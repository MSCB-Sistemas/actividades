<?php
session_start();
include("lib/funciones.php");
include("inc/conexion.php");

$link_mysql=Conexion();

$actividad=$_GET["txt_actividad"];

$query_actividades="select id_actividad ,actividad,anio_desde,anio_hasta,categoria,horarios from actividades
						where id_actividad='$actividad'";
$recordset= mysqli_query($link_mysql,$query_actividades);
$actividad=mysqli_fetch_array($recordset);


?>

<div class="form-group row">
  <div class="col-9">
	  <label>
	  <input name="txt_anio_desde" type="hidden" id="txt_anio_desde" value="<?php echo $actividad["anio_desde"]; ?>" />
	  </label>
	  <p>
	    <label>
	    <input type="hidden" name="txt_anio_hasta" id="txt_anio_hasta" value="<?php echo $actividad["anio_hasta"]; ?>"/>
	    </label>
	  </p>
	</div>
</div>


