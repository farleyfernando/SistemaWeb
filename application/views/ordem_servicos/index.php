

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
              <a title="Cadastrar nova ordem" href="<?php echo base_url('os/adicionar'); ?>" class="btn btn-success float-right"><i class="fas fa-plus"></i></i>&nbsp; Ordem</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Data Emissão</th>
                      <th>Cliente</th>
                      <th class="text-center pr-3">Forma Pgto</th>
                      <th class="text-center pr-3">Valor Total</th>
                      <th class="text-center pr-3">Situação</th>
                      <th class="text-center pr-3 no-sort">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($ordens_servicos as $os): ?>
                    <tr>
                      <td><?php echo $os->ordem_servico_id ?></td>
                      <td><?php echo formata_data_banco_com_hora($os->ordem_servico_data_emissao) ?></td>
                      <td><?php echo $os->cliente_nome ?></td>
                      <td class="text-center pr-3"><?php echo ($os->ordem_servico_status == 1 ? $os->forma_pagamento : 'Em aberto'); ?></td>
                      <td class="text-center pr-3"><?php echo 'R$&nbsp;'.$os->ordem_servico_valor_total ?></td>

                      <td class="text-center"><?php echo ($os->ordem_servico_status == 1 ? '<span class="badge badge-success btn-sm">Paga</span>' : '<span class="badge badge-secondary btn-sm">Em aberto</span>') ?></td>

                     
                      <td class="text-center pr-1">
                        <a title="Imprimir" target="_blank" href="<?php echo base_url('os/pdf/'.$os->ordem_servico_id); ?>" class="btn btn-sm btn-dark"><i class="fas fa-print"></i></a>
                        <a title="Editar ordem de serviço" href="<?php echo base_url('os/editar/'.$os->ordem_servico_id); ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                        <a title="Excluir ordem de serviço"href="javascript(void)" data-toggle="modal" data-target="#os-<?php echo $os->ordem_servico_id; ?>"class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                      </td> 
                      
                    </tr> 
                      <!-- Confirma exclusão Modal-->
                      <div class="modal fade" id="os-<?php echo $os->ordem_servico_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Confirma a exclusão?</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body"><h6>Para excluir a "Ordem de Serviço" selecionada clique em <strong>"Confirmar" !</strong> </h6></div>
                            <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                              <a class="btn btn-danger" href="<?php echo base_url('os/deletar/'.$os->ordem_servico_id); ?>">Confirmar</a>
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

      