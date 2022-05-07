<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exportstudentsdata extends CI_Controller {
 
 public function __construct()
 {
  parent::__construct();
  $this->load->model('Export_csv_model');
 }

 function index()
 {
  $data['student_data'] = $this->Export_csv_model->fetch_studata();
  $this->load->view('export_csv', $data);
 }

 function export()
 {
  $file_name = 'studentsdata'.date('dmY').'.csv'; 
     header("Content-Description: File Transfer"); 
     header("Content-Disposition: attachment; filename=$file_name"); 
     header("Content-Type: application/csv;");
   
     // get data 
     $student_data = $this->Export_csv_model->fetch_studata();

     // file creation 
     $file = fopen('php://output', 'w');
 
     $header = array("Id","Modified Date","Student Id","Name","Email","Address","State","Country","Country Code","Mobile","Date of birth","Category","Sub Category","Referal","Guardian","Status","Source","T&C & PrivacyPolicy"); 
     fputcsv($file, $header);
     foreach ($student_data->result_array() as $key => $value)
     { 
       fputcsv($file, $value); 
     }
     fclose($file); 
     exit; 
 }
 
  
}

