<?php

/**
 * Pembuatan schema Model
 *
 */
class Display_invoice extends Abstract_model {

    public $table           = "billsummary";
    public $pkey            = "";
    public $alias           = "b";

    public $fields          = array();

    public $selectClause    = "b.account_num, a.account_name, b.invoice_net_mny/100 tagihan, b.invoice_tax_mny/100 ppn, (b.invoice_net_mny/100) + (b.invoice_tax_mny/100) total, to_char(bill_dtm,'YYYYMM') period ";
    public $fromClause      = "billsummary b join account a on a.account_num = b.account_num ";

    public $refs            = array();

    function __construct() {
        
        parent::__construct();
        $this->db = $this->load->database('tosdb', TRUE);
        $this->db->_escape_char = ' ';
    }

    function validate() {

        if($this->actionType == 'CREATE') {
            //do something
            // example :
            //$this->record['created_date'] = date('Y-m-d');
            //$this->record['updated_date'] = date('Y-m-d');
            //$this->record[$this->pkey] = $this->generate_id($this->table);
        }else {
            //do something
            //example:
            //$this->record['updated_date'] = date('Y-m-d');
            //if false please throw new Exception
        }
        return true;
    }


}

/* End of file Users.php */
