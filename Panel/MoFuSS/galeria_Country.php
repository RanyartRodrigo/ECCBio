<script src="assets/js/host.js"></script>
  <style>
  .eliminarImg {
    width: 80px;
    height: 80px;
    margin: 10px;
    float: left;
    border-radius: 40px;
}
.galeriaImg, .galeriaImg1, .galeriaImg2 {
    float: left;
    width: 80px;
    height: 80px;
    border-radius: 40px;
    margin: 10px;
    margin-left: -90px;
    background: white;
}
.galeriaImg:hover, .galeriaImg1:hover , .galeriaImg2:hover {
    opacity: 0.5;
    cursor: pointer;
}
#galeriaprev:hover, #galeriaprev1:hover, #galeriaprev2:hover{
  opacity: 0.8;
  cursor: pointer;
  transition:all ease 2s;
}

#galeriaprev, #galeriaprev1, #galeriaprev2 {
    width: 80px;
    height: 80px;
    margin: 10px;
    border-radius: 40px;
    border: solid #52accc;
    transition:all ease 2s;
}
  </style>

<div class="separador">
<p class="titleGaleria">Logos Disponibles</p>
  <?php
 include '../base.php';
                            $obj=new Base("localhost","root","conabio");

                             $result = $obj->consulta("SELECT * FROM galeria_paises where idPais=".$_POST['id']." and tipo=1 order by nombre");
    $numfilas = $result->num_rows;
     for ($x=0;$x<$numfilas;$x++) {
        $fila = $result->fetch_object();
                echo '
                <img class="eliminarImg" src="img/delete.png"/>
                <img class="galeriaImg" src="uploads/galeria_Paises/'.$fila->nombre.'?'.rand(1,1000).'" onClick="Galeria(this, 0)" title="'.$fila->nombre.'"/>
                ';               
     }
  ?>
                  <img id="galeriaprev" src="img/more.png" alt="your image" />
                
                <div class="fileUpload btn form-control" style="display:none">
                    <span>Foto</span>
                    <form enctype="multipart/form-data" id="imgajaxGaleria" ><input type="file"  name="imgGaleria" id="imgGaleria" />
                  </form>
                </div>
<form enctype="multipart/form-data" id="imgajaxGaleriaCambiar" style="display:none" title="" ><input type="file"  name="imgGaleria" id="imgGaleriaCambiar" /></form>

                
                        <button class="form-control btn btn-primary" style="display:none" onClick="newGaleria(1)" id="guardarImagen">Guardar Imagen</button>
  </div>
<div class="separador">
<p class="titleGaleria">Logos Secundarios Disponibles</p>
  <?php

                             $result1 = $obj->consulta("SELECT * FROM galeria_paises where idPais=".$_POST['id']." and tipo=2 order by nombre");
    $numfilas1 = $result1->num_rows;
     for ($x=0;$x<$numfilas1;$x++) {
        $fila = $result1->fetch_object();
                echo '
                <img class="eliminarImg" src="img/delete.png"/>
                <img class="galeriaImg1" src="uploads/galeria_Paises/'.$fila->nombre.'" onClick="Galeria(this, 0)" title="'.$fila->nombre.'"/>
                ';
     }
  ?>
                  <img id="galeriaprev1" src="img/more.png" alt="your image" />

                <div class="fileUpload btn form-control" style="display:none">
                    <span>Foto</span>
                    <form enctype="multipart/form-data" id="imgajaxGaleria1" ><input type="file"  name="imgGaleria" id="imgGaleria1" />
                  </form>
                </div>
<form enctype="multipart/form-data" id="imgajaxGaleriaCambiar1" style="display:none" title="" ><input type="file"  name="imgGaleria" id="imgGaleriaCambiar1" /></form>

                        <button class="form-control btn btn-primary" style="display:none" onClick="newGaleria(5)" id="guardarImagen1">Guardar Imagen</button>
  </div>

<div class="separador">
<p class="titleGaleria">Imagenes Disponibles </p>
  <?php
                             $result2 = $obj->consulta("SELECT * FROM galeria_paises where idPais=".$_POST['id']." and tipo=0");
     $numfilas2 = $result2->num_rows;
     for ($x=0;$x<$numfilas2;$x++) {
        $fila = $result2->fetch_object();
                echo '
                <img class="eliminarImg" src="img/delete.png"/>
                <img class="galeriaImg2" src="uploads/galeria_Paises/'.$fila->nombre.'" onClick="Galeria(this, 0)" title="'.$fila->nombre.'"/>
                ';
     }
  ?>
                  <img id="galeriaprev2" src="img/more.png" alt="your image" />

                <div class="fileUpload btn form-control" style="display:none">
                    <span>Foto</span>
                    <form enctype="multipart/form-data" id="imgajaxGaleria2" ><input type="file"  name="imgGaleria" id="imgGaleria2" />
                  </form>
                </div>
