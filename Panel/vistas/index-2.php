<?php
$paises=getd();
if(isset($_GET['callback'])){ // Si es una petición cross-domain  
					  echo $_GET['callback'].'('.json_encode($paises).')';
						}
					else{ // Si es una normal, respondemos de forma normal  
 					 echo json_encode($paises);
					}










function getd(){
$echo='<script src="http://www.mofuss.unam.mx/Mapps/Global/assets/js/jquery.scrolly.min.js"></script>
<script src="http://www.mofuss.unam.mx/Mapps/Global/assets/js/jquery.scrollex.min.js"></script>
<script src="http://www.mofuss.unam.mx/Mapps/Global/assets/js/skel.min.js"></script>
<script src="http://www.mofuss.unam.mx/Mapps/Global/assets/js/util.js"></script>
<script src="http://www.mofuss.unam.mx/Mapps/Global/assets/js/main.js"></script>
<link rel="stylesheet" href="http://www.mofuss.unam.mx/Mapps/Global/assets/css/main.php" />';
include "../host.php";
include "../base.php";
                $obj=new Base("localhost","root","cursos");
           
                $obj->setBase("global");
                                        $result =$obj->consulta("SELECT * FROM galeria ORDER BY RAND() limit 3");
                                                        $numfilas = $result->num_rows;
                                                        for ($x=0;$x<$numfilas;$x++) {
                                        $fila = $result->fetch_object();
				if($x==0)
				$echo.= '<style>
					#banner{ background-image: url('.$host.'uploads/galeria/'.$fila->nombre.') !important;}
				</style>';
				if($x==1)
                                $img=$host.'uploads/galeria/'.$fila->nombre;
				if($x==2)
                                $echo.= '<style>
                                        #more{   background-attachment: fixed;
background-attachment: fixed;
    background-position: center top;
    background-size: cover;
 background-image:  url('.$host.'assets/css/img/overlay.png), url('.$host.'uploads/galeria/'.$fila->nombre.')!important;}
                                </style>';



			}
$echo.='
		<!-- Header -->
			<header id="header" class="alt">
				
				<!--<a href="#menu">Country</a>-->
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">';
						$obj->setBase("global");
						$result =$obj->consulta("SELECT * FROM paises order by nombre ASC");
                         $numfilas = $result->num_rows;
			
                                for ($x=0;$x<$numfilas;$x++) {
                                        $fila = $result->fetch_object();
                                        $echo.= '
						<li><a onClick="MapOf(\''.$fila->nombreURL.'\')" href="#">'.$fila->nombreURL.'</a></li>
					';
                                    }
					
					$echo.='
				</ul>
			</nav>

		<!-- Banner -->
			<section id="banner">
				<div class="inner">
					<header>
						<h1>Wood-Energy Geospatial Portal</h1>
						<p>This site is mostly dedicated to traditional wood-energy, here you can: <br /> 
					<span class="violet">Display</span>, 
					<span class="violet">Query</span> and 
					<span class="violet">Export</span> results from world-wide and country-specific maps from various studies <br />
                    <span class="violet">Run personalized simulations</span> for specific countries of interest using our high-performance computing resources
                </p>
					</header>
					<a href="#" onClick="sides()"  class="button big scrolly">Get Started</a>
				</div>
			</section>

		<!-- Main -->
			<div id="main">

				<!-- Section -->
					<section class="wrapper style2">
						<div class="inner">
							<div class="flex flex-2">
