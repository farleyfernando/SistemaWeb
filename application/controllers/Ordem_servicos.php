<?php

defined('BASEPATH') or exit('Caminho inválido');

class Ordem_servicos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sessão encerrada, favor efetuar o login novamente !!!');
            redirect('login');
        }

        $this->load->model('ordem_servicos_model');

    }

    public function index()
    {
        $data = [
            'titulo' => 'Ordens de serviços cadastradas',
            'styles' => ['vendor/datatables/dataTables.bootstrap4.min.css'],

            'scripts' => ['vendor/mask/jquery.mask.min.js',
                          'vendor/datatables/jquery.dataTables.min.js',
                          'vendor/datatables/dataTables.bootstrap4.min.js',
                          'vendor/datatables/app.js',
                          'vendor/mask/app.js'],

            'ordens_servicos' => $this->ordem_servicos_model->get_all(''),
        ];

        //echo '<pre>';
        //print_r($data['ordens_servicos']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('ordem_servicos/index');
        $this->load->view('layout/footer');
    }

    public function editar($ordem_servico_id = null){

        if(!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', ['ordem_servico_id' => $ordem_servico_id])){
            $this->session->set_flashdata('error', 'Ordem de serviço não localizada !!!');
            redirect('os');

        }else{
            //validação campos
            $this->form_validation->set_rules('ordem_servico_cliente_id','','required');
            $this->form_validation->set_rules('ordem_servico_forma_pagamento_id','','required');
            $this->form_validation->set_rules('ordem_servico_equipamento','equipamento','trim|required|min_length[2]|max_length[80]');

            $this->form_validation->set_rules('ordem_servico_marca_equipamento','marca','trim|required|min_length[2]|max_length[80]');

            $this->form_validation->set_rules('ordem_servico_modelo_equipamento','modelo','trim|required|min_length[3]|max_length[80]');

            $this->form_validation->set_rules('ordem_servico_acessorios','acessórios','trim|required|max_length[300]');

            $this->form_validation->set_rules('ordem_servico_defeito','defeito','trim|required|min_length[2]|max_length[700]');


            if($this->form_validation->run()){

                //echo '<pre>';
                //print_r($this->input->post());
                //exit();

                $ordem_servico_valor_total = str_replace('R$', '', trim($this->input->post('ordem_servico_valor_total')));

                $data = elements([
                    'ordem_servico_forma_pagamento_id',
                    'ordem_servico_cliente_id',                    
                    'ordem_servico_equipamento',
                    'ordem_servico_marca_equipamento',
                    'ordem_servico_modelo_equipamento',
                    'ordem_servico_acessorios',
                    'ordem_servico_defeito',
                    'ordem_servico_valor_desconto',
                    'ordem_servico_valor_total',
                    'ordem_servico_status',
                    'ordem_servico_obs',
                ], $this->input->post());

                $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/','', $ordem_servico_valor_total));

                $data = html_escape($data);

                $this->core_model->update('ordens_servicos', $data, ['ordem_servico_id' => $ordem_servico_id]);

                //deletando de ordem tem serviços os serviços antigos da ordem editada
                $this->ordem_servicos_model->delete_old_services($ordem_servico_id);

                $servico_id = $this->input->post('servico_id');
                $servico_quantidade = $this->input->post('servico_quantidade');
                $servico_desconto = str_replace('%','', $this->input->post('servico_desconto'));
                $servico_preco = str_replace('R$','', $this->input->post('servico_preco'));
                $servico_item_total = str_replace('R$','', $this->input->post('servico_item_total'));

                $qty_servico = count($servico_id);

                $ordem_servico_id = $this->input->post('ordem_servico_id');

                for($i = 0; $i < $qty_servico; $i++){

                    $data = [
                        'ordem_ts_id_ordem_servico' => $ordem_servico_id,
                        'ordem_ts_id_servico' => $servico_id[$i],
                        'ordem_ts_quantidade' => $servico_quantidade[$i],
                        'ordem_ts_valor_unitario' => $servico_preco[$i],
                        'ordem_ts_valor_desconto' => $servico_desconto[$i],
                        'ordem_ts_valor_total' => $servico_item_total[$i],
                    ];

                    $data = html_escape($data);

                    $this->core_model->insert('ordem_tem_servicos', $data);

                }

//                echo '<pre>';
//                print_r($this->input->post());
//                exit();
                // criar recurso pdf
                redirect('os');
               

            }else{

                $data = [
                    'titulo' => 'Atualizar ordem de serviço',
    
                    'styles' => ['vendor/select2/select2.min.css',
                                 'vendor/autocomplete/jquery-ui.css',
                                 'vendor/autocomplete/estilo.css'],
        
                    'scripts' => ['vendor/autocomplete/jquery-migrate.js', // 1°
                                  'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                                  'vendor/calcx/os.js', 
                                  'vendor/select2/select2.min.js',
                                  'vendor/select2/app.js',
                                  'vendor/sweetalert2/sweetalert2.js',
                                  'vendor/autocomplete/jquery-ui.js'], // ultimo na sequencia
        
                   'clientes' => $this->core_model->get_all('clientes', ['cliente_ativo' => 1]),
    
                   'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', ['forma_pagamento_ativa' => 1]),
    
                   'os_tem_servicos' => $this->ordem_servicos_model->get_all_servicos_by_ordem($ordem_servico_id)
                ];
    
                $ordem_servico = $data['ordem_servico'] = $this->ordem_servicos_model->get_by_id($ordem_servico_id);
    
              // echo '<pre>';
              // print_r($data['os_tem_servicos']);
               //exit();

                $this->load->view('layout/header', $data);
                $this->load->view('ordem_servicos/editar');
                $this->load->view('layout/footer');
            }
        }
    }
}
