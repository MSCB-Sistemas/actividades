<?php
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
	
function fecha_mysql_normal_completa($fechavieja){
    list($f)=explode(" ",$fechavieja);
	list($a,$m,$d)=explode("-",$f);
    return $d."-".$m."-".$a;
};
	
function fecha_mysql_normal($fechavieja){
    list($a,$m,$d)=explode("-",$fechavieja);
    return $d."-".$m."-".$a;
};
?>