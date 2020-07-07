
  <p class="titleGaleria">Colores de Pagina</p>
<div class="separador">
  <?php
 include '../base.php';
 include "../host2.php";
  $obj=new Base($DB_server,$DB_user,$DB_name);
   $result = $obj->consulta("SELECT id,color FROM colores");
     $numfilas = $result->num_rows;
     echo "<div id='paletaColores' class='hidden'>";
     include 'color.html';
          echo "</div>";
     echo '<form id="colores">';
     for ($x=0;$x<$numfilas;$x++) {
        $fila = $result->fetch_object();
        $y=$x+1;
        if($y==1)$titulo="Principal";
        if($y==2)$titulo="Fondo";
        if($y==3)$titulo="Secundario";
        if($y==4)$titulo="Texto";
        if($y==5)$titulo="Tercero";
                echo '
                <div class="form-group">
                    <label>'.$titulo.':</label>
                    <input type="text" id="color'.$fila->id.'" name="color'.$fila->id.'" class="form-control colores hidden"/>
                    <input type="button" id="colorBtn'.$fila->id.'" name="colorBtn'.$fila->id.'" onClick="colorde(\''.$fila->id.'\')" class="form-control colores"/>
                    <script>
                      document.getElementById("color'.$fila->id.'").value = "'.$fila->color.'";
                      $("#colorBtn'.$fila->id.'").prop("style" ,"background: '.$fila->color.'");
                      $("#colorBtn'.$fila->id.'").prop("title" ,"'.$fila->color.'");
                    </script>
                    </div>
                ';               
     }
     echo "</form>";
   
  ?>
                
                        <button class="form-control btn btn-primary"  onClick="colores()">Guardar Imagen</button>
  </div>
  <script>
  function Cambiar(id){
    var color=$("#swatch").attr("style");
    color=color.replace("background","");
    color=color.replace(":","");
    color=color.replace(";","");
    $("#color"+id).val(color);
    $("#color"+id).attr("title",color);
                      $("#colorBtn"+id).prop("style" ,"background: "+color+"");
                      $("#colorBtn"+id).prop("title" ,color);
                      $("#paletaColores").addClass("hidden");

  }
  
      function Galeria(id, opcion){
      Confirmacion("Galeria",eliminarGaleria,id,opcion);

  }
  function colorde(id){
    $("#AceptarColor").attr("onclick", "Cambiar("+id+")");
     var color=$("#colorBtn"+id).prop("title");
     console.log(color);
     if(color.indexOf("#")!=-1){
      var r=color.substring(1,3);
      var g=color.substring(3,5);
      var b=color.substring(5);
      var a=100;
      $( "#red" ).slider( "value", parseInt(r, 16) );
      $( "#green" ).slider( "value", parseInt(g, 16) );
      $( "#blue" ).slider( "value", parseInt(b, 16) );
      $( "#opacity" ).slider( "value", a );
      
     }
     else{
      var aux=color.split("(");
      var aux2=aux[1].substring(0,aux[1].length-1);
      aux2=aux2.replace(")","");
      var colores= aux2.split(",");
       var r=colores[0];
      var g=colores[1];
      var b=colores[2];
      var a=colores[3]*100;
      $( "#red" ).slider( "value", parseInt(r) );
      $( "#green" ).slider( "value", parseInt(g) );
      $( "#blue" ).slider( "value", parseInt(b) );
      $( "#opacity" ).slider( "value", a );     
}
     $("#paletaColores").removeClass("hidden");
  }
  function colores(){
    swal({title:"Colores Guardando!", text:"La paleta de colores se actualizo", type:"success"});
      var formData = new FormData(document.getElementById("colores"));
            $.ajax({
                url: "MoFuSS/coloresModel.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
       processData: false
            })
                .done(function(res){
                  $("#Lista").load(host+"MoFuSS/colores.php");
              })
              .fail(function( jqXHR, textStatus, errorThrown ) {
                if ( console && console.log ) {
                console.log( "La solicitud a fallado: " +  textStatus);
              }
            

  });
  }
   </script>

