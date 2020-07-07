<?php if (!Auth::userCan('manage_MoFuSS')) page_restricted(); 
?>

<?php echo View::make('admin.header')->render();;?>
  <link href="/jqueryTheme/jquery-ui.css" rel="stylesheet">
  <script src="/jqueryTheme/external/jquery/jquery.js"></script>
<script src="/jqueryTheme/jquery-ui.js"></script>
<h2 class="page-header">MoFuSS</h2>
<div class="row"> 
<div class="col-md-6">
    <div class="form-group">
     <h3>Seccion a Modificar:</h3>
    <select id="seccion" class="form-control">
    <option>Alcances</option>
    <option>Amigos</option>
    <option>Asesoramientos</option>
    <option>Investigaciones</option>
    <option>Personas</option>
    <option>Publicaciones</option>
</select>
</div>
<div id="Lista" class="separador">
</div>
</div>
<div class="col-md-6">
<div id="Contenidos">
</div>
</div>   
</div>
<?php echo View::make('admin.footer')->render() ?>
<?php include "../../../host.php"; ?>
<script>
function datos(id){
    var arr=id.split("-");
    if(arr[0]=="null"){
	$("#Contenidos").load(<?php echo $host; ?>+"MoFuSS/"+arr[1]+".php");
    }
    else{
	    $("#Lista").load(<?php echo $host; ?>+"MoFuSS/Lista.php",{lista:arr[1]},function(){

        $("#"+id).find( "p" ).css({
                "background": "#52accc",
    "color": "white",
    "border-bottom": "solid 2px white"
        });
    });
	    $("#Contenidos").load(<?php echo $host; ?>+"MoFuSS/"+arr[1]+".php",{id:arr[0]});
    }
}
$(document).ready(function(){
    $("#Contenidos").load(<?php echo $host; ?>+"MoFuSS/Alcances.php");
    $("#Lista").load(<?php echo $host; ?>+"MoFuSS/Lista.php",{lista:"Alcances"});
$("#seccion").on("change", function(){
    var x=$("#seccion").val();
    $("#Contenidos").load(<?php echo $host; ?>+"MoFuSS/"+x+".php");
    $("#Lista").load(<?php echo $host; ?>+"MoFuSS/Lista.php",{lista:x});
});    
});
  function vacio(id){
    var cadena=$("#"+id).val();
    console.log(cadena);
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
</script>
<style>
select {
    background: #52accc !important;
    color: white !important;
}
select:hover {
 background: white !important;
    color: #52accc !important; 
    cursor: pointer;  
}
select:hover {
    cursor: pointer;  
}
</style>
<link href="<?php echo asset_url('css/vendor/imgpicker.css') ?>" rel="stylesheet">
<link href="<?php echo asset_url('js/vendor/jquery.datetimepicker.min.css') ?>" rel="stylesheet">
<script src="<?php echo asset_url('js/vendor/moment.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/jquery.datetimepicker.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/jquery.datetimepicker.full.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/jquery.Jcrop.min.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/jquery.imgpicker.js') ?>"></script>
<script src="<?php echo asset_url('js/sweetalert.min.js') ?>"></script>
<script src="<?php echo asset_url('js/cursos.js') ?>"></script>
<link href="<?php echo asset_url('css/sweetalert.css') ?>" rel="stylesheet"/>
<link href="<?php echo asset_url('css/font-awesome.min.css') ?>" rel="stylesheet"/>
<link href="<?php echo asset_url('css/cursos.css') ?>" rel="stylesheet"/>
    <!-- Map JS -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="/panel/vendor/map/gmaps.min.js"></script>
    <script src="/panel/vendor/map/map.js"></script>
