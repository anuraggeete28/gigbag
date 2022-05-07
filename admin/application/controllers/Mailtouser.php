<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mailtouser extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('General_model');
        $this->load->model('Customer_regis_model');
          $this->load->library('session');
          $this->load->helper('security');

    }

    public function index() {
        $this->load->view('student/radio-list');
    }
    

    public function Apply(){

            $usertype=$this->input->post('usertype');  
      $username=$this->input->post('username');
      $email=$this->input->post('email');
      $address=$this->input->post('address');
      $country_code=$this->input->post('country_code');
      $state=$this->input->post('state_id');
      $country=$this->input->post('country_id');
      $mobile=$this->input->post('mobile');
      $signup_date = date('d-m-Y');
      $guardian=$this->input->post('guardian');
      $dob=$this->input->post('dob');
      $category_id=$this->input->post('subcatname');
      $subcat_id=$this->input->post('subcat_id');
      $source=$this->input->post('source');
      $referal=$this->input->post('referal');
      $password=$this->input->post('password');
      $confpassword=$this->input->post('confpassword');
      $policy=$this->input->post('policy');
      $unique_id = "S".rand(10000000,99999999);
      $radio_id = $this->input->post('radioID');
     
      $insertdata=array(
        'usertype'=>$usertype,
        'username'=>$username,
        'email'=>$email,
        'address'=>$address,
        'country_code'=>$country_code,
        'state_id'=>$state,
        'country_id'=>$country,
        'mobile'=>$mobile,
        'signup_date'=>$signup_date,
        'guardian'=>$guardian,
        'dob'=>$dob,
        'subcatname'=> $category_id,
        'subcat_id'=>$subcat_id,
        'source'=>$source,
        'referal'=>$referal,
        'password'=>$password,
        'confpassword'=>$confpassword,
        'policy'=>$policy,
        'unique_id'=>$unique_id
         );
       
                    $email_check=$this->Customer_regis_model->email_check($insertdata['email']);
                    $mobile_check=$this->Customer_regis_model->studentmochk($insertdata['mobile']);
                    $to = $email;
					$subject = "Registration successfull On Gigbag!!";
					$txt = "Account Details are given below :". "\n";
					$txt .= "Name - ".$username. "\n";
					$txt .= "Address - ".$address. "\n";
					$txt .= "Email -  ".$email. "\n";
					$txt .= "Mobile - ".$mobile. "\n";
					$txt .= "Password - ".$password. "\n";
					$txt .= "Date - ".date('d-m-y'). "\n";
					
					$headers = "From: jaideep.kirad@winworldtechs.com";

					mail($to,$subject,$txt,$headers);
					
					$to = "jaideep.kirad@winworldtechs.com";
					$subject = "Registration On Gigbag - $username !!";
					$txt = "Account Details are given below :". "\n";
				    $txt .= "Name - ".$username. "\n";
					$txt .= "Address - ".$address. "\n";
					$txt .= "Email -  ".$email. "\n";
					$txt .= "Mobile - ".$mobile. "\n";
					$txt .= "Password - ".$password. "\n";
					$txt .= "Date - ".date('d-m-y'). "\n";
					
					$headers = "From: jaideep.kirad@winworldtechs.com";

					mail($to,$subject,$txt,$headers);

if($email_check & $mobile_check){
  $this-> Customer_regis_model->register_user($insertdata);
  //$this->session->set_flashdata('success_msg', 'Registered successfully.');
  
  echo "<script>alert('Registered successfully.'); window.location.href='https://gigbag.winworldtechs.com/admin/Student/';</script>";

}
else{

 $filterD['studentid'] =  $radio_id;
        $this->General_model->update('student', $filterD,$insertdata);
        $radioID = $radio_id;
  $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
  
  echo "<script>alert('Email Or Mobile allready regsitered  or Data updated successfully !!'); window.location.href='https://gigbag.winworldtechs.com/admin/Student/';</script>";

}

}
    
   public function user_logout(){

  $this->session->sess_destroy();
  redirect('Login', 'refresh');
} 
    
    
    
}
    ?>