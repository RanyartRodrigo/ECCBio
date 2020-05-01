<?php
	include '../base.php';
	$obj=new Base("localhost","root","conabio3");
	if(isset($_POST['id'])){
		$result = $obj->consulta( "SELECT * FROM menus2 where id_Capa=".$_POST['id']);
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
			<label for="name">Tipo: </label>			  
			<?php
				$result = $obj->consulta("SELECT tipo FROM menus2 group by tipo");
				$numfilas = $result->num_rows;
				if($numfilas>0){
					echo "<select id='optipo'>";
					for($x=0;$x<$numfilas;$x++){
						$fila = $result->fetch_object();
						if(isset($edit->tipo)&&$fila->tipo==$edit->tipo){
							if($fila->tipo=="tiff")
								$tipoAux="Raster";
							else if($fila->tipo=="table")
								$tipoAux="Vectorial";
							else
								$tipoAux=$fila->tipo;
							echo "<option value='".$fila->tipo."' selected>".$tipoAux."</option>";
						}else{
							if($fila->tipo=="tiff")
								$tipoAux="Raster";
							else if($fila->tipo=="table")
								$tipoAux="Vectorial";
							else
								$tipoAux=$fila->tipo;
							echo "<option value='".$fila->tipo."' selected>".$tipoAux."</option>";
						}
					}
					echo "</select>";
				}
			?>
			<input type="text" name="name" id="tipoAux" value="<?php if(isset($edit->tipo)) echo $edit->tipo; else echo "Raster";?>" class="form-control">
			<input type="text" name="name" id="tipo" value="<?php if(isset($edit->tipo)) echo $edit->tipo; else echo "raster";?>" class="form-control hidden">
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
						if(isset($edit->unidad)&&$fila->unidad==$edit->unidad){
							echo "<option selected>".$fila->unidad."</option>";
						}else{
							echo "<option>".$fila->unidad."</option>";
						}
					}
					echo "</select>";
				}
			?>
			<input type="text" name="name" id="unidad" value="<?php if(isset($edit->unidad)) echo $edit->unidad?>" class="form-control">
		</div>
		<div class="form-group">
			<label for="name">Escala Logaritmica: </label>
				<?php 
					if(isset($edit->escalaLog)){
						if($edit->escalaLog) echo '<input type="checkbox" name="name" id="log"  class="form-control" checked>';
						else echo '<input type="checkbox" name="name" id="log"  class="form-control" >';
					}else echo '<input type="checkbox" name="name" id="log"  class="form-control" >';
				?>
		</div>
		<div class="form-group panelIzquierdo">
			<label for="name">Latitud: </label>
			<input type="number" name="name" id="latitud" value="<?php if(isset($edit->latitud)) echo $edit->latitud; else echo "23.24";?>" class="form-control">
		</div>
		<div class="form-group panelDerecho">
			<label for="name">Longitud: </label>
			<input type="number" name="name" id="longitud" value="<?php if(isset($edit->longitud)) echo $edit->longitud; else echo "-102.08";?>" class="form-control">
		</div>
		<div class="form-group">
			<label for="name">Paleta de colores de la capa: </label>
			<?php
				$result = $obj->consulta("SELECT idColumna, titulo FROM columnas order by columna ASC");
				$numfilas = $result->num_rows;
				$finalC="";
				if($numfilas>0){
					echo "<select id='opcolumna'>";
					for($x=0;$x<$numfilas;$x++){
						$fila = $result->fetch_object();
						if(isset($edit->id_Columna)&&$fila->idColumna==$edit->id_Columna){
							echo "<option value='".$fila->idColumna."' selected>".$fila->titulo."</option>";
							$finalC=$fila->titulo;		
						}else{
							echo "<option value='".$fila->idColumna."' >".$fila->titulo."</option>";
						}
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
			<input type="number" name="name" id="zoom" value="<?php if(isset($edit->zoom)) echo $edit->zoom; else echo "6";?>" class="form-control">
		</div>              
	</div>           
	<div class="form-group noSub  <?php if(isset($edit->sub))if($edit->sub==true) echo 'hidden'?>">
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
			echo '<button  onclick="EliminarAlcance()" title="1" class="btn btn-danger">Eliminar definitivamente</button>
				  <button  onclick="DuplicarAlcance()" title="1" class="btn btn-secundary">Duplicar Menu</button>';
	?>
</div>
<link rel="stylesheet" type="text/css" href="MoFuSS/application.css">
<script src="MoFuSS/jquery-sortable.js"></script>
<script>	
	function editSubmenu(idSubmenu, nombre){
		var name;
		name = prompt("Ingrese el nuevo nombre",nombre);
		name = name==null?"":name;
		if(name.trim()==""){
			alert("El nombre no puede quedar en blanco!");
			return;
		}
		$.ajax({
			url:"MoFuSS/menusPrioridadModel.php",
			data: {"name":name,"option":2,"idSubmenu":idSubmenu},
			type: "POST",
			dataType: "json",
			success: function(response){
				$("#sub"+idSubmenu).find("span").first().html(name);
			}
		});		
	}
	function addSubmenu(idPadre){		
		if(idPadre === undefined){
			idPadre = null;			
		}
		var name = prompt("Ingresa el nombre del nuevo submenu");
		if(name==null || (""+name).trim()==""){
			alert("El nombre es requerido");
			return;
		}
		description = "";		
		$.ajax({
			url:"MoFuSS/menusPrioridadModel.php",
			data: {"name":name,
					"description":description,
					"option":4,
					"idPadreSub":idPadre},
			type: "POST",
			dataType: "json",
			success: function(response){
				var idSubmenu = response["idSubmenu"];
				var padreSTR = "";
				if(idPadre == null){
					padreSTR = "menus";
				} else {
					padreSTR = "sub"+idPadre;
				}
				var strLi = "<li id='sub"+idSubmenu+"' data-prioridad='' data-name='"+name+"' data-id='sub"+idSubmenu+"'>";					
					strLi+= "<button class='btn glyphicon glyphicon-move'></button>";
					strLi+= "<span class='namDesc'>"+name+"</span>";
					strLi+= "<button title='Editar nombre' class='btn glyphicon glyphicon-pencil' onclick='editSubmenu(\""+idSubmenu+"\",\""+name+"\")'></button>";					
					strLi+= "<button title='Agregar submenu' class='btn glyphicon glyphicon-plus-sign' onclick='addSubmenu("+idSubmenu+")'></button>";
					strLi+= "<button title='Eliminar submenu' class='btn glyphicon glyphicon-minus-sign' onclick='removeSubmenu(\""+idSubmenu+"\")'></button>";
					strLi+=	"<button class='btn glyphicon glyphicon-triangle-bottom' data-toggle='collapse' data-target='#expsub"+idSubmenu+"' aria-expanded='true' aria-controls='#expsub"+idSubmenu+"'></button>";					
					strLi+= "<ol id='expsub"+idSubmenu+"' class='collapse' aria-labelledby='sub"+idSubmenu+"' data-parent='#sub"+idSubmenu+"'>";
					strLi+= "</ol></li>";
				$("#"+padreSTR).append(strLi);
			}
		});
	}
	function removeSubmenu(idSubmenu){
		var flag = confirm("Se borrarán todos los elementos contenidos, esta seguro de continuar?");
		if(!flag) return;
		$.ajax({
			url:"MoFuSS/menusPrioridadModel.php",
			data: {"option":5,"idSubmenu":idSubmenu},
			type: "POST",
			dataType: "json",
			success: function(response){
				console.log(response);
				$("#sub"+idSubmenu).remove();
			}
		});		
	}
	function assignPriority(data,offset){
		//console.log(data);
		if(offset === undefined)
			offset = 1;		
		for(var i = 0; i < data.length; i++){
			data[i].prioridad = i+offset;
			//console.log(data[i]);
			if(data[i].children !== undefined){
				assignPriority(data[i].children[0],data.length+1);
			}
		}
	}		
	function GuardarAlcance(){
		var flag=true;
		flag=flag*vacio("nombre");		
		flag=flag*vacio("latitud");
		flag=flag*vacio("longitud");		
		flag=flag*vacio("zoom");      
		flag=flag*vacio("tipo");
		if($("#log").is(':checked')) {  
            var log=1;  
        } else {  
            var log=0;  
        }  
		if($("#id_Columna").val()==""){
			var columna="null";
		}else{
			var columna=$("#id_Columna").val();
		}
		flag=flag*vacio("nombreEE");    
		if(flag){
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
					if (isConfirm){   
						swal("Capa Guardada!", "Esta Capa se guardado correctamente", "success");
						var id=$("#id").val();
                        $.ajax({
							data: {
							  "opcion": 1,
							  "nombre":$("#nombre").val(),
							  "latitud":$("#latitud").val(),
							  "longitud":$("#longitud").val(),
							  "id_Pais":1,
							  "descripcion":tinyMCE.activeEditor.getContent(),
							  "zoom":$("#zoom").val(),
							  "id_Columna":columna,
							  "nombreEE":$("#nombreEE").val(),
							  "nombreEE2":$("#nombreEE2").val(),
							  "unidad":$("#unidad").val(),
							  "tipo":$("#tipo").val(),
							  "log":log,
							  "id" : id
							},
							type: "POST",
							dataType: "json",
							url: "MoFuSS/menusModel.php"
						}).done(function( respuesta ) {
							if(id != "") return;
							id=respuesta.new;
							var nombre = $("#nombre").val();							
							var nuevaCapa = "<li class='menuFiltro' onclick='datos(this.title)' title='"+id+"-layers' style='color:red !important;' id='c"+id+"' data-prioridad='' data-name='"+nombre+"' data-id='"+id+"'>"
								nuevaCapa +="<button class='btn glyphicon glyphicon-move'></button>";
								nuevaCapa +="Capa-&gt;"+nombre;
								nuevaCapa +="<button title='Eliminar capa' class='btn glyphicon glyphicon-minus-sign' onclick='removeCapa("+id+")'></button></li>"
							$("#menus").append(nuevaCapa);
                        //$("#Lista").load(host+"MoFuSS/Lista.php",{lista:"layers"});
						}).fail(function( jqXHR, textStatus, errorThrown ) {
							if ( console && console.log ) {
								console.log( "La solicitud a fallado: " +  textStatus);
							}
						});        
						return true;
					}else {     
						swal("No se guardaron los datos", "", "error");   
						return false;
					}
					return false;
				});
		}
    }
	function DuplicarAlcance(){
		swal({title: "Esta Capa se duplicara",
			text: "¿Estas seguro de proceder?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Si, duplica el id_Pais",
			cancelButtonText: "No",
			closeOnConfirm: false,
			closeOnCancel: false },
			function(isConfirm){
				if (isConfirm){
					swal("layers Duplicado", "Este Capa se duplico", "success");
					var id=$("#id").val();
                    $.ajax({
						data: {
                          "opcion": 3,
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/menusModel.php",
					}).done(function( respuesta ) {
						id=respuesta.new;
						$("#Contenidos").load(host+"MoFuSS/layers.php",{id:id},function(){
							var nombre = $("#nombre").val();
							var descripcion = $("#descripcion").val();							
							var nuevaCapa = "<li class='menuFiltro' onclick='datos(this.title)' title='"+id+"-layers' style='color:red !important;' id='c"+id+"' data-prioridad='' data-name='"+nombre+"' data-id='"+id+"'>"
								nuevaCapa +="<button class='btn glyphicon glyphicon-move'></button>";
								nuevaCapa +="Capa-&gt;"+nombre;
								nuevaCapa +="<button title='Eliminar capa' class='btn glyphicon glyphicon-minus-sign' onclick='removeCapa("+id+")'></button></li>"
							$("#menus").append(nuevaCapa);
						});						
						//$("#Lista").load(host+"MoFuSS/Lista.php",{lista:"layers"});
					}).fail(function( jqXHR, textStatus, errorThrown ) {
						if ( console && console.log ) {
							console.log( "La solicitud a fallado: " +  textStatus);
						}
					});
					return true;
				}else {
					swal("Ok", "Esta Capa no se duplico", "error");
					return false;
				}
				return false;
			});
	}
    function EliminarAlcance(){
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
			if (isConfirm){   
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
				}).done(function( respuesta ) {
					$("#Contenidos").load(host+"MoFuSS/layers.php");
					$("#c"+id).remove();
					//$("#Lista").load(host+"MoFuSS/Lista.php",{lista:"layers"});
				}).fail(function( jqXHR, textStatus, errorThrown ) {
					if ( console && console.log ) {
						console.log( "La solicitud a fallado: " +  textStatus);
					}
				});
				return true;
			} else {     
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
	function removeCapa(idCapa){
		$("#Contenidos").load(host+"MoFuSS/layers.php",{id:idCapa},function(){			
			EliminarAlcance();
		});
	}
	$("#optipo").on("click",function(){
		$("#tipo").val($("#optipo").val());
		$("#tipoAux").val($("#optipo > option[value='"+$("#optipo").val()+"']").text());
	});
	$("#tipoAux").focusout(function(){
		var tipo=$("#tipoAux").val();
		if(tipo!="Vectorial" && tipo!="Raster")
			$("#tipo").val($("#tipoAux").val());
	});
	$("#opmenus").on("click",function(){
		$("#id_Pais").val($("#opmenus").val());
		$("#id_PaisAux").val($("#opmenus > option[value='"+$("#opmenus").val()+"']").text());
	});
	$("#opcolumna").on("click",function(){
		$("#id_Columna").val($("#opcolumna").val());
		$("#id_ColumnaAux").val($("#opcolumna > option[value='"+$("#opcolumna").val()+"']").text());
	});
    $("#opunidad").on("click",function(){
		$("#unidad").val($("#opunidad").val());
	});
	tinymce.init({ 
		selector:'textarea',
		plugins : 'autolink link lists preview table',
		removed_menuitems: 'newdocument',
		//language : 'es_MX'
	});
</script>
