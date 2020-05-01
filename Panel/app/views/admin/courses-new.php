<?php if (!Auth::userCan('manage_events')) page_restricted();


if(isset($_POST['submit']) && csrf_filter()) {

		
	$data = array(
    	'name' => $_POST['name'],
   
		'start'     => $_POST['start'],
		'end'     => $_POST['end'],
		'location'     => $_POST['location'],
    'venue'     => $_POST['venue'],
		'description'     => $_POST['description'],
    'color'     => $_POST['color']
    );

	$rules = array(
    	'name'     => 'required',
		'start'     => 'required',
		'location'     => 'required',

		
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
/*
		if ($researcharea->save()) {
			*/
			if ($_FILES['imgInp2']['size'] != 0){
			     $new_course=DB::table('cursos')
                ->insertGetId(array('nombre' => $_POST['name'], 'inicio' => $_POST['start'], 'final' => $_POST['end'], 
          'lugar' => $_POST['location'],'direccion' => $_POST['venue'],'color' => $_POST['color'], 'descripcion' => $_POST['description']));
                
			     $target_path = "uploads/cursos/";
$target_path = $target_path . $new_course.'.'.pathinfo($_FILES['imgInp2']['name'], PATHINFO_EXTENSION); 
move_uploaded_file($_FILES['imgInp2']['tmp_name'], 
    $target_path); 

DB::table('cursos')
          ->where('id', '=', $new_course)
          ->update(array('img' => $new_course.'.'.pathinfo($_FILES['imgInp2']['name'], PATHINFO_EXTENSION)));
        }

redirect_to('?page=courses-edit&id='.$new_course, array('course_created' => true));
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

<h3 class="page-header">Nuevo Curso</h3>
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
		
		<?php if (Session::has('course_deleted')): Session::deleteFlash(); ?>
			<div class="alert alert-info alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				Se ha Eliminado el Curso
			</div>
		<?php endif ?>

      <form action="?page=courses-new"  enctype="multipart/form-data" method="POST">
          <?php csrf_input();
          
          ?>
          <div class="form-group">
              <label for="name">Título del Curso: <em><?php _e('admin.required') ?></em></label>
              <input type="text" name="name" id="name" value="" class="form-control">
          </div>

                  <div class='form-group'>
                    <div class="panelIzquierdo">
                  <div class="fileUpload btn form-control">
                    <span>Imagen</span>
                    <input type="file" class="upload" id="imgInp2" name="imgInp2" />
                  </div>
                </div>
                <div class="panelDerecho">
                        <img id="blah2" src="assets/img/unam.png" alt="your image" />
                </div>
                </div>   
  
          <div class='col-md-5'>
              <div class="form-group">
                  <label for="start">Fecha y hora de inicio:<em><?php _e('admin.required') ?></em></label>
                  <input type='text' class="form-controls hide" name="start" id="start" value="<?php if(!empty($_POST['start'])) 
                      echo $_POST['start']; 
                      ?>"/>
                  <div class='input-group date' id='datetimepicker6'>
                      
                      <input type='text' class="form-control" id="start_timePicker"/>
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
              </div>
          </div>
          <div class='col-md-5'>
              <div class="form-group">
                  <label for="end">Fecha y hora de término:</label>
                  <input type='text' class="form-control hide" name="end" id="end" value="<?php if(!empty($_POST['end'])) 
                      echo $_POST['end']; 
                      ?>"/>
                  <div class='input-group date' id='datetimepicker7'>
                      
                      <input type='text' class="form-control" id="end_timePicker" />
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
              </div>
          </div>
  
          <div class="form-group">
              <label for="location">Lugar:<em><?php _e('admin.required') ?></em></label>
              <input type="text" name="location" id="location" value="<?php if(!empty($_POST['location'])) 
              echo $_POST['location']; 
               ?>" class="form-control">
          </div>
                          <div class="form-group">
                    <label for="venue">Direccion:</label>
                    <input type="text" name="venue" id="venue" onBlur="cambiar()"class="form-control"/>
                            <div id="map"></div> 

                </div>
          
          <div class="form-group">
              <label for="description">Descripción </label>
              <textarea name="description" id="description" class="form-control"><?php if(!empty($_POST['description'])) echo $_POST['description']; 
              ?></textarea>
          </div>
          <div class="form-group">
              <label for="color">Color </label>
              <input type="color" name="color" id="color" class="form-control" value="<?php if(!empty($_POST['color'])) echo $_POST['color']; 
              ?>"/>
          </div>          
          
          <div class="form-group">
              <button type="submit" name="submit" class="btn btn-primary hide" id="save">Guardar Cambios</button>
          </div>
      </form>
      <div class="form-group">
              <button onClick="ConfirmAdd()" class="btn btn-primary" >Guardar Cambios</button>
          </div>

	</div>

	<div class="col-md-6">
    </div>
	</div>
</div>

<link href="<?php echo asset_url('css/vendor/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">
<script src="<?php echo asset_url('js/vendor/moment.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/bootstrap-datetimepicker.js') ?>"></script>
<script src="<?php echo asset_url('js/sweetalert.min.js') ?>"></script>
<script src="<?php echo asset_url('js/cursos.js') ?>"></script>
<link href="<?php echo asset_url('css/sweetalert.css') ?>" rel="stylesheet"/>
<link href="<?php echo asset_url('css/cursos.css') ?>" rel="stylesheet"/>
    <!-- Map JS -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="vendor/map/gmaps.min.js"></script>
    <script src="vendor/map/map.js"></script>
<script type="text/javascript">

    function ConfirmAdd()
    {
      var flag=true;
      flag=flag*vacio("name");
      flag=flag*vacio("start");
      flag=flag*vacio("end");
      flag=flag*vacio("location");
      flag=flag*vacio("venue");
      if($("#imgInp2").val()=="")
      flag=false;
      if(flag)
          swal({   title: "Agregar Curso!",   
    text: "¿Estas seguro de seguir?",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Si, Agregar este Curso!",   
    cancelButtonText: "No!",   
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    function(isConfirm){   
        if (isConfirm) 
    {   
        swal("Curso Agregado!", "Este Curso se agrego correctamente!", "success");   
        $('#save').trigger('click');
        return true;
        } 
        else {     
            swal("Hurray", "Este curso no se agrego!", "error");   
            return false;
            }
            return false;
             });
    }
    $(function () {

        $('#datetimepicker6').datetimepicker({
			sideBySide: true,
			format: 'DD-MM-YYYY hh:mm A'

		});
        $('#datetimepicker7').datetimepicker({
            useCurrent: false, //Important! See issue #1075
			sideBySide: true,
			format: 'DD-MM-YYYY hh:mm A'
        });
		

		
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
	
			var m = moment($('#start_timePicker').val(), 'DD-MM-YYYY hh:mm A'); 
			$('#start').val(m.format("YYYY-MM-DD HH:mm:00"));
			
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);

			var m = moment($('#end_timePicker').val(), 'DD-MM-YYYY hh:mm A'); 
			$('#end').val(m.format("YYYY-MM-DD HH:mm:00"));
        });
                        $('#datetimepicker8').datetimepicker({
      sideBySide: true,
      format: 'DD-MM-YYYY hh:mm A'

    });

    
        $("#datetimepicker8").on("dp.change", function (e) {
  
      var m = moment($('#hr_start_timePicker').val(), 'DD-MM-YYYY hh:mm A'); 
      $('#hr_start').val(m.format("YYYY-MM-DD HH:mm:00"));
      
        });
        $("#imgInp2").change(function(){
    readCurso(this, "blah2");
});
                          

    });

$("#venue").on("hover",muestraMap());
function muestraMap(){
    $("#map").attr("style","width:100%;height:300px");
}
function cambiar(){
  var position=$("#venue").val();
                if(position==""){
                    GMaps.geolocate({
  success: function(positionA) {
    position="@"+positionA.coords.latitude+","+positionA.coords.longitude;
    $("#venue").val(position);
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
                    $("#venue").val("");
                    cambiar();
                }
                else{
                var p=position2[1].split(",");
                if(!isNaN(p[0]) && !isNaN(p[1])){
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
          $("#venue").val("").css({"border":"solid red 2px"});
                    cambiar();
        }
    }
}}

</script>




<?php echo View::make('admin.footer')->render() ?>