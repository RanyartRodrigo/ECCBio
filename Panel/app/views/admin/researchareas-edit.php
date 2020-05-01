<?php if (!Auth::userCan('manage_researchareas')) page_restricted();

if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
	redirect_to('?page=research');
}

$researcharea= DB::table('researchareas')->where('id', $_GET['id'])->first();	
if(empty($researcharea)) 
{ 
	redirect_to('?page=research'); 
}
	
if(isset($_POST['delete'])){
	
	$related_projects=DB::table('projects')
        				->where('researcharea_id', "=", $_GET['id'])->get();
	foreach($related_projects as $rp)
	{
		DB::table('projects-users')->where('project_id', '=', $rp->id)->delete();
		DB::table('projects')->where('id', '=', $rp->id)->delete();
	}
	DB::table('researchareas')->where('id', '=', $_GET['id'])->delete();
	
	redirect_to('?page=research', array('researcharea_deleted' => true ));

}elseif (isset($_POST['submit']) && csrf_filter()) {

	$data = array(
    	'title_es'    => $_POST['title_es'],
    	'title' => $_POST['title'], 
		'image'     => $_POST['image'],
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
		
		$researcharea->title_es = $_POST['title_es'];
		$researcharea->title = 	$_POST['title'];
/*
		if ($researcharea->save()) {
			*/
			DB::table('researchareas')
        	->where('id', $_GET['id'])
        	->update(array('title_es' => $researcharea->title_es, 'title' => $researcharea->title ));

			redirect_to('?page=researchareas-edit&id='.$researcharea->id, array('researcharea_updated' => true));
			
			
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

<h3 class="page-header">Editar Área de Investigación</h3>
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
		
		<?php if (Session::has('researcharea_updated')): Session::deleteFlash(); ?>
			<div class="alert alert-success alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				Se ha Actualizado la Área de Investigación
			</div>
		<?php endif ?>
        <?php if (Session::has('researcharea_created')): Session::deleteFlash(); ?>
			<div class="alert alert-success alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				Se ha Creado la Área de Investigación
			</div>
		<?php endif ?>

		<?php if ($researcharea): ?>
        	<link href="<?php echo asset_url('css/vendor/imgpicker.css') ?>" rel="stylesheet">
			<form action="?page=researchareas-edit&id=<?php echo $researcharea->id ?>" method="POST">
				<?php csrf_input() ?>
				


			    <div class="form-group">
			        <label for="title_es">Título (Español)<em><?php _e('admin.required') ?></em></label>
			        <input type="text" name="title_es" id="title_es" value="<?php echo $researcharea->title_es ?>" class="form-control">
			    </div>
                
                <div class="form-group">
			        <label for="title">Título (Inglés)</label>
			        <input type="text" name="title" id="title" value="<?php echo $researcharea->title ?>" class="form-control">
			    </div>
                
                <div class="form-group">
                	<button type="submit" id="save" name="submit" class="btn btn-primary">Guardar Cambios</button>
                    
                    <!--<button  type="submit"  name="delete" Onclick="return ResearchDelete();" class="btn btn-danger" value="1">Eliminar definitivamente</button>-->
                    <a href="#"  class="btn btn-danger" data-toggle="modal" data-target="#deleteResearchareaModal">Eliminar</a>
                    <div class="modal fade" id="deleteResearchareaModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="alert"></div>
                                        <h3>¿Estas seguro de querer eliminar esta Área de Investigación?</h3>
                                        <p>
                                        Los Proyectos asociados al área de investigación "<?php echo $researcharea->title_es ?>"
                                        <b>también serán eliminados</b>. Esta acción es irreversible.
                                        <br>
                                        </p>
                                         <a href="#"  class="btn btn-primary" data-toggle="modal" data-target="#deleteResearchareaModal">Cancelar</a>
                                         <button  type="submit"  name="delete" class="btn btn-danger" value="1">Eliminar definitivamente</button>
                                     </div>
                            </div>
                        </div>
                    </div>

                   
                </div>
                
                    <br >
                    <br >
                <div class="avatar-container form-group">
                	<label for="imageX">Imagen</label>
                    <div class="clearfix">
                    	
                        <div class="pull-left" style="margin-left: 10px;"> 
                        	 
                            <img src="../images/researcharea/<?php if(!empty($researcharea->image)) echo $researcharea->image; else  echo "default.png"?>" class="avatar-image img-thumbnail">
                           
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
		<script src="<?php echo asset_url('js/research.js') ?>"></script>
		<script src="<?php echo asset_url('js/vendor/jquery.Jcrop.min.js') ?>"></script>
		<script src="<?php echo asset_url('js/vendor/jquery.imgpicker.js') ?>"></script>
		<script> 
		
				$('.avatar-container').imgPicker({
					url: '<?php echo App::url("ajax.php?action=researchimage&researchareaid=".$researcharea->id) ?>',
					messages: <?php echo json_encode(trans('imgpicker.js')) ?>,
					aspectRatio: 1,
					cropSuccess: function(img) {
						$('.avatar-image').attr('src', img.url + '?'+new Date().getTime());
						this.container.find('select').val('image');
					}
				});
				 
		</script>

<?php echo View::make('admin.footer')->render() ?>