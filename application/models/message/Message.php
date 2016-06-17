<?php

/**
 * Pembuatan schema Model
 *
 */
class Message extends Abstract_model {

    public $table           = "cn_transaction";
    public $pkey            = "trx_id";
    public $alias           = "cn_trans";

    public $fields          = array(


                            );

    public $selectClause    = "cn_trans.trx_id, cn_trans.code, cn_trans.status as status_name, cn_trans.created_by, cn_trans.created_date, cn_trans.update_by, cn_trans.updated_date, cn_trans.approve_by, cn_trans.approve_date, cn_trans.review_by, cn_trans.review_date, cn_trans.trx_name, cn_trans.flag";
    public $fromClause      = "cn_transaction cn_trans";

    public $refs            = array();

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('geneva', TRUE);
        $this->db->_escape_char = ' ';
    }

    function validate() {
        $ci =& get_instance();

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

    function countNewMsg(){
        $result = array();
        $sql = "SELECT *
                FROM cn_transaction WHERE flag = 0";

        $q = $this->db->query($sql);
        if($q->num_rows() > 0) $result = $q->result();

        return $result;
    }

    function update_flag($trx_id){
        $upd = $this->db->set('flag', 1)
                        ->where('trx_id',$trx_id)
                        ->update('cn_transaction');

        return $upd;
    }

}

/* End of file Users.php */
