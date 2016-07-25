<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class Schema_controller
* @version 07/05/2015 12:18:00
*/
class Input_data_contract_controller {

    function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','sc.schema_id');
        $sord = getVarClean('sord','str','asc');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('schema/input_data_contract');
            $table = $ci->input_data_contract;

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
            default :
                permission_check('view-schema');
                $data = $this->read();
            break;
        }

        return $data;
    }

    function replace_value($content, $schema_id){

        $ci = & get_instance();
        $ci->load->model('schema/schema_contract');
        $table = $ci->schema_contract;


        $item = $table->get_data_contract($schema_id);
        foreach ($item as $key => $value) {

            $content = str_replace('#NOMOR1#', $value['nomor1'], $content);
            $content = str_replace('#NOMOR2#', $value['nomor2'], $content);
            $content = str_replace('#CUSTOMER_NAME#', $value['nama_pt'], $content);
            $content = str_replace('#HARI#', $value['hari'], $content);
            $content = str_replace('#TANGGAL#', $value['tanggal'], $content);
            $content = str_replace('#BULAN#', $value['bulan'], $content);
            $content = str_replace('#TAHUN#', $value['tahun'], $content);
            $content = str_replace('#TEMPAT#', $value['lokasi'], $content);
            $content = str_replace('#ALAMAT_TELKOM#', $value['alamat_t'], $content);
            $content = str_replace('#ALAMAT_CUSTOMER#', $value['alamat_c'], $content);
            $content = str_replace('#NAMA_T#', $value['nama_t'], $content);
            $content = str_replace('#NAMA_C#', $value['nama_c'], $content);
            $content = str_replace('#JABATAN_C#', $value['jabatan_c'], $content);
            $content = str_replace('#JABATAN_T#', $value['jabatan_t'], $content);
            $content = str_replace('#BULAN_1#', $value['bulan_1'], $content);
            $content = str_replace('#BULAN_4#', $value['bulan_4'], $content);
            $content = str_replace('#NILAI_RATA2#', 'Rp. '.number_format($value['nilai_rata2'],2,",","."), $content);
            $content = str_replace('#PERCENT_CMT#', $value['percent_cmt'], $content);
            $content = str_replace('#NILAI_CMT#', 'Rp. '.number_format($value['nilai_cmt'],2,",","."), $content);
            $content = str_replace('#REK_NAME#', $value['rek_name'], $content);
            $content = str_replace('#REK_NO#', $value['rek_no'], $content);
            $content = str_replace('#ALAMAT_INV#', $value['alamat_inv'], $content);

        }
        

        return $content;
    }

    function word_contract(){

        $ci = & get_instance();

        $schema_id = getVarClean('schema_id','str','');

        $path = './application/third_party/contract/template/';
        //$filename = get_filename();
        $filename = $path.'haha.doc';
        $template_name = $path.'KBCostCap2.htm';
        $file_temp = $path."tmp_contract.doc";

        $template = file_get_contents($template_name);
        $content_html = $this->replace_value($template,$schema_id);

        file_put_contents($file_temp,$content_html); 

        header('Content-Description: File Transfer');
        header("Content-type: application/msword; charset=utf-8");
        header("Content-Disposition: attachment;Filename=data_contract.doc");
        readfile($file_temp);
        unlink($file_temp);
        exit; 
    }

    function submit_skema_diskon(){

        $ci = & get_instance();
        $ci->load->model('schema/sc_schema');
        $table = $ci->sc_schema;

        $discount_code = getVarClean('discount_code','str','');
        $start_dat = getVarClean('start_dat','str','');
        $end_dat = getVarClean('end_dat','str','');
        $schema_id = getVarClean('schema_id','str','');

        $upd = $table->updateScSchema($schema_id, $kolom = 'start_dat', $val=$start_dat, 'date');
        $upd = $table->updateScSchema($schema_id, $kolom = 'end_dat', $val=$end_dat, 'date');
        $upd = $table->updateScSchema($schema_id, $kolom = 'discount_id', $val=$discount_code, '');

        echo 1;

        exit;

    }



    function getDetailSkema() {
        $ci = & get_instance();
        $ci->load->model('schema/input_data_contract');
        $table = $ci->input_data_contract;

        $discount_code = getVarClean('discount_code','str','');

        $item = $table->getDetailSkema($discount_code);

        $html = '<form class="form-horizontal">';
        $html .='<div class="form-group">
                    <label class="col-md-4 control-label">Nama Paket :</label>
                    <div class="col-md-8">
                        '.$item['schem_name'].' - '.$item['disc_description'].'
                    </div>
                </div>';
        $html .='<div class="form-group">
                    <label class="col-md-4 control-label">Discount Incentive :</label>
                    <div class="col-md-8">
                        '.$item['disc_pct'].' %
                    </div>
                </div>';
        $html .='<div class="form-group">
                    <label class="col-md-4 control-label">Event Filter :</label>
                    <div class="col-md-8">
                        -
                    </div>
                </div>';
        $html .='<div class="form-group">
                    <label class="col-md-4 control-label">Revenue Commitment/Revenue Reference :</label>
                    <div class="col-md-8">
                        -
                    </div>
                </div>';
        $html .='<div class="form-group">
                    <label class="col-md-4 control-label">Periodic Charge :</label>
                    <div class="col-md-8">
                        -
                    </div>
                </div>';
        $html .= '</form>';

        echo $html;
        exit;
    }



    function readLovFastel() {

        $start = getVarClean('current','int',0);
        $limit = getVarClean('rowCount','int',5);

        $sort = getVarClean('sort','str','p_notel');
        $dir  = getVarClean('dir','str','asc');

        $searchPhrase = getVarClean('searchPhrase', 'str', '');
        $schema_id = getVarClean('schema_id','str','');

        $data = array('rows' => array(), 'success' => false, 'message' => '', 'current' => $start, 'rowCount' => $limit, 'total' => 0);

        try {

            $ci = & get_instance();
            $ci->load->model('schema/fastel');
            $table = $ci->fastel;

            if(!empty($searchPhrase)) {
                $table->setCriteria("(upper(p_notel) ".$table->likeOperator." upper('%".$searchPhrase."%'))");
            }

            if(!empty($schema_id)) {
                $table->setCriteria("schema_id = '".$schema_id."'");
            }

            $start = ($start-1) * $limit;
            $items = $table->getAll($start, $limit, $sort, $dir);
            $totalcount = $table->countAll();

            $data['rows'] = $items;
            $data['success'] = true;
            $data['total'] = $totalcount;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }

}

/* End of file Scema_controller.php */