<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Aboutus  extends CI_Controller {

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
            $data['currentPage'] = "aboutus";
            $this->load->view('aboutus/radio-list',$data);
    }

       public function add() {
             if($this->input->post('add_radio'))
    
            $data['currentPage'] = "aboutus";
            $languageList=$this->Movie_model->getLanguageList();
            $data['languageList']=$languageList;

            $categoriesList=$this->Movie_model->getCategoriesList("3");
            $data['categoriesList']=$categoriesList;
            
            $getCourse=$this->Category_model->getCourse();
            $data['getCourse']=$getCourse;
            
            $this->load->view('aboutus/addRadioView',$data);
    }

    public function edit($mediaID=NULL){
        $data['id'] = $mediaID;
        $data['currentPage'] = "aboutus";
        $languageList=$this->Movie_model->getLanguageList();
        $data['languageList']=$languageList;
        $categoriesList=$this->Movie_model->getCategoriesList("3");
        $data['categoriesList']=$categoriesList;
        $filter['aboutusid'] = $mediaID;
        if($getData = $this->General_model->getData("aboutus",$filter)){
            $data['media_detail']= $getData ;
        }else{
          redirect('Aboutus/');
        }
        
        $getCourse=$this->Category_model->getCourse();
        $data['getCourse']=$getCourse;
        
        $this->load->view('aboutus/addRadioView',$data);
    }


     public function add_radio(){
         
      $description=$this->input->post('description');
      $radio_id = $this->input->post('radioID');
     
      $insertdata=array(
        'description'=>$description
         );

      if($radio_id == ""){
        $radioID = $this->General_model->insert('aboutus', $insertdata);
      }else{

        $filterD['aboutusid'] =  $radio_id;
        $this->General_model->update('aboutus', $filterD,$insertdata);
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
        $filterImage['aboutusid'] = $radioID;
        $setIcon['banner_img'] = "/uploads/banner/".$image_name_thumb;
          $setIcon['banner_img_thumb'] = "/uploads/banner/".$image_name_thumb;
          
          $userDetailid = $this->General_model->update('aboutus', $filterImage,$setIcon);
          
            redirect('Aboutus/');
            
        
            
            
        }else{
            redirect('Aboutus/');
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
         $columnName='aboutusid';   
        }
        if($columnName=='description')
        {
            $tbl='aboutus';
        }
        else
        {
              $tbl='aboutus';
        }
        
        
        

         $data = $this->db->query("SELECT * FROM aboutus where description LIKE '%".$search."%' ORDER BY $tbl.$columnName $order LIMIT ".$start." , ".$length." ");



        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->aboutusid;
         $result[$key]->banner_img = base_url()."".$result[$key]->banner_img;
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT * FROM aboutus");
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
           $filter['aboutusid']  = $ID;
           $setData['isActive']  = $isActive;
           $id = $this->webservice_general_model->delete('aboutus',$filter,$setData);
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
           $filter['aboutusid']  = $ID;
           $setData['isStatus']  = $isActive;
           $id = $this->webservice_general_model->update('aboutus',$filter,$setData);
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
