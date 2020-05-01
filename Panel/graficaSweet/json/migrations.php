<?php	
$tiempo=$_GET['t'];
$modelo=$_GET['m'];
	if(isset($_GET['callback'])){ // Si es una petición cross-domain                
		echo $_GET['callback'].'('.json_encode(demo($tiempo,$modelo)).')';
	}        
	else{ // Si es una normal, respondemos de forma normal                
		echo json_encode(demo($tiempo,$modelo));        
	}
        function demo($tiempo,$modelo){
		$nE=0;
		$nR=0;
		if (($fichero = fopen("../../uploads/csv/".$modelo."-".$tiempo.".csv", "r")) !== FALSE) {
    			while (($datosP = fgetcsv($fichero)) !== FALSE) {
				if($nE>0){
					for($i=0;$i<count($datosP);$i++){
						if($i>1)
						$datos[$i-2][$nE-1]=$datosP[$i];

					}
					$nombre[$nE-1]=$datosP[0];
					if($datosP[1]==1){
						$nombre[$nE-1]=strtoupper($datosP[0]);
                                        	$regiones[$nR]=$nE-1;
						$nR++;
					}
				}
				$nE++;
    			}
		}
		$nE--;
		$return='
                {"names":[';
                for($x=0;$nE>$x;$x++){
                        if($x!=($nE-1))$return.='"'.$nombre[$x].'",';
                        else $return.='"'.$nombre[$x].'"';
                }
                $return.='
                ],"regions":[';
                for($x=0;count($regiones)>$x;$x++){
                        if($x==0)$return.=$regiones[$x].',';
                        else if($x!=(count($regiones)-1))$return.=$regiones[$x].',';
                        else $return.=$regiones[$x];
                }
                $return.='],"matrix":{"'.$tiempo.'":[
                ';
		
		for($y=0;$y<$nE;$y++){
	                $return.='[';
			for($x=0;$x<$nE;$x++){
				if($x!=($nE-1))
                                	$return.=(($datos[$x][$y])*100000).',';
                                else
                                        $return.=(($datos[$x][$y])*100000);
			}
			if($y!=($nE-1))
                                $return.='],';
                        else
                                $return.=']';

		}
                $return.='
                ]}}
                ';
                return $return;
        }

	function demo2($tiempo){
		$regiones=array(0,3,37,62,76,90,98,103,113,116);
		$nombre=array("NorthAmerica","Canada","UnitedStates","Africa","Algeria","Angola","BurkinaFaso","Burundi","Cameroon","Chad","DRCongo","Egypt","Eritrea","Ethiopia","Ghana","Guinea","IvoryCoast","Kenya","Liberia","Libya","Malawi","Mali","Morocco","Mozambique","Nigeria","Rwanda","Senegal","SierraLeone","Somalia","SouthAfrica","SouthSudan","Sudan","Tanzania","Togo","Uganda","Zambia","Zimbabwe","Europe","Albania","Austria","Belgium","Bosnia&Herzegovina","Bulgaria","Croatia","CzechRepublic","Denmark","France","Germany","Greece","Hungary","Ireland","Italy","Netherlands","Norway","Poland","Portugal","Romania","Serbia","Spain","Sweden","Switzerland","UnitedKingdom","FmrSovietUnion","Armenia","Azerbaijan","Belarus","Georgia","Kazakhstan","Kyrgyzstan","Latvia","Lithuania","Moldova","Russia","Tajikistan","Ukraine","Uzbekistan","WestAsia","Iraq","Israel","Jordan","Kuwait","Lebanon","Oman","Palestine","Qatar","SaudiArabia","Syria","Turkey","UnitedArabEmirates","Yemen","SouthAsia","Afghanistan","Bangladesh","India","Iran","Nepal","Pakistan","SriLanka","EastAsia","China","HongKong","Japan","SouthKorea","South-EastAsia","Brunei","Cambodia","Indonesia","Malaysia","Myanmar","Philippines","Singapore","Thailand","Vietnam","Oceania","Australia","NewZealand","LatinAmerica","Argentina","Bolivia","Brazil","Chile","Colombia","CostaRica","Cuba","DominicanRepublic","Ecuador","ElSalvador","Guatemala","Haiti","Honduras","Jamaica","Mexico","Nicaragua","Paraguay","Peru","PuertoRico","Venezuela");
		$return='
		{"names":[';
		for($x=0;count($nombre)>$x;$x++){
			if($x!=(count($nombre)-1))$return.='"'.$nombre[$x].'",';
			else $return.='"'.$nombre[$x].'"';
		}
		$return.='
		],"regions":[';
		for($x=0;count($regiones)>$x;$x++){
                        if($x==0)$return.=$regiones[$x].',';
			else if($x!=(count($regiones)-1))$return.=$regiones[$x].',';
                        else $return.=$regiones[$x];
                }
		$return.='],"matrix":{"'.$tiempo.'":[
		';
		$out=0;
		$in=0;
		$total=0;
		$salida=0;
		$totaln=6000000;
		$d=array();
		for($y=0;$y<=136;$y++){
			$return.='[';
			for($x=0,$a=0,$b=0,$n=0;$x<=136;$x++){
				if($x==0){
					if(in_array($y,$regiones)){
                                        	$return.=$a=rand(0,$totaln).',';
						$total=$a;
						$totaln=$totaln-$a;
					}
					else{
                                                if(!in_array(($y+1),$regiones)){
							$return.=$a=rand(0,$total/4).',';
                                                	$total=$total-$a;
						}
						else{
							$return.=$a=$total.',';
                                                        $total=$total-$a;
						}
                                        }
				}
				else if($x==1){
					$return.=$b=rand(0,$a).',';
                                        if(in_array($y,$regiones))
						$in=$b;
				}	
				else if($x==2){
					$return.=($a-$b).',';
                                        if(in_array($y,$regiones))
						$out=($a-$b);
                                }
				else if($x==3){
					if(in_array($y,$regiones)){
						$return.=$n=($totaln/10).',';
						$salida=$n;
					}
					else{
						if(in_array($y+1,$regiones))
							$return.=$n=$salida.',';
						else
							$return.=$n=rand(0,$salida).',';
						$salida=$salida-$n;
					}
				}
				else{
						$ne=rand(0,$n);
					
					if($x!=136)
						$return.=$ne.',';
					else
						$return.=$ne;
				$n=$n-$ne;
				}
			}
			if($y!=136)
				$return.='],';
			else
				$return.=']';
		}
		$return.='
		]}}
		';
		return $return;
	}

?>

