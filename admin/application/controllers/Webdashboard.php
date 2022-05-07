<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Webdashboard extends CI_Controller {

    private $_user;

    public function __construct() {

        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        // Load database
        $this->load->model('authentication');
        $this->load->model('Dashboard_model');

        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }


    }

    public function index() {

        $data['currentPage'] = "webdashboard";

          $this->load->view('webdashboard',$data);
            

       
    }

}
