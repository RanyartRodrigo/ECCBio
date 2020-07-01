<?php
	switch ($_POST['opcion']) {
		case 0:
			Eliminar();
			break;
		case 1:
			if(!strcmp($_POST['id'],""))
				Agregar();
		else
				Modificar();
			break;
		case 2:
			Duplicar();
			break;
	}
function Modificar(){
	$id=$_POST['id'];
	include "../base.php";
	include "../host2.php";
	$obj=new Base("localhost",$DB_user,$DB_name);
	$estilos=str_replace("'","\'",$_POST['estilos']);
	$obj->consulta("update $DB_name.columnas set leyendaStrech='".$_POST['leyendaStrech']."',columna='".$_POST['columna']."', valorFiltro='".$_POST['valorFiltro']."', estilos='".$estilos."' , titulo='".$_POST['titulo']."', tipoMapa={$_POST['tipoMapa']}, tipoValores={$_POST['tipoValores']} where idColumna=".$id);
	$jsondata = array();
	$jsondata["success"] = $obj->db->affected_rows==1?true:false;
	$jsondata["new"] = $id;
    $jsondata["data"]["message"] =$obj->db->info." ".$obj->db->error;
    header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
function Duplicar(){
	$id=$_POST['id'];
	include "../base.php";
	include "../host2.php";
	$obj=new Base("localhost",$DB_user,$DB_name);
	$result=$obj->consulta("select * from $DB_name.columnas where idColumna=".$id);
	$fila = $result->fetch_object();
$obj->consulta('insert into $DB_name.columnas (columna, valorFiltro, estilos, titulo,tipoMapa,tipoValores,leyendaStrech) values ("'.$fila->columna.'", "'.$fila->valorFiltro.'", "'.$fila->estilos.'", "'.$fila->titulo.' 2",'.$fila->tipoMapa.','.$fila->tipoValores.',"'.$fila->leyendaStrech.'")');
	$result2=$obj->consulta('select idColumna from $DB_name.columnas where columna="'.$fila->columna.'" and valorFiltro="'.$fila->valorFiltro.'" and estilos="'.$fila->estilos.'" and titulo="'.$fila->titulo.' 2"');
	$fila2 = $result2->fetch_object();
	$alcanceId=$fila2->idColumna;
	$jsondata = array();
	$jsondata["new"] = $alcanceId;
	$jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
function Eliminar(){
	$id=$_POST['id'];
	include "../base.php";
	include "../host2.php";
	$obj=new Base("localhost",$DB_user,$DB_name);
	$obj->consulta("delete from $DB_name.columnas where idColumna=".$id);
	$jsondata = array();
	$jsondata["success"] = true;
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
function Agregar(){
	include "../base.php";
	include "../host2.php";
	$obj=new Base("localhost",$DB_user,$DB_name);
	$estilos=str_replace("'","\'",$_POST['estilos']);
	$obj->consulta("insert into columnas (columna, valorFiltro, estilos, titulo,tipoMapa,tipoValores,leyendaStrech) values ('{$_POST['columna']}', '{$_POST['valorFiltro']}', '$estilos', '{$_POST['titulo']}',{$_POST['tipoMapa']},{$_POST['tipoValores']},'{$_POST['leyendaStrech']}')");
	// $obj->consulta("insert into $DB_name.columnas (columna, valorFiltro, estilos, titulo) values ('".$_POST['columna']."', '".$_POST['valorFiltro']."', '".$estilos."', '".$_POST['titulo']."')");
	$result=$obj->consulta("select idColumna from $DB_name.columnas where columna='".$_POST['columna']."' and valorFiltro='".$_POST['valorFiltro']."'");
	for ($x=0;$x<1;$x++) {
		$fila = $result->fetch_object();
        $alcanceId=$fila->idColumna;
	}
	$jsondata = array();
	$jsondata["new"] = $alcanceId;
	$jsondata["success"] = true;
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
?>
