<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpass extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        // Load database
          $this->load->model('UserModel');
          //$this->load->library('session');
          $this->load->helper('security');



    }

    public function index() {
        $this->load->view('forgotpass');
    }
    public function reset_password($code) {
    	if (empty($code)) {
    		$data = array(
	            'status' => 'danger',
	            'msg' => 'Invalid Url',
	          );
    		$this->session->set_flashdata('message', $data);
      		redirect(base_url());
    	}
    	else
    	{
    		$data = $this->UserModel->check_reset_code($code);
    		if (empty($data)) {
    			$data = array(
		            'status' => 'danger',
		            'msg' => 'Invalid Url',
		          );
	    		$this->session->set_flashdata('message', $data);
	      		redirect(base_url(''));
    		}
    		else
    		{
    			$this->load->view('reset_password',$data);
    		}
    	}
      
    }
	 
	


public function resetpass()
	{
		$data['page_title'] = "Forgot Password";
		
		if($this->input->post('submit') !== null) {

			$email= trim($this->input->post('email'));
	  		
		  	$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		  	
	  		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	 
	  		if ($this->form_validation->run() != FALSE) {

	  			$query = $this->UserModel->Checkadmin($email);
	   			if(isset($query) && !empty($query)) {
	    			$send_email = $this->UserModel->Send_link_to_email($query);
	    			if (!empty($send_email)) {
	    				$data = array(
			            'status' => 'success',
			            'msg' => 'Password Reset Link has been sent to you email',
			          );
		    		}
		    		else
		    		{
		    			$data = array(
			            'status' => 'danger',
			            'msg' => 'Email not sent',
			          );
		    		}
	    			
	    			/* Send Email */
					
	   			} else {
	   			    
	   			  $data = array(
		            'status' => 'danger',
		            'msg' => 'Email not registered',
		          );
	   			}
	   			$this->session->set_flashdata('message', $data);
	   			redirect(base_url());
	  		}
		}

		$this->load->view('forgotpassword');
		
	}

	public function change_password()
	{
		$post = $this->input->post();
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('id', 'Id', 'trim|required');
         $this->form_validation->set_rules('reset_code', 'Reset Code', 'trim|required');
        if (!$this->form_validation->run()) 
        {
            $validation_errors = $this->form_validation->error_array();
	        $errors= array_values( $validation_errors);
			$data = array(
	            'status' => 'danger',
	            'msg' => $errors[0],
	          );
        }
        else
        {
        	$check_admin=$this->UserModel->validate_reset_password($post);
        	if (empty($check_admin)) 
	        {
	           $data = array(
		            'status' => 'danger',
		            'msg' => 'Invalid Request',
		         );
	        } 
	        else
	        {
	        	$update = $this->UserModel->updateData('tbl_admin', array('password'=>$post['password'],'reset_code'=>''),array('id'=>$post['id']));
	        	 if (empty($update)) 
		        {
		           $data = array(
			            'status' => 'danger',
			            'msg' => 'Password Not updated',
			         );
		        }
		        else
		        {
		        	$data = array(
			            'status' => 'success',
			            'msg' => 'Password updated Successfully',
			         );
		        }
	        }
        }
        $this->session->set_flashdata('message', $data);
	   	redirect(base_url());
    
	}


}
