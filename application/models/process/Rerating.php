<?php

/**
 * Groups Model
 *
 */
class Rerating extends Abstract_model {

    public $table           = "input_data_control";
    public $pkey            = "input_data_control_id";
    public $alias           = "ip";

    public $fields          = array(
                                  'input_data_control_id'   => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'input_data_control_id'),  
                                  'input_file_name'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'input_file_name'),
                                  'account_name'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'account_name'),
                                  'p_finance_period_id'    => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'p_finance_period_id'),
                                  'input_data_class_id'    => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'input_data_class_id'),
                                  'p_input_file_desc_id'    => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'p_input_file_desc_id'),
                              );

    public $selectClause    = "ip.*";
    public $fromClause      = "v_input_data_control_re ip";

    public $refs            = array();

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('tosdb_prod', TRUE);
        $this->db->_escape_char = ' ';
    }

    function validate() {
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();

        if($this->actionType == 'CREATE') {
            //do something
            // example :

            $this->db->set('creation_date',"to_date('".date('Y-m-d')."','yyyy-mm-dd')",false);
            $this->record['operator_id'] = $userinfo->username;

            if ( $this->record['input_file_name'] == 'ALL_ACCOUNT'){
                $this->record['input_file_name'] = 'ALL_ACCOUNT_'.date('YmdHis');
            }else{
                $this->record['input_file_name'] = $this->record['account_name'].'_'.date('YmdHis');
            }
            //$this->record['updated_date'] = date('Y-m-d');
            $this->record[$this->pkey] = $this->generate_id($this->table);
    
        }else {
            //do something
            //example:
            //$this->record['updated_date'] = date('Y-m-d');
            //if false please throw new Exception
        }
        return true;
    }

    function getPeriod(){
        try {

            $sql = "select p_finance_period_id from p_finance_period where period_status_id = 3";
            $query = $this->db->query($sql);

            $items = 0;
            if($query->num_rows() > 0){
                $result = $query->row_array();
                $items = $result['p_finance_period_id'];   
            }

            return $items;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}

/* End of file Groups.php */