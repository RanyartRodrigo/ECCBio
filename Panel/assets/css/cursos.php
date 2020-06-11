<?php
header('content-type:text/css');
include "../../base.php";
include "../../host2.php";

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

if(isset($_GET['color'])){
    $primero="#".$_GET['color'];
}
$fondo=$segundo;
echo <<<FINCSS
.showMensaje{
right:0px !important;
opacity: 1 !important;
        transition: all ease 2s;
}
.mensaje>p {
    color: $segundo;
    font-size: 14px;
    text-align: center;
    margin-top: 14px;
    font-weight: bolder;
}
.mensaje{
	transition: all ease 2s;
    opacity:0;
    background: $texto;
    width: 200px;
    height: 50px;
    position: fixed;
    top: 50px;
    right: -1000px;

}
.cortina {
    background: $texto;
    
    z-index: 100001;
    position: fixed;
}
.next {
    z-index: 10000000;
    position: fixed;
    font-size: 60px !important;
    bottom: 230px;
    margin: auto;
    right: 0px;
    color: $segundo;
    background: $texto;
    width: 50px;
line-height:54px !important;
    height: 53px;
    border-radius: 35px;
}
.back {
      z-index: 10000000;
    position: fixed;
    font-size: 60px !important;
    bottom: 230px;
    margin: auto;
    left: 0px;
    color: $segundo;
    background: $texto;
    width: 50px;
line-height:54px !important;
    height: 53px;
    border-radius: 35px;

}
.closer {
z-index: 10000000;
    position: fixed;
    font-size: 60px !important;
    bottom: 230px;
    margin: auto;
    right: 0px;
    left: 0px;
    color: $fondo;
    background: $texto;
    width: 50px;
line-height:54px !important;
    height: 53px;
    border-radius: 35px;
}

.next:hover, .back:hover, .closer:hover {
color:$texto;
background:$segundo;
cursor:pointer;
}
.explicacion{
     font-size: 20px;
    left: 0px;
    bottom: 0px;
    right: 0px;
    margin: auto;
    width: 100%;
    height: 250px;
    padding: 30px;
    text-align:justify;
background:$segundo;
overflow: auto;
    border-top: 30px solid $segundo;
/*box-shadow: inset -2px -10px 20px 5px rgba(0, 0, 0, 0.22);
-webkit-animation-name: example;
    -webkit-animation-duration: 4s; 
    animation-name: exp;
    animation-duration: 2s;
animation-iteration-count: infinite;
*/
}
@-webkit-keyframes exp {
    0% {background:rgba(255,255,255,0.0);}
    50% {background:rgba(255,255,255,0.4);}
    100% {background:rgba(255,255,255,0.0);}
}
@keyframes exp {    
    0% {background:rgba(255,255,255,0.0);}
    50% {background:rgba(255,255,255,0.4);}
    100% {background:rgba(255,255,255,0.0);}

}
.selec{
-webkit-animation-name: example;
    -webkit-animation-duration: 4s;
    animation-name: exp;
    animation-duration: 2s;
animation-iteration-count: infinite;

}
.explicacion video {
    margin-left: -220px;
    margin-top: -60px;
    opacity: 1;
}
.explicacion > p {
margin-top: -400px;
    width: 400px;
    height: 400px;
    padding: 55px;
    margin-left: -60px;
    border-radius: 200px;
    position: fixed;
    color: white;
    background: rgba(0,0,0,0.3);
    position:fixed;

}

.panelDerecho > img {
    width: 100%;
    height: 230px;
    padding: 20px;
border: dashed 3px;
    box-shadow: -3px 3px 20px $texto;
}
.panelIzquierdo {
    width: 48%;
    float: left;
    height: auto;
}
.panelDerecho {
    width: 48%;
    float: right;
}

.separador {
    width: 100%;
    float: left;
    padding: 8px;
    border-bottom: $texto 6px solid;
    margin-bottom: 20px;
    height: auto;
}
#galeria,#titleSchedules {
    float: left;
    width: 100%
}
.elementos {
    float: left;
}

