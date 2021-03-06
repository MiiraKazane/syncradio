<!DOCTYPE html>
<head>
   <title>SyncRadio | Reportes generales</title>
   <link rel="stylesheet" href="<?= (CSS . 'dataTables.bootstrap.css'); ?>" />
   <link rel="stylesheet" href="<?= (CSS . 'toastr.min.css'); ?>" />
</head>
    <?php $ci = & get_instance();
    $ci->load->view("navbar_view");
    $this->load->helper('tipos'); ?>
<div class="content-wrapper">
   <section class="content-header">
      <h1><i class="fa fa-list-ol" aria-hidden="true"></i> Reportes generales
      </h1>
      <ol class="breadcrumb">
         <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
         <li class="active">Reportes generales</li>
      </ol>
   </section>
   <br><br>
   <div class="container-fluid">
      <button class="btn btn-default btn-sm" onclick="add_report()" data-toggle="tooltip" title="Nuevo reporte"><i class="glyphicon glyphicon-plus"></i> Nuevo</button>
      <table id="table" class="table table-hover table-bordered" width="100%">
         <thead>
            <tr>
               <th class="text-center">Folio</th>
               <th class="text-center">Prioridad</th>
               <th class="text-center">Descripción</th>
               <th class="text-center">Estatus</td>
               <th class="text-center"><i class="fa fa-comments"></i></th>
               <th class="text-center" style="width: 50px"></th>
            </tr>
         </thead>
         <tbody>
         </tbody>
      </table>
   </div>
</div>
<script src ="<?= (JS . 'jquery.dataTables.min.js'); ?>"></script>
<script src ="<?= (JS . 'toastr.min.js'); ?>"></script>
<script type="text/javascript">
   var save_method;
   var table;
   
   $(document).ready(function () {
   
       table = $('#table').DataTable({
   
           "processing": false,
           "serverSide": true,
           "ajax": {
               "url": "<?php echo site_url('nreport/ajax_list') ?>",
               "type": "POST"},
           "ordering": false,
           "searching": false,
           "scrollCollapse": true,
           "paging": false,
           "language": {
               "lengthMenu": "Display _MENU_ records per page",
               "zeroRecords": "No hay registros",
               "search": "Buscar:",
               "info": "",
               "infoEmpty": " ",
               "sProcessing": "Procesando...",
               "sEmptyTable": "Ningún dato disponible en esta tabla",
               "sLoadingRecords": "Cargando...",
               "infoFiltered": " "
           }
       });
   
       setInterval(function () {
           table.ajax.reload();
       }, 10000);
   
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
   
   function add_report() {
       save_method = 'add';
       $('#form')[0].reset();
       $('.form-group').removeClass('has-error');
       $('.help-block').empty();
       $('#modal_form').modal('show');
       $('.modal-title').text('Nuevo reporte');
   
   }
   
   function edit_report(id) {
   
       save_method = 'update';
       $('#form')[0].reset();
       $('.form-group').removeClass('has-error');
       $('.help-block').empty();
   
       $.ajax({
           url: "<?= site_url('nreport/ajax_edit/') ?>/" + id,
           type: "GET",
           dataType: "JSON",
           success: function (data)
           {
               $('[name="id"]').val(data.id);
               $('[name="descripcion"]').val(data.description);
               $('[name="categoria"]').val(data.id_cat);
               $('[name="prioridad"]').val(data.priority);
               $('[name="estatus"]').val(data.status);
               $('#modal_form').modal('show');
               $('.modal-title').text('Modificar reporte');
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               toastr["error"]('Error obteniendo datos');
           }
       });
   }
   
   function see_report(id) {
   
       $.ajax({
           url: "<?= site_url('nreport/ajax_see/') ?>/" + id,
           type: "GET",
           dataType: "JSON",
           success: function (data)
           {
               $('#modal_see').modal('show');
               $('.modal-title').text('Ver reporte');
   
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               toastr["error"]('Error adding / update data');
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
           url = "<?php echo site_url('nreport/ajax_add') ?>";
       } else {
           url = "<?php echo site_url('nreport/ajax_update') ?>";
       }
   
       $.ajax({
           url: url,
           type: "POST",
           data: $('#form').serialize(),
           dataType: "JSON",
           success: function(data)
           {
   
               if (data.status) {
                   $('#modal_form').modal('hide');
                   reload_table();
   
               if (save_method == 'add') {
                          toastr["info"]('Reporte agregado');                    
               } else {
                          toastr["info"]('Reporte actualizado');
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
   
   function delete_report(id)
   {
       if (confirm('¿borrar reporte?'))
       {
           $.ajax({
               url: "<?php echo site_url('nreport/ajax_delete') ?>/" + id,
               type: "POST",
               dataType: "JSON",
               success: function (data)
               {
                   $('#modal_form').modal('hide');
                   toastr["info"]('Reporte eliminado');
                   reload_table();
               },
               error: function (jqXHR, textStatus, errorThrown)
               {
                  toastr["error"]('Error adding / update data');
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
                     <label name="reporte" class="control-label col-md-3" for="descripcion">Descripción: </label>
                     <div class="col-md-9">
                        <textarea name="descripcion" id="descripcion" placeholder="Ingresa descripcion" class="form-control" type="text"></textarea>
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3" for="categoria">Categoría: </label>
                     <div class="col-md-6">
                        <select name="categoria" class="form-control" id="categoria">
                           <option value="">-- Categoría --</option>
                           <?php
                              foreach ($list as $value) {
                                  echo '<option value="' . $value->id_cat . '">' . $value->name_cat . '</option>';
                              }
                              ?>
                        </select>
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3" for="prioridad">Prioridad: </label>
                     <div class="col-md-3">
                        <select name="prioridad" class="form-control" id="prioridad">
                           <option value="3">Baja</option>
                           <option value="2">Media</option>
                           <option value="1">Alta</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3" for="estatus">Estatus: </label>
                     <div class="col-md-3">
                        <select name="estatus" class="form-control" id="estatus">
                           <option value="0">Abierto</option>
                           <option value="1">En proceso</option>
                           <option value="2">Finalizado</option>
                        </select>
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
