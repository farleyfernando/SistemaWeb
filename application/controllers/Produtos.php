<?php

defined('BASEPATH') or exit('Caminho inválido');

class Produtos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sessão encerrada, favor efetuar o login novamente !!!');
            redirect('login');
        }

        $this->load->model('produtos_model');
    }

    public function index()
    {
        $data = [
            'titulo' => 'Produtos Cadastrados',
            'styles' => ['vendor/datatables/dataTables.bootstrap4.min.css'],

            'scripts' => ['vendor/mask/jquery.mask.min.js',
                          'vendor/datatables/jquery.dataTables.min.js',
                          'vendor/datatables/dataTables.bootstrap4.min.js',
                          'vendor/datatables/app.js',
                          'vendor/mask/app.js'],

            'produtos' => $this->produtos_model->get_all(''),
        ];

        //echo '<pre>';
        //print_r($data['produtos']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('produtos/index');
        $this->load->view('layout/footer');
    }

    public function editar($produto_id =null){

        //verificar se foi passado o id para editar
        if(!$produto_id || !$this->core_model->get_by_id('produtos', ['produto_id' => $produto_id])){
            $this->session->set_flashdata('error', 'Produto não localizado !!!');
            redirect('produtos');

        }else{

            $this->form_validation->set_rules('produto_descricao','descrição produto','trim|required|min_length[5]|max_length[145]|callback_descricao_check');

            $this->form_validation->set_rules('produto_unidade','unidade','trim|required|min_length[2]|max_length[10]');

            $this->form_validation->set_rules('produto_preco_custo','preço de custo','trim|required|max_length[45]');

            $this->form_validation->set_rules('produto_preco_venda','preço de venda','trim|required|max_length[45]|callback_venda_check');

            $this->form_validation->set_rules('produto_estoque_minimo','estoque minimo','trim|greater_than_equal_to[0]');

            $this->form_validation->set_rules('produto_qtde_estoque','qtde estoque','trim|required');

            $this->form_validation->set_rules('produto_obs','observação','trim|max_length[200]');


            if($this->form_validation->run()){

                
                $data = elements(
                    [
                        'produto_codigo',
                        'produto_categoria_id',
                        'produto_marca_id', 
                        'produto_fornecedor_id', 
                        'produto_descricao', 
                        'produto_unidade', 
                        'produto_preco_custo', 
                        'produto_preco_venda', 
                        'produto_estoque_minimo',
                        'produto_qtde_estoque',
                        'produto_obs',
                        'produto_ativo',
                    ], $this->input->post(),
                );

                $data = html_escape($data);

                $this->core_model->update('produtos', $data, ['produto_id' => $produto_id]);
                redirect('produtos');

            }else{

             //erro de validação
            $data = [
                'titulo' => 'Atualizar produto',

                'scripts' => ['vendor/mask/jquery.mask.min.js',
                              'vendor/mask/app.js'],


                'produto' => $this->core_model->get_by_id('produtos', ['produto_id' => $produto_id]),

                'marcas' => $this->core_model->get_all('marcas', ['marca_ativa' => 1]),
                'categorias' => $this->core_model->get_all('categorias', ['categoria_ativa' => 1]),
                'fornecedores' => $this->core_model->get_all('fornecedores', ['fornecedor_ativo' => 1]),

            ];


            
            //echo '<pre>';
            //print_r($data['produtos']);
            //exit();

            $this->load->view('layout/header', $data);
            $this->load->view('produtos/editar');
            $this->load->view('layout/footer');

            }


        }

    }

    public function adicionar(){


        $this->form_validation->set_rules('produto_descricao','descrição produto','trim|required|min_length[5]|max_length[145]|is_unique[produtos.produto_descricao]');

        $this->form_validation->set_rules('produto_unidade','unidade','trim|required|min_length[2]|max_length[10]');

        $this->form_validation->set_rules('produto_preco_custo','preço de custo','trim|required|max_length[45]');

        $this->form_validation->set_rules('produto_preco_venda','preço de venda','trim|required|max_length[45]|callback_venda_check');

        $this->form_validation->set_rules('produto_estoque_minimo','estoque minimo','trim|greater_than_equal_to[0]');

        $this->form_validation->set_rules('produto_qtde_estoque','qtde estoque','trim|required');

        $this->form_validation->set_rules('produto_obs','observação','trim|max_length[200]');


        if($this->form_validation->run()){

            
            $data = elements(
                [
                    'produto_codigo',
                    'produto_categoria_id',
                    'produto_marca_id', 
                    'produto_fornecedor_id', 
                    'produto_descricao', 
                    'produto_unidade', 
                    'produto_preco_custo', 
                    'produto_preco_venda', 
                    'produto_estoque_minimo',
                    'produto_qtde_estoque',
                    'produto_obs',
                    'produto_ativo',
                ], $this->input->post(),
            );

            $data = html_escape($data);

            $this->core_model->insert('produtos', $data);
            redirect('produtos');

        }else{

         //erro de validação
        $data = [
            'titulo' => 'Cadastrar produto',

            'scripts' => ['vendor/mask/jquery.mask.min.js',
                          'vendor/mask/app.js'],

            'produto_codigo' => $this->core_model->generate_unique_code('produtos','numeric',8,'produto_codigo'),   
        
            'marcas' => $this->core_model->get_all('marcas', ['marca_ativa' => 1]),
            'categorias' => $this->core_model->get_all('categorias', ['categoria_ativa' => 1]),
            'fornecedores' => $this->core_model->get_all('fornecedores', ['fornecedor_ativo' => 1]),

        ];


        
        //echo '<pre>';
        //print_r($data['produtos']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('produtos/adicionar');
        $this->load->view('layout/footer');

        }
    }

    public function deletar($produto_id = null)
    {

        if (!$produto_id || !$this->core_model->get_by_id('produtos', ['produto_id' => $produto_id])) {

            $this->session->set_flashdata('error', 'Produto não localizado !!!');
            redirect('produtos');                    
                     
        }elseif($this->core_model->get_by_id('produtos', ['produto_id' => $produto_id, 'produto_ativo'=> 1])){

            $this->session->set_flashdata('info', 'Solicitção não atendida, produto está ativo !!!');
            redirect('produtos');    
        }else{
            
            $this->core_model->delete('produtos', ['produto_id' => $produto_id]);
            redirect('produtos');
        }  
    }

    public function descricao_check($produto_descricao)
    {
        $produto_id = $this->input->post('produto_id');

        if ($this->core_model->get_by_id('produtos', ['produto_descricao' => $produto_descricao, 'produto_id!=' => $produto_id])) {
            $this->form_validation->set_message('descricao_check', 'Esse produto já existe');

            return false;
        } else {
            return true;
        }
    }

    public function venda_check($produto_preco_venda)
    {
        // verificar professor teste de valor tipo 17
        $produto_preco_custo = $this->input->post('produto_preco_custo');

        $produto_preco_custo = str_replace('.', '', $produto_preco_custo);
        $produto_preco_venda = str_replace('.', '', $produto_preco_venda);

        $produto_preco_custo = str_replace(',', '', $produto_preco_custo);
        $produto_preco_venda = str_replace(',', '', $produto_preco_venda);


        if ($produto_preco_custo > $produto_preco_venda) {
            $this->form_validation->set_message('venda_check', 'Preço de venda tem que ser igual ou maior que o preço de custo');

            return false;
        } else {
            return true;
        }
    }
}
