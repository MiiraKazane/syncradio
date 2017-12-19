<!DOCTYPE html>
<head>
  <title><?= $titulo ?></title>
</head>

  <?php $ci =& get_instance();
  $ci->load->view("navbar_view");?>

  <style type="text/css">
    .imag:hover{ 
      -webkit-transform: scale(1.2);
      transform: scale(1.2)
  }
  </style>

<div class="content-wrapper">
    <section class="content-header">
      <h1><i class="fa fa-user" aria-hidden="true"></i> Perfil<small>de usuario</small></h1>
        <ol class="breadcrumb">
          <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active">Perfil de usuario</li>
        </ol>
    </section>
    <br><br>
    <div class="container-fluid">
    <div class="row">
      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 pull-right">
        <?php if(!empty($emp->picture_emp)): ?>
          <img src="<?= (URL.'uploads/thumbs/'.$emp->picture_emp); ?>" width="200" height="200" class="img-thumbnail img-responsive imag" alt="User Image">
        <?php else: ?>
          <img src="<?= URL.'assetss/img/default.png' ?>" width="200" height="200" class="img-circle" alt="User Image">
        <?php endif; ?>
      </div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
      <div class="panel-group" id="accordion">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse1"> Generales</a></h4>
          </div>
        <div id="collapse1" class="panel-collapse collapse in">
          <div class="panel-body">
            <p><label>Tipo de usuario:</label> <?= see_tipos($emp->tipo_log) ?></p>
            <p><label>Nombre:</label> <?= $emp->lastname_emp." ".$emp->name_emp ?></p>
            <p><label>Fecha de nacimiento:</label> <?= format_date($emp->birth_date_emp) ?></p>
            <p><label>Departamento:</label> <?= $emp->name_dep ?> <small><?= $emp->job_emp ?></small></p>
          </div>
        </div>
          </div>
            <div class="panel panel-info">
              <div class="panel-heading">
                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse2"> Contacto</a></h4>
              </div>
              <div id="collapse2" class="panel-collapse collapse">
                <div class="panel-body">
                  <p><label>Teléfono:</label> <?= $emp->telephone_emp ?></p>
                  <p><label>E-mail:</label> <?= $emp->email_emp ?></p>  
                </div>
              </div>
            </div>
        <?php if ($this->session->userdata('tipo') == '1'): ?>
        <div class="panel panel-danger">
          <div class="panel-heading">
            <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse3"> Nómina</a></h4>
          </div>
          <div id="collapse3" class="panel-collapse collapse">
            <div class="panel-body">
              <p><label>Fecha de ingreso:</label> <?= format_date($emp->hire_date_emp) ?></p>
              <p><label>RFC:</label> <?= $emp->rfc_emp ?></p>
              <p><label>CURP:</label> <?= $emp->curp_emp ?></p>
              <p><label>NSS:</label> <?= $emp->nss_emp ?></p>
              <p><label>Razón social:</label> <?= $emp->social_reason_emp ?></p>
              <p><label>SBC:</label> <?= $emp->sbc_emp ?></p>
            </div>
          </div>
        </div>
        <?php endif; ?>
          </div>
        </div>
    </div></div>
</div>

</body>
</html>
