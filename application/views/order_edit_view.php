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
   <section class="content-header">
      <h1><i class="fa fa-users" aria-hidden="true"></i> Editar orden</h1>
      <ol class="breadcrumb">
         <li><a href="<?= (SITE . 'login'); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
         <li><a href="<?= (SITE . 'order'); ?>"><i class="fa fa-file-excel-o"></i> Ordenes</a>
         <li class="active">Editar orden</li>
      </ol>
   </section>
   <br><br>
   <div class="container-fluid">
      <div class=" col-md-10 col-md-offset-1 panel panel-info">
         <div class="panel-body">
            <?php $attr = array('name' => 'form', 'id' => 'form', 'class' => 'form-horizontal'); ?>
            <?php echo form_open('order/edit_order/'.$ord->id, $attr);?>
            <fieldset>
               <div class="form-group">
                  <span>
                     <legend> Detalles de la orden</legend>
                  </span>
                  <div class="row">
                     <!-- primera columna -->
                     <div class="col-md-3 col-sm-3">
                        <label class="control-label" for="number">Número</label>  
                        <input id="number" name="number" placeholder="Número" class="form-control input-md" type="text" value="<?= $ord->number ?>">
                     </div>
                     <!-- segunda columna -->
                     <div class="col-md-5 col-sm-5">
                        <label class="control-label" for="contract">Contrato</label>  
                        <input id="contract" name="contract" placeholder="Contrato" class="form-control input-md" type="text" value="<?= $ord->contract ?>">
                     </div>
                     <!-- tercera columna -->
                     <div class="col-md-4 col-sm-4">
                        <label class="control-label" for="customer">Cliente</label>
                        <input id="customer" name="customer" placeholder="Cliente" class="form-control input-md" type="text" value="<?= $ord->customer ?>">
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="row">
                     <!-- primera columna -->
                     <div class="col-md-3 col-sm-3">
                        <label class="control-label" for="kind">Tipo</label>
                        <select id="kind" name="kind" class="form-control">
                           <option value="SPOT" <?= $ord->kind_order=='SPOT'?'selected':'';?>>SPOT</option>
                           <option value="MENCION" <?= $ord->kind_order=='MENCION'?'selected':'';?>>MENCIÓN</option>
                           <option value="ENTREVISTA" <?= $ord->kind_order=='ENTREVISTA'?'selected':'';?>>ENTREVISTA</option>
                           <option value="INFOMERCIAL" <?= $ord->kind_order=='INFOMERCIAL'?'selected':'';?>>INFOMERCIAL</option>
                           <option value="LINNER" <?= $ord->kind_order=='LINNER'?'selected':'';?>>LINNER</option>
                           <option value="CAMBIO DE VERSION" <?= $ord->kind_order=='CAMBIO DE VERSION'?'selected':'';?>>CAMBIO DE VERSION</option>
                           <option value="CONTROL REMOTO" <?= $ord->kind_order=='CONTROL REMOTO'?'selected':'';?>>CONTROL REMOTO</option>
                           <option value="CAPSULA" <?= $ord->kind_order=='CAPSULA'?'selected':'';?>>CAPSULA</option>
                           <option value="ENLACE" <?= $ord->kind_order=='ENLACE'?'selected':'';?>>ENLACE</option>
                        </select>
                     </div>
                     <!-- segunda columna -->
                     <div class="col-md-2 col-sm-2">
                        <label class="control-label" for="rack">Rack</label>  
                        <input id="rack" name="rack" placeholder="Rack" class="form-control input-md" type="text" value="<?= $ord->rack ?>"> 
                     </div>
                     <!-- tercera columna -->
                     <div class="col-md-7 col-sm-7">
                        <label class="control-label" for="version">Versión</label>
                        <input id="version" name="version" placeholder="Versión" class="form-control input-md" type="text" value="<?= $ord->version ?>">
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="row">
                     <!-- primera columna -->
                     <div class="col-md-3 col-sm-3">
                        <label class="control-label" for="duration">Duración</label>  
                        <input id="duration" name="duration" placeholder="Duración" class="form-control input-md" type="text" value="<?= $ord->duration ?>">
                     </div>
                     <!-- segunda columna -->         
                     <div class="col-md-5 col-sm-5">
                        <label class="control-label" for="start">Inicio</label>  
                        <input id="start" name="start" placeholder="Inicio" class="form-control input-md datepicker" type="text" value="<?= $ord->start ?>">  
                     </div>
                     <!-- tercera columna -->
                     <div class="col-md-4 col-sm-4">
                        <label class="control-label" for="end">Termino</label>
                        <input id="end" name="end" placeholder="Termino" class="form-control input-md datepicker" type="text" value="<?= $ord->end ?>">
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="row">
                     <!-- primera columna -->
                     <div class="col-md-3 col-sm-3">
                        <label class="control-label" for="station">Estación</label>
                        <select id="station" name="station" class="form-control">
                        <?php
                           foreach($list as $val):
                             $selected = ($val->id_sta == $ord->id_sta) ? ' selected="selected"' : "";
                             echo '<option value="'.$val->id_sta.'" '.$selected.'>'.$val->acronym_sta.'</option>';
                           endforeach;
                           ?>
                        </select>
                     </div>
                     <!-- segunda columna -->
                     <div class="col-md-5 col-sm-5">
                        <label class="control-label" for="details">Observaciones</label>                
                        <textarea class="form-control" id="details" name="details"><?= $ord->details; ?></textarea>
                     </div>
                     <!-- tercera columna -->
                     <div class="col-md-4 col-sm-4">
                        <label class="control-label" for="hours">Horario</label>  
                        <input id="hours" name="hours" placeholder="Horario" class="form-control input-md" type="text" value="<?= $ord->hours ?>">
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="row">
                     <!-- primera columna -->
                     <div class="col-md-3 col-sm-3">
                        <label class="control-label" for="seller">Vendedor(a)</label>  
                        <input id="seller" name="seller" placeholder="Vendedor(a)" class="form-control input-md" type="text" value="<?= $ord->seller ?>">
                     </div>
                     <!-- segunda columna -->
                     <div class="col-md-5 col-sm-5"></div>
                     <!-- tercera columna -->
                     <div class="col-md-4 col-sm-4"></div>
                  </div>
               </div>
               <!-- Button -->
               <div class="form-group">
                  <div class="col-md-12 col-md-offset-6 col-sm-12 col-sm-offset-6 col-xs-12 col-xs-offset-6">
                     <button id="submit" name="submit" onclick="return valida();" class="btn btn-info">Aceptar</button>
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
   $('.datepicker').datepicker({
       autoclose: true,
       language: 'es',
       todayHighlight: true,
       format: "yyyy-mm-dd",
       todayBtn: 'linked'
   });
   
   function valida(){
   
     if (document.form.number.value == ""){
         toastr["error"]('Ingresa número');
         document.form.number.focus();
         return false;
     }
     if (document.form.contract.value == ""){
         toastr["error"]('Ingresa contrato');
         document.form.contract.focus();
         return false;
     }
     if (document.form.customer.value == ""){
         toastr["error"]('Ingresa cliente');
         document.form.customer.focus();
         return false;
     }
     if (document.form.rack.value == ""){
         toastr["error"]('Ingresa rack');
         document.form.rack.focus();
         return false;
     }
     if (document.form.version.value == ""){
         toastr["error"]('Ingresa versión');
         document.form.version.focus();
         return false;
     }
     if (document.form.duration.value == ""){
         toastr["error"]('Ingresa duración');
         document.form.duration.focus();
         return false;
     }
     if (document.form.start.value == ""){
         toastr["error"]('Selecciona fecha de inicio');
         document.form.start.focus();
         return false;
     }
     if (document.form.end.value == ""){
         toastr["error"]('Selecciona fecha de termino');
         document.form.end.focus();
         return false;
     }
     if (document.form.hours.value == ""){
         toastr["error"]('Ingresa Horario');
         document.form.hours.focus();
         return false;
     }
     if (document.form.seller.value == ""){
         toastr["error"]('Ingresa vendedor');
         document.form.seller.focus();
         return false;
     } 
   }
</script>
</body>
</html>
