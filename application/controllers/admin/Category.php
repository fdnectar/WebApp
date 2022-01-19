<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{

    //this method will show list category page
    public function index()
    {
        $this->load->model('Category_model');
        $search = $this->input->get('q');
        $params['search'] = $search;
        $categories = $this->Category_model->getCategories($params);
        $data['categories'] = $categories;
        $data['search'] = $search;
        $this->load->view('admin/list', $data);
    }
    //this method will show category create page
    public function create()
    {
        $this->load->helper('common_helper');
        $config['upload_path']          = './assets/images/category/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']        = true;
        $this->load->library('upload', $config);
        $this->load->model('Category_model');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            if (!empty($_FILES['image']['name'])) {
                //user has selected file so we can proceed
                if ($this->upload->do_upload('image')) {
                    //file uploaded successfully
                    $data = $this->upload->data();

                    //Resizing part
                    resizeImage($config['upload_path'] . $data['file_name'], $config['upload_path'] . 'thumb/' . $data['file_name'], 300, 200);

                    $formArray['image'] = $data['file_name'];
                    $formArray['name'] = $this->input->post('name');
                    $formArray['status'] = $this->input->post('status');
                    $formArray['created_at'] = date('Y-m-d H:i:s');
                    $this->session->set_flashdata('message', 'Category added successfully !');
                    $this->Category_model->create($formArray);
                    redirect(base_url() . 'admin/category/index');
                } else {
                    //we will show errors
                    $error =  $this->upload->display_errors("<p class='invalid-feedback'>", '</p>');
                    $data['errorImageUpload'] = $error;
                    $this->load->view('admin/create', $data);
                }
            } else {
                //will save category without image
                $formArray['name'] = $this->input->post('name');
                $formArray['status'] = $this->input->post('status');
                $formArray['created_at'] = date('Y-m-d H:i:s');
                $this->session->set_flashdata('message', 'Category added successfully !');
                $this->Category_model->create($formArray);
                redirect(base_url() . 'admin/category/index');
            }
        } else {
            $this->load->view('admin/create');
        }
    }
    //this method will show category edit page
    public function edit()
    {
    }
    //this method will delete the category
    public function delete()
    {
    }

    // public function do_upload()
    // {
    //     $config['upload_path']          = './assets/images/category/';
    //     $config['allowed_types']        = 'gif|jpg|png';
    //     $config['max_size']             = 100;
    //     $config['max_width']            = 1024;
    //     $config['max_height']           = 768;

    //     $this->load->library('upload', $config);

    //     if (!$this->upload->do_upload('image')) {
    //         $error = array('error' => $this->upload->display_errors());
    //         echo "<pre>"; print_r($error); die();
    //         $this->load->view('upload_form', $error);
    //     } else {
    //         $data = array('upload_data' => $this->upload->data());
    //         echo "<pre>"; print_r($data); die();
    //         $this->load->view('upload_success', $data);
    //     }
    // }
}
