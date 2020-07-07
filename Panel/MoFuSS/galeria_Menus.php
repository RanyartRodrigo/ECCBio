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
 include "../host2.php";
 	$obj=new Base($DB_server,$DB_user,$DB_name);
    $result = $obj->consulta("SELECT * FROM galeria_menus where idMenu=".$_POST['id']." order by nombre");
    $numfilas = $result->num_rows;
     for ($x=0;$x<$numfilas;$x++) {
        $fila = $result->fetch_object();
                echo '
                <img class="eliminarImg" src="img/delete.png"/>
                <img class="galeriaImg" src="uploads/menus/'.$fila->nombre.'" onClick="Galeria(this, 0)" title="'.$fila->nombre.'"/>
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
$("#imgGaleriaCambiar").change(function(){
cambiarImagen(2,"","");
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
                url: "MoFuSS/galeriaMenusModel.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
       processData: false
            })
                .done(function(res){
                         //$("#Contenidos").load("MoFuSS/layers.php",{id:$("#id").val()});
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
                  "menu" : $("#id").val()
                },
                type: "POST",
                dataType: "json",
                url: "MoFuSS/galeriaMenusModel.php",
              })
              .done(function( respuesta ) {
                if(opc==1)var formData = new FormData(document.getElementById("imgajaxGaleria"));
            formData.append("id", respuesta.new);
            formData.append("opcion", 2);
            $.ajax({
                url: "MoFuSS/galeriaMenusModel.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
       processData: false
            })
                .done(function(res){
                                $("#Contenidos").load("MoFuSS/layers.php",{id:$("#id").val()});
                                
              
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
                url: "MoFuSS/galeriaMenusModel.php",
              })
              .done(function( respuesta ) {
                $("#Contenidos").load("MoFuSS/layers.php",{id:$("#id").val()});
                
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

  </script>
