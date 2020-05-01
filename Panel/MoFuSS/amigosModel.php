  <?php


include "../base.php";
$obj=new Base("localhost","root","global");
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


$obj->consulta("update amigos set titulo='".$_POST['titulo']."', url='".$_POST['url']."' where id=".$id);
     
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
$obj->consulta("delete from amigos where id=".$id);
     
 $jsondata = array();
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}}
function Agregar($obj)
{
$obj->consulta("insert into amigos (titulo, url) values ('".$_POST['titulo']."', '".$_POST['url']."')");
     
$result=$obj->consulta("select id from amigos where titulo='".$_POST['titulo']."' and url='".$_POST['url']."'");
     
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
  $target_path = "../uploads/amigos/";
$target_path = $target_path . $_POST['id'].'.'.pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION); 
move_uploaded_file($_FILES['img']['tmp_name'], 
    $target_path); 
$obj->consulta("update amigos set img='".$_POST['id'].'.'.pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION)."' where id=".$_POST['id']);
     
   }
}

  ?>
