

    <?php $this->load->view('layout/sidebar'); ?>

      <!-- Main Content -->
      <div id="content">

    <?php $this->load->view('layout/navbar'); ?>    

        <!-- Begin Page Content -->
        <div class="container-fluid">  

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">

            <?php

                  if ($this->ion_auth->is_admin()) {
                    echo '<li class="breadcrumb-item"><a href="../../usuarios">Usuários</a></li>';
                    echo '<li class="breadcrumb-item active" aria-current="page">'.$titulo.'</li>';
                  
                  } else {
                      echo '<li class="breadcrumb-item"><a href="../../../ordem-servico">Home</a></li>';
                      echo '<li class="breadcrumb-item active" aria-current="page">'.$titulo.'</li>';
                  }

                  ?>
              
              
            </ol>
          </nav>
 
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <form method="post" name="form_edit">
                <div class="form-group row">
                  <div class="col-md-4">
                    <label>Nome</label>
                    <input type="text" class="form-control" name="first_name"  placeholder="Nome" value="<?php echo $usuario->first_name; ?>">
                    <?php echo form_error('first_name', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                  <div class="col-md-4">
                    <label>Sobrenome</label>
                    <input type="text" class="form-control" name="last_name"  placeholder="Sobrenome" value="<?php echo $usuario->last_name; ?>">
                    <?php echo form_error('last_name', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                  <div class="col-md-4">
                    <label>E-mail</label>
                    <input type="email" class="form-control" name="email"  placeholder="E-mail" value="<?php echo $usuario->email; ?>">
                    <?php echo form_error('email', '<small class="form-text text-danger">', '</small>'); ?>
                  </div>
                </div>
                  <div class="form-group row">
                    <div class="col-md-3">
                      <label>Nome Usuário</label>
                      <input type="text" class="form-control" name="username"  placeholder="Usuário" value="<?php echo $usuario->username; ?>">
                      <?php echo form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
                    </div>
                    <div class="col-md-3">
                      <label>Telefone</label>
                      <input type="text" class="form-control" name="phone" id="phone" placeholder="Telefone" value="<?php echo $usuario->phone; ?>">
                      <?php echo form_error('phone', '<small class="form-text text-danger">', '</small>'); ?>
                    </div>

                        <div class="col-md-3">
                          <label>Ativo</label>
                            <select class="form-control" name="active" <?php echo (!$this->ion_auth->is_admin() ? 'disabled' : '') ?>>
                              <option value="0" <?php echo ($usuario->active == 0) ? 'selected' : ''; ?>>Não</option>
                              <option value="1" <?php echo ($usuario->active == 1) ? 'selected' : ''; ?>>Sim</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                          <label>Perfil de Acesso</label>
                            <select class="form-control" name="perfil_usuario" <?php echo (!$this->ion_auth->is_admin() ? 'disabled' : '') ?>>
                              <option value="2" <?php echo ($perfil_usuario->id == 2) ? 'selected' : ''; ?>>Vendedor</option>
                              <option value="1" <?php echo ($perfil_usuario->id == 1) ? 'selected' : ''; ?>>Administrador</option>
                            </select>
                        </div>
                                          
                      </div>
                  <fieldset class="mt-4 border p-2">
                    <legend class="" style="font-size:13px"><i class="fas fa-key"></i>&nbsp; Alterar Senha</legend>
                      <div class="form-group row">
                      <div class="col-md-6">
                        <label>Nova Senha</label>
                        <input type="password" class="form-control" name="password" placeholder="Nova Senha" value="">
                        <?php echo form_error('password', '<small class="form-text text-danger">', '</small>'); ?>
                      </div>
                      <div class="col-md-6">
                        <label>Confirmar Senha</label>
                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirmar senha" value="">
                        <?php echo form_error('confirm_password', '<small class="form-text text-danger">', '</small>'); ?>
                      </div>

                      <input type="hidden" name="usuario_id" value="<?php echo $usuario->id; ?>">

                      </div>
                  </fieldset><br>   
                
                <button type="submit" class="btn btn-success"><i class="far fa-save ml-1"></i>&nbsp; Salvar</button>
                
                <?php if ($this->ion_auth->is_admin()): ?>
                  <a title="Voltar" href="<?php echo base_url('usuarios'); ?>" class="btn btn-primary ml-2"><i class="fas fa-arrow-left"></i>&nbsp; Voltar</a>
                <?php endif; ?>

              </form>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      