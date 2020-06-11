 
                                   <?php
if(isset($_POST['pais'])) {
	$pais="where id_Pais=".$_POST['pais']." and ";

$paisid=$_POST['pais'];
}else{
$pais="where ";
$paisid="";
}
 include '../base.php';
  $obj=new Base("localhost","root","conabio3");
if(isset($_POST['id'])){
                        if($_POST['id']!=""){
                             $result = $obj->consulta("SELECT * FROM submenus where id=".$_POST['id']);

  $numfilas = $result->num_rows;
  $fila = $result->fetch_object();
  $edit=$fila;
}

   }




echo '<div><div class="form-group">';
 if(isset($edit->titulo)) echo '<h4>"'.$edit->titulo.'" edit:</h4>'; else echo '<h4>Nuevo</h4>';
   ?>
 </div>
                    <input type="text" name="id" id="id" value="<?php if(isset($edit->id)) echo $edit->id?>" class="form-control hidden">

                                <div class="separador">
                    <div class="panelIzquierdo">    
                            <div class="form-group">
              <label for="name">Sub Menu: </label>
                            <?php
              $result = $obj->consulta("select nombre, id_Pais from paises");
  $numfilas = $result->num_rows;
  if($numfilas>0){
    echo "<select id='opPais'>";
  for($x=0;$x<$numfilas;$x++){
  $fila = $result->fetch_object();
  if($paisid==$fila->id_Pais){
      echo "<option value=".$fila->id_Pais." selected>".$fila->nombre."</option>";
    }
  else{
  echo "<option value=".$fila->id_Pais." >".$fila->nombre."</option>";
}
if($x==0)$paisAux=$fila->id_Pais;
}
echo "</select><br>";
}


              $result = $obj->consulta("(select id_Capa as id, nombre as a from menus ".$pais." sub=1 and 0=(select COUNT(*) from menus as b where menus.nombre=b.submenu) order by nombre) union (select id_Capa as id, submenu as a from menus ".$pais." sub!=1 group by subMenu)");
  $numfilas = $result->num_rows;
  if($numfilas>0){
    echo "<select id='opSub'>";
  for($x=0;$x<$numfilas;$x++){
  $fila = $result->fetch_object();
  if($fila->a){
      echo "<option selected>".$fila->a."</option>";
    }
  else{
  echo "<option>".$fila->a."</option>";
}
if($x==$numfilas-1)$subAux=$fila->a;
}
echo "</select>";
}
              ?>
              <input type="text" name="name" id="submenu" value="<?php if(isset($edit->submenu)) echo $edit->submenu; else echo $subAux;?>" class="form-control">
              <input type="text" name="name" id="pais" value="<?php if(isset($paisid)){ if($paisid!="")echo $paisid; else echo $paisAux;}?>" class="form-control hidden">
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
                          "pais":$("#pais").val(),
                          "submenu":$("#submenu").val(),
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/submenuShowModel.php",
                      })
                      .done(function( respuesta ) {
			var id=respuesta.new;
              $("#Contenidos").load(host+"MoFuSS/submenus.php",{id:id});
                        $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"submenus"}); 
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
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/submenuShowModel.php",
                      })
                      .done(function( respuesta ) {
                            $("#Contenidos").load(host+"MoFuSS/submenus.php");
                            $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"submenus"});
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
              
$("#opPais").on("change",function(){

var pais=$("#opPais > option[value='"+$("#opPais").val()+"']").val();
console.log(pais);
$("#Contenidos").load(host+"MoFuSS/submenus.php",{pais:pais,id:$("#id").val()});
});


$("#opSub").on("change",function(){
$("#submenu").val($("#opSub").val());
});


                </script>
