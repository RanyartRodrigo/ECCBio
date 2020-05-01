<?php if (!Auth::userCan('manage_courses')) page_restricted(); ?>

<?php echo View::make('admin.header')->render() ?>

<h3 class="page-header">
	Courses
</h3>

<link href="<?php echo asset_url('css/vendor/dataTables.bootstrap.css') ?>" rel="stylesheet">
<script src="<?php echo asset_url('js/vendor/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo asset_url('js/vendor/dataTables.bootstrap.js') ?>"></script>
<script src="<?php echo asset_url('js/sweetalert.min.js') ?>"></script>
<link href="<?php echo asset_url('css/sweetalert.css') ?>" rel="stylesheet"/>
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
		<a class="btn btn-primary btn-lg" href="?page=courses-new"> Agregar Nuevo Curso</a>
        <br><br>
		<?php
		$lang = 'es_MX.UTF-8';
		$langArray =  array('es_MX.UTF-8', "esm", "spanish-mexican");//'es_MX.utf8'; 
		putenv('LC_ALL=' . $lang);
		setlocale(LC_ALL, $langArray);
		
		$now = new DateTime();			
		$allcourses = DB::select(' SELECT *  FROM cursos  ORDER BY inicio DESC');
		
		$lastBlockOpen=false;
		$lastBlock=-1;
		$newBlock=true;
		$blockTitle=array("Cursos futuros", "Cursos de este mes", "Cursos pasados");
		$blockClass=array("label label-primary", "label label-success", "label label-default");
        foreach ($allcourses as $singleevent) {
			$formato = 'Y-m-d';
			$date = DateTime::createFromFormat($formato, $singleevent->inicio);
			if( ($date->format("Y") > $now->format("Y")) || 
				($date->format("Y") == $now->format("Y") &&  $date->format("m") > $now->format("m")))
			{
//				$blockTitle="Cursos futuros";
				$currentBlock=0;
			}elseif( ($date->format("Y") == $now->format("Y") &&  $date->format("m") == $now->format("m")))
			{
	//			$blockTitle="Cursos de este mes";
				$currentBlock=1;
			}elseif( ($date->format("Y") < $now->format("Y")) || 
				($date->format("Y") == $now->format("Y") &&  $date->format("m")< $now->format("m")))
			{
				$currentBlock=2;
	//			$blockTitle="Cursos pasados";
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
             
            <a href="?page=courses-edit&id=<?php echo $singleevent->id;?>" class="list-group-item" >
            
            
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
				<?php echo "  ".$singleevent->nombre;  ?>
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