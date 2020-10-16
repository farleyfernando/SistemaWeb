<?php

defined('BASEPATH') or exit('Caminho inválido');

class Marcas extends CI_Controller
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
            'titulo' => 'Marcas Cadastrados',
            'styles' => ['vendor/datatables/dataTables.bootstrap4.min.css'],

            'scripts' => ['vendor/mask/jquery.mask.min.js',
                          'vendor/datatables/jquery.dataTables.min.js',
                          'vendor/datatables/dataTables.bootstrap4.min.js',
                          'vendor/datatables/app.js',
                          'vendor/mask/app.js'],

            'marcas' => $this->core_model->get_all('marcas'),
        ];

        //echo '<pre>';
        //print_r($data['marcaes']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('marcas/index');
        $this->load->view('layout/footer');
    }
    public function editar($marca_id =null){

        //verificar se foi passado o id para editar
        if(!$marca_id || !$this->core_model->get_by_id('marcas', ['marca_id' => $marca_id])){
            $this->session->set_flashdata('error', 'Marca não localizada !!!');
            redirect('marcas');

        }else{

            $this->form_validation->set_rules('marca_nome', 'marca', 'trim|min_length[3]|max_length[45]|required|callback_nome_check');
            

            if ($this->form_validation->run()) {

                $marca_ativa = $this->input->post('marca_ativa');

                if($this->db->table_exists('produtos')){

                    if($marca_ativa == 0 && $this->core_model->get_by_id('produtos', ['produto_marca_id' => $marca_id, 'produto_ativo' => 1])){
                        
                        $this->session->set_flashdata('info', 'Solicitação não atendida, existem <i class="fab fa-product-hunt"></i>&nbsp;Produtos associados a essa marca !!!');
                        redirect('marcas'); 
                    }

                }

                $data = elements(
                    [
                        'marca_nome',                    
                        'marca_ativa',
                    ], $this->input->post(),
                );

                $data = html_escape($data);

                $this->core_model->update('marcas', $data, ['marca_id' => $marca_id]);
                redirect('marcas');
                
            }else{

                //erro de validação
                $data = [
                    'titulo' => 'Atualizar marca',
    
                    'scripts' => ['vendor/mask/jquery.mask.min.js',
                                  'vendor/mask/app.js'],
    
                    'marca' => $this->core_model->get_by_id('marcas', ['marca_id' => $marca_id]),
                ];
    
                //echo '<pre>';
                //print_r($data['marca']);
                //exit();
    
                $this->load->view('layout/header', $data);
                $this->load->view('marcas/editar');
                $this->load->view('layout/footer');

            }

        }

    }

    public function adicionar(){

        $this->form_validation->set_rules('marca_nome', 'marca', 'trim|min_length[2]|max_length[45]|required|is_unique[marcas.marca_nome]');
            

        if ($this->form_validation->run()) {

            $data = elements(
                [
                    'marca_nome',                    
                    'marca_ativa',
                ], $this->input->post(),
            );

            $data = html_escape($data);

            $this->core_model->insert('marcas', $data);
            redirect('marcas');
            
        }else{

            //erro de validação
            $data = [
                'titulo' => 'Cadastrar marca',

                'scripts' => ['vendor/mask/jquery.mask.min.js',
                              'vendor/mask/app.js'],   
            ];

            //echo '<pre>';
            //print_r($data['marca']);
            //exit();

            $this->load->view('layout/header', $data);
            $this->load->view('marcas/adicionar');
            $this->load->view('layout/footer');

        }

    }

    public function deletar($marca_id = null)
    {
        if (!$marca_id || !$this->core_model->get_by_id('marcas', ['marca_id' => $marca_id])) {
            $this->session->set_flashdata('error', 'Marca não localizada !!!');
            redirect('marcas');
            
        } else {

            $this->core_model->delete('marcas', ['marca_id' => $marca_id]);
            redirect('marcas');
        }  
    }

    public function nome_check($marca_nome)
    {
        $marca_id = $this->input->post('marca_id');

        if ($this->core_model->get_by_id('marcas', ['marca_nome' => $marca_nome, 'marca_id!=' => $marca_id])) {
            $this->form_validation->set_message('nome_check', 'Essa marca já existe');

            return false;
        } else {
            return true;
        }
    }
}