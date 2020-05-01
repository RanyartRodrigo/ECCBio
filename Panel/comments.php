<?php require_once 'app/init.php'; ?>

<?php echo View::make('header')->render() ?>
    
<div class="row">
	<div class="col-md-8">
		<h3 class="page-header">Comentarios</h3>

		<p>Los comentarios sólo se pueden ecribir si has iniciado sesión.</p>
		
		<?php echo ajax_comments('1', 'My page'); ?>

		<!-- Embeded version with iframe -->
		<!--
		<div id="embed_comments"></div>
		<script src="<?php echo asset_url('js/embed-comments.js') ?>"></script>
		<script> embedComments('#embed_comments', '1', 'My Page'); </script>
		-->
	</div>
</div>

<?php echo View::make('footer')->render() ?>