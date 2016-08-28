<?php

/**
 * Pembuatan schema Model
 *
 */
class Fastel extends Abstract_model {

    public $table           = "cc_dataref_batch";
    public $pkey            = "";
    public $alias           = "fastel";

    public $fields          = array(

                            );

    public $selectClause    = "fastel.*, (p_notel || '|' || schema_id) as fastel_id, batch_id||','|| '''' || fastel.p_notel ||'''' as action, fastel.valid status, (select sum(total_aamount) from V_TAGIHAN_AGREGAT_M4L where batch_id = fastel.batch_id and nd = fastel.p_notel) amount";
    public $fromClause      = "cc_dataref_batch fastel";

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

        }else {
            //do something
            //example:
            //$this->record['updated_date'] = date('Y-m-d');
            //if false please throw new Exception
        }
        return true;
    }

    function removeFastel($items) {
        $code = explode('|', $items);

        $sql = "DELETE FROM ".$this->table." WHERE p_notel = '".$code[0]."' AND schema_id = '".$code[1]."'";
        $this->db->query($sql);

        return true;
    }

    function getNextBatchID($schema_id) {
        //$sql = "select nvl(max(batch_id),0)+1 as total from cc_dataref_batch";
        $sql = "select decode(batch_id,null,max(batch_id)+1, batch_id)  total 
                from sc_schema 
                where schema_id = '".$schema_id."' 
                group by batch_id ";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        return (int)$row['total'];
    }

    function insertPeriodeExpense($batch_id) {
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();

        $sql = "select count(*) from t_job_has_period where batch_id = $batch_id";
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
    
    function updateScSchema($schema_id, $kolom, $val){

        $sql = "update sc_schema 
                    set $kolom = '".$val."'
                where schema_id = '".$schema_id."'
                    ";

        $query = $this->db->query($sql);

    }

    function delete_history_fastel($schema_id){

        $sql = "DELETE cc_dataref_batch where schema_id = '".$schema_id."' ";

        $query = $this->db->query($sql);
        
        $sql = " DELETE control_batch where BATCH_CONTROL_ID = $batch_id ";
        $query = $this->db->query($sql);
        
        $sql = " DELETE t_job_has_period where BATCH_ID = $batch_id ";
        $query = $this->db->query($sql);

    }
	
	function check_history_proses($schema_id){
		
		$batch_id =  $this->getNextBatchID($schema_id);
		
		$sql = "select count(*) total 
				from M4L_ACC_SCHEMA_REG where batch_id = $batch_id ";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        return (int)$row['total'];
		
	}

    function get_status_schema($schema_id){
        
        $sql = "select status from sc_schema where schema_id =  '".$schema_id."' ";
        $query = $this->db->query($sql);
        $row = $query->row_array();

        return $row['status'];
        
    }
}

/* End of file Users.php */
