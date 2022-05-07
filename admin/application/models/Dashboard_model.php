<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function userCount() {
        $qry = "
                SELECT COUNT(*) AS count
                FROM student
               ";
        $query = $this->db->query($qry);
        //Check old user Details exist or not
        if($query->num_rows()>0) {
            $result =  $query->row();
            return $result;
        } else {
            return false;
        }
    }

    public function mediaCount($type) {
        $qry = "
                SELECT COUNT(*) AS count
                FROM student";
        $query = $this->db->query($qry);
        //Check old user Details exist or not
        if($query->num_rows()>0) {
            $result =  $query->row();
            return $result;
        } else {
            return false;
        }
    }

    public function topMedia($type) {
        $qry = "
                SELECT studentid FROM student";
        $query = $this->db->query($qry);
        //Check old user Details exist or not
        if($query->num_rows()>0) {
            $result =  $query->row();
            return $result;
        } else {
            return false;
        }
    }


    public function productCount() {
        $qry = "
                SELECT COUNT(*) AS count
                FROM student
               ";
        $query = $this->db->query($qry);
        //Check old user Details exist or not
        if($query->num_rows()>0) {
            $result =  $query->row();
            return $result;
        } else {
            return false;
        }
    }

     public function get_cat_list($type){
        $this->db->select('studentid');
        $this->db->from('users');
        $this->db->order_by('user_id','desc');
        //$this->db->where('type',$type);
        //$this->db->where('isactive',1);
        $query = $this->db->get();
        $result = $query->result();
          foreach ($result as $key => $row) {
                if( $result[$key]->type == 1){
                    $result[$key]->type = "Movies";
                }else if( $result[$key]->type==2){
                    $result[$key]->type = "Radio";
                }else if( $result[$key]->type == 3){
                    $result[$key]->type = "Live TV";
                }
          }
        return $result;
    } 

   


}
?>