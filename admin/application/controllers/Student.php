<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student  extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('Teammodel');
        $this->load->model('Category_model');
        $this->load->model('Movie_model');
        $this->load->model('Dynamic_dependent_model');
        $this->load->model('General_model');
        $this->load->model('Customer_regis_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
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
    
    
  function index()
 {
  $data['country'] = $this->Dynamic_dependent_model->fetch_country();
  $this->load->view('student/radio-list',$data);
 }

 function fetch_state()
 {
  if($this->input->post('country_id'))
  {
   echo $this->Dynamic_dependent_model->fetch_state($this->input->post('country_id'));
  }
 }

 function fetch_city()
 {
  if($this->input->post('state_id'))
  {
   echo $this->Dynamic_dependent_model->fetch_city($this->input->post('state_id'));
  }
 }


  public function add() 
  {
      $data['currentPage'] = "student";
      $data['method'] = 'add';
      $data['page']='Add Student';
      $languageList=$this->Movie_model->getLanguageList();
      $data['languageList']=$languageList;
      $getcountry=$this->Teammodel->getcountry();
      $data['getcountry']=$getcountry;
      
      $getstate=$this->Teammodel->getstate();
      $data['getstate']=$getstate;
      
      $getcountrylist=$this->Teammodel->getcountrylist();
      $data['getcountrylist']=$getcountrylist;
      
      $getsource=$this->Teammodel->getsource();
      $data['getsource']=$getsource;
      
      $getpolicyaccept=$this->Teammodel->getpolicyaccept();
      $data['getpolicyaccept']=$getpolicyaccept;
      
     $getgigcats=$this->Category_model->getgigcats();
     $data['getgigcats']=$getgigcats;
    
      
      
      $getcountryli=$this->Teammodel->getcountryli();
      $data['getcountryli']=$getcountryli;
      
      $this->load->view('student/addRadioView',$data);
  }

    public function edit($mediaID=NULL){
        $data['id'] = $mediaID;
        $data['currentPage'] = "student";
        $data['method'] = 'edit/'.$mediaID;
        $data['page']='Update Student';
        $languageList=$this->Movie_model->getLanguageList();
        $data['languageList']=$languageList;
        $categoriesList=$this->Movie_model->getCategoriesList("3");
        $data['categoriesList']=$categoriesList;
        $filter['studentid'] = $mediaID;
        if($getData = $this->General_model->getData("student",$filter)){
            $data['media_detail']= $getData ;
        }else{
          redirect('Student/');
        }
        
        $getcountry=$this->Teammodel->getcountry();
        $data['getcountry']=$getcountry;
        
        $getgigcats=$this->Category_model->getgigcats();
        $data['getgigcats']=$getgigcats;
            
        $getstate=$this->Teammodel->getstate();
        $data['getstate']=$getstate;
        
        $getcountrylist=$this->Teammodel->getcountrylist();
        $data['getcountrylist']=$getcountrylist;
        
        $getsource=$this->Teammodel->getsource();
        $data['getsource']=$getsource;
        
        $getpolicyaccept=$this->Teammodel->getpolicyaccept();
        $data['getpolicyaccept']=$getpolicyaccept;
        
        $getcountryli=$this->Teammodel->getcountryli();
        $data['getcountryli']=$getcountryli;
        
        $this->load->view('student/addRadioView',$data);
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
         $columnName='studentid';   
        }
        if($columnName=='student_name')
        {
            $tbl='t1';
        }
        else
        {
              $tbl='t1';
        }
        
        
        /*SELECT * FROM courses where course_name LIKE '%".$search."%' ORDER BY $tbl.$columnName $order LIMIT ".$start." , ".$length."*/

        $data = $this->db->query("SELECT * FROM student as t1 left JOIN countries as t2 ON t1.country_id = t2.country_id left join states as t3 ON t1.state_id = t3.state_id left join subcategory as t4 ON t1.subcat_id=t4.subcat_id where t1.usertype = 'student' AND t1.username LIKE '%".$search."%' ORDER BY $tbl.$columnName $order LIMIT ".$start." , ".$length."");



        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->studentid;
          $result[$key]->profile = FILE_PATH.$result[$key]->profile;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT * FROM student as t1 inner JOIN countries as t2 ON t1.country_id = t2.country_id left join states as t3 ON t1.state_id = t3.state_id left join subcategory as t4 ON t1.subcat_id=t4.subcat_id where t1.usertype = 'student' AND t1.username LIKE '%".$search."%' ORDER BY $tbl.$columnName $order LIMIT ".$start." , ".$length."");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

 }
 
 
 
 public function ordersdetail(){

      
    $id=$this->input->post('ID');
         $data = $this->db->query("SELECT * FROM student as t1 inner JOIN countries as t2 ON t1.country_id = t2.country_id inner join states as t3 ON t1.state_id = t3.state_id where t1.usertype = 'student' AND t1.username LIKE '%".$search."%' ORDER BY $tbl.$columnName $order LIMIT ".$start." , ".$length."");

        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->booking_id;
          /*$result[$key]->created_date = date('d-m-Y',strtotime($result[$key]->created_date));*/
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT m.booking_id, m.check_in_date,m.check_out_date,m.number_of_persons, m.room_number, m.nightly_price FROM all_bookings as m where user_id=$id");
        $result1 = $data12->result_array();
        $data1['recordsFiltered'] = $data12->num_rows();
        $div= '<table id="" class="table" style="width:100%">
                            <thead>
                                    <tr>
                                    
                                    <th>Booking Id</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Persons  </th>
                                    <th>Room No.</th>
                                    <th>Payment</th>
                                    
                                    </tr>
                            </thead>
                            <tbody>';
                        foreach($result1 as $value){
                        $div.='<tr><td>'.$value['booking_id'].'</td>';
                        $div.='<td>'.$value['check_in_date'].'</td>';
                        $div.='<td>'.$value['check_out_date'].'</td>';
                        $div.='<td>'.$value['number_of_persons'].'</td>';
                        $div.='<td>'.$value['room_number'].'</td>';
                        $div.='<td>'.$value['nightly_price'].'</td>';
                       
                        $div.= '</tr>';
                        }
                            
                       $div .= '</tbody></table>';
                      echo $div;
       // echo json_encode($data1);
 }
 
 

     public function radioActivation(){
         $this->load->model('webservice_general_model');
         if($this->input->is_ajax_request()){
            $ID = $this->input->post('ID',TRUE);
            $isActive = $this->input->post('isActive',TRUE);
            if($ID != ''){
            //$transactionId = $this->encryption->decode($transactionId);
           $filter['studentid']  = $ID;
           $setData['isActive']  = $isActive;
           $id = $this->webservice_general_model->delete('student',$filter,$setData);
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
           $filter['studentid']  = $ID;
           $setData['isStatus']  = $isActive;
           $id = $this->webservice_general_model->update('student',$filter,$setData);
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
  public function submit_student()
  {

    $post = $this->input->post();
    $student_id = $this->input->post('student_id');
    $method = $this->input->post('method');
    $this->form_validation->set_rules('method', 'method', 'trim|required');
    $this->form_validation->set_rules('category_id', 'category', 'trim|required');
    $this->form_validation->set_rules('subcat_id', 'subcategory', 'trim|required');
    $this->form_validation->set_rules('usertype', 'usertype', 'trim|required');
    $this->form_validation->set_rules('username', 'username', 'trim|required');
    $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_email_check');
    $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
    $this->form_validation->set_rules('country_code', 'country code', 'trim|required');
    $this->form_validation->set_rules('address', 'address', 'trim|required');
    $this->form_validation->set_rules('dob', 'dob', 'trim|required');
    $this->form_validation->set_rules('source', 'source', 'trim|required');
    $this->form_validation->set_rules('guardian', 'guardian', 'trim|required');
    $this->form_validation->set_rules('source', 'source', 'trim|required');
    $this->form_validation->set_rules('password', 'password', 'trim|required');
    $this->form_validation->set_rules('confpassword', 'Password Confirmation', 'required|matches[password]');
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
      unset($post['student_id']);
      $post['last_modified_date'] = date('Y-m-d h:i:s');
      $email_check=$this->Customer_regis_model->email_check($post['email'],$student_id);
      $mobile_check=$this->Customer_regis_model->mobile_check($post['mobile'],$student_id);
      if (!empty($email_check)) 
      {
        if (!empty($mobile_check)) 
        {
          if (!empty($_FILES['profile']['name'])) 
          {
            $image_name = "";
            $image_name_thumb = "";
            $this->load->library('upload');   
            $config['upload_path'] = UPLOAD_PATH."users/";
            $config['allowed_types'] = '*';
            $config['max_size']    = '1024';
            //$config['file_name'] = "upload";
            $this->upload->initialize($config);
            if ($this->upload->do_upload("profile"))
            {
              $imageArray = $this->upload->data();
              $image_name = $imageArray['raw_name'].''.$imageArray['file_ext']; // Job Attachment
              $image_name_thumb =$imageArray['raw_name'].$imageArray['file_ext'];
              $post['profile'] = "users/".$image_name_thumb;
            }
            else
            {
              $error=$this->upload->display_errors();
              $data = array(
                'status' => 'danger',
                'msg' => $this->upload->display_errors(),
              );
            }
          }
          if (empty($error)) 
          {
            if (!empty($student_id)) 
            {
              $response = $this->Common_model->updateData('student', $post, array('studentid' => $student_id));
            } 
            else
            {
              $post['signup_date'] = date('d-m-Y');
              $unique_id = "S".rand(10000000,99999999);
              $post['unique_id']=$unique_id;
              $response = $this->Common_model->insertData('student', $post);
              $subcat_id = $response;
              
              $to = $email;
              $subject = "Registration successfull On Gigbag!!";
              $txt = "Account Details are given below :". "\n";
              $txt .= "Name - ".$username. "\n";
              $txt .= "Address - ".$address. "\n";
              $txt .= "Email -  ".$email. "\n";
              $txt .= "Mobile - ".$mobile. "\n";
              $txt .= "Password - ".$password. "\n";
              $txt .= "Date - ".date('d-m-y'). "\n";
              
              $headers = "From: admin@gmail.com";

              mail($to,$subject,$txt,$headers);
              
              $to = "admin@gmail.com";
              $subject = "Registration On Gigbag - $username !!";
              $txt = "Account Details are given below :". "\n";
                $txt .= "Name - ".$username. "\n";
              $txt .= "Address - ".$address. "\n";
              $txt .= "Email -  ".$email. "\n";
              $txt .= "Mobile - ".$mobile. "\n";
              $txt .= "Password - ".$password. "\n";
              $txt .= "Date - ".date('d-m-y'). "\n";
              $headers = "From: admin@gmail.com";

              mail($to,$subject,$txt,$headers);
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
        }
        else
        {

          $data = array(
              'status' => 'danger',
              'msg' => 'Mobile already exists',
            );
        }
      }
      else
      {

        $data = array(
            'status' => 'danger',
            'msg' => 'Email already exists',
          );
      }
    }  
    if (!empty($method)) 
    {
      $this->session->set_flashdata('message', $data);
      redirect(base_url('student/' . $method));
    } 
    else 
    {
      $data['id'] = $student_id;
      echo json_encode($data);
    }
  }

  function uploadStudentCsv()
  {
  
    $count=0; 
    $res=array();
    if (empty($_FILES['csv_file'])) 
    {
      $data = array(
        'status' => 'danger',
        'msg' => 'File Required',
      );
    }
    else 
    {
      $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
      if(!in_array($_FILES['csv_file']['type'],$mimes)){
        $data = array(
          'status' => 'danger',
          'msg' => 'File Type not allowed',
        );
      } 
      else 
      {
        $fp=fopen($_FILES['csv_file']['tmp_name'],'r');
        $post = $this->input->post();
        $data = array();
        while( ($line = fgetcsv($fp)) !== false) {
            $data[] = $line;
        }
        $email_exist_count=0;
        $mobile_exist_count=0;
        $success_count=0;
        $insert_csv = array();
        for($i = 1, $j = count($data); $i < $j; $i++)
        { 
          $unique_id = "S".rand(10000000,99999999);
          $email_check=$this->Customer_regis_model->email_check($data[$i][1]);
          $mobile_check=$this->Customer_regis_model->mobile_check($data[$i][6]);
          if (empty($email_check)) 
          {
            $email_exist_count++;
          }
          elseif (empty($mobile_check)) 
          {
            $mobile_exist_count++;
          }
          else
          {
            $country_id=$this->Common_model->getColumValue('countries','country_Id', array('country'=>$data[$i][4]));
            $state_id=$this->Common_model->getColumValue('states','state_id', array('state'=>$data[$i][5],'country_Id'=>$country_id));
            $category_id=$this->Common_model->getColumValue('categories','category_id', array('category_name'=>$data[$i][9]));
            $subcategory_id=$this->Common_model->getColumValue('subcategory','subcat_id', array('subcatname'=>$data[$i][10],'category_id'=>$category_id));
            $insert_csv=array(
              'usertype'=>'student',
              'username'=>$data[$i][0],
              'email'=>$data[$i][1],
              'address'=>$data[$i][2],
              'country_code'=>$data[$i][3],
              'country_id'=>$country_id,
              'state_id'=>$state_id,
              'mobile'=>$data[$i][6],
              'signup_date'=>date('Y-m-d h:i:s'),
              'guardian'=>$data[$i][7],
              'dob'=>$data[$i][8],
              'category_id'=> $category_id,
              'subcat_id'=>$subcategory_id,
              'source'=>$data[$i][11],
              'referal'=>$data[$i][12],
              'password'=>$data[$i][13],
              'confpassword'=>$data[$i][13],
              'policy'=>$data[$i][14],
              'unique_id'=>$unique_id,
              'last_modified_date'=>date('Y-m-d h:i:s')
           );
                          
            $response=$this->db->insert('student', $insert_csv); 
            $success_count++; 
          }
          
        }
        fclose($fp);
        $message="";
        if ($email_exist_count>0) 
        {
           $message.=$email_exist_count." Email Already Exist ";
        }
        if ($mobile_exist_count>0) 
        {
           $message.=$mobile_exist_count." Mobile Already Exist";
        }
        if ($success_count>0) 
        {
           $message.=$success_count." Successfully Saved";
        }
        $data = array(
          'status' => 'success',
          'msg' => $message,
        );
      }
    }
    $this->session->set_flashdata('message', $data);
    redirect('Student/');
      
  }

  public function getProfile()
  {
    $student_id = $this->input->post('student_id');
    $data = $this->db->query("SELECT * FROM student where studentid = $student_id");
    $result = $data->result();
    foreach ($result as $key => $value) {
      $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->studentid;
      $result[$key]->profile = FILE_PATH.$result[$key]->profile;
    }
    $data1 = [];
    $data1['data'] = $result[0];
    $data1['message'] = "student profile get successfully";
    $data1['status'] = true;
    echo json_encode($data1);
  }
}
