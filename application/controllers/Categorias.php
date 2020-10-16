<?php

defined('BASEPATH') or exit('Caminho inválido');

class Categorias extends CI_Controller
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
            'titulo' => 'Categorias Cadastrados',
            'styles' => ['vendor/datatables/dataTables.bootstrap4.min.css'],

            'scripts' => ['vendor/mask/jquery.mask.min.js',
                          'vendor/datatables/jquery.dataTables.min.js',
                          'vendor/datatables/dataTables.bootstrap4.min.js',
                          'vendor/datatables/app.js',
                          'vendor/mask/app.js'],

            'categorias' => $this->core_model->get_all('categorias'),
        ];

        //echo '<pre>';
        //print_r($data['categoriaes']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('categorias/index');
        $this->load->view('layout/footer');
    }
    public function editar($categoria_id =null){

        //verificar se foi passado o id para editar
        if(!$categoria_id || !$this->core_model->get_by_id('categorias', ['categoria_id' => $categoria_id])){
            $this->session->set_flashdata('error', 'categoria não localizada !!!');
            redirect('categorias');

        }else{

            $this->form_validation->set_rules('categoria_nome', 'categoria', 'trim|min_length[3]|max_length[45]|required|callback_nome_check');
            

            if ($this->form_validation->run()) {

                $categoria_ativa = $this->input->post('categoria_ativa');

                if($this->db->table_exists('produtos')){

                    if($categoria_ativa == 0 && $this->core_model->get_by_id('produtos', ['produto_categoria_id' => $categoria_id, 'produto_ativo' => 1])){
                        
                        $this->session->set_flashdata('info', 'Solicitação não atendida, existem <i class="fab fa-product-hunt"></i>&nbsp;Produtos associados a essa categoria !!!');
                        redirect('categorias'); 
                    }

                }

                $data = elements(
                    [
                        'categoria_nome',                    
                        'categoria_ativa',
                    ], $this->input->post(),
                );

                $data = html_escape($data);

                $this->core_model->update('categorias', $data, ['categoria_id' => $categoria_id]);
                redirect('categorias');
                
            }else{

                //erro de validação
                $data = [
                    'titulo' => 'Atualizar categoria',
    
                    'scripts' => ['vendor/mask/jquery.mask.min.js',
                                  'vendor/mask/app.js'],
    
                    'categoria' => $this->core_model->get_by_id('categorias', ['categoria_id' => $categoria_id]),
                ];
    
                //echo '<pre>';
                //print_r($data['categoria']);
                //exit();
    
                $this->load->view('layout/header', $data);
                $this->load->view('categorias/editar');
                $this->load->view('layout/footer');

            }

        }

    }

    public function adicionar(){

        $this->form_validation->set_rules('categoria_nome', 'categoria', 'trim|min_length[3]|max_length[45]|required|is_unique[categorias.categoria_nome]');
            

        if ($this->form_validation->run()) {

            $data = elements(
                [
                    'categoria_nome',                    
                    'categoria_ativa',
                ], $this->input->post(),
            );

            $data = html_escape($data);

            $this->core_model->insert('categorias', $data);
            redirect('categorias');
            
        }else{

            //erro de validação
            $data = [
                'titulo' => 'Cadastrar categoria',

                'scripts' => ['vendor/mask/jquery.mask.min.js',
                              'vendor/mask/app.js'],   
            ];

            //echo '<pre>';
            //print_r($data['categoria']);
            //exit();

            $this->load->view('layout/header', $data);
            $this->load->view('categorias/adicionar');
            $this->load->view('layout/footer');

        }

    }

    public function deletar($categoria_id = null)
    {
        if (!$categoria_id || !$this->core_model->get_by_id('categorias', ['categoria_id' => $categoria_id])) {
            $this->session->set_flashdata('error', 'categoria não localizada !!!');
            redirect('categorias');
            
        } else {

            $this->core_model->delete('categorias', ['categoria_id' => $categoria_id]);
            redirect('categorias');
        }  
    }

    public function nome_check($categoria_nome)
    {
        $categoria_id = $this->input->post('categoria_id');

        if ($this->core_model->get_by_id('categorias', ['categoria_nome' => $categoria_nome, 'categoria_id!=' => $categoria_id])) {
            $this->form_validation->set_message('nome_check', 'Essa categoria já existe');

            return false;
        } else {
            return true;
        }
    }
}