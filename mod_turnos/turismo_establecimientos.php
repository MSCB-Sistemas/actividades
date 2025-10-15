<?php  
session_start();

if($_SESSION['permiso'] != 'autorizado' or $_SESSION['tipo']!="turismo"){
	header('Location: ../mod_usuario/index.php?error=errorsesion');	
}

unset($_SESSION['legajo']); //SE DESTRUYE POR SI SE UTILIZO CUANDO SE MODIFICA UN ESTABLECIMIENTO

include '../inc/conexion.php';
include '../lib/funciones.php';

$db= Conexion();

if (!empty($_POST['txt_nombre'])){
	$buscar_nombre = $_POST['txt_nombre'];
	$where_nombre = " nombre like '%".$buscar_nombre."%' and ";
}
else
{
	$where_nombre = " ";
}

if (!empty($_POST['txt_direccion'])){
	$buscar_direccion = $_POST['txt_direccion'];
	$where_direccion = "calle like '%".$buscar_direccion."%' and ";
}
else
{
	$where_direccion = "";
}

if (!empty($_POST['txt_legajo'])){
	$buscar_legajo = $_POST['txt_legajo'];
	$where_legajo = "legajo like '%".$buscar_legajo."%' and ";
}
else
{
	$where_legajo = "";
}

if (!empty($_POST['txt_categoria'])){
	$buscar_categoria = $_POST['txt_categoria'];
	$where_categoria = "t_y_cat like '%".$buscar_categoria."%' ";
}
else
{
	$where_categoria = "";
}




//LONGITUD DE BUSQUEDA



if (!empty($_POST['txt_nombre']) || !empty($_POST['txt_direccion']) || !empty($_POST['txt_legajo']) || !empty($_POST['txt_categoria'])) {

	$sql ="SELECT legajo,nombre,calle,numero,descrip_ubicacion,telefono,email,t_y_cat from establecimientos 
		where".$where_nombre.$where_direccion.$where_legajo.$where_categoria."order by nombre";
	$sql=str_replace("and order", "order", $sql);
	
	$ejecuto = mysqli_query($db,$sql);
   
}

if (empty($_POST['txt_nombre']) and empty($_POST['txt_direccion']) and empty($_POST['txt_legajo']) and empty($_POST['txt_categoria'])) {

	$sql ="SELECT legajo,nombre,calle,numero,descrip_ubicacion,telefono,email,t_y_cat from establecimientos order by nombre";
	$sql=str_replace("and order", "order", $sql);
	
	$ejecuto = mysqli_query($db,$sql);
   
}



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
            <?php include("../inc/menu_turismo.php"); ?>

         <div class="row">
                <div class="col-lg-3">
                <br>
                <h4 class="text-center"><img src="../images/historico_carga_disponibilidad.gif" width="50" height="57"></h4>

                  <h4 class="text-center bg-info">Establecimientos</h4>
                </div>
                <div class="col-lg-6">
                
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  id="formjquery" name="buscar"><br>
                        <input class="form-control" name="txt_nombre" id="txt_nombre" value="<?php if (isset($_POST['txt_nombre'])){echo $buscar_nombre;} ?>"  placeholder="Nombre de establecimiento ">
                        <input class="form-control" name="txt_direccion" id="txt_direccion" value="<?php if (isset($_POST['txt_direccion'])){echo $buscar_direccion;} ?>"  placeholder="Dirección del establecimiento ">
                         <input class="form-control" name="txt_legajo" id="txt_legajo" value="<?php if (isset($_POST['txt_legajo'])){echo $buscar_legajo;} ?>"  placeholder="Legajo del establecimiento ">
                         <input class="form-control" name="txt_categoria" id="txt_categoria" value="<?php if (isset($_POST['txt_categoria'])){echo $buscar_categoria;} ?>"  placeholder="Categoría del establecimiento ">
<br>
<input class="btn btn-success" type="submit" value="Buscar" onSubmit="return validar();"> 
                    </form>
                </div>
                <div></div>
                <!-- /.col-lg-12 -->
        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="establecimientos_am.php"><img src="../images/add.png" width="30" height="30"></a></div>
    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>LEGAJO</th>
                                    <th>NOMBRE</th>
                                    <th>DIRECCION</th>
                                    <th>Descrip ubicación</th>
                                    <th>TELEFONO</th>
                                    <th>EMAIL</th>
                                    <th>TIPO Y CATEGORÍA</th>
                                    <th>SERVICIOS</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                    while ($row = mysqli_fetch_assoc($ejecuto)) {
									
										
                                       
                                ?>
                                
                                <tr class="odd gradeX">
                                	<td>
									<?php echo $row['legajo']; 
									
									?>                                    </td>
                                    <td><?php echo $row['nombre']; ?></td>
                                  <td><?php echo $row['calle']." ".$row['numero']; ?></td>
                                  <td class="center"><?php echo $row['descrip_ubicacion'];?></td>
                                    <td class="center"><?php echo $row['telefono'];?></td>
                                    <td class="center">
                                    <?php echo $row['email']; ?>									 </td>
                                    <td class="center"><?php echo $row['t_y_cat']; ?></td>
                                    <td class="center">
									<?php  
										$sql ="SELECT a.id_servicio,b.descripcion from establecimientos_servicios a,servicios b
										where a.id_servicio=b.id_servicio and a.legajo='".$row['legajo']."'";
										$recordset_servicios = mysqli_query($db,$sql);
										while ($row_servicios = mysqli_fetch_assoc($recordset_servicios)) {
											echo $row_servicios['descripcion']."<br>";
										}
										
									?>                                    </td>
                                    <td class="center"><form action="../mod_disponibilidad/carga_disponibilidad.php" method="POST">
                                      <input name="txt_legajo" type="hidden" id="txt_legajo" value="<?php echo $row['legajo']; ?>">
                                      <input type="submit" name="guardar" value="Disponibilidad" class="btn btn-table">
                                    </form></td>
                                    <td class="center"><form action="../mod_usuario/frm_alta_usuario.php" method="POST">
                                      <input name="txt_legajo" type="hidden" id="txt_legajo" value="<?php echo $row['legajo']; ?>">
                                      <input type="submit" name="guardar" value="usuario" class="btn btn-table">
                                    </form></td>
                                    <td class="center"><form action="../mod_establecimientos/establecimientos_am.php" method="POST">
                                      <input name="txt_legajo" type="hidden" id="txt_legajo" value="<?php echo $row['legajo']; ?>">
                                      <input type="submit" name="guardar" value="Modificar" class="btn btn-table">
                                    </form></td>
                                </tr>                                

                                <?php } ?>
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
