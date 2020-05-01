function traeDatosMenu() {
		$.ajax({
			url: 'http://www.mofuss.unam.mx/Mapps/Global/menuPlay.php',
			type: 'post',
			data: { "traeDatos": true, "id_Pais": idPaisGlobal, "db": home},
			dataType: 'json',
			success: function(data){
				console.log(data);
				$('#grupos').empty();
				$('#grupos').removeClass('grupo');
				var estructura = '', sTodos = '<div class="row labelTodos"><label class="labelSeleccionar">Seleccionar todos <input type="checkbox" id = "todos" value = "noValue" class="grupoCheck"/></label></div>', 
					btns = '<div class= "row"><div class="col-md-5"><input style="color:black; width:60%" type="number" step="10" min="1000" max="5000" value="1000">ms</div><div class="col-md-3"><button id="guardaCapas">Ready</button></div><div class="col-md-3"><button id ="cancelCapas">Cancel</button></div></div>',
					salirBtn = '<button id ="cancelCapas">Cancel<button>',
					esOp = '',
					salir  = '<button id = "salirCapas" type="button" class="btn btn-xs"><i class="fa fa-times" aria-hidden="true"></i></button><br>';
				for (var i = 0; i < data.menuGeneral.length; i++) {
					esOp = (data.menuGeneral[i].esOP == 'si')?data.menuGeneral[i].value:'noValue';
					donw = (data.menuGeneral[i].esOP == 'si')?"":"<i class='fa fa-angle-double-down'></i>";
					estructura += "<div class= 'row divColor' id = 'div"+data.menuGeneral[i].subMenu.split(' ').join('')+"'>";
					estructura += "<input type='checkbox' id ='menu-check-op"+data.menuGeneral[i].subMenu.split(' ').join('')+"'/ value = '"+esOp+"' class='grupoCheck'>";
					estructura += "<button data-toggle='collapse' data-target='#op"+data.menuGeneral[i].subMenu.split(' ').join('')+"' class = 'estiloMenu' >"+data.menuGeneral[i].subMenu+donw+"</button><br>";
					estructura += "<div id='op"+data.menuGeneral[i].subMenu.split(' ').join('')+"' class='espacio collapse'></div>";
					estructura += "</div>";
				}
				$('#grupos').append(salir, sTodos, estructura, btns);

				$('#grupos div[id^=op]').each(function(i, val){
					var id = $(this).attr('id'), idDiv = '#'+id;
					$.each(data.submenu, function(index, value){
						var subMenu = value['subMenu'].split(' ').join(''), sub = 'op'+subMenu;
						if(id == sub){
							var botonsub = "<div class = 'espacioSub'>";
							botonsub += "<input type='checkbox' id ='subMenu-check-esSub"+value['nombre'].split(' ').join('')+"' value = '"+value['id_Capa']+"' class='grupoCheckSubMenu'/>";
							botonsub +="<button data-toggle='collapse' data-target='#esSub"+value['nombre'].split(' ').join('')+"'class= 'estiloSubmenu'>"+value['nombre']+"<i class='fa fa-angle-down'></i></button><br>";
							botonsub +="<div class='espacio collapse' id = 'esSub"+value['nombre'].split(' ').join('')+"'></div>";
							botonsub += "</div>";
							$(idDiv).append(botonsub);
						}
					});
					$.each(data.restantes, function(index, value){
						var subMenu = value['subMenu'].split(' ').join(''), sub = 'op'+subMenu;
						if(id == sub){
							var lista ="<p id= 'p"+value['nombre'].split(' ').join('')+"' class='p'>";
								lista +=  "<input type='checkbox' id ='opCheck"+index+"' value = '"+value['id_Capa']+"' class='grupoCheck'/>";
								lista += value['nombre']+"</p>";
							$(idDiv).append(lista);
						}
					});
				});

				$('#grupos div[id^=esSub]').each(function(i, val){
					var id = $(this).attr('id'), idDiv = '#'+id;
					$.each(data.opSubMenu, function(index, value){
						var subMenu = value['subMenu'].split(' ').join(''), sub = 'esSub'+subMenu;
						if(id == sub){
							var lista = "<p id= 'p"+value['nombre'].split(' ').join('')+"' class = 'p'>"
								lista += "<input type='checkbox' id ='opSubCheck"+index+"' value = '"+value['id_Capa']+"' class='grupoCheckSubMenu'/>";
								lista += value['nombre']+"</p>";
							$(idDiv).append(lista);
						}
					});
				});
				$("#guardaCapas").click(function(){
					var ids = [];
					   $('#grupos input[type= "checkbox"]').each(function(i,v){
							var idC = '#'+v['id'];
							if( $(idC).is(':checked') &&  $(idC).val() != 'noValue')
								ids.push($(idC).val());
					});
					var tiempo = $("#tiempoSwitch").val();
					play(ids,tiempo);
					$("#grupos").addClass("hidden");
				});

				$("#grupos").on('click','input[type="checkbox"]', function(){
				var id= $(this).attr("id"), arreglo = id.split("-"), idCheck ="#"+id, isC = $(idCheck).is(':checked');
				switch(arreglo[0]) {
    					case 'menu':
    						var div = '#'+arreglo[2], elementos = div+' input[type="checkbox"]';
        					$(elementos).each(function(i,v){
        						var idC = '#'+v['id'];
        						(isC)?$(idC).prop('checked', true):$(idC).prop('checked', false);
        					});
        				break;
    					case 'subMenu':
    						var div = '#'+arreglo[2], elementos = div+' input[type="checkbox"]';
        					$(elementos).each(function(i,v){
        						var idC = '#'+v['id'];
        						(isC)?$(idC).prop('checked', true):$(idC).prop('checked', false);
        					});
        				break;
    					case 'todos':
    					$('#grupos input[type= "checkbox"]').each(function(i,v){
    						var idC = '#'+v['id'];
        					(isC)?$(idC).prop('checked', true):$(idC).prop('checked', false);
    					});
        				break;
				}
				});

					$('#salirCapas,#cancelCapas').on('click', function(){
						$("#grupos").addClass("hidden");
					});
					
			},      
			error: function(){	
				console.log('Error al generar menu para mostrar capas.');
                        }
		});

}
