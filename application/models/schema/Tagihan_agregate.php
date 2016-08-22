<?php

/**
 * Pembuatan schema Model
 *
 */
class Tagihan_agregate extends Abstract_model {

    //public $table           = "tagihan_agregat_m4l_batch";
    public $table           = "V_TAGIHAN_AGREGAT_M4L";
    public $pkey            = "";
    public $alias           = "a";

    public $fields          = array(

                            );

    // public $selectClause    = "rownum as id, a.*,  b.LELTFACT";
    public $selectClause    = "rownum as id, a.* ";
    //public $fromClause      = "tagihan_agregat_m4l_batch a left join p_neltfact b on a.neltfact = b.neltfact";
    public $fromClause      = "V_TAGIHAN_AGREGAT_M4L a";

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

}

/* End of file Users.php */
