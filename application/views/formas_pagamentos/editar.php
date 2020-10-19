

    <?php $this->load->view('layout/sidebar'); ?>

      <!-- Main Content -->
      <div id="content">

    <?php $this->load->view('layout/navbar'); ?>    

        <!-- Begin Page Content -->
        <div class="container-fluid">  

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('modulo'); ?>">Forma Pagamento</a></li>
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
              <form method="post" name="form_edit">
                  <p><strong><i class="fas fa-clock"></i>&nbsp; Última atualização: </strong><?php echo formata_data_banco_com_hora($forma_pagamento->forma_pagamento_data_alteracao) ?></p>

                <fieldset class="mt-4 border p-2">
                  <legend class="" style="font-size:17px"><i class="fas fa-cash-register"></i>&nbsp; Dados forma de pagamento </legend>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label>Forma Pagamento</label>
                          <input type="text" class="form-control" name="forma_pagamento_nome"  placeholder="Nome Forma pagamento" value="<?php echo $forma_pagamento->forma_pagamento_nome; ?>">
                          <?php echo form_error('forma_pagamento_nome', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>                    
                        <div class="col-md-3">
                            <label>Forma Pgto Ativa</label>
                            <select class="form-control" name="forma_pagamento_ativa">
                              <option value="0" <?php echo ($forma_pagamento->forma_pagamento_ativa == 0) ? 'selected' : ''; ?>>Não</option>
                              <option value="1" <?php echo ($forma_pagamento->forma_pagamento_ativa == 1) ? 'selected' : ''; ?>>Sim</option>
                          </select>
                        </div>
                        <div class="col-md-3">
                            <label>Aceita Parcelamento</label>
                            <select class="form-control" name="forma_pagamento_aceita_parc">
                              <option value="0" <?php echo ($forma_pagamento->forma_pagamento_aceita_parc == 0) ? 'selected' : ''; ?>>Não</option>
                              <option value="1" <?php echo ($forma_pagamento->forma_pagamento_aceita_parc == 1) ? 'selected' : ''; ?>>Sim</option>
                          </select>
                        </div>                          
                      </div>                   
                    </fieldset><br>


          
                  <input type="hidden" name="forma_pagamento_id" value="<?php echo $forma_pagamento->forma_pagamento_id; ?>">

                  <button type="submit" class="btn btn-success"><i class="far fa-save ml-1"></i>&nbsp; Salvar</button>
                <a title="Voltar" href="<?php echo base_url('modulo'); ?>" class="btn btn-primary ml-2"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</a>
            </div>              
          </form>
        </div>
      </div>

    </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

 <!---------- End of Main Content -----

      