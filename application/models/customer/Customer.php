<?php

/**
 * Pembuatan schema Model
 *
 */
class Customer extends Abstract_model {

    public $table           = "GENEVA_ADMIN_NPOTS.customer";
    public $pkey            = "customer_ref";
    public $alias           = "cust";

    public $fields          = array(


                            );

    public $selectClause    = "cust.customer_ref,
                                    LTRIM (ct.address_name) as address_name,
                                    ct.first_name,
                                    '-' as account_num,
                                    '-' as account_name";
    public $fromClause      = "GENEVA_ADMIN_NPOTS.customer cust
                                    INNER JOIN GENEVA_ADMIN_NPOTS.contact ct ON cust.customer_ref = ct.customer_ref
                                    AND cust.customer_contact_seq = ct.contact_seq";

    public $refs            = array();

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('tosdb', TRUE);
        $this->db->_escape_char = ' ';

        $this->db_crm = $this->load->database('corecrm', TRUE);
        $this->db_crm->_escape_char = ' ';
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

    public function genCustReff(){

        $prefix = (int)$this->input->post('prefix');
        //print_r($prefix);
        //exit;
        $sql = " DECLARE " .
            "  BEGIN " .
            "  SIN_CORE.SINCUSTOMER.GENCUSTOMERREF(:params1,:cursor); END;";

        $params = array(
            array('name' => ':params1', 'value' => $prefix, 'type' => SQLT_INT, 'length' => 11),
        );

        // Bind the output parameter
        $stmt = oci_parse($this->db_crm->conn_id, $sql);
        foreach ($params as $p) {
            // Bind Input
            oci_bind_by_name($stmt, $p['name'], $p['value'], $p['length']);
        }

        $cursor = oci_new_cursor($this->db_crm->conn_id);

        oci_bind_by_name($stmt, ":cursor", $cursor, -1, OCI_B_CURSOR);

        oci_execute($stmt, OCI_DEFAULT);
        oci_execute($cursor, OCI_DEFAULT);

        oci_fetch_all($cursor, $res);
        echo json_encode($res);
    }

}

/* End of file Users.php */
