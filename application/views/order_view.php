<!DOCTYPE html>
<html>
   <head>
      <title>SyncRadio - Ordenes</title>
      <link rel="stylesheet" href="<?= (CSS . 'dataTables.bootstrap.css'); ?>" />
   </head>
   <?php $ci =& get_instance();
      $ci->load->view("navbar_view"); ?>
   <div class="content-wrapper">
      <div class="container-fluid">
         <section class="content-header">
            <h1><i class="fa fa-file-excel-o"></i> Ordenes</h1>
            <ol class="breadcrumb">
               <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
               <li class="active">Ordenes</li>
            </ol>
         </section>
         <br><br>
         <div class="container-fluid">
            <?php if($this->session->userdata('tipo') == '1'): ?>
            <a class="btn btn-sm btn-default" data-toggle="tooltip" title="Nueva orden" href="<?= SITE ?>order/add_order"><i class="fa fa-file-excel-o"></i> Nueva</a>
            <?php endif; ?>
            <br><br>
            <?php if(isset($orders)): ?>
            <table id="table" class="table table-hover table-bordered">
               <thead>
                  <tr>
                     <th>Número</th>
                     <th>Contrato</th>
                     <th>Cliente</th>
                     <th>Versión</th>
                     <th>Estación</th>
                     <th>Tipo</th>
                     <?php if($this->session->userdata('tipo') == '1'): ?>
                     <th style="width:50px;"></th>
                     <?php endif; ?>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($orders as $row): ?>
                  <tr>
                     <td class="text-danger"><?= $row->number ?></td>
                     <td><?= $row->contract ?></td>
                     <td><?= $row->customer ?></td>
                     <td><?= $row->version ?></td>
                     <td><?= $row->acronym_sta ?></td>
                     <td><?= $row->kind_order ?></td>
                     <?php if($this->session->userdata('tipo') == '1'): ?>
                     <td>
                        <div class="dropdown">
                           <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Acciones 
                           <span class="caret"></span></button>
                           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <li><a href="<?= SITE ?>order/see_order/<?= $row->id ?>"><i class="glyphicon glyphicon-eye-open"></i> Ver</a></li>
                              <li><a href="<?= SITE ?>order/edit_order/<?= $row->id ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a></li>
                              <li><a href="<?= SITE ?>order/delete_order/<?= $row->id ?>" onclick="return confirmar()"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a></li>
                           </div>
                        </div>
                     </td>
                     <?php endif; ?>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
            <?php endif; ?>
         </div>
      </div>
   </div>
   <script src ="<?= (JS . 'jquery.dataTables.min.js'); ?>"></script>
   <script src ="<?= (JS . 'dataTables.bootstrap.js'); ?>"></script>
   <script type="text/javascript">
      var table;
      $(document).ready(function () {
          table = $('#table').DataTable({
              "language": {
                  "lengthMenu": "Mostrar _MENU_ ordenes por pagina",
                  "zeroRecords": "No hay ordenes",
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
      });
      
      function confirmar()
      {
      if(confirm('¿Borrar orden?'))
      return true;
      else
      return false;
      }
   </script>
   </body>
</html>
