<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance  extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('Category_model');
        $this->load->model('Movie_model');
        $this->load->model('Teammodel');
        $this->load->model('General_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }

    public function index() {
            $data['currentPage'] = "attendance";
            $this->load->view('attendance/radio-list',$data);
    }

       public function add() {
             if($this->input->post('add_radio'))
    
            $data['currentPage'] = "attendance";
            $languageList=$this->Movie_model->getLanguageList();
            $data['languageList']=$languageList;

            $categoriesList=$this->Movie_model->getCategoriesList("3");
            $data['categoriesList']=$categoriesList;
            
            $getCourse=$this->Category_model->getCourse();
            $data['getCourse']=$getCourse;
            
            $getsubcat=$this->Category_model->getsubcat();
            $data['getsubcat']=$getsubcat;
            
            $getcountry=$this->Teammodel->getcountry();
            $data['getcountry']=$getcountry;
            
            $getattenstatus=$this->Category_model->getattenstatus();
            $data['getattenstatus']=$getattenstatus;
            
            $getgigids=$this->Category_model->getgig();
            $data['getgigids']=$getgigids;
            
            $getteacheridss=$this->Category_model->getteacheridss();
            $data['getteacheridss']=$getteacheridss;
            
            $getstudentsidss=$this->Category_model->getstudentsidss();
            $data['getstudentsidss']=$getstudentsidss;
            
            $this->load->view('attendance/addRadioView',$data);
    }

   public function edit($mediaID=NULL){
        $data['id'] = $mediaID;
        $data['currentPage'] = "category";
        $languageList=$this->Movie_model->getLanguageList();
        $data['languageList']=$languageList;
        $categoriesList=$this->Movie_model->getCategoriesList("3");
        $data['categoriesList']=$categoriesList;
        $filter['attendance_id'] = $mediaID;
        if($getData = $this->General_model->getData("attendance",$filter)){
            $data['media_detail']= $getData ;
        }else{
          redirect('Attendance/');
        }
        
        $getCourse=$this->Category_model->getCourse();
        $data['getCourse']=$getCourse;
        
        $getsubcat=$this->Category_model->getsubcat();
        $data['getsubcat']=$getsubcat;
        
        $getcountry=$this->Teammodel->getcountry();
            $data['getcountry']=$getcountry;
            
            $getattenstatus=$this->Category_model->getattenstatus();
            $data['getattenstatus']=$getattenstatus;
            
            $getgigids=$this->Category_model->getgig();
            $data['getgigids']=$getgigids;
            
            $getteacheridss=$this->Category_model->getteacheridss();
            $data['getteacheridss']=$getteacheridss;
            
            $getstudentsidss=$this->Category_model->getstudentsidss();
            $data['getstudentsidss']=$getstudentsidss;
        $this->load->view('attendance/addRadioView',$data);
    }


     public function add_radio(){
     
        $last_update = date('d-m-Y');
        $dates=$this->input->post('dates');
        $time=$this->input->post('time');
        $duration=$this->input->post('duration');
        $status=$this->input->post('status');
        $remark=$this->input->post('remark');
        $teacher_id=$this->input->post('teacher_id');
        $student_id=$this->input->post('student_id');
        $start_time=$this->input->post('start_time');
        $endtime=$this->input->post('endtime');
        $gigid=$this->input->post('gigid');
        $virtuallink=$this->input->post('virtuallink');
        $classroomlink=$this->input->post('classroomlink');
        $serial_number = rand(1000000000,9999999999);
        $startotp = rand(1000,9999);
        $endotp = rand(1000,9999);
        $radio_id = $this->input->post('radioID');
     
      $insertdata=array(
        'last_update'=>$last_update,
        'serial_number'=>$serial_number,
        'dates'=>$dates,
        'time'=>$time,
        'duration'=>$duration,
        'class_id'=>$student_id.$gigid,
        'attendance_status'=>$status,
        'remark'=>$remark,
        'teacher_id'=>$teacher_id,
        'student_id'=>$student_id,
        'start_time'=>$start_time,
        'endtime'=>$endtime,
        'gigid'=>$gigid,
        'virtuallink'=>$virtuallink,
        'classroomlink'=>$classroomlink,
        'start_otp'=>$startotp,
        'endotp'=>$endotp
         );

      if($radio_id == ""){
        $radioID = $this->General_model->insert('attendance', $insertdata);
      }else{

        $filterD['attendance_id'] =  $radio_id;
        $this->General_model->update('attendance', $filterD,$insertdata);
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
        $filterImage['attendance_id'] = $radioID;
        $setIcon['banner_img'] = "/uploads/banner/".$image_name_thumb;
          $setIcon['banner_img_thumb'] = "/uploads/banner/".$image_name_thumb;
          
          $userDetailid = $this->General_model->update('attendance', $filterImage,$setIcon);
          
            redirect('Attendance/');
            
        
            
            
        }else{
            redirect('Attendance/');
            echo "<pre>"; Print_r($this->upload->data()); echo "</pre>";
        }
        
        
        
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
         $columnName='attendance_id';   
        }
        if($columnName=='t1.serial_number')
        {
            $tbl='t1';
        }
        else
        {
              $tbl='t1';
        }
        
        
        

        //  $data = $this->db->query("SELECT t1.*,s.unique_id as student,c.class_id_number,c.startdate,c.class_start_time,c.end_date,c.end_time,t.unique_id as teacher,c.teacher_id FROM attendance as t1 INNER JOIN student s on t1.student_id=s.studentid LEFT JOIN classes c on t1.class_id=c.class_id LEFT JOIN student t on c.teacher_id=t.studentid  where c.class_id_number LIKE '%".$search."%' ORDER BY $tbl.$columnName $order LIMIT ".$start." , ".$length." ");
         $data = $this->db->query("SELECT t1.* FROM attendance as t1 ORDER BY $tbl.$columnName $order LIMIT ".$start." , ".$length." ");
        //  $data = $this->db->query("SELECT t1.*, s.unique_id as student, c.class_id_number,c.startdate,c.class_start_time,c.end_date,c.end_time, t.unique_id as teacher, c.teacher_id FROM attendance as t1 INNER JOIN student s on t1.student_id=s.unique_id LEFT JOIN classes c on t1.class_id=c.class_id LEFT JOIN student t on t1.teacher_id=t.unique_id ORDER BY $tbl.$columnName $order LIMIT ".$start." , ".$length." ");

         
        


        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->attendance_id;
         //$result[$key]->banner_img = base_url()."".$result[$key]->banner_img;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT * FROM attendance");
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
           $filter['attendance_id']  = $ID;
           $setData['isActive']  = $isActive;
           $id = $this->webservice_general_model->delete('attendance',$filter,$setData);
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
           $filter['attendance_id']  = $ID;
           $setData['isStatus']  = $isActive;
           $id = $this->webservice_general_model->update('attendance',$filter,$setData);
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
