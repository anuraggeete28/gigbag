<?php
require_once("application/core/MYREST_Controller.php");
class Auth_api extends MYREST_Controller{
    
    public function __construct()
    {
        parent::__construct();
    } 
    
    public function login_post()
    {
        $email      = $this->post('email');
        $password    = $this->post('password');
        $this->form_validation->set_rules('device_type', 'Device Type', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
        $device_type=$this->input->post('device_type');
        if (!$this->form_validation->run()) 
        {
           $this->validation_errors();   
        }
        $getData=$this->Common_model->getSingleRow('student','*',array('email'=>$email,'password'=>$password));
        if (!empty($getData)) 
        {
            
            unset($getData->password);
            //$token = AUTHORIZATION::generateToken(['id' => $getData->studentid]);
            $token = $this->Common_model->generate_active_login_key($getData->studentid,$device_type);
            $status = parent::HTTP_OK;
            $response['status']=true;
            $response['message']='Successfully loggedin';
            $response['token']= $token;
            $response['data']= $getData;
        }
        else
        {
            $response['status']=false;
            $response['message']='Invalid Email Or Password';
        }
        
        $this->response($response,$status);       
    }
    
    public function social_login_post()
    {
        $post  = $this->post();
        $this->form_validation->set_rules('device_type', 'Device Type', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('oauth_uid', 'oauth uid', 'trim|required');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
        $device_type=$this->input->post('device_type');
        $usertype=$this->input->post('usertype');
        if (!$this->form_validation->run()) 
        {
            $this->validation_errors();  
        }
        unset($post['device_type']);
        $check_email=$this->Common_model->getSingleRow('student','studentid',array('email'=>$post['email']));
        if (!empty($check_email)) 
        {
            $user_id=$check_email->studentid;
            $update = $this->Common_model->updateData('student', $post,array('studentid'=>$user_id));
        } 
        else
        {
          
            unset($post['device_type']);
            if (strtolower($usertype)=='student') {
             $unique_id = "S".rand(10000000,99999999);
            }
            else
            {
                 $unique_id = "C".rand(10000000,99999999);
            }
            $user_id = $this->Common_model->insertData('student', $post);
        }
        if (empty($user_id)) 
        {
            $response['status']=false;
            $response['message']='Failed! Please try again';
            $this->response($response,$status);
        }
        $getData=$this->Common_model->getSingleRow('student','*',array('studentid'=>$user_id));
        if (empty($getData)) 
        {
            $response['status']=false;
            $response['message']='Failed! Not registered';
            $this->response($response,$status);
        }
        unset($getData->password);
        //$token = AUTHORIZATION::generateToken(['id' => $getData->studentid]);
        $token = $this->Common_model->generate_active_login_key($getData->studentid,$device_type);
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successfully loggedin';
        $response['token']= $token;
        $response['data']= $getData;
        $this->response($response,$status);          
    } 
     
    public function signup_post()
    {
        $post      = $this->post();
        $this->form_validation->set_rules('device_type', 'Device Type', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|matches[password]');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
        $device_type=$this->input->post('device_type');
        $usertype=$this->input->post('usertype');
        if (!$this->form_validation->run()) 
        {
            $this->validation_errors();  
        }
        $check_email=$this->Common_model->getSingleRow('student','studentid',array('email'=>$post['email']));
        if (!empty($check_email)) 
        {
            $response['status']=false;
            $response['message']='Email Already Exists';
            $this->response($response,$status);
        } 

        $post['last_modified_date'] = date('Y-m-d h:i:s');  
        $post['signup_date'] = date('Y-m-d');
        if (strtolower($usertype)=='student') {
             $unique_id = "S".rand(10000000,99999999);
        }
        else
        {
             $unique_id = "C".rand(10000000,99999999);
        }
        $post['unique_id']=$unique_id;
        unset($post['confirm_password']);
        unset($post['device_type']);
        if (empty($usertype)) 
        {
           $post['usertype']='student';
        }
       
        $studentid = $this->Common_model->insertData('student', $post);
        if (empty($studentid)) 
        {
            $response['status']=false;
            $response['message']='Failed! Please try again';
            $this->response($response,$status);
        }
        $getData=$this->Common_model->getSingleRow('student','*',array('studentid'=>$studentid));
        if (empty($getData)) 
        {
            $response['status']=false;
            $response['message']='Failed! Not registered';
            $this->response($response,$status);
        }
        unset($getData->password);
       // $token = AUTHORIZATION::generateToken(['id' => $getData->studentid]); 
        $token = $this->Common_model->generate_active_login_key($getData->studentid,$device_type);
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successfully Registred';
        $response['token']= $token;
        $response['data']= $getData;
        $this->response($response,$status);          
    }

    public function get_profile_post()
    {

        $post      = $this->post();
        $this->form_validation->set_rules('student_id', 'Student Id', 'trim|required');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
       
        if (!$this->form_validation->run()) 
        {
            $this->validation_errors();  
        }

        $getData=$this->Common_model->get_user_detail_by_id($post['student_id']);
        if (empty($getData)) 
        {
            $response['status']=false;
            $response['message']='Invalid Student Id';
            $this->response($response,$status);
        }
        unset($getData->password);
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successful';
        $response['data']= $getData;
        $this->response($response,$status);
    }

    public function edit_profile_post()
    {
        $post      = $this->post();
        $user_id=$this->user_id;
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
       
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
       
        if (!$this->form_validation->run()) 
        {
            $this->validation_errors();  
        }
        $check_mobile=$this->Common_model->getSingleRow('student','studentid',array('mobile'=>$post['mobile'],'studentid!='=>$user_id));

        if (!empty($check_email)) 
        {
            $response['status']=false;
            $response['message']='Email Already Exists';
            $this->response($response,$status);
        } 
        $post['last_modified_date'] = date('Y-m-d h:i:s');  
       
        $studentid = $this->Common_model->updateData('student', $post,array('studentid'=>$user_id));
        if (empty($studentid)) 
        {
            $response['status']=false;
            $response['message']='Failed! Please try again';
            $this->response($response,$status);
        }
        $getData=$this->Common_model->get_user_detail_by_id($user_id);
        if (empty($getData)) 
        {
            $response['status']=false;
            $response['message']='Failed! Not Updated';
            $this->response($response,$status);
        }
        unset($getData->password);
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successfully Updated';
        $response['data']= $getData;
        $this->response($response,$status);          
    }

    public function upload_file_post()
    {
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
        if (empty($_FILES['profile']['name'])) 
        {
            $response['status']=false;
            $response['message']='File Required';
            $this->response($response,$status);
        }
       
        $image_name = "";
        $image_name_thumb = "";
        $this->load->library('upload');   
        $config['upload_path'] = "./uploads/users/";
        $config['allowed_types'] = '*';
        $config['max_size']    = '1024';
        //$config['file_name'] = "upload";
        $this->upload->initialize($config);
        if (!$this->upload->do_upload("profile"))
        {
            $error=$this->upload->display_errors();
            $response['status']=false;
            $response['message']=$this->upload->display_errors();
            $this->response($response,$status);
        }
        $imageArray = $this->upload->data();
        $image_name = $imageArray['raw_name'].''.$imageArray['file_ext']; // Job Attachment
        $image_name_thumb =$imageArray['raw_name'].$imageArray['file_ext'];
        $profile = "users/".$image_name_thumb;
        $data=array('profile'=>$profile,"full_path"=>base_url('uploads/'.$profile));
        $post_data=array('profile'=>$profile);
        $update = $this->Common_model->updateData('student', $post_data,array('studentid'=>$this->user_id));
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successfully Uploaded';
        $response['data']= $data;
        $this->response($response,$status);  
    }

    public function forgot_password_post()
    {

        $post      = $this->post();
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
       
        if (!$this->form_validation->run()) 
        {
            $this->validation_errors();  
        }

        $getData=$this->Common_model->getSingleRow('student','studentid',array('email'=>$post['email']));
        if (empty($getData)) 
        {
            $response['status']=false;
            $response['message']='Sorry this email Not registered with us';
            $this->response($response,$status);
        }
        $rand_no = rand(0,100000);
        $pwd_reset_code = $rand_no;
        $body="Your Reset Password Code is:".$pwd_reset_code;
        $email_data['email']=$post['email'];
        $email_data['subject']='Gigbag |Forgot password';
        $email_data['body']=$body;
        if (!send_mail($email_data)) 
        {
            $response['status']=false;
            $response['message']='Email not sent';
            $this->response($response,$status);
        } 
        $update = $this->Common_model->updateData('student', array('password_reset_code'=>$pwd_reset_code),array('studentid'=>$getData->studentid));
        if (empty($update)) 
        {
            $response['status']=false;
            $response['message']='Failed! try again';
            $this->response($response,$status);
        } 
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Reset Code has been sent to your email';
        $this->response($response,$status);
    }

    public function validate_reset_password_code_post()
    {

        $post      = $this->post();
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('code', 'Code', 'trim|required');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
       
        if (!$this->form_validation->run()) 
        {
            $this->validation_errors();  
        }

        $getData=$this->Common_model->getSingleRow('student','studentid',array('email'=>$post['email'],'password_reset_code'=>$post['code']));
        if (empty($getData)) 
        {
            $response['status']=false;
            $response['message']='Invalid Code';
            $this->response($response,$status);
        }
       
        $update = $this->Common_model->updateData('student', array('password_reset_code'=>NULL),array('studentid'=>$getData->studentid));
        if (empty($update)) 
        {
            $response['status']=false;
            $response['message']='Failed! try again';
            $this->response($response,$status);
        } 
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Code Validate Successfully';
        $response['user_id']= $getData->studentid;
        $this->response($response,$status);
    }

    public function reset_password_post()
    {
        $post = $this->post();
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('user_id', 'User Id', 'trim|required');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
       
        if (!$this->form_validation->run()) 
        {
            $this->validation_errors();  
        }

        $check_user=$this->Common_model->getSingleRow('student','studentid',array('studentid'=>$post['user_id']));
        if (empty($check_user)) 
        {
            $response['status']=false;
            $response['message']='Invalid User';
            $this->response($response,$status);
        } 

        $update = $this->Common_model->updateData('student', array('password'=>$post['password']),array('studentid'=>$post['user_id']));
        if (empty($update)) 
        {
            $response['status']=false;
            $response['message']='Failed! Please try again';
            $this->response($response,$status);
        }

        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successfully Updated';
        $this->response($response,$status);          
    }

    public function change_password_post()
    {
        $post = $this->post();
        $user_id=$this->user_id;
        $this->form_validation->set_rules('old_password', 'Code', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|matches[password]');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
       
        if (!$this->form_validation->run()) 
        {
            $this->validation_errors();  
        }

        $check_old_password=$this->Common_model->getSingleRow('student','studentid',array('studentid'=>$user_id,'password'=>$post['old_password']));
        if (empty($check_old_password)) 
        {
            $response['status']=false;
            $response['message']='Invalid Old Password';
            $this->response($response,$status);
        } 
        
        $update = $this->Common_model->updateData('student', array('password'=>$post['password']),array('studentid'=>$user_id));
        if (empty($update)) 
        {
            $response['status']=false;
            $response['message']='Failed! Please try again';
            $this->response($response,$status);
        }

        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successfully Updated';
        $this->response($response,$status);          
    }
    public function logout_post() {
        $this->form_validation->set_rules('session_key', 'session key', 'trim|required');

        if (!$this->form_validation->run()) 
        {
            $this->validation_errors();  
        }
        $key = $this->input->post('session_key');
        $this->db->where(array('session_key' => $key))->delete('user_session_keys');

        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successfully Logged Out';       
        $this->response($response,$status);
    }

    public function get_country_list_post()
    {

        $countries=$this->Common_model->getMultipleRow('countries');
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successful';
        $response['data']= $countries;
        $this->response($response,$status);
    }

    public function get_state_list_post()
    {
        $this->form_validation->set_rules('country_id', 'Country Id', 'trim|required');
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
       
        if (!$this->form_validation->run()) 
        {
            $this->validation_errors();  
        }
        $country_id=$this->input->post('country_id');
        $states=$this->Common_model->getMultipleRow('states',array('country_id'=>$country_id));
        $status = parent::HTTP_OK;
        $response['status']=true;
        $response['message']='Successful';
        $response['data']= $states;
        $this->response($response,$status);
    }


}