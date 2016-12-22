<?php

/**
 * p_cc_dataref Model
 *
 */
class p_cc_dataref extends Abstract_model {

    public $table           = "operasi.cc_dataref";
    public $pkey            = "p_notel";
    public $alias           = "a";
	
	// p_kode_divre   varchar2 (2) 
	// p_bisnis_area  varchar2 (6) 
	// p_notel        varchar2 (15) 
	// p_kode_produk  number (6) 
	// p_cust_id      varchar2 (16) 
	// p_cust_account varchar2 (10) 
	// flag           varchar2 (1) 



    public $fields          = array(
								'p_notel' => array('pkey' => true, 'type' => 'str', 'nullable' => true, 'unique' => true, 'display' => 'Notel'),
								'p_kode_divre'       => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Kode Divre'),
                                'p_bisnis_area'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Bisnis Area'),
                                'p_kode_produk'      => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'Kode Product'),
                                'p_cust_id'     => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Cust ID'),
                                'p_cust_account'     => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Cust Account'),
                                'flag'     => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Flag')
                            );

    public $selectClause    = "a.*";
    public $fromClause      = "operasi.cc_dataref a";

  
    function __construct() {
        parent::__construct();
		$this->db = $this->load->database('operasi', TRUE);
        $this->db->_escape_char = ' ';
    }

    function validate() {
        $ci =& get_instance();
        return true;
    }

}

/* End of file Users.php */