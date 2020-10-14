

    <?php $this->load->view('layout/sidebar'); ?>

      <!-- Main Content -->
      <div id="content">

    <?php $this->load->view('layout/navbar'); ?>    

        <!-- Begin Page Content -->
        <div class="container-fluid">  

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('categoria'); ?>">Categoria</a></li>
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
                  <p><strong><i class="fas fa-clock"></i>&nbsp; Última atualização: </strong><?php echo formata_data_banco_com_hora($categoria->categoria_data_alteracao) ?></p>

                <fieldset class="mt-4 border p-2">
                  <legend class="" style="font-size:17px"><i class="fab fa-adn"></i>&nbsp; categoria </legend>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label>Categoria</label>
                          <input type="text" class="form-control" name="categoria_nome"  placeholder="Nome categoria" value="<?php echo $categoria->categoria_nome; ?>">
                          <?php echo form_error('categoria_nome', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>                    
                        <div class="col-md-6">
                            <label>Categoria Ativa</label>
                            <select class="form-control" name="categoria_ativa">
                              <option value="0" <?php echo ($categoria->categoria_ativa == 0) ? 'selected' : ''; ?>>Não</option>
                              <option value="1" <?php echo ($categoria->categoria_ativa == 1) ? 'selected' : ''; ?>>Sim</option>
                          </select>
                        </div>                          
                      </div>                   
                    </fieldset><br>
          
                  <input type="hidden" name="categoria_id" value="<?php echo $categoria->categoria_id; ?>">

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

      