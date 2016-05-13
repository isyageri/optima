<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'language'));
    }

    function index() {
        check_login();

        $this->load->model('administration/groups');
        $this->load->view('home/index');
    }
}