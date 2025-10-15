<?php 
//----------------Sesion------------------------------------------
include("../lib/sesion.php"); 
if ($_SESSION['a_caja']=="0" ){
	$mensaje="Usuario sin permisos";
	$destino="menu_principal.php";
	header("location:mensaje_ok.php?mensaje=$mensaje&destino=$destino");
}
$usuario=$_SESSION['id'];
//---------------Fin inicio Sesion-------------------------------

include("../lib/funciones.php");
include("../lib/sesion.php");

$time_liquidado=time();

//viene de formulario de busqueda
$persona_liquidada=$_POST['persona_liquidada']; 
$fecha_hasta=fecha_normal_mysql($_POST['txt_fecha_hasta']); 

$tipo_liquidacion=$_POST['tipo_liquidacion'];

if($tipo_liquidacion=="Azul"){
		$azul=1;
}
else
{
		$azul=0;
}
//------------------------------------

if(isset($_GET['marca'])){
	$persona_liquidada=$_GET['persona_liquidada']; //viene de marcar o desmarcar
	$fecha_hasta=fecha_normal_mysql($_GET['fecha']); //viene de marcar o desmarcar
}


//--Viene del formulario de liquidar--------
if(isset($_POST["liquidar"])){
	$liquidar=$_POST["liquidar"];
	$azul=$_POST["azul"];

}
//-----------------------------------------



//-------------------Querys-------------------------------------------
$link=conectarse();
if (isset($_POST['persona_liquidada']) or isset($_GET['marca'])){


	$query_persona_liquidada="select id_persona,apellido,nombre from personas where id_persona='$persona_liquidada' order by apellido";
	$record_persona_liquidada=mysql_query($query_persona_liquidada,$link);
	$apellido_liquidada=mysql_result($record_persona_liquidada,0,"apellido");
	$nombre_liquidada=mysql_result($record_persona_liquidada,0,"nombre");


	$query_monedas="select id_moneda,nombre from monedas";
	$record_monedas=mysql_query($query_monedas,$link);

}

$query_responsables="select id_persona,apellido,nombre from personas where activo='1' order by apellido";
$record_responsables=mysql_query($query_responsables,$link);

//---------------Fin querys-----------------------------------------------					
					



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Liquidacion</title>


<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />


<script language='javascript' src="../lib/funciones.js"></script>
<script language='javascript' src="../lib/popcalendar.js"></script>


</head>



