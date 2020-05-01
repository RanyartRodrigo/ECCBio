var iconosNames=["geographic_features","ranger_station","factory","gas_stations","post_office","agriculture","funicular","post_office_jp","thunderstorm","traffic","polygon","poi","falling_rocks","police_badge","terrain","capital_small","placemark_square","square","ruler","donut","play","stable","capital_small_highlight","placemark_square_highlight","stop","road_shield3","star","shaded_dot","dining","pharmacy_rx","sledding","capital_big","pause","road_shield2","triangle","target","crosscountry_ski","pharmacy_plus","ski_lift","capital_big_highlight","placemark_circle_highlight","go","road_shield1","forbidden","convenience","parks","shower","coffee","parking_lot","sea_ports","1_blue","2_blue","3_blue","4_blue","5_blue","6_blue","7_blue","8_blue","9_blue","10_blue","cemetary","museum","schools","A_blue","B_blue","C_blue","D_blue","E_blue","F_blue","G_blue","H_blue","I_blue","J_blue","K_blue","L_blue","M_blue","N_blue","O_blue","P_blue","Q_blue","R_blue","S_blue","T_blue","U_blue","V_blue","W_blue","X_blue","Y_blue","Z_blue","cemetary_jp","mountains","rec_wheel_chair_accessible","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","car_ferry","lighthouse","rec_phone","canoeing","library","rec_parking_lot","buildings","landmark","rec_lodging","prayer","broken_link","highway","rec_info_circle","temple_jp","boat_launch","heliport","rec_gas_stations","synagogue","binoculars","grocery","rec_dining","shrine_jp","bars","govtbldgs","rec_convenience","mosque","arena","gondola","rec_bus","hindu_temple","airports","golf","ranger_tower","church","small_red","small_yellow","small_green","small_blue","small_purple","measle_brown","measle_grey","measle_white","measle_turquoise","arrow","arts","campfire","cycling","flag","bus","yen","earthquake","firedept","homegardenbusiness","cabs","euro","camera","caution","campground","dollar","electronics","hiker","fishing","horsebackriding","hospitals","info","info_circle","lodging","man","marina","mechanic","motorcycling","movies","partly_cloudy","phone","picnic","police","rail","rainy","realestate","sailing","salon","shopping","ski","snack_bar","snowflake_simple","subway","sunny","swimming","toilets","trail","tram","truck","volcano","water","webcam","wheel_chair_accessible","woman"];
iconosNames.sort();
function updateVP(idOrigen,idDestino){
	var texto = $("#"+idOrigen).val();
	while(texto.includes(" ")){
		texto = texto.replace(" ","&nbsp;");
	}
	$("#"+idDestino).html(texto);
}
// function invertStretch(classDiv){
// 	var inputs = $("."+classDiv).find('.color');
// 	for (var i = 0; i <= parseInt(inputs.length/2); i++){
// 		var temp = $(inputs[i]).val();		
// 		$(inputs[i]).val(inputs[inputs.length-1-i]).val();
// 		$(inputs[inputs.length-1-i]).val(temp);
// 	}
// }

function invertStretch(classDiv){
	var inputs = $("."+classDiv).find('.color');
	var arr = [];
	var index = 0;
	for (var i = 0; i < parseInt(inputs.length); i++)
		arr.push($(inputs[i]).val());
	for (var i = parseInt(inputs.length)-1; i >= 0; i--){
		$(inputs[index]).val(arr[i]);
		index += 1;
	}
	$(inputs[0]).trigger("change");
}