<h3>Online and Onsite training curses</h3>							
';
						$obj->setBase("cursos");	
                					$result =$obj->consulta("SELECT * FROM cursos");
		                			$numfilas = $result->num_rows;
		                			for ($x=0,$y=1,$tipo="";$x<$numfilas;$x++) {
                                        $fila = $result->fetch_object();
                                        $echo.= '
									<div class="col col2">
									<h3>'.$fila->nombre.'</h3>
									<p>Etiam posuere hendrerit arcu, ac blandit nulla. Sed congue malesuada nibh, a varius odio vehicula aliquet. Aliquam consequat, nunc quis sollicitudin aliquet, enim magna cursus auctor lacinia nunc ex blandit augue. Ut vitae neque fermentum, luctus elit fermentum, porta augue. Nullam ultricies, turpis at fermentum iaculis, nunc justo dictum dui, non aliquet erat nibh non ex.</p>
									<p>Sed congue malesuada nibh, a varius odio vehicula aliquet. Aliquam consequat, nunc quis sollicitudin aliquet, enim magna cursus auctor lacinia nunc ex blandit augue. Ut vitae neque fermentum, luctus elit fermentum, porta augue. Nullam ultricies, turpis at fermentum iaculis, nunc justo dictum dui, non aliquet erat nibh non ex. </p>
									<a href="#" class="button">'.$fila->nombre.'</a>
								</div>
								<div class="col col1 first">
									<div class="image round fit">
										<a href="generic.html" class="link"><img  onclick="curso(this)" title="'.$fila->nombre.'"  src="'.$host.'../../newPage/panel/uploads/cursos/'.$fila->img.'" alt="" /></a>
									</div>
								</div>


											';
		               				}

						$echo.='
							</div>
						</div>
					</section>

				<!-- Section -->
					<section id ="more" class="wrapper style1">
						<div class="inner">
							<!-- 2 Columns -->
								<div class="flex flex-2">
									<div class="col col1">
										<div class="image round fit">
											<a href="generic.html" class="link"><img width="350px" height="350px" src="'.$img.'" alt="" /></a>
										</div>
									</div>
									<div class="col col2">
<a onclick="more()" class="button">What we know about woodfuel role in deforestation and forest degradation</a>

<div id="more2" class="mH">										
<h2>Statement on the relationship between woodfuel demand, deforestation and forest degradation</h2>
        <p>Identifying the causes of deforestation or forest degradationcan be difficult because there are many processes that contribute to it. For example, a stand of trees cleared for charcoal production one year may recover by natural regeneration. Recovery might be helped by good rainfall, or slowed by extended drought. Alternatively, regrowth might be hindered by herders setting fires to encourage grass growth or prevented altogether by farmers planting crops where the trees once stood. </p>
        <p>The GACC has supported extensive research into the relationships between woodfuel demand, deforestation,and forest degradation. We start by consideringdeforestation and forest degradationas separate processes.These terms have many definitions. Here we use basic generally applicable definitions from UN agencies, which considerdeforestationto be the “direct human-induced conversion of forested land to non-forested land,” and forest degradation as, “long-term reduction of the overall potential supply of benefits from the forest, which includes carbon, wood, biodiversity and other goods and services”. It is also important to acknowledge that much of the wood people cook with does not originate from forests, but from trees and shrubs found on other types of land such as open-canopy fields and rangelands, farms, roadsides, and private homesteads. </p>
        <p>The evidence produced by GACC-sponsoredresearch, supported by many other studies, indicates that woodfuel demand alone rarely drives deforestation, although it may serve a facilitating role in conjunction with other processes. For example agricultural expansion is often the root cause of deforestation and, inmanyinstances, woodfuels are supplied as by-products when land is cleared for farming.In these cases,reducingwoodfuel demand is unlikely to affect deforestationrates. On the other hand, woodfuel demand does, in some circumstances, contribute to forest degradation. This occurs when wood is harvested more rapidly than the landscape vegetation can recover, and more often when first targeting preferred tree species.Reducing demand for woodfuel by promoting fuel switching or efficient woodstoves could reduce degradation and encourage forests to recover, along with improving the environmental services they provide.</p>
   
<h1>Further reading:</h1><p>
<li>Bailis, R., et al., The Carbon Footprint of Traditional Woodfuels. Nature Climate Change, 2015.</li>

