<!DOCTYPE html>
<head>
    <title><?= $titulo ?></title>
    <link rel="stylesheet" href="<?= (CSS . 'dataTables.bootstrap.css'); ?>" />
    <link rel="stylesheet" href="<?= (CSS . 'bootstrap-datepicker.min.css'); ?>" />
</head>
  
  <?php $ci =& get_instance();
    $ci->load->view("navbar_view"); ?>


<div class="content-wrapper">
        <section class="content-header">
      <h1><i class="fa fa-plus" aria-hidden="true"></i> Nuevo<small>empleado</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="<?= (SITE . 'employee'); ?>"><i class="fa fa-users"> Empleados</a></i>
        <li class="active">Nuevo empleado</li>
      </ol>
    </section><br><br>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-body">
    <?php $attr = array('name' => 'form', 'id' => 'form', 'class' => 'form-horizontal'); ?>
    <?php echo form_open_multipart('employee/save_employee', $attr);?>
  <fieldset>
    <input type="hidden" value="" name="id"/> 
    <div class="form-group">
      <label class="col-md-4 control-label" for="userfile">Foto: </label>
      <div class="col-md-2">
        <input id="userfile" name="userfile" class="input-file" type="file" required="">
        <span class="help-block">(Recomendado 500 x 500)</span> 
      </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="rol">Rol:</label>
      <div class="col-md-2">
        <select id="rol" name="rol" class="form-control">
          <option value="1">Administrador</option>
          <option value="2">Usuario</option>
          <option value="3">Grabador</option>
          <option value="4">Continuista</option>
        </select>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="usuario">Usuario: </label>  
      <div class="col-md-2">
      <input id="usuario" name="usuario" type="text" placeholder="Ingresa usuario" class="form-control input-md" required=""><div id="Info"></div> 
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="contrasena">Contraseña: </label>  
      <div class="col-md-2">
      <input id="contrasena" name="contrasena" type="text" placeholder="Ingresa contraseña" class="form-control input-md" required="">
        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="apellido">Apellido(s): </label>  
      <div class="col-md-3">
      <input id="apellido" name="apellido" type="text" placeholder="Ingresa apellido(s)" class="form-control input-md" required="">
        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="nombre">Nombre(s): </label>  
      <div class="col-md-3">
      <input id="nombre" name="nombre" type="text" placeholder="Ingresa nombre" class="form-control input-md" required="">
        
      </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="selectbasic">departamento</label>
      <div class="col-md-2">
        <select name="departamento" id="departamento2" class="form-control">
          <?php
          foreach($list as $value):
              echo '<option value="' . $value->id_dep . '">' . $value->name_dep . '</option>';
          endforeach;
          ?>
        </select>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="textinput">puesto</label>  
      <div class="col-md-2">
      <input id="puesto" name="puesto" type="text" placeholder="Ingresa puesto" class="form-control input-md" required="">
        
      </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="estatus">Estatus: </label>
      <div class="col-md-2">
        <select id="estatus" name="estatus" class="form-control">
          <option value="sindicato">Sindicato</option>
          <option value="de confianza">De confianza</option>
        </select>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="telefono">Teléfono: </label>  
      <div class="col-md-2">
      <input id="telefono" name="telefono" type="text" placeholder="Escribe teléfono" class="form-control input-md" >
      <span class="help-block">(Solo numeros)</span>  
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="email">Email: </label>  
      <div class="col-md-2">
      <input id="email" name="email" type="email" placeholder="Escribe email" class="form-control input-md" >
        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="fecha_nacimiento">Fecha nacimiento: </label>  
      <div class="col-md-2">
      <input id="fecha_nacimiento" name="fecha_nacimiento" type="text" placeholder="Fecha de nacimiento" class="form-control input-md datepicker" >
        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="ingreso">Ingreso:</label>  
      <div class="col-md-2">
      <input id="ingreso" name="ingreso" type="text" placeholder="Fecha de ingreso" class="form-control input-md datepicker" >
        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="rfc">RFC: </label>  
      <div class="col-md-2">
      <input id="rfc" name="rfc" type="text" placeholder="Ingresa RFC" class="form-control input-md">
        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="curp">Curp: </label>  
      <div class="col-md-2">
      <input id="curp" name="curp" type="text" placeholder="Ingresa CURP" class="form-control input-md">
        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="nss">NSS: </label>  
      <div class="col-md-2">
      <input id="nss" name="nss" type="text" placeholder="Ingresa NSS" class="form-control input-md">
        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="sbc">SBC: </label>  
      <div class="col-md-2">
      <input id="sbc" name="sbc" type="text" placeholder="Ingresa SBC" class="form-control input-md">
      <span class="help-block">(Solo numeros enteros o decimales)</span>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="rs">Razón social: </label>  
      <div class="col-md-2">
      <input id="rs" name="rs" type="text" placeholder="Ingresa razón social" class="form-control input-md">
        
      </div>
    </div>

    <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-2">
        <button id="submit" name="submit" class="btn btn-inverse">Aceptar</button>
      </div>
    </div>
  </fieldset>
<?= form_close(); ?>
      </div>
    </div>
  </div>
</div>
              
  <script src ="<?= (JS . 'jquery.dataTables.min.js'); ?>"></script>
  <script src ="<?= (JS . 'dataTables.bootstrap.js'); ?>"></script>
  <script src ="<?= (JS . 'datepicker.js'); ?>"></script>
  <script src ="<?= (JS . 'bootstrap-datepicker.es.js'); ?>"></script>

</body>

  <script type="text/javascript">
$(document).ready(function() {    
    $('#usuario').change(function(){

        $('#Info').html('<img src="<?= IMG.'ajax-loader.gif' ?>">').fadeOut(500);

        var username = $(this).val();        
        if(username != ''){
        var dataString = 'username='+username;

        $.ajax({
            type: "POST",
            url: "<?php echo SITE ?>employee/if_exist",
            data: dataString,
            success: function(data) {
                $('#Info').fadeIn(500).html(data);
            }

        });
      }
    });              
});    

    $('.datepicker').datepicker({
        autoclose: true,
        language: 'es',
        todayHighlight: true,
        format: "yyyy-mm-dd",
        todayBtn: 'linked'
    });
  </script>
</html>