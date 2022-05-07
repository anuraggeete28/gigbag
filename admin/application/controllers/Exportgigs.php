<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exportgigs extends CI_Controller {
 
 public function __construct()
 {
  parent::__construct();
  $this->load->model('Export_csv_model');
 }

 function index()
 {
  $data['student_data'] = $this->Export_csv_model->fetchgigs();
  $this->load->view('export_csv', $data);
 }

 function export()
 {
   
  $file_name = 'Gigsdata'.date('dmY').'.csv'; 
     header("Content-Description: File Transfer"); 
     header("Content-Disposition: attachment; filename=$file_name"); 
     header("Content-Type: application/csv;");
     
     // get data 
     $student_data = $this->Export_csv_model->fetchgigs();
     // file creation 
     $file = fopen('php://output', 'w');
     
     $header = array("Modified Date","Gig Id","Category","Sub Category","Card Description","Base","Sessions","Max number of students","Gig fee(INR)","Gig fee(USD)","Coupon code","Final gig fee(INR)","Final gig fee(USD)","Teacher fee per session","Teacher gig fee(INR)","Portal gig fee","Type of class","State","Country","Session duration in hours","Rescheduling allowed"); 
     fputcsv($file, $header);
     foreach ($student_data->result_array() as $key => $value)
     { 
       fputcsv($file, $value); 
     }
     fclose($file); 
     exit; 
 }
 
  
}

