<?php

//-----------------Funciones de fecha-----------------------------------
function timestampToFecha ($timeStamp)
{
    $fechaDelTime=getdate($timeStamp);
		  $dia=$fechaDelTime[mday];
		  $mes=$fechaDelTime[mon];
		  $anio=$fechaDelTime[year];
		  $hora=$fechaDelTime[hours];
		  $minuto=$fechaDelTime[minutes];
$fechaDelTime=$dia."-".$mes."-".$anio;		

    return $fechaDelTime;
}


function fechaToTimestamp ($cadena)
{
    $retorno = "";

    
    list ($dia, $mes, $anyo)          = explode ("-", $fecha);
	
   
    if (!$fecha)
    {
        list ($dia, $mes, $anyo) = explode ("-", $cadena);
    }
       
  
    $retorno = mktime(0,0,0,$mes,$dia,$anyo);

    return $retorno;
}


//---------------------------------------------------------------------------

function conectarse(){
	if (!($link=mysql_connect("localhost","root","cavaliere"))){
	   echo "Error conectando a la base de datos.";
	   exit();
	   }
	if (!mysql_select_db("turnos_veterinaria",$link)){
	   echo "Error seleccionando la base de datos.";
	   exit();
	   }
	return $link;
}

	function conectarse_bche(){
		if (!($link=mssql_connect("10.20.130.6","sa","kristina")))  {
		   echo "Error conectando a la base de datos.";
		   exit();
		   }
		if (!mssql_select_db("Bche",$link))  {
		   echo "Error seleccionando la base de datos. ";
		   exit();
		   }
		return $link;
	}

	function send($text) {
		header("Content-type: text/html; charset=utf-8");
		echo utf8_encode($text);
	}	
	
	function conectarse_deportes(){
		if (!($link_deportes=mysqli_connect("localhost","systemasmscb","725Popa913@mysql"))){
		echo "Error conectando a la base de datos.";
		}
		if (!mysqli_select_db($link_deportes,"actividades")){
		echo "Error seleccionando la base de datos.";
		}
		return $link_deportes;
	}
	
	//---Manejo de fechas------------------------------------
	
function fecha_mysql_normal_completa($fechavieja){
    list($f)=explode(" ",$fechavieja);
	list($a,$m,$d)=explode("-",$f);
    return $d."-".$m."-".$a;
};
	
function fecha_mysql_normal($fechavieja){
    list($a,$m,$d)=explode("-",$fechavieja);
    return $d."-".$m."-".$a;
};

function fecha_normal_mysql_barras($fechavieja){
    list($a,$m,$d)=explode("/",$fechavieja);
    return $a."-".$m."-".$d;
};

function fecha_normal_mysql($fechavieja){
    list($d,$m,$a)=explode("-",$fechavieja);
    return $a."-".$m."-".$d;
};

	////////////////////////////////////////////////////
	//Convierte fecha de mysql a normal
	////////////////////////////////////////////////////
	function cambiaf_a_mssql($fecha){
		ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
		$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
		return $lafecha;
	}
	function cambiaf_desde_mssql($fecha){
		ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
		$lafecha=$mifecha[2]."/".$mifecha[1]."/".$mifecha[3];
		return $lafecha;
	}
	function cambiaf_a_normal($fecha){
		ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
		$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
		return $lafecha;
	}
	////////////////////////////////////////////////////
	//Convierte fecha de normal a mysql
	////////////////////////////////////////////////////
	
	function cambiaf_a_mysql($fecha){
		ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
		$lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
		return $lafecha;
	} 
	function lngBuscaId($txtTabla,$lngId) 
	{
		
		$link=Conectarse();
		$qry="Select max($lngId) from $txtTabla;";
		$result=mssql_query($qry,$link);
		$tuplas=0;
		$tuplas = mssql_num_rows($result);
		
		
		if ($tuplas!=0)
		{
			while($array = mssql_fetch_array($result)) {
					$id=$array[0]+1;
					return $id;
						}
		}
		else
		{
			 $id=1;
			 return $id;
		}
				
	}
	function GetIP()
	{
	   if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
			   $ip = getenv("HTTP_CLIENT_IP");
	   else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
			   $ip = getenv("HTTP_X_FORWARDED_FOR");
	   else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
			   $ip = getenv("REMOTE_ADDR");
	   else if (isset($_SERVER[�REMOTE_ADDR�]) && $_SERVER[�REMOTE_ADDR�] && strcasecmp($_SERVER[�REMOTE_ADDR�], "unknown"))
			   $ip = $_SERVER[�REMOTE_ADDR�];
	   else
			   $ip = "unknown";
	  
	   return($ip);
	}

	function fecha()
	{
		/* Definici�n de los meses del a�o en castellano */
		$mes[0]="-";
		$mes[1]="enero";
		$mes[2]="febrero";
		$mes[3]="marzo";
		$mes[4]="abril";
		$mes[5]="mayo";
		$mes[6]="junio";
		$mes[7]="julio";
		$mes[8]="agosto";
		$mes[9]="septiembre";
		$mes[10]="octubre";
		$mes[11]="noviembre";
		$mes[12]="diciembre";

		/* Definici�n de los d�as de la semana */
		$dia[0]="Domingo";
		$dia[1]="Lunes";
		$dia[2]="Martes";
		$dia[3]="Mi�rcoles";
		$dia[4]="Jueves";
		$dia[5]="Viernes";
		$dia[6]="S�bado";
		
		/* Implementaci�n de las variables que calculan la fecha */
		$gisett=(int)date("w");
		$mesnum=(int)date("m");
		/* Variable que calcula la hora*/
		$hora = date(" H:i",time());
		
		/* Presentaci�n de los resultados en una forma similar a la siguiente:
		Mi�rcoles, 23 de junio de 2004 | 17:20
		*/
		
		return $dia[$gisett].", ".date("d")." de ".$mes[$mesnum]." de ".date("Y")." | ".$hora;
	}
	//mostrar un fecha con formato normal
//	<input type="text" name="fecha" value="<?echo cambiaf_a_normal($fila->fecha);

function auditar($id_usuario,$operacion,$ip,$link) {
		$query="insert into auditorias (usuario,query,ip) values ('$id_usuario',\"$operacion\",'$ip')";
		mysql_query($query,$link);
}
	
?>