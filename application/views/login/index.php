
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center mt-lg-5">
             
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5" style="margin-top: 10rem !important">
             <?php if ($message = $this->session->flashdata('error')) : ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?php echo $message; ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>                
                    </div>
                </div>
             <?php endif; ?>
             <?php if ($message = $this->session->flashdata('info')) : ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?php echo $message; ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>                
                    </div>
                </div>
             <?php endif; ?>
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Seja bem-vindo !</h1>
                  </div>
                  <form name="form_auth" method="post" action="<?php echo base_url('login/auth'); ?>" >
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" placeholder="Senha" required>
                    </div>
                    <button type="submit " class="btn btn-primary btn-user btn-block">Entrar
                    </button>

                  </form><br>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
