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

        $html  = '<table class="table">';
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
            $html .= '<td>'.str_replace('_',' ',$keterangan).'</td>';
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

        $html  = '<table border="1">';
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


    public function getTableSkemaPembayaran() {

        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $result = array();
        $periode = array();

        $items = $table->getListSkemaPembayaran();

        $html  = '<table class="table">';
        $html .= '<tr>';
        $html .= '<th>No</th>';
        $html .= '<th>Nama Skema</th>';
        $html .= '<th>Diskon (%)</th>';
        $html .= '<th>Keterangan Diskon</th>';
        $html .= '<th>Action</th>';
        $html .= '</tr>';

        $no = 1;
        foreach($items as $item) {
            $html .= '<tr>';
            $html .= '<td>'.$no++.'</td>';
            $html .= '<td>'.$item['schem_name'].'</td>';
            $html .= '<td>'.$item['disc_pct'].'</td>';
            $html .= '<td>'.$item['disc_description'].'</td>';
            $html .= '<td>
                            <button type ="button" class="btn btn-primary" onclick="showSimulasi(\''.$item['discount_code'].'\')"> Simulasi </button>
                            <button type ="button" class="btn btn-success"> Pilih </button>
                      </td>';
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

        $html = '<table class="table table-bordered">';
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
}

/* End of file Scema_controller.php */