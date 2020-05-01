<?php
include '../base.php';
        $base=new Base("localhost","root","conabio");
	$paises=getd($base);
if(isset($_GET['callback'])){ // Si es una petición cross-domain  
					  echo $_GET['callback'].'('.json_encode($paises).')';
						}
					else{ // Si es una normal, respondemos de forma normal  
 					 echo json_encode($paises);
					}

//-------------------------------Escritorio---
function back($base){
        $result =$base->consulta("SELECT nombre from galeria");
        $numfilas = $result->num_rows;
        for($x=0;$x<$numfilas;$x++){
                $fila = $result->fetch_object();
                $back=$fila->nombre;
		}
        return "http://www.mofuss.unam.mx/Mapps/Conabio/uploads/galeria/".$back."?".rand(1,10000);
}
function tabla1(){
	$echo='';
	$variable=array('Temperatura','Precipitacion');
	$tiempo=array('Tiempo 1','Tiempo 2','Tiempo 3','Tiempo 4','Tiempo 5','Tiempo 6');
	$modelo=array('REA rcp 4.5','REA rcp 8.5');
	$ecoregiones=array('Ecorregion1','Ecorregion2','Ecorregion3');
	$echo.='<div class="sel"><label>variable</label><select id="variable">';
	for($x=0;$x<count($variable);$x++)
		$echo.='<option>'.$variable[$x].'</option>';
	$echo.='</select></div>';
        $echo.='<div class="sel"><label>tiempo</label><select id="tiempo">';
        for($x=0;$x<count($tiempo);$x++)
                $echo.='<option>'.$tiempo[$x].'</option>';
        $echo.='</select></div>';
        $echo.='<div class="sel"><label>modelo</label><select id="modelo">';
        for($x=0;$x<count($modelo);$x++)
                $echo.='<option>'.$modelo[$x].'</option>';
        $echo.='</select></div>';
        $echo.='<div class="sel"><label>ecoregiones</label><select id="ecoregiones">';
        for($x=0;$x<count($ecoregiones);$x++)
                $echo.='<option>'.$ecoregiones[$x].'</option>';
        $echo.='</select></div>';

	return $echo;
}
function tabla2(){
        $echo='';
        $variable=array('Temperatura','Precipitacion');
        $tiempo=array('Tiempo 1','Tiempo 2','Tiempo 3','Tiempo 4','Tiempo 5','Tiempo 6');
        $modelo=array('REA rcp 4.5','REA rcp 8.5');
        $ecoregiones=array('Ecorregion1','Ecorregion2','Ecorregion3');
        $echo.='<div class="sel"><label>Ecorregiones</label><select id="variable2">';
        for($x=0;$x<count($ecoregiones);$x++)
                $echo.='<option>'.$ecoregiones[$x].'</option>';
        $echo.='</select></div>';
        $echo.='<div class="sel"><label>tiempo</label><select id="tiempo2">';
        for($x=0;$x<count($tiempo);$x++)
                $echo.='<option>'.$tiempo[$x].'</option>';
        $echo.='</select></div>';
        $echo.='<div class="sel"><label>modelo</label><select id="modelo2">';
        for($x=0;$x<count($modelo);$x++)
                $echo.='<option>'.$modelo[$x].'</option>';
        $echo.='</select></div>';
        $echo.='<div class="sel"><label>vegetacion</label><select id="ecoregiones2">';
        for($x=0;$x<count($ecoregiones);$x++)
                $echo.='<option>'.$ecoregiones[$x].'</option>';
        $echo.='</select></div>';

        return $echo;
}
function tabla3($base){
	$result =$base->consulta("SELECT anio from migracion group by anio");
        $numfilas = $result->num_rows;
        for($x=0;$x<$numfilas;$x++){
                $fila = $result->fetch_object();
        	$tiempo[$x]=$fila->anio;
	}
	$result =$base->consulta("SELECT modelo from migracion group by modelo");
        $numfilas = $result->num_rows;
        for($x=0;$x<$numfilas;$x++){
                $fila = $result->fetch_object();
                $modelo[$x]=$fila->modelo;
        }
        $echo='';
        $echo.='<div class="sel"><label>tiempo</label><select id="tiempo3">';
        for($x=0;$x<count($tiempo);$x++)
                $echo.='<option>'.$tiempo[$x].'</option>';
        $echo.='</select></div>';
        $echo.='<div class="sel"><label>modelo</label><select id="modelo3">';
        for($x=0;$x<count($modelo);$x++)
                $echo.='<option>'.$modelo[$x].'</option>';
        $echo.='</select></div>';
        return $echo;
}

