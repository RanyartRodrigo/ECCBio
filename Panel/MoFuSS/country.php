<?php

	if(isset($_POST['id'])){
 		include '../base.php';
		include "../host2.php";
		$obj=new Base($DB_server,$DB_user,$DB_name);       
                             $result = $obj->consulta( "SELECT * FROM paises where id_Pais=".$_POST['id']);

  $numfilas = $result->num_rows;
  $fila = $result->fetch_object();
  $edit=$fila;
   }




echo '<div><div class="form-group">';
 if(isset($edit->nombre)) echo '<h4>"'.$edit->nombre.'" edit:</h4>'; else echo '<h4>Nuevo</h4>';
   ?>
 </div>
                    <input type="text" name="id" id="id" value="<?php if(isset($edit->id_Pais)) echo $edit->id_Pais?>" class="form-control hidden">
                                                               <div class="separador">

                 <div class="separador">
                <div class="panelDerecho">
                    <?php 
                    if(isset($edit->bandera)){
                    if($edit->bandera!="") 
                        echo '<img  id="bandera" src="uploads/paises/'.$edit->bandera.'" alt="your image" />' ; 
                    else 
                        echo '<img  id="bandera" src="assets/img/unam.png" alt="your image" />';
                        }
                        else 
                        echo '<img  id="bandera" src="assets/img/unam.png" alt="your" />';
                    ?>
                        
                </div>
                  <div class="fileUpload btn form-control hidden">
                    <span>Imagen</span>(required)
<form enctype="multipart/form-data" id="imgajaxBandera"><input type="file" class="upload" name="imgBandera" id="imgBandera" />
                  </form>
                  </div>
		</div>

                       <div class="form-group">
              <label for="name">Nombre: </label>
              <input type="text" name="name" id="nombre" value="<?php if(isset($edit->nombre)) echo $edit->nombre?>" class="form-control">
          </div>
                <div class="form-group">
              <label for="name">Url: </label>
              <input type="text" name="name" id="nombreURL" value="<?php if(isset($edit->nombreURL)) echo $edit->nombreURL?>" class="form-control">
          </div>
                  <div class="form-group">
              <label for="name">Latitud: </label>
              <input type="number" name="name" id="latitud" value="<?php if(isset($edit->latitud)) echo $edit->latitud?>" class="form-control">
          </div>
                  <div class="form-group">
              <label for="name">Longitud: </label>
              <input type="number" name="name" id="longitud" value="<?php if(isset($edit->longitud)) echo $edit->longitud?>" class="form-control">
          </div>
                          <div class="form-group">
              <label for="name">Zoom: </label>
              <input type="number" name="name" id="zoom" value="<?php if(isset($edit->zoom)) echo $edit->zoom?>" class="form-control">
          </div>
                  <div class="form-group">
              <label for="name">Max Zoom: </label>
              <input type="number" name="name" id="maxZoom" value="<?php if(isset($edit->maxZoom)) echo $edit->maxZoom?>" class="form-control">
          </div>
                  <div class="form-group">
              <label for="name">Uso de Suelo: </label>
              <input type="text" name="name" id="usoSuelo" value="<?php if(isset($edit->usoSuelo)) echo $edit->usoSuelo?>" class="form-control">
          </div>

           <div class="form-group">
              <input type="button" onClick="addInfo()" value="Agregar Información" class="form-control">
          </div>

