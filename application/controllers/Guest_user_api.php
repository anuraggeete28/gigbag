<?php
require_once("application/core/MYREST_Controller.php");
class Guest_user_api extends MYREST_Controller{
    
    public function __construct()
    {
        parent::__construct();
    } 
    public function gig_list_post()
    {
        $post_data=$this->input->post();
        $gigs=$this->Common_model->gig_list($post_data);
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successful';
        $response['data']= $gigs;
        $this->response($response,$status);
    }
    
}
?>