<li>Drigo, R. "WISDOM Case Studies". 2017; Available at: www.wisdomprojects.net/global/cs.asp.</li>

<li>Geist, H.J. and E.F. Lambin, Proximate Causes and Underlying Driving Forces of Tropical Deforestation. BioScience, 2002. 52(2): p. 143-151.</li>

<li>Ghilardi, A., et al., Spatiotemporal modeling of fuelwood environmental impacts: towards an improved accounting of non-renewable biomass. Env.Modelling & Software, 2016. 82: p. 241-254.</li>

<li>Hosonuma, N., et al., An assessment of deforestation and forest degradation drivers in developing countries.Environmental Research Letters, 2012. 7(4): p. 044009.</li>

<li>Masera, O.R., et al., Environmental Burden of Traditional Bioenergy Use. Annual Review of Environment and Resources, 2015. 40(1): p. 121–150.</li>
</p>
</div>

									</div>
								</div>
						</div>
					</section>

				
				

			</div>	
';
			$paises='';
                                                $obj->setBase("global");
                                                $result =$obj->consulta("SELECT * FROM paises order by nombre ASC");
                         $numfilas = $result->num_rows;
			 $paises.='<ul>';
                                for ($x=0;$x<$numfilas;$x++) {
                                        $fila = $result->fetch_object();
                                        $paises.= '
                                                <li style="background-image:url('.$host.'uploads/paises/'.$fila->bandera.');"><p onClick="MapOf(\''.$fila->nombreURL.'\')">'.$fila->nombre.'</p></li>
                                        ';
                                    }
                          $paises.='</ul>';
$echo.='
                        <div id="Simulaciones" class="noS"><h3>Run Simulations</h3><p>Descripcion</p><div class="galeria"></div></div>
                        <div id="Results" class="noR"><h3>Display Results</h3><p>Select any available country or region to display and query geospatial information on wood energy. </p><div class="galeria">'.$paises.'</div></div>

		<!-- Footer -->
			<footer id="footer">
				<div class="copyright">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						
					</ul>
	
				</div>
			</footer>
<script>
function more(){
$("#more2").toggleClass("mH");
}
function sides(){
$("#Results").toggleClass("noR");
$("#Simulaciones").toggleClass("noS");

}
$("#Results").on("click",function(){sides();});
$("#Simulaciones").on("click",function(){sides();});

 </script>
';
return $echo;
}