body{
  font-family: Arial;
  font-size: 13px;
  padding-bottom: 250px;
}
.seleccionado > a {
    color: rgba(255, 255, 255, 0)!Important;
}
.seleccionado > a > * {
    color: white;
}
.listaselect >li> a {
    color: rgba(255, 255, 255, 0) !Important;
}
.listaselect >li> a > * {
    color: black;
}
.cajaselect {
    background: none repeat scroll 0 0 #039acc;
    border-radius: 5px 5px 0 0;
    cursor: pointer;
    padding: 5px 10px;
    position: relative;
    z-index: 1;
}
ul.listaselect {
    background: none repeat scroll 0 0 #fff;
    border: 1px solid #dedede;
    display: none;
    left: -1px;
    margin-left: 1px;
    margin-top: 32px;
    padding-left: 0;
    position: absolute;
    text-indent: 15px;
    top: 0;
    overflow-y: auto;
    width: 100%;
    overflow-x: hidden;
}
ul.listaselect li {
    border-bottom: 1px solid #efefef;
    cursor: pointer;
    display: block;
    line-height: 15px;
    list-style: outside none none;
    margin: 0;
    padding: 1.1em 0.3em;
}
ul.listaselect li a {
    color: #333;
    text-decoration: none;
        height: 25px;
    padding: 5px 0px 0px 0px!important;
}
ul.listaselect li a:hover {
    color: #999797;
    text-decoration: none;
}
ul.SelectProductos li:last-child {
    border-bottom: medium none;
}
.seleccionado {
    color: white;
    display: block;
    font-weight: 700;
    line-height: 2;
    text-indent: 10px;
    overflow: hidden;
    width: 55px;
    height: 22px;
}
.trianguloinf {
    border-left: 9px solid rgba(0, 0, 0, 0);
    border-right: 9px solid rgba(0, 0, 0, 0);
    border-top: 13px solid #cfecfc;
    height: 0;
    position: absolute;
    right: 10px;
    top: 17px;
    width: 0;
}
.triangulosup {
    border-bottom: 13px solid #cfecfc;
    border-left: 9px solid rgba(0, 0, 0, 0);
    border-right: 9px solid rgba(0, 0, 0, 0);
    height: 0;
    position: absolute;
    right: 10px;
    top: 17px;
    width: 0;
}
#Schedules{
    width: 100%;
    height: auto;
    float: left;
}
.claseEvents {
    background: #05678a;
    color: black;
    border: solid #a0e4fd 2px;
}
.fileUpload {
        position: relative;
    overflow: hidden;
    background: #52accc;
    color: white;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
.textAdd {
    width: auto;
    float: right;
    margin-bottom: 20px;
}
.Consultas > div {
    width: 80%;
    float: right;
    text-align: justify;
    margin-bottom: 20px;
}
.eliminar {
    float: right;
    top: 0px;
    width: 20px;
    height: 20px;
    cursor: pointer;
    margin-right: 10px;
}

.modificar {
    width: 20px;
    height: 20px;
    float: right;
    margin-right: 10px;
    cursor: pointer;
}
img.agregar {
    width: 20px;
    height: 20px;
    float: right;
    margin-top: 4px;
    margin-left: 70%;
    cursor: pointer;
}
.checks {
    padding: 20px;
    background: white;
    border: solid #c1c1c1 3px;
    float: left;
    width: 100%;
}
.titleInstructor, .titleGaleria, .titleCurso,.titleSchedules {
    width: 100%;
    background: #52accc;
    color: white;
    font-size: 20px;
    text-align: center;
    border-bottom: 5px solid white;
}

.especial {
    background: #52accc;
    color: white;
    cursor: pointer;
}



    body {
        margin: 40px 10px;
        padding: 0;
        font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
        font-size: 14px;
        padding-bottom: 250px;
    }

    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }
    #titleEvento {
    width: 100%;
    bottom: 0px;
    height: auto;
    background: rgb(82, 172, 204);
    position: fixed;
    z-index: 1;
    left: 0px;
    color: white;
    margin: 0px;
}
#texto{
    padding: 10px;
    width: 100%;
    height: auto;
}

