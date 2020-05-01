<?php
include "base.php";
$obj=new Base("localhost","root","global");
$result =$obj->consulta("SELECT color FROM colores");
$numfilas = $result->num_rows;
for ($x=0;$x<$numfilas;$x++) {
    $fila = $result->fetch_object();
    if($x==0)
        $primero=$fila->color;
    if($x==1)
        $segundo=$fila->color;
    if($x==2)
        $cajas=$fila->color;
    if($x==3)
        $texto=$fila->color;
}

$obj->setBase("malawiTest");
if(isset($_POST['encuesta'])){
echo "<div class='elemento' id='' title=''><h7></h7><p>Encuesta CSV</p></div>";
$result = $obj->consulta( "SELECT idEncuesta as id, nombreCSV as a FROM encuesta where idGPS=".$_POST['encuesta']." order by idEncuesta ASC");
$numfilas = $result->num_rows;
for ($x=0;$x<$numfilas;$x++) {
      $fila = $result->fetch_object();
      $y=$x+1;
      echo "<div class='elemento' id='".$fila->id."-".$lista."' onClick='MAPA(this.title, ".$_POST['encuesta'].")' title='".$fila->id."'>";
        echo '<p>-- '.$fila->id.'-'.$fila->a.' --</p>';
        echo "</div>";
}
      echo "<div class='elemento' id='' onClick='GPS()' title=''><h7></h7><p>BACK</p></div>";

}
else if(isset($_POST['mapa'])){
$m=$_POST['mapa'];
$minX=1000;
$minY=1000;
$maxX=-1000;
$maxY=-1000;

$img="
<style>
#back{
position:fixed;
bottom:20px;
right:50px;
z-index;10001;
width:150px;
height:50px;
background:$texto;
color:$segundo;
border-top:solid 2px;
border-bottom:solid 2px;
}
</style>
";
$ac2=array('Bluegam','Tea branches (Makuli)','Tea stumps','Mango','Pears (avocado)','Cyndrea','Stalks of pigeon peas','Stalks of cassava (Nakotongwa)','Gmelina','Kweranyani','Bamboo (Nsungwi)','Hedges','Keisha','Mibawa','Anaphini','Other/Specify');
$ac3=array('Gather deadwood','Pruning branches from living trees','Cut whole living trees','Remove dead stumps','Other/Specify');
$ac4=array('Headload','Bicycle','Motorcycle','Vehicle','Draft animal','Draft animal cart','Wheelbarrow','Other/Specify');
$d2=array('Bluegam','Tea branches (Makuli)','Tea stumps','Mango','Pears (avocado)','Cyndrea','Stalks of pigeon peas','Stalks of cassava (Nakotongwa)','Gmelina','Kweranyani','Bamboo (Nsungwi)','Hedges','Keisha','Mibawa','Anaphini','Other/Specify');
$d3=array('Headload','Bicycle','Motorcycle','Vehicle','Draft animal','Draft animal cart','Wheelbarrow','Other/Specify');
$e2=array('Bluegam','Tea branches (Makuli)','Tea stumps','Mango','Pears (avocado)','Cyndrea','Stalks of pigeon peas','Stalks of cassava (Nakotongwa)','Gmelina','Kweranyani','Bamboo (Nsungwi)','Hedges','Keisha','Mibawa','Anaphini','Other/Specify');
$e3=array('Headload','Bicycle','Motorcycle','Vehicle','Draft animal','Draft animal cart','Wheelbarrow','Other/Specify');
$res=array('a.','b.','c.','d.','e.','f.','g.','h.','i.','j.','k.','l.','m.','n.','o.','p.','q.','r.','s.','t.','u.','v.');
$primera=array('Collecting or cutting firewood and taking it back to household','Cutting wood to let dry for firewood (left at the spot)','Collecting firewood that was previously cut and left to dry','Selling firewood','Buying firewood','Working at tea plantation','Working at crop field','Grazing','Selling food','Market','Mill','Wash clothes','Fish','Other/Specify');
$img.="
<script>
function cerrarCover(){
$('#back').removeClass('hidden');
	$('#cover').addClass('hidden');
}
$('cerrar').on('click',function(){
$('#cover').addClass('hidden');
});
$('#back').remove();
$('#cover').after('<button id=\'back\'>Back</button>');
$('#back').attr('onClick','ENCUESTA(this.title)');
$('#back').attr('title','".$_POST['mapaB']."');

