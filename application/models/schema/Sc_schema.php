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

    public $selectClause    = "sc.schema_id, sc.schema_name, sc.customer_ref, ac.account_name, 
                                sc.account_num, sc.discount_id, to_char(sc.start_dat,'yyyy-mm-dd') as start_dat, to_char(sc.end_dat,'yyyy-mm-dd') as end_dat,
                                to_char(sc.start_dat,'yyyymm') as start_periode";
    public $fromClause      = "sc_schema sc 
                                join account ac on ac.account_num = sc.account_num and ac.customer_ref = sc.customer_ref ";

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

    function getTrendHeader($schema_id) {

        $sql = "select b.trend_code, a.avg_usage_onnet, a.avg_usage_non_onnet
                from m4l_acc_schema_reg a
                left join p_trend_increase b on a.p_trend_increase_id = b.p_trend_increase_id
                left join sc_schema c on a.account_num = c.account_num
                where c.schema_id = '".$schema_id."'";

        $query = $this->db->query($sql);
        $row = $query->row_array();

        if($row == null) return array('trend_code' => '',
                                      'avg_usage_onnet' => '',
                                      'avg_usage_non_onnet' => '');
        return $row;
    }
    
    function getInfoSchema($schema_id) {
        
        $sql = "select 
                sc.schema_id, sc.schema_name, sc.customer_ref, ac.account_name, 
                sc.account_num, to_char(sc.start_dat,'yyyy-mm-dd') as start_dat, 
                to_char(sc.end_dat,'yyyy-mm-dd') as end_dat,
        to_char(sc.start_dat,'yyyymm') as start_periode, sc.created_by, sc.status, sc.step
        from sc_schema sc 
        join geneva_admin_npots.account ac on sc.account_num = ac.account_num
        where schema_id = '".$schema_id."'
        and rownum = 1
        ";
        
        $query = $this->db->query($sql);
        $row = $query->result_array();
        return $row;
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


    // function getListSkemaPembayaran($discount_code = "") {
    function getListSkemaPembayaran($trend, $operator, $kuadran, $model) {

        // $sql = "select * from v_business_schem_list";
        $sql = "select * from V_BS_SCHEM_LIST 
                    where OPERATOR = '".$operator."'
                    and KUADRAN = '".$kuadran."'
                    and SCHEM_NAME = '".$model."'
                    and TREND = '".$trend."' and rownum < 3
                    ";
        /*if(!empty($discount_code))
            $sql .= " where discount_code = '".$discount_code."'";*/
        $query = $this->db->query($sql);
        $row = $query->result_array();
        return $row;
    }


    function getAccSchemaID($schema_id) {

        $sql = "select b.m4l_acc_schema_id from sc_schema a
                left join  m4l_acc_schema b on a.account_num = b.account_num
                where schema_id = '".$schema_id."'";

        $query = $this->db->query($sql);
        $row = $query->row_array();

        if(empty($row)) return null;

        return $row['m4l_acc_schema_id'];
    }

    function getDiscountCodeAccBusinessSchem($schema_id) {
        $m4l_acc_schema_id = $this->getAccSchemaID($schema_id);

        if(empty($m4l_acc_schema_id)) return null;

        $sql = "select discount_code from m4l_acc_business_schem
                    where m4l_acc_schema_id = ".$m4l_acc_schema_id;

        $query = $this->db->query($sql);
        $row = $query->row_array();

        return $row['discount_code'];
    }

    function updateScSchema($schema_id, $kolom, $val){

        $sql = "update sc_schema 
                    set $kolom = '".$val."'
                where schema_id = '".$schema_id."'
                    ";

        $query = $this->db->query($sql);

    }
    
    function prosesGetHistory($schema_id, $created_by){

        $batch_id = $this->getNextBatchID($schema_id);

        $sql = "insert into control_batch (BATCH_CONTROL_ID, P_BATCH_TYPE_ID, LAST_PROCESS_STATUS_ID, CREATION_DATE, CREATED_BY)
                    values($batch_id, 1, 0, sysdate, '".$created_by."') ";

        $query = $this->db->query($sql);
        
    }

    function getNextBatchID($schema_id) {
        //$sql = "select nvl(max(batch_id),0)+1 as total from cc_dataref_batch";
        $sql = "select nvl(batch_id,(select nvl(max(batch_id),0)+1 as total from cc_dataref_batch)) total 
                from sc_schema 
                where schema_id = '".$schema_id."' ";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        return (int)$row['total'];
    }

     function get_select_option($select, $trend, $kuadran, $operator) {

        if($select == 'kuadran'){
                
                $sql = "SELECT DISTINCT KUADRAN id, KUADRAN code 
                    from V_BS_SCHEM_LIST
                    where OPERATOR = '$operator'
                    and TREND = '$trend' ";

        }else{

               
                     $sql = "SELECT DISTINCT SCHEM_NAME id, SCHEM_NAME code
                        from V_BS_SCHEM_LIST
                        where OPERATOR = '$operator'
                        and TREND = '$trend'
                        and KUADRAN = '$kuadran' ";

        }
         
        $query = $this->db->query($sql);
        $result = $query->result_array();

        return $result;
    }

}

/* End of file Users.php */
