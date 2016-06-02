<?php

/**
 * Pembuatan schema Model
 *
 */
class Customer extends Abstract_model {

    public $table           = "customer";
    public $pkey            = "customer_ref";
    public $alias           = "cust";

    public $fields          = array(


                            );

    public $selectClause    = "cust.customer_ref,
                                    LTRIM (ct.address_name) as address_name,
                                    ct.first_name,
                                    '-' as account_num,
                                    '-' as account_name";
    public $fromClause      = "customer cust
                                    INNER JOIN contact ct ON cust.customer_ref = ct.customer_ref
                                    AND cust.customer_contact_seq = ct.contact_seq";

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