$('#cover').addClass('hidden');
                  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 0, lng: 0},
    zoom: 3
  });
";
$result =$obj->consulta("SELECT * from encuestaD where idEncuesta in (".$m.")");
$numfilas = $result->num_rows;
for ($x=0;$x<$numfilas;$x++) {
        $fila = $result->fetch_object();
$p=substr($fila->poligono,1,strlen($fila->poligono)-1);
$arra=explode("],[",$p);
        $img.="
        var Coords = [";

        for($i=0;$i<count($arra);$i++){
                $arra[$i]=str_replace("[","",$arra[$i]);
                $arra[$i]=str_replace("]","",$arra[$i]);
                $coo=explode(",", $arra[$i]);
		if($minX>$coo[1])$minX=$coo[1];
                if($minY>$coo[0])$minY=$coo[0];
                if($maxX<$coo[1])$maxX=$coo[1];
                if($maxY<$coo[0])$maxY=$coo[0];
                if($i==count($arra)-1)
                        $img.="{lat:".$coo[1]." ,lng:".$coo[0]."}";
                else
                        $img.="{lat:".$coo[1]." ,lng:".$coo[0]."},";
        }

        $img.="
        ];

        var polygon = new google.maps.Polygon({
          paths: Coords,
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35
        });

                google.maps.event.addListener(polygon, 'click', function (event) {
$('#back').addClass('hidden');
                        ";
$img.="
$('#cover').html('<ul>";
$img.="<p>Which of the following activities were you doing here? </p>";
$n=0;
        for($n=0;$n<(count($primera)-1);$n++){
                if(strpos($fila->b1,$b1[$n])!==false || strpos($fila->b1,$res[$n])!==false)
                        $img.="<li><input type=\'checkbox\' checked disabled/>".$primera[$n]."</li>";
                else
                        $img.="<li><input type=\'checkbox\' disabled/>".$primera[$n]."</li>";
        }
$aux=explode($res[$n],$fila->b1);
	if(strpos($fila->b1,$b1[$n])!==false || strpos($fila->b1,$res[$n])!==false)
        	$img.="<li><input type=\'checkbox\' checked disabled/>Other: ".$aux[1]."</li>";
        else
                $img.="<li><input type=\'checkbox\' disabled/>".$primera[$n]."</li>";

if(strpos($fila->b1,'a.')!==false || strpos($fila->b1,'c.')!==false ){
$img.="<p>How much firewood did you carry back to the household from this spot?</p>";
$foto=explode("|",$fila->ac1);
if($foto[1]!="")$img.="<img src=\'malawi/".$foto[1].".jpg\'/>";
$img.="<li>".$foto[0]."</li>";
$img.="<p>What type of wood did you get?</p>";
	for($n=0;$n<(count($ac2)-1);$n++){
		if(strpos($fila->ac2,$ac2[$n])!==false || strpos($fila->ac2,$res[$n])!==false)
			$img.="<li><input type=\'checkbox\' checked disabled/>".$ac2[$n]."</li>";
		else
			$img.="<li><input type=\'checkbox\' disabled/>".$ac2[$n]."</li>";
	}
$aux=explode($res[$n],$fila->ac2);
        if(strpos($fila->ac2,$ac2[$n])!==false || strpos($fila->ac2,$res[$n])!==false)
                $img.="<li><input type=\'checkbox\' checked disabled/>Other: ".$aux[1]."</li>";
        else
                $img.="<li><input type=\'checkbox\' disabled/>".$ac2[$n]."</li>"; 
$img.="<p>How did you harvest it?</p>";
        for($n=0;$n<(count($ac3)-1);$n++){
                if(strpos($fila->ac3,$ac3[$n])!==false || strpos($fila->ac3,$res[$n])!==false)
                        $img.="<li><input type=\'checkbox\' checked disabled/>".$ac3[$n]."</li>";
                else
                        $img.="<li><input type=\'checkbox\' disabled/>".$ac3[$n]."</li>";
        }
$aux=explode($res[$n],$fila->ac3);
        if(strpos($fila->ac3,$ac3[$n])!==false || strpos($fila->ac3,$res[$n])!==false)
                $img.="<li><input type=\'checkbox\' checked disabled/>Other: ".$aux[1]."</li>";
        else
                $img.="<li><input type=\'checkbox\' disabled/>".$ac3[$n]."</li>";
$img.="<p>How did you bring it back home?</p>";
        for($n=0;$n<(count($ac4)-1);$n++){
                if(strpos($fila->ac4,$ac4[$n])!==false || strpos($fila->ac4,$res[$n])!==false)
                        $img.="<li><input type=\'checkbox\' checked disabled/>".$ac4[$n]."</li>";
                else
                        $img.="<li><input type=\'checkbox\' disabled/>".$ac4[$n]."</li>";
        }
$aux=explode($res[$n],$fila->ac4);
        if(strpos($fila->ac4,$ac4[$n])!==false || strpos($fila->ac4,$res[$n])!==false)
                $img.="<li><input type=\'checkbox\' checked disabled/>Other: ".$aux[1]."</li>";
        else
                $img.="<li><input type=\'checkbox\' disabled/>".$ac4[$n]."</li>";

}
if(strpos($fila->b1,'d.')!==false ){
$img.="<p>How much firewood did you sell at this spot?</p>";
$foto=explode("|",$fila->d1);
              if($foto[1]!="")  $img.="<img src=\'malawi/".$foto[1].".jpg\'/>";
$img.="<li>".$foto[0]."</li>";
$img.="<p>What type of wood did you sell?</p>";
        for($n=0;$n<(count($d2)-1);$n++){
                if(strpos($fila->d2,$d2[$n])!==false || strpos($fila->d2,$res[$n])!==false)
                        $img.="<li><input type=\'checkbox\' checked disabled/>".$d2[$n]."</li>";
                else
                        $img.="<li><input type=\'checkbox\' disabled/>".$d2[$n]."</li>";
        }
$aux=explode($res[$n],$fila->d2);
        if(strpos($fila->d2,$d2[$n])!==false || strpos($fila->d2,$res[$n])!==false)
                $img.="<li><input type=\'checkbox\' checked disabled/>Other: ".$aux[1]."</li>";
        else
                $img.="<li><input type=\'checkbox\' disabled/>".$d2[$n]."</li>";
$img.="<p>How did you bring it to the seller?</p>";
        for($n=0;$n<(count($d3)-1);$n++){
                if(strpos($fila->d3,$d3[$n])!==false || strpos($fila->d3,$res[$n])!==false)
                        $img.="<li><input type=\'checkbox\' checked disabled/>".$d3[$n]."</li>";
                else
                        $img.="<li><input type=\'checkbox\' disabled/>".$d3[$n]."</li>";
        }
$aux=explode($res[$n],$fila->d3);
        if(strpos($fila->d3,$d3[$n])!==false || strpos($fila->d3,$res[$n])!==false)
                $img.="<li><input type=\'checkbox\' checked disabled/>Other: ".$aux[1]."</li>";
        else
                $img.="<li><input type=\'checkbox\' disabled/>".$d3[$n]."</li>";
}
if(strpos($fila->b1,'e.')!==false ){
$img.="<p>How much firewood did you buy at this spot?</p>";
 $foto=explode("|",$fila->ac1);
               if($foto[1]!="") $img.="<img src=\'malawi/".$foto[1].".jpg\'/>";
$img.="<li>".$foto[0]."</li>";
$img.="<p>What type of wood did you get?</p>"; 
        for($n=0;$n<(count($e2)-1);$n++){
                if(strpos($fila->e2,$e2[$n])!==false || strpos($fila->e2,$res[$n])!==false)
                        $img.="<li><input type=\'checkbox\' checked disabled/>".$e2[$n]."</li>";
                else
                        $img.="<li><input type=\'checkbox\' disabled/>".$e2[$n]."</li>";
        }
$aux=explode($res[$n],$fila->e2);
        if(strpos($fila->e2,$e2[$n])!==false || strpos($fila->e2,$res[$n])!==false)
                $img.="<li><input type=\'checkbox\' checked disabled/>Other: ".$aux[1]."</li>";
        else
                $img.="<li><input type=\'checkbox\' disabled/>".$e2[$n]."</li>";
$img.="<p>How did you bring it back home?</p>";
        for($n=0;$n<(count($e3)-1);$n++){
                if(strpos($fila->e3,$e3[$n])!==false || strpos($fila->e3,$res[$n])!==false)
                        $img.="<li><input type=\'checkbox\' checked disabled/>".$e3[$n]."</li>";
                else
                        $img.="<li><input type=\'checkbox\' disabled/>".$e3[$n]."</li>";
        }
$aux=explode($res[$n],$fila->e3);
        if(strpos($fila->e3,$e3[$n])!==false || strpos($fila->e3,$res[$n])!==false)
                $img.="<li><input type=\'checkbox\' checked disabled/>Other: ".$aux[1]."</li>";
        else
                $img.="<li><input type=\'checkbox\' disabled/>".$e3[$n]."</li>";

}
$img.="</ul> <cerrar onClick=\'cerrarCover()\'>X</cerrar>');
$('#cover').removeClass('hidden');";
$img.="
                });
        polygon.setMap(map);
        ";
}
$VX=($maxX+$minX)/2;
$VY=($maxY+$minY)/2;

$Zoom=round(($maxX-$minX)*10);
echo $img."
var pixelWidth=document.getElementById('map').clientWidth;
map.setCenter(new google.maps.LatLng(".$VX.", ".$VY."));
var GLOBE_WIDTH = 256; // a constant in Google's map projection
var angle = ".$maxX." - ".$minX.";
if (angle < 0) {
  angle += 360;
}
var zoom = Math.round((Math.log(pixelWidth * 360 / angle / GLOBE_WIDTH) / Math.LN2)*0.85);
map.setZoom(zoom);
</script>";
}
else{
echo "<div class='elemento' id='' title=''><h7></h7><p>GPS</p></div>";
//result = $obj->consulta( "SELECT idGPS as id, idGPS as a FROM identification order by idGPS ASC");
$result = $obj->consulta( "SELECT DISTINCT(idGPS) as id FROM encuesta order by id ASC");
$numfilas = $result->num_rows;
for ($x=0;$x<$numfilas;$x++) {
      $fila = $result->fetch_object();
      $y=$x+1;
      echo "<div class='elemento' id='".$fila->id."-".$lista."' onClick='ENCUESTA(this.title)' title='".$fila->id."'>";
        echo '<p>-- '.$fila->id.' --</p>';
        echo "</div>";
}
}
echo "
<style>
.hidden{
display:none;
}

