var pDQG = [];
var bounds = null;
var CentX=0;
var CentY=0;
var coorde=new Array(2);
var imagenesElementos=[];
var pruba=[];
pruba[0]="panel1.png";
pruba[1]="panel2.png";
pruba[2]="panel3.png";
imagenesElementos[0]=pruba;
var pruba=[];
pruba[0]="home1.png";
imagenesElementos[1]=pruba;
var pruba=[];
pruba[0]="capas1.png";
imagenesElementos[2]=pruba;
var pruba=[];
pruba[0]="capas1.png";
pruba[1]="capas2.png";
pruba[2]="capas3.png";
imagenesElementos[3]=pruba;
var pruba=[];
pruba[0]="capas1.png";
pruba[1]="capas4.png";
pruba[2]="capas3.png";
imagenesElementos[4]=pruba;

var pruba=[];
pruba[0]="capas4.png";
pruba[1]="capas2.png";
pruba[2]="capas3.png";
imagenesElementos[5]=pruba;
imagenesElementos[6]=pruba;
imagenesElementos[7]=pruba;
imagenesElementos[8]=pruba;
imagenesElementos[9]=pruba;

var descripcionElementos=[
                            "Proporciona un conjunto de herramientas para la elaboracion de calculos y modificar la visualizacion del mapa",
                            "Al precionarlo el usuario puede regresar a la pagina principal",
                            "Conjunto de capas activas",
                            "informacion relacionada al mapa y a la region visualizada",
                            "Conjunto de organizacion, que apoyan el proyecto",
                            "Permite observar todas las capas una seguida de la otra",
                            "Tipos de grupos existentes entre las capas visibles",
                            "Boton de ayuda",
                            "cerraCover"
                        ];
var elementosMuestra=[
                        "panelDeControl",
                        "MenuPrincipal .home-menu",
                        "MenuPrincipal",
                        "banner",
                        "imgMaps",
                        "playStop",
                        "grupos",
                        "tour",
                        "cerraCover"
                    ];
var infoS=[];
var overlayP;
var ref=document.referrer;
var suelos;
var valorOperacion=0;
var valorR=[]
var variables=[];
var V=0,inicialAux;
var dentroDeMenu=false;
//if(ref.indexOf("conabio")!=-1)
               // $("head").append("<script src='https://cdn.plot.ly/plotly-latest.min.js'></script>");
	/*if(home == "conabio"){
		//$("head").append("<script src='https://cdn.plot.ly/plotly-latest.min.js'></script>");
		setTimeout(function(){$("#subTemperatura>ul").prepend("<titulo>Media Anual |°C|</titulo>");
            $("#subPrecipitacion>ul").prepend("<titulo>Total Anual (mm)</titulo>");
        },1000);
        $("#banner").before("<div id='conabioEstadisticas'><button class='c' onClick='showEstadisticas()'>X</button><div id='graficasC0'></div><div id='graficasC1'></div><div id='graficasC2'></div><div id='graficasC3'></div></div>");
                /*$("#datosC").append("<div onClick='enGrande(this)'><img src='http://www.mofuss.unam.mx/Mapps/Conabio/uploads/galeria_Paises/32.jpg'><p>rvcrfvrrdvrdvrvrvrdrvrvdfvdvevvvgvrvrvrvrvrvrtdvrvrtvr</p></div>");
                $("#datosC").append("<div onClick='enGrande(this)'><img src='http://www.mofuss.unam.mx/Mapps/Conabio/uploads/galeria_Paises/23.jpg'><p>rvcrf654f65fy56fy5665f555656f56f656rvrvrvrvrvrtdvrvrtvr</p></div>");
                $("#datosC").append("<div onClick='enGrande(this)'><img src='http://www.mofuss.unam.mx/Mapps/Conabio/uploads/galeria_Paises/50.jpg'><p>rvcrfvrrdvrdvrvr5vdf565ff55ffff65f5vvrvrvrvrvrtdvrvrtvr</p></div>");
		setTimeout(function(){
			showEstadisticas();
			ajusteEstadisticas();
			$(".sel>select").change(function(){cargarTablas();});
		},2000);		
		//$("#graficasC0").before(tabla1());
		//$(".sel>select").change(function(e){cargarTablas(e);});
	}*/
                /*setTimeout(function(){
			resizeCheck();
                        resizeCheck();
			$("#playStop").click(function(){
				if(playStop){
					play();
				} else {
					traeDatosMenu();
					$("#grupos").removeClass("hidden");
				}
			});
                },3000);*/
