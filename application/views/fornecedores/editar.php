

    <?php $this->load->view('layout/sidebar'); ?>

      <!-- Main Content -->
      <div id="content">

    <?php $this->load->view('layout/navbar'); ?>    

        <!-- Begin Page Content -->
        <div class="container-fluid">  

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('fornecedores'); ?>">Fornecedor</a></li>
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
                  <p><strong><i class="fas fa-clock"></i>&nbsp; Última atualização: </strong><?php echo formata_data_banco_com_hora($fornecedor->fornecedor_data_alteracao) ?></p>

                <fieldset class="mt-4 border p-2">
                  <legend class="" style="font-size:17px"><i class="fas fa-user-tag"></i>&nbsp; Dados Fornecedor</legend>
                      <div class="form-group row">
                        <div class="col-md-6">
                          <label>Razão Social</label>
                          <input type="text" class="form-control" name="fornecedor_razao"  placeholder="Razão Social" value="<?php echo $fornecedor->fornecedor_razao; ?>">
                          <?php echo form_error('fornecedor_razao', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                          <label>Nome Fantasia</label>
                          <input type="text" class="form-control" name="fornecedor_nome_fantasia"  placeholder="Nome Fantasia" value="<?php echo $fornecedor->fornecedor_nome_fantasia; ?>">
                          <?php echo form_error('fornecedor_nome_fantasia', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-md-4">
                            <label>CNPJ</label>
                            <input type="text" class="form-control" name="fornecedor_cnpj" placeholder="CNPJ" value="<?php echo $fornecedor->fornecedor_cnpj; ?>">
                            <?php echo form_error('fornecedor_cnpj', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>
                          <div class="col-md-4">
                          <label>Inscrição Estadual</label>
                            <input type="text" class="form-control" name="fornecedor_ie" placeholder="Insc. Est." value="<?php echo $fornecedor->fornecedor_ie; ?>">
                            <?php echo form_error('fornecedor_ie', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>
                          <div class="col-md-4">
                            <label>Telefone</label>
                            <input type="text" class="form-control phone_with_ddd" name="fornecedor_telefone" placeholder="Tel. fixo" value="<?php echo $fornecedor->fornecedor_telefone; ?>">
                            <?php echo form_error('fornecedor_telefone', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>
                      </div>                      
                        <div class="form-group row">
                          <div class="col-md-4">
                              <label>Celular</label>
                              <input type="text" class="form-control sp_celphones" name="fornecedor_celular" placeholder="Celular" value="<?php echo $fornecedor->fornecedor_celular; ?>">
                              <?php echo form_error('fornecedor_celular', '<small class="form-text text-danger">', '</small>'); ?>
                            </div> 
                          <div class="col-md-4">
                            <label>Nome Contato</label>
                              <input type="text" class="form-control" name="fornecedor_contato" placeholder="Nome" value="<?php echo $fornecedor->fornecedor_contato; ?>">
                              <?php echo form_error('fornecedor_contato', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>
                          <div class="col-md-4">
                            <label>Email</label>
                              <input type="text" class="form-control" name="fornecedor_email" placeholder="Email" value="<?php echo $fornecedor->fornecedor_email; ?>">
                              <?php echo form_error('fornecedor_email', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>
                        </div>
                    </fieldset>

                    <fieldset class="mt-4 border p-2">
                      <legend class="" style="font-size:17px"><i class="fas fa-map-marker-alt"></i>&nbsp; Dados Endereço</legend>
                      <div class="form-group row">
                        <div class="col-md-2">
                          <label>CEP</label>
                          <input type="text" class="form-control cep" name="fornecedor_cep" placeholder="Cep" value="<?php echo $fornecedor->fornecedor_cep; ?>">
                          <?php echo form_error('fornecedor_cep', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-5">
                          <label>Endereço</label>
                          <input type="text" class="form-control" name="fornecedor_endereco" placeholder="Endereço" value="<?php echo $fornecedor->fornecedor_endereco; ?>">
                          <?php echo form_error('fornecedor_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-2">
                          <label>Número</label>
                          <input type="text" class="form-control" name="fornecedor_numero_endereco" placeholder="Número" value="<?php echo $fornecedor->fornecedor_numero_endereco; ?>">
                          <?php echo form_error('fornecedor_numero_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-3">
                          <label>Bairro</label>
                          <input type="text" class="form-control" name="fornecedor_bairro" placeholder="Bairro" value="<?php echo $fornecedor->fornecedor_bairro; ?>">
                          <?php echo form_error('fornecedor_bairro', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        
                      </div>
                    <div class="row mb-4">
                        <div class="col-md-4">
                          <label>Complemento</label>
                          <input type="text" class="form-control" name="fornecedor_complemento" placeholder="Complemento" value="<?php echo $fornecedor->fornecedor_complemento; ?>">
                          <?php echo form_error('fornecedor_complemento', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                      <div class="col-md-6">
                          <label>Cidade</label>
                          <input type="text" class="form-control" name="fornecedor_cidade" placeholder="Cidade" value="<?php echo $fornecedor->fornecedor_cidade; ?>">
                          <?php echo form_error('fornecedor_cidade', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-2">
                          <label>Esatdo</label>
                          <input type="text" class="form-control uf" name="fornecedor_estado" placeholder="UF" value="<?php echo $fornecedor->fornecedor_estado; ?>">
                          <?php echo form_error('fornecedor_estado', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                    </div>
                  </fieldset>
              <fieldset class="mt-4 border p-2">
                  <legend class="" style="font-size:17px"><i class="fas fa-tools"></i>&nbsp; Configurações</legend>
                  <div class="form-group row">
                    <div class="col-md-2">
                        <label>Fornecedor Ativo</label>
                          <select class="form-control" name="fornecedor_ativo">
                            <option value="0" <?php echo ($fornecedor->fornecedor_ativo == 0) ? 'selected' : ''; ?>>Não</option>
                            <option value="1" <?php echo ($fornecedor->fornecedor_ativo == 1) ? 'selected' : ''; ?>>Sim</option>
                          </select>
                      </div>
                      <div class="col-md-10">
                          <label>Obs</label>
                          <input type="text" class="form-control" name="fornecedor_obs" placeholder="Observações" value="<?php echo $fornecedor->fornecedor_obs; ?>">
                          <?php echo form_error('fornecedor_obs', '<small class="form-text text-danger">', '</small>'); ?>
                      </div>
                  </div>
              </fieldset><br> 
              
                  
                  <input type="hidden" name="fornecedor_id" value="<?php echo $fornecedor->fornecedor_id; ?>">

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

      