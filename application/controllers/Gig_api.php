<?php
require_once("application/core/MYREST_Controller.php");
class Gig_api extends MYREST_Controller{
    
    public function __construct()
    {
        parent::__construct();
    } 
    public function category_list_post()
    {
        $categories=$this->Common_model->getMultipleRow('categories',array('is_active'=>1));
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successful';
        $response['data']= $categories;
        $this->response($response,$status);
    }

    public function gig_type_list_post()
    {
        $types=$this->Common_model->getMultipleRow('typeofclass');
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successful';
        $response['data']= $types;
        $this->response($response,$status);
    }
    public function gig_list_post()
    {
        $post_data=$this->input->post();
        $post_data['user_id']=$this->user_id;
        $gigs=$this->Common_model->gig_list($post_data);

        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successful';
        $response['data']= $gigs;
        $this->response($response,$status);
    }

    public function student_gig_list_post()
    {
        $post_data=$this->input->post();
         $post_data['user_id']=$this->user_id;
        $gigs=$this->Common_model->student_gig_list($post_data);
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successful';
        $response['data']= $gigs;
        $this->response($response,$status);
    }
    public function gig_detail_post()
    {
        $this->form_validation->set_rules('gig_id', 'Gig Id', 'trim|required');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
        if (!$this->form_validation->run()) 
        {
           $this->validation_errors();   
        }
        $post_data=$this->input->post();
         $post_data['user_id']=$this->user_id;
        $gigs=$this->Common_model->gig_list($post_data,2);
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successful';
        $response['data']= $gigs;
        $this->response($response,$status);
    }

    public function book_demo_post()
    {
        $post=$this->input->post();
        $this->form_validation->set_rules('gig_category_id', 'Gig Category Id', 'trim|required');
        $this->form_validation->set_rules('gig_type_id', 'Gig Type Id', 'trim|required');
        $this->form_validation->set_rules('date_time', 'Date Time', 'trim|required');
        $status = parent::HTTP_OK;
        if (!$this->form_validation->run()) 
        {
           $this->validation_errors();   
        }
        $check_gig=$this->Common_model->getSingleRow('categories','category_id',array('category_id'=>$post['gig_category_id']));
        if (empty($check_gig)) 
        {
            $response['status']=false;
            $response['message']='Invalid gig Category';
            $this->response($response,$status);
        } 
        $check_order=$this->Common_model->getSingleRow('demo_bookings','id',array('gig_category_id'=>$post['gig_category_id'],'gig_type_id'=>$post['gig_type_id'],'student_id'=>$this->user_id));

        if (!empty($check_order)) 
        {
            $response['status']=false;
            $response['message']='You already booked Demo';
            $this->response($response,$status);
        } 

        $post['student_id']=$this->user_id;
        $post['booking_date'] = date('Y-m-d h:i:s',strtotime($post['date_time'])); 
        unset($post['date_time']);
        $id = $this->Common_model->insertData('demo_bookings', $post);
        if (empty($id)) 
        {
          
            $response['status']=false;
            $response['message']='Failed! Please try again';
            $this->response($response,$status);
        }
        else
        {
            $booking_id='B'.sprintf("%'.05d", $id);
            $this->Common_model->updateData('demo_bookings',array('booking_id'=>$booking_id), array('id'=>$id));
            $status = parent::HTTP_OK;
            $response['status']=true;
            $response['message']='Successfully Booked';
            $response['id']= $id;
            $this->response($response,$status);
        }
    } 

    public function rate_your_gig_post()
    {
        $post=$this->input->post();
        $this->form_validation->set_rules('gig_id', 'Gig Id', 'trim|required');
        $this->form_validation->set_rules('rating', 'Gig Rating', 'trim|required');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
        if (!$this->form_validation->run()) 
        {
           $this->validation_errors();   
        }
        $check_gig=$this->Common_model->getSingleRow('gigs','gig_id',array('gig_id'=>$post['gig_id']));
        if (empty($check_gig)) 
        {
            $response['status']=false;
            $response['message']='Invalid gig';
            $this->response($response,$status);
        } 
        $post['student_id']=$this->user_id;
        $post['date_time'] = date('Y-m-d h:i:s'); 
        $post['status'] = 1;
        $check_data=$this->Common_model->getSingleRow('review_and_rating','id',array('gig_id'=>$post['gig_id'],'student_id'=>$this->user_id));

        if (!empty($check_data)) 
        {

           $res =$this->Common_model->updateData('review_and_rating',$post,array('id'=>$check_data->id));

        } 
        else
        {
            $res = $this->Common_model->insertData('review_and_rating', $post);
        }
       
        
        if (empty($res)) 
        {
          
            $response['status']=false;
            $response['message']='Failed! Please try again';
            $this->response($response,$status);
        }
        else
        {
            
            $status = parent::HTTP_OK;
            $response['status']=true;
            $response['message']='Successful';
            $this->response($response,$status);
        }
    } 

    public function notification_list_post()
    {  
        $user_id=$this->user_id;
        $notification=$this->Common_model->getMultipleRow('notifications',array('student_id'=>$user_id));
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successful';
        $response['data']= $notification;
        $this->response($response,$status);
    }

