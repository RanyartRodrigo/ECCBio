<?php
	include "base.php";
	include "host2.php";
	$baseDatos = $_REQUEST['bd'];
        $base=new Base($DB_server,$DB_user,"$baseDatos");
	$idPais = $_REQUEST['idPais'];
	$query = "SELECT categoria, descripcion FROM usoSuelo WHERE idPais =$idPais";
        //echo $query;
	$res =$base->consulta($query);
        $i=0;
	while($row = $res->fetch_array(MYSQLI_NUM)){       
	 	$response[$i][0] = intval($row[0]);
		$response[$i][1] = $row[1];
                $i++;
        }
	header('Content-Type: application/json');
	echo json_encode($response);
?>
