<?php

/**
 * Trx_control Model
 *
 */
class Trx_control extends Abstract_model {

    public $table           = "trx_control";
    public $pkey            = "trx_id";
    public $alias           = "scm";

    public $fields          = array();

    public $selectClause    = "scm.*";
    public $fromClause      = "trx_control scm";

    public $refs            = array();

    function __construct() {
        parent::__construct();
    }

    function validate() {

        if($this->actionType == 'CREATE') {
         

        }else{

        }
        return true;
    }

    function create_trx_control($data_id, $reason){
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();
        $username = $userinfo->username;

        $trx_id = $this->generate_id('TRX_CONTROL');

        try {
            $cust_order_id = $this->create_customer_order();
            // $data_id = $this->input->post('schema_id');
            // $reason =  $this->input->post('reason');
            $status =  1;
            $trx_name = 'MODIFIKASI_SCHEMA_ACCOUNT';

            $sql ="INSERT INTO TRX_CONTROL (TRX_ID, 
                                            DATA_ID, 
                                            CREATED_BY, 
                                            CREATED_DATE, 
                                            STATUS, 
                                            REASON, 
                                            T_CUSTOMER_ORDER_ID, 
                                            TRX_NAME)
                    VALUES (".$trx_id.",
                            '".$data_id."',
                            '".$username."',
                            SYSDATE,
                            '".$status."',
                            '".$reason."',
                            ".$cust_order_id.",
                            '".$trx_name."'
                            )";

             $this->db->query($sql);

            $submit = $this->submitWF($cust_order_id, 2);
            if($submit){
                return true;    
            }else{
                return false;
            }
            

        } catch (Exception $e) {
            return false;
        }
    }

    function create_customer_order(){
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();
        $username = $userinfo->username;

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
                            2,
                            1,
                            SYSDATE,
                            SYSDATE,
                            '".$username."',
                            SYSDATE,
                            '".$username."'
                )";

        $this->db->query($sql);

        return $cust_order_id;

    }

    function submitWF($t_customer_order_id, $doc_type_id) {
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();
        $username = $userinfo->username;

        try {

            $sql = "  BEGIN ".
                            "  p_first_submit_engine(:i_doc_type_id, :i_cust_req_id, :i_username, :o_result_code, :o_result_msg ); END;";

            $stmt = oci_parse($this->db->conn_id, $sql);

            //  Bind the input parameter
            oci_bind_by_name($stmt, ':i_doc_type_id', $doc_type_id);
            oci_bind_by_name($stmt, ':i_cust_req_id', $t_customer_order_id);
            oci_bind_by_name($stmt, ':i_username', $username);

            // Bind the output parameter
            oci_bind_by_name($stmt, ':o_result_code', $code, 2000000);
            oci_bind_by_name($stmt, ':o_result_msg', $msg, 2000000);

            ociexecute($stmt);

            return true;

        } catch( Exception $e ) {
            return false;
        }
    }

    function getTrx($t_cust_id){
        $sql = "SELECT a.*,
                       b.schema_id, 
                       b.schema_name, 
                       b.customer_ref, 
                       b.account_num, 
                       b.start_dat,
                       b.end_dat,
                       b.operator,
                       b.m4l_acc_schema_id,
                       b.location_id,
                       b.created_by,
                       b.created_date,
                       b.step,
                       b.status,
                       b.notes,
                       b.discount_id,
                       b.batch_id,
                       b.trend,
                       c.account_name
                FROM trx_control a
                LEFT JOIN sc_schema b ON a.data_id = b.schema_id
                LEFT JOIN account_1 c ON b.ACCOUNT_NUM = c.ACCOUNT_NUM AND b.CUSTOMER_REF = c.CUSTOMER_REF 
                WHERE a.t_customer_order_id = ".$t_cust_id;
        $query = $this->db->query($sql);

        $items = '';
        if($query->num_rows() > 0){
            $result = $query->row_array();  
        }

        return $result;
    }
    
}

/* End of file */