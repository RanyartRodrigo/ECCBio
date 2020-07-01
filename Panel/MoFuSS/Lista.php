<?php
include '../base.php';
include '../host2.php';
$obj=new Base("localhost",$DB_user,$DB_name);
if(isset($_POST["filtro"])){
        echo "<button id='filtroButton'>Buscar</button><input id='filtro' type='text' placeholder='Buscar' value='".$_POST["filtro"]."'>";
	$filtro=$_POST["filtro"];
}
else{
        echo "<button id='filtroButton'>Buscar</button><input id='filtro' type='text' value='' placeholder='Buscar'>";
        $filtro="";

}
$pais="id_Pais=1 and";
   
                              
  $lista=$_POST["lista"];
  if(isset($_POST["nL"]))
    $nl=($_POST["nL"]*10)-10;
  else
    $nl=0;
  if("identificadores"==$lista){
$obj->setBase("wegpComun");
        $result = $obj->consulta( "SELECT idEnt as id,nombre as a FROM polygonFF WHERE ".$pais." nombre LIKE '%".$filtro."%' order by nombre ASC LIMIT ".$nl.", 10");
        $nresult = $obj->consulta( "SELECT idEnt as id,nombre as a FROM polygonFF WHERE ".$pais."  nombre LIKE '%".$filtro."%'  order by nombre ASC");

  }
  if("country"==$lista){
  	$result = $obj->consulta( "SELECT id_Pais as id,nombre as a FROM paises WHERE  ".$pais." nombre LIKE '%".$filtro."%' order by nombre ASC LIMIT ".$nl.", 10");
        $nresult = $obj->consulta( "SELECT id_Pais as id,nombre as a FROM paises WHERE  ".$pais." nombre LIKE '%".$filtro."%'  order by nombre ASC");

  }
  if("usoSuelo"==$lista){
        $result = $obj->consulta( "SELECT idUsoSuelo as id,descripcion as a FROM usoSuelo WHERE  ".$pais." descripcion LIKE '%".$filtro."%'  order by idUsoSuelo ASC LIMIT ".$nl.", 10");
        $nresult = $obj->consulta( "SELECT idUsoSuelo as id,descripcion as a FROM usoSuelo WHERE  ".$pais." descripcion LIKE '%".$filtro."%'  order by idUsoSuelo ASC");

  }
  if("submenus"==$lista){
        $result = $obj->consulta( "select id as id, submenu as a FROM submenus WHERE  ".$pais." submenu LIKE '%".$filtro."%'  order by id ASC LIMIT ".$nl.", 10");
        $nresult = $obj->consulta( " select id as id, submenu as a FROM submenus WHERE  ".$pais." submenu LIKE '%".$filtro."%'  order by id ");

  }

  if("diagram"==$lista){
        $result = $obj->consulta( "SELECT id as id,nombre as a FROM diagrama  WHERE ".$pais."  nombre LIKE '%".$filtro."%' order by pais ASC LIMIT ".$nl.", 10");
        $nresult = $obj->consulta( "SELECT id as id,nombre as a FROM diagrama  WHERE  ".$pais." nombre LIKE '%".$filtro."%' order by pais ASC");

  }

    if("layers"==$lista){
		//$result = $obj->consulta( "SELECT id_Capa as id,concat(c.nombre,' | parte de [',s.nombre,']') as a FROM $DB_name.menus2 c, $DB_name.subMenus s WHERE id_Pais=1 and  nombre LIKE '%".$filtro."%'  and c.idSubmenu = s.idSubmenu order by id_Pais ASC, nombre ASC LIMIT ".$nl.", 10");
		//$nresult = $obj->consulta( "SELECT id_Capa as id,concat(c.nombre,' | parte de [',s.nombre,']') as a FROM $DB_name.menus2 c, $DB_name.subMenus s WHERE id_Pais=1 and  nombre LIKE '%".$filtro."%'  and c.idSubmenu = s.idSubmenu order by id_Pais  ASC");
	}
   if("layersStyle"==$lista){
    $result = $obj->consulta( "SELECT subMenu as id,subMenu as a FROM menus WHERE ".$pais."  nombre LIKE '%".$filtro."%' group by subMenu order by id_Pais ASC, nombre ASC, subMenu ASC LIMIT ".$nl.", 10");
    $nresult = $obj->consulta( "SELECT subMenu as id,subMenu as a FROM menus WHERE ".$pais."  nombre LIKE '%".$filtro."%' group by subMenu order by id_Pais ASC, subMenu ASC");

  }
    if("columns"==$lista){
		$pais = "";
    $result = $obj->consulta( "SELECT idColumna as id,titulo as a FROM $DB_name.columnas WHERE ".$pais."  titulo LIKE '%".$filtro."%'  order by titulo ASC LIMIT ".$nl.", 10");
    $nresult = $obj->consulta( "SELECT columna as a FROM $DB_name.columnas  WHERE ".$pais."  titulo LIKE '%".$filtro."%' order by idColumna ASC");

  }

    if("panel"==$lista){
    $result = $obj->consulta( "SELECT idPanel as id,concat('<i class=\'fa fa-',icono,'\'></i><i class=\'fa fa-arrow-circle-o-up masP\' onClick=\'Prioridad(',idPanel,',+1)\'></i><i class=\'fa fa-arrow-circle-o-down menosP\' onClick=\'Prioridad(',idPanel,',-1)\'></i>', nombre) as a FROM panel order by prioridad DESC LIMIT ".$nl.", 10");
    $nresult = $obj->consulta( "SELECT idPanel as id,concat('<i class=\'fa fa-',icono,'\'></i><i class=\'fa fa-arrow-circle-o-up masP\' onClick=\'Prioridad(',idPanel,',+1)\'></i><i class=\'fa fa-arrow-circle-o-down menosP\' onClick=\'Prioridad(',idPanel,',-1)\'></i>', nombre) as a FROM panel order by prioridad DESC");

  }
