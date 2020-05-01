

<?php
    include '../base.php';
    $base=new Base("localhost","root","conabio");
    $paises=getd($base);
    if(isset($_GET['callback'])){ // Si es una petición cross-domain  
//        echo $_GET['callback'].'('.json_encode($paises).')';
        echo $paises;
    }
    else{ // Si es una normal, respondemos de forma normal  
        //echo json_encode($paises);
		echo $paises;
    }
function back($base){
        $result =$base->consulta("SELECT nombre from galeria");
        $numfilas = $result->num_rows;
        for($x=0;$x<$numfilas;$x++){
                $fila = $result->fetch_object();
                $back=$fila->nombre;
        }
        return "http://www.mofuss.unam.mx/Mapps/Conabio/uploads/galeria/".$back."?".rand(1,10000);
}
function comercials(){
	$echo='<div id="comercials">';
        $imagen=array('semarnat.jpg','conanp.jpg','undp.png','gef.png','resiliencia.png');
        $titulo=array('SEMARNAT','CONANP','UNDP','GEF','RESILIENCIA');
        $url=array('','Mexico','','','','');
        for($x=1;$x<6;$x++)
                $echo.='<div class="comercials" onclick="cambiar(this.title)" title="'.$url[$x-1].'">
                                        <img src="http://www.mofuss.unam.mx/Mapps/Conabio/img/'.$imagen[$x-1].'" alt="Image" class="img-responsive"/>
                                </div>';
        return $echo.'</div>';
}

function menuSlide(){
	$echo='<div id="menu">';
	$imagen=array('inicio.png','clima.png');
                                        $titulo=array('Inicio','Mapa interactivo');
                                        $descripcion=array('conabio','conabio/Mexico');                                        $url=array('','Mexico','');
	for($x=1;$x<3;$x++)
		$echo.='<div class="elemento" onclick="cambiar(this.title)" title="'.$url[$x-1].'">
                                        <p>'.$titulo[$x-1].'</p>
                                        <a href="'.$descripcion[$x-1].'"><img src="http://www.mofuss.unam.mx/Mapps/Conabio/img/'.$imagen[$x-1].'" alt="Image" class="img-responsive"/></a>
                                </div>';
	return $echo.'</div>';				
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
    $echo.='<div class="grafica" id="myDiv"></div>';
    $echo.='<script>
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
                setTimeout(function(){cargarT1();},5000);
            </script>';
    return $echo;
}
function background($base){
	$echo='<div id="slide">
			<h1>Explorador de cambio climático</h1>
			<div class="descripcion">
				El Explorador de cambio climatico permite visualizar y consultar de manera interactiva los patrones de temperatura y precipitacion en Mexico con el fin de poder analizar y evaluar las tendencias climaticas historicas
y los cambios proyectados. La informacion presentada permite establecer una perspectiva clara que apoya la toma de desicionn informada para responder a preguntas relacionadas con la diversidad biologica y el cambio climatico.

los dato se presentan de manera geoespacial. Estos se pueden consultar por area nacional protegida y de manera personalizada. Toda la informacion disponible se puede descargar.

			</div>';
        $echo.=menuSlide();
        $echo.='
		</div>
		<script>
			var imageBackground=[
			';
	$result =$base->consulta("SELECT nombre from galeria");
	$numfilas = $result->num_rows;
	for($x=0;$x<$numfilas;$x++){
		$fila = $result->fetch_object();
		$back=$fila->nombre;
		if(($numfilas-1)==$x)
			$echo.='"http://www.mofuss.unam.mx/Mapps/Conabio/uploads/galeria/'.$back.'"';
                else
                        $echo.='"http://www.mofuss.unam.mx/Mapps/Conabio/uploads/galeria/'.$back.'",';
	}
	$echo.='
			];
			var indexB=0;
			function slide(){
				if(indexB==imageBackground.length)indexB=0;
				$("#slide").attr("style","background:url(\'"+imageBackground[indexB]+"\')");
				indexB++;
				setTimeout(function(){
				$("#slide").attr("style",$("#slide").attr("style")+";opacity:0.5");
				slide();},4000);
			}
			setTimeout(function(){slide();},1000);
		</script>
		';
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
        $echo.'		
		<script>
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

                         };
                         var trace4 = {
                          x: [1, 2, 3, 4],
                          y: [-1, Math.random()*3, -3, Math.random()*(-4)],
                          name: "Trace4",
                          type: "bar",
                          orientation:"h"

                         };
                    }
                setTimeout(function(){cargarT2();},5000);
		</script>
            ';
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
        ';
        return $echo;
}

