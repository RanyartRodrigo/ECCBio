<?php if (!Auth::userCan('dashboard')) page_restricted(); 

if(isset($_POST['deleteResearcharea']) && isset($_POST['target'])){
	
	$related_projects=DB::table('projects')
        				->where('researcharea_id', "=", $_POST['target'])->get();
	foreach($related_projects as $rp)
	{
		DB::table('projects-users')->where('project_id', '=', $rp->id)->delete();
		DB::table('projects')->where('id', '=', $rp->id)->delete();
	}
	DB::table('researchareas')->where('id', '=', $_POST['target'])->delete();
	
	
	redirect_to('?page=research', array('researcharea_deleted' => true));

}


if(isset($_POST['deleteProject']) && isset($_POST['target'])){
	
	DB::table('projects-users')->where('project_id', '=', $_POST['target'])->delete();
	DB::table('projects')->where('id', '=', $_POST['target'])->delete();
	
	redirect_to('?page=research', array('project_deleted' => true));

}

?>

<?php echo View::make('admin.header')->render() ?>

<link href="<?php echo asset_url('bootstrap-toggle-master/css/bootstrap-toggle.min.css') ?>" rel="stylesheet">
<script src="<?php echo asset_url('bootstrap-toggle-master/js/bootstrap-toggle.min.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/dataTables.bootstrap.js') ?>"></script>
<script src="<?php echo asset_url('js/research.js') ?>"></script>



<h3 class="page-header">
	Áreas y Proyectos de Investigación 
</h3>

<?php if (Session::has('researcharea_deleted')): Session::deleteFlash(); ?>	
    <div class="alert alert-info alert-dismissible">
        <span class="close" data-dismiss="alert">&times;</span>
        Se ha Eliminado la Área de Investigación
    </div>
<?php endif ?>

<?php if (Session::has('project_deleted')): Session::deleteFlash(); ?>
	<div class="alert alert-info alert-dismissible">
		<span class="close" data-dismiss="alert">&times;</span>
		Se ha Eliminado el Proyecto
	</div>
<?php endif ?>


<?php if (!Auth::userCan('manage_researchareas')): ?>
	<div class="alert alert-warning alert-dismissible">
		<span class="close" data-dismiss="alert">&times;</span>
		Por tu nivel de permisos, no puedas editar o agregar Areas de Investigación.
	</div>
<?php endif ?>

<?php if (!Auth::userCan('manage_projects')): ?>
	<div class="alert alert-warning alert-dismissible">
		<span class="close" data-dismiss="alert">&times;</span>
		Por tu nivel de permisos, no puedas editar o agregar Proyectos.
	</div>
<?php endif ?>
 

