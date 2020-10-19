

    <?php $this->load->view('layout/sidebar'); ?>

      <!-- Main Content -->
      <div id="content">

    <?php $this->load->view('layout/navbar'); ?>    

        <!-- Begin Page Content -->
        <div class="container-fluid">  

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('/'); ?>">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
            </ol>
          </nav>
          
          <?php if($message = $this->session->flashdata('sucesso')) : ?>
            <div class="row">
              <div class="col-md-12">
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong><i class="far fa-smile-wink"></i>&nbsp;&nbsp;<?php echo $message ?></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>                
              </div>
            </div>
          <?php endif ?>

          <?php if($message = $this->session->flashdata('error')) : ?>
            <div class="row">
              <div class="col-md-12">
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?php echo $message ?></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>                
              </div>
            </div>
          <?php endif ?>
          <?php if($message = $this->session->flashdata('info')) : ?>
            <div class="row">
              <div class="col-md-12">
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?php echo $message ?></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>                
              </div>
            </div>
          <?php endif ?>
 
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a title="Cadastrar contas a pagar" href="<?php echo base_url('pagar/adicionar'); ?>" class="btn btn-success float-right"><i class="fas fa-plus"></i></i>&nbsp; Nova</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Fornecedor</th>
                      <th class="text-center">Valor Conta</th>
                      <th class="text-center">Data Vencimento</th>
                      <th class="text-center">Data Pagamento</th>
                      <th class="text-center">Situação</th>
                      <th class="text-center pr-3 no-sort">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($contas_pagar as $conta): ?>
                    <tr>
                      <td><?php echo $conta->conta_pagar_id ?></td>
                      <td><?php echo $conta->fornecedor ?></td>
                      <td class="text-center pr-4"><?php echo 'R$&nbsp;'.$conta->conta_pagar_valor ?></td>
                      <td class="text-center pr-4"><?php echo formata_data_banco_sem_hora($conta->conta_pagar_data_venc); ?></td>
                      <td class="text-center pr-4"><?php echo ($conta->conta_pagar_status == 1 ? formata_data_banco_com_hora($conta->conta_pagar_data_pagamento) : 'Aguardando Pgto')  ?></td>

                      
                      <td class="text-center pr-3">
                        <?php 

                          if($conta->conta_pagar_status == 1){

                            echo '<span class="badge badge-success btn-sm text-gray-900">Paga</span>';

                          }elseif(strtotime($conta->conta_pagar_data_venc) > strtotime(date('Y-m-d'))){

                            echo '<span class="badge badge-secondary btn-sm text-gray-900">À pagar</span>';

                          }elseif(strtotime($conta->conta_pagar_data_venc) == strtotime(date('Y-m-d'))){

                            echo '<span class="badge badge-warning btn-sm text-gray-900">Vence Hoje</span>';    
                          }else{
                            echo '<span class="badge badge-danger btn-sm">Vencida</span>';  
                          }
                         ?>
                      </td>
                      <td class="text-center pr-1">
                        <a title="Editar conta a pagar" href="<?php echo base_url('pagar/editar/'.$conta->conta_pagar_id); ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                        <a title="Excluir conta a pagar"href="javascript(void)" data-toggle="modal" data-target="#conta-<?php echo $conta->conta_pagar_id ?>"class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                      </td> 
              
                    </tr> 
                      <!-- Confirma exclusão Modal-->
                      <div class="modal fade" id="conta-<?php echo $conta->conta_pagar_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Confirma a Exclusão?</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body"><h6>Para excluir a conta selecionado clique em <strong>"Confirmar" !</strong> </h6></div>
                            <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                              <a class="btn btn-danger" href="<?php echo base_url('pagar/deletar/'.$conta->conta_pagar_id); ?>">Confirmar</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?> 

                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      