function getd2(){
$echo='';
include "../host.php";
include "../base.php";              
                $obj=new Base("localhost","root","cursos");
                $obj->setBase("global");
                                                $result =$obj->consulta("SELECT * FROM galeria ORDER BY RAND()");
                                $numfilas = $result->num_rows;
                                if($numfilas>0){
                                  for ($x=0,$y=1,$tipo="";$x<$numfilas;$x++) {
                                        $fila = $result->fetch_object();
                                        if($x==0)
                                                $echo.='<script> $("#Wall").attr("style","background-image:url('.$host.'uploads/galeria/'.$fila->nombre.'");</script>';
                              }
                               }

$echo.='
        <!-- Slider 2 -->
        <div class="slider-2-container">
            <div class="container">
                <div class="row">
                    <div class=" col-sm-offset-2 slider-2-text wow fadeInUp">
                        <div><h1><span class="violet">Wood-Energy Geospatial Portal</span></h1></div>
	            		<div><p>This site is mostly dedicated to traditional wood-energy, here you can:</p></div>
                        <div><p><span class="violet">Display</span>, <span class="violet">Query</span> and <span class="violet">Export</span> results from world-wide and country-specific maps from various studies</p></div>
                    	<div><p><span class="violet">Run personalized simulations</span> for specific countries of interest using our high-performance computing resources</p></div>
                    	<div><a class="big-link-1" onclick="readMore()">Read more</a></div>
			<img src="http://www.mofuss.unam.mx/Mapps/Global/uploads/galeria_Paises/101.jpg" class="globalAliance">
                    </div>
                </div>
            </div>
        </div>
<script>function readMore(){
window.scrollTo(0, 0);
$("#readMore").toggleClass("hidden");
}</script>
        <!-- Services -->
<div class="non hidden" id="readMore">
	<button onClick="readMore()">X</button>
	<h2>Statement on the relationship between woodfuel demand, deforestation and forest degradation</h2>
        <div class="tercio semiobscuro"><p>Identifying the causes of deforestation or forest degradationcan be difficult because there are many processes that contribute to it. For example, a stand of trees cleared for charcoal production one year may recover by natural regeneration. Recovery might be helped by good rainfall, or slowed by extended drought. Alternatively, regrowth might be hindered by herders setting fires to encourage grass growth or prevented altogether by farmers planting crops where the trees once stood. </p></div>
        <div class="tercio obscuro"><p>The GACC has supported extensive research into the relationships between woodfuel demand, deforestation,and forest degradation. We start by consideringdeforestation and forest degradationas separate processes.These terms have many definitions. Here we use basic generally applicable definitions from UN agencies, which considerdeforestationto be the “direct human-induced conversion of forested land to non-forested land,” and forest degradation as, “long-term reduction of the overall potential supply of benefits from the forest, which includes carbon, wood, biodiversity and other goods and services”. It is also important to acknowledge that much of the wood people cook with does not originate from forests, but from trees and shrubs found on other types of land such as open-canopy fields and rangelands, farms, roadsides, and private homesteads. </p></div>
        <div class="tercio semiobscuro"><p>The evidence produced by GACC-sponsoredresearch, supported by many other studies, indicates that woodfuel demand alone rarely drives deforestation, although it may serve a facilitating role in conjunction with other processes. For example agricultural expansion is often the root cause of deforestation and, inmanyinstances, woodfuels are supplied as by-products when land is cleared for farming.In these cases,reducingwoodfuel demand is unlikely to affect deforestationrates. On the other hand, woodfuel demand does, in some circumstances, contribute to forest degradation. This occurs when wood is harvested more rapidly than the landscape vegetation can recover, and more often when first targeting preferred tree species.Reducing demand for woodfuel by promoting fuel switching or efficient woodstoves could reduce degradation and encourage forests to recover, along with improving the environmental services they provide.</p></div>
   
    <div class="medio obscuro"><h1>Further reading:</h1><p>
<li>Bailis, R., et al., The Carbon Footprint of Traditional Woodfuels. Nature Climate Change, 2015.</li>

<li>Drigo, R. "WISDOM Case Studies". 2017; Available at: www.wisdomprojects.net/global/cs.asp.</li>

<li>Geist, H.J. and E.F. Lambin, Proximate Causes and Underlying Driving Forces of Tropical Deforestation. BioScience, 2002. 52(2): p. 143-151.</li>

<li>Ghilardi, A., et al., Spatiotemporal modeling of fuelwood environmental impacts: towards an improved accounting of non-renewable biomass. Env.Modelling & Software, 2016. 82: p. 241-254.</li>

<li>Hosonuma, N., et al., An assessment of deforestation and forest degradation drivers in developing countries.Environmental Research Letters, 2012. 7(4): p. 044009.</li>

<li>Masera, O.R., et al., Environmental Burden of Traditional Bioenergy Use. Annual Review of Environment and Resources, 2015. 40(1): p. 121–150.</li>
</p></div>

</div>
<div class="non">
<h2>Statement on the relationship between woodfuel demand, deforestation and forest degradation</h2>
        <div class="s2"><p>Identifying the causes of deforestation or forest degradationcan be difficult because there are many processes that contribute to it. For example, a stand of trees cleared for charcoal production one year may recover by natural regeneration. Recovery might be helped by good rainfall, or slowed by extended drought. Alternatively, regrowth might be hindered by herders setting fires to encourage grass growth or prevented altogether by farmers planting crops where the trees once stood. </p>
        <button onclick="readMore()">Read More</button></div>
	<div class="s2"><p>The GACC has supported extensive research into the relationships between woodfuel demand, deforestation,and forest degradation. We start by consideringdeforestation and forest degradationas separate processes.These terms have many definitions. Here we use basic generally applicable definitions from UN agencies, which considerdeforestationto be the “direct human-induced conversion of forested land to non-forested land,” and forest degradation as, “long-term reduction of the overall potential supply of benefits from the forest, which includes carbon, wood, biodiversity and other goods and services”. It is also important to acknowledge that much of the wood people cook with does not originate from forests, but from trees and shrubs found on other types of land such as open-canopy fields and rangelands, farms, roadsides, and private homesteads. </p>
        <button onclick="readMore()">Read More</button></div>    
	<div class="s2"><p>The evidence produced by GACC-sponsoredresearch, supported by many other studies, indicates that woodfuel demand alone rarely drives deforestation, although it may serve a facilitating role in conjunction with other processes. For example agricultural expansion is often the root cause of deforestation and, inmanyinstances, woodfuels are supplied as by-products when land is cleared for farming.In these cases,reducingwoodfuel demand is unlikely to affect deforestationrates. On the other hand, woodfuel demand does, in some circumstances, contribute to forest degradation. This occurs when wood is harvested more rapidly than the landscape vegetation can recover, and more often when first targeting preferred tree species.Reducing demand for woodfuel by promoting fuel switching or efficient woodstoves could reduce degradation and encourage forests to recover, along with improving the environmental services they provide.</p>
        <button onclick="readMore()">Read More</button></div>
</div>
        <div class="par" id="mapaD">
		<div id="mapa"></div>
<style>
#Wall>.par>#mapa {
filter: grayscale(53%) contrast(126%);
   width: 100%;
    height: 700px;
    margin: auto;
}
#bodyContent>img {
    width: 200px;
    height: 100px;
}
#firstHeading {
    width: 200px;
    height: 100px;
    border-radius: 20px;
    cursor:pointer;
}
</style>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDqra8J1Lim9w7fyULtxg5ZlGDa4LNesC0"></script>

