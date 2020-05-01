<?php
		require_once("TCPDF-master/examples/tcpdf_include.php");
		require_once("TCPDF-master/tcpdf.php");
		require_once("TCPDF-master/config/tcpdf_config.php");
		//ini_set('display_errors', 1);
		//ini_set('display_startup_errors', 1);
		//error_reporting(E_ALL);
		
		header('Access-Control-Allow-Origin: http://www.wegp.unam.mx',false);
		//echo 'Llegue';

	class MYPDF extends TCPDF
	{
		public function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('helvetica', 'I', 10);
			$this->Cell(0,10, 'https://www.gob.mx/conabio', 0, false, 'C', 0, '', 0, false, 'T', 'M');
		}
	}
		$type = $_REQUEST['type'];
		$images = $_REQUEST['img'];
		$titulos = $_REQUEST['titulos'];
		$max = $_REQUEST['max'];
		$min = $_REQUEST['min'];
		$prec = $_REQUEST['prec'];
		$tmax = $_REQUEST['tmax'];
		$tmin = $_REQUEST['tmin'];
		//die (print_r($tmax));
		$n = count($images);
		//$periodos = ['1910-1949', '1950-1979', '1980-2009', '2015-2039 (RCP 4.5)', '2015-2039 (RCP 8.5)', '2075-2099 (RCP 4.5)','2075-2099 (RCP 8.5)'];
		$periodos = ['1950-1979', '1980-2009', '2015-2039 (RCP 4.5)', '2015-2039 (RCP 8.5)', '2075-2099 (RCP 4.5)','2075-2099 (RCP 8.5)'];
		$pdf = new MYPDF('p', 'mm', 'A4');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		
		for($i = 0; $i < $n; $i++){
			$estructura = 0;
			$infoCont = 0;
		     	$pdf->AddPage();
			$titulo= '<H1>'.$titulos[$i].'</H1>';
                        $grafica ='<div style="text-align:center"><p><img src="'.$images[$i].'" style= "width: 350px; height: 330px;"></p></div>';
			$tabla = '<table border ="1" ><tr><th>Periodo</th><th>V. min</th><th>V.max</th></tr>';
                        do{
                           $tabla .= "<tr>";
                           $tabla .= "<td>".$periodos[$estructura]."</td>";
                           $tabla .= "<td>".$min[$i][$estructura]."</td>";
                           $tabla .= "<td>".$max[$i][$estructura]."</td>";
                           $tabla .= "</tr>";
                           $estructura++;
                        }//while($estructura < 7);
                        while($estructura < 6);
			$tabla .= "</table>";
			
                       
			//$info = '<style>.hr{background-color: #CFAA36; width: 100%; height: 3px;}</style>';
			//$info .= '<table><tbody>';
			
			$info = '<style>.hr{background-color: #CFAA36; size:10;}td.container>div{width: 10%;height: 5%;overflow:hidden;}.container{height: 2px;}</style><table border = "0">';
		       //$info .= '<hr size="1000">';		


		       $info .= '<tr><td bgcolor="#CFAA36" color="#34303A"><b>Cambio proyectado (RCP 8.5)</b></td></tr>';
		       $info .= '<tr><td><b>La temperatura máxima en el ANP excederá el promedio histórico por:</b></td></tr>';
		       $info .= '<tr><td>'.round($tmax[$i][4]-$tmax[$i][2],2).'°C para el período 2015-2039'.'</td></tr>';
			$info .= '<tr><td>'.round($tmax[$i][6]-$tmax[$i][2],2).'°C para el período 2075-2099'.'</td></tr>';
			//$info .= '<tr><td class="hr"></td></tr>';
			//$info .= '<tr><td><div style="font-size: 10px; height: 10px;"><hr style="size: 10px; background-color:red;"></div></td></tr>';
			$info .= '<tr class="hr"><td class="container"></td></tr>';
			//$info .= '<tr><td bgcolor="#7F6F6E" color="white">Temperatura mínima</td></tr>';
                        $info .= '<tr><td><b>La temperatura mínima en el ANP excederá el promedio histórico por:</b></td></tr>';
                        $info .= '<tr><td>'.round($tmin[$i][4]-$tmin[$i][2],2).'°C para el período 2015-2039'.'</td></tr>';
                        $info .= '<tr><td>'.round($tmin[$i][6]-$tmin[$i][2],2).'°C para el período 2075-2099'.'</td></tr>';
			$info .= '<tr class="hr"><td></td></tr>';
		        //$info .= '<tr><td  bgcolor="#7F6F6E" color="white">Precipitación</td></tr>';
                        $info .= '<tr><td><b>La precipitación promedio en el ANP excederá el promedio histórico por:</b></td></tr>';
                        $info .= '<tr><td>'.round($prec[$i][4]-$prec[$i][2],2).'mm para el período 2015-2039'.'</td></tr>';
                        $info .= '<tr><td>'.round($prec[$i][6]-$prec[$i][2],2).'mm para el período 2075-2099'.'</td></tr>';
			$info .= '<tr class="hr"><td></td></tr>';
			$info .= '</table>';
			//$info .= '</tbody></table>';
			$pdf->writeHTML($titulo, true, false, true, false, '');
			if($type==0)
	                        $pdf->writeHTML($info, true, false, true, false, '');
			$pdf->writeHTML($grafica, true, false, true, false, '');
	                $pdf->writeHTML($tabla, true, false, true, false, '');
			$pdf->lastPage();
		}
		//die(print_r($info));
	ob_clean();
	$name = date('jnyGis');
	$pdf->Output($_SERVER['DOCUMENT_ROOT'].'Mapps/Conabio/reportesPDF/pdf/'.$name.'.pdf', 'F');
	$ret = 'http://www.mofuss.unam.mx/Mapps/Conabio/reportesPDF/pdf/'.$name.'.pdf';
	echo json_encode($ret);	
	exec("{ sleep 10; rm -f ".$_SERVER['DOCUMENT_ROOT']."Mapps/Conabio/reportesPDF/pdf/$name.pdf; } > /dev/null 2>/dev/null &");
?>
