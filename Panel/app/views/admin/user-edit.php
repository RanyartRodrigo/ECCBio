<?php if (!Auth::userCan('edit_users')) page_restricted();
	include '../../../base.php';
	include '../../../host2.php';

 $obj=new Base($DB_server,$DB_user,$DB_name);
if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
	redirect_to('?page=users');
}

//require_once '/var/www/lanase/panel/app/init.php';
//require_once '/app/init.php';


$user = User::find($_GET['id']);
$currentAdscriptions = DB::table('adscriptions')->where('user_id', '=', $_GET['id'])->get();


if (isset($_POST['submit']) && csrf_filter()) {

	$data = array(
    	'email'    => $_POST['email'],
    	'password' => $_POST['pass1'],
        'country' => $_POST['id_Pais'],
    	'password_confirmation' => $_POST['pass2'],
    	'role'     => $_POST['role'],
    	'status'   => $_POST['status']
    );

	$rules = array(
    	'email'    => 'required|email|max:100|unique:users,email,'.$user->id,
    	'password' => 'between:4,30|confirmed',
    	'role'     => 'required',
    	'status'   => 'required'
    );

    if (Config::get('auth.require_username')) {
    	$data['username'] = $_POST['username'];
    	$rules['username'] = 'required|min:3|max:50|alpha_dash|unique:users,username,'.$user->id;
    }

    foreach (UserFields::all('admin') as $key => $field) {
    	if (!empty($field['validation'])) {
    		$data[$key] = @$_POST[$key];
    		$rules[$key] = $field['validation'];
    	}
    }
	
	$validator = Validator::make($data, $rules);

	if ($validator->passes()) {
		$displayName = escape(@$_POST['display_name']);
		
		if (empty($displayName) && !empty($_POST['username'])) {
			$displayName = $_POST['username'];
		}

		if (Config::get('auth.require_username')) {
			$user->username = $_POST['username'];
		}

		if (!empty($_POST['pass1'])) {
			$user->password = Hash::make($_POST['pass1']);
		}
                $user->country            = $_POST['id_Pais'];
		$user->email 		= $_POST['email'];
		$user->display_name = $displayName;
		$user->role_id 		= (int) $_POST['role'];
		$user->status 		= (int) $_POST['status'];

		if ($user->save()) {

			//otros campos
			foreach (UserFields::all('admin') as $key => $field) {
				Usermeta::update($user->id, $key, escape(@$_POST[$key]), @$user->usermeta[$key]);
			}
			
			redirect_to('?page=user-edit&id='.$user->id, array('user_updated' => true));
		} else {
			$errors = new Hazzard\Support\MessageBag(array('error' => trans('errors.dbsave')));
		}
	} else {
		$errors = $validator->errors();
	}
}
?>

<?php echo View::make('admin.header')->render() ?>

<h3 class="page-header"><?php _e('admin.edit_user') ?></h3>
<p><a href="?page=users"><?php _e('admin.back_to_users') ?></a></p>

<link href="<?php echo asset_url('bootstrap-toggle-master/css/bootstrap-toggle.min.css') ?>" rel="stylesheet">
<script src="<?php echo asset_url('bootstrap-toggle-master/js/bootstrap-toggle.js') ?>"></script>
<script src="<?php echo asset_url('js/bibtex_button.js') ?>"></script>
<script>
$(function(){
$("#opmenus").on("click",function(){
$("#id_Pais").val($("#opmenus").val());
$("#id_PaisAux").val($("#opmenus > option[value='"+$("#opmenus").val()+"']").text());
});$("#opmenus").on("click",function(){
$("#id_Pais").val($("#opmenus").val());
$("#id_PaisAux").val($("#opmenus > option[value='"+$("#opmenus").val()+"']").text());
});
			
		});
</script>

