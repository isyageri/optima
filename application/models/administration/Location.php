<?php

/**
 * Groups Model
 *
 */
class Location extends Abstract_model {

    public $table           = "location";
    public $pkey            = "id";
    public $alias           = "loc";

    public $fields          = array(

                            );

    public $selectClause    = "loc.*";
    public $fromClause      = "location loc";

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