<form enctype="multipart/form-data" id="imgajaxGaleriaCambiar2" style="display:none" title="" ><input type="file"  name="imgGaleria" id="imgGaleriaCambiar2" /></form>

                        <button class="form-control btn btn-primary" style="display:none" onClick="newGaleria(4)" id="guardarImagen2">Guardar Imagen</button>
  </div>

  <script>
$(document).bind("contextmenu",function(e){
                return false;
            });
$('.galeriaImg').mousedown(function(event) {
    switch (event.which) {
        case 3:
            
            cambiarImagen(1,$(this).attr("title"),"");
            break;

    }
});
$('.galeriaImg1').mousedown(function(event) {
    switch (event.which) {
        case 3:
	  
            
            cambiarImagen(1,$(this).attr("title"),"1");
            break;

    }
});
$('.galeriaImg2').mousedown(function(event) {
    switch (event.which) {
        case 3:
            
            cambiarImagen(1,$(this).attr("title"),"2");
            break;

    }
});
$("#imgGaleriaCambiar").change(function(){
cambiarImagen(2,"","");
});
$("#imgGaleriaCambiar1").change(function(){
cambiarImagen(2,"","1");
});
$("#imgGaleriaCambiar2").change(function(){
cambiarImagen(2,"","2");
});

function cambiarImagen(fase, id,tipo){
if(fase==1){
$("#imgajaxGaleriaCambiar"+tipo).attr("title", id);
$("#imgGaleriaCambiar"+tipo).trigger("click");
}
else if(fase==2){
                var formData = new FormData(document.getElementById("imgajaxGaleriaCambiar"+tipo));
            formData.append("id", $("#imgajaxGaleriaCambiar"+tipo).attr("title"));
            formData.append("opcion", 6);
            $.ajax({
                url: "MoFuSS/galeriaCountryModel.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
       processData: false
            })
                .done(function(res){
                         //$("#Contenidos").load("MoFuSS/country.php",{id:$("#id").val()});
                         location.reload();
              })
              .fail(function( jqXHR, textStatus, errorThrown ) {
                if ( console && console.log ) {
                console.log( "La solicitud a fallado: " +  textStatus);
              }
              });
}
}
  $(document).ready(function(){
    
  });
  $("#galeriaprev").on("click", function(){
$("#imgGaleria").trigger("click");
  });
  $("#galeriaprev1").on("click", function(){
$("#imgGaleria1").trigger("click");
  });

  $("#galeriaprev2").on("click", function(){
$("#imgGaleria2").trigger("click");
  });

    function validacionGaleria(img){
    var res=true;
    /*if($("#galeriaprev").attr("src")=="assets/img/avatar.png")
      if(img=="")res= false;
*/    return res;
  }
  function newGaleria(opc){
    var img=$("#imgGaleria").val();
    var opcion;
    var flag=validacionGaleria(img);
    if(flag)
                   $.ajax({
                data: {
                  "opcion": opc,
                  "idPais" : $("#id").val()
                },
                type: "POST",
                dataType: "json",
                url: "MoFuSS/galeriaCountryModel.php",
              })
              .done(function( respuesta ) {
                if(opc==1)var formData = new FormData(document.getElementById("imgajaxGaleria"));
                else if(opc==5)var formData = new FormData(document.getElementById("imgajaxGaleria1"));
    else var formData = new FormData(document.getElementById("imgajaxGaleria2"));
            formData.append("id", respuesta.new);
            formData.append("opcion", 2);
            $.ajax({
                url: "MoFuSS/galeriaCountryModel.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
       processData: false
            })
                .done(function(res){
                                $("#Contenidos").load("MoFuSS/country.php",{id:$("#id").val()});
                                
              
              })
              .fail(function( jqXHR, textStatus, errorThrown ) {
                if ( console && console.log ) {
                console.log( "La solicitud a fallado: " +  textStatus);
              }
              }); 
            

  });
  }
    function Galeria(id, opcion){
      Confirmacion("Galeria",eliminarGaleria,id,opcion);

  }
  function eliminarGaleria(id, opcion){
                       $.ajax({
                data: {
                  "opcion": opcion,
                  "id" :  id.title
                },
                type: "POST",
                dataType: "json",
                url: "MoFuSS/galeriaCountryModel.php",
              })
              .done(function( respuesta ) {
                $("#Contenidos").load("MoFuSS/country.php",{id:$("#id").val()});
                
              })
              .fail(function( jqXHR, textStatus, errorThrown ) {
                if ( console && console.log ) {
                console.log( "La solicitud a fallado: " +  textStatus);
              }
              }); 
      }
                      function readGaleria(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$("#imgGaleria").change(function(){
    readInstructor(this, "galeriaprev");
    $("#guardarImagen").trigger("click");
});
$("#imgGaleria1").change(function(){
    readInstructor(this, "galeriaprev1");
    $("#guardarImagen1").trigger("click");
});
$("#imgGaleria2").change(function(){
    readInstructor(this, "galeriaprev2");
    $("#guardarImagen2").trigger("click");
});

  </script>
