<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class Schema_controller
* @version 07/05/2015 12:18:00
*/
class Bill_summary_controller {

    function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','account_num');
        $sord = getVarClean('sord','str','asc');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');
        $account_num = getVarClean('account_num','str','');

        try {

            $ci = & get_instance();
            $ci->load->model('schema/bill_summary');
            $table = $ci->bill_summary;

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
            $req_param['where'] = array("account_num = '".$account_num."'");

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


    function detail() {

        $ci = & get_instance();
        $ci->load->model('schema/bill_summary');
        $table = $ci->bill_summary;

        $account_num = getVarClean('account_num', 'str', '');
        $bill_seq = getVarClean('bill_seq', 'int', 0);
        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        $data['rows'] = $table->getDetails($account_num, $bill_seq);
        $data['success'] = true;
        $data['total'] = 1;
        $data['records'] = count($data['rows']);

        return $data;
    }

}

/* End of file Scema_controller.php */