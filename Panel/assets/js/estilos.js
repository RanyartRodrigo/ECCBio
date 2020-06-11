
var host="http://www.wegp.unam.mx/admin/Global/";
function menu(opc){	
	host="http://www.wegp.unam.mx/admin/Global/";
	if(home=="conabio3")
		host="http://localhost/eccbio/Panel/";
	if(home=="cemie")
		host="http://www.wegp.unam.mx/admin/Cemie/";
	if(home=="sicabioenergy")
		host="http://www.wegp.unam.mx/admin/SicaBioenergy/";
	
	$("head").append('<script src="'+host+'assets/js/jquery-1.11.1.min.js"></script>');
	$("head").append('<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">');
	$("head").append('<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>');
        $("head").append('<script src="'+host+'assets/js/jquery.mobile.custom.js"></script>');
	$("head").append('  <link rel="stylesheet" href="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">');
	//$("head").append('  <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>');
	$("head").append('<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>');
        $("head").append('<script src="http://www.wegp.unam.mx/admin/Global/assets/js/funcionesMapa.js"></script>');
        $("head").append('<script src="'+host+'assets/js/html2canvas.js"></script>');


	$(".navbar-header > a").remove();
	if (typeof home != 'undefined')
		$("#MenuPrincipal").append("<a href='http://www.wegp.unam.mx/"+home+"'><i class='fa fa-home home-menu' id='/' title='"+home+"'></i></a>");
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
var efectos=["brightness", "contrast","grayscale","invert","saturate"];
var efectosM=["200","200","200","200","6"];
var efectosD=["100","100","0","0","1"];
for(var x=0;x<efectos.length;x++){
if("grayscale"==efectos[x] || "invert"==efectos[x] ){
$("#panelDesign").append("<div id='"+efectos[x]+"'><p>"+efectos[x]+"</p><form onsubmit='return false'oninput='Output"+efectos[x]+".value = points"+efectos[x]+".valueAsNumber'><input type='button' value='Off' id='check"+efectos[x]+"' style='visibility:visible'/><input id='points"+efectos[x]+"' class='sliderRange hidden' onchange='efectoMap()' name='points"+efectos[x]+"' type='range' min='0' max='"+efectosM[x]+"' value='"+efectosD[x]+"'> <output class='hidden' for='points"+efectos[x]+"' id='Output"+efectos[x]+"' name='Output"+efectos[x]+"'>"+efectosD[x]+"</output></form></div>");
$("#panelDesign").append("<script> $('#check"+efectos[x]+"').on('click',function(){if($(this).val()=='Off'){$(this).val('On');$('#Output"+efectos[x]+"').text('100');efectoMap();}else {$(this).val('Off');$('#Output"+efectos[x]+"').text('0');efectoMap();}});</script>");
}
else
$("#panelDesign").append("<div id='"+efectos[x]+"'><p>"+efectos[x]+"</p><form onsubmit='return false' oninput='Output"+efectos[x]+".value = points"+efectos[x]+".valueAsNumber'><input id='points"+efectos[x]+"' class='sliderRange' onchange='efectoMap()' name='points"+efectos[x]+"' type='range' min='0' max='"+efectosM[x]+"' value='"+efectosD[x]+"'> <output for='points"+efectos[x]+"' name='Output"+efectos[x]+"'>"+efectosD[x]+"</output></form></div>");
}




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
$("#banner").after('<i id="btnBanner" class="padre fa fa-tag"></i>');
	   $("#btnBanner").on("click",function(){
		if($("#banner").hasClass("showBanner"))
		$("#banner").removeClass("showBanner");
		else
		$("#banner").addClass("showBanner");
	   });
           if (typeof mapa != 'undefined'){
        	$("head").append('<link rel="stylesheet" href="http://www.wegp.unam.mx/admin/Global/assets/css/smart.php">');
		$("#banner").after("<div id='controles'></div>");
                $("#controles").append($("#tour"));
                $("#controles").append($("#language"));
                $("#controles").append($("#cerraCover"));
                $("#controles").append($("#btnBanner"));
                setTimeout(function(){$("#controles").append($("#menu-hidde"));},500);
		$("#controles").on("click",function(){
			$("#controles").toggleClass("controles-show");
		});
	}
           $("head").append('<meta name="viewport" content="initial-scale=1.0 , minimum-scale=1.0 , maximum-scale=1.0" />');
	   $(".Mprincipal").append('<li id="esconder"><i class="fa fa-angle-double-up"></i></li>');
(function myLoop (i) {
   setTimeout(function () {
      $("#cortina").remove();
	      $("#menu-hidde").trigger("click");
        panel();
      if (--i) myLoop(i);
   }, 600)
})(1);
	   /*$(document).ready(function() {
	      console.log("Document ready!")
              $(window).resize(function() {
                   google.maps.event.trigger(map, 'resize');
              });
    //google.maps.event.trigger(map, 'resize');
                   setTimeout(function(){alert("Before Resize");google.maps.event.trigger(map, 'resize'); alert("After Resize");},3000);
           });*/


	}
        else
		if(typeof mapa != 'undefined')$("head").append('<link rel="stylesheet" href="http://www.wegp.unam.mx/admin/Global/assets/css/style'+opc+'.php">');
	$("i").tooltip({
         show: {
          effect: "slideDown",
          delay: 250
         },
         hide: {
          effect: "explode",
          delay: 250
         },
         track: true
        });
	$(".navbar-header").append('<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>'); 
   
     if(opc=="" || navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry)/)){
         $("#MenuPrincipal").after('<span class="fa fa-bars" id="menu-hidde"><p></p></span>');
        //Existe un swipeleft en jquery.mobile.custom.js
	 $("#menu-hidde").on("click", function(){
          if($("#menu-hidde").hasClass("menu-menu-hidde")){
           $("#menu-hidde").removeClass("menu-menu-hidde", 500);
           $("#MenuPrincipal").removeClass("menu-menu-hidde", 500);
           $("#Wall").removeClass("menu-menu-hidde", 500);
           $("footer").removeClass("menu-menu-hidde", 500);
           $("#capas").removeClass("menu-menu-hidde", 500);
           $("#banner").removeClass("menu-menu-hidde", 500);
           //new WOW().init();
          }
          else{
           $("#menu-hidde").addClass("menu-menu-hidde", 500);
           $("#MenuPrincipal").addClass("menu-menu-hidde", 500);
           $("#Wall").addClass("menu-menu-hidde", 500);
           $("footer").addClass("menu-menu-hidde", 500);
           $("#capas").addClass("menu-menu-hidde", 500);
           $("#banner").addClass("menu-menu-hidde", 500);
           //new WOW().init();
          }
          
         });
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
//$("#grupos>*").removeClass("noSeleccionado");
$(este).addClass("noSeleccionado");
}

}
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
  		$("#colores_de_"+id).remove();
		legendWrapper.class = 'colores_de_'+id+' paletaColores';
  		style2=style2.split('\'').join('"');
  		style2=style2.split('where').join('"where"');
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
  	var minMaxColores = getMinMaxColors(style);
        var minimos = minMaxColores.min;
        var maximos = minMaxColores.max;
        var colores = minMaxColores.color;
  	var columnas = style[0].where.substr(0, style[0].where.indexOf(">"));
  	var columna= columnas.replaceAll(" ","");
  	title.innerHTML = columna;
  	legend.appendChild(title);
    	var maxAnt=-1;
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
                color.style.width = '100%'; //No lo hace xD
                var table = document.createElement('table');
		var tr1 = document.createElement('tr');
		var td1 = document.createElement('td');
		td1.style.textAlign = 'center';
		table.appendChild(tr1);
		tr1.appendChild(td1);
		td1.appendChild(color);
		//color.style.width = "207px";
                var tr2 = document.createElement('tr');
                var td2 = document.createElement('td');
		td2.style.textAlign = 'center';
		var minMax = document.createElement('span');
                minMax.innerHTML = min + ' - ' + max;
                tr2.appendChild(td2);
                td2.appendChild(minMax);
		table.appendChild(tr2);
                legendItem.appendChild(table);
     		legend.appendChild(legendItem);
        }else{
		for(i=0;i<style.length;i++){
		        var legendItem = document.createElement('div');
			var color = document.createElement('div');
	    		color.setAttribute('class', 'color');
			if(style[i].polygonOptions!= undefined)
				color.style.backgroundColor = style[i].polygonOptions.fillColor;
		    	legendItem.appendChild(color);
		        var minMax = document.createElement('span');
        		var min = minimos[i];        		
                    	minMax.innerHTML = min;
			legendItem.appendChild(minMax);                                
			legend.appendChild(legendItem);
		}
  	}/*	
    for(i=0;i<style.length;i++){
        var legendItem = document.createElement('div');
    var color = document.createElement('div');
        limits = style[i].where.replaceAll(" ","").replaceAll("<","").replaceAll(">","").replaceAll("=","");
        limits = limits.split("AND");
        limits[0] = limits[0].replaceAll(columna,"");
        limits[1] = limits[1].replaceAll(columna,"");
    color.setAttribute('class', 'color');
if(style[i].polygonOptions!= undefined)
    color.style.backgroundColor = style[i].polygonOptions.fillColor;
    legendItem.appendChild(color);
        var minMax = document.createElement('span');
        var min = Math.round(limits[0]);//.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0];
        var max = Math.round(limits[1]);//.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0];
//console.log("min:"+min+" max:"+max+" maxAnt:"+maxAnt);
    if(maxAnt == max){

                }else if(min == max){
                    minMax.innerHTML = min;
    legendItem.appendChild(minMax);

                } else {
                    minMax.innerHTML = min + ' - ' + max;
    legendItem.appendChild(minMax);

                }
                maxAnt = max;
    legend.appendChild(legendItem);
  }*/
  	legendWrapper.appendChild(legend);
  	$("#colores_"+id).append(legendWrapper);
	$(".colores_"+id).append(legendWrapper);
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
var estiloB=estilo2.split(";");
  $(this).attr("style",estiloB[0]+";"+estilo);
  
});

}
function efectoMap(){
var efectosU=["%","%","%","%",""];
var x=0;
var estilo="filter:";
$("#panelDesign>div").each(function(){
            var name=$(this).attr("id");
	    var valor=$(this).find("form").find("output").text();
            estilo+=name+"("+valor+efectosU[x]+") ";
	    x++;
        });
console.log(estilo);
$("#map").attr("style",estilo);
$( ".color" ).each(function( index ) {
  var estilo2=$(this).attr("style");
var estiloB=estilo2.split(";");
  $(this).attr("style",estiloB[0]+";"+estilo);
  //console.log(estilo2+estilo);
});
}
function panelColor(){
if($("#panelDesign").attr("style")=="display:none"){ $("#panelDesign").attr("style","");}
else{$("#panelDesign").attr("style","display:none");}
}

function getMinMaxColors(style){
  	var columnas = style[0].where.substr(0, style[0].where.indexOf(">"));
  	var columna= columnas.replaceAll(" ","");
        var colores = [];
	var minimos = [];
	var maximos = [];
    	for(i=0;i<style.length;i++){
		limits = style[i].where.replaceAll(" ","").replaceAll("<","").replaceAll(">","").replaceAll("=","");
		limits = limits.split("AND");        
        	limits[0] = Math.round(limits[0].replaceAll(columna,""));
	        limits[1] = Math.round(limits[1].replaceAll(columna,""));
                minimos.push(limits[0]);
                maximos.push(limits[1]);                
		if(style[i].polygonOptions!= undefined)
		    colores.push(style[i].polygonOptions.fillColor);
	}
	return {min: minimos, max: maximos, color: colores};
}

function getTipo(minimos, maximos){
        if(minimos[0] == maximos[0]){
		return 'categorias';
	} else {
        	return 'strech';
	}
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
