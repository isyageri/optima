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

    function getSchemName($discount_code) {
        $this->db = $this->load->database('default', TRUE);
        $this->db->_escape_char = ' ';
        $sql = "SELECT * FROM v_bs_schem_list WHERE discount_code = '".$discount_code."'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $query->free_result();

        return $row['schem_name'];
    }

}

/* End of file Users.php */