<div class="row">
	<div class="col-md-6">

		<?php if (isset($errors)) {
			echo '<div class="alert alert-danger alert-dismissible"><span class="close" data-dismiss="alert">&times;</span><ul>';
			foreach ($errors->all('<li>:message</li>') as $error) {
			   echo $error;
			}
			echo '</ul></div>';
		} ?>
		
		<?php if (Session::has('user_updated')): Session::deleteFlash(); ?>
			<div class="alert alert-success alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				<?php _e('admin.user_updated') ?>
			</div>
		<?php endif ?>

		<?php if ($user): ?>
			<form action="?page=user-edit&id=<?php echo $user->id ?>" method="POST">
				<?php csrf_input() ?>
				
				

				<?php if (Config::get('auth.require_username')): ?>
					<div class="form-group">
				        <label for="username"><?php _e('admin.username') ?> <em><?php _e('admin.required') ?></em></label>
				        <input type="text" name="username" id="username" value="<?php echo $user->username ?>" class="form-control">
				    </div>
			    <?php endif ?>

			    <div class="form-group">
			        <label for="email"><?php _e('admin.email') ?> <em><?php _e('admin.required') ?></em></label>
			        <input type="text" name="email" id="email" value="<?php echo $user->email ?>" class="form-control">
			    </div>

				<?php if (UserFields::has('first_name') && UserFields::has('last_name')): ?>
					<div class="form-group">
				        <label for="display_name"><?php _e('main.display_name') ?></label>
				        <select name="display_name" id="display_name" class="form-control">
				        <?php if (Config::get('auth.require_username')): ?>
                            <option <?php echo $user->display_name == $user->username ? 'selected' : '' ?>><?php echo $user->username ?></option>
                            <?php endif ?>
                            
                            <?php if (!empty($user->first_name)): ?>
                            <option <?php echo $user->display_name == "$user->prefix  $user->first_name" ? 'selected' : '' ?>>
							<?php echo "$user->prefix  $user->first_name" ?></option>
                            <?php endif ?>

                            
                            <?php if (!empty($user->last_name)): ?>
                            <option <?php echo $user->display_name == "$user->prefix $user->last_name " ? 'selected' : '' ?>>
							<?php echo "$user->prefix $user->last_name "?></option>
                            <?php endif ?>
                            
                            
                            <?php if (!empty($user->first_name) && !empty($user->last_name)): ?>
                            <option <?php echo $user->display_name == "$user->prefix $user->first_name $user->last_name" ? 'selected' : '' ?>><?php echo "$user->prefix $user->first_name $user->last_name" ?></option>
                            
                            <?php endif ?>
                            
                            <?php if (!empty($user->first_name)): ?>
                            <option <?php echo $user->display_name == $user->first_name ? 'selected' : '' ?>><?php echo $user->first_name ?></option>
                            <?php endif ?>
                            
                            <?php if (!empty($user->last_name)): ?>
                            <option <?php echo $user->display_name == $user->last_name ? 'selected' : '' ?>><?php echo  $user->last_name ?></option>
                            <?php endif ?>
                            
                            <?php if (!empty($user->first_name) && !empty($user->last_name)): ?>
                            <option <?php echo $user->display_name == "$user->first_name $user->last_name" ? 'selected' : '' ?>><?php echo  "$user->first_name $user->last_name" ?></option>
                            
                            <?php endif ?>
				        </select>
				    </div>
				<?php endif ?>

	            <div class="form-group">
	            	<label for="role"><?php _e('admin.role') ?></label>
	            	<select name="role" id="role" class="form-control">
	            		<option value=""> </option>
						<?php foreach ((array) Role::all() as $role) {
							echo '<option value="'.$role->id.'" '.($user->role_id == $role->id ? 'selected' : '').'>'.$role->name.'</option>';
						} ?>
					</select>
	            </div>

	             <div class="form-group">
	            	<label for="status"><?php _e('admin.account_status') ?></label>
	            	<select name="status" id="status" class="form-control">
	            		<option value="0" <?php echo (int)$user->status === 0 ? 'selected' : ''; ?>><?php _e('admin.unactivated') ?></option>
						<option value="1" <?php echo (int)$user->status === 1 ? 'selected' : ''; ?>><?php _e('admin.activated') ?></option>
						<option value="2" <?php echo (int)$user->status === 2 ? 'selected' : ''; ?>><?php _e('admin.suspended') ?></option>
					</select>
	            </div>
                
	            <br>
	            <p><em><?php _e('admin.newpassinfo') ?></em></p>

				<div class="form-group">
			        <label for="pass1"><?php _e('admin.newpassword') ?></label>
			        <input type="password" name="pass1" id="pass1" class="form-control" autocomplete="off" value="">
			    </div>

			    <div class="form-group">
			        <label for="pass2"><?php _e('admin.newpassword_confirmation') ?></label>
			        <input type="password" name="pass2" id="pass2" class="form-control" autocomplete="off">
			    </div>
    <div class="form-group">
              <label for="name">Pais: </label>
                            <?php
              $result = $obj->consulta("SELECT id_Pais, nombre FROM paises order by nombre ASC");

  $numfilas = $result->num_rows;
  $final="";
  if($numfilas>0){
    echo "<select id='opmenus'>";
  for($x=0;$x<$numfilas;$x++){
  $fila = $result->fetch_object();
  if($fila->id_Pais==$user->country){
      echo "<option value='".$fila->id_Pais."' selected>".$fila->nombre."</option>";
      $final=$fila->nombre;
      $finalAux=$fila->id_Pais;

    }
  else
  echo "<option value='".$fila->id_Pais."' >".$fila->nombre."</option>";
  
}
echo "</select>";
}
              ?>
              <input type="text" name="name" id="id_PaisAux" value="<?php if(isset($final)) echo $final?>" class="form-control">
              <input type="number" name="id_Pais" id="id_Pais" value="<?php if(isset($finalAux)) echo $finalAux?>" class="form-control hidden">
          </div>

	            <br>
	            <div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary"><?php _e('admin.update_user') ?></button>
				</div>
			</form>
		<?php else: ?>
			<div class="alert alert-danger"><?php _e('errors.userid') ?></div>
		<?php endif ?>
	</div>

	<div class="col-md-6">
		<?php if (!empty($user->lastLogin)): ?>
			<p><?php _e('admin.last_login') ?> <?php echo with(new DateTime($user->lastLogin))->format('M j, Y \a\t H:i'); ?></p>
		<?php endif ?>
		<?php if (!empty($user->lastLoginIp)): ?>
			<p><?php _e('admin.last_login_ip') ?> <a href="https://who.is/whois-ip/ip-address/<?php echo $user->lastLoginIp; ?>" target="_blank"><?php echo $user->lastLoginIp; ?></a></p>
		<?php endif ?>
	</div>
</div>

<?php echo View::make('modals.bibtex')->render() ?>

<script>$(function(){ 
			<!--$("#adscriptionsDiv").load("admin.php?page=user-adscriptions.php&id=24");-->
			EasyLogin.generateDisplayName() });</script>

<?php echo View::make('admin.footer')->render() ?>

