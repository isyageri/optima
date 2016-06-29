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
            $summary = str_replace("/", "-", $url_arr[0]);
            $str_params = $url_arr[1];

            $total += $item['jumlah'];
            $strOutput .= '<div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="portlet box blue-hoki">
                                        <div class="portlet-title">
                                            <div class="caption">'.$item['profile_type'].'</div>
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
                            <div class="col-xs-12 col-sm-5">
                                <hr style="border:width:2px 0 0;">
                                <h4 class="blue" style="text-align:right;"> Jumlah Pekerjaan Tersedia : '.$total.'</h4>
                            </div>
                      </div>';

        echo $strOutput;
        exit;
    }
}

/* End of file Groups_controller.php */