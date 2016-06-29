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
                                <h4 class="blue" style="text-align:right;"> Jumlah Pekerjaan Tersedia : '.$total.'</h4>
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
                                    <td colspan="3"><strong class="blue">'.$item['display_name'].'</strong></td>
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
                                    <td style="padding-left:35px;"><strong class="green">'.$item['display_name'].'</strong></td>
                                    <td style="text-align:right;">'.$item['scount'].'</td>
                                    <td class="center"><input class="pointer radio-bigger" type="radio" '.$selected.' name="pilih_summary" value="'.$item['element_id'].'" onclick="loadUserTaskList(this);"></td>
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

        $sql = "select * from table (pack_task_profile.user_task_list (".$p_w_doc_type_id.",".$p_w_proc_id.",'".$profile_type."','".$user_name."',''))";
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
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;
        $start = $limit*$page - ($limit-1); // do not put $limit*($page - 1)

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
                            <td colspan="4"> <span class="green"><strong>'.$item['cust_info'].'</strong></span></td>
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

        $ci->load->model('workflow/wf');
        $table = $ci->wf;

        $curr_ctl_id = $ci->input->post('curr_ctl_id');
        $curr_doc_type_id = $ci->input->post('curr_doc_type_id');
        $user_name = strtoupper($ci->session->userdata("d_user_name"));

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
}

/* End of file Groups_controller.php */