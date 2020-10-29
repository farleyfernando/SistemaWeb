<?php

defined('BASEPATH') or exit('Caminho inválido');

class Pagar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sessão encerrada, favor efetuar o login novamente !!!');
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){

            $this->session->set_flashdata('info', 'ACESSO NEGADO !!!');
            redirect('/');
        }

        $this->load->model('financeiro_model');

    }

    public function index()
    {
        $data = [
            'titulo' => 'Contas a pagar cadastradas',
            'styles' => ['vendor/datatables/dataTables.bootstrap4.min.css'],

            'scripts' => ['vendor/mask/jquery.mask.min.js',
                          'vendor/datatables/jquery.dataTables.min.js',
                          'vendor/datatables/dataTables.bootstrap4.min.js',
                          'vendor/datatables/app.js',
                          'vendor/mask/app.js'],

            'contas_pagar' => $this->financeiro_model->get_all_pagar(''),
        ];

       // echo '<pre>';
       // print_r($data['contas_pagar']);
       // exit();

        $this->load->view('layout/header', $data);
        $this->load->view('pagar/index');
        $this->load->view('layout/footer');
    }

    public function adicionar($conta_pagar_id = null){

        $this->form_validation->set_rules('conta_pagar_fornecedor_id','','required');
        $this->form_validation->set_rules('conta_pagar_data_venc','','required');
        $this->form_validation->set_rules('conta_pagar_valor','','required');
        $this->form_validation->set_rules('conta_pagar_obs','observações','max_length[100]');

        if($this->form_validation->run()){

            $data = elements([
                'conta_pagar_fornecedor_id',
                'conta_pagar_data_venc',
                'conta_pagar_valor',
                'conta_pagar_status',
                'conta_pagar_obs',
                ], $this->input->post()
            );
            //verificar se foi paga
            $conta_pagar_status = $this->input->post('conta_pagar_status');

            if($conta_pagar_status == 1){
                $data['conta_pagar_data_pagamento'] = date('Y-m-d H:i:s');
            }

            $data = html_escape($data);

            $this->core_model->insert('contas_pagar', $data);
            redirect('pagar');

        }else{

            //form validation

        $data = [
            'titulo' => 'Cadastrar contas a pagar',
            'styles' => ['vendor/select2/select2.min.css'],

            'scripts' => ['vendor/select2/select2.min.js',
                          'vendor/select2/app.js',
                          'vendor/mask/jquery.mask.min.js',
                          'vendor/mask/app.js'],

            'fornecedores' => $this->core_model->get_all('fornecedores'),

        ];


        
        //echo '<pre>';
        //print_r($data['produtos']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('pagar/adicionar');
        $this->load->view('layout/footer');
        } 

    }

    public function editar($conta_pagar_id = null){

        if(!$conta_pagar_id || !$this->core_model->get_by_id('contas_pagar', ['conta_pagar_id' => $conta_pagar_id])){

            $this->session->set_flashdata('error', 'Conta não localizada !!!');
            redirect('pagar');

        }else{

            $this->form_validation->set_rules('conta_pagar_fornecedor_id','','required');
            $this->form_validation->set_rules('conta_pagar_data_venc','','required');
            $this->form_validation->set_rules('conta_pagar_valor','','required');
            $this->form_validation->set_rules('conta_pagar_obs','observações','max_length[100]');

            if($this->form_validation->run()){

                $data = elements([
                    'conta_pagar_fornecedor_id',
                    'conta_pagar_data_venc',
                    'conta_pagar_valor',
                    'conta_pagar_status',
                    'conta_pagar_obs',
                    ], $this->input->post()
                );
                //verificar se foi paga
                $conta_pagar_status = $this->input->post('conta_pagar_status');

                if($conta_pagar_status == 1){
                    $data['conta_pagar_data_pagamento'] = date('Y-m-d H:i:s');
                }

                $data = html_escape($data);

                $this->core_model->update('contas_pagar', $data, ['conta_pagar_id' => $conta_pagar_id]);
                redirect('pagar');

            }else{

                //form validation

            $data = [
                'titulo' => 'Atualizar contas a pagar',
                'styles' => ['vendor/select2/select2.min.css'],

                'scripts' => ['vendor/select2/select2.min.js',
                              'vendor/select2/app.js',
                              'vendor/mask/jquery.mask.min.js',
                              'vendor/mask/app.js'],


                'conta_pagar' => $this->core_model->get_by_id('contas_pagar', ['conta_pagar_id' => $conta_pagar_id]),
                'fornecedores' => $this->core_model->get_all('fornecedores'),

            ];


            
            //echo '<pre>';
            //print_r($data['produtos']);
            //exit();

            $this->load->view('layout/header', $data);
            $this->load->view('pagar/editar');
            $this->load->view('layout/footer');
            }            
        }
    }

    public function deletar($conta_pagar_id = null){

        if(!$conta_pagar_id || !$this->core_model->get_by_id('contas_pagar', ['conta_pagar_id' => $conta_pagar_id])){

            $this->session->set_flashdata('error', 'Conta não localizada !!!');
            redirect('pagar');

        }elseif($this->core_model->get_by_id('contas_pagar', ['conta_pagar_id' => $conta_pagar_id, 'conta_pagar_status' => 0])){

            $this->session->set_flashdata('info', 'Solicitação não atendida, conta em aberto !!!');
            redirect('pagar');

        }else{

            $this->core_model->delete('contas_pagar', ['conta_pagar_id' => $conta_pagar_id]);
            redirect('pagar');
        }
    }
}