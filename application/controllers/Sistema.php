<?php

defined('BASEPATH') or exit('Caminho Inválido');

class Sistema extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Voce precisa estar logado, favor efetuar o login');
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'titulo'  => 'Editar informações do sistema',
            'scripts' =>['vendor/mask/jquery.mask.min.js'],
            'scripts' =>['vendor/mask/app.js'],
            'sistema' =>  $this->core_model->get_by_id('sistema', ['sistema_id'=> 1]),
        ];

        /*
            [sistema_id] => 1
            [sistema_razao_social] => System Ordem Inc
            [sistema_nome_fantasia] => TellNet
            [sistema_cnpj] => 30.235.254/0001-50
            [sistema_ie] => 476.875.136.288
            [sistema_telefone_fixo] => (18) 3281-5214
            [sistema_telefone_movel] => (18) 99185-2548
            [sistema_email] => farlefernado@gmail.com
            [sistema_site_url] => farleyfernando.com.br
            [sistema_cep] => 19470-000
            [sistema_endereco] => R. Rio de Janeiro
            [sistema_numero] => 34-28
            [sistema_cidade] => Presidente Epitácio
            [sistema_estado] => SP
            [sistema_txt_ordem_servico] => 
            [sistema_data_alteracao] => 2020-10-11 15:42:10
        */

        $this->form_validation->set_rules('sistema_razao_social','razão social','required|min_length[5]|max_length[145]');
        $this->form_validation->set_rules('sistema_nome_fantasia','','required|min_length[5]|max_length[145]');
        $this->form_validation->set_rules('sistema_cnpj','cnpj','required|exact_length[18]');
        $this->form_validation->set_rules('sistema_ie','Insc. Est.','required|min_length[5]|max_length[25]');
        $this->form_validation->set_rules('sistema_telefone_fixo','','');
        $this->form_validation->set_rules('sistema_telefone_movel','tel. movel','required|exact_length[15]');
        $this->form_validation->set_rules('sistema_email','','required|valid_email|max_length[100]');
        $this->form_validation->set_rules('sistema_site_url','site','valid_url|max_length[100]');
        $this->form_validation->set_rules('sistema_cep','','required|exact_length[9]');
        $this->form_validation->set_rules('sistema_endereco','','required|max_length[145]');
        $this->form_validation->set_rules('sistema_numero','','required|max_length[10]');
        $this->form_validation->set_rules('sistema_cidade','cidade','required|max_length[45]');
        $this->form_validation->set_rules('sistema_estado','','required|max_length[2]');
        $this->form_validation->set_rules('sistema_sistema_txt_ordem_servico','','max_length[500]');


        if ($this->form_validation->run()){

            $data = elements(
                [
                    'sistema_razao_social',
                    'sistema_nome_fantasia',
                    'sistema_cnpj',
                    'sistema_ie',
                    'sistema_telefone_fixo',
                    'sistema_telefone_movel',
                    'sistema_email',
                    'sistema_site_url',
                    'sistema_site_url',
                    'sistema_cep',
                    'sistema_endereco',
                    'sistema_numero',
                    'sistema_cidade',
                    'sistema_estado',
                    'sistema_txt_ordem_servico',
                ], $this->input->post(),
                );

                $data = html_escape($data);

                $this->core_model->update('sistema',$data, ['sistema_id' => 1]);
                redirect('sistema');
        }else{

            $this->load->view('layout/header', $data);
            $this->load->view('sistema/index');
            $this->load->view('layout/footer');

        }      
    }
}
