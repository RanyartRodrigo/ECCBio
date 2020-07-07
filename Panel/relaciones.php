<?php  
	include "base.php";
	include "host2.php";
	$base=new Base($DB_server,$DB_user,$DB_name);
	if($_GET['opcion']==0)
		$res=getRelacion($base);
        if($_GET['opcion']==1)
                $res=getOperacion($base);
        if($_GET['opcion']==2)
                $res=getDescripcion($base);
        if($_GET['opcion']==3)
                $res=getOptions($base);
	if(isset($_GET['callback'])){ // Si es una petición cross-domain  
		echo $_GET['callback'].'('.json_encode($res).')';
	}
	else{ // Si es una normal, respondemos de forma normal  
 		 echo json_encode($res);
	}
function getRelacion($base){
	$pais=$_GET['pais'];
	$padre=$_GET['padre'];
	$result =$base->consulta("select id_Pais from paises where nombreURL='".$pais."'");
	$fila = $result->fetch_object();
	$idPais=$fila->id_Pais;
	if($padre=="Start")
		$idPadre=0;
	else{
		$result =$base->consulta("select id from diagrama where nombre='".$padre."'");
		$fila = $result->fetch_object();
		$idPadre=$fila->id;
	}
	$result =$base->consulta("select hijo as id, nombre, tipo, descripcion from relaciones left join diagrama on relaciones.hijo=diagrama.id where relaciones.pais=".$idPais." and padre=".$idPadre);
	$numfilas = $result->num_rows;		             
	$hijos= "";
 	for ($x=0;$x<$numfilas;$x++) {
		$fila = $result->fetch_object();
		$hijos.=",".$fila->tipo."|".$fila->nombre; 
	}
	return $hijos;
}
function getOperacion($base){
        $padre=$_GET['padre'];
        if($padre=="Start")
                $operacion="valor";
        else{
                $result =$base->consulta("select operacion from diagrama where nombre='".$padre."'");
                $fila = $result->fetch_object();
                $operacion=$fila->operacion;
        }
        return $operacion;

}
function getDescripcion($base){
        include "host.php";
        $padre=$_GET['padre'];
        if($padre=="Start")
                $operacion="valor";
        else{
                $result =$base->consulta("select descripcion, id, operacion, nombre from diagrama where nombre='".$padre."'");
                $fila = $result->fetch_object();
                $operacion1="<h4>".$fila->nombre."</h4><span>".$fila->operacion."</span><p>".$fila->descripcion."</p>";
		$result =$base->consulta("select nombre from galeria_diagramas where idDiagrama=".$fila->id);
		$numfilas = $result->num_rows;
	        $img= "";
        	for ($x=0;$x<$numfilas;$x++) {
                	$fila = $result->fetch_object();
                	$img.="<img src='".$host."uploads/diagramas/".$fila->nombre."'>";
        	}
		$operacion=$img.$operacion1;

        }
        return $operacion;

}
function getOptions($base){
        $padre=$_GET['padre'];
        if($padre=="Start")
                $options="";
        else{
                $result =$base->consulta("select operacion from diagrama where nombre='".$padre."'");
		$fila = $result->fetch_object();
                $options=$fila->operacion;
        }
        return $options;

}


?>
