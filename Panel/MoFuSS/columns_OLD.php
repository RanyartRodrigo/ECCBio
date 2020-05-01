
                                 <?php

if(isset($_POST['id'])){
 include '../base.php';
                            $obj=new Base("localhost","root","global");
                             $result = $obj->consulta( "SELECT * FROM columnas where idColumna=".$_POST['id']);

  $numfilas = $result->num_rows;
  $fila = $result->fetch_object();
  $edit=$fila;
   }




echo '<div><div class="form-group">';
 if(isset($edit->columna)) echo '<h4>"'.$edit->titulo.'" edit:</h4>'; else echo '<h4>Nuevo</h4>';
   ?>
 </div>
                    <input type="text" name="id" id="id" value="<?php if(isset($edit->idColumna)) echo $edit->idColumna?>" class="form-control hidden">
                                                               <div class="separador">
<div class='panelIzquierdo'>
                       <div class="form-group">
              <label for="name">Titulo: </label>
              <input type="text" name="name" id="titulo" value="<?php if(isset($edit->titulo)) echo $edit->titulo?>" class="form-control">
          </div>
                       <div class="form-group">
              <label for="name">Columnas: </label>
              <input type="text" name="name" id="columna" value="<?php if(isset($edit->columna)) echo $edit->columna?>" class="form-control">
          </div>

                <div class="form-group">
              <label for="name">Filtro: </label>
              <input type="text" name="name" id="valorFiltro" value="<?php if(isset($edit->valorFiltro)) echo $edit->valorFiltro?>" class="form-control">
          </div>
          <div class="form-group">
              <label for="name">Estilo Name: </label>
              <input type="text" name="name" id="valorName" value="" class="form-control">
          </div>
          <div class="form-group">
              <input type="button" name="name" onClick="addPart()" value="new limit" class="form-control">
          </div>
</div>
<div class='panelDerecho'>
          <div id="part1" class="partes separador">
                        <div class="form-group">
                <select name="name" id="" value="" class="form-control tipoP">
<option value="polygonOptions">polygonOptions</option>
<option value="polylineOptions">polylineOptions</option>
<option value="markerOptions">markerOptions</option>
</select>
  </div>
           <div class="form-group">
                <input type="checkbox" class="form-control siC" checked>
                <input type="color" name="name" id="" value="#000000" class="form-control color">
            </div>
            <div class="form-group">
                
                <select type="text" name="name" id="" value="" class="form-control icon"></select>
            </div>
            <div class="form-group panelIzquierdo">
                <label for="name">limitA1: </label>
                <input type="text" name="name" onBlur="cambioValor(1,0)" value="0" class="form-control limitA">
            </div>
            <div class="form-group panelDerecho">
                <label for="name">limitB1: </label>
                <input type="text" name="name" onBlur="cambioValor(1,1)" value="0" class="form-control limitB">
            </div>
          </div>
</div>
                  <div class="form-group hidden">
              <label for="name">estilos: </label>
              <textarea name="name" id="estilos" class="form-control"><?php if(isset($edit->estilos)) echo $edit->estilos?></textarea>
          </div>

</div>
                <div class="form-group">
                  <button onClick="GuardarAlcance()" class="btn btn-primary">Guardar Cambios</button>
                  <?php
                  if(isset($edit->idColumna))
                    echo '<button  onclick="EliminarAlcance()" title="1" class="btn btn-danger">Eliminar definitivamente</button>
			  <button  onclick="DuplicarAlcance()" title="1" class="btn btn-secondary">Duplicar Registro</button>';
                  ?>
    </div>
</div>
                <script>
