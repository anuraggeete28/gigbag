<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gig  extends CI_Controller {

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
            $data['currentPage'] = "gig";
            $this->load->view('gig/radio-list',$data);
    }

    public function add() 
    {
      $data['currentPage'] = "gig";
      $data['method'] = 'add';
      $data['page']='Add Gig';
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
      
      $gettypeofclass=$this->Category_model->gettypeofclass();
      $data['gettypeofclass']=$gettypeofclass;
      
      $gettrescheduling=$this->Category_model->gettrescheduling();
      $data['gettrescheduling']=$gettrescheduling;
      
      $getcoupon=$this->Category_model->getcoupon();
      $data['getcoupon']=$getcoupon;
      
      $getcouponnum=$this->Category_model->getcouponnum();
      $data['getcouponnum']=$getcouponnum;
      
      $getcoupondis=$this->Category_model->getcoupondis();
      $data['getcoupondis']=$getcoupondis;

      $section_category=$this->Common_model->getMultipleRow('section_categories',array('status'=>1));
      $data['section_category']=$section_category;

      
    
      $this->load->view('gig/addRadioView',$data);
    }

    public function edit($mediaID=NULL){
        $data['id'] = $mediaID;
        $data['currentPage'] = "gig";
       $data['currentPage'] = "gig";
      $data['method'] = 'add';
      $data['page']='Add Gig';
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
      
      $gettypeofclass=$this->Category_model->gettypeofclass();
      $data['gettypeofclass']=$gettypeofclass;
      
      $gettrescheduling=$this->Category_model->gettrescheduling();
      $data['gettrescheduling']=$gettrescheduling;
      
      $getcoupon=$this->Category_model->getcoupon();
      $data['getcoupon']=$getcoupon;
      
      $getcouponnum=$this->Category_model->getcouponnum();
      $data['getcouponnum']=$getcouponnum;
      
      $getcoupondis=$this->Category_model->getcoupondis();
      $data['getcoupondis']=$getcoupondis;
      
      $section_category=$this->Common_model->getMultipleRow('section_categories',array('status'=>1));
      $data['section_category']=$section_category;
        $filter['category_id'] = $mediaID;
        if($getData = $this->General_model->getData("gigs",$filter)){
            $data['media_detail']= $getData ;
        }else{
          redirect('Gig/');
        }
      $this->load->view('gig/addRadioView',$data);
    }


     public function add_radio(){
         
      $createdate = date('d-m-Y');
      $gigid=$this->input->post('gigid');
      $subcat_id=$this->input->post('subcat_id');
      $category_name=$this->input->post('subcatname');
      $carddescription=$this->input->post('carddescription');
      $base=$this->input->post('base');
      $sessions=$this->input->post('sessions');
      $maxstudents=$this->input->post('maxstudents');
      //$couponnumber=$this->input->post('couponnumber');
      $couponcode=$this->input->post('couponcode');
      //$discountrate=$this->input->post('discountrate');
      //$finalgigfees=$this->input->post('finalgigfees');
      $teacherfee_per_session=$this->input->post('teacherfee_per_session');
      //$teacher_gig_fees=$this->input->post('teacher_gig_fees');
      $portal_margin_per_session=$this->input->post('portal_margin_per_session');
      $ctype_of_class=$this->input->post('type_of_class');
      $state=$this->input->post('state_id');
      $country=$this->input->post('country_id');
      $session_duration_in_hours=$this->input->post('session_duration_in_hours');
      $crescheduling_allowed=$this->input->post('rescheduling_allowed');
      $usdrate=$this->input->post('usdrate');
      $radio_id = $this->input->post('radioID');
     
      $insertdata=array(
        'createdate'=>$createdate,
        'gigid'=>$gigid,
        //'category_name'=>implode(",",$this->input->post('category_name')),
        'subcatname'=> $category_name,
        'subcat_id'=>$subcat_id,
        'carddescription'=>$carddescription,
        'base'=>$base,
        'sessions'=>$sessions,
        'maxstudents'=>$maxstudents,
        'gigfees'=>$base*$sessions,
        'gigfeeusd'=>$base*$sessions/$usdrate,
        'finalgigfeeusd'=>$base*$sessions/$usdrate,
        'couponcode'=>$couponcode,
        'finalgigfees'=>$base*$sessions,
        'teacherfee_per_session'=>$teacherfee_per_session,
        'teacher_gig_fees'=>$sessions*$teacherfee_per_session,
        'portal_margin_per_session'=>$base*$sessions-$sessions*$teacherfee_per_session,
        'type_of_class'=>$ctype_of_class,
        'state_id'=>$state,
        'country_id'=>$country,
        'session_duration_in_hours'=>$session_duration_in_hours,
        'rescheduling_allowed'=>$crescheduling_allowed,
        'usdrate'=>$usdrate
         );

      if($radio_id == ""){
        $radioID = $this->General_model->insert('gigs', $insertdata);
      }else{

        $filterD['category_id'] =  $radio_id;
        $this->General_model->update('gigs', $filterD,$insertdata);
        $radioID = $radio_id;
      }


        if($_FILES)
       
        $image_name = "";
        $image_name_thumb = "";
        $this->load->library('upload');   
        $config['upload_path'] = UPLOAD_PATH."gigs/";
        $config['allowed_types'] = '*';
        //$config['max_size']    = '100000000';
        //$config['file_name'] = "upload";

        $this->upload->initialize($config);
        $certificateflag = $this->upload->do_upload("banner_img");       
        if ($this->upload->do_upload("banner_img")){
        
        $imageArray = $this->upload->data();

        $image_name = $imageArray['raw_name'].''.$imageArray['file_ext']; // Job Attachment
        
        $image_name_thumb =$imageArray['raw_name'].$imageArray['file_ext'];
        $filterImage['category_id'] = $radioID;
        $setIcon['banner_img'] = "/uploads/banner/".$image_name_thumb;
          $setIcon['banner_img_thumb'] = "/uploads/banner/".$image_name_thumb;
          
          $userDetailid = $this->General_model->update('gigs', $filterImage,$setIcon);
          
            redirect('Gig/');
            
        
            
            
        }else{
            redirect('Gig/');
            echo "<pre>"; Print_r($this->upload->data()); echo "</pre>";
        }
        
        
        
    }



  public function radioListwebAPI()
  {
        // $start = $_REQUEST['start'];
        // $length = $_REQUEST['length'];
        // $search = $_REQUEST['search']["value"];

        
        // if(isset($_REQUEST['order']))
        // {
        //   $column_num= $_REQUEST["order"][0]['column'];
        //   $order= $_REQUEST["order"][0]['dir'];
        //   $columnName= $_REQUEST["columns"][$column_num]['data'];
        // }
        // else
        // {
        //   $order='';
        //  $columnName='gigid';   
        // }
        
        $data = $this->db->query("SELECT  t1.*,t2.country,cat.category_name,sub4.subcatname,t3.state  FROM gigs as t1 LEFT JOIN countries as t2 ON t2.country_id = t1.country_id LEFT join categories as cat ON cat.category_id=t1.category_id LEFT join subcategory as sub4 ON sub4.subcat_id=t1.subcat_id left join states as t3 ON t3.state_id = t1.state_id");



        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->gigid;
           $result[$key]->banner_img = FILE_PATH.$result[$key]->banner_img;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT * FROM gig_orders");
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
           $filter['category_id']  = $ID;
           $setData['isActive']  = $isActive;
           $id = $this->webservice_general_model->delete('gigs',$filter,$setData);
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
           $filter['category_id']  = $ID;
           $setData['isStatus']  = $isActive;
           $id = $this->webservice_general_model->update('gigs',$filter,$setData);
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

   public function submit_gig()
  {

    $post = $this->input->post();
    $gig_id = $this->input->post('gig_id');
    $method = $this->input->post('method');
    //print_r($this->input->post());die;
    $this->form_validation->set_rules('method', 'method', 'trim|required');

    $this->form_validation->set_rules('base', 'base', 'trim|required');
    $this->form_validation->set_rules('sessions', 'sessions', 'trim|required');
     $this->form_validation->set_rules('section_category', 'section_category', 'trim|required');
    $this->form_validation->set_rules('rescheduling_allowed', 'rescheduling_allowed code', 'trim|required');
    $this->form_validation->set_rules('session_duration_in_hours', 'session_duration_in_hours', 'trim|required');
    $this->form_validation->set_rules('type_of_class', 'type_of_class', 'trim|required');
    if ($this->form_validation->run() == FALSE) {
      $data = array(
        'status' => 'danger',
        'msg' => validation_errors(),
      );
    }
    else 
    {
      extract($post);
      if ($standerd_gig_fee<$finalgigfees) 
      {
        $data = array(
          'status' => 'danger',
          'msg' => "Final gig fee should be less then standerd gig fee",
        );
      }
      else
      {
        unset($post['method']);
        unset($post['gig_id']);
        $category_data=$this->General_model->getData("categories",array('category_id'=>$category_id));
        $gig_last_count= $category_data->gig_last_count+1;
        $category_name= strtoupper(substr($category_data->category_name, 0, 3));
        $usdratedata=$this->General_model->getData("rate_coversion");
        if (empty( $usdratedata)) {
          $data = array(
            'status' => 'danger',
            'msg' => 'Rate convertion not available',
          );
        }
        else
        {
          $usdrate=$usdratedata->inr;
          $insertdata=array(
            'createdate'=>date('Y-m-d h:i:s'),
            'category_id'=> $category_id,
            'subcat_id'=>$subcat_id,
            'carddescription'=>$carddescription,
            'base'=>$base,
            'sessions'=>$sessions,
            'maxstudents'=>$maxstudents,
            'gigfees'=>$base*$sessions,
            'gigfeeusd'=>$base*$sessions/$usdrate,
            'finalgigfees'=>$finalgigfees,
            'finalgigfeeusd'=>$finalgigfees/$usdrate,
            'type_of_class'=>$type_of_class,
            'state_id'=>$state_id,
            'country_id'=>$country_id,
            'section_category'=>$section_category,
            'session_duration_in_hours'=>$session_duration_in_hours,
            'rescheduling_allowed'=>$rescheduling_allowed,
            'usdrate'=>$usdrate
           );
     
          if (!empty($_FILES['banner_img']['name'])) 
          {
            $image_name = "";
            $image_name_thumb = "";  
            $config['upload_path'] = UPLOAD_PATH."gigs/";
            $config['allowed_types'] = '*';
           // $config['max_size']    = '100000000';
            //$config['file_name'] = "upload";
           // print_r($config);die;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("banner_img"))
            {
              $imageArray = $this->upload->data();
              $image_name = $imageArray['raw_name'].''.$imageArray['file_ext']; // Job Attachment
              $image_name_thumb =$imageArray['raw_name'].$imageArray['file_ext'];
              $insertdata['banner_img'] = "gigs/".$image_name_thumb;
              $insertdata['banner_img_thumb'] = "gigs/".$image_name_thumb;
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
            if (!empty($gig_id)) 
            {
              unset($insertdata['createdate']);
              $response = $this->Common_model->updateData('gigs', $insertdata, array('gig_id' => $gig_id));
            } 
            else
            {
           
              $response = $this->Common_model->insertData('gigs', $insertdata);
              $gig_id = $response;
             $gigid= $category_name.sprintf("%'.05d\n", $gig_last_count);
              $this->Common_model->updateData('gigs', array('gigid'=>$gigid), array('gig_id' => $gig_id));
              $this->Common_model->updateData('categories', array('gig_last_count'=>$gig_last_count), array('category_id' => $category_id));
             
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
      }  
    }
    if (!empty($method)) 
    {
      $this->session->set_flashdata('message', $data);
      redirect(base_url('gig/' . $method));
    } 
    else 
    {
      $data['id'] = $gig_id;
      echo json_encode($data);
    }
  }
  


}