function getd($base){
        include "../host.php";
$echo.='

<!DOCTYPE html>
<html lang="en"><head>
        <meta charset="iso-8859-1">
        <title>Pa&iacute;s | Biodiversidad Mexicana | Comisión Nacional para el Conocimiento y Uso de la Biodiversidad</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema Nacional de Monitoreo de Biodiversidad">
        <meta name="keywords" content="país, conabio, Conabio, CONABIO">
        <meta name="author" content="CONABIO">
        <meta name="robots" content="index,follow">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="shortcut icon" href="'.$host.'elate/assets/images/favicon/favicon.ico">
        <link href="'.$host.'elate/assets/bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Custom Fonts Setup via Font-face CSS3 -->
        <link rel="stylesheet" href="'.$host.'elate/assets/font-awesome/css/font-awesome.min.css" type="text/css">
        <script src="https://use.typekit.net/shb5zji.js"></script>
        <script>try {
                Typekit.load({async: true});
            } catch (e) {
            }</script>
        <link href="stylesheets/pace.preloader.css" rel="stylesheet">-->
        <link href="'.$host.'elate/assets/stylesheets/slidingmenu.css" rel="stylesheet">
        <link href="'.$host.'elate/assets/stylesheets/owl.carousel.css" rel="stylesheet">
        <link href="'.$host.'elate/assets/stylesheets/owl.theme.css" rel="stylesheet">
        <link href="'.$host.'elate/assets/stylesheets/magnific-popup.css" rel="stylesheet"> 
        <link href="'.$host.'elate/assets/stylesheets/salvattore.css" rel="stylesheet">

        <link href="'.$host.'elate/assets/stylesheets/styles.css" rel="stylesheet">
        <!-- Main Template Styles -->
        <link href="'.$host.'elate/assets/stylesheets/main.css" rel="stylesheet">
        <!-- Main Template Responsive Styles -->
        <link href="'.$host.'elate/assets/stylesheets/main-responsive.css" rel="stylesheet">
        <!-- Main Template Retina Optimizaton Rules -->
        <link href="'.$host.'elate/assets/stylesheets/main-retina.css" rel="stylesheet">
        <!-- LESS stylesheet for managing color presets -->
        <link href="'.$host.'elate/assets/less/color-pais.less" rel="stylesheet/less" type="text/css">
        <!-- LESS JS engine-->
        <script src="'.$host.'elate/assets/less/less-1.5.0.min.js" type="text/javascript"></script>
        <!-- Estilos personalizados CSS -->
        <link href="'.$host.'elate/assets/stylesheets/overide.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="bootstrap/js/html5shiv.js"></script>
          <script src="bootstrap/js/respond.min.js"></script>
        <![endif]-->

        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        <link href="http://www.mofuss.unam.mx/Mapps/Conabio/graficaSweet/dist/app-v1.css" rel="stylesheet">
        <script src="http://www.mofuss.unam.mx/Mapps/Conabio/graficaSweet/dist/app-v1.js"></script>
		<!-- <script type="text/javascript" src="assets/javascripts/scripts.js"></script>
        <script src="assets/javascripts/tooltip.js" type="text/javascript"></script>
        <link href="assets/stylesheets/tooltip.css" rel="stylesheet" type="text/css" /> -->
        <script type="text/javascript">
            function MM_preloadImages() { //v3.0
              var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
                var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
                if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
            }
            function MM_swapImgRestore() { //v3.0
              var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
            }
            
            function MM_findObj(n, d) { //v4.01
              var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
                d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
              if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
              for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
              if(!x && d.getElementById) x=d.getElementById(n); return x;
            }
            
            function MM_swapImage() { //v3.0
              var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
               if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
            }
        </script>
        <!-- Modernizr Library-->
        <script src="'.$host.'elate/assets/javascripts/modernizr.custom.js"></script>

        <script>
            jQuery(document).on(\'click\', \'.mega-dropdown\', function (e) {
                e.stopPropagation()
            })
        </script>
        
        <script>
            jQuery(document).on(\'click\', \'.big-dropdown\', function (e) {
                e.stopPropagation()
            })
            <!-- Modernizr JS -->
     	</script>
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


            <!-- Sliding Navigation : starts MENÃš-->
            <nav class="menu" id="sm">
                <div class="sm-wrap">
                    <i class="icon-remove menu-close"></i>
                    <a href="http://www.biodiversidad.gob.mx/index.html">Inicio</a>
                    <a href="http://www.biodiversidad.gob.mx/biodiversidad/biodiversidad.html">Biodiversidad</a>
                    <a href="http://www.biodiversidad.gob.mx/ecosistemas/ecosistemas.html">Ecosistemas</a>
                    <a href="http://www.biodiversidad.gob.mx/especies/especies.html">Especies</a>
                    <a href="http://www.biodiversidad.gob.mx/genes/genes.html">Genes</a>
                    <a href="http://www.biodiversidad.gob.mx/corredor/corredor.html">Corredor</a>
                    <a href="http://www.biodiversidad.gob.mx/region/region.html">Regi&oacute;n</a>
                    <a href="Mexico" class="s">Pa&iacute;s</a>
                    <a href="http://www.biodiversidad.gob.mx/planeta/planeta.html">Planeta</a>
                    <a href="http://www.biodiversidad.gob.mx/usos/usos.html">Usos</a>
                    <a href="http://www.paismaravillas.mx/index.html" target="_blank">Ni&ntilde;os</a>
                    <a href="http://www.gob.mx/conabio/archivo/prensa" target="_blank">Medios</a>
                    <a href="http://www.biodiversidad.gob.mx/index.html#recursos">Productos</a>
                    <a href="http://www.biodiversidad.gob.mx/index.html#actua">&iexcl;Conoce y act&uacute;a&excl;</a>
                </div>
                <!-- Navigation Trigger Button -->
                <div id="sm-trigger"></div>
            </nav>
            <!-- Sliding Navigation : ends MENÃš -->





            <!-- Master Wrap : starts -->
            <section id="mastwrap">





                <!-- masthead : starts HEADER -->
                <header id="masthead" class="masthead project-masthead clearfix">
                    <!-- container : starts -->
                    <section class="container">
                        <div class="row">
                            <article class="col-md-4 mob-center small-mob-left">
                                <a href="http://www.biodiversidad.gob.mx"><img title="" alt="Biodiversidad Mexicana" class="main-logo" src="'.$host.'elate/assets/images/logo.png"/></a>
                            </article>
                            <article class="col-md-8 text-right">
                                <ul class="main-nav text-right hidden-xs">
                                    <li><a class="name" href="https://www.gob.mx/conabio" target="_blank" >Comisi&oacute;n Nacional para el Conocimiento y Uso de la Biodiversidad</a></li><br>
                                    <li><a href="http://www.biodiversidad.gob.mx/index.html#eventos">Eventos</a></li>
                                    <li><a href="http://www.biodiversidad.gob.mx/index.html#temas">Temas</a></li>
                                    <li><a href="http://www.biodiversidad.gob.mx/index.html#recursos">Productos</a></li>
                                    <li><a href="http://www.biodiversidad.gob.mx/index.html#actua">&iexcl;Conoce y act&uacute;a&excl;</a></li>
                                    <li><a href="http://www.biodiversidad.gob.mx/index.html#contacto">Contacto</a></li>
                                    <li><a href="http://www.biodiversidad.gob.mx/v_ingles" class="name" title="English">EN</a></li>
                                </ul>

                                <div id="cse-search-form" style="width: 70%; display:inline-block;">Loading</div>
                                <script src="//www.google.com/jsapi" type="text/javascript"></script>

                            </article>
                        </div>
                    </section>
                    <!-- container : ends -->
                </header>
                <!-- masthead : ends HEADER -->





                <!-- page-section : starts -->
                <section id="project" class="project page-section">
    				<section class="inner-section project-info">
        ';
	$echo.=background($base);
	$echo.='
                                       <!-- container : starts -->
                                        <section class="container">



                                <!-- inner-section : starts -->
                                <section id="pageinfo" class="inner-section project-info">
                                        <!-- container : starts -->
                        <section class="container">
                            <div class="row"> 
        ';
        $echo.=comercials();
                $echo.='        
                              <p><strong>Ejemplo de tabla</strong> </p>
        ';
        $echo.=tabla3($base);
		$echo.='
			</div>
        </div>
        ';   
		$echo.=tabla1();
		$echo.=tabla2();
		$echo.='
		<div id="map"></div><div class="grafica" id="chart_div"></div>
            <br><br>
            </section>
	<div id= "temVSprec"> </div>
	<div id = "divSelectRan"></div>
	 <div><label id="tituloANP" ></label></div>          
  <!-- container : ends -->
		</section>
		<!-- inner-section : ends -->
        </section>
        <!-- page-section : ends -->
            <!-- page-section : starts FOOTER -->
            <footer id="mastfoot" class="mastfoot">

                <!-- inner-section : starts -->
                <section class="inner-section footer-bottom">

                    <!-- container : starts -->
                    <section class="container">

                        <div class="row">
                            <article class="col-md-6 text-left">
                                Liga Perif&eacute;rico - Insurgentes Sur, N&uacute;m. 4903, Col. Parques<br> 
                                del Pedregal, Delegaci&oacute;n Tlalpan, 14010, Ciudad de M&eacute;xico.<br>
                            </article>
                            <article class="col-md-6 text-right">
                                <div class="credits">
                                    <p>Copyright &copy; 2017 Conabio.</p>
                                </div>	
                            </article>
                        </div>

                    </section>

                </section>
                <!-- inner-section : ends -->

            </footer>
            <!-- page-section : ends FOOTER -->
        </section>
        <!-- Master Wrap : ends -->
