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
    SubirImagen();
    break;
	
}
function Modificar()
{

	$id=$_POST['id'];
include "../base.php";
include "../host2.php";
$obj=new Base($DB_server,$DB_user,$DB_name);
$obj->consulta("update paises set usoSuelo='".$_POST['usoSuelo']."', nombre='".$_POST['nombre']."', nombreURL='".$_POST['nombreURL']."', latitud='".$_POST['latitud']."', zoom='".$_POST['zoom']."', maxZoom='".$_POST['maxZoom']."', longitud='".$_POST['longitud']."', informacion='".str_replace("'",'"',$_POST['informacion'])."' where id_Pais=".$id);
 $jsondata = array();
 $jsondata["success"] = true;
   $jsondata["new"] = $id;
    $jsondata["data"]["message"] ="Se han encontrado %d usuarios ";
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}

function Eliminar()
{

	$id=$_POST['id'];
include "../base.php";
$obj=new Base($DB_server,$DB_user,$DB_name);
$obj->consulta("delete from paises where id_Pais=".$id);

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
$obj->consulta("insert into paises (usoSuelo,nombre, nombreURL,latitud, longitud, informacion, zoom, maxZoom) values ( '".$_POST['usoSuelo']."', '".$_POST['nombre']."', '".$_POST['nombreURL']."', '".$_POST['latitud']."', '".$_POST['longitud']."', '".str_replace("'",'"',$_POST['informacion'])."', '".$_POST['zoom']."', '".$_POST['maxZoom']."')");

$result=$obj->consulta("select id_Pais from paises where usoSuelo='".$_POST['usoSuelo']."' and nombre='".$_POST['nombre']."' and nombreURL='".$_POST['nombreURL']."' and informacion='".$_POST['informacion']."'");

     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $alcanceId=$fila->id_Pais;
     }
 $jsondata = array();
 $jsondata["new"] = $alcanceId;
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
function SubirImagen(){
       if ($_FILES['imgBandera']['size'] != 0){
  $target_path = "../uploads/paises/";
$target_path = $target_path . $_POST['id'].'.'.pathinfo($_FILES['imgBandera']['name'], PATHINFO_EXTENSION); 
move_uploaded_file($_FILES['imgBandera']['tmp_name'], 
    $target_path); 
     include "../base.php";
     include "../host2.php";
$obj=new Base($DB_server,$DB_user,$DB_name);
$obj->consulta("update paises set bandera='".$_POST['id'].'.'.pathinfo($_FILES['imgBandera']['name'], PATHINFO_EXTENSION)."' where id_Pais=".$_POST['id']);

   }
}
  ?>