<div s id="0" class="completo obscuro" onmouseover="imagen(this)" onmouseout="imagen(this)" >
 <div class="form-group">
              
              <input type="text" hidden="TITULO" name="name" id="titulo0" value="" class="form-control textos">
          </div>
 <div class="form-group">
              <input type="button" name="name" id="estiloB0" value="Estilo" onClick="elegirEstilo(0,0,this)" class="form-control buttonEstilo">
	      <div id="elegirEstilo0" class="eleccionEstilo hidden">
			<div class="completo obscuro" onClick="elegirEstilo(0,1,this)"><p>completo obscuro</p></div>
                        <div class="completo semiobscuro" onClick="elegirEstilo(0,1,this)"><p>completo semiobscuro</p></div>
                        <div class="completo claro" onClick="elegirEstilo(0,1,this)"><p>completo claro</p></div>
                        <div class="medio obscuro"  onClick="elegirEstilo(0,1, this)"><p>medio obscuro</p></div>
                        <div class="medio semiobscuro" onClick="elegirEstilo(0,1,this)"><p>medio semiobscuro</p></div>
                        <div class="medio claro" onClick="elegirEstilo(0,1,this)"><p>medio <br>claro</p></div>
                        <div class="cuarto obscuro" onClick="elegirEstilo(0,1,this)"><p>cuarto obscuro</p></div>
                        <div class="cuarto semiobscuro" onClick="elegirEstilo(0,1,this)"><p>cuarto semiobscuro</p></div>
                        <div class="cuarto claro" onClick="elegirEstilo(0,1,this)"><p>cuarto claro</p></div>
                        <div class="tercio obscuro" onClick="elegirEstilo(0,1,this)"><p>tercio<br> obscuro</p></div>
                        <div class="tercio semiobscuro" onClick="elegirEstilo(0,1,this)"><p>tercio semiobscuro</p></div>
                        <div class="tercio claro" onClick="elegirEstilo(0,1,this)"><p>tercio <br>claro</p></div>
<button>X</button>
	      </div>
	      <input type="text" name="name" id="estilo0" value="completo obscuro" class="form-control hidden">
          </div>
 
 <div class="form-group">
              <input type="button" name="name" id="imagenB0" value="Imagen" onClick="elegirImagen(0,0,this)" class="form-control buttonImage">
              <div id="elegirImagen0" class="eleccionImagen hidden">
  <?php
if(isset($_POST['id'])){
                             $result2 = $obj->consulta("SELECT * FROM galeria_paises where idPais=".$_POST['id']." and tipo=0");
     $numfilas2 = $result2->num_rows;
     for ($x=0;$x<$numfilas2;$x++) {
        $fila = $result2->fetch_object();
                echo '
                <img class="eliminarImg" src="img/add.png"/>
                <img class="galeriaImg2" src="uploads/galeria_Paises/'.$fila->nombre.'" onClick="elegirImagen(0,1,this)" title="'.$fila->nombre.'"/>
                ';
  }
}
 ?>



               <button>X</button>
              </div>
              <input type="text" name="name" id="imagen0" value="" class="form-control hidden">
          </div>
 <div class="form-group">

              <textarea name="name" hidden="INFORMACIÓN" id="informacion0"  class="form-control"></textarea>
          </div>

</div>
           <div class="form-group">
              <input type="button" onClick="eliminarInfo()" value="Eliminar Información" class="form-control">
          </div>

                <div class="form-group hidden">
                    <label for="venue">informacion:</label>
                      <?php 
                        if(isset($edit->informacion)) 
                          echo '<textarea id="informacion" class="form-control">'.$edit->informacion.'</textarea>';
                        else
                          echo '<textarea id="informacion" class="form-control"></textarea>';
                      ?>
                </div>
                <div class="form-group" id="Relaciones"></div>


                </div>
      
                        
                <div class="form-group">
                  <button onClick="GuardarAlcance()" class="btn btn-primary">Guardar Cambios</button>
                  <?php 
                  if(isset($edit->id_Pais))
                    echo '<button  onclick="EliminarAlcance()" title="1" class="btn btn-danger">Eliminar definitivamente
                  </button>';
                  ?>
    </div>   
