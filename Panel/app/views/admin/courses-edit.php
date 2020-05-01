<?php if (!Auth::userCan('manage_courses')) page_restricted();

if (empty($_GET['id']) || !is_numeric($_GET['id']) ) {
	redirect_to('?page=courses');
}

$event= DB::table('cursos')
	->where('id', $_GET['id'])
	->first();


						
if(empty($event)) 
{ 
	redirect_to('?page=courses'); 
}
	
if(isset($_POST['delete'])){
	
	DB::table('cursos')->where('id', '=', $_GET['id'])->delete();
    DB::table('curso_instructor')->where('id_curso', '=', $_GET['id'])->delete();
    DB::table('horarios')->where('curso', '=', $_GET['id'])->delete();
	   $img=$_GET['id'];

$result =DB::select("select id, nombre from galeria_cursos where id_curso='".$img."'");
     $target_path = "uploads/cursos/galeria/";
     foreach ($result as $singleevent){
        echo $singleevent->id;
        $id=$singleevent->id;
        DB::table('galeria_cursos')->where('id','=',$id)->delete();
        $target_path = $target_path . $singleevent->nombre; 
     unlink($target_path);
     }
    redirect_to('?page=courses-new', array('event_deleted' => true));

}elseif(isset($_POST['submit']) && csrf_filter()) {

		
	$data = array(
    	'nombre' => $_POST['nombre'],   
		'inicio'     => $_POST['inicio'],
		'final'     => $_POST['final'],
		'lugar'     => $_POST['lugar'],
        'direccion'     => $_POST['direccion'],
        'img'     => $_FILES['imgInp2']['name'],
		'descripcion'     => $_POST['descripcion'],
        'color'     => $_POST['color']
    );

	$rules = array(
    	'nombre'     => 'required',
		'inicio'     => 'required',
		'lugar'     => 'required',

		
    );


    foreach (UserFields::all('admin') as $key => $field) {
    	if (!empty($field['validation'])) {
    		$data[$key] = @$_POST[$key];
    		$rules[$key] = $field['validation'];
    	}
    }
	
	$validator = Validator::make($data, $rules);

	if ($validator->passes()) 
	{	
		$event->nombre = $_POST['nombre'];
		$event->inicio= $_POST['inicio'];
		$event->final= $_POST['final'];
        $event->direccion  = $_POST['direccion'];
        $event->img = $_GET['id'].'.'.pathinfo($_FILES['imgInp2']['name'], PATHINFO_EXTENSION);
		$event->lugar=$_POST['lugar'];
		$event->descripcion=$_POST['descripcion'];
        $event->color=$_POST['color'];
        $flag=false;
/*
		if ($researcharea->save()) {
			*/
			if ($_FILES['imgInp2']['size'] != 0){
			$target_path = "uploads/cursos/";
$target_path = $target_path . $_GET['id'].'.'.pathinfo($_FILES['imgInp2']['name'], PATHINFO_EXTENSION); 
move_uploaded_file($_FILES['imgInp2']['tmp_name'], 
    $target_path);
$flag=true;
    } 

			if($flag){
			DB::table('cursos')
        	->where('id', '=', $_GET['id'])
        	->update(array('nombre' => $event->nombre, 'inicio' => $event->inicio, 'final' => $event->final, 
			'lugar' => $event->lugar,'direccion' => $event->direccion,'color' => $event->color,'img' => $event->img, 'descripcion' => $event->descripcion));
        }
        else{

        DB::table('cursos')
            ->where('id', '=', $_GET['id'])
            ->update(array('nombre' => $event->nombre, 'inicio' => $event->inicio, 'final' => $event->final, 
            'lugar' => $event->lugar,'direccion' => $event->direccion,'color' => $event->color, 'descripcion' => $event->descripcion));    
        }

			
						
			redirect_to('?page=courses-edit&id='.$event->id, array('event_updated' => true));
			
		/*
		} else {
			$errors = new Hazzard\Support\MessageBag(array('error' => trans('errors.dbsave')));
		}
		*/
	} else {
		$errors = $validator->errors();
	}
}
?>

<?php echo View::make('admin.header')->render() ?>
	<link href="../jqueryTheme/jquery-ui.css" rel="stylesheet">
	<script src="../jqueryTheme/external/jquery/jquery.js"></script>
