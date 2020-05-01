<?php if (!Auth::userCan('manage_institutions')) page_restricted();

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

		if (!empty($_POST['name'])) {
			
			$id = DB::table('institutions')->insertGetId(array('name' => $_POST['name']) );
			
			if(!empty($id)){
				if(isset($_POST['adscrip'])){
					$newAdscriptions =$_POST['adscrip'];
					foreach($newAdscriptions as $na){
							DB::table('adscriptions')->insert(
									array('user_id' => $na, 'institution_id' => $id));
					}
					
				}
				redirect_to('?page=institutions',array('institution_added' => true));
			}else{
				redirect_to('?page=institutions',array('add_error' => true));
			}
		
		}

	} else {
		$errors = $validator->errors();
	}
}

if (isset($_GET['delete'])) {
	
	
	DB::table('adscriptions')
					->where('institution_id', '=', $_GET['delete'])->delete();
	if(DB::table('institutions')
					->where('id', '=', $_GET['delete'])
					->limit(1)
					->delete()){
		redirect_to('?page=institutions', array('deleted' => true));
	} else {
		redirect_to('?page=institutions', array('delete_error' => true));
	}
}
?>

<?php echo View::make('admin.header')->render() ?>

<h3 class="page-header"><?php _e('admin.institutions') ?></h3>
<div class="row">
	<div class="col-md-6">
    	<?php if (Session::has('institution_added')): ?>
			<div class="alert alert-success alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				<?php _e('admin.institution_added') ?>
			</div>
		<?php endif ?>
        <?php if (Session::has('add_error')): ?>
			<div class="alert alert-danger alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				<?php _e('admin.institution_added_error') ?>
			</div>
		<?php endif ?>
        
		<?php if (Session::has('deleted')): ?>
			<div class="alert alert-success alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				<?php _e('admin.institution_deleted') ?>
			</div>
		<?php endif ?>
		<?php if (Session::has('delete_error')): ?>
			<div class="alert alert-danger alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				<?php _e('admin.institution_delete_error') ?>
			</div>
		<?php endif ?>
        
       
		<?php Session::deleteFlash(); ?>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<h4><?php _e('admin.institutions'); ?></h4>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th><?php _e('admin.institution_name') ?></th>
					<th><?php _e('admin.institution_users') ?></th>
					<th><?php _e('admin.action') ?></th>
				</tr>
			</thead>
			<tbody>
            
			<?php 
			$institutions = DB::table('institutions')->get();		
			foreach ($institutions as $institute): ?>
				<tr>
					<td><?php echo $institute->name?></td>
                    
					<?php  $adscriptions = DB::table('adscriptions')->where('institution_id', '=', $institute->id)->get(); ?>
                    
					<td class="word-break">
					<?php foreach ( $adscriptions as $ads) {
						$usr = User::find($ads->user_id);
						echo '<span class="label label-default" style="display: inline-block;">'.@$usr->display_name.'</span> ';
					} ?>
					</td>
					<td>
						<a href="?page=institution-edit&id=<?php echo $institute->id ?>" title="<?php _e('admin.edit_institution') ?>">
							<span class="glyphicon glyphicon-edit"></span></a> 
						<a href="?page=institutions&delete=<?php echo $institute->id ?>" title="<?php _e('admin.delete_institution') ?>">
							<span class="glyphicon glyphicon-trash"></span>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<div class="col-md-6">
		<h4><?php _e('admin.add_institution') ?></h4>
		
		<?php if (isset($errors)) {
			echo '<div class="alert alert-danger alert-dismissible"><span class="close" data-dismiss="alert">&times;</span><ul>';
			foreach ($errors->all('<li>:message</li>') as $error) {
			   echo $error;
			}
			echo '</ul></div>';
		} ?>

		<form action="" method="POST">
			<?php csrf_input() ?>
			
			<div class="form-group">
		        <label for="id"><?php _e('admin.institution_name') ?></label> <em><?php _e('admin.required') ?></em>
                <p class="help-block"><?php _e('admin.institution_name_help') ?></p>
		        <input type="text" name="name" id="name" value="<?php echo set_value('name') ?>" class="form-control">
		        
		    </div>

		    <div class="form-group">
		        <label for="label"><?php _e('admin.institution_users') ?></label>
                <p class="help-block"><?php _e('admin.institution_users_help') ?></p>
				<?php
                  $users = DB::table('users')->get();
                  foreach ($users as $usr) {
                      $user = User::find($usr->id);
                      ?>
                      <div class="checkbox">
                        <label for="adscrip[]">
                        <input name="adscrip[]" type="checkbox" 
                             value="<?php echo $user->id ?>">
                            <?php echo $user->prefix. " " . $user->first_name . " ". $user->last_name;  ?>
                        </label>
                      </div>
                      <?php       
                  }
                ?>
		        
		    </div>

		   

		    <div class="form-group">
		    	<button type="submit" name="submit" class="btn btn-primary"><?php _e('admin.add_institution') ?></button>
		    </div>
		</form>
	</div>
</div>

<?php echo View::make('admin.footer')->render() ?>