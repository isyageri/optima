<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_cont extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_login();
        $this->load->helper(array('url', 'language'));
        $this->load->model('customer/customer');
        $this->load->model('M_helper');

    }

    public function genCustRef()
    {
        $pck_name = "SINCUSTOMER.genCustomerRef";
        $pIN = array(
            'prefix' => 10
        );
        $conn_db = "corecrm";
        $out = $this->M_helper->exec_cursor($pck_name, $pIN, $conn_db);
        echo json_encode($out);
    }

    public function initTransaksi()
    {
        $pck_name = "SINCUSTOMER.inisialisasicreatecustomer";
        $pIN = array(
            'pIn_userId' => 1,
            'pIn_locId' => 1,
            'pIn_groupId' => 23
        );
        $conn_db = "corecrm";
        $out = $this->M_helper->exec_cursor($pck_name, $pIN, $conn_db);
        echo json_encode($out);
    }

    public function createCustomer()
    {
        $custReff = $this->input->post('custReff');
        $groupId = (int)$this->input->post('groupId');
        $idTD = (int)$this->input->post('idTD');
        $idTH = (int)$this->input->post('idTH');
        $in_AddressName = $this->input->post('in_AddressName');
        $in_BlockName = $this->input->post('in_BlockName');
        $in_CCCluster = $this->input->post('in_CCCluster');
        $in_City = $this->input->post('in_City');
        $in_ContactStartDate = $this->input->post('in_ContactStartDate');
        $in_ContactType = (int)$this->input->post('in_ContactType');
        $in_CustomerCategory = $this->input->post('in_CustomerCategory');
        $in_CustomerType = (int)$this->input->post('in_CustomerType');
        $in_DistrictName = $this->input->post('in_DistrictName');
        $in_Email = $this->input->post('in_Email');
        $in_FirstName = $this->input->post('in_FirstName');
        $in_Initials = $this->input->post('in_Initials');
        $in_LastName = $this->input->post('in_LastName');
        $in_MarketGroup = $this->input->post('in_MarketGroup');
        $in_MarketSegment = (int)$this->input->post('in_MarketSegment');
        $in_Phone = $this->input->post('in_Phone');
        $in_Province = $this->input->post('in_Province');
        $in_RefNipnas = $this->input->post('in_RefNipnas');
        $in_RegID = $this->input->post('in_RegID');
        $in_SalutationName = $this->input->post('in_SalutationName');
        $in_StreetName = $this->input->post('in_StreetName');
        $in_Title = $this->input->post('in_Title');
        $in_ZipCode = $this->input->post('in_ZipCode');
        $locId = (int)$this->input->post('locId');
        $userId = (int)$this->input->post('userId');
        $custAttr = (string)$this->getAttrValue(array($custReff,$in_CustomerCategory,$in_MarketGroup,$in_RegID,$in_CCCluster,$in_RefNipnas));


        $pck_name = "SINCUSTOMER.createCustomer";
        $pIN = array(
            'pIn_customerRef' => $custReff,
            'pIn_customerName' => '',
            'pIn_custType' => $in_CustomerType,
            'pIn_marketSegment' => $in_MarketSegment,
            'pIn_userId' => $userId,
            'pIn_locId' => $locId,
            'pIn_groupId' => $groupId,
            'pIn_title' => $in_Title,
            'pIn_firstName' => $in_FirstName,
            'pIn_initials' => $in_Initials,
            'pIn_lastName' => $in_LastName,
            'pIn_addressName' => $in_AddressName,
            'pIn_salutationNam' => $in_SalutationName,
            'pIn_contactType' => $in_ContactType,
            'pIn_streetName' => $in_StreetName,
            'pIn_blockName' => $in_BlockName,
            'pIn_districtName' => $in_DistrictName,
            'pIn_city' => $in_City,
            'pIn_provice' => $in_Province,
            'pIn_zipCode' => $in_ZipCode,
            'pIn_custAttr' => $custAttr,
            'pIn_email' => $in_Email,
            'pIn_phoneNumber' => $in_Phone,
            'pIn_cntStartDat' => $in_ContactStartDate,
            'pIn_trxId' => $idTH
        );

        // Exec Create Customer SIN_CORE
        $conn_db = "corecrm";
        $out = $this->M_helper->exec_cursor($pck_name, $pIN, $conn_db);

        // Exec Create Customer TOSDB
        $conn_db2 = "tosdb";
        $pck_name2 = "SINCUSTOMER.createCustomer";
        $out = $this->M_helper->exec_cursor($pck_name2, $pIN, $conn_db2);


        echo json_encode($out);
    }

    private function getAttrValue($arr){
        $vAttributes = '';
        for($i = 1; $i < count($arr); $i++){
            $vAttribute = '';
            $vAttrType = 'C';
            $vAttribute = $arr[0]."|".$i."|".$vAttrType."|".$arr[$i]."|";
            if($vAttributes != '')
            {
                $vAttributes .= "~".$vAttribute;
            }
            else
            {
                $vAttributes .= $vAttribute;
            }
        }

        return $vAttributes;
    }
}