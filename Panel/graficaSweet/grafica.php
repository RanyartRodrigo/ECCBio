<?php
$t=$_GET['t'];
$m=$_GET['m'];
	if(isset($_GET['callback'])){ // Si es una petición cross-domain
                echo $_GET['callback'].'('.json_encode(grafica($t,$m)).')';
        }
        else{ // Si es una normal, respondemos de forma normal
                echo json_encode(grafica($t,$m));
        }

	function grafica($t,$m){
		include '../host.php';
		include '../base.php';
        	$base=new Base("localhost","root","conabio");
		$echo='
			<div id=container><!-- class="container"-->
				<header role="banner"></header>
				<div class="wrap">
					<main role="main">
						<nav role=navigation>
							<div id="timeline"></div>
						</nav>
						<div id="diagram"></div>
					</main>
				</div>
			</div>
			<footer role="contentinfo"></footer>
			<script>
				function graficaSweet(tiempo,modelo) {	
					$.ajax({
            					url : "'.$host.'graficaSweet/json/migrations.php",
            					dataType : "jsonp",
            					data: {
							format:"json",
							t:tiempo,
							m:modelo
						},
            					type:"POST",
            					success: function(json) {									
									var datas= JSON.parse(json);
									console.log(datas);
									var aLittleBit = Math.PI / 100000;
										var now = tiempo;
										var chart = Globalmigration.chart(datas, {
											element: "#diagram",
											now: now,
											animationDuration: 500,
											margin: 125,
											arcPadding: 0.04,
											layout: {
												alpha: 0,
												threshold: 50000,
												labelThreshold: 5000,
												colors:[';
		$result =$base->consulta("SELECT colors from migracion where anio=".$t." and modelo='".$m."'");
        	$numfilas = $result->num_rows;
                $fila = $result->fetch_object();
        	$colors=explode(",",$fila->colors);
		for($x=0;$x<count($colors);$x++){
			if(($x+1)!=count($colors))
                		$echo.='"'.$colors[$x].'",';
			else
				$echo.='"'.$colors[$x].'"';
        	}
												$echo.=']
											}
										});
										Globalmigration.timeline(chart, {
											now: now,
											element: "#timeline",
											incr: 1
										});
										chart.draw(now);
									
								}
						});
			}
			graficaSweet('.$t.',"'.$m.'");
		</script>';
	return $echo;
	}
?>


