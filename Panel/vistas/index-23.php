<?php
$paises=get();
if(isset($_GET['callback'])){ // Si es una petición cross-domain  
					  echo $_GET['callback'].'('.json_encode($paises).')';
						}
					else{ // Si es una normal, respondemos de forma normal  
 					 echo json_encode($paises);
					}

function get(){
$echo='';
include "../host.php";
include "../base.php";              
                $obj=new Base("localhost","root","cursos");
$echo.='
        <!-- Slider 2 -->
        <div class="slider-2-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 slider-2-text wow fadeInUp">
                        <div><h1><span class="violet">MoFuSS</span></h1></div>
	            		<div><p><span class="violet">Our main interest</span>a of energy security for the poor.</p></div>
                    	<div><p><span class="violet">Our approach</span> change and woodfuel demand sources.</p></div>
                    	<div><a class="big-link-1" onclick="cargarContenido(this.id,this.title)" id="people.php" title="People">Read more</a>
</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Services -->
        <div class="non">

	            <div class=" slider1">
		                  		<div class="col-sm-6">
		                			<div class="service wow fadeInUp">
		                    			<div class="icon"><i class="fa fa-globe"></i></div>
		                    			<a class="big-link-1" onclick="MapOf(this.title)" title="Mexico">Mexico</a>
		                			</div>
								</div>
								<div class="col-sm-6">
		                			<div class="service wow fadeInUp">
		                    			<div class="icon"><i class="fa fa-globe"></i></div>
		                    			<a class="big-link-1" onclick="MapOf(this.title)" title="Guatemala">Guatemala</a>
		                			</div>
								</div>

	            </div>
</div>

                <!-- Latest work -->
        <div class="par">
	        <div class="container">
	        	<div class="row">
		            <div class="col-sm-12 work-title wow fadeIn">
		                <h2>Publications</h2>
		            </div>
	            </div>
	            <div class="row">

		                  		<div class="col-sm-4">
		                			<div class="service wow fadeInUp">
		                    			<h3>uno</h3>';
		                    		
		                    		$obj->setBase("global");
                                        $result =$obj->consulta("SELECT * FROM paises order by nombre ASC");
                                $numfilas = $result->num_rows;
                                $paises="";
 for ($x=0;$x<$numfilas;$x++) {
                                        $fila = $result->fetch_object();
                                        $paises.= '
                                                <div class="">
                                                        <div class="service wow fadeInUp">
                                                        <div class="icon"><i class="fa fa-globe"></i></div>
                                                        <a class="big-link-1" onclick="MapOf(\''.$fila->nombreURL.'\')" title="'.$fila->nombreURL.'">'.$fila->nombreURL.'</a>
                                                        </div>
                                                                </div>';
                                }
                                return $paises."<script>$('.slider1').bxSlider({
slideWidth:220,
minSlides:1,
maxSlides:4,
auto:true,
autoControls:true,
autoHover:true,
slideMargin:10
});</script>";
}
		            
		                    	$echo.='		<a class="big-link-1" onclick="cargarContenido(this.id,this.title)" id="publications.php" title="Publications">Read more</a>
		                			</div>
								</div>
										                  		<div class="col-sm-4">
		                			<div class="service linetime wow fadeInUp">
		                    			<h3>dos</h3>';
		                    				            	
		                    				            	$obj->setBase("cursos");
                		$result =$obj->consulta("SELECT * FROM horarios limit 6");
		                $numfilas = $result->num_rows;
		                  for ($x=0,$y=1,$tipo="";$x<$numfilas;$x++) {
		                  	$fila = $result->fetch_object();
		                  	if($x%2!=0)
		                  	$echo.= '<div class="left">
		                  <i class="'.$fila->icono.'  wow fadeInUp"></i>
		                    			<div><p>Read more</p><a class="big-link-1 wow fadeInDown" onclick="cargarContenido(this.id,this.title)" id="publications.php" title="Publications">Read more</a></div>
		                  		</div>
		                  		<br>
		                  		';
		                  	else
		                  	$echo.= '<div class="right">
		                    			<i class="'.$fila->icono.'  wow fadeInDown"></i>
		                    			<div><p>Read more</p><a class="big-link-1  wow fadeInUp" onclick="cargarContenido(this.id,this.title)" id="publications.php" title="Publications">Read more</a>
</div>
		                  		</div>
		                  		<br>
		                  		';
		               	}
		               	     $obj->setBase("mofuss_unam");
		            
		                		$echo.='</div>
								</div>
										                  		<div class="col-sm-4">
		                			<div class="service wow fadeInUp">
		                    			<h3>tres</h3>';
		                    				            	
                		$result =$obj->consulta("SELECT * FROM amigos limit 3");
		                $numfilas = $result->num_rows;
		                  for ($x=0,$y=1,$tipo="";$x<$numfilas;$x++) {
		                  	$fila = $result->fetch_object();
		                  	$echo.= '
		                  		<div class="amigos">
		                			<div class=" wow fadeInUp">
		                    			<img src="'.$host.'../panel/uploads/amigos/'.$fila->img.'" alt="Lorem Website" data-at2x="../panel/uploads/amigos/'.$fila->img.'">
		                    			<div class="informacion">
		                    			<h4>'.$fila->titulo.'</h4>
		                    			<p>'.$fila->url.'</p>
		                    			<a class="big-link-1" href="'.$fila->url.'" id="publications.php" title="Publications">Read more</a>

		                    			</div>
		                			</div>
								</div>
		                  		';
		               	}
		            
		                    	$echo.='		<a class="big-link-1" onclick="cargarContenido(this.id,this.title)" id="publications.php" title="Publications">Read more</a>
		                			</div>
								</div>
		             
	            </div>
	        </div>
        </div>
        <!-- Testimonials -->
        <div class="non">
	        <div class="container">
	        	<div class="row">
		            <div class="col-sm-12 testimonials-title wow fadeIn">
		                <h2>Teaching</h2>
		            </div>
	            </div>
	            <div class="row">
	                <div class="col-sm-10 col-sm-offset-1 testimonial-list">
	                	<div role="tabpanel">
	                		<!-- Tab panes -->
	                		<div class="tab-content">
	                		';	
                					$result =$obj->consulta("SELECT * FROM asesoramientos limit 4");
		                			$numfilas = $result->num_rows;
		                			$class="in active";
		                  			for ($x=0,$y=1,$tipo="";$x<$numfilas;$x++) {
		                  				$fila = $result->fetch_object();
		                  				$y=$x+1;
		                  				if($y>1)
		                  					$class="";
		                  				$echo.='
	                						<div role="tabpanel" class="tab-pane fade '.$class.'" id="tab'.$y.'">
	                							<div class="testimonial-image">
	                								<img src="assets/img/testimonials/unam.png" alt="" data-at2x="assets/img/testimonials/unam.png">
	                							</div>
	                							<div class="testimonial-text">
		                                			<p>
		                                			'.$fila->descripcion.'
		                                			</p>
		                                			<a class="big-link-1" onclick="cargarContenido(this.id,this.title)" id="teaching.php" title="Teaching">Read more</a>
	                                			</div>
	                						</div>
		                  				';
		               				}
		            			
	                			$echo.='
	                		</div>
	                		<!-- Nav tabs -->
	                		<ul class="nav nav-tabs" role="tablist">
	                			';
		                			$numfilas = 4;
		                			$class="class='active'";
		                  			for ($x=1;$x<=$numfilas;$x++) {
		                  				$fila = $result->fetch_object();
		      
		                  				if($x>1)
		                  					$class="";
		                  				$echo.= '
	                						<li role="presentation" '.$class.'>
	                							<a href="#tab'.$x.'" aria-controls="tab'.$x.'" role="tab" data-toggle="tab"></a>
	                						</li>
		                  				';
		               				}
		            		$echo.='
	                		</ul>
	                	</div>
	                </div>
	            </div>
	        </div>
        </div>'


                
                		                $result =$obj->consulta("SELECT * FROM galeria_mofuss");
		                $numfilas = $result->num_rows;
		                if($numfilas>0){
		                $echo.= '<script>
		                $(".slider-2-container").backstretch([';
		                  for ($x=0,$y=1,$tipo="";$x<$numfilas;$x++) {
		                  	$fila = $result->fetch_object();
		                  	if($x==0)
		                  		$echo.='"'.$host.'../panel/uploads/galeria_MoFuSS/'.$fila->nombre.'"';
		                  	else
		                  		$echo.= ',"'.$host.'../panel/uploads/galeria_MoFuSS/'.$fila->nombre.'"';
		               	}
		               	$echo.= '
		               	], {duration: 1000, fade: 750});
		               	</script>';
		               }
