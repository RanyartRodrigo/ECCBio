<?php if (!Auth::userCan('manage_institutions')) page_restricted();

if (empty($_GET['id']) ) {
	redirect_to('?page=institutions');
}

$institution= DB::table('institutions')
	->where('id', $_GET['id'])
	->first();
	
if (isset($_POST['submit']) && csrf_filter()) {
	
	$validator = Validator::make(
	    array(
	    	'name' => $_POST['name']
	    ),
	    array(
	    	'name' => 'required'
	    )
	);

	
	if ($validator->passes()) {
			$institution->name = $_POST['name'];
			DB::table('institutions')
        	->where('id', '=', $_GET['id'])
        	->update(array('name' => $institution->name));
		
			/*Agregar o quitar de tabla Adscripciones*/
			$currentAdscriptions = DB::table('adscriptions')->where('institution_id', '=', $_GET['id'])->get();
			$toDelete = array();
			$newAdscriptions = array();
			$i=0;
			foreach($currentAdscriptions as $ads)
			{
				$toDelete[$i] = $ads->user_id;
				$i++;
			}
			
			if(isset($_POST['adscrip'])){
				$newAdscriptions = $_POST['adscrip'];
				foreach($newAdscriptions as $na){
					
					$k = array_search($na, $toDelete);
					if($k===FALSE)
					{ 
						DB::table('adscriptions')->insert(
						array('user_id' => $na, 'institution_id' => $_GET['id']));
					}
					else
					{
						unset($toDelete[$k]);
					}
				}
			}
			
			foreach($toDelete as $d)
			{
				DB::table('adscriptions')
					->where('user_id','=',$d)
					->where('institution_id', '=', $_GET['id'])->delete();
			}
			redirect_to("?page=institution-edit&id={$_GET['id']}", array('updated' => true));
		
	}
	else
	{
		$errors = $validator->errors();
	}
	
}


?>

<?php echo View::make('admin.header')->render() ?>

<h3 class="page-header"><?php _e('admin.edit_institution') ?></h3>
<p><a href="?page=institutions"><?php _e('admin.back_to_institutions') ?></a></p>

<div class="row">
	<div class="col-md-6">

		<?php if (isset($errors)) {
			echo '<div class="alert alert-danger alert-dismissible"><span class="close" data-dismiss="alert">&times;</span><ul>';
			foreach ($errors->all('<li>:message</li>') as $error) {
			   echo $error;
			}
			echo '</ul></div>';
		} ?>
		
		<?php if (Session::has('updated')): Session::deleteFlash(); ?>
			<div class="alert alert-success alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				<?php _e('admin.institution_updated') ?>
			</div>
		<?php endif ?>

		<form action="" method="POST">
			<?php csrf_input() ?>
			
			<div class="form-group">
		    	<button type="submit" name="submit" class="btn btn-primary"><?php _e('admin.update_institution') ?></button>
		    </div>
	
			<div class="form-group">
		        <label for="name"><?php _e('admin.institution_name') ?></label>
                <p class="help-block"><?php _e('admin.institution_name_help') ?></p>
		        <input type="text" name="name" id="name" value="<?php echo $institution->name ?>" class="form-control">
		        
		    </div>

			<div class="form-group">
		        <label for="label"><?php _e('admin.institution_users') ?></label>
                <p class="help-block"><?php _e('admin.institution_users_help') ?></p>
				<?php
					//Adscripciones:

					$arrayAds=array();
					$currentAdscriptions = DB::table('adscriptions')->where('institution_id', '=', $_GET['id'])->get();
					$arrayAds = json_decode(json_encode($currentAdscriptions), true);
                  	$users = DB::table('users')->get();
					
					foreach ($users as $usr) {
						$user = User::find($usr->id);
						$check='checked="checked"';
						$key=array_search($user->id, array_column($arrayAds, 'user_id')); 
						if($key===FALSE) $check='';
				
						?>
						<div class="checkbox">
						  <label for="adscrip[]">
						  <input name="adscrip[]" type="checkbox" <?php echo $check ?>
							   value="<?php echo $user->id ?>">
							  <?php echo $user->prefix. " " . $user->first_name . " ". $user->last_name;  ?>
						  </label>
						</div>
						<?php       
					}
					?>
		        
		    </div>
		    
		    <div class="form-group">
		    	<button type="submit" name="submit" class="btn btn-primary"><?php _e('admin.update_institution') ?></button>
		    </div>
		</form>
	</div>
</div>

<script>$(function() { EasyLogin.admin.fields() });</script>

<?php echo View::make('admin.footer')->render() ?>