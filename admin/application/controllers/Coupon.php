<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon  extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('Category_model');
        $this->load->model('Movie_model');
         $this->load->model('Customer_regis_model');
        $this->load->model('General_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }

    public function index() {
            $data['currentPage'] = "coupon";
            $this->load->view('coupon/radio-list',$data);
    }

    public function add() 
    {
      $data['currentPage'] = "coupon";
      $data['method'] = 'add';
      $data['page']='Add Coupon';
      $languageList=$this->Movie_model->getLanguageList();
      $data['languageList']=$languageList;

      $this->load->view('coupon/addRadioView',$data);
    }

   public function edit($mediaID=NULL){
      $data['id'] = $mediaID;
      $data['currentPage'] = "coupon";
      $data['method'] = 'edit/'.$mediaID;
      $data['page']='Update Coupon';
      $languageList=$this->Movie_model->getLanguageList();
      $data['languageList']=$languageList;
      $categoriesList=$this->Movie_model->getCategoriesList("3");
      $data['categoriesList']=$categoriesList;
      $filter['couponid'] = $mediaID;
      if($getData = $this->General_model->getData("coupon",$filter)){
          $data['media_detail']= $getData ;
      }else{
        redirect('Coupon/');
      }
      
      
      $this->load->view('coupon/addRadioView',$data);
    }


  public function radioListwebAPI(){

        $start = $_GET['start'];
        $length = $_GET['length'];
        $search = $_GET['search']["value"];
        
        if(isset($_GET['order']))
        {
            $column_num= $_GET["order"][0]['column'];
           $order= $_GET["order"][0]['dir'];
           $columnName= $_GET["columns"][$column_num]['data'];
            
            
        }
        else
        {
            $order='';
         $columnName='couponid';   
        }
        if($columnName=='t1.couponnumber')
        {
            $tbl='t1';
        }
        else
        {
              $tbl='t1';
        }
        
        
        

         $data = $this->db->query("SELECT * FROM coupon as t1 where t1.couponnumber LIKE '%".$search."%' ORDER BY $tbl.$columnName $order LIMIT ".$start." , ".$length." ");



        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->couponid;
         //$result[$key]->banner_img = base_url()."".$result[$key]->banner_img;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT * FROM coupon");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

 }
 

     public function radioActivation(){
         $this->load->model('webservice_general_model');
         if($this->input->is_ajax_request()){
            $ID = $this->input->post('ID',TRUE);
            $isActive = $this->input->post('isActive',TRUE);
            if($ID != ''){
            //$transactionId = $this->encryption->decode($transactionId);
           $filter['couponid']  = $ID;
           $setData['isActive']  = $isActive;
           $id = $this->webservice_general_model->delete('coupon',$filter,$setData);
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


    
  public function languageActivation(){
         $this->load->model('webservice_general_model');
         if($this->input->is_ajax_request()){
            $ID = $this->input->post('ID',TRUE);
            $isActive = $this->input->post('isStatus',TRUE);
            if($ID != ''){
            //$transactionId = $this->encryption->decode($transactionId);
           $filter['couponid']  = $ID;
           $setData['isStatus']  = $isActive;
           $id = $this->webservice_general_model->update('coupon',$filter,$setData);
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
  public function submit_coupon()
  {
    $post = $this->input->post();
    $coupon_id = $this->input->post('coupon_id');
    $method = $this->input->post('method');
    $this->form_validation->set_rules('method', 'method', 'trim|required');
    $this->form_validation->set_rules('couponcode', 'couponcode', 'trim|required');
    $this->form_validation->set_rules('discountrate', 'discountrate', 'trim|required');
    $this->form_validation->set_rules('availablecoupon', 'availablecoupon', 'trim|required');
    $this->form_validation->set_rules('startdate', 'startdate', 'trim|required');
     $this->form_validation->set_rules('enddate', 'enddate', 'trim|required');
    if ($this->form_validation->run() == FALSE) {
      $data = array(
        'status' => 'danger',
        'msg' => validation_errors(),
      );
    }
    else 
    {
      extract($post);
      unset($post['method']);
      unset($post['coupon_id']);
      $unique_id = rand(10000,99999);
      $coupon_check=$this->Customer_regis_model->coupocode_check($post['couponcode'],$coupon_id);
      if (!empty($coupon_check)) 
      {
        
        if (!empty($coupon_id)) 
        {
          $response = $this->Common_model->updateData('coupon', $post, array('couponid' => $coupon_id));
        } 
        else
        {
          $unique_id = "C".rand(10000000,99999999);
          $post['couponnumber']=$unique_id;

          $post['startdate'] = date('Y-m-d', strtotime($post['startdate']));
          $post['enddate'] = date('Y-m-d', strtotime($post['enddate']));
          $response = $this->Common_model->insertData('coupon', $post);
          $coupon_id = $response;
        }
        if (empty($response)) 
        {
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
      else
      {

        $data = array(
            'status' => 'danger',
            'msg' => 'Coupon Code already exists',
          );
      }
    }  
    if (!empty($method)) 
    {
      $this->session->set_flashdata('message', $data);
      redirect(base_url('Coupon/' . $method));
    } 
    else 
    {
      $data['id'] = $coupon_id;
      echo json_encode($data);
    }
  }

}
