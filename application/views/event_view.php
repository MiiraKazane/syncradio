<!DOCTYPE html>
<head>
   <title>SyncRadio - Eventos</title>
   <link rel="stylesheet" href="<?= (CSS . 'dataTables.bootstrap.css'); ?>" />
   <link rel="stylesheet" href="<?= (CSS . 'bootstrap-datetimepicker.css'); ?>">
   <link rel="stylesheet" href="<?= (CSS . 'toastr.min.css'); ?>" />
   <?php $ci = & get_instance();
      $ci->load->view("navbar_view");?>
</head>
<div class="content-wrapper">
   <section class="content-header">
      <h1><i class="fa fa-flag-o" aria-hidden="true"></i> Listado de eventos
      </h1>
      <ol class="breadcrumb">
         <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
         <li class="active">Listado de eventos</li>
      </ol>
   </section>
   <br><br>
   <div class="container-fluid">
      <button class="btn btn-default btn-sm" onclick="add_event()" data-toggle="tooltip" title="Nuevo evento"><i class="glyphicon glyphicon-plus"></i> Nuevo</button><br><br>
      <table id="table" class="table table-hover table-bordered" width="100%">
         <thead>
            <tr>
               <th class="text-center">Titulo</th>
               <th class="text-center">Descripción</th>
               <th class="text-center">Inicio</th>
               <th class="text-center">Término</th>
               <th class="text-center">Categoría</td>
               <th style="width: 50px"></th>
            </tr>
         </thead>
         <tbody>
         </tbody>
      </table>
   </div>
</div>
<script src ="<?= (JS . 'jquery.dataTables.min.js'); ?>"></script>
<script src ="<?= (JS . 'dataTables.bootstrap.js'); ?>"></script>
<script src ="<?= (JS . 'moment.js'); ?>"></script>
<script src ="<?= (JS . 'bootstrap-datetimepicker.js'); ?>"></script>
<script src ="<?= (JS . 'toastr.min.js'); ?>"></script>
<script type="text/javascript">
   var save_method;
   var table;
   
   $(function () {
       $('#datetimepicker').datetimepicker({
           format: 'YYYY-MM-DD HH:mm',
           locale: 'es'
       });
   });
   
   $(function () {
       $('#datetimepicker2').datetimepicker({
           format: 'YYYY-MM-DD HH:mm',
           locale: 'es'
       });
   });
   
   $(document).ready(function () {
   
       table = $('#table').DataTable({
           "processing": false,
           "serverSide": true,
           "ajax": {
               "url": "<?php echo site_url('event/ajax_list') ?>",
               "type": "POST"},
           "ordering": false,
           
           "language": {
               "lengthMenu": "Mostrando _MENU_ eventos por pagina",
               "zeroRecords": "No hay eventos",
               "search": "Buscar:",
               "info": "",
               "infoEmpty": " ",
               "oPaginate": {
       "sFirst":    "Primero",
       "sLast":     "Último",
       "sNext":     "Siguiente",
       "sPrevious": "Anterior"
       },
               "sProcessing": "Procesando...",
               "sEmptyTable": "No hay eventos todavía",
               "sLoadingRecords": "Cargando...",
               "infoFiltered": " "
           }
       });
   
       $('body').tooltip({
           selector: '[data-toggle="tooltip"]',
           placement: 'top',
           trigger: 'hover'
       });
   
       $("input").change(function () {
           $(this).parent().parent().removeClass('has-error');
           $(this).next().empty();
       });
       $("textarea").change(function () {
           $(this).parent().parent().removeClass('has-error');
           $(this).next().empty();
       });
       $("select").change(function () {
           $(this).parent().parent().removeClass('has-error');
           $(this).next().empty();
       });
   });
   
   function add_event() {
       save_method = 'add';
       $('#form')[0].reset();
       $('.form-group').removeClass('has-error');
       $('.help-block').empty();
       $('#modal_form').modal('show');
       $('.modal-title').text('Nuevo evento');
   }
   
   function edit_event(id) {
   
       save_method = 'update';
       $('#form')[0].reset();
       $('.form-group').removeClass('has-error');
       $('.help-block').empty();
   
       $.ajax({
           url: "<?= site_url('event/ajax_edit/') ?>/" + id,
           type: "GET",
           dataType: "JSON",
           success: function (data)
           {
               $('[name="id"]').val(data.id);
               $('[name="titulo"]').val(data.title);
               $('[name="descripcion"]').val(data.body);
               $('[name="fecha_inicio"]').val(data.start);
               $('[name="fecha_final"]').val(data.end);
               $('[name="color"]').val(data.class);
               $('[name="categoria"]').val(data.id_kind_event);
               $('#modal_form').modal('show');
               $('.modal-title').text('Modificar evento');
   
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               toastr["error"]('Error obteniendo datos');
           }
       });
   }
   
   function reload_table() {
       table.ajax.reload(null, false);
   }
   
   function save() {
       $('#btnSave').text('Guardando...');
       $('#btnSave').attr('disabled', true);
       var url;
   
       if (save_method == 'add') {
           url = "<?php echo site_url('event/ajax_add') ?>";
       } else {
           url = "<?php echo site_url('event/ajax_update') ?>";
       }
   
       $.ajax({
           url: url,
           type: "POST",
           data: $('#form').serialize(),
           dataType: "JSON",
           success: function (data)
           {
   
               if (data.status) {
                   $('#modal_form').modal('hide');
                   reload_table();
   
                   if (save_method == 'add') {
                                  toastr["info"]('Evento agregado');                    
                       } else {
                                  toastr["info"]('Evento actualizado');
                       }
   
               } else
               {
                   for (var i = 0; i < data.inputerror.length; i++)
                   {
                       $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
                       $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                   }
               }
               $('#btnSave').text('Guardar');
               $('#btnSave').attr('disabled', false);
           },
           error: function (jqXHR, textStatus, errorThrown) {
               toastr["error"]('Error adding / update data');
               $('#btnSave').text('Guardar');
               $('#btnSave').attr('disabled', false);
           }
       });
   }
   
   function delete_event(id)
   {
       if (confirm('¿borrar evento?'))
       {
           $.ajax({
               url: "<?php echo site_url('event/ajax_delete') ?>/" + id,
               type: "POST",
               dataType: "JSON",
               success: function (data)
               {
                   $('#modal_form').modal('hide');
                   reload_table();
                   toastr["info"]('Evento eliminado');
               },
               error: function (jqXHR, textStatus, errorThrown)
               {
                   toastr["error"]('Error eliminando evento');
               }
           });
       }
   }
   
   toastr.options = {
       "newestOnTop": false,
       "positionClass": "toast-top-right",
       "timeOut": "5000"
   }
