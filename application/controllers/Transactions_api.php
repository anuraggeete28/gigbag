<?php
require_once("application/core/MYREST_Controller.php");
class Transactions_api extends MYREST_Controller{
    
    public function __construct()
    {
        parent::__construct();
    } 

    public function transactions_list_post()
    {  
        $post_data=$this->input->post();
        $post_data['user_id']=$this->user_id;
        $transctions=$this->Common_model->get_transactions($post_data);
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successful';
        $response['data']= $transctions;
        $this->response($response,$status);
    }

    public function wallet_balance_get()
    {
        $user_id = $this->user_id;
        $check_gig=$this->Common_model->getSingleRow('student','wallet_amount',array('studentid'=>$user_id));

        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
        if (empty($check_gig)) 
        {
            $response['status']=false;
            $response['message']='Invalid gig';
            $this->response($response,$status);
        } 
        else
        {
            $status = parent::HTTP_OK;
            $response['status']=true;
            $response['message']='Successful';
            $response['data']= $check_gig;  
            $this->response($response,$status);
        }
    }

    public function wallet_balance_post()
    {


        $post=$this->input->post();
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
        if (!$this->form_validation->run()) 
        {
           $this->validation_errors();   
        }
        $user_id = $this->user_id;

        $check_gig=$this->Common_model->getSingleRow('student','wallet_amount',array('studentid'=>$user_id));
        $data = $this->Common_model->updateData("student", array("wallet_amount"=>$check_gig->wallet_amount + $post["amount"]), array('studentid'=>$user_id));
        $check_gig=$this->Common_model->getSingleRow('student','wallet_amount',array('studentid'=>$user_id));
        $insertData = array(
            "transaction_id" => uniqid(), 
            "order_id" => 0,
            "student_id" => $user_id,
            "amount" => $post["amount"],
            "transaction_status" => 1,
            "transaction_date_time" => date("y-m-d H:i:s"),
        );
        $id = $this->Common_model->insertData('transactions', $insertData);
        
        if (empty($data)) 
        {
            $response['status']=false;
            $response['message']='Update Failed';
            $this->response($response,$status);
        } 
        else
        {
            $status = parent::HTTP_OK;
            $response['status']=true;
            $response['message']='Successful';
            $response['data']= $check_gig;  
            $this->response($response,$status);
        }
    }
}