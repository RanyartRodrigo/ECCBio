function MySlide(id, height){
var intervalo;
var c=100/$(".contenido").length;
$(".contenido").each(function(){
$(this).attr("style",$(this).attr("style")+";width:"+c+"%;");
});
}
