<!DOCTYPE html>
<head>
   <title><?= $titulo ?></title>
   <?php $ci =& get_instance();
      $ci->load->view("navbar_view"); ?>
</head>
<div class="content-wrapper">
   <section class="content-header">
      <h1><i class="fa fa-flag-o" aria-hidden="true"></i> Evento<small>completo</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
         <li><a href="<?= (SITE . 'calendar'); ?>"><i class="fa fa-calendar"></i> Calendario</a></li>
         <li class="active">Evento completo</li>
      </ol>
   </section>
   <br><br>
   <div class="container-fluid">
      <div class="col-md-12">
         <div class="row">
            <div class="panel panel-primary">
               <legend>
                  <h3 class="text-info text-center"><?= $row->title ?></h3>
               </legend>
               <div class="panel-body text-center">
                  <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                     <label>
                        <h3 class="text-primary">Inicio</h3>
                        <?= unix_to_normal_show($row->start) ?>
                     </label>
                  </div>
                  <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                     <label>
                        <h3 class="text-primary">Fin</h3>
                        <?= unix_to_normal_show($row->end) ?>
                     </label>
                  </div>
                  <div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
                     <label>
                        <h3 class="text-primary">Categoría</h3>
                        <?= $row->name_kind_event ?>
                     </label>
                  </div>
                  <div class="hidden-xs col-sm-3 col-md-3 col-lg-3">
                     <label>
                        <h3 class="text-primary">Publicado por</h3>
                        <?= $row->name_emp ?>
                     </label>
                  </div>
               </div>
            </div>
            <p>
            <h3>Descripción:</h3>
            <?= $row->body ?></p>
         </div>
      </div>
   </div>
</div>
</body>
</html>
