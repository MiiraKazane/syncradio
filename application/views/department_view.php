<!DOCTYPE html>
<head>
   <title><?= $titulo ?></title>
   <link rel="stylesheet" href="<?= (CSS . 'dataTables.bootstrap.css'); ?>" />
   <link rel="stylesheet" href="<?= (CSS . 'bootstrap-datepicker.min.css'); ?>" />
   <link rel="stylesheet" href="<?= (CSS . 'toastr.min.css'); ?>" />
</head>
<?php $ci =& get_instance();
   $ci->load->view("navbar_view"); ?>
<div class="content-wrapper">
   <div class="container-fluid">
      <section class="content-header">
         <h1><i class="fa fa-address-book-o" aria-hidden="true"></i> Departamentos</h1>
         <ol class="breadcrumb">
            <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Departamentos</li>
         </ol>
      </section>
      <br><br>
      <button class="btn btn-default btn-sm" onclick="add_department()" data-toggle="tooltip" title="Nuevo departamento"><i class="glyphicon glyphicon-plus"></i> Nuevo</button>
      <br><br>
      <!-- <button class="btn btn-default" onclick="reload_table()" data-toggle="tooltip" title="Actualizar registros"><i class="glyphicon glyphicon-refresh"></i> Recargar</button>-->
      <table id="table" class="table table-hover table-bordered" width="100%">
         <thead>
            <tr>
               <th>Nombre</th>
               <th>Extensión telefónica</th>
               <th>N° empleados</th>
               <th style="width:50px;"></th>
            </tr>
         </thead>
         <tbody>
         </tbody>
      </table>
   </div>
</div>
<script src ="<?= (JS . 'jquery.dataTables.min.js'); ?>"></script>
<script src ="<?= (JS . 'dataTables.bootstrap.js'); ?>"></script>
<script src ="<?= (JS . 'datepicker.js'); ?>"></script>
<script src ="<?= (JS . 'bootstrap-datepicker.es.js'); ?>"></script>
<script src ="<?= (JS . 'toastr.min.js'); ?>"></script>
<script type="text/javascript">
   var save_method; //for save method string
   var table;
   
   $(document).ready(function() {
   
       //datatables
       table = $('#table').DataTable({ 
   
           "processing": true,
           "serverSide": true,
           "searching": false,
           "order": [],
           "columnDefs": [
                           {
                               "targets": [2,3], //last column
                               "orderable": false //set not orderable
                           }
                       ],
           "ajax": {
               "url": "<?php echo site_url('department/ajax_list') ?>",
               "type": "POST" },
           "language": {
                   "lengthMenu": "Mostrar _MENU_ departamentos por pagina",
                   "zeroRecords": "No hay empleados",
                   "search": "Buscar:",
                   "info": "",
                   "infoEmpty": "0 registros disponibles",
                   "sProcessing": "Procesando...",
                   "sEmptyTable": "Ningún dato disponible en esta tabla",
                   "sLoadingRecords": "Cargando...",
                   "oPaginate": {
               "sFirst":    "Primero",
               "sLast":     "Último",
               "sNext":     "Siguiente",
               "sPrevious": "Anterior"
           },
                   "infoFiltered": ""
               }
       });
   
        $('body').tooltip({
           selector: '[data-toggle="tooltip"]',
           placement : 'top',
           trigger : 'hover'
       });
        
       $("input").change(function(){
           $(this).parent().parent().removeClass('has-error');
           $(this).next().empty();
       });
       $("textarea").change(function(){
           $(this).parent().parent().removeClass('has-error');
           $(this).next().empty();
       });
       $("select").change(function(){
           $(this).parent().parent().removeClass('has-error');
           $(this).next().empty();
       });
   
     });
   
   function add_department() {
       save_method = 'add';
       $('#form')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
       $('#modal_form').modal('show'); // show bootstrap modal
       $('.modal-title').text('Nuevo departamento'); // Set Title to Bootstrap modal title
   }
   
   function edit_department(id) {
   
       save_method = 'update';
       $('#form')[0].reset(); // reset form on modals
       $('.form-group').removeClass('has-error'); // clear error class
       $('.help-block').empty(); // clear error string
   
       //Ajax Load data from ajax
       $.ajax({
           url : "<?= site_url('department/ajax_edit/') ?>/" + id,
           type: "GET",
           dataType: "JSON",
           success: function(data)
           {
   
               $('[name="id"]').val(data.id_dep);
               $('[name="nombre"]').val(data.name_dep);
               $('[name="extension"]').val(data.extension_dep);
               $('#modal_form').modal('show'); 
               $('.modal-title').text('Modificar departamento');
   
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
               toastr["error"]('Error obteniendo datos');
           }
       });
   }
   
   function reload_table() {
       table.ajax.reload(null,false);
   }
   
   function save() {
       $('#btnSave').text('Guardando...'); 
       $('#btnSave').attr('disabled',true); 
       var url;
   
       if(save_method == 'add') {
           url = "<?php echo site_url('department/ajax_add') ?>";
       } else {
           url = "<?php echo site_url('department/ajax_update') ?>";
       }
   
       $.ajax({
           url : url,
           type: "POST",
           data: $('#form').serialize(),
           dataType: "JSON",
           success: function(data)
           {
   
               if(data.status) {
                   $('#modal_form').modal('hide');
                   reload_table();
   
                   if (save_method == 'add') {
                                  toastr["info"]('Departamento agregado');                    
                       } else {
                                  toastr["info"]('Departamento actualizado');
                       }
   
               }else
               {
                   for (var i = 0; i < data.inputerror.length; i++)
                   {
                       $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                       $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                   }
               }
               $('#btnSave').text('Guardar');
               $('#btnSave').attr('disabled',false);
           },
           error: function (jqXHR, textStatus, errorThrown) {
               toastr["error"]('Error adding / update data');
               $('#btnSave').text('Guardar');
               $('#btnSave').attr('disabled', false);
               }
           });
       }
   
       function delete_department(id)
       {
           if (confirm('¿borrar departamento?'))
           {
               $.ajax({
                   url: "<?php echo site_url('department/ajax_delete') ?>/" + id,
                   type: "POST",
                   dataType: "JSON",
                   success: function (data)
                   {
                       $('#modal_form').modal('hide');
                       reload_table();
                       toastr["info"]('Departamento eliminado');
                   },
                   error: function (jqXHR, textStatus, errorThrown)
                   {
                       toastr["error"]('Error eliminando departamento');
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
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"></h3>
         </div>
         <div class="modal-body form">
            <form action="#" id="form" class="form-horizontal">
               <input type="hidden" value="" name="id"/> 
               <div class="form-body">
                  <div class="form-group">
                     <label class="control-label col-md-2" for="nombre">Nombre: </label>
                     <div class="col-md-7">
                        <input name="nombre" id="nombre" placeholder="Ingresa nombre" class="form-control" type="text" autofocus>
                        <span class="help-block"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-md-2" for="extension">Extensión: </label>
                     <div class="col-md-2">
                        <input name="extension" id="extension" placeholder="# ext" class="form-control" type="text">
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
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- End Bootstrap modal -->
</body>
</html>
