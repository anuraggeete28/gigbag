<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Teachers  extends CI_Controller {

  private $_user;

  public function __construct() {
      parent::__construct();
      // Load form validation library
      $this->load->library('form_validation');
      $this->load->model('Category_model');
      $this->load->model('Movie_model');
      $this->load->model('Teammodel');
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
    
  public function index() {
          $data['currentPage'] = "teachers";
          $this->load->view('teachers/radio-list',$data);
  }
  
  public function date() {
          $data['currentPage'] = "teachers";
          $this->load->view('teachers/date',$data);
  }

  public function add() {
    $data['currentPage'] = "teachers";
    $data['method'] = 'add';
    $data['page']='Add Coach';
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
    
    $getpolicyaccept=$this->Teammodel->getpolicyaccept();
    $data['getpolicyaccept']=$getpolicyaccept;
    
    $getsource=$this->Teammodel->getsource();
    $data['getsource']=$getsource;
    
    $getgigcats=$this->Category_model->getgigcats();
    $data['getgigcats']=$getgigcats;
    
    $this->load->view('teachers/addRadioView',$data);
  }

  public function edit($mediaID=NULL)
  {
    $data['id'] = $mediaID;
    $data['currentPage'] = "category";
    $data['method'] = 'edit/'.$mediaID;
    $data['page']='Update Coach';
    $languageList=$this->Movie_model->getLanguageList();
    $data['languageList']=$languageList;
    $categoriesList=$this->Movie_model->getCategoriesList("3");
    $data['categoriesList']=$categoriesList;
    $filter['studentid'] = $mediaID;
    if($getData = $this->General_model->getData("student",$filter)){
        $data['media_detail']= $getData ;
    }else{
      redirect('Teachers/');
    }
    
    $getCourse=$this->Category_model->getCourse();
    $data['getCourse']=$getCourse;
    
    $getsubcat=$this->Category_model->getsubcat();
    $data['getsubcat']=$getsubcat;
    
    $getcountry=$this->Teammodel->getcountry();
    $data['getcountry']=$getcountry;
    
    $getpolicyaccept=$this->Teammodel->getpolicyaccept();
    $data['getpolicyaccept']=$getpolicyaccept;
    
    $getsource=$this->Teammodel->getsource();
    $data['getsource']=$getsource;
    
    $getgigcats=$this->Category_model->getgigcats();
        $data['getgigcats']=$getgigcats;

    $array = array(
      'student_id' => $mediaID
    );
    $data['stiudentCategory'] = $this->Common_model->getMultipleRow('stiudent_category', $array);
    
    $this->load->view('teachers/addRadioView',$data);
  }
  public function submit_teacher()
  {
    $post = $this->input->post();
    $teacher_id = $this->input->post('teacher_id');
    $method = $this->input->post('method');
    $this->form_validation->set_rules('method', 'method', 'trim|required');
    // $this->form_validation->set_rules('category_id', 'category', 'trim|required');
    // $this->form_validation->set_rules('subcat_id', 'subcategory', 'trim|required');
    $this->form_validation->set_rules('usertype', 'usertype', 'trim|required');
    $this->form_validation->set_rules('username', 'username', 'trim|required');
    $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
    $this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
    $this->form_validation->set_rules('country_code', 'country code', 'trim|required');
    $this->form_validation->set_rules('address', 'address', 'trim|required');
    $this->form_validation->set_rules('dob', 'dob', 'trim|required');
    $this->form_validation->set_rules('source', 'source', 'trim|required');
    $this->form_validation->set_rules('name_in_bank_account', 'name_in_bank_account', 'trim|required');
    $this->form_validation->set_rules('bankname', 'bankname', 'trim|required');
    $this->form_validation->set_rules('branch_name', 'branch_name', 'trim|required');
    $this->form_validation->set_rules('account_number', 'account_number', 'trim|required');
    $this->form_validation->set_rules('ifsc_code', 'ifsc_code', 'trim|required');
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
      $category_ids = $post['category_id'];
      $subcat_ids = $post['subcat_id'];
      // echo "<pre>";
      // print_r($category_ids);
      // print_r($subcat_ids);
      // die;
      unset($post['category_id']);
      unset($post['subcat_id']);
      unset($post['teacher_id']);
      $post['last_modified_date'] = date('Y-m-d h:i:s');
      $email_check=$this->Customer_regis_model->email_check($post['email'],$teacher_id);
      $mobile_check=$this->Customer_regis_model->mobile_check($post['mobile'],$teacher_id);
      if (!empty($email_check)) 
      {
        if (!empty($mobile_check)) 
        {
          if (!empty($_FILES['banner_img']['name'])) 
          {
            $image_name = "";
            $image_name_thumb = "";
            $this->load->library('upload');   
            $config['upload_path'] = UPLOAD_PATH."users/";
            $config['allowed_types'] = '*';
            $config['max_size']    = '1024';
            //$config['file_name'] = "upload";
            $this->upload->initialize($config);
            if ($this->upload->do_upload("banner_img"))
            {
              $imageArray = $this->upload->data();
              $image_name = $imageArray['raw_name'].''.$imageArray['file_ext']; // Job Attachment
              $image_name_thumb =$imageArray['raw_name'].$imageArray['file_ext'];
              $post['banner_img'] = "users/".$image_name_thumb;
              $post['banner_img_thumb'] = "users/".$image_name_thumb;
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
            if (!empty($teacher_id)) 
            {
              $response = $this->Common_model->updateData('student', $post, array('studentid' => $teacher_id));
              $this->Common_model->deleteData('stiudent_category', array('student_id' => $teacher_id ));
              foreach($category_ids as $key=>$value) {
                if($key < count($category_ids) - 1) {
                  $array = array(
                    'student_id' => $teacher_id,
                    'category_id' => $category_ids[$key],
                    'subcategory_id' => $subcat_ids[$key]
                  );
                  $this->Common_model->insertData('stiudent_category', $array);
                }
              }
            } 
            else
            {
              $post['signup_date'] = date('d-m-Y');
              $unique_id = "C".rand(10000000,99999999);
              $post['unique_id']=$unique_id;
              $response = $this->Common_model->insertData('student', $post);

              $lastId = $this->db->insert_id();
              foreach($category_ids as $key=>$value) {
                if($key < count($category_ids) - 1) {
                  $array = array(
                    'student_id' => $lastId,
                    'category_id' => $category_ids[$key],
                    'subcategory_id' => $subcat_ids[$key]
                  );
                  $this->Common_model->insertData('stiudent_category', $array);
                }
              }

              $subcat_id = $response;
              $to = $email;
              $subject = "Coach Registration successfull On Gigbag!!";
              $txt = "Account Details are given below :". "\n";
              $txt .= "Name - ".$username. "\n";
              $txt .= "Address - ".$address. "\n";
              $txt .= "Email -  ".$email. "\n";
              $txt .= "Mobile - ".$mobile. "\n";
              $txt .= "Password - ".$password. "\n";
              $txt .= "Date - ".date('d-m-y'). "\n";
              
              $headers = "From: contact@gigbag.info";

              mail($to,$subject,$txt,$headers);
              
              $to = "contact@gigbag.info";
              $subject = "Coach Registration On Gigbag - $username !!";
              $txt = "Account Details are given below :". "\n";
              $txt .= "Date - ".date('d-m-y'). "\n";
              $txt .= "Coach Id - ".$unique_id. "\n";
              $txt .= "Coach Name - ".$username. "\n";
              $txt .= "Email -  ".$email. "\n";
              $txt .= "Address - ".$address. "\n";
              $txt .= "Country Code - ".$country_code. "\n";
              $txt .= "Mobile - ".$mobile. "\n";
              $txt .= "Dob - ".$dob. "\n";
              $txt .= "Category - ".$category_id. "\n";
              $txt .= "Sub Category - ".$subcat_id. "\n";
              $txt .= "Source - ".$source. "\n";
                $txt .= "T&C & Privacypolicy - ".$policy. "\n";
              $txt .= "Name In Bank A/c - ".$name_in_bank_account. "\n";
              $txt .= "Bank Name - ".$bankname. "\n";
              $txt .= "Branch Location - ".$branch_name. "\n";
              $txt .= "A/C Number - ".$account_number. "\n";
              $txt .= "IFSC Code - ".$ifsc_code. "\n";
              $txt .= "Induction Date - ".$induction_date. "\n";
              $txt .= "Password - ".$password. "\n";
              
              $headers = "From: contact@gigbag.info";

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
      redirect(base_url('teachers/' . $method));
    } 
    else 
    {
      $data['id'] = $teacher_id;
      $data['name'] = $post['username'];
      echo json_encode($data);
    }
  }


    public function radioListwebAPI(){

        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search = $_REQUEST['search']["value"];
        
        if(isset($_REQUEST['order']))
        {
            $column_num= $_REQUEST["order"][0]['column'];
           $order= $_REQUEST["order"][0]['dir'];
           $columnName= $_REQUEST["columns"][$column_num]['data'];
            
            
        }
        else
        {
            $order='';
         $columnName='studentid';   
        }
        if($columnName=='t1.username')
        {
            $tbl='t1';
        }
        else
        {
              $tbl='t1';
        }
        
        
        

         $data = $this->db->query("SELECT t1.*,t4.subcatname,t5.category_name FROM student as t1 left join subcategory as t4 ON t1.subcat_id=t4.subcat_id left join categories as t5 ON t1.category_id=t5.category_id  where t1.usertype = 'teacher' AND t1.username LIKE '%".$search."%' ORDER BY $tbl.$columnName $order LIMIT ".$start." , ".$length." ");



        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->studentid;
          $sql = "select category_name from categories inner join stiudent_category on stiudent_category.category_id = categories.category_id where stiudent_category.student_id = ".$result[$key]->studentid;
          $studentCategory = $this->db->query($sql);
          $categoryName = "";
          $subcatname = "";
          if($studentCategory && $studentCategory->num_rows() > 0) {
            $studentCategory = $studentCategory->result_array();
            foreach($studentCategory as $catKey=>$cat) {
              if($catKey == 0) {
                $categoryName = $cat['category_name'];
              } else {
                $categoryName = $categoryName." ,".$cat['category_name'];
              }
            }
          }

          $sql1 = "select subcatname from subcategory inner join stiudent_category on stiudent_category.subcategory_id = subcategory.subcat_id  where stiudent_category.student_id = ".$result[$key]->studentid;
          $studentSubCategory = $this->db->query($sql1);
          if($studentSubCategory && $studentSubCategory->num_rows() > 0) {
            $studentSubCategory = $studentSubCategory->result_array();
            foreach($studentSubCategory as $catKey=>$cat) {
              if($catKey == 0) {
                $subcatname = $cat['subcatname'];
              } else {
                $subcatname = $subcatname." ,".$cat['subcatname'];
              }
            }
          }

          $result[$key]->category_name = $categoryName;
          $result[$key]->subcatname = $subcatname;

         $result[$key]->profile = FILE_PATH.$result[$key]->profile;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT * FROM student where usertype = 'teacher'");
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


  public function change_status(){
       $this->load->model('webservice_general_model');
       if($this->input->is_ajax_request()){
          $ID = $this->input->post('ID',TRUE);
          $isActive = $this->input->post('isActive');
          if($ID != ''){
          //$transactionId = $this->encryption->decode($transactionId);
         $filter['studentid']  = $ID;
         $setData['isActive']  = $isActive;
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
  function uploadCoachCsv()
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
       // print_r($data);die;
        $email_exist_count=0;
        $mobile_exist_count=0;
        $success_count=0;
        $insert_csv = array();
        for($i = 1, $j = count($data); $i < $j; $i++)
        { 
          $unique_id = "C".rand(10000000,99999999);
          $email_check=$this->Customer_regis_model->email_check($data[$i][1]);
          $mobile_check=$this->Customer_regis_model->mobile_check($data[$i][4]);
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
            $category_id=$this->Common_model->getColumValue('categories','category_id', array('category_name'=>$data[$i][6]));
            $subcategory_id=$this->Common_model->getColumValue('subcategory','subcat_id', array('subcatname'=>$data[$i][7],'category_id'=>$category_id));
            $insert_csv=array(
              'usertype'=>'teacher', 
              'username'=>$data[$i][0],
              'email'=>$data[$i][1],
              'address'=>$data[$i][3],
              'country_code'=>$data[$i][3],
              'mobile'=>$data[$i][4],
              'signup_date'=>date('Y-m-d h:i:s'),
              'dob'=>$data[$i][5],
              'category_id'=> $category_id,
              'subcat_id'=>$subcategory_id,
              'source'=>$data[$i][8],
              'password'=>$data[$i][9],
              'confpassword'=>$data[$i][9],
              'policy'=>$data[$i][10],
              'name_in_bank_account'=>$data[$i][11],
              'bankname'=>$data[$i][12],
              'branch_name'=>$data[$i][13],
              'account_number'=>$data[$i][14],
              'ifsc_code'=>$data[$i][15],
              'induction_date'=>$data[$i][16],
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
  


}
