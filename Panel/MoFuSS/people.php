<?php
 include '../base.php';
 include "../host2.php";
	$obj=new Base($DB_server,$DB_user,$DB_name);
              $result2 = $obj->consulta("SELECT tipo FROM personas group by tipo");

  $numfilas2 = $result2->num_rows;

if(isset($_POST['id'])){
                             $result = $obj->consulta( "SELECT * FROM personas where id=".$_POST['id']);


 
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
                    <div class="panelIzquierdo">
                       <div class="form-group">
              <label for="name">Nombre:(required) </label>
              <input type="text" name="name" id="nombre" value="<?php if(isset($edit->nombre)) echo $edit->nombre?>" class="form-control">
          </div>
                <div class="form-group">
              <label for="name">Apellido:(required)  </label>
              <input type="text" name="name" id="apellido" value="<?php if(isset($edit->apellido)) echo $edit->apellido?>" class="form-control">
          </div>
                  <div class="form-group">
              <label for="name">Ubicacion:(required)  </label>
              <input type="text" name="name" id="locacion" value="<?php if(isset($edit->locacion)) echo $edit->locacion?>" class="form-control">
          </div>
                  <div class="form-group">
              <label for="name">Contacto:(required)  </label>
              <input type="text" name="name" id="contacto" value="<?php if(isset($edit->contacto)) echo $edit->contacto?>" class="form-control">
          </div>
           
 <div class="form-group">
              <label for="name">Tipo:(required)  </label>
              <?php
        if($numfilas2>0){
    echo "<select id='oppersonas'>";
  for($x=0;$x<$numfilas2;$x++){
  $fila2 = $result2->fetch_object();
  echo "<option>".strtoupper($fila2->tipo)."</option>";
}
echo "</select>";
}
              ?>
              <input type="text" name="name" id="tipo" value="<?php if(isset($edit->tipo)) echo $edit->tipo?>" class="form-control">
          </div>

                <div class="form-group">
                    <label for="venue">descripcion:(required) </label>
                      <?php 
                        if(isset($edit->descripcion)) 
                          echo '<textarea id="descripcion" class="form-control">'.$edit->descripcion.'</textarea>';
                        else
                          echo '<textarea id="descripcion" class="form-control"></textarea>';
                      ?>
                </div>
                <div class="form-group">
                    <label for="Graduate">Graduado:</label>
                      <?php
                        if(isset($edit->graduado)){
				if($edit->graduado)
                          echo '<input type="checkbox" id="Graduate" class="form-control" checked/>';
                        	else
                          echo '<input type="checkbox" id="Graduate" class="form-control"/>';
			}
			else
                          echo '<input type="checkbox" id="Graduate" class="form-control"/>';
                      ?>
                </div>

                  <div class="fileUpload btn form-control">
                    <span>Imagen</span>(required) 
<form enctype="multipart/form-data" id="imgajax"><input type="file" class="upload" name="img" id="img" />
                  </form>
                  </div>
                </div>
                <div class="panelDerecho">
                    <?php 
                    if(isset($edit->img)){
                    if($edit->img!="") 
                        echo '<img id="blah" src="uploads/personas/'.$edit->img.'" alt="your image" />' ; 
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
$(".fileUpload").on("click", function(){
$(".fileUpload").css("border","none");
});
                  function GuardarAlcance()
    {
      var flag=true;
      flag=flag*vacio("nombre");
      flag=flag*vacio("apellido");
      flag=flag*vacio("locacion");
      flag=flag*vacio("contacto");
      flag=flag*vacio("descripcion");
      flag=flag*vacio("tipo");
      if($("#img").val()=="" && $("#id").val()==""){
        flag=false;
	$(".fileUpload").css("border","solid 2px red");
}
      if(flag)
          swal({   title: "Se guardara la informacion de esta Persona!",   
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
swal({title:"Guardando", type:"warning", showCancelButton: false, confirmButton:false});
        setTimeout(function(){
 swal("Persona Guardada!", "Esta persona se guardado correctamente", "success");
},2000);
                var id=$("#id").val();
                        $.ajax({
                        data: {
                          "opcion": 1,
                          "nombre":$("#nombre").val(),
                          "apellido":$("#apellido").val(),
                          "locacion":$("#locacion").val(),
                          "graduado":$("#Graduate").is(':checked'),                          
"contacto":$("#contacto").val(),
"tipo":$("#tipo").val(),

                          "img":$("#img").val(),
                          "descripcion":$("#descripcion").val(),
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/personasModel.php",
                      })
                      .done(function( respuesta ) {
                          id=respuesta.new;
                          
                                                                var formData = new FormData(document.getElementById("imgajax"));
            formData.append("id", id);
            formData.append("opcion", 2);
            $.ajax({
                url: "MoFuSS/personasModel.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
       processData: false
            })
                .done(function(res){
		   
              $("#Contenidos").load(host+"MoFuSS/people.php",{id:id});
                        $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"people"});
              
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
console.log(host);
    function EliminarAlcance()
    {
          swal({   title: "Este curso se eliminara",   
    text: "¿Estas seguro de proceder?",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Si, elimina el curso",   
    cancelButtonText: "No",   
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    function(isConfirm){   
        if (isConfirm) 
    {   
        swal("people Eliminado", "Este curso se elimino", "error");   
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
                        url: "MoFuSS/personasModel.php",
                      })
                      .done(function( respuesta ) {
                            $("#Contenidos").load(host+"MoFuSS/people.php");
                            $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"people"});
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
  
                    function readpeople(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$("#img").change(function(){
    readpeople(this, "blah");
});
$("#oppersonas").on("click",function(){
$("#tipo").val($("#oppersonas").val());
});
function Prioridad(este, val){
                        $.ajax({
                        data: {
                          "opcion": 4,
                          "valor":val,
                          "id" : este
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/personasModel.php",
                      })
                      .done(function( respuesta ) {
                            $("#Contenidos").load(host+"MoFuSS/people.php");
                            $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"people",nL:$("#nl").val()});
                      })
                      .fail(function( jqXHR, textStatus, errorThrown ) {
                        if ( console && console.log ) {
                          console.log( "La solicitud a fallado: " +  textStatus);
                      }
                      });
    }
                </script>
