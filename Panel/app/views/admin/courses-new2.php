<?php if (!Auth::userCan('manage_events')) page_restricted();


if(isset($_POST['submit']) && csrf_filter()) {

		
	$data = array(
    	'name' => $_POST['name'],
   
		'start'     => $_POST['start'],
		'end'     => $_POST['end'],
		'location'     => $_POST['location'],
		'description'     => $_POST['description'],
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
			
			
			
			$new_course=DB::table('cursos')
        				->insertGetId(array('name' => $_POST['name'], 'start' => $_POST['start'], 'end' => $_POST['end'], 
					'location' => $_POST['location'], 'description' => $_POST['description']));
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
<style>
.panelIzquierdo {
    width: 48%;
    float: left;
    height: auto;
}
.panelDerecho {
    width: 48%;
    float: right;
}

.separador {
    width: 100%;
    height: 3px;
    float: left;
    background: #edb867;
    margin-bottom: 10px;
}
.elementos {
    float: left;
}
.btnEliminar {
    float: right;
    background: red;
    color: white;
    font-weight: bolder;
}
</style>
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

      <form action="?page=courses-new" method="POST">
          <?php csrf_input();
          
          ?>
          <div class="form-group">
              <label for="name">Título del Curso: <em><?php _e('admin.required') ?></em></label>
              <input type="text" name="name" id="name" value="" class="form-control">
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
              <label for="description">Descripción </label>
              <textarea name="description" id="description" class="form-control"><?php if(!empty($_POST['description'])) echo $_POST['description']; 
              ?></textarea>
          </div>
          
          
          <div class="form-group">
              <button type="submit" name="submit" class="btn btn-primary hide" id="save">Guardar Cambios</button>
          </div>
      </form>
      <div class="form-group">
              <button onClick="ConfirmSave()" class="btn btn-primary" >Guardar Cambios</button>
          </div>

	</div>

	<div class="col-md-6">
     <div class="form-group" id="Schedules">              
    </div>
     <div class="form-group">    
        <button onClick="AddActivity(1)" id="AddBtn" class="btn btn-primary" >Agregar Actividad</button>
        <button onClick="Limpiar()" class="btn btn-primary" >Limpiar</button>       
    </div>


	</div>
</div>

<link href="<?php echo asset_url('css/vendor/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">
<script src="<?php echo asset_url('js/vendor/moment.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/bootstrap-datetimepicker.js') ?>"></script>
<script src="<?php echo asset_url('js/sweetalert.min.js') ?>"></script>
<script src="<?php echo asset_url('js/jquery.barrating.js') ?>"></script>
<link href="<?php echo asset_url('css/sweetalert.css') ?>" rel="stylesheet"/>
<link href="<?php echo asset_url('css/style.css') ?>" rel="stylesheet"/>
<link href="<?php echo asset_url('css/bars-horizontal.css') ?>" rel="stylesheet"/>
<link href="<?php echo asset_url('css/examples.css') ?>" rel="stylesheet"/>
<script type="text/javascript">
function AddActivity(numero){
$('#Schedules').append('<div id="n'+numero+'" class="elementos"></div>');
$(".btnEliminar").remove();
$('#n'+numero).load("schedules_form.php?n="+numero);
numero++;
$("#AddBtn").attr('onClick','AddActivity('+numero+')');
}
function Limpiar(){
$('#Schedules').html("");
  var numero=1;
$("#AddBtn").attr('onClick','AddActivity('+numero+')');
}
function eliminarActividad(id){
$("#n"+id).remove();
  var numero=id;
  var numero2=id-1;
  $("#Activity_"+numero2).append('<button class="btnEliminar" onclick="eliminarActividad('+numero2+')">X</button>');
$("#AddBtn").attr('onClick','AddActivity('+numero+')');
}

    function ConfirmSave()
    {
          swal({   title: "This event will be deleted permanently!",   
    text: "Are you sure to proceed?",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Yes, Remove this event!",   
    cancelButtonText: "No, I am not sure!",   
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    function(isConfirm){   
        if (isConfirm) 
    {   
        swal("Event Removed!", "This event is removed permanently!", "success");   
        $('#save').trigger('click');
        return true;
        } 
        else {     
            swal("Hurray", "This event is not removed!", "error");   
            return false;
            }
            return false;
             });
    }
    $(function () {
              $('.example-1to10').barrating('show', {
            theme: 'bars-horizontal',
            reverse: true,
            hoverState: true
        });

        $('.example-movie').barrating('show', {
            theme: 'bars-horizontal',
            reverse: true,
            hoverState: true
        });

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
    });
</script>




<?php echo View::make('admin.footer')->render() ?>