<?php
	//Reportar Errores
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);
		
	header('Access-Control-Allow-Origin: http://www.wegp.unam.mx',false);
	//echo 'Llegue';

	
	$type = $_REQUEST['type'];
	$images = $_REQUEST['img'];
	$imagesN = $_REQUEST['imgN'];
	$titulos = $_REQUEST['titulos'];
	$max = $_REQUEST['max'];
	$min = $_REQUEST['min'];
	$prec = $_REQUEST['prec'];
	$tmax = $_REQUEST['tmax'];
	$tmin = $_REQUEST['tmin'];
	$fecha = $_REQUEST['fecha'];
	$infoWindow = $_REQUEST['infoWindow'];
	$arrInfoTable = $_REQUEST['arrInfoTable'];
	$years = $_REQUEST['yearsPDF'];
	$caption = $_REQUEST['caption'];
	$caption2 = $_REQUEST['caption2'];
	$statics = $_REQUEST['statics'];

	
	//numero de imagenes
	$n = count($images);
		
	//ob_clean();
	//idNombre dada la fecha
	$name = date('jnyGis');
	//crear Directorio temporal
	exec("mkdir LaTeX/".$name."dir");
	exec("chmod -R 777 LaTeX/".$name."dir");

	// exec("touch id.txt");
	// exec("echo ".$name."dir>id.txt");


	//Guardar el tipo 0 para ANPS 1 y 3 para estados y poligonos
	exec("touch LaTeX/{$name}dir/tipo.txt && echo $type > LaTeX/{$name}dir/tipo.txt");
	exec("touch LaTeX/{$name}dir/fecha.txt && echo $fecha > LaTeX/{$name}dir/fecha.txt");
	//preparar archivos
	for($i = 0; $i < $n; $i++){

		//Crear las imagenes
	 	$id = $i+1;
	 	file_put_contents("LaTeX/{$name}dir/$id.png", file_get_contents($images[$i]));
	 	file_put_contents("LaTeX/{$name}dir/{$id}N.png", file_get_contents($imagesN[$i]));

	 	//Crear los titulos
	 	$titEspecial = html_entity_decode($titulos[$i]);
	 	
	 	// $titEspecial .= "cañon";
	 	//exec("touch LaTeX/{$name}dir/titulo{$id}.txt && echo $titulos[$i] > LaTeX/{$name}dir/titulo{$id}.txt");
	 	exec("touch LaTeX/{$name}dir/titulo{$id}.txt && echo $titEspecial > LaTeX/{$name}dir/titulo{$id}.txt");

	 	
	 	
	 	//crear los .csv
		$csv = fopen("LaTeX/{$name}dir/$id.csv", 'w');
		// $data = array(
		// 	array('hola','qioen','eres'),
		// 	array(1,2,2),
		// 	array(5,4,3)
		// );
		$data = array(
			array('Periodo', 				"Valor-Maximo", 		"Valor-Minimo"),
			array('1950-1979',				round($max[$i][0],2), 	round($min[$i][0],2)),
			array('1980-2009',				round($max[$i][1],2), 	round($min[$i][1],2)),
			array('2015-2039(RCP-4.5)',	round($max[$i][2],2), 	round($min[$i][2],2)),
			array('2015-2039(RCP-8.5)',	round($max[$i][3],2), 	round($min[$i][3],2)),
			array('2075-2099(RCP-4.5)',	round($max[$i][4],2), 	round($min[$i][4],2)),
			array('2075-2099(RCP-8.5)',	round($max[$i][5],2), 	round($min[$i][5],2))
		);
		// save each row of the data
		foreach ($data as $row){
			fputcsv($csv, $row);
		}
		// // Close the file
		fclose($csv);

		// //Guardar las restas
		exec("touch LaTeX/{$name}dir/info{$id}.txt");
		
		$var1 = round($tmax[$i][4]-$tmax[$i][2],2);
		exec("echo $var1 >> LaTeX/{$name}dir/info{$id}.txt");
		
		$var2 = round($tmax[$i][6]-$tmax[$i][2],2);
		exec("echo $var2 >> LaTeX/{$name}dir/info{$id}.txt");
		
		$var3 = round($tmin[$i][4]-$tmin[$i][2],2);
		exec("echo $var3 >> LaTeX/{$name}dir/info{$id}.txt");
		
		$var4 = round($tmin[$i][6]-$tmin[$i][2],2);
		exec("echo $var4 >> LaTeX/{$name}dir/info{$id}.txt");
		
		$var5 = round($prec[$i][4]-$prec[$i][2],2);
		exec("echo $var5 >> LaTeX/{$name}dir/info{$id}.txt");
		
		$var6 = round($prec[$i][6]-$prec[$i][2],2);
		exec("echo $var6 >> LaTeX/{$name}dir/info{$id}.txt");

		//InfoWindow reporte
		$temps = $infoWindow[$i];
		//media
		exec("touch LaTeX/{$name}dir/infoMedia{$id}.txt");
		exec("echo {$temps[0]} > LaTeX/{$name}dir/infoMedia{$id}.txt");
		//max
		exec("touch LaTeX/{$name}dir/infoMax{$id}.txt");
		exec("echo {$temps[1]} > LaTeX/{$name}dir/infoMax{$id}.txt");
		//min
		exec("touch LaTeX/{$name}dir/infoMin{$id}.txt");
		exec("echo {$temps[2]} > LaTeX/{$name}dir/infoMin{$id}.txt");
		//prec
		exec("touch LaTeX/{$name}dir/infoPrec{$id}.txt");
		exec("echo {$temps[3]} > LaTeX/{$name}dir/infoPrec{$id}.txt");

		//infoTabla
		exec("touch LaTeX/{$name}dir/infoTabla{$id}.txt");
		$arrayInfo = $arrInfoTable[$i];
		for ($l=0; $l < 61; $l++) {
			exec("echo {$arrayInfo[$l]} >> LaTeX/{$name}dir/infoTabla{$id}.txt");

		}
		//years
		exec("touch LaTeX/{$name}dir/years{$id}.txt");
		$arrayInfo = $years[$i];
		for ($l=0; $l < 33; $l++) {
			exec("echo {$arrayInfo[$l]} >> LaTeX/{$name}dir/years{$id}.txt");
		}

		//caption
		exec("touch LaTeX/{$name}dir/caption{$id}.txt");
		$arrayInfo = $caption[$i];
		for ($l = 0; $l < 2; $l++){
			exec("echo {$arrayInfo[$l]} >> LaTeX/{$name}dir/caption{$id}.txt");			
		}

		//caption
		exec("touch LaTeX/{$name}dir/caption2{$id}.txt");
		$arrayInfo = $caption2[$i];
		for ($l = 0; $l < 4; $l++){
			exec("echo {$arrayInfo[$l]} >> LaTeX/{$name}dir/caption2{$id}.txt");			
		}

		//statics
		exec("touch LaTeX/{$name}dir/statics{$id}.txt");
		$arrayInfo = $statics[$i];
		for ($l = 0; $l < 25; $l++){
			exec("echo {$arrayInfo[$l]} >> LaTeX/{$name}dir/statics{$id}.txt");			
		}

	

		
		
		
		


	}//fin de For preparar archivos
	
	//file_put_contents("LaTeX/".$name."dir/1.png", file_get_contents($images[0]));
	exec("cp LaTeX/templates/latexTemplate11.tex LaTeX/{$name}dir/");
	exec("cp LaTeX/templates/title.tex LaTeX/{$name}dir/");
	exec("cp LaTeX/templates/*.sty LaTeX/{$name}dir/");
	exec("mkdir LaTeX/{$name}dir/logos");
	exec("cp LaTeX/templates/logos/*.png LaTeX/{$name}dir/logos/");
	//exec("cp LaTeX/templates/logos/*.svg LaTeX/{$name}dir/logos/");
	//exec("cp LaTeX/templates/conabioLogo.jpg LaTeX/{$name}dir/conabioLogo.jpg");
	exec("rubber -d --shell-escape --into=LaTeX/{$name}dir LaTeX/{$name}dir/latexTemplate11.tex && mv LaTeX/{$name}dir/latexTemplate11.pdf LaTeX/{$name}dir/$name.pdf");
	//generar PDF
	//exec("pdflatex -output-directory=./LaTeX/".$name."dir -jobname=".$name." ./LaTeX/templates/latexTemplate".$n.".tex");

	//enviar reporte
	$ret = "http://www.mofuss.unam.mx/Mapps/Conabio/reportesPDF/LaTeX/{$name}dir/$name.pdf";
	echo json_encode($ret);

	//limpiar archivos
	//exec("sleep 2");
	//exec("rm -rf LaTeX/".$name."*");

	//exec("pdflatex -jobname=".$name." latexTemplate".$n$.".tex");
	//$ret = 'http://www.mofuss.unam.mx/Mapps/Conabio/reportesPDF/LaTeX/'.$name.'.pdf';
	//echo json_encode($ret);
	//$pdf->Output($_SERVER['DOCUMENT_ROOT'].'Mapps/Conabio/reportesPDF/pdf/'.$name.'.pdf', 'F');
	//$ret = 'http://www.mofuss.unam.mx/Mapps/Conabio/reportesPDF/pdf/'.$name.'.pdf';
	//echo json_encode($ret);	
	//exec("{ sleep 10; rm -fr ".$_SERVER['DOCUMENT_ROOT']."Mapps/Conabio/reportesPDF/LaTeX/{$name}dir } > /dev/null 2>/dev/null &");
	//exec("{ sleep 10; rm -fr ./LaTeX/{$name}dir; } > /dev/null 2>/dev/null &");
?>
