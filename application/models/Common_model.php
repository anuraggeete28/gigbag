<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common_model extends CI_Model{
    function __construct() {

    }
    /*
     * Insert data
     */
   public function generate_active_login_key($user_id, $device_type) 
   {
          $key = random_string('unique');
          $insert_data = array(
              'session_key' => $key,
              'user_id' => $user_id,
              'device_type' => $device_type,
              'date_created' => date('Y-m-d H:i:s')
          );
          $this->db->insert('user_session_keys', $insert_data);
          return $key;
    }
    public function check_user_key($key = FALSE) {
        $sql = $this->db->select("studentid")
                ->from('user_session_keys' . ' AS AL')
                ->join('student' . ' AS S', 'S.studentid = AL.user_id')
                ->where("session_key", $key)
                ->get();
        $result = $sql->row();
        return ($result) ? $result : array();
    }

    public function insertData($table,$data)
    {
      $insert=$this->db->insert($table,$data);
      if (!$insert)
      {
        return 0;
      }
      else
      {
        return $this->db->insert_id();
      }
    }

    /** Update Activity
    *
    * @return
    */
    public function updateData($table,$data,$where)
    {
        
        $this->db->where($where);
        if($this->db->update($table,$data))
        {
          return $this->db->last_query();
        }
        else
        {
          return 0;
        }

    }
    
    /** Delete Activity
    *
    * @return
    */
    public function deleteData($table,$where)
    {
      $this->db->where($where);
      if($this->db->delete($table))
      {
        return 1;
      }
      else
      {
        return 0;
      }

    }
    /** Get Data
    *
    * @return
    */
    public function getSingleRow($table,$colums='',$where=NULL)
    {
      $this->db->select($colums);
      $this->db->from($table);
      if(!empty($where)){
          $this->db->where($where);
      }
      $query    = $this->db->get();
      $response = $query->row();
      return $response;
    }
    /** Get Data
    *
    * @return
    */
    public function getMultipleRow($table,$where=NULL)
    {
      $this->db->select('*');
      $this->db->from($table);
      if(!empty($where)){
          $this->db->where($where);
      }
      $query    = $this->db->get();
      $response = $query->result();
      return $response;
    }
    
    public function get_count($table,$where='')
    {
      $this->db->select('id');
      $this->db->from($table);
      if(!empty($where)){
          $this->db->where($where);
      }
      $query    = $this->db->get();
      $response = $query->result();
      return $query->num_rows();
    }
    public function get_user_detail_by_id($id)
    {
        $image_path=base_url('uploads/');
        $this->db->select('U.*,CONCAT("'.$image_path.'",U.profile) as profile,C.country as country_name,S.state as state_name');
        $this->db->from('student U');
        $this->db->join('countries C','U.country_id=C.country_id','left');
        $this->db->join('states S','U.state_id=S.state_id','left');
        $this->db->where("U.studentid",$id);
        $query    = $this->db->get();
        $response = $query->row();
        return $response;
    }
    public function gig_list($post_data,$type=1)
    {

      $limit=10;
      $page=0;

      if (!empty($post_data['current_page'])) 
      {
        $page=$post_data['current_page']-1;
      }
      if (!empty($post_data['limit'])) 
      {
        $limit=$post_data['limit'];
      }
      $offset=($limit*$page);
      $image_path=base_url('uploads/');
      $current_date_time=date('Y-m-d H:i:s');
      $this->db->select('G.*,CONCAT("'.$image_path.'",G.banner_img) as banner_img,CONCAT("'.$image_path.'",G.banner_img_thumb) as banner_img_thumb,C.class_id,C.startdate,C.class_start_time,C.status,C.teacher_id');
      $this->db->from('gigs G');
      $this->db->join('classes C','C.gigid=G.gig_id','LEFT');
      
      if (!empty($post_data['user_id'])) 
      {
        $this->db->select("IF(CRT.id IS NULL ,'0','1') as is_cart_added ,IF(FG.id IS NULL ,'0','1') as is_favourited");
        $this->db->join('cart CRT','CRT.gig_id=G.gig_id AND CRT.student_id='.$post_data['user_id'],'LEFT');
        $this->db->join('favourite_gigs FG','G.gig_id=FG.gig_id AND FG.student_id='.$post_data['user_id'],'LEFT');
      }
      else
      {
          $this->db->select("0 as is_cart_added, 0 as is_favourited");
      }
      
       
      if (!empty($post_data['section_category'])) 
      {
        // $this->db->group_start();
        // $this->db->where('C.startdate IS NULL');
        // $this->db->or_where('CONCAT(C.startdate," ",C.class_start_time)>"'.$current_date_time.'"');
        // $this->db->group_end();
        $this->db->where("G.section_category",$post_data['section_category']);
      }
      if (!empty($post_data['gig_id'])) {
        $this->db->where("C.gigid",$post_data['gig_id']);
      }
      if (!empty($post_data['keyword'])) {
        $this->db->where("C.gigid",$post_data['gig_id']);
      }
      $query    = $this->db->get();
      if ($type==2) 
      {
        $response = $query->row();
      }
      else
      {
        $this->db->limit($limit,$offset);
        
        $response = $query->result();
      //print_r($this->db->last_query());die;

        if (!empty($response[0]->gig_id)) 
        {
          foreach ($response as $key => &$value) 
          {
           // print_r($value);die;
            $value->class_status= '';
            $value->username= '';
            $value->profile= '';
            $value->email= '';
            $value->address= '';
            $value->mobile= '';
            $value->rating= 0;
            $value->students=[];
            if (!empty($value->class_id)) 
            {
              $this->db->select('status');
              $this->db->from('classstatus');
              $this->db->where("status_id",$value->status);
              $qry    = $this->db->get();
              $class_status = $qry->row();
              if (!empty($class_status)) {
                $value->class_status= $class_status->status;
              }

              $this->db->select('AVG(rating) as rating');
              $this->db->from('review_and_rating');
              $this->db->where("gig_id",$value->gig_id);
              $qry1    = $this->db->get();
              $avg_rating = $qry1->row();
              if (!empty($avg_rating->rating)) {
                $value->rating= $avg_rating->rating;
              }
             

              $this->db->select('username,CONCAT("'.$image_path.'",profile) as profile ,email,address,mobile');
              $this->db->from('student');
              $this->db->where("studentid",$value->teacher_id);
              $qry1    = $this->db->get();
              $teaher_data = $qry1->row();
              if (!empty($teaher_data)) {
                $value->username= $teaher_data->username;
                $value->profile= $teaher_data->profile;
                $value->email= $teaher_data->email;
                $value->address= $teaher_data->address;
                $value->mobile= $teaher_data->mobile;
              }             


              $this->db->select('S.username,CONCAT("'.$image_path.'",S.profile) as profile');
              $this->db->from('attendance A');
              $this->db->join('student S','A.student_id=S.studentid','LEFT');
              $this->db->where("A.class_id",$value->class_id);
              $qry3    = $this->db->get();
              $value->students = $qry3->result();

            }
          }
        }
        else
        {
          $response=[];
        }
      }
      return $response;
    }
    
    public function student_gig_list($post_data,$type=1)
    {
      $limit=10;
      $page=0;

      if (!empty($post_data['current_page'])) 
      {
        $page=$post_data['current_page']-1;
      }
      if (!empty($post_data['limit'])) 
      {
        $limit=$post_data['limit'];
      }
      $offset=($limit*$page);
        $image_path=base_url('uploads/');
        $current_date_time=date('Y-m-d H:i:s');
        $this->db->select('G.*,CONCAT("'.$image_path.'",G.banner_img) as banner_img,CONCAT("'.$image_path.'",G.banner_img_thumb) as banner_img_thumb,C.class_id,C.startdate,C.class_start_time,ST.username,CONCAT("'.$image_path.'",ST.profile) as profile,S.email,S.address,S.mobile,IFNULL(AVG(RAR.rating),"0") as rating ,CS.status as class_status');
        $this->db->from('attendance A');
        $this->db->join('classes C','C.class_id=A.class_id','LEFT');
        $this->db->join('classstatus CS','CS.status_id=C.status','LEFT');
         $this->db->join('gigs G','G.gig_id=C.gigid','LEFT');
        $this->db->join('student ST','ST.studentid=C.teacher_id','LEFT');
         $this->db->join('student S','S.studentid=A.student_id','LEFT');
        $this->db->join('review_and_rating RAR','G.gig_id=RAR.gig_id','LEFT');
        
        if (!empty($post_data['user_id'])) 
        {
          $this->db->select("IF(CRT.id IS NULL ,'0','1') as is_cart_added ,IF(FG.id IS NULL ,'0','1') as is_favourited");
          $this->db->join('cart CRT','CRT.gig_id=G.gig_id AND CRT.student_id='.$post_data['user_id'],'LEFT');
          $this->db->join('favourite_gigs FG','G.gig_id=FG.gig_id AND FG.student_id='.$post_data['user_id'],'LEFT');
        }
        else
        {
            $this->db->select("0 as is_cart_added, 0 as is_favourited");
        }
      
        $this->db->where('A.student_id',$post_data['user_id']);
        if(!empty($post_data['is_past_gig'])) 
        {
         
          $this->db->or_where('CONCAT(C.startdate," ",C.class_start_time)<"'.$current_date_time.'"');        
        }
        if(!empty($post_data['is_upcoming_gig'])) 
        {
          $this->db->or_where('CONCAT(C.startdate," ",C.class_start_time)>"'.$current_date_time.'"');        
        }

        if (!empty($post_data['gig_id'])) {
          $this->db->where("C.gigid",$post_data['gig_id']);
        }
        $query    = $this->db->get();
        if ($type==2) 
        {
          $response = $query->row();
        }
        else
        {
          $this->db->limit($limit,$offset);
          $response = $query->result();
        // print_r($this->db->last_query());die;

          if (!empty($response[0]->gig_id)) 
          {
            foreach ($response as $key => &$value) 
            {
              $value->students=[];
              if (!empty($value->class_id)) 
              {
                $this->db->select('S.username,CONCAT("'.$image_path.'",S.profile) as profile');
                $this->db->from('attendance A');
                $this->db->join('student S','A.student_id=S.studentid','LEFT');
                $this->db->where("A.class_id",$value->class_id);
                $qry    = $this->db->get();
                $value->students = $qry->result();

              }
            }
          }
          else
          {
            $response=[];
          }
        }
        return $response;
    }
    public function get_transactions($post_data)
    {
       $limit=10;
      $page=0;

      if (!empty($post_data['current_page'])) 
      {
        $page=$post_data['current_page']-1;
      }
      if (!empty($post_data['limit'])) 
      {
        $limit=$post_data['limit'];
      }
      $offset=($limit*$page);
       $image_path=base_url('uploads/');
        $current_date_time=date('Y-m-d H:i:s');
        $this->db->select('T.*,G.gigid,G.gig_title,S.username,S.email,CONCAT("'.$image_path.'",S.profile) as profile,S.wallet_amount');
        $this->db->from('transactions T');
        $this->db->join('gig_orders GO','GO.id=T.order_id','LEFT');
        $this->db->join('student S','S.studentid=T.student_id','LEFT');
        $this->db->join('gigs G','GO.gig_id=G.gig_id','LEFT');
       
        
        $this->db->where('T.student_id',$post_data['user_id']);
        $this->db->limit($limit,$offset);
        $query    = $this->db->get();
       
        $response = $query->result();
        
        return $response;
    } 
  

    public function favourite_gigs_list($post_data,$type=1)
    {
      $limit=10;
      $page=0;

      if (!empty($post_data['current_page'])) 
      {
        $page=$post_data['current_page']-1;
      }
      if (!empty($post_data['limit'])) 
      {
        $limit=$post_data['limit'];
      }
      $offset=($limit*$page);
        $image_path=base_url('uploads/');
        $current_date_time=date('Y-m-d H:i:s');
        $this->db->select('FG.*,G.*,CONCAT("'.$image_path.'",G.banner_img) as banner_img,CONCAT("'.$image_path.'",G.banner_img_thumb) as banner_img_thumb,C.class_id,C.startdate,C.class_start_time,ST.username,CONCAT("'.$image_path.'",ST.profile) as profile,IFNULL(AVG(RAR.rating),"0") as rating ,CS.status as class_status');
        $this->db->from('favourite_gigs FG');
        $this->db->join('gigs G','G.gig_id=FG.gig_id','LEFT');
        $this->db->join('classes C','C.gigid=.G.gig_id','LEFT');
        $this->db->join('classstatus CS','CS.status_id=C.status','LEFT');
        $this->db->join('student ST','ST.studentid=C.teacher_id','LEFT');
        $this->db->join('review_and_rating RAR','G.gig_id=RAR.gig_id','LEFT');
        
        $this->db->where('FG.student_id',$post_data['user_id']);
        if (!empty($post_data['user_id'])) 
        {
          $this->db->select("IF(CRT.id IS NULL ,'0','1') as is_cart_added ,1 as is_favourited");
          $this->db->join('cart CRT','CRT.gig_id=G.gig_id AND CRT.student_id='.$post_data['user_id'],'LEFT');
         
        }
        else
        {
            $this->db->select("0 as is_cart_added, 0 as is_favourited");
        }
      
        
        $this->db->limit($limit,$offset);
         $query    = $this->db->get();
        $response = $query->result();
        if (!empty($response[0]->gig_id)) 
        {
          foreach ($response as $key => &$value) 
          {
            $value->students=[];
            if (!empty($value->class_id)) 
            {
              $this->db->select('S.username,CONCAT("'.$image_path.'",S.profile) as profile');
              $this->db->from('attendance A');
              $this->db->join('student S','A.student_id=S.studentid','LEFT');
              $this->db->where("A.class_id",$value->class_id);
              $qry    = $this->db->get();
              $value->students = $qry->result();

            }
          }
        }
        else
        {
          $response=[];
        }
        
        return $response;
    }

    public function cart_gigs_list($post_data)
    {
      $limit=10;
      $page=0;
      if (!empty($post_data['current_page'])) 
      {
        $page=$post_data['current_page']-1;
      }
      if (!empty($post_data['limit'])) 
      {
        $limit=$post_data['limit'];
      }
      $offset=($limit*$page);
        $image_path=base_url('uploads/');
        $current_date_time=date('Y-m-d H:i:s');
      
        $this->db->select('CRT.*,G.gig_title,CONCAT("'.$image_path.'",G.banner_img) as banner_img,CONCAT("'.$image_path.'",G.banner_img_thumb) as banner_img_thumb,C.class_id,C.startdate,C.class_start_time');
        $this->db->from('cart CRT');
        $this->db->join('gigs G','G.gig_id=CRT.gig_id','LEFT');
        $this->db->join('classes C','C.gigid=.G.gig_id','LEFT');
        
        $this->db->where('CRT.student_id',$post_data['user_id']);
        if (!empty($post_data['user_id'])) 
        {
          $this->db->select("IF(FG.id IS NULL ,'0','1') as is_favourited ,1 as is_cart_added");
          $this->db->join('favourite_gigs FG','FG.gig_id=G.gig_id AND FG.student_id='.$post_data['user_id'],'LEFT');
         
        }
        else
        {
            $this->db->select("0 as is_cart_added, 0 as is_favourited");
        }
      
        
        $this->db->limit($limit,$offset);
        $query    = $this->db->get();
        $response = $query->result();
        return $response;
    }
    public function get_cart_total($post_data)
    {
        $this->db->select('SUM(C.amount) as total');
        $this->db->from('cart C');
        $this->db->where('C.student_id',$post_data['user_id']);
        $query    = $this->db->get();
        $response = $query->row();
        return $response;
    }
    public function check_coupon_code($post_data)
    {
      $data=array();
      $this->db->select('GROUP_CONCAT(couponcode) as couponid');
      $this->db->from('cart C');
      $this->db->join('gigs G','G.gig_id=C.gig_id','LEFT');
      $this->db->where('C.student_id',$post_data['user_id']);
      $query    = $this->db->get();
      $response = $query->row();

      if (!empty($response->couponid)) 
      {
        $coupon_ids=explode(',',$response->couponid);
        $this->db->select('couponid,discountrate');
        $this->db->from('coupon C');
        $this->db->where_in('C.couponid',$coupon_ids);
        $query    = $this->db->get();
        $response = $query->row();
        $data=$response;
      }
      return $data;
    }    

    public function search_gig($post_data)
    {
      $limit=10;
      $page=0;

      if (!empty($post_data['current_page'])) 
      {
        $page=$post_data['current_page']-1;
      }
      if (!empty($post_data['limit'])) 
      {
        $limit=$post_data['limit'];
      }
      $offset=($limit*$page);
      $image_path=base_url('uploads/');
      $current_date_time=date('Y-m-d H:i:s');
      $this->db->select('G.*,CONCAT("'.$image_path.'",G.banner_img) as banner_img,CONCAT("'.$image_path.'",G.banner_img_thumb) as banner_img_thumb,C.class_id,C.startdate,C.class_start_time,C.status,C.teacher_id');
      $this->db->from('gigs G');
      $this->db->join('classes C','C.gigid=G.gig_id','LEFT');
       
      if (!empty($post_data['section_category'])) 
      {
        $this->db->where("G.section_category",$post_data['section_category']);
      }
      if (!empty($post_data['gig_id'])) {
        $this->db->where("C.gigid",$post_data['gig_id']);
      }
      if (!empty($post_data['keyword'])) {
        $this->db->like("G.gig_title",$post_data['keyword']);
      }
      $query    = $this->db->get();
      $this->db->limit($limit,$offset);
        
      $response = $query->result();

      if (!empty($response[0]->gig_id)) 
      {
        foreach ($response as $key => &$value) 
        {
         // print_r($value);die;
          $value->class_status= '';
          $value->rating= 0;

          if (!empty($value->class_id)) 
          {
            $this->db->select('status');
            $this->db->from('classstatus');
            $this->db->where("status_id",$value->status);
            $qry    = $this->db->get();
            $class_status = $qry->row();
            if (!empty($class_status)) {
              $value->class_status= $class_status->status;
            }

            $this->db->select('AVG(rating) as rating');
            $this->db->from('review_and_rating');
            $this->db->where("gig_id",$value->gig_id);
            $qry1    = $this->db->get();
            $avg_rating = $qry1->row();
            if (!empty($avg_rating->rating)) {
              $value->rating= $avg_rating->rating;
            }
          }
        }
      }
      else
      {
        $response=[];
      }
      return $response;
    }
}
?>