function getd($base){
        include "../host.php";
$echo.='
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Elate &mdash; 100% Free Fully Responsive HTML5 Template by FREEHTML5.co</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />
  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,400italic,700" rel="stylesheet" type="text/css">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="'.$host.'elate/css/animate.css">
	<!-- Icomoon Icon Fonts
	<link rel="stylesheet" href="'.$host.'elate/css/icomoon.css">
	 Simple Line Icons
	<link rel="stylesheet" href="'.$host.'elate/css/simple-line-icons.css"> -->
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="'.$host.'elate/css/magnific-popup.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="'.$host.'elate/css/bootstrap.css">
	<link rel="stylesheet" href="'.$host.'elate/css/style.php">

	<!-- Styleswitcher ( This style is for demo purposes only, you may delete this anytime. ) -->
	<link rel="stylesheet" id="theme-switch" href="'.$host.'elate/css/style.php">
	<!-- End demo purposes only -->


	

	<!-- Modernizr JS -->
	<script src="'.$host.'elate/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="'.$host.'elate/js/respond.min.js"></script>
	<![endif]-->
	<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
                                <link href="http://www.mofuss.unam.mx/Mapps/Conabio/graficaSweet/dist/app-v1.css" rel="stylesheet">
                                <script src="http://www.mofuss.unam.mx/Mapps/Conabio/graficaSweet/dist/app-v1.js"></script>

	</head>
	<body>
	<header role="banner" id="fh5co-header">
			<div class="container">
				<!-- <div class="row"> -->
			    <nav class="navbar navbar-default">
		        <div class="navbar-header">
		        	<!-- Mobile Toggle Menu Button -->
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
		         <a class="navbar-brand" href="index.html">CONABIO</a> 
		        </div>
		        <div id="navbar" class="navbar-collapse collapse">
		          <ul class="nav navbar-nav navbar-right">
		            <li class="active"><a href="#" data-nav-section="home"><span>Inicio</span></a></li>
		            <li><a href="#" data-nav-section="work"><span>Cambio Climatico</span></a></li>
		            <li><a href="#" data-nav-section="testimonials"><span>Conectividad</span></a></li>
		            <li><a href="#" data-nav-section="services"><span>Enlaces de Interes</span></a></li>
		            <li><a href="#" data-nav-section="about"><span>About</span></a></li>
		            <li><a href="#" data-nav-section="contact"><span>Contact</span></a></li>
		          </ul>
		        </div>
			    </nav>
			  <!-- </div> -->
		  </div>
	</header>

	<section id="fh5co-home" data-section="home" style="background-image: url('.back($base).');" data-stellar-background-ratio="0.5">
		<div class="gradient"></div>
		<div class="container">
			<div class="text-wrap">
				<div class="text-inner">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<h1 class="to-animate">CONABIO</h1>
							<h2 class="to-animate">La Estrategia Nacional sobre Biodiversidad de México (ENBioMex) es un conjunto de objetivos, líneas estratégicas y acciones requeridas para la conservación y el uso sustentable de la biodiversidad en México.La Estrategia Nacional sobre Biodiversidad de México (ENBioMex) es un conjunto de objetivos, líneas estratégicas y acciones requeridas para la conservación y el uso sustentable de la biodiversidad en México.</a></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="slant"></div>
	</section>

	<section id="fh5co-intro">
		<div class="container">
			<div class="row row-bottom-padded-lg">
				';
					$imagen=array('inicio.png','clima.png','conectividad.png');
                                        $titulo=array('Inicio','Cambio Climatico','Conectividad');
                                        $descripcion=array('Inicio','Cambio Climatico','Conectividad');
                                        $url=array('','Mexico','');
					for($x=1;$x<4;$x++)
					$echo.= '<div class="fh5co-block to-animate" style="background-image: url(http://www.mofuss.unam.mx/Mapps/Conabio/img/'.$imagen[$x-1].');">
							<div class="overlay-darker"></div>
							<div class="overlay"></div>
							<div class="fh5co-text">
								<i class="fh5co-intro-icon icon-bulb"></i>
								<h2>'.$titulo[$x-1].'</h2>
								<p>'.$descripcion[$x-1].'</p>
								<p><a href="http://www.wegp.unam.mx/conabio/'.$url[$x-1].'" class="btn btn-primary">Ir</a></p>
							</div>
						</div>';
				
			$echo.='</div>
			<div class="row watch-video text-center to-animate">
				<span>Watch the video</span>

				<a href="https://youtu.be/1H-kY7xkKl0" class="popup-vimeo btn-video"><i class="icon-play2"></i></a>
			</div>
		</div>
	</section>

	<section id="fh5co-work" data-section="work">
		<div class="container">
			<div class="row">
				<div class="col-md-12 section-heading text-center">
					<h2 class="to-animate"></h2>
					<div class="row">
						<div class="col-md-8 col-md-offset-2 subtext to-animate">
							<h3>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</h3>
						</div>
					</div>
				</div>
			</div>
			<div class="row row-bottom-padded-sm">
				';
					$imagen=array('conabio.jpg','IBUNAM.gif','conanp.jpg','resiliencia.png');
                                        $titulo=array('CONABIO','Instituto de Biologia UNAM','CONANP','RESILIENCIA');
                                        $url=array('','Mexico','','');
					for($x=1;$x<5;$x++)
					$echo.= '<div class="col-md-4 col-sm-6 col-xxs-12 enlaces">
							<a href="'.$url[$x-1].'" class="fh5co-project-item image-popup to-animate">
								<img src="http://www.mofuss.unam.mx/Mapps/Conabio/img/'.$imagen[$x-1].'" alt="Image" class="img-responsive">
								<div class="fh5co-text">
									<h2>'.$titulo[$x-1].'</h2>
									<span>Branding</span>
								</div>
							</a>
						</div>';
				
			$echo.='</div>
			<div class="row">
				<div class="col-md-12 text-center to-animate">
					<p>* Demo images from <a href="http://plmd.me/" target="_blank">plmd.me</a></p>
				</div>
			</div>
		</div>
	</section>

	<section id="fh5co-testimonials" data-section="testimonials">
		<div class="container">
			<div class="row">
				<div class="col-md-12 section-heading text-center">
					<h2 class="to-animate">Grafica 1</h2>
			</div>
			<div class="row">
				';
				$echo.=tabla1();	
				$echo.='
				<div class="grafica" id="myDiv"><!-- Plotly chart will be drawn inside this DIV --></div>
			</div>
		</div>
	</section>


	<section id="fh5co-services" data-section="services">
		<div class="container">
			<div class="row">
				<div class="col-md-12 section-heading text-left">
					<h2 class=" left-border to-animate">Grafica 2</h2>
					<div class="row">
						<div class="col-md-8 subtext to-animate">
							<h3>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</h3>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				';
				$echo.=tabla2();
				$echo.='
				<div class="grafica" id="myDiv2"><!-- Plotly chart will be drawn inside this DIV --></div>
			</div>
		</div>
	</section>
	
	<section id="fh5co-about" data-section="about">
		<div class="container">
			<div class="row">
				<div class="col-md-12 section-heading text-center">
					<h2 class="to-animate">Grafica 3</h2>
					<div class="row">
						<div class="col-md-8 col-md-offset-2 subtext to-animate">
							<h3>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</h3>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				';
                                $echo.=tabla3($base);
				$echo.='
<div id="myDiv3"></div>
                                <script>
                                        function cargarT3(tiempo,modelo){
                                        $.ajax({
                                                url : "http://www.mofuss.unam.mx/Mapps/Conabio/graficaSweet/grafica.php",
                                                dataType : "jsonp",
                                                data: {
                                                        t:tiempo,
                                                        m:modelo,
                                                        format: "json"
                                                },
                                                type:"POST",
                                                success: function(json) {
                                                        var id="myDiv3";
                                                        $("#"+id).html("");
                                                        $("#"+id).html(json);
                                                }
                                        });
                                        }
                                        setTimeout(function(){cargarT3($("#tiempo3").val(),$("#modelo3").val());},4000);
                                </script>
			</div>
		</div>
	</section>
	
	<section id="fh5co-counters" style="background-image: url('.back($base).');" data-stellar-background-ratio="0.5">
		<div class="fh5co-overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 section-heading text-center to-animate">
					<h2>Grafica N</h2>
				</div>
                        </div>
			<div class="row">
				';
                                        
				$echo.='
			</div>
		</div>
	</section>

	<section id="fh5co-contact" data-section="contact">
		<div class="container">
			<div class="row">
				<div class="col-md-12 section-heading text-center">
					<h2 class="to-animate">Get In Touch</h2>
					<div class="row">
						<div class="col-md-8 col-md-offset-2 subtext to-animate">
							<h3>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</h3>
						</div>
					</div>
				</div>
			</div>
			<div class="row row-bottom-padded-md">
				<div class="col-md-6 to-animate">
					<h3>Contact Info</h3>
					<ul class="fh5co-contact-info">
						<li class="fh5co-contact-address ">
							<i class="icon-home"></i>
							5555 Love Paradise 56 New Clity 5655, <br>Excel Tower United Kingdom
						</li>
						<li><i class="icon-phone"></i> (123) 465-6789</li>
						<li><i class="icon-envelope"></i>info@freehtml5.co</li>
						<li><i class="icon-globe"></i> <a href="http://freehtml5.co/" target="_blank">freehtml5.co</a></li>
					</ul>
				</div>

				<div class="col-md-6 to-animate">
					<h3>Contact Form</h3>
					<div class="form-group ">
						<label for="name" class="sr-only">Name</label>
						<input id="name" class="form-control" placeholder="Name" type="text">
					</div>
					<div class="form-group ">
						<label for="email" class="sr-only">Email</label>
						<input id="email" class="form-control" placeholder="Email" type="email">
					</div>
					<div class="form-group ">
						<label for="phone" class="sr-only">Phone</label>
						<input id="phone" class="form-control" placeholder="Phone" type="text">
					</div>
					<div class="form-group ">
						<label for="message" class="sr-only">Message</label>
						<textarea name="" id="message" cols="30" rows="5" class="form-control" placeholder="Message"></textarea>
					</div>
					<div class="form-group ">
						<input class="btn btn-primary btn-lg" value="Send Message" type="submit">
					</div>
					</div>
				</div>

			</div>
		</div>
		<div id="map" class="to-animate"></div>
	</section>
	
	
	<footer id="footer" role="contentinfo">
		<a href="#" class="gotop js-gotop"><i class="icon-arrow-up2"></i></a>
		<div class="container">
			<div class="">
				<div class="col-md-12 text-center">
					<p>&copy; Elate Free HTML5. All Rights Reserved. <br>Created by <a href="http://freehtml5.co/" target="_blank">FREEHTML5.co</a> Images: <a href="http://pexels.com/" target="_blank">Pexels</a>, <a href="http://plmd.me/" target="_blank">plmd.me</a></p>
					
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<ul class="social social-circle">
						<li><a href="#"><i class="icon-twitter"></i></a></li>
						<li><a href="#"><i class="icon-facebook"></i></a></li>
						<li><a href="#"><i class="icon-youtube"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	


	
	<!-- jQuery -->
	<script src="'.$host.'elate/js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="'.$host.'elate/js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="'.$host.'elate/js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="'.$host.'elate/js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="'.$host.'elate/js/jquery.stellar.min.js"></script>
	<!-- Counter -->
	<script src="'.$host.'elate/js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="'.$host.'elate/js/jquery.magnific-popup.min.js"></script>
	<script src="'.$host.'elate/js/magnific-popup-options.js"></script>
	<!-- Google Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="'.$host.'elate/js/google_map.js"></script>

	<!-- For demo purposes only styleswitcher ( You may delete this anytime ) -->
	<script src="'.$host.'elate/js/jquery.style.switcher.js"></script>
	<script>
		$(function(){
			$("#colour-variations ul").styleSwitcher({
				defaultThemeId: "theme-switch",
				hasPreview: false,
				cookie: {
		          	expires: 30,
		          	isManagingLoad: true
		      	}
			});	
			$(".option-toggle").click(function() {
				$("#colour-variations").toggleClass("sleep");
			});
		});
	</script>
	<!-- End demo purposes only -->

	<!-- Main JS (Do not remove) -->
	<script src="'.$host.'elate/js/main.js"></script>
<script>
function cargarT1(){
var trace1 = {
  x: [1, 2, 3, 4],
  y: [10, Math.random()*15, 13, Math.random()*17],
  type: "scatter"
};
var trace2 = {
  x: [1, 2, 3, 4],
  y: [Math.random()*16, 5, 11, Math.random()*9],
  type: "scatter"
};
var trace3 = {
  x: [1, 2, 3, 4],
  y: [11, 4, Math.random()*12, Math.random()*9],
  type: "scatter"
};

var data = [trace1, trace2,trace3];
Plotly.newPlot("myDiv", data);
}

function cargarT2(){

var trace1 = {
  y: [1, 2, 3,4],
  x: [Math.random()*1, 4, Math.random()*9, 16],
  name: "Trace1",
  type: "bar",
  orientation:"h"
};
var trace2 = {
  y: [1, 2, 3, 4],
  x: [6, -8, Math.random()*4.5, Math.random()*8],
  name: "Trace2",
  type: "bar",
  orientation:"h"

};
var trace3 = {
  y: [1, 2, 3, 4],
  x: [Math.random()*(-15), -3, Math.random()*4.5, -8],
  name: "Trace3",
  type: "bar",
  orientation:"h"

 }
 var trace4 = {
  x: [1, 2, 3, 4],
  y: [-1, Math.random()*3, -3, Math.random()*(-4)],
  name: "Trace4",
  type: "bar",
  orientation:"h"

 }

var data = [trace1, trace2, trace3, trace4];
var layout = {
  xaxis: {title: "X axis"},
  yaxis: {title: "Y axis"},
  barmode: "relative",
  title: "Relative Barmode"
};
Plotly.newPlot("myDiv2", data, layout);
}

setTimeout(function(){    
var trace1 = {
  x: [1, 2, 3, 4], 
  y: [10, 15, 13, 17], 
  type: "scatter"
};
var trace2 = {
  x: [1, 2, 3, 4], 
  y: [16, 5, 11, 9], 
  type: "scatter"
};
var trace3 = {
  x: [1, 2, 3, 4],
  y: [11, 4, 12, 9],
  type: "scatter"
};

var data = [trace1, trace2,trace3];
Plotly.newPlot("myDiv", data);
var trace1 = {
  y: [1, 2, 3, 4],
  x: [1, 4, 9, 16],
  name: "Guadalajara",
  type: "bar",
  orientation:"h"
};
var Morelia = {
  y: [1, 2, 3, 4],
  x: [6, -8, -4.5, 8],
  name: "Morelia",
  type: "bar",
  orientation:"h"

};
var trace3 = {
  y: [1, 2, 3, 4],
  x: [-15, -3, 4.5, -8],
  name: "Queretaro",
  type: "bar",
  orientation:"h"

 }
 
 var trace4 = {
  x: [1, 2, 3, 4],
  y: [-1, 3, -3, -4],
  name: "CDMX",
  type: "bar",
  orientation:"h"

 }
 
var data = [trace1, Morelia, trace3, trace4];
var layout = {
  xaxis: {title: "X axis"},
  yaxis: {title: "Y axis"},
  barmode: "relative",
  title: "Relative Barmode"
};
Plotly.newPlot("myDiv2", data, layout);
 },8000); 
$("#variable").change(function(){
cargarT1();
});
$("#variable2").change(function(){
cargarT2();
});
$("#tiempo").change(function(){
cargarT1();
});
$("#tiempo2").change(function(){
cargarT2();
});
$("#modelo").change(function(){
cargarT1();
});
$("#modelo2").change(function(){
cargarT2();
});
$("#ecoregion").change(function(){
cargarT1();
});
$("#ecoregion2").change(function(){
cargarT2();
});
$("#tiempo3").change(function(){
var tiempo=$("#tiempo3").val();
var modelo=$("#modelo3").val();
cargarT3(tiempo, modelo);
});
$("#modelo3").change(function(){
var tiempo=$("#tiempo3").val();
var modelo=$("#modelo3").val();
cargarT3(tiempo,modelo);
});


</script>
	</body>
</html>';
return $echo;
}
?>



