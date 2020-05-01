<?php if (!Auth::userCan('manage_events')) page_restricted();

if (empty($_GET['id']) || !is_numeric($_GET['id']) ) {
	redirect_to('?page=events');
}

$event= DB::table('events')
	->where('id', $_GET['id'])
	->first();


						
if(empty($event)) 
{ 
	redirect_to('?page=events'); 
}
	
if(isset($_POST['delete'])){
	
	DB::table('events')->where('id', '=', $_GET['id'])->delete();
	
	redirect_to('?page=events-new', array('event_deleted' => true));

}elseif(isset($_POST['submit']) && csrf_filter()) {

		
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
	
		$event->title = $_POST['title'];
		$event->start_time= $_POST['start_time'];
		$event->end_time= $_POST['end_time'];
		$event->location=$_POST['location'];
		$event->description=$_POST['description'];
/*
		if ($researcharea->save()) {
			*/
			
			
			
			DB::table('events')
        	->where('id', '=', $_GET['id'])
        	->update(array('title' => $event->title, 'start_time' => $event->start_time, 'end_time' => $event->end_time, 
			'location' => $event->location, 'description' => $event->description));

			
						
			redirect_to('?page=events-edit&id='.$event->id, array('event_updated' => true));
			
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

<h3 class="page-header">Editar Evento</h3>
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
		
		<?php if (Session::has('event_updated')): Session::deleteFlash(); ?>
			<div class="alert alert-success alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				Se ha Actualizado el Evento
			</div>
		<?php endif ?>
        <?php if (Session::has('event_created')): Session::deleteFlash(); ?>
			<div class="alert alert-success alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				Se ha Creado el Evento
			</div>
		<?php endif ?>

		<?php if ($event): ?>
			<form action="?page=events-edit&id=<?php echo $event->id ?>" method="POST">
				<?php csrf_input();
				
				?>
				<div class="form-group">
			        <label for="title">Título del Evento: <em><?php _e('admin.required') ?></em></label>
			        <input type="text" name="title" id="title" value="<?php if(!empty($_POST['title'])) 
					echo $_POST['title']; 
					else echo $event->title; ?>" class="form-control">
			    </div>

		
        
                <div class='col-md-5'>
                    <div class="form-group">
                    	<label for="start_time">Fecha y hora de inicio:<em><?php _e('admin.required') ?></em></label>
                        <input type='text' class="form-controls hide" name="start_time" id="start_time" value="<?php if(!empty($_POST['start_time'])) 
							echo $_POST['start_time']; 
							else echo $event->start_time; ?>"/>
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
							else echo $event->end_time; ?>"/>
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
					else echo $event->location; ?>" class="form-control">
			    </div>
                
                
                <div class="form-group">
                	<label for="description">Descripción </label>
                    <textarea name="description" id="description" class="form-control hide"><?php if(!empty($_POST['description'])) echo $_POST['description']; 
					else echo $event->description ?></textarea>
                    <textarea id="editorTA-description"></textarea>
                </div>
                
                
                <div class="form-group">
                	<button type="submit" name="submit" class="btn btn-primary" id="save">Guardar Cambios</button>
                    <button  type="submit" onclick="return confirm('¿Seguro que quieres eliminar definitivamente éste Evento?');" 
                    name="delete"  class="btn btn-danger" value="1">Eliminar definitivamente</button>
                </div>
                
                               
                    <br >
                    <br >
                <div class="avatar-container form-group">
                	<label for="imageX">Imagen</label>
                    <div class="clearfix">
                    	
                        <div class="pull-left" style="margin-left: 10px;"> 
                        	 
                            <img src="../images/events/<?php if(!empty($event->image)) echo $event->image; else  echo "default.png"?>" 
                            class="avatar-image img-thumbnail">
                           
                            <div class="btn btn-info btn-sm ip-upload">Cargar Imagen<input type="file" name="image" class="ip-file"></div>
                        
                        </div>
                    </div>
                                                            


                    <div class="alert ip-alert"></div>
                    <div class="ip-info"><?php _e('main.crop_info') ?></div>
                    <div class="ip-preview"></div>
                    <div class="ip-rotate">
                        <button type="button" class="btn btn-default ip-rotate-ccw" title="Rotate counter-clockwise"><span class="icon-ccw"></span></button>
                        
                        <button type="button" class="btn btn-default ip-rotate-cw" title="Rotate clockwise"><span class="icon-cw"></span></button>
                    </div> 

                    <div class="ip-progress">
                        <div class="text"><?php _e('main.uploading') ?></div>
                        <div class="progress progress-striped active"><div class="progress-bar"></div></div>
                    </div>
                    <div class="ip-actions">
                        <button type="button" class="btn btn-sm btn-success ip-save"><?php _e('main.save_image') ?></button>
                        <button type="button" class="btn btn-sm btn-primary ip-capture"><?php _e('main.capture') ?></button>
                        <button type="button" class="btn btn-sm btn-default ip-cancel"><?php _e('main.cancel') ?></button>
                    </div>
                    
                </div>
              
			</form>

		<?php else: ?>
			<div class="alert alert-danger"><?php _e('errors.userid') ?></div>
		<?php endif ?>
	</div>

	<div class="col-md-6">
	</div>
</div>
<link href="<?php echo asset_url('css/vendor/imgpicker.css') ?>" rel="stylesheet">
<link href="<?php echo asset_url('css/vendor/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">
<script src="<?php echo asset_url('js/vendor/moment.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/bootstrap-datetimepicker.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/jquery.Jcrop.min.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/jquery.imgpicker.js') ?>"></script>
<script> 
	  function ConfirmDelete()
	  {
		var x = confirm("¿Seguro que quieres eliminar definitivamente esta Área de Investigación?"
					  +"\nLos Proyectos que esten dentro de esta área TAMBIEN SE ELIMINARÁN ");
		if (x)
			return true;
		else
		  return false;
	  }


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
		var m = moment($('#start_time').val(), 'YYYY-MM-DD HH:mm:00' ); 
		var m2 = moment($('#end_time').val(), 'YYYY-MM-DD HH:mm:00' ); 
		$('#start_timePicker').val(m.format('DD-MM-YYYY hh:mm A'));
		$('#end_timePicker').val(m2.format('DD-MM-YYYY hh:mm A'));
		
        $('#datetimepicker6').datetimepicker({
			sideBySide: true,
			format: 'DD-MM-YYYY hh:mm A'

		});
        $('#datetimepicker7').datetimepicker({
            useCurrent: false, //Important! See issue #1075
			sideBySide: true,
			format: 'DD-MM-YYYY hh:mm A'
        });
		
		if($('#start_time').val()!=''){
			var m = moment($('#start_time').val(), 'YYYY-MM-DD HH:mm:00' );
			$('#start_timePicker').val(m.format('DD-MM-YYYY hh:mm A'));
			$('#datetimepicker7').data("DateTimePicker").minDate(m);
			
		}
		if($('#end_time').val()!=''){
			var m2 = moment($('#end_time').val(), 'YYYY-MM-DD HH:mm:00' ); 
			$('#end_timePicker').val(m2.format('DD-MM-YYYY hh:mm A'));
			
			$('#datetimepicker6').data("DateTimePicker").maxDate(m2);
			
		}
		
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