

    <?php $this->load->view('layout/sidebar'); ?>

      <!-- Main Content -->
      <div id="content">

    <?php $this->load->view('layout/navbar'); ?>    

        <!-- Begin Page Content -->
        <div class="container-fluid">  

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('vendedores'); ?>">Vendedor</a></li>
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
                <fieldset class="mt-4 border p-2">
                  <legend class="" style="font-size:17px"><i class="fas fa-user-secret"></i>&nbsp; Dados Vendedor</legend>
                      <div class="form-group row">
                        <div class="col-md-4">
                          <label>Nome Completo</label>
                          <input type="text" class="form-control" name="vendedor_nome_completo"  placeholder="Nome completo" value="<?php echo set_value('vendedor_nome_completo'); ?>">
                          <?php echo form_error('vendedor_nome_completo', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-3">
                            <label>CPF</label>
                            <input type="text" class="form-control cpf" name="vendedor_cpf" placeholder="CPF" value="<?php echo set_value('vendedor_cpf'); ?>">
                            <?php echo form_error('vendedor_cpf', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>
                          <div class="col-md-3">
                          <label>RG</label>
                            <input type="text" class="form-control rg" name="vendedor_rg" placeholder="RG" value="<?php echo set_value('vendedor_rg'); ?>">
                            <?php echo form_error('vendedor_rg', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>
                          <div class="col-md-2">
                            <label>Data Nascimento</label>
                            <input type="date" class="form-control" name="vendedor_dn" placeholder="Data Nasc." value="">
                            <?php echo form_error('vendedor_dn', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-md-4">
                            <label>Telefone</label>
                            <input type="text" class="form-control phone_with_ddd" name="vendedor_telefone" placeholder="Tel. fixo" value="<?php echo set_value('vendedor_telefone'); ?>">
                            <?php echo form_error('vendedor_telefone', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>
                          <div class="col-md-4">
                              <label>Celular</label>
                              <input type="text" class="form-control sp_celphones" name="vendedor_celular" placeholder="Celular" value="<?php echo set_value('vendedor_celular'); ?>">
                              <?php echo form_error('vendedor_celular', '<small class="form-text text-danger">', '</small>'); ?>
                            </div> 
                            <div class="col-md-4">
                            <label>Email</label>
                              <input type="text" class="form-control" name="vendedor_email" placeholder="Email" value="<?php echo set_value('vendedor_email'); ?>">
                              <?php echo form_error('vendedor_email', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>
                      </div>                      
                    </fieldset>

                    <fieldset class="mt-4 border p-2">
                      <legend class="" style="font-size:17px"><i class="fas fa-map-marker-alt"></i>&nbsp; Dados Endereço</legend>
                      <div class="form-group row">
                        <div class="col-md-2">
                          <label>CEP</label>
                          <input type="text" class="form-control cep" name="vendedor_cep" placeholder="Cep" value="<?php echo set_value('vendedor_cep'); ?>" onblur="pesquisacep(this.value);">
                          <?php echo form_error('vendedor_cep', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-5">
                          <label>Endereço</label>
                          <input type="text" class="form-control" id="end" name="vendedor_endereco" placeholder="Endereço" value="<?php echo set_value('vendedor_endereco'); ?>">
                          <?php echo form_error('vendedor_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-2">
                          <label>Número</label>
                          <input type="text" class="form-control" name="vendedor_numero_endereco" placeholder="Número" value="<?php echo set_value('vendedor_numero_endereco'); ?>">
                          <?php echo form_error('vendedor_numero_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-3">
                          <label>Bairro</label>
                          <input type="text" class="form-control" id="bairro" name="vendedor_bairro" placeholder="Bairro" value="<?php echo set_value('vendedor_bairro'); ?>">
                          <?php echo form_error('vendedor_bairro', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        
                      </div>
                    <div class="row mb-4">
                        <div class="col-md-4">
                          <label>Complemento</label>
                          <input type="text" class="form-control" name="vendedor_complemento" placeholder="Complemento" value="<?php echo set_value('vendedor_complemento'); ?>">
                          <?php echo form_error('vendedor_complemento', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                      <div class="col-md-6">
                          <label>Cidade</label>
                          <input type="text" class="form-control"  id="cidade" name="vendedor_cidade" placeholder="Cidade" value="<?php echo set_value('vendedor_cidade'); ?>" readonly>
                          <?php echo form_error('vendedor_cidade', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-2">
                          <label>Esatdo</label>
                          <input type="text" class="form-control uf" id="uf" name="vendedor_estado" placeholder="UF" value="<?php echo set_value('vendedor_estado'); ?>" readonly="">
                          <?php echo form_error('vendedor_estado', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                    </div>
                  </fieldset>
              <fieldset class="mt-4 border p-2">
                  <legend class="" style="font-size:17px"><i class="fas fa-tools"></i>&nbsp; Configurações</legend>
                  <div class="form-group row">
                    <div class="col-md-4">
                        <label>Cliente Ativo</label>
                          <select class="form-control" name="vendedor_ativo">
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                          </select>
                      </div>
                      <div class="col-md-4">
                          <label>Matrícula</label>
                          <input type="text" class="form-control" name="vendedor_codigo" placeholder="Código" value="<?php echo $vendedor_codigo; ?>" readonly="" >
                      </div>
                      <div class="col-md-4">
                          <label>Obs</label>
                          <input type="text" class="form-control" name="vendedor_obs" placeholder="Observações" value="<?php echo set_value('vendedor_obs'); ?>">
                          <?php echo form_error('vendedor_obs', '<small class="form-text text-danger">', '</small>'); ?>
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

      