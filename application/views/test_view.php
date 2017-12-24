
<!DOCTYPE html>
<html>
<head>
	<title>Datos personas</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?= (CSS . 'bootstrap.min.css'); ?>" />
</head>
<body>
	<div class="container" >
		<form action="pagina.php" method="GET" style="margin:5%; background-color:#F2F2F2; padding: 5%; ">
			<!-- primera fila -->
			<div class="form-group">
				<div class="row">
					<!-- primera columna -->
					<div class="col-md-4">
						<input  class="form-control"type="text" name="nombres" placeholder="Nombres">
					</div>
					<!-- segunda columna -->
					<div class="col-md-4">
						<input  class="form-control"type="text" name="apellidos" placeholder="Apellidos">
					</div>
					<!-- tercera columna -->
					<div class="col-md-4">
						<input  class="form-control"type="date" name="nacimiento" placeholder="Fecha de nacimiento">
					</div>
				</div>
			</div>
			<!-- segunda fila -->
			<div class="form-group">
				<div class="row">
					<!-- primera columna -->
					<div class="col-md-4">
						<select class="form-control">
							<option>Femenino</option>
							<option>Masculino</option>
						</select>
					</div>
					<!-- segunda columna -->
					<div class="col-md-4">
						<input  class="form-control" type="text" name="rh" placeholder="RH">
					</div>
					<!-- tercera columna -->
					<div class="col-md-4">	
					</div>
				</div>
			</div>
			<!-- tercera fila -->
			<div class="form-group">
				<div class="row">
					<!-- primera columna -->
					<div class="col-md-4">
						<select  class="form-control">
							<option>Registro civil</option>
							<option>Tarjeta de identidad</option>
							<option>Cedula</option>
						</select>
					</div>
					<!-- segunda columna -->
					<div class="col-md-4">
						<input  class="form-control"type="number" name="ndocumento" placeholder="Numero de documentó">
					</div>
					<!-- tercera columna -->
					<div class="col-md-4">
						<input class="form-control" type="date" name="expedicion" placeholder="Expedición">
					</div>
				</div>
			</div>
			<button class="btn btn-default" type="submit">Guardar</button>
		</form>
	</div>
</body>
</html>