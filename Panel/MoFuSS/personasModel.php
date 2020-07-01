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
    case 4:
           Prioridad();
	   break;
}
function Prioridad()
{

        $id=intval($_POST['id']);
 $val=intval($_POST['valor']);
include "../base.php";
include "../host2.php";
$obj=new Base("localhost",$DB_user,$DB_name);
$result=$obj->consulta("select prioridad from personas where id=".$id);
     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $prioridadOld=intval($fila->prioridad);
     }

$result=$obj->consulta("select id,prioridad from personas order by prioridad DESC");

     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $prioridad=intval($fila->prioridad)+1;
	$maxID=$fila->id;
     }
if($prioridad>$prioridadOld && $val==1 && $maxID!=$id ){
$result=$obj->consulta("select id,prioridad from personas where prioridad>".$prioridadOld." order by prioridad ASC");
     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $prioridadNext=intval($fila->prioridad);
	$idNext=$fila->id;
     }
$obj->consulta("update personas set prioridad=".intval($prioridadNext)." where id=".$id);
$obj->consulta("update personas set prioridad=".intval($prioridadOld)." where id=".$idNext);
}
if($prioridadOld>0 && $val==-1){
$result=$obj->consulta("select id,prioridad from personas where prioridad<".$prioridadOld." order by prioridad DESC");
     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $prioridadBefore=intval($fila->prioridad);
        $idBefore=$fila->id;
     }
$obj->consulta("update personas set prioridad=".intval($prioridadBefore)." where id=".$id);
$obj->consulta("update personas set prioridad=".intval($prioridadOld)." where id=".$idBefore);

}
$result=$obj->consulta("select prioridad from personas where id=".$id);
     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $prioridadNew=intval($fila->prioridad);
     }

 $jsondata = array();
 $jsondata["newo"] = $prioridadNew;
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
function Modificar()
{

	$id=$_POST['id'];
$flag=preg_match('\d',$id);
if(count($flag)>0){

include "../base.php";
include "../host2.php";
$obj=new Base("localhost",$DB_user,$DB_name);
if($_POST['graduado']=="true")
$graduado=1;
else
$graduado=0;

$obj->consulta("update personas set graduado=".$graduado.", nombre='".$_POST['nombre']."', tipo='".$_POST['tipo']."', apellido='".$_POST['apellido']."', locacion='".$_POST['locacion']."', contacto='".$_POST['contacto']."', descripcion='".$_POST['descripcion']."' where id=".$id."");
 $jsondata = array();
 $jsondata["success"] = true;
   $jsondata["new"] = $id;
    $jsondata["data"]["message"] ="Se han encontrado %d usuarios ";
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
}
function Eliminar()
{

	$id=$_POST['id'];
$flag=preg_match('\d',$id);
if(count($flag)>0){

include "../base.php";
include "../host2.php";
$obj=new Base("localhost",$DB_user,$DB_name);
 $result=$obj->consulta("select prioridad from personas where id= ".$id);
     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $prioridad=intval($fila->prioridad);
     }
$obj->consulta("update personas set prioridad=prioridad-1 where prioridad>".$prioridad);
$obj->consulta("delete from personas where id=".$id);

 $jsondata = array();
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
}
function Agregar()
{

include "../base.php";
include "../host2.php";
$obj=new Base("localhost",$DB_user,$DB_name);
if($_POST['graduado']=="true")
$graduado=1;
else
$graduado=0;
$result=$obj->consulta("select prioridad from personas order by prioridad DESC limit 1");
     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $prioridad=intval($fila->prioridad)+1;
     }

$obj->consulta("insert into personas (nombre, apellido,locacion, contacto,tipo, descripcion,graduado,prioridad) values ('".$_POST['nombre']."', '".$_POST['apellido']."', '".$_POST['locacion']."', '".$_POST['contacto']."',  '".$_POST['tipo']."', '".$_POST['descripcion']."', ".$graduado.", '".$prioridad."')");

$result=$obj->consulta("select id from personas where nombre='".$_POST['nombre']."' and apellido='".$_POST['apellido']."' and descripcion='".$_POST['descripcion']."'");

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
function SubirImagen(){
       if ($_FILES['img']['size'] != 0){
  $target_path = "../uploads/personas/";
$target_path = $target_path . $_POST['id'].'.'.pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION); 
move_uploaded_file($_FILES['img']['tmp_name'], 
    $target_path); 
     include "../base.php";
     include "../host2.php";
$obj=new Base("localhost",$DB_user,$DB_name);
$obj->consulta("update personas set img='".$_POST['id'].'.'.pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION)."' where id=".$_POST['id']);

   }
}
  ?>
