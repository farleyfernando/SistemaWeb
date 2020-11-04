

    <?php $this->load->view('layout/sidebar'); ?>

      <!-- Main Content -->
      <div id="content">

    <?php $this->load->view('layout/navbar'); ?>    

        <!-- Begin Page Content -->
        <div class="container-fluid">   

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Home</h1>

          <?php if ($message = $this->session->flashdata('info')) : ?>
            <div class="row">
              <div class="col-md-12">
                  <div class="alert alert-warning text-gray-900 alert-dismissible fade show" role="alert">
                  <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?php echo $message; ?></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>                
              </div>
            </div>
          <?php endif; ?>
          <?php if ($message = $this->session->flashdata('sucesso')) : ?>
            <div class="row">
              <div class="col-md-12">
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong><i class="far fa-smile-wink"></i>&nbsp;&nbsp;<?php echo $message; ?></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>                
              </div>
            </div>
          <?php endif; ?>
          <?php if ($message = $this->session->flashdata('error')) : ?>
            <div class="row">
              <div class="col-md-12">
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong><i class="fas fa-times"></i>&nbsp;&nbsp;<?php echo $message; ?></strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>                
              </div>
            </div>
          <?php endif; ?>

          <?php if($this->ion_auth->is_admin()): ?>
            <!-- Content Row -->
            <div class="row">                 
                  <!-- Earnings (Monthly) Card Example -->
                  <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card shadow h-100 py-2" style="border-left: 0.25rem solid #447402"> 
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-home text-uppercase mb-1">Total de Vendas</div>
                            <div class="h5 mb-0 font-weight-bold text-home"><?php echo 'R$&nbsp;'.$soma_vendas->venda_total; ?></div>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-3x text-home"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Earnings (Monthly) Card Example -->
                  <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">                    
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total de Serviços</div>
                            <div class="h5 mb-0 font-weight-bold text-primary"><?php echo 'R$&nbsp;'.$soma_ordem_servicos->ordem_servico_valor_total; ?></div>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-shopping-basket fa-3x text-primary"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Earnings (Monthly) Card Example -->
                  <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Contas à Pagar</div>
                            <div class="row no-gutters align-items-center">
                              <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-danger"><?php echo 'R$&nbsp;'.$total_pagar->conta_pagar_valor; ?></div>
                              </div>
                            </div>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-money-bill-alt fa-3x text-danger"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Pending Requests Card Example -->
                  <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-dark shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Contas à Receber</div>
                            <div class="h5 mb-0 font-weight-bold text-dark"><?php echo 'R$&nbsp;'.($total_receber->conta_receber_valor == null ? '0,00' : $total_receber->conta_receber_valor); ?></div>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-hand-holding-usd fa-3x text-dark"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
          <?php endif; ?>    

              <div class="row">

                <div class="col-lg-6 mb-4">

                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-home">TOP 3 - Produtos mais vendidos</h6>
                      </div>
                      <div class="card-body">
                        <div class="text-center">
                          <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo base_url('public/img/produtos.svg'); ?>" alt="">
                        </div>
                         
                        <div class="table-responsive">
                          <table class="table table-striped table-borderless">

                            <thead>
                              <tr>
                                <th>Nome Produto</th>
                                <th class="text-center">Qtde Vendidos</th>
                              </tr>
                              
                            </thead>
                            <tbody>

                            <?php foreach ($produtos_mais_vendidos as $produto): ?>

                              <tr>
                                  <td class="text-gray-900" style="font-size:14px;"><?php echo $produto->produto_descricao ?></td>
                                  <td class="text-center"><?php echo '<span class="badge badge-success" style="font-size:13px; background-color: #447402">' . $produto->qtde_vendidos . '</span>' ?></td>
                              </tr>

                            <?php endforeach; ?>

                            </tbody>

                          </table>
                        </div>

                      </div>
                    </div>
                                     
                  </div>
                  <div class="col-lg-6 mb-4">

                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">TOP 3 - Serviços mais vendidos</h6>
                      </div>
                      <div class="card-body">
                        <div class="text-center">
                          <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 9rem;" src="<?php echo base_url('public/img/servicos.svg'); ?>" alt="">
                        </div> 
                        
                        <div class="table-responsive">
                          <table class="table table-striped table-borderless">

                            <thead>
                              <tr>
                                <th>Nome Serviço</th>
                                <th class="text-center">Qtde Serviços</th>
                              </tr>
                              
                            </thead>
                            <tbody>

                            <?php foreach ($servicos_mais_vendidos as $servico): ?>

                              <tr>
                                  <td class="text-gray-900" style="font-size:14px;"><?php echo $servico->servico_nome ?></td>
                                  <td class="text-center"><?php echo '<span class="badge badge-primary" style="font-size:13px;">' . $servico->qtde_serv_vendidos . '</span>' ?></td>
                              </tr>

                            <?php endforeach; ?>

                            </tbody>

                          </table>
                        </div>
                      </div>
                    </div>
                                     
                  </div>
              </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      