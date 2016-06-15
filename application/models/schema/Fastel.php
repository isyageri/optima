<?php

/**
 * Pembuatan schema Model
 *
 */
class Fastel extends Abstract_model {

    public $table           = "cc_dataref_batch";
    public $pkey            = "";
    public $alias           = "fastel";

    public $fields          = array(

                            );

    public $selectClause    = "fastel.*, (p_notel || '-' || schema_id) as fastel_id";
    public $fromClause      = "cc_dataref_batch fastel";

    public $refs            = array();

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('geneva', TRUE);
        $this->db->_escape_char = ' ';
    }

    function validate() {
        $ci =& get_instance();

        if($this->actionType == 'CREATE') {
            //do something
            // example :
            //$this->record['created_date'] = date('Y-m-d');
            //$this->record['updated_date'] = date('Y-m-d');

        }else {
            //do something
            //example:
            //$this->record['updated_date'] = date('Y-m-d');
            //if false please throw new Exception
        }
        return true;
    }

    function removeFastel($items) {
        $code = explode('-', $items);

        $sql = "DELETE FROM ".$this->table." WHERE p_notel = '".$code[0]."' AND schema_id = ".$code[1];
        $this->db->query($sql);

        return true;
    }

}

/* End of file Users.php */