<script src="../jqueryTheme/jquery-ui.js"></script>
<h3 class="page-header">Editar Curso</h3>
<p><a href="?page=courses">Volver a Cursos</a></p>
<br ><br >
<div class="row">
	<div class="col-md-6">

		<?php if (isset($errors)) {
			echo '<div class="alert alert-danger alert-dismissible"><span class="close" data-dismiss="alert">&times;</span><ul>';
			foreach ($errors->all('<li>:message</li>') as $error) {
			   echo $error;
			}
			echo '</ul></div>';
		} ?>
		
		<?php if (Session::has('event_updated')): Session::deleteFlash(); ?>
			<div class="alert alert-success alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				Se ha Actualizado el Curso
			</div>
		<?php endif ?>
        <?php if (Session::has('event_created')): Session::deleteFlash(); ?>
			<div class="alert alert-success alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				Se ha Creado el Curso
			</div>
		<?php endif ?>

		<?php if ($event): ?>
        <div class="checks">
			<form enctype="multipart/form-data" action="?page=courses-edit&id=<?php echo $event->id ?>" method="POST">
				<?php csrf_input();
				
				?>
                <h4 class="tituloCurso">Curso <?php if(!empty($_POST['nombre'])) 
                    echo $_POST['nombre']; 
                    else echo $event->nombre; ?></h4>
                    <input type="text" name="id" id="id" value="<?php if(!empty($_GET['id'])) 
                    echo $_GET['id']; 
                    else echo $event->id; ?>" class="form-control hidden">
				<div class="form-group">
			        <label for="nombre">Título del Curso: <em><?php _e('admin.required') ?></em></label>
			        <input type="text" name="nombre" id="nombre" value="<?php if(!empty($_POST['nombre'])) 
					echo $_POST['nombre']; 
					else echo $event->nombre; ?>" class="form-control">
			    </div>

		
                <div class='form-group'>
                    <div class="panelIzquierdo">
                  <div class="fileUpload btn form-control">
                    <span>Imagen</span>
<input type="file" class="upload" name="imgInp2" id="imgInp2" />
                  </div>
                </div>
                <div class="panelDerecho">
                    <?php 
                    if(file_exists('uploads/cursos/'.$event->img) &&  $event->img!="") 
                        echo '<img id="blah2" src="uploads/cursos/'.$event->img.'" alt="your image" />' ; 
                    else 
                        echo '<img id="blah2" src="assets/img/unam.png" alt="your image" />';
                        
                    ?>
                        
                </div>
                </div>        


                <div  class="form-group">
                    <div class="form-group">
                    	<label for="inicio">Fecha y hora de inicio:<em><?php _e('admin.required') ?></em></label>
                        <input type='text' class="form-controls hide" name="inicio" id="inicio" value="<?php if(!empty($_POST['inicio'])) 
							echo $_POST['inicio']; 
							else echo $event->inicio; ?>"/>
                        <div class='input-group date'>
                        	
                            <input type='text' class="form-control" id="datetimepicker6"/>
                           </div>
                    </div>
                </div>
                <div  class="form-group">
                    <div class="form-group">
                    	<label for="final">Fecha y hora de término:</label>
                        <input type='text' class="form-control hide" name="final" id="final" value="<?php if(!empty($_POST['final'])) 
							echo $_POST['final']; 
							else echo $event->final; ?>"/>
                        <div class='input-group date'>
                        	
                            <input type='text' class="form-control" id="datetimepicker7" />
                            
                        </div>
                    </div>
                </div>
        
			    <div class="form-group">
			        <label for="lugar">Lugar:<em><?php _e('admin.required') ?></em></label>
			        <input type="text" name="lugar" class="form-control" id="lugar" value="<?php if(!empty($_POST['lugar'])) 
					echo $_POST['lugar']; 
					else echo $event->lugar; ?>" class="form-control"/>
			    </div>
                <div class="form-group">
                    <label for="direccion">Direccion:</label>
                    <input type="text" name="direccion" id="direccion" onBlur="cambiar()" value="<?php if(!empty($_POST['direccion'])) 
                    echo $_POST['direccion']; 
                    else echo $event->direccion; ?>" class="form-control"/>
                            <div id="map"></div> 

                </div>
                
                
                <div class="form-group">
                	<label for="descripcion">Descripción </label>
                    <textarea name="descripcion" id="descripcion" class="form-control"><?php if(!empty($_POST['descripcion'])) echo $_POST['descripcion']; 
					else echo $event->descripcion ?></textarea>
                </div>
                
                          <div class="form-group">
              <label for="color">Color </label>
              <input type="color" name="color" id="color" class="form-control" value=""/>
              <?php if(!empty($_POST['color'])) 
                    $color= $_POST['color']; 
                    else $color=$event->color; 
                    echo "<script>
                    document.getElementById('color').value = '".$color."';
                </script>";?>
          </div>  

                <div class="form-group">
                	<button type="submit" name="submit" class="btn btn-primary hide" id="save">Guardar Curso</button>
                    <button  type="submit" id="btnDelete" title="1" 
                    name="delete"  class="btn btn-danger hide" value="1">Eliminar definitivamente</button>
                </div>

           
			</form>
			<div class="form-group">
                	<button onClick="ConfirmSave()" class="btn btn-primary">Guardar Curso</button>
			<button  onclick="ConfirmDelete()" title="1" class="btn btn-danger">Eliminar definitivamente</button>
		</div>
    </div>

		<?php else: ?>
			<div class="alert alert-danger"><?php _e('errors.userid') ?></div>
		<?php endif ?>
	</div>
	<div class="col-md-6">
        <div class="form-group checks" id="Instructors">
	</div>
            <div class="form-group checks" id="newInstructors" style="display:none;">              
    </div>
                    <div id="areasForm" class="form-group checks" style="display:none;">
                </div>
                                <div id="referenciasForm" class="form-group checks"style="display:none;">
                </div>
                <div id="galeria" class="form-group checks">
