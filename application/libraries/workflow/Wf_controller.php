<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Json library
* @class Groups_controller
* @version 07/05/2015 12:18:00
*/
class Wf_controller {

    function list_inbox() {
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $items = $table->getListInbox($userinfo->username);

        $strOutput = '';
        $total = 0;
        foreach($items as $item) {

            $url_arr = explode("#", $item['url']);
            $summary = str_replace("/", ".", $url_arr[0]);
            $str_params = $url_arr[1];

            $total += $item['jumlah'];
            $strOutput .= '<div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="portlet box blue-hoki">
                                        <div class="portlet-title">
                                            <div class="caption">'.$item['profile_type'].'</div>
                                            <div class="tools">
                                                <a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
                                            </div>
                                            <div class="actions">
                                                Pekerjaan Baru : '.$item['jumlah'].'
                                            </div>

                                        </div>
                                        <div class="portlet-body">
                                            <button class="btn btn-sm btn-danger" onClick="loadContentWithParams(\''.$summary.'\','.$str_params.');"> Lihat Detail </button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
        }

        $strOutput .= '<div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <hr>
                                <h4 class="font-blue" style="text-align:right;"> Jumlah Pekerjaan Tersedia : '.$total.'</h4>
                            </div>
                      </div>';

        echo $strOutput;
        exit;
    }

    public function summary_list() {
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $P_W_DOC_TYPE_ID = $ci->input->post('P_W_DOC_TYPE_ID');
        $user_name = $userinfo->username;
        $ELEMENT_ID = $ci->input->post('ELEMENT_ID');

        $items = $table->getSummaryList($P_W_DOC_TYPE_ID, $user_name);
        $strOutput = '<div class="portlet box blue-hoki">
                        <div class="portlet-title">
                            <div class="caption">Summary</div>
                            <div class="tools">
                                <a class="collapse" href="javascript:;" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body">';
        $strOutput .= '
                      <table class="table table-bordered table-hover" id="dynamic-table">
                        <thead>
                            <tr>
                                <th class="center"> Pekerjaan</th>
                                <th class="center" width="15"> Jumlah </th>
                                <th class="center"> Pilih </th>
                                <th style="display:none;"> Hidden Value </th>
                            </tr>
                        </thead>
                        ';

        $strOutput .= '<tbody>';


        $selected = '';
        $not_checked = true;
        foreach ($items as $item) {

            if($item['stype'] == 'PROFILE') {
                $strOutput .= '<tr>
                                    <td colspan="3"><strong class="font-green">'.$item['display_name'].'</strong></td>
                              </tr>';
            }else {

                if(!empty($ELEMENT_ID)) {
                    if( $ELEMENT_ID == $item['element_id']) {
                        $selected = 'checked=""';
                    }else {
                        $selected = '';
                    }
                }else {
                    if( $not_checked ) {
                        $selected = 'checked=""';
                        $not_checked = false;
                    }else {
                        $selected = '';
                    }
                }

                $strOutput .= '<tr>
                                    <td style="padding-left:35px;"><strong class="font-blue">'.$item['display_name'].'</strong></td>
                                    <td style="text-align:right;">'.$item['scount'].'</td>
                                    <td class="center"><input class="pointer radio-bigger" type="radio" '.$selected.' name="pilih_summary" value="'.$item['element_id'].'" onclick="loadUserTaskList(this, event);"></td>
                                    <td style="display:none;">
                                        <input type="hidden" id="'.$item['element_id'].'_p_w_doc_type_id" value="'.$item['p_w_doc_type_id'].'">
                                        <input type="hidden" id="'.$item['element_id'].'_p_w_proc_id" value="'.$item['p_w_proc_id'].'">
                                        <input type="hidden" id="'.$item['element_id'].'_profile_type" value="'.$item['profile_type'].'">
                                    </td>
                              </tr>';

            }
        }
        $strOutput .= '</tbody>';
        $strOutput .= '</table>';
        $strOutput .= '</div>';

        echo $strOutput;
        exit;
    }