$echo.='

        <script>
$(\'.slider1\').bxSlider({
    slideWidth: 200,
    minSlides: 2,
    maxSlides: 3,
    slideMargin: 10
  });
         function curso(este){
          	var $form=$(document.createElement("form")).css({display:"none"}).attr("method","POST").attr("action",host+"curso.php");
			var $input=$(document.createElement("input")).attr("name","nombre").val(este.title);
			$form.append($input);
			$("body").append($form);
			$form.submit();
          }
        
	/*
	    Portfolio
	*/
	$(\'.CURSOS\').masonry({
		columnWidth: \'.box\', 
		itemSelector: \'.box\',
		transitionDuration: \'0.5s\'
	});
	
	$(\'.curso-a a\').on(\'click\', function(e){
		e.preventDefault();
		if(!$(this).hasClass(\'active\')) {
	    	$(\'.curso-a a\').removeClass(\'active\');
	    	var clicked_filter = $(this).attr(\'class\').replace(\'filter-\', \'\');
	    	$(this).addClass(\'active\');
	    	if(clicked_filter != \'all\') {
	    		$(\'.curso-b:not(.\' + clicked_filter + \')\').css(\'display\', \'none\');
	    		$(\'.curso-b:not(.\' + clicked_filter + \')\').removeClass(\'box\');
	    		$(\'.\' + clicked_filter).addClass(\'box\');
	    		$(\'.\' + clicked_filter).css(\'display\', \'block\');
	    		$(\'.CURSOS\').masonry();
	    	}
	    	else {
	    		$(\'.CURSOS > div\').addClass(\'box\');
	    		$(\'.CURSOS > div\').css(\'display\', \'block\');
	    		$(\'.CURSOS\').masonry();
	    	}
		}
	});
		$(window).on(\'resize\', function(){

        new WOW().init();});
	
	// image popup	
	$(\'.curso-b img\').magnificPopup({
		type: \'image\',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: \'The image could not be loaded.\',
			titleSrc: function(item) {
				return item.el.siblings(\'.curso-c\').find(\'h3\').text();
			}
		},
		callbacks: {
			elementParse: function(item) {				
				if(item.el.hasClass(\'portfolio-video\')) {
					item.type = \'iframe\';
					item.src = item.el.data(\'portfolio-video\');
				}
				else {
					item.type = \'image\';
					item.src = item.el.attr(\'src\');
				}
			}
		}
	});
/*
	    Image popup (home latest work)
	*/
	$(\'.view-work\').magnificPopup({
		type: \'image\',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: \'The image could not be loaded.\',
			titleSrc: function(item) {
				return item.el.parent(\'.work-bottom\').siblings(\'img\').attr(\'alt\');
			}
		},
		callbacks: {
			elementParse: function(item) {
				item.src = item.el.attr(\'href\');
			}
		}
	});

$(document).ready(function(){


        new WOW().init();
    });
	
        </script>
        ';
return $echo;
}
?>
