<?php
	//include "base.php";
        include "host.php"
	include $rootApp."/Panel/base.php";
	header('Access-Control-Allow-Origin: http://www.wegp.unam.mx',false); 
        //header('Access-Control-Allow-Origin: http://www.wegp.unam.mx',false); 
	#$baseDatos = $_REQUEST['bd'];
        $base=new Base("localhost","root","conabio3");	
	//$temperaturas = $_REQUEST['temperaturas']; 
	$idPais = 1;//$_REQUEST['idPais'];
	$idEstado = $_REQUEST['metadata'];
	$idVariable = $_REQUEST['variable'];
	$idTemporada = $_REQUEST['idTemporada'];
	$query = "SELECT climas,idsANP FROM climaPorEstado WHERE idEstado IN ($idEstado) and idVariable=$idVariable and idTemporada=$idTemporada order by idEstado";
        //die ($query);
	$resultado=$base->consulta($query);
	$result = [[]];
	header('Content-Type: application/json');
	$i=0;
	while($fila=$resultado->fetch_assoc()){
		//echo $fila["climas"];
		$result[$i][0] = $fila["climas"];
		$result[$i]["idsANP"] = $fila["idsANP"];
		$i++;
//		array_push($result,{$fila["climas"],'idsANP':$fila["idsANP"]});
	}
	if(isset($_GET['callback'])){ // Si es una petición cross-domain  
	        echo $_GET['callback'].'('.json_encode($result).')';
        }else{ // Si es una normal, respondemos de forma normal  
        	echo json_encode($result);
        }
	//print_r($result);
?>