var iconosList=["gas_stations","industry","post_office","agriculture","post_office_jp","thunderstorm","falling_rocks","terrain","ruler","play","road_shield3","star","wht_pushpin","pharmacy_rx","pause","road_shield2","triangle","info_i","crosscountry_ski","pharmacy_plus","ski_lift","road_shield1","arrow_reverse","shower","coffee","sledding","1_blue","2_blue","3_blue","4_blue","5_blue","6_blue","7_blue","8_blue","9_blue","10_blue","cemetary","museum","schools","a_blue","b_blue","c_blue","d_blue","e_blue","f_blue","g_blue","h_blue","i_blue","j_blue","k_blue","l_blue","m_blue","n_blue","o_blue","p_blue","q_blue","r_blue","s_blue","t_blue","u_blue","v_blue","w_blue","x_blue","y_blue","z_blue","mountains","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","car_ferry","rec_phone","library","rec_parking_lot","blu_stars","grn_stars","ltblu_stars","orange_stars","pink_stars","purple_stars","red_stars","wht_stars","ylw_stars","buildings","landmark","rec_lodging","prayer","blu_square","grn_square","ltblu_square","orange_square","pink_square","purple_square","red_square","wht_square","ylw_square","rec_info_circle","blu_diamond","grn_diamond","ltblu_diamond","orange_diamond","pink_diamond","purple_diamond","red_diamond","wht_diamond","ylw_diamond","heliport","rec_gas_stations","blu_circle","grn_circle","ltblu_circle","orange_circle","pink_circle","purple_circle","red_circle","wht_circle","ylw_circle","binoculars","rec_dining","blu_blank","grn_blank","ltblu_blank","orange_blank","pink_blank","purple_blank","red_blank","wht_blank","ylw_blank","rec_convenience","arena","gondola","rec_bus","large_red","large_yellow","large_green","large_blue","large_purple","airports","golf","church","small_red","small_yellow","small_green","small_blue","small_purple","measle_brown","measle_grey","measle_white","measle_turquoise","arrow","campfire","cycling","flag","bus","firedept","euro","camera","caution","dollar","hospitals","info","info_circle","man","motorcycling","movies","phone","picnic","police","rainy","ski","sunny","swimming","volcano","water","webcam","wheel_chair_accessible","woman"];
iconosList.sort();
var lista=["160","151","152","153","154","155","156","157","158","159","187","161","10","115","113","122","148","188","162","97","221","239","230","221","214","79","18","189","163","32","16","68","150","71","118","53","14","84","190","164","1","191","165","2","192","166","22","38","21","193","167","8","116","110","248","240","231","222","213","194","168","92","40","195","169","6","142","46","142","196","170","197","171","198","172","180","239","240","235","255","256","4","249","241","232","223","214","199","173","67","265","266","268","267","84","24","90","104","200","174","201","175","250","242","233","224","215","202","176","138","40","42","70","98","251","243","234","225","216","145","114","7","7","82","252","244","235","226","217","203","177","204","178","20","111","105","99","93","87","81","76","102","253","245","236","227","218","146","139","132","128","205","179","104","49","51","43","37","268","262","263","260","261","133","72","77","206","180","24","17","44","207","181","208","182","107","209","183", "113","12","19","254","246","237","135","228","219","26","210","184","211","185","256","247","238","229","220","212","186"];
function cambioValor(id,opc){
/*if(opc==1){
var valor=$("#part"+id).find(".limitB").val();
newid=id+1;
if($("#part"+newid)){
$("#part"+newid).find(".limitA").val(valor);
}}
else{
var valor=$("#part"+id).find(".limitA").val();
newid=id-1;
if($("#part"+newid)){
$("#part"+newid).find(".limitB").val(valor);
}}*/
}
function llenarFormulario(){
for(var i=0;i<iconosList.length;i++){
$("#googleMap").append("<img src='"+host+"img/iconos/"+lista[i]+".png' title='"+iconosList[i]+"'>");
}
var estilo=$("#estilos").val();
estilo=estilo.replace("[","");
estilo=estilo.replace("]","");
var estilos=estilo.split("},");
estilos[estilos.length-1]=(estilos[estilos.length-1].replace("} }","}")).replace("}}","}");
for(var x=0;x<estilos.length;x++){

var name=limpiarCadena((estilos[x].substring(estilos[x].indexOf("where:"),estilos[x].indexOf(">"))).replace("where:",""));
if(estilos[x].indexOf(">=")>=0)
var limit1=limpiarCadena((estilos[x].substring(estilos[x].indexOf(">="),estilos[x].indexOf("AND"))).replace(">=",""));
else
var limit1=limpiarCadena((estilos[x].substring(estilos[x].indexOf(">"),estilos[x].indexOf("AND"))).replace(">",""));
var tipo=limpiarCadena((estilos[x].substring(estilos[x].indexOf("',"))));
tipo=(tipo.substring(0, tipo.indexOf(":")));
var limit2=limpiarCadena((estilos[x].substring(estilos[x].indexOf("<="),estilos[x].indexOf(tipo+":"))).replace("<=",""));
if(tipo=="polygonOptions"){
var color=limpiarCadena((estilos[x].substring(estilos[x].indexOf("fillColor:"),estilos[x].indexOf("fillOpacity"))).replace("fillColor:",""));
if(estilos[x].indexOf("valFill")>=0)
$("#part"+(x+1)).find(".siC").prop( "checked", true );
else 
$("#part"+(x+1)).find(".siC").prop( "checked", false );

}
else if(tipo=="polylineOptions")
var color=limpiarCadena((estilos[x].substring(estilos[x].indexOf("strokeColor:"))).replace("}}","").replace("strokeColor:","").replace("}",""));
else if(tipo=="markerOptions")
var icon=limpiarCadena((estilos[x].substring(estilos[x].indexOf("iconName:"))).replace("}}","").replace("iconName:","").replace("}",""));

$("#valorName").val(name);
$("#part"+(x+1)).find(".limitA").val(limit1);
$("#part"+(x+1)).find(".limitB").val(limit2);
if(tipo!="markerOptions")
$("#part"+(x+1)).find(".color").val(color);
else
$("#part"+(x+1)).find(".icon").val(icon);
$("#part"+(x+1)).find(".tipoP").val(tipo);
if(tipo!="markerOptions"){
$("#part"+(x+1)).find(".icon").addClass("hidden");
$("#part"+(x+1)).find(".color").removeClass("hidden");
}
else{
$("#part"+(x+1)).find(".icon").removeClass("hidden");
$("#part"+(x+1)).find(".color").addClass("hidden");
}

if(x<estilos.length-1)addPart();
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
function crearEstilo(){
var estilo="";
var nombre=$("#valorName").val();
var limitA=$("#part1").find(".limitA").val();
var limitB=$("#part1").find(".limitB").val();
var color=$("#part1").find(".color").val();
var tipo=$("#part1").find(".tipoP").val();
var siC=$("#part1").find(".siC").is(':checked');

estilo="[{where:";
estilo+="'"+nombre+">"+limitA+" AND "+nombre+"<="+limitB+"',";
estilo+=tipo+":{";
if(tipo=="polygonOptions"){
estilo+="fillColor:'"+color+"',";
if(siC)
estilo+="fillOpacity:valFill}}";
else
estilo+="fillOpacity:0.01}}";
}
else if(tipo=="polylineOptions"){
estilo+="strokeColor:'"+color+"'}}";
}
else if(tipo=="markerOptions"){
var icon=$("#part1").find(".icon").val();
estilo+="iconName:'"+icon+"'}}";
}

if($(".partes").length>1)
for(x=2;x<=$(".partes").length;x++){

var limitA=$("#part"+x).find(".limitA").val();
var limitB=$("#part"+x).find(".limitB").val();
var color=$("#part"+x).find(".color").val();
var tipo=$("#part"+x).find(".tipoP").val();
var siC=$("#part"+x).find(".siC").is(':checked');
estilo+=",{where:";
estilo+="'"+nombre+">"+limitA+" AND "+nombre+"<="+limitB+"',";
estilo+=tipo+":{";
if(tipo=="polygonOptions"){
estilo+="fillColor:'"+color+"',";
if(siC)
estilo+="fillOpacity:valFill}}";
else
estilo+="fillOpacity:0.01}}";
}
else if(tipo=="polylineOptions"){
if(siC)
estilo+="strokeColor:'"+color+"'}}";
else
estilo+="strokeColor:'"+color+"',strokeWeight:3}}";
}
else if(tipo=="markerOptions"){
var icon=$("#part"+x).find(".icon").val();
estilo+="iconName:'"+icon+"'}}";
}
}
estilo+="]";
$("#estilos").text(estilo);
}
                function addPart(){
                  var x=$(".partes").length;

                  var newx=x+1;
                  var string='';
                  string+='<div id="part'+newx+'" class="partes separador">';
                
                  string+='<div><select type="text" name="name" id=""  class="form-control tipoP" ><option value="polygonOptions" checked>polygonOptions</option><option value="polylineOptions">polylineOptions</option>  <option value="markerOptions">markerOptions</option></select></div>';
                  
                  string+='<div class="form-group panelIzquierdo">';
                string+='<input type="checkbox" class="form-control siC" checked>';
                  string+='<input type="color" name="name" id="" value="#000000" class="form-control color">'
                  string+='<select type="text" name="name" id=""  class="form-control icon hidden"></select>';
                  string+='</div>';
                  string+='<div class="form-group panelDerecho">';
                  string+='<input type="button" name="name" onClick="removePart('+newx+')" value="remove ('+newx+')"/>';
                  string+='</div>';
                  string+='<div class="form-group panelIzquierdo">';
                  string+='<label for="name">limitA'+newx+': </label>';
                  string+='<input type="text" name="name" onBlur="cambioValor('+newx+', 0)"  value="0" class="form-control limitA">';
                  string+='</div>';
                  string+='<div class="form-group panelDerecho">';
                  string+='<label for="name">limitB'+newx+': </label>';
                  string+='<input type="text" name="name" onBlur="cambioValor('+newx+', 1)" value="0" class="form-control limitB">';
                  string+='</div>';
                  string+='</div>';
                  $(string).insertAfter("#part"+x);

$( ".tipoP" ).change(function () {
		console.log($(this).val());
		if($(this).val()!="markerOptions"){
		$(this).parent().parent().find(".icon").addClass("hidden");
		$(this).parent().parent().find(".color").removeClass("hidden");
		}
		else{
		$(this).parent().parent().find(".icon").removeClass("hidden");
		$(this).parent().parent().find(".color").addClass("hidden");
		}
		});
                  
                  
var iconosLista=iconosList;
iconosLista.sort();
for(var a=0;iconosLista.length>a;a++)
$("#part"+newx).find(".icon").append('<option value="'+iconosLista[a]+'">'+iconosLista[a]+'</option>');
                }

                function removePart(id){
		  $(".partes").each(function(){
			var newId=$(this).attr("id").replace("part","");
			if(id<newId){
				$(this).attr("id","part"+(newId-1));
				$(this).find("input[type='button']").attr("onclick","removePart("+(newId-1)+")");
                                $(this).find("input[type='button']").attr("value","remove("+(newId-1)+")");
			}
		  });
                  $("#part"+id).remove();
                }
                  function GuardarAlcance()
    {
crearEstilo();
      var flag=true;
      flag=flag*vacio("columna");
      //if($("#img").val()=="")
       // flag=false;
	if($("#valorFiltro").val()=="")
var valorFiltro="NULL";
	else
	var valorFiltro=$("#valorFiltro").val();
      if(flag)
          swal({   title: "Se guardara la informacion de esta Columna!",
    text: "¿Estas seguro de proceder?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Si, Guarda los datos",
    cancelButtonText: "No",
    closeOnConfirm: false,
    closeOnCancel: false },
    function(isConfirm){
        if (isConfirm)
    {
        swal("Pais Guardada!", "Esta Columna se guardado correctamente", "success");
                var id=$("#id").val();
                        $.ajax({
                        data: {
                          "opcion": 1,
                          "columna":$("#columna").val(),
                          "titulo":$("#titulo").val(),
                          "valorFiltro":valorFiltro,
                          "estilos":$("#estilos").val(),
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/columnasModel.php",

                      })
                      .done(function( respuesta ) {
                          id=respuesta.new;
              $("#Contenidos").load(host+"MoFuSS/columns.php",{id:id});
                        $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"columns"});

                      })
                      .fail(function( jqXHR, textStatus, errorThrown ) {
                        if ( console && console.log ) {
                          console.log( "La solicitud a fallado: " +  textStatus);
                      }
                      });

        return true;
        }
        else {
            swal("No se guardaron los datos", "", "error");
            return false;
            }
            return false;
             });
    }
    function DuplicarAlcance()
    {
          swal({   title: "Esta Columna se Duplicara",
    text: "¿Estas seguro de proceder?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Si, duplica",
    cancelButtonText: "No",
    closeOnConfirm: false,
    closeOnCancel: false },
    function(isConfirm){
        if (isConfirm)
    {
        swal("columns Eliminado", "Esta Columna se duplico", "error");
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
                      })
                      .done(function( respuesta ) {
                          id=respuesta.new;
                            $("#Contenidos").load(host+"MoFuSS/columns.php",{id:id});
                            $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"columns"});
                      })
                      .fail(function( jqXHR, textStatus, errorThrown ) {
                        if ( console && console.log ) {
                          console.log( "La solicitud a fallado: " +  textStatus);
                         }
                      });

        return true;
        }
        else {
            swal("No se guardaron los datos", "", "error");
            return false;
            }
            return false;
             });
    }
    function EliminarAlcance()
    {
          swal({   title: "Esta Colmuna se eliminara",
    text: "¿Estas seguro de proceder?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",

    confirmButtonText: "Si, elimina la Columna",
    cancelButtonText: "No",
    closeOnConfirm: false,
    closeOnCancel: false },
    function(isConfirm){
        if (isConfirm)
    {
        swal("columns Eliminado", "Esta Columna se elimino", "error");
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
                      })
                      .done(function( respuesta ) {
                            $("#Contenidos").load(host+"MoFuSS/columns.php");
                            $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"columns"});
                      })
                      .fail(function( jqXHR, textStatus, errorThrown ) {
                        if ( console && console.log ) {
                          console.log( "La solicitud a fallado: " +  textStatus);
                      }
                      });
        return true;
        }
        else {
            swal("Ok", "Esta Capa no se elimino", "success");
            return false;
            }
            return false;
             });
    }

$(document).ready(function(){
var pinIcon=iconosList;
for(var a=0;pinIcon.length>a;a++){
$("#part1").find(".icon").append("<option value='"+pinIcon[a]+"'>"+pinIcon[a]+" </option>");
}
llenarFormulario();
});
$( ".tipoP" ).change(function () {
console.log($(this).val()); 
if($(this).val()!="markerOptions"){
$(this).parent().parent().find(".icon").addClass("hidden");
$(this).parent().parent().find(".color").removeClass("hidden");
}
else{
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

$(".icon").on("click",function(){
$(this).blur();  
var id=$(this).parent().parent().attr("id");
$("#googleMap").attr("title",id);
$("#googleMap").attr("style","display:block !important;");
});

                </script>
<style>
.panelDerecho > input[type="button"] {
    height: 34px;
}
</style>
<div id="googleMap" style="width:100%;height:400px;"></div>