@media (min-width: 800px){
.d, #lista {
    width: 500px;
    height: auto;
    box-shadow: 3px 11px 20px 4px rgba(0, 0, 0, 0.48);
    margin-left:20px;
    float:left;
    background: rgba(44, 45, 53, 0.86);
    color: white;
    overflow-y: auto;
    padding-bottom: 30px;
    border: solid 3px;
display:block !important;
}
#opciones{
display:none;
}
.elemento {
    width: 23% !important;
    margin-left: 1% !important;
    margin-right: 1% !important;
}
.elemento:hover {
    cursor:pointer;
    background: $segundo;
    color:black;
    transition:all ease 1s;
    font-size:16px !important;
}


}
.d select{
width:44%;
float:left;
margin-left:50%;
height:30px;
font-size:23px;
margin-bottom:-30px;
}
.elemento>h7 {
    float: left;
    margin-left: 10px;
}
.elemento>p {
        width: 100%;
    margin: 0px;
    text-align: center;
}
.elemento>span {
    padding-left: 15px;
}
.elemento {
    background: $texto;
    margin-left: 10%;
    margin-right: 10%;
    padding-top: 10px;
    padding-bottom: 10px;
    float: left;
    width: 80%;
    margin-top: 5px;
    transition:all ease 1s;
   color:$segundo;
    border-top:1px solid;
    border-bottom:1px solid;
}
.elemento:first-child {
    background: $segundo;
   color:$texto;

}
.elemento:hover {
    cursor:pointer;
    background: $segundo;
    color:$texto;
    transition:all ease 1s;
    font-size:25px;
}
#lista button {
    margin: 10px;
    width: 30px;
    height: 30px;
    font-size: 17px;
    font-weight: bolder;
}
#lista button:hover {
    background:$primero;
    color:$segundo;
    cursor:pointer;
}
@media (max-width: 799px){
.d, #lista {
    width: 100%;
    height: auto;
    box-shadow: 3px 11px 20px 4px rgba(0, 0, 0, 0.48);
    margin: auto;
    background: rgba(44, 45, 53, 0.86);
    color: white;
    overflow-y: auto;
    padding-bottom: 30px;
    border: solid 3px;
}

}

