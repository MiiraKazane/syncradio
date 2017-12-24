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
      <h1><i class="fa fa-users" aria-hidden="true"></i> Editar<small>empleado</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="<?= (SITE . 'employee'); ?>"><i class="fa fa-users"> Empleados</a></i>
        <li class="active">Editar empleado</li>
      </ol>
    </section><br><br>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-body">
    <?php $hidden = array('id' => $emp->id_emp); ?>
    <?php $attr = array('name' => 'form', 'id' => 'form', 'class' => 'form-horizontal'); ?>
    <?php echo form_open_multipart('employee/alter_employee', $attr, $hidden);?>
<fieldset>

    <!-- Select Basic -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="rol">Rol:</label>
      <div class="col-md-2">
        <select id="rol" name="rol" class="form-control">
          <option value="1" <?= $emp->tipo_log!=1?'selected':'';?>>Administrador</option>
          <option value="2" <?= $emp->tipo_log!=1?'selected':'';?>>Usuario</option>
        </select>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="usuario">Usuario: </label>  
      <div class="col-md-2">
      <input id="usuario" name="usuario" type="text" placeholder="Ingresa usuario" class="form-control input-md" required="" value="<?= $emp->usu_emp ?>">
      <span class="help-block">(Con el que inicia sesión)</span>  
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="contrasena">Contraseña: </label>  
      <div class="col-md-2">
      <input id="contrasena" name="contrasena" type="text" placeholder="Ingresa contraseña" class="form-control input-md" required="" value="<?= $emp->pass_emp ?>">
        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="apellido">Apellido(s): </label>  
      <div class="col-md-3">
      <input id="apellido" name="apellido" type="text" placeholder="Ingresa apellido(s)" class="form-control input-md" required="" value="<?= $emp->lastname_emp ?>">
        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="nombre">Nombre(s): </label>  
      <div class="col-md-3">
      <input id="nombre" name="nombre" type="text" placeholder="Ingresa nombre" class="form-control input-md" required="" value="<?= $emp->name_emp ?>">
        
      </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="selectbasic">departamento</label>
      <div class="col-md-2">
        <select name="departamento" id="departamento2" class="form-control">
            <?php 
                foreach($list as $dep):
                
                  $selected = ($dep->id_dep == $emp->id_dep) ? ' selected="selected"' : "";

                  echo '<option value="'.$dep->id_dep.'" '.$selected.'>'.$dep->name_dep.'</option>';
                endforeach; 
              ?>
        </select>
      </div>
    </div>
    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="textinput">puesto</label>  
      <div class="col-md-2">
      <input id="puesto" name="puesto" type="text" placeholder="Ingresa puesto" class="form-control input-md" required="" value="<?= $emp->job_emp ?>">
        
      </div>
    </div>

    <!-- Select Basic -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="estatus">Estatus: </label>
      <div class="col-md-2">
        <select id="estatus" name="estatus" class="form-control">
          <option value="sindicato" <?= $emp->contract_emp!=1?'selected':'';?>>Sindicato</option>
          <option value="de confianza" <?= $emp->contract_emp!=1?'selected':'';?>>De confianza</option>
        </select>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="telefono">Teléfono: </label>  
      <div class="col-md-2">
      <input id="telefono" name="telefono" type="text" placeholder="Escribe teléfono" class="form-control input-md" required="" value="<?= $emp->telephone_emp ?>">
      <span class="small">(Solo numeros)</span>  
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="email">Email: </label>  
      <div class="col-md-2">
      <input id="email" name="email" type="text" placeholder="Escribe email" class="form-control input-md" required="" value="<?= $emp->email_emp ?>">
        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="fecha_nacimiento">Fecha nacimiento: </label>  
      <div class="col-md-2">
      <input id="fecha_nacimiento" name="fecha_nacimiento" type="text" placeholder="Fecha de nacimiento" class="form-control input-md datepicker" required="" value="<?= $emp->birth_date_emp ?>">
        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="ingreso">Ingreso:</label>  
      <div class="col-md-2">
      <input id="ingreso" name="ingreso" type="text" placeholder="Fecha de ingreso" class="form-control input-md datepicker" required="" value="<?= $emp->hire_date_emp ?>">
        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="rfc">RFC: </label>  
      <div class="col-md-2">
      <input id="rfc" name="rfc" type="text" placeholder="Ingresa RFC" class="form-control input-md" required="" value="<?= $emp->rfc_emp ?>">
        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="curp">Curp: </label>  
      <div class="col-md-2">
      <input id="curp" name="curp" type="text" placeholder="Ingresa CURP" class="form-control input-md" required="" value="<?= $emp->curp_emp ?>">
        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="nss">NSS: </label>  
      <div class="col-md-2">
      <input id="nss" name="nss" type="text" placeholder="Ingresa NSS" class="form-control input-md" required="" value="<?= $emp->nss_emp ?>">
        
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="sbc">SBC: </label>  
      <div class="col-md-2">
      <input id="sbc" name="sbc" type="text" placeholder="Ingresa SBC" class="form-control input-md" required="" value="<?= $emp->sbc_emp ?>">
      <span class="small">(Enteros o decimales)</span>
      </div>
    </div>

    <!-- Text input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="rs">Razón social: </label>  
      <div class="col-md-4">
      <input id="rs" name="rs" type="text" placeholder="Ingresa razón social" class="form-control input-md" required="" value="<?= $emp->social_reason_emp ?>">
        
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
    $('.datepicker').datepicker({
        autoclose: true,
        language: 'es',
        todayHighlight: true,
        format: "yyyy-mm-dd",
        todayBtn: 'linked'
    });
  </script>
</html>