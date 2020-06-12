<?php
 include '../base.php';
 include "../host2.php";
 $obj=new Base("localhost",$DB_user,$DB_name);
if(isset($_POST['id'])){

                             $result = $obj->consulta( "SELECT * FROM menus where id_Capa=".$_POST['id']);

  $numfilas = $result->num_rows;
  $fila = $result->fetch_object();
  $edit=$fila;
   }




echo '<div><div class="form-group">';
 if(isset($edit->nombre)) echo '<h4>"'.$edit->nombre.'" edit:</h4>'; else echo '<h4>Nuevo</h4>';
   ?>
 </div>
                    <input type="text" name="id" id="id" value="<?php if(isset($edit->id_Capa)) echo $edit->id_Capa?>" class="form-control hidden">
                                                               <div class="separador">
                       <div class="form-group">
              <label for="name">Nombre: </label>
              <input type="text" name="name" id="nombre" value="<?php if(isset($edit->nombre)) echo $edit->nombre?>" class="form-control">
          </div>
                            <div class="form-group">
              <label for="name">Submenu de: </label>
                            <?php
              $result = $obj->consulta("SELECT subMenu FROM menus group by subMenu");

  $numfilas = $result->num_rows;
  if($numfilas>0){
    echo "<select id='opmenussub'>";
  for($x=0;$x<$numfilas;$x++){
  $fila = $result->fetch_object();
  if($fila->subMenu==$edit->subMenu){
      echo "<option selected>".$fila->subMenu."</option>";
    }
  else
  echo "<option>".$fila->subMenu."</option>";
  
}
echo "</select>";
}
              ?>
              <input type="text" name="name" id="subMenu" value="<?php if(isset($edit->subMenu)) echo $edit->subMenu?>" class="form-control">
          </div>
                            <div class="form-group">
              <label for="name">Grupo: </label>
                            <?php
              $result = $obj->consulta("SELECT grupo FROM menus group by grupo");

  $numfilas = $result->num_rows;
  if($numfilas>0){
    echo "<select id='opgrupo'>";
  for($x=0;$x<$numfilas;$x++){
  $fila = $result->fetch_object();
  if($fila->grupo==$edit->grupo){
      echo "<option selected>".$fila->grupo."</option>";
    }
  else
  echo "<option>".$fila->grupo."</option>";

}
echo "</select>";
}
              ?>
              <input type="text" name="name" id="grupo" value="<?php if(isset($edit->grupo)) echo $edit->grupo?>" class="form-control">
          </div>

                            <div class="form-group">
              <label for="name">Tipo: </label>
                            <?php
              $result = $obj->consulta("SELECT tipo FROM menus group by tipo");

  $numfilas = $result->num_rows;
  if($numfilas>0){
    echo "<select id='optipo'>";
  for($x=0;$x<$numfilas;$x++){
  $fila = $result->fetch_object();
  if($fila->tipo==$edit->tipo){
      echo "<option selected>".$fila->tipo."</option>";
    }
  else
  echo "<option>".$fila->tipo."</option>";

}
echo "</select>";
}
              ?>
              <input type="text" name="name" id="tipo" value="<?php if(isset($edit->tipo)) echo $edit->tipo?>" class="form-control">
          </div>

                            <div class="form-group">
              <label for="name">Unidad: </label>
                            <?php
              $result = $obj->consulta("SELECT unidad FROM menus unidad group by unidad");
  $numfilas = $result->num_rows;
  if($numfilas>0){
    echo "<select id='opunidad'>";
  for($x=0;$x<$numfilas;$x++){
  $fila = $result->fetch_object();
  if($fila->unidad==$edit->unidad){
      echo "<option selected>".$fila->unidad."</option>";
    }
  else
  echo "<option>".$fila->unidad."</option>";

}
echo "</select>";
}
              ?>
              <input type="text" name="name" id="unidad" value="<?php if(isset($edit->unidad)) echo $edit->unidad?>" class="form-control">
          </div>
                  <div class="form-group">
              <label for="name">Escala Logaritmica: </label>
              <?php if(isset($edit->escalaLog)){
			if($edit->escalaLog) echo '<input type="checkbox" name="name" id="log"  class="form-control" checked>';
			else echo '<input type="checkbox" name="name" id="log"  class="form-control" >';
		    }
		    else echo '<input type="checkbox" name="name" id="log"  class="form-control" >';
