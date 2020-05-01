function initMap(){
    fillData([6,7,8,10]);
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(grafica);
}

function grafica() {
	data = null;
	data = new google.visualization.DataTable();
	data.addColumn('number', 'Temperatura');
	data.addColumn('number', 'Precipitación');
	data.addColumn( {'type': 'string', 'role': 'style'} );
	var idEra = 0;
	for (var i = 1; i <= 138; i++) {
		var x = bioTempP[parseInt(i)][idEra];
		if(isNaN(x) || $.isArray(x)){ 				
			data.addRow(null);
			continue;
		}
		var y = bioPrecT[parseInt(i)][idEra];				
		if(isNaN(y) || $.isArray(y)){				
			data.addRow(null); 
			continue;  
		}
		var fillColor = getColorXY(x,y);
		data.addRow([x,y,'point {size: 5; fill-color:'+fillColor+'}']);
	}
	var options = {
		tooltip: {trigger: 'none'},
		legend: 'none',
		chartArea:{top:5,width:'80%',height:'95%'}    
	};
	chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
	chart.draw(data, options);
	chart.setSelection([]);	
	var botones = '<select class="form-control" id="tipoEstadistica"><option value="0">Moda</option><option value="1">Media</option><option value="2">Mediana</option></select><br>', 
		rangos = ['1910-1949', '1950-1979', '1980-2010', '2015-2039', '2075-2099'],
		valoresSelect = ['RCP 4.5','RCP 8.5'];
	for ( var ind = 0; ind <=4; ind++){
		botones += '<button type="button" style="margin-right:30px;" class="btn btn-default" id="btnRang-'+ind+'">'+rangos[ind]+'</button>';
	}
	botones += "<br>";
	$('#temVSprec').empty();
	$('#temVSprec').append(botones);
	$('#tipoEstadistica').change(function(e){
		 changeData(lastEra);
	});
	$('button[id^= btnRang-]').on('click', function(){
		var btn = $(this).attr('id'), texto = $(this).text(),num = btn.split('-');
		if(num[1] < 3 ){ 
			$('#divSelectRan').empty();
			var dataChange = '';
			changeData(num[1]);
		}else{
			var index=num[1]==3?3:5;
			var select = '<br>Escenario<select style = "height: 10%;" class="form-control" id= "selectRangos">';			
			for(var i = 0; i<2; i++ ){
				select += '<option id= "btn-'+texto+'-'+i+'" value="'+(index+i)+'">';
				select += valoresSelect[i];
				select += '</option>';
			}
			select += '</select>';
			$('#divSelectRan').empty();
			$('#divSelectRan').append(select);
			$('#selectRangos option[value=0]').attr("selected","selected");
			$('#selectRangos').change(function(e){
				var dataChange = $(this).val();
				changeData(dataChange);
		   });
		   $('#selectRangos').val(index).trigger("change");
		}
	});
}
	
function changeData(idEra){
	var tipoE = $('#tipoEstadistica :selected').val();
	console.log(tipoE);
	var temp = tipoE == 0 ? bioTempP:(tipoE == 1 ? bioTempPMean:bioTempPMedian);
	var prec = bioPrecT;
	idEra = parseInt(idEra);
	lastEra = idEra;
	chart.clearChart();
	data = new google.visualization.DataTable();
	data.addColumn('number', 'Temperatura');
	data.addColumn('number', 'Precipitación');
	data.addColumn( {'type': 'string', 'role': 'style'} );        
	for (var i = 1; i <= 138; i++) {
		var x = temp[i][idEra];
		if(isNaN(x) || $.isArray(x)){ x=0; data.addRow(null); continue;}
		var y = prec[i][idEra];
		if(isNaN(y) || $.isArray(y)){ y=0; data.addRow(null); continue;}
		var fillColor = getColorXY(x,y);
		data.addRow([x,y,'point {size: 5; fill-color:'+fillColor+'}']);
	}
	var options = {
		tooltip: {trigger: 'none'},
		legend: 'none',
		chartArea:{top:5,width:'80%',height:'95%'}
	};
	chart.draw(data, options);
}
		
function centrarMapa(){
	var e = chart.getSelection();
	if (!e) return;
	if(e.row === undefined) return;
   centrarPol(parseInt(e.row)+1);             
}
	
function prendeMapa(e){
	if(e.row === undefined) return;
	chart.setSelection([{row: e.row, column: e.column}]);
	var selected = chart.getSelection();    
	google.visualization.events.trigger(chart, 'select', selected);
	if (e){
	   cambiaEstilo(parseInt(e.row)+1,1);
		$('#tituloANP').append(storeData[e.row+1][1]);               
	}              
}

function apagaMapa(e){
	if(e.row===undefined || e.row === 0 ) return;
	chart.setSelection([{row: null}]);
	google.visualization.events.trigger(chart, 'select', {});
	cambiaEstilo(e.row+1,0.5);
	$('#tituloANP').empty();
}

function centrarPol(idAnp){
	var pol = storeP.polygons[idAnp];
	var bounds = new google.maps.LatLngBounds();
	var path = pol.getPath();
	for(var i=0;i<path.getLength();i++){
		bounds.extend(path.getAt(i))
	}
	console.log(bounds.getCenter());
}

function cambiaEstilo(idAnp,opacity){
	var pol = storeP.polygons[idAnp];
	pol.setOptions({fillOpacity:opacity});
}

function hacerlaultima(e){
   // console.log(e);
}

function errorC(ec,ed){
	console.log(ec+" "+ed);
}

function successC(){
	//console.log("Tdodo bien");
}

function hacerotracosa(e,cols, pol){
	$('#tituloANP').empty();
	pol.setOptions({fillOpacity:0.5});
	chart.setSelection([{row: null}]);   
	//chart.setTitle({text:""});		
	google.visualization.events.trigger(chart, 'select', {});
}

function haceralgo(e,columns,pol){
	var row = (parseInt(columns[0]))-1;
	//console.log("Fila en mapa: "+row);
	$('#tituloANP').append(columns[1]);
	pol.setOptions({fillOpacity:1});
	chart.setSelection([{row: row,column: 1}]);
	//console.log(chart.getSelection());
	//chart.setTitle({text:storeData[e.row][1]});
	var selected = chart.getSelection();
	google.visualization.events.trigger(chart, 'select', selected);
}

function getColorXY(x,y){
	return rgbToHex(Math.round(x*255/40),0,Math.round(y*255/2400));
}

function componentToHex(c) {
	var hex = c.toString(16);
	return hex.length == 1 ? "0" + hex : hex;
}

function rgbToHex(r, g, b) {
	r = r>255?255:r;
	g = g>255?255:g;
	b = b>255?255:b;
	return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
}