<?php require_once 'app/init.php'; ?>

<?php echo View::make('header')->render() ?>

<div class="jumbotron" style="text-align: center; background: none;">
	<h1><?php _e('main.welcome') ?></h1>

 	<div style="margin-top: 50px;">
 		<?php if (Auth::guest()): ?>
			<a href="login.php" class="btn btn-primary"><?php _e('main.login') ?></a> &nbsp;
			<!--<a href="signup.php" class="btn btn-primary"><?php _e('main.signup') ?></a>-->
		<?php endif ?>
 	</div>


 	<div style="min-height: 100px"></div>
</div>
	<?php if (!Auth::guest()): ?>
    <div>
    	<p> Esta es la página de Administración del sitio web de CONABIO. Aquí podrá:</p>
        <p> De clic en el icono del engrane  <span class="glyphicon glyphicon-cog"></span> para acceder al <em>Dashboard</em>, que
        muestra un resumen de los usuarios registrados. </p>
        <p> Si quiere modificar información de perfil, de clic en su imagen o nombre (arriba-derecha) y a continuación seleccione la opción <em>Configuración</em>.
        
            
        
    </div>
    <?php endif ?>

<?php echo View::make('footer')->render() ?>