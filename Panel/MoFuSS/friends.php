 
 <?php

if(isset($_POST['id'])){
 include '../base.php';
 include "../host2.php";
 $obj=new Base($DB_server,$DB_user,$DB_name);
   $result = $obj->consulta("SELECT * FROM amigos where id=".$_POST['id']);

  $numfilas = $result->num_rows;
  $fila = $result->fetch_object();
  $edit=$fila;
   }




echo '<div><div class="form-group">';
 if(isset($edit->titulo)) echo '<h4>"'.$edit->titulo.'" edit:</h4>'; else echo '<h4>Nuevo</h4>';
   ?>
 </div>
                    <input type="text" name="id" id="id" value="<?php if(isset($edit->id)) echo $edit->id?>" class="form-control hidden">

                                <div class="separador">
                    <div class="panelIzquierdo">

        <div class="form-group">
              <label for="name">Título del friends:(required) </label>
              <input type="text" name="name" id="titulo" value="<?php if(isset($edit->titulo)) echo $edit->titulo?>" class="form-control">
          </div>

           
        
          <div class="form-group">
              <label for="location">url:(required)</label>
              <input type="text" name="location" id="url" value="<?php if(isset($edit->url)) echo $edit->url?>" class="form-control"/>
          </div>

                    
                  <div class="fileUpload btn form-control">
                    <span>Imagen</span>
<form enctype="multipart/form-data" id="imgajax"><input type="file" class="upload" name="img" id="img" />
                  </form>
                  </div>
                </div>
                <div class="panelDerecho">
                    <?php 
                    if(isset($edit->img)){
                    if($edit->img!="") 
                        echo '<img id="blah" src="uploads/amigos/'.$edit->img.'" alt="your image" />' ; 
                    else 
                        echo '<img id="blah" src="assets/img/unam.png" alt="your image" />';
                        }
                        else 
                        echo '<img id="blah" src="assets/img/unam.png" alt="your" />';
                    ?>
                        
                </div>

                </div>
                                <div class="form-group">
                  <button onClick="GuardarAlcance()" class="btn btn-primary">Guardar Cambios</button>
                  <?php 
                  if(isset($edit->id))
                    echo '<button  onclick="EliminarAlcance()" title="1" class="btn btn-danger">Eliminar definitivamente
                  </button>';
                  ?>
    </div>
</div>
                <script>
                  function GuardarAlcance()
    {
      var flag=true;
      flag=flag*vacio("titulo");
      flag=flag*vacio("url");
          //  if($("#img").val()=="")
        //flag=false;
      if(flag)
          swal({   title: "Se guardara la informacion de este Amigo!",   
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
        swal("Amigo Guardado!", "Este amigo se guardado correctamente", "success");
                var id=$("#id").val();
                        $.ajax({
                        data: {
                          "opcion": 1,
                          "titulo":$("#titulo").val(),
                          "url":$("#url").val(),
                          "img":$("#img").val(),
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/amigosModel.php",
                      })
                      .done(function( respuesta ) {
                        if(id=="")
                          id=respuesta.new;
                          
                                                                var formData = new FormData(document.getElementById("imgajax"));
            formData.append("id", id);
            formData.append("opcion", 2);
            $.ajax({
                url: "MoFuSS/amigosModel.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
       processData: false
            })
                .done(function(res){
              $("#Contenidos").load(host+"MoFuSS/friends.php",{id:id});
                        $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"friends"});
              
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
          swal({   title: "Este amigo se eliminara",   
    text: "¿Estas seguro de proceder?",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Si, elimina el amigo",   
    cancelButtonText: "No",   
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    function(isConfirm){   
        if (isConfirm) 
    {   
        swal("friends Eliminado", "Este amigo se elimino", "error");   
        var id=$("#id").val();
                        $.ajax({
                        data: {
                          "opcion": 0,
                          "titulo":$("#titulo").val(),
                          "url":$("#url").val(),
                          "img":$("#img").val(),
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/amigosModel.php",
                      })
                      .done(function( respuesta ) {
                            $("#Contenidos").load(host+"MoFuSS/friends.php");
                            $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"friends"});
                      })
                      .fail(function( jqXHR, textStatus, errorThrown ) {
                        if ( console && console.log ) {
                          console.log( "La solicitud a fallado: " +  textStatus);
                      }
                      });
        return true;
        } 
        else {     
            swal("Ok", "Este evento no se elimino", "success");   
            return false;
            }
            return false;
             });
    }
                  function readAmigo(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$("#img").change(function(){
    readAmigo(this, "blah");
});

                </script>
