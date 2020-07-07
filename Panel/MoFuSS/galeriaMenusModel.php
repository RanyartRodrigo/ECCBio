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
        case 6:
        cambiarImagen();
  break;

}

function Eliminar()
{
	$img=$_POST['id'];
include "../base.php";
include "../host2.php";
$obj=new Base($DB_server,$DB_user,$DB_name);
$obj->consulta("delete from galeria_menus where nombre='".$img."'");
     $target_path = "../uploads/menus/";
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
include "../host2.php";
$obj=new Base($DB_server,$DB_user,$DB_name);
$obj->consulta("insert into galeria_menus (nombre, idMenu) values ('nuevo', '".$_POST['menu']."')");
     $result = $obj->consulta("select idGaleria from galeria_menus where nombre='nuevo'");
     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $id=$fila->idGaleria;
     }
     $jsondata = array();
 $jsondata["new"] = $id;
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
function SubirImagen(){
  if ($_FILES['imgGaleria']['size'] != 0){
	$target_path = "../uploads/menus/";
$target_path = $target_path . $_POST['id'].'.'.pathinfo($_FILES['imgGaleria']['name'], PATHINFO_EXTENSION); 
move_uploaded_file($_FILES['imgGaleria']['tmp_name'], 
    $target_path); 
include "../base.php";
$obj=new Base($DB_server,$DB_user,$DB_name);
$obj->consulta("update galeria_menus set nombre='".$_POST['id'].'.'.pathinfo($_FILES['imgGaleria']['name'], PATHINFO_EXTENSION)."' where idGaleria=".$_POST['id']);

   }
}

function cambiarImagen(){
  if ($_FILES['imgGaleria']['size'] != 0){
include "../base.php";
include "../host2.php";
$obj=new Base($DB_server,$DB_user,$DB_name);
     $result = $obj->consulta("select idGaleria from galeria_menus where nombre='".$_POST['id']."'");
     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $id=$fila->idGaleria;
     }

        $target_path = "../uploads/menus/";
$target_path = $target_path . $id.'.'.pathinfo($_FILES['imgGaleria']['name'], PATHINFO_EXTENSION);
move_uploaded_file($_FILES['imgGaleria']['tmp_name'],
    $target_path);
$obj->consulta("update galeria_menus set nombre='".$id.".".pathinfo($_FILES['imgGaleria']['name'], PATHINFO_EXTENSION)."' where idGaleria=".$id);

   }
}


?>