function llenarFormularioRCon(){
	var estilo=$("#estilos").val();
	estilo=estilo.replace("[","");
	estilo=estilo.replace("]","");
	var estilos=estilo.split("},");
	estilos[estilos.length-1]=(estilos[estilos.length-1].replace("} }","}")).replace("}}","}");
	var minRCon, maxRCon;
	for(var x=0;x<estilos.length;x++){
		if(x==0){
			var tipo=limpiarCadena((estilos[x].substring(estilos[x].indexOf("',"))));
			tipo=(tipo.substring(0, tipo.indexOf(":")));
			if(estilos[x].indexOf(">=")>=0)
				minRCon=limpiarCadena((estilos[x].substring(estilos[x].indexOf(">="),estilos[x].indexOf("AND"))).replace(">=",""));
			else
				minRCon=limpiarCadena((estilos[x].substring(estilos[x].indexOf(">"),estilos[x].indexOf("AND"))).replace(">",""));
			maxRCon=limpiarCadena((estilos[x].substring(estilos[x].indexOf("<="),estilos[x].indexOf(tipo+":"))).replace("<=",""));
		}			
		var color=limpiarCadena((estilos[x].substring(estilos[x].indexOf("fillColor:"),estilos[x].indexOf("fillOpacity"))).replace("fillColor:",""));
		$("#rConPart"+(x+1)).find(".color").val(color);
		if(x<estilos.length-1)addColor();
	}
	$("#minRCon").val(minRCon);
	$("#maxRCon").val(maxRCon);
	recalcularStrech("rasterContinuo","strechRCon");
}
function llenarFormularioVCon(){
	var estilo=$("#estilos").val();
	estilo=estilo.replace("[","");
	estilo=estilo.replace("]","");
	var estilos=estilo.split("},");
	estilos[estilos.length-1]=(estilos[estilos.length-1].replace("} }","}")).replace("}}","}");
	for(var x=0;x<estilos.length;x++){
		var name=limpiarCadena((estilos[x].substring(estilos[x].indexOf("where:"),estilos[x].indexOf(">"))).replace("where:",""));
		if(estilos[x].indexOf(">=")>=0)
			var lim1VCon=limpiarCadena((estilos[x].substring(estilos[x].indexOf(">="),estilos[x].indexOf("AND"))).replace(">=",""));
		else
			var lim1VCon=limpiarCadena((estilos[x].substring(estilos[x].indexOf(">"),estilos[x].indexOf("AND"))).replace(">",""));
		var tipo=limpiarCadena((estilos[x].substring(estilos[x].indexOf("',"))));
		tipo=(tipo.substring(0, tipo.indexOf(":")));
		var lim2VCon=limpiarCadena((estilos[x].substring(estilos[x].indexOf("<="),estilos[x].indexOf(tipo+":"))).replace("<=",""));
		console.log(estilos[x]);
		if(tipo=="polygonOptions"){
			var color=limpiarCadena((estilos[x].substring(estilos[x].indexOf("fillColor:"),estilos[x].indexOf("fillOpacity"))).replace("fillColor:",""));
			var strokeColor=limpiarCadena((estilos[x].substring(estilos[x].indexOf("strokeColor:"),estilos[x].indexOf("strokeWeight"))).replace("strokeColor:",""));
			var strokeWeight=limpiarCadena((estilos[x].substring(estilos[x].indexOf("strokeWeight:"),estilos[x].indexOf("}"))).replace("strokeWeight:",""));
			$("#colorLVCon").val(strokeColor);
			$("#grosorLVCon").val(strokeWeight);
		}else if(tipo=="polylineOptions"){
			color=limpiarCadena((estilos[x].substring(estilos[x].indexOf("strokeColor:"),estilos[x].indexOf("strokeWeight"))).replace("strokeColor:",""));
			var strokeWeight=limpiarCadena((estilos[x].substring(estilos[x].indexOf("strokeWeight:"),estilos[x].indexOf("}"))).replace("strokeWeight:",""));
			$("#grosorLVCon").val(strokeWeight);
		}else if(tipo=="markerOptions"){
			var icon=limpiarCadena((estilos[x].substring(estilos[x].indexOf("iconName:"))).replace("}}","").replace("iconName:","").replace("}",""));		
		}
		$("#valorName").val(name);
		$("#vConPart"+(x+1)).find(".lim1VCon").val(lim1VCon);
		$("#vConPart"+(x+1)).find(".lim2VCon").val(lim2VCon);
		if(tipo!="markerOptions")
			$("#vConPart"+(x+1)).find("input[type='color']").val(color);
		else
			$("#vConPart"+(x+1)).find(".icon").val(icon);
		$("#tipoDatoVS").val(tipo);
		if(tipo!="markerOptions"){
			$("#vConPart"+(x+1)).find(".icon").addClass("hidden");
			$("#vConPart"+(x+1)).find(".color").removeClass("hidden");
		}else{			
			$("#vConPart"+(x+1)).find(".icon").removeClass("hidden");
			$("#vConPart"+(x+1)).find(".color").addClass("hidden");
		}
		if(x<estilos.length-1)addColorV();
	}
	hideShowPrev();
	recalcularStrech("vectorialContinuo","strechVCon");
}
function llenarFormularioRCat(){
	var estilo=$("#estilos").val();
	estilo=estilo.replace("[","");
	estilo=estilo.replace("]","");
	var estilos=estilo.split("},");
	estilos[estilos.length-1]=(estilos[estilos.length-1].replace("} }","}")).replace("}}","}");
	for(var x=0;x<estilos.length;x++){
		var tipo=limpiarCadena((estilos[x].substring(estilos[x].indexOf("',"))));
		tipo=(tipo.substring(0, tipo.indexOf(":")));
		if(estilos[x].indexOf(">=")>=0)
			minRCat=limpiarCadena((estilos[x].substring(estilos[x].indexOf(">="),estilos[x].indexOf("AND"))).replace(">=",""));
		else
			minRCat=limpiarCadena((estilos[x].substring(estilos[x].indexOf(">"),estilos[x].indexOf("AND"))).replace(">",""));
		maxRCat=limpiarCadena2((estilos[x].substring(estilos[x].indexOf("<="),estilos[x].indexOf(tipo+":"))).replace("<=",""));
		var color=limpiarCadena((estilos[x].substring(estilos[x].indexOf("fillColor:"),estilos[x].indexOf("fillOpacity"))).replace("fillColor:",""));
		$("#rCatPart"+(x+1)).find(".color").val(color);
		$("#rCatPart"+(x+1)).find(".valorRCat").val(minRCat);
		$("#rCatPart"+(x+1)).find(".descRCat").val(maxRCat);
		if(x<estilos.length-1)addColorCat();
	}	
}
function llenarFormularioVCat(){
	var estilo=$("#estilos").val();
	estilo=estilo.replace("[","");
	estilo=estilo.replace("]","");
	var estilos=estilo.split("},");
	estilos[estilos.length-1]=(estilos[estilos.length-1].replace("} }","}")).replace("}}","}");
	for(var x=0;x<estilos.length;x++){
		var name=limpiarCadena((estilos[x].substring(estilos[x].indexOf("where:"),estilos[x].indexOf("=="))).replace("where:",""));		
		var lim1VCat=limpiarCadena((estilos[x].substring(estilos[x].indexOf("=="),estilos[x].indexOf("$"))).replace("==",""));
		var tipo=limpiarCadena((estilos[x].substring(estilos[x].indexOf("',"))));
		tipo=(tipo.substring(0, tipo.indexOf(":")));
		var lim2VCat=limpiarCadena((estilos[x].substring(estilos[x].indexOf("$"),estilos[x].indexOf(tipo+":"))).replace("$",""));
		lim2VCat=lim2VCat=="$"?"":lim2VCat;
		console.log(estilos[x]);
		if(tipo=="polygonOptions"){
			var color=limpiarCadena((estilos[x].substring(estilos[x].indexOf("fillColor:"),estilos[x].indexOf("fillOpacity"))).replace("fillColor:",""));
			var strokeColor=limpiarCadena((estilos[x].substring(estilos[x].indexOf("strokeColor:"),estilos[x].indexOf("strokeWeight"))).replace("strokeColor:",""));
			var strokeWeight=limpiarCadena((estilos[x].substring(estilos[x].indexOf("strokeWeight:"),estilos[x].indexOf("}"))).replace("strokeWeight:",""));			
			$("#colorLVCat").val(strokeColor);
			$("#grosorLVCat").val(strokeWeight);
		}else if(tipo=="polylineOptions"){
			color=limpiarCadena((estilos[x].substring(estilos[x].indexOf("strokeColor:"),estilos[x].indexOf("strokeWeight"))).replace("strokeColor:",""));
			var strokeWeight=limpiarCadena((estilos[x].substring(estilos[x].indexOf("strokeWeight:"),estilos[x].indexOf("}"))).replace("strokeWeight:",""));
			$("#grosorLVCat").val(strokeWeight);
		}else if(tipo=="markerOptions"){
			var icon=limpiarCadena((estilos[x].substring(estilos[x].indexOf("iconName:"))).replace("}}","").replace("iconName:","").replace("}",""));		
		}
		$("#valorName").val(name);
		$("#vCatPart"+(x+1)).find(".valorVCat").val(lim1VCat);
		$("#vCatPart"+(x+1)).find(".descVCat").val(lim2VCat);
		if(tipo!="markerOptions")
			$("#vCatPart"+(x+1)).find("input[type='color']").val(color);
		else
			$("#vCatPart"+(x+1)).find(".icon").val(icon);
		$("#tipoDatoVCS").val(tipo);
		if(tipo!="markerOptions"){			
			$("#vCatPart"+(x+1)).find(".icon").addClass("hidden");
			$("#vCatPart"+(x+1)).find(".color").removeClass("hidden");
		}else{
			
			$("#vCatPart"+(x+1)).find(".icon").removeClass("hidden");
			$("#vCatPart"+(x+1)).find(".color").addClass("hidden");
		}
		if(x<estilos.length-1)addColorVC();
	}
	hideShowPrev2();
}
function llenarFormulario(){
	for(var i=0;i<iconosNames.length;i++){
		$("#googleMap").append("<img src='"+host+"img/iconos/"+iconosNames[i]+".png' title='"+iconosNames[i]+"'>");
	}
	var tipoMapa = $("#tipoMapa").val();
	var tipoValores = $("#tipoValores").val();
	if(tipoValores == 1){
		var texto = leyendaStrechEdit;
		while(texto.includes(" ")){
			texto = texto.replace(" ","&nbsp;");
		}
		$("#leyendaStrech"+tipoMapa).val(leyendaStrechEdit);
		$("#labelLS"+tipoMapa).html(texto);
	}
	if(tipoMapa == 1 && tipoValores == 1){
		llenarFormularioRCon();
		return;
	}else if(tipoMapa == 1 && tipoValores == 2){
		llenarFormularioRCat();
		return;
	}else if(tipoMapa == 2 && tipoValores == 1){
		llenarFormularioVCon();
		return;
	} else {
		llenarFormularioVCat();
		return;
	}
}
function limpiarCadena(cadena){
	cadena=cadena.split("'").join("");
	cadena=cadena.split(",").join("");
	cadena=cadena.split(" ").join("");
	cadena=cadena.split("\t").join("");
	cadena=cadena.split("\n").join("");
	return cadena;
}
function limpiarCadena2(cadena){
	cadena=cadena.split("'").join("");
	cadena=cadena.split(",").join("");
	cadena=cadena.split("\t").join("");
	cadena=cadena.split("\n").join("");
	return cadena;
}
function getAttributes(id,type){
	var idSelect,cLim1,cLim2,idPadre,idSC,idSW;
	if(type == "con"){
		idSelect = "#tipoDatoVS";
		cLim1 = ".lim1VCon";
		cLim2 = ".lim2VCon";
		idPadre = "#vConPart";
		idSC = "#colorLVCon";
		idSW = "#grosorLVCon";
	} else {
		idSelect = "#tipoDatoVCS";
		cLim1 = ".valorVCat";
		cLim2 = ".descVCat";
		idPadre = "#vCatPart";
		idSC = "#colorLVCat";
		idSW = "#grosorLVCat";
	}
	var tipo = $(idSelect).val();
	var lim1VCon = $(idPadre+id).find(cLim1).val();
	var lim2VCon = $(idPadre+id).find(cLim2).val();
	if(tipo == "polygonOptions"){
		var strokeColor = $(idSC).val();
		var strokeWeight = $(idSW).val();
		color=$(idPadre+id).find("input[type='color']").val();
		nameProp = "fillColor";
		extra = ",fillOpacity:valFill,strokeColor:'"+strokeColor+"',strokeWeight:"+strokeWeight+"";
	}else if(tipo == "polylineOptions"){
		var strokeWeight = $(idSW).val();
		color=$(idPadre+id).find("input[type='color']").val();
		nameProp = "strokeColor";
		extra = ",strokeWeight:"+strokeWeight;
	} else {
		color = $(idPadre+id).find(".icon").val();
		nameProp = "iconName";
		extra = "";
	}
	return [lim1VCon,lim2VCon,color,nameProp,extra];
}
function crearEstiloRCon(){
	var minRCon = $("#minRCon").val();
	var maxRCon = $("#maxRCon").val();
	var nombre="a", tipo="polygonOptions";
	$("#columna").val("a,a");
	var color=$("#rConPart1").find("input[type='color']").val();
	estilo="[{where:";
	estilo+="'"+nombre+">="+minRCon+" AND "+nombre+"<="+maxRCon+"',";
	estilo+=tipo+":{";
	estilo+="fillColor:'"+color+"',";
	estilo+="fillOpacity:valFill}}";
	for(var x=2;x<=$(".partesRCon").length;x++){
		var color=$("#rConPart"+x).find(".color").val();
		estilo+=",{where:";
		estilo+="'"+nombre+">="+minRCon+" AND "+nombre+"<="+maxRCon+"',";
		estilo+=tipo+":{";
		estilo+="fillColor:'"+color+"',";
		estilo+="fillOpacity:valFill}}";
	}
	estilo+="]";
	return estilo;
}
function crearEstiloVCon(){
	var attributes = getAttributes("1","con");
	var nombre = $("#valorName").val();
	var tipo = $("#tipoDatoVS").val();	
	var lim1VCon = attributes[0], lim2VCon = attributes[1];
	var color = attributes[2], nameProp = attributes[3];
	var extra = attributes[4];
	estilo="[{where:";
	estilo+="'"+nombre+">="+lim1VCon+" AND "+nombre+"<="+lim2VCon+"',";
	estilo+=tipo+":{";
	estilo+=nameProp+":'"+color+"'";
	estilo+=extra+"}}";
	for(var x=2;x<=$(".partesVCon").length;x++){
		attributes = getAttributes(x,"con");
		nombre = $("#valorName").val();
		lim1VCon = attributes[0], lim2VCon = attributes[1];
		color = attributes[2], nameProp = attributes[3];
		extra = attributes[4];
		estilo+=",{where:";
		estilo+="'"+nombre+">="+lim1VCon+" AND "+nombre+"<="+lim2VCon+"',";
		estilo+=tipo+":{";
		estilo+=nameProp+":'"+color+"'";
		estilo+=extra+"}}";
	}
	estilo+="]";
	return estilo;
}
function crearEstiloRCat(){
	var valor = $("#rCatPart1").find(".valorRCat").val();
	var descripcion = $("#rCatPart1").find(".descRCat").val();
	var nombre="a", tipo="polygonOptions";	
	$("#columna").val("a,a");
	var color=$("#rCatPart1").find("input[type='color']").val();
	estilo="[{where:";
	estilo+="'"+nombre+">="+valor+" AND "+nombre+"<="+descripcion+"',";
	estilo+=tipo+":{";
	estilo+="fillColor:'"+color+"',";
	estilo+="fillOpacity:valFill}}";
	for(var x=2;x<=$(".partesRCat").length;x++){
		var color=$("#rCatPart"+x).find("input[type='color']").val();
		var valor = $("#rCatPart"+x).find(".valorRCat").val();
		var descripcion = $("#rCatPart"+x).find(".descRCat").val();
		estilo+=",{where:";
		estilo+="'"+nombre+">="+valor+" AND "+nombre+"<="+descripcion+"',";
		estilo+=tipo+":{";
		estilo+="fillColor:'"+color+"',";
		estilo+="fillOpacity:valFill}}";
	}
	estilo+="]";
	return estilo;
}
function crearEstiloVCat(){
	var attributes = getAttributes("1","cat");
	var nombre = $("#valorName").val();
	var tipo = $("#tipoDatoVCS").val();
	var lim1VCon = attributes[0], lim2VCon = attributes[1];
	var color = attributes[2], nameProp = attributes[3];
	var extra = attributes[4];
	estilo="[{where:";
	estilo+="'"+nombre+"=="+lim1VCon+" $ "+lim2VCon+"',";
	estilo+=tipo+":{";
	estilo+=nameProp+":'"+color+"'";
	estilo+=extra+"}}";
	for(var x=2;x<=$(".partesVCat").length;x++){
		attributes = getAttributes(x,"cat");
		nombre = $("#valorName").val();
		lim1VCon = attributes[0], lim2VCon = attributes[1];
		color = attributes[2], nameProp = attributes[3];
		extra = attributes[4];
		estilo+=",{where:";
		estilo+="'"+nombre+"=="+lim1VCon+" $ "+lim2VCon+"',";
		estilo+=tipo+":{";
		estilo+=nameProp+":'"+color+"'";
		estilo+=extra+"}}";
	}
	estilo+="]";
	console.log(estilo);
	return estilo;
}
function crearEstilo(){
	var tipoMapa = $("#tipoMapa").val();
	var tipoValores = $("#tipoValores").val();		
	if(tipoMapa == 1 && tipoValores == 1){
		$("#estilos").text(crearEstiloRCon());
		return;
	}else if(tipoMapa == 1 && tipoValores == 2){
		$("#estilos").text(crearEstiloRCat());
		return;
	}else if(tipoMapa == 2 && tipoValores == 1){
		$("#estilos").text(crearEstiloVCon());
		return;
	} else {
		$("#estilos").text(crearEstiloVCat());
		return;
	}
}
function getCodes(colores){
	var temp = "";
	for(i = 0; i < colores.length;i++){
		var r = parseInt(colores[i].substr(1,2), 16);
		var g = parseInt(colores[i].substr(3,2), 16);
		var b = parseInt(colores[i].substr(5,2), 16);
		temp += 'rgb('+r+','+g+','+b+'),';
	}
	return temp.substring(0,temp.length-1);
}
function recalcularStrech(idPadre,idStrech){		
	var colores = [];
	$("#"+idPadre).find("input[type='color']").each(function(){
		if($(this).attr("id")=="colorLVCat" || $(this).attr("id")=="colorLVCon") return;
		colores.push($(this).val());
	});
	var coloresRGB = getCodes(colores);
	if(colores.length>1){
		$("#"+idStrech).css('background','linear-gradient(to right,'+coloresRGB+')');
	}else{
		$("#"+idStrech).css('background',coloresRGB);
	}
}
function addColor(){
	var x=$(".partesRCon").length;
	var newx=x+1;
	var string='';
	string+='<div id="rConPart'+newx+'" class="partesRCon"><div class="form-group panelIzquierdo">';
	string+='<label>Color '+newx+'</label>';
	string+='<input type="color" value="#000000" onChange="recalcularStrech(\'rasterContinuo\',\'strechRCon\')" class="form-control color">';
	string+='</div>';
	string+='<div class="form-group panelDerecho"><label>&nbsp;</label>';
	string+='<input class="form-control" type="button" name="name" onClick="removeColor('+newx+')" value="Borrar color('+newx+')"/>';
	string+='</div></div>';
	$(string).insertAfter("#rConPart"+x);
	recalcularStrech("rasterContinuo","strechRCon");
}
function removeColor(id){
	$(".partesRCon").each(function(){
		var newId=$(this).attr("id").replace("rConPart","");			
		if(newId==1) return;
		if(id<newId){
			$(this).attr("id","rConPart"+(newId-1));
			$(this).find("input[type='button']").attr("onclick","removeColor("+(newId-1)+")");
			$(this).find(".panelIzquierdo").find('label').html("Color "+(newId-1));
			$(this).find("input[type='button']").attr("value","Borrar color("+(newId-1)+")");
		}
	});
	$("#rConPart"+id).remove();
	recalcularStrech("rasterContinuo","strechRCon");
}
function addColorV(){
	var x=$(".partesVCon").length;
	var newx=x+1;
	var lim1VCon = parseInt($("#vConPart"+x).find(".lim2VCon").val())+1;
	var string='';
	string+='<div id="vConPart'+newx+'" class="partesVCon">';
	string+='<div class="form-group">';
	string+='<label>Rango '+newx+'</label>';
	string+='<input type="button" name="name" onClick="removeColorV('+newx+')" value="Borrar rango('+newx+')" class="form-control">';
	string+='</div>';
	string+='<div class="form-group panelIzquierdo">';
	string+='<label>Límite inferior</label>';
	string+='<input type="text" value="'+lim1VCon+'" class="form-control lim1VCon">';
	string+='</div>';
	string+='<div class="form-group panelDerecho">';
	string+='<label>Límite superior</label>';
	string+='<input type="text" value="" class="form-control lim2VCon">';
	string+='</div>';
	string+='<div class="separador">';
	string+='<div class="form-group color">';
	string+='<label>Color '+newx+'</label>';
	string+='<input type="color" value="#000000" onChange=\'recalcularStrech("vectorialContinuo","strechVCon")\' class="form-control">';
	string+='</div>';
	string+='<div class="form-group">';
	string+='<select class="icon">';
	string+='</select>';
	string+='</div>';
	string+='</div>';
	string+='</div>';
	$(string).insertAfter("#vConPart"+x);
	if($("#tipoDatoVS").val()!="polygonOptions"){
		$("#vConPart"+newx).find(".color").addClass("hidden");
		$("#vConPart"+newx).find(".icon").removeClass("hidden");
	}else{
		$("#vConPart"+newx).find(".color").removeClass("hidden");
		$("#vConPart"+newx).find(".icon").addClass("hidden");
	}
	for(var a=0;iconosNames.length>a;a++){
		$("#vConPart"+newx).find(".icon").append("<option value='"+iconosNames[a]+"'>"+iconosNames[a]+" </option>");
	}
	addIconsListener();
	recalcularStrech("vectorialContinuo","strechVCon");
}
function removeColorV(id){
	$(".partesVCon").each(function(){
		var newId=$(this).attr("id").replace("vConPart","");			
		if(newId==1) return;
		if(id<newId){
			$(this).attr("id","vConPart"+(newId-1));
			$(this).find("input[type='button']").attr("onclick","removeColorV("+(newId-1)+")");
			$(this).find(":nth-child(1)").find('label').html("Rango "+(newId-1));
			$(this).find('.separador').find('label').html("Color "+(newId-1));
			$(this).find("input[type='button']").attr("value","Borrar rango("+(newId-1)+")");
		}
	});
	$("#vConPart"+id).remove();
	recalcularStrech("vectorialContinuo","strechVCon");
}
function addColorCat(){
	var x=$(".partesRCat").length;	
	var newx=x+1;
	var string='';
	string+='<div id="rCatPart'+newx+'" class="partesRCat">';
	string+='<div class="form-group">';
	string+='<label>Categorías</label>';
	string+='<input type="button" name="name" onClick="removeColorCat('+newx+')" value="Borrar categoría('+newx+')" class="form-control">';
	string+='</div>';
	string+='<div class="form-group panelIzquierdo">';
	string+='<label>Valor</label>';
	string+='<input type="text" value="'+newx+'" class="form-control valorRCat">';
	string+='</div>';
	string+='<div class="form-group panelDerecho">';
	string+='<label>Descripción</label>';
	string+='<input type="text" class="form-control descRCat">';
	string+='</div>';
	string+='<div class="separador"><div class="form-group">';
	string+='<label>Categoría '+newx+'</label>';
	string+='<input type="color" value="#000000" class="form-control color">';
	string+='</div></div></div>';
	$(string).insertAfter("#rCatPart"+x);
}
function removeColorCat(id){
	$(".partesRCat").each(function(){
		var newId=$(this).attr("id").replace("rCatPart","");			
		if(newId==1) return;
		if(id<newId){
			$(this).attr("id","rCatPart"+(newId-1));
			$(this).find("input[type='button']").attr("onclick","removeColorCat("+(newId-1)+")");
			$(this).find(".separador").find('label').html("Categoría "+(newId-1));
			$(this).find("input[type='button']").attr("value","Borrar categoría("+(newId-1)+")");
		}
	});
	$("#rCatPart"+id).remove();
}

