<?php

/**
 * Pembuatan schema Model
 *
 */
class Account_attr extends Abstract_model {

    public $table           = "paramdefinitiondetail";
    public $pkey            = "";
    public $alias           = "a";

    public $fields          = array(


                            );

    public $selectClause    = 	"a.attr_id, a.attr_name, b.XS2
                                ";
    public $fromClause      = "paramdefinitiondetail a, gparams b";

    public $refs            = array();

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('corecrm', TRUE);
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

}

/* End of file Users.php */
