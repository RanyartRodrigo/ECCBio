<!DOCYPE html>
<html>
  <head>
    <title>MoFuSS</title>
    <link rel="import" href="/static/styles.html"> 
  </head>
  <body>
    <div id="loadingDiv" style="position:fixed; top:0; width: 100%; height: 100%; display:none; opacity:0.7; background-color:gray; z-index:1; vertical-align:middle;">
      <center><img src="/static/loading.gif" style="vertical-align: middle;"></center>
    </div>
   
        <div id="menu"></div>   
        <nav id="MenuPrincipal" class="navbar" role="navigation">
            <div class="container">
                <div class="navbar-header">                    
                    <a onclick="cargarContenido('/',this.title)" title="Home"><img class='icono' src='/static/assets/img/unam.png' /></a>
                </div>                
                <div class="collapse navbar-collapse" id="top-navbar-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li title="MDE M&eacute;xico" id="capa0">
                            <a onClick="agregarCapa('capa0','primero','0','tiff','MDE M&eacute;xico')" title="MDE M&eacute;xico"><i class="fa fa-home"></i><div class="miniSlideThree"><input type="checkbox" value="0" id="miniSlideThree" name="check" class="tiff"/><label ></label></div>MDE M&eacute;xico</a>
                        </li>
                        <li title="Biomasa M&eacute;xico" id="capa1">
                            <a onClick="agregarCapa('capa1','segundo','1','tiff','Biomasa M&eacute;xico')" title="Biomasa M&eacute;xico"><i class="fa fa-camera"></i><div class="miniSlideThree"><input type="checkbox" value="1" id="miniSlideThree" name="check" class="tiff"/><label ></label></div>Biomasa M&eacute;xico</a>
                        </li>
                        <li class="dropdown" title="submenu de capas">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" >
                                <i class="fa fa-users"></i>Municipios <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li title="Municipios de Michoac&aacute;n" id="capa2">
                                    <a onClick="agregarCapa('capa2','tercero','2','shape','Municipios de Michoac&aacute;n')" title="Municipios de Michoac&aacute;n"><i class="fa fa-users"></i><div class="miniSlideThree"><input type="checkbox" value="2" id="miniSlideThree" name="check" class="shape"/><label ></label></div>Michoac&aacute;n</a>
                                </li>
                                <li title="Municipios de M&eacute;xico" id="capa3">
                                    <a onClick="agregarCapa('capa3','cuarto','3','shape','Municipios de M&eacute;xico')" title="Municipios de M&eacute;xico"><i class="fa fa-tasks"></i><div class="miniSlideThree"><input type="checkbox" value="3" id="miniSlideThree" name="check" class="shape"/><label ></label></div>M&eacute;xico</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown" title="sub menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000">
                                <i class="fa fa-search"></i>Models <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li class="" title=" capa 4"><a  onClick="agregarCapa('capa4','sexto')" title="Research"><i class="fa fa-search"></i><div class="miniSlideThree"><input type="checkbox" value="capa4" id="miniSlideThree" name="check" /><label ></label></div>capa4</a></li>
                                <li class=""><a  onClick="agregarCapa('capa5','septimo')" title="Models"><i class="fa fa-search"></i><div class="miniSlideThree"><input type="checkbox" value="capa5" id="miniSlideThree" name="check" /><label ></label></div>capa5</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000">
                                <i class="fa fa-newspaper-o"></i>Publications <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a  onClick="agregarCapa('capa6','segundo')" title="Outreach"><i class="fa fa-play"></i><div class="miniSlideThree"><input type="checkbox" value="capa6" id="miniSlideThree" name="check" /><label ></label></div>capa6</a></li>
                                <li><a  onClick="agregarCapa('capa8','tercero')" title="Publications"><i class="fa fa-newspaper-o"></i><div class="miniSlideThree"><input type="checkbox" value="capa8" id="miniSlideThree" name="check" /><label ></label></div>capa8</a></li>
                            </ul>
                        </li>
                        <li><a  onClick="agregarCapa('capa9','primero')" title="Friends"><i class="fa fa-user"></i><div class="miniSlideThree"><input type="checkbox" value="capa9" id="miniSlideThree" name="check" /><label ></label></div>capa9</a></li>
                    </ul>
                </div>
            </div>
        </nav>        	                               
        <div id="capas" style="display:none;">
            <h3>Tiff</h3>
            <div id="primero">
            </div>
            <div id="segundo">
            </div>
        </div>
        <div id="infoMap"  style="display:none;">
            <h3 id="TitleInfo">Shape</h3>
            <div id="tercero">
            </div>
            <div id="cuarto">
            </div>
            <div id="sexto">
            </div>
            <div id="septimo">
            </div>
            <div id="octavo">
            </div>
            <div id="noveno">
            </div>
        </div>
        <div id="banner"><img src="/static/assets/img/google-logo-map.png" class="logos"/><img src="/static/assets/img/gee-logo-map.png" class="logos"/><p class="organization">Lanase</p><p class="organization">UNAM</p>
          <button id="playStop" type="button" class="btn btn-info">
 	    			<span id="playStopIcon" class="glyphicon glyphicon-play"></span> <b id="playStopText">Play</b>
          </button>
        </div>


        <script>
					var mapa="{{ mapa }}";
					var zoom={{ zoom }};
					var maxZoom={{ maxZoom }};
					var lat={{ lat }};
					var lng={{ lng }};
				</script>
	<script src="https://maps.google.com/maps/api/js?key={{ key }}"></script>
	<link rel="import" href="/static/scripts.html">		
  </body>
</html>

