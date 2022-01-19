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
    public function edit($id)
    {
        $this->load->model('Category_model');
        $categories = $this->Category_model->getCategory($id);
        if (empty($categories)) {
            $this->session->set_flashdata('msg', 'Category not found..');
            redirect(base_url() . 'admin/category/index');
        }
        $this->load->helper('common_helper');
        $config['upload_path']          = './assets/images/category/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']        = true;
        $this->load->library('upload', $config);
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
                    $formArray['updated_at'] = date('Y-m-d H:i:s');

                    $this->Category_model->update($id, $formArray);

                    //unlink image part not working
                    if (file_exists(base_url().'assets/images/category/' . $categories['image'])) {
                        unlink(base_url().'assets/images/category/' . $categories['image']);
                    }

                    if (file_exists(base_url().'assets/images/category/thumb/' . $categories['image'])) {
                        unlink(base_url().'assets/images/category/thumb/' . $categories['image']);
                    }
                    //unlink image part not working

                    $this->session->set_flashdata('message', 'Category updated successfully !');
                    redirect(base_url() . 'admin/category/index');
                } else {
                    //we will show errors
                    $error =  $this->upload->display_errors("<p class='invalid-feedback'>", '</p>');
                    $data['errorImageUpload'] = $error;
                    $data['categories'] = $categories;
                    $this->load->view('admin/edit', $data);
                }
            } else {
                //will save category without image
                $formArray['name'] = $this->input->post('name');
                $formArray['status'] = $this->input->post('status');
                $formArray['updated_at'] = date('Y-m-d H:i:s');
                $this->Category_model->update($id, $formArray);
                $this->session->set_flashdata('message', 'Category updated successfully !');
                redirect(base_url() . 'admin/category/index');
            }
        } else {
            $data['categories'] = $categories;
            $this->load->view('admin/edit', $data);
        }
    }

    //this method will delete the category
    public function delete($id)
    {
        $this->load->model('Category_model');
        $categories = $this->Category_model->getCategory($id);
        if (empty($categories)) {
            $this->session->set_flashdata('msg', 'Category not found..');
            redirect(base_url() . 'admin/category/index');
        }
        if (file_exists(base_url().'/assets/images/category/' . $categories['image'])) {
            unlink(base_url().'assets/images/category/' . $categories['image']);
        }

        if (file_exists(base_url().'/assets/images/category/thumb/' . $categories['image'])) {
            unlink(base_url().'assets/images/category/thumb/' . $categories['image']);
        }
        $this->Category_model->delete($id);
        $this->session->set_flashdata('success', 'Category deleted successfully !');
        redirect(base_url() . 'admin/category/index');
        
    }
}
