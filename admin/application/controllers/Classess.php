<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Classess  extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('Category_model');
        $this->load->model('Movie_model');
        $this->load->model('General_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }

    public function index() {
            $data['currentPage'] = "classes";
            $this->load->view('classes/radio-list',$data);
    }

       public function add() {
             if($this->input->post('add_radio'))
    
            $data['currentPage'] = "classes";
            $languageList=$this->Movie_model->getLanguageList();
            $data['languageList']=$languageList;

            $categoriesList=$this->Movie_model->getCategoriesList("3");
            $data['categoriesList']=$categoriesList;
            
            $getCourse=$this->Category_model->getCourse();
            $data['getCourse']=$getCourse;
            
            $getsubcat=$this->Category_model->getsubcat();
            $data['getsubcat']=$getsubcat;
            
            $getstudentid=$this->Category_model->getstudentid();
            $data['getstudentid']=$getstudentid;
            
            $getteacherid=$this->Category_model->getteacherid();
            $data['getteacherid']=$getteacherid;
            
            $getstatus=$this->Category_model->getstatus();
            $data['getstatus']=$getstatus;
            
            $getpaid=$this->Category_model->getpaid();
            $data['getpaid']=$getpaid;
            
            $getgig=$this->Category_model->getgig();
            $data['getgig']=$getgig;
            
            $getcoupon=$this->Category_model->getcoupon();
            $data['getcoupon']=$getcoupon;
            
            $this->load->view('classes/addRadioView',$data);
    }

   public function edit($mediaID=NULL){
        $data['id'] = $mediaID;
        $data['currentPage'] = "category";
        $languageList=$this->Movie_model->getLanguageList();
        $data['languageList']=$languageList;
        $categoriesList=$this->Movie_model->getCategoriesList("3");
        $data['categoriesList']=$categoriesList;
        $filter['class_id'] = $mediaID;
        if($getData = $this->General_model->getData("classes",$filter)){
            $data['media_detail']= $getData ;
        }else{
          redirect('Classess/');
        }
        
        $getCourse=$this->Category_model->getCourse();
        $data['getCourse']=$getCourse;
        
        $getsubcat=$this->Category_model->getsubcat();
        $data['getsubcat']=$getsubcat;
        
        $getstudentid=$this->Category_model->getstudentid();
        $data['getstudentid']=$getstudentid;
        
        
        $getteacherid=$this->Category_model->getteacherid();
        $data['getteacherid']=$getteacherid;
            
         $getstatus=$this->Category_model->getstatus();
         $data['getstatus']=$getstatus; 
         
         $getpaid=$this->Category_model->getpaid();
         $data['getpaid']=$getpaid;
         
          $getgig=$this->Category_model->getgig();
          $data['getgig']=$getgig;
            
          $getcoupon=$this->Category_model->getcoupon();
          $data['getcoupon']=$getcoupon;
          
          
        $this->load->view('classes/addRadioView',$data);
    }


     public function add_radio(){
     
      $createdate = date('d-m-Y');
      $student_id=$this->input->post('student_id');
      $teacher_id=$this->input->post('teacher_id');
      $category_id=$this->input->post('gigid');
      $couponnumber=$this->input->post('couponcode');
      $startdate=$this->input->post('startdate');
      $class_start_time=$this->input->post('class_start_time');
      $end_date=$this->input->post('end_date');
      $classid = "GIG".rand(100000,999999);
      $status=empty($this->input->post('status'))?'':$this->input->post('status');
      $paid=empty($this->input->post('paid'))?'':$this->input->post('paid');
      $radio_id = $this->input->post('radioID');
      $unique_id = "CLS".rand(10000000,99999999);
      $insertdata=array(
         'createdate'=>$createdate,
        'teacher_id'=>$teacher_id,
        'gigid'=>$category_id,
         'couponcode'=>$couponnumber,
         'startdate'=>$startdate,
         'class_start_time'=>$class_start_time,
        'end_date'=>empty($end_date)?NULL:$end_date,
        'classid'=>$classid,
        'status'=>$status,
        'class_id_number'=>$unique_id,
        'paid'=>$paid
         );
     // print_r($insertdata);die;
      if($radio_id == ""){
        $radioID = $this->General_model->insert('classes', $insertdata);
      }else{

        $filterD['class_id'] =  $radio_id;
        $this->General_model->update('classes', $filterD,$insertdata);
        //print_r($this->db->last_query());die;
        $radioID = $radio_id;
      }


        if($_FILES)
       
        $image_name = "";
        $image_name_thumb = "";
        $this->load->library('upload');   
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT']."/admin/uploads/banner/";
        $config['allowed_types'] = '*';
        $config['max_size']    = '100000000';
        //$config['file_name'] = "upload";

        $this->upload->initialize($config);
        $certificateflag = $this->upload->do_upload("banner_img");       
        if ($this->upload->do_upload("banner_img")){
        
        $imageArray = $this->upload->data();

        $image_name = $imageArray['raw_name'].''.$imageArray['file_ext']; // Job Attachment
        
        $image_name_thumb =$imageArray['raw_name'].$imageArray['file_ext'];
        $filterImage['class_id'] = $radioID;
        $setIcon['banner_img'] = "/uploads/banner/".$image_name_thumb;
          $setIcon['banner_img_thumb'] = "/uploads/banner/".$image_name_thumb;
          
          $userDetailid = $this->General_model->update('classes', $filterImage,$setIcon);
          
            redirect('Classess/');
            
        
            
            
        }else{
            redirect('Classess/');
            echo "<pre>"; Print_r($this->upload->data()); echo "</pre>";
        }
        
        
        
    }



        public function radioListwebAPI(){

        // $start = $_GET['start'];
        // $length = $_GET['length'];
        // $search = $_GET['search']["value"];
        
        // if(isset($_GET['order']))
        // {
        //     $column_num= $_GET["order"][0]['column'];
        //    $order= $_GET["order"][0]['dir'];
        //    $columnName= $_GET["columns"][$column_num]['data'];
            
            
        // }
        // else
        // {
        //     $order='';
        //  $columnName='class_id';   
        // }
        // if($columnName=='t1.classid')
        // {
        //     $tbl='t1';
        // }
        // else
        // {
        //       $tbl='t1';
        // }
        
        
        

         $data = $this->db->query("SELECT t1.*,t2.unique_id as student_unique_id,t3.unique_id as teacher_unique_id ,t4.gigid as gig_unique_id FROM classes as t1 LEFT JOIN student t2 ON t1.student_id=t2.studentid LEFT JOIN student t3 ON t1.teacher_id=t3.studentid LEFT JOIN gigs t4 ON t1.gigid=t4.gig_id");



        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->class_id;
         //$result[$key]->banner_img = base_url()."".$result[$key]->banner_img;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT * FROM classes");
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
           $filter['class_id']  = $ID;
           $setData['isActive']  = $isActive;
           $id = $this->webservice_general_model->delete('classes',$filter,$setData);
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
           $filter['class_id']  = $ID;
           $setData['isStatus']  = $isActive;
           $id = $this->webservice_general_model->update('classes',$filter,$setData);
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
