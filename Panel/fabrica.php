<?php  
	include "base.php";
	include "host2.php";
	$base=new Base("localhost",$DB_user,$DB_name);
if(isset($_GET["parent"])){
        $parent=$_GET["parent"];
}
else{
$parent="global";
}
                                 if($_GET['t']=="pass")$paises=pass($base,$parent);
		                 if($_GET['t']=="paises")$paises=paises($base,$parent);
		                 if($_GET['t']=="capas")$paises=capas($base,$parent);
		                 if($_GET['t']=="capas2")$paises=capas2($base,1,$parent);
                                 if($_GET['t']=="capas3")$paises=capas2($base,0,$parent);
		                 if($_GET['t']=="logos")$paises=logos($base,$parent);
				 if($_GET['t']=="paises2")$paises=paises2($base,$parent);
                                 if($_GET['t']=="panel")$paises=panel($base,$parent);
                                 if($_GET['t']=="infoCover")$paises=infoCover($base,$parent);
                                 if($_GET['t']=="estilos")$paises=estilosCapa($base,$parent);
                                 if($_GET['t']=="getInfoLegend")$paises=infoLegend($base,$parent);


		              if(isset($_GET['callback'])){ // Si es una petición cross-domain  
					  echo $_GET['callback'].'('.json_encode($paises).')';
						}
					else{ // Si es una normal, respondemos de forma normal  
 					 echo json_encode($paises);
					}

function pass($base,$parent){
$password=$_GET['pass'];
$capa=str_replace("capa","",$_GET['id']);
	$result =$base->consulta("SELECT id_Capa FROM menus where id_Capa=".$capa." and password='".$password."'");
        $numfilas = $result->num_rows;
	if($numfilas==1){
                $fila = $result->fetch_object();
		return "true";
	}
	else
		return "false"; 
}
function panel($base,$parent){
                                        $result =$base->consulta("SELECT * FROM panel order by prioridad ASC");
                                $numfilas = $result->num_rows;
				$contador=0;
                                $paises="<i class='fa fa-cog' onClick='panel()' id='op'></i>";
 for ($x=0;$x<$numfilas;$x++) {
                                        $fila = $result->fetch_object();
					$paises.= '<i id="panel'.$fila->idPanel.'" onclick="'.$fila->funcion.'" class="padre fa fa-'.$fila->icono.'" >';
                                        if($fila->descripcion!="")$paises.='<div class="hijo" id="submenu'.$fila->idPanel.'">'.$fila->descripcion.' <br></div>';
                                        $paises.='</i>';
if($fila->submenu>0)
$paises.= '<script> $(\'#panel'.$fila->idPanel.'\').appendTo(\'#submenu'.$fila->submenu.'\');</script>';
else
$contador++;
                                }
                                return $paises."
<style>
.abrir{
width: ".(($contador*40)+40)."px !important;
}
</style>
<script>
function panel(){
if($('#panelDeControl').hasClass('abrir')){
        $('#panelDeControl').removeClass('abrir');
        $('#op').addClass('fa-cog');
        $('#op').removeClass('fa-cogs');
}
else{
        $('#panelDeControl').addClass('abrir');
        $('#op').addClass('fa-cogs');
        $('#op').removeClass('fa-cog');
}
}
panel();
$(document).ready(function(){
$('#panelDeControl>.padre').on('click',function(){
        if($(this).find('.hijo').first().attr('style')=='')
        $(this).find('.hijo').first().attr('style','display:block !important; color:black');
        else
        $(this).find('.hijo').first().attr('style','');
});
});

</script>";


}

