<?php

/**
 * Pembuatan schema Model
 *
 */
class Schema_contract extends Abstract_model {

    public $table           = "schema_contract";
    public $pkey            = "schema_id";
    public $alias           = "sc";

    public $fields          = array(
                                'schema_id'      => array('pkey' => true, 'type' => 'str', 'nullable' => true, 'unique' => true, 'display' => 'ID Schema'),
                                'nomor1'         => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Nomor 1'),
                                'nomor2'         => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Nomor 2'),
                                'hari'         => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Hari'),
                                'tanggal'         => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Tanggal'),
                                'bulan'         => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Bulan'),
                                'tahun'         => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Tahun'),
                                'lokasi'         => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Lokasi'),
                                'alamat_t'         => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Alamat Telkom'),
                                'alamat_c'         => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Alamat Customer'),
                                'nama_t'         => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Nama Perwakilan Telkom'),
                                'nama_c'         => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Nama Perwakilan Customer'),
                                'rek_no'         => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Nomor Rekening'),
                                'rek_name'         => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Atas Nama'),
                                'jabatan_t'         => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Jabatan'),
                                'jabatan_c'         => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Jabatan'),
                                'nama_pt'         => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Nama Perusahaan'),
                                'alamat_inv'         => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Alamat Invoice'),
                                'program'         => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'Program')
                            );

    public $selectClause    = "sc.*";
    public $fromClause      = "schema_contract sc";

    public $refs            = array();

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database('corecrm', TRUE);
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

    function isContractExist($schema_id) {
        $sql = "select count(1) as totalcount from schema_contract where schema_id = '".$schema_id."'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $query->free_result();

        if ($row['totalcount'] > 0) return true;
        return false;
    }

    function get_data_contract($schema_id){
        
        $sql = "SELECT a.SCHEMA_ID,
                       NOMOR1,
                       NOMOR2,
                       HARI,
                       TANGGAL,
                       BULAN,
                       TAHUN,
                       LOKASI,
                       ALAMAT_T,
                       ALAMAT_C,
                       NAMA_T,
                       NAMA_C,
                       REK_NO,
                       REK_NAME,
                       JABATAN_T,
                       JABATAN_C,
                       NAMA_PT,
                       ALAMAT_INV,
                       c.schem_name PROGRAM,
                       c.disc_pct || '%' PERCENT_CMT,
                       to_char(d.START_PERIOD,'MON') BULAN_4,
                       to_char(add_months(d.START_PERIOD, MONTH_BACKWARD_QTY*-1),'MON') BULAN_1, 
                       d.AVG_USAGE_ONNET NILAI_CMT, 
                       d.AVG_USAGE_ONNET * c.disc_pct/100 NILAI_RATA2
                       from schema_contract a
                       join sc_schema@GNV_CUS_NPOTS b on a.schema_id = b.schema_id  
                       join v_bs_schem_list@GNV_CUS_NPOTS c
                       on b.discount_id = c.discount_code
                       join M4L_ACC_SCHEMA_REG@GNV_CUS_NPOTS d
                       on b.batch_id = d.batch_id 
                       where a.schema_id = '$schema_id' ";

        $query = $this->db->query($sql);
        $result = $query->result_array();

        return $result;

    }


    function getSchemName($discount_code) {
        $this->db = $this->load->database('default', TRUE);
        $this->db->_escape_char = ' ';
        $sql = "SELECT * FROM v_bs_schem_list WHERE discount_code = '".$discount_code."'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $query->free_result();

        return $row['schem_name'];
    }

    function get_uploaded_contract($schema_id='') {
        $sql = "select * from schema_contract_upd where schema_id = '".$schema_id."'";
        $query = $this->db->query($sql);
        $item  = $query->result_array();

        return $item;
    }

    function get_con_id($schema_id){
      $sql = "SELECT nvl(max(contract_id),0)+1  cid FROM schema_contract_upd WHERE schema_id = '".$schema_id."'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $query->free_result();

        return $row['cid'];
    }

    function delete_upd_c($schema_id='',  $seq) {
        
        $sql = "delete schema_contract_upd where schema_id = '".$schema_id."' and contract_id = '".$seq."' ";
        $query = $this->db->query($sql);
    }
    
    function ins_data_contract($schema_id='', $filename, $seq) {
        
        $sql = "insert into schema_contract_upd (SCHEMA_ID, UPLOADED_DATE, FILE_NAME, CONTRACT_ID) 
                VALUES('".$schema_id."', sysdate, '".$filename."', ".$seq.")";
        $query = $this->db->query($sql);
    }
}

/* End of file Users.php */
