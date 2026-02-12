<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=inscriptos.xls");
header("Pragma: no-cache");
header("Expires: 0");

include("../lib/sesion.php");
include("../lib/funciones.php");
include("../inc/conexion.php");

$link = Conexion();

$usuario = $_SESSION['id'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

	<title>Generando documento Excel...</title>

	<style type="text/css" title="currentStyle">
		@import "../css/demo_page.css";
		@import "../css/demo_table.css";
		@import "../css/themes/smoothness/jquery-ui-1.7.2.custom.css";
		@import "../css/jquery.dataTables.css";
	</style>

	<link href="../css/estilos.css" rel="stylesheet" type="text/css">
</head>

<body>
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>
							<table width="100%" border="0" cellspacing="1" id="t_certificados">
								<thead>
									<tr>
										<th class="etiquetas_tabla">DNI </th>
										<th class="etiquetas_tabla">APELLIDO y NOMBRE </th>
										<th class="etiquetas_tabla">FEC NAC</th>
										<th class="etiquetas_tabla">TELEFONO</th>
										<th class="etiquetas_tabla">EMAIL</th>
										<th class="etiquetas_tabla">RESPONSABLE</th>
										<th class="etiquetas_tabla">CUIL RESPONSABLE</th>
										<th width="60" class="etiquetas_tabla">ACTIVIDAD</th>
										<th class="etiquetas_tabla">CATEGORIA</th>
										<th class="etiquetas_tabla">GRUPO</th>
										<th class="etiquetas_tabla">PERIODO</th>
										<th class="etiquetas_tabla">LUGAR</th>
										<th class="etiquetas_tabla">FECHA DE INSC</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($_GET["txt_fecha_desde"] != "" and $_GET["txt_fecha_hasta"] != "") {
										$fecha_desde = $_GET["txt_fecha_desde"];
										$fecha_hasta = $_GET["txt_fecha_hasta"];
										$criterio_fecha = " where DATE_FORMAT(fecha_sistema,'%Y-%m-%d') >='$fecha_desde' and DATE_FORMAT(fecha_sistema,'%Y-%m-%d')<='$fecha_hasta'";
									} else {
										$criterio_fecha = "";
									}

									$query = "SELECT 
													a.id AS nroInscripcion,
													dni,
													apellido,
													a.nombre AS nombrePersona,
													sexo,
													fecha_nacimiento,
													telefono,
													email,
													b.actividad AS nombreActividad,
													b.anio_desde,
													b.anio_hasta,
													b.grupo,
													b.periodo,
													c.nombre AS nombreLugar,
													apellido_responsable,
													nombre_responsable,
													cuil_responsable,
													fecha_sistema
												FROM inscripciones a INNER JOIN actividades b 
												ON a.actividad = b.id_actividad
												INNER JOIN lugares c
												ON b.lugar = c.id_lugar" . $criterio_fecha;

									$recordset = mysqli_query($link, $query);
									while ($record = mysqli_fetch_array($recordset)) {
									?>
										<tr class="datos">
											<td><?php echo $record["dni"]; ?></td>
											<td><?php echo $record["apellido"] . " " . $record["nombrePersona"]; ?></td>
											<td><?php echo fecha_mysql_normal($record["fecha_nacimiento"]); ?></td>
											<td><?php echo $record["telefono"]; ?></td>
											<td><?php echo $record["email"]; ?></td>
											<td><?php echo $record["apellido_responsable"] . " " . $record["nombre_responsable"]; ?></td>
											<td><?php echo $record["cuil_responsable"]; ?></td>
											<td><?php echo $record["nombreActividad"]; ?></td>
											<td><?php echo $record["anio_desde"] . "-" . $record["anio_hasta"]; ?></td>
											<td><?php echo $record["grupo"]; ?></td>
											<td><?php echo $record["periodo"]; ?></td>
											<td><?php echo $record["nombreLugar"]; ?></td>
											<td><?php echo fecha_mysql_normal_completa($record["fecha_sistema"]); ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>

</html>