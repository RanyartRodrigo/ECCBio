<?php
	//include "base.php";
	include "../Panel/base.php";
	header('Access-Control-Allow-Origin: http://www.wegp.unam.mx',false); 
	include "../Panel/host2.php";
        $base=new Base($DB_server,$DB_user,$DB_name);
	
	$idANP = $_REQUEST['idANP'];
	$rcp = $_REQUEST['rcp'];
	
	//$query = "SELECT climas FROM climasANP WHERE idANP IN ($idANP) and idVariable=$idVariable and idTemporada=$idTemporada order by idANP asc";
	$query = "SELECT mann FROM mannKendall WHERE idANP = $idANP AND rcp = $rcp";
	$resultado=$base->consulta($query);
	$result = [];
	header('Content-Type: application/json');
	while($fila=$resultado->fetch_assoc()){
		array_push($result,$fila["mann"]);
	}
	if(isset($_GET['callback'])){ // Si es una petición cross-domain  
		echo $_GET['callback'].'('.json_encode($result).')';
	}else{ // Si es una normal, respondemos de forma normal  
		echo json_encode($result);
	}
?>
