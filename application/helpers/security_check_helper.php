<?php

function check_login($ws = '') {
	$ci =& get_instance();

	if(!$ci->ion_auth->logged_in()) {
		if($ci->input->is_ajax_request()) { //request from Web Service (ws.php)
			throw new Exception('Sorry, Your login session has been expired. <br/> Please <a href="'.base_url().'auth/index">Login</a> first so that You can access this page. Thank You');
		}else {
			redirect('auth/index');
		}
	}
	return true;
}

function permission_check($permission_name='') {

    if(empty($permission_name)) return;

    $ci =& get_instance();
    $user = $ci->ion_auth->user()->row();

    $sql = "SELECT gp.status
                FROM groups_permissions gp
                LEFT JOIN permissions pr ON gp.permission_id = pr.permission_id
                WHERE pr.permission_name = '".$permission_name."'
                AND group_id IN (
                    SELECT group_id FROM users_groups
                    WHERE user_id = ".$user->id.")";

    $ci->load->model('administration/permissions');
    $query = $ci->permissions->db->query($sql);
    $row = $query->row_array();

    if( empty($row) or $row['status'] == 'N') {
        if($ci->input->is_ajax_request()) { //request from Web Service (ws.php)
            header('Content-Type: application/json');
            echo json_encode(array('success' => false,
                                    'message' => 'We\'re sorry. You don\'t have permission to access this page'));
            exit;
        }else {
            $ci->load->view('error_401');
        }
    }

}

?>