</div>
                <script>
                  function GuardarAlcance()
    {
      var flag=true;
      flag=flag*vacio("nombre");
      flag=flag*vacio("nombreURL");
      flag=flag*vacio("latitud");
      flag=flag*vacio("longitud");
   
            flag=flag*vacio("zoom");
      flag=flag*vacio("maxZoom");
      //if($("#img").val()=="")
       // flag=false;
      if(flag)
          swal({   title: "Se guardara la informacion de este Pais!",   
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
        swal("Pais Guardada!", "Este Pais se guardado correctamente", "success");
                var id=$("#id").val();
formarInfo();
                        $.ajax({
                        data: {
                          "opcion": 1,
                          "nombre":$("#nombre").val(),
                          "nombreURL":$("#nombreURL").val(),
                          "latitud":$("#latitud").val(),
                          "longitud":$("#longitud").val(),
                          "informacion":$("#informacion").val(),
                          "zoom":$("#zoom").val(),
                          "maxZoom":$("#maxZoom").val(),
                          "usoSuelo":$("#usoSuelo").val(),
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/paisesModel.php",
                      })
                      .done(function( respuesta ) {



                          id=respuesta.new;
                          
                                                                var formData = new FormData(document.getElementById("imgajaxBandera"));
             formData.append("id", id);
            formData.append("opcion", 2);
            $.ajax({
                url: "MoFuSS/paisesModel.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
       processData: false
            })
                .done(function(res){
		   
              $("#Contenidos").load(host+"MoFuSS/country.php",{id:id});
                        $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"country"});

              })
              .fail(function( jqXHR, textStatus, errorThrown ) {
                if ( console && console.log ) {
                console.log( "La solicitud a fallado: " +  textStatus);
              }
              });

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
          swal({   title: "Este pais se eliminara",   
    text: "¿Estas seguro de proceder?",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Si, elimina el pais",   
    cancelButtonText: "No",   
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    function(isConfirm){   
        if (isConfirm) 
    {   
        swal("country Eliminado", "Este pais se elimino", "error");   
        var id=$("#id").val();
                        $.ajax({
                        data: {
                          "opcion": 0,
                          "nombre":$("#nombre").val(),
                          "url":$("#url").val(),
                          "informacion":$("#informacion").text(),
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/paisesModel.php",
                      })
                      .done(function( respuesta ) {
                            $("#Contenidos").load(host+"MoFuSS/country.php");
                            $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"country"});
                      })
                      .fail(function( jqXHR, textStatus, errorThrown ) {
                        if ( console && console.log ) {
                          console.log( "La solicitud a fallado: " +  textStatus);
                      }
                      });
        return true;
        } 
        else {     
            swal("Ok", "Este pais no se elimino", "success");   
            return false;
            }
            return false;
             });
    }
  
                    function readcountry(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$("#img").change(function(){
    readcountry(this, "blah");
});
$("#imgBandera").change(function(){
    readcountry(this, "bandera");
});
$("#bandera").click(function(){
    $("#imgBandera").trigger("click");
});

function elegirEstilo(id, op, este){
if(!op){
$(".eleccionEstilo").removeClass("hidden");
$(".eleccionEstilo").attr("id","elegirEstilo"+id);
}
else{
$(".eleccionEstilo").addClass("hidden");

id=$(".eleccionEstilo").attr("id");
id=id.replace("elegirEstilo","");
$("#"+id).prop("class",$(este).prop("class"));
$("#estilo"+id).val($(este).prop("class"));
}
}
function elegirImagen(id, op, este){
if(!op){
$(".eleccionImagen").removeClass("hidden");
$(".eleccionImagen").attr("id","elegirImagen"+id);
}
else{
$(".eleccionImagen").addClass("hidden");
id=$(".eleccionImagen").attr("id");
id=id.replace("elegirImagen","");
//$(""+id).prop("class",$(este).prop("title"));
$("#imagen"+id).val($(este).prop("title"));
$("#imagen"+id).val(host+'uploads/galeria_Paises/'+$(este).attr("title"));
$("#"+id).find(".buttonImage").attr("title",host+'uploads/galeria_Paises/'+$(este).attr("title"));
}

}
function addInfo(){
var y=$(".textos").length;
var x=y-1;
$("#"+x).after(
'<div s id="'+y+'" class="completo obscuro" onmouseover="imagen(this)"  onmouseout="imagen(this)">'+
 '<div class="form-group">'+
              '<input type="text" name="name" id="titulo'+y+'" value="" class="form-control textos">'+
          '</div>'+
 '<div class="form-group">'+
              '<input type="button" name="name" id="estiloB'+y+'" value="Estilo" onclick="elegirEstilo('+y+',0,this)" class="form-control buttonEstilo">'+
	      
	      '<input type="text" name="name" id="estilo'+y+'" value="completo obscuro" class="form-control hidden">'+
          '</div>'+
 '<div class="form-group">'+
              '<input type="button" name="name" id="imagenB0" value="Imagen" onClick="elegirImagen('+y+',0,this)" class="form-control buttonImage">'+
              '<input type="text" name="name" id="imagen'+y+'" value="" class="form-control hidden">'+
          '</div>'+
 '<div class="form-group">'+
              '<textarea name="name" id="informacion'+y+'" class="form-control"></textarea>'+
          '</div>'+

'</div>');
}
function eliminarInfo(){
var y=$(".textos").length;
var x=y-1;
if(x>0)
$("#"+x).remove();
}
function formarInfo(){
var y=$(".textos").length;
var text="";
for(var x=0;x<y;x++){
if($("#imagen"+x).val()=="")
var img=$("#bandera").attr("src");
else
var img=$("#imagen"+x).val();
text+='<div s class="'+$("#estilo"+x).val()+'"><img src="'+img+'"/><div><h3>'+$("#titulo"+x).val().toUpperCase()+'</h3><p>'+$("#informacion"+x).val()+'</p></div></div>';

}
$("#informacion").val(text);
}


$(window).ready(function(){
setTimeout(function(){
var info=$("#informacion").val();
var infos=info.split("<div s");
var clase="";
var titulo="";
var informacion="";
var imagen="";
var cc="";
for(var x=1;infos.length>x;x++){
cc='<div'+infos[x];
clase1=cc.split('class="');
clase2=clase1[1].split('">');
clase=clase2[0];
var titulo1=cc.split('<h3>');
var titulo2=titulo1[1].split('</h3>');
titulo=titulo2[0];
var informacion1=cc.split('<p>');
var informacion2=informacion1[1].split('</p>');
informacion=informacion2[0];
var imagen1=cc.split('<img src="');
var imagen2=imagen1[1].split('"/>');
imagen=imagen2[0];

$("#estilo"+(x-1)).val(clase);
$("#titulo"+(x-1)).val(titulo);
$("#informacion"+(x-1)).val(informacion);
$("#imagen"+(x-1)).val(imagen);
$("#"+(x-1)).find(".buttonImage").attr("title",imagen);
$("#"+(x-1)).prop("class",clase);
if((infos.length-1)>x)addInfo();
}
},100);

});
function imagen(este){
if($("#imagenVista").length==1){
$("#imagenVista").remove();
}
else{
var img= $(este).find(".buttonImage").attr("title");
$("#Contenidos").after("<div id='imagenVista'><img src='"+img+"'></div>");

}
}
$(".eleccionEstilo>button").on("click",function(){
$(".eleccionEstilo").addClass("hidden");
});
$(".eleccionImagen>button").on("click",function(){
$(".eleccionImagen").addClass("hidden");
});


//$("#Relaciones").load("MoFuSS/relaciones.php",{pais:$("#id").val()});
             
function autosize(este){
  var el = este;
  setTimeout(function(){
    el.style.cssText = 'height:auto; padding:0';
    // for box-sizing other than "content-box" use:
    // el.style.cssText = '-moz-box-sizing:content-box';
    el.style.cssText = 'height:' + el.scrollHeight + 'px';
  },0);
}
$("textarea").each(function(){
autosize(this);
});
                </script>
