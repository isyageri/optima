<?php

/**
 * Pembuatan schema Model
 *
 */
class Schema extends Abstract_model {

    public $table           = "";
    public $pkey            = "";
    public $alias           = "";

    public $fields          = array(


                            );

    public $selectClause    = "e.tariff_id, e.tariff_name, b.customer_ref, ltrim (h.address_name) as address_name, b.event_source,
                                e.sales_start_dat, e.sales_end_dat";
    public $fromClause      = "tariff e
                                inner join custproducttariffdetails d on  e.tariff_id = d.tariff_id
                                inner join custeventsource b on b.customer_ref = d.customer_ref and b.product_seq = d.product_seq
                                inner join custhasproduct f on b.customer_ref = f.customer_ref and b.product_seq = f.product_seq
                                inner join customer c on d.customer_ref = c.customer_ref
                                inner join contact h on c.customer_ref = h.customer_ref and c.customer_contact_seq = h.contact_seq
                                inner join account a on b.event_source = a.account_num and b.customer_ref = a.customer_ref
                                inner join accountstatus g on b.event_source = g.account_num";

    public $refs            = array();

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('ccpbb', TRUE);
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

}

/* End of file Users.php */
