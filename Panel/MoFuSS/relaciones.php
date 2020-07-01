        <link rel="stylesheet" href="assets/js/arbol/dist/themes/default/style.min.css" />
        <script src="assets/js/arbol/dist/jstree.min.js"></script>

<?php
 include '../base.php';
 include "../host2.php";
  $obj=new Base("localhost",$DB_user,$DB_name);

?>                               

                            <div class="form-group panelIzquierdo">
              <label for="name">Relacion: </label>
                            <?php
              $result = $obj->consulta("SELECT id,nombre,tipo from diagrama where pais=".$_POST["pais"]." order by tipo");
  $numfilas = $result->num_rows;
  if($numfilas>0){
    echo "<div id='operacion'>";
  for($x=0;$x<$numfilas;$x++){
  $fila = $result->fetch_object();
  echo "<button value='".$fila->id."' class='tipo".$fila->tipo."'>".$fila->nombre."</button>";

}
echo "</div>";
}

$padres=array();
function nodo($id,$pais, $obj,$padres){
$iconos=array("glyphicon glyphicon-log-in","glyphicon glyphicon-flash","glyphicon glyphicon-log-out");
$nodo="";
	if($id==false){
		$nodo="{ 'text' : 'Start','id':'start'";
		$result = $obj->consulta("select diagrama.nombre, diagrama.id from relaciones left join diagrama on diagrama.id=relaciones.hijo  where diagrama.pais=".$pais." and relaciones.padre=0 group by nombre");
		$numfilas = $result->num_rows;
  		if($numfilas>0){
	  	$hijos=",'children':[";
	  		for($x=0;$x<$numfilas;$x++){
  				$fila = $result->fetch_object();
                                   
  				//if(!in_array($fila->nombre,$GLOBALS['padres'])){
                               
  					if($x==$numfilas-1)
  						$hijos.=nodo($fila->id, $pais,$obj,$GLOBALS['padres']);
  					else
  						$hijos.=nodo($fila->id, $pais,$obj,$GLOBALS['padres']).",";
  				//}
  			}
  		$hijos.="]";
  		$nodo.=$hijos;
		}
	}

	else{
		$result = $obj->consulta("SELECT nombre, tipo from diagrama where id=".$id);
		$fila = $result->fetch_object();
		$nombre=$fila->nombre;
		$nodo="{ 'text' : '".$nombre."','icon':'".$iconos[$fila->tipo]."'";
		$result = $obj->consulta("SELECT hijo from relaciones where padre=".$id);
		$numfilas = $result->num_rows;
  		if($numfilas>0){
	  	$hijos=",'children':[";
			if(!in_array($nombre,$GLOBALS['padres'])){
	  			for($x=0;$x<$numfilas;$x++){
  					$fila = $result->fetch_object();
					if($fila->hijo==$id)array_push($GLOBALS['padres'],$nombre);                                        
  					if($x==$numfilas-1)
  						$hijos.=nodo($fila->hijo, $pais, $obj,$GLOBALS['padres']);
  					else
  						$hijos.=nodo($fila->hijo, $pais,$obj,$GLOBALS['padres']).",";
					
					
                        	        array_push($GLOBALS['padres'],$nombre);       
  				}
				array_push($GLOBALS['padres'],$nombre);
			}
  		$hijos.="]";
  		$nodo.=$hijos;
		}
	}

                return $nodo."}";
}

              ?>
<button onClick="formarRelaciones()">Guardar Relaciones!!!</button>
</div><div id='data' class='demo panelDerecho'></div>
	
	<script>
function formarRelaciones(){
var relaciones="";
$("#data").find("li").each(function(){
//console.log($(this).children("a").text());
if($(this).children("a").text()!="Start"){
relaciones+="|"+$(this).parent().parent().children("a").text()+","+$(this).children("a").text();
relaciones.replace("undefined","");
}
//console.log("padre "+$(this).parent().parent().children("a").text());
});

                        $.ajax({
                        data: {
                          "opcion": 2,
			  "pais":$("#id").val(),
                          "relaciones":relaciones
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/diagramaModel.php",
                      })
                      .done(function( respuesta ) {
                      })
                      .fail(function( jqXHR, textStatus, errorThrown ) {
                        if ( console && console.log ) {
                          console.log( "La solicitud a fallado: " +  textStatus);
                      }
                      });   

}

var iconos=["glyphicon glyphicon-log-in","glyphicon glyphicon-flash","glyphicon glyphicon-log-out"];
	var tree=$('#data').jstree({      
		'core' : {
			"animation" : 0,
    "check_callback" : true,
    "themes" : { "stripes" : true },

			"data" : [<?php echo nodo(false,$_POST["pais"],$obj,$padres);?>]
},
"plugins" : [ "dnd", "search",
    "state", "types", "wholerow","contextmenu"],
"contextmenu":{         
    "items": function($node) {
        return {
            "Create": {
                "separator_before": false,
                "separator_after": false,
                "label": "Add",
                "action": function (obj) {
var name=$("#operacion>.newName").text(); 
var clase=parseInt($("#operacion>.newName").attr("class").replace("newName","").replace("tipo",""));
var flag=true;
if($("#"+$node.id+">a>i").hasClass("glyphicon-log-out"))flag=false;
var ap=1;
var hijos=0;
if($node.id!="#"){
var padre=$("#"+$node.id+">a").text();
$("#data").find("a").each(function(){
if($node.id!=$(this).parent().attr("id"))
if($(this).text()==padre)
if($(this).parent().find("ul").length>0)
hijos++;
});
console.log(hijos);
if(hijos>0)
flag=false;
}
//console.log($node);
$("#"+$node.id+">ul>li>a").each(function(){
if($(this).text()==name)flag=false;
});
for(var x=0;($node.parents.length-1)>x;x++)
if($("#"+$node.parents[x]+">a").text()==name)ap--;
if(ap<=0)flag=false;

if(flag){
                    $node = tree.jstree('create_node', $node);
                    //tree.jstree('set_type', $node,name);
                    tree.jstree('set_text', $node,name);
                    tree.jstree('set_icon', $node,iconos[clase]);
                    tree.jstree('set_state', $node,"open");
                    tree.jstree('show_node', $node);
}
                }
            },
            "Rename": {
                "separator_before": false,
                "separator_after": false,
                "label": "Edit",
                "action": function (obj) { 
var name=$("#operacion>.newName").text();
var clase=parseInt($("#operacion>.newName").attr("class").replace("newName","").replace("tipo",""));

var flag=true;
if($node.parents.length>1)

$("#"+$node.parents[0]+">ul>li>a").each(function(){
if($(this).text()==name)flag=false;
});


if(flag){
                    tree.jstree('rename_node', $node,name);
                    tree.jstree('set_icon', $node,iconos[clase]);
}

                }
            },                         
            "Remove": {
                "separator_before": false,
                "separator_after": false,
                "label": "Remove",
                "action": function (obj) { 
                                        tree.jstree('delete_node', $node);

                }
            }
        };
    }
}
});
$("#operacion>button").on("click", function(){
$("#operacion>button").removeClass("newName");
$(this).addClass("newName");
$("#data").addClass("newName");
});
	</script>

