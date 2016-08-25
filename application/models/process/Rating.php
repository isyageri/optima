<?php

/**
 * Groups Model
 *
 */
class Rating extends Abstract_model {

    public $table           = "v_control_process_rating_rmd";
    public $pkey            = "task_request_id";
    public $alias           = "per";

    public $fields          = array();

    public $selectClause    = "per.*";
    public $fromClause      = "v_control_process_rating_rmd per";

    public $refs            = array();

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('operasi', TRUE);
        $this->db->_escape_char = ' ';
    }

    function validate() {

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