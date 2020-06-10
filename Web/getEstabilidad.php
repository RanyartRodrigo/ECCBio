<?php
	include "../Panel/base.php";
	header('Access-Control-Allow-Origin: http://www.wegp.unam.mx',false); 
	$base=new Base("localhost","ggonzalez","conabio3");
	
	$idANP = $_REQUEST['idANP'];
	$per = $_REQUEST['per'];
	$rcp = $_REQUEST['rcp'];

	//$query = "SELECT climas FROM climasANP WHERE idANP IN ($idANP) and idVariable=$idVariable and idTemporada=$idTemporada order by idANP asc";
	$query = "SELECT estabilidad FROM estabilidad WHERE idANP = $idANP AND periodo = $per AND rcp = $rcp";
	$resultado=$base->consulta($query);
	$result = [];
	header('Content-Type: application/json');
	while($fila=$resultado->fetch_assoc()){
		array_push($result,$fila["estabilidad"]);
		//array_push($result,$fila["prot"]);
		//array_push($result,$fila["unprot"]);
	}
	if(isset($_GET['callback'])){ // Si es una petición cross-domain  
		echo $_GET['callback'].'('.json_encode($result).')';
	}else{ // Si es una normal, respondemos de forma normal  
		echo json_encode($result);
	}
?>
