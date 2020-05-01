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
                        <h1>People /</h1>
                    </div>
                </div>
            </div>
        </div>
-->
        <?php
        $result = $obj->consulta( "SELECT * FROM personas where graduado!=true order by prioridad ASC");
  	$numfilas = $result->num_rows;
        ?>
        <!-- Meet Our Team -->
        <div class="contenedor-clase">
        	<div class="container">
	            <div class="row">
	            	<div class="col-sm-12 filters people-a wow fadeInLeft">
	            				                <?php
		          
		                $result2 =$obj->consulta("SELECT tipo FROM personas where graduado!=true group by tipo");
		                $numfilas2 = $result2->num_rows;
		                echo '<a href="#" class="filter-all active">All</a>/';
		                  for ($x=0,$y=1,$tipo="";$x<$numfilas2;$x++) {
		                  	$fila = $result2->fetch_object();
		                  	echo '
		               		<a href="#" class="filter-'.str_replace(" ","-",$fila->tipo).'">'.$fila->tipo.'</a>/
		                  	';
     }
     ?>
	            	</div>
	            </div>

	            <div class="row">
      <div class="col-sm-12 wow fadeIn PEOPLE">

	            	<?php
	            	 	for ($x=0;$x<$numfilas;$x++) {
      						$fila = $result->fetch_object();
        					echo '	                
        					<div class="box people-b '.str_replace(" ","-",$fila->tipo).'">
		                		<div class="box-container wow fadeInDown">';
						if ($fila->img!="")
		                    		echo '<img src="'.$host.'uploads/personas/'.$fila->img.'" alt="" data-at2x="'.$host.'uploads/personas/'.$fila->img.'">';
		                    		else
						 echo '<img src="assets/img/testimonials/unam.png" alt="" data-at2x="assets/img/testimonials/unam.png">';
						echo '<h3>'.$fila->nombre.' '.$fila->apellido.'</h3>
		                    		<p>'.$fila->locacion.'</p>
		                    		<p>'.$fila->descripcion.'</p>
		                    		<div class="team-social">		                        
		                        	<p><i class="fa fa-envelope"></i>  '.$fila->contacto.'</p>
		                    		</div>
		                		</div>
	                		</div>
        					';
     					}
     				?>	            	
</div>
	            </div>
	        </div>
        </div>

       <script>
	$('.PEOPLE').masonry({
		columnWidth: '.box', 
		itemSelector: '.box',
		transitionDuration: '0.5s'
	});
	
	$('.people-a a').on('click', function(e){
		e.preventDefault();
		if(!$(this).hasClass('active')) {
	    	$('.people-a a').removeClass('active');
	    	var clicked_filter = $(this).attr('class').replace('filter-', '');
	    	$(this).addClass('active');
	    	if(clicked_filter != 'all') {
	    		$('.people-b:not(.' + clicked_filter + ')').css('display', 'none');
	    		$('.people-b:not(.' + clicked_filter + ')').removeClass('box');
	    		$('.' + clicked_filter).addClass('box');
	    		$('.' + clicked_filter).css('display', 'block');
	    		$('.PEOPLE').masonry();
	    	}
	    	else {
	    		$('.PEOPLE > div').addClass('box');
	    		$('.PEOPLE > div').css('display', 'block');
	    		$('.PEOPLE').masonry();
	    	}
		}
	});
	$(window).on('resize', function(){
        new WOW().init();
	$('.PEOPLE').masonry(); });
	
</script>

