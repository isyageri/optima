<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'language'));
    }

    function index() {
        check_login();
    }   

	public function excelAccountReport()
    {
        $npwp_val = $this->input->get('npwp_val');      
        $output = $this->getAccountReport();

        startExcel(date("mdy") . "_" ."TELKOM_ACCOUNT_REPORT.xls");
        echo '<html>';
        echo '<head><title>Account </title></head>';
        echo '<body>';
        echo $output;
        echo '</body>';
        echo '</html>';
        exit;
    }
	
	public function excelAccountList()
    {     
        $output = $this->getAccountList();

        startExcel(date("mdy") . "_" . "TELKOM.xls");
        echo '<html>';
        echo '<head><title>Account </title></head>';
        echo '<body>';
        echo $output;
        echo '</body>';
        echo '</html>';
        exit;
    }

    public function getAccountList()
    {	
		$npwp_val = !($this->input->post('npwp_val')) ? $this->input->get('npwp_val') : $this->input->post('npwp_val');
        /*header*/
        $output = '<style>td { 
                        padding:1px;
                    }</style>';
        $output .= '<table width="100%">';
        $output .= '<tr>
                       <td colspan="4" style="text-align:center;"> <span style="font-size:16px;"><b>ACCOUNT DETAILS INFORMATION</b></span></td>
                   </tr>';
        // $output .= '<tr>
                       // <td colspan="4" style="text-align:center;"><span style="font-size:16px;"><b>' . $schm_fee_arr[0] . '</b></span></td>
                   // </tr>';
        // $output .= '<tr>
                       // <td colspan="4" style="text-align:center;"><span style="font-size:14px;"><b>PERIODE TAGIHAN : ' . $bulan . ' ' . $tahun . '</b></span></td>
                   // </tr>';
        $output .= '<tr><td colspan="4">&nbsp;</td></tr>';
        $output .= '<table>';

		$sql = "SELECT a.account_num, null as action, a.account_name, b.account_status, a.currency_code, 
                a.deposit_mny, c.end_dat, null as golivedtm, e.email_address as email, d.npwp as npwp,
                RTRIM(f.address_1) || ' ' || RTRIM(f.address_2) || ' ' || RTRIM(f.address_3) || ' ' || RTRIM(f.address_4) || ' ' || RTRIM(f.address_5) as address
					FROM account a INNER JOIN accountstatus b ON a.ACCOUNT_NUM = b.ACCOUNT_NUM
                        INNER JOIN accountdetails c ON a.ACCOUNT_NUM = c.ACCOUNT_NUM
                        INNER JOIN accountattributes d ON a.ACCOUNT_NUM = d.ACCOUNT_NUM
                        INNER JOIN contactdetails e ON a.CUSTOMER_REF = e.CUSTOMER_REF
                        INNER JOIN address f ON a.CUSTOMER_REF = f.CUSTOMER_REF
						WHERE ROWNUM <=20
						";
        $this->db = $this->load->database('ccpbb', TRUE);
		$query = $this->db->query($sql);
        $items = $query->result_array();
        /*content*/
        $output .= '<table width="100%" border="1">';
        $output .= '<tr>
                        <th style="text-align:center;">Account Number</th>
                        <th style="text-align:center;">Action</th>
                        <th style="text-align:center;">Account Name</th>
                        <th style="text-align:center;">Account Status</th>
                        <th style="text-align:center;">Currency Code</th>
                        <th style="text-align:center;">Email</th>
                        <th style="text-align:center;"></th>
                        <th style="text-align:center;">NPWP</th>
                        <th style="text-align:center;">Address</th>
                    </tr>';
		foreach ($items as $item) 
		{
			$output .='<tr>';						
			$output .=	'<td>'. $item['account_num'] .'</td>';						
			$output .=	'<td>'. $item['action'] .'</td>';						
			$output .=	'<td>'. $item['account_name'] .'</td>';						
			$output .=	'<td>'. $item['account_status'] .'</td>';						
			$output .=	'<td>'. $item['currency_code'] .'</td>';						
			$output .=	'<td>'. $item['email'] .'</td>';						
			$output .=	'<td>'. $item['npwp'] .'</td>';						
			$output .=	'<td>'. $item['address'] .'</td>';						
			$output .='</tr>';
		}
		$output .= '</table>';
        return $output;
    }
	
	public function getAccountReport()
    {	
		 $npwp_val = !($this->input->post('npwp_val')) ? $this->input->get('npwp_val') : $this->input->post('npwp_val');
        /*header*/
        $output = '<style>td { 
                        padding:1px;
                    }</style>';
        $output .= '<table width="100%">';
        $output .= '<tr>
                       <td colspan="4" style="text-align:center;"> <span style="font-size:16px;"><b>ACCOUNT DETAILS INFORMATION</b></span></td>
                   </tr>';
        // $output .= '<tr>
                       // <td colspan="4" style="text-align:center;"><span style="font-size:16px;"><b>' . $schm_fee_arr[0] . '</b></span></td>
                   // </tr>';
        // $output .= '<tr>
                       // <td colspan="4" style="text-align:center;"><span style="font-size:14px;"><b>PERIODE TAGIHAN : ' . $bulan . ' ' . $tahun . '</b></span></td>
                   // </tr>';
        $output .= '<tr><td colspan="4">&nbsp;</td></tr>';
        $output .= '<table>';


        /*content*/
        $output .= '<table width="100%" border="1">';
        $output .= '<tr>
                        <th style="text-align:center;">Attribute ID</th>
                        <th style="text-align:center;">Attribute Name</th>
                        <th style="text-align:center;">Attribute Value</th>
                    </tr>';
		
		$output	.=	'<tr><td>1</td><td>BUSINESS_AREA</td><td></td></tr>';
		$output	.=	'<tr><td>1</td><td>BUSINESS_SHARE</td><td></td></tr>';
		$output	.=	'<tr><td>1</td><td>REFERENSI_ACCOUNT</td><td></td></tr>';
		$output	.=	'<tr><td>1</td><td>PREFIX_ACCOUNT</td><td></td></tr>';
		$output	.=	'<tr><td>1</td><td>NPWP</td><td>'. $npwp_val .'</td></tr>';
		$output	.=	'<tr><td>1</td><td>NPPKP</td><td></td></tr>';
		$output	.=	'<tr><td>1</td><td>BILL2PARTY</td><td></td></tr>';
		$output	.=	'<tr><td>1</td><td>REGION</td><td>1</td></tr>';						

        $output .= '</table>';
       
        return $output;
    }
}