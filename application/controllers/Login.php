<?php

defined('BASEPATH') or exit('Caminho Inválido');

class Login extends CI_Controller
{
    public function index()
    {
        $data = [
            'titulo' => 'Login',
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('login/index');
        $this->load->view('layout/footer');
    }

    public function auth()
    {
        $identity = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));
        $remember = false; // remember the user

        if ($this->ion_auth->login($identity, $password, $remember)) {
            redirect('home');
        } else {

            $usuario = $this->core_model->get_by_id('users', array('email' => $identity));
 
            if($usuario->active == 0){
                $this->session->set_flashdata('info', 'Sua conta está inativa !!!'); /// coloque o texto que achar melhor
                redirect('login');
            }

            $this->session->set_flashdata('error', 'Email ou senha incorretos !!!');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->ion_auth->logout();
        redirect('login');
    }
}
