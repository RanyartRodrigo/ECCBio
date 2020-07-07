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
	
	case 2: Relaciones();
		break;
	
}
function Relaciones(){
	
include "../base.php";
include "../host2.php";
$obj=new Base($DB_server,$DB_user,$DB_name);
$pais=$_POST["pais"];
$relaciones=explode("|",$_POST["relaciones"]);
                $obj->consulta("delete from relaciones where pais=".$pais);

for($x=1;$x<count($relaciones);$x++){
	$r=explode(",",$relaciones[$x]);
        if($r[0]!="Start"){
$result=$obj->consulta("select id from diagrama where nombre='".$r[0]."'");
     for ($x1=0;$x1<1;$x1++) {
        $fila = $result->fetch_object();
        $padre=$fila->id;
     }
}
else $padre=0;
$result=$obj->consulta("select id from diagrama where nombre='".$r[1]."'");
     for ($x1=0;$x1<1;$x1++) {
        $fila = $result->fetch_object();
        $hijo=$fila->id;
     }
		$obj->consulta("insert into relaciones (padre,hijo, pais) values(".$padre.",".$hijo.",".$pais.")");
	
}
}
function Modificar()
{

	$id=$_POST['id'];
include "../base.php";
include "../host2.php";
$obj=new Base($DB_server,$DB_user,$DB_name);
//$relacion=split(",",$_POST['relaciones']);
$obj->consulta("update diagrama set operacion='".$_POST['operacion']."', pais=".$_POST['pais'].", tipo='".$_POST['tipo']."', descripcion='".$_POST['descripcion']."', nombre='".$_POST['nombre']."',idRelacion=0 where id=".$id);
//$result=$obj->consulta("delete from relaciones where base=".$id );
//for($x=0;$x<(count($relacion)-1);$x++){
//$result=$obj->consulta("select base from relaciones where base=".$id." and direccion=".$relacion[$x] );
//if($result->num_rows==0)
//$obj->consulta("insert into relaciones (base,direccion) values (".$id.",".$relacion[$x].")");
//}

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
$obj->consulta("delete from diagrama where id=".$id);

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
//if($_POST['idRelacion']=='null')
        $relacion=0;
//else
// $relacion=$_POST['idRelacion'];
$obj->consulta("insert into diagrama (nombre,tipo, operacion, pais, descripcion, idRelacion) values ('".$_POST['nombre']."','".$_POST['tipo']."', '".$_POST['operacion']."',".$_POST['pais'].", '".$_POST['descripcion']."',  ".$relacion.")");

$result=$obj->consulta("select id from diagrama where nombre='".$_POST['nombre']."' and pais=".$_POST['pais']." and tipo='".$_POST['tipo']."' and  operacion='".$_POST['operacion']."' and descripcion='".$_POST['descripcion']."'  and idRelacion=".$relacion."");

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

