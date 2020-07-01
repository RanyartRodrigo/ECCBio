<?php
	include "../Panel/base.php";
	$baseDatos = $_REQUEST['bd'];	
	$conex=new Base("localhost","root","$baseDatos");	
	echo json_encode(estilosCapa($conex,$_REQUEST["idCapa"]));
	
	function estilosCapa($conex,$idCapa){				
		$estilo="";
		$query="SELECT columnas.estilos 
				FROM menus2,columnas 
				WHERE columnas.idColumna=menus2.id_Columna 
				AND id_Capa=$idCapa";
        $result = $conex->consulta($query);        
		$fila = $result->fetch_object();
		return $fila->estilos;        
	}
?>
