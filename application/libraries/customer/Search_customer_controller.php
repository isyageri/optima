<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_customer_controller {

    function read() {

        $page = getVarClean('page','int',1);
        $limit = getVarClean('rows','int',5);
        $sidx = getVarClean('sidx','str','ug.id');
        $sord = getVarClean('sord','str','desc');

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        $user_id = getVarClean('user_id','int',0);
        try {

            $ci = & get_instance();
            $ci->load->model('customer/search_customer');
            $table = $ci->users_groups;

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
            $req_param['where'] = array("ug.user_id = ".$user_id);

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

        $sort = getVarClean('sort','str','permission_id');
        $dir  = getVarClean('dir','str','desc');

        $searchPhrase = getVarClean('searchPhrase', 'str', '');

        $data = array('rows' => array(), 'success' => false, 'message' => '', 'current' => $start, 'rowCount' => $limit, 'total' => 0);

        try {

            $ci = & get_instance();
            $ci->load->model('administration/permissions');
            $table = $ci->permissions;

            //Set default criteria. You can override this if you want
            foreach ($table->fields as $key => $field){
                if (!empty($$key)){ // <-- Perhatikan simbol $$
                    if ($field['type'] == 'str'){
                        $table->setCriteria($table->getAlias().$key.$table->likeOperator." '".$$key."' ");
                    }else{
                        $table->setCriteria($table->getAlias().$key." = ".$$key);
                    }
                }
            }

            if(!empty($searchPhrase)) {
                $table->setCriteria("(prms.permission_name ".$table->likeOperator." '%".$searchPhrase."%')");
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
            case 'add' :
                permission_check('add-role');
                $data = $this->create();
            break;

            case 'edit' :
                permission_check('edit-role');
                $data = $this->update();
            break;

            case 'del' :
                permission_check('delete-role');
                $data = $this->destroy();
            break;

            default :
                permission_check('view-role');
                $data = $this->read();
            break;
        }

        return $data;
    }


    function create() {

        $ci = & get_instance();
        $ci->load->model('customer/search_customer');
        $table = $ci->users_groups;

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

    function update() {

        $ci = & get_instance();
        $ci->load->model('customer/search_customer');
        $table = $ci->users_groups;

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
        $ci->load->model('customer/search_customer');
        $table = $ci->users_groups;

        $data = array('rows' => array(), 'page' => 1, 'records' => 0, 'total' => 1, 'success' => false, 'message' => '');

        $jsonItems = getVarClean('items', 'str', '');
        $items = jsonDecode($jsonItems);

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
                }

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


    function html_select_options_group() {
        try {
            $ci = & get_instance();
            $ci->load->model('administration/groups');
            $table = $ci->groups;

            $user_id = getVarClean('user_id','int',0);
            $group_id = getVarClean('group_id','int',0);

            if(empty($group_id))
                $table->setCriteria('grp.id NOT IN (SELECT group_id FROM users_groups WHERE user_id = '.$user_id.')');
            else
                $table->setCriteria('grp.id NOT IN (SELECT group_id FROM users_groups WHERE user_id = '.$user_id.' AND group_id != '.$group_id.')');

            $items = $table->getAll(0,-1);
            echo '<select>';
            foreach($items  as $item ){
                echo '<option value="'.$item['id'].'">'.$item['name'].'</option>';
            }
            echo '</select>';
            exit;
        }catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
	
	public function tableSearchResult(){
		$ci = & get_instance();
		$ci->load->model('customer/search_customer');
		$table = $ci->search_customer;

		$reftype = getVarClean('typeRef','int',0);	
		$refvalue = getVarClean('valueRef','str','');	
		
		$PIN_REFTYPE = $reftype;
		$PIN_REFVALUE = $refvalue;
		
		$curs = oci_new_cursor($table->db->conn_id);
		$sql = 	"BEGIN SINIRBQUERY.GETSEARCHRESULT ( :PIN_REFTYPE, :PIN_REFVALUE, :O_CURSOR ); END;";	
		$stid = oci_parse($table->db->conn_id, $sql);
		oci_bind_by_name($stid, ':PIN_REFTYPE', $PIN_REFTYPE, 32);
		oci_bind_by_name($stid, ':PIN_REFVALUE', $PIN_REFVALUE, 255);
		
		oci_bind_by_name($stid, ":O_CURSOR", $curs, -1, OCI_B_CURSOR);
		
		oci_execute($stid);
		oci_execute($curs, OCI_DEFAULT);		
		oci_fetch_all($curs, $data, null, null, OCI_FETCHSTATEMENT_BY_ROW);
		
		
		echo json_encode($data);
        exit;
	}
	
	public function createNodeTree(){		
		$ci = & get_instance();
		$ci->load->model('customer/search_customer');
		$table = $ci->search_customer;

		$cust_ref = getVarClean('celval','int',0);		
		$CUSTOMER_REF = $cust_ref;

		$curs = oci_new_cursor($table->db->conn_id);
		$sql = 	"BEGIN SINIRBQUERY.QUERYCUSTHIRARCHY ( :P_CUSTOMERREF, :P_CUSTSTRUCTURE); END;";	
		$stid = oci_parse($table->db->conn_id, $sql);
		oci_bind_by_name($stid, ':P_CUSTOMERREF', $CUSTOMER_REF, 255);				
		oci_bind_by_name($stid, ":P_CUSTSTRUCTURE", $curs, -1, OCI_B_CURSOR);
		
		oci_execute($stid);
		oci_execute($curs, OCI_DEFAULT);		
		oci_fetch_all($curs, $data, null, null, OCI_FETCHSTATEMENT_BY_ROW);		
		echo json_encode($data);
        exit;
	}
}

/* End of file Users_groups_controller.php */