function paises($base,$parent){
$base->setBase($parent);
include 'host.php';
if($parent=="global"){
if(isset($_GET['seleccionado']))
//if(preg_match('/\w/',$_GET['seleccionado']))
$seleccionado=$_GET['seleccionado'];
else
$seleccionado="n";


	                		$result =$base->consulta("SELECT * FROM paises order by nombre ASC");
		                $numfilas = $result->num_rows;
		                $paises="";
 for ($x=0;$x<$numfilas;$x++) {
		                  	$fila = $result->fetch_object();

		                  if($seleccionado==$fila->nombreURL){
if($fila->bandera=="")
                                        $paises.= '<li onclick="MapOf(\''.$fila->nombreURL.'\')" id="'.$fila->nombreURL.'" class="active">'.$fila->nombre.'</li>';
else
		                  	$paises.= '<li onclick="MapOf(\''.$fila->nombreURL.'\')" id="'.$fila->nombreURL.'" class="active">'.$fila->nombre.'<img src="'.$host.'uploads/paises/'.$fila->bandera.'"></li>';
}
		                    else{
if($fila->bandera=="") $paises.= '<li onclick="MapOf(\''.$fila->nombreURL.'\')" id="'.$fila->nombreURL.'">'.$fila->nombre.'</li>';
else $paises.= '<li onclick="MapOf(\''.$fila->nombreURL.'\')" id="'.$fila->nombreURL.'">'.$fila->nombre.'<img src="'.$host.'uploads/paises/'.$fila->bandera.'"></li>';
}
		               	}
		               	return $paises;
}
else
	return '<script>$(".Mprincipal>li").remove();</script>';
}
function capas($base,$parent){
$base->setBase($parent);
$subm=array();
$advertencia='';
if($_GET["seleccionado"]=="Mexico"){
$advertencia='<style>
#MenuPrincipal>.container, #MenuPrincipal>.container>.collapse>.nav {
    width: 100%;
    margin-left: 20px;
    float: left !important;
font-size: 10px;
}
</style>';
}
if($_GET["seleccionado"]=="World"){
$advertencia='
<script>
function creaAdvertencia(){ $("#banner").append("<div class=\'advertencia\'><button id=\'cerrarAdvertencia\' onClick=\'cierraAdvertencia()\'>To see more details and get more information about the active layers, Zoom in to the map<br> <i class=\'fa fa-exclamation\'></i></button></div>");}
function cierraAdvertencia(){$(".advertencia").remove();}
//$(document).ready(function(){creaAdvertencia();});
</script>';
}
                                                $resultsub =$base->consulta("SELECT nombre FROM menus where sub=1 order by prioridad ASC");
                                $numfilassub = $resultsub->num_rows;
                                                for ($x=0;$x<$numfilassub;$x++) {
                                        $fila = $resultsub->fetch_object();
                                        array_push($subm,$fila->nombre);
                                }

		                		$result =$base->consulta("SELECT id_Pais FROM paises where nombreURL='".$_GET["seleccionado"]."'");
		                $numfilas = $result->num_rows;
	 					for ($x=0;$x<$numfilas;$x++) {
		                  	$fila = $result->fetch_object();
		                  	$id=$fila->id_Pais;
		               	}
				$grupos='<div id="grupos">';
                                       $resultGrupos =$base->consulta("SELECT grupo,GROUP_CONCAT(id_Capa SEPARATOR '_') as id FROM menus where id_Pais='".$id."' and grupo!='' group by grupo ASC order by prioridad ASC");
                                $gruposn = $resultGrupos->num_rows;
				$estilos=array();
                                                for ($x=0;$x<$gruposn;$x++) {
                                        $fila = $resultGrupos->fetch_object();
					$estilos[$fila->grupo]='partede'.$x;
                                        $grupos.='<div class="padre"><div class="hijo partede'.$x.'">'.$fila->grupo.'</div><input class="grupo'.$x.'" type="button" onClick="grupo(this)" id="'.$fila->id.'"/></div>';
                                }
				$grupos.='</div><script>$("#grupos").insertAfter("#playStop");$("<div class=\'padre\'><div class=\'hijo\'>All Groups</div><input  type=\'button\' onClick=\'grupoAll(this)\' value=\'ALL\' class=\'grupo\'/></div>").appendTo("#grupos");</script>';

	                		$result2 =$base->consulta("SELECT * FROM menus where id_Pais='".$id."' order by prioridad ASC,subMenu ASC, sub DESC ");
		                $numfilas2 = $result2->num_rows;
		                $paises="";
		                $subMenu="";
		 		for ($x=0;$x<$numfilas2;$x++) {
		                	$fila = $result2->fetch_object();
					$clasegrupos=$estilos[$fila->grupo];
					$clase=$fila->tipo;
		                	if(str_replace(" ", "",$fila->subMenu)=="" && $fila->sub!=1){  	
		                  		$paises.= '<li class="padre '.$estilos[$fila->grupo].'" title="'.$fila->nombre.'" id="capa'.$fila->id_Capa.'">
                            			<a onClick="agregarCapa(\'capa'.$fila->id_Capa.'\',\''.$clasegrupos.'\',\''.$fila->id_Capa.'\',\''.$clase.'\',\''.$fila->nombre.'\')" title="'.$fila->nombre.'">
						<div class="miniSlideThree"><input type="checkbox" value="'.$fila->id_Capa.'" grupo="'.$fila->grupo.'" id="miniSlideThree" name="check" class="'.$clase.'"/><label ></label></div><label>'.$fila->nombre.'</label></a>
						<i class="fa fa-info-circle"  onClick="openbox(\'infoOfLayer\',\'capa'.$fila->id_Capa.'\')"></i>';
 						if($fila->descripcion!=""){
							$paises.='<div class="hijo"><p>'.$fila->descripcion;
							if($fila->grupo!="")$paises.='<br>('.$fila->grupo.')';
							$paises.='</p></div></div><i class="ayudaPerson fa fa-user"></i>';
						}
                        			$paises.='</li>';
					}
                        		else{
                        			if($subMenu!=$fila->subMenu){
						        $subMenu=$fila->subMenu;
							if(in_array($fila->subMenu,$subm))
                                                                ;
							else{
                        					$paises.='<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000">
								<span class="caret"></span><label>'.$fila->subMenu.'</label>
								</a><i class="fa fa-info"  onClick="openbox(\'infoOfLayer\',this.id)" id="capa"></i>
								<ul class="dropdown-menu dropdown-menu-left '.str_replace(" ", "",$fila->subMenu).'" role="menu">
								</ul>
								</li>';
							}
                        			}
						if($fila->sub==1){
							$paises.= '<li class="sub padre '.$estilos[$fila->grupo].'" title="'.$fila->nombre.'" id="capa'.$fila->id_Capa.'"><a><label>'.$fila->nombre.'</label></a>
                                                        <i class="fa fa-info"  onClick="openbox(\'infoOfLayer\',\'capa'.$fila->id_Capa.'\')"></i><ul class="dropdown-menu subsub '.str_replace(" ", "",$fila->nombre).'" role="menu"></ul>';
						}
						else
                        				$paises.= '<li class="sub padre '.$estilos[$fila->grupo].'" title="'.$fila->nombre.'" id="capa'.$fila->id_Capa.'"><a onClick="agregarCapa(\'capa'.$fila->id_Capa.'\',\''.$clasegrupos.'\',\''.$fila->id_Capa.'\',\''.$clase.'\',\''.$fila->nombre.'\')" title="'.$fila->nombre.'"><div class="miniSlideThree"><input type="checkbox" value="'.$fila->id_Capa.'"  grupo="'.$fila->grupo.'"  id="miniSlideThree" name="check" class="'.$clase.'"/><label ></label></div><label>'.$fila->nombre.'</label></a>
 							<i class="fa fa-info-circle"  onClick="openbox(\'infoOfLayer\',\'capa'.$fila->id_Capa.'\')"></i>';
						if($fila->descripcion!=""){
                                        		$paises.='<div class="hijo"><p>'.$fila->descripcion;
                                        		if($fila->grupo!="")$paises.='<br>('.$fila->grupo.')';
                                        		$paises.='</p></div></div><i class="ayudaPerson fa fa-user"></i>';
                                		}
						$paises.='</li>';    	
						$paises.= '<script>
						$( \'#capa'.$fila->id_Capa.'\' ).appendTo( ".'.str_replace(" ", "",$fila->subMenu).'" );
						$( ".'.str_replace(" ", "",$fila->subMenu).'" ).parent().children("i").attr("id",$( ".'.str_replace(" ", "",$fila->subMenu).'" ).parent().children("i").attr("id")+", '.$fila->id_Capa.'");
						$( ".'.str_replace(" ", "",$fila->subMenu).'" ).parent().children("i").attr("id",$( ".'.str_replace(" ", "",$fila->subMenu).'" ).parent().children("i").attr("id").replace("capa, ","capa"));
						if(typeof menuCenter === "function") {setTimeout(menuCenter, 500);}
						</script>';
                        		}

		               	}
		           return $paises.$grupos.$advertencia;

}
function capas2($base,$op,$parent){
$base->setBase($parent);

                                                $result =$base->consulta("SELECT id_Pais FROM paises where nombreURL='".$_GET["seleccionado"]."'");
                                $numfilas = $result->num_rows;
                                                for ($x=0;$x<$numfilas;$x++) {
                                        $fila = $result->fetch_object();
                                        $id=$fila->id_Pais;
                                }
                                $result2 =$base->consulta("SELECT * FROM menus where id_Pais='".$id."' order by subMenu ASC");
					$capas='<select>';
					$numfilas2 = $result2->num_rows;
                                        for ($x=0;$x<$numfilas2;$x++) {
                                        	$fila = $result2->fetch_object();
                                        	$capas.='<option value="'.$fila->id_Capa.'">'.$fila->nombre.'</option>';
                                	}
					$capas.='</select>';
				$select1=str_replace('<select>','<select id="Ncapa1">',$capas);
					$select2=str_replace('<select>','<select id="Ncapa2">',$capas);
if($op==1)
return  $select1.'-------------------'.$select2.'<button onClick="resultado(1)">Diferencia</button><button onClick="cancelar(\'restaCapas\')">Cancelar</button>';
else
return  $select1.'-------------------'.$select2.'<button onClick="resultado(0)">Interseccion</button><button onClick="cancelar(\'interseccionCapas\')">Cancelar</button>';

}
function logos($base,$parent){
$base->setBase($parent);
include 'host.php';
                $result =$base->consulta("SELECT id_Pais, bandera FROM paises where nombreURL='".$_GET["seleccionado"]."'");
                                $numfilas = $result->num_rows;
                                 for ($x=0;$x<$numfilas;$x++) {
                                        $fila = $result->fetch_object();
                                        $pais=$fila->id_Pais;
					$bandera='<div class="divlogos"><img src="'.$host.'uploads/paises/'.$fila->bandera.'"  class="logosmapas" /><img src="'.$host.'uploads/paises/'.$fila->bandera.'" class="logosmapasgrande"/></div>';
                                }

		                $result =$base->consulta("SELECT * FROM galeria_paises where idPais=".$pais." and tipo=1 order by nombre ASC");
		                $numfilas = $result->num_rows;
		                $paises="";
				 for ($x=0;$x<$numfilas;$x++) {
		                  	$fila = $result->fetch_object();
		                  	$paises.='<div class="divlogos"><img src="'.$host.'uploads/galeria_Paises/'.$fila->nombre.'" class="logosmapas"/><img src="'.$host.'uploads/galeria_Paises/'.$fila->nombre.'" class="logosmapasgrande"/></div>';
		               	}
		               	return $paises;

}
function estilosCapa($base,$parent){
$base->setBase($parent);
include 'host.php';
$estilo="";
                $result = $base->consulta("SELECT columnas.estilos from menus left join columnas on columnas.idColumna=menus.id_Columna where id_Capa=".$_GET["seleccionado"]); 
                                $numfilas = $result->num_rows;
                                 for ($x=0;$x<$numfilas;$x++) {
                                        $fila = $result->fetch_object();
                                        $estilo=$fila->estilos;
                                }
                                return $estilo;
}

