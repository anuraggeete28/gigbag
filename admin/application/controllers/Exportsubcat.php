<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exportsubcat extends CI_Controller {
 
 public function __construct()
 {
  parent::__construct();
  $this->load->model('Export_csv_model');
 }

 function index()
 {
  $data['student_data'] = $this->Export_csv_model->fetchsubcat();
  $this->load->view('export_csv', $data);
 }

 function export()
 {
  $file_name = 'Category'.date('dmY').'.csv'; 
     header("Content-Description: File Transfer"); 
     header("Content-Disposition: attachment; filename=$file_name"); 
     header("Content-Type: application/csv;");
   
     // get data 
     $student_data = $this->Export_csv_model->fetchsubcat();

     // file creation 
     $file = fopen('php://output', 'w');
 
     $header = array("Id","Categories","Sub categories"); 
     fputcsv($file, $header);
     foreach ($student_data->result_array() as $key => $value)
     { 
       fputcsv($file, $value); 
     }
     fclose($file); 
     exit; 
 }
 
 function export_category()
 {
  $file_name = 'Category'.date('dmY').'.csv'; 
     header("Content-Description: File Transfer"); 
     header("Content-Disposition: attachment; filename=$file_name"); 
     header("Content-Type: application/csv;");
   
     // get data 
     $student_data = $this->Export_csv_model->fetchcat();

     // file creation 
     $file = fopen('php://output', 'w');
 
     $header = array("Id","Categories"); 
     fputcsv($file, $header);
     foreach ($student_data->result_array() as $key => $value)
     { 
       fputcsv($file, $value); 
     }
     fclose($file); 
     exit; 
 }

 function export_user()
 {
    $file_name = 'User'.date('dmY').'.csv'; 
     header("Content-Description: File Transfer"); 
     header("Content-Disposition: attachment; filename=$file_name"); 
     header("Content-Type: application/csv;");
   
     // get data 
     $student_data = $this->Export_csv_model->fetchuser();

     // file creation 
     $file = fopen('php://output', 'w');
 
     $header = array("Id","username","email","mobile","user_type"); 
     fputcsv($file, $header);
     foreach ($student_data->result_array() as $key => $value)
     { 
       fputcsv($file, $value); 
     }
     fclose($file); 
     exit; 
 }
 
  
}

