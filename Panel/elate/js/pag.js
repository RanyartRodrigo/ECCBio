 function curso(este){
            var $form=$(document.createElement("form")).css({display:"none"}).attr("method","POST").attr("action",host+"curso.php");
            var $input=$(document.createElement("input")).attr("name","nombre").val(este.title);
            $form.append($input);
            $("body").append($form);
            $form.submit();
          }
        
    


$(document).ready(function(){
//cargarMenu("paises","",".Msecundario");	
if (typeof mapa != 'undefined')
menu("2");
});
function cargarContenido(file,este){
window.location.href=file;}

function MapOf(place){
window.location.href=place;
}
function cargarMenu(tabla, menu, div){
$.ajax({ 
    url : 'https://www.wegp.unam.mx/admin/Global/fabrica.php', 
dataType : 'jsonp', 
data: {
        t: tabla,
	seleccionado: menu,
        format: "json"
    },
type:"POST",
success: function(json) {
$(div).html("");
$(div).html(json);
} 
  }); 
}
