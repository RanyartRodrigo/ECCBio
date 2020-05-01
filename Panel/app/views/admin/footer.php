<?php 
	if(isset($_GET['part'])){
		$part=$_GET['part'];
		tourDE($part);
	} else {
		echo'
			<script>
				var elementosMuestra=[];
				var descripcionElementos=[];
			</script>
		';
	}
	function tourDe($part){
		echo '<script>';
		if($part=="country")country();	
		elseif($part=="columns")columns();
		elseif($part=="layers")layers();
		elseif($part=="panel")panel();
		elseif($part=="identificadores")identificadores();
		elseif($part=="galeria")galeria();
		elseif($part=="diagram")diagram();
		elseif($part=="suelo")suelo();
		elseif($part=="submenus")submenus();
		elseif($part=="countryShow")paisesShow();
		elseif($part=="layersStyle")layersStyle();
		else common();
		echo '</script>';
	}
	function common(){
		echo '
			console.log("Nain");
			var elementosMuestra=[];
			var descripcionElementos=[];
		';
	}
	function country(){
        echo '
            var elementosMuestra=[
                "Contenidos",
    			"Relaciones",
    			"0",
    			"galeriaCountry .separador",
                "galeriaCountry .separador img",
                "Lista",
                "Lista .elemento",
                "Lista #filtro",
                "Lista #filtroButton",  
                "Lista2"
            ];
            var descripcionElementos=[
                "El apartado de Country ofrece varios elementos para interactuar, uno de  ellos es el formulario de llenado de información para cada país en caso de contar con más de un país en el sistema. Se recomienda subir como imagen principal la bandera del país, dando clic a  la imagen de muestra.",
                "En esta sección se pueden dar de alta diagramas para los diferentes países, dando clic a alguno de los elementos dados de alta en el apartado “Diagram” se inicia el dado de alta. Enseguida presionando el clic derecho sobre la parte derecha de la sección de componentes  se ofrecen tres opciones como es la de agregar, renombrar y eliminar el componente seleccionado.",
    			"Los elementos a la derecha, son un conjunto de cajas de texto que se presentan en el apartado de información en la página principal. El primer cuadro de texto es el título de la caja  y el segundo de la descripción del mismo.",
    			"Finalmente se da la opción para agregar tanto logotipos referentes a alguna organización colaborado como imágenes representativas del país, como ayuda para los usuarios de la pagina principal, ”importante todas aquellas imágenes en la sección logos disponibles se mostrar en la parte inferior de la pagina de mapas”. Otro detalle a considerar es de que en caso de que se desea modificar alguna imagen se presione el botón derecho del ratón sobre la imagen para modificar dicha imagen.",
                "Realizando un click Izquierdo la imagen se podra eliminar y dando un click derecho se modificara",
                "Lista de los elementos almacenados en la base de datos",
                "Al dar click, se podra acceder a modificar el elemento seleccionado",
                "Introucioendo un conjunto d caracteres se ppuede realizar un filtrado de informacion realizando un click sobre el boton de Buscar",
                "Boton de busqueda de datos basado en los datos proporcionados en los elementos a la derecha del mismo",                
                "La lista presentada en la parte lateral izquierda tiene como finalidad proporcionar un apartado de priorización de capas del país, y de cómo se presentara en la página principal, los elementos con mayor prioridad se muestran el inicio de la lista."
            ];
        ';
	}
    function columns(){
        echo '
            var elementosMuestra=[
                "Contenidos",
                "part1",
                "part1 .tipoP",
                "part1 .siC",
                "part1 .color",
                "part1 .limitA",
                "part1 .limitB",
                "Lista",
                "Lista .elemento",
                "Lista #filtro",
                "Lista #filtroButton"
            ];
            var descripcionElementos=[
    			"Columns es un apartado especializado que sirve para el llenado de informacion referente a las capas almacenadas en servidor de Google Google Engine.",
    			"Elementos visuales sobre el mapa y algunos otros parámetros, como las escalas y valores relacionados al Google Engine",
                "Tipo de elemento grafico utilizado sobre la capa ",
                "Caja de selección que define si el elemento tiene algun tipo de transparencia",
                "color del elemento grafico a desplegar sobre el mapa",
                "limite inferior que delimita el coloreado del elemento grafico",
                "limite superior que delimita el coloreado del elemento grafico",
                "Lista de los elementos almacenados en la base de datos",
                "Al dar click, se podra acceder a modificar el elemento seleccionado",
                "Introucioendo un conjunto d caracteres se ppuede realizar un filtrado de informacion realizando un click sobre el boton de Buscar",
                "Boton de busqueda de datos basado en los datos proporcionados en los elementos a la derecha del mismo" 
            ];
        ';
    }
    function layers(){
        echo '
            var elementosMuestra=[
                "Contenidos",
                "Lista",
                "Lista .elemento",
                "Lista #filtro",
                "Lista #filtroButton"
            ];
            var descripcionElementos=[
                "Layers son todos aquellas capas presentadas en el servidor de mapas, cada submenú puede poseer características particulares como son las siguientes: •Submenú al que pertenecen •Si es o no un submenú •A qué país pertenece en caso de tener más de un país en la base de datos •Si realiza una función particular al ser enfocado dentro de la página principal",
                "Lista de los elementos almacenados en la base de datos",
                "Al dar click, se podra acceder a modificar el elemento seleccionado",
                "Introucioendo un conjunto d caracteres se ppuede realizar un filtrado de informacion realizando un click sobre el boton de Buscar",
                "Boton de busqueda de datos basado en los datos proporcionados en los elementos a la derecha del mismo" 
            ];
        ';
    }
    function panel(){
        echo '
            var elementosMuestra=[
                "Contenidos",
                "iconoAux",
                "Lista",
                "Lista .elemento",
                "Lista .elemento .masP",
                "Lista .elemento .menosP",
                "Lista #filtro",
                "Lista #filtroButton"

            ];
            var descripcionElementos=[
                "Conjunto de funciones permitidas para el usuario",
                "icono que representara la funcion dada en la caja de herramientas sobre la pagina",
                "Lista de los elementos almacenados en la base de datos",
                "Al dar click, se podra acceder a modificar el elemento seleccionado",
                "boton de priorizacion de elementos al dar click sobre el se mejorara la prioridad del elemento",
                "boton de priorizacion de elementos al dar click sobre el se reducira la prioridad del elemento",
                "Introucioendo un conjunto d caracteres se ppuede realizar un filtrado de informacion realizando un click sobre el boton de Buscar",
                "Boton de busqueda de datos basado en los datos proporcionados en los elementos a la derecha del mismo", 
            ];
        ';
    }
    function identificadores(){
    }
    function galeria(){
        echo '
            var x=0;
            var clickN;
            setTimeout(function(){
                $(".colores").each(function(){
                    if(x==1)
                        clickN="#"+$(this).attr("id");
                        x++;
                });
            },2000);
            var elementosMuestra=[
                "Contenidos .separador",
                "Contenidos .separador img",
            	"colores",
            	"paletaColores",
            ];
            var descripcionElementos=[
                "Galería es utilizado para la modificación visual de los parámetros básicos de la pagina como la paleta de colores de todas las páginas del sistema",
            	"también de las imágenes del índex",
            	"Barras de colores RGBA<br>1.	Rojo<br>2.	Verde<br>3.	Azul<br>4.	Opacidad o transparencia"
            ];
        ';
    }
    function diagram(){
        echo '
            var elementosMuestra=[
                "Contenidos",
                "galeriaDiagrama .separador",
                "Lista",
                "Lista .elemento",
                "Lista #filtro",
                "Lista #filtroButton"
            ];
            var descripcionElementos=[
                "Driagram deja al usuario dar de alta elementos para la creación de diagramas sobre el servidor de mapas, facilita la inserción de formulas, descripciones e imágenes.",
                "imágenes ilustrativas para el usuario final.",
                "Lista de los elementos almacenados en la base de datos",
                "Al dar click, se podra acceder a modificar el elemento seleccionado",
                "Introucioendo un conjunto d caracteres se ppuede realizar un filtrado de informacion realizando un click sobre el boton de Buscar",
                "Boton de busqueda de datos basado en los datos proporcionados en los elementos a la derecha del mismo" 
            ];
        ';
    }
    function suelo(){
        echo '
            var elementosMuestra=[
                "Contenidos",
                "Lista",
                "Lista .elemento",
                "Lista #filtro",
                "Lista #filtroButton"
            ];
            var descripcionElementos=[
                "Uso Suelo da la oportunidad de describir mejor parámetros utilizados en el servidor de mapas.
                <br>•   Categoría a la que pertenece dicho uso de suelo
                <br>•   País determinado por el usuario donde se visualizara el uso de suelo
                <br>•   Descripción del uso de suelo
                ",
                "Lista de los elementos almacenados en la base de datos",
                "Al dar click, se podra acceder a modificar el elemento seleccionado",
                "Introucioendo un conjunto d caracteres se ppuede realizar un filtrado de informacion realizando un click sobre el boton de Buscar",
                "Boton de busqueda de datos basado en los datos proporcionados en los elementos a la derecha del mismo" 
            ];
        ';
    }
    function submenus(){
        echo '
            var elementosMuestra=[
                "Contenidos",
                "Lista",
                "Lista .elemento",
                "Lista #filtro",
                "Lista #filtroButton"
            ];
            var descripcionElementos=[
                "Al igual que Uso de suelo submenús permite dar de alta en la base de datos los grupos de capas que se mostraran durante el proceso de cálculos, en la página de mapas.",
                "Lista de los elementos almacenados en la base de datos",
                "Al dar click, se podra acceder a modificar el elemento seleccionado",
                "Introucioendo un conjunto d caracteres se ppuede realizar un filtrado de informacion realizando un click sobre el boton de Buscar",
                "Boton de busqueda de datos basado en los datos proporcionados en los elementos a la derecha del mismo" 
            ];
        ';
    }
    function paisesShow(){
        echo '
            var elementosMuestra=[
                "Contenidos",
                "Lista",
                "Lista .elemento",
                "Lista #filtro",
                "Lista #filtroButton"
            ];
            var descripcionElementos=[
                "Finalmente contryShow es utilizado para la gestión de los países visibles para los usuarios finales en la pagina principal. ",
                "Lista de los elementos almacenados en la base de datos",
                "Al dar click, se podra acceder a modificar el elemento seleccionado",
                "Introucioendo un conjunto d caracteres se ppuede realizar un filtrado de informacion realizando un click sobre el boton de Buscar",
                "Boton de busqueda de datos basado en los datos proporcionados en los elementos a la derecha del mismo" 
            ];
        ';
    }
    function layersStyle(){
        echo '
            var elementosMuestra=[
                "Contenidos",
                "Lista",
                "Lista .elemento",
                "Lista #filtro",
                "Lista #filtroButton"
            ];
            var descripcionElementos=[
                "LayersStyle da la opción al usuario de modificar el color del elemento en la página de mapas, en caso de ser necesario para denotar que el elemento es particular comparado con los demás",
                "Lista de los elementos almacenados en la base de datos",
                "Al dar click, se podra acceder a modificar el elemento seleccionado",
                "Introucioendo un conjunto d caracteres se ppuede realizar un filtrado de informacion realizando un click sobre el boton de Buscar",
                "Boton de busqueda de datos basado en los datos proporcionados en los elementos a la derecha del mismo" 
            ];
        ';
    }

