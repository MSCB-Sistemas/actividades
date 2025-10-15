<?php
session_start();
include("../lib/funciones.php");

$link_mysql=conectarse();

$fecha=fecha_normal_mysql($_GET["txt_fecha"]);

$fecha_hoy=date("Y")."-".date("m")."-".date("d");
$especie=$_GET["txt_especie"];


$sql="select fecha_limite,habilitado from calendario where id='1'";
$calendario=mysql_fetch_array(mysql_query($sql,$link_mysql));

$fecha_limite=$calendario["fecha_limite"];

if($_SESSION['permiso']=='autorizado'){
	$habilitado="SI";
}
else
{
	$habilitado=$calendario["habilitado"];
}




$flag=false;
?>

<div class="form-group row">
	<label for="example-text-input" class="col-3 col-form-label">Horario</label>
	<div class="col-9">
	  <select class="form-control" name="combo_horario" id="combo_horario" required="" placeholder="Primero debe selleccionar la fecha" >
        <option  value="" selected="selected"></option>
        <?php
			
if($habilitado=='SI'){	
	//CORROBORO PARA QUE NO PUEDAN SACAR TURNOS MAS ALLA DE ESTA FECHA
	if ($fecha < $fecha_limite){
		//CORROBORO SI LA FECHA SELECCIONADA ES HOY PARA DESCARTAR LOS HORARIOS QUE YA PASARON	
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
		
		$recordset_combo_auxiliares = mysql_query($query_combo_auxiliares,$link_mysql);
		if (mysql_num_rows($recordset_combo_auxiliares)>0) {
			$flag = true;
					
		}
		else
		{
			$alerta = 2;
					
		}
	}
	else
	{
		$alerta=1;
	}	
}
else
{
	$alerta=3;
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



switch ($alerta) {
    case 1:
        echo "<div class='alert alert-danger col-12' role='alert'>
  No se pueden sacar turnos con fecha posterior al ".fecha_mysql_normal($fecha_limite)."
</div>";
        break;
    case 2:
        echo "<div class='alert alert-danger col-12' role='alert'>
  No hay turnos disponibles para la fecha seleccionada.
</div>";
        break;
		
	case 3:
        echo "<div class='alert alert-danger col-12' role='alert'>
  Por el momento no esta habilitado el calendario de castraciones.
</div>";
        break;
    
}


?>


