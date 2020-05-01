<?php
require_once 'app/init.php';
	  
$users = User::where('role_id', '<>', 1)
		->orderBy('display_name', 'asc')->get();

if(!empty($_GET['already'])){
	$alreadyIds = explode("-", $_GET['already']);
	foreach($users as $user)
	{
		if(!in_array($user->id, $alreadyIds)) 
		{
		?>
			<div class="input-group" >
				<span class="input-group-addon">
					<input type="checkbox" aria-label="..."
                       	id="check<?php echo $_GET['type']."-".$user->id ?>" 
                        value="<?php echo $user->id."-".
                        $user->prefix." ".$user->first_name." ".$user->last_name; ?>">
				</span>
				<label for="check<?php echo $_GET['type']."-".$user->id ?>" class="form-control" aria-label="..." >
				<?php echo $user->prefix." ".$user->first_name." ".$user->last_name; ?>
                </label>
			</div><!-- /input-group -->
		<?php
		}
	}
}else{
	foreach($users as $user)
	{
	?>
			<div class="input-group" >
				<span class="input-group-addon">
					<input type="checkbox" aria-label="..."
                       	id="check<?php echo $_GET['type']."-".$user->id ?>" 
                        value="<?php echo $user->id."-".
                        $user->prefix." ".$user->first_name." ".$user->last_name; ?>">
				</span>
				<label for="check<?php echo $_GET['type']."-".$user->id ?>" class="form-control" aria-label="..." >
				<?php echo $user->prefix." ".$user->first_name." ".$user->last_name; ?>
                </label>
			</div><!-- /input-group -->
		<?php
	}
}
?>
