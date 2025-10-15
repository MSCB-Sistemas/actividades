<?php 
//-------Generador Excel--------------------------------
// esto le indica al navegador que muestre el diálogo de descarga aún sin haber descargado todo el contenido
 
header("Content-type: application/octet-stream");
//indicamos al navegador que se está devolviendo un archivo
header("Content-Disposition: attachment; filename=inscriptos.xls");
//con esto evitamos que el navegador lo grabe en su caché
header("Pragma: no-cache");
header("Expires: 0");
//damos salida a la tabla
//echo $tbHtml;
//--------Fin Generador Excel----------------------------------

 
include("../lib/funciones.php");

$link=conectarse_deportes();


$sql ="SELECT apellido,nombre,dni,fecha_nacimiento,telefono,email,fecha_sistema,b.actividad as descripcion,
	b.horarios,lugar_descrip
	from inscripciones a,actividades b
	where 
	a.actividad=b.id_actividad
	order by b.id_actividad,apellido";
	
$ejecuto = mysql_query($sql,$link);
   



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

<script>
function validar(){
	
	//Almacenamos los valores
	nombre=$('#txt_buscar').val();
	
   //Comprobamos la longitud de caracteres
	if (nombre.length>=2){
		return true;
	}
	else {
		alert('Minimo 2 caracteres');
		return false;
		
	}

}
</script>

<body>

    <div class="container">
        <br>
            
            <div></div>
                <!-- /.col-lg-12 -->
                
                <div class="col-lg-12">
                <div class="panel panel-default">
                  <!-- /.panel-heading -->
              <div class="panel-body">
                        <table width="100%"  id="dataTables-example">
                           
                                <tr>
                                    <td>Apellido</td>
                                    <td>Nombre</td>
                                    <td>DNI</td>
                                    <td>Fecha nacimiento</td>
                                    <td>Telefono</td>
                                    <td>Email</td>
                                    <td>Fecha inscripcion</td>
                                    <td>descripcion</td>
                                    <td>Horarios</td>
                                    <td>Lugar</td>
                                    
                                </tr>
                            
                         
                                <?php 

                                    while ($row = mysql_fetch_array($ejecuto)) {
									
                                       
                                ?>
                                
                                <tr class="odd gradeX">
                                	<td><?php echo $row['apellido']; ?> </td>
                                    <td><?php echo $row['nombre']; ?></td>
                                    <td><?php echo $row['razon_social']; ?></td>
                                    <td><?php echo $row['dni']; ?></td>
                                    <td><?php echo $row['fecha_nacimiento']; ?></td>
                                  	<td><?php echo $row['telefono']; ?></td>
                                  	<td><?php echo $row['email']; ?></td>
                                  	<td><?php echo $row['fecha_sistema']; ?></td>
                                  	<td><?php echo $row['descripcion']; ?></td>
                                  	<td><?php echo $row['horarios']; ?></td>
                                  	<td><?php echo $row['lugar_descrip']; ?></td>
                                </tr>                                

                                <?php } ?>
                </table>
                      <!-- /.table-responsive -->
                       
                  </div>  <!-- /.panel-body -->
                </div>  <!-- /.panel -->
            </div>
                
        </div>
            <!-- /.row -->
        <div class="row">
            
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