<script>
var arrMarkers = {};
var nA=0;
var mapaST;
marcadores();
$("#mapa").hover(function(){clearTimeout(mapaST);},function(){marcadores();});
function marcadores(){
console.log("hola");
mapaST=setTimeout(function(){

new google.maps.event.trigger( arrMarkers[Math.floor(Math.random() * nA) - 1], "click" );
marcadores();
},2000);
}
$( window ).resize(function() {
  initMap();
});
/*setTimeout(function(){window.scrollTo(0, 0)},2000);
$( window ).scroll(function() {
var positionMapa=$("#mapaD").offset().top-$( document ).scrollTop()-($( window ).height()/2)+($( "#mapaD").height()/2);
var positionCurso=$("#curso").offset().top-$( document ).scrollTop()-($( window ).height()/2)+($( "#curso").height()/2);  
var positionMapaF=$("#mapaD").offset().top;
var positionCursoF=$("#curso").offset().top;
var marCurso=(positionCurso/positionCursoF)*100;
if(marCurso<0)marCurso=0;
$("#curso").attr("style","padding-left: "+marCurso+"%;opacity:"+(1-(marCurso/100))+";");

var marMapa=(positionMapa/positionMapaF)*100;
if(marMapa<0)marMapa=0;
$("#mapaD").attr("style","padding-left: "+marMapa+"%;opacity:"+(1-(marMapa/100))+";");

});*/
 var map;
      function initMap() {
	var index=0;
        map = new google.maps.Map(document.getElementById("mapa"), {
          zoom: 3,
          center: new google.maps.LatLng(0, 0),
          mapTypeId: "roadmap",
scrollwheel: false,
    navigationControl: false,
    mapTypeControl: false,
    scaleControl: true,
    draggable: true,
	  disableDefaultUI: true
        });
map.setOptions({ minZoom: 3, maxZoom: 15 });
initialBounds = new google.maps.LatLngBounds(
		new google.maps.LatLng(-65,-180),
		new google.maps.LatLng(65,180)
	);
	google.maps.event.addListener(map, "bounds_changed", function() {
		if (initialBounds.contains(map.getCenter())) return;
 		var c = map.getCenter(),
			 x = c.lng(),
			 y = c.lat(),
			 maxX = initialBounds.getNorthEast().lng(),
			 maxY = initialBounds.getNorthEast().lat(),
			 minX = initialBounds.getSouthWest().lng(),
			 minY = initialBounds.getSouthWest().lat();
	 	if (x < minX) x = minX;
	 	if (x > maxX) x = maxX;
		if (y < minY) y = minY;
		if (y > maxY) y = maxY;
		map.setCenter(new google.maps.LatLng(y, x));		
		printLog(initialBounds);
  });
        var iconBase = "'.$host.'uploads/paises/";';
                                                          $obj->setBase("global");
                                        $result =$obj->consulta("SELECT * FROM paises order by nombre ASC");
                                $numfilas = $result->num_rows;

 for ($x=0;$x<$numfilas;$x++) {
                                        $fila = $result->fetch_object();
                                       
                                               $echo.='var '.$fila->nombreURL.'= {url: iconBase + "'.$fila->bandera.'",nombre:"'.$fila->nombre.'",nombreURL:"'.$fila->nombreURL.'"};';

                                }

        $echo.='



var contentString = "<div id=\'content\'>"+
            "<div id=\'siteNotice\'>"+
            "</div>"+
            "<h2 id=\'firstHeading\' class=\'firstHeading\'>Uluru</h2>"+
            "<div id=\'bodyContent\'>"+
            "</div>"+
            "</div>";

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });


        function addMarker(feature) {
          var marker = new google.maps.Marker({
            position: feature.position,
	    title:feature.icon.nombreURL,
            icon:"http://www.mofuss.unam.mx/assets/img/rayo.png",
            map: map
          });
    arrMarkers[nA++] = marker;
          marker.addListener("click", function(e) {
infowindow.open(map, marker);
$("#firstHeading").html("");
var principal=$("#bodyContent").parent().parent().parent().parent();
principal.attr("style",principal.attr("style")+"background:url("+feature.icon.url+");background-size:100% 100%;");
$("#content").attr("onClick","MapOf(\'"+feature.icon.nombreURL+"\')");
  });

        }



        var features = [';
                                                
                                        $result =$obj->consulta("SELECT * FROM paises order by nombre ASC");
                                $numfilas = $result->num_rows;
                                
 for ($x=0;$x<$numfilas;$x++) {
                                        $fila = $result->fetch_object();
					if($x==$numfilas-1)                                        
						$echo.= '{
            							position: new google.maps.LatLng('.$fila->latitud.', '.$fila->longitud.'),
            							icon: '.$fila->nombreURL.'
          						}';
					else
                                                $echo.= '{
                                                                position: new google.maps.LatLng('.$fila->latitud.', '.$fila->longitud.'),
                                                                icon: '.$fila->nombreURL.'
                                                        },';

                                }
