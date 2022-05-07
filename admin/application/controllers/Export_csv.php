<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export_csv extends CI_Controller {
 
 public function __construct()
 {
  parent::__construct();
  $this->load->model('Export_csv_model');
 }

 function index()
 {
  $data['student_data'] = $this->Export_csv_model->fetch_data();
  $this->load->view('export_csv', $data);
 }

 function export()
 {
    $file_name = 'Coachdata'.date('dmY').'.csv'; 
   header("Content-Description: File Transfer"); 
   header("Content-Disposition: attachment; filename=$file_name"); 
   header("Content-Type: application/csv;");
 
   // get data 
   $student_data = $this->Export_csv_model->fetch_data();

   // file creation 
   $file = fopen('php://output', 'w');

   $header = array("Id","Coach Id","Coach Name","Email","Address","Country Code","Mobile","Date of birth","Category Name","Sub Category","Status","Source","T&C & Privacypolicy","Name in bank account","Bank Name","Branch Location","Account Number","IFSC Code","Induction Date"); 
   fputcsv($file, $header);
   foreach ($student_data->result_array() as $key => $value)
   { 
     fputcsv($file, $value); 
   }
   fclose($file); 
   exit; 
 }
  function download_student_sample()
  {
    $file_name = 'Student Sample'.date('dmY').'.csv'; 
    header("Content-Description: File Transfer"); 
    header("Content-Disposition: attachment; filename=$file_name"); 
    header("Content-Type: application/csv;");
    $file = fopen('php://output', 'w');

    $header = array("Username","Email","Address","Country Code","Country","State","Mobile","Guardian","Date of birth","Category Name","Sub Category","Source","Referal","Password","Policy"); 
    fputcsv($file, $header);
    $value=array("Test","test@gmail.com","Test address","India (+91)","India","Madhya Pradesh","9876543210","Guardian","1995-01-01","Vocal","Karnatic","Source","Referal","123456","YES/NO"); 
    fputcsv($file, $value); 

    fclose($file); 
    exit; 
        
  }

  function download_coach_sample()
  {
    $file_name = 'Coach Sample'.date('dmY').'.csv'; 
    header("Content-Description: File Transfer"); 
    header("Content-Disposition: attachment; filename=$file_name"); 
    header("Content-Type: application/csv;");
    $file = fopen('php://output', 'w');

    $header = array("Coach Name","Email","Address","Country Code","Mobile","Date of birth","Category Name","Sub Category","Source","Password","T&C & Privacypolicy","Name in bank account","Bank Name","Branch Location","Account Number","IFSC Code","Induction Date"); 
    fputcsv($file, $header);
    $value=array("Test","test@gmail.com","Test address","India (+91)","9876543210","1995-01-01","Vocal","Karnatic","Source","123456","YES/NO","Name","Bank Of India","Indore","123456789","BKID00009809","2020-01-01"); 
    fputcsv($file, $value); 

    fclose($file); 
    exit; 
        
  }
 
  
}