function infoCover($base,$parent){
$base->setBase($parent);
include 'host.php';
                                $numfilas = $result->num_rows;
                                $result =$base->consulta("SELECT * FROM paises where nombreURL='".$_GET["seleccionado"]."'");
                                $numfilas = $result->num_rows;
                                $paises="";
                                 for ($x=0;$x<$numfilas;$x++) {
                                        $fila = $result->fetch_object();
                                        $paises.='<div class="non"><h2><img src="'.$host.'uploads/paises/'.$fila->bandera.'">'.$fila->nombre.'<img src="'.$host.'uploads/paises/'.$fila->bandera.'"></h2>';
					$paises.=$fila->informacion;
					$result1 =$base->consulta("SELECT grupo FROM menus where id_Pais='".$fila->id_Pais."' and grupo!=''  group by grupo");
                                        $numfilas1 = $result1->num_rows;
					$result2 =$base->consulta("SELECT menus.id_Capa as id,menus.nombre,menus.descripcion,menus.grupo, columnas.estilos  FROM menus left join columnas on columnas.idColumna=menus.id_Columna  where id_Pais='".$fila->id_Pais."'");
                                	$numfilas2 = $result2->num_rows;
					$result3 =$base->consulta("select nombre from galeria_paises where idPais='".$fila->id_Pais."' and tipo=1 order by nombre");
                                        $numfilas3 = $result3->num_rows;
                                        $result31 =$base->consulta("select nombre from galeria_paises where idPais='".$fila->id_Pais."' and tipo=2 order by nombre");
                                        $numfilas31 = $result31->num_rows;
					$result4 =$base->consulta("select nombre from galeria_paises where idPais='".$fila->id_Pais."' and tipo=0");
                                        $numfilas4 = $result4->num_rows;
                                        $cantLogos=5;



$paises.='</div></div><div class="par ">
	            <div class="col-sm-10 col-sm-offset-1 testimonial-list">
	                	<div role="tabpanel">
	                		<!-- Tab panes -->
	                		<div class="tab-content logosOrg">
	                		';	
                                    $numfilasA=$numfilas31+$numfilas3;
		                			$class="in active";
		                  			for ($x=0,$y=1,$a=1,$c=0;$x<$numfilasA;$x++,$a++) {
		                  				
		                  				$y=$x+1;
		                  				if($y>1)
		                  					$class="";
                                                                if($a==1){
									$c++;
									$paises.='<div role="tabpanel" class="tab-pane fade '.$class.'" id="tab'.$c.'">';
								}
		                  				if($numfilas3>$x){
	                                                        	$fila3 = $result3->fetch_object();
									$paises.='<img src="'.$host.'uploads/galeria_Paises/'.$fila3->nombre.'"/>';
								}
		                  				else{
		                  					$fila31 = $result31->fetch_object();
                                                                	$paises.='<img src="'.$host.'uploads/galeria_Paises/'.$fila31->nombre.'"/>';
								}
                                                                if($a==$cantLogos || ($x+1)==$numfilasA){
                                                                	$paises.='</div>';
									$a=0;
								}
		               				}
		            			
	                			$paises.='
	                		</div>
	                		<!-- Nav tabs -->
	                		<ul class="nav nav-tabs logosLista" role="tablist">
	                			';
		                			$numfilasA;
		                			$class="class='active'";
		                  			for ($x=1;$x<=round($numfilasA/$cantLogos);$x++) {
		                  				$fila = $result->fetch_object();
		      
		                  				if($x>1)
		                  					$class="";
		                  				$paises.= '
	                						<li role="presentation" '.$class.'>
	                							<a href="#tab'.$x.'" aria-controls="tab'.$x.'" role="tab" data-toggle="tab"></a>
	                						</li>
		                  				';
		               				}
		            		$paises.='
	                		</ul>
	                	</div>
	                
	            
	        </div>
        </div>
<div class="non"><div class="filters capas-a wow fadeInLeft">';




					if($numfilas1>1){
					$paises.='<a href="#" class="filter-all active">All</a>/';
					for ($x1=0;$x1<$numfilas1;$x1++) {
                                                $fila1 = $result1->fetch_object();
                                                $paises.='<a href="#" class="filter-'.str_replace(" ","-",$fila1->grupo).'">'.$fila1->grupo.'</a>/';
                                        }
                                        }
                                    $paises.='</div><div class="CAPAS">';
                                 	for ($x2=0;$x2<$numfilas2;$x2++) {
                                        	$fila2 = $result2->fetch_object();
                                        	$paises.='<div class="box capas-b '.str_replace(" ","-",$fila2->grupo).'"><div class="box-container"><div class="box-text"><h2>'.$fila2->nombre.'</h2><br>';
                                        	$paises.='<p>'.$fila2->descripcion.'</p><br>';
					
						$paises.='<script> agregarColores('.$fila2->id.', "'.$fila2->estilos.'");</script>';
						$paises.='<div class="colores_'.$fila2->id.' paletaColores"></div><br></div></div></div>';
                                	}
					$paises.='</div></div><div class="par galeria">';
					for ($x4=0;$x4<$numfilas4;$x4++) {
                                                $fila4 = $result4->fetch_object();
                                                $paises.='<img src="'.$host.'uploads/galeria_Paises/'.$fila4->nombre.'"/>';
                                        }
					$paises.='</div>';
                                }
                                return $paises.'<button onClick="Cover()">X</button>
<script src="/static/assets/js/masonry.pkgd.min.js"></script>
<script>
$(document).ready(function(){
setTimeout(function(){$("#cover>div").first().find("img").each(function(){
var obj=$(this);
if(obj.attr("src").indexOf("http")==-1)
	obj.attr("src","'.$host.'"+obj.attr("src"));
});},1000);
  $(".CAPAS").masonry({
                columnWidth: ".box",
                itemSelector: ".box",
                transitionDuration: "0.5s"
        });

        $(".capas-a a").on("click", function(e){
                e.preventDefault();
                if(!$(this).hasClass("active")) {
                $(".capas-a a").removeClass("active");
                var clicked_filter = $(this).attr("class").replace("filter-", "");
                $(this).addClass("active");
                if(clicked_filter != "all") {
                        $(".capas-b:not(." + clicked_filter + ")").css("display", "none");
                        $(".capas-b:not(." + clicked_filter + ")").removeClass("box");
                        $("." + clicked_filter).addClass("box");
                        $("." + clicked_filter).css("display", "block");
                        $(".CAPAS").masonry();
                }
                else {
                        $(".CAPAS > div").addClass("box");
                        $(".CAPAS > div").css("display", "block");
                        $(".CAPAS").masonry();
                }
                }
        });
});
setTimeout(function(){$(".CAPAS").masonry(); },1000);
$(window).on("resize", function(){
$(".logosLista>li>a").first().trigger("click");
        $(".CAPAS").masonry(); });
setTimeout(function(){$(".CAPAS").masonry(); },500);
$("#cover>.galeria>img").on("click", function(){
	var img=$(this).attr("src");
var back=$(this).prev().attr("src");
var next=$(this).next().attr("src");
if(next==undefined)
next=$("#cover>.galeria > img").first().attr("src");
if(back==undefined)
back=$("#cover>.galeria > img").last().attr("src");
$("body").append("<div class=\'imgCoverBig\'><img src=\'"+img+"\'/><button onClick=\'removeImgCover()\'>X</button><i class=\'fa fa-arrow-left\' onClick=\'cambiaImagen(this.title)\' title=\'"+back+"\'></i><i class=\'fa fa-arrow-right\' onClick=\'cambiaImagen(this.title)\' title=\'"+next+"\'></i></div>");
});

$(".logosOrg>div>img").on("click", function(){
        var img=$(this).attr("src");
var back=$(this).prev().attr("src");
var next=$(this).next().attr("src");
if(next==undefined)
next=$(".logosOrg >div> img[src=\'"+img+"\']").parent().next().find("img").first().attr("src");
if(next==undefined)
next=$(".logosOrg >div").first().find("img").first().attr("src");
if(back==undefined)
back=$(".logosOrg >div> img[src=\'"+img+"\']").parent().prev().find("img").last().attr("src");
if(back==undefined)
back=$(".logosOrg >div").last().find("img").last().attr("src");
$("body").append("<div class=\'imgCoverBig\'><img src=\'"+img+"\'/><button onClick=\'removeImgCover()\'>X</button><i class=\'fa fa-arrow-left\' onClick=\'cambiaImagen2(this.title)\' title=\'"+back+"\'></i><i class=\'fa fa-arrow-right\' onClick=\'cambiaImagen2(this.title)\' title=\'"+next+"\'></i></div>");

});


function removeImgCover(){
	$(".imgCoverBig").remove();
}
function cambiaImagen(nombre){
var img=nombre;
var back=$("#cover>.galeria > img[src=\'"+nombre+"\']").prev().attr("src");
var next=$("#cover>.galeria > img[src=\'"+nombre+"\']").next().attr("src");
if(next==undefined)
next=$("#cover>.galeria > img").first().attr("src");
if(back==undefined)
back=$("#cover>.galeria > img").last().attr("src");

removeImgCover();
$("body").append("<div class=\'imgCoverBig\'><img src=\'"+img+"\'/><button onClick=\'removeImgCover()\'>X</button><i class=\'fa fa-arrow-left\' onClick=\'cambiaImagen(this.title)\' title=\'"+back+"\'></i><i class=\'fa fa-arrow-right\' onClick=\'cambiaImagen(this.title)\' title=\'"+next+"\'></i></div>");
}
function cambiaImagen2(nombre){
var img=nombre;
var back=$(".logosOrg >div> img[src=\'"+nombre+"\']").prev().attr("src");
var next=$(".logosOrg >div> img[src=\'"+nombre+"\']").next().attr("src");
if(next==undefined)
next=$(".logosOrg >div> img[src=\'"+nombre+"\']").parent().next().find("img").first().attr("src");
if(next==undefined)
next=$(".logosOrg >div").first().find("img").first().attr("src");
if(back==undefined)
back=$(".logosOrg >div> img[src=\'"+nombre+"\']").parent().prev().find("img").last().attr("src");
if(back==undefined)
back=$(".logosOrg >div").last().find("img").last().attr("src");

removeImgCover();
$("body").append("<div class=\'imgCoverBig\'><img src=\'"+img+"\'/><button onClick=\'removeImgCover()\'>X</button><i class=\'fa fa-arrow-left\' onClick=\'cambiaImagen2(this.title)\' title=\'"+back+"\'></i><i class=\'fa fa-arrow-right\' onClick=\'cambiaImagen2(this.title)\' title=\'"+next+"\'></i></div>");

}
$(".logosLista>li>a").on("click", function(){
	setTimeout(function(){
	var w=$(".logosOrg>.active").width();
        var w2=$(".logosOrg>.active").parent().width();
        $(".logosOrg>.active").attr("style", "margin-left:"+((w2-w)/2)+"px; margin-right:"+((w2-w)/2)+"px");
	}, 200);
});

</script>
';

}
function infoLegend($base,$parent){
$base->setBase($parent);
$estilo="";
                $result = $base->consulta("SELECT nombre, unidad from menus where id_Capa=".$_GET["seleccionado"]);
                                $numfilas = $result->num_rows;
                                 for ($x=0;$x<$numfilas;$x++) {
                                        $fila = $result->fetch_object();
                                        $estilo=$fila->nombre."<br>".$fila->unidad;
                                }
                                return $estilo;

}


					?>
