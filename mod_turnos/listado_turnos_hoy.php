<?php 
header('Content-Type: text/html; charset=iso-8859-1');
//--------------------------------Inicio de sesion------------------------

include("../lib/sesion.php"); 

//--------------------------------Fin inicio de sesion------------------------


include("../lib/funciones.php");

$link=conectarse();

$fecha=fecha_normal_mysql($_POST['txt_fecha']);

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Turnos</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="shortcut icon" href="../images/escudo_ico.ico">
    <!-- Scripts -->
    <script src="../jscripts/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script src="../jscripts/js/jquery-ui.js" type="text/javascript"></script>
    <script language='javascript' src="../jscripts/funciones.js"></script>

<script src="../jscripts/js/jquery.dataTables.min.js" type="text/javascript"></script>



<script language='javascript' src="../jscripts/funciones.js"></script>


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
					"sZeroRecords": "Ningún registro encontrado",
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


</head>


<body >

<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>
  <td width="770"><?php include("../lib/encabezado.php"); ?></td>
  </tr>
  
  <tr align="left" valign="middle">
    <td height="50" class="titulos_pantalla"><?php include("../lib/barra_menu_standard.php"); ?></td>
  </tr>
  
   <tr align="left" valign="middle">
    <td height="50" class="titulos_pantalla"><form action="procesa_turno.php" method="post" name="form1" id="form1" onsubmit="return validar(this)">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-xs-12">
          <div class="form-group row">
            <script src="../jscripts/popcalendar_castraciones.js"></script>
            <label for="example-search-input" class="col-3 col-form-label">Fecha</label>
            <div class="col-9">
              <input class="form-control" type="text" name="txt_fecha" id="txt_fecha"
                    onclick="popUpCalendar(this, form1.txt_fecha,'dd-mm-yyyy');" 
                    onkeypress="return tabular(event,this)"  onkeyup="mascara(this,'-',patron,true)" size="10" maxlength="10" required="" autocomplete="off" placeholder="Seleccione una fecha" readonly="" />
              <label>
              <input name="txt_especie" type="text" id="txt_especie" value="Canino" />
              </label>
            </div>
          </div>
          <div id="horarios"></div>
        </div>
        <div class="col-lg-6 col-md-12 col-xs-12"></div>
      </div>
      <!-- FIN ROW -->
      <div class="row">
        <div class="col-md-12 col-xs-12"> <a href="http://www.bariloche.gov.ar">
          <button type="button" align="right" name="btnCancelaTurno" class="btn btn-danger btn-lg" style="top:5px;">Cancelar</button>
          </a>
            <input type="submit" align="right" name="button" id="button3" class="btn btn-success btn-lg" value="Confirmar" />
        </div>
      </div>
    </form></td>
  </tr>
  
  <tr>
    <td class="titulopantalla">Listado de turnos para hoy</td>
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
            <th class="etiquetas_tabla" >Fecha</th>
            <th class="etiquetas_tabla" >Horario</th>
            <th class="etiquetas_tabla" >Apellido</th>
            <th class="etiquetas_tabla" >Nombre</th>
    	    <th class="etiquetas_tabla" >Documento</th>
    	    <th class="etiquetas_tabla" >Tel</th>
    	    <th class="etiquetas_tabla" >Mail</th>
            <th class="etiquetas_tabla" >Especi</th>
            <th class="etiquetas_tabla" >Sexo</th>
            <th class="etiquetas_tabla" >Raza</th>
            <th class="etiquetas_tabla" >Nombre raza</th>
            <th class="etiquetas_tabla" >Edad</th>
            <th class="etiquetas_tabla" >Celo</th>
            <th class="etiquetas_tabla" >Cria</th>

    	    <th width="60" class="etiquetas_tabla" >&nbsp;</th>
    	    <th width="60" class="etiquetas_tabla" >&nbsp;</th>
    	</tr>
    </thead>
          
    <tbody>
		<?php 
		//curdate()
		$query="select id_turno,fecha,b.horario as hora_turno,dni,apellido,nombre,telefono,email,a.especie as turno_especie,sexo,raza,nombre_raza,edad,celo,cria,estado from turnos a, horarios b
		where a.horario=b.id_horario and fecha='$fecha'
		order by b.horario";

		$recordset=mysql_query($query,$link);
		
		while($record=mysql_fetch_array($recordset)){ 
		
			$estado=$record["estado"];
			
			switch ($estado) {
			
				case 0:
				$estilo="datos";
				break;
				
				case 1:
				$estilo="atendido";
				break;
				
				case 2:
				$estilo="anulado";
				break;

			}
			
		 ?>
         	<tr class="datos" >
            	<td class="<?php echo $estilo;?>"><?php echo fecha_mysql_normal($record["fecha"]);?></td>
            	<td class="<?php echo $estilo;?>"><?php echo $record["hora_turno"];?></td>
                <td class="<?php echo $estilo;?>"><?php echo $record["apellido"];?></td>
            	<td class="<?php echo $estilo;?>"><?php echo $record["nombre"];?></td>
         	    <td class="<?php echo $estilo;?>"><?php echo $record["dni"];?></td>
         	    <td class="<?php echo $estilo;?>"><?php echo $record["telefono"];?></td>
         	    <td class="<?php echo $estilo;?>"><?php echo $record["mail"];?></td>
                <td class="<?php echo $estilo;?>"><?php echo $record["turno_especie"];?></td>
                <td class="<?php echo $estilo;?>"><?php echo $record["sexo"];?></td>
                <td class="<?php echo $estilo;?>"><?php echo $record["raza"];?></td>
                <td class="<?php echo $estilo;?>"><?php echo $record["nombre_raza"];?></td>
                <td class="<?php echo $estilo;?>"><?php echo $record["edad"];?></td>
                <td class="<?php echo $estilo;?>"><?php echo $record["celo"];?></td>
                <td class="<?php echo $estilo;?>"><?php echo $record["cria"];?></td>
         	    <td width="60">
                <?php if($estado==0){?>
                    <form id="form2" name="form2" method="post" action="setea_estado.php">
                      <label>
                      <input type="submit" name="Submit" id="button" value="Atender" />
                      </label>
                                    <label></label>
                                    <input name="hd_turno" type="hidden" id="hd_turno" value="<?php echo $record["id_turno"];?>" />
                                    <input name="hd_estado" type="hidden" id="hd_estado" value="1" />
                                    <input name="hd_quien" type="hidden" id="hd_quien" value="1" />
                    </form>
                <?php }?>           	      </td>
         	    <td width="60">
                <?php if($estado==0){?>
                <form id="form3" name="form3" method="post" action="setea_estado.php">
         	      <input type="submit" name="button2" id="button2" value="Anular" />
                                <input name="hd_turno" type="hidden" id="hd_turno" value="<?php echo $record["id_turno"];?>" />
         	                    <input name="hd_estado" type="hidden" id="hd_estado" value="2" />
         	                    <input name="hd_quien" type="hidden" id="hd_quien" value="1" />
                </form>
                <?php }?>         	    </td>
         	</tr>
		  <?php 
		  }
		  ?>
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