function addColorVC(){
	var x=$(".partesVCat").length;
	var newx=x+1;
	var string='';
	string+='<div id="vCatPart'+newx+'" class="partesVCat">';
	string+='<div class="form-group">';
	string+='<label>Categoría '+newx+'</label>';
	string+='<input type="button" name="name" onClick="removeColorVC('+newx+')" value="Borrar categoría('+newx+')" class="form-control">';
	string+='</div>';
	string+='<div class="form-group panelIzquierdo">';
	string+='<label>Valor</label>';
	string+='<input type="text" value="'+newx+'" class="form-control valorVCat">';
	string+='</div>';
	string+='<div class="form-group panelDerecho">';
	string+='<label>Descripción</label>';
	string+='<input type="text" value="" class="form-control descVCat">';
	string+='</div>';
	string+='<div class="separador">';
	string+='<div class="form-group color">';
	string+='<label>Color '+newx+'</label>';
	string+='<input type="color" value="#000000" class="form-control">';
	string+='</div>';
	string+='<div class="form-group">';
	string+='<select class="icon">';
	string+='</select>';
	string+='</div>';
	string+='</div>';
	string+='</div>';
	$(string).insertAfter("#vCatPart"+x);
	if($("#tipoDatoVCS").val()!="polygonOptions"){
		$("#vCatPart"+newx).find(".color").addClass("hidden");
		$("#vCatPart"+newx).find(".icon").removeClass("hidden");
	}else{
		$("#vCatPart"+newx).find(".color").removeClass("hidden");
		$("#vCatPart"+newx).find(".icon").addClass("hidden");
	}
	for(var a=0;iconosNames.length>a;a++){
		$("#vCatPart"+newx).find(".icon").append("<option value='"+iconosNames[a]+"'>"+iconosNames[a]+" </option>");
	}
	addIconsListener();
}
function removeColorVC(id){
	$(".partesVCat").each(function(){
		var newId=$(this).attr("id").replace("vCatPart","");			
		if(newId==1) return;
		if(id<newId){
			$(this).attr("id","vCatPart"+(newId-1));
			$(this).find("input[type='button']").attr("onclick","removeColorVC("+(newId-1)+")");
			$(this).find(":nth-child(1)").find('label').html("Categoría "+(newId-1));
			$(this).find('.separador').find('label').html("Color "+(newId-1));
			$(this).find("input[type='button']").attr("value","Borrar categoría("+(newId-1)+")");
		}
	});
	$("#vCatPart"+id).remove();
	recalcularStrech("vectorialCattinuo","strechVCat");
}
function GuardarColumna(){
	crearEstilo();
	var flag=true;
	flag=flag*vacio("columna");      
	if($("#valorFiltro").val()=="")
		var valorFiltro="";
	else
		var valorFiltro=$("#valorFiltro").val();
	if(flag)
		swal({title: "Se guardara la informacion de esta columna!",
			text: "¿Estas seguro de proceder?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Si, Guarda los datos",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false },
			function(isConfirm){
				if (isConfirm){
					swal("Columna Guardada!", "Esta columna se guardado correctamente", "success");
					var id=$("#id").val();
					var leyendaStrech = $("#tipoValores").val()==1?$("#leyendaStrech"+$("#tipoMapa").val()).val():"";
					$.ajax({
						data: {
							"opcion": 1,
							"columna":$("#columna").val(),
							"titulo":$("#titulo").val(),
							"valorFiltro":valorFiltro,
							"estilos":$("#estilos").val(),
							"tipoValores":$("#tipoValores").val(),
							"tipoMapa":$("#tipoMapa").val(),
							"leyendaStrech":leyendaStrech,
							"id" : id
						},
						type: "POST",
						dataType: "json",
						url: "MoFuSS/columnasModel.php",
					}).done(function( respuesta ) {
						id=respuesta.new;
						$("#Contenidos").load(host+"MoFuSS/columns.php",{id:id});
						$("#Lista").load(host+"MoFuSS/Lista.php",{lista:"columns"});
					}).fail(function( jqXHR, textStatus, errorThrown ) {
						if ( console && console.log ) {
							console.log( "La solicitud a fallado: " +  textStatus);
						}
					});
					return true;
				}else {
					swal("No se guardaron los datos", "", "error");
					return false;
				}
				return false;
		});
}
function DuplicarColumna(){
	swal({title: "Esta columnas se Duplicara",
		text: "¿Estas seguro de proceder?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Si, duplica",
		cancelButtonText: "No",
		closeOnConfirm: false,
		closeOnCancel: false },
		function(isConfirm){
			if (isConfirm){
				swal("Duplicar columna", "Esta columna se duplico", "error");
				var id=$("#id").val();
				$.ajax({
					data: {
						"opcion": 2,
						"columna":$("#columna").val(),
						"id" : id
					},
					type: "POST",
					dataType: "json",
					url: "MoFuSS/columnasModel.php",
				}).done(function( respuesta ) {
					id=respuesta.new;
					$("#Contenidos").load(host+"MoFuSS/columns.php",{id:id});
					$("#Lista").load(host+"MoFuSS/Lista.php",{lista:"columns"});
				}).fail(function( jqXHR, textStatus, errorThrown ) {
					if ( console && console.log ) {
						console.log( "La solicitud a fallado: " +  textStatus);
					}
				});
				return true;
			}else {
				swal("No se guardaron los datos", "", "error");
				return false;
			}
			return false;
	});
}
function EliminarColumna() {
	swal({   title: "Esta columna se eliminara",
		text: "¿Estas seguro de proceder?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",		
		confirmButtonText: "Si, elimina el columna",
		cancelButtonText: "No",
		closeOnConfirm: false,
		closeOnCancel: false },
		function(isConfirm){
			if (isConfirm){
				swal("columns Eliminado", "Esta Capa se elimino", "error");
				var id=$("#id").val();
				$.ajax({
					data: {
						"opcion": 0,
						"columna":$("#columna").val(),
						"url":$("#url").val(),
						"informacion":$("#informacion").text(),
						"id" : id
					},
					type: "POST",
					dataType: "json",
					url: "MoFuSS/columnasModel.php",
				}).done(function( respuesta ) {
					$("#Contenidos").load(host+"MoFuSS/columns.php");
					$("#Lista").load(host+"MoFuSS/Lista.php",{lista:"columns"});
				}).fail(function( jqXHR, textStatus, errorThrown ) {
					if ( console && console.log ) {
						console.log( "La solicitud a fallado: " +  textStatus);
					}
				});
				return true;
			}else {
				swal("Ok", "Esta Capa no se elimino", "success");
				return false;
			}
			return false;
	});
}
function addIconsListener(){
	$(".icon").on("click",function(){
		$(this).blur();  
		var id=$(this).parent().parent().parent().attr("id");
		$("#googleMap").attr("title",id);
		$("#googleMap").attr("style","display:block !important;");
	});
}
function hideShowTMTV(){
	if($("#tipoMapa").val()==1 && $("#tipoValores").val()==1){
		$("#rasterContinuo").show();
		$("#rasterCategorias").hide();
		$("#vectorialContinuo").hide();
		$("#vectorialCategoria").hide();
		$("#hideIfRaster").hide();
	}else if($("#tipoMapa").val()==1 && $("#tipoValores").val()==2){
		$("#rasterContinuo").hide();
		$("#rasterCategorias").show();
		$("#hideIfRaster").hide();
		$("#vectorialCategoria").hide();
		$("#vectorialContinuo").hide();
	}else if($("#tipoMapa").val()==2 && $("#tipoValores").val()==1){
		$("#rasterContinuo").hide();
		$("#rasterCategorias").hide();
		$("#hideIfRaster").show();
		$("#vectorialCategoria").hide();
		$("#vectorialContinuo").show();
	}else{
		$("#rasterContinuo").hide();
		$("#rasterCategorias").hide();
		$("#hideIfRaster").show();
		$("#vectorialCategoria").show();
		$("#vectorialContinuo").hide();
	}
}
function hideShowPrev(){
	if($("#tipoDatoVS").val()=="markerOptions"){
		$("#tipoDatoV").addClass("hidden");
		$("#vectorialContinuo").find(".grosor").addClass("hidden");
	}else if($("#tipoDatoVS").val()=="polylineOptions"){
		$("#tipoDatoV").addClass("hidden");
		$("#vectorialContinuo").find(".grosor").removeClass("hidden");
	} else {
		$("#tipoDatoV").removeClass("hidden");
		$("#vectorialContinuo").find(".grosor").removeClass("hidden");
	}
}
function hideShowPrev2(){
	if($("#tipoDatoVCS").val()=="markerOptions"){
		$("#tipoDatoVCat").addClass("hidden");
		$("#vectorialCategoria").find(".grosor").addClass("hidden");
	}else if($("#tipoDatoVCS").val()=="polylineOptions"){
		$("#tipoDatoVCat").addClass("hidden");
		$("#vectorialCategoria").find(".grosor").removeClass("hidden");
	} else {
		$("#tipoDatoVCat").removeClass("hidden");
		$("#vectorialCategoria").find(".grosor").removeClass("hidden");
	}
}
$(document).ready(function(){	
	var pinIcon=iconosNames;
	for(var a=0;pinIcon.length>a;a++){
		$("#vConPart1").find(".icon").append("<option value='"+pinIcon[a]+"'>"+pinIcon[a]+" </option>");
		$("#vCatPart1").find(".icon").append("<option value='"+pinIcon[a]+"'>"+pinIcon[a]+" </option>");
	}
	llenarFormulario();
	hideShowTMTV();
	$("#tipoMapa").change(function(){
		hideShowTMTV();
	});
	$("#tipoValores").change(function(){
		hideShowTMTV();
	});
	$("#tipoDatoVS").change(function(){
		hideShowPrev();
	});
	$("#tipoDatoVCS").change(function(){
		hideShowPrev2();
	});
});
$( ".tipoP" ).change(function () {
	console.log($(this).val()); 
	if($(this).val()!="markerOptions"){
		$(this).parent().parent().find(".icon").addClass("hidden");
		$(this).parent().parent().find(".color").removeClass("hidden");
	}else{
		$(this).parent().parent().find(".icon").removeClass("hidden");
		$(this).parent().parent().find(".color").addClass("hidden");
	}
});
$("#googleMap > img").on("click", function(){
	var titulo=$(this).attr("title");
	var img=$(this).attr("src");
	var id=$("#googleMap").attr("title");
	$("#"+id).find(".icon").val(titulo);
	$("#googleMap").attr("style","display:none !important;");
});
addIconsListener();