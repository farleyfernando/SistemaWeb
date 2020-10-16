

    <?php $this->load->view('layout/sidebar'); ?>

      <!-- Main Content -->
      <div id="content">

    <?php $this->load->view('layout/navbar'); ?>    

        <!-- Begin Page Content -->
        <div class="container-fluid">  

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url('produtos'); ?>">Produtos</a></li>
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
                  <p><strong><i class="fas fa-clock"></i>&nbsp; Última atualização: </strong><?php echo formata_data_banco_com_hora($produto->produto_data_alteracao) ?></p>

                <fieldset class="mt-4 border p-2">
                  <legend class="" style="font-size:17px"><i class="fab fa-product-hunt"></i>&nbsp; Dados Principais</legend>
                      <div class="form-group row">
                        <div class="col-md-2">
                          <label>Código do Produto</label>
                          <input type="text" class="form-control" name="produto_codigo"  placeholder="" readonly="" value="<?php echo $produto->produto_codigo; ?>">                         
                        </div>
                        <div class="col-md-10">
                          <label>Descrição do Produto</label>
                            <input type="text" class="form-control" name="produto_descricao" placeholder="Desc. Produto" value="<?php echo $produto->produto_descricao; ?>">
                            <?php echo form_error('produto_descricao', '<small class="form-text text-danger">', '</small>'); ?>
                        </div>                                              
                      </div>
                      <div class="form-group row">
                        <div class="col-md-3">
                          <label>Marca</label>
                            <select class="form-control" name="produto_marca_id">
                            <?php foreach ($marcas as $marca): ?>
                              <option value="<?php echo $marca->marca_id ?>" <?php echo ($marca->marca_id == $produto->produto_marca_id ? 'selected':'') ?> <?php echo ($marca->marca_ativa == 0 ? 'disabled' : '')?>><?php echo ($marca->marca_ativa == 0 ? $marca->marca_nome.'&nbsp; ->&nbsp;Inativa': $marca->marca_nome) ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="col-md-3">
                          <label>Categoria</label>
                          <select class="form-control" name="produto_categoria_id">
                            <?php foreach ($categorias as $categoria): ?>
                              <option value="<?php echo $categoria->categoria_id ?>" <?php echo ($categoria->categoria_id == $produto->produto_categoria_id ? 'selected':'') ?>><?php echo $categoria->categoria_nome ?></option>
                            <?php endforeach; ?>
                          </select>
                                                 
                        </div>
                        <div class="col-md-3">
                        <label>Forncedor</label>
                        <select class="form-control" name="produto_fornecedor_id">
                            <?php foreach ($fornecedores as $fornecedor): ?>
                              <option value="<?php echo $fornecedor->fornecedor_id ?>" <?php echo ($fornecedor->fornecedor_id == $produto->produto_fornecedor_id ? 'selected':'') ?>><?php echo $fornecedor->fornecedor_nome_fantasia ?></option>
                            <?php endforeach; ?>
                          </select>
                                                  
                        </div> 
                        <div class="col-md-3">
                          <label>Unidade de Medida</label>
                          <input type="text" class="form-control" name="produto_unidade"  placeholder="UN" value="<?php echo $produto->produto_unidade; ?>">
                          <?php echo form_error('produto_unidade', '<small class="form-text text-danger">', '</small>'); ?>                         
                        </div>                                             
                      </div>                  
                    </fieldset>

                    <fieldset class="mt-4 border p-2">
                      <legend class="" style="font-size:17px"><i class="fas fa-funnel-dollar"></i>&nbsp; Precificação e Estoque</legend>
                        <div class="form-group row">
                          <div class="col-md-3">
                            <label>Preço de Custo</label>
                              <input type="text" class="form-control money" name="produto_preco_custo" placeholder="Preço custo" value="<?php echo $produto->produto_preco_custo; ?>">
                              <?php echo form_error('produto_preco_custo', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>
                          <div class="col-md-3">
                            <label>Preço de Venda</label>
                              <input type="text" class="form-control money" name="produto_preco_venda" placeholder="Preço venda" value="<?php echo $produto->produto_preco_venda; ?>">
                              <?php echo form_error('produto_preco_venda', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>
                          <div class="col-md-3">
                            <label>Estoque Minimo</label>
                              <input type="text" class="form-control" name="produto_estoque_minimo" placeholder="Estoque minino" value="<?php echo $produto->produto_estoque_minimo; ?>">
                              <?php echo form_error('produto_estoque_minimo', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>
                          <div class="col-md-3">
                            <label>Quantidade Estoque</label>
                              <input type="text" class="form-control" name="produto_qtde_estoque" placeholder="Qtde estoque" value="<?php echo $produto->produto_qtde_estoque; ?>">
                              <?php echo form_error('produto_qtde_estoque', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>                                              
                        </div>
                    </fieldset>

                    <fieldset class="mt-4 border p-2">
                      <legend class="" style="font-size:17px"><i class="fas fa-cogs"></i>&nbsp; Configurações</legend>
                        <div class="form-group row">
                        <div class="col-md-3">
                          <label>Produto Ativo</label>
                            <select class="form-control" name="produto_ativo">
                              <option value="0" <?php echo ($produto->produto_ativo == 0) ? 'selected' : ''; ?>>Não</option>
                              <option value="1" <?php echo ($produto->produto_ativo == 1) ? 'selected' : ''; ?>>Sim</option>
                            </select>
                        </div>
                          <div class="col-md-9">
                            <label>Observações</label>
                              <input type="text" class="form-control" name="produto_obs" placeholder="Obs." value="<?php echo $produto->produto_obs; ?>">
                              <?php echo form_error('produto_obs', '<small class="form-text text-danger">', '</small>'); ?>
                          </div>                                       
                        </div>
                    </fieldset><br>
          
                  <input type="hidden" name="produto_id" value="<?php echo $produto->produto_id; ?>">

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

      