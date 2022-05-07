<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categories  extends CI_Controller {

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
    public function subcategory_list($category_id='') {
      
        $data['category_id'] =$category_id;
        $data['currentPage'] = "subcategory";
        $this->load->view('subcategory/radio-list',$data);
      
    }

    public function category_list() {
      $data['currentPage'] = "category";
      $this->load->view('category/category_list',$data);
    }

       public function add($category_id='') {
        
          $data['currentPage'] = "subcategory";
          $data['category_id']= base64_decode($category_id);
          $data['method'] = 'add/'.$category_id;
          $data['page']='Add Subcategory';
          $languageList=$this->Movie_model->getLanguageList();
          $data['languageList']=$languageList;

          $categoriesList=$this->Common_model->getMultipleRow('categories');
          $data['categoriesList']=$categoriesList;
        
          $getCourse=$this->Category_model->getCourse();
          $data['getCourse']=$getCourse;
          
          $this->load->view('subcategory/addRadioView',$data);
           
    }

    public function edit($subcat_id=NULL){
        $data['id'] = $subcat_id;
        $data['currentPage'] = "subcategory";
        $data['page']='Update Subcategory';
        $data['method'] = 'edit/' . $subcat_id;
         $data['category_id']='';
        $languageList=$this->Movie_model->getLanguageList();
        $data['languageList']=$languageList;
        $categoriesList=$this->Category_model->getCourse();
        $data['categoriesList']=$categoriesList;

        $filter['subcat_id'] = $subcat_id;
        if($getData = $this->General_model->getData("subcategory",$filter)){

            $data['subcategoryData']= $getData ;
        }else{
          redirect('Categories/');
        }
        
        
        $this->load->view('subcategory/addRadioView',$data);
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
         $columnName='subcat_id';   
        }
        if($columnName=='t1.subcatname')
        {
            $tbl='t1';
        }
        else
        {
              $tbl='t1';
        }
        $where_category='';
        if (!empty($_REQUEST['category_id'])) {
          $category_id=base64_decode($_REQUEST['category_id']);
          $where_category="t1.category_id=".$category_id." AND ";
        }
        
        

         $data = $this->db->query("SELECT * FROM subcategory as t1 LEFT JOIN categories as t2 ON t1.category_id=t2.category_id where $where_category (t1.subcatname LIKE '%".$search."%' or t2.category_name LIKE '%".$search."%') ORDER BY $tbl.$columnName $order LIMIT ".$start." , ".$length." ");



        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->subcat_id;
         $result[$key]->banner_img = base_url()."".$result[$key]->banner_img;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT * FROM subcategory");
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
           $filter['subcat_id']  = $ID;
           $setData['isActive']  = $isActive;
           $id = $this->webservice_general_model->delete('subcategory',$filter,$setData);
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
   public function delete_category(){
         $this->load->model('webservice_general_model');
         if($this->input->is_ajax_request()){
            $ID = $this->input->post('ID',TRUE);
            $isActive = $this->input->post('isActive',TRUE);
            if($ID != ''){
            //$transactionId = $this->encryption->decode($transactionId);
           $filter['category_id']  = $ID;
           $setData['isActive']  = $isActive;
           $id = $this->webservice_general_model->delete('categories',$filter,$setData);
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
           $filter['subcat_id']  = $ID;
           $setData['isStatus']  = $isActive;
           $id = $this->webservice_general_model->update('subcategory',$filter,$setData);
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
  public function add_category() 
  {
    $data['currentPage'] = "category";
    $data['method'] = 'add_category';
    $data['page'] = 'Add Category';
    $languageList=$this->Movie_model->getLanguageList();
    $data['languageList']=$languageList;
    $this->load->view('category/category',$data);
  }
  public function update_category($category_id)
  {
    $data['page'] = 'Update Category';
    $data['method'] = 'update_category/' . $category_id;
    $data['categoryData'] = $this->Common_model->getSingleRow('categories', array('category_id' => base64_decode($category_id)));
     $this->load->view('category/category',$data);
    
  }
  public function submit_category()
  {

    $post = $this->input->post();
    $category_id = $this->input->post('category_id');
    $method = $this->input->post('method');
    $this->form_validation->set_rules('category_name', 'category_name', 'trim|required');
    if ($this->form_validation->run() == FALSE) {
      $data = array(
        'status' => 'danger',
        'msg' => validation_errors(),
      );
    } else {
      unset($post['method']);
      unset($post['category_id']);
      $category_check=$this->Customer_regis_model->cat_check($post['category_name'],$category_id);
      if (!empty($category_check)) 
      {
        if (!empty($category_id)) 
        {
          $response = $this->Common_model->updateData('categories', $post, array('category_id' => $category_id));
        } else {
          $response = $this->Common_model->insertData('categories', $post);
          $category_id = $response;
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
      else
      {
        $data = array(
            'status' => 'danger',
            'msg' => 'Category Already Exists',
          );
      }
      
      
    }
    if (!empty($method)) {
      $this->session->set_flashdata('message', $data);
      redirect(base_url('Categories/' . $method));
    } else {
      $data['id'] = $category_id;
      $data['name'] = $post['name'];
      echo json_encode($data);
    }
  }
  public function load_category_table_data()
    {
      $columns = array(
            0=>'category_id',
            1=>'category_name',
            2=>'is_active',
        );
      $selectArr=$columns;
      $draw = intval($this->input->post("draw"));
      $where='';
     $data=[];
      $result=$this->Category_model->get_category_table_data($columns,$where);
      if(!empty($result))
      {
          foreach($result as $key => $value)
          {
             $delete = "<button data-id='".$value->category_id."'  href='javascript:void(0);' type='button' class='btn btn-primary delete'>Delete</button>";
              $edit = "<a href='".base_url('Categories/update_category/'.base64_encode($value->category_id))."'><i class='fa fa-edit fa-lg'></i></a>";
              $view_subcategories = "<a href='".base_url('Categories/subcategory_list/'.base64_encode($value->category_id))."'>View Subcategories</a>";
            
              $data[]= array(
                  $key+1,
                  $value->category_name,
                  $view_subcategories,
                  $edit,
                  $delete
              );     
          }
      }

        $total_data = $this->Common_model->getCount('categories');
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_data,
            "recordsFiltered" => $total_data,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }
  
  public function submit_subcategory()
  {

    $post = $this->input->post();
    $subcat_id = $this->input->post('subcat_id');
    $method = $this->input->post('method');
    $category_id=$this->input->post('category_id');
    $this->form_validation->set_rules('subcatname', 'subcatname', 'trim|required');
    $this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
    if ($this->form_validation->run() == FALSE) {
      $data = array(
        'status' => 'danger',
        'msg' => validation_errors(),
      );
    }
    else 
    {

      unset($post['method']);
      unset($post['subcat_id']);

      $subcat_check=$this->Customer_regis_model->subcat_check($post['subcatname'],$category_id,$subcat_id);
      if (!empty($subcat_check)) 
      {
        if (!empty($_FILES['banner_img']['name'])) 
        {
          $image_name = "";
          $image_name_thumb = "";
          $this->load->library('upload');   
          $config['upload_path'] = "./uploads/banner/";
          $config['allowed_types'] = '*';
          $config['max_size']    = '1024';
          //$config['file_name'] = "upload";
          $this->upload->initialize($config);
          if ($this->upload->do_upload("banner_img"))
          {
            $imageArray = $this->upload->data();
            $image_name = $imageArray['raw_name'].''.$imageArray['file_ext']; // Job Attachment
            $image_name_thumb =$imageArray['raw_name'].$imageArray['file_ext'];
            $post['banner_img'] = "/uploads/banner/".$image_name_thumb;
            $post['banner_img_thumb'] = "/uploads/banner/".$image_name_thumb;
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
          if (!empty($subcat_id)) 
          {
            $response = $this->Common_model->updateData('subcategory', $post, array('subcat_id' => $subcat_id));
          } 
          else
          {
            $response = $this->Common_model->insertData('subcategory', $post);
            $subcat_id = $response;
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
            'msg' => 'Subcategory already exists in same category',
          );
      }
    }  
    if (!empty($method)) 
    {
      $this->session->set_flashdata('message', $data);
      redirect(base_url('categories/' . $method));
    } 
    else 
    {
      $data['id'] = $subcat_id;
      $data['name'] = $post['name'];
      echo json_encode($data);
    }
  }

  public function add_radio(){
        
      $subcatname=$this->input->post('subcatname');
      $category_id=$this->input->post('category_name');
      $radio_id = $this->input->post('radioID');
     
      $insertdata=array(
        'subcatname'=>$subcatname,
        'category_name'=>$category_id,
         );
        if($_FILES)
       
        $image_name = "";
        $image_name_thumb = "";
        $this->load->library('upload');   
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT']."/admin/uploads/banner/";
        $config['allowed_types'] = '*';
        $config['max_size']    = '1024';
        //$config['file_name'] = "upload";

        $this->upload->initialize($config);
        $certificateflag = $this->upload->do_upload("banner_img");       
        if ($this->upload->do_upload("banner_img"))
        {
        
        $imageArray = $this->upload->data();

        $image_name = $imageArray['raw_name'].''.$imageArray['file_ext']; // Job Attachment
        
        $image_name_thumb =$imageArray['raw_name'].$imageArray['file_ext'];
        $filterImage['subcat_id'] = $radio_id;
        $setIcon['banner_img'] = "/uploads/banner/".$image_name_thumb;
          $setIcon['banner_img_thumb'] = "/uploads/banner/".$image_name_thumb;
          
          $userDetailid = $this->General_model->update('subcategory', $filterImage,$setIcon);
      
        $coupon_check=$this->Customer_regis_model->cat_check($insertdata['category_name']);
        $couponnumber_check=$this->Customer_regis_model->subcat_check($insertdata['subcatname']);
        if($coupon_check & $couponnumber_check){
        $this->Customer_regis_model->catadd($insertdata);
        
      }else{

        $filterD['subcat_id'] =  $radio_id;
        $this->General_model->update('subcategory', $filterD,$insertdata);
        $radioID = $radio_id;
      }


        if($_FILES)
       
        $image_name = "";
        $image_name_thumb = "";
        $this->load->library('upload');   
        $config['upload_path'] = $_SERVER['DOCUMENT_ROOT']."/admin/uploads/banner/";
        $config['allowed_types'] = '*';
        $config['max_size']    = '1024';
        //$config['file_name'] = "upload";

        $this->upload->initialize($config);
        $certificateflag = $this->upload->do_upload("banner_img");       
        if ($this->upload->do_upload("banner_img")){
        
        $imageArray = $this->upload->data();

        $image_name = $imageArray['raw_name'].''.$imageArray['file_ext']; // Job Attachment
        
        $image_name_thumb =$imageArray['raw_name'].$imageArray['file_ext'];
        $filterImage['subcat_id'] = $radio_id;
        $setIcon['banner_img'] = "/uploads/banner/".$image_name_thumb;
          $setIcon['banner_img_thumb'] = "/uploads/banner/".$image_name_thumb;
          
          $userDetailid = $this->General_model->update('subcategory', $filterImage,$setIcon);
          
            echo "<script>alert('Category or sub category already exist / category updated  !!'); window.location.href='https://gigbag.winworldtechs.com/admin/Categories/';</script>";
            
        }else{
            echo "<script>alert('Category added  !!'); window.location.href='https://gigbag.winworldtechs.com/admin/Categories/';</script>";
        }
        
      
        }
    }

  


}
