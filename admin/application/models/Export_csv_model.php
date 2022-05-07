<?php
class Export_csv_model extends CI_Model
{
     function fetch_data()
     {
      $this->db->select("studentid,unique_id,username,email,address,country_code,mobile,dob,s1.category_name,s3.subcatname,IF(s2.isActive=0, 'INACTIVE', 'ACTIVE') as status,source,policy,name_in_bank_account,bankname,branch_name,account_number,ifsc_code,induction_date");
      $this->db->from('student as s2');
      $this->db->where("usertype='teacher'");
     $this->db->join('categories as s1', 's1.category_id = s2.category_id', 'left');
     $this->db->join('subcategory as s3', 's3.subcat_id = s2.subcat_id', 'left');
      return $this->db->get();
     }
 
 
      function fetch_studata()
     {
      $this->db->select("s1.studentid,s1.signup_date,s1.unique_id,s1.username,s1.email,s1.address,s2.state,c1.country,s1.country_code,s1.mobile,s1.dob,t2.category_name,t3.subcatname,s1.referal,s1.guardian,s1.status,s1.source,s1.policy");
      $this->db->from('student as s1');
      $this->db->join('countries c1', 'c1.country_id = s1.country_id', 'left');
      $this->db->join('states as s2', 's2.state_id = s1.state_id', 'left');
       $this->db->join('categories as t2', 't2.category_id = s1.category_id', 'left');
       $this->db->join('subcategory as t3', 't3.subcat_id = s1.subcat_id', 'left');
      $this->db->where("usertype='student'");
      return $this->db->get();
     }
     
     
      function fetchgigs()
     {
      $this->db->select("t1.createdate, t1.gig_id, cat.category_name, sub4.subcatname, t1.carddescription, t1.base, t1.sessions, t1.maxstudents, t1.gigfees, t1.gigfeeusd, t1.couponcode, t1.finalgigfees, t1.finalgigfeeusd, t1.teacherfee_per_session, t1.teacher_gig_fees, t1.portal_margin_per_session, t1.state, t1.country, t1.session_duration_in_hours, t1.rescheduling_allowed, t1.type_of_class");
      $this->db->from('gigs as t1');
      $this->db->join('categories as cat', 'cat.category_id = t1.category_id', 'left');
     $this->db->join('subcategory as sub4', 'sub4.subcat_id = t1.subcat_id', 'left');
      return $this->db->get();
}
     
 function fetchsubcat()
     {
      $this->db->select("s.subcat_id,c.category_name,s.subcatname");
      $this->db->from('subcategory as s');
      $this->db->join('categories as c','s.category_id = c.category_id',"left");
      return $this->db->get();
     }
     function fetchcat()
     {
      $this->db->select("category_id,category_name");
      $this->db->from('categories');
      return $this->db->get();
     }
     
     function fetchuser()
     {
      $this->db->select("id,username,email,mobile,user_type");
      $this->db->from('tbl_admin');
      return $this->db->get();
     }
     
     function fetchclass()
     {
      $this->db->select("class_id,createdate,student_id,teacher_id,gigid,couponcode,startdate,class_start_time,end_date,classid,status,paid");
      $this->db->from('classes');
      return $this->db->get();
     }
     
     function fetchcoupon()
     {
      $this->db->select("couponid,couponnumber,couponcode,discountrate,availablecoupon,consumcoupon,startdate,enddate");
      $this->db->from('coupon');
      return $this->db->get();
     }
     
     
     function fetchattendance()
     {
      $this->db->select("attendance_id,last_update,serial_number,dates,time,duration,class_id,remark,teacher_id,start_time,start_otp,endtime,student_id,endotp,gigid,virtuallink,classroomlink");
      $this->db->from('attendance');
      return $this->db->get();
     }
}

?>
