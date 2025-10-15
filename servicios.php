<?php 
header("Content-Type: text/html;charset=iso-8859-1");
include("lib/functions.php");

//----Seguridad sql inyection-------------------------------------
if (!is_numeric($_GET["sector"]) and $_GET["sector"] !=""){

	header("location:index.php");
}
//----FIN Seguridad sql inyection-------------------------------------

//----------Querys---------------------------

$id_sector=$_GET["sector"];

$link=conectarse();

control_acceso($link,$id_sector);

$sql_sector="SELECT descripcion  FROM sectores 
WHERE id_sector='$id_sector'";	
					
$result=mysql_query($sql_sector,$link);
$sector=mysql_fetch_array($result);


$sql_noti="SELECT id_noticia,titulo,contenido1,contenido2,video_script,video_habilitado from noticias_2014 
		WHERE publicado='1' and id_sector='$id_sector'";
				
$result_noti=mysql_query($sql_noti,$link);

      



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Servicios</title>
<link href="css2014/estilos2014.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images_prototipo/escudo_ico.ico">

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


<script language='javascript' src="jscripts/funciones.js"></script>
 
<script type="text/JavaScript">

//-------------Validaciones del formulario---------------------------//
function validar(frm) {

	var patron= /\S+@\S+\.\S+/;

	if (isNaN(document.form1.txt_documento.value) || vacio(document.form1.txt_documento.value)==false || document.form1.txt_documento.value.length < 7 || document.form1.txt_documento.value.length > 8) {
        alert("Debe ingresar el documento, el mismo no puede tener menos de 7 dígitos ni más de 8"); 
		document.form1.txt_documento.focus();
  		return (false); 
    }
	
	 if ( vacio(document.form1.txt_apellido.value)==false ){
  		alert("Debe ingresar el apellido"); 
		document.form1.txt_apellido.focus();
  		return (false); 
  	}
   
   if ( vacio(document.form1.txt_nombre.value)==false ){
  		alert("Debe ingresar el nombre"); 
		document.form1.txt_nombre.focus();
  		return (false); 
  	}
	
	if ( vacio(document.form1.txt_fecha.value)==false ){
  		alert("Debe ingresar la fecha de nacimiento"); 
		document.form1.txt_fecha.focus();
  		return (false); 
  	}
	
	if ( isNaN(document.form1.txt_telefono.value) || vacio(document.form1.txt_telefono.value)==false || document.form1.txt_telefono.value.length < 7 ){
  		alert("Debe ingresar un número de teléfono, el mismo debe contener solo números"); 
		document.form1.txt_telefono.focus();
  		return (false); 
  	}
	
	
	if ( !(document.form1.txt_email.value.match(patron))){
  		alert("Debe ingresar una direccion de correo valida"); 
		document.form1.txt_email.focus();
  		return (false); 
  	}

	if ( document.form1.txt_actividad.value==".." ){
  		alert("Debe seleccionar una actividad"); 
		document.form1.txt_actividad.focus();
  		return (false); 
  	}

	
	if (!confirm('¿Confirma la inscripción?')){   
	   return (false); 
   }
   
}
//-------------Fin validaciones del formulario---------------------------//

</script>

</head>

