<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('/'); ?>">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fab fa-suse mr-2"></i>
  </div>
  <div class="sidebar-brand-text">System Ordem <sup></sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
  <a class="nav-link" href="<?php echo base_url('/'); ?>">
    <i class="fas fa-home"></i>
    <span>Home</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Cadastros
</div>

<li class="nav-item">
  <a title="Gerenciar Clientes" class="nav-link" href="<?php echo base_url('clientes'); ?>">
    <i class="fas fa-users"></i>
    <span>Clientes</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Configurações
</div>

<!-- Nav Item -->
<li class="nav-item">
  <a title="Gerenciar Usuários" class="nav-link" href="<?php echo base_url('usuarios'); ?>">
    <i class="fas fa-users"></i>
    <span>Usuários</span></a>
</li>
<li class="nav-item">
  <a title="Gerenciar Sistema" class="nav-link" href="<?php echo base_url('sistema'); ?>">
    <i class="fas fa-cogs"></i>
    <span>Sistema</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">