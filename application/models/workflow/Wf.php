<?php

/**
 * Groups Model
 *
 */
class Wf extends Abstract_model {

    public $table           = "";
    public $pkey            = "";
    public $alias           = "";

    public $fields          = array(
                            );

    public $selectClause    = "";
    public $fromClause      = "";

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

    public function getListInbox($user_name) {
        $sql = "select * from table(pack_task_profile.workflow_name('".$user_name."'))";
        $query = $this->db->query($sql);
        $rows = $query->result_array();

        return $rows;
    }

}

/* End of file Groups.php */