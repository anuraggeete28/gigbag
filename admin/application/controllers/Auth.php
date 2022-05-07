<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load form validation library
        //$this->load->library('form_validation');
        // Load database
          $this->load->model('UserModel');
          //$this->load->library('session');
          //$this->load->helper('security');



    }

    public function index() {
        $this->load->view('forgotpassword');
    }
	 
	


public function forgetPassword()
	{
		$data['page_title'] = "Forgot Password";
		
		if($this->input->post('submit') !== null) {

			$email= trim($this->input->post('email'));
	  		
		  	$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		  	
	  		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	  		/*$this->form_validation->set_message('required', 'Enter %s');*/
	 
	  		if ($this->form_validation->run() != FALSE) {

	  			$query = $this->UserModel->checkUser($email);

	   			if(isset($query) && !empty($query)) {

	    			$newPassword = $this->UserModel->resetPasswordd($email);
	    			
	    			/* Send Email */
	    			$to = $email;
					$subject = "Forgot Password";
					$txt = "Your new password is ".$newPassword;
					$headers = "From: info@lawflu.com";

					mail($to,$subject,$txt,$headers);

					$this->session->set_flashdata('success_msg', 'New password has been sent your registered Email.');
	   			} else {
	   				$this->session->set_flashdata('error_msg', 'Invalid Email.');
	   			}
	  		}
		}

		//$this->load->view('admin/includes/header',$data);
		//$this->load->view('admin/forget_password');
		
	}


}
