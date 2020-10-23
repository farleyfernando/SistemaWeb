

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
              <a title="Cadastrar clientes" href="<?php echo base_url('clientes/adicionar'); ?>" class="btn btn-success float-right"><i class="fas fa-plus"></i>&nbsp; Clientes</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nome</th>
                      <th >CPF/CNPJ</th>
                      <th class="text-center">Tipo Cliente</th>
                      <th class="text-center pr-2">Ativo</th>
                      <th class="text-center pr-3 no-sort">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                    <tr>
                      <td><?php echo $cliente->cliente_id ?></td>
                      <td><?php echo $cliente->cliente_nome ?></td>
                      <td><?php echo $cliente->cliente_cpf_cnpj ?></td>
                      <td class="text-center pr-1"><?php echo ($cliente->cliente_tipo == 2 ? '<span class="badge badge-dark btn-sm">PJ</span>' : '<span class="badge badge-warning btn-sm">PF</span>') ?></td>

                      <td class="text-center"><?php echo ($cliente->cliente_ativo == 1 ? '<span class="badge badge-info btn-sm">Sim</span>' : '<span class="badge badge-secondary btn-sm">Não</span>') ?></td> 

                      <td class="text-center pr-1">
                        <a title="Editar Usuário" href="<?php echo base_url('clientes/editar/'.$cliente->cliente_id); ?>" class="btn btn-sm btn-primary"><i class="fas fa-user-edit"></i></a>
                        <a title="Excluir Usuário"href="javascript(void)" data-toggle="modal" data-target="#cliente-<?php echo $cliente->cliente_id; ?>"class="btn btn-sm btn-danger"><i class="fas fa-user-times"></i></a>
                      </td> 
                      
                    </tr> 
                      <!-- Confirma exclusão Modal-->
                      <div class="modal fade" id="cliente-<?php echo $cliente->cliente_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Confirma a Exclusão?</h5>
                              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <div class="modal-body"><h6>Para excluir o cliente selecionado clique em <strong>"Confirmar" !</strong> </h6></div>
                            <div class="modal-footer">
                              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                              <a class="btn btn-danger" href="<?php echo base_url('clientes/deletar/'.$cliente->cliente_id); ?>">Confirmar</a>
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

      