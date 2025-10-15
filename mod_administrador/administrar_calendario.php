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
                
                <div class="col-lg-6"></div>
           <div></div>
                <!-- /.col-lg-12 -->
        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                  <!-- /.panel-heading -->
                  <div class="panel-body">
                    <form action="administrar_calendario_proc.php" method="POST" name="form1" id="form1" onSubmit="return validar(this)">
              <div class="row">
              <div class="col-lg-6 col-md-12 col-xs-12">
                <div class="form-group row">
                  <label for="example-text-input" class="col-3 col-form-label">Habilitado</label>
                  <div class="col-9">
                    <select class="form-control" name="txt_habilitado" id="txt_habilitado"  required="">
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                      <option selected><?php echo $calendario["habilitado"];?></option>
                    </select>
                  </div>
                </div>
                
                
                <div class="form-group row">
            
            <label for="example-search-input" class="col-3 col-form-label">Fecha limite</label>
            
            <div class="col-9">
            <script src="../jscripts/popcalendar_castraciones.js"></script>
              <input name="txt_fecha_limite" type="date" class="form-control" id="txt_fecha_limite" value="<?php echo $calendario["fecha_limite"];?>" size="10" maxlength="10" required="" autocomplete="off" placeholder="dd-mm-aaaa"  />
                     
            </div>
          </div>
                
                <div id="horarios"></div>
                

              </div>
              <div class="col-lg-6 col-md-12 col-xs-12"></div>
            </div><!-- FIN ROW -->
            <div class="row">
              <div class="col-md-12 col-xs-12">
                <a href="http://www.bariloche.gov.ar"><button type="button" align="right" name="btnCancelaTurno" class="btn btn-danger btn-lg" style="top:5px;">Cancelar</button></a>
                <input type="submit" align="right" name="button" id="button" class="btn btn-success btn-lg" value="Confirmar">
              </div>
            </div>
            </form>
                      <!-- /.table-responsive -->
</div>  
                  <!-- /.panel-body -->
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
