<?php

/**
 * Pembuatan schema Model
 *
 */
class Terminasi_schema extends Abstract_model {

    public $table           = "sc_schema";
    public $pkey            = "schema_id";
    public $alias           = "a";

    public $fields          = array(
                              
							  );

    public $selectClause    = 	"schema_id, a.customer_ref, a.account_num, 
								b.account_name, start_dat, end_dat, 
								c.disc_description , 'detail | terminate' as dt";
    public $fromClause      = "sc_schema a 
								inner join geneva_admin_npots.account b 
									ON a.customer_ref = b.customer_ref AND a.account_num = b.account_num
								inner join V_BUSINESS_SCHEM_LIST c 
									ON a.discount_id = c.discount_code ";

    public $refs            = array();

    function __construct() {
        parent::__construct();
		$this->db = $this->load->database('geneva', TRUE);
        $this->db->_escape_char = ' ';
    }

    function validate() {
        $ci =& get_instance();

        if($this->actionType == 'CREATE') {            
		
		}else {                        
        
		}
        return true;
    }

}

/* End of file Users.php */
