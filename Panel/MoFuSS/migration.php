 
                                   <?php

if(isset($_POST['id'])){
 include '../base.php';
                            $obj=new Base("localhost","root","conabio3");
                             $result = $obj->consulta("SELECT * FROM migracion where id=".$_POST['id']);
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
              <label for="name">modelo:(required) </label>
              <input type="text" name="name" id="modelo" value="<?php if(isset($edit->modelo)) echo $edit->modelo?>" class="form-control">
          </div>
          <?php
/*		$resultd = $obj->consulta("SELECT modelo FROM migracion group by modelo order by modelo");
		$numfilasd = $resultd->num_rows;
		if($numfilasd>0){
			echo "<select id='opmodelo'>";
 			for($i=0;$i<$numfilasd;$i++){
				$fila = $resultd->fetch_object();
				if(isset($edit->modelo)){
					if($fila->modelo==$edit->modelo){
						echo "<option value='".$fila->modelo."' selected>".$fila->modelo."</option>";
					}		
					else
						echo "<option value='".$fila->modelo."'>".$fila->modelo."</option>";
				}
                                else
                                        echo "<option value='".$fila->modelo."'>".$fila->modelo."</option>";


			}
			echo "</select>";
		}
*/	?>

           
        
          <div class="form-group">
              <label for="location">año:(required)</label>
              <input type="text" name="location" id="anio" value="<?php if(isset($edit->anio)) echo $edit->anio?>" class="form-control"/>
          </div>

          <div class="form-group">
              <label for="location">colors:(required)</label>
		<div id="colorsShow"></div>
              <input type="text" name="location" id="colors" value="<?php if(isset($edit->colors)) echo $edit->colors?>" class="form-control hidden"/>
          </div>
                    
                  <div class="fileUpload btn form-control">
                    <span>Imagen</span>
<form enctype="multipart/form-data" id="imgajax"><input type="file" class="upload" name="img" id="img" />
                  </form>
                  </div>
                </div>
                <div class="panelDerecho">
                    <?php 
/*                    if(isset($edit->img)){
                    if($edit->img!="") 
                        echo '<img id="blah" src="uploads/amigos/'.$edit->img.'" alt="your image" />' ; 
                    else 
                        echo '<img id="blah" src="assets/img/unam.png" alt="your image" />';
                        }
                        else 
                        echo '<img id="blah" src="assets/img/unam.png" alt="your" />';
  */                  ?>
                        
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
$(document).ready(function(){
coloresConstruir();
});
 function coloresConstruir(){
	var colores=$("#colors").val().split(",");
	for(var x=0;x<colores.length;x++){
		if(colores[x]!='')
			$("#colorsShow").append("<div onclick='cambiarC(this)' title='"+colores[x]+"'style='background:"+colores[x]+"'></div>");
	}
	 $("#colorsShow").append("<div onclick='agregarC()' title='add' id='colorM'><span>+</span></div>");
console.log(colores);
}/*
function agregarC(){
if($("#seleccionarColor").length==0)
$("body").append("<div id='seleccionarColor"></div>);
}*/
function agregarC(){
 $("#colorM").before("<div onclick='cambiarC(this)' title='#000000' style='background:#000000'></div>");
}
function cambiarC(este){
if($("#seleccionarColor").length==0)
$("body").append("<div id='seleccionarColor'><input type='color' id='colorS'/></div>");
$("#colorS").change(function(){
$(este).attr("title",$(this).val());
$(este).attr("style","background:"+$(this).val());
$("#seleccionarColor").remove();
});
$("#colorS").trigger("click");
}
function obtenerColores(){
$("#colors").val("");
var x=0;
$("#colorsShow>div").each(function(){
	var color=$(this).prop("title");
	if(x==0){
		$("#colors").val(color);
		x++;
	}
	else
		$("#colors").val($("#colors").val()+','+color);
});
return $("#colors").val().replace(",add","");
}
                  function GuardarAlcance()
    {
      var flag=true;
      flag=flag*vacio("modelo");
      flag=flag*vacio("anio");
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
                          "modelo":$("#modelo").val(),
                          "anio":$("#anio").val(),
                          "colores":obtenerColores(),
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/migracionModel.php",
                      })
                      .done(function( respuesta ) {
                        if(id=="")
                          id=respuesta.new;
                          
                                                                var formData = new FormData(document.getElementById("imgajax"));
            formData.append("modelo", $("#modelo").val());
            formData.append("anio", $("#anio").val());
            formData.append("id", id);
            formData.append("opcion", 2);
            $.ajax({
                url: "MoFuSS/migracionModel.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
       processData: false
            })
                .done(function(res){
              $("#Contenidos").load(host+"MoFuSS/migration.php",{id:id});
                        $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"migration"});
              
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
                        url: "MoFuSS/migracionModel.php",
                      })
                      .done(function( respuesta ) {
                            $("#Contenidos").load(host+"MoFuSS/migration.php");
                            $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"migration"});
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

$("#opmodelo").on("click",function(){
$("#modelo").val($("#opmodelo").val());
});

                </script>
<style>
#colorsShow {
    width: 400px;
    min-height: 40px;
    border: solid 1px;
    padding: 5px;
    float:left;
}
#colorsShow>div {
    border: solid 1px;
    width: 40px;
    height: 28px;
    float: left;
    margin-left:2px;
}
#seleccionarColor {
    bottom: 0px;
    right: 0px;
    position: fixed;
    border: solid;
    width: 200px;
    height: 200px;
    background: white;
}
</style>
