<?php //if (!Auth::userCan('manage_courses')) page_restricted(); ?>

<?php echo View::make('admin.header')->render() ?>
<h3 class="page-header"><?php _e('admin.'.ucfirst($_GET['part']));?></h3>
  <link href="../jqueryTheme/jquery-ui.css" rel="stylesheet">
  <script src="../jqueryTheme/external/jquery/jquery.js"></script>
<script src="../jqueryTheme/jquery-ui.js"></script>
<script src="assets/js/host.js"></script>
<div class="row"> 
<div class="col-md-6">
<div id="Lista" class="separador">
</div>
</div>
<div class="col-md-6">
<div id="Contenidos">
</div>
</div>   
</div>
<?php echo View::make('admin.footer')->render();?>
<script>
function datos(id){
    $('html,body').animate({
        scrollTop: $("#Contenidos").offset().top-50},
        'slow');
    var arr=id.split("-");
    if(arr[0]=="null"){
		$("#Contenidos").load(host+"MoFuSS/"+arr[1]+".php",{pais:<?php echo Auth::user()->country?>},function(){
			tinymce.remove();
			setTimeout(function(){
				console.log("Loading again tinymce..");				
				tinymce.init({
					selector:'textarea',
					plugins : 'autolink link lists preview table',
					removed_menuitems: 'newdocument',
					//language : 'es'
				});				
			},0);
		});
	}else{
		$(".elemento>p").removeClass("elementoSeleccionado");
		$("#"+id).find("p").addClass("elementoSeleccionado");
        $("#Contenidos").load(host+"MoFuSS/"+arr[1]+".php",{id:arr[0],pais:<?php echo Auth::user()->country?>},function(){
			tinymce.remove();
			setTimeout(function(){
				console.log("Loading again tinymce..");				
				tinymce.init({
					selector:'textarea',
					plugins : 'autolink link lists preview table',
					removed_menuitems: 'newdocument',
					//language : 'es'
				});				
			},0);
		});
    }
}
$(document).ready(function(){
    $("#Contenidos").load(host+"MoFuSS/<?php echo $_GET['part'];?>.php",{pais:1});
    $("#Lista").load(host+"MoFuSS/Lista.php",{lista:"<?php echo $_GET['part'];?>",pais:1});
$("#seccion").on("change", function(){
    var x="<?php echo $_GET['part'];?>";
    $("#Contenidos").load(host+"MoFuSS/"+x+".php",{pais:1});
    $("#Lista").load(host+"MoFuSS/Lista.php",{lista:x});
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
<link href="<?php echo asset_url('css/cursos.php') ?>" rel="stylesheet"/>
    <!-- Map JS -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="vendor/map/gmaps.min.js"></script>
    <script src="vendor/map/map.js"></script>
