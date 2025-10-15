<?php  
session_start();

if($_SESSION['permiso'] != 'autorizado'){
	header('Location: ../mod_usuario/index.php?error=errorsesion');	
}

include("../lib/funciones.php");

$link=conectarse();


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../images/logo.png" sizes="16x16">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema Turismo MSCB</title>
    

   <!-- Bootstrap Core CSS -->
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


   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   
      
</head>



<body>

    <div class="container">
        <br>
            <?php include("../inc/menu_superior.php"); ?>

         <div class="row">
                
                <div class="col-lg-6">
                  <form action="listado_turnos.php" method="post" name="form1" id="form1" onsubmit="return validar(this)">
                    <div class="row">
                      <div class="col-lg-6 col-md-12 col-xs-12">
                        <div class="form-group row">
                          <label for="example-search-input" class="col-3 col-form-label">Fecha</label>
                          <div class="col-9">
                            <script src="../jscripts/popcalendar_castraciones.js"></script>
                            <input class="form-control" type="date" name="txt_fecha" id="txt_fecha"
                    
                    onkeypress="return tabular(event,this)"  onkeyup="mascara(this,'-',patron,true)" size="10" maxlength="10" required="" autocomplete="off" placeholder="dd-mm-aaaa"  />
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- FIN ROW -->
                    <div class="row">
                      <div class="col-md-12 col-xs-12">
                        <input type="submit" align="right" name="button" id="button3" class="btn btn-success btn-lg" value="Ver" />
                      </div>
                    </div>
                  </form>
                  
                  <form id="frm_imprimir" name="frm_imprimir" method="post" action="../lib/pdf/reporte_turnos.php" target="_blank">
      
      <input name="hd_fecha" type="hidden" id="hd_fecha" value="<?php echo $fecha; ?>" />
      <img src="../images/imprimir.gif" width="32" height="32" border="0" onclick="document.frm_imprimir.submit();" />
            </form>
                  
                  
                </div>
           <div></div>
                <!-- /.col-lg-12 -->
        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Turnos para el día <span class="titulopantalla"><?php echo $fecha_titulo; ?></span></div>
<!-- /.panel-heading -->
                    <div class="panel-body">
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
        </table>
                      <!-- /.table-responsive -->
                       
                    </div>  <!-- /.panel-body -->
                </div>  <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div> <!-- /.row -->

        <div class="panel-footer">
                <p class="text-center">Direccion de Sistemas - Municipalidad de Bariloche</p>
        </div>

    </div><!-- container -->

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
   

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
    $('#dataTables-example').DataTable( {
		
		responsive : true,
		
        "language": {
            "url": "../inc/spanish.json"
        	}
    	} );
	} );
    </script>

	<script type="text/javascript">
	$('#divMiCalendarioActividad').datetimepicker({
      format: 'DD-MM-YYYY'
    });
	</script>

</body>

</html>
