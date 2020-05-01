<?php
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/
	include "../base.php";	
	$conex=new Base("localhost","root","conabio3");
	echo capas($conex);
	
	function limpia($text){
		$text=str_replace(" ", "",$text);
		$text=str_replace("á", "a",$text);
		$text=str_replace("é", "e",$text);
		$text=str_replace("í", "i",$text);
		$text=str_replace("ó", "o",$text);
		$text=str_replace("ú", "u",$text);
		$text=str_replace("Á", "A",$text);
		$text=str_replace("É", "E",$text);
		$text=str_replace("Í", "I",$text);
		$text=str_replace("Ó", "O",$text);
		$text=str_replace("Ú", "U",$text);
		$text=str_replace("ñ", "n",$text);
		$text=str_replace("Ñ", "N",$text);
		return $text;
	}
	
	function capas($conex){
		$subm=array();
		$id=1;
		$paises = '';
		$scriptT='<script>';
		$scriptT.="var capasIds=[], unidades=[];
			function callbackF(){
		";
		$Subsresult =$conex->consulta("select idSubmenu,nombre,descripcion,idPadreSub from subMenus WHERE idPadreSub IS NULL order by prioridad");
		while($fila = $Subsresult->fetch_object()){
			$idSub="sub".$fila->idSubmenu;
			$sub='id="'.$idSub.'"';
			$claseS=$fila->idSubmenu;
			$paises.='<li class="menuFiltro" '.$sub.' data-prioridad="" data-name="'.htmlentities($fila->nombre, ENT_QUOTES, "ISO-8859-1").'" data-id="'.$idSub.'">
						<button class="btn glyphicon glyphicon-move"></button> 
						<span class="namDesc">'.htmlentities($fila->nombre, ENT_QUOTES, "ISO-8859-1").'</span>
						<button title="Editar nombre" class="btn glyphicon glyphicon-pencil" onclick="editSubmenu(\''.$fila->idSubmenu.'\',\''.htmlentities($fila->nombre, ENT_QUOTES, "ISO-8859-1").'\')"></button> 							
						<button title="Agregar submenu" class="btn glyphicon glyphicon-plus-sign" onclick="addSubmenu()"></button> 
						<button title="Eliminar submenu" class="btn glyphicon glyphicon-minus-sign" onclick="removeSubmenu(\''.$fila->idSubmenu.'\')"></button>
						<button class="btn glyphicon glyphicon-triangle-bottom" data-toggle="collapse" data-target="#exp'.$idSub.'" aria-expanded="true" aria-controls="exp'.$idSub.'"></button>
						<ol id="exp'.$idSub.'" class="_'.limpia($claseS).' collapse" aria-labelledby="'.$idSub.'" data-parent="#'.$idSub.'">
						</ol>
					</li>';			
		}
		$Subsresult =$conex->consulta("select s.idSubmenu,s.nombre,s.descripcion,s.idPadreSub,s.prioridad from subMenus s,subMenus p WHERE s.idPadreSub IS NOT NULL AND s.idPadreSub=p.idSubmenu order by p.prioridad, s.prioridad;");
		while($fila = $Subsresult->fetch_object()){
			$idSub="sub".$fila->idSubmenu;
			$sub='id="'.$idSub.'"';
			$claseS=$fila->idSubmenu; 
			$paises.='<li class="menuFiltro" '.$sub.' data-prioridad="" data-name="'.htmlentities($fila->nombre, ENT_QUOTES, "ISO-8859-1").'" data-id="'.$idSub.'">						
						<button class="btn glyphicon glyphicon-move"></button> 
						<span class="namDesc">'.htmlentities($fila->nombre, ENT_QUOTES, "ISO-8859-1").'</span>
						<button title="Editar nombre" class="btn glyphicon glyphicon-pencil" onclick="editSubmenu(\''.$fila->idSubmenu.'\',\''.htmlentities($fila->nombre, ENT_QUOTES, "ISO-8859-1").'\')"></button> 							
						<button title="Agregar submenu" class="btn glyphicon glyphicon-plus-sign" onclick="addSubmenu('.$fila->idSubmenu.')"></button> 
						<button title="Eliminar submenu" class="btn glyphicon glyphicon-minus-sign" onclick="removeSubmenu(\''.$fila->idSubmenu.'\')"></button>
						<button class="btn glyphicon glyphicon-triangle-bottom" data-toggle="collapse" data-target="#exp'.$idSub.'" aria-expanded="true" aria-controls="exp'.$idSub.'"></button>
						<ol id="exp'.$idSub.'" class="_'.limpia($claseS).' collapse" aria-labelledby="'.$idSub.'" data-parent="#'.$idSub.'">
						</ol>
					</li>';
			$scriptT.='$( \'#'.$idSub.'\' ).appendTo( "._'.$fila->idPadreSub.'" );';		
		}		
	    $Subsresult3 =$conex->consulta("select nombre,id_Capa,descripcion,unidad,idSubmenu from menus2 where id_Pais=1 order by prioridad ASC");
	    $Subsnumfilas3 = $Subsresult3->num_rows;
	    for ($x=0;$x<$Subsnumfilas3;$x++) {
	        $fila = $Subsresult3->fetch_object();
			$paises.='
				<li class="menuFiltro" onclick="datos(this.title)" title="'.$fila->id_Capa.'-layers" style="color:red !important;" id="'.limpia("c".$fila->id_Capa).'" data-prioridad="" data-name="'.$fila->nombre.'" data-id="'.$fila->id_Capa.'">
					<button class="btn glyphicon glyphicon-move"></button>
					Capa->'.$fila->nombre.'
					<button title="Eliminar capa" class="btn glyphicon glyphicon-minus-sign" onclick="removeCapa(\''.$fila->id_Capa.'\')"></button>
				</li>
			';
			if($fila->idSubmenu!=NULL){
				$scriptT.= '$( "#c'.$fila->id_Capa.'"  ).appendTo( "._'.$fila->idSubmenu.'" );';				
			}
	    }
		$scriptT.="					
				}
				callbackF();
			</script>";
		$conex->db->close();
        return $paises.$scriptT;
	}
?>
