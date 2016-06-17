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
                                'schema_id'      => array('pkey' => true, 'type' => 'str', 'nullable' => true, 'unique' => true, 'display' => 'ID Schema'),
                                'schema_name'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Schema Name'),
                                'customer_ref'   => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Customer Ref'),
                                'account_num'    => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Account Num'),
                                'discount_id'    => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'Discount ID'),
                                'start_dat'      => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Start Date'),
                                'end_dat'        => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'End Date'),
                            );

    public $selectClause    = "sc.schema_id, sc.schema_name, sc.customer_ref,
                                sc.account_num, sc.discount_id, to_char(sc.start_dat,'yyyy-mm-dd') as start_dat, to_char(sc.end_dat,'yyyy-mm-dd') as end_dat,
                                to_char(sc.start_dat,'yyyymm') as start_periode,";
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
            $this->record[$this->pkey] = $this->getSchemaID();
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

    function getTrendInfo($schema_id) {

        $item = $this->get($schema_id);

        $sql = "select max(P_CUST_ID) p_cust_id,
                    b.PERIODE,
                    sum(b.TELKOM_JJ) TELKOM_JJ,
                    sum(b.TELKOM_LK) TELKOM_LK,
                    sum(b.TELKOMSEL) TELKOMSEL,
                    sum(b.LAINNYA) LAINNYA,
                    sum(b.ON_NET) TAGIHAN_ON_NET ,
                    sum(b.NON_ON_NET) TAGIHAN_NON_ON_NET
                    from CC_DATAREF_BATCH a,
                    V_TAGIHAN_AGREGAT_M4L b
                    where A.P_NOTEL = B.ND
                    and a.P_CUST_ACCOUNT = '".$item['account_num']."'
                    and to_number(b.PERIODE) between ".date('Ym', strtotime('-3 month'))." and ".date('Ym')."
                    group by b.PERIODE
                    order by b.PERIODE";

        $query = $this->db->query($sql);
        $row = $query->result_array();
        return $row;
    }


    function getSchemaID() {

        $format_serial = 'SCM-DATE-XXXX';

        $sql = "select max(to_number(substr(schema_id, nvl(length(schema_id),0)-4 + 1 ))) total from sc_schema
                    where substr(schema_id,5,8) = '".date('Ymd')."'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        if(empty($row)) {
            $row = array('total' => 0);
        }

        $format_serial = str_replace('XXXX', str_pad(($row['total']+1), 4, '0', STR_PAD_LEFT), $format_serial);
        $format_serial = str_replace('DATE', date('Ymd'), $format_serial);

        return $format_serial;
    }

}

/* End of file Users.php */