if("friends"==$lista){
        $result = $obj->consulta( "SELECT id,titulo as a FROM amigos WHERE ".$pais."  nombre LIKE '%".$filtro."%'  LIMIT ".$nl.", 10");
        $nresult = $obj->consulta( "SELECT id,titulo as a FROM amigos WHERE ".$pais."  nombre LIKE '%".$filtro."%' ");

  }
if("migration"==$lista){
        $result = $obj->consulta( "SELECT id,concat(modelo,'-',anio,'.csv') as a FROM migracion WHERE modelo LIKE '%".$filtro."%'  LIMIT ".$nl.", 10");
    $nresult = $obj->consulta( "SELECT id,modelo as a FROM migracion WHERE modelo LIKE '%".$filtro."%' ");
  }

if("people"==$lista){
        $result = $obj->consulta( "SELECT id,concat('<i class=\'fa fa-arrow-circle-o-down menosP\' onClick=\'Prioridad(',id,',+1)\'></i><i class=\'fa fa-arrow-circle-o-up masP\' onClick=\'Prioridad(',id,',-1)\'></i>', nombre, IF(graduado = 0, '', '(Graduado)')) as a FROM personas order by prioridad ASC LIMIT ".$nl.", 10");
        $nresult = $obj->consulta( "SELECT id,concat('<i class=\'fa fa-arrow-circle-o-down menosP\' onClick=\'Prioridad(',id,',+1)\'></i><i class=\'fa fa-arrow-circle-o-up masP\' onClick=\'Prioridad(',id,',-1)\'></i>', nombre, IF(graduado = 0, '', '(Graduado)')) as a FROM personas order by prioridad ASC");
  }

  if($lista != "layers"){
	$numfilas = $result->num_rows;
	$numfilas2 = $nresult->num_rows;
	for ($x=0;$x<$numfilas;$x++) {
		$fila = $result->fetch_object();
		$y=$x+1;
		echo "<div class='elemento' id='".$fila->id."-".$lista."' onClick='datos(this.title)' title='".$fila->id."-".$lista."'>";
		echo '<h7>'.($y+$nl).'.- </h7>';
        echo '<p>'.$fila->a.'</p>';
        echo "</div>";
	}  
	echo "<div class='elemento' onClick='datos(this.title)' title='null-".$lista."'>";
	echo '<span>Nuevo</span>';
	echo "</div>";
	echo "<input id='nl' type='number' value='".(($nl/10)+1)."' class='hidden'>";      
	for ($x=0;$x<=$numfilas2/10;$x++) {
		echo '<button onClick="listaN(this)" title="'.($x+1).'">'.($x+1).'</button>';
	}
  }else{
		echo "<div class='elemento panelDerecho' style='min-width:150px !important;' onClick='datos(this.title)' title='null-".$lista."'>";
		echo '<span>Nueva capa</span>';
		echo "</div>";
		echo "<div class='elemento panelIzquierdo' style='min-width:150px !important;' onClick='addSubmenu()'>";
		echo '<span>Nuevo submenu</span>';
		echo "</div>";
  }
