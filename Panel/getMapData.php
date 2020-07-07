<?php
	include "base.php";
	include "host2.php";
	$baseDatos = $_REQUEST['bd'];
        $base=new Base($DB_server,$DB_user,"$baseDatos");	
	$idCapa = $_REQUEST['idCapa'];
	$query = "SELECT nombreEE, latitud, longitud, zoom, columna, valorFiltro, estilos,nombreEE2,unidad,tipo,escalaLog, id_Pais, password  
		FROM menus LEFT join columnas 
		ON menus.id_Columna = columnas.idColumna 
		WHERE id_Capa=$idCapa";
	$res =$base->consulta($query);
	$row = $res->fetch_array(MYSQLI_NUM);
	$response[0] = $row[0];
	$response[1] = $row[1];
	$response[2] = $row[2];
	$response[3] = $row[3];
	$response[4] = $row[4];
	$response[5] = $row[5]=='NULL'?NULL:$row[5];
	$response[6] = $row[6];
	$response[7] = $row[7]==NULL?"":$row[7];
	$response[8] = $row[8]==NULL?"":$row[8];
        $response[9] = $row[9]==NULL?"":$row[9];
        $response[10] = $row[10];
        $response[11] = $row[11];
        $response[12] = $row[12];
	header('Content-Type: application/json');
	echo json_encode($response);	
?>
