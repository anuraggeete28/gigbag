<?php

class Adminmodel extends CI_Model {
 
 	function __construct(){
  		parent::__construct();
  		//$this->load->library('bcrypt');
 	}
 	
 	/**
	 * Check Login for admin
	 *
	 */
 	public function processLogin($email, $password){
 		

 		$where = array('email'=>$email, 'status'=>1, 'role_id'=>1);

		$this->db->select('user_id, user_name, role_id, password, profile_image');
		$this->db->where($where);
		$this->db->from('users');
		$query = $this->db->get();
		$query = $query->row();

		if(isset($query) && !empty($query)) {
			return $query;
		}
 	}
 	
 	
 	
 		public function checkUsers($email){

 		$where = array('email'=>$email, );

		$this->db->select('email');
		$this->db->where($where);
		$this->db->from('tbl_admin');
		$query = $this->db->get();
		$query = $query->row();

		if(isset($query) && !empty($query)) {
			return $query;
		}
 	}
 	
 	

 	/**
	 * Check admin for Forget password
	 *
	 */
 	public function checkUser($email){

 		$where = array('email'=>$email, 'status'=>1, 'role_id'=>1);

		$this->db->select('user_id, email');
		$this->db->where($where);
		$this->db->from('users');
		$query = $this->db->get();
		$query = $query->row();

		if(isset($query) && !empty($query)) {
			return $query;
		}
 	}

 	/**
	 * Reset password for admin
	 *
	 */
 /*	public function resetPassword($email){

 		$newPassword = rand();
 		$newPassword = $this->bcrypt->hash_password($newPassword);

 		$where = array('email'=>$email, 'status'=>1, 'role_id'=>1);
 		$data = array('password'=>$newPassword);

        $this->db->where($where);
        $this->db->update('users', $data);

		return $newPassword;
 	}
 	*/
 	
 		public function resetPasswordd($email){

 		$newPassword = rand(10000,1000);
 		$newPasswordff = $newPassword;
        $newPasswordww = $newPassword;
        $to = $email;
        $subject = "Gigbag admin password reset";
        $txt = "Your new password is ".$newPasswordww;
        $headers = "From: 	jaideep.kirad@winworldtechs.com";
        
        mail($to,$subject,$txt,$headers);
					
					
 		$where = array('email'=>$email);
 		$data = array('password'=>$newPasswordff);
 		

        $this->db->where($where);
        $this->db->update('tbl_admin', $data);

		return $newPassword;
 	}
 	
 	
 	
 	 public function addUpdateSocialUser($userData = array()){
        if(!empty($userData)){
            //check whether user data already exists in database with same oauth info
            $this->db->select('*');
            $this->db->from('a1_users_list');
            $this->db->where(array('oauth_provider'=>$userData['oauth_provider'], 'oauth_uid'=>$userData['oauth_uid']));
            $prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();
            
            if($prevCheck > 0){
                $prevResult = $prevQuery->row_array();
                
                //update user data
                $update = $this->db->update('a1_users_list', $userData, array('users_id ' => $prevResult['users_id ']));
                
                //get user ID
                $userID = $prevResult['users_id '];
            }else{
                //insert user data                
                $insert = $this->db->insert('a1_users_list', $userData);
                
                //get user ID
                $userID = $this->db->insert_id();
            }
        }
        
		$query = $this->db->get_where('a1_users_list', array('users_id ' => $userID));
		$result = $query->row();

        //return user 
        return $result?$result:FALSE;
    
}
 
}
?>