#allIconos {
    position: fixed;
    top: 0px;
    left: 0px;
    height: 600px;
    margin-left: 10%;
    margin-top: 10%;
    width: 80%;
    background: white;
    overflow-y:auto;
    padding:40px;
    border:solid 7px;
}
#allIconos >i {
    float: left;
    padding: 4px;
    font-size: 35px;
    margin: 10px;
    width: 40px;
    height: 40px;
}
#allIconos >i:hover{
    color: blue;
    cursor:pointer;

}
#allIconos >button:hover{
    background: white;
    color: black;
}

#allIconos > button {
    width: 50px;
    height: 50px;
    position: fixed;
    top: 0px;
    right: 0px;
    margin-top: 10%;
    margin-right: 10%;
    background: black;
    color: white;
}

#iconoAux{
cursor:pointer;
font-size: 30px;
}
#iconoAux:hover{
color:blue;
}
.completo {
    float: left;
    width: 98%;
    margin:1%;
    height: auto;
padding: 15px;
}
.medio {
    float: left;
    width: 48%;
    margin:1%;
    height: auto;
padding: 15px;
}
.cuarto {
    float: left;
    width: 23%;
    margin:1%;
    height: auto;
padding: 15px;
}
.tercio {
    float: left;
    width: 31%;
    margin:1%;
    height: auto;
padding: 15px;
}

.claro, .claro>div>input, .claro>div>label, .claro>div>textarea {
    background: $segundo !important;
    color: $texto !important;
}
.semiobscuro, .semiobscuro>div>input, .semiobscuro>div>label, .semiobscuro>div>textarea {
    background: $primero !important;
    color: $segundo !important;
}
.obscuro, .obscuro>div>input, .obscuro>div>label, .obscuro>div>textarea {
    background: $texto !important;
    color: $segundo !important;
}

.eleccionEstilo, .eleccionImagen {
    position: fixed;
    top: 0px;
    left: 0px;
    bottom: 0px;
    width: 500px;
    margin: auto;
    z-index: 1030;
    padding: 40px;
    background:gray;
}
.eleccionEstilo>*:hover, .eleccionImagen>*:hover{
opacity:0.7;
cursor:pointer;
}

#googleMap>img {
    width: 50px;
    height: 50px;
    background: #a3ccff;
    padding: 7px;
    margin: 4px;
    border-radius: 50px;
}
#googleMap>img:hover{
opacity:0.6;
cursor:pointer;
}
#googleMap {
    position: fixed;
    top: 0px;
    left: 0px;
    z-index: 10001;
    background: #a3ccff;
    padding: 50px;
    border: solid 50px;
    height: 100%;
    width: 100%;
    overflow-x: auto;
    display:none;
}
.buttonImage {
    width: 47px;
    height: 16px;
    margin-top: -64px;
    position: absolute;
    margin-left: 34px;
    padding: 0px;
    font-size: 10px;
}
.buttonEstilo {
    width: 40px;
    height: 16px;
    position: absolute;
    margin-top: -64px;
    margin-left: -15px;
    padding: 0px;
    font-size: 10px;
}
.buttonEstilo:hover, .buttonImage:hover {
backgrond: green !important;
cursor:pointer;
}
#imagenVista {
    height: 200px;
    z-index: 10001;
    background: white;
    position: fixed;
    bottom: 0px;
    right: 0px;
    padding: 5px;
}
#imagenVista>img{
height:190px;

}
.eleccionImagen>button, .eleccionEstilo>button  {
    position: absolute;
    top: 0px;
    right: 0px;
    color: red;
    background: black;
    border: none;
    width: 30px;
    height: 30px;
    font-size: 20px;
}
.noagregado{
opacity:0.5;
}
#operacion>button{
    font-size: 15px;
    padding: 6px;
    margin: 8px;
    border-radius: 50px;
    float: none;
    max-width: 100%;
    left: 0px;
    right: 0px;
    opacity:0.4;
}
#data{
 opacity:0.0;
}
.tipo0 {
    background: #ffffff;
border-radius: 0px !important;
    transform: skew(-23deg);

}
.tipo1 {
    background: #dddddd;
    border-radius: 0px !important;

}
.tipo2 {
    background: #bbbbbb;
}
.tipo3 {
    background: #999999;

}

#diagrama h1 {
float:left;
padding:10px;
}
.elCont{
float:left;
border:solid 2px;
}
.newName{
opacity:1 !important;
}
FINCSS;
?>