@media (orientation: portrait){
.elemento {
    width: 98% !important;
    font-size: 30px;
}
.d, #lista {
    width: 100%;
    height: auto;
    box-shadow: 3px 11px 20px 4px rgba(0, 0, 0, 0.48);
    margin: auto;
    background: rgba(44, 45, 53, 0.86);
    color: white;
    overflow-y: auto;
    padding-bottom: 30px;
    border: solid 3px;
}
.d *{
font-size:25px !important;
line-height:55px !important;
min-height: 55px  !important;
}
.d select{
margin-bottom: -120px !important;
    margin-top: 80px !important;
width:90% !important;
margin-left:5% !important;
}
.i {
    width: 90% !important;
    float: left;
    height: 30px;
    font-size: 16px;
    line-height: 30px;
    text-align:center !important;
    padding-left: 20px;
    margin-bottom: 10px;
    margin-left:5% !important;
}
.i2 {
    width: 80% !important;
    float: left;
    height: 30px;
    font-size: 16px;
    line-height: 30px;
    text-align:center !important;
    padding-left: 20px;
    margin-bottom: 10px;
    margin-left:5% !important;
}

.l{
    width: 90% !important;
    float: left;
    height: 30px;
    line-height: 30px;
    text-align: center !important;
    margin-left:5% !important;

}
}
.t {
    text-align: center;
}
.i {
    width: 45%;
    float: left;
    height: 30px;
    font-size: 16px;
    line-height: 30px;
    text-align: left;
    padding-left: 20px;
    margin-bottom: 10px;
}
.i2 {
    width: 39%;
    float: left;
    height: 30px;
    font-size: 16px;
    line-height: 30px;
    text-align: left;
    padding-left: 20px;
    margin-bottom: 10px;
}

.l{
    width: 45%;
    float: left;
    height: 30px;
    font-size: 16px;
    line-height: 30px;
    text-align: right;
    padding-right: 20px;
    margin-bottom: 10px;
}
.aceptar {
    width: 45%;
    float: right;
    padding: 5px;
    margin-right: 5%;
}
.eliminar {
    width: 45%;
    float: left;
    padding: 5px;
    margin-left: 5%;
}
#opciones {
    width: 500px;
    margin: auto;
    height: 60px;
}
#opciones>button {
    width: 46%;
    margin-left: 2.5%;
    height: 40px;
    font-size: 25px;
}
</style>
";
?>
