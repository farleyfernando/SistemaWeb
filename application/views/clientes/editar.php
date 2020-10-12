

    <?php $this->load->view('layout/sidebar'); ?>

      <!-- Main Content -->
      <div id="content">

    <?php $this->load->view('layout/navbar'); ?>    

        <!-- Begin Page Content -->
        <div class="container-fluid">  

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('clientes'); ?>">Clientes</a></li>
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
                  <p><strong><i class="fas fa-clock"></i>&nbsp; Última atualização: </strong><?php echo formata_data_banco_com_hora($cliente->cliente_data_alteracao) ?></p>

                <fieldset class="mt-4 border p-2">
                  <legend class="" style="font-size:17px"><i class="fas fa-user-tie"></i>&nbsp; Dados Pessoais</legend>
                      <div class="form-group row">
                        <div class="col-md-3">
                          <label>Nome</label>
                          <input type="text" class="form-control" name="cliente_nome"  placeholder="Nome" value="<?php echo $cliente->cliente_nome; ?>">
                          <?php echo form_error('cliente_nome', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-4">
                          <label>Sobrenome</label>
                          <input type="text" class="form-control" name="cliente_sobrenome"  placeholder="Sobrenome" value="<?php echo $cliente->cliente_sobrenome; ?>">
                          <?php echo form_error('cliente_sobrenome', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-2">
                            <label>Data Nasc.</label>
                            <input type="date" class="form-control" name="cliente_data_nascimento" value="<?php echo $cliente->cliente_data_nascimento; ?>">
                            <?php echo form_error('cliente_data_nascimento', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>
                          <div class="col-md-3">
                            <?php if($cliente->cliente_tipo == 1): ?>
                              <label>CPF</label>
                                <input type="text" class="form-control cpf" name="cliente_cpf" placeholder="<?php echo ($cliente->cliente_tipo == 1 ? 'CPF':'CNPJ') ?>" value="<?php echo $cliente->cliente_cpf_cnpj; ?>">

                                <?php echo form_error('cliente_cpf', '<small class="form-text text-danger">', '</small>'); ?>
                            <?php else: ?>
                              <label>CNPJ</label>
                              <input type="text" class="form-control cnpj" name="cliente_cnpj" placeholder="<?php echo ($cliente->cliente_tipo == 1 ? 'CPF':'CNPJ') ?>" value="<?php echo $cliente->cliente_cpf_cnpj; ?>">

                              <?php echo form_error('cliente_cnpj', '<small class="form-text text-danger">', '</small>'); ?>
                              <?php endif; ?>         
                          </div>
                      </div>
                        <div class="form-group row">
                          <div class="col-md-3">
                            <?php if($cliente->cliente_tipo == 1): ?>
                              <label>RG</label>
                            <?php else: ?>
                              <label>Insc. Est.</label>
                              <?php endif; ?>  
                              
                            <input type="text" class="form-control" name="cliente_rg_ie" placeholder="<?php echo ($cliente->cliente_tipo == 1 ? 'RG':'Insc. Est.') ?>" value="<?php echo $cliente->cliente_rg_ie; ?>">

                            <?php echo form_error('cliente_rg_ie', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>
                          <div class="col-md-3">
                            <label>E-mail</label>
                            <input type="email" class="form-control" name="cliente_email" placeholder="Email" value="<?php echo $cliente->cliente_email; ?>">
                            <?php echo form_error('cliente_email', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>
                          <div class="col-md-3">
                            <label>Telefone</label>
                            <input type="text" class="form-control sp_celphones" name="cliente_telefone" placeholder="Tel. fixo" value="<?php echo $cliente->cliente_telefone; ?>">
                            <?php echo form_error('cliente_telefone', '<small class="form-text text-danger">', '</small>'); ?>
                          </div> 
                          <div class="col-md-3">
                            <label>Celular</label>
                            <input type="text" class="form-control sp_celphones" name="cliente_celular" placeholder="Celular" value="<?php echo $cliente->cliente_celular; ?>">
                            <?php echo form_error('cliente_celular', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>                   
                        </div>
                    </fieldset>

                    <fieldset class="mt-4 border p-2">
                      <legend class="" style="font-size:17px"><i class="fas fa-map-marker-alt"></i>&nbsp; Dados Endereço</legend>
                      <div class="form-group row">
                        <div class="col-md-2">
                          <label>CEP</label>
                          <input type="text" class="form-control cep" name="cliente_cep" placeholder="Cep" value="<?php echo $cliente->cliente_cep; ?>">
                          <?php echo form_error('cliente_cep', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-5">
                          <label>Endereço</label>
                          <input type="text" class="form-control" name="cliente_endereco" placeholder="Endereço" value="<?php echo $cliente->cliente_endereco; ?>">
                          <?php echo form_error('cliente_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-1">
                          <label>Numero</label>
                          <input type="text" class="form-control" name="cliente_numero_endereco" placeholder="N°" value="<?php echo $cliente->cliente_numero_endereco; ?>">
                          <?php echo form_error('cliente_numero_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-4">
                          <label>Bairro</label>
                          <input type="text" class="form-control" name="cliente_bairro" placeholder="Bairro" value="<?php echo $cliente->cliente_bairro; ?>">
                          <?php echo form_error('cliente_bairro', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        
                      </div>
                    <div class="row mb-4">
                        <div class="col-md-5">
                          <label>Complemento</label>
                          <input type="text" class="form-control" name="cliente_complemento" placeholder="Complemento" value="<?php echo $cliente->cliente_complemento; ?>">
                          <?php echo form_error('cliente_complemento', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                      <div class="col-md-6">
                          <label>Cidade</label>
                          <input type="text" class="form-control" name="cliente_cidade" placeholder="Cidade" value="<?php echo $cliente->cliente_cidade; ?>">
                          <?php echo form_error('cliente_cidade', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                        <div class="col-md-1">
                          <label>Esatdo</label>
                          <input type="text" class="form-control uf" name="cliente_estado" placeholder="UF" value="<?php echo $cliente->cliente_estado; ?>">
                          <?php echo form_error('cliente_estado', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>
                    </div>
                  </fieldset>
              <fieldset class="mt-4 border p-2">
                  <legend class="" style="font-size:17px"><i class="fas fa-tools"></i>&nbsp; Configurações</legend>
                  <div class="form-group row">
                    <div class="col-md-2">
                        <label>Cliente Ativo</label>
                          <select class="form-control" name="cliente_ativo">
                            <option value="0" <?php echo ($cliente->cliente_ativo == 0) ? 'selected' : ''; ?>>Não</option>
                            <option value="1" <?php echo ($cliente->cliente_ativo == 1) ? 'selected' : ''; ?>>Sim</option>
                          </select>
                      </div>
                      <div class="col-md-10">
                          <label>Obs</label>
                          <input type="text" class="form-control" name="cliente_obs" placeholder="Observações" value="<?php echo $cliente->cliente_obs; ?>">
                          <?php echo form_error('cliente_obs', '<small class="form-text text-danger">', '</small>'); ?>
                      </div>
                  </div>
              </fieldset><br> 
              
                  <input type="hidden" name="cliente_tipo" value="<?php echo $cliente->cliente_tipo; ?>">
                  <input type="hidden" name="cliente_id" value="<?php echo $cliente->cliente_id; ?>">

                  <button type="submit" class="btn btn-success"><i class="far fa-save ml-1"></i>&nbsp; Salvar</button>
                <a title="Voltar" href="<?php echo base_url('clientes'); ?>" class="btn btn-primary ml-2"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</a>
            </div>              
          </form>
        </div>
      </div>

    </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

 <!---------- End of Main Content -----

      