<div class="row">

		<?php if (Auth::userCan('manage_researchareas')):?>
            <!--
            <a href="?page=researchareas-new" class="btn btn-primary">
            <span class="glyphicon glyphicon-plus"></span>
            Agregar nueva Área de Investigación
            </a>
            -->
        <?php endif ?>

		<?php
        $researchareas = DB::table('researchareas')->get();
        foreach ($researchareas as $ra) {
        ?>
		<div class="panel panel-default">
			<div class="panel-heading">
            	<?php if (Auth::userCan('manage_projects')):?>
                		
                      
            			<div class="btn-group pull-right" role="group" aria-label="...">

                             <!-- <button type="button" class="btn btn-xs btn-success">-->
                              <a href="?page=projects-new&researcharea=<?php echo $ra->id;?>" class="btn btn-xs btn-success">
                                <span class="glyphicon glyphicon-plus"></span>
                              </a>
                             <!--</button>-->
                             
                              <?php 
                              $message="Todo los Proyectos asociados al área de investigación \'".$ra->title_es."\' <b>también serán eliminados</b>. "
                              ."Esta acción es irreversible.<br>"
                              ?> 
                              <button type="button" class="btn btn-xs btn-danger" 
                              onclick="toDelete(<?php echo $ra->id ?>, '<?php echo $message ?>');" 
                              data-toggle="modal" data-target="#deleteResearchareaModal" > 	
                                <span class="glyphicon glyphicon-trash"></span>
                              </button>    
                        </div> 
                        <div class="btn-group pull-right" role="group" aria-label="...">
                        	 <input id="isdisplayRA-<?php echo $ra->id;?>" type="hidden" value="<?php echo $ra->display ?>">
                        	<label class="checkbox-inline">
                          		<input id="displayRA-<?php echo $ra->id ?>" type="checkbox" checked 
                                data-toggle="toggle" data-onstyle="default" data-size="mini"
                                data-on="<i class='glyphicon glyphicon-eye-open'></i> Visible" 
                                data-off="<i class='glyphicon glyphicon-eye-close'></i> Oculta">
                       		 </label>
                        </div>    
                    
                <?php endif ?>
                <?php if (Auth::userCan('manage_researchareas')):?>
				<a href="?page=researchareas-edit&id=<?php echo $ra->id;?>" >
                <?php endif ?>
                	<?php echo $ra->title_es;  ?>
                <?php if (Auth::userCan('manage_researchareas')):?>
                </a>
                <?php endif ?>
            </div>
			<div id="panel-<?php echo $ra->id;?>" class="panel-body">
				<div class="row">
                  	<div class="col-md-2">

						<?php if($ra->image=="")
                                $image="default.png";
                                else
                                $image=$ra->image;
                        ?>
                        <img src="../images/researcharea/<?php echo $image?>" style="max-width:165px; ">
                    </div>
                    <div class="col-md-10">
						<?php
                        $projects = DB::table('projects')->where('researcharea_id', $ra->id)->get();
                        foreach ($projects as $p) {
							if (Auth::userCan('manage_projects')){
                             
                                $message="El proyecyo \'".$p->title_es."\' se va a eliminar. Ésta acción es irreversible.<br>";
                                ?> 
                                  
                                  <input id="isdisplayProject-<?php echo $p->id;?>" type="hidden" value="<?php echo $p->display;?>" >
                                  <div class="input-group">
                                     <form action="?page=projects-edit&id=<?php echo $p->id;?>" method="POST">
                                        <input id="projectName-<?php echo $p->id;?>" type="submit" class="form-control btn-responsive"
                                        aria-label="..." value="<?php echo $p->title_es;?>">
                                     </form>
                                      <div class="input-group-btn">  
                                                           
                                        <button id="displayProject-<?php echo $p->id;?>" type="button" class="btn btn-default">
                                          <span class="glyphicon glyphicon-eye-open"></span>
                                        </button>
                                        <button id="nodisplayProject-<?php echo $p->id;?>" type="button" class="btn btn-default">
                                          <span class="glyphicon glyphicon-eye-close"></span>
                                        </button>
                                        
                                        <button type="button" class="btn btn-default" 
                                            onclick="toDelete(<?php echo $p->id ?>, '<?php echo $message ?>');" 
                                            data-toggle="modal" data-target="#deleteProjectModal" > 	
                                              <span class="glyphicon glyphicon-trash"></span>
                                        </button>   
                                      </div>
                                  </div>
                                                               
                           
                             
                              <?php
                             }else {?>
                                    <p><?php echo $p->title_es;  ?></p>
          
                             <?php } 
                        }
                        ?>
					</div>

            	</div>
         	</div>         
		</div>
		<?php
        }
        ?>
        <?php if (Auth::userCan('manage_researchareas')):?>
         <a href="?page=researchareas-new" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>
         Agregar nueva Área de Investigación </a>
         <?php endif ?>
</div>


<!--MODAL de Eliminar Area de Investigación-->
<?php if (Auth::userCan('manage_researchareas')):?>
<div class="modal fade" id="deleteResearchareaModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
            <div class="modal-body">
              <div class="alert"></div>
              <h3>¿Estas seguro de querer eliminar esta Área de Investigación?</h3>
              <p>
              	<div class="deleteMessage"></div>
              </p>
               <p>
               <form action="?page=research" method="POST">
               	  <input type="hidden" class="target" name="target" value="">
                  <button  type="submit"  name="deleteResearcharea" class="btn btn-danger" value="1">Eliminar definitivamente</button>
                  <a href="#"  class="btn btn-primary" data-toggle="modal" data-target="#deleteResearchareaModal">Cancelar</a>
               </form>
               </p>
             </div>
		</div>
	</div>
</div>
<?php endif ?>

<?php if (Auth::userCan('projects')):?>
<!--MODAL de Eliminar Proyecto-->
<div class="modal fade" id="deleteProjectModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
            <div class="modal-body">
              <div class="alert"></div>
              <h3>¿Estas seguro de querer eliminar este Proyecto?</h3>
              <p>
              	<div class="deleteMessage"></div>
              </p>
               <p>
               <form action="?page=research" method="POST">
               	  <input type="hidden" class="target" name="target" value="">
                  <button  type="submit"  name="deleteProject" class="btn btn-danger" value="1">Eliminar definitivamente</button>
                  <a href="#"  class="btn btn-primary" data-toggle="modal" data-target="#deleteProjectModal">Cancelar</a>
               </form>
               </p>
             </div>
		</div>
	</div>
</div>
<?php endif ?>

<?php echo View::make('admin.footer')->render() ?>