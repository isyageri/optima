<?php

/**
 * Groups Model
 *
 */
class Rejecterror extends Abstract_model {

    public $table           = "rejectevent";
    public $pkey            = "process_instance_id";
    public $alias           = "ip";

    public $fields          = array();

    public $selectClause    = "ip.*";
    public $fromClause      = "rejectevent ip";

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