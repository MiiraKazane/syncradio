<?php $ci =& get_instance();
   $ci->load->helper('tipos');
   $ci->load->model('employee_model');
   $row = $ci->employee_model->get_by_id($this->session->userdata('id'));
   ?>
<link rel="stylesheet" href="<?= (CSS . 'bootstrap.min.css'); ?>" />
<link rel="stylesheet" href="<?= (CSS . 'font-awesome.min.css'); ?>" />
<link rel="icon"       href="<?= (IMG . 'favicon.png'); ?>" type="image/x-icon">
<link rel="stylesheet" href="<?= (CSS . 'AdminLTE.min.css'); ?>" />
<link rel="stylesheet" href="<?= (CSS . 'skins/skin-black-light.min.css'); ?>" />
<link rel="stylesheet" href="<?= (CSS . 'SourceSanPro.css'); ?>" />
<body class="sidebar-collapse skin-black-light sidebar-mini">
   <div class="wrapper">
   <header class="main-header">
      <a href="<?= (SITE . 'login'); ?>" class="logo">
      <span class="logo-mini"><img src="<?= URL.'assetss/img/favicon.png' ?>" class="img-thumbnail" width="30" height="30"></span>
      <span class="logo-lg"><img src="<?= URL.'assetss/img/logo.png' ?>" class="img-thumbnail" width="100" height="30"></span>
      </a>
      <nav class="navbar navbar-static-top">
         <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
         <span class="sr-only">Toggle navigation</span>
         </a>
         <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
               <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">             
                  <?php 
                     if(!empty($row->picture_emp)): ?>
                  <img src="<?= (URL.'uploads/thumbs/'.$row->picture_emp); ?>" width="15" height="15" class="img-circle">
                  <?php else: ?>
                  <img src="<?= URL.'assetss/img/default.png' ?>" class="img-circle" width="15" height="15">
                  <?php endif; ?><span class="hidden-xs"><?= strtoupper($this->session->userdata('nombre')); ?> <i class="fa fa-caret-down" aria-hidden="true"></i></span>
                  </a>
                  <ul class="dropdown-menu">
                     <li class="user-header">
                        <?php 
                           if(!empty($row->picture_emp)): ?>
                        <img src="<?= (URL.'uploads/thumbs/'.$row->picture_emp); ?>" width="10" height="10" class="img-circle">
                        <?php else: ?>
                        <img src="<?= URL.'assetss/img/default.png' ?>" width="10" height="10" class="img-circle" alt="User Image">
                        <?php endif; ?>
                        <p><?= strtoupper($this->session->userdata('nombre')); ?><small><?= see_tipos($this->session->userdata('tipo')); ?></small></p>
                     </li>
                     <li class="user-footer">
                        <div class="pull-left">
                           <a href="<?= (SITE . 'profile/see_profile/'.$this->session->userdata('id')); ?>" class="btn btn-default btn-flat">Perfil</a>
                        </div>
                        <div class="pull-right">
                           <a href="<?= (SITE . 'login/logout_ci'); ?>" class="btn btn-danger btn-flat">Cerrar sesión</a>
                        </div>
                     </li>
                  </ul>
               </li>
            </ul>
            </li>
            </ul>
         </div>
      </nav>
   </header>
   <aside class="main-sidebar">
      <section class="sidebar">
         <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Bienvenido/a <?= strtoupper($this->session->userdata('nombre')); ?></li>
            <li class="treeview">
               <a href="#">
               <i class="fa fa-sliders" aria-hidden="true"></i> <span>MONITORES</span>
               <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
               </span>
               </a>
               <ul class="treeview-menu">
                  <li><a href="<?= (SITE . 'report_bestia'); ?>"><i class="fa fa-caret-right"></i></i>XHRPC |Bestia Grupera</a></li>
                  <li><a href="<?= (SITE . 'report_love'); ?>"><i class="fa fa-caret-right"></i></i>XHUA | Love</a></li>
                  <li><a href="<?= (SITE . 'report_super'); ?>"><i class="fa fa-caret-right"></i></i>XHFO | Super</a></li>
               </ul>
            </li>
            <li><a href="<?= (SITE . 'nreport'); ?>"><i class="fa fa-list-ol"></i> <span>REPORTES GENERALES</span></a></li>
            <?php if($this->session->userdata('tipo') != 2): ?>
            <li><a href="<?= (SITE . 'order'); ?>"><i class="fa fa-file-excel-o"></i> <span>ORDENES</span></a></li>
            <?php endif; ?>
            <!-- Calendario -->
            <li class="treeview">
               <a href="#">
               <i class="fa fa-calendar"></i>
               <span>EVENTOS</span>
               <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
               </span>
               </a>
               <ul class="treeview-menu">
                  <li><a href="<?= (SITE . 'calendar'); ?>"><i class="fa fa-caret-right"></i> Calendario</a></li>
                  <?php if($this->session->userdata('tipo') == 1): ?>
                  <li><a href="<?= (SITE . 'event'); ?>"><i class="fa fa-caret-right"></i> Listado</a></li>
                  <?php endif; ?>
               </ul>
            </li>
            <?php if($this->session->userdata('tipo') == 1): ?>
            <!--Administración-->
            <li class="treeview">
               <a href="#">
               <i class="fa fa-laptop"></i>
               <span>ADMINISTRACIÓN</span>
               <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
               </span>
               </a>
               <ul class="treeview-menu">
                  <li><a href="<?= (SITE . 'employee'); ?>"><i class="fa fa-caret-right"></i> Empleados</a></li>
                  <li><a href="<?= (SITE . 'department'); ?>"><i class="fa fa-caret-right"></i> Departamentos</a></li>
                  <li><a href="<?= (SITE . 'station'); ?>"><i class="fa fa-caret-right"></i>  Estaciones</a></li>
               </ul>
            </li>
            <?php endif; ?>
            <?php if($this->session->userdata('tipo') != 2): ?>
            <li><a href="<?= (SITE . 'spot'); ?>"><i class="fa fa-rss"></i> <span>CONTROL DE SPOTS</span></a></li>
            <li><a href="<?= (SITE . 'queries'); ?>"><i class="fa fa-search"></i> <span>CONSULTAS</span></a></li>
            <?php endif; ?>
         </ul>
      </section>
   </aside>
   <!--<footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
      reserved.
      </footer>
      -->
   <script src ="<?= (JS . 'jquery-2.2.4.js'); ?>"></script>
   <script src ="<?= (JS . 'bootstrap.js'); ?>"></script>
   <script src ="<?= (JS . 'adminlte.min.js'); ?>"></script>
