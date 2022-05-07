<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orders  extends CI_Controller {

    private $_user;

    public function __construct() {
        parent::__construct();
        // Load form validation library
        $this->load->library('form_validation');
        $this->load->model('Customer_regis_model');
        $this->load->model('General_model');
        $this->load->model('Category_model');
        $this->load->model('Common_model');
        $this->load->model('Movie_model');
        if (!isset($this->session->userdata['user'])) {
            redirect('login');
        } else {
            $this->_user = $this->session->userdata['user'];
        }
    }

    public function orders_list() {
      $data['currentPage'] = "orders";
      $this->load->view('orders/orders_list',$data);
    }

    public function orderListwebAPI(){
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search = $_REQUEST['search']["value"];

        
        if(isset($_REQUEST['order']))
        {
          $column_num= $_REQUEST["order"][0]['column'];
          $order= $_REQUEST["order"][0]['dir'];
          $columnName= $_REQUEST["columns"][$column_num]['data'];
            
            
        }
        else
        {
          $order='';
         $columnName='id';   
        }
        $data = $this->db->query("SELECT t1.*,t2.username as student_name,t3.gigid ,IFNULL(t4.transaction_id,'N/A') as transaction_id, IFNULL(t4.transaction_status,'Pending') as transaction_status FROM gig_orders as t1 LEFT JOIN student as t2 ON t2.studentid=t1.student_id LEFT JOIN gigs as t3 ON t3.gig_id=t1.gig_id LEFT JOIN transactions as t4 ON t4.order_id=t1.id  where (t1.order_id LIKE '%".$search."%' or t2.username LIKE '%".$search."%' or t3.gigid LIKE '%".$search."%') ORDER BY t1.$columnName $order LIMIT ".$start." , ".$length." ");



        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
          $result[$key]->action = "<a student-id='".$result[$key]->student_id."' class='btn btn-info text-white studentInfo'>Show Student Info</a>
          <a order-id='".$result[$key]->id."' row-id='DT_RowId_".$result[$key]->id."' order-status='".$result[$key]->order_status."' class='btn btn-info text-white updateStatus'>Update Status</a>
          ";
        }
        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT * FROM gig_orders");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();

        echo json_encode($data1);

 }

    public function demo_bookings_list() {
      $data['currentPage'] = "Demo Bookings";
      $this->load->view('orders/demo_bookings_list',$data);
    }
    public function demoBookingListwebAPI(){

        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $search = $_REQUEST['search']["value"];

        
        if(isset($_REQUEST['order']))
        {
          $column_num= $_REQUEST["order"][0]['column'];
          $order= $_REQUEST["order"][0]['dir'];
          $columnName= $_REQUEST["columns"][$column_num]['data'];
            
            
        }
        else
        {
          $order='';
         $columnName='id';   
        }
        $data = $this->db->query("SELECT t1.*,t2.username as student_name,t3.category_name,t4.type_of_class FROM demo_bookings as t1 LEFT JOIN student as t2 ON t2.studentid=t1.student_id LEFT JOIN categories as t3 ON t3.category_id=t1.gig_category_id LEFT JOIN typeofclass as t4 ON t4.classtype_id=t1.gig_type_id  where (t1.booking_id LIKE '%".$search."%' or t2.username LIKE '%".$search."%' or t3.category_name LIKE '%".$search."%') order BY t1.$columnName $order LIMIT ".$start." , ".$length." ");



        $result = $data->result();
        foreach ($result as $key => $value) {
          $result[$key]->DT_RowId = "DT_RowId_".$result[$key]->id;
          $result[$key]->action = "<a student-id='".$result[$key]->student_id."' class='btn btn-info studentInfo text-white'>Show Student Info</a>
          <a booking-id='".$result[$key]->id."' row-id='DT_RowId_".$result[$key]->id."' booking-status='".$result[$key]->booking_status."' class='btn btn-info text-white updateStatus'>Update Status</a>
          ";
        }

        $data1['data'] = $result;
        $data1['recordsTotal'] = $data->num_rows();

        $data12 = $this->db->query("SELECT * FROM demo_bookings");
        $result1 = $data12->result();
        $data1['recordsFiltered'] = $data12->num_rows();
        echo json_encode($data1);

 }

 public function addOrder(){

  $data['currentPage'] = "Add Order";
  
  $coupon = $this->Common_model->getMultipleRow("coupon", [
    "startdate <=" => date("Y-m-d"),
    "enddate >=" => date("Y-m-d"),
  ]);
 
  $data['coupon'] = $coupon;

  $classes = $this->Common_model->getMultipleRow("classes");
  $data['classes'] = $classes;

  $getstudentsidss=$this->Category_model->getstudentsidss();
  $data['getstudentsidss']=$getstudentsidss;

  $this->load->view('orders/addRadioView',$data);

}

public function add_radio(){
  print_r($_POST);
  die;
}

public function bookingStatusUpdate()
{
  $id = $this->input->post('id');
  $booking_status = $this->input->post('booking_status');
  $insertdata=array(
    'booking_status'=>$booking_status
  );
  $this->load->database();
  $this->db->where('id', $id);
	$this->db->update('demo_bookings', $insertdata);
  echo json_encode(
    array(
      'status' => true,
      'message' => 'Status Upadated Successfully',
      'data' => $_POST
    )
  );
}


public function orderStatusUpdate()
{
  $id = $this->input->post('id');
  $order_status = $this->input->post('order_status');
  $insertdata=array(
    'order_status'=>$order_status
  );
  $this->load->database();
  $this->db->where('id', $id);
	$this->db->update('gig_orders', $insertdata);
  echo json_encode(
    array(
      'status' => true,
      'message' => 'Status Upadated Successfully',
      'data' => $_POST
    )
  );
}


}
