<?php

defined('BASEPATH') or exit('Caminho Inválido');

class Usuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sessão encerrada, favor efetuar o login novamente !!!');
            redirect('login');
        }
    }

    public function index()
    {
        if(!$this->ion_auth->is_admin()){

            $this->session->set_flashdata('info', 'ACESSO NEGADO !!!');
            redirect('/');
        }

        $data = [
            'titulo' => 'Usuários cadastrados',

            'styles' => [
                'vendor/datatables/dataTables.bootstrap4.min.css', ],

            'scripts' => [
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js'],

            'usuarios' => $this->ion_auth->users()->result(),
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/index');
        $this->load->view('layout/footer');
    }

    public function adicionar()
    {

        if(!$this->ion_auth->is_admin()){

            $this->session->set_flashdata('info', 'ACESSO NEGADO !!!');
            redirect('/');
        }

        $this->form_validation->set_rules('first_name', 'nome', 'trim|required|min_length[3]|max_length[15]');
        $this->form_validation->set_rules('last_name', '', 'trim|required|min_length[5]|max_length[50]');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('username', 'usuário', 'trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('phone', 'telefone', 'required');
        $this->form_validation->set_rules('password', 'senha', 'required|min_length[5]|max_length[255]');
        $this->form_validation->set_rules('confirm_password', 'confirmar senha', 'matches[password]');

        if ($this->form_validation->run()) {
            $username = $this->security->xss_clean($this->input->post('username'));
            $password = $this->security->xss_clean($this->input->post('password'));
            $email = $this->security->xss_clean($this->input->post('email'));

            $additional_data = [
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'username' => $this->input->post('username'),
                        'phone' => $this->input->post('phone'),
                        'active' => $this->input->post('active'),
                        ];
            $group = [$this->input->post('perfil_usuario')];

            $additional_data = $this->security->xss_clean($additional_data);

            $group = $this->security->xss_clean($group);

            if ($this->ion_auth->register($username, $password, $email, $additional_data, $group)) {
                $this->session->set_flashdata('sucesso', 'Usuário cadastrado com sucesso !!!');
            } else {
                $this->session->set_flashdata('error', 'Erro ao cadastrar usuário !!!');
            }
            redirect('usuarios');
        } else {
            //erro de validação

            $data = [
                'titulo' => 'Cadastrar usuário',
            ];

            $this->load->view('layout/header', $data);
            $this->load->view('usuarios/adicionar');
            $this->load->view('layout/footer');
        }
    }

    public function edit($usuario_id = null)
    {
         //Se não for admin e tentar editar user diferente do seu
         if (!$this->ion_auth->is_admin()) {

            if (($this->session->userdata('user_id') != $usuario_id)) {
                $this->session->set_flashdata('error', 'ACESSO NEGADO !!!');
                redirect('/');
            }
        }

        if (!$usuario_id || !$this->ion_auth->user($usuario_id)->row()) {
            $this->session->set_flashdata('error', 'Usuário não localizado !!!');
            redirect('usuarios');
        } else {

            
            $this->form_validation->set_rules('first_name', 'nome', 'trim|required|min_length[3]|max_length[10]');
            $this->form_validation->set_rules('last_name', '', 'trim|required|min_length[5]|max_length[50]');
            $this->form_validation->set_rules('email', '', 'trim|required|valid_email|callback_email_check');
            $this->form_validation->set_rules('username', '', 'trim|required|callback_username_check');
            $this->form_validation->set_rules('phone', 'telefone', 'required');
            $this->form_validation->set_rules('password', 'senha', 'min_length[5]|max_length[255]');
            $this->form_validation->set_rules('confirm_password', 'confirmar senha', 'matches[password]');

            if ($this->form_validation->run()) {

               // echo '<pre>';
                //print_r($this->input->post());
                //exit();

                $data = elements(
                    [
                        'first_name',
                        'last_name',
                        'email',
                        'username',
                        'phone',
                        'active',
                        'password',
                    ], $this->input->post()
                );

                if (!$this->ion_auth->is_admin()) {
                    unset($data['active']);
                }

                // verificação contra tentativa de introdução de codigos maliciosos no formulário limpando os formulários
                $data = $this->security->xss_clean($data);

                $password = $this->input->post('password');

                //verifica se fi passado a senha
                if (!$password) {
                    unset($data['password']);
                }

                if ($this->ion_auth->update($usuario_id, $data)) {
                    //prefil usuario verificar

                    $perfil_usuario_db = $this->ion_auth->get_users_groups($usuario_id)->row();
                    $perfil_usuario_post = $this->input->post('perfil_usuario');

                    //se o perfil for diferente atualiza o grupo

                    if ($this->ion_auth->is_admin()) {

                        if ($perfil_usuario_post != $perfil_usuario_db->id) {
                            $this->ion_auth->remove_from_group($perfil_usuario_db->id, $usuario_id);
    
                            $this->ion_auth->add_to_group($perfil_usuario_post, $usuario_id);
                        }
                    }
                    

                    $this->session->set_flashdata('sucesso', 'Atualização efetuada com sucesso !!!');
                } else {
                    $this->session->set_flashdata('error', 'Não foi possível efetuar a atualização !!!');
                }

                if($this->ion_auth->is_admin()){

                    redirect('usuarios');                 
                }else{
                    redirect('/');
                }
                
            } else {
                $data = [
                    'titulo' => 'Editar usuário',
                    'usuario' => $this->ion_auth->user($usuario_id)->row(),
                    'perfil_usuario' => $this->ion_auth->get_users_groups($usuario_id)->row(),
                ];

                $this->load->view('layout/header', $data);
                $this->load->view('usuarios/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function deletar($usuario_id = null)
    {
        if(!$this->ion_auth->is_admin()){

            $this->session->set_flashdata('info', 'ACESSO NEGADO !!!');
            redirect('/');
        }

        if (!$usuario_id || !$this->ion_auth->user($usuario_id)->row()) {
            $this->session->set_flashdata('error', 'Usuário não localizado !!!');
            redirect('usuarios');
        }

        if ($this->ion_auth->is_admin($usuario_id)) {
            $this->session->set_flashdata('info', 'Solicitação não atendida, para excluir um usuário administrador antes altere seu perfil !!!');
            redirect('usuarios');
        }

        if ($this->ion_auth->delete_user($usuario_id)) {
            $this->session->set_flashdata('sucesso', 'Usuário excluído com sucesso !!!');
            redirect('usuarios');
        } else {
            $this->session->set_flashdata('error', 'Erro ao excluir usuário !!!');
            redirect('usuarios');
        }
    }

    public function email_check($email)
    {
        $usuario_id = $this->input->post('usuario_id');

        if ($this->core_model->get_by_id('users', ['email' => $email, 'id!=' => $usuario_id])) {
            $this->form_validation->set_message('email_check', 'Esse e-mail já existe');

            return false;
        } else {
            return true;
        }
    }

    public function username_check($username)
    {
        $usuario_id = $this->input->post('usuario_id');

        if ($this->core_model->get_by_id('users', ['username' => $username, 'id!=' => $usuario_id])) {
            $this->form_validation->set_message('username_check', 'Esse nome de usuário não está disponível');

            return false;
        } else {
            return true;
        }
    }
}
