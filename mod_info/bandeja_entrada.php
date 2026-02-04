<?php 
error_reporting(0);
//header('Content-Type: text/html; charset=iso-8859-1');
//--------------------------------Inicio de sesion------------------------

//include("../lib/sesion.php"); 

//--------------------------------Fin inicio de sesion------------------------


include("../lib/funciones.php");
include("../inc/conexion.php");

$link=Conexion();





?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Bandeja de entrada</title>


<script src="../jscripts/js/jquery-1.4.4.min.js" type="text/javascript"></script>
<script src="../jscripts/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../jscripts/js/jquery-ui.js" type="text/javascript"></script>

<script language='javascript' src="../jscripts/funciones.js"></script>
<script src="../jscripts/popcalendar.js"></script>

<script type="text/javascript">

$(document).ready( function() {

       var tabla = $("#tabla_expedientes").dataTable({			
			"responsive" : true,
			"bJQueryUI": true,
			"bFilter": true,
			"bPaginate": true,
			"bSort": true,
			"bLengthChange": true,
			"iDisplayLength": 100,
			"aaSorting": [],
			"sPaginationType": "full_numbers",
			//-----Esto son etiquetas para mostrar en castellano, si se quita anda todo pero muestra en ingles
			"oLanguage": {
					"sLengthMenu": "Mostrar  _MENU_  registros",
					"sZeroRecords": "Ning�n registro encontrado",
					"sInfo": "Registros: _START_ al _END_ - Total: _TOTAL_ registros",
					"sInfoEmpty": "Muestra 0 al 0 de 0 registros",
					"sInfoFiltered": "(Filtrados desde _MAX_ total de registros )",
					"sSearch": "Buscar:",	
					"oPaginate": {
        				"sPrevious": " < Anterior  ",
						"sNext": "  Siguiente > ",
						"sFirst": " << Primero ",
						"sLast": " Ultimo >> ",
     				 }
			}
			//----------Fin etiquetas-------------------------------------------------------------------------		
		});
});



</script>


<style type="text/css" title="currentStyle">
	@import "../css/demo_page.css";
	@import "../css/demo_table.css";
	
	@import "../css/themes/smoothness/jquery-ui-1.7.2.custom.css";
	@import "../css/jquery.dataTables.css";
</style>

<link href="../css/estilos.css" rel="stylesheet" type="text/css">

 <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>


<body >


<div class="row">
        
	<div class="col-md-12 col-md-offset">
		<?php include("../lib/encabezado.php"); ?>
        <?php include("../lib/barra_menu_standard.php"); ?>
	</div>
</div>
 
<div class="row">
	<div class="col-md-12 col-md-offset">  
<form action="bandeja_entrada.php" method="post" name="form1" id="form1" onsubmit="return validar(this)" >
     
	<div class="form-group">
    	<div class="input-group">
      Fecha desde:
                
              <input name="txt_fecha_desde" type="date" class="datos" id="txt_fecha_desde" tabindex="3"  onkeypress="return tabular(event,this)"  onkeyup="mascara(this,'-',patron,true)"  size="10" maxlength="10"   />
		<div class="input-group">
    </div>              
              
       <div class="form-group"> 
       	<div class="input-group">       
               Fecha hasta:
                
                  <input name="txt_fecha_hasta" type="date" class="datos" id="txt_fecha_hasta" tabindex="3"  onkeypress="return tabular(event,this)"  onkeyup="mascara(this,'-',patron,true)"  size="10" maxlength="10"  />
                  
                 
      </div>
    </div>  
    
    <div class="form-group"> 
       	<div class="input-group">       
               
                  <input type="submit" name="button" id="button3" value="Confirmar" />
      </div>
    </div>  
</form> 

	</div>
</div>            


<div class="row">
	<div class="col-md-12 col-md-offset">
		<?php
		$fecha_desde=$_POST["txt_fecha_desde"];
		$fecha_hasta=$_POST["txt_fecha_hasta"];
		?>
		<a href="bandeja_entrada_excel.php?txt_fecha_desde=<?php echo $fecha_desde ?>&txt_fecha_hasta=<?php echo $fecha_hasta ?>"><img src="../images/logo_excel.jpg" with=50 height=50></a>
	</div>
