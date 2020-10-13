

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
        <form method="post" name="form_adicionar">

          <div class="custom-control custom-radio custom-control-inline mt-2">
              <input type="radio" id="pessoa_fisica" name="cliente_tipo" class="custom-control-input" value="1" <?php echo set_checkbox('cliente_tipo', '1') ?> checked="">
              <label class="custom-control-label pt-1" for="pessoa_fisica">Pessoa física</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="pessoa_juridica" name="cliente_tipo" class="custom-control-input" value="2" <?php echo set_checkbox('cliente_tipo', '2') ?> >
              <label class="custom-control-label pt-1" for="pessoa_juridica">Pessoa jurídica</label>
          </div>
          
          <fieldset class="mt-4 border p-2">
            <legend class="" style="font-size:17px"><i class="fas fa-user-tie"></i>&nbsp; Dados Pessoais</legend>
                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="cliente_nome"  placeholder="Nome" value="<?php echo set_value('cliente_nome'); ?>">
                    <?php echo form_error('cliente_nome', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                  <div class="col-md-4">
                    <label>Sobrenome</label>
                    <input type="text" class="form-control" name="cliente_sobrenome"  placeholder="Sobrenome" value="<?php echo set_value('cliente_sobrenome'); ?>">
                    <?php echo form_error('cliente_sobrenome', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                  <div class="col-md-2">
                      <label>Data Nasc.</label>
                      <input type="date" class="form-control" name="cliente_data_nascimento" value="<?php echo set_value('cliente_data_nascimento'); ?>">
                      <?php echo form_error('cliente_data_nascimento', '<small class="form-text text-danger">', '</small>'); ?>
                    </div>
                    <div class="col-md-3">
                        <div class="pessoa_fisica">
                          <label>CPF</label>
                            <input type="text" class="form-control cpf" name="cliente_cpf" placeholder="CPF" value="<?php echo set_value('cliente_cpf'); ?>">
                            <?php echo form_error('cliente_cpf', '<small class="form-text text-danger">', '</small>'); ?>

                        </div>
                        <div class="pessoa_juridica">
                            <label>CNPJ</label>
                            <input type="text" class="form-control cnpj" name="cliente_cnpj" placeholder="CNPJ" value="<?php echo set_value('cliente_cnpj'); ?>">
                            <?php echo form_error('cliente_cnpj', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>   
                    </div>
                </div>
                  <div class="form-group row">
                    <div class="col-md-3">
                        <label class="pessoa_fisica" >RG</label>
                        <label class="pessoa_juridica" >Inscricão Estadual</label>  
                        
                        <input type="text" class="form-control" name="cliente_rg_ie" placeholder="" value="<?php echo set_value('cliente_rg_ie'); ?>">

                        <?php echo form_error('cliente_rg_ie', '<small class="form-text text-danger">', '</small>'); ?>
                    </div>
                    <div class="col-md-3">
                      <label>E-mail</label>
                      <input type="email" class="form-control" name="cliente_email" placeholder="Email" value="<?php echo set_value('cliente_email'); ?>">
                      <?php echo form_error('cliente_email', '<small class="form-text text-danger">', '</small>'); ?>
                    </div>
                    <div class="col-md-3">
                      <label>Telefone</label>
                      <input type="text" class="form-control sp_celphones" name="cliente_telefone" placeholder="Tel. fixo" value="<?php echo set_value('cliente_telefone'); ?>">
                      <?php echo form_error('cliente_telefone', '<small class="form-text text-danger">', '</small>'); ?>
                    </div> 
                    <div class="col-md-3">
                      <label>Celular</label>
                      <input type="text" class="form-control sp_celphones" name="cliente_celular" placeholder="Celular" value="<?php echo set_value('cliente_celular'); ?>">
                      <?php echo form_error('cliente_celular', '<small class="form-text text-danger">', '</small>'); ?>
                    </div>                   
                  </div>
              </fieldset>

              <fieldset class="mt-4 border p-2">
                <legend class="" style="font-size:17px"><i class="fas fa-map-marker-alt"></i>&nbsp; Dados Endereço</legend>
                <div class="form-group row">
                  <div class="col-md-2">
                    <label>CEP</label>
                    <input type="text" class="form-control cep" name="cliente_cep" placeholder="Cep" value="<?php echo set_value('cliente_cep'); ?>" onblur="pesquisacep(this.value);">
                    <?php echo form_error('cliente_cep', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                  <div class="col-md-5">
                    <label>Endereço</label>
                    <input type="text" class="form-control" name="cliente_endereco" placeholder="Endereço" value="<?php echo set_value('cliente_endereco'); ?>" id="end">
                    <?php echo form_error('cliente_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                  <div class="col-md-1">
                    <label>Numero</label>
                    <input type="text" class="form-control" name="cliente_numero_endereco" placeholder="N°" value="<?php echo set_value('cliente_numero_endereco'); ?>">
                    <?php echo form_error('cliente_numero_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                  <div class="col-md-4">
                    <label>Bairro</label>
                    <input type="text" class="form-control" name="cliente_bairro" id="bairro" placeholder="Bairro" value="<?php echo set_value('cliente_bairro'); ?>">
                    <?php echo form_error('cliente_bairro', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                  
                </div>
              <div class="row mb-4">
                  <div class="col-md-5">
                    <label>Complemento</label>
                    <input type="text" class="form-control" name="cliente_complemento" placeholder="Complemento" value="<?php echo set_value('cliente_complemento'); ?>">
                    <?php echo form_error('cliente_complemento', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                <div class="col-md-6">
                    <label>Cidade</label>
                    <input type="text" class="form-control" name="cliente_cidade" id="cidade" placeholder="Cidade" value="<?php echo set_value('cliente_cidade'); ?>">
                    <?php echo form_error('cliente_cidade', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                  <div class="col-md-1">
                    <label>Esatdo</label>
                    <input type="text" class="form-control uf" name="cliente_estado" id="uf" placeholder="UF" value="<?php echo set_value('cliente_estado'); ?>">
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
                      <option value="0">Não</option>
                      <option value="1">Sim</option>
                    </select>
                </div>
                <div class="col-md-10">
                    <label>Obs</label>
                    <input type="text" class="form-control" name="cliente_obs" placeholder="Observações" value="<?php echo set_value('cliente_obs'); ?>">
                    <?php echo form_error('cliente_obs', '<small class="form-text text-danger">', '</small>'); ?>
                </div>
            </div>
        </fieldset><br> 
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

