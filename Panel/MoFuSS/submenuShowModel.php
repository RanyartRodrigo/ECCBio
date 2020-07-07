  <?php
include "../base.php";
include '../host2.php';
$obj=new Base($DB_server,$DB_user,$DB_name);
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
}
function Modificar($obj)
{
	  
	$id=$_POST['id'];
$flag=preg_match('\d',$id);
if(count($flag)>0){
$result=$obj->consulta("select count(*) as x from submenus where submenu='".$_POST['submenu']."' and pais=".$_POST['pais']);
        $fila = $result->fetch_object();
if($fila->x==0)
$obj->consulta("update submenus set submenu='".$_POST['submenu']."', pais=".$_POST['pais']." where id=".$id);
     
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

$obj->consulta("delete from submenus where id=".$id);
     
 $jsondata = array();
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}}
function Agregar($obj)
{
	  
$result=$obj->consulta("select count(*) as x from submenus where submenu='".$_POST['submenu']."' and pais=".$_POST['pais']);
        $fila = $result->fetch_object();
if($fila->x==0)
$obj->consulta("insert into submenus (submenu,pais) values ('".$_POST['submenu']."', ".$_POST['pais'].")");
$result=$obj->consulta("select id from submenus where submenu='".$_POST['submenu']."' and pais=".$_POST['pais']);
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

  ?>

