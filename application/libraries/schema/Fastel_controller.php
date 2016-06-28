<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class Sc_schema_controller
* @version 07/05/2015 12:18:00
*/
class Fastel_controller {

    function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','schema_id');
        $sord = getVarClean('sord','str','desc');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        $schema_id = getVarClean('schema_id','str',-1);

        try {

            $ci = & get_instance();
            $ci->load->model('schema/fastel');
            $table = $ci->fastel;

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
            $req_param['where'] = array("schema_id = '".$schema_id."'");

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


    function readLov() {

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
                $table->setCriteria("(upper(p_notel) ".$table->likeOperator." upper('%".$searchPhrase."%')");
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


    function crud() {

        $data = array();
        $oper = getVarClean('oper', 'str', '');
        switch ($oper) {

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


    function uploadFastel() {

        $ci = & get_instance();
        $ci->load->model('schema/fastel');
        $table = $ci->fastel;

        $schema_id = getVarClean('schema_id', 'str', '');
        $p_cust_id = getVarClean('p_cust_id', 'str', '');
        $p_cust_account = getVarClean('p_cust_account', 'str', '');

        $data = array('success' => false, 'message' => '');

        try{

            $config['upload_path'] = './application/third_party/upload_fastel';
            $config['allowed_types'] = 'txt';
            $config['max_size'] = '10000000';
            $config['overwrite'] = TRUE;
            $config['file_name'] = "fastel_" . $schema_id;

            $ci->load->library('upload');
            $ci->upload->initialize($config);

            if (!$ci->upload->do_upload("file_upload_fastel")) {
                throw new Exception( $ci->upload->display_errors() );
            }else{
                $filedata = $ci->upload->data();
            }

            $datainsert = array();
            $fastelfile = fopen("./application/third_party/upload_fastel/".$filedata['file_name'], "r") or die("Unable to open file!");
            // Output one line until end-of-file
            $loop = 0;
            $batch_id = $table->getNextBatchID();

            while(!feof($fastelfile)) {

                $row = fgets($fastelfile);


                $datainsert[$loop]['p_notel'] = $row;
                $datainsert[$loop]['p_cust_id'] = $p_cust_id;
                $datainsert[$loop]['p_cust_account'] = $p_cust_account;
                $datainsert[$loop]['flag'] = null;
                $datainsert[$loop]['batch_id'] = $batch_id;
                $datainsert[$loop]['schema_id'] = $schema_id;

                $loop++;


            }

            fclose($fastelfile);

            foreach($datainsert as $rec) {
                $table->db->insert( $table->table, $rec );
            }

            $table->insertPeriodeExpense($batch_id);

            $data['message'] = 'Upload data success';
            $data['success'] = true;

        }catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        echo json_encode($data);
        exit;
    }


    function destroy() {
        $ci = & get_instance();
        $ci->load->model('schema/fastel');
        $table = $ci->fastel;

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        $items = getVarClean('items', 'str', '');

        try{
            $table->db->trans_begin(); //Begin Trans

            if (empty($items)){
                throw new Exception('Empty parameter');
            };

            $table->removeFastel($items);
            $data['rows'][] = array($table->pkey => $items);
            $data['total'] = $total = 1;

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
}

/* End of file Scema_controller.php */