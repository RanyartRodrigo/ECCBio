$("li").tooltip({
   show: {
     effect: "slideDown",
     delay: 250
   },
   hide: {
     effect: "explode",
     delay: 250
   },
   track: true
});
//menu();
function agregarCapa(idLi,idDiv,id,clase,title){
    var check = $('#'+idLi).find("input").is(':checked');
    console.log(idLi+""+check);
    if(!check){
        $('#'+idLi).addClass('active');
        $('#'+idLi).find("input").prop('checked', true);        
        $("#"+idDiv).html('<div class="capa" style="display: none;" id="'+idLi+idDiv+'"><div><i class="fa fa-circle"></i><p class="title">'+title+'</p><input type="button" onClick="eliminaCapa(\''+idLi+idDiv+'\',\''+idLi+'\')" value="X"/></div><div class="slideThree"><input type="checkbox" value="'+id+'" class="'+clase+'" id="slideThree'+idLi+idDiv+'" name="check" /><label for="slideThree'+idLi+idDiv+'"></label></div><input id="points'+id+'" name="points'+id+'" type="range" min="0" max="100" value="100"><output for="points'+id+'" name="pointsOutput">100</output></div>');
        $("#"+idDiv+" .capa").fadeIn();
    }else{
        $('#'+idLi).removeClass('active');
        $('#'+idLi).find("input").prop('checked', false);
        $("#"+idDiv+" .capa").fadeOut();
        $("#"+idDiv).html('');
    }
    $('#'+idLi).find("input").trigger("change");
    chequeo();
    $( ".slider" ).slider();    
}
function eliminaCapa(id,idLi){
    $("#"+id).fadeOut();
    $('#'+idLi).find("input").trigger("change");
    chequeo();
}
function chequeo(){
     var array=["primero","segundo","tercero", "cuarto","sexto","septimo","octavo","noveno"];
    for(var x=0;x<array.length;x++){
     if($("#"+array[x]+"> .capa").length==0)
        $("#"+array[x]).css("display","none");
     else
        $("#"+array[x]).css("display","block");  
    }
    if($("#capas .capa").length==0)
        $("#capas").css("display","none");
    else
        $("#capas").css("display","block");
    if($("#infoMap .capa").length==0)
        $("#infoMap").css("display","none");
    else
      $("#infoMap").css("display","block");    
}
$(document).ready(function(){
    $('.success-message').hide();
    $('.error-message').hide();
    $('#correo').click(function() {
        var form = $(this.title);
        var postdata = form.serialize();
        $.ajax({
            type: 'POST',
            url: 'assets/subscribe.php',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                if(json.valid == 0) {
                    alert();
                    $('.success-message').hide();
                    $('.error-message').hide();
                    $('.error-message').php(json.message);
                    $('.error-message').fadeIn();
                }
                else {
                    $('.error-message').hide();
                    $('.success-message').hide();
                    form.hide();
                    $('.success-message').php(json.message);
                    $('.success-message').fadeIn();
                }
            }
        });
    });

    
    
});
function cargarContenido(file,idLi){
    window.location.href=file;
}

function MapOf(place){
    window.location.href=place;
}
