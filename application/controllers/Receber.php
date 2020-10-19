<?php

defined('BASEPATH') or exit('Caminho inválido');

class Receber extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sessão encerrada, favor efetuar o login novamente !!!');
            redirect('login');
        }

        $this->load->model('financeiro_model');

    }

    public function index()
    {
        $data = [
            'titulo' => 'Contas a receber cadastradas',
            'styles' => ['vendor/datatables/dataTables.bootstrap4.min.css'],

            'scripts' => ['vendor/mask/jquery.mask.min.js',
                          'vendor/datatables/jquery.dataTables.min.js',
                          'vendor/datatables/dataTables.bootstrap4.min.js',
                          'vendor/datatables/app.js',
                          'vendor/mask/app.js'],

            'contas_receber' => $this->financeiro_model->get_all_receber(''),
        ];

       // echo '<pre>';
       // print_r($data['contas_receber']);
       // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('receber/index');
        $this->load->view('layout/footer');
    }

    public function adicionar(){

        $this->form_validation->set_rules('conta_receber_cliente_id','','required');
        $this->form_validation->set_rules('conta_receber_data_vencto','','required');
        $this->form_validation->set_rules('conta_receber_valor','','required');
        $this->form_validation->set_rules('conta_receber_obs','observações','max_length[100]');

        if($this->form_validation->run()){

            $data = elements([
                'conta_receber_cliente_id',
                'conta_receber_data_vencto',
                'conta_receber_valor',
                'conta_receber_status',
                'conta_receber_obs',
                ], $this->input->post()
            );
            //verificar se foi paga
            $conta_receber_status = $this->input->post('conta_receber_status');

            if($conta_receber_status == 1){
                $data['conta_receber_data_pagamento'] = date('Y-m-d H:i:s');
            }

            $data = html_escape($data);

            $this->core_model->insert('contas_receber', $data);
            redirect('receber');

        }else{

            //form validation

        $data = [
            'titulo' => 'Cadastrar contas a receber',
            'styles' => ['vendor/select2/select2.min.css'],

            'scripts' => ['vendor/select2/select2.min.js',
                          'vendor/select2/app.js',
                          'vendor/mask/jquery.mask.min.js',
                          'vendor/mask/app.js'],

            'clientes' => $this->core_model->get_all('clientes', ['cliente_ativo' => 1]),

        ];

 
        
        //echo '<pre>';
        //print_r($data['produtos']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('receber/adicionar');
        $this->load->view('layout/footer');
        } 

    }

    public function editar($conta_receber_id = null){

        if(!$conta_receber_id || !$this->core_model->get_by_id('contas_receber', ['conta_receber_id' => $conta_receber_id])){

            $this->session->set_flashdata('error', 'Conta não localizada !!!');
            redirect('receber');

        }else{

            $this->form_validation->set_rules('conta_receber_cliente_id','','required');
            $this->form_validation->set_rules('conta_receber_data_vencto','','required');
            $this->form_validation->set_rules('conta_receber_valor','','required');
            $this->form_validation->set_rules('conta_receber_obs','observações','max_length[100]');

            if($this->form_validation->run()){

                $data = elements([
                    'conta_receber_cliente_id',
                    'conta_receber_data_vencto',
                    'conta_receber_valor',
                    'conta_receber_status',
                    'conta_receber_obs',
                    ], $this->input->post()
                );
                //verificar se foi paga
                $conta_receber_status = $this->input->post('conta_receber_status');

                if($conta_receber_status == 1){
                    $data['conta_receber_data_pagamento'] = date('Y-m-d H:i:s');
                }

                $data = html_escape($data);

                $this->core_model->update('contas_receber', $data, ['conta_receber_id' => $conta_receber_id]);
                redirect('receber');

            }else{

                //form validation

            $data = [
                'titulo' => 'Atualizar contas a receber',
                'styles' => ['vendor/select2/select2.min.css'],

                'scripts' => ['vendor/select2/select2.min.js',
                              'vendor/select2/app.js',
                              'vendor/mask/jquery.mask.min.js',
                              'vendor/mask/app.js'],


                'conta_receber' => $this->core_model->get_by_id('contas_receber', ['conta_receber_id' => $conta_receber_id]),
                'clientes' => $this->core_model->get_all('clientes', ['cliente_ativo' => 1]),

            ];
            
            //echo '<pre>';
            //print_r($data['produtos']);
            //exit();

            $this->load->view('layout/header', $data);
            $this->load->view('receber/editar');
            $this->load->view('layout/footer');
            }            
        }
    }

    public function deletar($conta_receber_id = null){

        if(!$conta_receber_id || !$this->core_model->get_by_id('contas_receber', ['conta_receber_id' => $conta_receber_id])){

            $this->session->set_flashdata('error', 'Conta não localizada !!!');
            redirect('receber');

        }elseif($this->core_model->get_by_id('contas_receber', ['conta_receber_id' => $conta_receber_id, 'conta_receber_status' => 0])){

            $this->session->set_flashdata('info', 'Solicitação não atendida, conta em aberto !!!');
            redirect('receber');

        }else{

            $this->core_model->delete('contas_receber', ['conta_receber_id' => $conta_receber_id]);
            redirect('receber');
        }
    }
}