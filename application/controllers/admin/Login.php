<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    //log functionality
    public function index()
    {

        $this->load->view('admin/login');
    }
    public function authenticate()
    {
        $this->load->model('Admin');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == true) {
            $username = $this->input->post('username');
            $admin = $this->Admin->getByUsername($username);

            if (!empty($admin)) {
                $password = $this->input->post('password');
                if (password_verify($password, $admin['password']) == true) {
                    $admin['admin_id'] = $admin['id'];
                    $admin['username'] = $admin['username'];
                    $this->session->set_userdata('admin', $admin);
                    redirect(base_url() . 'admin/home/index');
                } else {
                    $this->session->set_flashdata('message', 'Either username or password is incorrect !');
                    redirect(base_url() . 'admin/login/index');
                }
            } else {
                $this->session->set_flashdata('message', 'Either username or password is incorrect !');
                redirect(base_url() . 'admin/login/index');
            }
        } else {
            $this->load->view('admin/login');
        }
    }
    public function logout(){
        $this->session->unset_userdata('admin');
        redirect(base_url(). 'admin/login/index');
    }
    //login functionality end
    
}
