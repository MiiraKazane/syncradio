<!DOCTYPE html>
<head>
   <title><?= $titulo ?></title>
   <link rel="stylesheet" href="<?php echo(CSS . 'calendar.css'); ?>">
</head>
<?php $ci =& get_instance();
      $ci->load->view("navbar_view"); ?>
<div class="content-wrapper">
<section class="content-header">
   <h1><i class="fa fa-calendar" aria-hidden="true"></i> Calendario</h1>
   <ol class="breadcrumb">
      <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Calendario</li>
   </ol>
</section>
<br>
<div class="container-fluid">
<div class="page-header">
   <div class="pull-right form-inline">
      <div class="btn-group">
         <button class="btn btn-info" data-calendar-nav="prev"><i class="fa fa-arrow-left" aria-hidden="true"></i> Anterior</button>
         <button class="btn btn-primary" data-calendar-nav="today">Actual</button>
         <button class="btn btn-info" data-calendar-nav="next">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
      </div>
      <div class="btn-group">
         <button class="btn btn-info" data-calendar-view="year">Año</button>
         <button class="btn btn-info active" data-calendar-view="month">Mes</button>
         <button class="btn btn-info" data-calendar-view="week">Semana</button>
         <button class="btn btn-info" data-calendar-view="day">Día</button>
      </div>
   </div>
   <h3></h3>
</div>
<div class="row">
<div class="col-md-12">
   <div id="calendar" class="center-block"></div>
</div>
<div class="col-md-3">
   <div class="modal fade" id="events-modal" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-body" style="height: 400px"></div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
         </div>
      </div>
   </div>
   <br><br><br>
</div>
<script src="<?= (JS . 'underscore-min.js'); ?>"></script>
<script src="<?= (JS . 'calendar.js'); ?>"></script>
<script src="<?= (JS . 'jstz.js'); ?>"></script>
<script src="<?= (JS . 'language/es-MX.js'); ?>"></script>
</body>
</html>
