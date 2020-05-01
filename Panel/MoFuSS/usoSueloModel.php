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
	
}

function Modificar()
{

	$id=$_POST['id'];
include "../base.php";
$obj=new Base("localhost","root","global");
$obj->consulta("update usoSuelo set categoria=".$_POST['categoria'].", idPais=".$_POST['pais'].", descripcion='".$_POST['descripcion']."' where idUsoSuelo=".$id);
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
$obj=new Base("localhost","root","global");
$obj->consulta("delete from usoSuelo where idUsoSuelo=".$id);

 $jsondata = array();
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
function Agregar()
{

include "../base.php";
$obj=new Base("localhost","root","global");
$obj->consulta("insert into usoSuelo (categoria, idPais, descripcion) values (".$_POST['categoria'].", ".$_POST['pais'].", '".$_POST['descripcion']."')");

$result=$obj->consulta("select idUsoSuelo from usoSuelo where categoria=".$_POST['categoria']." and descripcion='".$_POST['descripcion']."' and idPais=".$_POST['pais']);

     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $alcanceId=$fila->idUsoSuelo;
     }
 $jsondata = array();
 $jsondata["new"] = $alcanceId;
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
  ?>

