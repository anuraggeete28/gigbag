<?php
class Customer_regis_model extends CI_model{



public function register_user($user){


$this->db->insert('student', $user);

}

public function register_student($user){


$this->db->insert('student', $user);

}


public function couponadd($user){


$this->db->insert('coupon', $user);

}


public function catadd($user){


$this->db->insert('subcategory', $user);

}

public function getexcecutivedata()
{
                $this->load->database();
                die('sdfsd');

  $this->db->select('*');
  $this->db->from('user');

  if($query=$this->db->get())
  {
      return $query->result_array();
  }
  else{
    return false;
  }
}

public function login_user($email,$pass){

  $this->db->select('*');
  $this->db->from('users');
  $this->db->where('email',$email);
  $this->db->where('password',$pass);
  

  if($query=$this->db->get())
  {
      return $query->row_array();
  }
  else{
    return false;
  }


}
public function email_check($email,$id=''){

  $this->db->select('*');
  $this->db->from('student');
  $this->db->where('email',$email);
  if (!empty($id)) 
  {
    $this->db->where('studentid!=',$id);
  }
  $query=$this->db->get();

  if($query->num_rows()>0){
    return false;
  }else{
    return true;
  }

}

public function mobile_check($teacher_phone,$id=''){

  $this->db->select('*');
  $this->db->from('student');
  $this->db->where('mobile',$teacher_phone);
  if (!empty($id)) 
  {
    $this->db->where('studentid!=',$id);
  }
  $query=$this->db->get();

  if($query->num_rows()>0){
    return false;
  }else{
    return true;
  }

}


public function studentmochk($mobile){

  $this->db->select('*');
  $this->db->from('student');
  $this->db->where('mobile',$mobile);
  $query=$this->db->get();

  if($query->num_rows()>0){
    return false;
  }else{
    return true;
  }

}



public function coupocode_check($coupon_code,$coupon_id=''){

  $this->db->select('*');
  $this->db->from('coupon');
  $this->db->where('couponcode',$coupon_code);
  if (!empty($coupon_id)) 
  {
    $this->db->where('couponid!=',$coupon_id);
  }
  $query=$this->db->get();

  if($query->num_rows()>0){
    return false;
  }else{
    return true;
  }

}


public function cat_check($category_name,$category_id=''){

  $this->db->select('*');
  $this->db->from('categories');
  $this->db->where('category_name',$category_name);
  if (!empty($category_id)) 
  {
   $this->db->where('category_id!=',$category_id);
  }
  $query=$this->db->get();
  if($query->num_rows()>0){
    return false;
  }else{
    return true;
  }

}


public function subcat_check($subcatname,$category_id,$subcat_id=''){

  $this->db->select('*');
  $this->db->from('subcategory');
  $this->db->where('subcatname',$subcatname);
  $this->db->where('category_id',$category_id);
  if (!empty($subcat_id)) 
  {
   $this->db->where('subcat_id!=',$subcat_id);
  }
  $query=$this->db->get();

  if($query->num_rows()>0){
    return false;
  }else{
    return true;
  }

}

public function couponnumber_check($unique_id){

  $this->db->select('*');
  $this->db->from('coupon');
  $this->db->where('couponnumber',$unique_id);
  $query=$this->db->get();

  if($query->num_rows()>0){
    return false;
  }else{
    return true;
  }

}

public function email_checkss($email){

  $this->db->select('*');
  $this->db->from('student');
  $this->db->where('email',$email);
  $query=$this->db->get();

  if($query->num_rows()>0){
    return false;
  }else{
    return true;
  }

}

}


?>
