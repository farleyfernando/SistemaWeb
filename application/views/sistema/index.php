

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
                <div class="form-group row mb-4">
                  <div class="col-md-3">
                    <label>Razão Social</label>
                    <input type="text" class="form-control" name="sistema_razao_social"  placeholder="Razão Social" value="<?php echo $sistema->sistema_razao_social; ?>">
                    <?php echo form_error('sistema_razao_social', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                  <div class="col-md-3">
                    <label>Nome Fantasia</label>
                    <input type="text" class="form-control" name="sistema_nome_fantasia"  placeholder="Nome Fantasia" value="<?php echo $sistema->sistema_nome_fantasia; ?>">
                    <?php echo form_error('sistema_nome_fantasia', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                  <div class="col-md-3">
                    <label>CNPJ</label>
                    <input type="text" class="form-control cnpj" name="sistema_cnpj"  placeholder="Cnpj" value="<?php echo $sistema->sistema_cnpj; ?>">
                    <?php echo form_error('sistema_cnpj', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                  <div class="col-md-3">
                      <label>Inscrição Estadual</label>
                      <input type="text" class="form-control" name="sistema_ie"  placeholder="Insc. Est" value="<?php echo $sistema->sistema_ie; ?>">
                      <?php echo form_error('sistema_ie', '<small class="form-text text-danger">', '</small>'); ?>
                    </div>
                </div>
                  <div class="form-group row mb-4">
                    <div class="col-md-3">
                      <label>Telefone Fixo</label>
                      <input type="text" class="form-control sp_celphones" name="sistema_telefone_fixo" id="tel-fixo" placeholder="Telefone" value="<?php echo $sistema->sistema_telefone_fixo; ?>">
                      <?php echo form_error('sistema_telefone_fixo', '<small class="form-text text-danger">', '</small>'); ?>
                    </div> 
                    <div class="col-md-3">
                      <label>Tel. Celular</label>
                      <input type="text" class="form-control sp_celphones" name="sistema_telefone_movel" id="tel-movel" placeholder="Celular" value="<?php echo $sistema->sistema_telefone_movel; ?>">
                      <?php echo form_error('sistema_telefone_movel', '<small class="form-text text-danger">', '</small>'); ?>
                    </div>
                    <div class="col-md-3">
                      <label>E-mail</label>
                      <input type="email" class="form-control" name="sistema_email" placeholder="E-mail" value="<?php echo $sistema->sistema_email; ?>">
                      <?php echo form_error('sistema_email', '<small class="form-text text-danger">', '</small>'); ?>
                    </div> 
                    <div class="col-md-3">
                      <label>Site</label>
                      <input type="text" class="form-control" name="sistema_site_url"  placeholder="Site" value="<?php echo $sistema->sistema_site_url; ?>">
                      <?php echo form_error('sistema_site_url', '<small class="form-text text-danger">', '</small>'); ?>
                    </div>                   
                  </div>
                <div class="form-group row mb-4">
                  <div class="col-md-2">
                    <label>CEP</label>
                    <input type="text" class="form-control cep" name="sistema_cep" placeholder="Cep" value="<?php echo $sistema->sistema_cep; ?>">
                    <?php echo form_error('sistema_cep', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                  <div class="col-md-3">
                    <label>Endereço</label>
                    <input type="text" class="form-control" name="sistema_endereco" placeholder="Endereço" value="<?php echo $sistema->sistema_endereco; ?>">
                    <?php echo form_error('sistema_endereco', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                  <div class="col-md-1">
                    <label>Numero</label>
                    <input type="text" class="form-control" name="sistema_numero" placeholder="N°" value="<?php echo $sistema->sistema_numero; ?>">
                    <?php echo form_error('sistema_numero', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                  <div class="col-md-3">
                    <label>Cidade</label>
                    <input type="text" class="form-control" name="sistema_cidade" placeholder="Cidade" value="<?php echo $sistema->sistema_cidade; ?>">
                    <?php echo form_error('sistema_cidade', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                  <div class="col-md-3">
                    <label>Estado</label>
                    <input type="text" class="form-control uf" name="sistema_estado" placeholder="UF" value="<?php echo $sistema->sistema_estado; ?>">
                    <?php echo form_error('sistema_estado', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                </div>
              <div class="row mb-4">
                <div class="col-12">
                  <label>Obs. ordem de serviço e vendas</label>
                    <textarea class="form-control" name="sistema_txt_ordem_servico" style="max-height: 60px;min-width: 100%" placeholder="Observaçoes"><?php echo $sistema->sistema_txt_ordem_servico; ?></textarea>
                    <?php echo form_error('sistema_txt_ordem_servico', '<small class="form-text text-danger">', '</small>'); ?>
                </div>
              </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
              </form>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

 <!---------- End of Main Content -----

      