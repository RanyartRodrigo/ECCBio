  <?php
include "../base.php";
include "../host2.php";
$obj=new Base($DB_server,$DB_user,"cemie");
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
    SubirImagen($obj);
    break;
    case 3:
    Duplicar($obj);
    break;
    case 4:
    Prioridad($obj);
    break;
    case 5:
    AgregarColor($obj);
    break;
    case 6:
    EliminarColor($obj);
    break;


	
}
function AgregarColor($obj){
        $id=$_POST['id'];

$result=$obj->consulta("select * from submenusEstilo where nombre='".$_POST['id']."'");
$fila = $result->fetch_object();
$numfilas = $result->num_rows;
if($numfilas==0)
$obj->consulta('insert into submenusEstilo (nombre,color) values ("'.$_POST['id'].'","'.$_POST['color'].'")');
else
$obj->consulta('update submenusEstilo set nombre="'.$_POST['id'].'", color="'.$_POST['color'].'" where nombre="'.$_POST['id'].'"');
$alcanceId=$_POST['id'];
 $jsondata = array();
 $jsondata["new"] = $alcanceId;
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);

}
function EliminarColor($obj){
}

function Duplicar($obj)
{

        $id=$_POST['id'];

$result=$obj->consulta("select * from menus where id_Capa=".$id);
$fila = $result->fetch_object();
$obj->consulta('insert into menus (parent,nombre,grupo,tipo, unidad, escalaLog, subMenu, latitud,longitud, id_Pais, descripcion,nombreEE, nombreEE2, id_Columna, zoom) values ("'.$fila->parent.'","'.$fila->nombre.' 2","'.$fila->grupo.'","'.$fila->tipo.'", "'.$fila->unidad.'", '.$fila->escalaLog.',"'.$fila->subMenu.'","'.$fila->latitud.'","'.$fila->longitud.'", '.$fila->id_Pais.', "'.$fila->descripcion.'","'.$fila->nombreEE.'", "'.$fila->nombreEE2.'", '.$fila->id_Columna.', '.$fila->zoom.')');
$result2=$obj->consulta("select id_Capa from menus where parent='".$fila->parent."' and nombre='".$fila->nombre." 2' and escalaLog=".$fila->escalaLog." and tipo='".$fila->tipo."' and  unidad='".$fila->unidad."' and grupo='".$fila->grupo."' and latitud='".$fila->latitud."' and descripcion='".$fila->descripcion."' and nombreEE='".$fila->nombreEE."' and id_Columna=".$fila->id_Columna." and zoom='".$fila->zoom."'");
        $fila2 = $result2->fetch_object();
        $alcanceId=$fila2->id_Capa;
 $jsondata = array();
 $jsondata["new"] = $alcanceId;
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}

function Modificar($obj)
{

	$id=$_POST['id'];

if($_POST['id_Columna']=='null')
	$columna="NULL";
else
 $columna=$_POST['id_Columna'];
$obj->consulta("update menus set  sub='".$_POST['sub']."',parent='".$_POST['parent']."',  unidad='".$_POST['unidad']."', escalaLog=".$_POST['log'].", tipo='".$_POST['tipo']."',  grupo='".$_POST['grupo']."', nombre='".$_POST['nombre']."', subMenu='".$_POST['subMenu']."', latitud='".$_POST['latitud']."', longitud='".$_POST['longitud']."', id_Pais='".$_POST['id_Pais']."', descripcion='".$_POST['descripcion']."', nombreEE='".$_POST['nombreEE']."', nombreEE2='".$_POST['nombreEE2']."', id_Columna=".$columna.", zoom='".$_POST['zoom']."' where id_Capa=".$id);
 $jsondata = array();
 $jsondata["success"] = true;
   $jsondata["new"] = $id;
    $jsondata["data"]["message"] ="Se han encontrado %d usuarios ";
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}

