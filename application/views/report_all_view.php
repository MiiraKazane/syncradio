<!DOCTYPE html>
<head>
    <title><?= $titulo ?></title>
    <link rel="stylesheet" href="<?= (CSS . 'dataTables.bootstrap.css'); ?>" />
    <link rel="stylesheet" href="<?= (CSS . 'toastr.min.css'); ?>" />

</head>

<?php $ci =& get_instance();
$ci->load->view("navbar_view"); ?>

<div class="content-wrapper">
    <section class="content-header">
      <h1><i class="fa fa-list-ol" aria-hidden="true"></i> Reporte<small>Completo</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Reporte completo</li>
      </ol>
    </section>
    <div class="container-fluid">
    <p><h3>Descripción:</h3> <?= $reporte->description ?></p>

    <table class="table table-default table-condensed">
        <tr class="text-center">
            <td><p><h3>Folio</h3> <span class="text-info"><?= $reporte->folio ?></span></p></td>
            <td class="hidden-xs"><p><h3>Prioridad</h3> <?= see_tipo_reporte($reporte->priority); ?></p></td>
            <td class="hidden-xs"><p><h3>Categoría</h3> <?= $reporte->name_cat ?></p></td>
            <td><p><h3>Fecha</h3> <?= format_date($reporte->date_in) ?></p></td>
            <td><p><h3>Hora</h3> <?= $reporte->time_in ?></p></td>
            <td class="<?= color_status($reporte->status); ?>"><h3>Estatus</h3> <?= see_status($reporte->status); ?></td>
        </tr>
    </table>
    
    <script>
        function valida()
        {
            if (document.form.comentario.value === "")
            {
                toastr["warning"]('Escribe comentario');
                document.form.comentario.focus();
                return false;
            }else{
                save_comment();
            } 
        }
    </script>
    <div class="panel panel-info">
        <div class="panel-body col-xs-12 col-sm-12 col-md-12 col-lg-12">
     <table id="table" class="table table-responsive">
        <thead>
            <tr><th style="width: 80px"></th><th></th></tr>
        </thead>
        <tbody>
        </tbody>
    </table>   
        </div>
    </div>

    <form action="#" id="form" name="form" class="form-horizonta">
        <input type="hidden" value="<?php echo $reporte->id; ?>" name="id"/> 
            <div class="form-group">
                <textarea name="comentario" id="comentario" placeholder="Escribe un comentario..." class="form-control" type="text" required=""></textarea>
                <br>
                <button type="button" id="btnSave" onclick="return valida()" class="btn btn-default btn-round-lg">Enviar</button>
            </div>
    </form>
    </div>
</div>

</body>
        <script src ="<?= (JS . 'jquery.dataTables.min.js'); ?>"></script>
        <script src ="<?= (JS . 'dataTables.bootstrap.js'); ?>"></script>
        <script src ="<?= (JS . 'toastr.min.js'); ?>"></script>

   <script type="text/javascript">

var table;
 var id = '<?= $reporte->id; ?>'
    $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({ 
            
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('comment/ajax_comments/') ?>/" + id,
                "type": "POST" },
                "paging": false,
                "searching": false,
                "ordering": false,
                "order": [[ 0, "desc" ]],
                "language": {
                            "lengthMenu": "Mostrar _MENU_ reportes por página",
                            "zeroRecords": "No hay comentarios todavía",
                            "search": "Buscar:",
                            "info": "",
                            "infoFiltered": " ",
                            "infoEmpty": "",
                            "sProcessing": "Procesando...",
                            "sEmptyTable": "Ningún dato disponible en esta tabla",
                            "sLoadingRecords": "Cargando...",
                        }
            });
        });

    setInterval( function () {
        table.ajax.reload();
    }, 10000 );

    function reload_table() {
        table.ajax.reload(null,false);
        document.form.comentario.value = "";
         document.getElementById("comentario").focus();
    }
    
    function save_comment() {

        $.ajax({
            url : "<?php echo site_url('comment/ajax_add_comment') ?>",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                    reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                 toastr["error"]('Primero ingresa comentario');
              }
            });
        }

    toastr.options = {
        "newestOnTop": false,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
        "positionClass": "toast-bottom-center"
    }
    </script>

</html>