?>
<script>
<?php echo "var layersBol = '$lista';"?>
if(layersBol == "layers"){
	$.extend($.expr[":"], {"containsNC": function(elem, i, match, array) {
		return (elem.textContent || elem.innerText || "").replace(/[ãáàäâÃÁÄÂ]/g,'a').replace(/[éèêÉÈÊ]/g,'e').replace(/[íìÍÌ]/g,'i').replace(/[óòôõÓÒÔÕ]/g,'o').replace(/[úùûÚÙÛ]/g,'u').replace(/[ç]/g,'c').toLowerCase().indexOf((match[3] || "").replace(/[ãáàäâÃÁÄÂ]/g,'a').replace(/[éèêÉÈÊ]/g,'e').replace(/[íìÍÌ]/g,'i').replace(/[óòôõÓÒÔÕ]/g,'o').replace(/[úùûÚÙÛ]/g,'u').replace(/[çÇ]/g,'c').toLowerCase()) >= 0;
	}});
	$("#filtroButton").remove();
	$("#filtro").keyup(function(){
		console.log($("#filtro").val());
		$(".menuFiltro").addClass("hidden");
		$(".menuFiltro").find("span:containsNC("+$("#filtro").val().toUpperCase()+")").parent().parent().removeClass("hidden");
	});
	$("#filtro").remove();
	$(function(){
		$('#Lista').after($('#Lista2'));
		//$("#Lista").remove();
		loadMenus();
	});
	
} else {
	$("#filtroButton").click(function(){
		   $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"<?php echo $_POST["lista"];?>",filtro:$("#filtro").val(),paisN:$("#paisN").val()});
		   $("#filtro").focus();
	});
}
function loadMenus(){
	console.log("load menus");
	$('#menus').load('MoFuSS/creaMenu.php',function(){
		var group = $("#menus").sortable({
			group: 'serialization',
			handle: 'button.glyphicon-move',
			delay: 500,
			onDrop: function ($item, container, _super) {
				var data = group.sortable("serialize").get();
				assignPriority(data[0]);
				var jsonString = JSON.stringify(data, null, ' ');
				$.ajax({
					url:"MoFuSS/menusPrioridadModel.php",
					data: {"data":jsonString,"option":1},
					type: "POST",
					dataType: "json",
					success: function(response){
						console.log(response);
					}
				});
				_super($item, container);
			}
		});
	});
}
function listaN(este){
   $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"<?php echo $_POST["lista"];?>",filtro:$("#filtro").val(),nL:$(este).attr("title")});
}
<?php
	if($lista=="country"){
		echo "datos('1-country');";	
	}
?>
</script>
<div class="row" id='Lista2'>
	<div class="col-md-12">
		<ol id="menus" class="simple_with_animation vertical">
		</ol>
	</div>	
</div>
