<?php

/**
 * Pembuatan schema Model
 *
 */
class Info_schema extends Abstract_model {

    public $table           = "sc_schema";
    public $pkey            = "schema_id";
    public $alias           = "sc";

    public $fields          = array(

                            );

    public $selectClause    = "sc.schema_id, sc.schema_name, sc.customer_ref, sc.account_num, sc.discount_id, sc.status,
                                    to_char(sc.start_dat,'yyyy-mm-dd') as start_dat, to_char(sc.end_dat,'yyyy-mm-dd') as end_dat,
                                    to_char(sc.start_dat,'yyyymm') as start_periode,
                                    ac.account_name, ac2.account_name as customer_name, '-' cust_address,
                                    vbsl.disc_pct, vbsl.p_business_schem_id, vbsl.schem_name,
                                    vbsl.kuadran, vbsl.trend, vbsl.operator, vbsl.disc_description,
                                    ( vbsl.schem_name || ' - ' || vbsl.disc_description ) as jenis_skema";
    public $fromClause      = "sc_schema sc
                                    left join account ac on sc.account_num = ac.account_num
                                    left join account ac2 on sc.customer_ref = ac2.customer_ref and sc.account_num = ac2.account_num
                                    left join v_bs_schem_list vbsl on sc.discount_id = vbsl.discount_code";

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


    function getDetailSkema($discount_code='') {
        $sql = "select * from v_bs_schem_list where discount_code = '".$discount_code."'";
        $query = $this->db->query($sql);
        $item  = $query->row_array();

        return $item;
    }

}

/* End of file Users.php */