    public function toggle_cart_post()
    {
        $post=$this->input->post();
        $this->form_validation->set_rules('gig_id', 'Gig Id', 'trim|required');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
        if (!$this->form_validation->run()) 
        {
           $this->validation_errors();   
        }
        $check_gig=$this->Common_model->getSingleRow('gigs','gig_id,gigfees',array('gig_id'=>$post['gig_id']));

        if (empty($check_gig)) 
        {
            $response['status']=false;
            $response['message']='Invalid gig';
            $this->response($response,$status);
        } 
        $check_data=$this->Common_model->getSingleRow('cart','id',array('gig_id'=>$post['gig_id'],'student_id'=> $post['student_id']));

        if (!empty($check_data)) 
        {

           $res =$this->Common_model->deleteData('cart',array('id'=>$check_data->id));
           $message="Successfully Removed";

        } 
        else
        {
            $data = array(
                'gig_id'  => $check_gig->gig_id,
                'amount'   => floatval($check_gig->gigfees),
                'student_id'  =>$post['student_id'],
                'created_date'=>date('Y-m-d H:i:s'),
            );
            $res = $this->Common_model->insertData('cart', $data);
            $message="Successfully Added";
        }
       
        if (empty($res)) 
        {
          
            $response['status']=false;
            $response['message']='Failed! Please try again';
            $this->response($response,$status);
        }
        else
        {
            
            $status = parent::HTTP_OK;
            $response['status']=true;
            $response['message']=$message;
            $this->response($response,$status);
        }
    } 
    public function order_gig_post()
    {
        $post=$this->input->post();
        $this->form_validation->set_rules('gig_id', 'Gig Id', 'trim|required');
        $this->form_validation->set_rules('class_id', 'Gig Class Id', 'trim|required');
        $this->form_validation->set_rules('gig_amount', 'Gig Amount', 'trim|required');
        $this->form_validation->set_rules('order_amount', 'Order Amount', 'trim|required');
        if (!empty($post['gig_amount']) && !empty($post['order_amount']) && $post['gig_amount']!=$post['order_amount']) 
        {
            $this->form_validation->set_rules('coupon_id', 'Coupon Id', 'trim|required');
        }
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
        if (!$this->form_validation->run()) 
        {
           $this->validation_errors();   
        }
        $post['student_id']=$this->user_id;
        $post['order_date']=date('Y-m-d H:i:s');
        $post['status']=1;

        $check_gig=$this->Common_model->getSingleRow('gigs','gigfees',array('gig_id'=>$post['gig_id']));

        if (empty($check_gig)) 
        {
            $response['status']=false;
            $response['message']='Invalid Gig';
            $this->response($response,$status);
        } 

        $post['student_id']=$this->user_id;
        $check_wallet=$this->Common_model->getSingleRow('student','wallet_amount',array('studentid'=>$post['student_id']));
        if (empty($check_wallet->wallet_amount) || ($check_wallet->wallet_amount<$post['order_amount'])) 
        {
            $response['status']=false;
            $response['message']='You have insufficient amount  in wallet';
            $this->response($response,$status);
        } 
        $id = $this->Common_model->insertData('gig_orders', $post);
        if (empty($id)) 
        {
            $response['status']=false;
            $response['message']='Failed! Please try again';
            $this->response($response,$status);
        }
        else
        {
            $new_amount=($check_wallet->wallet_amount-$post['order_amount']);
            $this->Common_model->deleteData('cart',array('student_id'=>$post['student_id']));
            $this->Common_model->updateData('student',array('wallet_amount'=>$new_amount),array('studentid'=>$post['student_id']));
            $status = parent::HTTP_OK;
            $response['status']=true;
            $response['message']='Order placed';
            $response['id']= $id;
            $this->response($response,$status);
        }
    } 
    
    public function toggle_favourite_gig_post()
    {
        $post=$this->input->post();
        $this->form_validation->set_rules('gig_id', 'Gig Id', 'trim|required');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
        if (!$this->form_validation->run()) 
        {
           $this->validation_errors();   
        }
        $check_gig=$this->Common_model->getSingleRow('gigs','gig_id',array('gig_id'=>$post['gig_id']));
        if (empty($check_gig)) 
        {
            $response['status']=false;
            $response['message']='Invalid gig';
            $this->response($response,$status);
        } 
        $post['student_id']=$this->user_id;
        $post['created_date'] = date('Y-m-d h:i:s'); 
        $check_data=$this->Common_model->getSingleRow('favourite_gigs','id',array('gig_id'=>$post['gig_id'],'student_id'=> $post['student_id']));

        if (!empty($check_data)) 
        {

           $res =$this->Common_model->deleteData('favourite_gigs',array('id'=>$check_data->id));
           $message="Successfully Removed";

        } 
        else
        {
            $res = $this->Common_model->insertData('favourite_gigs', $post);
            $message="Successfully Added";
        }
       
        if (empty($res)) 
        {
          
            $response['status']=false;
            $response['message']='Failed! Please try again';
            $this->response($response,$status);
        }
        else
        {
            
            $status = parent::HTTP_OK;
            $response['status']=true;
            $response['message']=$message;
            $this->response($response,$status);
        }
    } 