//});
function entidadMenu(este){
	if($("#pan"+$(este).parent().attr("id")).html()==""){
		$("#pan"+$(este).parent().attr("id")).html("<div><input id='buscarEstado' type='text'/><i class='fa fa-search search'></i></div>");
        $.ajax({
            url : 'http://www.mofuss.unam.mx/Mapps/Global/getEstados.php',
            dataType : 'jsonp',
            data: {
                format: "json"
            },
            type:"POST",
            success: function(json) {
                $("#pan"+$(este).parent().attr("id")).append(json);
		$("#buscarEstado").keyup(function(){
			console.log($("#buscarEstado").val());
                        $(".opcionesEstados").addClass("hidden");
			$(".opcionesEstados span:contains("+$("#buscarEstado").val().toUpperCase()+")").parent().removeClass("hidden");
		});
            }
        });

	}
}
function ANPMenu(este){
    if($("#pan"+$(este).parent().attr("id")).html()==""){
        $("#pan"+$(este).parent().attr("id")).html("<div><input id='buscarEstado' type='text'/><i class='fa fa-search search'></i></div>");
        for(var x=1;x<nombresANP.length;x++)
            $("#pan"+$(este).parent().attr("id")).append("<div class='opcionesEstados' onclick='selEst(this)' title='"+x+"'><span>"+nombresANP[x]+"</span></div>");
        /*$.ajax({
            url : 'http://www.mofuss.unam.mx/Mapps/Global/getEstados.php',
            dataType : 'jsonp',
            data: {
                format: "json"
            },
            type:"POST",
            success: function(json) {
                $("#pan"+$(este).parent().attr("id")).append(json);
        $("#buscarEstado").keyup(function(){
            console.log($("#buscarEstado").val());
                        $(".opcionesEstados").addClass("hidden");
            $(".opcionesEstados span:contains("+$("#buscarEstado").val().toUpperCase()+")").parent().removeClass("hidden");
        });
            }
        });*/

    }
}
function entidad(){
$("#banner").after("<button onClick='quitarCapa()' id='quitarCapa'>X</button>");
getEnt();
}
function getDraw(este){
        if($(este).parent().find(".pan").html()==""){
                $(este).parent().find(".pan").append("<div class='dibujosSub'>"+$("#submenu8").html()+"</div>");
                $(este).parent().find(".pan").find(".hijo").remove();
        }
}
function enGrande(este){
if($(este).hasClass("enGrande"))
$(este).removeClass("enGrande");
else
$(este).addClass("enGrande")
}
function ajusteEstadisticas(){
if($("#conabioEstadisticas").hasClass("miniEstadisticas"))
$("#conabioEstadisticas").removeClass("miniEstadisticas");
else
$("#conabioEstadisticas").addClass("miniEstadisticas");
}
function showEstadisticas(){
if($("#conabioEstadisticas").hasClass("showEstadisticas")){
$("#conabioEstadisticas").removeClass("showEstadisticas");
$("#conabioEstadisticas").removeClass("miniEstadisticas");
}
else
$("#conabioEstadisticas").addClass("showEstadisticas");
/*if($("#conabioEstadisticas").length==1){
		$("#conabioEstadisticas").attr("style","bottom:"+$("#banner").outerHeight()+"px !important;");
                $("#conabioEstadisticas").attr("style","top:"+$("#MenuPrincipal").outerHeight()+"px !important;");
	}*/
}
function ajusteCoordenadas(coo, Ni,size){    
	var cooN=[];
	for(var x=0;size>x;x++){
		cooN[x]=coo[Ni+x];
		if(Ni+x+1==size)
			Ni=-x-1;
	}
	return cooN;
}
function capaSeleccionada(type,coordsAux,tabla,llave1,llave2,valor1,valor2){
    recurso=$("#capaSeleccionar option:selected").attr("id").replace("capa","");
    console.log(recurso);
    var mapid=$("#capaSeleccionar option:selected").attr("id");
    var flag=$("#capaSeleccionar option:selected").attr("flag");
    suelos=$("#suelo").html();
    var usoSueloSel=$("#usoSuelo").val();
    var usarANP=$("#usarANP").val();
    var usarPen=$("#usarPen").val();
    $("#datosOverlay").html("");
    $("#datosOverlay").attr("style","right:-30% !important;");
    setTimeout(function(){$("#datosOverlay").addClass("hidden");$("#datosOverlay").attr("style","");},1000);
    var id=mapid.replace("capa","");
    //$("#loadingDiv").show();
	$("#cortina").removeClass("removeCortina");
    getStadistics(id,flag, usoSueloSel,type,coordsAux,tabla,llave1,llave2,valor1,valor2,usarANP,usarPen);
    console.log(id);    
    //chequeoDeContenido(id,flag);
}
function capaSeleccionada2(type,coordsAux,tabla,llave1,llave2,valor1,valor2){
    recurso=$("#capaSeleccionarD option:selected").attr("id").replace("capa","");
    console.log(recurso);
    var mapid=$("#capaSeleccionarD option:selected").attr("id");
    var flag=$("#capaSeleccionarD option:selected").attr("flag");
    suelos=$("#suelo").html();
    var usoSueloSel=$("#usoSuelo").val();
    var usarCercania=$("#usarCercania").val();
    var usarPotencia=$("#usarPotencia").val();
    $("#datosOverlay2").html("");
    $("#datosOverlay2").attr("style","right:-30% !important;");
    setTimeout(function(){$("#datosOverlay2").addClass("hidden");$("#datosOverlay2").attr("style","");},1000);
    var id=mapid.replace("capa","");
	$("#cortina").removeClass("removeCortina");
    getStadistics(id,flag, usoSueloSel,type,coordsAux,tabla,llave1,llave2,valor1,valor2,usarCercania,usarPotencia);
    console.log(id);
}
function cancelar(id){
    $("#"+id).removeClass("muestra");
}
function captura(){
    console.log($("#formula").html());
}
function Cover(){
    if($("#cover").hasClass("muestraCover")){
	   $("#cover").removeClass("muestraCover");
       $(".dropdown-menu").attr("style","");
       $(".dropdown-menu").removeClass("box");
	   setTimeout(function(){$("#cover").html("");},1000);
    }
    else{
        $.ajax({
            url : 'http://www.mofuss.unam.mx/Mapps/Global/fabrica.php',
            dataType : 'jsonp',
            data: {
                t: "infoCover",
                seleccionado: mapa,
                parent: home,
                format: "json"
            },
            type:"POST",
            success: function(json) {
                var id="cover";
                $("#"+id).html("");
                $("#"+id).html(json);
                $("#"+id).addClass("muestraCover");
            }
        });
    }
}
function crearDiagrama(){
    nV=0;
    $("#formula").append("<div class='AreaDeTrabajo'></div>");
    var val=$("#datosOverlay>p").first().next().text().replace("Sum:","").replace(/[^0-9\.]+/g, '');
    printLog(val);
    $(".AreaDeTrabajo").append("<div class='base padre hidden'><h2><button onClick='seleccionarOpcion(this)'>START: "+val.replace(/[a-zA-Z\s\t\n,%$#]*/g, '')+"<p class='hidden' tipo='-1'>Start</p></button></h2></div>");
    $("#formula").append("<div id='descripcionDiagrama'></div>");
    valorOperacion=parseFloat(val);
    V=parseFloat(val);
    inicialAux=parseFloat(val);
    valorR[0]=valorOperacion;
    printLog(inicialAux);
    for(var a=0;variables.length>a;a++){   
        eval("delete "+variables[a]+";");
    }
    variables=new Array();
    $(".AreaDeTrabajo>div>h2>button").trigger("click");
}
function datosOverlay(){
    $('#datosOverlay').remove();
    $('#formula').remove();
}
function datosOverlay2(){
    $('#datosOverlay2').remove();    
}
function diferencia(){
	$.ajax({ 
		url : 'http://www.mofuss.unam.mx/Mapps/Global/fabrica.php', 
		dataType : 'jsonp', 
		data: {
            t: "capas2",
            seleccionado: mapa,
            format: "json"
        },
        type:"POST",
		success: function(json) {
			$("#restaCapas").html("");
			$("#restaCapas").html(json);
			$("#restaCapas #Ncapa2 option[value='"+$( "#restaCapas #Ncapa1" ).val()+"']").attr("style","display:none");
			$('#restaCapas #Ncapa2 option[value="'+$( '#restaCapas #Ncapa1' ).val()+'"]').next().attr('selected', 'selected');
			$( "#restaCapas #Ncapa1" ).change(function(){
				$("#restaCapas #Ncapa2 option").each(function( index ) {
  					$(this).attr("style","display:block");
				});
				$("#restaCapas #Ncapa2 option[value='"+$( "#restaCapas #Ncapa1" ).val()+"']").attr("style","display:none");
			});
            $( "#restaCapas #Ncapa2" ).change(function() {
                $("#restaCapas #Ncapa1 option").each(function( index ) {
                    $(this).attr("style","display:block");
                });
                $("#restaCapas #Ncapa1 option[value='"+$( "#restaCapas #Ncapa2" ).val()+"']").attr("style","display:none");
            });
			$("#restaCapas").addClass("muestra");
			$("#interseccionCapas").removeClass("muestra");
        }
    });
}
function esSentidoH(lats,lngs,arrayN){
	var st=0;
	var s=0;
	for(var x=0;arrayN>x;x++){
       	if(arrayN!=(x+1))
            s=(parseFloat(lats[x+1])+parseFloat(lats[x]))*(parseFloat(lngs[x+1])-parseFloat(lngs[x]));
        else
            s=(parseFloat(lats[0])+parseFloat(lats[x]))*(parseFloat(lngs[0])-parseFloat(lngs[x]));
		st=st+s;
	}
	return st>0;
}
function formula(){    
	if($('#formula').length==0){
		$('#cover').after('<div id="formula"><button onClick="formula()">X</button></div>');
		crearDiagrama();
	}
	else{
		$('#formula').remove();
	}
}
function grupPersiana(clase){
	if($(".persiana"+clase).hasClass("hidden"))
		$(".persiana"+clase).removeClass("hidden");
	else
		$(".persiana"+clase).addClass("hidden");
}
function info(este,flag){
	if(flag){
		if(infoS[$(este).attr("name")]==undefined){
            $.ajax({
                url : 'http://www.mofuss.unam.mx/Mapps/Global/relaciones.php',
                dataType : 'jsonp',
                data: {
                    pais: mapa,
                    padre:$(este).attr("name"),
		    recurso:recurso,
                    opcion:2,
                    format: "json"
                },
                type:"POST",
                success: function(json) {
                    infoS[$(este).attr("name")]=json;
		      		$("#descripcionDiagrama").html(infoS[$(este).attr("name")]);
                    $("#descripcionDiagrama").removeClass("hidden");
                    setTimeout(function(){$("#descripcionDiagrama").removeClass("prebase");},100);
                }
            });
        }
        else{
            $("#descripcionDiagrama").html(infoS[$(este).attr("name")]);
            $("#descripcionDiagrama").removeClass("hidden");
            setTimeout(function(){$("#descripcionDiagrama").removeClass("prebase");},100);
	   }
    }
	else{
		$("#descripcionDiagrama").html("");
                $("#descripcionDiagrama").addClass("hidden");
                $("#descripcionDiagrama").addClass("prebase");
	}
}
function interseccion(){
    $.ajax({
        url : 'http://www.mofuss.unam.mx/Mapps/Global/fabrica.php',
        dataType : 'jsonp',
        data: {
            t: "capas3",
            seleccionado: mapa,
            format: "json"
        },
        type:"POST",
        success: function(json) {
    		var id="interseccionCapas";
            $("#"+id).html("");
            $("#"+id).html(json);
            $("#"+id+" #Ncapa2 option[value='"+$( "#"+id+" #Ncapa1" ).val()+"']").attr("style","display:none");
    		$('#'+id+' #Ncapa2 option[value="'+$( '#'+id+' #Ncapa1' ).val()+'"]').next().attr('selected', 'selected');
            $( "#"+id+" #Ncapa1" ).change(function(){
                $("#"+id+" #Ncapa2 option").each(function( index ) {
                    $(this).attr("style","display:block");
                });
                $("#"+id+" #Ncapa2 option[value='"+$( "#"+id+" #Ncapa1" ).val()+"']").attr("style","display:none");
            });
            $( "#"+id+" #Ncapa2" ).change(function() {
                $("#"+id+" #Ncapa1 option").each(function( index ) {
                    $(this).attr("style","display:block");
                });
                $("#"+id+" #Ncapa1 option[value='"+$( "#"+id+" #Ncapa2" ).val()+"']").attr("style","display:none");
            });
            $("#interseccionCapas").addClass("muestra");
    		$("#restaCapas").removeClass("muestra");
        }
    });
}
function listaCapas2(type,coordsAux,tabla,llave1,llave2,valor1,valor2){ 
    gettingDemand = true;
	$("#cortina").removeClass("removeCortina");    
    if($("#datosOverlay2").length==0)
        $("#cover").after("<div id='datosOverlay2' class=''></div>");
    $("#datosOverlay2").html("");
    $("#datosOverlay2").append("<button onClick='datosOverlay2()'>X</button>");
    $("#datosOverlay2").append("<p>Selecci&oacute;n de sector de demanda</p>");
    $("#datosOverlay2").append("<select id='capaSeleccionarD'></select>");
    $("#datosOverlay2").append("<p>Restringir demanda total seg&uacute;n los siguientes criterios<br><br>1.-Por alguna clase particular de cobertura/uso del suelo</p>");
    if(suelos==undefined)
	   $("#datosOverlay2").append("<div id='sueloD'>select</div>");
    else
	   $("#datosOverlay2").append("<div id='suelo'>"+suelos+"</div>");
    $("#datosOverlay2").append("<p>2.- Baja, Media ó Alta potencia </p><select id='usarPotencia'><option value='0'>Baja</option><option value='1'>Media</option><option value='2'>Alta</option></select>");
    $("#datosOverlay2").append("<p>3.- Cercania a subestaciones y l&iacute;neas de alta tensi&oacute;n</p><select id='usarCercania'><option value='0'>No</option><option value='1'>Si</option></select>");    
    $("#datosOverlay2").append("<input type='button' onClick='capaSeleccionada2(\""+type+"\",\""+coordsAux+"\",\""+tabla+"\",\""+llave1+"\",\""+llave2+"\",\""+valor1+"\",\""+valor2+"\")' value='OK'/>");
    $.ajax({
        url : 'http://www.mofuss.unam.mx/Mapps/Global/fabrica.php',
        dataType : 'jsonp',
        data: {
            seleccionado: mapa,
            t:"grupoDemanda",
            format: "json"
        },
        type:"POST",
        success: function(json) {
   			$("#capaSeleccionarD").append(json);
			$("#cortina").addClass("removeCortina");
        }
    });
}
function listaCapas(type,coordsAux,tabla,llave1,llave2,valor1,valor2){ 
    $("#cortina").removeClass("removeCortina");
    $("#formula").remove();
    if($("#datosOverlay").length==0)
        $("#cover").after("<div id='datosOverlay' class=''></div>");
    $("#datosOverlay").html("");
    $("#datosOverlay").append("<button onClick='datosOverlay()'>X</button>");
    $("#datosOverlay").append("<p>Selecci&oacute;n de materia prima</p>");
    $("#datosOverlay").append("<select id='capaSeleccionar'></select>");
    $("#datosOverlay").append("<p>Restringir oferta total seg&uacute;n criterios de sustentabilidad<br><br>1.-Por alguna clase particular de cobertura/uso del suelo</p>");
    if(suelos==undefined)
	   $("#datosOverlay").append("<div id='suelo'>select</div>");
    else
	   $("#datosOverlay").append("<div id='suelo'>"+suelos+"</div>");
    $("#datosOverlay").append("<p>2.- Excluyendo &aacute;reas naturales protegidas</p><select id='usarANP'><option value='0'>No</option><option value='1'>Si</option></select>");
    $("#datosOverlay").append("<p>3.- Excluyendo pendientes mayores a 10&deg;</p><select id='usarPen'><option value='0'>No</option><option value='1'>Si</option></select>");    
    $("#datosOverlay").append("<input type='button' onClick='capaSeleccionada(\""+type+"\",\""+coordsAux+"\",\""+tabla+"\",\""+llave1+"\",\""+llave2+"\",\""+valor1+"\",\""+valor2+"\")' value='OK'/>");
    $.ajax({
        url : 'http://www.mofuss.unam.mx/Mapps/Global/fabrica.php',
        dataType : 'jsonp',
        data: {
            seleccionado: mapa,
            t:"grupoCapas",
            format: "json"
        },
        type:"POST",
        success: function(json) {
   			$("#capaSeleccionar").append(json);
			$("#cortina").addClass("removeCortina");
        }
    });
}
function loadingGif(){
    $('#banner').after('<div id="cortina" style="position: fixed;top: 0px;left: 0px;width: 100%;height: 100%;background: white;z-index: 10001;"><i class="fa fa-'+icono+'" style="font-size: 300px;margin:auto;margin-top: 100px;"></i></div>');
}
function mostrarVariables(formula,desc){
    var res="";
	var last=0;
    var base=$(".areaDeTrabajo>.base").length-2;    
    console.log(base);
    for(var a=0;formula.length>a;a++){
        eval("res+='<br>"+formula[a]+": '+Math.round("+formula[a]+"["+base+"]*100)/100;");
		eval("last=Math.round("+formula[a]+"["+base+"]*100)/100;");
    }
    return ["<p>"+res+" "+desc+"</p>",last];
}
function menuCenter(){
    var x=$(".navbar-nav").width();
    var X=$(".navbar-collapse").width();
    var df=(X-x)/2;
    if($(window).width()>770)
        $(".navbar-nav").prop("style","margin-right: "+df+"px");
    else 
        $(".navbar-nav").prop("style","margin-right: 0px");
}
function obtenNorte(lats){
	var Norte=Math.max.apply(null,lats);
	var Nindex=lats.indexOf(Norte);
	return Nindex;
}
function polygonCenter(poly) {
    var lowx=1000;
    var lowy=1000;
    var maxx=-1000;
    var maxy=-1000;
    //console.log(poly);
    for(var i=0; i<poly.length; i++) {
      if(lowx>poly[i][0])lowx=poly[i][0];
      if(lowy>poly[i][1])lowy=poly[i][1];
      if(maxx<poly[i][0])maxx=poly[i][0];
      if(maxy<poly[i][1])maxy=poly[i][1];
    }
    return new google.maps.LatLng((lowy+(maxy-lowy)/2),(lowx+(maxx-lowx)/2));
}
function replaceVariables(formula){
    var base=$(".areaDeTrabajo>.base").length-3;  
    var formulaS=formula.split("=")[1];
    var res=formula.split("=")[0];
    for(var a=0;variables.length>a;a++){    
        formulaS=formulaS.replace(variables[a],variables[a]+"["+(base+1)+"]");
    }
    console.log(res+"["+(base+1)+"]="+formulaS);
    return res+"["+(base+1)+"]="+formulaS;
}
function resultado(op){
    if(op==1){var opL="D";var id="restaCapas";}
    else {var opL="I";var id="interseccionCapas";}
    var id1=parseInt($("#"+id+"> #Ncapa1" ).val());
    var id2=parseInt($("#"+id+"> #Ncapa2" ).val());
    if($("#n"+id1+"_"+id2+"_"+opL).length==0){
        var name1=$("#"+id+"> #Ncapa1  option[value='"+id1+"']" ).text();
        var name2=$("#"+id+"> #Ncapa2 option[value='"+id2+"']" ).text();
        getMapOper(id1,id2,op);
        if(op==1)cancelar("restaCapas");
        else cancelar("interseccionCapas");
        if(op==1)
            capa(id1+"_"+id2+"_D","", id1+"_"+id2+"_D","tiff", "( "+name1+" ) - ( "+name2+" )", "checked");
        else
            capa(id1+"_"+id2+"_I","", id1+"_"+id2+"_I","tiff", "( "+name1+" ) &#8745 ( "+name2+" )", "checked");
        chequeo();
    }
}
function seleccionarOpcion(este){
    nV=$(".areaDeTrabajo>.base").length-1;
    for(var a=0;variables.length>a;a++){   
        eval(variables[a]+"["+nV+"]="+variables[a]+"["+(nV-1)+"];");
        eval("console.log('"+variables[a]+": '+"+variables[a]+");");
    }
	var nombre=$(este).find("p").text();
	var flag=true;
	if($(este).find("p").attr("tipo")==1)var clase="proceso";
	else if($(este).find("p").attr("tipo")==0)var clase="datos";
	else if($(este).find("p").attr("tipo")==2){var clase="final";flag=false;}
	$(este).parent().parent().nextAll().remove();
    if($(este).parent().parent().hasClass("datos"))
        $(este).parent().parent().find("select").attr("disabled","disabled");
	if(clase=="datos")
		$(este).parent().parent().after("<div onClick='showOpciones(this)' class='prebase base padre "+clase+"'><i class='fa fa-info-circle' onmouseover='info(this, true)' onmouseout='info(this, false)'  name='"+nombre+"'></i><h2>"+nombre+"</h2><input type='number' id='"+nombre.replace(" ","_")+"'/></div>");    
	else                                                                   
		$(este).parent().parent().after("<div onClick='showOpciones(this)' class='prebase base padre "+clase+"'><i class='fa fa-info-circle' onmouseover='info(this, true)' onmouseout='info(this, false)'  name='"+nombre+"'></i><h2>"+nombre+"</h2></div>");
	setTimeout(function(){$(".base").removeClass("prebase")},100);
    $.ajax({
		url : 'http://www.mofuss.unam.mx/Mapps/Global/relaciones.php',
        dataType : 'jsonp',
        data: {
           	pais: mapa,
			recurso:recurso,
           	padre:nombre,
            opcion:1,
      		format: "json"
    	},
        type:"POST",
        success: function(json) {
            var igualdades=false;
            if(nombre!="Start"){				
                if(clase=="datos"){
                    $.ajax({
                        url : 'http://www.mofuss.unam.mx/Mapps/Global/relaciones.php',
                        dataType : 'jsonp',
                        data: {
                            pais: mapa,
							recurso:recurso,
                            padre:nombre,
                            opcion:3,
                            format: "json"
                        },
                        type:"POST",
                        success: function(json1) {
                            var opcion=json1.split("|");
                            var select="";
                            var d1="0";
                            for (var z = 0; z < (nV); z++) {
                                d1+=",0";
                            }
                            var change="<script> variables.push('"+nombre.replace(" ","_")+"');"+nombre.replace(" ","_")+"=["+d1+"];"
                                        +nombre.replace(" ","_")+"["+(nV-1)+"]=$('#"+nombre.replace(" ","_")+"').val();"
                                        +nombre.replace(" ","_")+"["+(nV)+"]=$('#"+nombre.replace(" ","_")+"').val();"
                                        +"$('#"+nombre.replace(" ","_")+"').change(function(){"
                                        +nombre.replace(" ","_")+"["+(nV-1)+"]=$('#"+nombre.replace(" ","_")+"').val();"
                                        +nombre.replace(" ","_")+"["+(nV)+"]=$('#"+nombre.replace(" ","_")+"').val();"
                                        +"});</script>";
                            for(var a=0;a<opcion.length;a++){
                                select+="<option>"+opcion[a]+"</option>";
                            }
                            $("#"+nombre.replace(" ","_")).after("<select id='"+nombre.replace(" ","_")+"Aux'></select>");
                            $("#"+nombre.replace(" ","_")).remove();
                            $("#"+nombre.replace(" ","_")+"Aux").attr("id",nombre.replace(" ","_"));
                            $("#"+nombre.replace(" ","_")).append(select);
                            $("#"+nombre.replace(" ","_")).after(change);
                        }
                    });
                }
			}
        	$.ajax({
            	url : 'http://www.mofuss.unam.mx/Mapps/Global/relaciones.php',
            	dataType : 'jsonp',
            	data: {
            		pais: mapa,
					recurso:recurso,
                    padre:nombre,
          			opcion:0,
    	      		format: "json"
   				},
           		type:"POST",
           		success: function(json2) {
               		var elements=json2.split(",");
               		$(este).parent().parent().next().append("<div class='hijo'></div>");
                    for(var x=1;x<elements.length;x++){
    	                var prop=elements[x].split("|");
                      	var tipo=prop[0];
   		                var texto=prop[1];
                        if(tipo==1)var claseH="proceso";
			            else if(tipo==0)var claseH="datos";
			            else if(tipo==2)var claseH="final";
                        $(este).parent().parent().next().find(".hijo").append("<div class='opciones "+claseH+"' onClick='seleccionarOpcion(this)'><i onmouseover='info(this, true)' onmouseout='info(this, false)' class='fa fa-info-circle' name='"+texto+"'><p tipo='"+tipo+"'>"+texto+"</p></div>");
                    }
                    var formula="";
                    $.ajax({
                        url : 'http://www.mofuss.unam.mx/Mapps/Global/relaciones.php',
                        dataType : 'jsonp',
                        data: {
                            pais: mapa,
							recurso:recurso,
                            padre:nombre,
                            opcion:1,
                            format: "json"
                        },
                        type:"POST",
                        success: function(json2) {
                            formula=json2[0];
							var desc=json2[1];
                            if(clase=="datos"){
                                var valores=formula.split("|");
                            }else if(clase=="proceso"){				
								printLog(formula);
								printLog(inicialAux);
                                var formulas=formula.split(";");
                                var d1="0";
                                for (var z = 0; z < (nV-1); z++) {
                                    d1+=",0";
                                }
                                for(var i=0;formulas.length>i;i++){
                                    var checkVariables=formulas[i].split("=");
                                    if(jQuery.inArray(checkVariables[0],variables)==-1){
                                        eval(""+checkVariables[0]+"=["+d1+"];");
                                        variables.push(checkVariables[0]);
                                        console.log(checkVariables[0]);
                                    }
                                    eval(replaceVariables(formulas[i])+";");
                                }   
                            }else{
                                var mostrar=formula.split(";");
                                var checkVariables=mostrar;
                                var d1="0";
                                for (var z = 0; z < (nV-1); z++) {
                                    d1+=",0";
                                }
                                for(var i=0;mostrar.length>i;i++){
                                    if(jQuery.inArray(checkVariables[i],variables)==-1){
                                        eval(""+checkVariables[i]+"=["+d1+"];");
                                        variables.push(checkVariables[i]);
                                        console.log(checkVariables[i]);
                                    }
                                } 
                                var res=mostrarVariables(mostrar,desc);
                                $(".resultados").html(res[0]);
								if(res[1]!=0){
									totalProduccion = res[1];
									$("#getDemand").show();
									console.log(res);
								}
                            }
                        }
                    });
                    if(!flag){
						var resultadoFinal=V;						
						//$(este).parent().parent().next().find("h2").remove();
						$(este).parent().parent().next().append("<div class='resultados'> Resultado = "+resultadoFinal+"</div>");						
					}
               		$(este).parent().parent().after("<i class='fa fa-arrow-right'></i>");
               		if(elements.length==2 && clase!="datos")
                   		setTimeout(function(){$(este).parent().parent().next().next().find(".opciones").trigger("click");
                  			if(!flag){
                      			$(".base>.hijo").remove();
                   			}
                   		},500);			
				}
 			});
    	}
 	});
}
function setLatLong(){
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
                        console.log(zoomN);
			if(zoomN>5.95)zoomN=zoomN+2;
			var latitudN=data.results[0].geometry.location.lat;
			var longitudN=data.results[0].geometry.location.lng;
			mapG.setCenter(new google.maps.LatLng(latitudN,longitudN));
			mapG.setZoom(Math.round(zoomN));
			closebox("cajabuscar");
		}
	});
}
function showOpciones(este){
    if($(este).children(".hijo").hasClass("showOpcion"))
        $(".hijo").removeClass("showOpcion")
    else{
        $(".hijo").removeClass("showOpcion")
        $(este).children(".hijo").addClass("showOpcion")
    }
}
function selectEstado(momento){
    if(momento==0){
        $("#banner").after("<div id='selectEstado'><button onClick='selectEstado(1)'>Aceptar</button></div>");
        $.ajax({
            url : 'http://www.mofuss.unam.mx/Mapps/Global/fabrica.php',
            dataType : 'jsonp',
            data: {
                t: "claveEstados",
                seleccionado: mapa,
                format: "json"
            },
            type:"POST",
            success: function(json) {
                $("#selectEstado").append(json);
            	//getEnt(json); 
			}
        });

    }else{
		var idEnt=$('#selectEstado>select option:selected').val();
		if(idEnt<10)
			getEnt();
		else
            getEnt();
           $("#selectEstado").remove();
        }
}
function Tour(act){
    if(act=="#close#")
	   $(".cortina").remove();
    else{
        var elemento=act;
        if(elementosMuestra.indexOf(act)==0){
            if(!$("#MenuPrincipal").find("li").first().hasClass("active")){
                $("#MenuPrincipal").find("li").first().find("a").trigger("click");
                elementosMuestra.splice((elementosMuestra.indexOf("MenuPrincipal")+1),0,"capas .capa .paletaColores");
                elementosMuestra.splice((elementosMuestra.indexOf("MenuPrincipal")+1),0,"capas .capa form");
                elementosMuestra.splice((elementosMuestra.indexOf("MenuPrincipal")+1),0,"capas .capa .slideThree");
                elementosMuestra.splice((elementosMuestra.indexOf("MenuPrincipal")+1),0,"capas .capa");
                elementosMuestra.splice((elementosMuestra.indexOf("MenuPrincipal")+1),0,"capas");

                descripcionElementos.splice((elementosMuestra.indexOf("MenuPrincipal")+1),0,"Conjunto de colores con que esta formada la capa ");
                descripcionElementos.splice((elementosMuestra.indexOf("MenuPrincipal")+1),0,"capas .capa form");
                descripcionElementos.splice((elementosMuestra.indexOf("MenuPrincipal")+1),0,"Indicador del estado actual de la capa");
                descripcionElementos.splice((elementosMuestra.indexOf("MenuPrincipal")+1),0,"Informacion y configuracion de capa activa");
                descripcionElementos.splice((elementosMuestra.indexOf("MenuPrincipal")+1),0,"Capas activas actualmente");
            }
        }
        var next=elementosMuestra[elementosMuestra.indexOf(act)+1];
        var back=elementosMuestra[elementosMuestra.indexOf(act)-1];
        var p= $( "#"+elemento);
        var l=p.offset().left;
        var t=p.offset().top;
        var w=p.outerWidth();
        var h=p.outerHeight();
        $(".cortina").remove();
        //$("#banner").after("<div class='cortina explicacion'><video height='400px'muted autoplay loop><source src='http://www.mofuss.unam.mx/Mapps/Global/efecto.mp4' type='video/mp4'></video><p>"+elementosMuestra[elementosMuestra.indexOf(elemento)]+"</p></div>");
        var img="";
        console.log(elementosMuestra.indexOf(elemento));
        for(var x=0;x<imagenesElementos[elementosMuestra.indexOf(elemento)].length;x++){
            img+="<img src='http://www.mofuss.unam.mx/Mapps/Global/uploads/tour/"+imagenesElementos[elementosMuestra.indexOf(elemento)][x]+"'>";
        }
        $("#banner").after("<div class='cortina explicacion'>"+descripcionElementos[elementosMuestra.indexOf(elemento)]+"<div class='imagenesTour'>"+img+"</div></div>");
        $("#banner").after("<div class='cortina' style='left:0px; top:"+t+"px; width:"+l+"px; height:"+h+"px;'></div>");
        $("#banner").after("<div class='cortina' style='left:0px; right:0px; top:"+t+"px; margin-left:"+(l+w)+"px; height:"+h+"px;'></div>");
        $("#banner").after("<div class='cortina' style='left:0px; top:"+(t+h)+"px; width:100%; bottom:0px;'></div>");
        $("#banner").after("<div class='cortina' style='left:0px; top:0px; width:100%; height:"+t+"px;'></div>");
        $("#banner").after("<div class='cortina selec' style='left:"+l+"px; top:"+t+"px; width:"+w+"px; height:"+h+"px;'></div>");

        if(next!=undefined)$("#banner").after('<i class="fa fa-chevron-right next cortina" onClick="Tour(\''+next+'\')"></i>');
        else $("#banner").after('<i class="fa fa-chevron-right next cortina" onClick="Tour(\'#close#\')"></i>');
        if(back!=undefined)$("#banner").after('<i class="fa fa-chevron-left back cortina" onClick="Tour(\''+back+'\')"></i>');
        else $("#banner").after('<i class="fa fa-chevron-left back cortina" onClick="Tour(\'#close#\')"></i>');
        $("#banner").after('<i class="fa fa-times closer cortina" onClick="Tour(\'#close#\')"></i>');
    }
}
function traductor(){
    if($("#google_translate_element").hasClass("verTraductor"))$("#google_translate_element").removeClass("verTraductor");
    else $("#google_translate_element").addClass("verTraductor");
}

$(window).resize(function(){
    menuCenter();
});

