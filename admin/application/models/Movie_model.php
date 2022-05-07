<?php

/**
* 
*/
class Movie_model extends CI_model
{
	
public function __construct(){

parent::__construct();

		
}
public function insertdata(){
    $insert=$this->db->insert('tbl_admin');
    if(!$insert)
    {
        return 0;
    }
    else
    {
        return $this->db->insert_id();
    }
    
}
public function getLanguageList(){

	$this->db->select('*');
	$this->db->from('tbl_admin');
	$resultSet=$this->db->get();
	return $resultSet->result();

}

public function getCategoriesList($type){

	$this->db->select('*');
	$this->db->from('tbl_admin');
	//$this->db->like('category_type',$type);
	$resultSet=$this->db->get();
	return $resultSet->result();

}

function getSelsDetails(){
        
        $response = array();
           
        // Select record
        $this->db->select('id,firstname,lastname,phone,email,zipcode,city,shipping_address,country');
        //$this->db->join('user', 'user.user_id = sales.user_id','user_name');
        $q = $this->db->get('tbl_admin');
        //$this->db->where('user_id',$user_id);
        $response = $q->result_array();
        
        return $response;
    }




}

?>