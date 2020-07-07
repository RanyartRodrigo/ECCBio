<?php
include "../../../host.php";
function active_menu($items) { 
	return in_array(@$_GET['page'], explode('|', $items))?'active':'';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="<?php echo csrf_token() ?>">
	<link href="<?php echo asset_url('img/favicon.png') ?>" rel="icon">
	
	<title><?php echo Config::get('app.name') ?> | Admin</title>
    
    
	<link href="<?php echo asset_url('trumbowyg/dist/ui/trumbowyg.css') ?>" rel="stylesheet">
	<link href="<?php echo asset_url('css/vendor/bootstrap.min.css') ?>" rel="stylesheet">
	<link href="<?php echo asset_url('css/bootstrap-custom.css') ?>" rel="stylesheet">
	<link href="<?php echo asset_url('css/admin.css') ?>" rel="stylesheet">
        <link href="<?php echo asset_url('css/colors/general.php') ?>" rel="stylesheet">
	<!-- <link href="<?php echo asset_url('css/flat.css') ?>" rel="stylesheet"> -->
	
	<?php $color = Config::get('app.color_scheme'); ?>
	<link href="<?php echo asset_url("css/cursos.php") ?>" rel="stylesheet">
	
	<script src="<?php echo asset_url("js/vendor/jquery-1.11.1.min.js") ?>"></script>
    <script src="<?php echo asset_url("js/vendor/jquery.moveSelected.js") ?>"></script>
	<script src="<?php echo asset_url("js/vendor/bootstrap.min.js") ?>"></script>
	<script src="<?php echo asset_url('js/easylogin.js') ?>"></script>
	<script src="<?php echo asset_url("js/admin.js") ?>"></script>
    <script src="<?php echo asset_url('trumbowyg/dist/trumbowyg.js') ?>"></script>
	<script>
		EasyLogin.options = {
			baseUrl: '<?php echo App::url() ?>',
			ajaxUrl: '<?php echo App::url("ajax.php") ?>',
			lang: <?php echo json_encode(trans('admin.js')) ?>,
			debug: <?php echo Config::get('app.debug')?1:0 ?>
		};
		
		
	</script>
        <link rel="stylesheet" href="<?php echo asset_url("js/arbol/dist/themes/default/style.min.css")?>" />
        <script src="<?php echo asset_url("js/arbol/dist/jstree.min.js")?>"></script>

</head>
<body>
	<div class="navbar navbar-fixed-top navbar-top">
    	<div class="container">
        	<div class="navbar-header">
         		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            		<span class="sr-only">Toggle navigation</span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
          		</button>
      			
                
      			
          		<a href="<?php echo App::url() ?>" class="navbar-brand">Inicio</a>
        	</div>
        	<div class="navbar-collapse collapse">
	          	<ul class="nav navbar-nav">
                	<li class="<?php echo active_menu('return') ?>">
			<a href=<?php echo $appRoot; ?>><span class="glyphicon glyphicon-hand-left"></span> Sitio Web CONABIO</a>
                    </li>
                    
	            	<li class="<?php echo active_menu('dashboard') ?>">
	            		<a href="?page=dashboard"><span class="glyphicon glyphicon-home"></span> <?php _e('admin.dashboard') ?></a>
	            	</li>
                    
                      
                     	<li class="dropdown <?php echo active_menu('CONABIO') ?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
								<span class="glyphicon glyphicon-user"></span> <?php _e('admin.CONABIO') ?> <b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<?php if (Auth::userCan('Country')): ?>
									<li><a href="?page=MoFuSS&part=country"><?php _e('admin.Country') ?></a></li>
								<?php endif ?>
								<?php if (Auth::userCan('Layers')): ?>
									<li><a href="?page=MoFuSS&part=layers"><?php _e('admin.Layers') ?></a></li>
								<?php endif ?>		
								<?php if (Auth::userCan('LayersStyle')): ?>
									<li><a href="?page=MoFuSS&part=layersStyle"><?php _e('admin.LayersStyle') ?></a></li>
								<?php endif ?>	
								<?php if (Auth::userCan('Columns')): ?>
									<li><a href="?page=MoFuSS&part=columns"><?php _e('admin.Columns') ?></a></li>
								<?php endif ?>
                                                                <?php if (Auth::userCan('Panel')): ?>
                                                                        <li><a href="?page=MoFuSS&part=panel"><?php _e('admin.Panel') ?></a></li>
                                                                <?php endif ?>
                                                                <?php if (Auth::userCan('Identificadores')): ?>
                                                                        <li><a href="?page=MoFuSS&part=identificadores"><?php _e('admin.Identificadores') ?></a></li>
                                                                <?php endif ?>
								<?php if (Auth::userCan('Galeria')): ?>
                                                                        <li><a href="?page=MoFuSS&part=galeria"><?php _e('admin.Galeria') ?></a></li>
                                                                <?php endif ?>
                                                                <?php if (Auth::userCan('Diagram')): ?>
                                                                        <li><a href="?page=MoFuSS&part=diagram"><?php _e('admin.Diagram') ?></a></li>
                                                                <?php endif ?>

								<?php if (Auth::userCan('Suelo')): ?>
                                                                        <li><a href="?page=MoFuSS&part=usoSuelo"><?php _e('admin.Suelo') ?></a></li>
                                                                <?php endif ?>
                                                                <?php if (Auth::userCan('Submenus')): ?>
                                                                        <li><a href="?page=MoFuSS&part=submenus"><?php _e('admin.Submenus') ?></a></li>
                                                                <?php endif ?>
                                                                        <li><a href="?page=MoFuSS&part=migration"><?php _e('admin.Migracion') ?></a></li>



							</ul>
						</li>
	            	
		            	<li class="dropdown <?php echo active_menu('users|user-new|user-edit|user-roles|user-fields') ?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
								<span class="glyphicon glyphicon-user"></span> <?php _e('admin.users') ?> <b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<?php if (Auth::userCan('list_users')): ?>
									<li><a href="?page=users"><?php _e('admin.all_users') ?></a></li>
								<?php endif ?>
								
								<?php if (Auth::userCan('add_users')): ?>
									<li><a href="?page=user-new"><?php _e('admin.add_user') ?></a></li>
								<?php endif ?>
								
								<?php if (Auth::userCan('manage_roles')): ?>
									<li><a href="?page=user-roles"><?php _e('admin.roles') ?></a></li>
								<?php endif ?>
                                
                                <?php if (Auth::userCan('manage_fields')): ?>
									<li><a href="?page=user-fields"><?php _e('admin.fields') ?></a></li>
								<?php endif ?>

								<?php if (Auth::userCan('manage_institutions')): ?>
									<li><a href="?page=institutions"><?php _e('admin.institutions') ?></a></li>
								<?php endif ?>
                                

							</ul>
						</li>
				

					
					<?php if (Auth::userCan('manage_settings') && Config::getLoader()->getDBLoader()): ?>
						<li class="dropdown <?php echo active_menu('options-app|options-auth|options-services|options-mail|options-pms|options-comments') ?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
								<span class="glyphicon glyphicon-cog"></span> <?php _e('admin.settings') ?> <b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="?page=options-app"><?php _e('admin.options_general') ?></a></li>
								<li><a href="?page=options-auth"><?php _e('admin.options_auth') ?></a></li>
								<li><a href="?page=options-comments"><?php _e('admin.options_comments') ?></a></li>
								<li><a href="?page=options-pms"><?php _e('admin.options_pms') ?></a></li>
								<li><a href="?page=options-services"><?php _e('admin.options_services') ?></a></li>
								<li><a href="?page=options-mail"><?php _e('admin.options_mail') ?></a></li>
							</ul>
						</li>
					<?php endif ?>
	          	</ul>
	          	<ul class="nav navbar-nav navbar-pull-right">
	          		<li class="dropdown <?php echo active_menu('profile') ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
							<?php echo Auth::user()->display_name ?>
							<img src="<?php echo Auth::user()->avatar ?>" class="avatar"> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="profile.php?u=<?php echo Auth::user()->id ?>"><?php _e('admin.my_profile') ?></a></li>
							<li><a href="settings.php"><?php _e('admin.settings') ?></a></li>
							<li><a href="?logout"><?php _e('admin.logout') ?></a></li>
						</ul>
					</li>
	          	</ul>
        	</div>
      	</div>
    </div>
    <div class="container">

     <!-- Compose email Modal -->
	<div class="modal fade" id="composeModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<form action="sendEmail" class="ajax-form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title"><?php _e('admin.compose_email') ?></h4>
					</div>
					<div class="modal-body">
		          		<div class="alert"></div>
						
						<div class="form-group">
			                <input type="text" name="to" placeholder="<?php _e('admin.to') ?>" class="form-control">
			            </div>

			            <div class="form-group">
			                <input type="text" name="subject" placeholder="<?php _e('admin.subject') ?>" class="form-control">
			            </div>

			            <div class="form-group">
			                <textarea class="form-control" name="message" placeholder="<?php _e('admin.message') ?>" rows="5"></textarea>
			            </div>

			            <div class="help-block"><?php _e('admin.add_multiple_emails') ?></div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><?php _e('admin.cancel') ?></button>
						<button type="submit" class="btn btn-primary"><?php _e('admin.send') ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>

