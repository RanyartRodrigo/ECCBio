<?php if (!Auth::userCan('manage_projects')) page_restricted();

if (empty($_GET['id']) || !is_numeric($_GET['id']) ) {
	redirect_to('?page=research');
}

$project= DB::table('projects')
	->where('id', $_GET['id'])
	->first();

$project_user = DB::table('projects-users')->where('project_id', $_GET['id'])
						->orderBy('order', 'asc')->get();

$project_responsable = DB::table('projects-users')->where('project_id', $_GET['id'])
						->where('responsible', 1)
						->orderBy('order', 'asc')->get();
						
$project_group = DB::table('projects-users')->where('project_id', $_GET['id'])
					->where('responsible', 0)
					->orderBy('order', 'asc')->get();
						
if(empty($project)) 
{ 
	redirect_to('?page=research'); 
}
	
if(isset($_POST['delete'])){
	
	DB::table('projects-users')->where('project_id', '=', $_GET['id'])->delete();
	DB::table('projects')->where('id', '=', $_GET['id'])->delete();
	
	redirect_to('?page=research', array('project_deleted' => true));

}elseif(isset($_POST['submit']) && csrf_filter()) {

		
	$data = array(
    	'title_es'    => $_POST['title_es'],
    	'title' => $_POST['title'],
   
		'abstract_es'     => $_POST['abstract_es'],
		'abstract'     => $_POST['abstract'],
		'Investigador-Responsable'     => $_POST['Investigador-Responsable'],
		
		//'galleryfolder'     => $_POST['galleryfolder'],
    );

	$rules = array(
    	'title_es'     => 'required',
		'Investigador-Responsable'     => 'required',

		
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
		
		$project->title_es = $_POST['title_es'];
		$project->title = 	$_POST['title'];
		$project->abstract_es = 	$_POST['abstract_es'];
		$project->abstract = 	$_POST['abstract'];
/*
		if ($researcharea->save()) {
			*/
			
			
			
			DB::table('projects')
        	->where('id', '=', $_GET['id'])
        	->update(array('title_es' => $project->title_es, 'title' => $project->title, 'abstract_es' => $project->abstract_es, 'abstract' => $project->abstract ));

			
			
			$toDelete = array();
			$i=0;
			foreach($project_user as $pu)
			{
				$toDelete[$i] = $pu->user_id;
				$i++;
			}			
			
			
			
			$responsible = $_POST['responsable'];
						
			$order=0;
			foreach($responsible as $r)
			{	$order++;
				$alreadyexists=0;
				foreach($project_user as $pu)
				{
					if($pu->user_id == $r){
						$alreadyexists=1;
						$key = array_search($r, $toDelete);
						unset($toDelete[$key]);
						
						if($pu->order != $order || $pu->responsible != 1)
						{
												
							DB::table('projects-users')
							->where('user_id', '=', $r)
							->where('project_id', '=', $_GET['id'])
							->update(array('order' => $order, 'responsible' => 1));
							
							
						}
					}
				}
				if($alreadyexists==0)
				{
			
					DB::table('projects-users')->insert(
    						array('order' => $order, 'responsible' => '1', 'user_id' => $r, 'project_id' => $_GET['id']));
							
				}
				
			}
		
			$order=0;
			
			if(!empty($_POST['group']))
			{
				
				$group = $_POST['group'];
				$order=0;

				foreach($group as $g)
				{	$order++;
					$alreadyexists=0;
					foreach($project_user as $pu)
					{
						if($pu->user_id == $g){
							$alreadyexists=1;
							$key = array_search($g, $toDelete);
							unset($toDelete[$key]);
							
							if($pu->order != $order || $pu->responsible != 0)
							{
								echo "<h3>Actualizar orden o hacer GRUPO a ". $g."</h3>";
							
								DB::table('projects-users')
								->where('user_id', '=', $g)
								->where('project_id', '=', $_GET['id'])
								->update(array('order' => $order, 'responsible' => '0'));
								
								
							}
						}
					}
					if($alreadyexists==0)
					{/**/
						
						
						DB::table('projects-users')->insert(
								array('order' => $order, 'responsible' => '0', 'user_id' => $g, 'project_id' => $_GET['id']));
								
					}
				}
			}
			if(!empty($toDelete))
			{
				
				foreach($toDelete as $d)
				{
					DB::table('projects-users')
						->where('project_id','=',$_GET['id'])
						->where('user_id', '=', $d)->delete();
				}	
			}
			
			redirect_to('?page=projects-edit&id='.$project->id, array('project_updated' => true));
			
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
<script>
$(function(){
			$("[id^='editorTA-']")
							.trumbowyg({
							  lang: 'es',
							  removeformatPasted: false,
							  fullscreenable: false})
							.on('tbwchange', function(){ 
							  var end=$(this).attr('id').replace('editorTA-','');
							  $('#'+end).html($('#editorTA-'+end).trumbowyg('html'));
						
						});	
			
			$("#editorTA-abstract").trumbowyg('html', $('#abstract').text());
			$("#editorTA-abstract_es").trumbowyg('html', $('#abstract_es').text());
			$("#editorTA-description").trumbowyg('html', $('#description').text());
	
		});
</script>

<h3 class="page-header">Editar Proyecto</h3>
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
		
		<?php if (Session::has('project_updated')): Session::deleteFlash(); ?>
			<div class="alert alert-success alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				Se ha Actualizado el Proyecto
			</div>
		<?php endif ?>
        <?php if (Session::has('project_created')): Session::deleteFlash(); ?>
			<div class="alert alert-success alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				Se ha Creado el Proyecto
			</div>
		<?php endif ?>

		<?php if ($project): ?>
			<form action="?page=projects-edit&id=<?php echo $project->id ?>" method="POST">
				<?php csrf_input();
				
				 $ra= DB::table('researchareas')
					->where('id', $project->researcharea_id)
					->first(); 
				?>
				<div class="form-group">
			        <label for="researcharea">Área de Investigación <em><?php _e('admin.required') ?></em></label>
			        <input type="text" name="researcharea" id="researcharea" readonly="readonly" value="<?php echo $ra->title_es ?>" class="form-control">
			    </div>


			    <div class="form-group">
			        <label for="title_es">Título (Español)<em><?php _e('admin.required') ?></em></label>
			        <input type="text" name="title_es" id="title_es" value="<?php if(!empty($_POST['title_es'])) 
					echo $_POST['title_es']; 
					else echo $project->title_es; ?>" class="form-control">
			    </div>
                
                <div class="form-group">
			        <label for="title">Título (Inglés)</label>
			        <input type="text" name="title" id="title" value="<?php if(!empty($_POST['title'])) echo $_POST['title'];
					else echo $project->title ?>" class="form-control">
			    </div>
                
                
                
                
                
                <div class="form-group">
                	<label for="abstractes">Resumen (Español) <em><?php _e('admin.required') ?></em></label>
                    <textarea name="abstract_es" id="abstract_es" class="form-control hide"><?php if(!empty($_POST['abstract_es'])) echo $_POST['abstract_es']; 
					else echo $project->abstract_es ?></textarea>
                    <textarea id="editorTA-abstract_es"></textarea>
                </div>
                <div class="form-group">
                	<label for="abstract">Resumen (Inglés)</label>
                    <textarea name="abstract" id="abstract" class="form-control hide"><?php if(!empty($_POST['abstract'])) echo $_POST['abstract'];
					else echo $project->abstract ?></textarea>
                    <textarea id="editorTA-abstract"></textarea>
                </div>
                
                
                 <!-- AQUI LOS BOTONES DE LA GALERIA -->
                <div class="form-group">
                    <button type="button" class="btn btn-default" 
                        onclick="" 
                        data-toggle="modal" data-target="#galleryModal" > 	
                        <span class="glyphicon glyphicon-picture"></span> Administrar galería de fotos
                     </button>
                </div>    
                
                
                
                 <div class="form-group">
                 	<input type="text" name="Investigador-Responsable" id="Investigador-Responsable" class="hide">
                 	<label for="responsable">Investigador(es) Responsable(s) <em><?php _e('admin.required') ?></em></label> <br>
                    <div class="row">
                      <div class="col-lg-6" id="responsable-panel">
                         <div class="btn-group" role="group" aria-label="...">
                            <button type="button" class="btn btn-default  btn-success" aria-label="Agregar responsable" id="add-responsable">
                              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-default  btn-danger" aria-label="Quitar responsable" id="remove-responsable">
                              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                             <button type="button" class="btn btn-default " aria-label="Mover arriba" id="up-responsable">
                              <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
                            </button>
                             <button type="button" class="btn btn-default " aria-label="Mover abajo" id="down-responsable">
                              <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                            </button>  
                        </div>
                        
                        <select multiple name="responsable[]" id="responsable" class="form-control">
                            <?php
                            if(!empty($project_responsable))
                            {
                                
                                foreach ($project_responsable as $pr) {
                                    $user = User::where('id', $pr->user_id)->orWhere('username', $pr->user_id)->first();
                                    echo $user->prefix. " " . $user->first_name . " ". $user->last_name;
                                ?>
                                <option value=<?php echo $user->id ?>>
                                    <?php echo $user->prefix. " " . $user->first_name . " ". $user->last_name; ?>
                                    
                                 </option>
                                 <?php       
                                }
                            }
                            ?>
                        </select>
                        
                        
                        
                        
                      </div><!-- /.col-lg-6 -->
                      <div class="col-lg-6" id="panel-add-responsable">
                      	<div class="btn-group" role="group" aria-label="...">
                            <button type="button" class="btn btn-default  btn-success" aria-label="Agregar responsable" id="select-responsable">
                              <span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span> Copiar a la lista
                            </button>
                            <button type="button" class="btn btn-default  btn-info" aria-label="Agregar responsable" id="cancel-select-responsable">
                              <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Cancelar
                            </button>
                        </div>
                        <div id="selectable-responsable">
                        </div>
                        
                      </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                </div>
               
                
                 <div class="form-group">
                 	<input type="text" name="Grupo-de-Investigacion" id="Grupo-de-Investigacion" class="hide">
                 	<label for="group">Grupo de Investigación</label> <br>
                    <div class="row">
                      <div class="col-lg-6" id="responsable-panel">
                         <div class="btn-group" role="group" aria-label="...">
                            <button type="button" class="btn btn-default  btn-success" aria-label="Agregar responsable" id="add-group">
                              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="btn btn-default  btn-danger" aria-label="Quitar responsable" id="remove-group">
                              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                             <button type="button" class="btn btn-default " aria-label="Mover arriba" id="up-group">
                              <span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span>
                            </button>
                             <button type="button" class="btn btn-default " aria-label="Mover abajo" id="down-group">
                              <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                            </button>  
                        </div>
                        
                        <select multiple name="group[]" id="group" class="form-control">
                            <?php
                            if(!empty($project_group))
                            {
                                
                                foreach ($project_group as $pg) {
                                    $user = User::where('id', $pg->user_id)->orWhere('username', $pg->user_id)->first();
                                    echo $user->prefix. " " . $user->first_name . " ". $user->last_name;
                                ?>
                                <option value=<?php echo $user->id ?>>
                                    <?php echo $user->prefix. " " . $user->first_name . " ". $user->last_name; ?> 
                                 </option>
                                 <?php       
                                }
                            }
                            ?>
                        </select>
                        
                      </div><!-- /.col-lg-6 -->
                      <div class="col-lg-6" id="panel-add-group">
                      	<div class="btn-group" role="group" aria-label="...">
                            <button type="button" class="btn btn-default  btn-success" aria-label="Agregar miembro del grupo" id="select-group">
                              <span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span> Copiar a la lista
                            </button>
                            <button type="button" class="btn btn-default  btn-info" aria-label="Cancelar miembros del grupo" id="cancel-select-group">
                              <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Cancelar
                            </button>
                        </div>
                        <div id="selectable-group">
                        </div>
                        
                      </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                </div>
                
                
                
                            
               
                
                <div class="form-group">
                	<button type="submit" name="submit" class="btn btn-primary" id="save">Guardar Cambios</button>
                    <button  type="submit" onclick="return confirm('¿Seguro que quieres eliminar definitivamente éste Poyecto?');" 
                    name="delete"  class="btn btn-danger" value="1">Eliminar definitivamente</button>
                </div>
			</form>
            
                               

		<?php else: ?>
			<div class="alert alert-danger"><?php _e('errors.userid') ?></div>
		<?php endif ?>
	</div>

	<div class="col-md-6">
	</div>
</div>


<script>$(function(){ 
			
			$("[id^='up-']").click(function(){
				var end=$(this).attr('id').replace('up-','');
				$("select[name='"+end+"[]']").moveSelectedUp();
				});
				
			$("[id^='down-']").click(function(){
				var end=$(this).attr('id').replace('down-','');
				$("select[name='"+end+"[]']").moveSelectedDown();
			});
				
			
			$("[id^='panel-add']").hide();
			
			$("[id^='remove-']").click(function(){
				var end=$(this).attr('id').replace('remove-','');
				$("#"+end+" option:selected").remove();
			});
			
			$("[id^='add-']").click(function(){
				var end=$(this).attr('id').replace('add-','');
				var already="";
				$("#"+end+" option").each(function()
				{
					already=already+$(this).val()+"-";
				});
				var url="admin.php?page=selectable-researchers&already="+already+"&type="+end;
				$("#selectable-"+end).load(url);
				$("#panel-add-"+end).show();
				$("#"+end+"-panel").children().prop('disabled',true);
			});
			
			$("[id^='select-']").click(function(){
				var end=$(this).attr('id').replace('select-','');
				var other="group";
						if(end=="group") other="responsable";
				var final = '';
				$("[id|='check"+end+"']").each(function(){  
					if(this.checked)
					{   
						var values =  $(this).val().split("-");
						$("#"+ other +" option[value='"+values[0]+"']").remove();
						$("#"+end).append($('<option>', {
							value: values[0],
							text: values[1]
						}));

					}
				});
				$("#panel-add-"+end).hide();
				$("#"+end+"-panel").children().prop('disabled',false);
			});
			
			$("[id^='cancel-select-']").click(function(){
				var end=$(this).attr('id').replace('cancel-select-','');
				$("#panel-add-"+end).hide();
				$("#"+end+"-panel").children().prop('disabled',false);
			});
			
			$("#save").click(function(){
				
				$("#Investigador-Responsable").val("");
				if( $('#responsable').has('option').length > 0 ) 
				{	
					$('#responsable option').prop('selected', true);
					$("#Investigador-Responsable").val("ok");
				}
				$('#group option').prop('selected', true);
				
			});
	});
	
</script>
<script>
/*
 * jQuery File Upload Plugin JS Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '../images/projects/index.php?p=<?php echo $project->galleryfolder ?>'
    });
    

        // Load existing files:
        $('#fileupload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
			//url:'server/php/index.php?project=22',
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });

});
</script>

<?php echo View::make('modals.project-gallery')->render() ?>
<?php echo View::make('admin.footer')->render() ?>