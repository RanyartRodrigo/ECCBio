<?php if (!Auth::userCan('manage_events')) page_restricted();


if(isset($_POST['submit']) && csrf_filter()) {

		
	$data = array(
    	'title' => $_POST['title'],
   
		'start_time'     => $_POST['start_time'],
		'end_time'     => $_POST['end_time'],
		'location'     => $_POST['location'],
		'description'     => $_POST['description'],
    );

	$rules = array(
    	'title'     => 'required',
		'start_time'     => 'required',
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
			
			
			
			$new_event=DB::table('events')
        				->insertGetId(array('title' => $_POST['title'], 'start_time' => $_POST['start_time'], 'end_time' => $_POST['end_time'], 
					'location' => $_POST['location'], 'description' => $_POST['description']));
			redirect_to('?page=events-edit&id='.$new_event, array('event_created' => true));
			
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

<h3 class="page-header">Nuevo Evento</h3>
<p><a href="?page=events">Volver a Eventos</a></p>
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
		
		<?php if (Session::has('event_deleted')): Session::deleteFlash(); ?>
			<div class="alert alert-info alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				Se ha Eliminado el Evento
			</div>
		<?php endif ?>

      <form action="?page=events-new" method="POST">
          <?php csrf_input();
          
          ?>
          <div class="form-group">
              <label for="title">Título del Evento: <em><?php _e('admin.required') ?></em></label>
              <input type="text" name="title" id="title" value="" class="form-control">
          </div>

  
  
          <div class='col-md-5'>
              <div class="form-group">
                  <label for="start_time">Fecha y hora de inicio:<em><?php _e('admin.required') ?></em></label>
                  <input type='text' class="form-controls hide" name="start_time" id="start_time" value="<?php if(!empty($_POST['start_time'])) 
                      echo $_POST['start_time']; 
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
                  <label for="end_time">Fecha y hora de término:</label>
                  <input type='text' class="form-control hide" name="end_time" id="end_time" value="<?php if(!empty($_POST['end_time'])) 
                      echo $_POST['end_time']; 
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
              <textarea name="description" id="description" class="form-control hide"><?php if(!empty($_POST['description'])) echo $_POST['description']; 
              ?></textarea>
              <textarea id="editorTA-description"></textarea>
          </div>
          
          
          <div class="form-group">
              <button type="submit" name="submit" class="btn btn-primary" id="save">Guardar Cambios</button>
          </div>
      </form>

	</div>

	<div class="col-md-6">
	</div>
</div>

<link href="<?php echo asset_url('css/vendor/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">
<script src="<?php echo asset_url('js/vendor/moment.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/bootstrap-datetimepicker.js') ?>"></script>
<script type="text/javascript">
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
			$('#start_time').val(m.format("YYYY-MM-DD HH:mm:00"));
			
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);

			var m = moment($('#end_timePicker').val(), 'DD-MM-YYYY hh:mm A'); 
			$('#end_time').val(m.format("YYYY-MM-DD HH:mm:00"));
        });
    });
</script>




<?php echo View::make('admin.footer')->render() ?>