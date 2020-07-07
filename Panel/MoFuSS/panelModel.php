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
$obj=new Base($DB_server,$DB_user,$DB_name);
$result=$obj->consulta("select prioridad from panel where idPanel=".$id);
     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $prioridadOld=intval($fila->prioridad);
     }

$result=$obj->consulta("select idPanel,prioridad from panel order by prioridad DESC");

     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $prioridad=intval($fila->prioridad)+1;
	$maxID=$fila->idPanel;
     }
if($prioridad>$prioridadOld && $val==1 && $maxID!=$id ){
$result=$obj->consulta("select idPanel,prioridad from panel where prioridad>".$prioridadOld." order by prioridad ASC");
     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $prioridadNext=intval($fila->prioridad);
	$idNext=$fila->idPanel;
     }
$obj->consulta("update panel set prioridad=".intval($prioridadNext)." where idPanel=".$id);
$obj->consulta("update panel set prioridad=".intval($prioridadOld)." where idPanel=".$idNext);
}
if($prioridadOld>0 && $val==-1){
$result=$obj->consulta("select idPanel,prioridad from panel where prioridad<".$prioridadOld." order by prioridad DESC");
     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $prioridadBefore=intval($fila->prioridad);
        $idBefore=$fila->idPanel;
     }
$obj->consulta("update panel set prioridad=".intval($prioridadBefore)." where idPanel=".$id);
$obj->consulta("update panel set prioridad=".intval($prioridadOld)." where idPanel=".$idBefore);

}
$result=$obj->consulta("select prioridad from panel where idPanel=".$id);
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
include "../base.php";
include "../host2.php";
$obj=new Base($DB_server,$DB_user,$DB_name);
$obj->consulta("update panel set nombre='".$_POST['nombre']."', submenu='".$_POST['submenu']."', icono='".$_POST['icono']."', funcion='".$_POST['funcion']."', descripcion='".$_POST['descripcion']."' where idPanel=".$id);
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
include "../host2.php";
$obj=new Base($DB_server,$DB_user,$DB_name);
 $result=$obj->consulta("select prioridad from panel where idPanel= ".$id);
     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $prioridad=intval($fila->prioridad);
     }
$obj->consulta("update panel set prioridad=prioridad-1 where prioridad>".$prioridad);
$obj->consulta("delete from panel where idPanel=".$id);

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
$result=$obj->consulta("select prioridad from panel order by prioridad DESC limit 1");
     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $prioridad=intval($fila->prioridad)+1;
     }
$obj->consulta("insert into panel (nombre, submenu, icono,funcion, descripcion, prioridad) values ('".$_POST['nombre']."', '".$_POST['submenu']."', '".$_POST['icono']."', '".$_POST['funcion']."', '".$_POST['descripcion']."', '".$prioridad."')");

$result=$obj->consulta("select idPanel from panel where nombre='".$_POST['nombre']."' and icono='".$_POST['icono']."' and descripcion='".$_POST['descripcion']."' and prioridad='".$prioridad."'  and funcion='".$_POST['funcion']."'");

     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $alcanceId=$fila->idPanel;
     }
 $jsondata = array();
 $jsondata["new"] = $alcanceId;
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
  ?>

