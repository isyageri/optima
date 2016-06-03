<?php

/**
 * Pembuatan schema Model
 *
 */
class Invoice extends Abstract_model {

    public $table           = "v_list_reportinvoice";
    public $pkey            = "";
    public $alias           = "list";

    public $fields          = array();

    public $selectClause    = "list.*";
    public $fromClause      = "v_list_reportinvoice list";

    public $refs            = array();

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('corecrm', TRUE);
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

/* End of file Users.php */
