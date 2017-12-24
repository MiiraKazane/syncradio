<!DOCTYPE html>
<html>
    <head> 
        <title><?= $titulo ?></title>
        <link rel="stylesheet" href="<?= (CSS . 'dataTables.bootstrap.css'); ?>" />
    </head> 
    <?php $ci =& get_instance();
    $ci->load->view("navbar_view"); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <section class="content-header">
      <h1><i class="fa fa-users" aria-hidden="true"></i> Empleados</h1>
      <ol class="breadcrumb">
        <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Empleados</li>
      </ol>
    </section><br><br>
    <div class="container-fluid">
        <a class="btn btn-sm btn-default" data-toggle="tooltip" title="Nuevo empleado" href="<?= SITE ?>employee/add_employee"><i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo</a>
        <br><br>
        <?php if(isset($employees)): ?>
        <table id="table" class="table table-hover table-bordered">
            <thead>
                <tr>  
                    <th>Apellido(s)</th>
                    <th>Nombre(s)</th>
                    <th>Departamento</th>
                    <th>Puesto</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $row): ?>
                    <tr>
                        <td><?= $row->lastname_emp ?></td>
                        <td><?= $row->name_emp ?></td>
                        <td><?= $row->name_dep ?></td>
                        <td><?= $row->job_emp ?></td>
                        <td><?= $row->telephone_emp ?></td>
                        <td><?= $row->email_emp ?></td>
                        <td>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Acciones 
                              <span class="caret"></span></button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a href="<?= SITE ?>profile/see_profile/<?= $row->id_emp ?>"><i class="glyphicon glyphicon-eye-open"></i> Perfil</a></li>
                                <li><a href="<?= SITE ?>employee/edit_employee/<?= $row->id_emp ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a></li>
                                <li><a href="<?= SITE ?>employee/delete_employee/<?= $row->id_emp ?>" onclick="return confirmar()"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a></li>
                              </div>
                            </div>
                        </td>
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
            "columnDefs": [
                    {
                        "targets": [3,4,5,6],
                        "orderable": false
                    }
                        ], 
                "language": {
                    "lengthMenu": "Mostrar _MENU_ empleados por pagina",
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
        });

        function confirmar()
{
    if(confirm('¿Borrar empleado?'))
        return true;
    else
        return false;
}
    </script>
    </body>
</html>