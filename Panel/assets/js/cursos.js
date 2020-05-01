function abrirAgregar(){
   $("#newInstructors").load("/panel/calendar/instructors_form.php");
                $("#referenciasForm").load("/panel/calendar/references.php");
$("#areasForm").load("/panel/calendar/areas.php");
    $("#newInstructors").slideDown();
    $("#Instructors").slideUp();
}
function cerrarAgregar(){
    $("#newInstructors").slideUp();
    $("#Instructors").slideDown();
}
	  function ConfirmSave()
	  {

          var flag=true;
      flag=flag*vacio("nombre");
      flag=flag*vacio("inicio");
      flag=flag*vacio("lugar");
      flag=flag*vacio("direccion");
      flag=flag*vacio("final");
      if(flag){
	  			swal({   title: "Se guardara la informacion de este curso!",   
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
        swal("Curso Guardado!", "Este curso se guardado correctamente", "success");   
        $('#save').trigger('click');
        return true;
        } 
        else {     
            swal("No se guardaron los datos", "", "error");   
            return false;
            }
            return false;
             });
	  }
  }
	  function ConfirmDelete(title)
	  {
	  			swal({   title: "Este curso se eliminara",   
    text: "¿Estas seguro de proceder?",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Si, elimina el curso",   
    cancelButtonText: "No",   
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    function(isConfirm){   
        if (isConfirm) 
    {   
        swal("Curso Eliminado", "Este curso se elimino", "error");   
        $('#btnDelete').trigger('click');
        return true;
        } 
        else {     
            swal("Ok", "Este evento no se elimino", "success");   
            return false;
            }
            return false;
             });
	  }
        function Confirmacion(elemento, funcion, id, opcion)
    {
          swal({   title: "Este "+elemento+" se eliminara",   
    text: "¿Estas seguro de proceder?",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Si, elimina el "+elemento,   
    cancelButtonText: "No",   
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    function(isConfirm){   
        if (isConfirm) 
    {   
        swal(elemento+" Eliminado", "Este "+elemento+" se elimino", "error");   
        funcion(id,opcion,true);
        } 
        else {     
            swal("Ok", "Este "+elemento+" no se elimino", "success");   
            }
            return false;
             });
    }

                                function readCurso(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
                function readInstructor(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#'+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
                    function clickcaja(e) {
    var lista = $(this).find("ul"),
        triangulo = $(this).find("span:last-child");
    e.preventDefault();
    //lista.is(":hidden") ? $(this).find("ul").show() : $(this).find("ul").hide();
  $(this).find("ul").toggle();
    if(lista.is(":hidden")) {
        triangulo.removeClass("triangulosup").addClass("trianguloinf");
    }
    else {
        triangulo.removeClass("trianguloinf").addClass("triangulosup");
    }
}
function clickli(e) {
    var texto = $(this).text(),
        seleccionado = $(this).parent().prev(),
        lista = $(this).closest("ul"),
        triangulo = $(this).parent().next();
    e.preventDefault();
    e.stopPropagation();
    $(".seleccionado").html("<a><i class='"+texto+"'></i>"+texto+"</a>");
    lista.hide();
    triangulo.removeClass("triangulosup").addClass("trianguloinf");
}

function openbox2(formtitle,id,comment,hr_start,hr_end, fadin)
{
    var btitle = document.getElementById('boxtitle');
  btitle.innerHTML = formtitle;
    
  $("#descripcionSchedule").attr('value',comment);
  $("#idSchedule").attr("value",id);
  $("#deleteSchedule").attr("title",id);
  if(id=="" || id=="null")
  $("#deleteSchedule").addClass("hide");
else
  $("#deleteSchedule").removeClass("hide");
var m=moment(hr_start).zone("-0600");
  var fin=moment(hr_end).zone("-0600")-moment(hr_start).zone("-0600");
  var day=parseInt(moment(fin).format("DD"));
          var horas=parseInt(moment(fin).format("HH"));
          var minutos=parseInt(moment(fin).format("mm"));
  var icono="";
      var mi=0;
    var h=23;
    if(minutos==0 && horas>=1){
      horas--;
      minutos=60;
    }
   for(var x=0;x<=23;x++){
    if(horas<x)
      $("#duracionHr option[value=" + x + "]").prop('disabled', true).prop("class", "hide");
    else{
      $("#duracionHr option[value=" + x + "]").prop('disabled', false)/*.prop('selected', true)*/.removeClass("hide");
      h=x;
    }
  }
  for(var x=0;x<=60;x=x+5){
    if(minutos<x)
      $("#duracionM option[value=" + x + "]").prop('disabled', true).prop("class", "hide");
    else{
      $("#duracionM option[value=" + x + "]").prop('disabled', false)/*.prop('selected', true)*/.removeClass("hide");
      mi=x;
    } 
  }

  if(h==0){
    $( "#Mslider" ).slider( "option", "max", (mi/5)+1 );
    $( "#Hrslider" ).slider( "option", "max", 0 ); 
    $('#Hrslider').slider( "option", "value", h);
    $('#Mslider').slider( "option", "value", (mi/5)+1);
  }
  else{
    if(mi==0){
    $( "#Mslider" ).slider( "option", "max", (60/5) );
    $( "#Hrslider" ).slider( "option", "max", h ); 
    $('#Hrslider').slider( "option", "value", h);
    $('#Mslider').slider( "option", "value", (mi/5)+1);
    }
    else{
    $( "#Mslider" ).slider( "option", "max", (mi/5)+1 );
    $( "#Hrslider" ).slider( "option", "max", h+1 ); 
    $('#Hrslider').slider( "option", "value", h+1);
    $('#Mslider').slider( "option", "value", (mi/5)+1);
    }
  }
   
  


  
  $("#duracionHr").val(horas);
  $("#duracionM").val(minutos);
    
  $("#hr_start").attr("value",m.zone("-0000").format('YYYY-MM-DD HH:mm:00'));
  $('#datetimepicker8').datetimepicker({value:m.zone("-0000").format('YYYY/MM/DD H:m'),step:5});
  $('#datetimepicker8').datetimepicker({minDate:m.zone("-0000").format('YYYY/MM/DD')});
  $.ajax({
                        data: {
                          "opcion": 5,
                          "id" : id
                        },
                        type: "POST",
                        dataType: "json",
                        url: "/panel/calendar/schedulesModel.php",
                      })
                      .done(function( respuesta ) {
                        if(respuesta.icono!="")
                        $("#iconoSchedule").find("a").html('<i class="'+respuesta.icono+'"></i>'+respuesta.icono);
                      })
                      .fail(function( jqXHR, textStatus, errorThrown ) {
                      }); 
          
 
    var box = document.getElementById('box'); 
  document.getElementById('shadowing').style.display='block';


  
  
  if(fadin)
  {
   gradient("box", 0);
   fadein("box");
  }
  else
  {   
    box.style.display='block';
  }   
}
function openbox(formtitle,fadin)
{
  var box = document.getElementById('box'); 
  document.getElementById('shadowing').style.display='block';

  var btitle = document.getElementById('boxtitle');
  btitle.innerHTML = formtitle;
  $("#deleteSchedule").attr("title","");
  $("#deleteSchedule").addClass("hide");
  $("#duracionHr").val(0);
  $("#duracionM").val(0);
  $("#descripcionSchedule").attr('value','');
  if(fadin)
  {
   gradient("box", 0);
   fadein("box");
  }
  else
  {   
    box.style.display='block';
  }   
}
  function vacio(id){
    var cadena=$("#"+id).val();
    cadena=cadena.split(/\n/).join('');
    cadena=cadena.split(/\s/).join('');
    cadena=cadena.split(/\t/).join('');
    if(cadena==""){
        $("#"+id).css({"color": "red", "border": "solid 1px red"});
        $("#"+id).on("focus",function(){
        $("#"+id).css({"color": "#555", "border": "solid 1px #555"});
    });
      return false;
  }
    else
      return true;
  }