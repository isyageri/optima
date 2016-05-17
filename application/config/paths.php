<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| PATHS
| -------------------------------------------------------------------
|
*/
$ci = & get_instance();
$ci->load->helper('url');

$config['WS_JQGRID'] = define('WS_JQGRID',base_url().'ws/json_jqgrid/');

/* End of file autoload.php */
/* Location: ./application/config/paths.php */