<?php echo View::make('admin.header')->render() ?>
	<script>
		$("#myModal").modal();
	</script>

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
            <p>
			<?php echo '<h3 class="page-header">'.trans('admin.page_restricted').'</h3>';
			_e('admin.restricted');
			
			$refering_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
			?>
    		</p>
            <?php if($refering_url!=""):?>
            	<a href="<?php echo $refering_url?>"> Regresar</a>
                <?php endif ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
    
      </div>
    </div>
<?php echo View::make('admin.footer')->render() ?>