var infoANP = [;
var ANPS = [];
var minPdf = [];
var maxPdf = [];
var titulos = [];
var images = [];
var divs = [];
var scroll = 0;
var divsCharts = [];
var imgData = [];
var chartData = [];
var t_max = [];
var t_min = [];
var t_prec = [];
var anpDatos = -1;
var single = false;
var positions = [null, ['-500px','500px'],['-500px'],['-1000px','500px']];
var num_anps = 0;
var traces = [];

var storeP = [[],[]];
var storeData = [];
var bioTempP = [[],[]];
var bioPrecT = [[],[]];
var bioTempPMean = [[],[]];
var bioTempPMedian = [[],[]];
var bioTempPMax = [[],[]];
var bioTempPMin = [[],[]];
var chart = null, data = null, dataView = null;
var lastEra = 0;

function fillData(variables){
	var i = 250;
	var idsANP = "";
	for(var j = 1; j < 138; j++){
		idsANP += j+",";
	}
	idsANP += "138";
	for(var j = 0; j < variables.length; j++){
		var k = variables[j];
		setTimeout(fillDataAux,i,k,idsANP);
	}
}

function fillDataAux(variable,idsANP){
	$.getJSON('http://www.wegp.unam.mx/admin/Global/getTemp.php',{metadata:idsANP,variable:variable,idTemporada:1},function(data){		
		for(var j = 0; j < data.length; j++){
			eval("var dataT = "+data[j]);			
			if(variable == 6){				
				for(var i = 0; i < dataT.length; i++){					
					var pos = parseInt(j+1);
					if(bioTempP[pos] === undefined) bioTempP[pos] = [];
					bioTempP[pos][i]=dataT[i];
				}
			}else if(variable == 7){
				for(var i = 0; i < dataT.length; i++){					
					var pos = parseInt(j+1);
					if(bioPrecT[pos] === undefined) bioPrecT[pos] = [];
					bioPrecT[pos][i]=dataT[i];
				}
			}else if(variable == 8){
				for(var i = 0; i < dataT.length; i++){					
					var pos = parseInt(j+1);
					if(bioTempPMean[pos] === undefined) bioTempPMean[pos] = [];
					bioTempPMean[pos][i]=dataT[i];
				}
			}else if(variable == 10){
				for(var i = 0; i < dataT.length; i++){					
					var pos = parseInt(j+1);
					if(bioTempPMedian[pos] === undefined) bioTempPMedian[pos] = [];
					bioTempPMedian[pos][i]=dataT[i];
				}
			}else if(variable == 12){
				for(var i = 0; i < dataT.length; i++){					
					var pos = parseInt(j+1);
					if(bioTempPMax[pos] === undefined) bioTempPMax[pos] = [];
					bioTempPMax[pos][i]=dataT[i];
				}
			}else if(variable == 13){
				for(var i = 0; i < dataT.length; i++){					
					var pos = parseInt(j+1);
					if(bioTempPMin[pos] === undefined) bioTempPMin[pos] = [];
					bioTempPMin[pos][i]=dataT[i];
				}
			}
		}
	});
}

function envia(t, anp, p,temporada,borrar){
	if(anp.includes(",") && p != 3){
		anp = anp.split(",");
		anp.sort(function(a, b) {
			return a - b;
		});
		anp = anp.join(",");
		console.log("Arreglo ordenado: "+anp);
	}
	varMeta = (p!==3)?anp:'Poligono';
	if(borrar === undefined)
		borrar=true;
	if(borrar){
		printLog("Se borró conabioEstadisticas :(");
		$('#conabioEstadisticas').empty();
	}
	divs = [];
	ANPS = anp;
	var url = (p==3)?'/getclimatedata':(p==1)?'http://www.wegp.unam.mx/admin/Global/getTempE.php':'http://www.wegp.unam.mx/admin/Global/getTemp.php';	
	divs = [];
	traces = [];
	divsCharts = [];
	titulos = [];
	minPdf = [];
	maxPdf = [];
	images = [];
	console.log("Inside envia ",p,t,anp,temporada,url);
	$.getJSON(url, {pol: p, variable: t, metadata: anp,idTemporada:temporada},
		function(data) {
			k = data.length;
			var years=[];
			if(p == 3)
				divs = [];
			for (var m=0; m<k; m++){		
				years[m] = [];				
				if(p == 0)
					eval("var datosT = "+data[m]);
				else if (p == 3){
					var datosT = data[0];					
					var idsANP = '['+data[0][7].idsANP+']';
					idsANP = idsANP.substring(1,idsANP.length-1);
					//envia(t,idsANP,0,false);
					$("#cortina").addClass("removeCortina");
				}else{
					eval("var datosT = "+data[m][0]);
					console.log(datosT);
					/*var idsANP = data[m].idsANP;
					idsANP = idsANP.substring(1,idsANP.length-1);
					printLog("idsANP: "+idsANP);*/
					//envia(t,idsANP,0,false);
				}
				for(var i=0;i<7;i++){
					years[m][i] = [];
					var datos = datosT[i];
					n = datos.length;
					if(n == 0){
						years[m][i] = [];
					}
					for(var l=0; l<n; l++){
						if(datos[l].includes("x")){
							var datosR = datos[l].split("x");
							var contAux = 0;
							while(contAux<datosR[1]){
								years[m][i].push(datosR[0]);
								contAux++;
							}
						}else{
							years[m][i].push(datos[l]);
						}
					}
				}
			}
			console.log('years: ', years);
			graphicDivs(years, k, varMeta, borrar,  p, t);
		});
	$("#conabioEstadisticas").addClass("showEstadisticas");
	$("#conabioEstadisticas").addClass("ui-widget-content");
}

function creaEstructura(divs){
	var n = divs.length;
	console.log('TAMAnio de divs: ', n);
	if(!$('#graficasConabio').length){
		var estructura = '<table id= "graficasConabio" >',
			auxTd = 0,
			paraOcultar = '<button class="c" onclick="showEstadisticas()">X</button>';
			paraExportar = '<img class="exportar colorElementos5" onclick="exportaDatos()" src="http://www.wegp.unam.mx/admin/Conabio2/assets/ico/download.png"/>'
		$('#conabioEstadisticas').append(paraOcultar);
		$('#conabioEstadisticas').append(paraExportar);                
		for(var ind = 0; ind <2; ind++ ){
				estructura += '<tr id= "fila-'+ind+'" class="fondoElementos1 colorElementos5">';
				for( var i = 0; i<2; i++ ){
						estructura += '<td id = "row-'+auxTd+'"></td>';
						auxTd ++;
				}
				estructura += '</tr>';
		}
		estructura += '</table>';  
		$('#conabioEstadisticas').append(estructura);
	}
	if(n == 1){
		$('table#graficasConabio td ').each( function(i, val){
			var row = $(this).attr('id'), 
				pos =  row.split('-'), 
				id = '#'+row;   
			if(parseInt(pos[1]) == 0){
					$(id).attr('rowspan',2);
					var informacion = '<div class ="row" id = "tablaRow"></div><div class= "row" id = "graficaRow"></div>';
					$(id).append(informacion);
			}
			if( parseInt(pos[1]) > 0 ){
					$(id).hide();
			}
		});			
		$('#tablaRow').append($('#tit'));
		$('#tablaRow').find('#tit').show();
		if($('#menuTabla').length){
			$('#menuTabla').remove();				
		}
		$('#tablaRow').append(tabla1());		
		var imagenId =  $('#'+divs[0]);
		$('#graficaRow').append(imagenId);
	}else{
		$('table#graficasConabio td ').each( function(i, val){
			console.log(this);
			var row = $(this).attr('id'),
				pos =  row.split('-'),
				id = '#'+row,
				div = '<div id="infoGeneral-'+i+'"></div>';
			$(id).append(div);
		});
		if(!$('#menuTabla').length)		
			$('#divSelect').append(tabla1());		
		$.each(divs, function(i,v){
			var imagenId = $('#'+divs[i]),
			idDiv = '#infoGeneral-'+i;
			$(idDiv).append(imagenId);
		});
	}	
	$("#variable").change(function(e){cambioVariable(e);});
	$("#tiempo").change(function(e){cambioTemporada(e);});
	$("#variable").val('2').change();
	$("#tiempo").val('1').change();
}

function graphicDivs(years, n, anp, borrar,p, variable){
	if(p != 3){
		anp=anp.split(',');
	}else{
		anp[0]= anp;
	}
	divs = [];
	for(var i=0; i<n; i++){
		var mins = [];
		var maxs = [];
		var data = [];
		var str = '';
		printLog(variable);
		switch(parseInt(variable)){
			case 2: str = 'Precipitacion total anual (mm)'; break;
			case 3: str = 'Temperatura máxima anual (°C)'; break;
			case 4: str = 'Temperatura mínima anual (°C)'; break;
			case 5: str = 'Temperatura media anual (°C)'; break;			
		}
		printLog(str);
		//el ciclo comienza en 1 para saltar el primer periodo 1910
		//console.log("Hello");
		for(var t=0;t<7;t++){
			mins.push(Math.min.apply(null, years[i][t]));
			maxs.push(Math.max.apply(null, years[i][t]));
			data[t] = {
				y: years[i][t], 
				type: 'box',
				name: getName(t),
				marker: { 
					color: getColor(t,true),
					//opacity: 0.9,
					//fillcolor: getColor(t)
				  },
				fillcolor: getColor(t),
				boxpoints: 'false' 
			};
		}
		var titulo = '';
		if(anp.length > 1){
			titulo = nombresANP[anp[i]];
			$('#conabioEstadisticas').css('width','1035px');
			$('#conabioEstadisticas').css('right','-1070px');
			if(anp.length == 2){
				$('#conabioEstadisticas').css('height','680px');
			}
			else{
				$('#conabioEstadisticas').css('height','1200px');
			}
		}else{
			$('#conabioEstadisticas').css('width','580px');
			$('#conabioEstadisticas').css('right','-600px');
			$('#conabioEstadisticas').css('height','1030px');
		}
		var tituloLayout = p==0?nombresANP[anp[i]]:'';
		var layout={
			showlegend: false,
			yaxis: {title: str},
			//title: tituloLayout,
			paper_bgcolor: '#F5F6F4',
			width: 500,
			height: 500			
		}
		// var layout={
			// showlegend: false,
			// yaxis: {title: str},
			// //title: 'Poligono',
			// //plot_bgcolor: 'rgb(240,240,240)',
			// plot_bgcolor: '#F5F6F4',
			// //opacity: 0.9,
			// //theme: 'ggplot',
			// //fillcolor: 1
			// width: 500,
			// height: 500
		// }		
		var strDiv = "graficas"+anp[i]+"-"+p+"-"+i;
		divs[i] = strDiv;
		$('<div/>', {id: strDiv }).appendTo('#conabioEstadisticas');
		if(!$('#image'+i).length){
			$('<div/>', {
					id: 'image'+i
				}).appendTo("#conabioEstadisticas");
				$('#image'+i).append('<img id="jpg-export'+i+'"></img>');
		}
		setTimeout(Plot, 250, strDiv, data, layout, i, anp);
		$('#image'+i).hide();
		minPdf[i] = mins;
		maxPdf[i] = maxs;
	}
	for(var i=0; i<anp.length; i++)
		titulos[i] = nombresANP[anp[i]];
	if(anp.length == 1){
		t_prec = bioPrecT[anp[0]];
		t_max = bioTempPMax[anp[0]];
		t_min = bioTempPMin[anp[0]];
		divStyle(strDiv, anp[0],borrar,p);
	}
	
	else if(anp.length > 1){
		for(var i = 0; i < anp.length; i++)
		{
                	t_prec = bioPrecT[anp[i]];
                	t_max = bioTempPMax[anp[i]];
                	t_min = bioTempPMin[anp[i]];
                	divStyle(divs[i], anp[i], borrar,p);
			console.log('Entre: ', divs[i]);
		}
        }

	
	
	if(borrar){
		setTimeout(creaEstructura, 1300, divs);
	}else{
		if(divs.length == 1){			
			var imagenId =  $('#'+divs[0]);
			$('#graficaRow').empty();
			$('#graficaRow').append(imagenId);
		}else{
			$('#infoGeneral-*').empty();
			$.each(divs, function(i,v){
				var imagenId = $('#'+divs[i]),idDiv = '#infoGeneral-'+i;
				$(idDiv).append(imagenId);
			});
		}
	}
}

function Plot(div, data, layout, i, anp){
	var d3 = Plotly.d3;
	var img_jpg = d3.select('#jpg-export'+i);
	Plotly.newPlot(div, data, layout).then(function(gd){
		Plotly.toImage(gd,{height:500,width:500,margin:"auto"}).then(function(url){
			$(".svg-container").css("margin","auto");
			img_jpg.attr("src", url);
			return Plotly.toImage(gd,{format:'jpeg',height:500,width:500});
		})
	});
}

function exportaDatos(){
	var n = divs.length;
	printLog(n);
	ANPS = ANPS.split(',');
	var prec = [];
	var tmax = [];
	var tmin = [];
	for(var i = 0; i < n; i++){
		images[i] = $('#jpg-export'+i).attr('src');
		prec[i] = bioPrecT[ANPS[i]];
		tmax[i] = bioTempPMax[ANPS[i]];
		tmin[i] = bioTempPMin[ANPS[i]];
	}
	var t = titulos;
	var t1 = maxPdf;
	var t2 = minPdf;
	var imgs = images;
	//printLog("Images: "+images);
	$.ajax({
		url: 'http://www.wegp.unam.mx/admin/Conabio2/reportesPDF/creaPDF.php',
		type: 'POST',
		data: {img: imgs, titulos: t, max: t1, min: t2, prec: prec, tmax: tmax, tmin: tmin},
		dataType: 'json',
		success: function(blob){
			var link = document.createElement('a');
			link.target="_blank";
			link.href = blob;
			link.download = "reporte.pdf";
			link.click();
			showEstadisticas();
		}
	});
}

function divStyle(div, anp, borrar, pol){
	if($('#tit'+div).length && borrar){
		$('#tit'+div).remove();
	}
	if($('#tit'+div).length) return;
	//$('<div/>',{id: 'tit'}).prependTo("#conabioEstadisticas");
	$('<div/>',{id: 'tit'+div}).prependTo("#"+div);
	if(pol == 0)
		$("#tit"+div).html(nombresANP[anp]);
	else if(pol == 1)
		$("#tit"+div).html(nombresEstados[anp]);	
	$("#tit"+div).addClass("fondoElementos1 colorElementos5");
	$('#tit'+div).css('fontSize','24');
	$('#tit'+div).css('fontWeight','bold');
	$('<div/>',{id:'cambProy'+div}).appendTo('#tit'+div);
	$("#cambProy"+div).html("<b>Cambio proyectado (RCP 8.5)</b>");
	$("#cambProy"+div).addClass("fondoElementos2 colorElementos5");
	$('#cambProy'+div).css('fontSize','20');
	$('#cambProy'+div).css('fontWeight','normal');
	$('#cambProy'+div).css('marginTop','10px');
	$('<div/>',{id: 'text'+div}).appendTo('#tit'+div);	
	$('#text'+div).html('La <b>temperatura m&aacutexima</b> exceder&aacute el promedio hist&oacuterico por: <br><ul><li style="color: black;"> '+Math.round((t_max[4]-t_max[2])*100, 2)/100+'°C para el periodo 2015-2039 (RCP8.5)</li><li style="color: black;" > '+Math.round((t_max[6]-t_max[2])*100, 2)/100+'°C para el periodo 2075-2099 (RCP8.5)</li></ul>' );
	$('#text'+div).css('text-align','left');
	$('#text'+div).css('fontSize','16');
	$('#text'+div).css('fontWeight','normal');
	$('#text'+div).css('marginTop','10px');
	$('<hr/>',{id:'separator1'+div}).appendTo('#tit'+div);
	$("#separator1"+div).addClass("fondoElementosHR");	
	$('<div/>',{id: 'text2'+div}).appendTo('#tit'+div);
	$('#text2'+div).html('La <b>temperatura m&iacutenima</b> exceder&aacute el promedio hist&oacuterico por: <br><ul><li style="color: black;"> '+Math.round((t_min[4]-t_min[2])*100, 2)/100+'°C para el periodo 2015-2039 (RCP8.5)</li><li style="color: black;"> '+Math.round((t_min[6]-t_min[2])*100, 2)/100+'°C para el periodo 2075-2099 (RCP8.5)</li></ul>');
	$('#text2'+div).css('text-align','left');
	$('#text2'+div).css('fontSize','16');
	$('#text2'+div).css('fontWeight','normal');
	$('#text2'+div).css('marginTop','10px');
	$('<hr/>',{id:'separator2'+div}).appendTo('#tit'+div);
	$("#separator2"+div).addClass("fondoElementosHR");	
	$('<div/>', {id: 'text3'+div}).appendTo('#tit'+div);			
	$('#text3'+div).html('La <b>precipitaci&oacuten total</b> exceder&aacute el promedio hist&oacuterico por: <br><ul><li style="color: black;"> '+Math.round((t_prec[4]-t_prec[2])*100, 2)/100+'mm para el periodo 2015-2039 (RCP8.5)</li><li style="color: black;"> '+Math.round((t_prec[6]-t_prec[2])*100, 2)/100+'mm para el periodo 2075-2099 (RCP8.5)</li></ul>' );
	$('#text3'+div).css('text-align','left');
	$('#text3'+div).css('fontSize','16');
	$('#text3'+div).css('fontWeight','normal');
	$('#text3'+div).css('marginTop','10px');
	$('<hr/>',{id:'separator3'+div}).appendTo('#tit'+div);
	$("#separator3"+div).addClass("fondoElementosHR");	
	$('#menuTabla').appendTo('#tit'+div);
	$('#tit').hide();
}

function getName(t){
	switch(t){
		case 0: return '1910-1949';
		case 1: return '1950-1979';                        
		case 2: return '1980-2009';
		case 3: return '2015-2039 (RCP 4.5)';
		case 4: return '2015-2039 (RCP 8.5)';
		case 5: return '2075-2099 (RCP 4.5)';
		case 6: return '2075-2099 (RCP 8.5)';
		default: return '';
	}
}

function getColor(t, flag){
	if(flag){
		switch(t){
			case 0: return 'rgb(53, 109, 126)'
			case 1: return 'rgb(61, 151, 142)';
			case 2: return 'rgb(107, 200, 192)';
			case 3: return 'rgb(271, 241, 177)';
			case 4: return 'rgb(239, 177, 102)';
			case 5: return 'rgb(240, 178, 103)';
			case 6: return 'rgb(188, 129, 71)';
			default: return 'rgb(131, 96, 58)';
		}
	}else{
		switch(t){
			case 0: return 'rgb(3, 59, 46)'
			case 1: return 'rgb(11, 101, 92)';
			case 2: return 'rgb(57, 150, 142)';
			case 3: return 'rgb(221, 191, 127)';
			case 4: return 'rgb(189, 127, 52)';
			case 5: return 'rgb(190, 128, 53)';
			case 6: return 'rgb(138, 79, 21)';
			default: return 'rgb(81, 46, 8)';
		}
	}
}

function tabla1(){	
	var indicesT = [5,3,4,2];
	var vT=['Media (&deg;C)','Máxima (&deg;C)','Mínima (&deg;C)','Total (mm)'];
	var tiempo=['Anual','Ene-feb-mar','Abr-may-jun','Jul-ago-sep','Oct-nov-dic'];
	var echo='<div id="menuTabla"><div class="sel"><select id="variable" name="variable">';
	echo += "<option selected disabled>Variable</option>";
	for(var x=0;x<vT.length;x++){	
		echo+='<option value="'+indicesT[x]+'" data-imagesrc="background-image: url(\'/static/conabio/icons/p'+(x+1)+'.png\');">'+vT[x]+'</option>';		
		//echo+='<option value="'+indicesT[x]+'">'+variable[x]+'</option>';		
	}
	echo+='</select></div><div class="sel"><select id="tiempo">';
	echo += "<option selected disabled>Temporada</option>";
	for(var x=0;x<tiempo.length;x++)
			echo+='<option value="'+(parseInt(x)+1)+'">'+tiempo[x]+'</option>';
	echo+='</select></div></div>';
	return echo;
}

function loadConabioStuffs(){
	fillData([8,7,12,13]);
	polsANP = new FTStore("polygon");
	var plantilla = [{
		maxWidth: "410",
		tabla:{
			nombre: "1BE5n-CAhAl601hgEyX5ZvW1IsNN3T7g48y_ylqQb",
			columns: "OBJECTID,NOMBRE_eti",
			where: null, columnaGeometria: "geometry", 
			style:[{
				polygonOptions:{
					fillColor: "#9c603d", strokeColor: "#Ac805d",fillOpacity:0.8,
					strokeWeight:0.8,strokeOpacity: 1
				}
			}]
		},
		key: key,
		map: map,
		storePol: "polsANP",
		storeData: "infoANP",
		data: "elements",
		idData: "ids",
		hasId: true,
		error: errorC,
		success: successC
	},{
		caja: {
			mouseover: showWindowANP,
			mouseout: hideWindowANP
		},
		clase: 'cajita colorElementos1',
		claseTabla: 'table',
		cols: 5,
		rows: 7,
		widths:[100,140,10,100,50],
		cuerpo:[
			{ style:'negritas th td tituloTabla colorElementos1',tipo:"span",pos:'a0',texto:"|1",colspan:4},
			{ style:'th td colorElementos1 centrado centrado2',tipo:"img",pos:'e0',src:"/static/conabio/icons/map-pin.png",width:"35px",onclick:"markANPAux",parametros:'0',cursor:"hand",id:"mapPin",title:"Seleccionar"},
			{ style:'negritas th td colorElementos1 centrado',tipo:"span",pos:'a1',texto:"Clima al presente", colspan:2},			
			{ style:'verticalLine th td colorElementos1',tipo:"div",pos:'c1',texto:"",rowspan:6,width:"10px"},			
			{ style:'negritas th td colorElementos1 centrado top',tipo:"span",pos:'d1',texto:"Cambio<br>proyectado",rowspan:2,colspan:2},
			{ style:'th td colorElementos1 centrado2 centrado',tipo:"img",pos:'a2',src:'/static/conabio/icons/temperature.png',rowspan:3,width:"50px"},
			{ style:'th td colorElementos1 contenidoCaja bold',tipo:'span',pos:'b2',texto:"media: |0 °C",getExtra:media},
			{ style:'th td colorElementos1 contenidoCaja bold',tipo:'span',pos:'b3',texto:"máxima: |0 °C",getExtra:maxima},
			{ style:'th td colorElementos1 centrado',tipo:"img",pos:'d3',src:'/static/conabio/icons/line-graphic.png',width:"90px",rowspan:4,colspan:2,onclick:"usar",parametros:'0',cursor:"hand"},
			{ style:'th td colorElementos1 contenidoCaja bold',tipo:'span',pos:'b4',texto:"mínima: |0 °C",getExtra: minima},			
			{ style:'th td colorElementos1',tipo:'span',pos:'b5',texto:""},
			{ style:'th td colorElementos1 centrado2 centrado',tipo:"img",pos:'a5',src:'/static/conabio/icons/rain.png',width:"35px",rowspan:2},
			{ style:'th td colorElementos1 contenidoCaja bold',tipo:'span',pos:'b6',texto:"|0 mm",getExtra:prec},			
		]
	}];
	createFusionTM(plantilla);	
}

function markANPAux(boton,idANP){
	idANP = parseInt(idANP);
	markANP(idANP);
	var index = isANPMarked(idANP);
	if(index==-1){
		$(boton).css("transform","rotate(0deg)");
		$(boton).attr("title","Seleccionar");
	}else{
		$(boton).css("transform","rotate(-45deg)");
		$(boton).attr("title","Deseleccionar");
	}
}

function usar(boton,idANP){	
	enviaAux(2,idANP,0);
}

function maxima(idANP){
	return Math.round(bioTempPMax[idANP][2]);
}

function media(idANP){
	return Math.round(bioTempPMean[idANP][2]);
}

function minima(idANP){
	return Math.round(bioTempPMin[idANP][2]);
}

function prec(idANP){
	return Math.round(bioPrecT[idANP][2]);
}

function hideWindowANP(e,columns,p){
	var idANP = parseInt(columns[0]);
	var index = isANPMarked(idANP);
	if(index == -1){
		p.setOptions({fillOpacity:0.8, fillColor:"#9c603d"});
	}
}

function showWindowANP(e,columns,p,ventana){
	var idANP = parseInt(columns[0]);    
	var index = isANPMarked(idANP);
	if(index == -1){
		p.setOptions({fillOpacity:1, fillColor:"#00FF00"});
		$("#mapPin").css("transform","rotate(0deg)");
	}else{
		p.setOptions({fillOpacity:1, fillColor:"#00FFFF"});
		$("#mapPin").css("transform","rotate(-45deg)");
	}
}

function successC(){
	for(var index in infoANP){
		nombresANP[index] = infoANP[index][1];
	}	
}

function cambioVariable(e){
	var pol = polG;
	var metadata = "";
	if(pol==0 || pol == 3){
		metadata = anpG;
	} else if(pol == 1){
		metadata = cveEntG;
	}
	if(pol == 3)
		$('#cortina').removeClass('removeCortina');
	temporada=temporadaG;
	variableG=e.target.value;
	variable=variableG;
	envia(variable, metadata, pol,temporada, false);
}

function cambioTemporada(e){
	var pol = polG;
	var metadata = "";
	if(pol==0 || pol == 3){
		metadata = anpG;
	} else if(pol == 1){
		metadata = cveEntG;
	}
	if(pol == 3)
		$('#cortina').removeClass('removeCortina');	
	temporadaG=e.target.value;
	temporada=temporadaG;
	variable=variableG;
	envia(variable, metadata, pol,temporada, false);
}

function enviaAux(variable, anp, pol){
	if(cveANPMarked.length==1){
		if(anp!=cveANPMarked[0]){
			polsANP.elements[cveANPMarked[0]].setOptions({fillOpacity:0.8, fillColor:"#9c603d"});
			cveANPMarked = []; 
		}
	}
	if(cveANPMarked.length>0){
        anp = JSON.stringify(cveANPMarked);
        anp = anp.substring(1,anp.length-1);
    }else{
		markANP(anp);
	}
	variableG = 2;
	anpG = anp;
	polG = pol;
	temporadaG=1;	
	envia(variable, anp, pol,1);
}

function markANP(cveANP){
	cveANP = parseInt(cveANP);
	var index = isANPMarked(cveANP);
	if(index>-1){
		polsANP.elements[cveANP].setOptions({fillOpacity:0.8, fillColor:"#9c603d"});
		cveANPMarked.splice(index,1);
		$("#mapPin").css("transform","rotate(0deg)");
	} else {
		if(cveANPMarked.length == 4){
			alert("Lo sentimos, solo puede marcar 4 ANP's");
			return 0;
		}
		$("#mapPin").css("transform","rotate(-45deg)");
		polsANP.elements[cveANP].setOptions({fillOpacity:1, fillColor:"#00FFFF"});
		cveANPMarked.push(cveANP);
	}
	return 1;
}
var callbackF = null;
