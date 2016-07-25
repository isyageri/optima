<?php

/**
 * Pembuatan schema Model
 *
 */
class Search_customer extends Abstract_model {

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
        $this->db = $this->load->database('ccpbb', TRUE);

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


    function get_hierarchy($customer_ref){
      
        $sql = "
             SELECT *
           FROM (SELECT 'C_' || cust.customer_ref AS ID, 1 AS CODE,
                           'C|'
                        || cust.customer_ref
                        || '|0|0|0|'
                        || TRIM (cont.address_name)
                        || '|0|0' AS keyName,
                        '-1' AS parentNode,
                        'C_' || cust.customer_ref AS node,
                           cust.customer_ref
                        || ' '
                        || cont.address_name AS nodeLabel,
                        '' AS PAGE_FILE, '' AS XX
                   FROM customer cust, contact cont
                  WHERE cust.customer_ref = '$customer_ref'
                    AND cust.customer_ref = cont.customer_ref
                    AND cust.customer_contact_seq = cont.contact_seq
                 UNION ALL
                 SELECT 'A_' || acc.account_num AS ID, 2 AS CODE,
                           'A|'
                        || acc.customer_ref
                        || '|'
                        || acc.account_num
                        || '|0|0|'
                        || TRIM (ccust.address_name)
                        || '|'
                        || TRIM (c.address_name)
                        || '|'
                        || CASE
                              WHEN (get_accountPRD_status (acc.account_num) =
                                                                             0
                                   )
                                 THEN 'TX'
                              WHEN (get_accountPRD_status (acc.account_num) =
                                                                             1
                                   )
                                 THEN 'OK'
                              ELSE 'YES'
                           END AS keyName,
                        'C_' || acc.customer_ref AS parentNode,
                        'A_' || acc.account_num AS node,
                           acc.account_num
                        || ' - '
                        || c.address_name AS nodeLabel,
                        ' ' AS PAGE_FILE, ' ' AS XX
                   FROM ACCOUNT acc,
                        accountdetails acd,
                        contact c,
                        customer cust,
                        contact ccust
                  WHERE acc.customer_ref = '$customer_ref'
                    AND (acc.ACCOUNT_NUM LIKE '8%'
                         OR acc.ACCOUNT_NUM LIKE '9%'
                        )
                    AND acc.account_num = acd.account_num
                    AND (acd.END_DAT IS NULL OR acd.END_DAT >= SYSDATE)
                    AND acc.customer_ref = c.customer_ref
                    AND acd.BILLING_CONTACT_SEQ = c.CONTACT_SEQ
                    AND (acc.ACCOUNT_NUM LIKE '8%'
                         OR acc.ACCOUNT_NUM LIKE '9%'
                        )
                    AND acc.customer_ref = cust.CUSTOMER_REF
                    AND cust.CUSTOMER_CONTACT_SEQ = ccust.contact_seq
                    AND cust.customer_ref = ccust.customer_ref
                 UNION ALL
                 SELECT    cp.customer_ref
                        || '_'
                        || TO_CHAR (cp.product_seq) AS ID,
                        4 AS CODE,
                           DECODE (NVL (chp.parent_product_seq, 0),
                                   0, 'P|',
                                   'D|'
                                  )
                        || cp.customer_ref
                        || '|'
                        || ce.event_source
                        || '|'
                        || TO_CHAR (cp.product_seq)
                        || '|'
                        || cp.tariff_id
                        || '|'
                        || TRIM (cont.address_name)
                        || '|'
                        || TRIM (conta.address_name)
                        || '|'
                        || CASE
                              WHEN (get_product_status (cp.customer_ref,
                                                        cp.product_seq,
                                                        'TX'
                                                       ) <= SYSDATE
                                   )
                                 THEN 'TX'
                              ELSE 'OK'
                           END AS keyName,
                        NVL (TO_CHAR (chp.parent_product_seq),
                             'A_' || ce.event_source
                            ) AS parentNode,
                           cp.customer_ref
                        || '_'
                        || TO_CHAR (cp.product_seq) AS node,
                           prd.PRODUCT_NAME
                        || ' - '
                        || NVL (t.TARIFF_NAME, ' ')                --namaskema
                        || ' - '
                        || NVL (ce.EVENT_SOURCE, ' ')             --accountnum
                        || ' ( '
                        || TO_CHAR (get_product_status (cp.customer_ref,
                                                        cp.product_seq,
                                                        'OK'
                                                       ),
                                    'DD/MM/YYYY'
                                   )
                        || ' - '
                        || TO_CHAR (get_product_status (cp.customer_ref,
                                                        cp.product_seq,
                                                        'TX'
                                                       ),
                                    'DD/MM/YYYY'
                                   )
                        || ')' AS nodeLabel,
                        ' ' AS PAGE_FILE, ' ' AS XX
                   FROM  geneva_admin.custhasproduct chp,
                         geneva_admin.custproducttariffdetails cp,
                         geneva_admin.custeventsource ce,
                         geneva_admin.product prd,
                         geneva_admin.tariff t,
                        geneva_admin.cataloguechange cc,
                         geneva_admin.customer cust,
                         geneva_admin.contact cont,
                         geneva_admin.accountdetails acd,
                         geneva_admin.contact conta
                  WHERE chp.CUSTOMER_REF = cp.CUSTOMER_REF
                    AND chp.PRODUCT_SEQ = cp.PRODUCT_SEQ
                    AND cp.CUSTOMER_REF = ce.CUSTOMER_REF
                    AND cp.PRODUCT_SEQ = ce.PRODUCT_SEQ
                    AND cp.START_DAT =
                           (SELECT MAX (start_dat)
                              FROM geneva_admin.custproducttariffdetails xx
                             WHERE cp.customer_ref = xx.customer_ref
                               AND cp.product_seq = xx.product_seq)
                    AND chp.PRODUCT_ID = prd.PRODUCT_ID
                    AND cp.customer_ref = '$customer_ref'
                    AND cp.TARIFF_ID = t.TARIFF_ID
                    AND t.CATALOGUE_CHANGE_ID = cc.CATALOGUE_CHANGE_ID
                    AND cc.CATALOGUE_STATUS = 3
                    AND cp.CUSTOMER_REF = cust.customer_ref
                    AND cust.CUSTOMER_REF = cont.CUSTOMER_REF
                    AND cust.CUSTOMER_CONTACT_SEQ = cont.CONTACT_SEQ
                    AND (acd.END_DAT IS NULL OR acd.END_DAT >= SYSDATE)
                    AND (ce.EVENT_SOURCE LIKE '8%'
                         OR ce.EVENT_SOURCE LIKE '9%'
                        )
                    AND ce.EVENT_SOURCE = acd.ACCOUNT_NUM
                    AND cp.CUSTOMER_REF = conta.customer_ref
                    AND acd.BILLING_CONTACT_SEQ = conta.CONTACT_SEQ)

        ";
        $this->db = $this->load->database('tosdb', TRUE);
        $query = $this->db->query($sql);
        $result = $query->result_array();

        return $result;

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
	
	public function getAccDetail(){

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
