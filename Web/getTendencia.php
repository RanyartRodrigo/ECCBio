<?php
	//include "base.php";
	include "../Panel/base.php";
	header('Access-Control-Allow-Origin: http://www.wegp.unam.mx',false); 
	include "../Panel/host2.php";
        $base=new Base($DB_server,$DB_user,$DB_name);
	
	$idANP = $_REQUEST['idANP'];
	$d = $_REQUEST['d'];
	//$query = "SELECT climas FROM climasANP WHERE idANP IN ($idANP) and idVariable=$idVariable and idTemporada=$idTemporada order by idANP asc";
	$query = "SELECT tendencia FROM tendencia WHERE idANP = $idANP AND d = $d";
	$resultado=$base->consulta($query);
	$result = [];
	header('Content-Type: application/json');
	while($fila=$resultado->fetch_assoc()){
		array_push($result,$fila["tendencia"]);
		//array_push($result,$fila["prot"]);
		//array_push($result,$fila["unprot"]);
	}
	if(isset($_GET['callback'])){ // Si es una petición cross-domain  
		echo $_GET['callback'].'('.json_encode($result).')';
	}else{ // Si es una normal, respondemos de forma normal  
		echo json_encode($result);
	}
?>
