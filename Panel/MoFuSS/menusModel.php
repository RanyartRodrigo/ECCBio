<?php
	include "../base.php";
	$obj=new Base("localhost","root","conabio3");
	switch ($_POST['opcion']) {
		case 0: Eliminar($obj); break;
		case 1: if(!strcmp($_POST['id'],""))
					Agregar($obj);
				else
					Modificar($obj);
			break;
		case 2: SubirImagen($obj);break;
		case 3: Duplicar($obj);break;
		case 4: Prioridad($obj);break;
		case 5: AgregarColor($obj);break;
		case 6: EliminarColor($obj);break;	
	}
	function AgregarColor($obj){
		$id=$_POST['id'];
		$result=$obj->consulta("select * from submenusEstilo where nombre='".$_POST['id']."'");
		$fila = $result->fetch_object();
		$numfilas = $result->num_rows;
		if($numfilas==0)
			$obj->consulta('insert into submenusEstilo (nombre,color) values ("'.$_POST['id'].'","'.$_POST['color'].'")');
		else
			$obj->consulta('update submenusEstilo set nombre="'.$_POST['id'].'", color="'.$_POST['color'].'" where nombre="'.$_POST['id'].'"');
		$alcanceId=$_POST['id'];
		$jsondata = array();
		$jsondata["new"] = $alcanceId;
		$jsondata["success"] = true;
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata, JSON_FORCE_OBJECT);
	}
	function Duplicar($obj){
		$id=$_POST['id'];
		$result=$obj->consulta("select * from menus2 where id_Capa=".$id);
		$fila = $result->fetch_object();		
		$obj->consulta('insert into menus2 (nombre,tipo,unidad,escalaLog,latitud,longitud,id_Pais,descripcion,nombreEE,nombreEE2,id_Columna,zoom) values ("'.$fila->nombre.' 2","'.$fila->tipo.'", "'.$fila->unidad.'", '.$fila->escalaLog.',"'.$fila->latitud.'","'.$fila->longitud.'", '.$fila->id_Pais.', "'.$fila->descripcion.'","'.$fila->nombreEE.'", "'.$fila->nombreEE2.'", '.$fila->id_Columna.', '.$fila->zoom.')');		
		$jsondata = array();
		$jsondata["new"] = $obj->db->insert_id;
		$jsondata["success"] = true;
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata, JSON_FORCE_OBJECT);
	}
	function Modificar($obj){
		$id=$_POST['id'];
		if($_POST['id_Columna']=='null')
			$columna="NULL";
		else
			$columna=$_POST['id_Columna'];
		$res = $obj->consulta("update menus2 set unidad='".htmlentities($_POST['unidad'])."', escalaLog=".$_POST['log'].", tipo='".$_POST['tipo']."', nombre='".htmlentities($_POST['nombre'])."', latitud='".$_POST['latitud']."', longitud='".$_POST['longitud']."', id_Pais='".$_POST['id_Pais']."', descripcion='".$_POST['descripcion']."', nombreEE='".$_POST['nombreEE']."', nombreEE2='".$_POST['nombreEE2']."', id_Columna=".$columna.", zoom='".$_POST['zoom']."' where id_Capa=".$id);
		$jsondata = array();
		$jsondata["success"] = $res;
		$jsondata["new"] = $id;
		$jsondata["data"]["message"] =$obj->error;
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata, JSON_FORCE_OBJECT);
	}
	function Eliminar($obj){
		$id=$_POST['id'];
		$obj->consulta("delete from menus2 where id_Capa=".$id);
		$jsondata = array();
		$jsondata["success"] = true;
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata, JSON_FORCE_OBJECT);
	}
	function Agregar($obj){
		if($_POST['id_Columna']=='null')
			$columna="NULL";
		else
			$columna=$_POST['id_Columna'];			
		$obj->consulta("insert into menus2 (nombre,tipo, unidad, escalaLog, latitud,longitud, id_Pais, descripcion,nombreEE, nombreEE2, id_Columna, zoom) values ('".htmlentities($_POST['nombre'])."','".$_POST['tipo']."', '".htmlentities($_POST['unidad'])."',".$_POST['log'].", '".$_POST['latitud']."', '".$_POST['longitud']."', '".$_POST['id_Pais']."', '".$_POST['descripcion']."', '".$_POST['nombreEE']."',  '".$_POST['nombreEE2']."', ".$columna.", '".$_POST['zoom']."')");
		$jsondata = array();
		$jsondata["new"] = $obj->db->insert_id;
		$jsondata["success"] = true;
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata, JSON_FORCE_OBJECT);
	}
	function SubirImagen($obj){
		if ($_FILES['img']['size'] != 0){
			$target_path = "../uploads/menus/";
			$target_path = $target_path . $_POST['id'].'.'.pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION); 
			move_uploaded_file($_FILES['img']['tmp_name'], 
			$target_path); 
			$obj->consulta("update menus set img='".$_POST['id'].'.'.pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION)."' where id=".$_POST['id']);
		}
	}
	function Prioridad($obj){
		$jsondata["success"] = true;
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsondata, JSON_FORCE_OBJECT);
	}
?>
