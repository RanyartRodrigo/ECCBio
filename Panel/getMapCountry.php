<?php
	include "base.php";
	$baseDatos = $_REQUEST['bd'];
	$base=new Base("localhost","root","$baseDatos");
	$url = $_REQUEST['url'];
	$query = "SELECT latitud, longitud,zoom, maxZoom,usoSuelo,id_Pais FROM paises WHERE nombreURL ='$url'";
	$res =$base->consulta($query);
	$row = $res->fetch_array(MYSQLI_NUM);
	$response[0] = $row[0];
	$response[1] = $row[1];
	$response[2] = $row[2];
	$response[3] = $row[3];
        $response[4] = ($row[4]==NULL || $row[4] == '')?NULL:$row[4];
        $response[5] = $row[5];
	header('Content-Type: application/json');
	echo json_encode($response);	
?>
