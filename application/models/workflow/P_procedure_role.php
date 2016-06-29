<?php

/**
 * Pembuatan schema Model
 *
 */
class p_procedure_role extends Abstract_model {

    public $table           = "p_procedure_role";
    public $pkey            = "p_procedure_role_id";
    public $alias           = "pr";

    public $fields          = array(
                                'p_procedure_role_id'   => array('pkey' => true, 'type' => 'str', 'nullable' => true, 'unique' => true, 'display' => 'ID Procedure'),
                                'p_procedure_id'        => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'ID Procedure'),
                                'p_app_role_id'         => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'ID Role'),
                                'f_role'                => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Diupdate Oleh'),
                                'valid_from'            => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Tgl Update'),
                                'valid_to'              => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Tgl Update'),

                                'updated_date'          => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Tgl Update'),
                                'updated_by'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Diupdate Oleh'),
                                'created_by'            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Dibuat Oleh'),
                                'creation_date'         => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Tgl Pembuatan'),
                            );

    public $selectClause    = "pr.p_procedure_role_id, pr.p_procedure_id, pr.p_app_role_id, groups.name as role_name, pr.f_role,
                                    pr.valid_from, pr.valid_to, pr.updated_date, pr.updated_by, pr.created_by, pr.creation_date";
    public $fromClause      = "p_procedure_role pr
                                    left join groups on pr.p_app_role_id = groups.id";

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

            if(empty($this->record['valid_to'])) {
                $this->db->set('valid_to', NULL);
            }else {
                $this->db->set('valid_to',"to_date('".$this->record['valid_to']."','yyyy-mm-dd')",false);
            }

            $this->db->set('valid_from',"to_date('".$this->record['valid_from']."','yyyy-mm-dd')",false);

            unset($this->record['valid_to']);
            unset($this->record['valid_from']);

        }else {
            //do something
            //example:
            //$this->record['updated_date'] = date('Y-m-d');
            //if false please throw new Exception
            $this->db->set('updated_date',"to_date('".date('Y-m-d')."','yyyy-mm-dd')",false);
            $this->record['updated_by'] = $userinfo->username;

            if(empty($this->record['valid_to'])) {
                $this->db->set('valid_to', NULL);
            }else {
                $this->db->set('valid_to',"to_date('".$this->record['valid_to']."','yyyy-mm-dd')",false);
            }

            $this->db->set('valid_from',"to_date('".$this->record['valid_from']."','yyyy-mm-dd')",false);

            unset($this->record['valid_to']);
            unset($this->record['valid_from']);
        }
        return true;
    }

}

/* End of file Users.php */
