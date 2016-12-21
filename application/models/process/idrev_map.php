<?php

/**
 * Idrev_map Model
 *
 */
class Idrev_map extends Abstract_model {

   public $table           = "custom.bd29_idrev_map";
    public $pkey            = "idrev";
    public $alias           = "a";
	
	// d_c        varchar2 (1) 
	// idcat      varchar2 (3) 
	// idrev      number (12) 
	// kol_index  number
	// kol_name   varchar2 (50) 
	// trans_name varchar2 (255) 


    public $fields          = array(
								'idrev' => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'Id Rev'),
								'kol_name'       => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Kol Name'),
                                'd_c'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'D_C'),
                                'kol_index'      => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'Kol Index'),
                                'trans_name'     => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Trans Name')
                            );

    public $selectClause    = "a.*";
    public $fromClause      = "custom.bd29_idrev_map a";

  
    function __construct() {
        parent::__construct();
		$this->db = $this->load->database('tosdb_prod', TRUE);
        $this->db->_escape_char = ' ';
    }

    function validate() {
        $ci =& get_instance();
        return true;
    }

}

/* End of file Users.php */