    public function user_task_list() {

        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $p_w_doc_type_id = $ci->input->post('p_w_doc_type_id');
        $p_w_proc_id     = $ci->input->post('p_w_proc_id');
        $profile_type    = $ci->input->post('profile_type');
        $element_id      = $ci->input->post('element_id');
        $user_name       = $userinfo->username;

        $page = intval($ci->input->post('page')) ;
        $limit = $ci->input->post('limit');
        $sort = 'donor_date';
        $dir = 'desc';

        /* search parameter */
        $searchPhrase      = $ci->input->post('searchPhrase');
        $tgl_terima        = $ci->input->post('tgl_terima');

        if(empty($p_w_doc_type_id) || empty($p_w_proc_id) || empty($profile_type)) {
            $data = array();
            $data['total'] = 0;
            $data['contents'] = self::emptyTaskList();

            echo json_encode($data);
            exit;
        }

        $sql = "SELECT * FROM TABLE (PACK_TASK_PROFILE.USER_TASK_LIST (".$p_w_doc_type_id.",".$p_w_proc_id.",'".$profile_type."','".$user_name."',''))";
        $req_param = array (
            "table" => $sql,
            "sort_by" => $sort,
            "sord" => $dir,
            "limit" => null,
            "search" => ''
        );
        $req_param['where'] = array();
        if(!empty($searchPhrase)) {
             $req_param['where'][] = "(upper(keyword) LIKE upper('%".$searchPhrase."%'))";
        }

        if(!empty($tgl_terima)) {
            $req_param['where'][] = "trunc(donor_date) = nvl(to_date('".$tgl_terima."','YYYY-MM-DD'),trunc(donor_date))";
        }

        $count = $table->bootgrid_countAll($req_param);
        if( $count > 0 && !empty($limit) ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 1;
        }

        if ($page > $total_pages)
            $page = $total_pages;

        $start = $limit*$page - ($limit); // do not put $limit*($page - 1)

        $req_param['limit'] = array(
            'start' => $start,
            'end' => $limit
        );

        $items = $table->bootgrid_getData($req_param);
        $data = array();

        $data['total'] = $count;
        $data['contents'] = self::getTaskListHTML($items);

        echo json_encode($data);
        exit;
    }

    public function emptyTaskList() {
        return '<tr>
                    <td colspan="4" align="center"> Tidak ada data untuk ditampilkan </td>
                </tr>';
    }

    public function getTaskListHTML($items) {

        if(count($items) == 0) {
            return self::emptyTaskList();
        }
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();

        $user_id_login = $userinfo->id;

        $result  = '';
        foreach($items as $item) {
            $result .= '<tr>
                            <td colspan="4"> <span class="font-blue"><strong>'.$item['cust_info'].'</strong></span></td>
                        </tr>';

            $result .= '<tr>';

            $params = array();
            $file_name = str_replace("/","-",$item['filename']);
            $params['CURR_DOC_ID'] = intval($item['doc_id']);
            $params['CURR_DOC_TYPE_ID'] = intval($item['p_w_doc_type_id']);
            $params['CURR_PROC_ID'] = intval($item['p_w_proc_id']);
            $params['CURR_CTL_ID'] = intval($item['t_ctl_id']);
            $params['USER_ID_DOC'] = intval($item['p_app_user_id_donor']);
            $params['USER_ID_DONOR'] = intval($item['p_app_user_id_donor']);
            $params['USER_ID_LOGIN'] = intval($user_id_login);
            $params['USER_ID_TAKEN'] = intval($item['p_app_user_id_takeover']);
            $params['IS_CREATE_DOC'] = "N";
            $params['IS_MANUAL'] = "N";
            $params['CURR_PROC_STATUS'] = $item['proc_sts'];
            $params['CURR_DOC_STATUS'] = $item['doc_sts'];
            $params['PREV_DOC_ID'] = intval($item['prev_doc_id']);
            $params['PREV_DOC_TYPE_ID'] = intval($item['prev_doc_type_id']);
            $params['PREV_PROC_ID'] = intval($item['prev_proc_id']);
            $params['PREV_CTL_ID'] = intval($item['prev_ctl_id']);
            $params['SLOT_1'] = $item['slot_1'];
            $params['SLOT_2'] = $item['slot_2'];
            $params['SLOT_3'] = $item['slot_3'];
            $params['SLOT_4'] = $item['slot_4'];
            $params['SLOT_5'] = $item['slot_5'];
            $params['MESSAGE'] = $item['message'];

            if($item['profile_type'] != 'INBOX') {
                $params['ACTION_STATUS'] = "VIEW";
                $json_param = str_replace('"', "'", json_encode($params));
                $result .= '<td><button type="button" class="btn btn-sm btn-primary" onClick="loadWFForm(\''.$file_name.'\','.$json_param.')">View</button></td>';
            }else {
                if($item['is_read'] == 'N') {
                    $params['ACTION_STATUS'] = "TERIMA";
                    $json_param = str_replace('"', "'", json_encode($params));
                    $result .= '<td><button type="button" class="btn btn-sm btn-primary" onClick="loadWFForm(\''.$file_name.'\','.$json_param.')">Terima</button></td>';
                }else {
                    $params['ACTION_STATUS'] = "BUKA";
                    $json_param = str_replace('"', "'", json_encode($params));
                    $result .= '<td><button type="button" class="btn btn-sm btn-primary" onClick="loadWFForm(\''.$file_name.'\','.$json_param.')">Buka</button></td>';
                }
            }

            $result .= '<td>
                            <table class="table">
                                <tr>
                                    <td>Nama Pekerjaan</td>
                                    <td>:</td>
                                    <td colspan="2"><span class="red"><strong>'.$item['ltask'].'</strong></span></td>
                                </tr>
                                <tr>
                                    <td>Pengirim</td>
                                    <td>:</td>
                                    <td>'.$item['sender'].'</td>
                                    <td>'.$item['donor_date'].'</td>
                                </tr>
                                <tr>
                                    <td>Penerima</td>
                                    <td>:</td>
                                    <td>'.$item['recipient'].'</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Pengambil</td>
                                    <td>:</td>
                                    <td>'.$item['takeover'].'</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Submitter</td>
                                    <td>:</td>
                                    <td>'.$item['closer'].'</td>
                                    <td>'.$item['submit_date'].'</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>'.$item['proc_sts'].'</td>
                                    <td></td>
                                </tr>
                            </table>
                        </td>'; /* pekerjaan */
            $result .= '<td>
                            <table class="table">
                                <tr>
                                    <td>Nomor Permohonan</td>
                                    <td>:</td>
                                    <td>'.$item['doc_no'].'</td>
                                </tr>
                                <tr>
                                    <td>Periode</td>
                                    <td>:</td>
                                    <td>'.$item['period'].'</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Dibaca</td>
                                    <td>:</td>
                                    <td>'.$item['read_date'].'</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td>'.$item['doc_sts'].'</td>
                                </tr>
                            </table>
                        </td>'; /* dokumen */
            $result .= '<td>'.$item['message'].'</td>'; /* pesan */
            $result .= '</tr>';
        }

        return $result;
    }


