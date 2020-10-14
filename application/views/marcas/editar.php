

    <?php $this->load->view('layout/sidebar'); ?>

      <!-- Main Content -->
      <div id="content">

    <?php $this->load->view('layout/navbar'); ?>    

        <!-- Begin Page Content -->
        <div class="container-fluid">  

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('marcas'); ?>">Marcas</a></li>
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
                  <p><strong><i class="fas fa-clock"></i>&nbsp; Última atualização: </strong><?php echo formata_data_banco_com_hora($marca->marca_data_alteracao) ?></p>

                <fieldset class="mt-4 border p-2">
                  <legend class="" style="font-size:17px"><i class="fab fa-adn"></i>&nbsp; Marca </legend>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label>Marca</label>
                          <input type="text" class="form-control" name="marca_nome"  placeholder="Nome marca" value="<?php echo $marca->marca_nome; ?>">
                          <?php echo form_error('marca_nome', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>                    
                        <div class="col-md-6">
                            <label>Marca Ativa</label>
                            <select class="form-control" name="marca_ativa">
                              <option value="0" <?php echo ($marca->marca_ativa == 0) ? 'selected' : ''; ?>>Não</option>
                              <option value="1" <?php echo ($marca->marca_ativa == 1) ? 'selected' : ''; ?>>Sim</option>
                          </select>
                        </div>                          
                      </div>                   
                    </fieldset><br>
          
                  <input type="hidden" name="marca_id" value="<?php echo $marca->marca_id; ?>">

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

      