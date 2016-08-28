<?php

/**
 * Pembuatan schema Model
 *
 */
class Mapping_account_am extends Abstract_model {

  
    public $table           = "M4L_MAPPING_ACCOUNT_AM";
    public $pkey            = "";
    public $alias           = "a";

    public $fields          = array();

    public $selectClause    = "a.*, b.account_name ";
    public $fromClause      = "M4L_MAPPING_ACCOUNT_AM a join account b on a.account_num = b.account_num ";

    public $refs            = array();

    function __construct() {
        
        parent::__construct();
        $this->db = $this->load->database('geneva', TRUE);
        $this->db->_escape_char = ' ';
    }

    function validate() {

        if($this->actionType == 'CREATE') {
            //do something
            // example :
            //$this->record['created_date'] = date('Y-m-d');
            //$this->record['updated_date'] = date('Y-m-d');
            //$this->record[$this->pkey] = $this->generate_id($this->table);
        }else {
            //do something
            //example:
            //$this->record['updated_date'] = date('Y-m-d');
            //if false please throw new Exception
        }
        return true;
    }


}

/* End of file Users.php */
