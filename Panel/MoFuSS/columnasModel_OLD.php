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
		Duplicar();
		break;
}
function Modificar()
{

	$id=$_POST['id'];
include "../base.php";
$obj=new Base("localhost","root","global");
$estilos=str_replace("'","\'",$_POST['estilos']);
$obj->consulta("update columnas set columna='".$_POST['columna']."', valorFiltro='".$_POST['valorFiltro']."', estilos='".$estilos."' , titulo='".$_POST['titulo']."' where idColumna=".$id);
 $jsondata = array();
 $jsondata["success"] = true;
   $jsondata["new"] = $id;
    $jsondata["data"]["message"] ="Se han encontrado %d usuarios ";
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}

function Duplicar()
{

	$id=$_POST['id'];
include "../base.php";
$obj=new Base("localhost","root","global");
$result=$obj->consulta("select * from columnas where idColumna=".$id);
$fila = $result->fetch_object();
$obj->consulta('insert into columnas (columna, valorFiltro, estilos, titulo) values ("'.$fila->columna.'", "'.$fila->valorFiltro.'", "'.$fila->estilos.'", "'.$fila->titulo.' 2")');
$result2=$obj->consulta('select idColumna from columnas where columna="'.$fila->columna.'" and valorFiltro="'.$fila->valorFiltro.'" and estilos="'.$fila->estilos.'" and titulo="'.$fila->titulo.' 2"');
        $fila2 = $result2->fetch_object();
        $alcanceId=$fila2->idColumna;
 $jsondata = array();
 $jsondata["new"] = $alcanceId;
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
function Eliminar()
{

        $id=$_POST['id'];
include "../base.php";
$obj=new Base("localhost","root","global");
$obj->consulta("delete from columnas where idColumna=".$id);

 $jsondata = array();
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
function Agregar()
{

include "../base.php";
$obj=new Base("localhost","root","global");
$estilos=str_replace("'","\'",$_POST['estilos']);
$obj->consulta("insert into columnas (columna, valorFiltro, estilos, titulo) values ('".$_POST['columna']."', '".$_POST['valorFiltro']."', '".$estilos."', '".$_POST['titulo']."')");
$result=$obj->consulta("select idColumna from columnas where columna='".$_POST['columna']."' and valorFiltro='".$_POST['valorFiltro']."'");

     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $alcanceId=$fila->idColumna;
     }
 $jsondata = array();
 $jsondata["new"] = $alcanceId;
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
  ?>
