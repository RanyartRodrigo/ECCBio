<?php
        include "base.php";
$base=new Base("localhost","root","global");
if($_GET["seccion"]=="people")$seccion=people($base);
if($_GET["seccion"]=="friends")$seccion=friends($base);
                              if(isset($_GET['callback'])){ // Si es una petición cross-domain
                                          echo $_GET['callback'].'('.json_encode($seccion).')';
                                                }
                                        else{ // Si es una normal, respondemos de forma normal
                                         echo json_encode($seccion);
                                        }
function people($base){        
include "host.php";
        $result = $base->consulta( "SELECT * FROM personas order by prioridad ASC");
  	$numfilas = $result->num_rows;
        $echo.='
        <!-- Meet Our Team -->
        <div class="contenedor-clase">
        	<div class="container">
	            <div class="row">
	            	<div class="col-sm-12 filters people-a wow fadeInLeft">';
	       		          
		                $result2 =$base->consulta("SELECT tipo FROM personas group by tipo");
		                $numfilas2 = $result2->num_rows;
		                $echo.= '<a href="#" class="filter-all active">All</a>/';
		                  for ($x=0,$y=1,$tipo="";$x<$numfilas2;$x++) {
		                  	$fila = $result2->fetch_object();
		                  	$echo.= '
		               		<a href="#" class="filter-'.str_replace(" ","-",$fila->tipo).'">'.$fila->tipo.'</a>/
		                  	';
     }
     $echo.='
	            	</div>
	            </div>

	            <div class="row">
      <div class="col-sm-12 wow fadeIn PEOPLE">';
	            	 	for ($x=0;$x<$numfilas;$x++) {
      						$fila = $result->fetch_object();
        					$echo.= '	                
        					<div class="box people-b '.str_replace(" ","-",$fila->tipo).'">
		                		<div class="box-container wow fadeInDown">';
						if ($fila->img!="")
		                    		$echo.= '<img src="'.$host.'uploads/personas/'.$fila->img.'" alt="" data-at2x="'.$host.'uploads/personas/'.$fila->img.'">';
		                    		else
						 $echo.= '<img src="assets/img/testimonials/unam.png" alt="" data-at2x="assets/img/testimonials/unam.png">';
						$echo.= '<h3>'.$fila->nombre.' '.$fila->apellido.'</h3>
		                    		<p>'.$fila->locacion.'</p>
		                    		<p>'.$fila->descripcion.'</p>
		                    		<div class="team-social">		                        
		                        	<p><i class="fa fa-envelope"></i>  '.$fila->contacto.'</p>
		                    		</div>
		                		</div>
	                		</div>
        					';
     					}
     				$echo.='	            	
</div>
	            </div>
	        </div>
        </div>
<script src="/static/assets/js/masonry.pkgd.min.js"></script>
       <script>
        if($("#MenuPrincipal").find("#People").length==0){
        $("#MenuPrincipal").find("ul").append("<li><a onClick=\'cargarContenido(this.id, this.title)\' id=\'/\' title=\'Home\'><i class=\'fa fa-arrow-left\'><span>Back</span></a></li>");
        $("#MenuPrincipal").find("ul").append("<li><a onClick=\'cargarSeccion(this.title)\' id=\'People\' title=\'people\'><i class=\'fa fa-refresh\'><span>People</span></a></li>");
}
	$(".PEOPLE").masonry({
		columnWidth: ".box", 
		itemSelector: ".box",
		transitionDuration: "0.5s"
	});
	
	$(".people-a a").on("click", function(e){
		e.preventDefault();
		if(!$(this).hasClass("active")) {
	    	$(".people-a a").removeClass("active");
	    	var clicked_filter = $(this).attr("class").replace("filter-", "");
	    	$(this).addClass("active");
	    	if(clicked_filter != "all") {
	    		$(".people-b:not(." + clicked_filter + ")").css("display", "none");
	    		$(".people-b:not(." + clicked_filter + ")").removeClass("box");
	    		$("." + clicked_filter).addClass("box");
	    		$("." + clicked_filter).css("display", "block");
	    		$(".PEOPLE").masonry();
	    	}
	    	else {
	    		$(".PEOPLE > div").addClass("box");
	    		$(".PEOPLE > div").css("display", "block");
	    		$(".PEOPLE").masonry();
	    	}
		}
	});
	$(window).on("resize", function(){
        new WOW().init();
	$(".PEOPLE").masonry(); });
$(document).ready(function(){
        new WOW().init();
    });

</script>';
return $echo;
}
function friends($base){
 
include "host.php";            
$echo.='
        <div class="">
            <div class="container">

                <div class="row">';
                
                        $result =$base->consulta("SELECT * FROM amigos");
                        $numfilas = $result->num_rows;
                          for ($x=0,$y=1,$tipo="";$x<$numfilas;$x++) {
                            $fila = $result->fetch_object();
                            $echo.='
                                <div class="col-sm-3">
                                    <div class="friends wow fadeInUp">
                                        <img src="'.$host.'uploads/amigos/'.$fila->img.'" alt="Lorem Website" data-at2x="'.$host.'uploads/amigos/'.$fila->img.'">
                                        <p>'.$fila->titulo.'</p>
                                        <a class="big-link-1" href="'.$fila->url.'"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                ';
                        }
                    $echo.='
                </div>
            </div>
        </div>
        <script src="/static/assets/js/masonry.pkgd.min.js"></script>
       <script>
$(document).ready(function(){
        new WOW().init();
    });
        if($("#MenuPrincipal").find("#Contributors").length==0){
        $("#MenuPrincipal").find("ul").append("<li><a onClick=\'cargarContenido(this.id, this.title)\' id=\'/\' title=\'Home\'><i class=\'fa fa-arrow-left\'><span>Back</span></a></li>");
        $("#MenuPrincipal").find("ul").append("<li><a onClick=\'cargarSeccion(this.title)\' id=\'Contributors\' title=\'friends\'><i class=\'fa fa-refresh\'><span>Contributors</span></a></li>");
}

    $(".view-work").magnificPopup({
        type: "image",
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            tError: "The image could not be loaded.",
            titleSrc: function(item) {
                return item.el.parent(".work-bottom").siblings("img").attr("alt");
            }
        },
        callbacks: {
            elementParse: function(item) {
                item.src = item.el.attr("href");
            }
        }
    });
    
        </script>
';
return $echo;
}
?>
