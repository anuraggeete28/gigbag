<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_settings  extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('General_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }
    public function password_check($password)
    {
       if (strlen($password)==8 && preg_match('#[0-9]#', $password) && preg_match('#[a-zA-Z]#', $password)) {
         return TRUE;
       }
        $this->form_validation->set_message('password_check', "Password must be 8 digit alpha numric string");
       return FALSE;
    }
    public function email_check($email) {

      $allowed_hostnames = array("in", "info","edu");

      $emailParts = explode('@',$email);

      $hostname = end($emailParts);
      $email_end_str = explode('.',$hostname);
       $email_extension = end($email_end_str);
      if (array_search($email_extension, $allowed_hostnames) === FALSE)
      {
          $this->form_validation->set_message('email_check', "The {field} field can only be .in Or .info Or.edu");
          return FALSE;
      }
      else
      {
          return TRUE;
      }
    }
    
    public function rate_conversion() 
    {
      $data['currentPage'] = "Rate Conversion";
      $data['page'] = "Rate Conversion";
      $data['method'] = 'rate_conversion';
      $data['usdratedata']=$this->General_model->getData("rate_coversion");
      $this->load->view('admin_settings/admin_settings',$data);
    }

 

  
  public function submit_rate_conversion()
  {

    $post = $this->input->post();
    $id = $this->input->post('id');
    $method = $this->input->post('method');
     $this->form_validation->set_rules('usd', 'USD Value', 'trim|required');
    $this->form_validation->set_rules('inr', 'INR Value', 'trim|required');
    if ($this->form_validation->run() == FALSE) {
      $data = array(
        'status' => 'danger',
        'msg' => validation_errors(),
      );
    } else {
      unset($post['method']);
      unset($post['id']);
     
      if (!empty($id)) 
      {
        $response = $this->Common_model->updateData('rate_coversion', $post, array('id' => $id));
      } else {
        $response = $this->Common_model->insertData('rate_coversion', $post);
        $id = $response;
      }

      if (empty($response)) {
        $data = array(
          'status' => 'danger',
          'msg' => 'Failed !Please Try Again.',
        );
      } else {
        $data = array(
          'status' => 'success',
          'msg' => 'Successfully Saved',
        );
      }
    }
    if (!empty($method)) {
      $this->session->set_flashdata('message', $data);
      redirect(base_url('Admin_settings/' . $method));
    } else {
      $data['id'] = $id;
      echo json_encode($data);
    }
  }

   public function class_type_list() {
      $data['currentPage'] = "Class Type";
      $data['class_type_list']=$this->General_model->getData("typeofclass",array(),"","","rows");
      $this->load->view('admin_settings/class_type_list',$data);;
    }

    public function add_class_type() 
    {
      $data['currentPage'] = "Add Class Type";
      $data['method'] = 'add_class_type';
      $data['page']='Add Class Type';
      $this->load->view('admin_settings/class_type',$data);
    }

   public function update_class_type($classtype_id=NULL){
      $data['id'] = $classtype_id;
      $data['currentPage'] = "Updte Class Type";
      $data['method'] = 'update_class_type/'.$classtype_id;
      $data['page']='Update Class Type';
      $filter['classtype_id'] = base64_decode($classtype_id);
      $getData = $this->General_model->getData("typeofclass",$filter);
      if($getData){
          $data['class_type_data']= $getData ;
      }else{
        redirect('admin_settings/class_type_list');
      }
      $this->load->view('admin_settings/class_type',$data);
    }

  public function submit_class_type()
  {
    $post = $this->input->post();
    $id = $this->input->post('classtype_id');
    $method = $this->input->post('method');
     $this->form_validation->set_rules('type_of_class', 'Type Of Class', 'trim|required');
    $this->form_validation->set_rules('location_required', 'Location Required', 'trim|required');
    if ($this->form_validation->run() == FALSE) {
      $data = array(
        'status' => 'danger',
        'msg' => validation_errors(),
      );
    } else {
      unset($post['method']);
      unset($post['classtype_id']);
     
      if (!empty($id)) 
      {
        $response = $this->Common_model->updateData('typeofclass', $post, array('classtype_id' => $id));
      } else {
        $response = $this->Common_model->insertData('typeofclass', $post);
        $id = $response;
      }

      if (empty($response)) {
        $data = array(
          'status' => 'danger',
          'msg' => 'Failed !Please Try Again.',
        );
      } else {
        $data = array(
          'status' => 'success',
          'msg' => 'Successfully Saved',
        );
      }
    }
    if (!empty($method)) {
      $this->session->set_flashdata('message', $data);
      redirect(base_url('Admin_settings/' . $method));
    } else {
      $data['id'] = $id;
      echo json_encode($data);
    }
  }
  public function delete_class_type(){
     $this->load->model('webservice_general_model');
     if($this->input->is_ajax_request()){
        $ID = $this->input->post('ID',TRUE);
        $isActive = $this->input->post('isActive',TRUE);
        if($ID != ''){
        //$transactionId = $this->encryption->decode($transactionId);
       $filter['classtype_id']  = $ID;
       $setData['isActive']  = $isActive;
       $id = $this->webservice_general_model->delete('typeofclass',$filter,$setData);
        if($id){
          echo 1; die;
      }else{
          echo 0; die;
      }
    }else{
      echo 0; die;
    }
    }else{
     echo 0; die;
    }
  }

   public function sub_admin_list() {
      $data['currentPage'] = "Sub Admin";
      $data['sub_admin_list']=$this->Common_model->getMultipleRow('tbl_admin',array('user_type'=>2));
      $this->load->view('admin_settings/sub_admin_list',$data);;
    }

    public function add_sub_admin() 
    {
      $data['currentPage'] = "Add Sub Admin";
      $data['method'] = 'add_sub_admin';
      $data['page']='Add Sub Admin';
      $this->load->view('admin_settings/sub_admin',$data);
    }

   public function update_sub_admin($id=NULL){
      $data['id'] = $id;
      $data['currentPage'] = "Update Sub Admin";
      $data['method'] = 'update_sub_admin/'.$id;
      $data['page']='Update Sub Admin';
      $filter['id'] = base64_decode($id);
      $getData = $this->General_model->getData("tbl_admin",$filter);
      if($getData){
          $data['sub_admin_data']= $getData ;
      }else{
        redirect('admin_settings/sub_admin_list');
      }
      $this->load->view('admin_settings/sub_admin',$data);
    }

  public function submit_sub_admin()
  {
    $post = $this->input->post();
    $id = $this->input->post('id');
    $method = $this->input->post('method');
    $this->form_validation->set_rules('username', 'User name', 'trim|required');
    $this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required|callback_email_check');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if ($post['password']!=='********')  
    {
       $this->form_validation->set_rules('password', 'Password', 'callback_password_check');
    }
    $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
    if ($this->form_validation->run() == FALSE) {
      $data = array(
        'status' => 'danger',
        'msg' => validation_errors(),
      );
    } else {
      unset($post['method']);
      unset($post['id']);
      unset($post['confirm_password']);
      if ($post['password']=='********')
      {
        unset($post['password']);
      }
      if (!empty($id)) 
      {
        $response = $this->Common_model->updateData('tbl_admin', $post, array('id' => $id));
      } else {
        $response = $this->Common_model->insertData('tbl_admin', $post);
        $id = $response;
      }

      if (empty($response)) {
        $data = array(
          'status' => 'danger',
          'msg' => 'Failed !Please Try Again.',
        );
      } else {
        $data = array(
          'status' => 'success',
          'msg' => 'Successfully Saved',
        );
      }
    }
    if (!empty($method)) {
      $this->session->set_flashdata('message', $data);
      redirect(base_url('Admin_settings/' . $method));
    } else {
      $data['id'] = $id;
      echo json_encode($data);
    }
  }
  public function delete_sub_admin()
  {
    $this->load->model('webservice_general_model');
    if($this->input->is_ajax_request()){
        $ID = $this->input->post('ID',TRUE);
        $isActive = $this->input->post('isActive',TRUE);
        if($ID != ''){
        //$transactionId = $this->encryption->decode($transactionId);
       $filter['id']  = $ID;
     //  $setData['isActive']  = $isActive;
       $id = $this->webservice_general_model->delete('tbl_admin',$filter,$setData);
        if($id){
          echo 1; die;
      }else{
          echo 0; die;
      }
    }else{
      echo 0; die;
    }
    }else{
     echo 0; die;
    }
  }

}
