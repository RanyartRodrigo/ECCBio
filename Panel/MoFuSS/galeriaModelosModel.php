<?php
$opc=$_POST['opcion'];
switch(intval($opc)){
	case 2:
	SubirImagen();
  break;
	case 1:
	Agregar();
	break;
	case 0:
	Eliminar();
	break;
}

function Eliminar()
{
	$img=$_POST['id'];
include "../base.php";
$obj=new Base("localhost","root","mofuss_unam");
$obj->consulta("delete from galeria_modelos  where nombre='".$img."'");
     $target_path = "../uploads/galeria_modelos/";
$target_path = $target_path . $_POST['id']; 
     unlink($target_path);
 $jsondata = array();
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
function Agregar()
{
include "../base.php";
$obj=new Base("localhost","root","mofuss_unam");
$obj->consulta("insert into galeria_modelos (nombre, modelo) values ('nuevo','".$_POST['modelo']."')");
     $result = $obj->consulta("select id from galeria_modelos where nombre='nuevo'");
     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $id=$fila->id;
     }
     $jsondata = array();
 $jsondata["new"] = $id;
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
function SubirImagen(){
  if ($_FILES['imgGaleria']['size'] != 0){
	$target_path = "../uploads/galeria_modelos/";
$target_path = $target_path . $_POST['id'].'.'.pathinfo($_FILES['imgGaleria']['name'], PATHINFO_EXTENSION); 
move_uploaded_file($_FILES['imgGaleria']['tmp_name'], 
    $target_path); 
include "../base.php";
$obj=new Base("localhost","root","mofuss_unam");
$obj->consulta("update galeria_modelos set nombre='".$_POST['id'].'.'.pathinfo($_FILES['imgGaleria']['name'], PATHINFO_EXTENSION)."' where id=".$_POST['id']);

   }
}


?>