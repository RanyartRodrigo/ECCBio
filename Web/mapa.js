function confirmacionCapa(idLi,idDiv,mapid,clase,title,check){
	$.getJSON(
		'/getmappassword', {'mapid':mapid,'bd':home},
		function(data) {
			data.forEach(function(layer, i) {
				password = "";
				password = layer.password;
				if(password!=""){
					$('#banner').after('<div id="Pass"><div><label>Password:</label><input onkeypress="return isEnter(event)"  type="text" id="passUSR" name="pass"><input class="hidden" id="li" value="'+idLi+'"><button id="sendPass" onClick="confPassword(\''+idLi+'\',\''+idDiv+'\',\''+mapid+'\',\''+clase+'\',\''+title+'\','+check+')">OK</button></div></div>');
				}else{
					addMapLayer(idLi,idDiv,mapid,clase,title,check);
				}
			});
		}
	);
}

function isEnter(e){
	if(e.keyCode == 13){
		$("#sendPass").click();
		return false;
	}
}

function confPassword(idLi,idDiv,id,clase,title,check){
	if($('#passUSR').val() == password){		
		addMapLayer(idLi,idDiv,id,clase,title,check);
		$("#Pass").remove();
	} else {
		$("#Pass").remove();
		$('#banner').after('<div id="Pass"><div><label>Wrong password, try again please</label><button onClick="hideWP()">OK</button></div></div>');
	}
}

function hideWP(){
	$("#Pass").remove();
}

function addMapLayer(idLi,idDiv,id,clase,title,check,opacity,prioridad){
	$("#"+idLi).find("svg").removeClass("fa-toggle-off");
	$("#"+idLi).find("svg").addClass("fa-toggle-on");
	eventoChange(!check, id, opacity,prioridad);
}

function agregarCapa(idLi,idDiv,id,clase,title,prioridad){
	
   console.log(idLi,id);
   var opacity = $("#points"+id).val();
   var check = $("#"+idLi).find("svg").hasClass("fa-toggle-on");
   if(!check){
        addMapLayer(idLi,idDiv,id,clase,title,check,opacity,prioridad);
        //agregar al panel de capas activas
        agregaDiv(id);
   }else{
		$("#"+idLi).find("svg").removeClass("fa-toggle-on");
		$("#"+idLi).find("svg").addClass("fa-toggle-off");		
        eventoChange(!check, id, opacity,prioridad);
        //quitar de panel de capas activas
        remueveDiv(id);
   }
}
function openFind(){
	gradient("cajabuscar",0);
	fadein("cajabuscar");
	$("#buscar").val("");
}