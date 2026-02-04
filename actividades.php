<?php
session_start();
include("lib/funciones.php");
include("inc/conexion.php");

$link_mysql=Conexion();

$lugar=$_GET["txt_lugar"];

?>

<div class="form-group row">
	<label for="example-text-input" class="col-3 col-form-label">Actividades</label><div class="col-9">
	  <select class="form-control" name="txt_actividad" id="txt_actividad" required="" placeholder="Primero debe selleccionar la fecha" onChange="anios();">
        <option  value="" selected="selected"></option>
        <?php
			
		$query_actividades="select id_actividad ,actividad,anio_desde,anio_hasta,categoria,horarios,grupo,periodo from actividades
						where lugar='$lugar' and activo=1 order by actividad";
		$recordset= mysqli_query($link_mysql,$query_actividades);

 		while($actividad=mysqli_fetch_array($recordset)){ 

  		?>
        <option value="<?php echo $actividad["id_actividad"]; ?>" ><?php echo $actividad["actividad"]." - "."CATEGORIA: ".$actividad["anio_desde"]." a ".$actividad["anio_hasta"]." ".utf8_encode($actividad["horarios"]." - "."GRUPO: ".$actividad["grupo"]." - "."PERIODO: ".$actividad["periodo"]);?></option>
        <?php
    
  			}
		?>
      </select>
	</div>
</div>


