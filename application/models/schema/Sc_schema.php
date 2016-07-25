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

    public $selectClause    = "sc.schema_id, sc.schema_name, sc.customer_ref, ac.account_name, sc.status, sc.batch_id,
                                sc.account_num, sc.discount_id, to_char(sc.start_dat,'yyyy-mm-dd') as start_dat, to_char(sc.end_dat,'yyyy-mm-dd') as end_dat,
                                to_char(sc.start_dat,'yyyymm') as start_periode";
    public $fromClause      = "sc_schema sc
                                join account ac on ac.account_num = sc.account_num and ac.customer_ref = sc.customer_ref ";

    public $refs            = array();

    public $schema_id_global = '';

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
            $schema_id = $this->getSchemaID();
            $this->record[$this->pkey] = $schema_id;
            //$this->$schema_id_global = $schema_id;
            /*if(empty($this->record['end_dat'])) {
                $this->db->set('end_dat', NULL);
            }else {
                $this->db->set('end_dat',"to_date('".$this->record['end_dat']."','yyyy-mm-dd')",false);
            }*/

            $this->db->set('created_date',"to_date('".date('Y-m-d')."','yyyy-mm-dd')",false);
            $this->db->set('created_by', "'".$ci->ion_auth->user()->row()->username."'" ,false);

            unset($this->record['created_date']);
            unset($this->record['created_by']);

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
                 join p_trend_increase b on a.p_trend_increase_id = b.p_trend_increase_id
                 join sc_schema c on a.account_num = c.account_num and a.batch_id = c.batch_id
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
                sc.schema_id, sc.batch_id, sc.schema_name, sc.customer_ref, ac.account_name,
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
                    and a.batch_id = ".$item['batch_id']."
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
                    and TREND = '".$trend."'
                    and discount_code = nvl('".$discount_code."', discount_code)
                    order by schem_name, disc_pct
                    ";
        /*if(!empty($discount_code))
            $sql .= " where discount_code = '".$discount_code."'";*/
        $query = $this->db->query($sql);
        $row = $query->result_array();
        return $row;
    }

    function getListSkemaPembayaran2($trend, $operator, $kuadran, $model, $discount_code) {

        // $sql = "select * from v_business_schem_list";
        $sql = "select * from V_BS_SCHEM_LIST
                    where OPERATOR = '".$operator."'
                    and KUADRAN = '".$kuadran."'
                    and TREND = '".$trend."'
                    and discount_code = nvl('".$discount_code."', discount_code)
                     order by schem_name, disc_pct
                    ";
        /*if(!empty($discount_code))
            $sql .= " where discount_code = '".$discount_code."'";*/
        $query = $this->db->query($sql);
        $row = $query->result_array();
        return $row;
    }

    function getAccSchemaID($schema_id) {

        $sql = "select b.m4l_acc_schema_id from sc_schema a
                left join  m4l_acc_schema_reg b on a.batch_id = b.batch_id
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

    function updateScSchema($schema_id, $kolom, $val, $tipe){
        if($tipe == 'date'){
             $sql = "update sc_schema
                    set $kolom = to_date('".$val."','yyyy-mm-dd')
                where schema_id = '".$schema_id."'
                    ";
        }else if ($tipe == 'schema_name'){
                 $sql = "update sc_schema
                    set schema_name = customer_ref || '_' || account_num || '_' || substr(schema_id, -1)
                where schema_id = '".$schema_id."' ";
        }else{
             $sql = "update sc_schema
                    set $kolom = '".$val."'
                where schema_id = '".$schema_id."'
                    ";
        }


        $query = $this->db->query($sql);

    }

    function insertPeriodeExpense($batch_id) {
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();

        $sql = "select count(*) total from t_job_has_period where batch_id = $batch_id";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        if( $row['total'] < 1){

            $result = '';
            $periode = array();
            $max_month = 3;
            for($i = 0; $i <= $max_month; $i++) {
                $periode[] = date('Ym', strtotime('-'.$i.' month'));
            }
            $string_periode = join("#", $periode);

            $sql = "  BEGIN ".
                   "  insert_period_expense(:params1, :params2, :params3, :params4); END;";

            $stmt = oci_parse($this->db->conn_id,$sql);

            oci_bind_by_name($stmt,':params1', $string_periode, 255);
            oci_bind_by_name($stmt,':params2', $userinfo->username, 255);
            oci_bind_by_name($stmt,':params3', $batch_id, 16);
            oci_bind_by_name($stmt,':params4', $result, 255);

            oci_execute($stmt);
        }



    }

    function prosesGetHistory($schema_id, $created_by){

        $batch_id = $this->getNextBatchID($schema_id);

        $sql = " DELETE control_batch where BATCH_CONTROL_ID = $batch_id ";

        $query = $this->db->query($sql);

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

    function create_customer_order(){
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();
        $username = $userinfo->username;
        $tosdb = $this->load->database('tosdb', TRUE);
        $tosdb->_escape_char = ' ';

        $cust_order_id = $this->generate_id('T_CUSTOMER_ORDER');

        $sql = "INSERT INTO T_CUSTOMER_ORDER (  T_CUSTOMER_ORDER_ID,
                                                ORDER_NO,
                                                P_RQST_TYPE_ID,
                                                P_ORDER_STATUS_ID,
                                                ORDER_DATE,
                                                CREATION_DATE,
                                                CREATED_BY,
                                                UPDATED_DATE,
                                                UPDATED_BY )
                    VALUES (".$cust_order_id.",
                            LPAD(T_CUSTOMER_ORDER_SEQ.NEXTVAL, 10, '0'),
                            1,
                            1,
                            SYSDATE,
                            SYSDATE,
                            '".$username."',
                            SYSDATE,
                            '".$username."'
                )";

        $tosdb->query($sql);

        return $cust_order_id;

    }

    function submitWF($t_customer_order_id, $doc_type_id) {
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();
        $username = $userinfo->username;
        $tosdb = $this->load->database('tosdb', TRUE);
        $tosdb->_escape_char = ' ';

        try {

            $sql = "  BEGIN ".
                            "  p_first_submit_engine(:i_doc_type_id, :i_cust_req_id, :i_username, :o_result_code, :o_result_msg ); END;";

            $stmt = oci_parse($tosdb->conn_id, $sql);

            //  Bind the input parameter
            oci_bind_by_name($stmt, ':i_doc_type_id', $doc_type_id);
            oci_bind_by_name($stmt, ':i_cust_req_id', $t_customer_order_id);
            oci_bind_by_name($stmt, ':i_username', $username);

            // Bind the output parameter
            oci_bind_by_name($stmt, ':o_result_code', $code, 2000000);
            oci_bind_by_name($stmt, ':o_result_msg', $msg, 2000000);

            ociexecute($stmt);

            $data['success'] = true;
            $data['error_code'] = $code;
            $data['error_message'] = $msg;

        } catch( Exception $e ) {
            $data['success'] = false;
            $data['message'] = $e->getMessage();
        }

        //echo json_encode($data);
        exit;
    }

    function get_data_skema($schema_id) {

        $sql = "SELECT * FROM sc_schema where schema_id = '$schema_id' ";

        $query = $this->db->query($sql);
        $result = $query->result_array();

        return $result;
    }

    function validate_account($account_num){

         $sql = "select count(*) total
                from sc_schema
                where account_num = '".$account_num."' 
                and end_dat > sysdate";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        return $row['total'];
    }

    function trx_initiate($schema_id, $param ){
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();
        $username = $userinfo->username;
        $tosdb = $this->load->database('default', TRUE);
        $tosdb->_escape_char = ' ';

        $cust_order_id = $this->generate_id('T_CUSTOMER_ORDER');

        $sql = "INSERT INTO TRX_CONTROL (  T_CUSTOMER_ORDER_ID,
                                                ORDER_NO,
                                                P_RQST_TYPE_ID,
                                                P_ORDER_STATUS_ID,
                                                ORDER_DATE,
                                                CREATION_DATE,
                                                CREATED_BY,
                                                UPDATED_DATE,
                                                UPDATED_BY )
                    VALUES (".$cust_order_id.",
                            LPAD(T_CUSTOMER_ORDER_SEQ.NEXTVAL, 10, '0'),
                            1,
                            1,
                            SYSDATE,
                            SYSDATE,
                            '".$username."',
                            SYSDATE,
                            '".$username."'
                )";
         $sql = "select count(*) total
                from sc_schema
                where account_num = '".$account_num."' 
                and end_dat > sysdate";
        $query = $this->db->query($sql);
    }

}

/* End of file Users.php */
