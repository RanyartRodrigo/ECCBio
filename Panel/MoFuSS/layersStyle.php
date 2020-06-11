
                                 <?php

if(isset($_POST['id'])){
 include '../base.php';
                            $obj=new Base("localhost","root","conabio3");
                             $result = $obj->consulta( "SELECT * FROM submenusEstilo where nombre='".$_POST['id']."'");
  $numfilas = $result->num_rows;
	if($numfilas==1){
  $fila = $result->fetch_object();
  $color=$fila->color;
  $nombre=$fila->nombre;
}
else 
$nombre=$_POST['id'];
   }




echo '<div><div class="form-group">';
 if(isset($nombre)) echo '<h4>"'.$nombre.'" edit:</h4>'; else echo '<h4>Nuevo</h4>';
   ?>
 </div>
                    <input type="text" name="id" id="id" value="<?php if(isset($nombre)) echo $nombre?>" class="form-control hidden">
                                                               <div class="separador">
<div class='panelIzquierdo'>
                       <div class="form-group">
              <label for="name">Titulo: </label>
              <input type="text" name="name" id="titulo" value="<?php if(isset($nombre)) echo $nombre?>" class="form-control" disabled="disabled">
          </div>
</div>
<div class='panelDerecho'>
          <div id="part1" class="partes separador">
           <div class="form-group">
                <input type="color" name="name" id="color" value="<?php echo $color?>" class="form-control color">
            </div>
          </div>
</div>
</div>
                <div class="form-group">
                  <button onClick="GuardarAlcance()" class="btn btn-primary">Guardar Cambios</button>
                  <?php
                  if(isset($edit->nombre))
                    echo '<button  onclick="EliminarAlcance()" title="1" class="btn btn-danger">Eliminar definitivamente</button>';
                  ?>
    </div>
</div>
                <script>
                  function GuardarAlcance()
    {
      var flag=true;
      if(flag)
          swal({   title: "Se guardara la informacion de esta estilo de Capa!",
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
        swal("Pais Guardada!", "Este estilo de Capa se guardado correctamente", "success");
                var id=$("#id").val();
                        $.ajax({
                        data: {
                          "opcion": 5,
                          "color": $("#color").val(),
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/menusModel.php",

                      })
                      .done(function( respuesta ) {
                          id=respuesta.new;
              $("#Contenidos").load(host+"MoFuSS/layersStyle.php",{id:id});
                        $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"layersStyle"});

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
          swal({   title: "Este estilo de Capa se eliminara",
    text: "¿Estas seguro de proceder?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",

    confirmButtonText: "Si, elimina el estilo de Capa",
    cancelButtonText: "No",
    closeOnConfirm: false,
    closeOnCancel: false },
    function(isConfirm){
        if (isConfirm)
    {
        swal("Estilo de Capa Eliminado", "Este estilo de Capa se elimino", "error");
        var id=$("#id").val();
                        $.ajax({
                        data: {
                          "opcion": 6,
                          "color": $("#color").val(),
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/menusModel.php",
                      })
                      .done(function( respuesta ) {
                            $("#Contenidos").load(host+"MoFuSS/layersStyle.php");
                            $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"layersStyle"});
                      })
                      .fail(function( jqXHR, textStatus, errorThrown ) {
                        if ( console && console.log ) {
                          console.log( "La solicitud a fallado: " +  textStatus);
                      }
                      });
        return true;
        }
        else {
            swal("Ok", "Este estilo de Capa no se elimino", "success");
            return false;
            }
            return false;
             });
    }
                </script>



