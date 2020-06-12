<?php  
$array = array("mensaje" => "<button>".$_GET["q"]."</button>"); //Por ejemplo
if(isset($_GET['callback'])){ // Si es una petición cross-domain  
	include "base.php";
	include "host2.php"
	$base=new Base("localhost",$DB_user,$DB_name);
                		$result =$base->consulta("SELECT * FROM paises");
		                $numfilas = $result->num_rows;
		                $paises="";
		                  for ($x=0;$x<$numfilas;$x++) {
		                  	$fila = $result->fetch_object();
		                  	$paises.= '<li onclick="MapOf(\''.$fila->tituloCorto.'\')" id="'.$fila->tituloCorto.'">'.$fila->titulo.'</li>';
		               	}

  echo $_GET['callback'].'('.json_encode($paises).')';
}
else{ // Si es una normal, respondemos de forma normal  

	include "base.php";
	include "host2.php";
	$base=new Base("localhost",$DB_user,$DB_name);
                		$result =$base->consulta("SELECT * FROM paises");
		                $numfilas = $result->num_rows;
		                $paises="";
		                  for ($x=0;$x<$numfilas;$x++) {
		                  	$fila = $result->fetch_object();
		                  	$paises.= '<li onclick="MapOf(\''.$fila->tituloCorto.'\')" id="'.$fila->tituloCorto.'">'.$fila->titulo.'</li>';
		               	}


  echo json_encode($paises);



}
?>
