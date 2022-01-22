<?php

class Article_model extends CI_Model
{

    public function getArticle()
    {
    }

    public function getArticles($param = array())
    {
        if (isset($param['offset']) && isset($param['limit'])) {
            $this->db->limit($param['offset'], $param['limit']);
        }

        if (isset($param['q'])) {
            $this->db->or_like('title', trim($param['q']));
            $this->db->or_like('author', trim($param['q']));
        }


        $query = $this->db->get('articles');
        $articles = $query->result_array();
        return $articles;
    }

    public function getArticlesCounts($param = array())
    {
        if (isset($param['q'])) {
            $this->db->or_like('title', trim($param['q']));
            $this->db->or_like('author', trim($param['q']));
        }
        if (isset($param['category_id'])) {
            $this->db->where('category',$param['category_id']);
        }

        $count = $this->db->count_all_results('articles');
        //echo "<pre>"; print_r($count); die();
        return $count;
    }

    public function addArticles($formArray)
    {
        //this function will add article in db
        $this->db->insert('articles', $formArray);
        return $this->db->insert_id();
    }
}
