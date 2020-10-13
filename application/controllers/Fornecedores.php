<?php

defined('BASEPATH') or exit('Caminho inválido');

class Fornecedores extends CI_Controller
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
            'titulo' => 'Forcedores Cadastrados',
            'styles' => ['vendor/datatables/dataTables.bootstrap4.min.css'],

            'scripts' => ['vendor/mask/jquery.mask.min.js',
                          'vendor/datatables/jquery.dataTables.min.js',
                          'vendor/datatables/dataTables.bootstrap4.min.js',
                          'vendor/datatables/app.js',
                          'vendor/mask/app.js'],

            'fornecedores' => $this->core_model->get_all('fornecedores'),
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('fornecedores/index');
        $this->load->view('layout/footer');
    }

    public function editar($fornecedor_id =null){

        //verificar se foi passado o id para editar
        if(!$fornecedor_id || !$this->core_model->get_by_id('fornecedores', ['fornecedor_id' => $fornecedor_id])){
            $this->session->set_flashdata('error', 'Fornecedor não localizado !!!');
            redirect('fornecedores');

        }else{

            $this->form_validation->set_rules('fornecedor_razao', '', 'trim|required|min_length[5]|max_length[100]|callback_razao_check');

            $this->form_validation->set_rules('fornecedor_nome_fantasia', '', 'trim|required|min_length[5]|max_length[145]');

            $this->form_validation->set_rules('fornecedor_cnpj', '','trim|required|exact_length[18]|callback_valida_cnpj');
          
            $this->form_validation->set_rules('fornecedor_ie', '', 'trim|required|max_length[20]|callback_ie_check');

            $this->form_validation->set_rules('fornecedor_email', '', 'trim|required|valid_email|max_length[50]|callback_email_check');

            $this->form_validation->set_rules('fornecedor_telefone', '', 'trim|max_length[14]|required');

            $this->form_validation->set_rules('fornecedor_celular', '', 'trim|max_length[15]|required');

            $this->form_validation->set_rules('fornecedor_cep', '', 'trim|required|exact_length[9]');

            $this->form_validation->set_rules('fornecedor_endereco', '', 'trim|required|max_length[155]');

            $this->form_validation->set_rules('fornecedor_numero_endereco', '', 'trim|required|max_length[20]');

            $this->form_validation->set_rules('fornecedor_bairro', '', 'trim|required|max_length[45]');

            $this->form_validation->set_rules('fornecedor_complemento', '', 'trim|max_length[145]');

            $this->form_validation->set_rules('fornecedor_cidade', '', 'trim|max_length[50]');
            $this->form_validation->set_rules('fornecedor_estado', '', 'trim|exact_length[2]');
            $this->form_validation->set_rules('fornecedor_obs', '', 'max_length[500]');

            if ($this->form_validation->run()) {

                $data = elements(
                    [
                        'fornecedor_razao',
                        'fornecedor_nome_fantasia',
                        'fornecedor_cnpj',
                        'fornecedor_ie',
                        'fornecedor_email',
                        'fornecedor_telefone',
                        'fornecedor_celular',
                        'fornecedor_cep',
                        'fornecedor_endereco',
                        'fornecedor_numero_endereco',
                        'fornecedor_bairro',
                        'fornecedor_complemento',
                        'fornecedor_cidade',
                        'fornecedor_ativo',
                        'fornecedor_obs',
                    ], $this->input->post(),
                );

                $data ['fornecedor_estado'] = strtoupper($this->input->post('fornecedor_estado'));

                $data = html_escape($data);

                $this->core_model->update('fornecedores', $data, ['fornecedor_id' => $fornecedor_id]);
                redirect('fornecedores');
                
            }else{

                //erro de validação
                $data = [
                    'titulo' => 'Atualizar dados Fornecedor',
    
                    'scripts' => ['vendor/mask/jquery.mask.min.js',
                                  'vendor/mask/app.js'],
    
                    'fornecedor' => $this->core_model->get_by_id('fornecedores', ['fornecedor_id' => $fornecedor_id]),
                ];
    
                //echo '<pre>';
                //print_r($data['fornecedor']);
                //exit();
    
                $this->load->view('layout/header', $data);
                $this->load->view('fornecedores/editar');
                $this->load->view('layout/footer');

            }

        }

    }

    public function adicionar(){

            $this->form_validation->set_rules('fornecedor_razao', '', 'trim|required|min_length[5]|max_length[100]|is_unique[fornecedores.fornecedor_razao]|callback_razao_check');

            $this->form_validation->set_rules('fornecedor_nome_fantasia', '', 'trim|required|min_length[5]|max_length[145]');

            $this->form_validation->set_rules('fornecedor_cnpj', '','trim|required|exact_length[18]|is_unique[fornecedores.fornecedor_cnpj]|callback_valida_cnpj');
          
            $this->form_validation->set_rules('fornecedor_ie', '', 'trim|required|max_length[20]|is_unique[fornecedores.fornecedor_ie]|callback_ie_check');

            $this->form_validation->set_rules('fornecedor_email', '', 'trim|required|valid_email|max_length[50]|is_unique[fornecedores.fornecedor_email]|callback_email_check');

            $this->form_validation->set_rules('fornecedor_telefone', '', 'trim|max_length[14]|required');

            $this->form_validation->set_rules('fornecedor_celular', '', 'trim|max_length[15]|required');

            $this->form_validation->set_rules('fornecedor_cep', '', 'trim|required|exact_length[9]');

            $this->form_validation->set_rules('fornecedor_endereco', '', 'trim|required|max_length[155]');

            $this->form_validation->set_rules('fornecedor_numero_endereco', '', 'trim|required|max_length[20]');

            $this->form_validation->set_rules('fornecedor_bairro', '', 'trim|required|max_length[45]');

            $this->form_validation->set_rules('fornecedor_complemento', '', 'trim|max_length[145]');

            $this->form_validation->set_rules('fornecedor_cidade', '', 'trim|max_length[50]|required');
            $this->form_validation->set_rules('fornecedor_estado', '', 'trim|exact_length[2]|required');
            $this->form_validation->set_rules('fornecedor_obs', '', 'max_length[500]');

            if ($this->form_validation->run()) {

                $data = elements(
                    [
                        'fornecedor_razao',
                        'fornecedor_nome_fantasia',
                        'fornecedor_cnpj',
                        'fornecedor_ie',
                        'fornecedor_email',
                        'fornecedor_telefone',
                        'fornecedor_celular',
                        'fornecedor_cep',
                        'fornecedor_endereco',
                        'fornecedor_numero_endereco',
                        'fornecedor_bairro',
                        'fornecedor_complemento',
                        'fornecedor_cidade',
                        'fornecedor_ativo',
                        'fornecedor_obs',
                    ], $this->input->post(),
                );

                $data ['fornecedor_estado'] = strtoupper($this->input->post('fornecedor_estado'));

                $data = html_escape($data);

                $this->core_model->insert('fornecedores', $data);
                redirect('fornecedores');
                
            }else{

                //erro de validação
                $data = [
                    'titulo' => 'Cadastro Fornecedor',
    
                    'scripts' => ['vendor/mask/jquery.mask.min.js',
                                  'vendor/mask/app.js'],
                ];
    
                $this->load->view('layout/header', $data);
                $this->load->view('fornecedores/adicionar');
                $this->load->view('layout/footer');

            }
    }

    public function deletar($fornecedor_id = null)
    {
        if (!$fornecedor_id || !$this->core_model->get_by_id('fornecedores', ['fornecedor_id' => $fornecedor_id])) {
            $this->session->set_flashdata('error', 'Cliente não localizado');
            redirect('fornecedores');
            
        } else {

            $this->core_model->delete('fornecedores', ['fornecedor_id' => $fornecedor_id]);
            redirect('fornecedores');
        }  
    }

    
    public function valida_cnpj($cnpj) 
    {

        // Verifica se um número foi informado
        if (empty($cnpj)) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

        if ($this->input->post('fornecedor_id')) {

            $fornecedor_id = $this->input->post('fornecedor_id');

            if ($this->core_model->get_by_id('fornecedores', array('fornecedor_id !=' => $fornecedor_id, 'fornecedor_cnpj' => $cnpj))) {
                $this->form_validation->set_message('valida_cnpj', 'Esse cnpj já existe');
                return FALSE;
            }
        }

        // Elimina possivel mascara
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);
        $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);


        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cnpj) != 14) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;
        }

        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cnpj == '00000000000000' ||
                $cnpj == '11111111111111' ||
                $cnpj == '22222222222222' ||
                $cnpj == '33333333333333' ||
                $cnpj == '44444444444444' ||
                $cnpj == '55555555555555' ||
                $cnpj == '66666666666666' ||
                $cnpj == '77777777777777' ||
                $cnpj == '88888888888888' ||
                $cnpj == '99999999999999') {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
            return false;

            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {

            $j = 5;
            $k = 6;
            $soma1 = "";
            $soma2 = "";

            for ($i = 0; $i < 13; $i++) {

                $j = $j == 1 ? 9 : $j;
                $k = $k == 1 ? 9 : $k;

                //$soma2 += ($cnpj{$i} * $k);

                //$soma2 = intval($soma2) + ($cnpj{$i} * $k); //Para PHP com versão < 7.4
                $soma2 = intval($soma2) + ($cnpj[$i] * $k); //Para PHP com versão > 7.4

                if ($i < 12) {
                    //$soma1 = intval($soma1) + ($cnpj{$i} * $j); //Para PHP com versão < 7.4
                    $soma1 = intval($soma1) + ($cnpj[$i] * $j); //Para PHP com versão > 7.4
                }

                $k--;
                $j--;
            }

            $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
            $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

            if (!($cnpj[12] == $digito1) and ( $cnpj[13] == $digito2)) {
                $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');
                return false;
            } else {
                return true;
            }
        }

    }

    public function email_check($fornecedor_email)
    {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', ['fornecedor_email' => $fornecedor_email, 'fornecedor_id!=' => $fornecedor_id])) {
            $this->form_validation->set_message('email_check', 'Esse e-mail já existe');

            return false;
        } else {
            return true;
        }
    }

    public function ie_check($fornecedor_ie)
    {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', ['fornecedor_ie' => $fornecedor_ie, 'fornecedor_id!=' => $fornecedor_id])) {
            $this->form_validation->set_message('ie_check', 'Essa inscrição estadual já existe');

            return false;
        } else {
            return true;
        }
    }

    public function razao_check($fornecedor_razao)
    {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', ['fornecedor_razao' => $fornecedor_razao, 'fornecedor_id!=' => $fornecedor_id])) {
            $this->form_validation->set_message('razao_check', 'Essa razão social já existe');

            return false;
        } else {
            return true;
        }
    }

}