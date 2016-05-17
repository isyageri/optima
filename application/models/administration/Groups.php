<?php

/**
 * Groups Model
 *
 */
class Groups extends Abstract_model {

    public $table           = "groups";
    public $pkey            = "id";
    public $alias           = "grp";

    public $fields          = array(
                                'id'             => array('pkey' => true, 'type' => 'int', 'nullable' => false, 'unique' => true, 'display' => 'ID Group'),
                                'name'           => array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Nama Group'),
                                'description'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Keterangan'),
                            );

    public $selectClause    = "grp.*";
    public $fromClause      = "groups as grp";

    public $refs            = array('users_groups' => 'group_id');

    function __construct() {
        parent::__construct();
    }

    function validate() {

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

/* End of file Groups.php */