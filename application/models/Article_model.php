<?php

class Article_model extends CI_Model{

    public function getArticle(){

    }

    public function getArticles(){

    }

    public function addArticles($formArray){
        //this function will add article in db
        $this->db->insert('articles', $formArray);
        return $this->db->insert_id();
    }
}

?>