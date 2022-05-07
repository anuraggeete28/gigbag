<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile  extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('Movie_model');
        $this->load->model('general_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }

    public function index() {
            $data['currentPage'] = "profile";
            $this->load->view('profile/oldprofile',$data);
    }

       public function add() {
             if($this->input->post('add_radio'))
  
            $data['currentPage'] = "profile";
            $languageList=$this->Movie_model->getLanguageList();
            $data['languageList']=$languageList;

            $categoriesList=$this->Movie_model->getCategoriesList("3");
            $data['categoriesList']=$categoriesList;
            $this->load->view('profile/oldprofile',$data);
    }

    public function edit($mediaID=NULL){
        $data['id'] = $mediaID;
        $data['currentPage'] = "profile";
        $languageList=$this->Movie_model->getLanguageList();
        $data['languageList']=$languageList;
        $categoriesList=$this->Movie_model->getCategoriesList("3");
        $data['categoriesList']=$categoriesList;
        $filter['id'] = $mediaID;
        if($getData = $this->general_model->getData("tbl_admin",$filter)){
            $data['media_detail']= $getData ;
        }else{
          redirect('profile/');
        }
        
        $this->load->view('profile/oldprofile',$data);
    }


    public function add_radio(){
   
      $user_name=$this->input->post('username');
      $user_email=$this->input->post('email');
      $password=$this->input->post('password');
      $cpassword=$this->input->post('confirm_Password');
      $usdrate=$this->input->post('usdrate');
      $radio_id = $this->input->post('radioID');
     
      $insertdata=array(
        'username'=>$user_name,
        'email'=>$user_email,
        'password'=>$password,
        'confirm_Password'=>$cpassword,
         'usdrate'=>$usdrate
         );

      if($radio_id == ""){
        $radioID = $this->general_model->insert('tbl_admin', $insertdata);
        
        $messge =  'Profile has been updated';
                       $this->session->set_flashdata('success_msg',$messge );
                       echo "<script>alert('Profile updated !!'); window.location.href='https://gigbag.winworldtechs.com/admin/Dashboard/';</script>";
      }else{

        $filterD['id'] =  $radio_id;
        $this->general_model->update('tbl_admin', $filterD,$insertdata);
        $radioID = $radio_id;
        
        $messge =  'Profile has been updated';
                       $this->session->set_flashdata('success_msg',$messge );
                       echo "<script>alert('Profile updated !!'); window.location.href='https://gigbag.winworldtechs.com/admin/Dashboard/';</script>";
      }


      
    }

 



}
