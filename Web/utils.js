var ft = [], lastElement = null;
var unique = true;
function getGeoJson(nombre, columns, geometry){
	console.log('ft Nombre: ', nombre);
	columns = columns.split(',');
	geometry = geometry+'';
	console.log('ft Columnas: ', columns);
	console.log('ft Geometry: ', geometry);

	//HAcer llamada ajax a leer el archivo
	var file = nombre+'.geojson';
	$.getJSON(
		//"/utilities/getGeoJson.php", {file: file},
		"/assets_conabio2/getGeoJson.php", {file: file},                
		function(data){
			var json = JSON.parse(data);
			console.log('datos originales: ', json);
			json = json['features'];
			//var record = json[1];
			//var properties = record['properties'];
			//console.log('Esto trae data: ', json);
			//console.log('Estas son las features: ', json['features']);
			//console.log('Record nombre: ', properties['NOMBRE'], ' id_anp: ', properties['ID_ANP']);

			//formar las columnas para la plantilla
			var columnas = [];
			var especial = '14iTp4T1f2Jio_hVx0zNY4aHjkiSIWVPNew81u1fN';
			//var rutas = '14NlYUxKVK1wO7_Zb3ZAeGCrdSrHF5O9wEoRaay5Q';
			for(var i = 0; i < columns.length; i++){
				columnas[i] = columns[i];
			}
			columnas.push(geometry);
			//formar los datos para la plantilla
			var rows = [];
			for(var i = 0; i<json.length; i++){
				var properties = json[i]['properties'];
				var row = [];
				var nCol = columns.length;
				for(var j = 0; j < nCol; j++){
					if(nombre == especial && columns[j] == 'OBJECTID')
						row.push((i+1)+'');
					else	
						row.push(properties[columns[j]]);
				}
				row.push({"geometries":json[i]["geometry"]});
				rows.push(row);
			}
			
			var plantilla = {
				"kind": "fusiontables#sqlresponse",
				"columns": columnas,
				"rows": rows
			};

			totalRowsInt = rows.length;
			console.log('Esta es la PLANTILLA: ', plantilla);
			ft[0].addPolygons(plantilla);
			unique = true;
		}
	);
	
}
function createFusionTM(params,offset,limit){
	var test = params[0].test;
	console.log('Es prueba?: ', test);
	if((test == undefined || test == true) && unique){
		var temp = new FusionTableM(params,offset);
		ft[0] = temp;
		getGeoJson(params[0].tabla.nombre, params[0].tabla.columns, params[0].tabla.columnaGeometria);
		//unique = false;	
		return;
	}

	var temp = new FusionTableM(params,offset);
	ft[temp.offset] = temp;	
	if(params[0].tabla.nombre === undefined){
		params[0].error(1,"Ocupas poner el id de la tabla");
		return;
	}
	var offsetText = offset === undefined?"":" OFFSET "+offset;	
	var limitText = limit === undefined?"":" LIMIT "+limit;
	var nombreT = params[0].tabla.nombre;
	var columns = params[0].tabla.columns;
	var where = params[0].tabla.where;
	var geometry = params[0].tabla.columnaGeometria;
	var script = document.createElement('script');
	var url = ['https://www.googleapis.com/fusiontables/v2/query?'];
	url.push('sql=');
	var query = 'SELECT '+columns+', '+geometry+' FROM '+
		nombreT + ((where === undefined || where == null)?'':' WHERE '+where);
	query += offsetText+limitText;
	var encodedQuery = encodeURIComponent(query);
	url.push(encodedQuery);
	url.push('&callback=ft['+temp.offset+'].addPolygons');
	url.push('&key='+params[0].key);
	script.src = url.join('');
	var body = document.getElementsByTagName('body')[0];
	body.appendChild(script);
}
function FusionTableM(params,offset){
	this.params = params;
	this.offset = offset===undefined?0:offset;
	this.click = false;
	var mapa = params[0].map;
	//console.log("el centro del mapa es: ", mapa.getCenter());
	hasCloseButton = params[1].hasCloseButton===undefined?true:params[1].hasCloseButton;
	if(this.offset == 0){
		this.ventana = new google.maps.InfoWindow({maxWidth: params[0].maxWidth,zIndex:1001,pixelOffset: new google.maps.Size(0,0)});
		google.maps.event.addListener(this.ventana, "domready", 
			function(){				
				var iwOuter = $('.gm-style-iw');
				var iwBackground = iwOuter.prev();
				//iwOuter.parent().parent().css({'bottom': '-40px'});
				iwBackground.children(':nth-child(1)').css({'display' : 'none'});
				iwBackground.children(':nth-child(2)').css({'display' : 'none'});
				iwBackground.children(':nth-child(3)').css({'display' : 'none'});
				iwBackground.children(':nth-child(4)').css({'display' : 'none'});
				//iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});
				//iwBackground.children(':nth-child(3)').find('div>div').css({'background':'#6B757D'});
				var iwCloseBtn = iwOuter.next();
				iwCloseBtn.css({opacity: '1',width: '25px',height: '25px',right: '25px',top: '19px','background-color': '#535961',color: 'white','font-size': '20px','font-weight': '700','font-family': 'sans-serif'});
				iwCloseBtn.html("x");
				if($('.iw-content').height() < 140){
				  $('.iw-bottom-gradient').css({display: 'none'});
				}
				iwCloseBtn.mouseout(function(){
				  $(this).css({opacity: '1'});
				});
				if(!hasCloseButton){
					console.log(iwCloseBtn);
					iwCloseBtn.remove();
				}
				//$('.gm-style-iw').attr('background-color','transparent');
			  });
	}else{
		this.ventana = ft[0].ventana;
	}	
}
FusionTableM.prototype.addElement = function(element,columns) {
	var ft = this;
	var mapa = ft.params[0].map;
	//console.log("el centro del mapa es: ", mapa.getCenter());
	var showOnlyClick = ft.params[1] !== undefined && ft.params[1].showOnlyClick !== undefined?ft.params[1].showOnlyClick:false;
	google.maps.event.addListener(element, 'rightclick', function(e){
		var pol = this;
		if(lastElement != element){
			lastElement = element;
			if(ft.params[1] !==undefined && ft.params[1].infoWindow === undefined && !showOnlyClick){
				if(!ft.areEmpty(columns)){
					var content = ft.constructInfoWindowContent(columns);
					ft.ventana.setContent(content);
					ft.ventana.setPosition(e.latLng);
					//ft.ventana.setPosition(mapa.getCenter());
					setTimeout(function(){ft.ventana.open(ft.params[0].map);},100);
				}
			}
		}
		if(ft.params[1]!==undefined && 
			ft.params[1].caja !== undefined && 
			ft.params[1].caja.mouseover !== undefined)
				setTimeout(function(){ft.params[1].caja.mouseover(e,columns,pol,ft.ventana);},10);
	});
	/*google.maps.event.addListener(element, 'mouseover', function(e){
		var pol = this;
		var municipios = ft.params[0].municipios;	
		if(ft.params[1]!==undefined && 
			ft.params[1].caja !== undefined && 
			ft.params[1].caja.mouseover !== undefined){
				setTimeout(function(){ft.params[1].caja.mouseover(e,columns,pol,ft.ventana);},10);
				if(municipios){
					var content = ft.constructInfoWindowContent(columns);
					ft.ventana.setContent(content);
					ft.ventana.setPosition(e.latLng);
					//ft.ventana.setPosition(mapa.getCenter());
					setTimeout(function(){ft.ventana.open(ft.params[0].map);},100);
				}
			}
	});*/
	
	google.maps.event.addListener(element, 'mouseout', function(e) {
		var pol = this;
		var municipios = ft.params[0].municipios;
		if(municipios){
			ft.ventana.close();
		}
		//ft.ventana.close();
		lastElement = null;
		if(ft.params[1] !==undefined && 
			ft.params[1].caja !== undefined && 
			ft.params[1].caja.mouseout !== undefined)
				setTimeout(function(){ft.params[1].caja.mouseout(e,columns,pol);},10);
	});

	if(ft.params[1]!==undefined && 
		ft.params[1].caja !== undefined && 
		ft.params[1].caja.mouseclick !== undefined){
			google.maps.event.addListener(element, 'click', function(e) {
				if(ft.params[1] !==undefined && ft.params[1].infoWindow === undefined){
					if(!ft.areEmpty(columns)){
						var content = ft.constructInfoWindowContent(columns);
						ft.ventana.setContent(content);
						ft.ventana.setPosition(e.latLng);
						//ft.ventana.setPosition(mapa.getCenter());
						setTimeout(function(){ft.ventana.open(ft.params[0].map);},100);
					}
				}
				setTimeout(function(){ft.params[1].caja.mouseclick(columns[0],columns[2]);},10);
			});
	}
}
FusionTableM.prototype.constructInfoWindowContent = function(columns){	
	var clase = this.params[1].clase, cuerpo = this.params[1].cuerpo;
	var totalCols = this.params[1].cols === undefined ? 1:this.params[1].cols;
	var totalRows = this.params[1].rows === undefined ? cuerpo.length:this.params[1].rows;
	var widths = this.params[1].widths === undefined ? []:this.params[1].widths;
	var claseTabla = this.params[1].claseTabla;
	var estructura = "<div style='width:"+this.params[0].maxWidth+"px !important;' id='base' class='"+clase+"'><table style='width:100% !important; table-layout:fixed !important;' id='tablaTemp' class='"+claseTabla+"'>";
	//var	abecedario = ['a', 'b', 'c', 'd', 'e', 'f', 'g'];
	var	abecedario = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k'];
	if(this.params[1].cuerpo === undefined){
		estructura += "</table></div>";
		return estructura;
	}
	if(widths.length>=1){
		estructura+='<tr style="background-color: transparent;">';
		for(var i = 0; i < widths.length;i++){
			estructura+='<td style="width:'+widths[i]+'px"></td>';
		}
		estructura+='</tr>';
	}
	for(var row=0;row < totalRows;row++){
		estructura += '<tr style="background-color: transparent;">';
		for(var col = 0; col < totalCols; col++){
			var pos = abecedario[col]+row;
			for(var contenido = 0; contenido < cuerpo.length; contenido++){				
				if( pos == cuerpo[contenido]['pos']){
					var rowspan = cuerpo[contenido].rowspan, colspan = cuerpo[contenido].colspan;
					var style = cuerpo[contenido].style, texto = cuerpo[contenido]['texto'];
					var onclick = cuerpo[contenido]['onclick'], tipo = cuerpo[contenido]['tipo'];
					var parametros = cuerpo[contenido]['parametros'], class_ = cuerpo[contenido]['class_'];
					var icono = cuerpo[contenido]['icono'],src = cuerpo[contenido]['src'];
					var width = cuerpo[contenido]['width'], height = cuerpo[contenido]['height'];
					var cursor = cuerpo[contenido]['cursor'], id = cuerpo[contenido]['id'];
					var title = cuerpo[contenido]['title'];
					title = title === undefined?"":" title='"+title+"' ";
					width = width === undefined?"":" width: "+width+" !important;";
					height = height === undefined?"":" height: "+height+" !important;";
					cursor = cursor === undefined?"":" cursor: "+cursor+" !important;";
					id = id === undefined?"":" id='"+id+"' ";
					src = src === undefined?"":" src='"+src+"' ";
					texto = texto === undefined?"":texto;
					rowspan = rowspan === undefined?1:rowspan;
					colspan = colspan === undefined?1:colspan;
					estructura += "<td rowspan='"+rowspan+"' colspan='"+colspan+"' class='"+style+"'>";					
					while(texto.includes("|")){
						var number = this.getNumber(texto), valor;
						if(cuerpo[contenido]['getExtra'] !== undefined){
							valor = cuerpo[contenido]['getExtra'](columns[number]);
						} else {
							valor = columns[number];
							if(valor!="" && !isNaN(valor)){
								valor = numberWithCommas(Math.round(valor*10)/10);
							}
						}
						texto = texto.replace("|"+number,valor);
					}
					var onclickText = this.getOnclickText(parametros,onclick,columns);
					var iconoText = this.getIconoText(icono);
					estructura += "<"+tipo+onclickText+src+id+" style='"+width+height+cursor+"' "+title+">"+iconoText+texto+"</"+tipo+">";					
					break;
				}
			}
			estructura += "</td>";
		}
		estructura += "</tr>";
	}
	if(widths.length>=1){
		estructura+='<tr style="background-color: transparent !important;">';
		for(var i = 0; i < widths.length;i++){
			estructura+='<td style="width:'+widths[i]+'; border-top: none !important;"></td>';
		}
		estructura+='</tr>';
	}
	estructura += "</table></div>";
	return estructura;
}
FusionTableM.prototype.getOnclickText = function(parametros,onclick,columns){
	var onclickText;
	if(onclick !== undefined){
		parametros = parametros === undefined?"":parametros; 
		var posParam=parametros==""?[]:parametros.split(','), param= [];
		onclickText = " onclick='"+onclick+"(this";
		for(var index = 0 ; index < posParam.length; index++ ){
			param.push('"'+columns[posParam[index]]+'"');
		}
		if(param.length>=1) onclickText+=",";
		onclickText+=param+")'";
	} else {
		onclickText = " ";
	}
	return onclickText;
}
FusionTableM.prototype.areEmpty = function(columns){	
	for(var i=0;i<columns.length;i++){
		if(columns[i]!=null && (""+columns[i]).trim()!="") return false;
	}
	return true;
}
FusionTableM.prototype.getIconoText = function(icono){
	var iconoText = "";
	if(icono !== undefined){
		iconoText = "<i class='"+icono+"'aria-hidden='true'></i>";
	}
	return iconoText;
}
FusionTableM.prototype.getNumber = function(text){
	var number = "";
	for(var i = 0; i < text.length; i++){
		if(text[i] == "|"){
			while(!isNaN(text[i+1])){
				number += text[i+1];
				i++;
			}
			break;
		}
	}
	return parseInt(number);
}
FusionTableM.prototype.getWhereColumn = function(where){
	var whereColumn = '';
	for(var i=0;i<where.length-1;i++){
		whereColumn+=where[i];
		if(where[i+1] == "<" || where[i+1] == ">" || where[i+1] == "!" || where[i+1] == "=") break;
	}
	return whereColumn;
}
FusionTableM.prototype.findIndex = function(options,columns,columnNames){
	if(options.length == 1) return 0;
	for(var i=0; i<options.length;i++){
		if(options[i].where !== undefined){
			var where = options[i].where;
			var wc = this.getWhereColumn(where);			
			var indexWhere = columnNames.indexOf(wc);			
			var valorColumn = columns[indexWhere];			
			var cond = where.replaceAll(wc,valorColumn);			
			cond = cond.replaceAll("AND","&&");
			cond = cond.replaceAll("OR","||");
			cond = cond.split("$");
			var resp = false;
			var cadena = "if("+cond[0]+") resp=true;";
			eval(cadena);
			if(resp) return i;
		}
	}
	return 0;
}
FusionTableM.prototype.getMarkerOptions = function(markerOptions, index){	
	return markerOptions[index].markerOptions.iconName;
}
FusionTableM.prototype.getPolylineOptions = function(polylineOptions, index){
	strokeColor=polylineOptions[index].polylineOptions.strokeColor;strokeWeight=polylineOptions[index].polylineOptions.strokeWeight;
	strokeOpacity=polylineOptions[index].polylineOptions.strokeOpacity; return [strokeColor,strokeOpacity,strokeWeight];	
}
FusionTableM.prototype.getPolygonOptions = function(polygonOptions, index){
	strokeColor=polygonOptions[index].polygonOptions.strokeColor;fillOpacity=polygonOptions[index].polygonOptions.fillOpacity;
	strokeOpacity=polygonOptions[index].polygonOptions.strokeOpacity;strokeWeight=polygonOptions[index].polygonOptions.strokeWeight;
	fillColor=polygonOptions[index].polygonOptions.fillColor;return [strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity];
}
FusionTableM.prototype.addPolygons = function(data){
	var auxOpenKML='<?xml version="1.0" encoding="UTF-8"?><kml xmlns="http://earth.google.com/kml/2.1"><Document><Placemark><name></name><description></description>';
	var auxCloseKML='</Placemark></Document></kml>';
	if(data.error !== undefined){
		this.params[0].error(2,data.error.message,this.params);
		return;
	}
	if(data['rows'] === undefined) return;
	console.log('data dentro de addPolygons', data);
	//console.log('data[rows] dentro de addPolygons', data['rows']);
	var visible = this.params[0].visible !== undefined ? this.params[0].visible:true;
	var rows = data['rows'], columnNames = data['columns'];
	var zIndex = this.params[0].zIndex !== undefined ? this.params[0].zIndex:10;
	var typeFigure,tamCols = this.params[0].tabla.columns.split(',').length,style = this.params[0].tabla.style;
	var polygonOptions=[],polylineOptions=[],markerOptions=[],strokeColor,strokeOpacity,strokeWeight,fillColor,fillOpacity;
	var strokeColorD="#FF0000",strokeOpacityD=1,strokeWeightD=2,fillColorD="#FFFFFF",fillOpacityD=1,iconName="measle_brown";

	for(var i=0; i<style.length; i++){
		if(style[i].polygonOptions !== undefined){
			polygonOptions.push(style[i]);
		}else if(style[i].polylineOptions !== undefined){
			polylineOptions.push(style[i]);
		}else{
			markerOptions.push(style[i]);
		}
	}
	var totalAdded = null;
	for(var i=0; i<rows.length; i++) {
		var columns = [],geometries;
		for(var k = 0; k<tamCols;k++){
			columns.push(rows[i][k]);
		}
		var newCoordinates = [];		
		if(typeof rows[i][tamCols] == "string"){
			var xmlDoc = jQuery.parseXML(auxOpenKML+rows[i][tamCols]+auxCloseKML);
			rows[i][tamCols] = (toGeoJSON.kml(xmlDoc)).features[0];
			geometries = rows[i][tamCols]['geometry']['geometries'];
		} else {
			geometries = rows[i][tamCols]['geometries'];
		}
		if(geometries instanceof Array) {
			typeFigure = geometries[0].type;
			for (var j=0; j<geometries.length; j++) {
				if(geometries[j]['coordinates'][0] instanceof Array &&
				   geometries[j]['coordinates'][0][0] instanceof Array){
					for(var ll=0; ll<geometries[j]['coordinates'].length;ll++){
						var coordinates = geometries[j]['coordinates'][ll];
						newCoordinates.push(this.constructNewCoordinates2(coordinates,typeFigure));
					}
				} else {					  
					newCoordinates.push(this.constructNewCoordinates(geometries[j],typeFigure));
				}
			}		
		} 
		else if(geometries instanceof Object){
			console.log('entre al caso de objeto');
			typeFigure = geometries.type;

			if(geometries['coordinates'][0] instanceof Array &&
			  geometries['coordinates'][0][0] instanceof Array){
					for(var ll=0; ll<geometries['coordinates'].length;ll++){
						var coordinates = geometries['coordinates'][ll];
						if(typeFigure == 'MultiPolygon')
							for(var lll = 0; lll < coordinates.length; lll++)
								newCoordinates.push(this.constructNewCoordinates2(coordinates[lll],typeFigure));
						else if(typeFigure == 'MultiLineString')
							newCoordinates.push(this.constructNewCoordinates2(coordinates,typeFigure));
					}
				} else {					  
					newCoordinates.push(this.constructNewCoordinates(geometries[j],typeFigure));
				}
			
		}
		else {
			if(rows[i][tamCols]['geometry']['coordinates'][0] instanceof Array &&
				rows[i][tamCols]['geometry']['coordinates'][0][0] instanceof Array){
				for (var j=0; j<rows[i][tamCols]['geometry']['coordinates'].length; j++) {
					var coordinates = rows[i][tamCols]['geometry']['coordinates'][j];
					newCoordinates.push(this.constructNewCoordinates2(coordinates,typeFigure));
				}
			}else{
				newCoordinates = this.constructNewCoordinates(rows[i][tamCols]['geometry']);
			}
			typeFigure = rows[i][tamCols]['geometry'].type;
		}
		switch(typeFigure){
			case "Polygon": case "MultiPolygon":
				var index = this.findIndex(polygonOptions,columns,columnNames);
				var po=this.getPolygonOptions(polygonOptions,index);
				strokeColor = po[0] === undefined?strokeColorD:po[0];strokeOpacity = po[1] === undefined?strokeOpacityD:po[1];
				strokeWeight = po[2] === undefined?strokeWeightD:po[2];fillColor = po[3] === undefined?fillColorD:po[3];
				fillOpacity = po[4] === undefined?fillOpacityD:po[4]; break;
			case "Point":
				var index = this.findIndex(markerOptions,columns,columnNames);
				iconName=this.getMarkerOptions(markerOptions,index);
				break;
			case "LineString": case "MultiLineString":
				var index = this.findIndex(polylineOptions,columns,columnNames);				
				var po=this.getPolylineOptions(polylineOptions,index);			
				strokeColor = po[0] === undefined?strokeColorD:po[0];strokeOpacity = po[1] === undefined?strokeOpacityD:po[1];
				strokeWeight = po[2] === undefined?strokeWeightD:po[2]; break;
				break;
		}
		var element = null;
		if(typeFigure == "Polygon" || typeFigure == 'MultiPolygon'){
			element = new google.maps.Polygon({               
				paths: newCoordinates,
				strokeColor: strokeColor,
				strokeOpacity: strokeOpacity,
				strokeWeight: strokeWeight,
				fillColor: fillColor,
				fillOpacity: fillOpacity,
				map: this.params[0].map,
				visible: visible,
				zIndex: zIndex
			});
		}else if(typeFigure == "Point"){
			element = new google.maps.Marker({
				position: newCoordinates[0],
				map: this.params[0].map,
				icon: pathIcons+iconName+".png",
				zIndex: zIndex				
			});
		}else if(typeFigure == "LineString" || typeFigure == "MultiLineString"){
			var auxCoords = [];
			if(newCoordinates[0] instanceof Array){
				for(var r=0;r<newCoordinates.length;r++){					
					for(var c=0;c<newCoordinates[r].length;c++){
						auxCoords.push(newCoordinates[r][c]);						
					}
				}
			} else {
				auxCoords = newCoordinates;
			}			
			element = new google.maps.Polyline({
				path: auxCoords,
				map: this.params[0].map,
				strokeColor: strokeColor,
				strokeOpacity: strokeOpacity,
				strokeWeight: strokeWeight,
				visible: visible,
				zIndex: zIndex
			});
		}
		var pos;
		if(this.params[0].storePol !== undefined){
			var offset = this.offset;			
			if( this.params[0].hasId !== undefined &&
				this.params[0].hasId &&
				!isNaN(columns[0]) && 
				columns[0].trim()!=""){
				pos = columns[0];
				if(!isNaN(columns[1])){
					pos = i + offset;
				}
				if(this.params[0].municipios === undefined){
					pos = parseInt(pos);
				}
				else if(this.params[0].municipios){
					pos = parseInt(columns[2]+pos);
				}
			} else {
				pos = i + offset;
			}
			eval(this.params[0].storePol+"."+this.params[0].data+"["+pos+"]=element");
			eval(this.params[0].storePol+"."+this.params[0].idData+".push(pos)");			
		}
		if(this.params[0].storeData !== undefined){                
			//var pos = parseInt(columns[0]);
			eval(this.params[0].storeData+"["+pos+"]=columns");
		}
		if(element != null){
			this.addElement(element,columns);
		}
	}
	if(this.params[0].storePol !== undefined){
		eval("totalAdded="+this.params[0].storePol+"."+this.params[0].idData+".length");
	}
	this.params[0].success(totalAdded,this.offset);
}
FusionTableM.prototype.constructNewCoordinates2 = function(coordinates,type) {
	var newCoordinates = [];
	for (var i=0; i<coordinates.length; i++) {			
		newCoordinates.push(
			new google.maps.LatLng(coordinates[i][1], coordinates[i][0]));
	}	
	return newCoordinates;
}
FusionTableM.prototype.constructNewCoordinates = function(polygon,type) {
	if(polygon['coordinates'] === undefined) return;	
	var newCoordinates = [];
	var coordinates;
	if(polygon['coordinates'][0] instanceof Array && 
		polygon['coordinates'][0][0] instanceof Array){
		var coordinates = polygon['coordinates'];
		for (var i=0; i<coordinates.length; i++) {		
			for(var j=0; j<coordinates[i].length;j++){
				newCoordinates.push(
					new google.maps.LatLng(coordinates[i][j][1], coordinates[i][j][0]));
			}
		}
	}else if(polygon['coordinates'][0] instanceof Array && 
			!(polygon['coordinates'][0][0] instanceof Array)){
		var coordinates = polygon['coordinates'];
		for (var i=0; i<coordinates.length; i++) {			
			newCoordinates.push(
				new google.maps.LatLng(coordinates[i][1], coordinates[i][0]));
		}
	}else{
		var coordinates = polygon['coordinates'];
		newCoordinates.push(
			new google.maps.LatLng(coordinates[1], coordinates[0]));
	}
	if(type == "Polygon"){		
		if(this.isLatLngEq(newCoordinates[0],newCoordinates[newCoordinates.length-1])){
			newCoordinates.pop();			
		}
	}
	return newCoordinates;
}
FusionTableM.prototype.isLatLngEq = function(coord1,coord2){
	return (coord1.lat() == coord2.lat() && coord1.lng() == coord2.lng());
}
function FTStore(type){
	this.type=type;
	this.elements=[];
	this.ids=[];
}
FTStore.prototype.setMap = function(map){
	for(var i=0; i < this.ids.length; i++){
		this.elements[this.ids[i]].setMap(map);
	}
};
FTStore.prototype.setVisible = function(band){
	for(var i=0; i < this.ids.length; i++){
		this.elements[this.ids[i]].setVisible(band);
	}
};
FTStore.prototype.setOpacity = function(opacity){
	var options;
	if(this.elements[this.ids[0]] instanceof google.maps.Polyline){
		options = {strokeOpacity:opacity};
	} else if(this.elements[this.ids[0]] instanceof google.maps.Polygon){
		options = {fillOpacity:opacity};
	} else {
		options = {opacity:opacity};
	}
	console.log(options,opacity,this.ids.length);
	for(var i=0; i < this.ids.length; i++){
		this.elements[this.ids[i]].setOptions(options);
	}
};
String.prototype.hashCode = function() {
	var hash = 0, i, chr, len;
	if (this.length === 0) return hash;
	for (i = 0, len = this.length; i < len; i++) {
		chr   = this.charCodeAt(i);
		hash  = ((hash << 5) - hash) + chr;
		hash |= 0;
	}
	return hash;
};