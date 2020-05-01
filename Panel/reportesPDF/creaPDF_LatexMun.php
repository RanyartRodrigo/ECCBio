<?php
	//Reportar Errores
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);	
	$type = $_REQUEST['type'];
	$images = $_REQUEST['img'];
	$imagesN = $_REQUEST['imgN'];
	$titulos = $_REQUEST['titulos'];
	$max = $_REQUEST['max'];
	$min = $_REQUEST['min'];
	$fecha = $_REQUEST['fecha'];
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
	exec("mkdir -Z -m 0776 LaTeX/".$name."dir");
	//exec("whoami",$output);
	//exec("chmod -R 777 LaTeX/".$name."dir");
	//exec("chown apache:webmaster -R LaTeX/{$name}dir");

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
	 	//file_put_contents("LaTeX/{$name}dir/{$id}P.png", file_get_contents($imagesP[$i]));

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
	exec("cp LaTeX/templates/templateMun.tex LaTeX/{$name}dir/");
	exec("cp LaTeX/templates/title.tex LaTeX/{$name}dir/");
	//exec("cp LaTeX/templates/referencias.bib LaTeX/{$name}dir/");
	//exec("cp LaTeX/templates/*.sty LaTeX/{$name}dir/");
	exec("cp -r LaTeX/templates/fonts LaTeX/{$name}dir/");
	exec("mkdir LaTeX/{$name}dir/logos");
	exec("cp LaTeX/templates/logos/*.png LaTeX/{$name}dir/logos/");
	
	//exec("cp LaTeX/templates/logos/*.svg LaTeX/{$name}dir/logos/");
	//exec("cp LaTeX/templates/conabioLogo.jpg LaTeX/{$name}dir/conabioLogo.jpg");
	//exec("chown -r apache:webmaster LaTeX/{$name}dir/");
	//$comandoRubber = "echo avantasia3 | su roberto -c 'chcon -t httpd_sys_rw_content_t LaTeX/{$name}dir -R;rubber -d -m xelatex --shell-escape --into=LaTeX/{$name}dir LaTeX/{$name}dir/template.tex && mv LaTeX/{$name}dir/template.pdf LaTeX/{$name}dir/$name.pdf'";
	//exec($comandoRubber);
	exec("chmod 777 LaTeX/{$name}dir/*");
	$name2 = "ReporteECCB".$name;
	$comandoRubber2 = "cd LaTeX/{$name}dir; /usr/local/texlive/2018/bin/x86_64-linux/xelatex --shell-escape -interaction=nonstopmode templateMun.tex && /usr/local/texlive/2018/bin/x86_64-linux/xelatex --shell-escape -interaction=nonstopmode templateMun.tex && mv templateMun.pdf $name2.pdf";
	//$comandoRubber2 = "cd LaTeX/{$name}dir; xelatex --shell-escape -interaction=nonstopmode template.tex&&xelatex --shell-escape -interaction=nonstopmode template.tex&&mv template.pdf $name2.pdf";
	//$comandoRubber22 = "/usr/local/texlive/2018/bin/x86_64-linux/xelatex --shell-escape -interaction=nonstopmode template.tex&&mv template.pdf $name.pdf";
	//exec("echo '$comandoRubber22' > LaTeX/{$name}dir/script.sh; chmod 777 LaTeX/{$name}dir/script.sh");
	//exec($comandoRubber2);
	exec("echo '$comandoRubber2' > LaTeX/{$name}dir/script.sh; chmod 777 LaTeX/{$name}dir/script.sh");
	exec("bash LaTeX/{$name}dir/script.sh > LaTeX/{$name}dir/output.txt 2> LaTeX/{$name}dir/error.txt");
	//exec("rubber -d -m xelatex --shell-escape --into=LaTeX/{$name}dir LaTeX/{$name}dir/template.tex && mv LaTeX/{$name}dir/template.pdf LaTeX/{$name}dir/$name.pdf");
	//exec("lualatex --shell-escape --into=LaTeX/{$name}dir LaTeX/{$name}dir/template.tex && mv LaTeX/{$name}dir/template.pdf LaTeX/{$name}dir/$name.pdf");
	//generar PDF
	//exec("pdflatex -output-directory=./LaTeX/".$name."dir -jobname=".$name." ./LaTeX/templates/latexTemplate".$n.".tex");

	//enviar reporte
	
	$ret = "http://www.wegp.unam.mx/admin/Conabio2/reportesPDF/LaTeX/{$name}dir/$name2.pdf";
	echo json_encode($ret);
	//echo $comandoRubber2;
	//print_r($output);
	//echo json_encode($output);
	//print_r($output);

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
