<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        // Load database
        $this->load->model('Authentication');
        $this->load->library('session');
        $this->load->helper('security');


    }

    public function index() {
          //$this->load->view('welcome_message');
        $gigbag_login=$this->session->userdata('gigbag_login');

        if (!empty($gigbag_login)) 
        {
            redirect('Dashboard');
            
        }
        $this->load->view('login');
    }

    public function do_login() {
        try {
            $this->form_validation->set_rules('username', 'email', 'trim|required|valid_email|xss_clean', array('required'=>'Email Is Empty','valid_email' => 'Incorrect email id. Please try again.'));
            $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean',array('required'=>'Password Is Empty'));

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'email' => $this->input->post('username'),
                    'password' => $this->input->post('password')
                );
                $result = $this->Authentication->login($data);

                if ($result == TRUE) {
                    $this->session->set_userdata('gigbag_login',true);
                    $this->session->set_userdata('user_data',$result);
                     redirect('Dashboard');
                    
                } else {
                    $data = array(
                        'status' => 'danger',
                        'msg' => 'Please enter valid email or password.',
                      );
                    $this->session->set_flashdata('message', $data);
                      redirect('Login');
                }
            } else {
                if($this->input->post('username') == ""){
                    $this->session->set_flashdata('errors_msg', 'Please enter email address');
                    $this->load->view('login');
                }elseif($this->input->post('password') == ""){
                   $data = array(
                        'status' => 'danger',
                        'msg' => 'Please enter password.',
                      );
                    $this->session->set_flashdata('message', $data);
                    $this->load->view('login');
                }else{
                     $data = array(
                        'status' => 'danger',
                        'msg' => 'Please enter valid email or password.',
                      );
                    $this->session->set_flashdata('message', $data);
                   // echo "<script>alert('Please enter valid email or password.');</script>";
                     redirect('login');
                    $this->load->view('login');
                }
                
            }
        } catch (Exception $ex) {
            echo $ex->getMessage() . $ex->getLine();
            die;
        }
    }

    public function logout() {
        $this->session->unset_userdata('user');
        $this->session->sess_destroy();
        redirect('Login');
    }

}