</script>
<div class="modal fade" id="modal_form" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
            <h3 class="modal-title"></h3>
         </div>
         <div class="modal-body form">
            <form action="#" id="form" class="form-horizontal">
               <input type="hidden" value="" name="id"/> 
               <div class="form-body">
                  <div class="form-group">
                     <label class="control-label col-md-3" for="titulo">Titulo: </label>
                     <div class="col-md-7">
                        <input name="titulo" id="titulo" placeholder="Ingresa titulo" class="form-control" type="text" />
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3" for="descripcion">Descripción: </label>
                     <div class="col-md-7">
                        <textarea name="descripcion" id="descripcion" placeholder="Ingresa descripción" class="form-control" type="text"></textarea>
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3" for="datetimepicker">Empieza: </label>
                     <div class="col-md-4">
                        <input name="fecha_inicio" id="datetimepicker" type="text" placeholder="Ingresa fecha" class="form-control input-md" />
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3" for="datetimepicker2">Termina: </label>
                     <div class="col-md-4">
                        <input name="fecha_final" id="datetimepicker2" type="text" placeholder="Ingresa fecha" class="form-control input-md" />
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3" for="categoria">Tipo: </label>
                     <div class="col-md-6">
                        <select name="categoria" class="form-control" id="categoria">
                           <option value="">-- Tipo --</option>
                           <?php
                              foreach ($list as $value):
                                  echo '<option value="' . $value->id_kind_event . '">' . $value->name_kind_event . '</option>';
                              endforeach;
                              ?>
                        </select>
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3" for="color">Color: </label>
                     <div class="col-md-4">
                        <select class="form-control" name="color" id="color">
                           <option value = "event-important">Rojo</option>
                           <option value = "event-warning">  Amarillo</option>
                           <option value = "event-info">     Azul</option>
                           <option value = "event-inverse">  Negro</option>
                           <option value = "event-success">  Verde</option>
                           <option value = "event-special">  Morado</option>
                        </select>
                        <span class="help-block"></span>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary btn-round-lg">Guardar</button>
            <button type="button" class="btn btn-danger btn-round-lg" data-dismiss="modal">Cancelar</button>
         </div>
      </div>
   </div>
</div>
</body>
</html>
