<?php  
	include "base.php";
$base=new Base("localhost","root","global");
if($_GET['t']=="img")
                                $paises=img($base);
else
		                $paises=paises2($base);

		              if(isset($_GET['callback'])){ // Si es una petición cross-domain  
					  echo $_GET['callback'].'('.json_encode($paises).')';
						}
					else{ // Si es una normal, respondemos de forma normal  
 					 echo json_encode($paises);
				}
function img($base){
        include "host.php";
$img="";
$result =$base->consulta("SELECT * from galeria_menus where idMenu=".$_GET["seleccionado"]);
                                $numfilas = $result->num_rows;
 for ($x=0;$x<$numfilas;$x++) {
                                        $fila = $result->fetch_object();
                                        $img.= "<img src='".$host."uploads/menus/".$fila->nombre."'>";
                                        }

return $img."<script>
$('.minigaleria>img').on('click', function(){
var img=$(this).attr('src');
$('body').append('<div class=\'imgCoverBig\'><img src=\''+img+'\'/><button onClick=\'removeImgCover()\'>X</button></div>');
});
function removeImgCover(){
        $('.imgCoverBig').remove();
}

</script>";
}
function paises2($base){
$seleccionado=str_replace(", ","' or menus.id_Capa='",str_replace("capa","",$_GET["seleccionado"]));
$result =$base->consulta("SELECT menus.id_Capa as id, menus.latitud as latitud, menus.longitud as longitud, menus.zoom as zoom, menus.descripcion as descripcion, menus.nombre as nombre, paises.nombre as id_Pais, columnas.estilos as estilos FROM menus left join columnas on columnas.idColumna=menus.id_Columna left join paises on paises.id_Pais=menus.id_Pais where menus.id_Capa='".$seleccionado."'");
		                $numfilas = $result->num_rows;
		             
$paises.= "";
 for ($x=0;$x<$numfilas;$x++) {
		                  	$fila = $result->fetch_object();
		                  	$paises.= "<table><thead></thead><tbody><tr><th>ATTRIBUTE</th><th>VALUE</th></tr>
						<tr><td>NAME:</td><td>".$fila->nombre."</td></tr>
						<tr><td>LATITUDE:</td><td>".$fila->latitud."</td></tr>
						<tr><td>LONGITUDE:</td><td>".$fila->longitud."</td></tr>
						<tr><td>DESCRIPTION:</td><td>".$fila->descripcion."</td></tr>
						<tr><td>COUNTRY:</th><td>".$fila->id_Pais."</td></tr>
						<tr><td>COLOR SCALE:</th><td class='colores_".$fila->id." paletaColores'><script> agregarColores(".$fila->id.", \"".$fila->estilos."\");</script></td></tr></tbody></table>";
					}
		               	return $paises;
				}
					?>
