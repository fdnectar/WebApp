<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article extends CI_Controller
{

    // this will show list of articles
    public function index()
    {
        $this->load->view('admin/article/list');
    }
    // this will show create page of articles

    public function create()
    {
        //this will give category name in select option from database
        $this->load->model('Category_model');
        $this->load->model('Article_model');
        $this->load->helper('common_helper');

        $categories = $this->Category_model->getCategories();
        $data['categories'] = $categories;

        //file upload settings

        $config['upload_path'] = './assets/images/articles/';
        $config['allowed_types'] = 'gif|png|jpg';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);


        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
        $this->form_validation->set_rules('category_id', 'Category', 'trim|required');
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[20]');
        $this->form_validation->set_rules('author', 'Author', 'trim|required');

        if ($this->form_validation->run() == true) {
            //Validated Succesfully 

            if (!empty($_FILES['image']['name'])) {
                //image upload successfully
                if ($this->upload->do_upload('image')) {
                    //image uploaded successfully
                    $data = $this->upload->data();

                    resizeImage($config['upload_path'] . $data['file_name'], $config['upload_path'] . 'thumb_front/' . $data['file_name'], 1120, 800);
                    resizeImage($config['upload_path'] . $data['file_name'], $config['upload_path'] . 'thumb_admin/' . $data['file_name'], 300, 250);


                    $formArray['image'] = $data['file_name'];
                    $formArray['title'] = $this->input->post('title');
                    $formArray['category'] = $this->input->post('category_id');
                    $formArray['description'] = $this->input->post('description');
                    $formArray['author'] = $this->input->post('author');
                    $formArray['status'] = $this->input->post('status');
                    $formArray['created_at'] = date('Y-m-d H:i:s');
                    $this->Article_model->addArticles($formArray);
                    $this->session->set_flashdata('message', 'Article added successfully !');
                    redirect(base_url() . 'admin/article/index');
                } else {
                    //errors
                    // echo "<pre>"; print_r($this->upload->display_errors()); die();
                    $error =  $this->upload->display_errors("<p class='invalid-feedback'>", '</p>');
                    $data['imageError'] = $error;
                    $this->load->view('admin/article/create', $data);
                }
            } else {
                // will save article without image
                $formArray['title'] = $this->input->post('title');
                $formArray['category'] = $this->input->post('category_id');
                $formArray['description'] = $this->input->post('description');
                $formArray['author'] = $this->input->post('author');
                $formArray['status'] = $this->input->post('status');
                $formArray['created_at'] = date('Y-m-d H:i:s');
                $this->Article_model->addArticles($formArray);
                $this->session->set_flashdata('message', 'Article added successfully !');
                redirect(base_url() . 'admin/article/index');
            }
        } else {
            //validation failed
            $this->load->view('admin/article/create', $data);
        }
    }
}
