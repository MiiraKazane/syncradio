<!DOCTYPE html>
<head>
    <title><?= $titulo ?></title>
    <link rel="stylesheet" href="<?= (CSS . 'dataTables.bootstrap.css'); ?>" />

    <?php $ci =& get_instance();
    $ci->load->view("navbar_view"); ?>
</head>

<div class="content-wrapper">
            <section class="content-header">
              <h1><i class="fa fa-podcast" aria-hidden="true"></i> Estaciones</h1>
              <ol class="breadcrumb">
                <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Estaciones</li>
                </ol>
            </section><br><br>
        <div class="container-fluid">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>  
                        <th>Logo</th>
                        <th>Estación</th>
                        <th>Frecuencia</th>
                        <th>Clave</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($estaciones as $row): ?>
                        <tr>
                            <td class="text-center">
                                <img class="img-thumbnail" src="<?= $row->image_sta ?>" height="100" width="100">
                            </td>
                            <td><?= $row->name_sta; ?></td>
                            <td><?= $row->frequency_sta; ?></td>
                            <td><?= $row->acronym_sta; ?></td>
                            <td><?= $row->telephone_sta; ?></td>
                        </tr>    
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

        <script src ="<?= (JS . 'jquery.dataTables.min.js'); ?>"></script>
        <script src ="<?= (JS . 'dataTables.bootstrap.js'); ?>"></script>

    </body>
</html>
