<?php
   if (!isset($_POST['start'])) {
       $start = FALSE;
   }
   else {
       $start = $start;
   }
    $date_start = array('name' => 'date_start','placeholder' => 'Fecha de inicio','class' => 'form-control datepicker', );
    $date_end = array('name' => 'date_end','placeholder' => 'Fecha de fin','class' => 'form-control datepicker');
    $submit = array('name' => 'submit','value' => 'Buscar','title' => 'Buscar','class' => 'btn btn-info btn-sm','onclick' => 'return valida()');
    $att = array('name' => 'form', 'id' => 'form'); ?>
<!DOCTYPE html>
<head>
   <title>SyncRadio - Reportes por fecha</title>
   <link rel="stylesheet" href="<?=(CSS . 'dataTables.bootstrap.css'); ?>" />
   <link rel="stylesheet" href="<?=(CSS . 'bootstrap-datepicker.min.css'); ?>" />
   <link rel="stylesheet" href="<?=(CSS . 'toastr.min.css'); ?>" />
</head>
<?php $ci =& get_instance();
   $ci->load->view("navbar_view"); ?>
<div class="content-wrapper">
   <section class="content-header">
      <h1><i class="fa fa-search" aria-hidden="true"></i> Reportes por fecha</h1>
      <ol class="breadcrumb">
         <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
         <li class="active"><i class="fa fa-search"> Consulta de reportes</i>
      </ol>
   </section>
   <br><br>
   <div class="container-fluid">
      <div class="row">
         <?= form_open(SITE . 'queries/see_results', $att) ?>
         <div class="input-group input-daterange col-md-4 col-md-offset-4">
            <?= form_input($date_start) ?>
            <div class="input-group-addon"></div>
            <?= form_input($date_end) ?>
         </div>
         <br>
         <center><?= form_submit($submit) ?>
            <?= form_close() ?> 
         </center>
      </div>
      <br><br>
      <?php if(isset($queue)):
         $ci->load->model('nreport_model', 'moo'); ?>
      <table id="table" class="table table-hover table-bordered">
         <thead>
            <tr>
               <th class="text-center">Folio</th>
               <th class="text-center">Prioridad</th>
               <th class="text-center">Descripción</th>
               <th class="text-center">Estatus</td>
               <th class="text-center" style="width: 70px">Fecha</td>
               <th class="text-center">Categoría</th>
               <th class="text-center" style="width: 2px"><i class="fa fa-comments" aria-hidden="true"></i></th>
               <th class="text-center"></th>
            </tr>
         </thead>
         <tbody>
            <?php foreach($queue as $res): ?>
            <tr>
               <td style="text-align: center;"><?= $res->folio ?></td>
               <td style="text-align: center;"><?= see_tipo_reporte($res->priority) ?></td>
               <td><?= $res->description ?></td>
               <td style="text-align: center;"><?= see_status($res->status); ?></td>
               <td style="text-align: center;"><?= format_date($res->date_in) ?></td>
               <td><?= $res->name_cat ?></td>
               <td style="text-align: center;"><span class="badge badge-pill badge-dark"><?= $ci->moo->count_comments($res->id) ?></span></td>
               <td style="text-align: center;"><a class="btn btn-default text-center" target="_blank" data-toggle="tooltip" title="Ver reporte" href="<?= SITE ?>report_bestia/report_all/<?= $res->id ?>"><i class="glyphicon glyphicon-eye-open"></i></a></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
         </tbody>
      </table>
   </div>
</div>
</div>
<script src ="<?= (JS . 'jquery.dataTables.min.js'); ?>"></script>
<script src ="<?= (JS . 'dataTables.bootstrap.js'); ?>"></script>
<script src ="<?= (JS . 'datepicker.js'); ?>"></script>
<script src ="<?= (JS . 'bootstrap-datepicker.es.js'); ?>"></script>
<script src ="<?= (JS . 'toastr.min.js'); ?>"></script>
<script>
   $(document).ready(function() {
   
   table = $('#table').DataTable({
   "columnDefs": [
               {
                   "targets": [0,2,6,7],
                   "orderable": false
               }
           ], 
       "language": {
           "lengthMenu": "Mostrar _MENU_ reportes por pagina",
           "zeroRecords": "No hay registros",
           "search": "Buscar:",
           "info": "",
           "infoEmpty": " ",
           "sProcessing": "Procesando...",
           "sEmptyTable": "No se encontraron resultados    ",
           "sLoadingRecords": "Cargando...",
           "oPaginate": {
               "sFirst":    "Primero",
               "sLast":     "Último",
               "sNext":     "Siguiente",
               "sPrevious": "Anterior"
           },
           "infoFiltered": " "
       }
       });
   });
   
   $(document).ready(function(){
   $('[data-toggle="tooltip"]').tooltip(); 
   });
   
   $('.datepicker').datepicker({
   autoclose: true,
   language: 'es',
   todayHighlight: true,
   format: "yyyy-mm-dd",
   todayBtn: 'linked',
   orientation: "top left"
   });
   
   function valida()
   {
   if (document.form.date_start.value === "")
   {
       toastr["warning"]('Selecciona fecha de inicio');
       document.form.date_start.focus();
       return false;
   } else {
       if (document.form.date_end.value === "")
       {
           toastr["warning"]('Selecciona fecha de fin');
           document.form.date_end.focus();
           return false;
       }
   }
   }
</script>
</body>
</html>
