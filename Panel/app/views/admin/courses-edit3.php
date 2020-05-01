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
	
	redirect_to('?page=courses-new', array('event_deleted' => true));

}elseif(isset($_POST['submit']) && csrf_filter()) {

		
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
	
		$event->name = $_POST['name'];
		$event->start= $_POST['start'];
		$event->end= $_POST['end'];
		$event->location=$_POST['location'];
		$event->description=$_POST['description'];
/*
		if ($researcharea->save()) {
			*/
			
			
			
			DB::table('cursos')
        	->where('id', '=', $_GET['id'])
        	->update(array('name' => $event->name, 'start' => $event->start, 'end' => $event->end, 
			'location' => $event->location, 'description' => $event->description));

			
						
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
	<link href="/jqueryTheme/jquery-ui.css" rel="stylesheet">
	<script src="/jqueryTheme/external/jquery/jquery.js"></script>
<script src="/jqueryTheme/jquery-ui.js"></script>

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
    float: left;
    background: #edb867;
    padding: 8px;
    height: auto;
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
body{
  font-family: Arial;
  font-size: 13px;
}
.seleccionado > a {
    color: rgba(255, 255, 255, 0)!Important;
}
.seleccionado > a > * {
    color: white;
}
.listaselect >li> a {
    color: rgba(255, 255, 255, 0) !Important;
}
.listaselect >li> a > * {
    color: black;
}
.cajaselect {
    background: none repeat scroll 0 0 #039acc;
    border-radius: 5px 5px 0 0;
    cursor: pointer;
    padding: 5px 10px;
    position: relative;
    z-index: 1;
}
ul.listaselect {
    background: none repeat scroll 0 0 #fff;
    border: 1px solid #dedede;
    display: none;
    left: -1px;
    margin-left: 0;
    margin-top: 49px;
    padding-left: 0;
    position: absolute;
    text-indent: 15px;
    top: 0;
    height: 280px;
    overflow-y: auto;
    width: 100%;
    overflow-x: hidden;
}
ul.listaselect li {
    border-bottom: 1px solid #efefef;
    cursor: pointer;
    display: block;
    line-height: 15px;
    list-style: outside none none;
    margin: 0;
    padding: 1.1em 0.3em;
}
ul.listaselect li a {
    color: #333;
    text-decoration: none;
}
ul.listaselect li a:hover {
    color: #999797;
    text-decoration: none;
}
ul.SelectProductos li:last-child {
    border-bottom: medium none;
}
.seleccionado {
    color: white;
    display: block;
    font-weight: 700;
    line-height: 3;
    text-indent: 10px;
        overflow: hidden;
    width: 55px;
    height: 55px;
}
.trianguloinf {
    border-left: 9px solid rgba(0, 0, 0, 0);
    border-right: 9px solid rgba(0, 0, 0, 0);
    border-top: 13px solid #cfecfc;
    height: 0;
    position: absolute;
    right: 10px;
    top: 17px;
    width: 0;
}
.triangulosup {
    border-bottom: 13px solid #cfecfc;
    border-left: 9px solid rgba(0, 0, 0, 0);
    border-right: 9px solid rgba(0, 0, 0, 0);
    height: 0;
    position: absolute;
    right: 10px;
    top: 17px;
    width: 0;
}
</style>
<h3 class="page-header">Editar Curso</h3>
<p><a href="?page=courses">Volver a Cursos</a></p>
<br ><br >
<div class="row">
<ul class="nav">
                    <li>
                <a>
                  <i class="fa fa-user"></i>
                  <span></span>
                </a>
              </li>

</ul>
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
			<form action="?page=courses-edit&id=<?php echo $event->id ?>" method="POST">
				<?php csrf_input();
				
				?>
				<div class="form-group">
			        <label for="name">Título del Curso: <em><?php _e('admin.required') ?></em></label>
			        <input type="text" name="name" id="name" value="<?php if(!empty($_POST['name'])) 
					echo $_POST['name']; 
					else echo $event->name; ?>" class="form-control">
			    </div>

		
        
                <div class='col-md-5'>
                    <div class="form-group">
                    	<label for="start">Fecha y hora de inicio:<em><?php _e('admin.required') ?></em></label>
                        <input type='text' class="form-controls hide" name="start" id="start" value="<?php if(!empty($_POST['start'])) 
							echo $_POST['start']; 
							else echo $event->start; ?>"/>
                        <div class='input-group date'>
                        	
                            <input type='text' class="form-control" id="datetimepicker6"/>
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
							else echo $event->end; ?>"/>
                        <div class='input-group date'>
                        	
                            <input type='text' class="form-control" id="datetimepicker7" />
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
                    <textarea name="description" id="description" class="form-control"><?php if(!empty($_POST['description'])) echo $_POST['description']; 
					else echo $event->description ?></textarea>
                </div>
                
                
                <div class="form-group">
                	<button type="submit" name="submit" class="btn btn-primary hide" id="save">Guardar Cambios</button>
                    <button  type="submit" id="btnDelete" title="1" 
                    name="delete"  class="btn btn-danger hide" value="1">Eliminar definitivamente</button>
                </div>

           
			</form>
			<div class="form-group">
                	<button onClick="ConfirmSave()" class="btn btn-primary">Guardar Cambios</button>
			<button  onclick="ConfirmDelete()" title="1" class="btn btn-danger">Eliminar definitivamente</button>
		</div>

		<?php else: ?>
			<div class="alert alert-danger"><?php _e('errors.userid') ?></div>
		<?php endif ?>
	</div>

	<div class="col-md-6">
		     <div class="form-group" id="Schedules">              
    </div>
	</div>
</div>
<link href="<?php echo asset_url('css/vendor/imgpicker.css') ?>" rel="stylesheet">
<link href="<?php echo asset_url('js/vendor/jquery.datetimepicker.min.css') ?>" rel="stylesheet">
<script src="<?php echo asset_url('js/vendor/moment.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/jquery.datetimepicker.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/jquery.datetimepicker.full.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/jquery.Jcrop.min.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/jquery.imgpicker.js') ?>"></script>
<script src="<?php echo asset_url('js/sweetalert.min.js') ?>"></script>
<link href="<?php echo asset_url('css/sweetalert.css') ?>" rel="stylesheet"/>
<link href="<?php echo asset_url('css/font-awesome.min.css') ?>" rel="stylesheet"/>
<script  rel="stylesheet"> 

	  function ConfirmSave()
	  {
	  			swal({   title: "Se guardara la informacion de este curso!",   
    text: "¿Estas seguro de proceder?",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Si, Guarda los datos",   
    cancelButtonText: "No",   
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    function(isConfirm){   
        if (isConfirm) 
    {   
        swal("Curso Guardado!", "Este curso se guardado correctamente", "success");   
        $('#save').trigger('click');
        return true;
        } 
        else {     
            swal("No se guardaron los datos", "", "error");   
            return false;
            }
            return false;
             });
	  }
	  function ConfirmDelete(title)
	  {
	  			swal({   title: "Este curso se eliminara",   
    text: "¿Estas seguro de proceder?",   
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Si, elimina el curso",   
    cancelButtonText: "No",   
    closeOnConfirm: false,   
    closeOnCancel: false }, 
    function(isConfirm){   
        if (isConfirm) 
    {   
        swal("Curso Eliminado", "Este curso se elimino", "error");   
        $('#btnDelete').trigger('click');
        return true;
        } 
        else {     
            swal("Ok", "Este evento no se elimino", "success");   
            return false;
            }
            return false;
             });
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
    	var m = moment($('#start').val(), 'YYYY-MM-DD' ); 
        var m2 = moment($('#end').val(), 'YYYY-MM-DD' ); 
        $('#datetimepicker6').datetimepicker({value:m.format('YYYY/MM/DD H:i'),step:5});
        $('#datetimepicker7').datetimepicker({value:m2.format('YYYY/MM/DD H:i'),step:5});
        
        $('#datetimepicker6').datetimepicker({

     mask:'9999/19/39 29:59'

});
        $('#datetimepicker7').datetimepicker({
    mask:'9999/19/39 29:59'
});

        
        if($('#start').val()!=''){
            var m = moment($('#start').val(), 'YYYY-MM-DD' );
            $('#datetimepicker7').datetimepicker({minDate:m.format('YYYY/MM/DD')});  
        }
        if($('#end').val()!=''){
            var m2 = moment($('#end').val(), 'YYYY-MM-DD' ); 
            $('#datetimepicker6').datetimepicker({maxDate:m2.format('YYYY/MM/DD')});
            
        }
        
        $("#datetimepicker6").on("change", function (e) {
            var m = moment($("#datetimepicker6").val(), 'YYYY-MM-DD' );
            $("#start").attr('value',m.format('YYYY-MM-DD'));
            $('#datetimepicker7').datetimepicker({
                minDate:"-"+m.format('YYYY/MM/DD')
            }); 

            
        });
        $("#datetimepicker7").on("change", function (e) {
            var m2 = moment($("#datetimepicker7").val(), 'YYYY-MM-DD' ); 
            $("#end").attr('value',m2.format('YYYY-MM-DD'));
            $('#datetimepicker6').datetimepicker({
                maxDate:"+"+m2.format('YYYY/MM/DD')
            });
        });

        		$("#Schedules").load("/panel/calendar/demos/selectable.php?course="+$("#name").val());
		
    });
</script>




<?php echo View::make('admin.footer')->render() ?>