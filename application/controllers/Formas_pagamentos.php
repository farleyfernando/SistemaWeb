<?php

defined('BASEPATH') or exit('Caminho inválido');

class Formas_pagamentos extends CI_Controller
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
            'titulo' => 'Formas de pagamento',
            'styles' => ['vendor/datatables/dataTables.bootstrap4.min.css'],

            'scripts' => ['vendor/mask/jquery.mask.min.js',
                          'vendor/datatables/jquery.dataTables.min.js',
                          'vendor/datatables/dataTables.bootstrap4.min.js',
                          'vendor/datatables/app.js',
                          'vendor/mask/app.js'],

            'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos'),
        ];

       // echo '<pre>';
       // print_r($data['contas_pagar']);
       // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('formas_pagamentos/index');
        $this->load->view('layout/footer');
    }

    public function adicionar(){

        $this->form_validation->set_rules('forma_pagamento_nome', 'nome forma pgto', 'trim|required|min_length[4]|max_length[45]|is_unique[formas_pagamentos.forma_pagamento_nome]');
            

        if ($this->form_validation->run()) {


            $data = elements(
                [
                    'forma_pagamento_nome',                    
                    'forma_pagamento_ativa',
                    'forma_pagamento_aceita_parc',

                ], $this->input->post(),
            );

            $data = html_escape($data);
               
            $this->core_model->insert('formas_pagamentos', $data);
            redirect('modulo');


        }else{

            $data = [
                'titulo' => 'Cadastrar forma de pagamento',
            ];
    
           // echo '<pre>';
           // print_r($data['contas_pagar']);
           // exit();
    
            $this->load->view('layout/header', $data);
            $this->load->view('formas_pagamentos/adicionar');
            $this->load->view('layout/footer');

        }
    }

    public function editar($forma_pagamento_id =null){

        if(!$forma_pagamento_id || !$this->core_model->get_by_id('formas_pagamentos', ['forma_pagamento_id' => $forma_pagamento_id])){

            $this->session->set_flashdata('error', 'Forma de pagamento não localizada');
            redirect('modulo');

        }else{

            $this->form_validation->set_rules('forma_pagamento_nome', 'nome forma pgto', 'trim|required|min_length[4]|max_length[45]|callback_forma_check');
            

            if ($this->form_validation->run()) {

                $forma_pagamento_ativa = $this->input->post('forma_pagamento_ativa');

                //verificação para o modulo vendas 
                if($this->db->table_exists('vendas')){

                    if($forma_pagamento_ativa == 0 && $this->core_model->get_by_id('vendas', ['venda_forma_pagamento_id' => $forma_pagamento_id, 'venda_status' => 0])){
                        $this->session->set_flashdata('info', 'Solicitação não atendida, forma de pagemento sendo utilizada em Vendas !!!');
                        redirect('modulo');
                    }
                }

                //verificação para o modulo vendas 
                if($this->db->table_exists('ordem_servicos')){

                    if($forma_pagamento_ativa == 0 && $this->core_model->get_by_id('ordem_servicos', ['ordem_servicos_forma_pagamento_id' => $forma_pagamento_id, 'ordem_servicos_status' => 0])){
                        $this->session->set_flashdata('info', 'Solicitação não atendida, forma de pagemento sendo utilizada em Ordem de serviços !!!');
                        redirect('modulo');
                    }
                }

                $data = elements(
                    [
                        'forma_pagamento_nome',                    
                        'forma_pagamento_ativa',
                        'forma_pagamento_aceita_parc',
                    ], $this->input->post(),
                );

                $data = html_escape($data);
                   
                $this->core_model->update('formas_pagamentos', $data, ['forma_pagamento_id' => $forma_pagamento_id]);
                redirect('modulo');


            }else{


                $data = [
                    'titulo' => 'Atualizar forma de pagamento',
                    'forma_pagamento' => $this->core_model->get_by_id('formas_pagamentos', ['forma_pagamento_id' => $forma_pagamento_id])
                ];
        
               // echo '<pre>';
               // print_r($data['contas_pagar']);
               // exit();
        
                $this->load->view('layout/header', $data);
                $this->load->view('formas_pagamentos/editar');
                $this->load->view('layout/footer');

            }          
        }
    }

    public function deletar($forma_pagamento_id = null)
    {
        if (!$forma_pagamento_id || !$this->core_model->get_by_id('formas_pagamentos', ['forma_pagamento_id' => $forma_pagamento_id])) {
            $this->session->set_flashdata('error', 'Forma de pagamento não localizada !!!');
            redirect('modulo');
            
        }elseif ($this->core_model->get_by_id('formas_pagamentos', ['forma_pagamento_id' => $forma_pagamento_id, 'forma_pagamento_ativa' => 1])) {
            $this->session->set_flashdata('info', 'Solicitação não atendida, forma de pagamento ativa !!!');
            redirect('modulo');
            
        }else{

            $this->core_model->delete('formas_pagamentos', ['forma_pagamento_id' => $forma_pagamento_id]);
            redirect('modulo');
        } 
     
    }

    public function forma_check($forma_pagamento_nome)
    {
        $forma_pagamento_id = $this->input->post('forma_pagamento_id');

        if ($this->core_model->get_by_id('formas_pagamentos', ['forma_pagamento_nome' => $forma_pagamento_nome, 'forma_pagamento_id!=' => $forma_pagamento_id])) {
            $this->form_validation->set_message('forma_check', 'Essa forma de pagamento já existe');

            return false;
        } else {
            return true;
        }
    }
}