$echo.='
        ];

        for (var i = 0, feature; feature = features[i]; i++) {
          addMarker(feature);
        }
      }
setTimeout(function(){initMap();
setTimeout(function(){$("img[src=\'http://www.mofuss.unam.mx/assets/img/rayo.png\']").attr("class","cris");},1000);

},800);
</script>
';
		                    	
                                
	            $echo.='
	            
</div>
        <!-- Testimonials -->
        <div class="non" id="curso">
	        <div class="container">
	        	<div class="row">
		            <div class="col-sm-12 testimonials-title wow fadeIn">
		                <h2>Courses & training events</h2>
		            </div>
	            </div>
	            <div class="row">
	                <div class="col-sm-10 col-sm-offset-1 testimonial-list">
	                	<div role="tabpanel">
	                		<!-- Tab panes -->
	                		<div class="tab-content">
	                		';
						$obj->setBase("cursos");	
                					$result =$obj->consulta("SELECT * FROM cursos");
		                			$numfilas = $result->num_rows;
		                			$class="in active";
		                  			for ($x=0,$y=1,$tipo="";$x<$numfilas;$x++) {
                                                                $fila = $result->fetch_object();						
							$curso=$fila->id;	
							$img='';     
                                                        $result2 = $obj->consulta( "SELECT nombre FROM galeria_cursos where id_curso=".$curso);
                                                        $numfilas2 = $result2->num_rows;

                                                        for ($x2=0;$x2<$numfilas2;$x2++) {
                                                        $fila2 = $result2->fetch_object();
                                                        $img.='
                                    <img src="'.$host.'../../../panel/uploads/cursos/galeria/'.$fila2->nombre.'">
                                        ';
                                                }

		                  				
		                  				$y=$x+1;
		                  				if($y>1)
		                  					$class="";
		                  				$echo.='
	                						<div role="tabpanel" class="tab-pane fade '.$class.'" id="tab'.$y.'">
	                							<div class="testimonial-image">
	                								<img src="'.$host.'../../newPage/panel/uploads/cursos/'.$fila->img.'" alt="" data-at2x="'.$host.'../../newPage/panel/uploads/cursos/'.$fila->img.'">
	                							</div>
	                							<div class="testimonial-text">
									<h3>
									'.$fila->nombre.'
									
                                                                        <a class="big-link-1" onclick="curso(this)" title="'.$fila->nombre.'">Read more</a>
                                                                        </h3>
		                                			'.$img.'
		                					</div>
	                						</div>
		                  				';
		               				}
		            			
	                			$echo.='
	                		</div>
	                		<!-- Nav tabs -->
	                		<ul class="nav nav-tabs" role="tablist">
	                			';
		                			
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
        </div>';
