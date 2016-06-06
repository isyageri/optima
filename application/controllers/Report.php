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
        $output = $this->getReportRedekomposisi();

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
        $output = $this->getReportInvoice();

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
}