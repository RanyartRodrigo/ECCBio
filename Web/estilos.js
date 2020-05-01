var host="http://www.wegp.unam.mx/admin/Global/";
ListaCP=0;
indexCP=0;
function agregarColores(id, style2){
	if($("#Pass").length==0){
		if(style2=="")
        	$.ajax({
              	url : host+'fabrica.php',
	            dataType : 'jsonp',
	            data: {
	        	   	t: "estilos",
	                seleccionado: id,
	      			format: "json"
				},
                type:"POST",
                success: function(json) {
                   	style2=json;
					agregarColores(id, style2);
    			}
	 		});
		else{
			var legendWrapper = document.createElement('div');
			if($("#paletaColores"+id).length==0){
				legendWrapper.id = "paletaColores"+id;
				legendWrapper.class = 'colores_de_'+id+' paletaColores';
				style2=style2.split('\'').join('"');
				style2=style2.split('where').join('"where"');
				style2=style2.split('iconName').join('"iconName"');
				style2=style2.split('fillColor').join('"fillColor"');
				style2=style2.split('fillOpacity').join('"fillOpacity"');
				style2=style2.split('strokeColor').join('"strokeColor"');
				if(style2.indexOf('polygonOptions')>=0)
					style2=style2.split('polygonOptions').join('"polygonOptions"');
				if(style2.indexOf('polylineOptions')>=0){
					style2=style2.split('polylineOptions').join('"polylineOptions"');
				}
				if(style2.indexOf('markerOptions')>=0)
					style2=style2.split('markerOptions').join('"markerOptions"');
				style2=style2.split('},]').join('}]');
				if(style2.indexOf('valFill')>=0)
					style=JSON.parse(style2.split('valFill').join('1'));
				else
					style=JSON.parse(style2);
				var legend = document.createElement('div');
				legend.id = 'legend_'+id;
				var title = document.createElement('p');
				title.id="titleLegend_"+id;
				var minMaxColores = getMinMaxColors(style);
				var minimos = minMaxColores.min;
				var maximos = minMaxColores.max;
				var colores = minMaxColores.color;
				var columnas = style[0].where.substr(0, style[0].where.indexOf(">"));
				var columna= columnas.replaceAll(" ","");
				//title.innerHTML = columna;
				legend.appendChild(title);
				var tipo = getTipo(minimos, maximos);
				if(tipo == 'strech'){
					var legendItem = document.createElement('div');
					minimos.sort(function(a, b){return a-b});
					maximos.sort(function(a, b){return a-b});
					var min = minimos[0];
					var max = maximos[maximos.length-1];
					var colores = getCodes(colores);
					var color = document.createElement('div');
					color.setAttribute('class', 'color2');
					color.style.background = 'linear-gradient(to right,'+colores+')';
					var table = document.createElement('table');
					var tr1 = document.createElement('tr');
					var td1 = document.createElement('td');
					td1.style.textAlign = 'center';
					table.appendChild(tr1);
					tr1.appendChild(td1);
					td1.appendChild(color);
					var tr2 = document.createElement('tr');
					var td2 = document.createElement('td');
					td2.style.textAlign = 'center';
					var minMax = document.createElement('span');
					minMax.id='minMax_'+id;
					minMax.innerHTML = min + ' - ' + max + ' '+unidades_[id];
					tr2.appendChild(td2);
					td2.appendChild(minMax);
					table.appendChild(tr2);
					legendItem.appendChild(table);
					legend.appendChild(legendItem);
				}else{
					if(style.length > 1){
						console.log(style);
						for(i=0;i<style.length;i++){
							var legendItem = document.createElement('div');
							legendItem.style.height=30;
							var color = document.createElement('div');
								color.setAttribute('class', 'color');
							if(style[i].polygonOptions!= undefined)
								color.style.backgroundColor = style[i].polygonOptions.fillColor;
							if(style[i].markerOptions!=undefined)
								color.style.backgroundImage = "url('"+pathIcons+style[i].markerOptions.iconName+".png')";
							legendItem.appendChild(color);
							var minMax = document.createElement('span');
							var min = minimos[i];
							minMax.innerHTML = min+' '+(unidades_[id]=='-'?'':unidades_[i]);
							legendItem.appendChild(minMax);
							legend.appendChild(legendItem);
						}
					}
				}
				legendWrapper.appendChild(legend);
				$("#colores_"+id).append(legendWrapper);
				$(".colores_"+id).append(legendWrapper);
				if(style.length <= 1){
					$("#form"+id).hide();
					$("#legend_"+id).hide();
				}
				$.ajax({
					url : host+'fabrica.php',
					dataType : 'jsonp',
					data: {
						t: "getInfoLegend",
						seleccionado: id,
					format: "json"
					},
					type:"POST",
					success: function(json) {
						$("#legend_"+id+">p").html(json);
						if($("#galeria_"+id).length==0)
							$("#legend_"+id).after("<div id='galeria_"+id+"' class='miniGaleria'></div>");
						$.ajax({
							url : host+'infoCapas.php',
							dataType : 'jsonp',
							data: {
								t: "img",
								seleccionado: id,
								format: "json"
							},
							type:"POST",
							success: function(json) {
								$("#galeria_"+id).html(json);                		
							}
						});
					}
				});	 
			}
		}
		}
	var efectosU=["%","%","%","%",""];
	var x=0;
	var estilo="filter:";
	$("#panelDesign>div").each(function(){
        var name=$(this).attr("id");
        var valor=$(this).find("form").find("output").text();
        estilo+=name+"("+valor+efectosU[x]+") ";
        x++;
    });
	$( ".color" ).each(function( index ) {
  		var estilo2=$(this).attr("style");
		if(estilo2 === undefined) return;
		var estiloB=estilo2.split(";");
  		$(this).attr("style",estiloB[0]+";"+estilo); 
	});
}
function efectoMap(){
	var efectosU=["%","%","%","%",""];
	var x=0;	
	var estilo1="filter:";
	var estilo2="-webkit-filter:";
	var names = ["brightness","contrast","grayscale","invert","saturate"];
	for(var i=0;i<names.length;i++){
		var valor=$("#"+names[i]).find("form").find("output").text();
		estilo1+=names[i]+"("+valor+efectosU[i]+") ";
		estilo2+=names[i]+"("+valor+efectosU[i]+") ";
	}
	estilo1+=";";
	estilo2+=";";
	console.log(estilo1);
	console.log(estilo2);
	$("#map").attr("style",estilo1+estilo2);	
}
function getCodes(colores){
	temp = "";
	for(i = 0; i < colores.length;i++){                
		var r = parseInt(colores[i].substr(1,2), 16);
	   	var g = parseInt(colores[i].substr(3,2), 16);
    	var b = parseInt(colores[i].substr(5,2), 16);
        temp += 'rgb('+r+','+g+','+b+'),';
	}
	return temp.substring(0,temp.length-1);
}
function getMinMaxColors(style){
  	var columnas = style[0].where.substr(0, style[0].where.indexOf(">"));
  	var columna= columnas.replaceAll(" ","");
	var colores = [];
	var minimos = [];
	var maximos = [];
    for(i=0;i<style.length;i++){
		limits = style[i].where.replaceAll("<","").replaceAll(">","").replaceAll("=","");
		limits = limits.split("AND");
		var temp1 = limits[0].replaceAll(columna,"");
		var temp2 = limits[1].replaceAll(columna,""); 
		limits[0] = isNaN(temp1)?temp1.trim():Math.round(temp1);
		limits[1] = isNaN(temp2)?temp2.trim():Math.round(temp2);
	//limits[1] = Math.round(limits[1].replaceAll(columna,""));
        minimos.push(limits[0]);
        maximos.push(limits[1]);                
		if(style[i].polygonOptions!= undefined)
			colores.push(style[i].polygonOptions.fillColor);
	}
	return {min: minimos, max: maximos, color: colores};
}