$echo.='

        <script>
$(\'.slider1\').bxSlider({
    slideWidth: 200,
    minSlides: 2,
    maxSlides: 3,
    slideMargin: 10
  });


         function curso(este){
          	var $form=$(document.createElement("form")).css({display:"none"}).attr("method","POST").attr("action","'.$host.'../../newPage/MoFuSS/curso.php");
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
$(".bx-next").html("<i class=\'fa fa-arrow-circle-right\'></i>");
$(".bx-prev").html("<i class=\'fa fa-arrow-circle-left\'></i>");
    });
	function cargarSeccion(seccion){
$.ajax({
                url : "http://www.mofuss.unam.mx/Mapps/Global/seccion.php",
                dataType : "jsonp",
                data: {
                  seccion: seccion,
      format: "json"
    },
                type:"POST",
                success: function(json) {
                        $("#Wall").html(json);
    }
 });

}
        </script>
        ';



$obj->setBase("global");

                                        $country =$obj->consulta("SELECT * FROM paises order by nombre ASC");
                                $numfilas = $country->num_rows;
                                $paises='<div id="addPaises">';
 for ($x=0;$x<$numfilas;$x++) {
                                        $fila = $country->fetch_object();

                                       if($fila->bandera=="") $paises.= '<li onclick="MapOf(\''.$fila->nombreURL.'\')" id="'.$fila->nombreURL.'">'.$fila->nombre.'</li>';
else $paises.= '<li onclick="MapOf(\''.$fila->nombreURL.'\')" id="'.$fila->nombreURL.'">'.$fila->nombre.'<img src="'.$host.'uploads/paises/'.$fila->bandera.'"></li>';

                                }
$paises.='</div><script>$("#addPaises > *").appendTo(".Msecundario");</script>';


return $echo.$paises;
}
?>
