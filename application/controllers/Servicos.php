<?php

defined('BASEPATH') or exit('Caminho inválido');

class Servicos extends CI_Controller
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
        $data = [
            'titulo' => 'Serviços Cadastrados',
            'styles' => ['vendor/datatables/dataTables.bootstrap4.min.css'],

            'scripts' => ['vendor/mask/jquery.mask.min.js',
                          'vendor/datatables/jquery.dataTables.min.js',
                          'vendor/datatables/dataTables.bootstrap4.min.js',
                          'vendor/datatables/app.js',
                          'vendor/mask/app.js'],

            'servicos' => $this->core_model->get_all('servicos'),
        ];

        //echo '<pre>';
        //print_r($data['servicoes']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('servicos/index');
        $this->load->view('layout/footer');
    }

    public function editar($servico_id =null){

        //verificar se foi passado o id para editar
        if(!$servico_id || !$this->core_model->get_by_id('servicos', ['servico_id' => $servico_id])){
            $this->session->set_flashdata('error', 'servico não localizado !!!');
            redirect('servicos');

        }else{

            $this->form_validation->set_rules('servico_nome', 'nome do serviço', 'trim|min_length[10]|max_length[145]|required|callback_nome_check');
            $this->form_validation->set_rules('servico_preco', 'preço', 'trim|required');
            $this->form_validation->set_rules('servico_descricao', 'descrição do serviço', 'trim|max_length[700]');

            if ($this->form_validation->run()) {

                $data = elements(
                    [
                        'servico_nome',
                        'servico_preco',
                        'servico_descricao',                      
                        'servico_ativo',
                    ], $this->input->post(),
                );

                $data = html_escape($data);

                $this->core_model->update('servicos', $data, ['servico_id' => $servico_id]);
                redirect('servicos');
                
            }else{

                //erro de validação
                $data = [
                    'titulo' => 'Atualizar serviço',
    
                    'scripts' => ['vendor/mask/jquery.mask.min.js',
                                  'vendor/mask/app.js'],
    
                    'servico' => $this->core_model->get_by_id('servicos', ['servico_id' => $servico_id]),
                ];
    
                //echo '<pre>';
                //print_r($data['servico']);
                //exit();
    
                $this->load->view('layout/header', $data);
                $this->load->view('servicos/editar');
                $this->load->view('layout/footer');

            }

        }

    }

    public function adicionar(){

        $this->form_validation->set_rules('servico_nome', 'serviço', 'trim|min_length[10]|max_length[145]|required|is_unique[servicos.servico_nome]');
        $this->form_validation->set_rules('servico_preco', 'valor', 'trim|required');
        $this->form_validation->set_rules('servico_descricao', 'descrição', 'trim|max_length[700]');

        if ($this->form_validation->run()) {

            $data = elements(
                [
                    'servico_nome',
                    'servico_preco',
                    'servico_descricao',                      
                    'servico_ativo',
                ], $this->input->post(),
            );

            $data = html_escape($data);

            $this->core_model->insert('servicos', $data);
            redirect('servicos');
            
        }else{

            //erro de validação
            $data = [
                'titulo' => 'Cadastrar serviço',

                'scripts' => ['vendor/mask/jquery.mask.min.js',
                              'vendor/mask/app.js'],   
            ];

            //echo '<pre>';
            //print_r($data['servico']);
            //exit();

            $this->load->view('layout/header', $data);
            $this->load->view('servicos/adicionar');
            $this->load->view('layout/footer');

        }
        

    }

    public function deletar($servico_id = null)
    {
        if (!$servico_id || !$this->core_model->get_by_id('servicos', ['servico_id' => $servico_id])) {
            $this->session->set_flashdata('error', 'servico não localizado');
            redirect('servicos');
            
        } else {

            $this->core_model->delete('servicos', ['servico_id' => $servico_id]);
            redirect('servicos');
        }  
    }

    public function nome_check($servico_nome)
    {
        $servico_id = $this->input->post('servico_id');

        if ($this->core_model->get_by_id('servicos', ['servico_nome' => $servico_nome, 'servico_id!=' => $servico_id])) {
            $this->form_validation->set_message('nome_check', 'Esse nome de serviço já existe');

            return false;
        } else {
            return true;
        }
    }

}