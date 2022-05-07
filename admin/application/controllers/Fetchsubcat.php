<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fetchsubcat  extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        
        $this->load->model('Dynamic_dependent_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }


function Fetch_catgry()
 {
  if($this->input->post('subcat_id'))
  {
   echo $this->Dynamic_dependent_model->Fetch_category($this->input->post('subcat_id'));
  }
 }
 function Fetch_subcatgry()
 {
  if($this->input->post('category_id'))
  {
   echo $this->Dynamic_dependent_model->Fetch_subcategory($this->input->post('category_id'));
  }
 }




  


}
