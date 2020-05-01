<?php if (!Auth::userCan('manage_researchareas')) page_restricted();



if (isset($_POST['submit']) && csrf_filter()) {

	$data = array(
    	'title_es'    => $_POST['title_es'],
    	'title' => $_POST['title'], 
    );

	$rules = array(
    	'title_es'     => 'required',
    );


    foreach (UserFields::all('admin') as $key => $field) {
    	if (!empty($field['validation'])) {
    		$data[$key] = @$_POST[$key];
    		$rules[$key] = $field['validation'];
    	}
    }
	
	$validator = Validator::make($data, $rules);

	if ($validator->passes()) {
		
/*
		if ($researcharea->save()) {
			*/
			$new_researcharea=DB::table('researchareas')->insertGetId(
        			array('title_es' => $_POST['title_es'], 'title' => $_POST['title'] ));

			redirect_to('?page=researchareas-edit&id='.$new_researcharea, array('researcharea_created' => true));
			
			
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

<h3 class="page-header">Nueva Área de Investigación</h3>
<p><a href="?page=research">Volver a Áreas y Proyectos de Investigación</a></p>
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
		<?php if (Session::has('researcharea_deleted')): Session::deleteFlash(); ?>
			<div class="alert alert-info alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				Se ha Eliminado la Área de Investigación
			</div>
		<?php endif ?>

			<form action="?page=researchareas-new" method="POST">
				<?php csrf_input() ?>
				


			    <div class="form-group">
			        <label for="title_es">Título (Español)<em><?php _e('admin.required') ?></em></label>
			        <input type="text" name="title_es" id="title_es" value="<?php if(!empty($_POST['title_es'])) echo $_POST['title_es']; ?>" class="form-control">
			    </div>
                
                <div class="form-group">
			        <label for="title">Título (Inglés)</label>
			        <input type="text" name="title" id="title" value="<?php if(!empty($_POST['title'])) echo $_POST['title']; ?>" class="form-control">
			    </div>
                
                <div class="form-group">
                	<button type="submit" name="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
                

			</form>
            
	</div>

	<div class="col-md-6">
	</div>
</div>


<?php echo View::make('admin.footer')->render() ?>