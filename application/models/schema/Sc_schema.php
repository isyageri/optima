<?php

/**
 * Pembuatan schema Model
 *
 */
class Sc_schema extends Abstract_model {

    public $table           = "sc_schema";
    public $pkey            = "schema_id";
    public $alias           = "sc";

    public $fields          = array(
                                'schema_id'      => array('pkey' => true, 'type' => 'int', 'nullable' => true, 'unique' => true, 'display' => 'ID Schema'),
                                'schema_name'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Schema Name'),
                                'customer_ref'   => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Customer Ref'),
                                'account_num'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Account Num'),
                                'discount_id'    => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'Discount ID'),
                                'start_dat'      => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Start Date'),
                                'end_dat'        => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'End Date'),
                            );

    public $selectClause    = "sc.*";
    public $fromClause      = "sc_schema sc";

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
            $this->record[$this->pkey] = $this->generate_id($this->table);
            if(empty($this->record['end_dat'])) {
                $this->db->set('end_dat', NULL);
            }else {
                $this->db->set('end_dat',"to_date('".$this->record['end_dat']."','yyyy-mm-dd')",false);
            }

            $this->db->set('start_dat',"to_date('".$this->record['start_dat']."','yyyy-mm-dd')",false);

            unset($this->record['start_dat']);
            unset($this->record['end_dat']);

        }else {
            //do something
            //example:
            //$this->record['updated_date'] = date('Y-m-d');
            //if false please throw new Exception
        }
        return true;
    }

    function getTrendInfo() {

        $sql = "select max(P_CUST_ID) p_cust_id,
                    b.PERIODE,
                    sum(b.TELKOM_JJ) TELKOM_JJ,
                    sum(b.TELKOM_LK) TELKOM_LK,
                    sum(b.TELKOMSEL) TELKOMSEL,
                    sum(b.LAINNYA) LAINNYA,
                    sum(b.ON_NET) TAGIHAN_ON_NET ,
                    sum(b.NON_ON_NET) TAGIHAN_NON_ON_NET
                    from CC_DATAREF_02_NETEZA a,
                    V_TAGIHAN_AGREGAT_M4L b
                    where A.P_NOTEL = B.ND
                    and a.P_CUST_ACCOUNT = '8000001428'
                    and to_number(b.PERIODE) between 201512 and 201603
                    group by b.PERIODE
                    order by b.PERIODE";

        $query = $this->db->query($sql);
        $row = $query->result_array();
        return $row;
    }

}

/* End of file Users.php */
