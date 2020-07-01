<?php
 include '../base.php';
 include "../host2.php";
$obj=new Base("localhost",$DB_user,$DB_name);
if(isset($_POST['id'])){
  $result = $obj->consulta( "SELECT * FROM usoSuelo where idUsoSuelo=".$_POST['id']);

  $numfilas = $result->num_rows;
  $fila = $result->fetch_object();
  $edit=$fila;
   }




echo '<div><div class="form-group">';
 if(isset($edit->descripcion)) echo '<h4>"'.$edit->descripcion.'" edit:</h4>'; else echo '<h4>Nuevo</h4>';
   ?>
 </div>
                    <input type="text" name="id" id="id" value="<?php if(isset($edit->idUsoSuelo)) echo $edit->idUsoSuelo?>" class="form-control hidden">
                                                               <div class="separador">
                       <div class="form-group">
              <label for="name">Categoria: </label>
              <input type="number" name="name" id="categoria" value="<?php if(isset($edit->categoria)) echo $edit->categoria?>" class="form-control">
          </div>
                            <div class="form-group">
              <label for="name">Pais: </label>
                            <?php
                            $final="";
              $result = $obj->consulta("SELECT id_Pais, nombre FROM paises order by nombre");

  $numfilas = $result->num_rows;
  if($numfilas>0){
    echo "<select id='oppais'>
<option value='-1' selected></option>";
  for($x=0;$x<$numfilas;$x++){
  $fila = $result->fetch_object();
  if($fila->id_Pais==$edit->idPais){
    $final=$fila->nombre;
      echo "<option value='".$fila->id_Pais."' selected>".$fila->nombre."</option>";
    }
  else
  echo "<option value='".$fila->id_Pais."'>".$fila->nombre."</option>";
  
}
echo "</select>";
}
              ?>
              <input type="text" name="name" id="pais" value="<?php if(isset($edit->idPais)) echo $edit->idPais?>" class="form-control hidden">
              <input type="text" name="name" id="paisAux" value="<?php if(isset($final)) echo $final?>" class="form-control">
          </div>
                
                <div class="form-group">
                    <label for="venue">Descripcion:</label>
                      <?php 
                        if(isset($edit->descripcion)) 
                          echo '<textarea id="descripcion" class="form-control">'.$edit->descripcion.'</textarea>';
                        else
                          echo '<textarea id="descripcion" class="form-control"></textarea>';
                      ?>
                </div>

                </div>
      
                        
                <div class="form-group">
                  <button onClick="GuardarAlcance()" class="btn btn-primary">Guardar Cambios</button>
                  <?php 
                  if(isset($edit->idPais))
                    echo '<button  onclick="EliminarAlcance()" title="1" class="btn btn-danger">Eliminar definitivamente
                  </button>';
                  ?>
    </div>
</div>
                <script>

                  function GuardarAlcance()
    {
      var flag=true;
      //flag=flag*vacio("nombre");
      //flag=flag*vacio("funcion");
      flag=flag*vacio("categoria");
      //flag=flag*vacio("descripcion");
      if(flag)
          swal({   title: "Se guardara la informacion de este Uso de Suelo!",   
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
        swal("Capa Guardada!", "Este Uso de Suelo se guardado correctamente", "success");
                var id=$("#id").val();
                        $.ajax({
                        data: {
                          "opcion": 1,
                          "categoria":$("#categoria").val(),
                          "pais":$("#pais").val(),
                          "descripcion":$("#descripcion").val(),
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/usoSueloModel.php",
                      })
                      .done(function( respuesta ) {
                          id=respuesta.new;
              $("#Contenidos").load(host+"MoFuSS/usoSuelo.php",{id:id});
                        $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"usoSuelo"});

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
          swal({   title: "Este Uso de Suelo se eliminara",   
    text: "¿Estas seguro de proceder?",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Si, elimina el Uso de Suelo",   
    cancelButtonText: "No",   
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    function(isConfirm){   
        if (isConfirm) 
    {   
        swal("panel Eliminado", "Este Uso de Suelo se elimino", "error");   
        var id=$("#id").val();
                        $.ajax({
                        data: {
                          "opcion": 0,
                          "descripcion":$("#descripcion").text(),
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/usoSueloModel.php",
                      })
                      .done(function( respuesta ) {
                            $("#Contenidos").load(host+"MoFuSS/usoSuelo.php");
                            $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"usoSuelo"});
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
  
                  
  
$("#oppais").on("click",function(){
$("#pais").val($("#oppais").val());
$("#paisAux").val($("#oppais > option[value='"+$("#oppais").val()+"']").text());
});

             </script>

