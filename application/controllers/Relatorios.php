<?php

defined('BASEPATH') or exit('Caminho inválido');

class Relatorios extends CI_Controller
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
    }

    public function vendas()
    {
        $data = [
                'titulo' => 'Relatórios de vendas',
            ];

        $data_inicial = $this->input->post('data_inicial');
        $data_final = $this->input->post('data_final');

        if ($data_inicial) {
            $this->load->model('vendas_model');

            if ($this->vendas_model->gerar_relatorio_vendas($data_inicial, $data_final)) {
                //montar o pdf

                $empresa = $this->core_model->get_by_id('sistema', ['sistema_id' => 1]);

                $vendas = $this->vendas_model->gerar_relatorio_vendas($data_inicial, $data_final);

                $file_name = 'Relatório de Vendas';

                //inicio html
                $html = '<html>';

                $html .= '<head>';

                $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Relatório de vendas</title>';

                $html .= '<style>';
                $html .= 'table';
                $html .= '{
                                width: 100%;
                                border-collapse: collapse;
                                padding-top: 10px;
                                
                                                              
                               }';

                $html .= 'th';
                $html .= '{
                               font-family: sans-serif; 
                               height:40px;
                               background: #fff; 
                               font-size: 15px;
                               text-align: center;

                               }';

                $html .= 'td';
                $html .= '{
                               height:25px;
                               font-family:sans-serif;
                               padding: 3px; 
                               vertical-align: middle;

                               }';

                $html .= 'tr:nth-child(even)';
                $html .= '{
                                background: #ddd;

                                }';
                $html .= 'p';
                $html .= '{
                                font-family:"Lucida Console", Courier, monospace;
                                font-size: 20px;
                                text-align: center;
                                font-weight: bold;

                                }';

                $html .= '</style>';

                $html .= '</head>';

                $html .= '<body  style="font-size: 12px">';

                $html .= '<h4 align="center">
                         '.$empresa->sistema_razao_social.'<br/>
                         '.'CNPJ: '.$empresa->sistema_cnpj.'<br/>
                         '.$empresa->sistema_endereco.', '.$empresa->sistema_numero.' - '.$empresa->sistema_bairro.'<br/>
                         '.$empresa->sistema_cep.' - '.$empresa->sistema_cidade.'/'.$empresa->sistema_estado.'<br/>
                         '.'Telefone: '.$empresa->sistema_telefone_fixo.'<br/>
                         '.'Email: '.$empresa->sistema_email.'<br/>
                         </h4>';

                $html .= '<hr>';

                if ($data_inicial && $data_final) {
                    $html .= '<p>Relatório de vendas realizadas no período de &nbsp;'.formata_data_banco_sem_hora($data_inicial).' - '.formata_data_banco_sem_hora($data_final).'</p>';
                } else {
                    $html .= '<p>Relatório de vendas à partir de '.formata_data_banco_sem_hora($data_inicial).'</p>';
                }

                $html .= '<hr>';

                //dados da venda

                $html .= '<table border="1">';

                $html .= '<tr>';

                $html .= '<th>Cód</th>';
                $html .= '<th>Data</th>';
                $html .= '<th>Cliente</th>';
                $html .= '<th>Forma Pagamento</th>';
                $html .= '<th>Valor Total</th>';

                $html .= '</tr>';

                $valor_final_vendas = $this->vendas_model->get_valor_final_relatorio($data_inicial, $data_final);

                //echo '<pre>';
                //print_r($valor_final_os);
                //exit();

                foreach ($vendas as $venda):

                        $html .= '<tr>';
                $html .= '<td width:"45!important">'.$venda->venda_id.'</td>';
                $html .= '<td>'.formata_data_banco_com_hora($venda->venda_data_emissao).'</td>';
                $html .= '<td>'.$venda->cliente_nome_completo.'</td>';
                $html .= '<td>'.$venda->forma_pagamento.'</td>';
                $html .= '<td>'.'R$ '.$venda->venda_valor_total.'</td>';

                $html .= '</tr>';

                endforeach;

                $html .= '<th colspan="3"><br/>';

                $html .= '<td align="right" bgcolor="#01DF74"><strong>Valor Final</strong></td>';
                $html .= '<td align="right" bgcolor="#01DF74"><strong>'.'&nbsp;&nbsp;R$ '.$valor_final_vendas->venda_valor_total.'</strong></td>';

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
            } else {
                if (!empty($data_inicial) && !empty($data_final)) {
                    $this->session->set_flashdata('info', 'Não foram encontradas vendas entre as dastas '.formata_data_banco_sem_hora($data_inicial).'&nbsp;&nbsp;'.formata_data_banco_sem_hora($data_inicial).' !!!');
                } else {
                    $this->session->set_flashdata('info', 'Não foram encontradas Vendas à partir da data '.formata_data_banco_sem_hora($data_inicial).' !!!');
                }
                redirect('relatorios/vendas');
            }
        }

        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/vendas');
        $this->load->view('layout/footer');
    }

    public function os()
    {
        $data = [
            'titulo' => 'Relatórios de ordens de serviços',
        ];

        $data_inicial = $this->input->post('data_inicial');
        $data_final = $this->input->post('data_final');

        if ($data_inicial) {
            $this->load->model('ordem_servicos_model');

            if ($this->ordem_servicos_model->gerar_relatorio_os($data_inicial, $data_final)) {
                //montar o pdf

                $empresa = $this->core_model->get_by_id('sistema', ['sistema_id' => 1]);

                $ordens_servicos = $this->ordem_servicos_model->gerar_relatorio_os($data_inicial, $data_final);

                $file_name = 'Relatório de Ordens de Serviços';

                //inicio html
                $html = '<html>';

                $html .= '<head>';

                $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Relatório de ordens de serviços</title>';

                $html .= '<style>';
                $html .= 'table';
                $html .= '{
                            width: 100%;
                            border-collapse: collapse;
                            padding-top: 10px;
                            
                                                          
                           }';

                $html .= 'th';
                $html .= '{
                           font-family: sans-serif; 
                           height:40px;
                           background: #fff; 
                           font-size: 15px;
                           text-align: center;

                           }';

                $html .= 'td';
                $html .= '{
                           height:25px;
                           font-family:sans-serif;
                           padding: 3px; 
                           vertical-align: middle;

                           }';

                $html .= 'tr:nth-child(even)';
                $html .= '{
                            background: #ddd;

                            }';
                $html .= 'p';
                $html .= '{
                            font-family:"Lucida Console", Courier, monospace;
                            font-size: 20px;
                            text-align: center;
                            font-weight: bold;

                            }';

                $html .= '</style>';

                $html .= '</head>';

                $html .= '<body  style="font-size: 12px">';

                $html .= '<h4 align="center">
                     '.$empresa->sistema_razao_social.'<br/>
                     '.'CNPJ: '.$empresa->sistema_cnpj.'<br/>
                     '.$empresa->sistema_endereco.', '.$empresa->sistema_numero.' - '.$empresa->sistema_bairro.'<br/>
                     '.$empresa->sistema_cep.' - '.$empresa->sistema_cidade.'/'.$empresa->sistema_estado.'<br/>
                     '.'Telefone: '.$empresa->sistema_telefone_fixo.'<br/>
                     '.'Email: '.$empresa->sistema_email.'<br/>
                     </h4>';

                $html .= '<hr>';

                if ($data_inicial && $data_final) {
                    $html .= '<p>Relatório de ordens de serviços realizadas no período de &nbsp;'.formata_data_banco_sem_hora($data_inicial).' - '.formata_data_banco_sem_hora($data_final).'</p>';
                } else {
                    $html .= '<p>Relatório de ordens de serviços à partir de '.formata_data_banco_sem_hora($data_inicial).'</p>';
                }

                $html .= '<hr>';

                //dados da venda

                $html .= '<table border="1">';

                $html .= '<tr>';

                $html .= '<th>Cód</th>';
                $html .= '<th>Data</th>';
                $html .= '<th>Cliente</th>';
                $html .= '<th>Forma Pagamento</th>';
                $html .= '<th>Valor Total</th>';

                $html .= '</tr>';

                $valor_final_os = $this->ordem_servicos_model->get_valor_final_relatorio_os($data_inicial, $data_final);

                //echo '<pre>';
                //print_r($valor_final_os);
                //exit();

                foreach ($ordens_servicos as $os):

                    $html .= '<tr>';
                $html .= '<td width:"45!important">'.$os->ordem_servico_id.'</td>';
                $html .= '<td>'.formata_data_banco_com_hora($os->ordem_servico_data_emissao).'</td>';
                $html .= '<td>'.$os->cliente_nome_completo.'</td>';

                if ($os->forma_pagamento == '') {
                    $html .= '<td align="center">Em aberto</td>';
                } else {
                    $html .= '<td align="center">'.$os->forma_pagamento.'</td>';
                }

                $html .= '<td align="center">'.'R$ '.$os->ordem_servico_valor_total.'</td>';

                $html .= '</tr>';

                endforeach;

                $html .= '<th colspan="3"><br/>';

                $html .= '<td align="right" bgcolor="#01DF74"><strong>Valor Final</strong></td>';
                $html .= '<td align="right" bgcolor="#01DF74"><strong>'.'&nbsp;&nbsp;R$ '.$valor_final_os->ordem_servico_valor_total.'</strong></td>';

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
            } else {
                if (!empty($data_inicial) && !empty($data_final)) {
                    $this->session->set_flashdata('info', 'Não foram encontradas Ordens de Serviços entre as dastas '.formata_data_banco_sem_hora($data_inicial).'&nbsp;&nbsp;'.formata_data_banco_sem_hora($data_inicial).' !!!');
                } else {
                    $this->session->set_flashdata('info', 'Não foram encontradas Ordens de Serviços à partir da data '.formata_data_banco_sem_hora($data_inicial).' !!!');
                }
                redirect('relatorios/os');
            }
        }

        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/os');
        $this->load->view('layout/footer');
    }

    public function receber()
    {
        $data = [
            'titulo' => 'Relatório de contas a receber',
        ];

        $contas = $this->input->post('contas');

        if ($contas == 'vencidas' || $contas == 'pagas' || $contas == 'receber') {
            $this->load->model('financeiro_model');

            if ($contas == 'vencidas') {
                $conta_receber_status = 0;
                $data_vencimento = true;

                //formar pdf

                $empresa = $this->core_model->get_by_id('sistema', ['sistema_id' => 1]);

                if ($contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status, $data_vencimento)) {
                    $file_name = 'Relatório de contas vencidas';

                    //inicio html
                    $html = '<html>';

                    $html .= '<head>';

                    $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Relatório de contas vencidas</title>';

                    $html .= '<style>';
                    $html .= 'table';
                    $html .= '{
                                width: 100%;
                                border-collapse: collapse;
                                padding-top: 10px;
                                
                                                              
                               }';

                    $html .= 'th';
                    $html .= '{
                               font-family: sans-serif; 
                               height:40px;
                               background: #fff; 
                               font-size: 15px;
                               text-align: center;

                               }';

                    $html .= 'td';
                    $html .= '{
                               height:25px;
                               font-family:sans-serif;
                               padding: 3px; 
                               vertical-align: middle;

                               }';

                    $html .= 'tr:nth-child(even)';
                    $html .= '{
                                background: #ddd;

                                }';
                    $html .= 'p';
                    $html .= '{
                                font-family:"Lucida Console", Courier, monospace;
                                font-size: 20px;
                                text-align: center;
                                font-weight: bold;

                                }';

                    $html .= '</style>';

                    $html .= '</head>';

                    $html .= '<body  style="font-size: 12px">';

                    $html .= '<h4 align="center">
                         '.$empresa->sistema_razao_social.'<br/>
                         '.'CNPJ: '.$empresa->sistema_cnpj.'<br/>
                         '.$empresa->sistema_endereco.', '.$empresa->sistema_numero.' - '.$empresa->sistema_bairro.'<br/>
                         '.$empresa->sistema_cep.' - '.$empresa->sistema_cidade.'/'.$empresa->sistema_estado.'<br/>
                         '.'Telefone: '.$empresa->sistema_telefone_fixo.'<br/>
                         '.'Email: '.$empresa->sistema_email.'<br/>
                         </h4>';

                    $html .= '<hr>';
                    $html .= '<p>Relatório geral de contas a receber "Vencidas"</p>';
                    $html .= '<hr>';

                    //dados da venda

                    $html .= '<table border="1">';

                    $html .= '<tr>';

                    $html .= '<th>Cód. Conta</th>';
                    $html .= '<th>Data Vencimento</th>';
                    $html .= '<th>Cliente</th>';
                    $html .= '<th>Situção</th>';
                    $html .= '<th>Valor</th>';

                    $html .= '</tr>';

                    //echo '<pre>';
                    //print_r($valor_final_os);
                    //exit();

                    foreach ($contas as $conta):

                        $html .= '<tr>';
                    $html .= '<td width:"45!important">'.$conta->conta_receber_id.'</td>';
                    $html .= '<td>'.formata_data_banco_sem_hora($conta->conta_receber_data_vencto).'</td>';
                    $html .= '<td>'.$conta->cliente_nome_completo.'</td>';
                    $html .= '<td align="center">Vencida</td>';
                    $html .= '<td>'.'R$ '.$conta->conta_receber_valor.'</td>';

                    $html .= '</tr>';

                    endforeach;

                    $valor_final_contas = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status, $data_vencimento);

                    $html .= '<th colspan="3"><br/>';

                    $html .= '<td align="right" bgcolor="#FA5858"><strong>Valor Total</strong></td>';
                    $html .= '<td align="right" bgcolor="#FA5858"><strong>'.'&nbsp;&nbsp;R$ '.$valor_final_contas->conta_receber_valor_total.'</strong></td>';

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
                } else {
                    $this->session->set_flashdata('info', 'Não existem contas vencidas na base de dados !!!');
                    redirect('relatorios/receber');
                }
            }

            //conta pagas

            if ($contas == 'pagas') {
                $conta_receber_status = 1;

                if ($contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status)) {
                    //formar pdf

                    $empresa = $this->core_model->get_by_id('sistema', ['sistema_id' => 1]);

                    $contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status);

                    $file_name = 'Relatório de contas pagas';

                    //inicio html
                    $html = '<html>';

                    $html .= '<head>';

                    $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Relatório de contas pagas</title>';

                    $html .= '<style>';
                    $html .= 'table';
                    $html .= '{
                                width: 100%;
                                border-collapse: collapse;
                                padding-top: 10px;
                                
                                                              
                               }';

                    $html .= 'th';
                    $html .= '{
                               font-family: sans-serif; 
                               height:40px;
                               background: #fff; 
                               font-size: 15px;
                               text-align: center;

                               }';

                    $html .= 'td';
                    $html .= '{
                               height:25px;
                               font-family:sans-serif;
                               padding: 3px; 
                               vertical-align: middle;

                               }';

                    $html .= 'tr:nth-child(even)';
                    $html .= '{
                                background: #ddd;

                                }';
                    $html .= 'p';
                    $html .= '{
                                font-family:"Lucida Console", Courier, monospace;
                                font-size: 20px;
                                text-align: center;
                                font-weight: bold;

                                }';

                    $html .= '</style>';

                    $html .= '</head>';

                    $html .= '<body  style="font-size: 12px">';

                    $html .= '<h4 align="center">
                         '.$empresa->sistema_razao_social.'<br/>
                         '.'CNPJ: '.$empresa->sistema_cnpj.'<br/>
                         '.$empresa->sistema_endereco.', '.$empresa->sistema_numero.' - '.$empresa->sistema_bairro.'<br/>
                         '.$empresa->sistema_cep.' - '.$empresa->sistema_cidade.'/'.$empresa->sistema_estado.'<br/>
                         '.'Telefone: '.$empresa->sistema_telefone_fixo.'<br/>
                         '.'Email: '.$empresa->sistema_email.'<br/>
                         </h4>';

                         $html .= '<hr>';
                         $html .= '<p>Relatório geral de contas a receber "Pagas"</p>';
                         $html .= '<hr>';

                    //dados da venda

                    $html .= '<table border="1">';

                    $html .= '<tr>';

                    $html .= '<th>Cód. Conta</th>';
                    $html .= '<th>Data Pagamento</th>';
                    $html .= '<th>Cliente</th>';
                    $html .= '<th>Situção</th>';
                    $html .= '<th>Valor</th>';

                    $html .= '</tr>';

                    //echo '<pre>';
                    //print_r($valor_final_os);
                    //exit();

                    foreach ($contas as $conta):

                        $html .= '<tr>';
                    $html .= '<td width:"45!important">'.$conta->conta_receber_id.'</td>';
                    $html .= '<td>'.formata_data_banco_com_hora($conta->conta_receber_data_pagamento).'</td>';
                    $html .= '<td>'.$conta->cliente_nome_completo.'</td>';
                    $html .= '<td align="center">Paga</td>';
                    $html .= '<td>'.'R$ '.$conta->conta_receber_valor.'</td>';

                    $html .= '</tr>';

                    endforeach;

                    $valor_final_contas = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status);

                    $html .= '<th colspan="3"><br/>';

                    $html .= '<td align="right" bgcolor="#01DF74"><strong>Valor Total</strong></td>';
                    $html .= '<td align="right" bgcolor="#01DF74"><strong>'.'&nbsp;&nbsp;R$ '.$valor_final_contas->conta_receber_valor_total.'</strong></td>';

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
                } else {
                    $this->session->set_flashdata('info', 'Não existem contas pagas na base de dados !!!');
                    redirect('relatorios/receber');
                }
            }

            //contas receber
            if ($contas == 'receber') {
                $conta_receber_status = 0;

                if ($contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status)) {
                    //formar pdf

                    $empresa = $this->core_model->get_by_id('sistema', ['sistema_id' => 1]);

                    $contas = $this->financeiro_model->get_contas_receber_relatorio($conta_receber_status);

                    $file_name = 'Relatório de contas pagas';

                    //inicio html
                    $html = '<html>';

                    $html .= '<head>';

                    $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Relatório de contas a receber</title>';

                    $html .= '<style>';
                    $html .= 'table';
                    $html .= '{
                                width: 100%;
                                border-collapse: collapse;
                                padding-top: 10px;
                                
                                                              
                               }';

                    $html .= 'th';
                    $html .= '{
                               font-family: sans-serif; 
                               height:40px;
                               background: #fff; 
                               font-size: 15px;
                               text-align: center;

                               }';

                    $html .= 'td';
                    $html .= '{
                               height:25px;
                               font-family:sans-serif;
                               padding: 3px; 
                               vertical-align: middle;

                               }';

                    $html .= 'tr:nth-child(even)';
                    $html .= '{
                                background: #ddd;

                                }';
                    $html .= 'p';
                    $html .= '{
                                font-family:"Lucida Console", Courier, monospace;
                                font-size: 20px;
                                text-align: center;
                                font-weight: bold;

                                }';

                    $html .= '</style>';

                    $html .= '</head>';

                    $html .= '<body  style="font-size: 12px">';

                    $html .= '<h4 align="center">
                         '.$empresa->sistema_razao_social.'<br/>
                         '.'CNPJ: '.$empresa->sistema_cnpj.'<br/>
                         '.$empresa->sistema_endereco.', '.$empresa->sistema_numero.' - '.$empresa->sistema_bairro.'<br/>
                         '.$empresa->sistema_cep.' - '.$empresa->sistema_cidade.'/'.$empresa->sistema_estado.'<br/>
                         '.'Telefone: '.$empresa->sistema_telefone_fixo.'<br/>
                         '.'Email: '.$empresa->sistema_email.'<br/>
                         </h4>';

                         $html .= '<hr>';
                         $html .= '<p>Relatório geral de contas a "Receber"</p>';
                         $html .= '<hr>';
                    //dados da venda

                    $html .= '<table border="1">';

                    $html .= '<tr>';

                    $html .= '<th>Cód. Conta</th>';
                    $html .= '<th>Data Vencimento</th>';
                    $html .= '<th>Cliente</th>';
                    $html .= '<th>Situção</th>';
                    $html .= '<th>Valor</th>';

                    $html .= '</tr>';

                    //echo '<pre>';
                    //print_r($valor_final_os);
                    //exit();

                    foreach ($contas as $conta):

                        $html .= '<tr>';
                    $html .= '<td width:"45!important">'.$conta->conta_receber_id.'</td>';
                    $html .= '<td>'.formata_data_banco_sem_hora($conta->conta_receber_data_vencto).'</td>';
                    $html .= '<td>'.$conta->cliente_nome_completo.'</td>';
                    $html .= '<td align="center">À receber</td>';
                    $html .= '<td>'.'R$ '.$conta->conta_receber_valor.'</td>';

                    $html .= '</tr>';

                    endforeach;

                    $valor_final_contas = $this->financeiro_model->get_sum_contas_receber_relatorio($conta_receber_status);

                    $html .= '<th colspan="3"><br/>';

                    $html .= '<td align="right" bgcolor="#01DF74"><strong>Valor Total</strong></td>';
                    $html .= '<td align="right" bgcolor="#01DF74"><strong>'.'&nbsp;&nbsp;R$ '.$valor_final_contas->conta_receber_valor_total.'</strong></td>';

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
                } else {
                    $this->session->set_flashdata('info', 'Não existem contas a receber na base de dados !!!');
                    redirect('relatorios/receber');
                }
            }
        }

        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/receber');
        $this->load->view('layout/footer');
    }

    public function pagar()
    {
        $data = [
            'titulo' => 'Relatório de contas a pagar',
        ];

        $contas = $this->input->post('contas');

        if ($contas == 'pagas' || $contas == 'vencidas' || $contas == 'a_pagar') {
            $this->load->model('financeiro_model');

            if ($contas == 'vencidas') {
                $conta_pagar_status = 0;
                $data_vencimento = true;

                //formar pdf

                $empresa = $this->core_model->get_by_id('sistema', ['sistema_id' => 1]);

                if ($contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento)) {
                    $file_name = 'Relatório de contas vencidas';

                    //inicio html
                    $html = '<html>';

                    $html .= '<head>';

                    $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Relatório de contas vencidas</title>';

                    $html .= '<style>';
                    $html .= 'table';
                    $html .= '{
                                width: 100%;
                                border-collapse: collapse;
                                padding-top: 10px;
                                
                                                              
                               }';

                    $html .= 'th';
                    $html .= '{
                               font-family: sans-serif; 
                               height:40px;
                               background: #fff; 
                               font-size: 15px;
                               text-align: center;

                               }';

                    $html .= 'td';
                    $html .= '{
                               height:25px;
                               font-family:sans-serif;
                               padding: 3px; 
                               vertical-align: middle;

                               }';

                    $html .= 'tr:nth-child(even)';
                    $html .= '{
                                background: #ddd;

                                }';
                    $html .= 'p';
                    $html .= '{
                                font-family:"Lucida Console", Courier, monospace;
                                font-size: 20px;
                                text-align: center;
                                font-weight: bold;

                                }';

                    $html .= '</style>';

                    $html .= '</head>';

                    $html .= '<body  style="font-size: 12px">';

                    $html .= '<h4 align="center">
                         '.$empresa->sistema_razao_social.'<br/>
                         '.'CNPJ: '.$empresa->sistema_cnpj.'<br/>
                         '.$empresa->sistema_endereco.', '.$empresa->sistema_numero.' - '.$empresa->sistema_bairro.'<br/>
                         '.$empresa->sistema_cep.' - '.$empresa->sistema_cidade.'/'.$empresa->sistema_estado.'<br/>
                         '.'Telefone: '.$empresa->sistema_telefone_fixo.'<br/>
                         '.'Email: '.$empresa->sistema_email.'<br/>
                         </h4>';

                         $html .= '<hr>';
                         $html .= '<p>Relatório geral de contas a pagar "Vencidas"</p>';
                         $html .= '<hr>';
                    //dados da venda

                    $html .= '<table border="1">';

                    $html .= '<tr>';

                    $html .= '<th>Cód. Conta</th>';
                    $html .= '<th>Data Vencimento</th>';
                    $html .= '<th>Fornecedor</th>';
                    $html .= '<th>Situção</th>';
                    $html .= '<th>Valor</th>';

                    $html .= '</tr>';

                    //echo '<pre>';
                    //print_r($valor_final_os);
                    //exit();

                    foreach ($contas as $conta):

                        $html .= '<tr>';
                    $html .= '<td width:"45!important">'.$conta->conta_pagar_id.'</td>';
                    $html .= '<td>'.formata_data_banco_sem_hora($conta->conta_pagar_data_venc).'</td>';
                    $html .= '<td>'.$conta->fornecedor_nome_fantasia.'</td>';
                    $html .= '<td align="center">Vencida</td>';
                    $html .= '<td>'.'R$ '.$conta->conta_pagar_valor.'</td>';

                    $html .= '</tr>';

                    endforeach;

                    $valor_final_contas = $this->financeiro_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);

                    $html .= '<th colspan="3"><br/>';

                    $html .= '<td align="right" bgcolor="#FA5858"><strong>Valor Total</strong></td>';
                    $html .= '<td align="right" bgcolor="#FA5858"><strong>'.'&nbsp;&nbsp;R$ '.$valor_final_contas->conta_pagar_valor_total.'</strong></td>';

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
                } else {
                    $this->session->set_flashdata('info', 'Não existem contas a pagar vencidas na base de dados !!!');
                    redirect('relatorios/pagar');
                }
            }

            //conta pagas

            if ($contas == 'pagas') {
                $conta_pagar_status = 1;

                $data_vencimento = FALSE; //Quando paga

                if ($contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status,  $data_vencimento)) {
                    //formar pdf

                    $empresa = $this->core_model->get_by_id('sistema', ['sistema_id' => 1]);

                    $contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status,  $data_vencimento);

                    $file_name = 'Relatório de contas pagas';

                    //inicio html
                    $html = '<html>';

                    $html .= '<head>';

                    $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Relatório de contas pagas</title>';

                    $html .= '<style>';
                    $html .= 'table';
                    $html .= '{
                                width: 100%;
                                border-collapse: collapse;
                                padding-top: 10px;
                                
                                                              
                               }';

                    $html .= 'th';
                    $html .= '{
                               font-family: sans-serif; 
                               height:40px;
                               background: #fff; 
                               font-size: 15px;
                               text-align: center;

                               }';

                    $html .= 'td';
                    $html .= '{
                               height:25px;
                               font-family:sans-serif;
                               padding: 3px; 
                               vertical-align: middle;

                               }';

                    $html .= 'tr:nth-child(even)';
                    $html .= '{
                                background: #ddd;

                                }';
                    $html .= 'p';
                    $html .= '{
                                font-family:"Lucida Console", Courier, monospace;
                                font-size: 20px;
                                text-align: center;
                                font-weight: bold;

                                }';

                    $html .= '</style>';

                    $html .= '</head>';

                    $html .= '<body  style="font-size: 12px">';

                    $html .= '<h4 align="center">
                         '.$empresa->sistema_razao_social.'<br/>
                         '.'CNPJ: '.$empresa->sistema_cnpj.'<br/>
                         '.$empresa->sistema_endereco.', '.$empresa->sistema_numero.' - '.$empresa->sistema_bairro.'<br/>
                         '.$empresa->sistema_cep.' - '.$empresa->sistema_cidade.'/'.$empresa->sistema_estado.'<br/>
                         '.'Telefone: '.$empresa->sistema_telefone_fixo.'<br/>
                         '.'Email: '.$empresa->sistema_email.'<br/>
                         </h4>';

                         $html .= '<hr>';
                         $html .= '<p>Relatório geral de contas a pagar "Pagas"</p>';
                         $html .= '<hr>';

                    //dados da venda

                    $html .= '<table border="1">';

                    $html .= '<tr>';

                    $html .= '<th>Cód. Conta</th>';
                    $html .= '<th>Data Pagamento</th>';
                    $html .= '<th>Fornecedor</th>';
                    $html .= '<th>Situção</th>';
                    $html .= '<th>Valor</th>';

                    $html .= '</tr>';

                    //echo '<pre>';
                    //print_r($valor_final_os);
                    //exit();

                    foreach ($contas as $conta):

                        $html .= '<tr>';
                    $html .= '<td width:"45!important">'.$conta->conta_pagar_id.'</td>';
                    $html .= '<td>'.formata_data_banco_com_hora($conta->conta_pagar_data_pagamento).'</td>';
                    $html .= '<td>'.$conta->fornecedor_nome_fantasia.'</td>';
                    $html .= '<td align="center">Paga</td>';
                    $html .= '<td>'.'R$ '.$conta->conta_pagar_valor.'</td>';

                    $html .= '</tr>';

                    endforeach;

                    $valor_final_contas = $this->financeiro_model->get_sum_contas_pagar_relatorio($conta_pagar_status,  $data_vencimento);

                    $html .= '<th colspan="3"><br/>';

                    $html .= '<td align="right" bgcolor="#01DF74"><strong>Valor Total</strong></td>';
                    $html .= '<td align="right" bgcolor="#01DF74"><strong>'.'&nbsp;&nbsp;R$ '.$valor_final_contas->conta_pagar_valor_total.'</strong></td>';

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
                } else {
                    $this->session->set_flashdata('info', 'Não existem contas pagas na base de dados !!!');
                    redirect('relatorios/pagar');
                }
            }

            //contas receber
            if ($contas == 'a_pagar') {

                $conta_pagar_status = 0;

                $data_vencimento = FALSE; //Quando paga

                if ($contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento)) {
                    //formar pdf

                    $empresa = $this->core_model->get_by_id('sistema', ['sistema_id' => 1]);

                    $contas = $this->financeiro_model->get_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);

                    $file_name = 'Relatório de contas a pagar';

                    //inicio html
                    $html = '<html>';

                    $html .= '<head>';

                    $html .= '<title>'.$empresa->sistema_nome_fantasia.' | Relatório de contas a pagar</title>';

                    $html .= '<style>';
                    $html .= 'table';
                    $html .= '{
                                width: 100%;
                                border-collapse: collapse;
                                padding-top: 10px;
                                
                                                              
                               }';

                    $html .= 'th';
                    $html .= '{
                               font-family: sans-serif; 
                               height:40px;
                               background: #fff; 
                               font-size: 15px;
                               text-align: center;

                               }';

                    $html .= 'td';
                    $html .= '{
                               height:25px;
                               font-family:sans-serif;
                               padding: 3px; 
                               vertical-align: middle;

                               }';

                    $html .= 'tr:nth-child(even)';
                    $html .= '{
                                background: #ddd;

                                }';
                    $html .= 'p';
                    $html .= '{
                                font-family:"Lucida Console", Courier, monospace;
                                font-size: 20px;
                                text-align: center;
                                font-weight: bold;

                                }';

                    $html .= '</style>';

                    $html .= '</head>';

                    $html .= '<body  style="font-size: 12px">';

                    $html .= '<h4 align="center">
                         '.$empresa->sistema_razao_social.'<br/>
                         '.'CNPJ: '.$empresa->sistema_cnpj.'<br/>
                         '.$empresa->sistema_endereco.', '.$empresa->sistema_numero.' - '.$empresa->sistema_bairro.'<br/>
                         '.$empresa->sistema_cep.' - '.$empresa->sistema_cidade.'/'.$empresa->sistema_estado.'<br/>
                         '.'Telefone: '.$empresa->sistema_telefone_fixo.'<br/>
                         '.'Email: '.$empresa->sistema_email.'<br/>
                         </h4>';

                         $html .= '<hr>';
                         $html .= '<p>Relatório geral de contas a pagar "À pagar"</p>';
                         $html .= '<hr>';
                    //dados da venda

                    $html .= '<table border="1">';

                    $html .= '<tr>';

                    $html .= '<th>Cód. Conta</th>';
                    $html .= '<th>Data Vencimento</th>';
                    $html .= '<th>Fornecedor</th>';
                    $html .= '<th>Situção</th>';
                    $html .= '<th>Valor</th>';

                    $html .= '</tr>';

                    //echo '<pre>';
                    //print_r($valor_final_os);
                    //exit();

                    foreach ($contas as $conta):

                        $html .= '<tr>';
                    $html .= '<td width:"45!important">'.$conta->conta_pagar_id.'</td>';
                    $html .= '<td>'.formata_data_banco_sem_hora($conta->conta_pagar_data_venc).'</td>';
                    $html .= '<td>'.$conta->fornecedor_nome_fantasia.'</td>';
                    $html .= '<td align="center">À Pagar</td>';
                    $html .= '<td>'.'R$ '.$conta->conta_pagar_valor.'</td>';

                    $html .= '</tr>';

                    endforeach;

                    $valor_final_contas = $this->financeiro_model->get_sum_contas_pagar_relatorio($conta_pagar_status, $data_vencimento);

                    $html .= '<th colspan="3"><br/>';

                    $html .= '<td align="right" bgcolor="#FA5858"><strong>Valor Total</strong></td>';
                    $html .= '<td align="right" bgcolor="#FA5858"><strong>'.'&nbsp;&nbsp;R$ '.$valor_final_contas->conta_pagar_valor_total.'</strong></td>';

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
                } else {
                    $this->session->set_flashdata('info', 'Não existem contas a pagar na base de dados !!!');
                    redirect('relatorios/pagar');
                }
            }
        }

        $this->load->view('layout/header', $data);
        $this->load->view('relatorios/pagar');
        $this->load->view('layout/footer');
    }
}