<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3"><img src="images_prototipo/encabezado.jpg" width="1000" height="99" /></td>
  </tr>
  <tr>
    <td width="219" height="65" rowspan="2" align="left" valign="top"><?php require_once("inc2014/lateral_izq.php");?></td>
    <td height="65" colspan="2" align="left" valign="top"><?php require_once("inc2014/menu_sup.php");?></td>
  </tr>
  <tr>
    <td width="562" align="center" valign="top"><table width="520" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
    <td height="30" align="left" valign="top" ><a href="<?php echo $_SERVER['HTTP_REFERER'];?>" class="leer_mas">&#9474;Volver &#9474;</a></td>
    </tr>
    <tr>
    <td class="sector_titulo">
    <?php echo $sector["descripcion"]; ?>    </td>
    </tr>
    <tr align="center" valign="top">
        <td height="15" class="desarrollo_titu_noticia"></td>
      </tr>
      <tr>
        <td align="center" valign="top" class="desarrollo_cont_noticia"><?php while ($noticia=mysql_fetch_array($result_noti)){?>
            <table width="520" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="desarrollo_titu_noticia"><?php echo $noticia["titulo"]; ?></td>
              </tr>
              
              <tr> 
              <td align="left" valign="top">
 
        <?php 
			
			//Mapa para lugares de pago------------------------------
			if($id_sector==240){
			echo"<iframe width='540' height='400' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='https://maps.google.com/maps/ms?msid=206694498020373933344.0004d84ef5c7604a9f49a&amp;msa=0&amp;ie=UTF8&amp;ll=-41.139323,-71.357666&amp;spn=0.055831,0.170202&amp;t=h&amp;output=embed'></iframe><br /><small><a href='https://maps.google.com/maps/ms?msid=206694498020373933344.0004d84ef5c7604a9f49a&amp;msa=0&amp;ie=UTF8&amp;ll=-41.139323,-71.357666&amp;spn=0.055831,0.170202&amp;t=h&amp;source=embed' style='color:#0000FF;text-align:left' target='_blank' class='leer_mas'>Ver lugares de pago en un mapa ampliado</a></small>";
			}
			//Fin mapa para lugares de pago------------------------------
			
			if($noticia["video_habilitado"]==1){ //muestro video o galeria
				?>
                	<iframe width="453" height="300" src="<?php echo $noticia["video_script"]; ?>" frameborder="0" allowfullscreen="allowfullscreen">		</iframe>
				<?php
				}
				else
				{
					$contenido=$noticia["id_noticia"]; 
					include("pasador_desarrollo.php");
				}
				?>	            </td>
              </tr>
              <tr>
                <td>
                <?php
                 if ($id_sector==224){ //SECTOR DEPORTES
				 
				 
				 ?>
                 
                 <p><strong><em>Direcci&oacute;n:</em></strong><em> Casa del Deporte, Av. Costanera y Rolando &ndash;San Carlos de Bariloche.<br />
					<strong>Tel&eacute;fonos:  (54) 294 4426466</strong><br />
                    <strong>E-mail: admdeportesmscb@bariloche.gov.ar</strong></em></p>
				<p>&nbsp;</p>
				
                <strong>MISIÓN:</strong>
                <p>Diseñar e implementar políticas de promoción de la práctica del deporte, recreación y aprovechamiento del tiempo libre. </p>
                <br />
                <strong>FUNCIONES:</strong>
                <p>

<li>Planificar, mantener y cuidar las instalaciones deportivas y recreativas del Municipio, como así también los recursos para su funcionamiento.</li>
<li>Elaborar un plan anual que contemple mantenimiento, refacción, mejoramiento y construcción de infraestructura deportiva - recreativa municipal.</li>
<li>Prestar asistencia técnica y de infraestructura a organismos e instituciones estatales y privadas, a fin de fomentar el desarrollo de actividades físicas y deportivas en la comunidad.</li>
<li>Habilitar, coordinar y controlar el registro de instituciones deportivas, clubes, colonias de vacaciones, gimnasios y otras, dedicados a la enseñanza y práctica de las actividades físicas y/o recreativas.</li>
<li>Aplicar el canon correspondiente a las cesiones de las distintas instalaciones que dependen de la Subsecretaría de Deportes.</li>
<li>Apoyar la labor de los clubes deportivos con medidas que apunten al desarrollo del deporte federado.</li>
<li>Colaborar en el calendario anual de actividades y competencias deportivas junto con las entidades vinculadas que lo deseen.</li>
<li>Establecer contacto permanente con las fuerzas empresariales, sindicales y comerciales con el objeto de lograr apoyo para el desarrollo del deporte federado.</li>
<li>Recibir las peticiones que motivan las actividades o programas de las instituciones deportivas, para su estudio y tratamiento.</li>
<li>Llevar a cabo todas las actividades deportivas programadas, coordinando su ejecución con los demás organismos públicos o privados vinculados.</li>
<li>Proponer actividades y programas a incluir cada año en base a experiencias propias y del personal técnico.</li></p>
                 
                 
               
                  <table width="570" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
                          <tr>
                            <td width="570" height="30" align="left" valign="middle" class="sector_titulo"><label><span class="Titulo_noticia_sec">Preinscripci&oacute;n a Actividades Deportivas Anuales (aranceladas)</span><span class="titulopantalla"><br />
                              </span></label>
                              <div class="desarrollo_cont_noticia"></div>
                              <p class="desarrollo_cont_noticia">La pre-inscripción dará lugar a un sorteo para cubrir las vacantes en las actividades aranceladas programadas por la Subsecretaria de Deportes Municipal. Momento en el cual se le confirmara telefónicamente si ha quedado seleccionado a fin de instruirlo, donde y cuando deberá presentar la documentación requerida y abonar el arancel correspondiente. </p>
                              <p class="desarrollo_cont_noticia">Requisitos:</p>
                              <p class="desarrollo_cont_noticia">* Preinscribirse completando el formulario</p>
                              <p class="desarrollo_cont_noticia">Al momento de la Inscripción, luego de confirmarse el lugar, deberá concurrir con la siguiente documentación obligatoria e indispensable:</p>
                              <p class="desarrollo_cont_noticia">* 2 fotos carnet 4x4</p>
                              <p class="desarrollo_cont_noticia">* Fotocopia del DNI</p>
                              <p class="desarrollo_cont_noticia">* En caso de los menores traer fotocopia de CUIL del padre o tutor.</p>
                              <p class="desarrollo_cont_noticia">* Ficha de Salud debidamente conformada y rubricada con validez anual (<a href="http://www.bariloche.gov.ar\upload\ficha_salud.pdf" target="_blank">descargar aqui</a>)</p>
                              <p class="desarrollo_cont_noticia">* Abonar arancel correspondiente a Matricula y cuota (<a href="http://www.bariloche.gov.ar\upload\cuadro_tarifario_deportes.pdf" target="_blank">Ver Ord. 2932-CM-17  Cap&iacute;tulo XVII</a>)</p>
                              <label><span class="titulopantalla"><br />
                              </span></label></td>
                          </tr>
                      </table></td>
                    </tr>
                   <tr>
                   <td><a href="actividades/index.php" target="_blank" class="enlace">Formulario de preinscripci&oacute;n en actividades deportivas aranceladas</a></td>
                   </tr> 
                    
                  </table>
               
			  	
				<?php 
				}//FIN SECTOR DEPORTES
				
			  ?>
                
                </td>
              </tr>
              
              <tr>
                <td class="desarrollo_cont_noticia"><?php echo $noticia["contenido1"]." ".$noticia["contenido2"]; ?></td>
              </tr>
              
			  <?php if($id_sector==217){?>
               <tr>
                <td class="desarrollo_cont_noticia"><a href="turnos_frentistas/mod_turnos" target="_blank"><img src="banners_inicio/bn_frentistas.jpg" width="260" height="110" border="0" /></a></td>
              </tr>
               <?php }?>
			  
			  <?php if($id_sector==228){?>
               <tr>
                <td class="desarrollo_cont_noticia"><a href="http://www.bariloche.gov.ar/sector2014.php?sector=264"><img src="http://www.bariloche.gov.ar/upload/banner_voluntariado.gif" width="240" height="110" /></a></td>
              </tr>
              <tr>
                <td height="10"> </td>
              </tr>
              <tr>
                <td class="desarrollo_cont_noticia"><a href="http://www.bariloche.gov.ar/upload/plan_de_emergencias_final.pdf" target="_blank"><img src="http://www.bariloche.gov.ar/upload/banner_plan_gral_pc.jpg" border="0"  /></a></td>
              </tr>
               <tr>
                <td height="10"> </td>
              </tr>
              <tr>
                <td class="desarrollo_cont_noticia"><a href=" https://drive.google.com/drive/folders/0BzwnxI6BKY-2Rmx4UGt0OXBrUmM
" target="_blank"><img src="http://www.bariloche.gov.ar/upload/banner_folletos.gif" border="0"  /></a></td>
              </tr>
              
               <tr>
                <td height="10"> </td>
              </tr>
              <tr>
                <td class="desarrollo_cont_noticia"><a href="http://www.bariloche.gov.ar/upload/convocatoria_usar.pdf
" target="_blank"><img src="http://www.bariloche.gov.ar/upload/banner_usar.jpg" border="0"  /></a></td>
              </tr>
              
              <tr>
                <td class="desarrollo_cont_noticia"><a href="http://www.bariloche.gov.ar/upload/plan_contingencias_eventos_masivos.pdf
" target="_blank"><img src="http://www.bariloche.gov.ar/upload/banner_contingencias_eventos_masivos.jpeg" border="0"  /></a></td>
              </tr>
              
              <?php }?>
              <tr>
                <td class="desarrollo_cont_noticia"><?php include("inc2014/descargas.php");?></td>
              </tr>
            </table>
          <?php } ?>
        </td>
      </tr>
      <tr>
        <td class="desarrollo_cont_noticia"></td>
      </tr>
    </table></td>
    <td width="219" align="center" valign="top">
				<?php
				
                 if ($id_sector!=224){
				 	require_once("inc2014/lateral_der2014.php");
				}?>
	</td>
  </tr>
  <tr>
    <td width="219">&nbsp;</td>
    <td width="562">&nbsp;</td>
    <td width="219">&nbsp;</td>
  </tr>
</table>
</body>

</html>
