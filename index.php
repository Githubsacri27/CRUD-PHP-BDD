<?php
// Recuperar los datos del formulario
require_once('servicios/recuperardatos.php');
// Incluir el archivo de conexión a la base de datos
require_once('servicios/conexion.php');

try {

	//evaluar petición recibida para incorporar el fichero correspondiente a la operativa a realizar
	switch ($peticion) {
		case 'A':
			require_once('servicios/altapersona.php');
			break;
		case 'C':
			require_once('servicios/consultapersona.php');
			break;
		case 'M':
			require_once('servicios/modificacionpersona.php');
			break;
		case 'B':
			require_once('servicios/bajapersona.php');
			break;
	}
} catch (Exception $e) {
	//informar mensaje de error
	$mensajes = $e->getMessage();
} finally {
	//CONSULTA DE TODAS LAS PERSONAS
	require_once('servicios/consultapersonas.php');
}

?>

<html>

<head>
	<title>Banco</title>
	<meta charset='UTF-8'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
	<div class="container-fluid px-1 py-5 mx-auto">
		<div class="row d-flex justify-content-center">
			<div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
				<div class="card">
					<h5 class="text-center mb-4">CRUD básico con conexión a BDD</h5>
						<form id='formulario' method='post' action='#'>

							<input type='hidden' name='idpersona' id='idpersona' value="<?php echo $idpersona ?? null; ?>">
							<div class="row mb-3">
								<label for="nif" class="col-sm-2 col-form-label">NIF</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="nif" name='nif' value='<?= $nif ?? null; ?>'>
								</div>
							</div>
							<div class="row mb-3">
								<label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="nombre" name="nombre" value='<?= $nombre ?? null; ?>'>
								</div>
							</div>
							<div class="row mb-3">
								<label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="apellidos" name="apellidos" value='<?= $apellidos ?? null; ?>'>
								</div>
							</div>
							<div class="row mb-3">
								<label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="direccion" name="direccion" value='<?= $direccion ?? null; ?>'>
								</div>
							</div>
							<div class="row mb-3">
								<label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="telefono" name="telefono" value='<?= $telefono ?? null; ?>'>
								</div>
							</div>
							<div class="row mb-3">
								<label for="email" class="col-sm-2 col-form-label">Email</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" id="email" name="email" value='<?= $email ?? null; ?>'>
								</div>
							</div>
							<label class="col-sm-2 col-form-label"></label>
							<button type="submit" name="peticion" value="A">Alta Paciente</button>
							<button type="submit" name="peticion" value="M">Modificación Paciente</button>
							<button type="submit" name="peticion" value="B">Baja Paciente</button>
							<button type="reset" name="reset" class="btn btn-success">Limpiar</button>

							<label class="col-sm-2 col-form-label"></label>
							<p class='mensajes'><?php echo $mensajes ?? null; ?></p>

						</form><br><br>
						<table id='listapersonas' class="table table-striped">

							<tr class='table-dark'>
								<th>Id</th>
								<th>NIF</th>
								<th>Nombre</th>
								<th>Apellidos</th>
							</tr>
							<?php
							foreach ($personas ?? []  as $persona) {
								echo "<tr class='fila-persona' onclick='consultaPersona($persona[idpersona])'>";
								echo "<td>$persona[idpersona]</td>";
								echo "<td>$persona[nif]</td>";
								echo "<td>$persona[nombre]</td>";
								echo "<td>$persona[apellidos]</td>";
								echo "</tr>";
							}
							?>

						</table>

				</div>
				<form id='formconsulta' method='post' action='#'>
					<input type='hidden' id='consulta' name='consulta'>
					<input type='hidden' name='peticion' value='C'>
				</form>
			</div>
		</div>
	</div>
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
				<script type="text/javascript" src='scripts/script.js'></script>
</body>

</html>