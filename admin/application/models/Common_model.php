<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common_model extends CI_Model{
    function __construct() {

    }
    /*
     * Insert data
     */

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
    public function getSingleRow($table,$where=NULL)
    {
      $this->db->select('*');
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
    public function getMultipleRow($table,$where=NULL,$limit=NULL)
    {
      $this->db->select('*');
      $this->db->from($table);
      if(!empty($where)){
          $this->db->where($where);
      }
     
      if (!empty($limit)) {
        $this->db->limit($limit);
      }
      $query    = $this->db->get();
      $response = $query->result();
      return $response;
    }
    public function getCount($table,$where='')
    {
         $this->db->select("COUNT(*) as num");
         if (!empty($where)) {
            $this->db->where($where);
         }
        $query =$this->db->get($table);
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }

    public function getColumValue($table,$key,$where='')
    {
         $this->db->select($key." as name");
         if (!empty($where)) {
            $this->db->where($where);
         }
        $query =$this->db->get($table);
        $result = $query->row();
        if(isset($result)) return $result->name;
        return 0;
    }
  
  }

?>