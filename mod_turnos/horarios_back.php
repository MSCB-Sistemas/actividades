<?php
include("../lib/funciones.php");

$link_mysql=conectarse();

$fecha=fecha_normal_mysql($_GET["txt_fecha"]);
$fecha_hoy=date("Y")."-".date("m")."-".date("d");
$especie=$_GET["txt_especie"];


$flag=false;
?>

<div class="form-group row">
	<label for="example-text-input" class="col-3 col-form-label">Horario</label>
	<div class="col-9">
	  <select class="form-control" name="combo_horario" id="combo_horario" required="" placeholder="Primero debe selleccionar la fecha">
	    <option  value="" selected="selected"></option>
    	<?php
			
		if ($fecha>='2017-02-01'){
	
			if($fecha==$fecha_hoy){
				$query_combo_auxiliares="select id_horario,horario from horarios 
				where id_horario not in (select horario from turnos where fecha='$fecha' and estado='0' ) 
				and time(CAST(concat('$fecha',' ',horario) AS DATETIME)) >  time(NOW()) and activo=1 and especie='$especie' order by horario";
			}
			else
			{
				$query_combo_auxiliares="select id_horario,horario from horarios 
				where id_horario not in (select horario from turnos where fecha='$fecha' and estado='0' ) and activo=1 and especie='$especie' order by horario";
			}
		}	
			
		    $recordset_combo_auxiliares = mysql_query($query_combo_auxiliares,$link_mysql);
		    if (mysql_num_rows($recordset_combo_auxiliares)>0) {
		    	$flag = true;
		    	
		    }else{
		    	$flag = false;
		    	
		    }

 			while($record_combo_auxiliares=mysql_fetch_array($recordset_combo_auxiliares)){ 

  		?>
    			<option value="<?php echo $record_combo_auxiliares["id_horario"]; ?>" selected="selected"><?php echo $record_combo_auxiliares["horario"]; ?></option>
   		<?php
    
  			}
		?>
		</select>
	</div>
</div>

<?php

if ($flag == false){

echo "<div class='alert alert-danger col-12' role='alert'>
  No hay turnos disponibles para la fecha seleccionada.
</div>";
}


?>