</div>

 <div class="row">
	<div class="col-md-12 col-md-offset">
		Bandeja de entrada
	</div>
</div>


<div class="row">
	<div class="col-md-12 col-md-offset">
<table width="100%" class="table table-striped table-bordered table-hover" id="tabla_expedientes">
	<thead>
    	<tr>
            <th class="etiquetas_tabla" >DNI </th>
			<th class="etiquetas_tabla" >APELLIDO </th>
            <th class="etiquetas_tabla" >NOMBRE</th>
    	    <th class="etiquetas_tabla" >FEC NAC</th>
			<th class="etiquetas_tabla" >TELEFONO</th>
            <th class="etiquetas_tabla" >EMAIL</th>
            <th width="60" class="etiquetas_tabla" >ACTIVIDAD</th>
    	    <th class="etiquetas_tabla" >LUGAR</th>
            <th class="etiquetas_tabla" >ARCHIVOS</th>
			<th class="etiquetas_tabla" >FECHA</th>
    	    
    	</tr>
    </thead>
          
    <tbody>
		<?php 
		if($_POST["txt_fecha_desde"]!="" and $_POST["txt_fecha_hasta"]!=""){
			$fecha_desde=$_POST["txt_fecha_desde"];
			$fecha_hasta=$_POST["txt_fecha_hasta"];
			$criterio_fecha=" where DATE_FORMAT(fecha_sistema,'%Y-%m-%d') >='$fecha_desde' and DATE_FORMAT(fecha_sistema,'%Y-%m-%d')<='$fecha_hasta'";
		}
		else
		{
			$criterio_fecha="";
		}
		

			$query="select a.id as nroInscripcion,dni,apellido,a.nombre as nombrePersona,sexo,fecha_nacimiento,telefono,email,
			b.actividad as nombreActividad,c.nombre as nombreLugar,fecha_sistema 
			from inscripciones a inner join actividades b 
			ON a.actividad=b.id_actividad
			inner join lugares c
			on b.lugar=c.id_lugar".$criterio_fecha;
		
		
		$recordset=mysqli_query($link,$query);
		while($record=mysqli_fetch_array($recordset)){
		

		
		 ?>
         	<tr class="datos" >
            	
         	    <td class="<?php echo $estilo;?>"><?php echo $record["dni"];?></td>
         	    <td class="<?php echo $estilo;?>"><?php echo $record["apellido"];?></td>
                <td class="<?php echo $estilo;?>"><?php echo $record["nombrePersona"];?></td>
                <td class="<?php echo $estilo;?>"><?php echo fecha_mysql_normal($record["fecha_nacimiento"]);?></td>
                <td class="<?php echo $estilo;?>"><?php echo $record["telefono"];?></td>
                <td class="<?php echo $estilo;?>"><?php echo $record["email"];?></td>
                <td class="<?php echo $estilo;?>"><?php echo $record["nombreActividad"];?></td>
				<td class="<?php echo $estilo;?>"><?php echo $record["nombreLugar"];?></td>
                
				<td class="<?php echo $estilo;?>">
                	<?php
						$query="select archivo from archivos where inscripcion=".$record["nroInscripcion"]." and archivo like '".$record["dni"]."%'";
						$rec=mysqli_query($link,$query);
						while($archivos=mysqli_fetch_array($rec)){
							echo "<a href='http://www.bariloche.gov.ar/actividades/archivos/".$archivos["archivo"]."' target='blank'>".$archivos["archivo"]."</a><br>";
						}
					
					?>
					
                
                </td>
				<td class="<?php echo $estilo;?>"><?php echo $record["fecha_sistema"];?></td>
                
         	</tr>
		  <?php }?>
          </tbody>
        </table> 
        </div>
		</div>	
		


</body>
</html>
