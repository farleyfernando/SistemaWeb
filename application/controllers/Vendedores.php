<?php

defined('BASEPATH') or exit('Caminho inválido');

class Vendedores extends CI_Controller
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
            'titulo' => 'Vendedores Cadastrados',
            'styles' => ['vendor/datatables/dataTables.bootstrap4.min.css'],

            'scripts' => ['vendor/mask/jquery.mask.min.js',
                          'vendor/datatables/jquery.dataTables.min.js',
                          'vendor/datatables/dataTables.bootstrap4.min.js',
                          'vendor/datatables/app.js',
                          'vendor/mask/app.js'],

            'vendedores' => $this->core_model->get_all('vendedores'),
        ];

        //echo '<pre>';
        //print_r($data['vendedores']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('vendedores/index');
        $this->load->view('layout/footer');
    }

    public function adicionar(){


        $this->form_validation->set_rules('vendedor_nome_completo', '', 'trim|required|min_length[5]|max_length[145]');

        $this->form_validation->set_rules('vendedor_cpf', '','trim|required|exact_length[14]|is_unique[vendedores.vendedor_cpf]|callback_valida_cpf');
      
        $this->form_validation->set_rules('vendedor_rg', 'rg', 'trim|required|exact_length[12]|is_unique[vendedores.vendedor_rg]');

        $this->form_validation->set_rules('vendedor_dn', '', 'required');

        $this->form_validation->set_rules('vendedor_email', '', 'trim|required|valid_email|max_length[50]|is_unique[vendedores.vendedor_email]');

        $this->form_validation->set_rules('vendedor_telefone', '', 'trim|max_length[14]');

        $this->form_validation->set_rules('vendedor_celular', '', 'trim|max_length[15]|required');

        $this->form_validation->set_rules('vendedor_cep', '', 'trim|required|exact_length[9]|required');

        $this->form_validation->set_rules('vendedor_endereco', '', 'trim|required|max_length[155]|required');

        $this->form_validation->set_rules('vendedor_numero_endereco', '', 'trim|required|max_length[20]|required');

        $this->form_validation->set_rules('vendedor_bairro', '', 'trim|required|max_length[45]|required');

        $this->form_validation->set_rules('vendedor_complemento', '', 'trim|max_length[145]');

        $this->form_validation->set_rules('vendedor_cidade', '', 'trim|max_length[50]|required');
        $this->form_validation->set_rules('vendedor_estado', '', 'trim|exact_length[2]|required');
        $this->form_validation->set_rules('vendedor_obs', '', 'max_length[500]');

        if ($this->form_validation->run()) {

            $data = elements(
                [
                    'vendedor_nome_completo',
                    'vendedor_cpf',
                    'vendedor_rg',
                    'vendedor_dn',
                    'vendedor_email',
                    'vendedor_telefone',
                    'vendedor_celular',
                    'vendedor_cep',
                    'vendedor_endereco',
                    'vendedor_numero_endereco',
                    'vendedor_bairro',
                    'vendedor_complemento',
                    'vendedor_cidade',
                    'vendedor_ativo',
                    'vendedor_codigo',
                    'vendedor_obs',
                    
                ], $this->input->post(),
            );

            $data ['vendedor_estado'] = strtoupper($this->input->post('vendedor_estado'));

            $data = html_escape($data);

            $this->core_model->insert('vendedores', $data);
            redirect('vendedores');
            
        }else{

            //erro de validação
            $data = [
                'titulo' => 'Cadastrar Vendedor',

                'scripts' => ['vendor/mask/jquery.mask.min.js',
                              'vendor/mask/app.js'],

                'vendedor_codigo' => $this->core_model->generate_unique_code('vendedores','numeric',8,'vendedor_codigo'),              
            ];


            //echo '<pre>';
            //print_r($data['vendedor']);
            //exit();

            $this->load->view('layout/header', $data);
            $this->load->view('vendedores/adicionar');
            $this->load->view('layout/footer');

        }
        

    }

    public function editar($vendedor_id =null){

        //verificar se foi passado o id para editar
        if(!$vendedor_id || !$this->core_model->get_by_id('vendedores', ['vendedor_id' => $vendedor_id])){
            $this->session->set_flashdata('error', 'vendedor não localizado !!!');
            redirect('vendedores');

        }else{

        
            $this->form_validation->set_rules('vendedor_nome_completo', '', 'trim|required|min_length[5]|max_length[145]');

            $this->form_validation->set_rules('vendedor_cpf', '','trim|required|exact_length[14]|callback_valida_cpf');
          
            $this->form_validation->set_rules('vendedor_rg', 'rg', 'trim|required|exact_length[12]|callback_rg_check');

            $this->form_validation->set_rules('vendedor_dn', '', 'required');

            $this->form_validation->set_rules('vendedor_email', '', 'trim|required|valid_email|max_length[50]|callback_email_check');

            $this->form_validation->set_rules('vendedor_telefone', '', 'trim|max_length[14]');

            $this->form_validation->set_rules('vendedor_celular', '', 'trim|max_length[15]|required');

            $this->form_validation->set_rules('vendedor_cep', '', 'trim|required|exact_length[9]|required');

            $this->form_validation->set_rules('vendedor_endereco', '', 'trim|required|max_length[155]');

            $this->form_validation->set_rules('vendedor_numero_endereco', '', 'trim|required|max_length[20]');

            $this->form_validation->set_rules('vendedor_bairro', '', 'trim|required|max_length[45]');

            $this->form_validation->set_rules('vendedor_complemento', '', 'trim|max_length[145]');

            $this->form_validation->set_rules('vendedor_cidade', '', 'trim|max_length[50]|required');
            $this->form_validation->set_rules('vendedor_estado', '', 'trim|exact_length[2]|required');
            $this->form_validation->set_rules('vendedor_obs', '', 'max_length[500]');

            if ($this->form_validation->run()) {

                $data = elements(
                    [
                        'vendedor_nome_completo',
                        'vendedor_cpf',
                        'vendedor_rg',
                        'vendedor_dn',
                        'vendedor_email',
                        'vendedor_telefone',
                        'vendedor_celular',
                        'vendedor_cep',
                        'vendedor_endereco',
                        'vendedor_numero_endereco',
                        'vendedor_bairro',
                        'vendedor_complemento',
                        'vendedor_cidade',
                        'vendedor_ativo',
                        'vendedor_obs',
                    ], $this->input->post(),
                );

                $data ['vendedor_estado'] = strtoupper($this->input->post('vendedor_estado'));

                $data = html_escape($data);

                $this->core_model->update('vendedores', $data, ['vendedor_id' => $vendedor_id]);
                redirect('vendedores');
                
            }else{

                //erro de validação
                $data = [
                    'titulo' => 'Atualizar dados vendedor',
    
                    'scripts' => ['vendor/mask/jquery.mask.min.js',
                                  'vendor/mask/app.js'],
    
                    'vendedor' => $this->core_model->get_by_id('vendedores', ['vendedor_id' => $vendedor_id]),
                ];
    
                //echo '<pre>';
                //print_r($data['vendedor']);
                //exit();
    
                $this->load->view('layout/header', $data);
                $this->load->view('vendedores/editar');
                $this->load->view('layout/footer');

            }

        }

    }

    public function deletar($vendedor_id = null)
    {
        if (!$vendedor_id || !$this->core_model->get_by_id('vendedores', ['vendedor_id' => $vendedor_id])) {
            $this->session->set_flashdata('error', 'Vendedor não localizado');
            redirect('vendedores');
            
        } else {

            $this->core_model->delete('vendedores', ['vendedor_id' => $vendedor_id]);
            redirect('vendedores');
        }  
    }

    public function valida_cpf($cpf) {

        if ($this->input->post('vendedor_id')) {

            $vendedor_id = $this->input->post('vendedor_id');

            if ($this->core_model->get_by_id('vendedores', array('vendedor_id !=' => $vendedor_id, 'vendedor_cpf' => $cpf))) {
                $this->form_validation->set_message('valida_cpf', 'Este cpf já existe');
                return FALSE;
            }
        }

        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {

            $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
            return FALSE;
        } else {
            // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    //$d += $cpf{$c} * (($t + 1) - $c); // Para PHP com versão < 7.4
                    $d += $cpf[$c] * (($t + 1) - $c); //Para PHP com versão < 7.4
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');
                    return FALSE;
                }
            }
            return TRUE;
        }
    }

    public function email_check($vendedor_email)
    {
        $vendedor_id = $this->input->post('vendedor_id');

        if ($this->core_model->get_by_id('vendedores', ['vendedor_email' => $vendedor_email, 'vendedor_id!=' => $vendedor_id])) {
            $this->form_validation->set_message('email_check', 'Esse e-mail já existe');

            return false;
        } else {
            return true;
        }
    }

    public function rg_check($vendedor_rg)
    {
        $vendedor_id = $this->input->post('vendedor_id');

        if ($this->core_model->get_by_id('vendedores', ['vendedor_rg' => $vendedor_rg, 'vendedor_id!=' => $vendedor_id])) {
            $this->form_validation->set_message('rg_check', 'Esse rg já existe');

            return false;
        } else {
            return true;
        }
    }
}