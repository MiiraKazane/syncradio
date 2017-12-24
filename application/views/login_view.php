<!DOCTYPE html>
<head>
   <title>SyncRadio | Login</title>
   <link rel="stylesheet" href="<?php echo(CSS.'bootstrap.min.css'); ?>">
   <link rel="stylesheet" href="<?php echo(CSS.'AdminLTE.css'); ?>">
   <link rel="icon"       href="<?= (IMG . 'favicon.png'); ?>" type="image/x-icon">
</head>
<?php
   $username = array('name' => 'username', 'id' => 'username', 'placeholder' => 'Usuario', 'class' => 'form-control', 'required' => 'required');
   $password = array('name' => 'password', 'placeholder' => 'Contraseña', 'class' => 'form-control', 'required' => 'required');
   $submit = array('name' => 'submit', 'value' => 'Iniciar sesión', 'class' => 'btn btn-info');
   ?>
<body class="login-page">
   <div class="login-box">
      <div class="login-logo"><img src="<?= URL.'assetss/img/logo.png' ?>" width="300" height="100"></div>
      <div class="login-box-body">
         <?php $att = array('name' => 'form', 'id' => 'form'); ?>
         <?= form_open(SITE.'login/new_user', $att) ?>
         <div class="form-group has-feedback">
            <?= form_input($username) ?>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
         </div>
         <div class="form-group has-feedback">
            <?= form_password($password) ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
         </div>
         <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
               <?= form_hidden('token', $token) ?>
               <?= form_submit($submit) ?>
               <?= form_close() ?>
            </div>
            <?php if ($this->session->flashdata('usuario_incorrecto')) { ?>
            <br><br><br>
            <p class="text-danger text-center"><?= $this->session->flashdata('usuario_incorrecto') ?></p>
            <?php } ?>
         </div>
      </div>
   </div>
   <script src="<?= (JS . 'jquery-3.1.0.min.js'); ?>"></script>
   <script src="<?= (JS . 'bootstrap.min.js'); ?>"></script>
   <script src="<?= (JS . 'adminlte.min.js'); ?>"></script>
</body>
</html>
