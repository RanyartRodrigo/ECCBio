<?php	
	include "../Panel/base.php";
	$baseDatos = $_REQUEST['bd'];	
	$conex=new Base("localhost","ggonzalez","$baseDatos");	
	echo json_encode(descripcion($conex));
	
	function descripcion($conex){				
		$estilo="";
		$query="SELECT descripcion FROM menus2 
				WHERE id_Capa=".$_REQUEST["idCapa"];
        $result = $conex->consulta($query);        
		$fila = $result->fetch_object();
		return $fila->descripcion;        
	}
?>
