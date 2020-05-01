  <?php


include "../base.php";
$obj=new Base("localhost","root","conabio");
switch ($_POST['opcion']) {
	case 0:
		Eliminar($obj);
		break;
	case 1:
		if(!strcmp($_POST['id'],""))
			Agregar($obj);
		else
			Modificar($obj);
		break;
    case 2:
    SubirImagen();
    break;
	
}
function Modificar($obj)
{
	  
	$id=$_POST['id'];
$flag=preg_match('\d',$id);
if(count($flag)>0){
$obj->consulta("update migracion set modelo='".$_POST['modelo']."', anio=".$_POST['anio'].",  colors='".$_POST['colores']."' where id=".$id);
     
 $jsondata = array();
 $jsondata["success"] = true;
  $jsondata["new"] = $id;
    $jsondata["data"]["message"] ="Se han encontrado %d usuarios ";
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}}

function Eliminar($obj)
{
	  
	$id=$_POST['id'];
$flag=preg_match('\d',$id);
if(count($flag)>0){
$obj->consulta("delete from migracion where id=".$id);
     
 $jsondata = array();
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}}
function Agregar($obj)
{
$obj->consulta("insert into migracion (modelo, anio,colors) values ('".$_POST['modelo']."', ".$_POST['anio'].", '".$_POST['colores']."')");
     
$result=$obj->consulta("select id from migracion where modelo='".$_POST['modelo']."' and anio=".$_POST['anio']);
     
     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $alcanceId=$fila->id;
     }
 $jsondata = array();
 $jsondata["new"] = $alcanceId;
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
function SubirImagen($obj){
       if ($_FILES['img']['size'] != 0){
  $target_path = "../uploads/csv/";
$target_path = $target_path . $_POST['modelo'].'-'.$_POST['anio'].'.'.pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION); 
move_uploaded_file($_FILES['img']['tmp_name'], 
    $target_path); 
//$obj->consulta("update migracion set ='".$_POST['id'].'.'.pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION)."' where id=".$_POST['id']);   
   }
}

  ?>