    public function taken_task() {

        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;
        $userinfo = $ci->ion_auth->user()->row();

        $curr_ctl_id = $ci->input->post('curr_ctl_id');
        $curr_doc_type_id = $ci->input->post('curr_doc_type_id');
        $user_name = strtoupper($userinfo->username);

        $curr_doc_type_id = empty($curr_doc_type_id) ? NULL : $curr_doc_type_id;

        try {

            $sql = "  BEGIN ".
                    "  pack_task_profile.taken_task(:params1, :params2, :params3); END;";

            $params = array(
                array('name' => ':params1', 'value' => $curr_ctl_id, 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params2', 'value' => $user_name, 'type' => SQLT_CHR, 'length' => 100),
                array('name' => ':params3', 'value' => $curr_doc_type_id, 'type' => SQLT_INT, 'length' => 100)
            );
            // Bind the output parameter

            $stmt = oci_parse($table->db->conn_id,$sql);

            foreach($params as $p){
                // Bind Input
                oci_bind_by_name($stmt, $p['name'], $p['value'], $p['length']);
            }

            ociexecute($stmt);

            $data['success'] = true;
            $data['message'] = 'Taken Task Berhasil';
        }catch(Exception $e){
            $data['success'] = false;
            $data['message'] = 'Taken Task Gagal';
        }

        echo json_encode($data);
        exit;
    }


    public function submitter_submit() {

        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;
        $userinfo = $ci->ion_auth->user()->row();

        $o_submitter_id = null;
        $o_error_message = "";
        $o_result_msg = "";
        $o_warning = "";
        $user_id_login = $userinfo->id;

        /* posting from submit lov */
        $interactive_message = $ci->input->post('interactive_message');
        $submitter_params = json_decode($ci->input->post('params') , true);

        try {

            $sql = "select submitter_seq.nextval as seq from dual";
            $query = $table->db->query($sql);
            $row = $query->row_array();
            $o_submitter_id = $row['seq'];

            $submitter_params['USER_ID_DOC'] = empty($submitter_params['USER_ID_DOC']) ? NULL : $submitter_params['USER_ID_DOC'];
            $submitter_params['USER_ID_DONOR'] = empty($submitter_params['USER_ID_DONOR']) ? NULL : $submitter_params['USER_ID_DOC'];
            $submitter_params['USER_ID_TAKEN'] = empty($submitter_params['USER_ID_TAKEN']) ? $user_id_login : $submitter_params['USER_ID_TAKEN'];

            $submitter_params['CURR_CTL_ID'] = empty($submitter_params['CURR_CTL_ID']) ? NULL : $submitter_params['CURR_CTL_ID'];
            $submitter_params['CURR_DOC_TYPE_ID'] = empty($submitter_params['CURR_DOC_TYPE_ID']) ? NULL : $submitter_params['CURR_DOC_TYPE_ID'];
            $submitter_params['CURR_PROC_ID'] = empty($submitter_params['CURR_PROC_ID']) ? NULL : $submitter_params['CURR_PROC_ID'];
            $submitter_params['CURR_DOC_ID'] = empty($submitter_params['CURR_DOC_ID']) ? NULL : $submitter_params['CURR_DOC_ID'];

            $submitter_params['PREV_CTL_ID'] = empty($submitter_params['PREV_CTL_ID']) ? NULL : $submitter_params['PREV_CTL_ID'];
            $submitter_params['PREV_DOC_TYPE_ID'] = empty($submitter_params['PREV_DOC_TYPE_ID']) ? NULL : $submitter_params['PREV_DOC_TYPE_ID'];
            $submitter_params['PREV_PROC_ID'] = empty($submitter_params['PREV_PROC_ID']) ? NULL : $submitter_params['PREV_PROC_ID'];
            $submitter_params['PREV_DOC_ID'] = empty($submitter_params['PREV_DOC_ID']) ? NULL : $submitter_params['PREV_DOC_ID'];

            $str_params = "";
            define("TOTAL_PARAMS", 23);
            for($i = 1; $i <= TOTAL_PARAMS; $i++) {
                if($i == 1) $str_params .= ":params".$i;
                else $str_params .= ",:params".$i;
            }

            $sql = "  BEGIN ".
                        "  pack_workflow.submit_engine(".$str_params."); END;";

            $params = array(
                array('name' => ':params1', 'value' => $o_submitter_id, 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params2', 'value' => $submitter_params['IS_CREATE_DOC'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params3', 'value' => $submitter_params['IS_MANUAL'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params4', 'value' => $submitter_params['USER_ID_DOC'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params5', 'value' => $submitter_params['USER_ID_DONOR'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params6', 'value' => $user_id_login, 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params7', 'value' => $submitter_params['USER_ID_TAKEN'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params8', 'value' => $submitter_params['CURR_CTL_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params9', 'value' => $submitter_params['CURR_DOC_TYPE_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params10', 'value' => $submitter_params['CURR_PROC_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params11', 'value' => $submitter_params['CURR_DOC_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params12', 'value' => $submitter_params['CURR_DOC_STATUS'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params13', 'value' => $submitter_params['CURR_PROC_STATUS'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params14', 'value' => $submitter_params['PREV_CTL_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params15', 'value' => $submitter_params['PREV_DOC_TYPE_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params16', 'value' => $submitter_params['PREV_PROC_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params17', 'value' => $submitter_params['PREV_DOC_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params18', 'value' => $interactive_message, 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params19', 'value' => $submitter_params['SLOT_1'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params20', 'value' => $submitter_params['SLOT_2'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params21', 'value' => $submitter_params['SLOT_3'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params22', 'value' => $submitter_params['SLOT_4'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params23', 'value' => $submitter_params['SLOT_5'], 'type' => SQLT_CHR, 'length' => 500)
            );
            // Bind the output parameter

            //print_r($params);
            //exit;

            $stmt = oci_parse($table->db->conn_id,$sql);

            foreach($params as $p){
                // Bind Input
                oci_bind_by_name($stmt, $p['name'], $p['value'], $p['length']);
            }

            ociexecute($stmt);

            $sql_message = "select error_message, return_message, warning from submitter where submitter_id = ".$o_submitter_id;
            $query_message = $table->db->query($sql_message);
            $row_message = $query_message->row_array();

            $data = array();

            if($row_message['return_message'] != "0") {
                $data['submit_success'] = true;
                $row_message['return_message'] = "BERHASIL";
            }else {
                $data['submit_success'] = false;
                $row_message['return_message'] = "";
            }

            $data['success'] = true;
            $data['return_message'] = $row_message['return_message'];
            $data['error_message'] = $row_message['error_message'];
            $data['warning'] = $row_message['warning'];

        } catch( Exception $e ) {
            $data['success'] = false;
            $data['message'] = $e->getMessage();
        }

        echo json_encode($data);
        exit;
    }


    public function submitter_reject() {

        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;
        $userinfo = $ci->ion_auth->user()->row();

        $o_submitter_id = null;
        $o_error_message = "";
        $o_result_msg = "";
        $o_warning = "";
        $user_id_login = $userinfo->id;

        /* posting from submit lov */
        $interactive_message = $ci->input->post('interactive_message');
        $submitter_params = json_decode($ci->input->post('params') , true);

        try {

            $sql = "select submitter_seq.nextval as seq from dual";
            $query = $table->db->query($sql);
            $row = $query->row_array();
            $o_submitter_id = $row['seq'];

            $submitter_params['USER_ID_DOC'] = empty($submitter_params['USER_ID_DOC']) ? NULL : $submitter_params['USER_ID_DOC'];
            $submitter_params['USER_ID_DONOR'] = empty($submitter_params['USER_ID_DONOR']) ? NULL : $submitter_params['USER_ID_DOC'];
            $submitter_params['USER_ID_TAKEN'] = empty($submitter_params['USER_ID_TAKEN']) ? $user_id_login : $submitter_params['USER_ID_TAKEN'];

            $submitter_params['CURR_CTL_ID'] = empty($submitter_params['CURR_CTL_ID']) ? NULL : $submitter_params['CURR_CTL_ID'];
            $submitter_params['CURR_DOC_TYPE_ID'] = empty($submitter_params['CURR_DOC_TYPE_ID']) ? NULL : $submitter_params['CURR_DOC_TYPE_ID'];
            $submitter_params['CURR_PROC_ID'] = empty($submitter_params['CURR_PROC_ID']) ? NULL : $submitter_params['CURR_PROC_ID'];
            $submitter_params['CURR_DOC_ID'] = empty($submitter_params['CURR_DOC_ID']) ? NULL : $submitter_params['CURR_DOC_ID'];

            $submitter_params['PREV_CTL_ID'] = empty($submitter_params['PREV_CTL_ID']) ? NULL : $submitter_params['PREV_CTL_ID'];
            $submitter_params['PREV_DOC_TYPE_ID'] = empty($submitter_params['PREV_DOC_TYPE_ID']) ? NULL : $submitter_params['PREV_DOC_TYPE_ID'];
            $submitter_params['PREV_PROC_ID'] = empty($submitter_params['PREV_PROC_ID']) ? NULL : $submitter_params['PREV_PROC_ID'];
            $submitter_params['PREV_DOC_ID'] = empty($submitter_params['PREV_DOC_ID']) ? NULL : $submitter_params['PREV_DOC_ID'];

            $str_params = "";
            define("TOTAL_PARAMS", 23);
            for($i = 1; $i <= TOTAL_PARAMS; $i++) {
                if($i == 1) $str_params .= ":params".$i;
                else $str_params .= ",:params".$i;
            }

            $sql = "  BEGIN ".
                        "  pack_workflow.reject_engine(".$str_params."); END;";

            $params = array(
                array('name' => ':params1', 'value' => $o_submitter_id, 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params2', 'value' => $submitter_params['IS_CREATE_DOC'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params3', 'value' => $submitter_params['IS_MANUAL'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params4', 'value' => $submitter_params['USER_ID_DOC'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params5', 'value' => $submitter_params['USER_ID_DONOR'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params6', 'value' => $user_id_login, 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params7', 'value' => $submitter_params['USER_ID_TAKEN'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params8', 'value' => $submitter_params['CURR_CTL_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params9', 'value' => $submitter_params['CURR_DOC_TYPE_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params10', 'value' => $submitter_params['CURR_PROC_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params11', 'value' => $submitter_params['CURR_DOC_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params12', 'value' => $submitter_params['CURR_DOC_STATUS'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params13', 'value' => $submitter_params['CURR_PROC_STATUS'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params14', 'value' => $submitter_params['PREV_CTL_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params15', 'value' => $submitter_params['PREV_DOC_TYPE_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params16', 'value' => $submitter_params['PREV_PROC_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params17', 'value' => $submitter_params['PREV_DOC_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params18', 'value' => $interactive_message, 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params19', 'value' => $submitter_params['SLOT_1'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params20', 'value' => $submitter_params['SLOT_2'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params21', 'value' => $submitter_params['SLOT_3'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params22', 'value' => $submitter_params['SLOT_4'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params23', 'value' => $submitter_params['SLOT_5'], 'type' => SQLT_CHR, 'length' => 500)
            );
            // Bind the output parameter

            $stmt = oci_parse($table->db->conn_id,$sql);

            foreach($params as $p){
                // Bind Input
                oci_bind_by_name($stmt, $p['name'], $p['value'], $p['length']);
            }

            ociexecute($stmt);

            $sql_message = "select error_message, return_message, warning from submitter where submitter_id = ".$o_submitter_id;
            $query_message = $table->db->query($sql_message);
            $row_message = $query_message->row_array();

            $data = array();

            if($row_message['return_message'] != "0") {
                $data['submit_success'] = true;
                $row_message['return_message'] = "BERHASIL";
            }else {
                $data['submit_success'] = false;
                $row_message['return_message'] = "";
            }

            $data['success'] = true;
            $data['return_message'] = $row_message['return_message'];
            $data['error_message'] = $row_message['error_message'];
            $data['warning'] = $row_message['warning'];

        } catch( Exception $e ) {
            $data['success'] = false;
            $data['message'] = $e->getMessage();
        }

        echo json_encode($data);
        exit;
    }


    public function submitter_back() {

        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;
        $userinfo = $ci->ion_auth->user()->row();

        $o_submitter_id = null;
        $o_error_message = "";
        $o_result_msg = "";
        $o_warning = "";
        $user_id_login = $userinfo->id;

        /* posting from submit lov */
        $interactive_message = $ci->input->post('interactive_message');
        $submitter_params = json_decode($ci->input->post('params') , true);

        try {

            $sql = "select submitter_seq.nextval as seq from dual";
            $query = $table->db->query($sql);
            $row = $query->row_array();
            $o_submitter_id = $row['seq'];

            $submitter_params['USER_ID_DOC'] = empty($submitter_params['USER_ID_DOC']) ? NULL : $submitter_params['USER_ID_DOC'];
            $submitter_params['USER_ID_DONOR'] = empty($submitter_params['USER_ID_DONOR']) ? NULL : $submitter_params['USER_ID_DOC'];
            $submitter_params['USER_ID_TAKEN'] = empty($submitter_params['USER_ID_TAKEN']) ? $user_id_login : $submitter_params['USER_ID_TAKEN'];

            $submitter_params['CURR_CTL_ID'] = empty($submitter_params['CURR_CTL_ID']) ? NULL : $submitter_params['CURR_CTL_ID'];
            $submitter_params['CURR_DOC_TYPE_ID'] = empty($submitter_params['CURR_DOC_TYPE_ID']) ? NULL : $submitter_params['CURR_DOC_TYPE_ID'];
            $submitter_params['CURR_PROC_ID'] = empty($submitter_params['CURR_PROC_ID']) ? NULL : $submitter_params['CURR_PROC_ID'];
            $submitter_params['CURR_DOC_ID'] = empty($submitter_params['CURR_DOC_ID']) ? NULL : $submitter_params['CURR_DOC_ID'];

            $submitter_params['PREV_CTL_ID'] = empty($submitter_params['PREV_CTL_ID']) ? NULL : $submitter_params['PREV_CTL_ID'];
            $submitter_params['PREV_DOC_TYPE_ID'] = empty($submitter_params['PREV_DOC_TYPE_ID']) ? NULL : $submitter_params['PREV_DOC_TYPE_ID'];
            $submitter_params['PREV_PROC_ID'] = empty($submitter_params['PREV_PROC_ID']) ? NULL : $submitter_params['PREV_PROC_ID'];
            $submitter_params['PREV_DOC_ID'] = empty($submitter_params['PREV_DOC_ID']) ? NULL : $submitter_params['PREV_DOC_ID'];

            $str_params = "";
            define("TOTAL_PARAMS", 23);
            for($i = 1; $i <= TOTAL_PARAMS; $i++) {
                if($i == 1) $str_params .= ":params".$i;
                else $str_params .= ",:params".$i;
            }

            $sql = "  BEGIN ".
                        "  pack_workflow.back_engine(".$str_params."); END;";

            $params = array(
                array('name' => ':params1', 'value' => $o_submitter_id, 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params2', 'value' => $submitter_params['IS_CREATE_DOC'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params3', 'value' => $submitter_params['IS_MANUAL'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params4', 'value' => $submitter_params['USER_ID_DOC'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params5', 'value' => $submitter_params['USER_ID_DONOR'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params6', 'value' => $user_id_login, 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params7', 'value' => $submitter_params['USER_ID_TAKEN'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params8', 'value' => $submitter_params['CURR_CTL_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params9', 'value' => $submitter_params['CURR_DOC_TYPE_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params10', 'value' => $submitter_params['CURR_PROC_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params11', 'value' => $submitter_params['CURR_DOC_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params12', 'value' => $submitter_params['CURR_DOC_STATUS'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params13', 'value' => $submitter_params['CURR_PROC_STATUS'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params14', 'value' => $submitter_params['PREV_CTL_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params15', 'value' => $submitter_params['PREV_DOC_TYPE_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params16', 'value' => $submitter_params['PREV_PROC_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params17', 'value' => $submitter_params['PREV_DOC_ID'], 'type' => SQLT_INT, 'length' => 100),
                array('name' => ':params18', 'value' => $interactive_message, 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params19', 'value' => $submitter_params['SLOT_1'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params20', 'value' => $submitter_params['SLOT_2'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params21', 'value' => $submitter_params['SLOT_3'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params22', 'value' => $submitter_params['SLOT_4'], 'type' => SQLT_CHR, 'length' => 500),
                array('name' => ':params23', 'value' => $submitter_params['SLOT_5'], 'type' => SQLT_CHR, 'length' => 500)
            );
            // Bind the output parameter

            $stmt = oci_parse($table->db->conn_id,$sql);

            foreach($params as $p){
                // Bind Input
                oci_bind_by_name($stmt, $p['name'], $p['value'], $p['length']);
            }

            ociexecute($stmt);

            $sql_message = "select error_message, return_message, warning from submitter where submitter_id = ".$o_submitter_id;
            $query_message = $table->db->query($sql_message);
            $row_message = $query_message->row_array();

            $data = array();

            if($row_message['return_message'] != "0") {
                $data['submit_success'] = true;
                $row_message['return_message'] = "BERHASIL";
            }else {
                $data['submit_success'] = false;
                $row_message['return_message'] = "";
            }

            $data['success'] = true;
            $data['return_message'] = $row_message['return_message'];
            $data['error_message'] = $row_message['error_message'];
            $data['warning'] = $row_message['warning'];

        } catch( Exception $e ) {
            $data['success'] = false;
            $data['message'] = $e->getMessage();
        }

        echo json_encode($data);
        exit;
    }


    public function pekerjaan_tersedia() {

        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;


        $curr_proc_id = $ci->input->post('curr_proc_id');
        $curr_doc_type_id = $ci->input->post('curr_doc_type_id');

        $sql = "select f_get_next_info(".$curr_proc_id.",".$curr_doc_type_id.")as task from dual";
        $query = $table->db->query($sql);
        $row = $query->row_array();

        $data = array();
        $data['task'] = $row['task'];

        echo json_encode($data);
        exit;
    }


    public function status_dokumen_workflow() {

        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $sql = "select * from v_document_workflow_status";
        $query = $table->db->query($sql);

        $items = $query->result_array();
        $opt_status = '';

        foreach ($items as $item) {
            $opt_status .= '<option value="'.$item['p_status_list_id'].'"> '.$item['code'].' </option>';
        }

        echo json_encode( array('opt_status' => $opt_status ) );
        exit;
    }

    public function grid_customer_order() {

        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;
        $t_customer_order_id = $ci->input->post('t_customer_order_id');
        $p_w_proc_id = $ci->input->post('p_w_proc_id');

        $sql = "SELECT a.*, to_char(a.start_dat,'yyyy-mm-dd') as start_date, to_char(a.end_dat,'yyyy-mm-dd') as end_date FROM v_wf_create_schema a WHERE t_customer_order_id = ".$t_customer_order_id." AND p_w_proc_id = ".$p_w_proc_id;
        $query = $table->db->query($sql);

        $items = $query->result_array();

        echo json_encode( $items );
        exit;
    }

    public function doc_type() {
        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $sql = "select * from p_legal_doc_type";
        $query = $table->db->query($sql);

        $items = $query->result_array();
        $opt_status = '';

        foreach ($items as $item) {
            $opt_status .= '<option value="'.$item['p_legal_doc_type_id'].'"> '.$item['code'].' </option>';
        }

        echo json_encode( array('opt_status' => $opt_status ) );
        exit;
    }

    public function getLogKronologi(){
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $page = intval($ci->input->post('current')) ;
        $limit = $ci->input->post('rowCount');
        $sort = $ci->input->post('sort');
        $dir = $ci->input->post('dir');

        $result = array();
        $query = $table->db->query("SELECT * FROM v_t_nwo_log_kronologis WHERE T_CUSTOMER_ORDER_ID = ".$ci->input->post('t_customer_order_id')." ");

        if($query->num_rows() > 0)
            $result = $query->result_array();


        if ($page == 0) {
            $hasil['current'] = 1;
        } else {
            $hasil['current'] = $page;
        }

        $hasil['total'] = count($result);
        $hasil['rowCount'] = $limit;
        $hasil['success'] = true;
        $hasil['message'] = 'Berhasil';
        $hasil['rows'] = $result;

        echo(json_encode($hasil));
        exit;
    }

    public function save_log(){
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $log_params = json_decode($ci->input->post('params') , true);
        $CREATED_BY = $userinfo->username;
        $UPDATED_BY = $userinfo->username;
        $log_params['CURR_DOC_ID'] = empty($log_params['CURR_DOC_ID']) ? NULL : $log_params['CURR_DOC_ID'];
        $log_params['USER_ID_LOGIN'] = empty($log_params['USER_ID_LOGIN']) ? NULL : $log_params['USER_ID_LOGIN'];

        try {

            $sql = "INSERT INTO T_ORDER_LOG_KRONOLOGIS(  DESCRIPTION,
                                                         CREATE_DATE,
                                                         UPDATE_DATE,
                                                         ACTIVITY,
                                                         CREATE_BY,
                                                         UPDATE_BY,
                                                         COUNTER_NO,
                                                         T_CUSTOMER_ORDER_ID,
                                                         P_APP_USER_ID,
                                                         EMPLOYEE_NO,
                                                         LOG_DATE,
                                                         P_PROCEDURE_ID,
                                                         INPUT_TYPE )
                                                VALUES(  '".$ci->input->post('desc_log')."',
                                                         SYSDATE,
                                                         SYSDATE,
                                                         '".$ci->input->post('activity')."',
                                                         '".$CREATED_BY."',
                                                         '".$UPDATED_BY."',
                                                         (SELECT NVL(MAX(COUNTER_NO),0)+1 FROM T_ORDER_LOG_KRONOLOGIS WHERE T_CUSTOMER_ORDER_ID=".$log_params['CURR_DOC_ID']."),
                                                         ".$log_params['CURR_DOC_ID'].",
                                                         ".$log_params['USER_ID_LOGIN'].",
                                                         NULL,
                                                         SYSDATE,
                                                         ".$log_params['CURR_PROC_ID'].",
                                                         'M'
                                                )";

            $table->db->query($sql);

            $result['success'] = true;
            $result['message'] = 'Log Kronologis Berhasil Ditambah';

        }catch(Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

         echo json_encode($result);
         exit;
    }

    public function getLegalDoc(){
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $page = intval($ci->input->post('current')) ;
        $limit = $ci->input->post('rowCount');
        $sort = $ci->input->post('sort');
        $dir = $ci->input->post('dir');

        $result = array();
        $query = $table->db->query("SELECT a.*, b.CODE as LEGAL_DOC_DESC FROM t_cust_order_legal_doc a
                                 LEFT JOIN p_legal_doc_type b ON a.P_LEGAL_DOC_TYPE_ID = b.P_LEGAL_DOC_TYPE_ID
                                 WHERE a.T_CUSTOMER_ORDER_ID = ".$ci->input->post('t_customer_order_id')." ");
        if($query->num_rows() > 0)
            $result = $query->result_array();


        if ($page == 0) {
            $hasil['current'] = 1;
        } else {
            $hasil['current'] = $page;
        }

        $hasil['total'] = count($result);
        $hasil['rowCount'] = $limit;
        $hasil['success'] = true;
        $hasil['message'] = 'Berhasil';
        $hasil['rows'] = $result;

        echo(json_encode($hasil));
        exit;
    }

    public function save_legaldoc(){
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $params = json_decode($ci->input->post('legaldoc_params') , true);
        $CREATED_BY = $userinfo->username;
        $UPDATED_BY = $userinfo->username;
        $log_params['CURR_DOC_ID'] = empty($log_params['CURR_DOC_ID']) ? NULL : $log_params['CURR_DOC_ID'];

        try {

            $config['upload_path'] = './application/third_party/upload_file';
            $config['allowed_types'] = '*';
            $config['max_size'] = '10000000';
            $config['overwrite'] = TRUE;
            $file_id = date("YmdHis");
            $config['file_name'] = "wf_" . $file_id;

            $ci->load->library('upload');
            $ci->upload->initialize($config);

            if (!$ci->upload->do_upload("filename")) {

                $error = $ci->upload->display_errors();
                $result['success'] = false;
                $result['message'] = $error;

                echo json_encode($result);
                exit;
            }else{

                //chmod

                // Do Upload
                $data = $ci->upload->data();

                $idd = $table->generate_id('T_CUST_ORDER_LEGAL_DOC');

                $sql = "INSERT INTO T_CUST_ORDER_LEGAL_DOC(T_CUST_ORDER_LEGAL_DOC_ID,
                                                           DESCRIPTION,
                                                           CREATED_BY,
                                                           UPDATED_BY,
                                                           CREATION_DATE,
                                                           UPDATED_DATE,
                                                           P_LEGAL_DOC_TYPE_ID,
                                                           T_CUSTOMER_ORDER_ID,
                                                           ORIGIN_FILE_NAME,
                                                           FILE_FOLDER,
                                                           FILE_NAME)
                            VALUES (".$idd.",
                                    '".$ci->input->post('desc')."',
                                    '".$CREATED_BY."',
                                    '".$UPDATED_BY."',
                                    SYSDATE,
                                    SYSDATE,
                                    ".$ci->input->post('p_legal_doc_type_id').",
                                    ".$params['CURR_DOC_ID'].",
                                    '".$data['client_name']."',
                                    'application/third_party/upload_file',
                                    '".$data['file_name']."'
                                    )";

                $table->db->query($sql);


                $result['success'] = true;
                $result['message'] = 'Dokumen Pendukung Berhasil Ditambah';

            }

        }catch(Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        echo json_encode($result);
        exit;
    }

    public function delete_legaldoc(){
        $ci =& get_instance();
        $userinfo = $ci->ion_auth->user()->row();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        try {

            $id_ = $ci->input->post('t_cust_order_legal_doc_id');
            $table->db->where('T_CUST_ORDER_LEGAL_DOC_ID', $id_);
            $table->db->delete('T_CUST_ORDER_LEGAL_DOC');

            $result['success'] = true;
            $result['message'] = 'Dokumen Pendukung Berhasil Dihapus';

        } catch (Exception $e) {
            $result['success'] = false;
            $result['message'] = $e->getMessage();
        }

        echo json_encode($result);
        exit;
    }

    public function workflow_list() {
        $ci =& get_instance();
        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $sql = "select * from p_workflow";
        $query = $table->db->query($sql);

        $items = $query->result_array();
        $opt_status = '';

        foreach ($items as $item) {
            $opt_status .= '<option value="'.$item['p_workflow_id'].'"> '.$item['display_name'].' </option>';
        }

        echo json_encode( array('opt_status' => $opt_status ) );
        exit;
    }

}

/* End of file Groups_controller.php */