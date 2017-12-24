<!DOCTYPE html>
<head>
   <title>SyncRadio - Control de spots</title>
   <link rel="stylesheet" href="<?=(CSS . 'dataTables.bootstrap.css'); ?>" />
   <link rel="stylesheet" href="<?=(CSS . 'bootstrap-datepicker.min.css'); ?>" />
   <link rel="stylesheet" href="<?=(CSS . 'toastr.min.css'); ?>" />
</head>
    <?php $ci = & get_instance();
    $ci->load->view("navbar_view");
    $this->load->helper('tipos'); ?>
<div class="content-wrapper">
   <section class="content-header">
      <h1><i class="fa fa-rss" aria-hidden="true"></i> Control de spots</h1>
      <ol class="breadcrumb">
         <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
         <li><a href="<?= (SITE . 'employee'); ?>"><i class="fa fa-rss"> Control de spots</a></i>
      </ol>
   </section>
   <br><br>    
   <div class="container-fluid">
      <?php if($this->session->userdata('tipo') != '3'): ?>
      <button class="btn btn-default btn-sm" onclick="add_spot()" data-toggle="tooltip" title="Nuevo spot"><i class="glyphicon glyphicon-plus"></i> Nuevo</button>
      <?php endif; ?>
      <table id="table" class="table table-hover table-condensed table-bordered" width="100%">
         <thead>
            <tr>
               <th class="text-center">Código</th>
               <th class="text-center">Versión</th>
               <th class="text-center">Cliente</th>
               <th class="text-center">Estación</td>
               <th class="text-center">Fecha</th>
               <th class="text-center">Vigencia</th>
               <?php if($this->session->userdata('tipo') != '3'): ?>
               <th class="text-center" style="width: 50px"></th>
               <?php endif; ?>
            </tr>
         </thead>
         <tbody>
         </tbody>
      </table>
   </div>
</div>
<script src ="<?= (JS . 'jquery.dataTables.min.js'); ?>"></script>
<script src ="<?= (JS . 'datepicker.js'); ?>"></script>
<script src ="<?= (JS . 'bootstrap-datepicker.es.js'); ?>"></script>
<script src ="<?= (JS . 'toastr.min.js'); ?>"></script>
<script type="text/javascript">
   var save_method;
   var table;
   
   $(document).ready(function () {
   
       //datatables
       table = $('#table').DataTable({
   
           "processing": false,
           "serverSide": true,
           "ajax": {
               "url": "<?php echo site_url('spot/ajax_list') ?>",
               "type": "POST"},
           "ordering": false,
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
   
   function add_spot() {
       save_method = 'add';
       $('#form')[0].reset();
       $('.form-group').removeClass('has-error');
       $('.help-block').empty();
       $('#modal_form').modal('show');
       $('.modal-title').text('Nuevo spot');
   }
   
   function edit_spot(id) {
   
       save_method = 'update';
       $('#form')[0].reset();
       $('.form-group').removeClass('has-error');
       $('.help-block').empty();
   
       $.ajax({
           url: "<?= site_url('spot/ajax_edit/') ?>/" + id,
           type: "GET",
           dataType: "JSON",
           success: function (data)
           {
               $('[name="id"]').val(data.id_spot);
               $('[name="codigo"]').val(data.code_spot);
               $('[name="version"]').val(data.version_spot);
               $('[name="cliente"]').val(data.customer_spot);
               $('[name="estacion"]').val(data.id_sta_spot);
               $('[name="expiracion"]').val(data.expired_date_spot);
               $('#modal_form').modal('show');
               $('.modal-title').text('Modificar spot');
   
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
           url = "<?php echo site_url('spot/ajax_add') ?>";
       } else {
           url = "<?php echo site_url('spot/ajax_update') ?>";
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
                          toastr["info"]('Spot agregado');                    
               } else {
                          toastr["info"]('Spot actualizado');
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
   
   function delete_spot(id)
   {
       if (confirm('¿borrar spot?'))
       {
           $.ajax({
               url: "<?php echo site_url('spot/ajax_delete') ?>/" + id,
               type: "POST",
               dataType: "JSON",
               success: function (data)
               {
                   $('#modal_form').modal('hide');
                   reload_table();
                   toastr["info"]('Spot eliminado');
               },
               error: function (jqXHR, textStatus, errorThrown)
               {
                   toastr["error"]('Error borrando spot');
               }
           });
   
       }
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
                     <label class="control-label col-md-3" for="codigo">Codigo: </label>
                     <div class="col-md-4">
                        <input name="codigo" id="codigo" placeholder="Código" class="form-control" type="text" />
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3" for="version">Versión: </label>
                     <div class="col-md-4">
                        <input name="version" id="version" placeholder="Versión" class="form-control" type="text" />
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3" for="cliente">Cliente: </label>
                     <div class="col-md-4">
                        <input name="cliente" id="cliente" placeholder="Cliente" class="form-control" type="text" />
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3" for="estacion">Estación: </label>
                     <div class="col-md-6">
                        <select name="estacion" class="form-control" id="estacion">
                           <option value="">-- Estación --</option>
                           <?php
                              foreach ($list as $value) {
                                  echo '<option value="' . $value->id_sta . '">' . $value->acronym_sta.' '.$value->name_sta . '</option>';
                              }
                              ?>
                        </select>
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-3" for="expiracion">Vigencia: </label>
                     <div class="col-md-3">
                        <input type="text" name="expiracion" placeholder="Vigencia" class="form-control datepicker" />
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
<script type="text/javascript">
   $('.datepicker').datepicker({
       autoclose: true,
       language: 'es',
       todayHighlight: true,
       format: "yyyy-mm-dd",
       todayBtn: 'linked',
       orientation: "top left"
   });
</script>
</body>
</html>