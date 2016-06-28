<?php

/**
 * Pembuatan schema Model
 *
 */
class Bill_summary extends Abstract_model {

    public $table           = "billsummary";
    public $pkey            = "account_num";
    public $alias           = "bs";

    public $fields          = array(

                            );

    public $selectClause    = "rownum as id, bs.account_num, bs.bill_seq, to_char(bs.bill_dtm,'yyyy-mm-dd') as bill_dtm, bs.invoice_net_mny";
    public $fromClause      = "billsummary bs";

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


    function getDetails($account_num, $bill_seq) {

        $sql = "select rownum as id, foo.* from ( select a.account_num, b.revenue_code_desc, sum(a.revenue_mny) revenue_mny from billdetails a
                left join revenuecode b on a.revenue_code_id = b.revenue_code_id
                where account_num = '".$account_num."'
                and bill_seq = ".$bill_seq."
                group by a.account_num, b.revenue_code_desc
                order by revenue_code_desc asc)  foo";

        $query = $this->db->query($sql);
        $result = $query->result_array();

        return $result;
    }

}

/* End of file Users.php */
