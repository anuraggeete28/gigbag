<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Teammodel extends CI_Model {

     public function __construct() {
        $this->load->database();
        //$this->countryTbl = 'countries';
        //$this->stateTbl = 'states';
        //$this->cityTbl = 'cities';
    }

function fetch_country()
 {
  $this->db->order_by("country", "ASC");
  $query = $this->db->get("countries");
  return $query->result();
 }

 function fetch_state($country_id)
 {
  $this->db->where('country_id', $country_id);
  $this->db->order_by('state', 'ASC');
  $query = $this->db->get('states');
  $output = '<option value="">Select State</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->state_id.'">'.$row->state.'</option>';
  }
  return $output;
 }

 function fetch_city($state_id)
 {
  $this->db->where('state_id', $state_id);
  $this->db->order_by('city_name', 'ASC');
  $query = $this->db->get('city');
  $output = '<option value="">Select City</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
  }
  return $output;
 }
 
    /*
     * Get country rows from the countries table
     */
    function getCountryRows($params = array()){
        $this->db->select('c.id, c.name');
        $this->db->from($this->countryTbl.' as c');
        
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach ($params['conditions'] as $key => $value) {
                if(strpos($key,'.') !== false){
                    $this->db->where($key,$value);
                }else{
                    $this->db->where('c.'.$key,$value);
                }
            }
        }
        $this->db->where('c.status','1');
        
        $query = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;

        //return fetched data
        return $result;
    }
    
    /*
     * Get state rows from the countries table
     */
    function getStateRows($params = array()){
        $this->db->select('s.id, s.name');
        $this->db->from($this->stateTbl.' as s');
        
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach ($params['conditions'] as $key => $value) {
                if(strpos($key,'.') !== false){
                    $this->db->where($key,$value);
                }else{
                    $this->db->where('s.'.$key,$value);
                }
            }
        }
        
        $query = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;

        //return fetched data
        return $result;
    }
    
    /*
     * Get city rows from the countries table
     */
    function getCityRows($params = array()){
        $this->db->select('c.id, c.name');
        $this->db->from($this->cityTbl.' as c');
        
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach ($params['conditions'] as $key => $value) {
                if(strpos($key,'.') !== false){
                    $this->db->where($key,$value);
                }else{
                    $this->db->where('c.'.$key,$value);
                }
            }
        }
        
        $query = $this->db->get();
        $result = ($query->num_rows() > 0)?$query->result_array():FALSE;

        //return fetched data
        return $result;
    }

    /**
     * 
     * @param type $user_id
     * @return type
     */
    public function get_dish_list_by_user($user_id) {
        $this->db->select(['id', 'dish_name', 'slots', 'category', 'cuisine', 'dish_price', 'created_at', 'status', 'is_approved', 'approved_at']);
        $this->db->from('dishes');
        $this->db->where('created_by', $user_id);
        $query = $this->db->get();
        return $query->result();
    }
    
     /**
     * 
     * @param type $user_id
     * @return type
     */
    
    public function get_user_detail_by_id($user_id) {
        $this->db->select('t1.first_name, t1.last_name, t1.email, t1.password_at_reg');
        $this->db->from('users AS t1');
        $this->db->where('t1.id', $user_id);
        $query = $this->db->get();
        return $query->result();
    }

    
    public function getcountry(){

	$query=$this->db->query("select * from countries");
		return $query->result();

}


public function getcountryli(){

	$query=$this->db->query("select * from countries");
		return $query->result();

}


 public function getcountrylist(){

	$query=$this->db->query("select * from countries");
		return $query->result();

}

public function getstate(){

	$query=$this->db->query("select * from states");
		return $query->result();

}

 public function getsource(){

	$query=$this->db->query("select * from source");
		return $query->result();

}

public function getsubCourse(){

	$query=$this->db->query("select * from sub_courses ");
		return $query->result();

}

public function getpolicyaccept(){

	$query=$this->db->query("select * from policy_accept ");
		return $query->result();

}

    public function user_list_by_role(){
        $this->db->select(['user_id_PK as id', 'name', 'email', 'mobile', 'profile','created_date','isActive']);
        $this->db->from('tbl_user');
        $query = $this->db->get();
        return $query->result();
    }
}
