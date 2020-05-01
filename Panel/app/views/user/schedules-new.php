<?php if (!Auth::userCan('manage_events')) page_restricted();


if(isset($_POST['submit']) && csrf_filter()) {

		
	$data = array(
    	'icon' => $_POST['icon'],
   
		'hr_start'     => $_POST['hr_start'],
		'hr_end'     => $_POST['hr_end'],
		'course'     => $_POST['course'],
		'comment'     => $_POST['comment'],
    );

	$rules = array(
    	'icon'     => 'required',
		'hr_start'     => 'required',
		'course'     => 'required',

		
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
			
			
			
			$new_course=DB::table('schedules')
        				->insertGetId(array('icon' => $_POST['icon'], 'hr_start' => $_POST['hr_start'], 'hr_end' => $_POST['hr_end'], 
					'course' => $_POST['course'], 'comment' => $_POST['comment']));
			redirect_to('?page=schedules-edit&id='.$new_course, array('course_created' => true));
			
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

<h3 class="page-header">Nuevo Horario</h3>
<p><a href="?page=schedules">Volver a Horario</a></p>
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
				Se ha Eliminado el Horario
			</div>
		<?php endif ?>

      <form action="?page=schedules-new" method="POST">
        <?php csrf_input();
          $cursos = DB::select(' SELECT name, id FROM cursos');
          ?>
          <div class="form-group">
              <label for="course">Curso:<em><?php _e('admin.required') ?></em></label>
              <select name="course" id="course" value="" class="form-control">
          <?php
          foreach ($cursos as $curso) {
  echo '<option value="'.$curso->id.'">'.$curso->name.'</option>';
}
  ?>
</select>
</div>

          <div class='col-md-5'>
              <div class="form-group">
                  <label for="hr_start">Fecha y hora de inicio:<em><?php _e('admin.required') ?></em></label>
                  <input type='text' class="form-controls hide" name="hr_start" id="hr_start" value="<?php if(!empty($_POST['hr_start'])) 
                      echo $_POST['hr_start']; 
                      ?>"/>
                  <div class='input-group date' id='datetimepicker6'>
                      
                      <input type='text' class="form-control" id="hr_start_timePicker" value="<?php if(!empty($_POST['hr_start'])) 
                      echo $_POST['hr_start']; 
                      ?>"/>
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
              </div>
          </div>
          <div class='col-md-5'>
              <div class="form-group">
                  <label for="hr_end">Fecha y hora de término:</label>
                  <input type='text' class="form-control hide" name="hr_end" id="hr_end" value="<?php if(!empty($_POST['hr_end'])) 
                      echo $_POST['hr_end']; 
                      ?>"/>
                  <div class='input-group date' id='datetimepicker7'>
                      
                      <input type='text' class="form-control" id="hr_end_timePicker" value="<?php if(!empty($_POST['hr_end'])) 
                      echo $_POST['hr_end']; 
                      ?>"/>
                      <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
              </div>
          </div>
  
                <div class="form-group">
              <label for="icon">Icono del Horario: <em><?php _e('admin.required') ?></em></label>
             <select name="icon" id="icon" value="" class="form-control">
  <option value="fa fa-clock-o">fa fa-clock-o</option>
  <option value="fa fa-user">fa fa-user</option>
</select>

          </div>
          

          
          <div class="form-group">
              <label for="comment">Descripción </label>
              <textarea name="comment" id="comment" class="form-control"><?php if(!empty($_POST['comment'])) echo $_POST['comment']; 
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
	</div>
</div>

<link href="<?php echo asset_url('css/vendor/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">
<script src="<?php echo asset_url('js/vendor/moment.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/bootstrap-datetimepicker.js') ?>"></script>
<script src="<?php echo asset_url('js/sweetalert.min.js') ?>"></script>
<link href="<?php echo asset_url('css/sweetalert.css') ?>" rel="stylesheet"/>
<script type="text/javascript">

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
	
			var m = moment($('#hr_start_timePicker').val(), 'DD-MM-YYYY hh:mm A'); 
			$('#hr_start').val(m.format("YYYY-MM-DD HH:mm:00"));
			
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);

			var m = moment($('#hr_end_timePicker').val(), 'DD-MM-YYYY hh:mm A'); 
			$('#hr_end').val(m.format("YYYY-MM-DD HH:mm:00"));
        });
    });
</script>




<?php echo View::make('admin.footer')->render() ?>