function Eliminar($obj)
{

	$id=$_POST['id'];

$obj->consulta("delete from menus where id_Capa=".$id);

 $jsondata = array();
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
function Agregar($obj)
{


if($_POST['id_Columna']=='null')
        $columna="NULL";
else
 $columna=$_POST['id_Columna'];
if($_POST['color1']=='null')
        $c1=NULL;
else
 $c1=$_POST['color1'];
if($_POST['color2']=='null')
        $c2=NULL;
else
 $c2=$_POST['color2'];
if($_POST['color3']=='null')
        $c3=NULL;
else
 $c3=$_POST['color3'];
$obj->consulta("insert into menus (sub,parent, nombre,grupo,tipo, unidad, escalaLog, subMenu, latitud,longitud, id_Pais, descripcion,nombreEE, nombreEE2, id_Columna, zoom) values ('".$_POST['sub']."','".$_POST['parent']."', '".$_POST['nombre']."', '".$_POST['grupo']."','".$_POST['tipo']."', '".$_POST['unidad']."',".$_POST['log'].",  '".$_POST['subMenu']."', '".$_POST['latitud']."', '".$_POST['longitud']."', '".$_POST['id_Pais']."', '".$_POST['descripcion']."', '".$_POST['nombreEE']."',  '".$_POST['nombreEE2']."', ".$columna.", '".$_POST['zoom']."')");

$result=$obj->consulta("select id_Capa from menus where  parent='".$_POST['parent']."' and  nombre='".$_POST['nombre']."' and escalaLog=".$_POST['log']." and tipo='".$_POST['tipo']."' and  unidad='".$_POST['unidad']."' and grupo='".$_POST['grupo']."' and latitud='".$_POST['latitud']."' and descripcion='".$_POST['descripcion']."' and nombreEE='".$_POST['nombreEE']."' and id_Columna=".$columna." and zoom='".$_POST['zoom']."'");

     for ($x=0;$x<1;$x++) {
        $fila = $result->fetch_object();
        $alcanceId=$fila->id_Capa;
     }
 $jsondata = array();
 $jsondata["new"] = $alcanceId;
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
}
function SubirImagen($obj){
       if ($_FILES['img']['size'] != 0){
  $target_path = "../uploads/menus/";
$target_path = $target_path . $_POST['id'].'.'.pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION); 
move_uploaded_file($_FILES['img']['tmp_name'], 
    $target_path); 

$obj->consulta("update menus set img='".$_POST['id'].'.'.pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION)."' where id=".$_POST['id']);

   }
}
function Prioridad($obj){
	$id_Capa=intval($_POST['id']);
	$val=intval($_POST['valor']);

	$subMenu='';	
	$result=$obj->consulta("select prioridad, subMenu from menus where id_Capa=".$id_Capa." and id_Pais=".$_POST['pais']);
	for ($x=0;$x<1;$x++) {
        	$fila = $result->fetch_object();
        	$prioridadOld=intval($fila->prioridad);
        	$subMenu=$fila->subMenu;
     	}
	$result=$obj->consulta("select prioridad from menus where id_Pais=".$_POST['pais']." order by prioridad DESC");
	$fila = $result->fetch_object();
        $MAX=intval($fila->prioridad);
	$result=$obj->consulta("select prioridad from menus where id_Pais=".$_POST['pais']." order by prioridad ASC");
	$fila = $result->fetch_object();
        $MIN=intval($fila->prioridad);
	if(true){
		if($val==1 && $prioridadOld<$MAX){
			$result=$obj->consulta("select subMenu, id_Capa,prioridad from menus where prioridad > ".$prioridadOld." and id_Pais=".$_POST['pais']." order by prioridad ASC");
     			
        			$fila = $result->fetch_object();
	        		$prioridadNext=intval($fila->prioridad);
        			$idNext=$fila->id_Capa;
        			$subNext=$fila->subMenu;
     			
     		/*	$where=($subMenu=='')?"id_Capa=".$id_Capa:"subMenu='".$subMenu."'";
			$obj->consulta("update menus set prioridad=".intval($prioridadNext)." where ".$where." and id_Pais=".$_POST['pais']);
		
			$where=($subNext=='')?"id_Capa=".$idNext:"subMenu='".$subNext."'";
			$obj->consulta("update menus set prioridad=".intval($prioridadOld)." where ".$where." and id_Pais=".$_POST['pais']);
		*/
                        $where="id_Capa=".$id_Capa;
                        $obj->consulta("update menus set prioridad=".intval($prioridadNext)." where ".$where." and id_Pais=".$_POST['pais']);

                        $where="id_Capa=".$idNext;
                        $obj->consulta("update menus set prioridad=".intval($prioridadOld)." where ".$where." and id_Pais=".$_POST['pais']);
              

		}
		else if($val==-1 && $prioridadOld>$MIN){
			$result=$obj->consulta("select subMenu, id_Capa,prioridad from menus where prioridad<".$prioridadOld." and id_Pais=".$_POST['pais']." order by prioridad DESC");
	         
        	                $fila = $result->fetch_object();
                	        $prioridadBefore=intval($fila->prioridad);
                        	$idBefore=$fila->id_Capa;
                        	$subBefore=$fila->subMenu;
                	
/*                        $where=($subMenu=='')?"id_Capa=".$id_Capa:"subMenu='".$subMenu."'";
                        $obj->consulta("update menus set prioridad=".intval($prioridadBefore)." where ".$where." and id_Pais=".$_POST['pais']);

                        $where=($subBefore=='')?"id_Capa=".$idBefore:"subMenu='".$subBefore."'";
                        $obj->consulta("update menus set prioridad=".intval($prioridadOld)." where ".$where." and id_Pais=".$_POST['pais']);
*/
                        $where="id_Capa=".$id_Capa;
                        $obj->consulta("update menus set prioridad=".intval($prioridadBefore)." where ".$where." and id_Pais=".$_POST['pais']);

                        $where="id_Capa=".$idBefore;
                        $obj->consulta("update menus set prioridad=".intval($prioridadOld)." where ".$where." and id_Pais=".$_POST['pais']);

		}

	}
                $where="id_Capa=".$id_Capa;
                //$where=($subMenu=='')?"id_Capa=".$id_Capa:"subMenu='".$subMenu."'";
                //$obj->consulta("update menus set prioridad=".(intval($prioridadOld)+1)." where ".$where." and id_Pais=".$_POST['pais']);	
	$result=$obj->consulta("select prioridad from menus where id_Capa=".$id_Capa." and id_Pais=".$_POST['pais']);
    	for ($x=0;$x<1;$x++) {
       		$fila = $result->fetch_object();
       		$prioridadNew=intval($fila->prioridad);
    	}
 	$jsondata = array();
 	$jsondata["newo"] = $prioridadNew;
                $jsondata["prioridadOld"] =$prioridadOld;
                $jsondata["subMenu"] =$subMenu;
                $jsondata["prioridad"] =$prioridad;
                $jsondata["max"] =$MAX;
                $jsondata["min"] =$MIN;
                $jsondata["hola"] =$hola;
               $jsondata["subMax"] =$subMax;
 			$jsondata["prioridadNext"] =$prioridadNext;
                        $jsondata["idNext"] =$idNext;
                        $jsondata["subNext"] =$subNext;

 	$jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  	echo json_encode($jsondata, JSON_FORCE_OBJECT);

}

  ?>