?>
<script>
    var x=0;
    var clickN;
    setTimeout(function(){
        $(".elemento").each(function(){
            if(x==0)
                clickN="#"+$(this).attr("id");
            x++;
        });
    },1000);
	if(elementosMuestra.length>0)
		setTimeout(function(){		
			$(".mensaje").attr('onclick','Tour(\''+elementosMuestra[0]+'\')');
			$(".mensaje").addClass('showMensaje');
		},1000);
	setTimeout(function(){
		$(".mensaje").removeClass('showMensaje');
	},15000);
    function Tour(act){
    	if(elementosMuestra.indexOf(act)==0){
            $("body").attr("style","overflow:hidden");
            $(".elemento").first().trigger("click");
    		$(clickN).trigger("click");
    		console.log(clickN);
    	}
        if(act=="#close#"){
            $("body").attr("style","");
           $(".cortina").remove();
        }
        else{
            var elemento=act;
            var next=elementosMuestra[elementosMuestra.indexOf(act)+1];
            var back=elementosMuestra[elementosMuestra.indexOf(act)-1];
        	$('html, body').animate({scrollTop:$("#"+elemento).offset().top-80});
            setTimeout(function(){
        		var p= $( "#"+elemento).first();
                var l=p.offset().left;
                var t=p.offset().top- $(window).scrollTop();
        	    var w=p.outerWidth();
                var h=p.outerHeight();
        		if(w==0)w=300;
        		if(h==0)h=300;
                $(".cortina").remove();
                	//$("#banner").after("<div class='cortina explicacion'><video height='400px'muted autoplay loop><source src='http://www.mofuss.unam.mx/Mapps/Global/efecto.mp4' type='video/mp4'></video><p>"+elementosMuestra[elementosMuestra.indexOf(elemento)]+"</p></div>");
                $("#banner").after("<div class='cortina explicacion'>"+descripcionElementos[elementosMuestra.indexOf(elemento)]+"</div>");
                $("#banner").after("<div class='cortina' style='left:0px; top:"+t+"px; width:"+l+"px; height:"+h+"px;'></div>");
                $("#banner").after("<div class='cortina' style='left:0px; right:0px; top:"+t+"px; margin-left:"+(l+w)+"px; height:"+h+"px;'></div>");
                $("#banner").after("<div class='cortina' style='left:0px; top:"+(t+h)+"px; width:100%; bottom:0px;'></div>");
                $("#banner").after("<div class='cortina' style='left:0px; top:0px; width:100%; height:"+t+"px;'></div>");
                $("#banner").after("<div class='cortina selec' style='left:"+l+"px; top:"+t+"px; width:"+w+"px; height:"+h+"px;'></div>");
                if(next!=undefined)$("#banner").after('<i class="fa fa-chevron-circle-right next1 cortina" onClick="Tour(\''+next+'\')"></i>');
                else $("#banner").after('<i class="fa fa-chevron-circle-right next cortina" onClick="Tour(\'#close#\')"></i>');
                if(back!=undefined)$("#banner").after('<i class="fa fa-chevron-circle-left back cortina" onClick="Tour(\''+back+'\')"></i>');
               	else $("#banner").after('<i class="fa fa-chevron-circle-left back cortina" onClick="Tour(\'#close#\')"></i>');
                	$("#banner").after('<i class="fa fa-times-circle closer cortina" onClick="Tour(\'#close#\')"></i>');
        	},500);
        }
    }

</script>
<div id="banner">
	<div onClick=""" class="mensaje"><p>¿Deseas dar un recorrido?</p></div>
</div>
	</div>
</body>
</html>
