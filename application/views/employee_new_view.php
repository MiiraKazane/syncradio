<!DOCTYPE html>
<head>
   <title>SyncRadio | Nuevo empleado</title>
   <link rel="stylesheet" href="<?= (CSS . 'dataTables.bootstrap.css'); ?>" />
   <link rel="stylesheet" href="<?= (CSS . 'bootstrap-datepicker.min.css'); ?>" />
   <link rel="stylesheet" href="<?= (CSS . 'toastr.min.css'); ?>" />
</head>
<?php $ci =& get_instance();
   $ci->load->view("navbar_view"); ?>
<div class="content-wrapper">
   <section class="content-header">
      <h1><i class="fa fa-plus"></i> Nuevo empleado</h1>
      <ol class="breadcrumb">
         <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
         <li><a href="<?= (SITE . 'employee'); ?>"><i class="fa fa-users"> Empleados</a></i>
         <li class="active">Nuevo empleado</li>
      </ol>
   </section>
   <br><br>
   <div class="container-fluid">
      <div class=" col-md-10 col-md-offset-1 panel panel-info">
         <div class="panel-body">
            <?php $attr = array('name' => 'form', 'id' => 'form', 'class' => 'form-horizontal'); ?>
            <?php echo form_open_multipart('employee/add_employee', $attr);?>
            <fieldset>
               <input type="hidden" value="" name="id"/> 
               <div class="form-group">
                  <div class="col-md-3 col-md-offset-5 col-sm-3 col-sm-offset-5">
                     <label class="control-label" for="userfile">Foto</label>
                     <input id="userfile" name="userfile" type="file" required="required">
                     <span class="help-block">(jpg | 500 x 500)</span> 
                  </div>
               </div>
               <div class="form-group">
                  <span class="text-info">
                     <legend>Detalles de inicio de sesión</legend>
                  </span>
                  <div class="row">
                     <!-- primera columna -->
                     <div class="col-md-3 col-sm-3">
                        <label class="control-label" for="rol">Rol</label>
                        <select id="rol" name="rol" class="form-control">
                           <option value="1">Administrador</option>
                           <option value="2">Usuario</option>
                           <option value="3">Grabador</option>
                           <option value="4">Continuista</option>
                        </select>
                     </div>
                     <!-- segunda columna -->
                     <div class="col-md-5 col-sm-5">
                        <label class="control-label" for="usuario">Usuario</label>
                        <input id="usuario" name="usuario" type="text" placeholder="usuario" class="form-control input-md">
                        <div id="Info"></div>
                     </div>
                     <!-- tercera columna -->
                     <div class="col-md-4 col-sm-4">
                        <label class="control-label" for="contrasena">Contraseña</label>  
                        <input id="contrasena" name="contrasena" type="text" placeholder="contraseña" class="form-control input-md">
                     </div>
                  </div>
               </div>
               <br>
               <div class="form-group">
                  <span class="text-info">
                     <legend>Datos generales</legend>
                  </span>
                  <div class="row">
                     <!-- primera columna -->
                     <div class="col-md-4 col-sm-4">
                        <label class="control-label" for="apellido">Apellido(s)</label>  
                        <input id="apellido" name="apellido" type="text" placeholder="apellido(s)" class="form-control input-md">
                     </div>
                     <!-- segunda columna -->
                     <div class="col-md-5 col-sm-5">
                        <label class="control-label" for="nombre">Nombre(s)</label>  
                        <input id="nombre" name="nombre" type="text" placeholder="nombre" class="form-control input-md">
                     </div>
                     <!-- tercera columna -->
                     <div class="col-md-3 col-sm-3">
                        <label class="control-label" for="selectbasic">Departamento</label>
                        <select name="departamento" id="departamento2" class="form-control">
                        <?php
                           foreach($list as $value):
                               echo '<option value="' . $value->id_dep . '">' . $value->name_dep . '</option>';
                           endforeach;
                           ?>
                        </select> 
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="row">
                     <!-- primera columna -->
                     <div class="col-md-4 col-sm-4">
                        <label class="control-label" for="textinput">Puesto</label>  
                        <input id="puesto" name="puesto" type="text" placeholder="puesto" class="form-control input-md">
                     </div>
                     <!-- segunda columna -->
                     <div class="col-md-4 col-sm-4">
                        <label class="control-label" for="estatus">Estatus</label>
                        <select id="estatus" name="estatus" class="form-control">
                           <option value="sindicato">Sindicato</option>
                           <option value="de confianza">De confianza</option>
                        </select>
                     </div>
                     <!-- tercera columna -->
                     <div class="col-md-4 col-sm-4">
                        <label class="control-label" for="telefono">Teléfono</label>  
                        <input id="telefono" name="telefono" type="text" placeholder="Escribe teléfono" class="form-control input-md" >
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="row">
                     <!-- primera columna -->
                     <div class="col-md-4 col-sm-4">
                        <label class="control-label" for="email">E-mail</label>  
                        <input id="email" name="email" type="email" placeholder="Escribe email" class="form-control input-md" >
                     </div>
                     <!-- segunda columna -->
                     <div class="col-md-4 col-sm-4">
                        <label class="control-label" for="fecha_nacimiento">Fecha nacimiento</label>  
                        <input id="fecha_nacimiento" name="fecha_nacimiento" type="text" placeholder="Fecha de nacimiento" class="form-control input-md datepicker">
                     </div>
                     <!-- tercera columna -->
                     <div class="col-md-4 col-sm-4">
                        <label class="control-label" for="ingreso">Ingreso</label>  
                        <input id="ingreso" name="ingreso" type="text" placeholder="Fecha de ingreso" class="form-control input-md datepicker">
                     </div>
                  </div>
               </div>
               <br>
               <div class="form-group">
                  <span class="text-danger">
                     <legend>Datos de nómina</legend>
                  </span>
                  <br>
                  <div class="row">
                     <!-- primera columna -->
                     <div class="col-md-4 col-sm-4">
                        <label class="control-label" for="rfc">RFC</label>  
                        <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="rfc" name="rfc" type="text" placeholder="RFC" class="form-control input-md">
                     </div>
                     <!-- segunda columna -->
                     <div class="col-md-4 col-sm-4">
                        <label class="control-label" for="curp">Curp</label>  
                        <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="curp" name="curp" type="text" placeholder="CURP" class="form-control input-md"> 
                     </div>
                     <!-- tercera columna -->
                     <div class="col-md-4 col-sm-4">
                        <label class="control-label" for="nss">NSS</label>  
                        <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="nss" name="nss" type="text" placeholder="NSS" class="form-control input-md">
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="row">
                     <!-- primera columna -->
                     <div class="col-md-2 col-sm-2">
                        <label class="control-label" for="sbc">SBC</label>  
                        <input id="sbc" name="sbc" type="text" placeholder="SBC" class="form-control input-md">
                        <span class="help-block"><small>(Enteros o decimales)</small></span>
                     </div>
                     <!-- segunda columna -->
                     <div class="col-md-6 col-sm-6">
                        <label class="control-label" for="rs">Razón social</label>  
                        <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="rs" name="rs" type="text" placeholder="razón social" class="form-control input-md">
                     </div>
                  </div>
               </div>
               <!-- Button -->
               <div class="form-group">
                  <div class="col-md-12">
                     <button id="submit" name="submit" onclick="return valida();" class="btn btn-info center-block">Aceptar</button>
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
<script src ="<?= (JS . 'toastr.min.js'); ?>"></script>
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
   
     function valida(){
   
       if (document.form.usuario.value == ""){
           toastr["error"]('Ingresa usuario');
           document.form.usuario.focus();
           return false;
       }
       if (document.form.contrasena.value == ""){
           toastr["error"]('Ingresa contraseña');
           document.form.contrasena.focus();
           return false;
       }
       if (document.form.apellido.value == ""){
           toastr["error"]('Ingresa apellidos');
           document.form.apellido.focus();
           return false;
       }
       if (document.form.nombre.value == ""){
           toastr["error"]('Ingresa nombre');
           document.form.nombre.focus();
           return false;
       }
       if (document.form.puesto.value == ""){
           toastr["error"]('Ingresa puesto');
           document.form.puesto.focus();
           return false;
       }
       if (document.form.telefono.value == ""){
           toastr["error"]('Ingresa telefono');
           document.form.telefono.focus();
           return false;
       }
       if (document.form.email.value == ""){
           toastr["error"]('Ingresa E-mail');
           document.form.email.focus();
           return false;
       }
       if (document.form.ingreso.value == ""){
           toastr["error"]('Selecciona fecha de ingreso');
           document.form.ingreso.focus();
           return false;
       }
       if (document.form.rfc.value == ""){
           toastr["error"]('Ingresa RFC');
           document.form.rfc.focus();
           return false;
       }
       if (document.form.curp.value == ""){
           toastr["error"]('Ingresa CURP');
           document.form.curp.focus();
           return false;
       }
       if (document.form.nss.value == ""){
           toastr["error"]('Ingresa NSS');
           document.form.nss.focus();
           return false;
       }
       if (document.form.sbc.value == ""){
           toastr["error"]('Ingresa SBC');
           document.form.sbc.focus();
           return false;
       }
       if (document.form.rs.value == ""){
           toastr["error"]('Ingresa razón social');
           document.form.rs.focus();
           return false;
       } 
   }
</script>
</body>
</html>
