<?php
error_reporting(0);

defined('BASEPATH') OR exit('No direct script access allowed');

class Mailtocoach extends CI_Controller {

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
      $category_id=$this->input->post('subcatname');
      $subcat_id=$this->input->post('subcat_id');
      $email=$this->input->post('email');
      $address=$this->input->post('address');
      $country_code=$this->input->post('country_code');
      $teacher_phone=$this->input->post('mobile');
      $dob=$this->input->post('dob');
      $source=$this->input->post('source');
      $name_in_bank_account=$this->input->post('name_in_bank_account');
      $bankname=$this->input->post('bankname');
      $branch_name=$this->input->post('branch_name');
      $account_number=$this->input->post('account_number');
      $ifsc_code=$this->input->post('ifsc_code');
      $induction_date=$this->input->post('induction_date');
      $teacher_registered = date('d-m-Y');
      $password=$this->input->post('password');
      $confpassword=$this->input->post('confpassword');
      $policy=$this->input->post('policy');
      $unique_id = "C".rand(10000000,99999999);
      $radio_id = $this->input->post('radioID');
     
      $insertdata=array(
        'usertype'=>$usertype,
        'username'=>$username,
        'subcatname'=> $category_id,
        'subcat_id'=>$subcat_id,
        'email'=>$email,
        'address'=>$address,
        'country_code'=>$country_code,
        'mobile'=>$teacher_phone,
        'dob'=>$dob,
        'source'=>$source,
        'name_in_bank_account'=>$name_in_bank_account,
        'bankname'=>$bankname,
        'branch_name'=>$branch_name,
        'account_number'=>$account_number,
        'ifsc_code'=>$ifsc_code,
        'induction_date'=>$induction_date,
        'signup_date'=>$teacher_registered,
        'password'=>$password,
        'confpassword'=>$confpassword,
        'policy'=>$policy,
        'unique_id'=>$unique_id
         );
       
          $email_check=$this->Customer_regis_model->email_check($insertdata['email']);
          $mobile_check=$this->Customer_regis_model->mobile_check($insertdata['mobile']);
          $to = $email;
					$subject = "Coach Registration successfull On Gigbag!!";
					$txt = "Account Details are given below :". "\n";
					$txt .= "Name - ".$username. "\n";
					$txt .= "Address - ".$address. "\n";
					$txt .= "Email -  ".$email. "\n";
					$txt .= "Mobile - ".$teacher_phone. "\n";
					$txt .= "Password - ".$password. "\n";
					$txt .= "Date - ".date('d-m-y'). "\n";
					
					$headers = "From: jaideep.kirad@winworldtechs.com";

					mail($to,$subject,$txt,$headers);
					
					$to = "jaideep.kirad@winworldtechs.com";
					$subject = "Coach Registration On Gigbag - $username !!";
					$txt = "Account Details are given below :". "\n";
					$txt .= "Date - ".date('d-m-y'). "\n";
					$txt .= "Coach Id - ".$unique_id. "\n";
			    $txt .= "Coach Name - ".$username. "\n";
			    $txt .= "Email -  ".$email. "\n";
			    $txt .= "Address - ".$address. "\n";
			    $txt .= "Country Code - ".$country_code. "\n";
			    $txt .= "Mobile - ".$teacher_phone. "\n";
			    $txt .= "Dob - ".$dob. "\n";
			    $txt .= "Category - ".$category_id. "\n";
			    $txt .= "Sub Category - ".$category_id. "\n";
					$txt .= "Source - ".$source. "\n";
				    $txt .= "T&C & Privacypolicy - ".$policy. "\n";
          $txt .= "Name In Bank A/c - ".$name_in_bank_account. "\n";
          $txt .= "Bank Name - ".$bankname. "\n";
          $txt .= "Branch Location - ".$branch_name. "\n";
          $txt .= "A/C Number - ".$account_number. "\n";
          $txt .= "IFSC Code - ".$ifsc_code. "\n";
					$txt .= "Induction Date - ".$induction_date. "\n";
					$txt .= "Password - ".$password. "\n";
					
					$headers = "From: jaideep.kirad@winworldtechs.com";

					mail($to,$subject,$txt,$headers);

if($email_check & $mobile_check){
  $this->Customer_regis_model->register_user($insertdata);
  //$this->session->set_flashdata('success_msg', 'Registered successfully.');
  
  echo "<script>alert('Registered successfully.'); window.location.href='https://gigbag.winworldtechs.com/admin/Teachers/';</script>";

}
else{

 $filterD['studentid'] =  $radio_id;
        $this->General_model->update('student', $filterD,$insertdata);
        $radioID = $radio_id;
  $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
  
  echo "<script>alert('Email Or Mobile already regsitered  or Data updated successfully !!'); window.location.href='https://gigbag.winworldtechs.com/admin/Teachers/';</script>";

}

}
    
   public function user_logout(){

  $this->session->sess_destroy();
  redirect('Login', 'refresh');
} 
    
    
    
}
    ?>