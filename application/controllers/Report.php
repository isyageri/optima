<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'language'));
    }

    function index() {
        check_login();
    }

    function excelRedekomposisi(){
        $cek = permission_check_v2('view-redekomposisi');

        if($cek > 0){
            $output = $this->getReportRedekomposisi();
        }else{
            $output = 'We\'re sorry. You don\'t have permission to access this request';
        }

        startExcel(date('dmY')."-TELKOM--1.xls");
        echo '<html>';
        echo '<head><title>Report Redekomposisi</title></head>';
        echo '<body>';
        echo $output;
        echo '</body>';
        echo '</html>';
        exit;
    }

    function getReportRedekomposisi(){
        $period   = !($this->input->post('period')) ? $this->input->get('period') : $this->input->post('period');
        $items = array();
        $sql = "SELECT *   
                FROM  v_report_redekomposisi
                WHERE period = '".$period."'";

        $this->db = $this->load->database('tosdb', TRUE);
        $this->db->_escape_char = ' ';        
        $query = $this->db->query($sql);
        $items = $query->result_array();
        $output = '';

        $output .= '<table width="100%" border="1">';
        $output .= '<tr>
                        <th style="text-align:left;">Keterangan</th>
                        <th style="text-align:center;">Account Num</th>
                        <th style="text-align:center;">Divre</th>
                        <th style="text-align:center;">Period</th>
                        <th style="text-align:center;">Notel</th>
                        <th style="text-align:center;">Event Filter Name</th>
                        <th style="text-align:right;">D SLJJ PSTN</th>
                        <th style="text-align:right;">D SLJJ Seluler</th>
                        <th style="text-align:right;">D Lokal Seluler</th>
                        <th style="text-align:right;">D Lokal PSTN</th>
                        <th style="text-align:right;">D SLI 007</th>
                        <th style="text-align:right;">D Abonemen</th>
                        <th style="text-align:left;">Ket</th>
                        <th style="text-align:right;">NCLI</th>
                        <th style="text-align:right;">NDOS</th>
                        <th style="text-align:right;">BA</th>
                        <th style="text-align:right;">PPN</th>
                    </tr>';

        foreach ($items as $item) {
            $output .= '<tr>';
            $output .= '<td style="text-align:left">'.$item['keterangan'].'</td>';
            $output .= '<td style="text-align:center">'.$item['account_num'].'</td>';
            $output .= '<td style="text-align:center">'.$item['divre'].'</td>';
            $output .= '<td style="text-align:center">'.$item['period'].'</td>';
            $output .= '<td style="text-align:center">'.$item['notel'].'</td>';
            $output .= '<td style="text-align:center">'.$item['event_filter_name'].'</td>';
            $output .= '<td style="text-align:right">' .$item['d_sljj_pstn']. '</td>';
            $output .= '<td style="text-align:right">'.$item['d_sljj_seluler'].'</td>';
            $output .= '<td style="text-align:right">'.$item['d_lokal_seluler'].'</td>';
            $output .= '<td style="text-align:right">'.$item['d_lokal_pstn'].'</td>';
            $output .= '<td style="text-align:right">'.$item['d_sli_007'].'</td>';
            $output .= '<td style="text-align:right">'.$item['d_abonemen'].'</td>';
            $output .= '<td style="text-align:left">'.$item['ket'].'</td>';
            $output .= '<td style="text-align:right">'.$item['ncli'].'</td>';
            $output .= '<td style="text-align:right">'.$item['ndos'].'</td>';
            $output .= '<td style="text-align:right">'.$item['ba'].'</td>';
            $output .= '<td style="text-align:right">'.$item['ppn'].'</td>';
            $output .= '</tr>';
        }

        $output .= '</table>';

        return $output;
    }

    function excelInvoice(){
        $cek = permission_check_v2('view-invoice');

        if($cek > 0){
            $output = $this->getReportInvoice();
        }else{
            $output = 'We\'re sorry. You don\'t have permission to access this request';
        }

        startExcel(date('dmY')."-TELKOM--1.xls");
        echo '<html>';
        echo '<head><title>Report Invoice</title></head>';
        echo '<body>';
        echo $output;
        echo '</body>';
        echo '</html>';
        exit;
    }

    function getReportInvoice(){
        $bill_period   = !($this->input->post('period')) ? $this->input->get('period') : $this->input->post('period');
        $items = array();
        $sql = "SELECT *   
                FROM  v_list_reportinvoice
                WHERE bill_period = '".$bill_period."'";

        $this->db = $this->load->database('corecrm', TRUE);
        $this->db->_escape_char = ' ';        
        $query = $this->db->query($sql);
        $items = $query->result_array();
        $output = '';

        $output .= '<table width="100%" border="1">';
        $output .= '<tr>
                        <th style="text-align:center;">Account Num</th>
                        <th style="text-align:center;">Account Lama</th>
                        <th style="text-align:left;">Nama</th>
                        <th style="text-align:left;">Alamat</th>
                        <th style="text-align:center;">Bill Period</th>
                        <th style="text-align:center;">SST Before Bill</th>
                        <th style="text-align:center;">SST After Bill</th>
                        <th style="text-align:right;">Commitment</th>
                        <th style="text-align:right;">Allowance</th>
                        <th style="text-align:right;">Disc Prec</th>
                        <th style="text-align:right;">Tagihan</th>
                        <th style="text-align:right;">Eligible</th>
                        <th style="text-align:right;">Diskon AMN</th>
                        <th style="text-align:right;">Tag Diskon</th>
                        <th style="text-align:right;">PPN</th>
                        <th style="text-align:right;">Total Bill</th>
                        <th style="text-align:left;">Paket</th>
                        <th style="text-align:left;">Prosses</th>
                        <th style="text-align:left;">DIV</th>
                    </tr>';

        foreach ($items as $item) {
            $output .= '<tr>';
            $output .= '<td style="text-align:center">'.$item['account_num'].'</td>';
            $output .= '<td style="text-align:center">'.$item['account_lama'].'</td>';
            $output .= '<td style="text-align:left">'.$item['nama'].'</td>';
            $output .= '<td style="text-align:left">'.$item['alamat'].'</td>';
            $output .= '<td style="text-align:center">'.$item['bill_period'].'</td>';
            $output .= '<td style="text-align:center">'.$item['fastel_before_bill'].'</td>';
            $output .= '<td style="text-align:center">' .$item['fastel_bill']. '</td>';
            $output .= '<td style="text-align:right">'.$item['commitment'].'</td>';
            $output .= '<td style="text-align:right">'.$item['allowance'].'</td>';
            $output .= '<td style="text-align:right">'.$item['disc_perc'].'</td>';
            $output .= '<td style="text-align:right">'.$item['tagihan'].'</td>';
            $output .= '<td style="text-align:right">'.$item['eligible'].'</td>';
            $output .= '<td style="text-align:right">'.$item['disc_amn'].'</td>';
            $output .= '<td style="text-align:right">'.$item['tag_diskon'].'</td>';
            $output .= '<td style="text-align:right">'.$item['ppn'].'</td>';
            $output .= '<td style="text-align:right">'.$item['total_bill'].'</td>';
            $output .= '<td style="text-align:left">'.$item['paket'].'</td>';
            $output .= '<td style="text-align:left">'.$item['proses'].'</td>';
            $output .= '<td style="text-align:left">'.$item['div'].'</td>';
            $output .= '</tr>';
        }

        $output .= '</table>';

        return $output;
    }

    function excelListNokesM4L(){
        $cek = permission_check_v2('view-list-nokes-m4l');

        if($cek > 0){
            $output = $this->getReportListNokesM4L();
        }else{
            $output = 'We\'re sorry. You don\'t have permission to access this request';
        }

        startExcel(date('dmY')."-TELKOM--1.xls");
        echo '<html>';
        echo '<head><title>Report List NOKES M4L</title></head>';
        echo '<body>';
        echo $output;
        echo '</body>';
        echo '</html>';
        exit;
    }

    function getReportListNokesM4L(){        
        $where = '';
        $bill_period   = !($this->input->post('period')) ? $this->input->get('period') : $this->input->post('period');
        $filter_by   = !($this->input->post('filter_by')) ? $this->input->get('filter_by') : $this->input->post('filter_by');
        $filter_name   = !($this->input->post('filter_name')) ? $this->input->get('filter_name') : $this->input->post('filter_name');

        switch ($filter_by) {
            case '1':
                $where .= " WHERE customer_ref like '%".$filter_name."%' ";
                break;
            case '2':
                $where .= " WHERE account_num like '%".$filter_name."%' ";
                break;
            case '3':
                $where .= " WHERE name like '%".$filter_name."%' ";
                break;
            default:
                $where .= " WHERE customer_ref like '%%' ";
                break;
        }

        if(!empty($bill_period)){
            $where .= " AND bill_period = '".$bill_period."'";
        }


        $items = array();
        $sql = "SELECT *   
                FROM  v_listnokesm4l ".$where;

        $this->db = $this->load->database('corecrm', TRUE);
        $this->db->_escape_char = ' ';      
        $query = $this->db->query($sql);
        $items = $query->result_array();
        $output = '';

        $output .= '<table width="100%" border="1">';
        $output .= '<tr>
                        <th style="text-align:left;">Divisi</th>
                        <th style="text-align:center;">Period</th>
                        <th style="text-align:center;">Customer</th>
                        <th style="text-align:center;">Account Num</th>
                        <th style="text-align:left;">Name</th>
                        <th style="text-align:center;">Skema M4L</th>
                        <th style="text-align:center;">Paket</th>
                        <th style="text-align:center;">Start Date Schema</th>
                        <th style="text-align:center;">End Date Schema</th>
                        <th style="text-align:right;">Commitment Rev</th>
                        <th style="text-align:right;">Rev. Reference</th>
                        <th style="text-align:center;">Tanggal Transaksi</th>
                        <th style="text-align:right;">Rev</th>
                        <th style="text-align:right;">TEligible Rev</th>
                        <th style="text-align:right;">Discount</th>
                        <th style="text-align:right;">Rev. After Disc</th>
                    </tr>';

        foreach ($items as $item) {
            $output .= '<tr>';
            $output .= '<td style="text-align:left">'.$item['company_name'].'</td>';
            $output .= '<td style="text-align:center">'.$item['bill_period'].'</td>';
            $output .= '<td style="text-align:center">'.$item['customer_ref'].'</td>';
            $output .= '<td style="text-align:center">'.$item['account_num'].'</td>';
            $output .= '<td style="text-align:left">'.$item['nama'].'</td>';
            $output .= '<td style="text-align:center">'.$item['paket'].'</td>';
            $output .= '<td style="text-align:center">' .$item['offering_name']. '</td>';
            $output .= '<td style="text-align:center">'.$item['start_dat'].'</td>';
            $output .= '<td style="text-align:center">'.$item['end_dat'].'</td>';
            $output .= '<td style="text-align:right">'.$item['commitment'].'</td>';
            $output .= '<td style="text-align:right">'.$item['rev_ref'].'</td>';
            $output .= '<td style="text-align:center">'.$item['tanggal_transaksi'].'</td>';
            $output .= '<td style="text-align:right">'.$item['tagihan'].'</td>';
            $output .= '<td style="text-align:right">'.$item['eligible'].'</td>';
            $output .= '<td style="text-align:right">'.$item['disc_amn'].'</td>';
            $output .= '<td style="text-align:right">'.$item['total_bill'].'</td>';
            $output .= '</tr>';
        }

        $output .= '</table>';

        return $output;
    }

    function excelSalesM4L(){
        $cek = permission_check_v2('view-sales-m4l');

        if($cek > 0){
            $output = $this->getReportSalesM4L();
        }else{
            $output = 'We\'re sorry. You don\'t have permission to access this request';
        }

        startExcel(date('dmY')."-TELKOM--1.xls");
        echo '<html>';
        echo '<head><title>Report Sales M4L</title></head>';
        echo '<body>';
        echo $output;
        echo '</body>';
        echo '</html>';
        exit;
    }

    function getReportSalesM4L(){        
        $where = '';
        $start_date   = !($this->input->post('start')) ? $this->input->get('start') : $this->input->post('start');
        $end_date   = !($this->input->post('end')) ? $this->input->get('end') : $this->input->post('end');
        $filter_by   = !($this->input->post('filter_by')) ? $this->input->get('filter_by') : $this->input->post('filter_by');
        $filter_name   = !($this->input->post('filter_name')) ? $this->input->get('filter_name') : $this->input->post('filter_name');

        switch ($filter_by) {
            case '1':
                $where .= " WHERE a.customer_ref like '%".$filter_name."%' ";
                break;
            case '2':
                $where .= " WHERE a.account_num like '%".$filter_name."%' ";
                break;
            case '3':
                $where .= " WHERE a.address_name like '%".$filter_name."%' ";
                break;
            default:
                $where .= " WHERE a.customer_ref like '%%' ";
                break;
        }

        if(!empty($start_date)){
            $where .= " AND a.start_dat >= trunc(to_date('".$start_date."', 'mm/dd/yyyy'))";
        }

        if(!empty($end_date)){
            $where .= " AND a.end_dat <= trunc(to_date('".$end_date."', 'mm/dd/yyyy'))";
        }


        $items = array();
        $sql = "SELECT a.*, 
                       (CASE WHEN instr(a.nokes,'<input') > 0 THEN 'ACTION' ELSE '' END) nokes_action
                FROM  v_salesm4l a ".$where;

        $this->db = $this->load->database('corecrm', TRUE);
        $this->db->_escape_char = ' ';      
        $query = $this->db->query($sql);
        $items = $query->result_array();
        $output = '';

        $output .= '<table width="100%" border="1">';
        $output .= '<tr>
                        <th style="text-align:center;">CUSTOMER REF</th>
                        <th style="text-align:center;">ACCOUNT NUM</th>
                        <th style="text-align:left;">ACCOUNT NAME</th>
                        <th style="text-align:center;">NOKES</th>
                        <th style="text-align:center;">TANGGAL TRANSAKSI</th>
                        <th style="text-align:left;">DIVISI</th>
                        <th style="text-align:center;">SKEMA M4L</th>
                        <th style="text-align:left;">PAKET</th>
                        <th style="text-align:left;">STATUS TRX</th>
                    </tr>';

        foreach ($items as $item) {
            $output .= '<tr>';
            $output .= '<td style="text-align:center">'.$item['customer_ref'].'</td>';
            $output .= '<td style="text-align:center">'.$item['account_num'].'</td>';
            $output .= '<td style="text-align:left">'.$item['address_name'].'</td>';
            $output .= '<td style="text-align:center">'.$item['nokes_action'].'</td>';
            $output .= '<td style="text-align:center">'.$item['tanggal_trans'].'</td>';
            $output .= '<td style="text-align:left">'.$item['company_name'].'</td>';
            $output .= '<td style="text-align:center">' .$item['schema_type_name']. '</td>';
            $output .= '<td style="text-align:left">'.$item['offering_name'].'</td>';
            $output .= '<td style="text-align:left">'.$item['status_trx'].'</td>';
            $output .= '</tr>';
        }

        $output .= '</table>';

        return $output;
    }
    
}