    public function favourite_gigs_list_post()
    {
        $post_data=$this->input->post();
         $post_data['user_id']=$this->user_id;
        $gigs=$this->Common_model->favourite_gigs_list($post_data);
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successful';
        $response['data']= $gigs;
        $this->response($response,$status);
    }
    public function cart_gigs_list_post()
    {
        $post_data=$this->input->post();
        $post_data['user_id']=$this->user_id;
        $gigs=$this->Common_model->cart_gigs_list($post_data);
        $cart_data=$this->Common_model->get_cart_total($post_data);
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successful';
        $response['data']=array("total"=>$cart_data->total,"gigs"=>$gigs);
        $this->response($response,$status);
    }

    public function check_coupon_code_post()
    {
        $post=$this->input->post();
        $post['user_id']=$this->user_id;
        $this->form_validation->set_rules('coupon_code', 'Coupon Code', 'trim|required');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
        if (!$this->form_validation->run()) 
        {
           $this->validation_errors();   
        }
        $check_coupon=$this->Common_model->check_coupon_code($post);
        if (empty($check_coupon)) 
        {
            $response['status']=false;
            $response['message']='Invalid Coupon Code';
            $this->response($response,$status);
        } 
        else
        {            
            $status = parent::HTTP_OK;
            $response['status']=true;
            $response['message']="Successful";
            $response['data']=$check_coupon;
            $this->response($response,$status);
        }
    }

    public function reschedule_gig_post()
    {
        $post=$this->input->post();
        $this->form_validation->set_rules('gig_id', 'Gig Id', 'trim|required');
        $this->form_validation->set_rules('class_id', 'Class Id', 'trim|required');
        $this->form_validation->set_rules('reschedule_reason', 'Reschedule Reason', 'trim|required');
        $this->form_validation->set_rules('date', 'Date', 'trim|required');
        $this->form_validation->set_rules('time', 'Time', 'trim|required');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
        if (!$this->form_validation->run()) 
        {
           $this->validation_errors();   
        }
        $check_gig=$this->Common_model->getSingleRow('gigs','rescheduling_allowed',array('gig_id'=>$post['gig_id']));
        if (empty($check_gig)) 
        {
            $response['status']=false;
            $response['message']='Invalid gig';
            $this->response($response,$status);
        } 
        if (empty($check_gig->rescheduling_allowed=='Yes')) 
        {
            $response['status']=false;
            $response['message']='Rescheduling not allowed';
            $this->response($response,$status);
        } 
        $post_data=array(
            'startdate'=>date('Y-m-d',strtotime($post['date'])),
            'class_start_time'=>date('H:i:s',strtotime($post['time'])),
            'reschedule_reason'=>$post['reschedule_reason']
        );
        
        $res =$this->Common_model->updateData('classes',$post_data,array('class_id'=>$post['class_id']));
        if (empty($res)) 
        {
          
            $response['status']=false;
            $response['message']='Failed! Please try again';
            $this->response($response,$status);
        }
        else
        {
            
            $status = parent::HTTP_OK;
            $response['status']=true;
            $response['message']='Successful';
            $this->response($response,$status);
        }
    } 

    public function cancel_gig_post()
    {
        $post=$this->input->post();
        $this->form_validation->set_rules('gig_id', 'Gig Id', 'trim|required');
        $this->form_validation->set_rules('class_id', 'Class Id', 'trim|required');
        $this->form_validation->set_rules('reason', 'Reason', 'trim|required');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
        if (!$this->form_validation->run()) 
        {
           $this->validation_errors();   
        }
        $check_gig=$this->Common_model->getSingleRow('gigs','rescheduling_allowed',array('gig_id'=>$post['gig_id']));
        if (empty($check_gig)) 
        {
            $response['status']=false;
            $response['message']='Invalid gig';
            $this->response($response,$status);
        } 
       
        $post_data=array(
            'cancel_date_time'=>date('Y-m-d H:i:s'),
            'cancel_reason'=>$post['reason'],
            'status'=>3
        );
        
        $res =$this->Common_model->updateData('classes',$post_data,array('class_id'=>$post['class_id']));
        if (empty($res)) 
        {
          
            $response['status']=false;
            $response['message']='Failed! Please try again';
            $this->response($response,$status);
        }
        else
        {
            
            $status = parent::HTTP_OK;
            $response['status']=true;
            $response['message']='Successful';
            $this->response($response,$status);
        }
    } 

    public function search_gig_post() 
    {
        $post_data=$this->input->post();
        $gigs=$this->Common_model->search_gig($post_data);
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successful';
        $response['data']= $gigs;
        $this->response($response,$status);
    }
    
    public function privacy_policy_get() 
    {
        $privay=$this->Common_model->getSingleRow("privacypolicy");
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successful';
        $response['data']= $privay;
        $this->response($response,$status);
    }

    
}
?>