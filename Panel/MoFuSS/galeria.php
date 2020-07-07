<script src="assets/js/host.js"></script>
  <style>
  .eliminarImg {
    width: 80px;
    height: 80px;
    margin: 10px;
    float: left;
    border-radius: 40px;
}
.galeriaImg {
    float: left;
    width: 80px;
    height: 80px;
    border-radius: 40px;
    margin: 10px;
    margin-left: -90px;
}
.galeriaImg:hover {
    opacity: 0.5;
    cursor: pointer;
}
#galeriaprev:hover{
  opacity: 0.8;
  cursor: pointer;
  transition:all ease 2s;
}

#galeriaprev {
    width: 80px;
    height: 80px;
    margin: 10px;
    border-radius: 40px;
    border: solid #52accc;
    transition:all ease 2s;
}
  </style>

  <p class="titleGaleria">Imagenes Disponibles</p>
<div class="separador">
  <?php
 include '../base.php';
 include "../host2.php";
	$obj=new Base($DB_server,$DB_user,$DB_name);
	 $result = $obj->consulta("SELECT * FROM galeria");
     $numfilas = $result->num_rows;
     for ($x=0;$x<$numfilas;$x++) {
        $fila = $result->fetch_object();
                echo '
                <img class="eliminarImg" src="img/delete.png"/>
                <img class="galeriaImg" src="uploads/galeria/'.$fila->nombre.'?'.rand(0,1000).'" onClick="Galeria(this, 0)" title="'.$fila->nombre.'"/>
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
                
                        <button class="form-control btn btn-primary" style="display:none" onClick="newGaleria()" id="guardarImagen">Guardar Imagen</button>
  </div>
  <script>
$('.galeriaImg').mousedown(function(event) {
    switch (event.which) {
        case 3:
            var res=confirm("Deseas Cambiar la Imagen?");
            if(res)cambiarImagen(1,$(this).attr("title"));
            break;

    }
});
$("#imgGaleriaCambiar").change(function(){
cambiarImagen(2,"");
});

function cambiarImagen(fase, id){
if(fase==1){
$("#imgajaxGaleriaCambiar").attr("title", id);
$("#imgGaleriaCambiar").trigger("click");
}
else if(fase==2){
                var formData = new FormData(document.getElementById("imgajaxGaleriaCambiar"));
            formData.append("id", $("#imgajaxGaleriaCambiar").attr("title"));
            formData.append("opcion", 3);
            $.ajax({
                url: "MoFuSS/galeriaModel.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
       processData: false
            })
                .done(function(res){
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
    $("#Lista").load(host+"MoFuSS/colores.php");
  });
  $("#galeriaprev").on("click", function(){
$("#imgGaleria").trigger("click");
  });
    function validacionGaleria(img){
    var res=true;
    if($("#galeriaprev").attr("src")=="assets/img/avatar.png")
      if(img=="")res= false;
    return res;
  }
  function newGaleria(){
    var img=$("#imgGaleria").val();
    var opcion;
    var flag=validacionGaleria(img);
    if(flag)
                   $.ajax({
                data: {
                  "opcion": 1,
                  "curso" : $("#id").val()
                },
                type: "POST",
                dataType: "json",
                url: "MoFuSS/galeriaModel.php",
              })
              .done(function( respuesta ) {
                var formData = new FormData(document.getElementById("imgajaxGaleria"));
            formData.append("id", respuesta.new);
            formData.append("opcion", 2);
            $.ajax({
                url: "MoFuSS/galeriaModel.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
       processData: false
            })
                .done(function(res){
                                $("#Contenidos").load("MoFuSS/galeria.php",{course:$("#name").val()});
                                $("#Lista").load(host+"MoFuSS/colores.php");
              
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
                url: "MoFuSS/galeriaModel.php",
              })
              .done(function( respuesta ) {
                $("#Contenidos").load("MoFuSS/galeria.php",{course:$("#name").val()});
                $("#Lista").load(host+"MoFuSS/colores.php");
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
