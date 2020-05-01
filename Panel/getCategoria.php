<?php
	include "base.php";
        $baseDatos = $_REQUEST['bd'];
        $base=new Base("localhost","root","$baseDatos"); 
	$descripcion = $_REQUEST['descripcion'];
        $idPais = $_REQUEST['idPais'];
	$query = "SELECT categoria FROM usoSuelo WHERE idPais =$idPais AND descripcion='$descripcion'";
	$res =$base->consulta($query);
	$row = $res->fetch_array(MYSQLI_NUM);
        if($row != null){
	        $categoria = intval($row[0]);
		$response[0] = $categoria == 0?-1:$categoria;		
	}else{
		$response[0] = -1;
	}
	header('Content-Type: application/json');
	echo json_encode($response);
?>
