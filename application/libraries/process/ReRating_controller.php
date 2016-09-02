<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class ReRating_controller
* @version 07/05/2015 12:18:00
*/
class ReRating_controller {

    function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','input_data_control_id');
        $sord = getVarClean('sord','str','desc');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        try {

            $ci = & get_instance();
            $ci->load->model('process/rerating');
            $table = $ci->rerating;

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
                
            break;

            case 'edit' :
                
            break;

            case 'del' :
               
            break;

            default :
               // permission_check('view-re-rating');
                $data = $this->read();
            break;
        }

        return $data;
    }

    function create() {

        $ci = & get_instance();
        $ci->load->model('process/rerating');
        $table = $ci->rerating;

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        if(getVarClean('p_finance_period_id', 'int', 0) == 0){
            $items[0]['p_finance_period_id'] = $this->getFinancePeriod();
            $items[0]['input_file_name'] = 'ALL_ACCOUNT_'.$this->getFinancePeriod();
        }else{
            $items[0]['p_finance_period_id'] = getVarClean('p_finance_period_id', 'int', 0);    
            $items[0]['input_file_name'] = getVarClean('input_file_name', 'str', '');
        }
        
        $items[0]['input_data_class_id'] = getVarClean('input_data_class_id', 'int', 0);
        $items[0]['account_name'] = getVarClean('account_name', 'str', '');
        // $items = jsonDecode($jsonItems);

        

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

    function destroy() {
        $ci = & get_instance();
        $ci->load->model('process/rerating');
        $table = $ci->rerating;

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        // $jsonItems = getVarClean('items', 'str', '');
        // $items = jsonDecode($jsonItems);
        $items = getVarClean('input_data_control_id', 'int', 0);

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
                $items = (int) $items;
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

    function getFinancePeriod(){
        $ci = & get_instance();
        $ci->load->model('process/rerating');
        $fp = $ci->rerating->getPeriod();

        return $fp;
    }

    function readBillLov(){
        $start = getVarClean('current', 'int', 0);
        $limit = getVarClean('rowCount', 'int', 5);

        $sort = getVarClean('sort', 'str', 'process_instance_id');
        $dir = getVarClean('dir', 'str', 'asc');

        $searchPhrase = getVarClean('searchPhrase', 'str', '');
        $customer_ref = getVarClean('customer_ref', 'str', '');

        $data = array('rows' => array(), 'success' => false, 'message' => '', 'current' => $start, 'rowCount' => $limit, 'total' => 0);

        try {

            $ci = &get_instance();
            $ci->load->model('process/billerror');
            $table = $ci->billerror;

            if (!empty($searchPhrase)) {
                $table->setCriteria("(upper(account_num) " . $table->likeOperator . " upper('%" . $searchPhrase . "%') OR upper(customer_ref) " . $table->likeOperator . " upper('%" . $searchPhrase . "%') ");
            }

            $start = ($start - 1) * $limit;
            $items = $table->getAll($start, $limit, $sort, $dir);
            $totalcount = $table->countAll();

            $data['rows'] = $items;
            $data['success'] = true;
            $data['total'] = $totalcount;

        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }

    function readRejectLov(){
        $start = getVarClean('current', 'int', 0);
        $limit = getVarClean('rowCount', 'int', 5);

        $sort = getVarClean('sort', 'str', 'process_instance_id');
        $dir = getVarClean('dir', 'str', 'asc');

        $searchPhrase = getVarClean('searchPhrase', 'str', '');
        $customer_ref = getVarClean('customer_ref', 'str', '');

        $data = array('rows' => array(), 'success' => false, 'message' => '', 'current' => $start, 'rowCount' => $limit, 'total' => 0);

        try {

            $ci = &get_instance();
            $ci->load->model('process/rejecterror');
            $table = $ci->rejecterror;

            $table->setCriteria("to_char(REJECT_DTM,'YYYYMM') = '".$this->getFinancePeriod()."'");

            if (!empty($searchPhrase)) {
                $table->setCriteria("(upper(event_source) " . $table->likeOperator . " upper('%" . $searchPhrase . "%') ");
            }

            $start = ($start - 1) * $limit;
            $items = $table->getAll($start, $limit, $sort, $dir);
            $totalcount = $table->countAll();

            $data['rows'] = $items;
            $data['success'] = true;
            $data['total'] = $totalcount;

        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
        }

        return $data;
    }

}

/* End of file ReRating_controller.php */