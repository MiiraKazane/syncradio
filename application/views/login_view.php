<!DOCTYPE html>
<head>
    <title><?= $titulo ?></title>
    <link rel="stylesheet" href="<?php echo(CSS.'bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo(CSS.'AdminLTE.css'); ?>">
</head>
<?php
    $username = array('name' => 'username', 'id' => 'username', 'placeholder' => 'Introduce tu usuario', 'class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off');
    $password = array('name' => 'password', 'placeholder' => 'introduce tu contraseña', 'class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off');
    $submit = array('name' => 'submit', 'value' => 'Iniciar sesión', 'class' => 'btn btn-info');
?>
<body class="login-page">
    <div class="login-box">
        <div class="login-logo"><a>SyncRadio</a></div>
            <div class="login-box-body">
                <?php $att = array('name' => 'form', 'id' => 'form'); ?>
                <?= form_open(SITE . 'login/new_user', $att) ?>
            <div class="form-group has-feedback">
                <?= form_input($username) ?><p><?= form_error('username') ?></p>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <?= form_password($password) ?><p><?= form_error('password') ?></p>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
                <?= form_hidden('token', $token) ?>
                <?= form_submit($submit) ?>
                <?= form_close() ?>
            </div>
                <?php if ($this->session->flashdata('usuario_incorrecto')) { ?>
                <br><br><br><p class="text-danger text-center"><?= $this->session->flashdata('usuario_incorrecto') ?></p>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="<?= (JS . 'jquery-3.1.0.min.js'); ?>"></script>
    <script src="<?= (JS . 'bootstrap.min.js'); ?>"></script>
    <script src="<?= (JS . 'adminlte.min.js'); ?>"></script>
</body>
</html>

