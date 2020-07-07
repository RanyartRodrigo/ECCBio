                                   <?php
 include '../base.php';
 include "../host2.php";
 $obj=new Base($DB_server,$DB_user,$DB_name);
if(isset($_POST['id'])){

                             $result = $obj->consulta( "SELECT * FROM diagrama where id=".$_POST['id']);

  $numfilas = $result->num_rows;
  $fila = $result->fetch_object();
  $edit=$fila;
   }




echo '<div><div class="form-group">';
 if(isset($edit->nombre)) echo '<h4>"'.$edit->nombre.'" edit:</h4>'; else echo '<h4>Nuevo</h4>';
   ?>
 </div>
                    <input type="text" name="id" id="id" value="<?php if(isset($edit->id)) echo $edit->id?>" class="form-control hidden">
                                                               <div class="separador">
                       <div class="form-group">
              <label for="name">Nombre: </label>
              <input type="text" name="name" id="nombre" value="<?php if(isset($edit->nombre)) echo $edit->nombre?>" class="form-control">
          </div>
                            <div class="form-group">
              <label for="name">Pais: </label>
                            <?php
              $result = $obj->consulta("SELECT nombre,id_Pais FROM paises");

  $numfilas = $result->num_rows;
  if($numfilas>0){
    echo "<select id='oppais'>";
  for($x=0;$x<$numfilas;$x++){
  $fila = $result->fetch_object();
  if($fila->id_Pais==$edit->pais){
      $final=$fila->nombre;
      echo "<option value='".$fila->id_Pais."' selected>".$fila->nombre."</option>";
    }
  else
  echo "<option value='".$fila->id_Pais."'>".$fila->nombre."</option>";
  
}
echo "</select>";
}
              ?>
              <input type="text" name="name" id="paisAux" value="<?php if(isset($final)) echo $final?>" class="form-control">
              <input type="text" name="name" id="pais" value="<?php if(isset($edit->pais)) echo $edit->pais?>" class="form-control hidden">
          </div>
                <div class="form-group" id="Relaciones"></div>

                

                            <div class="form-group">
              <label for="name">Tipo: </label>
                            <?php
              $result =array("datos","proceso","final");
  $numfilas=count($result);
  if($numfilas>0){
    echo "<select id='optipo'>";
  for($x=0;$x<$numfilas;$x++){
  $fila = $result;
  if($x==$edit->tipo){
      $final=$fila[$x];
      echo "<option value='".$x."'selected >".$fila[$x]."</option>";
    }
  else
  echo "<option value='".$x."'>".$fila[$x]."</option>";

}
echo "</select>";
}
              ?>
              <input type="text" name="name" id="tipoAux" value="<?php if(isset($final)) echo $final?>" class="form-control">
              <input type="text" name="name" id="tipo" value="<?php if(isset($edit->tipo)) echo $edit->tipo?>" class="form-control hidden">
          </div>

                <div class="form-group">
              <label for="name">Operacion: </label>
              <input type="text" name="name" id="operacion" value="<?php if(isset($edit->operacion)) echo $edit->operacion?>" class="form-control">
          </div>
                  <div class="form-group">
              <label for="name">Descripcion: </label>
              <textarea type="text" name="name" id="descripcion" class="form-control"><?php if(isset($edit->descripcion)) echo $edit->descripcion?></textarea>
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
  <?php
    if(isset($_POST['id']))
      echo "<div id='galeriaDiagrama'></div><script>$('#galeriaDiagrama').load('/admin/Global/MoFuSS/galeria_Diagramas.php',{id:".$_POST['id']."});</script>";
    ?>

</div>
                <script>
                  function GuardarAlcance()
    {
/*var relaciones="";
$("#oprelacion>button").each(function(){
if(!$(this).hasClass("noagregado"))
relaciones+=$(this).attr("value")+",";
});*/
      var flag=true;
      flag=flag*vacio("nombre");
      flag=flag*vacio("pais");
      flag=flag*vacio("descripcion");
     flag=flag*vacio("tipo");
      if(flag)
          swal({   title: "Se guardara la informacion de esta Capa!",   
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
        swal("Capa Guardada!", "Esta Capa se guardado correctamente", "success");
                var id=$("#id").val();
                        $.ajax({
                        data: {
                          "opcion": 1,
                          "nombre":$("#nombre").val(),
                          "pais":$("#pais").val(),
                          "descripcion":$("#descripcion").val(),
                          "orden":$("#orden").val(),
                          "operacion":$("#operacion").val(),
                          "tipo":$("#tipo").val(),
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/diagramaModel.php",
                      })
                      .done(function( respuesta ) {
                          id=respuesta.new;
              $("#Contenidos").load(host+"MoFuSS/diagram.php",{id:id});
                        $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"diagram"});

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
          swal({   title: "Esta Capa se eliminara",   
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
        swal("layers Eliminado", "Este Capa se elimino", "error");   
        var id=$("#id").val();
                        $.ajax({
                        data: {
                          "opcion": 0,
                          "nombre":$("#nombre").val(),
                          "descripcion":$("#descripcion").text(),
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/menusModel.php",
                      })
                      .done(function( respuesta ) {
                            $("#Contenidos").load(host+"MoFuSS/diagram.php");
                            $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"diagram"});
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
  
                    function readlayers(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$("#optipo").on("click",function(){
$("#tipoAux").val($("#optipo > option[value='"+$("#optipo").val()+"']").text());
$("#tipo").val($("#optipo").val());
});

$("#oppais").on("click",function(){
$("#paisAux").val($("#oppais > option[value='"+$("#oppais").val()+"']").text());
$("#pais").val($("#oppais").val());
});

                </script>

