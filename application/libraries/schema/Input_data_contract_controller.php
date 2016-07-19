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