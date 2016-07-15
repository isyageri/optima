<?php

/**
 * Groups Model
 *
 */
class Process_billing extends Abstract_model {

    public $table           = "job_control";
    public $pkey            = "job_control_id";
    public $alias           = "jb";

    public $fields          = array();

    public $selectClause    = "jb.*";
    public $fromClause      = "v_job_control jb";

    public $refs            = array();

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('tosdb', TRUE);
        $this->db->_escape_char = ' ';
    }

    function validate() {
        $ci =& get_instance();

        if($this->actionType == 'CREATE') {
            //do something
            // example :
            //$this->record['created_date'] = date('Y-m-d');
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

}

/* End of file Groups.php */