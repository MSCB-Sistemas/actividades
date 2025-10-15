<!-- Bootstrap -->
<script src="../js/bootstrap.min.js"></script>
<link href="../css/font-awesome.css" rel="stylesheet">
<link href="../css/font-awesome.min.css" rel="stylesheet">
<link href="../css/bootstrap.css" rel="stylesheet">

<div class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
	  <div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand"><p><img src="../images/escudobrc.gif" alt="Municipalidad Bariloche" align="middle" style="margin:0px 0px 0px 20px"></p></a>
	  </div>
	  <div class="navbar-collapse collapse">
		  <ul class="nav navbar-nav">
			<li><a href="../mod_principal/menu_principal.php"><i class="fa fa-home fa-fw"></i>Inicio</a></li>
				
                  
                  <li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-id-badge fa-fw"></i> Operaciones frecuentes<span class="caret"></span></a>
					  <ul class="dropdown-menu">
						<li><a href="../mod_turnos/listado_turnos.php">Turnos</a></li>
						<li><a href="../mod_turnos/frm_turno_sistema.php">Solicitar turno</a></li>
                        <li><a href="../mod_administrador/administrar_calendario.php">Administrar calendario</a></li>
                 
					</ul>
				  </li>
                  
                   
				  
				 
				

	    </ul>
		  <ul class="nav navbar-nav navbar-right">

			<li><a><i class="fa fa-user-circle-o fa-fw"></i> <?php echo "Veterinaria y zoonosis - Usuario: ".$_SESSION['ses_nombre']." - ".$_SESSION['ses_apellido'];  ?> </a></li>
			<li><a><i class="fa fa-calendar-o fa-fw"></i>
			<?php
			// Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
			date_default_timezone_set('UTC');
			//Imprimimos la fecha actual dandole un formato
			echo date("d / m / Y");
			?></a></li>
			<li><a href="../mod_usuario/logout.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a></li>
		  </ul>
	  </div><!--/.nav-collapse -->
	</div><!--/.container-fluid -->
</div>
