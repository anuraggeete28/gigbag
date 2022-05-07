<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exportclass extends CI_Controller {
 
 public function __construct()
 {
  parent::__construct();
  $this->load->model('Export_csv_model');
 }

 function index()
 {
  $data['student_data'] = $this->Export_csv_model->fetchclass();
  $this->load->view('export_csv', $data);
 }

 function export()
 {
  $file_name = 'Classdata'.date('dmY').'.csv'; 
     header("Content-Description: File Transfer"); 
     header("Content-Disposition: attachment; filename=$file_name"); 
     header("Content-Type: application/csv;");
   
     // get data 
     $student_data = $this->Export_csv_model->fetchclass();

     // file creation 
     $file = fopen('php://output', 'w');
 
     $header = array("Id","Modified Date","Student id","Teacher id","Gig id","Coupon code","Start date","Class start time","End date","Class id","Status","Paid"); 
     fputcsv($file, $header);
     foreach ($student_data->result_array() as $key => $value)
     { 
       fputcsv($file, $value); 
     }
     fclose($file); 
     exit; 
 }
 
  
}

