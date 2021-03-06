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
        if (!empty($params['search'])) {
            $this->db->like('name', $params['search']);
        }
        $result = $this->db->get('categories')->result_array();
        return $result;
    }
    public function getCategory($id)
    {
        $this->db->where('id', $id);
        $categories = $this->db->get('categories')->row_array();
        //Select * From categories where id = {ID} 
        return $categories;
    }
    public function update($id, $formArray)
    {
        $this->db->where('id', $id);
        $this->db->update('categories', $formArray);
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('categories');
    }
}
