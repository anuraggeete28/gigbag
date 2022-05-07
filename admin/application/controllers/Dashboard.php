<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    private $_user;

    public function __construct() {

        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        // Load database
        $this->load->model('authentication');
        $this->load->model('Dashboard_model');

        // Load helper
       // $this->load->helper('webuser');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }


    }

    public function index() {



             $data["userCount"] = $this->Dashboard_model->userCount()->count;
             $data["liveTvCOunt"] = $this->Dashboard_model->mediaCount("2")->count;
             $data["movieCount"] = $this->Dashboard_model->mediaCount("1")->count;
             $data["radioCount"] = $this->Dashboard_model->mediaCount("3")->count;
             $data["topMovie"] = $this->Dashboard_model->topMedia("1");
             $data["topLiveTv"] = $this->Dashboard_model->topMedia("2");
             $data["topRadio"] = $this->Dashboard_model->topMedia("3");

        $data['currentPage'] = "dashboard";

          $this->load->view('dashboard',$data);
            

       
    }

}
