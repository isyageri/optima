<?php

/**
 * Pembuatan schema Model
 *
 */
class Invoice extends Abstract_model {

    // public $table           = "customer";
    // public $pkey            = "customer_ref";
    // public $alias           = "cust";

    // public $fields          = array(


    //                         );

    // public $selectClause    = "cust.customer_ref,
    //                                 LTRIM (ct.address_name) as address_name,
    //                                 ct.first_name,
    //                                 '-' as account_num,
    //                                 '-' as account_name";
    // public $fromClause      = "customer cust
    //                                 INNER JOIN contact ct ON cust.customer_ref = ct.customer_ref
    //                                 AND cust.customer_contact_seq = ct.contact_seq";

    // public $refs            = array();

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('corecrm', TRUE);
        $this->db->_escape_char = ' ';
    }

    function getReportInvoice() {
        
        $period = '201604';
        $curs = oci_new_cursor($this->db->conn_id);
        $sql = "begin sinuareport.getlistreportinvoice( :pin_billperiode, :pout_result ); end;";
        $stid = oci_parse($this->db->conn_id, $sql);

        oci_bind_by_name($stid, ':pin_billperiode', $period, 32);
        oci_bind_by_name($stid, ":pout_result", $curs, -1, OCI_B_CURSOR);

        oci_execute($stid);
        oci_execute($curs, OCI_DEFAULT);
        oci_fetch_all($curs, $data, null, null, OCI_FETCHSTATEMENT_BY_ROW);

        print_r($data);
        die();
        // oci_free_statement($stid);
        // oci_free_statement($curs);
        // oci_close($this->db);

    }

}

/* End of file Users.php */
