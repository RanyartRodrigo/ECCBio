String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};

var mapG;

function zoomMas(opcion){
	mapG.setZoom(mapG.getZoom()+opcion);
	mapG.setZoom(mapG.getZoom()+opcion);
}
//---------------------modificado--------------------------------------------
function setMapa(tipo){	
	drawingManager.setMap(mapG);
	switch(tipo){
		case 1:
			mapG.setMapTypeId(google.maps.MapTypeId.ROADMAP);
			break;
		case 2:
			mapG.setMapTypeId(google.maps.MapTypeId.SATELLITE);
			break;
		case 3:
			mapG.setMapTypeId(google.maps.MapTypeId.TERRAIN);
			break;
		case 4:
			mapG.setMapTypeId(google.maps.MapTypeId.HYBRID);
			break;
		case 5:
			$("#dibujar").find(".bmaps-item").removeClass("active");
			$("#dibujar").find(".__"+tipo).addClass("active");
			drawingManager.setDrawingMode(google.maps.drawing.OverlayType.CIRCLE);
			break;
		case 6:
			$("#dibujar").find(".bmaps-item").removeClass("active");
			$("#dibujar").find(".__"+tipo).addClass("active");
			drawingManager.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);
			break;
		case 7:
			$("#dibujar").find(".bmaps-item").removeClass("active");
			$("#dibujar").find(".__"+tipo).addClass("active");
			drawingManager.setDrawingMode(google.maps.drawing.OverlayType.RECTANGLE);
			break;
		case 8:
			drawingManager.setMap(null);
			break;

	}
}
//----------------------------------------------------------------------------------------------
function limpiarcadena(cadena){
  cadena=cadena.toUpperCase();
  cadena=cadena.replace("Ñ","N");
  cadena=cadena.replace("Í","I");
  cadena=cadena.replace("É","E");
  cadena=cadena.replace("Ó","O");
  cadena=cadena.replace("Ú","U");
  cadena=cadena.replace("Á","A");
  return cadena;
}

/*function setLatLong(){
	var resultado=$("#buscar").val();
  resultado=limpiarcadena(resultado);
	var url='https://maps.googleapis.com/maps/api/geocode/json?address='+resultado+'&key=AIzaSyDiAmRBLWnQstHaFcyqfiW2tyJXV_OEyC4';
  console.log(url);
  $.ajax({
	  dataType: "json",
  	url: url,
	  success: function(data) {
	    console.log(data.results[0]);
	    var sw=data.results[0].geometry.bounds.northeast.lng;
	    var ne=data.results[0].geometry.bounds.southwest.lng;
	    var GLOBE_WIDTH = 256; // a constant in Google's map projection
			var west = sw;
			var east = ne;
			var angle = east - west;
			if (angle < 0) {
			  angle += 360;
			}
			var zoomN =angle*0.0192345678;
			if(zoom>5.5)zoomN++;
			else zoomN--;
			if(zoomN<3)zoomN=3;
			console.log(latitudN);
			var latitudN=data.results[0].geometry.location.lat;
			var longitudN=data.results[0].geometry.location.lng;
			mapG.setCenter(new google.maps.LatLng(latitudN,longitudN));
			mapG.setZoom(zoomN);
			closebox("cajabuscar");
		}
	});
}*/

/*function initialize() {
  var options = {
    types: ['(regions)']
  };
  var input = document.getElementById('buscar');
  var autocomplete = new google.maps.places.Autocomplete(input , options);  
}*/

//google.maps.event.addDomListener(window, 'load', initialize);

function printLog(mensaje){
	if(debug){
		console.trace(mensaje);
	}
}

function cargarMenu(tabla, menu, div){
	$.ajax({ 
		url : 'http://www.mofuss.unam.mx/Mapps/Global/fabrica.php', 
		dataType : 'jsonp', 
		data: {
		  t: tabla,
			seleccionado: menu,
		  parent: home,
      format: "json"
    },
		type:"POST",
		success: function(json) {
			$(div).html("");
			$(div).html(json);
			if(tabla!="capas"){
				$(".Msecundario").parent().addClass("active");
			}
    }
 });
}

$(function() {
	printLog("Terminó de cargar!!");
	//menu("2");	
	$("body").append('<div id="shadowing"></div><div id="infoOfLayer" class="lightbox"><div id="contenidoBox"></div><input type="button" value="X" class="closebox" onclick="closebox(\'infoOfLayer\')"/></div>');
	//cargarMenu("capas",mapa,".nav");
 	//cargarMenu("paises",mapa,".Msecundario");
	//cargarMenu("logos",mapa,"#imgMaps");
	//cargarMenu("panel",mapa,"#panelDeControl");
	$("input[type='checkbox']").on("change",function(event){
		eventoChange(event);      
	});
  //$("#loadingDiv").show();
	//loadMap();  
});
$(document).ready(function() {
    console.log("Document ready!")
    $(window).resize(function() {
         google.maps.event.trigger(map, 'resize');
    });
    setTimeout(function(){google.maps.event.trigger(map, 'resize'); printLog("Triggered!");},3000);
});   