</div>
</div>

                 <div class="form-group checks" id="Schedules">              
    </div>
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
    <script type="text/javascript" src="vendor/map/gmaps.min.js"></script>
    <script src="vendor/map/map.js"></script>
<script  rel="stylesheet"> 


	  $('.avatar-container').imgPicker({
		  url: '<?php echo App::url("ajax.php?action=eventimage&eventid=".$event->id) ?>',
		  messages: <?php echo json_encode(trans('imgpicker.js')) ?>,
		  aspectRatio: 1,
		  cropSuccess: function(img) {
			  $('.avatar-image').attr('src', img.url + '?'+new Date().getTime());
			  this.container.find('select').val('image');
		  }
	  });
				 
    $(function () {
    	var m = moment($('#inicio').val(), 'YYYY-MM-DD' ); 
        var m2 = moment($('#final').val(), 'YYYY-MM-DD' ); 
        $('#datetimepicker6').datetimepicker({value:m.format('YYYY/MM/DD H:i'),step:5});
        $('#datetimepicker7').datetimepicker({value:m2.format('YYYY/MM/DD H:i'),step:5});
        
        $('#datetimepicker6').datetimepicker({
     mask:'9999/19/39 29:59'

});
        $('#datetimepicker7').datetimepicker({
    mask:'9999/19/39 29:59'
});

        
        if($('#inicio').val()!=''){
            var m = moment($('#inicio').val(), 'YYYY-MM-DD' );
            $('#datetimepicker7').datetimepicker({minDate:m.format('YYYY/MM/DD')});  
        }
        if($('#final').val()!=''){
            var m2 = moment($('#final').val(), 'YYYY-MM-DD' ); 
            $('#datetimepicker6').datetimepicker({maxDate:m2.format('YYYY/MM/DD')});
            
        }
        
        $("#datetimepicker6").on("change", function (e) {
            var m = moment($("#datetimepicker6").val(), 'YYYY-MM-DD' );
            $("#inicio").attr('value',m.format('YYYY-MM-DD'));
            $('#datetimepicker7').datetimepicker({
                minDate:m.format('YYYY/MM/DD')
            }); 

            
        });
        $("#datetimepicker7").on("change", function (e) {
            var m2 = moment($("#datetimepicker7").val(), 'YYYY-MM-DD' ); 
            $("#final").attr('value',m2.format('YYYY-MM-DD'));
            $('#datetimepicker6').datetimepicker({
                maxDate:m2.format('YYYY/MM/DD')
            });
        });

        		$("#Schedules").load("calendar/demos/selectable.php",{course:$("#nombre").val()});
                $("#galeria").load("calendar/galeria.php",{course:$("#nombre").val()});

                $("#Instructors").load("calendar/instructors.php",{course:$("#nombre").val()});
                $("#newInstructors").load("calendar/instructors_form.php");
                $("#referenciasForm").load("calendar/references.php",{Instructor:$("#id").val()});
$("#areasForm").load("calendar/areas.php",{Instructor:$("#id").val()});

$("#imgInp2").change(function(){
    readCurso(this, "blah2");
});
$("#direccion").on("hover",muestraMap());        
    });
cambiar();

function muestraMap(){
    $("#map").attr("style","width:100%;height:300px");
}
function cambiar(){
  var position=$("#direccion").val();
  console.log();
                if(position==""){
                    GMaps.geolocate({
  success: function(positionA) {
    position="@"+positionA.coords.latitude+","+positionA.coords.longitude;
    $("#direccion").val(position);
  },
  error: function(error) {
    alert('Geolocation failed: '+error.message);
  },
  not_supported: function() {
    alert("Your browser does not support geolocation");
  },
  always: function() {
    muestraMap();
    cambiar();
  }
});
                    
                }
                else{
                var position2=position.split("@");
                if(position2[1]==undefined){
                    $("#direccion").val("").css({"border":"solid red 2px"});
                    cambiar();
                }
                else{
                var p=position2[1].split(",");
                if(!isNaN(p[0])){
                     var map = new GMaps({
                el: '#map',
                lat: p[0],
                lng:p[1],
                zoomControl : false, 
                zoomControlOpt: {
                style : 'SMALL',
                position: 'TOP_LEFT'
            },
            panControl : false,
            streetViewControl : false, 
            mapTypeControl: false,
            scrollwheel: false,
            overviewMapControl: false
        });
        map.addMarker({
                lat: p[0],
                lng:p[1],
            title: 'College of Science', 
        });}
        else{
            $("#direccion").val("").css({"border":"solid red 2px"});
                    cambiar();
        }
    }
}}

</script>




<?php echo View::make('admin.footer')->render() ?>