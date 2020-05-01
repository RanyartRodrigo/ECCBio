		</div>
	</div>
<div class="footer">
	<div class="container">
		<ul class="footer-links">
		
		</ul>
		<p>&copy; <?php echo date('Y', time()) .' '. Config::get('app.name'); ?></p>
	</div>
</div>

<?php echo View::make('modals.load')->render() ?>

</body>
</html>