<?php

function check_login($ws = '') {
	$ci =& get_instance();

	if(!$ci->ion_auth->logged_in()) {
		if(!empty($ws)) { //request from Web Service (ws.php)
			throw new Exception('Sorry, Your login session has been expired. <br/> Please <a href="'.BASE_URL.'base/index">Login</a> first so that You can access this page. Thank You');
		}else {
			redirect('auth/index');
		}
	}
	return true;
}

function check_permission($module_name, $privileges) {

}

?>