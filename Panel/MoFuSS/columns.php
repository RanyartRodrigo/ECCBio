<script>
	var leyendaStrechEdit = '';
</script>
<?php
	if(isset($_POST['id'])){
		include '../base.php';
		include '../host2.php';
		$obj=new Base($DB_server,$DB_user,$DB_name);
		$result = $obj->consulta( "SELECT * FROM columnas where idColumna=".$_POST['id']);
		$numfilas = $result->num_rows;
		$fila = $result->fetch_object();
		$edit=$fila;
		echo "<script>
				leyendaStrechEdit = '{$edit->leyendaStrech}';
			</script>";
	}
	echo '<div><div class="form-group">';
	if(isset($edit->columna)) echo '<h4>"'.$edit->titulo.'" edit:</h4>'; else echo '<h4>Nuevo</h4>';
?>
	</div>
	<input type="text" name="id" id="id" value="<?php if(isset($edit->idColumna)) echo $edit->idColumna?>" class="form-control hidden">
	<div class="separador">
		<div class='panelIzquierdo'>			
			<div class="form-group">
				<label for="name">1.- Nombre de la paleta: </label>
				<input type="text" name="name" id="titulo" value="<?php if(isset($edit->titulo)) echo $edit->titulo?>" class="form-control">
			</div>			
			<div class="form-group">
				<label>2.- Tipo de mapa: </label>
				<select id="tipoMapa" name="tipoMapa" class="form-control">
					<option value="1" <?php if(isset($edit->tipoMapa) && $edit->tipoMapa == 1) echo "selected";?>>Raster</option>
					<option value="2" <?php if(isset($edit->tipoMapa) && $edit->tipoMapa == 2) echo "selected";?>>Vectorial</option>
				</select>
			</div>
			<div class="form-group">
				<label>3.- Tipo de valores: </label>
				<select id="tipoValores" name="tipoValores" class="form-control">
					<option value="1" <?php if(isset($edit->tipoValores) && $edit->tipoValores == 1) echo "selected";?>>Continuos</option>
					<option value="2" <?php if(isset($edit->tipoValores) && $edit->tipoValores == 2) echo "selected";?>>Por clases (categorias)</option>
				</select>
			</div>
			<div id="hideIfRaster" style="display:none;">
				<div class="form-group">
					<label for="name">Columnas a mostrar: </label>
					<input type="text" name="name" id="columna" value="<?php if(isset($edit->columna)) echo $edit->columna?>" class="form-control">
				</div>
				<div class="form-group">
					<label for="name">Columna de los rangos: </label>
					<input type="text" name="name" id="valorName" value="" class="form-control">
				</div>
				<div class="form-group">
					<label for="name">Condición extra: </label>
					<input type="text" name="name" id="valorFiltro" value="<?php if(isset($edit->valorFiltro) && $edit->valorFiltro!="NULL") echo $edit->valorFiltro?>" class="form-control">
				</div>
			</div>
			<button onClick="GuardarColumna()" class="btn btn-primary">Guardar Cambios</button>
			<?php
				if(isset($edit->idColumna))
					echo '<button  onclick="EliminarColumna()" title="1" class="btn btn-danger">Eliminar definitivamente</button>
				  <button  onclick="DuplicarColumna()" title="1" class="btn btn-secondary">Duplicar Registro</button>';
			?>
		</div>
		<div id="rasterContinuo" class='panelDerecho'>
			<div>
				<div class="form-group">
					<label>Límites</label>
				</div>
				<div class="form-group panelIzquierdo">
					<label>Mínimo</label>
					<input type="text" id="minRCon" value="0" class="form-control limitA">
				</div>
				<div class="form-group panelDerecho">
					<label>Máximo</label>
					<input type="text" id="maxRCon" value="0" class="form-control limitB">
				</div>
				<div class="form-group">
					<label>Leyenda strech</label>
				</div>
				<div class="form-group">					
					<input type="text" id="leyendaStrech1" class="form-control" onkeyup="updateVP('leyendaStrech1','labelLS1')">
				</div>
				<div class="form-group separador">
					<label>Vista previa:</label>
					<div id="strechRCon" style="background:black; width:140px;" class="form-control color"></div>
					<label>Invertir stretch: </label>
					<input type="checkbox" id="invertirStretch" onChange="invertStretch('partesRCon')">
					<label id="labelLS1"></label>
					<div id="rConPart1" class="partesRCon">
						<div class="form-group panelDerecho">
							<label>&nbsp;</label>
							<input type="button" name="name" onClick="addColor()" value="Agregar color" class="form-control">
						</div>
						<div  class="form-group panelIzquierdo">
							<label>Color 1</label>
							<input type="color" value="#000000" onChange="recalcularStrech('rasterContinuo','strechRCon')" class="form-control color">
						</div>
					</div>				
				</div>
			</div>
		</div>
		<div id="rasterCategorias" class='panelDerecho'>
			<div id="rCatPart1" class="partesRCat">
				<div class="form-group">
					<label>Categorías</label>
					<input type="button" name="name" onClick="addColorCat()" value="Agregar categoría" class="form-control">
				</div>				
				<div class="form-group panelIzquierdo">
					<label>Valor</label>
					<input type="text" value="1" class="form-control valorRCat">
				</div>
				<div class="form-group panelDerecho">
					<label>Descripción</label>
					<input type="text" class="form-control descRCat">
				</div>					
				<div class="separador">					
					<div  class="form-group">
						<label>Categoría 1</label>
						<input type="color" value="#000000" class="form-control color">
					</div>					
				</div>
			</div>
		</div>
		<div id="vectorialContinuo" class='panelDerecho'>
			<div class="form-group">
				<label>Tipo de dato vectorial</label>
				<select id="tipoDatoVS" class="form-control tipoP">
					<option value="polygonOptions">Polígonos</option>
					<option value="polylineOptions">Líneas</option>
					<option value="markerOptions">Puntos</option>
				</select>				
			</div>			
			<div id="tipoDatoV" class="form-group">
				<div class="form-group">
					<label>Leyenda strech</label>
				</div>
				<div class="form-group">					
					<input type="text" id="leyendaStrech2" class="form-control" onkeyup="updateVP('leyendaStrech2','labelLS2')">
				</div>
				<label>Vista previa: </label>
				<div id="strechVCon" style="background:black; width:140px;" class="form-control color"></div>
				<label id="labelLS2"></label>
				<div>
					<label>Color de la línea</label>
					<input id="colorLVCon" class="form-control" type="color" value="000000">
				</div>
			</div>
			<div class="form-group grosor">
				<label>Grosor de la línea</label>
				<input id="grosorLVCon" class="form-control" type="number" min="1" max="5" value="1">
			</div>
			<div id="vConPart1" class="partesVCon">
				<div class="form-group">
					<label>Rango 1</label>
					<input type="button" name="name" onClick="addColorV()" value="Agregar rango" class="form-control">
				</div>
				<div class="form-group panelIzquierdo">
					<label>Límite inferior</label>
					<input type="text" value="0" class="form-control lim1VCon">
				</div>
				<div class="form-group panelDerecho">
					<label>Límite superior</label>
					<input type="text" value="0" class="form-control lim2VCon">
				</div>					
				<div class="separador">					
					<div  class="form-group color">
						<label>Color 1</label>
						<input type="color" value="#000000" onChange="recalcularStrech('vectorialContinuo','strechVCon')" class="form-control"/>
					</div>
					<div class="form-group">
						<select class="icon hidden">
						</select>
					</div>
				</div>
			</div>
		</div>
		<div id="vectorialCategoria" class='panelDerecho'>
			<div class="form-group">
				<label>Tipo de dato vectorial</label>
				<select id="tipoDatoVCS" class="form-control tipoP">
					<option value="polygonOptions">Polígonos</option>
					<option value="polylineOptions">Líneas</option>
					<option value="markerOptions">Puntos</option>
				</select>				
			</div>
			<div id="tipoDatoVCat" class="form-group">				
				<div>
					<label>Color de la línea</label>
					<input id="colorLVCat" class="form-control" type="color" value="000000">
				</div>
			</div>
			<div class="form-group grosor">
				<label>Grosor de la línea</label>
				<input id="grosorLVCat" class="form-control" type="number" min="1" max="5" value="1">
			</div>
			<div id="vCatPart1" class="partesVCat">
				<div class="form-group">
					<label>Categoría 1</label>
					<input type="button" name="name" onClick="addColorVC()" value="Agregar categoría" class="form-control">
				</div>
				<div class="form-group panelIzquierdo">
					<label>Valor</label>
					<input type="text" value="1" class="form-control valorVCat">
				</div>
				<div class="form-group panelDerecho">
					<label>Descripción</label>
					<input type="text" value="" class="form-control descVCat">
				</div>					
				<div class="separador">					
					<div  class="form-group color">
						<label>Color 1</label>
						<input type="color" value="#000000" class="form-control"/>
					</div>
					<div class="form-group">
						<select class="icon hidden">
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group hidden">
			<label for="name">estilos: </label>
			<textarea name="name" id="estilos" class="form-control"><?php if(isset($edit->estilos)) echo $edit->estilos?></textarea>
		</div>
	</div>
<script src="MoFuSS/columns.js"></script>
<style>
	.panelDerecho > input[type="button"] {
		height: 34px;
	}
</style>
<div id="googleMap" style="width:100%;height:400px;"></div>
