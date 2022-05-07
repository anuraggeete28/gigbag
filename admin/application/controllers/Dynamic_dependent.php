<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dynamic_dependent extends CI_Controller {
 
 public function __construct()
 {
  parent::__construct();
  $this->load->model('Dynamic_dependent_model');
 }

 function index()
 {
  $data['country'] = $this->Dynamic_dependent_model->fetch_country();
  $this->load->view('dynamic_dependent', $data);
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
  
}