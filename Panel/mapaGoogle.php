<?php
include "base.php";
include "host2.php";
$base=new Base($DB_server,$DB_user,$DB_name);
$result =$base->consulta("SELECT color FROM colores");
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
?>
<!DOCTYPE html>
<html>
  <head>



    <style>
#Estad {
    height: 70%;
    top: 50px;
    right: 0px;
    position: fixed;
    width: 300px;
margin-right:0px;
opacity:1;
transition:all ease 2s;
}
#Estad2 {
    height: 100%;
    top: 0px;
    left: 0px;
    position: fixed;
    width: 300px;
padding-left:10px;
margin-left:0px;
opacity:1;
transition:all ease 2s;
background:<?php echo $texto?>;
color:<?php echo $segundo?>;
    box-shadow: 3px 11px 20px 4px rgba(0, 0, 0, 0.48);
}

#Estad > p {
padding-right:0px;
text-align:right;
margin-bottom:4px;
margin-top:4px;
background: <?php echo $segundo?>;
    color: <?php echo $texto?>;
    box-shadow: 3px 11px 20px 4px rgba(0, 0, 0, 0.48);
    float: right;
    padding: 8px;
    border-bottom-left-radius: 100px;
    border-top-left-radius: 100px;
width:100%;
}
}
#Estad2 > p {
padding-left:10px;
}

.hiddeEst{
margin-right:-330px !important;
opacity:0.2 !important;
transition:all ease 2s;
}

.hiddeEst2{
margin-left:-330px !important;
opacity:0.2 !important;
transition:all ease 2s;
}

#back{
position:fixed;
bottom:20px;
right:50px;
z-index;10001;
width:150px;
height:50px;
background:<?php echo $texto?>;
color:<?php echo $segundo?>;
border-top:solid 2px;
border-bottom:solid 2px;
}

       #map {
        height: 100%;
        width: 100%;
	position: fixed;
	top:0px;
	bottom:0px;
       }
	body, html{
	width:100%;
	height:100%;
	padding:0px;
	margin:0px;}
	#cover{
	width:100%;
	height:100%;
	position: fixed;
	top:0px;
	left:0px;
	background:rgba(0,0,0,0.4);
        overflow:auto;
	}
	.hidden{
	display:none;
	}
ul img {
    width: 300px;
    position: absolute;
    left: 35%;
    border: solid 30px <?php echo $texto?>;
    box-shadow: 15px 6px 19px 0px;
    border-radius: 46px;
    border-top-left-radius: 0px;
margin-top:-29px;
}
ul p {
    padding-left:15px;
    background: <?php echo $texto?>;
    color:<?php echo $segundo?>;
    margin: 0px;
    padding-top: 5px;
    padding-bottom: 5px;
}
cerrar {
    position: fixed;
    top: 0px;
    right: 20px;
    font-size: 40px;
    width: 35px;
    height: 45px;
    padding-left: 8px;
    color: <?php echo $segundo?>;
    background:<?php echo $texto?>;
}
cerrar:hover {
cursor:pointer;
background:<?php echo $segundo?>;
color:<?php echo $texto?>;
}
#cover >ul {
    padding:0px;
    float: left;
    width: 30%;
    height: auto;
    margin-left: 5%;
    background:<?php echo $segundo?>;
box-shadow: 11px 7px 20px rgba(0, 0, 0, 0.65);
}
#cover>ul>li {
    float: none;
    list-style: none;
    margin: 7px;
}
@media (orientation: portrait){
#cover ul{
width: 90%;
    font-size: 25px;
}
#cover img{
    position: relative;
    width: 60%;
    left: 0px;
    right: 0px;
    margin-left: 20%;
    box-shadow: none;
    margin-top: 0px;
    border: none;
    border-radius: 0px;
}
.elemento{
    width: 50% !important;
}
}
    </style>
  </head>
  <body>
    <div id="map"></div>
    <div id="cover" class=""></div>
    <div id="Estad" class="hiddeEst"></div>
    <div id="Estad2" class="hiddeEst2"></div>

<script>


        function mapa(){
                  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 0, lng: 0},
    zoom: 3,
    mapTypeId:'satellite'
  });
<?php
$base->setBase("malawiTest");
$result =$base->consulta("SELECT * from encuestas");
$numfilas = $result->num_rows;
$img="";
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
    			alert('Encuesta: ".$fila->encuesta." Date:".$fila->fechaHora."');
		});
        polygon.setMap(map);
	";
}
echo $img;
?>

                     }
        </script>

         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiAmRBLWnQstHaFcyqfiW2tyJXV_OEyC4&callback=mapa" async defer></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script>
function GPS(){
$('#cover').load('contenido.php');
$('#back').addClass('hidden');
$('#Estad').addClass('hiddeEst');
}
function ENCUESTA(id){
$('#cover').removeClass('hidden');
$('#cover').load('contenido.php',{encuesta:id});
$('#back').addClass('hidden');
$('#Estad').addClass('hiddeEst');

}
function MAPA(id, back){
$('#cover').load('contenido.php',{mapa:id, mapaB:back});
$('#back').removeClass('hidden');
$('#Estad').addClass('hiddeEst');

}

GPS();
</script>
      
         
  </body>
</html>