function getTipo(minimos, maximos){
    console.log(minimos[0]+" "+maximos[0])
    if(minimos[0] == maximos[0]){
		return 'categorias';
	} else {
        	return 'strech';
	}
}
function grupo(este){
	if($(este).hasClass("noSeleccionado")){
		$(este).removeClass("noSeleccionado");
	}
	else{
		$(este).addClass("noSeleccionado");
		$(".grupo").addClass("noSeleccionado");//posiblemente no
	}
}
function grupoAll(este){
	if($(este).hasClass("noSeleccionado")){
		$("#grupos>.padre>*").removeClass("noSeleccionado");
	}
	else{
		$("#grupos>.padre>*").addClass("noSeleccionado");
		$(este).addClass("noSeleccionado");
	}
}
function defaultMapa(){
	$("#panelDesign input").each(function(){
		if($(this).attr("default")!="" && $(this).attr("default")!=undefined){
			$(this).val($(this).attr("default"));
			
		}
	});
        $("#panelDesign output").each(function(){
                if($(this).attr("default")!="" && $(this).attr("default")!=undefined){
                                $(this).text($(this).attr("default"));
                }
        });
	
	$("#map").attr('style', ''); 
	//efectoMap();
}
function menu(opc){	
	host="http://www.mofuss.unam.mx/Mapps/Global/";
	if(home=="conabio")host="http://www.mofuss.unam.mx/Mapps/Conabio/";
	if(home=="cemie")host="http://www.mofuss.unam.mx/Mapps/Cemie/";
	if(home=="sicabioenergy")host="http://www.mofuss.unam.mx/Mapps/SicaBioenergy/";	
	if(home=="probiomasa")host="http://www.mofuss.unam.mx/Mapps/Probiomasa/";	
	$("head").append('<script src="'+host+'assets/js/jquery-1.11.1.min.js"></script>');
	$("head").append('<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">');
	$("head").append('<link href="https://fonts.googleapis.com/css?family=Oleo+Script" rel="stylesheet">');
	$("head").append('<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>');
    $("head").append('<script src="'+host+'assets/js/jquery.mobile.custom.js"></script>');
	$("head").append('  <link rel="stylesheet" href="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">');
	//$("head").append('  <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>');
	$("head").append('<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>');
    $("head").append('<script src="http://www.mofuss.unam.mx/Mapps/Global/assets/js/funcionesMapa.js"></script>');
    $("head").append('<script src="'+host+'assets/js/html2canvas.js"></script>');
	$(".navbar-header > a").remove();
	printLog(home);
	if (typeof home != 'undefined'){
		if(home=="conabio"){
		setTimeout(function(){
			$("#tour").text("Deseas un recorrido?");
			$("#tour").addClass("showTour");
			setTimeout(function(){
				$("#tour").removeClass("showTour");
			},15000);
		},3000);
		$("#MenuPrincipal").append("<h1 id='titulo'>Explorador de cambio climático</h1>");
                $("#MenuPrincipal").append("<a href='http://www.wegp.unam.mx/"+home+"'><img src='http://www.mofuss.unam.mx/Mapps/Conabio/assets/img/conabio.png' id='homePage' title='"+home+"'/></a>");
                $("#MenuPrincipal").append("<a href='http://www.wegp.unam.mx/"+home+"'><img src='http://www.mofuss.unam.mx/Mapps/Conabio/assets/img/conanp.png' id='conanp'/></a>");
		}
		else
			$("#MenuPrincipal").append("<a href='http://www.wegp.unam.mx/"+home+"'><i class='fa fa-home home-menu' id='/' title='"+home+"'></i></a>");    	
		if(home!="probiomasa")
			$(".Mprincipal>li").append("<i class='fa fa-globe'></i>");
	}
	else
		$("#MenuPrincipal").append("<i class='fa fa-home home-menu' onclick=\'cargarContenido(this.id,this.title)\' id='/' title='Home'></i>");
	$("<div id='restaCapas' class='operaciones'></div>").insertAfter("#banner");
	$("<div id='interseccionCapas' class='operaciones'></div>").insertAfter("#banner");
	$("<div id='cover'></div>").insertAfter("#banner");
	$("<p id='beta'>Beta</p>").insertAfter("#MenuPrincipal");
	if (typeof mapa == 'undefined'){
		$("#MenuPrincipal").remove();
		$("#menu").remove();
		$("footer").remove();
		$("#beta").remove();
		setTimeout(function(){$("#cortina").remove();},1000);
	}
	$("#banner").after("<div id='panelDesign' style='display:none'></div>");
	var efectos=["brightness", "contrast","grayscale","invert","saturate","reset"];
	var efectosM=["200","200","200","200","6","1"];
	var efectosD=["100","100","0","0","1","0"];
	for(var x=0;x<efectos.length;x++){
		if("grayscale"==efectos[x] || "invert"==efectos[x] ){
			$("#panelDesign").append("<div id='"+efectos[x]+"'><p>"+efectos[x]+"</p><form onsubmit='return false'oninput='Output"+efectos[x]+".value = points"+efectos[x]+".valueAsNumber'><input type='button' default='Off' value='Off' id='check"+efectos[x]+"' style='visibility:visible'/><input id='points"+efectos[x]+"' class='sliderRange hidden' onchange='efectoMap()' name='points"+efectos[x]+"' type='range' min='0' max='"+efectosM[x]+"' default='"+efectosD[x]+"' value='"+efectosD[x]+"'> <output class='hidden' for='points"+efectos[x]+"' id='Output"+efectos[x]+"' default='"+efectosD[x]+"' name='Output"+efectos[x]+"'>"+efectosD[x]+"</output></form></div>");
			$("#panelDesign").append("<script> $('#check"+efectos[x]+"').on('click',function(){if($(this).val()=='Off'){$(this).val('On');$('#Output"+efectos[x]+"').text('100');efectoMap();}else {$(this).val('Off');$('#Output"+efectos[x]+"').text('0');efectoMap();}});</script>");
		}
		else if("reset"==efectos[x]){
                        $("#panelDesign").append("<div id='"+efectos[x]+"'><p></p><input type='button' onClick='defaultMapa()' value='RESET' id='check"+efectos[x]+"' style='visibility:visible'/></div>");
		}
		else
			$("#panelDesign").append("<div id='"+efectos[x]+"'><p>"+efectos[x]+"</p><form onsubmit='return false' oninput='Output"+efectos[x]+".value = points"+efectos[x]+".valueAsNumber'><input id='points"+efectos[x]+"' class='sliderRange' onchange='efectoMap()' name='points"+efectos[x]+"' type='range' min='0' max='"+efectosM[x]+"' default='"+efectosD[x]+"' value='"+efectosD[x]+"'> <output for='points"+efectos[x]+"' default='"+efectosD[x]+"' name='Output"+efectos[x]+"'>"+efectosD[x]+"</output></form></div>");
	}
	if(home!="conabio")
	$("#banner").after('<button id="cerraCover" onClick="Cover()" ><i class="fa fa-info-circle"></i><p>nformation</p></button>');
	$("#banner").append('<button id="tour" onClick="Tour(\'panelDeControl\')" ><i class="fa fa-question-circle"></i></button>');
	$("#MenuPrincipal").append('<div id="google_translate_element"></div><script type="text/javascript">function googleTranslateElementInit() {new google.translate.TranslateElement({pageLanguage: \'en\', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, \'google_translate_element\');}</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>');
	$(".control-panel").append('<i id="language" onclick="traductor()" class="padre fa fa-language"><div class="hijo">translate the page <br></div></i>');
	$(".Mprincipal>li").on("click",function(){
		if($(".Msecundario").hasClass("selectPais")) $(".Msecundario").removeClass("selectPais");
		else $(".Msecundario").addClass("selectPais");
	});
	$("#capas>h3").on("click", function(){
		if($("#capas").hasClass("escondeCapas"))
			$("#capas").removeClass("escondeCapas");
		else
			$("#capas").addClass("escondeCapas");
	});
    if(navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry)/)){
    	if (typeof mapa != 'undefined'){	
		}
        $("head").append('<meta name="viewport" content="initial-scale=1.0 , minimum-scale=1.0 , maximum-scale=1.0" />');
	   	$(".Mprincipal").append('<li id="esconder"><i class="fa fa-angle-double-up"></i></li>');
		(function myLoop (i) {
   			setTimeout(function () {
      			$("#cortina").remove();
	      		$("#menu-hidde").trigger("click");
        		if(typeof panel == 'function')
				panel();
      			if (--i) myLoop(i);
   			}, 600)
		})(1);
	/*   $(document).ready(function() {
	      console.log("Document ready!")
              $(window).resize(function() {
                   google.maps.event.trigger(map, 'resize');
              });
    //google.maps.event.trigger(map, 'resize');
                   setTimeout(function(){alert("Before Resize");google.maps.event.trigger(map, 'resize'); alert("After Resize");},2000);

           });*/

	}
    else
		if(typeof mapa != 'undefined' & home=='conabio')$("head").append('<link rel="stylesheet" href="http://www.mofuss.unam.mx/Mapps/Global/assets/css/conabio.php">');		
		else if(typeof mapa != 'undefined')$("head").append('<link rel="stylesheet" href="http://www.mofuss.unam.mx/Mapps/Global/assets/css/style'+opc+'.php?home="'+home+'">');
		
		$(document).ready(function() {
        		console.log("Document ready!");
			resizeCheck();
                        setTimeout(function(){resizeCheck();},500);
			setTimeout(function(){resizeCheck();},1500);
            		$(window).resize(function() {
				indexCP=0;
				resizeCheck();
			});
	        });
		$(".navbar-header").append('<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>'); 
		if(opc=="" || navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry)/)){
         //---------------------mobile view-------------------------------------
			if(typeof mapa != 'undefined'){
			//$('head').html("");
            	$('body').html("");
        		$.ajax({
                   	url : 'http://www.mofuss.unam.mx/Mapps/Global/mobile/index.php',
                   	dataType : 'jsonp',
                   	data: {
                       	t: "body",
                       	seleccionado: mapa,
                      	format: "json"
                   	},
                  	type:"POST",
                   	success: function(json) {
                  		$('body').html(json);
                  	}
                });
			}
		}	
		$("#capas>h3").on("click", function(){
	 		if($("#capas").hasClass("esconde-capas")){
	  			$("#capas").removeClass("esconde-capas");
	 		}
	 		else{
	  			$("#capas").addClass("esconde-capas");
	 		}
		});
		$("#esconder").on("click", function(){
        if($(".Mprincipal").hasClass("esconde-panel")){
			$(".Mprincipal").removeClass("esconde-panel");
		}
        else{
			$(".Mprincipal").addClass("esconde-panel");
		}
	});
	(function myLoop (i) {
   		setTimeout(function () {
      	$("#cortina").addClass("removeCortina");
      	if (--i) myLoop(i);
   		}, 600)
	})(1);
} 
function padresSub(id){
	if($(id).parent().parent().length){
		$(id).parent().parent().children('a').first().addClass('subOperacion');
	}
}
function panelColor(){
	if($("#panelDesign").attr("style")=="display:none"){ $("#panelDesign").attr("style","");}
	else{$("#panelDesign").attr("style","display:none");}
}
function resizeCheck(){
	if($("#capas").length)$("#capas").attr("style","margin-top:"+$("#MenuPrincipal").outerHeight()+"px;margin-bottom:"+$("#banner").outerHeight()+"px !important;");
	if(home!='conabio') if($("#panelDeControl").length) $("#panelDeControl").attr("style","bottom:"+$("#banner").outerHeight()+"px !important;top:"+($("#tour").offset().top+35)+"px !important ");
	if($("#conabioEstadisticas").length==1){
		$("#conabioEstadisticas").attr("style","bottom:"+$("#banner").outerHeight()+"px !important;");
                $("#conabioEstadisticas").attr("style","top:"+$("#MenuPrincipal").outerHeight()+"px !important;");
	}
	if(home!='conabio'){
	var e=($("#panelDeControl>i").length-2)*35;
	if ($("#panelDeControl").height() < e) {
		ListaCP=($("#panelDeControl").height()/35)-3;
		$("#panelDeControl>i").attr("style","display:none");
		var x=0;
		$("#panelDeControl>.padre").each(function(){
			console.log((ListaCP*indexCP)+ListaCP+" - "+ListaCP*indexCP);
			if(x==0 &&(Math.ceil((ListaCP*indexCP)+ListaCP)>x && Math.floor(ListaCP*indexCP)<=x))
				$(this).attr("style","margin-top:35px;");
			else if(Math.ceil((ListaCP*indexCP)+ListaCP)>x && Math.floor(ListaCP*indexCP)<=x) //Aqui va la MagiaXD
				$(this).attr("style","");
			x++;
		});
		$("#panelDeControlT").attr("style","top:"+($("#tour").offset().top+35)+"px !important;");
		$("#panelDeControlB").attr("style","bottom:"+$("#banner").outerHeight()+"px !important;");
	} else {
		ListaCP=0;
		$("#panelDeControl>i").attr("style","");
		$("#panelDeControlT").attr("style","display:none");
		$("#panelDeControlB").attr("style","display:none");
	}
	}
	
}
function downSC(){
if(($("#panelDeControl>.padre").length/ListaCP)>indexCP)
indexCP++;
console.log(indexCP);
resizeCheck();
}
function upSC(){
if(indexCP>0)
indexCP--;
console.log(indexCP);
resizeCheck();
}

