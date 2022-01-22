<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article extends CI_Controller
{

    // this will show list of articles
    public function index($page=1)
    {
        $perpage = 6;
        $param['offset'] = $perpage;
        $param['limit'] = ($page*$perpage)-$perpage;
        $param['q'] = $this->input->get('q');
        $this->load->model('Article_model');

        //showing pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/article/index');
        $config['total_rows'] = $this->Article_model->getArticlesCounts();
        $config['per_page'] = $perpage;
        $config['use_page_numbers'] = true;

        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled page-item'><li class='active page-item'><a href='#' class=\"page-link\">";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li class=\"page-item\">";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li  class=\"page-item\">";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li  class=\"page-item\">";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li  class=\"page-item\">";
        $config['last_tagl_close'] = "</li>";
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);
        
        $pagination_links = $this->pagination->create_links();
        
        

        //this will fetch the articles form database
        $articles = $this->Article_model->getArticles($param);
        $data['q'] = $this->input->get('q');
        $data['articles'] = $articles;
        $data['pagination_links'] = $pagination_links;
        // echo "<pre>"; print_r($data); die();
        $this->load->view('admin/article/list', $data);
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
