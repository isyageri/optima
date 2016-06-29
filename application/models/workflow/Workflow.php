<?php

/**
 * Groups Model
 *
 */
class Workflow extends Abstract_model {

    public $table           = "v_workflow";
    public $pkey            = "p_workflow_id";
    public $alias           = "wrk";

    public $fields          = array(
                                'p_workflow_id'   => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Workflow'),
                                'doc_name'        => array('nullable' => true, 'type' => 'str', 'unique' => true, 'display' => 'Doc Name'),
                                'display_name'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Display Name'),
                                'p_document_type_id'    => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'ID Doc Type'),
                                'p_procedure_id_start'    => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'ID Proc Start'),
                                'is_active'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Active?'),
                                'description'    => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Description'),
                            );

    public $selectClause    = "wrk.*";
    public $fromClause      = "v_workflow wrk";

    public $refs            = array();

    function __construct() {
        parent::__construct();
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

/* End of file Groups.php */