<body>
<table width="770" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
 <tr>
  <td width="770"><table width="770" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><table width="770" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><?php include("../lib/encabezado_modulos.php"); ?></td>
          </tr>
        <tr>
          <td><table width="770" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td><table width="770" border="0" cellpadding="0" cellspacing="0">
                  <tr align="left" valign="middle">
                    <td><?php include("../lib/barra_menu_standard.php"); ?></td>
                  </tr>
                  <tr>
                    <td align="center" bgcolor="#A8B6C6" class="tituloencabezado"><span class="titulopantalla">
                    <?php if ($tipo_liquidacion=="Azul"){
                    	echo "Liquidación Azul";
					}
					else
					{
						echo "Liquidación";
					}
					?>
                    </span></td>
                  </tr>
                  <tr>
                    <td height="25">&nbsp;</td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
          </tr>
      </table></td>
    </tr>
  </table></td>
  </tr>
  <tr>
    <td><form id="form1" name="form1" method="post" action="frm_liquidacion.php">
      <table width="500" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="250" align="left" valign="middle" class="etiquetas">Persona para liqidaci&oacute;n</td>
          <td width="250" align="left" valign="middle" class="etiquetas"><select name="persona_liquidada" id="persona_liquidada" tabindex="4" onkeypress="return tabular(event,this)">
            <?php
			 		 while($responsables=mysql_fetch_array($record_responsables)){ //para combo
			 	 ?>
            <option  value="<?php echo $responsables["id_persona"]; ?>"><?php echo htmlentities($responsables["apellido"])." "; 
				echo htmlentities($responsables["nombre"]);
				?></option>
            <?php
		  	  		}//--Fin para combo
         		?>
          </select></td>
        </tr>
        <tr>
          <td width="250" align="left" valign="middle"><span class="etiquetas">Liquidar hasta fecha </span></td>
          <td width="250" align="left" valign="middle"><span class="style17">
            <input name="txt_fecha_hasta" type="text" id="dateArrival" tabindex="1" onkeypress="return tabular(event,this)" onclick="bPreguntar = false;popUpCalendar(this, form1.txt_fecha_hasta, 'dd-mm-yyyy');" onkeyup="mascara(this,'-',patron,true)" value="<?php echo timestampToFecha(time()); ?>" size="10" />
          </span></td>
        </tr>
        <tr>
          <td width="250" align="left" valign="middle"><span class="etiquetas">Tipo liquidaci&oacute;n</span></td>
          <td width="250" align="left" valign="middle"><select name="tipo_liquidacion" id="tipo_liquidacion">
            <option>Blanco</option>
            <option>Azul</option>
          </select>          </td>
        </tr>
        <tr>
          <td width="250" align="left" valign="middle"><input type="submit" name="Submit" value="Ver liquidacion" onclick="bPreguntar = false;"/></td>
          <td width="250" align="left" valign="middle">&nbsp;</td>
        </tr>
      </table>
        </form>    </td>
  </tr>
  <tr bgcolor="#A8B6C6">
        <td colspan="9" align="center" valign="middle" bgcolor="#648BFF" class="etiquetas"><?php echo "Liquidacion de: ".$apellido_liquidada.", ".$nombre_liquidada;  ?></td>
  </tr>
    
  <tr bgcolor="#FFFFFF">
    <td height="10">
	
			<?php 
			if (isset($_POST['persona_liquidada']) or isset($_GET['marca'])){
			
			  //------INICIO BUCLE PARA EL TIPO DE MONEDAS REF.1
			  while ($monedas=mysql_fetch_array($record_monedas)){ 	  
			?>
	
		    <table width="770" border="0" cellpadding="0" cellspacing="1">
			<tr>
        	<td colspan="11" align="center" valign="middle" class="etiquetas">&nbsp;</td>
      	</tr>
		<tr bgcolor="#A8B6C6">
        	<td colspan="11" align="center" valign="middle" bgcolor="#648BFF" class="etiquetas"><?php echo $monedas["nombre"]." ".$forma;  ?></td>
      	</tr>
		
      	<tr bgcolor="#A8B6C6">
        	<td align="center" valign="middle" class="etiquetas">Fecha</td>
        	<td align="center" valign="middle" class="etiquetas">Recibo/Factura</td>
      		<td align="center" valign="middle" class="etiquetas">Persona/Empresa</td>
        	<td align="center" valign="middle" class="etiquetas">Descripci&oacute;n</td>
        	<td align="center" valign="middle" class="etiquetas">Asignado a</td>
        	<td align="center" valign="middle" class="etiquetas">Ingreso</td>
        	<td align="center" valign="middle" class="etiquetas">Egreso</td>
            <td align="center" valign="middle" class="etiquetas">Liquidar</td>

      	</tr>
      <?php
				//Traigo asientos dependiendo si son azules o blancos
				$color_fondo="#D7DDE3";
				
				
$query_asientos="select id_caja,fecha,nro_recibo_factura,emitido_por,cuenta,signo,tts_caja.comentario as 	c_comentario, descripcion, concepto, monto,
asignar_a, apellido, nombre, no_liquidar from 
tts_caja inner join tts_cuentas on tts_caja.cuenta=tts_cuentas.id_cuenta
inner join personas on tts_caja.asignar_a=personas.id_persona
where 
asignar_a='$persona_liquidada' 
and azul='$azul'
and liquidado='0'
and fecha <='$fecha_hasta'
and moneda= '".$monedas["id_moneda"]."' order by signo desc,descripcion,fecha";
				

$record_asientos=mysql_query($query_asientos,$link);


$asientos_liquidar=$asientos_liquidar + mysql_num_rows($record_asientos);		
				
		//------INICIO BUCLE PARA LISTAR LOS ASIENTOS REF.2
		$tot_ingreso=0;
		$tot_egreso=0;
		$total=0;
		while ($asientos=mysql_fetch_array($record_asientos)){ 
		
			if($liquidar==1){ //MARCA EL ASIENTO COMO LIQUIDADO
				$query_cierra_asiento="update tts_caja set liquidado='$time_liquidado' where id_caja='".$asientos["id_caja"]."' and asignar_a='".
				$persona_liquidada."'and liquidado='0' and no_liquidar='0'";
				
				mysql_query($query_cierra_asiento,$link);
			}
				?>
      		<tr >
        	<td align="left" valign="middle" bgcolor="<?php echo $color_fondo; ?>" class="datos"><?php echo fecha_mysql_normal($asientos["fecha"]);?></td>
        	<td align="left" valign="middle" bgcolor="<?php echo $color_fondo; ?>" class="datos"><?php echo $asientos["nro_recibo_factura"];?></td>
			<td align="left" valign="middle" bgcolor="<?php echo $color_fondo; ?>" class="datos"><?php echo $asientos["emitido_por"];?></td>
        	<td align="left" valign="middle" bgcolor="<?php echo $color_fondo; ?>" class="datos"><?php echo $asientos["descripcion"]." ".$asientos["concepto"]; ?></td>
        	<td align="left" valign="middle" bgcolor="<?php echo $color_fondo; ?>" class="datos"><?php echo $asientos["apellido"].", ".$asientos["nombre"];?> </td>
        	<td align="left" valign="middle" bgcolor="<?php echo $color_fondo; ?>" class="datos"><?php if ($asientos["signo"]==1){
																				echo $asientos["monto"];
																					if ($asientos["no_liquidar"]==0){
																						$tot_ingreso=$tot_ingreso+$asientos["monto"];
																					}
																				}	
			?></td>
        	<td align="left" valign="middle" bgcolor="<?php echo $color_fondo; ?>" class="datos"><?php if ($asientos["signo"]==0){
																				echo $asientos["monto"];
																					if ($asientos["no_liquidar"]==0){
																						$tot_egreso=$tot_egreso+$asientos["monto"];
																					}
																				}	
			?>
        	  <a href="<? echo $asientos["id_caja"];?>">.</a></td>
              
              <td class="informacion">
			  <?php 
			  	if ($asientos["no_liquidar"]==1){?>
                	<a href="marcar_para_liquidacion.php?movimiento=<?php echo $asientos["id_caja"];?>&no_liquidar=0&responsable=<?php echo $persona_liquidada;?>&fecha_liquidacion=<?php echo $fecha_hasta;?>"><img src="../images/realizada_no.gif" width="16" height="16" border="0" /></a>
                            <?php }
				  		else
				  		{?>
                            <a href="marcar_para_liquidacion.php?movimiento=<?php echo $asientos["id_caja"];?>&no_liquidar=1&responsable=<?php echo $persona_liquidada;?>&fecha_liquidacion=<?php echo $fecha_hasta;?>"><img src="../images/realizada_si.gif" width="16" height="16" border="0" /></a>
                            <?php } ?>                        
               </td>
      		</tr>
      
	  		<?php
				if ($color_fondo=="#D7DDE3"){
					$color_fondo="#B4BFCD";
				}
				else
				{
				$color_fondo="#D7DDE3";
				}	
					
		
		}//------FIN BUCLE PARA LISTAR LOS ASIENTOS REF.2
		
		
	
				$total=$tot_ingreso-$tot_egreso;
				
				
				$query_ultima_liquidacion="select liquidacion,moneda,total,fecha_hasta from tts_liquidaciones
				where persona='$persona_liquidada' and azul='$azul' and moneda='".$monedas["id_moneda"]."' order by liquidacion desc";
								
				
				$record_ultima_liquidacion=mysql_query($query_ultima_liquidacion,$link);
				
				if($ultima_liqui=mysql_fetch_array($record_ultima_liquidacion)){
					$saldo_inicial=$ultima_liqui["total"];
					$fecha_desde=$ultima_liqui["fecha_hasta"];
				}
				
				$total_cierre=$total + $saldo_inicial;
			
				?>
      <tr>
        <td height="60" colspan="11"><table width="250" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100" align="left" valign="middle" class="etiquetas">Saldo anterior:</td>
            <td width="100" align="left" valign="middle" class="datos"><?php echo " ".number_format($saldo_inicial,2,'.','');?></td>
          </tr>
          <tr>
            <td width="100" align="left" valign="middle" class="etiquetas">Saldo actual:</td>
            <td width="100" align="left" valign="middle" class="datos"><?php echo " ".number_format($total,2,'.','');?></td>
          </tr>
          <tr>
            <td width="100" align="left" valign="middle" class="etiquetas">Saldo final: </td>
            <td width="100" align="left" valign="middle" class="datos"><?php 
					echo " ".number_format($total_cierre,2,'.','');?></td>
          </tr>
        </table>          </td>
      </tr>
     
      <?
				
				
				
				if($liquidar==1 and $asientos_liquidar >0){
				
						$query_inserta_liquidacion="insert into tts_liquidaciones (liquidacion,azul,usuario,persona,moneda,saldo_inicial,total_movimientos,total_liquidacion,fecha_hasta) 
						values ('$time_liquidado','$azul','$usuario','$persona_liquidada','".$monedas["id_moneda"]."','$saldo_inicial','$total','$total_cierre','$fecha_hasta')";
				}
					
				if(mysql_query($query_inserta_liquidacion,$link)==true){
						$error_inserta_liquidacion=$error_inserta_liquidacion+0;
				}
				else
				{
					$error_inserta_liquidacion=$error_inserta_liquidacion+1;
				}
				
				
				
			}//------FIN BUCLE PARA EL TIPO DE MONEDAS REF.1
			
			if($liquidar==1){ 
				if($error_inserta_liquidacion==0){
					$mensaje="Liquidación realizada correctamente";
				}
				else
				{
					$mensaje="La liquidación no fue realizada correctamente";
				}
			}
				
				?>
    </table>
	<?php
	}
	?>
	<p><br />
          <br />
    </p>	</td>
  </tr>
  <tr>
    <td bgcolor="#A8B6C6">
	</td>
  </tr>
  <tr>
    <td bgcolor="#A8B6C6"><table width="700" border="0" cellspacing="0" cellpadding="0">
	 <tr>
        <td><span class="etiquetas"><?php echo $mensaje;?></span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="350"><?php if($liquidar!=1 and $asientos_liquidar >0){ ?>
          <form id="form2" name="form2" method="post" action="frm_liquidacion.php">
          <table width="300" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><label>
                <input type="submit" name="Submit2" value="Liquidar" />
              </label></td>
              <td><label>
                <input name="persona_liquidada" type="hidden" id="persona_liquidada" value="<?php echo $persona_liquidada;?>" />
                </label>
                  <label>
                  <input name="liquidar" type="hidden" id="liquidar" value="1" />
                  <input name="txt_fecha_hasta" type="hidden" id="txt_fecha_hasta" value="<?php echo fecha_mysql_normal($fecha_hasta);?>" />
                  <input name="azul" type="hidden" id="azul" value="<?php echo $azul;?>" />
                  </label></td>
            </tr>
          </table>
        </form>
		<?php } ?>		</td>
        <td width="350">
        
		<?php 
		if($liquidar==1 and $asientos_liquidar >0){ ?>
		<form action="../lib/pdf/reporte_liquidacion.php" method="post" name="form3" target="_blank" id="form3">
          <table width="300" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><label>
                <input type="submit" name="Submit22" value="Imprimir" />
              </label></td>
              <td><label>
                <input name="liquidacion" type="hidden" id="liquidacion" value="<?php echo $time_liquidado; ?>" />
                </label>
                  <label>
                  <input name="persona" type="hidden" id="persona" value="<?php echo $persona_liquidada;?>" />
                  <input name="txt_fecha_hasta" type="hidden" id="txt_fecha_hasta" value="<?php echo fecha_mysql_normal($fecha_hasta);?>" />
                  <input name="txt_fecha_desde" type="hidden" id="txt_fecha_desde" value="<?php echo fecha_mysql_normal($fecha_desde);?>" />
                  <input name="azul" type="input" id="azul" value="<?php echo $azul; ?>" />
                  </label></td>
            </tr>
          </table>
        </form>
		<?php }?>		</td>
      </tr>
     
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#A8B6C6">&nbsp;</td>
  </tr>
</table>
</body>
</html>
