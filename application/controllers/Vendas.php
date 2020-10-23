<?php

defined('BASEPATH') or exit('Caminho inválido');

class Vendas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sessão encerrada, favor efetuar o login novamente !!!');
            redirect('login');
        }

        $this->load->model('vendas_model');
        $this->load->model('produtos_model');

    }

    public function index()
    {
        $data = [
            'titulo' => 'Vendas efetuadas',
            'styles' => ['vendor/datatables/dataTables.bootstrap4.min.css'],

            'scripts' => ['vendor/mask/jquery.mask.min.js',
                          'vendor/datatables/jquery.dataTables.min.js',
                          'vendor/datatables/dataTables.bootstrap4.min.js',
                          'vendor/datatables/app.js',
                          'vendor/mask/app.js'],

            'vendas' => $this->vendas_model->get_all(''),
        ];

        //echo '<pre>';
        //print_r($data['ordens_servicos']);
        //exit();

        $this->load->view('layout/header', $data);
        $this->load->view('vendas/index');
        $this->load->view('layout/footer');
    }

    public function adicionar(){

                    //atualização de estoque
           // $venda_produtos = $this->vendas_model->get_all_produtos_by_venda($venda_id);


            //validação campos
            $this->form_validation->set_rules('venda_cliente_id','','required');
            $this->form_validation->set_rules('venda_tipo','','required');
            $this->form_validation->set_rules('venda_forma_pagamento_id','','required');
            $this->form_validation->set_rules('venda_vendedor_id','','required');


            if($this->form_validation->run()){

                //echo '<pre>';
                //print_r($this->input->post());
                //exit();

                if(!$this->input->post('produto_id')){
 
                    $this->session->set_flashdata('info', 'Favor adicionar ao menos um produto !!!');
                    redirect('vendas/adicionar');
     
                }

                $venda_valor_total = str_replace('R$', '', trim($this->input->post('venda_valor_total')));

                $data = elements([
                    'venda_forma_pagamento_id',
                    'venda_cliente_id',                    
                    'venda_tipo',
                    'venda_vendedor_id',
                    'venda_valor_desconto',
                    'venda_valor_total',

                ], $this->input->post());


                $data['venda_valor_total'] = trim(preg_replace('/\$/','', $venda_valor_total));

                $data = html_escape($data);

                $this->core_model->insert('vendas', $data, TRUE);

                 //recuperar ID
                 $id_venda = $this->session->userdata('last_id');

              

                $produto_id = $this->input->post('produto_id');
                $produto_quantidade = $this->input->post('produto_quantidade');
                $produto_desconto = str_replace('%','', $this->input->post('produto_desconto'));
                $produto_preco_venda = str_replace('R$','', $this->input->post('produto_preco_venda'));
                $produto_item_total = str_replace('R$','', $this->input->post('produto_item_total'));

                $produto_preco = str_replace(',','', $produto_preco_venda);
                $produto_item_total = str_replace(',','', $produto_item_total);

                $qty_produto = count($produto_id);


                

                for($i = 0; $i < $qty_produto; $i++){

                    $data = [
                        'venda_produto_id_venda' => $id_venda,
                        'venda_produto_id_produto' => $produto_id[$i],
                        'venda_produto_quantidade' => $produto_quantidade[$i],
                        'venda_produto_valor_unitario' => $produto_preco_venda[$i],
                        'venda_produto_desconto' => $produto_desconto[$i],
                        'venda_produto_valor_total' => $produto_item_total[$i],
                    ];

                    $data = html_escape($data);

                    
                    $this->core_model->insert('venda_produtos', $data);

                    // Inicio atualização estoque
                    
                    $produto_qtde_estoque = 0;
                    $produto_qtde_estoque += intval($produto_quantidade[$i]);

                    $produtos = [
                        'produto_qtde_estoque' => $produto_qtde_estoque,
                    ];

                    $this->produtos_model->update($produto_id[$i], $produto_qtde_estoque);                    

                     //fim atualização estoque
                    
                } // fim for foreach principal

                    redirect('vendas/imprimir/'. $id_venda);
                
               
            }else{

                $data = [
                    'titulo' => 'Inserir venda',
    
                    'styles' => ['vendor/select2/select2.min.css',
                                 'vendor/autocomplete/jquery-ui.css',
                                 'vendor/autocomplete/estilo.css'],
        
                    'scripts' => ['vendor/autocomplete/jquery-migrate.js', // 1°
                                  'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                                  'vendor/calcx/venda.js', 
                                  'vendor/select2/select2.min.js',
                                  'vendor/select2/app.js',
                                  'vendor/sweetalert2/sweetalert2.js',
                                  'vendor/autocomplete/jquery-ui.js'], // ultimo na sequencia
        
                   'clientes' => $this->core_model->get_all('clientes', ['cliente_ativo' => 1]),
    
                   'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', ['forma_pagamento_ativa' => 1]),
                   'vendedores' => $this->core_model->get_all('vendedores', ['vendedor_ativo' => 1]),

                ];
    
                
    
               //echo '<pre>';
              // print_r($data['venda_produtos']);
               //exit();

                $this->load->view('layout/header', $data);
                $this->load->view('vendas/adicionar');
                $this->load->view('layout/footer');
            }


    }

    public function editar($venda_id = null){

        if(!$venda_id || !$this->core_model->get_by_id('vendas', ['venda_id' => $venda_id])){
            $this->session->set_flashdata('error', 'Venda não localizada !!!');
            redirect('vendas');

        }else{

            //atualização de estoque
           // $venda_produtos = $this->vendas_model->get_all_produtos_by_venda($venda_id);


            //validação campos
            $this->form_validation->set_rules('venda_cliente_id','','required');
            $this->form_validation->set_rules('venda_tipo','','required');
            $this->form_validation->set_rules('venda_forma_pagamento_id','','required');
            $this->form_validation->set_rules('venda_vendedor_id','','required');


            if($this->form_validation->run()){

                //echo '<pre>';
                //print_r($this->input->post());
                //exit();

                $venda_valor_total = str_replace('R$', '', trim($this->input->post('venda_valor_total')));

                $data = elements([
                    'venda_forma_pagamento_id',
                    'venda_cliente_id',                    
                    'venda_tipo',
                    'venda_vendedor_id',
                    'venda_valor_desconto',
                    'venda_valor_total',

                ], $this->input->post());


                $data['venda_valor_total'] = trim(preg_replace('/\$/','', $venda_valor_total));

                $data = html_escape($data);

                $this->core_model->update('vendas', $data, ['venda_id' => $venda_id]);

                //deletando da tabela venda os produtos as editados
                $this->vendas_model->delete_old_products($venda_id);

                $produto_id = $this->input->post('produto_id');
                $produto_quantidade = $this->input->post('produto_quantidade');
                $produto_desconto = str_replace('%','', $this->input->post('produto_desconto'));
                $produto_preco_venda = str_replace('R$','', $this->input->post('produto_preco_venda'));
                $produto_item_total = str_replace('R$','', $this->input->post('produto_item_total'));

                $produto_preco = str_replace(',','', $produto_preco_venda);
                $produto_item_total = str_replace(',','', $produto_item_total);

                $qty_produto = count($produto_id);


                

                for($i = 0; $i < $qty_produto; $i++){

                    $data = [
                        'venda_produto_id_venda' => $venda_id,
                        'venda_produto_id_produto' => $produto_id[$i],
                        'venda_produto_quantidade' => $produto_quantidade[$i],
                        'venda_produto_valor_unitario' => $produto_preco_venda[$i],
                        'venda_produto_desconto' => $produto_desconto[$i],
                        'venda_produto_valor_total' => $produto_item_total[$i],
                    ];

                    $data = html_escape($data);

                    $this->core_model->insert('venda_produtos', $data);

                    /*/ Inicio atualização estoque
                    foreach($venda_produtos as $venda_p){

                        if($venda_p->venda_produto_quantidade < $produto_quantidade[$i]){
                           
                            $produto_qtde_estoque = 0;
                            $produto_qtde_estoque += intval($produto_quantidade[$i]);

                            $diferenca = ($produto_qtde_estoque - $venda_p->venda_produto_quantidade);

                            $this->produtos_model->update($produto_id[$i], $diferenca);

                        }

                    } fim atualização estoque  */
                    
                } // fim for foreach principal

               // redirect('vendas/imprimir/'. $venda_id);
                redirect('vendas');
               
            }else{

                $data = [
                    'titulo' => 'Visualizar venda',
    
                    'styles' => ['vendor/select2/select2.min.css',
                                 'vendor/autocomplete/jquery-ui.css',
                                 'vendor/autocomplete/estilo.css'],
        
                    'scripts' => ['vendor/autocomplete/jquery-migrate.js', // 1°
                                  'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                                  'vendor/calcx/venda.js', 
                                  'vendor/select2/select2.min.js',
                                  'vendor/select2/app.js',
                                  'vendor/sweetalert2/sweetalert2.js',
                                  'vendor/autocomplete/jquery-ui.js'], // ultimo na sequencia
        
                   'clientes' => $this->core_model->get_all('clientes', ['cliente_ativo' => 1]),
    
                   'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', ['forma_pagamento_ativa' => 1]),
                   'vendedores' => $this->core_model->get_all('vendedores', ['vendedor_ativo' => 1]),

                   'venda_produtos' => $this->vendas_model->get_all_produtos_by_venda($venda_id),
                   'desabilitar' => TRUE, //Desabilita botão de submit
                   'venda' => $this->vendas_model->get_by_id($venda_id),
    
                ];
    
                
    
               //echo '<pre>';
              // print_r($data['venda_produtos']);
               //exit();

                $this->load->view('layout/header', $data);
                $this->load->view('vendas/editar');
                $this->load->view('layout/footer');
            }
        }
    }

    public function deletar($venda_id = null){

        if(!$venda_id || !$this->core_model->get_by_id('vendas', ['venda_id' => $venda_id])){
            $this->session->set_flashdata('error', 'Venda não localizada !!!');
            redirect('vendas');

        }else{

            $this->core_model->delete('vendas', ['venda_id' => $venda_id]);
            redirect('vendas');

        }

    }

    public function imprimir($venda_id = null){

        if(!$venda_id || !$this->core_model->get_by_id('vendas', ['venda_id' => $venda_id])){
            $this->session->set_flashdata('error', 'Ordem de serviço não localizada !!!');
            redirect('vendas');

        }else{

            $data = [
                'titulo' => 'Escolha uma opção',
                'venda' => $this->core_model->get_by_id('vendas', ['venda_id' => $venda_id]),

                //enviar dados da ordem
            ];

            $this->load->view('layout/header', $data);
            $this->load->view('vendas/imprimir');
            $this->load->view('layout/footer');

        }

    }

    public function pdf($venda_id = null){

        if(!$venda_id || !$this->core_model->get_by_id('vendas', ['venda_id' => $venda_id])){
            $this->session->set_flashdata('error', 'Venda não localizada !!!');
            redirect('vendas');

        }else{

            $empresa = $this->core_model->get_by_id('sistema', ['sistema_id' => 1]);

            //echo '<pre>';
           // print_r($empresa);
            //exit(); 

            $venda = $this->vendas_model->get_by_id($venda_id);

             //echo '<pre>';
             //print_r($venda);
             //exit(); 

             $file_name = 'Venda&nbsp; '.$venda->venda_id;

             //inicio html
             $html = '<html>';

             $html .= '<head>';

             $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Impressão de Venda</title>';


             $html .= '</head>';

             $html .= '<body  style="font-size: 12px">';

             $html .= '<h4 align="center">
                 '.$empresa->sistema_razao_social.'<br/>
                 '.'CNPJ: '.$empresa->sistema_cnpj.'<br/>
                 '.$empresa->sistema_endereco.', '.$empresa->sistema_numero.' - '.$empresa->sistema_bairro.'<br/>
                 '.$empresa->sistema_cep.' - '.$empresa->sistema_cidade.'/'.$empresa->sistema_estado.'<br/>
                 '.'Telefone:'.$empresa->sistema_telefone_fixo.'<br/>

                      </h4>';
             $html .= '<hr>';

             //dados do cliente

             $html .= '<h6 align="center" style="font-size: 18px; font-family: Arial, Helvetica, sans-serif">VENDA:  '.'Nº '.$venda->venda_id.'</h6>';

             $html .= '<p style="font-size: 12px">'                       
                          .'<strong>Cliente: </strong>'. $venda->cliente_nome_completo .'<br/>'
                          .'<strong>CPF: </strong>'. $venda->cliente_cpf_cnpj .'<br/>'
                          .'<strong>Celular: </strong>'. $venda->cliente_celular .'<br/>'
                          .'<strong>Data Emissão: </strong>'.formata_data_banco_com_hora ($venda->venda_data_emissao) .'<br/>'
                          .'<strong>Forma de Pagamento: </strong>'. $venda->forma_pagamento .'<br/>'
                          .'</p>';

             
             

             $html .= '<hr>';
             
             
             
             //dados da ordem de serviços
             
             $html .= '<table width="100%" height="solid #ddd 1px">';

             $html .= '<tr>';

             $html .= '<th>Cód. Produto</th>';
             $html .= '<th>Descrição</th>';
             $html .= '<th>Qtde</th>';
             $html .= '<th>Valor Uni</th>';
             $html .= '<th>Desconto</th>';
             $html .= '<th>Valor Total</th>';
       
                        
             $html .= '</tr>';
            
             

             //$venda_id = $venda->venda_id;

             $produtos_venda = $this->vendas_model->get_all_produtos($venda_id);

             $valor_final_venda = $this->vendas_model->get_valor_final_venda($venda_id);

             //echo '<pre>';
             //print_r($valor_final_os);
             //exit();

             foreach ($produtos_venda as $produto):

                $html .= '<tr>';

                $html .= '<td>'.$produto->venda_produto_id_produto.'</td>';
                $html .= '<td>'.$produto->produto_descricao.'</td>';
                $html .= '<td>'.$produto->venda_produto_quantidade.'</td>';
                $html .= '<td>'.'R$ '.$produto->venda_produto_valor_unitario.'</td>';
                $html .= '<td>'.$produto->venda_produto_desconto.'% </td>';
                $html .= '<td>'.'R$ '.$produto->venda_produto_valor_total.'</td>';
            
                $html .= '</tr>';

             endforeach;

             $html .= '<th colspan="4"><br/>';
               
             $html .= '<td style="border-top: 1px solid #ddd 1px"><strong>Valor Final</strong></td>';
             $html .= '<td style="border-top: 1px solid #ddd 1px">'.'R$ '.$valor_final_venda->venda_valor_total.'</td>';

             $html .= '</th>';

             $html .= '</table>';

             $html .= '</body>';

             $html .= '</html>';

            //echo '<pre>';
            //print_r($html);
            //exit(); 

             //False  = Abre pdf no navegador
             //true = faz o downolad
             $this->pdf->createPDF($html, $file_name, false);


        }

    }
}