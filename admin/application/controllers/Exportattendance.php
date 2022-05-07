<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exportattendance extends CI_Controller {
 
 public function __construct()
 {
  parent::__construct();
  $this->load->model('Export_csv_model');
 }

 function index()
 {
  $data['student_data'] = $this->Export_csv_model->fetchattendance();
  $this->load->view('export_csv', $data);
 }

 function export()
 {
  $file_name = 'Attendancedata'.date('dmY').'.csv'; 
     header("Content-Description: File Transfer"); 
     header("Content-Disposition: attachment; filename=$file_name"); 
     header("Content-Type: application/csv;");
     // get data 
     $student_data = $this->Export_csv_model->fetchattendance();
     // file creation 
     $file = fopen('php://output', 'w');
 
     $header = array("Id","Modified date","Serial number","Date","Time","Duration","Class id","Remark","Teacher id","Start time","Start otp","End time","Student id","End otp","Gig id","Virtual link","Classroom link"); 
     fputcsv($file, $header);
     foreach ($student_data->result_array() as $key => $value)
     { 
       fputcsv($file, $value); 
     }
     fclose($file); 
     exit; 
 }
 
  
}

