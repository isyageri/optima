<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class Sc_schema_controller
* @version 07/05/2015 12:18:00
*/
class Sc_schema_controller {

    function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','schema_id');
        $sord = getVarClean('sord','str','desc');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('schema/sc_schema');
            $table = $ci->sc_schema;

            $req_param = array(
                "sort_by" => $sidx,
                "sord" => $sord,
                "limit" => null,
                "field" => null,
                "where" => null,
                "where_in" => null,
                "where_not_in" => null,
                "search" => $_REQUEST['_search'],
                "search_field" => isset($_REQUEST['searchField']) ? $_REQUEST['searchField'] : null,
                "search_operator" => isset($_REQUEST['searchOper']) ? $_REQUEST['searchOper'] : null,
                "search_str" => isset($_REQUEST['searchString']) ? $_REQUEST['searchString'] : null
            );

            // Filter Table
            $req_param['where'] = array();

            $table->setJQGridParam($req_param);
            $count = $table->countAll();

            if ($count > 0) $total_pages = ceil($count / $limit);
            else $total_pages = 1;

            if ($page > $total_pages) $page = $total_pages;
            $start = $limit * $page - ($limit); // do not put $limit*($page - 1)

            $req_param['limit'] = array(
                'start' => $start,
                'end' => $limit
            );

            $table->setJQGridParam($req_param);

            if ($page == 0) $data['page'] = 1;
            else $data['page'] = $page;

            $data['total'] = $total_pages;
            $data['records'] = $count;