?>
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
              <label for="name">Columna: </label>
                            <?php
              $result = $obj->consulta("SELECT idColumna, titulo FROM columnas order by columna ASC");

  $numfilas = $result->num_rows;
  $finalC="";
  if($numfilas>0){
    echo "<select id='opcolumna'>";
  for($x=0;$x<$numfilas;$x++){
  $fila = $result->fetch_object();
  if($fila->idColumna==$edit->id_Columna){
      echo "<option value='".$fila->idColumna."' selected>".$fila->titulo."</option>";
      $finalC=$fila->titulo;

    }
    else
  echo "<option value='".$fila->idColumna."' >".$fila->titulo."</option>";

}
echo "</select>";
}
              ?>

              <input type="text" name="name" id="id_ColumnaAux" value="<?php if(isset($finalC)) echo $finalC?>" class="form-control">
              <input type="number" name="name" id="id_Columna" value="<?php if(isset($edit->id_Columna)) echo $edit->id_Columna?>" class="form-control hidden">
          </div>
                <div class="form-group">
              <label for="name">NombreEE: </label>
              <input type="text" name="name" id="nombreEE" value="<?php if(isset($edit->nombreEE)) echo $edit->nombreEE?>" class="form-control">
          </div>
                <div class="form-group">
              <label for="name">NombreEE Zoom1: </label>
              <input type="text" name="name" id="nombreEE2" value="<?php if(isset($edit->nombreEE2)) echo $edit->nombreEE2?>" class="form-control">
          </div>

                  <div class="form-group">
              <label for="name">Zoom: </label>
              <input type="number" name="name" id="zoom" value="<?php if(isset($edit->zoom)) echo $edit->zoom?>" class="form-control">
          </div>

                  <div class="form-group">
              <label for="name">Pais: </label>
                            <?php
              $result = $obj->consulta("SELECT id_Pais, nombre FROM paises order by nombre ASC");

  $numfilas = $result->num_rows;
  $final="";
  if($numfilas>0){
    echo "<select id='opmenus'>";
  for($x=0;$x<$numfilas;$x++){
  $fila = $result->fetch_object();
  if($fila->id_Pais==$edit->id_Pais){
      echo "<option value='".$fila->id_Pais."' selected>".$fila->nombre."</option>";
      $final=$fila->nombre;

    }
  else
  echo "<option value='".$fila->id_Pais."' >".$fila->nombre."</option>";
  
}
echo "</select>";
}
              ?>
              <input type="text" name="name" id="id_PaisAux" value="<?php if(isset($final)) echo $final?>" class="form-control">
              <input type="number" name="name" id="id_Pais" value="<?php if(isset($edit->id_Pais)) echo $edit->id_Pais?>" class="form-control hidden">
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
                  if(isset($edit->id_Capa))
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
      flag=flag*vacio("latitud");
      flag=flag*vacio("longitud");
      flag=flag*vacio("id_Pais");
      flag=flag*vacio("descripcion");
      flag=flag*vacio("zoom");	
      flag=flag*vacio("unidad");
      flag=flag*vacio("tipo");
	if($("#log").is(':checked')) {  
            var log=1;  
        } else {  
            var log=0;  
        }  
      if($("#id_Columna").val()==""){
	var columna="null";
       }
      else 
	var columna=$("#id_Columna").val();
      flag=flag*vacio("nombreEE");

      //if($("#img").val()=="")
       // flag=false;
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
                          "latitud":$("#latitud").val(),
                          "longitud":$("#longitud").val(),
                          "id_Pais":$("#id_Pais").val(),
                          "descripcion":$("#descripcion").val(),
                           "zoom":$("#zoom").val(),
                          "id_Columna":columna,
                          "nombreEE":$("#nombreEE").val(),
                          "subMenu":$("#subMenu").val(),
                          "nombreEE2":$("#nombreEE2").val(),
                          "grupo":$("#grupo").val(),
                          "unidad":$("#unidad").val(),
                          "tipo":$("#tipo").val(),
                          "log":log,
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/menusModel.php",
                      })
                      .done(function( respuesta ) {
                          id=respuesta.new;
              $("#Contenidos").load(host+"MoFuSS/layers.php",{id:id});
                        $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"layers"});

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
    confirmButtonText: "Si, elimina el id_Pais",   
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
                          "url":$("#url").val(),
                          "descripcion":$("#descripcion").text(),
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/menusModel.php",
                      })
                      .done(function( respuesta ) {
                            $("#Contenidos").load(host+"MoFuSS/layers.php");
                            $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"layers"});
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
$("#tipo").val($("#optipo").val());
});

$("#opmenus").on("click",function(){
$("#id_Pais").val($("#opmenus").val());
$("#id_PaisAux").val($("#opmenus > option[value='"+$("#opmenus").val()+"']").text());
});
$("#opcolumna").on("click",function(){
$("#id_Columna").val($("#opcolumna").val());
$("#id_ColumnaAux").val($("#opcolumna > option[value='"+$("#opcolumna").val()+"']").text());
});
  
    $("#opmenussub").on("click",function(){
$("#subMenu").val($("#opmenussub").val());
});
    $("#opunidad").on("click",function(){
$("#unidad").val($("#opunidad").val());
});

    $("#opgrupo").on("click",function(){
$("#grupo").val($("#opgrupo").val());
});

                </script>
