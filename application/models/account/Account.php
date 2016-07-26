<?php

/**
 * Pembuatan schema Model
 *
 */
class Account extends Abstract_model {

    public $table           = "account";
    public $pkey            = "account_num";
    public $alias           = "a";

    public $fields          = array(


                            );

    public $selectClause    = 	"a.account_num, null as action, a.account_name, 'OK' as account_status, a.currency_code,
								a.deposit_mny, c.end_dat, null as golivedtm, e.email_address as email, d.npwp as npwp,
								RTRIM(f.address_1) || ' ' || RTRIM(f.address_2) || ' ' || RTRIM(f.address_3) || ' ' || RTRIM(f.address_4) || ' ' || RTRIM(f.address_5) as address
                                ";
    public $fromClause      = "account a
                                    INNER JOIN accountdetails c ON a.ACCOUNT_NUM = c.ACCOUNT_NUM
                                    INNER JOIN accountattributes d ON a.ACCOUNT_NUM = d.ACCOUNT_NUM
                                    INNER JOIN contactdetails e ON a.CUSTOMER_REF = e.CUSTOMER_REF
                                    INNER JOIN address f ON a.CUSTOMER_REF = f.CUSTOMER_REF";

    public $refs            = array();

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('tosdb', TRUE);
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
