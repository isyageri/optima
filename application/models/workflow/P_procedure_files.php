<?php

/**
 * Pembuatan schema Model
 *
 */
class P_procedure_files extends Abstract_model {

    public $table           = "p_procedure_files";
    public $pkey            = "p_procedure_files_id";
    public $alias           = "pf";

    public $fields          = array(
                                'p_procedure_files_id'  => array('pkey' => true, 'type' => 'str', 'nullable' => true, 'unique' => true, 'display' => 'ID Procedure'),
                                'p_procedure_id'        => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'ID Procedure'),
                                'filename'              => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Nama File'),
                                'sequence_no'           => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'No Urut'),
                                'updated_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Tgl Update'),
                                'updated_by'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Diupdate Oleh'),
                                'created_by'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Dibuat Oleh'),
                                'creation_date'         => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Tgl Pembuatan'),
                            );

    public $selectClause    = "pf.p_procedure_files_id, pf.p_procedure_id, pf.filename, pf.sequence_no,
                                to_char(pf.updated_date,'yyyy-mm-dd') as updated_date, pf.updated_by, pf.created_by,
                                to_char(pf.creation_date,'yyyy-mm-dd') as creation_date";
    public $fromClause      = "p_procedure_files pf";

    public $refs            = array();

    function __construct() {
        parent::__construct();
    }

    function validate() {
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();

        if($this->actionType == 'CREATE') {
            //do something
            // example :
            //$this->record['created_date'] = date('Y-m-d');
            //$this->record['updated_date'] = date('Y-m-d');
            $this->record[$this->pkey] = $this->generate_id($this->table);
            $this->db->set('updated_date',"to_date('".date('Y-m-d')."','yyyy-mm-dd')",false);
            $this->db->set('creation_date',"to_date('".date('Y-m-d')."','yyyy-mm-dd')",false);
            $this->record['updated_by'] = $userinfo->username;
            $this->record['created_by'] = $userinfo->username;

        }else {
            //do something
            //example:
            //$this->record['updated_date'] = date('Y-m-d');
            //if false please throw new Exception
            $this->db->set('updated_date',"to_date('".date('Y-m-d')."','yyyy-mm-dd')",false);
            $this->record['updated_by'] = $userinfo->username;
        }
        return true;
    }

}

/* End of file Users.php */
