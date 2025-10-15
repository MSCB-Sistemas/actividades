<?php 
//-------Generador Excel--------------------------------
// esto le indica al navegador que muestre el di�logo de descarga a�n sin haber descargado todo el contenido
 
header("Content-type: application/octet-stream");
//indicamos al navegador que se est� devolviendo un archivo
header("Content-Disposition: attachment; filename=inscriptos.xls");
//con esto evitamos que el navegador lo grabe en su cach�
header("Pragma: no-cache");
header("Expires: 0");
//damos salida a la tabla
//echo $tbHtml;
//--------Fin Generador Excel----------------------------------


//--------------------------------Inicio de sesion------------------------

include("../lib/sesion.php"); 

//--------------------------------Fin inicio de sesion------------------------


include("../lib/funciones.php");

$link=conectarse_deportes();

$usuario=$_SESSION['id'];
$tipo_usuario=$_SESSION['tipo_usuario'];


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

       var tabla = $("#t_certificados").dataTable({			
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




//----------Verifica existencia del nro de interno----------------------
function aprobar(){
	$.get("setea_estado.php",{txt_id_persona:document.frm.hd_persona.value,estado:document.frm.hd_estado.value});
}
//-------------------------------------------------------------------------

function Hola(id_persona,comentario) {
     var parametros = {"hd_persona":id_persona,"txt_comentario":comentario};
$.ajax({
    data:parametros,
    url:'setea_estado.php',
    type: 'post',
    beforeSend: function () {
        $("#resultado").html("Procesando, espere por favor");
    },
    success: function (response) {   
        $("#resultado").html(response);
    }
});
}

</script>


<style type="text/css" title="currentStyle">
	@import "../css/demo_page.css";
	@import "../css/demo_table.css";
	
	@import "../css/themes/smoothness/jquery-ui-1.7.2.custom.css";
	@import "../css/jquery.dataTables.css";
</style>

<link href="../css/estilos.css" rel="stylesheet" type="text/css">


</head>


<body >

<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td class="titulopantalla">Bandeja de entrada</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><form id="form1" name="form1" method="post" action="listado_propietarios.php" >
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
          </table>
        </form></td>
      </tr>
      <tr>
        <td>
<table width="100%" border="0" cellspacing="1" id="t_certificados">
<thead>
    	<tr>
            <th class="etiquetas_tabla" >DNI </th>
			<th class="etiquetas_tabla" >APELLIDO y NOMBRE </th>
    	    <th class="etiquetas_tabla" >FEC NAC</th>
			<th class="etiquetas_tabla" >TELEFONO</th>
            <th class="etiquetas_tabla" >EMAIL</th>
			<th class="etiquetas_tabla" >RESPONSABLE</th>
			<th class="etiquetas_tabla" >CUIL RESPONSABLE</th>
            <th width="60" class="etiquetas_tabla" >ACTIVIDAD</th>
    	    <th class="etiquetas_tabla" >LUGAR</th>
			<th class="etiquetas_tabla" >FECHA DE INSC</th>
            
    	    
    	</tr>
    </thead>
          
	<tbody>
		<?php 
		if($_GET["txt_fecha_desde"]!="" and $_GET["txt_fecha_hasta"]!=""){
			$fecha_desde=$_GET["txt_fecha_desde"];
			$fecha_hasta=$_GET["txt_fecha_hasta"];
			$criterio_fecha=" where DATE_FORMAT(fecha_sistema,'%Y-%m-%d') >='$fecha_desde' and DATE_FORMAT(fecha_sistema,'%Y-%m-%d')<='$fecha_hasta'";
		}
		else
		{
			$criterio_fecha="";
		}
		

			$query="select a.id as nroInscripcion,dni,apellido,a.nombre as nombrePersona,sexo,fecha_nacimiento,telefono,email,
			b.actividad as nombreActividad,c.nombre as nombreLugar,apellido_responsable,nombre_responsable,cuil_responsable,fecha_sistema
			from inscripciones a inner join actividades b 
			ON a.actividad=b.id_actividad
			inner join lugares c
			on b.lugar=c.id_lugar".$criterio_fecha;
		
		
		$recordset=mysqli_query($link,$query);
		while($record=mysqli_fetch_array($recordset)){
		

		
		 ?>
         	<tr class="datos" >
            	
         	    <td class="<?php echo $estilo;?>"><?php echo $record["dni"];?></td>
         	    <td class="<?php echo $estilo;?>"><?php echo $record["apellido"]." ".$record["nombrePersona"];?></td>
                <td class="<?php echo $estilo;?>"><?php echo fecha_mysql_normal($record["fecha_nacimiento"]);?></td>
                <td class="<?php echo $estilo;?>"><?php echo $record["telefono"];?></td>
                <td class="<?php echo $estilo;?>"><?php echo $record["email"];?></td>
				<td class="<?php echo $estilo;?>"><?php echo $record["apellido_responsable"]." ".$record["nombre_responsable"];?></td>
                <td class="<?php echo $estilo;?>"><?php echo $record["cuil_responsable"];?></td>
				<td class="<?php echo $estilo;?>"><?php echo $record["nombreActividad"];?></td>
				<td class="<?php echo $estilo;?>"><?php echo $record["nombreLugar"];?></td>
				<td class="<?php echo $estilo;?>"><?php echo fecha_mysql_normal_completa($record["fecha_sistema"]);?></td>
                
				
                
         	</tr>
		  <?php }?>
          </tbody>
        </table>        </td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
