<?php if (!Auth::userCan('manage_events')) page_restricted(); ?>

<?php echo View::make('admin.header')->render() ?>

<h3 class="page-header">
	Eventos 
</h3>

<link href="<?php echo asset_url('css/vendor/dataTables.bootstrap.css') ?>" rel="stylesheet">
<script src="<?php echo asset_url('js/vendor/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/dataTables.bootstrap.js') ?>"></script>
	<?php if (!Auth::userCan('manage_researchareas')): ?>
			<div class="alert alert-warning alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				Por tu nivelde permisos, no puedas editar o agregar Areas de Investigación.
			</div>
		<?php endif ?>
		<?php if (!Auth::userCan('manage_projects')): ?>
			<div class="alert alert-warning alert-dismissible">
				<span class="close" data-dismiss="alert">&times;</span>
				Por tu nivelde permisos, no puedas editar o agregar Proyectos.
			</div>
		<?php endif ?>

<div class="row">
		<a class="btn btn-primary btn-lg" href="?page=events-new"> Agregar Nuevo Evento</a>
        <br><br>
		<?php
		$lang = 'es_MX.UTF-8';
		$langArray =  array('es_MX.UTF-8', "esm", "spanish-mexican");//'es_MX.utf8'; 
		putenv('LC_ALL=' . $lang);
		setlocale(LC_ALL, $langArray);
		
		$now = new DateTime();			
		$allevents = DB::select(' SELECT *  FROM events  ORDER BY start_time DESC');
		
		$lastBlockOpen=false;
		$lastBlock=-1;
		$newBlock=true;
		$blockTitle=array("Eventos futuros", "Eventos de este mes", "Eventos pasados");
		$blockClass=array("label label-primary", "label label-success", "label label-default");
        foreach ($allevents as $singleevent) {
			$formato = 'Y-m-d H:i:s';
			$date = DateTime::createFromFormat($formato, $singleevent->start_time);
			if( ($date->format("Y") > $now->format("Y")) || 
				($date->format("Y") == $now->format("Y") &&  $date->format("m") > $now->format("m")))
			{
//				$blockTitle="Eventos futuros";
				$currentBlock=0;
			}elseif( ($date->format("Y") == $now->format("Y") &&  $date->format("m") == $now->format("m")))
			{
	//			$blockTitle="Eventos de este mes";
				$currentBlock=1;
			}elseif( ($date->format("Y") < $now->format("Y")) || 
				($date->format("Y") == $now->format("Y") &&  $date->format("m")< $now->format("m")))
			{
				$currentBlock=2;
	//			$blockTitle="Eventos pasados";
			}
			
			if($currentBlock!=$lastBlock)
			{
				if($lastBlockOpen)
				{	
					?>
                    		</div>
                    	</div>
                    </div>
                 <?php
                }
				$lastBlockOpen=true;
				?>
                 	<div class="panel panel-default">
						<div class="panel-heading">
							<h4><?php echo $blockTitle[$currentBlock]; ?></h4>
						</div>
						<div class="panel-body">
                        	 <div class="list-group">
             <?php    
			 }
			 $lastBlock=$currentBlock;
			 ?>
             
            <a href="?page=events-edit&id=<?php echo $singleevent->id;?>" class="list-group-item" >
            
            
            <p><span class="<?php echo $blockClass[$currentBlock]?> mrg18" >
            		<span class="glyphicon glyphicon-calendar"></span>
					<?php echo strftime("%A %d de %B, %Y", $date->getTimestamp()) ?>
            	</span>
                &nbsp;&nbsp;
                <span class="label label-info mrg18" >
                    <span class="glyphicon glyphicon-time"></span>
                    <?php echo $date->format("H").":".$date->format("m"); ?>
                </span>
                &nbsp;&nbsp;
            	<strong>
				<?php echo "  ".$singleevent->title;  ?>
            	</strong> 
            </p>
            </a>
        <?php
		}
		if($lastBlockOpen)
		{	
			?>
					</div>
				</div>
			</div>
		 <?php
		}
		?>
        	
</div>
<?php echo View::make('admin.footer')->render() ?>