<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
class MYREST_Controller extends REST_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$_POST = $this->post();
		ini_set('max_execution_time', 300); 
		$this->user_id=$this->verify_request();
       
	}

	/**
	 * Retrieve the validation errors array and send as response.
	 * 26/12/2014 16:46
	 * @return none
	 */

	public function validation_errors($return_only=FALSE)
	{
		$validation_errors = $this->form_validation->error_array();
        $errors= array_values( $validation_errors);
        $status = parent::HTTP_INTERNAL_SERVER_ERROR;
        $response['status']=false;
        $response['message']= $errors[0];
		if(!$this->input->post())
		{
			$response['message'] = 'Please input valid parameters.';
		}

		if($return_only===TRUE) return $response;

		$this->response($response, $status);
	}


	protected function verify_request()
    {
    	$headers = $this->input->request_headers();
	    if (((in_array($this->router->fetch_class(), array('Auth_api','auth_api')) AND !in_array($this->router->fetch_method(), array('edit_profile','upload_file')) )OR  in_array($this->router->fetch_method(), array('gig_list','gig_detail'))))
        {
            if (empty( $headers['session_key'])) {
                return TRUE;
            }
        }
        else
        {
        //    if (empty($headers['session_key'])) 
        //     {
        //         $status = self::HTTP_UNAUTHORIZED;
        //         $response = ['status' => $status, 'message' => 'Unauthorized Access!'];
        //         $this->response($response, $status);
        //     }  
        }
          
        // Get all the headers
        
        // Extract the token
       
        $token = isset($headers['session_key']) ? $headers['session_key'] : "";
        // Use try-catch
        // JWT library throws exception if the token is not valid
        try {
            // Validate the token
            // Successfull validation will return the decoded user data else returns false
            $data =$this->Common_model->check_user_key($token);
           // $data = AUTHORIZATION::validateToken($token);
            if (empty($data))
            {
                // $status = self::HTTP_UNAUTHORIZED;
                // $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
                // $this->response($response, $status);
                // exit();
            } else {
                return $data->studentid;
            }
        } catch (Exception $e) {
            // Token is invalid
            // Send the unathorized access message
            // $status = self::HTTP_UNAUTHORIZED;
            // $response = ['status' => false, 'message' => 'Unauthorized Access! '];
            // $this->response($response, $status);
        }
    }
    protected function jwt_token_get($tokenData)
    {
        // Create a token
        $token = AUTHORIZATION::generateToken($tokenData);
        // Set HTTP status code
        $status = self::HTTP_OK;
        // Prepare the response
        $response = ['status' => $status, 'token' => $token];
        // REST_Controller provide this method to send responses
        $this->response($response, $status);
    }  
}
/* End of file MYREST_Controller.php */
/* Location: ./application/controllers/MYREST_Controller.php */