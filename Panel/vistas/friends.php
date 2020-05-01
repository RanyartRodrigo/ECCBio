<?php
include "../base.php";  
include "../host.php";            
                $obj=new Base("localhost","root","global");
?>


        <!-- Page Title
        <div class="page-title-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow fadeIn">
                        <i class="fa fa-users"></i>
                        <h1>Friends /</h1>
                    </div>
                </div>
            </div>
        </div>-->
        <!-- Latest work -->
        <div class="">
	        <div class="container">
	        	<!--<div class="row">
		            <div class="col-sm-12 work-title wow fadeIn">
		                <h2>Friends</h2>
		            </div>
	            </div>-->
	            <div class="row">
	            	<?php
                		$result =$obj->consulta("SELECT * FROM amigos");
		                $numfilas = $result->num_rows;
		                  for ($x=0,$y=1,$tipo="";$x<$numfilas;$x++) {
		                  	$fila = $result->fetch_object();
		                  	echo '
		                  		<div class="col-sm-3">
		                			<div class="friends wow fadeInUp">
		                    			<img src="'.$host.'uploads/amigos/'.$fila->img.'" alt="Lorem Website" data-at2x="'.$host.'uploads/amigos/'.$fila->img.'">
		                    			<p>'.$fila->titulo.'</p>
		                    			<a class="big-link-1" href="'.$fila->url.'"><i class="fa fa-link"></i></a>
		                			</div>
								</div>
		                  		';
		               	}
		            ?>
	            </div>
	        </div>
        </div>
       <script>
$(document).ready(function(){
        new WOW().init();
    });
/*
	    Image popup (home latest work)
	*/
	$('.view-work').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: 'The image could not be loaded.',
			titleSrc: function(item) {
				return item.el.parent('.work-bottom').siblings('img').attr('alt');
			}
		},
		callbacks: {
			elementParse: function(item) {
				item.src = item.el.attr('href');
			}
		}
	});
	
        </script>

