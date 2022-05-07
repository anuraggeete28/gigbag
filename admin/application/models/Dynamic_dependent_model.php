<?php
class Dynamic_dependent_model extends CI_Model
{
 function fetch_country()
 {
  $this->db->order_by("country", "ASC");
  $query = $this->db->get("countries");
  return $query->result();
 }
 
 
 /*function Fetch_category()
 {
  $this->db->order_by("subcatname", "ASC");
  $query = $this->db->get("subcategory");
  return $query->result();
 }*/
 
 
 function Fetch_category($Fetch_catgry)
 {
  $this->db->where('subcat_id', $Fetch_catgry);
  $this->db->order_by('subcatname', 'ASC');
  $query = $this->db->get('subcategory');
  $output = '<option value="">Select sub category</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->subcat_id.'">'.$row->subcatname.'</option>';
  }
  return $output;
 }
 function Fetch_subcategory($category_id)
 {
  $this->db->where('category_id', $category_id);
  $this->db->order_by('subcatname', 'ASC');
  $query = $this->db->get('subcategory');
  $output = '<option value="">Select sub category</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->subcat_id.'">'.$row->subcatname.'</option>';
  }
  return $output;
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
}

?>