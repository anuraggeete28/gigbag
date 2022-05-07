<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

    function insertRecord($record){
        
        if(count($record) > 0){
            
            // Check user
            $this->db->select('*');
            $this->db->where('methodology', $record[0]);
            $q = $this->db->get('research_data');
            $response = $q->result_array();
            $current_date=date('F Y');
            $reportcode = "GRMI".rand(10000,99999);
            // Insert record
            if(count($response) == 0){
                $newuser = array(
                    "category_id" => trim($record[0]),
                    "title" => trim($record[1]),
                    "pages" => trim($record[2]),
                    "keywords" => trim($record[3]),
                    "description" => trim($record[4]),
                    "table_of_content" => trim($record[5]),
                    "publish_date"=> $current_date,
                    "report_code"=> $reportcode
                );

                $this->db->insert('research_data', $newuser);
            }
            
        }
        
    }

}