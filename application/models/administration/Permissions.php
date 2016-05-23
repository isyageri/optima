<?php

/**
 * Groups Model
 *
 */
class Permissions extends Abstract_model {

    public $table           = "permissions";
    public $pkey            = "permission_id";
    public $alias           = "prms";

    public $fields          = array(
                                'permission_id'             => array('pkey' => true, 'type' => 'int', 'nullable' => false, 'unique' => true, 'display' => 'ID Permissions'),
                                'permission_name'           => array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Permission Name'),
                                'permission_description'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Description'),
                            );

    public $selectClause    = "prms.*";
    public $fromClause      = "permissions as prms";

    // public $refs            = array('users_groups' => 'permissions_id');

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