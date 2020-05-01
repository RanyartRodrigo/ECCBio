<?php
$host="http://www.wegp.unam.mx/admin/Conabio/elate/";
?>
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
        <!-- Standard Favicon--> 
        <link rel="shortcut icon" href="<?php echo $host; ?>assets/images/favicon/favicon.ico">

        <!-- Bootstrap CSS Files -->
        <link href="<?php echo $host; ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Custom Fonts Setup via Font-face CSS3 -->
        <link rel="stylesheet" href="<?php echo $host; ?>assets/font-awesome/css/font-awesome.min.css" type="text/css">
        <script src="https://use.typekit.net/shb5zji.js"></script>
        <script>try {
                Typekit.load({async: true});
            } catch (e) {
            }</script>

        <!-- CSS files for plugins 
        <link href="stylesheets/pace.preloader.css" rel="stylesheet">-->
        <link href="<?php echo $host; ?>assets/stylesheets/slidingmenu.css" rel="stylesheet">
        <link href="<?php echo $host; ?>assets/stylesheets/owl.carousel.css" rel="stylesheet">
        <link href="<?php echo $host; ?>assets/stylesheets/owl.theme.css" rel="stylesheet">
        <link href="<?php echo $host; ?>assets/stylesheets/magnific-popup.css" rel="stylesheet"> 
        <link href="<?php echo $host; ?>assets/stylesheets/salvattore.css" rel="stylesheet">

        <link href="<?php echo $host; ?>assets/stylesheets/styles.css" rel="stylesheet">
        <!-- Main Template Styles -->
        <link href="<?php echo $host; ?>assets/stylesheets/main.css" rel="stylesheet">
        <!-- Main Template Responsive Styles -->
        <link href="<?php echo $host; ?>assets/stylesheets/main-responsive.css" rel="stylesheet">
        <!-- Main Template Retina Optimizaton Rules -->
        <link href="<?php echo $host; ?>assets/stylesheets/main-retina.css" rel="stylesheet">
        <!-- LESS stylesheet for managing color presets -->
        <link href="<?php echo $host; ?>assets/less/color-pais.less" rel="stylesheet/less" type="text/css">
        <!-- LESS JS engine-->
        <script src="<?php echo $host; ?>assets/less/less-1.5.0.min.js" type="text/javascript"></script>

        <!-- Estilos personalizados CSS -->
        <link href="<?php echo $host; ?>assets/stylesheets/overide.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="bootstrap/js/html5shiv.js"></script>
          <script src="bootstrap/js/respond.min.js"></script>
        <![endif]-->

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
        <script src="<?php echo $host; ?>assets/javascripts/modernizr.custom.js"></script>

        <script>
            jQuery(document).on('click', '.mega-dropdown', function (e) {
                e.stopPropagation()
            })
        </script>
        
        <script>
            jQuery(document).on('click', '.big-dropdown', function (e) {
                e.stopPropagation()
            })
        </script>

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
                <a href="http://www.biodiversidad.gob.mx/pais/pais.html" class="s">Pa&iacute;s</a>
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
                            <a href="http://www.biodiversidad.gob.mx"><img title="" alt="Biodiversidad Mexicana" class="main-logo" src="<?php echo $host; ?>assets/images/logo.png"/></a>
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
                            <script type="text/javascript">
            google.load('search', '1', {language: 'es', style: google.loader.themes.DEFAULT});
            google.setOnLoadCallback(function () {
                var customSearchOptions = {};
                var orderByOptions = {};
                orderByOptions['keys'] = [{label: 'Relevance', key: ''}, {label: 'Date', key: 'date'}];
                customSearchOptions['enableOrderBy'] = true;
                customSearchOptions['orderByOptions'] = orderByOptions;
                var customSearchControl = new google.search.CustomSearchControl('008095775353890783041:h-_r2kr0x5u', customSearchOptions);
                customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
                var options = new google.search.DrawOptions();
                options.enableSearchboxOnly('https://www.google.com/cse?cx=008095775353890783041:h-_r2kr0x5u', null, true);
                options.setAutoComplete(true);
                customSearchControl.draw('cse-search-form', options);
            }, true);
                            </script>

                        </article>
                    </div>
                </section>
                <!-- container : ends -->
            </header>
            <!-- masthead : ends HEADER -->





            <!-- page-section : starts -->
            <section id="project" class="project page-section">
                <!-- inner-section : starts -->
                <section id="pagetitle" class="inner-section page-head project-head">
                    <!-- container : starts -->
                    <section class="container">
                        <div class="row">
                            <article class="col-md-12 text-left">
                                <h1 class="white">Cambio climático</h1>
                                <div class="liner liner-dark"></div>
                            </article>
                        </div>
                    </section>
                    <!-- container : ends -->
                </section>
                <!-- inner-section : ends -->







                <nav id="sectionmenu" class="navbar navbar-default navbar-planeta">
                    <div class="container-fluid">

                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <!--<a class="navbar-brand" href="#">Brand</a>-->
                        </div>


                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                            <ul class="nav navbar-nav">
                            	<li class="big-dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pa&iacute;s <span class="caret"></span></a>
									<ul class="dropdown-menu big-dropdown-menu row">
										<li class="col-sm-4">
											<ul>
												<li class="dropdown-header">Conceptos</li>
												<li><a href="quees.html">¿Qu&eacute; es un pa&iacute;s megadiverso?</a></li>
												<li><a href="prioridades.html">Prioridades globales</a></li>
												<li><a href="riquezanat.html">Riqueza natural</a></li>
												<li><a href="riquezacul.html">Riqueza cultural</a></li>
												<li><a href="capitalNatMex.html">Capital Natural de M&eacute;xico (Segundo Estudio de Pa&iacute;s)</a></li>
												<li><a href="EstudioPais.html" class="menulatopcion">Primer Estudio de Pa&iacute;s</a></li>
											</ul>
										</li>
										<li class="col-sm-4">
											<ul>
												<li class="dropdown-header">Conocimiento y uso</li>
												<li><a href="pdf/FQ003_Anexo_Politicas_Publicas.pdf" target="_blank">Pol&iacute;ticas p&uacute;blicas hacia la sustentabilidad</a></li>
												<li class="text-indent">Estrategias Nacionales</li>
												<li class="text-indent"><a href="ENBM.html">Biodiversidad</a></li>
												<li class="text-indent"><a href="EMCV.html">Para la Conservaci&oacute;n Vegetal 2012 - 2030</a></li>
												<li class="text-indent"><a href="http://www.biodiversidad.gob.mx/especies/Invasoras/estrategia.html">Especies Invasoras</a></li>
												<li><a href="MexCapacidades.html">Capacidades</a></li>
												<li><a href="http://www.conabio.gob.mx/institucion/snib/doctos/acerca.html" target="_blank">Sistema Nal. de Informaci&oacute;n sobre Biodiversidad</a></li>
												<li><a href="vaciosyom.html" class="menulatopcion">Vac&iacute;os y omisiones en conservaci&oacute;n</a></li>
												<li><a href="http://incendios1.conabio.gob.mx/" target="_blank">Sistema de alerta de incendios</a></li>
												<li><a href="http://www.biodiversidad.gob.mx/pais/cobertura_suelo/">Monitoreo de la cobertura de suelo</a></li>
												<li><a href="http://www.biodiversidad.gob.mx/sistema_monitoreo/">Sistema Nacional de Monitoreo de la Biodiversidad</a></li>
												<li><a href="mares/index.html">Mares mexicanos</a></li>
												<li><a href="cien_casos/cien_casos.php">Patrimonio natural de M&eacute;xico Cien casos de &eacute;xito</a></li>
												<li><a href="<?php echo $host; ?>region/geoinformacion.html">Geoinformaci&oacute;n</a></li>
											</ul>
										</li>
										<li class="col-sm-4">
											<ul>
												<li class="dropdown-header">Para conocer m&aacute;s</li>
												<li><a href="bibliografia.html">Bibliograf&iacute;a</a></li>
												<li><a href="sitiosweb.html">Sitios Web</a></li>
											</ul>
										</li>
											
									</ul>
								</li>
								
								<li class="big-dropdown">
									<a href="#" class="dropdown-toggle sub" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cambio climático <span class="caret"></span></a>
									  	<ul class="dropdown-menu big-dropdown-menu row">
											<li class="col-sm-6">
												<ul>
													<li><a href="">Tema 1</a></li>
													<li><a href="">Tema 2</a></li>
													<li><a href="">Tema 3</a></li>
													<li><a href="">Tema 4</a></li>
													<li><a href="">Tema 5</a></li>
													<li><a href="">Tema 6</a></li>
												</ul>
											</li>
											<li class="col-sm-6">
												<ul>
													<li><a href="#rv">Tema 7</a></li>
													<li><a href="#mediateca">Tema 8</a></li>
													<li><a href="#oculus">Tema 9</a></li>
													<li><a href="#smartphone">Tema 10</a></li>
													<li><a href="#desktop">Tema 11</a></li>
												</ul>
											</li>		
										</ul>
								</li>
								
								
							</ul>



                        </div><!-- /.navbar-collapse -->

                    </div><!-- /.container-fluid -->
                </nav>


                <!-- inner-section : starts -->
                <section id="pageima" class="inner-section features-wrap">
                    
                    <div class="row">
						<!-- testimonial-carousel : starts -->
						<div class="col-lg-12 col-sm-12 videor">
							<!--VIDEO O IMAGEN-->
						
							<div class="video-resposive">
							<iframe src="https://www.youtube.com/embed/qgF3f6ORLcw?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
					
							</div>
						
						
						</div>
					</div>

                    <nav class="breadcrumb">
                        <a class="breadcrumb-item" href="<?php echo $host; ?>index.html">Inicio</a>
                        <a class="breadcrumb-item" href="pais.html">Pais</a>
                        <span class="breadcrumb-item active">Cambio climático</span>
                    </nav>



                </section>
				<!-- inner-section : ends -->
				
				
				<!-- inner-section : starts INTRODUCCIÓN-->
				<section class="inner-section project-info">
					<!-- container : starts -->
					<section class="container">                         
                        <div class="row">
                            <article class="col-md-12 col-sm-12 project-det texto_snmb">	
                          		<h4 class="sub-heading">Contenido en una columna</h4>
                          		<p><b>Lorem Ipsum</b> es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.</p>
							</article>
						</div>
					</section>
				</section>
				
				

				<!-- inner-section : starts -->
				<section id="pageinfo" class="inner-section project-info">
					<!-- container : starts -->
                    <section class="container">
                       
                        <div class="row">

                            <article class="col-md-8 col-sm-8 project-det texto_snmb">
                          		<h4 class="sub-heading">Primera columna de contenidos</h4>
                                <h1 class="sub-heading">Título h1</h1>
                                <h2 class="sub-heading">Título h2</h2>
                                <h3 class="sub-heading">Título h3</h3>
                                <h4 class="sub-heading">Título h4</h4>
                                <h5 class="sub-heading">Título h5</h5>
                                <h6 class="sub-heading">Título h6</h6>
                                
                          <p>P&aacute;rrafo cupcake ipsum dolor sit. Amet tart brownie caramels donut oat cake jujubes jelly. Wafer caramels dessert cupcake jelly <a href="">candy gingerbread</a> candy canes. Pie biscuit tiramisu bear claw dessert cake.</p>
                            <h5>Ejemplo de unordered list</h5>
                            <ul>
                            	<li><p>List element</p></li>
                                <li><p>List element</p></li>
                                <li><p>List element</p></li>
                            </ul>
                            <h5>Ejemplo de ordered list</h5>
                            <ol>
                            	<li><p>List element</p></li>
                                <li><p>List element</p></li>
                                <li><p>List element</p></li>
                            </ol>
                            
                          
                          <p><strong>Ejemplo de tabla</strong> </p>
                          
                          <table class="tabla" width="100%" cellpadding="0" cellspacing="0">
                          	<tr>
                            	<th>table heading</th>
                                <th>table heading</th>
                                <th>table heading</th>
                            </tr>
                          	<tr>
                            	<td>table content</td>
                                <td>table content</td>
                                <td>table content</td>
                            </tr>
                            <tr>
                            	<td>table content</td>
                                <td>table content</td>
                                <td>table content</td>
                            </tr>
                            <tr>
                            	<td>table content</td>
                                <td>table content</td>
                                <td>table content</td>
                            </tr>
                          </table>
                          
                          <br><br>
                          <p><strong>Ejemplo de acordeón</strong> </p>
                          
                          <div class="panel-group" id="accordion">
							  <div class="panel panel-default">
								<div class="panel-heading">
								  <h3 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
									Collapsible Group 1</a>
								  </h3>
								</div>
								<div id="collapse1" class="panel-collapse collapse in">
								  <ul class="list-group">
									  <li class="list-group-item">One</li>
									  <li class="list-group-item">Two</li>
									  <li class="list-group-item">Three</li>
								</ul>
								</div>
							  </div>
							  <div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
									Collapsible Group 2</a>
								  </h4>
								</div>
								<div id="collapse2" class="panel-collapse collapse">
								  <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
								  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
								  minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
								  commodo consequat.</div>
								</div>
							  </div>
							  <div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
									Collapsible Group 3</a>
								  </h4>
								</div>
								<div id="collapse3" class="panel-collapse collapse">
								  <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
								  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
								  minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
								  commodo consequat.</div>
								</div>
							  </div>
						</div>
                          
                          <button type="button" class="btn btn-default btn-lg">Bot&oacute;n</button>
                          <button type="button" class="btn btn-default">Bot&oacute;n</button>
                          <button type="button" class="btn btn-default btn-sm">Bot&oacute;n</button>
                          <button type="button" class="btn btn-default btn-xs">Bot&oacute;n</button>
                          <br>
                          
                          <h4>Video</h4>
                          
                          <div class="embed-responsive embed-responsive-16by9">
                          	<iframe src="https://player.vimeo.com/video/176198892"> </iframe> 
                          </div>
                          <p>*Utiliza una clase de bootstrap 3.3.7 que hay que incluir en este css</p>
                          
                          <h4>Fotos</h4>
                          <img src="<?php echo $host; ?>assets/images/planeta/cites/2CGL1746-Phoenicopterus-rub.jpg" class="img-responsive" alt="">
                          <p class="small text-center">Pie de foto <a href="">con enlace</a></p>
                            
                            <h4>Men&uacute; de fotos</h4>
                            
                            <div id="grid" data-columns>
									<div class="column size-1of4">
										<a href="">
											<div><img src="<?php echo $host; ?>assets/images/usos/01-maices.jpg"></div>
											<div class="item_info"><p>Ma&iacute;ces</p></div>
										</a>
										
										<a href="">
											<div><img src="<?php echo $host; ?>assets/images/usos/05-chiles.jpg"></div>
											<div class="item_info"><p>Chiles</p></div>
										</a>

									</div>
									
									<div class="column size-1of4">
										<a href="<?php echo $host; ?>alimentacion/calabaza.html">
											<div><img src="<?php echo $host; ?>assets/images/usos/02-calabaza.jpg"></div>
											<div class="item_info"><p>Calabazas y chilacayotes</p></div>
										</a>
											
										<a href="<?php echo $host; ?>alimentacion/aguacate.html">
											<div><img src="<?php echo $host; ?>assets/images/usos/06-aguacate.jpg"></div>
											<div class="item_info"><p>Aguacate</p></div>
										</a>
											
									</div>
									
									<div class="column size-1of4">
										<a href="<?php echo $host; ?>alimentacion/frijol.html">
											<div><img src="<?php echo $host; ?>assets/images/usos/03-frijol.jpg"></div>
											<div class="item_info"><p>Frijol</p></div>
										</a>
										<a href="<?php echo $host; ?>alimentacion/tomate.html">
											<div><img src="<?php echo $host; ?>assets/images/usos/07-tomates.jpg"></div>
											<div class="item_info"><p>Tomate</p></div>
										</a>
										
									</div>
									
									<div class="column size-1of4">
										<a href="<?php echo $host; ?>alimentacion/jitomate.html">
											<div><img src="<?php echo $host; ?>assets/images/usos/04-jitomate.jpg"></div>
											<div class="item_info"><p>Jitomate</p></div>
										</a>
										
										<a href="<?php echo $host; ?>alimentacion/quelites.html">
											<div><img src="<?php echo $host; ?>assets/images/usos/08-quelites.jpg"></div>
											<div class="item_info"><p>Quelites</p></div>
										</a>
										
 									</div>
								</div>

                            </article>

                            <article class="col-md-4 col-sm-4 project-det pad">
                            	<h4 class="sub-heading">Segunda columna de contenidos</h4>
                                <a href="http://cop13.mx/" target="_blank"><img src="<?php echo $host; ?>assets/images/l_conabio2.png" class="center-block"></a>
                                <h4 class="sub-heading"><a href="<?php echo $host; ?>cbd.html">CBD</a></h4>
                                <ul>
                                	<li><p><a href="<?php echo $host; ?>cop.html">COP</a></p></li>
                                    <li><p><a href="<?php echo $host; ?>secretaria_ejecutiva.html">Secretar&iacute;a Ejecutiva</a></p></li>
                                    <li><p><a href="<?php echo $host; ?>sbstta.html">SBSTTA</a></p></li>
                                    <li><p><a href="<?php echo $host; ?>sbi.html">SBI</a></p></li>
                                    <li><p><a href="<?php echo $host; ?>grupos_adhoc.html">Grupos <em>ad hoc</em></a></p></li>
                                    <li><p><a href="<?php echo $host; ?>programas_tematicos.html">Programas tem&aacute;ticos</a></p></li>
                                    <li><p><a href="<?php echo $host; ?>temas_transversales.html">Temas transversales</a></p></li>
                                    <li><p><a href="<?php echo $host; ?>protocolos_cbd.html">Protocolos del CBD</a></p></li>
                                    <li><p><a href="<?php echo $host; ?>plan_estrategico.html">Plan estrat&eacute;gico 2011-2020</a></p></li>                                   <li><p><a href="<?php echo $host; ?>implementacion_cbd_mex.html">Implementaci&oacute;n en M&eacute;xico</a></p></li>
                                </ul>
                                
                                <hr>
                                
                                <a href="http://www.cbd.int/" target="_blank"><img src="<?php echo $host; ?>assets/images/l_conafor.png" class="center-block"></a>
                                
                                <hr>
                                
                                <a href="http://www.cbd.int/cop/" target="_blank"><img src="<?php echo $host; ?>assets/images/l_pnud.png" ></a><br>
                                <p class="text-center">Para m&aacute;s informaci&oacute;n sobre las <br> 
                              <a href="http://www.cbd.int/cop/" target="_blank">Conferencias de las Partes (CoP)</a> </p>
                            </article>

                        </div>


                        <article class="col-sm-12 col-md-12">
                        	<div class="row add-top-half add-bottom-half">
                            	<h4 class="sub-heading">Tercera columna o pseudo-footer</h4>
                                <p>Se utiliza en algunas secciones para colocar logos u otros contenidos:</p>
                            	
                            	<div class="col-md-4 col-sm-4 mob-add-bottom">
                            		<a href="http://www.gob.mx/conabio" target="_blank"><img src="<?php echo $host; ?>assets/images/l_conabio2.png" class="center-block"></a>
                            	</div>

								<div class="col-md-4 col-sm-4 mob-add-bottom">         
                                	<a href="https://www.cbd.int/chm" target="_blank"><img src="<?php echo $host; ?>assets/images/l_conafor.png" class="center-block"></a>
                                </div>
                                
                            

                            	<div class="col-md-4 col-sm-4 mob-add-bottom">
                                	<a href="http://cop13.mx" target="_blank"><img src="<?php echo $host; ?>assets/images/l_pnud.png" class="center-block"></a>
                                </div>
                         	</div>
                        </article>
                            

                    </section>
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


        <!-- Core JS Libraries -->
        <script src="<?php echo $host; ?>assets/bootstrap/js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo $host; ?>assets/javascripts/jquery.easing.1.3.js" type="text/javascript"></script>
        <script src="<?php echo $host; ?>assets/bootstrap/js/bootstrap.js" ></script> 
        <!-- JS Plugins -->
        <script src="<?php echo $host; ?>assets/javascripts/pace.min.js"></script>
        <script src="<?php echo $host; ?>assets/javascripts/retina.js" ></script> 
        <script src="<?php echo $host; ?>assets/javascripts/classie.js" ></script> 
        <script src="<?php echo $host; ?>assets/javascripts/jquery.superslides.min.js"></script>
        <script src="<?php echo $host; ?>assets/javascripts/slidingmenu.js" ></script> 
        <script src="<?php echo $host; ?>assets/javascripts/jquery.touchSwipe.js"></script>
        <script src="<?php echo $host; ?>assets/javascripts/owl.carousel.js"></script>
        <script src="<?php echo $host; ?>assets/javascripts/jquery.mixitup.js"></script>
        <script src="<?php echo $host; ?>assets/javascripts/jquery.magnific-popup.js"></script> 
        <script src="<?php echo $host; ?>assets/javascripts/jquery.tweet.js"></script>
        <script src="<?php echo $host; ?>assets/javascripts/jquery.stellar.js"></script>
        <script src="<?php echo $host; ?>assets/javascripts/smooth-scroll.js"></script>
        <script src="<?php echo $host; ?>assets/javascripts/jquery.appear.js"></script>
        <script src="<?php echo $host; ?>assets/javascripts/flexslider.js" ></script> 
        <script src="<?php echo $host; ?>assets/javascripts/prettyPhoto.js" ></script> 
        <script src="<?php echo $host; ?>assets/javascripts/waypoints.min.js"></script>
        <!-- JS Custom Codes --> 
        <script src="<?php echo $host; ?>assets/javascripts/portfolio.js" ></script> 
        <script src="<?php echo $host; ?>assets/javascripts/form-validation.js" ></script> 
        <script src="<?php echo $host; ?>assets/javascripts/main.js" ></script> 

        <script src="http://biodiversidad.gob.mx/googleAnalytics.js"></script> 
        <!-- C&oacute;digo para estad&iacute;sticas en Google Analytics -->
        <script type="text/javascript">
            var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
            document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
        </script>
        <script type="text/javascript">
            try {
                var pageTracker = _gat._getTracker("UA-8226401-1");
                pageTracker._trackPageview();
            } catch (err) {
            }</script>
        <!-- Fin del c&oacute;digo para estad&iacute;sticas en Google Analytics -->

    </body>
</html>

