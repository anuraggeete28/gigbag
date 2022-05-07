<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Category_model extends CI_Model {

     public function __construct() {
        $this->load->database();
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

    
    public function getCourse(){

	$query=$this->db->query("select * from categories");
		return $query->result();

}


 public function getsubcat(){

	$query=$this->db->query("select * from subcategory");
		return $query->result();

}

 public function getstudentid(){

	$query=$this->db->query("select studentid, unique_id as student_id from student where usertype='student'");
		return $query->result();

}

public function getteacherid(){

	$query=$this->db->query("select studentid,unique_id as teacher_id, username as teacher_name from student where usertype='teacher'");
		return $query->result();

}


public function getstatus(){

	$query=$this->db->query("select * from classstatus");
		return $query->result();

}

public function getpaid(){

	$query=$this->db->query("select * from classpaid");
		return $query->result();

}

public function getgig(){

	$query=$this->db->query("select * from gigs");
		return $query->result();

}

public function getgigcats(){

	$query=$this->db->query("select * from categories");
		return $query->result();

}

public function getcoupon(){

	$query=$this->db->query("select * from coupon");
		return $query->result();

}

public function getcouponnum(){

	$query=$this->db->query("select * from coupon");
		return $query->result();

}


public function getcoupondis(){

	$query=$this->db->query("select * from coupon");
		return $query->result();

}


public function gettypeofclass(){

	$query=$this->db->query("select * from typeofclass");
		return $query->result();

}

public function gettrescheduling(){

	$query=$this->db->query("select * from reschedull_allowed");
		return $query->result();

}

public function getattenstatus(){

	$query=$this->db->query("select * from attendance_status");
		return $query->result();

}

public function getgigids(){

	$query=$this->db->query("select * from categories");
		return $query->result();

}

public function getteacheridss(){

	$query=$this->db->query("select unique_id as teacher_id from student where usertype='teacher'");
		return $query->result();

}

public function getstudentsidss(){

	$query=$this->db->query("select unique_id as student_id from student where usertype='student'");
		return $query->result();

}

    public function user_list_by_role(){
        $this->db->select(['user_id_PK as id', 'name', 'email', 'mobile', 'profile','created_date','isActive']);
        $this->db->from('tbl_user');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_category_table_data($valid_columns,$where='')
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        $this->db->select('categories.category_id ,categories.category_name,categories.is_active');
        $this->db->from('categories');
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }
        
        if(!empty($valid_columns[$col]))
        {
            $order = $valid_columns[$col];
        }
        else
        {
            $order='id';
        }
        if(!empty($order))
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            
          $this->db->like('categories.category_name',$search);
                       
        }
      $this->db->limit($length,$start);
       
      if(!empty($where)){
          $this->db->where($where);
      }
      $query    = $this->db->get();
      $response = $query->result();
      return $response;
    }

    public function get_table_data($valid_columns,$where='')
    {
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        $this->db->select('subcategory.subcate_id ,categories.category_name,categories.is_active');
        $this->db->from('subcategory');
        $this->db->join('categories','users.id = videos.user_id', 'left');
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }
        
        if(!empty($valid_columns[$col]))
        {
            $order = $valid_columns[$col];
        }
        else
        {
            $order='id';
        }
        if(!empty($order))
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            
          $this->db->like('users.firstname',$search);
      
          $this->db->or_like('users.lastname',$search);
          $this->db->or_like('videos.description',$search);
                
                       
        }
      $this->db->limit($length,$start);
       
      if(!empty($where)){
          $this->db->where($where);
      }
      $this->db->where('videos.is_deleted',0);
      $query    = $this->db->get();
      $response = $query->result();
      return $response;
    }



}
