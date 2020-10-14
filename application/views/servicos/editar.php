

    <?php $this->load->view('layout/sidebar'); ?>

      <!-- Main Content -->
      <div id="content">

    <?php $this->load->view('layout/navbar'); ?>    

        <!-- Begin Page Content -->
        <div class="container-fluid">  

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('servicos'); ?>">Serviços</a></li>
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
                  <p><strong><i class="fas fa-clock"></i>&nbsp; Última atualização: </strong><?php echo formata_data_banco_com_hora($servico->servico_data_alteracao) ?></p>

                <fieldset class="mt-4 border p-2">
                  <legend class="" style="font-size:17px"><i class="fas fa-tools"></i>&nbsp; Dados do Serviço</legend>
                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Nome do Serviço</label>
                          <input type="text" class="form-control" name="servico_nome"  placeholder="Nome serviço" value="<?php echo $servico->servico_nome; ?>">
                          <?php echo form_error('servico_nome', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-4">
                          <label>Valor do Serviço</label>
                            <input type="text" class="form-control money" name="servico_preco" placeholder="Valor" value="<?php echo $servico->servico_preco; ?>">
                            <?php echo form_error('servico_preco', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>                     
                        <div class="col-md-4">
                            <label>Serviço Ativo</label>
                            <select class="form-control" name="servico_ativo">
                              <option value="0" <?php echo ($servico->servico_ativo == 0) ? 'selected' : ''; ?>>Não</option>
                              <option value="1" <?php echo ($servico->servico_ativo == 1) ? 'selected' : ''; ?>>Sim</option>
                          </select>
                        </div>                          
                      </div>
                      <div class="form-group row">
                        <div class="col-md-12">
                            <label>Descriçao do Serviço</label>
                            <textarea type="text" class="form-control" name="servico_descricao" style="max-height: 100px;min-width: 100px" placeholder="Descrição"><?php echo $servico->servico_descricao; ?></textarea>
                            <?php echo form_error('servico_descricao', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                      </div>                   
                    </fieldset><br>
          
                  <input type="hidden" name="servico_id" value="<?php echo $servico->servico_id; ?>">

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

      