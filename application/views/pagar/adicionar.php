

    <?php $this->load->view('layout/sidebar'); ?>

      <!-- Main Content -->
      <div id="content">

    <?php $this->load->view('layout/navbar'); ?>    

        <!-- Begin Page Content -->
        <div class="container-fluid">  

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('pagar'); ?>">Contas a Pagar</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
            </ol>
          </nav>

        <!-- Mensagensde informação ao usuário erro e sucesso  -->
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
 
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <form method="post" name="form_adicionar">
                  
               <fieldset class="mt-4 border p-2">
                  <legend class="" style="font-size:17px"><i class="fas fa-money-bill-alt"></i>&nbsp; Dados da Conta</legend>
                      <div class="form-group row">
                        <div class="col-md-6">
                        <label >Fornecedor</label>
                        <select class="form-control contas_pagar" name="conta_pagar_fornecedor_id">
                          <option value="" selected></option>
                            <?php foreach ($fornecedores as $fornecedor): ?>
                              <option value="<?php echo $fornecedor->fornecedor_id ?>"><?php echo $fornecedor->fornecedor_nome_fantasia ?></option>
                            <?php endforeach; ?>
                          </select>
                          <?php echo form_error('conta_pagar_fornecedor_id', '<small class="form-text text-danger">', '</small>'); ?>       
                                                  
                        </div> 
                        <div class="col-md-2">
                          <label>Data Vencimento</label>
                          <input type="date" class="form-control" name="conta_pagar_data_venc"  placeholder="" value="<?php echo set_value('conta_pagar_data_venc') ?>">
                          <?php echo form_error('conta_pagar_data_venc', '<small class="form-text text-danger">', '</small>'); ?>                         
                        </div>   
                        <div class="col-md-2">
                          <label>Valor Conta</label>
                          <input type="text" class="form-control money2" name="conta_pagar_valor"  placeholder="Valor conta" value="<?php echo set_value('conta_pagar_valor') ?>">
                          <?php echo form_error('conta_pagar_valor', '<small class="form-text text-danger">', '</small>'); ?>                         
                        </div>
                        <div class="col-md-2">
                          <label >Status</label>
                          <select class="form-control" name="conta_pagar_status">
                          <option value="1">Paga</option>
                          <option value="0">Pendente</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-12">
                          <label>Observaçoes da Conta</label>
                          <textarea class="form-control" name="conta_pagar_obs" style="max-height: 60px;min-width: 100%" placeholder="Obs. conta"><?php echo set_value('conta_pagar_obs') ?></textarea>
                          <?php echo form_error('conta_pagar_obs', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                      </div>                  
                    </fieldset><br>
                   
                    <button type="submit" class="btn btn-success"><i class="far fa-save ml-1"></i>&nbsp; Salvar</button>
                <a title="Voltar" href="<?php echo base_url($this->router->fetch_class()); ?>" class="btn btn-primary ml-2"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</a>
            </div>              
          </form>
        </div>
      </div>

    </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

 <!---------- End of Main Content -----

      