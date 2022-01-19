<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{

    public function create($formArray)
    {
        $this->db->insert('categories', $formArray);
    }
    public function getCategories($params = [])
    {
        if (!empty($params['search'])){
            $this->db->like('name', $params['search']);
        }
            $result = $this->db->get('categories')->result_array();
        return $result;
    }
}