            $data['rows'] = $table->getAll();
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }

    function crud() {

        $data = array();
        $oper = getVarClean('oper', 'str', '');
        switch ($oper) {
            case 'add' :
                permission_check('add-schema');
                $data = $this->create();
            break;

            case 'edit' :
                permission_check('edit-schema');
                $data = $this->update();
            break;

            case 'del' :
                permission_check('delete-schema');
                $data = $this->destroy();
            break;

            default :
                permission_check('view-schema');
                $data = $this->read();
            break;
        }

        return $data;
    }


    function create() {

        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        $jsonItems = getVarClean('items', 'str', '');
        $items = jsonDecode($jsonItems);

        if (!is_array($items)){
            $data['message'] = 'Invalid items parameter';
            return $data;
        }

        $table->actionType = 'CREATE';
        $errors = array();

        if (isset($items[0])){
            $numItems = count($items);
            for($i=0; $i < $numItems; $i++){
                try{

                    $table->db->trans_begin(); //Begin Trans

                        $table->setRecord($items[$i]);
                        $table->create();

                    $table->db->trans_commit(); //Commit Trans

                }catch(Exception $e){

                    $table->db->trans_rollback(); //Rollback Trans
                    $errors[] = $e->getMessage();
                }
            }

            $numErrors = count($errors);
            if ($numErrors > 0){
                $data['message'] = $numErrors." from ".$numItems." record(s) failed to be saved.<br/><br/><b>System Response:</b><br/>- ".implode("<br/>- ", $errors)."";
            }else{
                $data['success'] = true;
                $data['message'] = 'Data added successfully';
            }
            $data['rows'] =$items;
        }else {

            try{
                $table->db->trans_begin(); //Begin Trans

                    $table->setRecord($items);
                    $table->create();

                $table->db->trans_commit(); //Commit Trans

                $data['success'] = true;
                $data['message'] = 'Data added successfully';

            }catch (Exception $e) {
                $table->db->trans_rollback(); //Rollback Trans

                $data['message'] = $e->getMessage();
                $data['rows'] = $items;
            }

        }
        return $data;

    }


    function addSkema() {
        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $jsonItems = getVarClean('items', 'str', '');
        $items = jsonDecode($jsonItems);
        $data = array('success' => false, 'message' => '');

        try{
            $table->actionType = 'CREATE';
            $table->db->trans_begin(); //Begin Trans
                $table->setRecord($items);
                $table->create();

            $table->db->trans_commit(); //Commit Trans

            $data['schema_id'] = $table->record[$table->pkey];
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        echo json_encode($data);
        exit;
    }


    function update() {

        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        $jsonItems = getVarClean('items', 'str', '');
        $items = jsonDecode($jsonItems);

        if (!is_array($items)){
            $data['message'] = 'Invalid items parameter';
            return $data;
        }

        $table->actionType = 'UPDATE';

        if (isset($items[0])){
            $errors = array();
            $numItems = count($items);
            for($i=0; $i < $numItems; $i++){
                try{
                    $table->db->trans_begin(); //Begin Trans

                        $table->setRecord($items[$i]);
                        $table->update();

                    $table->db->trans_commit(); //Commit Trans

                    $items[$i] = $table->get($items[$i][$table->pkey]);
                }catch(Exception $e){
                    $table->db->trans_rollback(); //Rollback Trans

                    $errors[] = $e->getMessage();
                }
            }

            $numErrors = count($errors);
            if ($numErrors > 0){
                $data['message'] = $numErrors." from ".$numItems." record(s) failed to be saved.<br/><br/><b>System Response:</b><br/>- ".implode("<br/>- ", $errors)."";
            }else{
                $data['success'] = true;
                $data['message'] = 'Data update successfully';
            }
            $data['rows'] =$items;
        }else {

            try{
                $table->db->trans_begin(); //Begin Trans

                    $table->setRecord($items);
                    $table->update();

                $table->db->trans_commit(); //Commit Trans

                $data['success'] = true;
                $data['message'] = 'Data update successfully';

                $data['rows'] = $table->get($items[$table->pkey]);
            }catch (Exception $e) {
                $table->db->trans_rollback(); //Rollback Trans

                $data['message'] = $e->getMessage();
                $data['rows'] = $items;
            }

        }
        return $data;

    }

    function destroy() {
        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        $items = getVarClean('items', 'str', '');
       // $items = jsonDecode($jsonItems);

        try{
            $table->db->trans_begin(); //Begin Trans

            $total = 0;
            if (is_array($items)){
                foreach ($items as $key => $value){
                    if (empty($value)) throw new Exception('Empty parameter');

                    $table->remove($value);
                    $data['rows'][] = array($table->pkey => $value);
                    $total++;
                }
            }else{
                $items = $items;
                if (empty($items)){
                    throw new Exception('Empty parameter');
                };

                $table->remove($items);
                $data['rows'][] = array($table->pkey => $items);
                $data['total'] = $total = 1;
            }

            $data['success'] = true;
            $data['message'] = $total.' Data deleted successfully';

            $table->db->trans_commit(); //Commit Trans

        }catch (Exception $e) {
            $table->db->trans_rollback(); //Rollback Trans
            $data['message'] = $e->getMessage();
            $data['rows'] = array();
            $data['total'] = 0;
        }
        return $data;
    }

    public function getInfoSchema() {
        if(getVarClean('schema_id','str','')){
            $schema_id = getVarClean('schema_id','str','');
            $ci = & get_instance();
            $ci->load->model('schema/sc_schema');
            $table = $ci->sc_schema;
            
            $items = $table->getInfoSchema($schema_id);
            echo json_encode($items);
            exit;
        }else{
            echo 'nodata';
            exit;
        }
        
    }

    public function getTableTrendInfo() {

        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $schema_id = getVarClean('schema_id','str','');

        $result = array();
        $periode = array();

        $items = $table->getTrendInfo($schema_id);
        foreach($items as $item) {

            $periode[$item['periode']] = getMonth((int)substr($item['periode'], (strlen($item['periode'])-2)+1));

            $result['TELKOM_JJ']['items'][$item['periode']] = $item['telkom_jj'];
            $result['TELKOM_LK']['items'][$item['periode']]  = $item['telkom_lk'];
            $result['TELKOMSEL']['items'][$item['periode']] = $item['telkomsel'];
            $result['LAINNYA']['items'][$item['periode']] = $item['lainnya'];
            $result['TAGIHAN_ON_NET']['items'][$item['periode']] = $item['tagihan_on_net'];
            $result['TAGIHAN_NON_ON_NET']['items'][$item['periode']] = $item['tagihan_non_on_net'];

            $result['TOTAL_TAGIHAN']['items'][$item['periode']] =
                $result['TELKOM_JJ']['items'][$item['periode']] + $result['TELKOM_LK']['items'][$item['periode']] +
                $result['TELKOMSEL']['items'][$item['periode']] + $result['LAINNYA']['items'][$item['periode']] +
                $result['TAGIHAN_ON_NET']['items'][$item['periode']] + $result['TAGIHAN_NON_ON_NET']['items'][$item['periode']];
        }

        if(count($periode) == 0) {
            $max_month = 3;
            for($i = $max_month; $i >= 0; $i--) {
                $periode[date('m', strtotime('-'.$i.' month'))] = getMonth((int)date('m', strtotime('-'.$i.' month')));
            }
        }

        $itemheader = $table->getTrendHeader($schema_id);

        $html  = '<div class="col-md-12">
                      <div class="form-group form-md-line-input form-md-floating-label">
                            <label class="col-md-3 control-label" for="trend"><b>Trend:</b></label>
                            <div class="col-md-4">
                                <input type="text" id="trend-name" class="form-control" readonly value="'.$itemheader['trend_code'].'">
                            </div>
                      </div>
                      <div class="form-group form-md-line-input form-md-floating-label">
                            <label class="col-md-3 control-label" for="trend"><b>Avg On Net:</b></label>
                            <div class="col-md-4">
                                <input type="text" id="trend-avg-usage-onnet" class="form-control" readonly value="'.$itemheader['avg_usage_onnet'].'">
                            </div>
                      </div>
                      <div class="form-group form-md-line-input form-md-floating-label">
                            <label class="col-md-3 control-label" for="trend"><b>Avg Non On Net:</b></label>
                            <div class="col-md-4">
                                <input type="text" id="trend-avg-usage-nononnet" class="form-control" readonly value="'.$itemheader['avg_usage_non_onnet'].'">
                            </div>
                      </div>
                  </div>';
        $html .= '<table class="table">';
        $html .= '<tr>';
        $html .= '<th>Keterangan</th>';
        foreach($periode as $key => $pr) {
            $year = substr($key, 0, 4);
            $month = (int)substr($key,4);
            $html .= '<th><a href="javascript:;" onclick="showDetailTrend(\''.$year.'\',\''.$month.'\')">'.$pr.'</th>';
        }
        $html .= '</tr>';

        foreach($result as $keterangan => $nilai_per_periode) {
            $html .= '<tr>';
            $html .= '<td align="right">'.str_replace('_',' ',$keterangan).'</td>';
            foreach($nilai_per_periode['items'] as $val) {
                $html .= '<td align="right">'.numberFormat($val).'</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table>';

        echo $html;
        exit;
    }

    public function excelTableTrendInfo() {

        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $schema_id = getVarClean('schema_id','str','');

        $result = array();
        $periode = array();

        $items = $table->getTrendInfo($schema_id);
        foreach($items as $item) {

            $periode[$item['periode']] = getMonth((int)substr($item['periode'], (strlen($item['periode'])-2)+1));

            $result['TELKOM_JJ']['items'][$item['periode']] = $item['telkom_jj'];
            $result['TELKOM_LK']['items'][$item['periode']]  = $item['telkom_lk'];
            $result['TELKOMSEL']['items'][$item['periode']] = $item['telkomsel'];
            $result['LAINNYA']['items'][$item['periode']] = $item['lainnya'];
            $result['TAGIHAN_ON_NET']['items'][$item['periode']] = $item['tagihan_on_net'];
            $result['TAGIHAN_NON_ON_NET']['items'][$item['periode']] = $item['tagihan_non_on_net'];

            $result['TOTAL_TAGIHAN']['items'][$item['periode']] =
                $result['TELKOM_JJ']['items'][$item['periode']] + $result['TELKOM_LK']['items'][$item['periode']] +
                $result['TELKOMSEL']['items'][$item['periode']] + $result['LAINNYA']['items'][$item['periode']] +
                $result['TAGIHAN_ON_NET']['items'][$item['periode']] + $result['TAGIHAN_NON_ON_NET']['items'][$item['periode']];
        }

        if(count($periode) == 0) {
            $max_month = 3;
            for($i = $max_month; $i >= 0; $i--) {
                $periode[$i] = getMonth((int)date('m', strtotime('-'.$i.' month')));
            }
        }

        $itemheader = $table->getTrendHeader($schema_id);
        $html  = '<b>Trend</b> : '.$itemheader['trend_code'].'<br>
                  <b>Avg On Net</b> : '.$itemheader['avg_usage_onnet'].'<br>
                  <b>Avg Non On Net</b> : '.$itemheader['avg_usage_non_onnet'].'<br><br>';
        $html .= '<table border="1">';
        $html .= '<tr>';
        $html .= '<th>Keterangan</th>';
        foreach($periode as $pr) {
            $html .= '<th>'.$pr.'</th>';
        }
        $html .= '</tr>';

        foreach($result as $keterangan => $nilai_per_periode) {
            $html .= '<tr>';
            $html .= '<td>'.str_replace('_',' ',$keterangan).'</td>';
            foreach($nilai_per_periode['items'] as $val) {
                $html .= '<td align="right">'.numberFormat($val).'</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table>';

        startExcel('schema_trend_info.xls');
        echo '<html>';
        echo '<head><title>Excel Trend & Info</title></head>';
        echo '<body>';
        echo $html;
        echo '</body>';
        echo '</html>';
        exit;
    }

    public function getTableSkemaPembayaran_lov() {

        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $result = array();
        $periode = array();

        $schema_id = getVarClean('schema_id','str','');
        $trend = getVarClean('trend','str','');
        $operator = getVarClean('operator','str','');
        $kuadran = getVarClean('kuadran','str','');
        $model = getVarClean('model','str','');


        $discount_code = $table->getDiscountCodeAccBusinessSchem($schema_id);
        $items = $table->getListSkemaPembayaran( $trend, $operator, $kuadran, $model );
        // $items = $table->getListSkemaPembayaran($discount_code, $trend, $operator, $kuadran, $model );

        $html  = '<table class="table">';
        $html .= '<tr>';
        $html .= '<th>No</th>';
        $html .= '<th>Nama Skema</th>';
        $html .= '<th>Diskon (%)</th>';
        $html .= '<th>Keterangan Diskon</th>';
        $html .= '<th>'.(empty($discount_code) ? "Action" : "Status").'</th>';
        $html .= '</tr>';

        $no = 1;
        foreach($items as $item) {
            $html .= '<tr>';
            $html .= '<td>'.$no++.'</td>';
            $html .= '<td>'.$item['schem_name'].'</td>';
            $html .= '<td>'.$item['disc_pct'].'</td>';
            $html .= '<td>'.$item['disc_description'].'</td>';
            if(empty($discount_code)) {
                $html .= '<td>
                                <button type ="button" class="btn btn-sm btn-primary" onclick="showSimulasi(\''.$item['discount_code'].'\')"> Simulasi </button>'
                                //'<button type ="button" class="btn btn-sm btn-success pilih-simulasi" onclick="pilihSimulasi(\''.$item['discount_code'].'\','.$item['p_business_schem_id'].')"> Pilih </button>
                          .'</td>';
            }else {
                 $html .= '<td> Dipilih </td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';
        echo $html;
        exit;
    }

    public function getTableSkemaPembayaran() {

        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $result = array();
        $periode = array();

        $schema_id = getVarClean('schema_id','str','');
        $trend = getVarClean('trend','str','');
        $operator = getVarClean('operator','str','');
        $kuadran = getVarClean('kuadran','str','');
        $model = getVarClean('model','str','');


        $discount_code = $table->getDiscountCodeAccBusinessSchem($schema_id);
        $items = $table->getListSkemaPembayaran( $trend, $operator, $kuadran, $model );
        // $items = $table->getListSkemaPembayaran($discount_code, $trend, $operator, $kuadran, $model );

        $html  = '<table class="table">';
        $html .= '<tr>';
        $html .= '<th>No</th>';
        $html .= '<th>Nama Skema</th>';
        $html .= '<th>Diskon (%)</th>';
        $html .= '<th>Keterangan Diskon</th>';
        $html .= '<th>'.(empty($discount_code) ? "Action" : "Status").'</th>';
        $html .= '</tr>';

        $no = 1;
        foreach($items as $item) {
            $html .= '<tr>';
            $html .= '<td>'.$no++.'</td>';
            $html .= '<td>'.$item['schem_name'].'</td>';
            $html .= '<td>'.$item['disc_pct'].'</td>';
            $html .= '<td>'.$item['disc_description'].'</td>';
            if(empty($discount_code)) {
                $html .= '<td>
                                <button type ="button" class="btn btn-sm btn-primary" onclick="showSimulasi(\''.$item['discount_code'].'\')"> Simulasi </button>'
                                //'<button type ="button" class="btn btn-sm btn-success pilih-simulasi" onclick="pilihSimulasi(\''.$item['discount_code'].'\','.$item['p_business_schem_id'].')"> Pilih </button>
                          .'</td>';
            }else {
                 $html .= '<td> Dipilih </td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';
        echo $html;
        exit;
    }

     public function getTableSkemaPembayaran2() {

        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $result = array();
        $periode = array();

        $schema_id = getVarClean('schema_id','str','');
        $form = getVarClean('form','str','');
        $trend = getVarClean('trend','str','');
        $getop = $table->get_data_skema($schema_id);
        
        foreach($getop as $op) {
            $operator = $op['operator'];
        }

        $kuadran = '';
        $getkuadran = $table->get_select_option($select='kuadran', $trend, $kuadran, $operator);
        
        foreach($getkuadran as $kd) {
            $kuadran = $kd['id'];
        }
        
        $discount_code = $table->getDiscountCodeAccBusinessSchem($schema_id);
        $model = '';
        $items = $table->getListSkemaPembayaran2( $trend, $operator, $kuadran, $model );
        // $items = $table->getListSkemaPembayaran($discount_code, $trend, $operator, $kuadran, $model );

        $html  = '<table class="table">';
        $html .= '<tr>';
        $html .= '<th>No</th>';
        $html .= '<th>Nama Skema</th>';
        $html .= '<th>Diskon (%)</th>';
        $html .= '<th>Keterangan Diskon</th>';
        $html .= '<th>'.(empty($discount_code) ? "Action" : "Status").'</th>';
        $html .= '</tr>';

        $no = 1;
        foreach($items as $item) {
            $html .= '<tr>';
            $html .= '<td>'.$no++.'</td>';
            $html .= '<td>'.$item['schem_name'].'</td>';
            $html .= '<td>'.$item['disc_pct'].'</td>';
            $html .= '<td>'.$item['disc_description'].'</td>';
            if(empty($discount_code)) {
                if($form == 'contract'){
                    $description= $item['schem_name'].' | '.$item['disc_description'];
                    $html .= '<td>'.
                                //'<button type ="button" class="btn btn-sm btn-primary" onclick="showSimulasi(\''.$item['discount_code'].'\')"> Simulasi </button>'
                                '<button type ="button" class="btn btn-sm btn-success pilih-simulasi" onclick="pilih_diskon(\''.$item['discount_code'].'\',\''.$description.'\', '.$item['p_business_schem_id'].')"> Pilih </button>'
                          .'</td>';
                }else{
                    $html .= '<td>'
                                //'<button type ="button" class="btn btn-sm btn-primary" onclick="showSimulasi(\''.$item['discount_code'].'\')"> Simulasi </button>'
                                /*'<button type ="button" class="btn btn-sm btn-success pilih-simulasi" onclick="pilihSimulasi(\''.$item['discount_code'].'\','.$item['p_business_schem_id'].')"> Pilih </button>'*/
                          .'</td>';
                }
                
            }else {
                 $html .= '<td> Dipilih </td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';
        echo $html;
        exit;
    }

    public function getSimulasiTable() {

        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $schema_id = getVarClean('schema_id','str','');
        $avg_on_net = getVarClean('avg_on_net','int',0);
        $on_net = getVarClean('on_net','int',0);
        $non_on_net = getVarClean('non_on_net','int',0);
        $discount_code = getVarClean('discount_code','int',0);
        
        $kuadran = getVarClean('kuadran','str','');
        $operator = getVarClean('operator','str','');
        $trend = getVarClean('trend','str','');
        $model = getVarClean('model','str','');
        
        

        $item = $table->get($schema_id);

        $I_ACCOUNT_NUM = $item['account_num'];
        $I_BILL_PERIOD = date('Ym');
        $I_AVG_ON_NET = $avg_on_net;
        $I_ON_NET = $on_net;
        $I_NON_ON_NET = $non_on_net;
        $I_DISCOUNT_CODE = 0; //$discount_code;
            
            $html = '<div class="tabbable-custom ">';
            $html .= '<ul class="nav nav-tabs ">';/*
            $html .= '<li class="$active">';
            $html .= '<a href="#tab_ke$i" data-toggle="tab">'.$item['id'].'</a>';
            $html .= '</li>';*/
            $html .= '#LI_SECTION#';
            $html .= '</ul>';
            $html .= '<div class="tab-content">';
            // $html .= '<div class="tab-pane active" id="tab_ke$i">';
            $html .= '#TAB_CONTENT_SECTION#';
            
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            $LI_SECTION ='';
            $TH_VAL_SECTION ='';
            $TAB_CONTENT_SECTION ='';
            $CONTENT_TAB ='';
            $CONTENT_TABLE_SECTION ='';

        // get skema pembayaran 
        $items2 = $table->get_select_option($select='skema_pembayaran', $trend, $kuadran, $operator);
        // loop 
        $i =0;
        foreach($items2 as $item) {
            if($i == 0){
                $active = 'active';
            }else{
                $active = '';
            }

            $LI_SECTION .= '<li class="'.$active.'">';
            $LI_SECTION .= '<a href="#tab_ke'.$i.'" data-toggle="tab">'.$item['id'].'</a>';
            $LI_SECTION .= '</li>';

           // $TAB_CONTENT_SECTION ='';
            $CONTENT_TAB .= '<div class="tab-pane '.$active.'" id="tab_ke'.$i.'">';
            $CONTENT_TAB .= '#CONTENT_TAB'.$i.'#';
            $CONTENT_TAB .= '</div>';

            $TAB_CONTENT_SECTION .= '<table class="table table-bordered">';
            $TAB_CONTENT_SECTION .= '<tr>';
            $TAB_CONTENT_SECTION .= '<th>No</th>';
            $TAB_CONTENT_SECTION .= '<th>Keterangan</th>';
            $TAB_CONTENT_SECTION .= '#TH_VAL_SECTION'.$i.'#';
            $TAB_CONTENT_SECTION .= '#CONTENT_TABLE_SECTION'.$i.'#';
            $TAB_CONTENT_SECTION .= '</tr>';
            $TAB_CONTENT_SECTION .= '</table>';
          
                $skema_discount =  $table->getListSkemaPembayaran($trend, $operator, $kuadran, $item['id']);

                $TH_VAL_SECTION = '';
                foreach ($skema_discount as $key ) {
                      $TH_VAL_SECTION .= '<th>'.$key['disc_description'].'</th>';
                }

            $total_skema = count($skema_discount);
            $tdnum = 1;
            $CONTENT_TABLE_SECTION = '';
            foreach ($skema_discount as $key ) {
                //$CONTENT_TABLE_SECTION = '';

                $I_DISCOUNT_CODE = $key['discount_code'];

                $curs = oci_new_cursor($table->db->conn_id);
                $sql = "begin P_M4L_CALCULATE_ADJ_ONLY_C( :I_ACCOUNT_NUM, :I_BILL_PERIOD, :I_AVG_ON_NET, :I_ON_NET, :I_NON_ON_NET, :I_DISCOUNT_CODE, :O_CURSOR ); end;";
                $stid = oci_parse($table->db->conn_id, $sql);

                oci_bind_by_name($stid, ':I_ACCOUNT_NUM', $I_ACCOUNT_NUM, 255);
                oci_bind_by_name($stid, ':I_BILL_PERIOD', $I_BILL_PERIOD, 255);
                oci_bind_by_name($stid, ':I_AVG_ON_NET', $I_AVG_ON_NET, 32);
                oci_bind_by_name($stid, ':I_ON_NET', $I_ON_NET, 32);
                oci_bind_by_name($stid, ':I_NON_ON_NET', $I_NON_ON_NET, 32);
                oci_bind_by_name($stid, ':I_DISCOUNT_CODE', $I_DISCOUNT_CODE, 255);

                oci_bind_by_name($stid, ":O_CURSOR", $curs, -1, OCI_B_CURSOR);

                oci_execute($stid);
                oci_execute($curs, OCI_DEFAULT);
                oci_fetch_all($curs, $data, null, null, OCI_FETCHSTATEMENT_BY_ROW);

                $no = 1;
                $rpc = $tdnum + 1;
                $clearing = '';
                $addingtd = '';
                foreach($data as $item1) {
                    
                     if($tdnum == 1){

                        $CONTENT_TABLE_SECTION .= '<tr>';
                        $CONTENT_TABLE_SECTION .= '<td>'.$no++.'</td>';
                        $CONTENT_TABLE_SECTION .= '<td>'.$item1['V1'].'</td>';
                        $CONTENT_TABLE_SECTION .= '<td align="right">'.$item1['V2'].'</td>replace'.$rpc.'#'.$no;
                        $CONTENT_TABLE_SECTION .= '</tr>';
                   
                     }else{

                        $no++;
                        if($tdnum ==  $total_skema ){
                            $addingtd = '<td align="right">'.$item1['V2'].'</td>';
                        }else{
                            $addingtd = '<td align="right">'.$item1['V2'].'</td>replace'.$rpc.'#'.$no;
                        }
                       
                        $CONTENT_TABLE_SECTION = str_replace('replace'.$tdnum.'#'.$no, $addingtd, $CONTENT_TABLE_SECTION);

                     }
                            
                }
                
               
                $tdnum ++;
                //oci_statement_type($curs);
            }

                $TAB_CONTENT_SECTION = str_replace('#CONTENT_TABLE_SECTION'.$i.'#', $CONTENT_TABLE_SECTION, $TAB_CONTENT_SECTION);
                $TAB_CONTENT_SECTION = str_replace('#TH_VAL_SECTION'.$i.'#', $TH_VAL_SECTION, $TAB_CONTENT_SECTION);
                $CONTENT_TAB = str_replace('#CONTENT_TAB'.$i.'#', $TAB_CONTENT_SECTION, $CONTENT_TAB);
                $TAB_CONTENT_SECTION = '';
                $i++;
        }
               
            // $html = str_replace('#TAB_CONTENT_SECTION#', $TAB_CONTENT_SECTION, $html );
            $html = str_replace('#TAB_CONTENT_SECTION#', $CONTENT_TAB, $html );
            $html = str_replace('#LI_SECTION#', $LI_SECTION, $html );
            $html = str_replace('#TH_VAL_SECTION#', $TH_VAL_SECTION, $html );
            $html = str_replace('#CONTENT_TABLE_SECTION#', $CONTENT_TABLE_SECTION, $html );
        

        echo $html;
        exit;
    }


    public function excelSimulasiTable() {
        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $schema_id = getVarClean('schema_id','str','');
        $avg_on_net = getVarClean('avg_on_net','int',0);
        $on_net = getVarClean('on_net','int',0);
        $non_on_net = getVarClean('non_on_net','int',0);
        $discount_code = getVarClean('discount_code','int',0);
        
        $kuadran = getVarClean('kuadran','str','');
        $operator = getVarClean('operator','str','');
        $trend = getVarClean('trend','str','');
        $model = getVarClean('model','str','');
        
        

        $item = $table->get($schema_id);

        $I_ACCOUNT_NUM = $item['account_num'];
        $I_BILL_PERIOD = date('Ym');
        $I_AVG_ON_NET = $avg_on_net;
        $I_ON_NET = $on_net;
        $I_NON_ON_NET = $non_on_net;
        $I_DISCOUNT_CODE = 0; //$discount_code;
            
            $html = '<div class="tabbable-custom ">';
            $html .= '<ul class="nav nav-tabs ">';/*
            $html .= '<li class="$active">';
            $html .= '<a href="#tab_ke$i" data-toggle="tab">'.$item['id'].'</a>';
            $html .= '</li>';*/
            $html .= '#LI_SECTION#';
            $html .= '</ul>';
            $html .= '<div class="tab-content">';
            // $html .= '<div class="tab-pane active" id="tab_ke$i">';
            $html .= '#TAB_CONTENT_SECTION#';
            
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';

            $LI_SECTION ='';
            $TH_VAL_SECTION ='';
            $TAB_CONTENT_SECTION ='';
            $CONTENT_TAB ='';
            $CONTENT_TABLE_SECTION ='';
        

        // get skema pembayaran 
        $items2 = $table->get_select_option($select='skema_pembayaran', $trend, $kuadran, $operator);
        // loop 
        $i =0;
        foreach($items2 as $item) {
            if($i == 0){
                $active = 'active';
            }else{
                $active = '';
            }

            $LI_SECTION .= '<li class="'.$active.'">';
            $LI_SECTION .= '<a href="#tab_ke'.$i.'" data-toggle="tab">'.$item['id'].'</a>';
            $LI_SECTION .= '</li>';

           // $TAB_CONTENT_SECTION ='';
            $CONTENT_TAB .= '<div class="tab-pane '.$active.'" id="tab_ke'.$i.'">';
            $CONTENT_TAB .= '#CONTENT_TAB'.$i.'#';
            $CONTENT_TAB .= '</div>';

            $TAB_CONTENT_SECTION .= '<table class="table table-bordered">';
            $TAB_CONTENT_SECTION .= '<tr>';
            $TAB_CONTENT_SECTION .= '<th>No</th>';
            $TAB_CONTENT_SECTION .= '<th>Keterangan</th>';
            $TAB_CONTENT_SECTION .= '#TH_VAL_SECTION'.$i.'#';
            $TAB_CONTENT_SECTION .= '#CONTENT_TABLE_SECTION'.$i.'#';
            $TAB_CONTENT_SECTION .= '</tr>';
            $TAB_CONTENT_SECTION .= '</table>';
          
                $skema_discount =  $table->getListSkemaPembayaran($trend, $operator, $kuadran, $item['id']);

                $TH_VAL_SECTION = '';
                foreach ($skema_discount as $key ) {
                      $TH_VAL_SECTION .= '<th>'.$key['disc_description'].'</th>';
                }

            $total_skema = count($skema_discount);
            $tdnum = 1;
            $CONTENT_TABLE_SECTION = '';
            foreach ($skema_discount as $key ) {
                //$CONTENT_TABLE_SECTION = '';

                $I_DISCOUNT_CODE = $key['discount_code'];

                $curs = oci_new_cursor($table->db->conn_id);
                $sql = "begin P_M4L_CALCULATE_ADJ_ONLY_C( :I_ACCOUNT_NUM, :I_BILL_PERIOD, :I_AVG_ON_NET, :I_ON_NET, :I_NON_ON_NET, :I_DISCOUNT_CODE, :O_CURSOR ); end;";
                $stid = oci_parse($table->db->conn_id, $sql);

                oci_bind_by_name($stid, ':I_ACCOUNT_NUM', $I_ACCOUNT_NUM, 255);
                oci_bind_by_name($stid, ':I_BILL_PERIOD', $I_BILL_PERIOD, 255);
                oci_bind_by_name($stid, ':I_AVG_ON_NET', $I_AVG_ON_NET, 32);
                oci_bind_by_name($stid, ':I_ON_NET', $I_ON_NET, 32);
                oci_bind_by_name($stid, ':I_NON_ON_NET', $I_NON_ON_NET, 32);
                oci_bind_by_name($stid, ':I_DISCOUNT_CODE', $I_DISCOUNT_CODE, 255);

                oci_bind_by_name($stid, ":O_CURSOR", $curs, -1, OCI_B_CURSOR);

                oci_execute($stid);
                oci_execute($curs, OCI_DEFAULT);
                oci_fetch_all($curs, $data, null, null, OCI_FETCHSTATEMENT_BY_ROW);

                $no = 1;
                $rpc = $tdnum + 1;
                $clearing = '';
                $addingtd = '';
                foreach($data as $item1) {
                    
                     if($tdnum == 1){

                        $CONTENT_TABLE_SECTION .= '<tr>';
                        $CONTENT_TABLE_SECTION .= '<td>'.$no++.'</td>';
                        $CONTENT_TABLE_SECTION .= '<td>'.$item1['V1'].'</td>';
                        $CONTENT_TABLE_SECTION .= '<td align="right">'.$item1['V2'].'</td>replace'.$rpc.'#'.$no;
                        $CONTENT_TABLE_SECTION .= '</tr>';
                   
                     }else{

                        $no++;
                        if($tdnum ==  $total_skema ){
                            $addingtd = '<td align="right">'.$item1['V2'].'</td>';
                        }else{
                            $addingtd = '<td align="right">'.$item1['V2'].'</td>replace'.$rpc.'#'.$no;
                        }
                       
                        $CONTENT_TABLE_SECTION = str_replace('replace'.$tdnum.'#'.$no, $addingtd, $CONTENT_TABLE_SECTION);

                     }
                            
                }
                
               
                $tdnum ++;
                //oci_statement_type($curs);
            }

                $TAB_CONTENT_SECTION = str_replace('#CONTENT_TABLE_SECTION'.$i.'#', $CONTENT_TABLE_SECTION, $TAB_CONTENT_SECTION);
                $TAB_CONTENT_SECTION = str_replace('#TH_VAL_SECTION'.$i.'#', $TH_VAL_SECTION, $TAB_CONTENT_SECTION);
                $CONTENT_TAB = str_replace('#CONTENT_TAB'.$i.'#', $TAB_CONTENT_SECTION, $CONTENT_TAB);
                $TAB_CONTENT_SECTION = '';
                $i++;
        }
               startExcel('simulasi_'.$I_DISCOUNT_CODE.'.xls');
            // $html = str_replace('#TAB_CONTENT_SECTION#', $TAB_CONTENT_SECTION, $html );
            $html = str_replace('#TAB_CONTENT_SECTION#', $CONTENT_TAB, $html );
            $html = str_replace('#LI_SECTION#', $LI_SECTION, $html );
            $html = str_replace('#TH_VAL_SECTION#', $TH_VAL_SECTION, $html );
            $html = str_replace('#CONTENT_TABLE_SECTION#', $CONTENT_TABLE_SECTION, $html );
        
            
        echo $html;
        exit;

    }

    public function excelSimulasiTable_ori() {

        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $schema_id = getVarClean('schema_id','str','');
        $avg_on_net = getVarClean('avg_on_net','int',0);
        $on_net = getVarClean('on_net','int',0);
        $non_on_net = getVarClean('non_on_net','int',0);
        $discount_code = getVarClean('discount_code','int',0);

        $item = $table->get($schema_id);

        $I_ACCOUNT_NUM = $item['account_num'];
        $I_BILL_PERIOD = date('Ym');
        $I_AVG_ON_NET = $avg_on_net;
        $I_ON_NET = $on_net;
        $I_NON_ON_NET = $non_on_net;
        $I_DISCOUNT_CODE = $discount_code;

        $curs = oci_new_cursor($table->db->conn_id);
        $sql = "begin P_M4L_CALCULATE_ADJ_ONLY_C( :I_ACCOUNT_NUM, :I_BILL_PERIOD, :I_AVG_ON_NET, :I_ON_NET, :I_NON_ON_NET, :I_DISCOUNT_CODE, :O_CURSOR ); end;";
        $stid = oci_parse($table->db->conn_id, $sql);

        oci_bind_by_name($stid, ':I_ACCOUNT_NUM', $I_ACCOUNT_NUM, 255);
        oci_bind_by_name($stid, ':I_BILL_PERIOD', $I_BILL_PERIOD, 255);
        oci_bind_by_name($stid, ':I_AVG_ON_NET', $I_AVG_ON_NET, 32);
        oci_bind_by_name($stid, ':I_ON_NET', $I_ON_NET, 32);
        oci_bind_by_name($stid, ':I_NON_ON_NET', $I_NON_ON_NET, 32);
        oci_bind_by_name($stid, ':I_DISCOUNT_CODE', $I_DISCOUNT_CODE, 255);

        oci_bind_by_name($stid, ":O_CURSOR", $curs, -1, OCI_B_CURSOR);

        oci_execute($stid);
        oci_execute($curs, OCI_DEFAULT);
        oci_fetch_all($curs, $data, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        startExcel('simulasi_'.$I_DISCOUNT_CODE.'.xls');
        $html = '<html>';
        $html .= '<head>
                    <title>Simulasi</title>
                </head>';
        $html .= '<body>';
        $html .= 'Discount Code : '.$I_DISCOUNT_CODE;
        $html .= '<br>Average On Net : '.$I_AVG_ON_NET;
        $html .= '<br>On Net : '.$I_ON_NET;
        $html .= '<br>Non On Net : '.$I_ON_NET;
        $html .= '<br>';
        $html .= '<table border="1">';
        $html .= '<tr>';
        $html .= '<th>No</th>';
        $html .= '<th>Keterangan</th>';
        $html .= '<th>Value</th>';
        $html .= '</tr>';

        $no = 1;
        foreach($data as $item) {
            $html .= '<tr>';
            $html .= '<td>'.$no++.'</td>';
            $html .= '<td>'.$item['V1'].'</td>';
            $html .= '<td align="right">'.$item['V2'].'</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        $html .= '</body>';
        $html .= '</html>';
        echo $html;
        exit;
    }

    public function createDataContract() {
        $ci = & get_instance();
        $ci->load->model('schema/schema_contract');
        $table = $ci->schema_contract;

        $schema_id = getVarClean('schema_id','str','');
        $nomor1 = getVarClean('nomor1','str','');
        $nomor2 = getVarClean('nomor2','str','');
        $hari = getVarClean('hari','str','');
        $tanggal = getVarClean('tanggal','str','');
        $bulan = getVarClean('bulan','str','');
        $tahun = getVarClean('tahun','str','');
        $lokasi = getVarClean('lokasi','str','');
        $alamat_t = getVarClean('alamat_t','str','');
        $alamat_c = getVarClean('alamat_c','str','');
        $nama_t = getVarClean('nama_t','str','');
        $nama_c = getVarClean('nama_c','str','');
        $rek_no = getVarClean('rek_no','str','');
        $rek_name = getVarClean('rek_name','str','');
        $jabatan_t = getVarClean('jabatan_t','str','');
        $jabatan_c = getVarClean('jabatan_c','str','');
        $nama_pt = getVarClean('nama_pt','str','');
        $alamat_inv = getVarClean('alamat_inv','str','');
        $program = getVarClean('program','int',0);

        $data = array('success' => false, 'message' => '');

        try{

            $items = [
                'nomor1' => $nomor1,
                'nomor2' => $nomor2,
                'hari' => $hari,
                'tanggal' => $tanggal,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'lokasi' => $lokasi,
                'alamat_t' => $alamat_t,
                'alamat_c' => $alamat_c,
                'nama_t' => $nama_t,
                'nama_c' => $nama_c,
                'rek_no' => $rek_no,
                'rek_name' => $rek_name,
                'jabatan_t' => $jabatan_t,
                'jabatan_c' => $jabatan_c,
                'nama_pt' => $nama_pt,
                'alamat_inv' => $alamat_inv,
                'program' => $program
            ];

            $this->pilihSimulasiPembayaran($table);

            $table->actionType = 'CREATE';
            $table->db->trans_begin(); //Begin Trans
                $table->setRecord($items);
                $table->db->set('schema_id',$schema_id);
                $table->create();

            $table->db->trans_commit(); //Commit Trans

            $data['success'] = true;
            $data['message'] = 'Data berhasil ditambahkan';
        }catch (Exception $e) {
            $table->db->trans_rollback(); //Rollback Trans
            $data['message'] = $e->getMessage();
        }
        
        echo json_encode($data);
        exit;
    }

    public function pilihSimulasiPembayaran($tSchemaContract = '') {

        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $schema_id = getVarClean('schema_id','str','');
        $discount_code = getVarClean('discount_code','str','');
        $p_business_schem_id = getVarClean('p_business_schem_id','int',0);

        $m4l_acc_schema_id = $table->getAccSchemaID($schema_id);
        $data = array('success' => false, 'message' => '');
        try{

            if(empty($m4l_acc_schema_id)) throw new Exception('Data belum tersedia, tidak dapat dipilih');

            $item_schema = $table->get($schema_id);
            $record = array(
                'M4L_ACC_BUSINESS_SCHEM_ID' => $table->generate_id('M4L_ACC_BUSINESS_SCHEM'),
                'M4L_ACC_SCHEMA_ID' => $m4l_acc_schema_id,
                'P_BUSINESS_SCHEM_ID' => $p_business_schem_id,
                'DISCOUNT_CODE' => $discount_code,
                'CREATED_BY' => $ci->ion_auth->user()->row()->username,
                'UPDATED_BY' => $ci->ion_auth->user()->row()->username
            );

            $table->db->set($record);
            $table->db->set('VALID_FROM', "to_date('".$item_schema['start_dat']."','yyyy-mm-dd')",false);
            if(empty($item['end_dat']))
                $table->db->set('VALID_TO', NULL);
            else
                $table->db->set('VALID_TO', "to_date('".$item_schema['end_dat']."','yyyy-mm-dd')",false);
            $table->db->set('CREATION_DATE','sysdate', false);
            $table->db->set('UPDATED_DATE','sysdate', false);

            $table->db->insert('M4L_ACC_BUSINESS_SCHEM');


            $sqlupdate_schema = "UPDATE sc_schema SET M4L_ACC_SCHEMA_ID = ".$m4l_acc_schema_id."
                                    WHERE schema_id = ".$schema_id;

            $table->db->query($sqlupdate_schema);

            $data['success'] = true;
            $data['message'] = 'Data pembayaran dengan discount code : '.$discount_code.' telah dipilih';
        }catch (Exception $e) {
            if(!empty($tSchemaContract)) {
                $tSchemaContract->db->trans_rollback(); //Rollback Trans
            }
            $data['message'] = $e->getMessage();
            echo json_encode($data);
            exit;
        }

        if(empty($tSchemaContract)) {
            echo json_encode($data);
            exit;
        }else {
            return true;
        }
    }

    public function proses_get_history(){
        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $schema_id = getVarClean('schema_id','str','');
        // $username = $ci->ion_auth->user()->row()->username;
        $username = 'qwert'; //$ci->ion_auth->user()->row()->username;
        
        $data = array('success' => false, 'message' => '');

        try{

            $table->prosesGetHistory($schema_id, $username);
            // run proses get history pl 
            $command = "/sourcehubber/m4l/header_run_job.pl";
            $shell = shell_exec($command);

            $data['success'] = true;
            $data['message'] = 'Data Fastel Berhasil Di Proses ';
        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }
        
        echo json_encode($data);
        exit;

    }

    function finished() {

        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $ci->load->model('workflow/pembuatan_schema');
        $tosdb = $ci->pembuatan_schema;


        $trend = getVarClean('trend','str','');
        $schema_id = getVarClean('schema_id','str','');
        $model = getVarClean('model','str','');
        $kuadran = getVarClean('kuadran','str','');
        $operator = getVarClean('operator','str','');
        
        
        
        try{

            $table-> updateScSchema($schema_id, $kolom='trend', $val=$trend,'');
            $table-> updateScSchema($schema_id, $kolom='step', $val=4,'');
            $table-> updateScSchema($schema_id, $kolom='status', $val=4,'');
            $table-> updateScSchema($schema_id, $kolom='operator', $val=$operator,'');

            $order_id = $tosdb->create_customer_order();

            $table->updateScSchema($schema_id, $kolom='T_CUSTOMER_ORDER_ID', $val=$order_id,'');

            $tosdb->submitWF($order_id, $doc_type_id=1);


            $data['success'] = true;
            $data['message'] = 'Data Offering Berhasil Disimpan ! ';
        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }
        
        echo json_encode($data);
        exit;
    }

    function get_select_option() {

        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $trend = getVarClean('trend','str','');
        $operator = getVarClean('operator','str','');

        $items = $table->get_select_option($select='kuadran', $trend, '', $operator);

        $ret = '';

        foreach($items as $item) {
            $ret .= '<option value="'.$item['id'].'"> '.$item['code'].' </option>';
            $kuadran = $item['id'];
        }
        
        $items2 = $table->get_select_option($select='skema_pembayaran', $trend, $kuadran, $operator);
        $ret.='|';
        
        $ret.= '<option value="-"> - </option>';
        foreach($items2 as $item) {
            $ret.= '<option value="'.$item['id'].'"> '.$item['code'].' </option>';
        }
        echo $ret;
        exit;
    }

}

/* End of file Scema_controller.php */