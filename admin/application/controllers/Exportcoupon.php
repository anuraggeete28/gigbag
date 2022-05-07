<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exportcoupon extends CI_Controller {
 
 public function __construct()
 {
  parent::__construct();
  $this->load->model('Export_csv_model');
 }

 function index()
 {
  $data['student_data'] = $this->Export_csv_model->fetchcoupon();
  $this->load->view('export_csv', $data);
 }

 function export()
 {
  $file_name = 'Coupondata'.date('dmY').'.csv'; 
     header("Content-Description: File Transfer"); 
     header("Content-Disposition: attachment; filename=$file_name"); 
     header("Content-Type: application/csv;");
   
     // get data 
     $student_data = $this->Export_csv_model->fetchcoupon();

     // file creation 
     $file = fopen('php://output', 'w');
 
     $header = array("Id","Coupon number","Coupon code","Discount rate","Available coupon","Consum coupon","Start date","End date"); 
     fputcsv($file, $header);
     foreach ($student_data->result_array() as $key => $value)
     { 
       fputcsv($file, $value); 
     }
     fclose($file); 
     exit; 
 }
 
  
}