<!-- jQuery -->
        <script src="'.$host.'elate/js/jquery.min.js"></script>
        <!-- Core JS Libraries -->
        <script src="'.$host.'elate/assets/bootstrap/js/jquery.js" type="text/javascript"></script>
        <script src="'.$host.'elate/assets/javascripts/jquery.easing.1.3.js" type="text/javascript"></script>
        <script src="'.$host.'elate/assets/bootstrap/js/bootstrap.js" ></script> 
        <!-- JS Plugins -->
        <script src="'.$host.'elate/assets/javascripts/pace.min.js"></script>
        <script src="'.$host.'elate/assets/javascripts/retina.js" ></script> 
        <script src="'.$host.'elate/assets/javascripts/classie.js" ></script> 
        <script src="'.$host.'elate/assets/javascripts/jquery.superslides.min.js"></script>
        <script src="'.$host.'elate/assets/javascripts/slidingmenu.js" ></script> 
        <script src="'.$host.'elate/assets/javascripts/jquery.touchSwipe.js"></script>
        <script src="'.$host.'elate/assets/javascripts/owl.carousel.js"></script>
        <script src="'.$host.'elate/assets/javascripts/jquery.mixitup.js"></script>
        <script src="'.$host.'elate/assets/javascripts/jquery.magnific-popup.js"></script> 
        <script src="'.$host.'elate/assets/javascripts/jquery.tweet.js"></script>
        <script src="'.$host.'elate/assets/javascripts/jquery.stellar.js"></script>
        <script src="'.$host.'elate/assets/javascripts/smooth-scroll.js"></script>
        <script src="'.$host.'elate/assets/javascripts/jquery.appear.js"></script>
        <script src="'.$host.'elate/assets/javascripts/flexslider.js" ></script> 
        <script src="'.$host.'elate/assets/javascripts/prettyPhoto.js" ></script> 
        <script src="'.$host.'elate/assets/javascripts/waypoints.min.js"></script>
        <!-- JS Custom Codes --> 
        <script src="'.$host.'elate/assets/javascripts/portfolio.js" ></script> 
        <script src="'.$host.'elate/assets/javascripts/form-validation.js" ></script> 
        <script src="'.$host.'elate/assets/javascripts/main.js" ></script>
        
    </body>
	</script>
	<!-- End demo purposes only -->

	<!-- Main JS (Do not remove) -->
	<script src="'.$host.'elate/js/main.js"></script>
    <script>
        setTimeout(function(){

        },2000); 
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
	initMap();
        </script>
</html>';
return $echo;
}
?>


