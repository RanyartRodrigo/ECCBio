
<?php
header('content-type:text/css');
include "../../base.php";
include "../../host2.php";
$obj=new Base($DB_server,$DB_user,$DB_name);
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
.esconde-capas{
        height: 45px !important;
    overflow: hidden !important;
    width: 100% !important;
    bottom: 40px !important;
    right: 0px !important;
    left: 100% !important;
    z-index: 0 !important;
}
.esconde-panel{
          margin-top: 50px !important;
    height: 100% !important;
    position: fixed;
    float: none !important;
    left: 0px;
    margin-bottom: -50px !important;
    top: 0px;
    padding-bottom: 50px !important;

}
#esconder i {
    width: 100% !important;
    height: 100% !important;
    position: relative !important;
    margin: auto;
    text-align: center;
}
#esconder{
    position: fixed;
    top: 0px;
    width: 20%;
    right: 0px;
    padding: 0px;
/*-webkit-animation-name: exp2;
    -webkit-animation-duration: 20s;
    animation-name: exp2;
    animation-duration: 2s;
    animation-iteration-count: infinite;*/
}
.padre>.hijo {
       display: none;
    background: $fondo;
    position: absolute;
    float: left;
    padding: 20px;
    left:0px;
    margin-left: 0px;
    border-radius: 200px;
    border-top-left-radius: 0px;
    border: solid 1px $primero;
}

.padre:hover > .hijo{
display: block !important;
}


#panelDeControl > i {
    width: 40px;
    height: 40px;
    color: $fondo;
    font-size: 25px;
padding:8px;
}
#panelDeControl > *{
float:left;
}
#panelDeControl i:hover{
cursor:pointer;
background:$fondo !important;
color:$texto !important;
}

#panelDeControl {
    height: 0px;
    width:100% !important;
    overflow:hidden;
    float:left;
    width:100%;
    background: $texto;
    background: -webkit-linear-gradient(left top, $texto, $primero); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(bottom right, $texto, $primer); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(bottom right, $texto, $primero); /* For Firefox 3.6 to 15 */
    background: linear-gradient(to bottom right, $texto, $primero); /* Standard syntax */
transition:all ease 1s;
    z-index:11;
}

.abrir{
    width: 100% !important;
    height: auto !important;
}
#panelDeControl > i {
    width: 70px;
    height: 70px;
    overflow: hidden;
    color: $fondo;
    font-size: 50px;
padding:8px;
}
#panelDeControl > *{
float:left;
}
#panelDeControl > i:hover{
cursor:pointer;
background:$fondo !important;
color:$texto !important;
}

.bx-viewport{
min-height:200px;
}
#menu {
    width:100%;
    float:left;
}

 .non {
                padding-top: 20px;
                padding-bottom: 40px;
                background: $fondo;
            }
            .par {
                padding-top: 20px;
                padding-bottom: 40px;
                background: $texto;
            }

.infoBtn:hover{
color: $fondo !important;
background: $primero !important;
border-color: $fondo !important;
}
input[type=range] {
  -webkit-appearance: none;
  width: 100%;
  margin: 7.95px 0;
}
input[type=range]:focus {
  outline: none;
}
input[type=range]::-webkit-slider-runnable-track {
  width: 100%;
  height: 20px;
  cursor: pointer;
    background: $primero;
  border-radius: 25px;
  border: 0px solid $primero;
}
input[type=range]::-webkit-slider-thumb {
    border: 1px solid rgba(0, 0, 0, 0.22);
  height: 41px;
  width: 41px;
  border-radius: 50px;
  background: $segundo;
  cursor: pointer;
  -webkit-appearance: none;
  margin-top: -7.95px;
}
input[type=range]:focus::-webkit-slider-runnable-track {
  background: $primero;
}
input[type=range]::-moz-range-track {
  width: 100%;
  height: 20px;
  cursor: pointer;
    background: #c171a9;
  border-radius: 25px;
  border: 0px solid $primero;
}
input[type=range]::-moz-range-thumb {
  
  border: 1px solid rgba(0, 0, 0, 0.22);
  height: 21px;
  width: 11px;
  border-radius: 50px;
  background: $primero;
  cursor: pointer;
}
input[type=range]::-ms-track {
  width: 100%;
  height: 5.1px;
  cursor: pointer;
  background: transparent;
  border-color: transparent;
  color: transparent;
}
input[type=range]::-ms-fill-lower {
  background: $primero;
  border: 0px solid #dee196;
  border-radius: 50px;
  box-shadow: 2px 2px 15px $primero, 0px 0px 2px $primero;
}
input[type=range]::-ms-fill-upper {
  background: $primero;
  border: 0px solid #dee196;
  border-radius: 50px;
  box-shadow: 2px 2px 15px $primero, 0px 0px 2px $primero;
}
input[type=range]::-ms-thumb {
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
  border: 1px solid rgba(0, 0, 0, 0.22);
  height: 21px;
  width: 11px;
  border-radius: 50px;
  background: #bcffff;
  cursor: pointer;
  height: 5.1px;
}
input[type=range]:focus::-ms-fill-lower {
  background: #c171a9;
}
input[type=range]:focus::-ms-fill-upper {
  background: #cf91bc;
}

.infoBtn{
color: $primero;
background: $fondo;
border-color: $texto ;
margin-left:10px;
    float: right;
    border-radius: 30px;
    border: solid 1px;
    width: 40px;
    height: 40px;
    line-height: 35px;
    font-size: 40px;
font-family:monospace;
}
.capa input[value="X"] {
    float: right;
    border-radius: 30px;
    background: $segundo;
    border: solid 1px red;
    color: red;
    width: 40px;
    height: 40px;
    line-height: 35px;
    font-size: 40px;
}
.capa input[value="X"]:hover {
    background: red;
    border-color: $segundo;
    color: $segundo;
}
form > output {
    color: $primero !important;
    font-weight: bolder;
    padding: 0px !important;
    margin: auto !important;
    font-size:25px !important;
}
.bx-controls-direction a {
    z-index: 10 !important;
}
#banner #imgMaps {
    float: left;
    height: 100%;
    width: auto;
    min-width: 10px;
}
.logosmapas{
width:29px;
height:29px;
margin-left:10px;
float:left;
}

.logosmapasgrande{
display:none;
}
.divlogos{
float:left;
}

/*
 *
 * Template Name: Andia
 * Template URI: http://azmind.com
 * Description: Andia - Responsive Agency Template
 * Author: Anli Zaimi
 * Author URI: http://azmind.com
 *
 */
.country {
    padding: 15px 15px 20px 15px;
    background: #f5f5f5;
    border-bottom: 2px solid #f5f5f5;
    min-width: 180px;
    min-height: 180px;
}
.fc-event, .fc-event-dot, .ui-widget-header, .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active {
    border: 1px solid $primero !important;
    background: $primero !important;
    font-weight: normal;
    color: $texto;
}
.Mprincipal .active {
    background: $primero !important;
    color: $segundo !important;
}
.Msecundario .active {
    background: $texto !important;
    color: $segundo !important;
}
.slider {
    height: 10px !important;
    background: #cecece !important;
    width: 120px !important;
    border: $segundo 2px solid !important;
    left: 130px;
    top: -20px;
}
#banner p {
    float: left;
    margin: 0px;
    margin-left: 20px;
    line-height: 30px;
    font-size: 15px;
    font-weight: bolder;
    cursor: pointer;
}
#banner .logos {
    float: left;
    margin-top: 8px;
    margin-left: 10px;
    height: 18px;
    cursor: pointer;
}
.capa>div{
    width: 100%;
    height: 35px
}
.capa i{
        float: left;
    padding: 7px !important;
    margin: 0px !important;
}
.capa .title{
    float: left;
    padding: 0px !important;
    margin: 0px !important;
}
.lightbox{
top: 0% !important;
    left: 0% !important;
    width: 100% !important;
    height: 100% !important;
    padding:20px !important;
}
#capas>*, #infoMap>* {
    border-bottom: solid 1px;
    
    padding-bottom: 7px;
    text-align: left;
    font-size:18px;
}
#primero {
    color: #a52020;
}
#segundo {
    color: #20a520;
}
#tercero {
    color: #233220;
}
#cuarto {
    color: #aaa567;
}
#sexto {
    color: #accaa0;
}
#septimo {
    color: #20777c;
}
#octavo {
    color: #c58880;
}
#noveno {
    color: #cabd50;
}
#capas, #infoMap{
   border:solid 2px ; 
}
    #banner {
    position: fixed;
    width: 100%;
    bottom: 0px;
    height: 40px;
    background: $cajas;
    padding: 5px;
    left:100%;
z-index:10;
    padding-left: 0px !important;
    padding-top:40px;
padding-bottom:40px;
}
.organization{
display:none;
}
.caret{
margin-top:10px;
float:right;
width:40px;
height:20px;
border-top: 20px solid !important;
border-right: 20px solid transparent !important;
border-left: 20px solid transparent !important;
}
li > i {
	height:30px;
        width: 30px;
    position: absolute;
    left: 0px;
    margin-top: -60px;
    padding-left:10px;
    padding-right:10px;
font-size: 35px !important;
}
li > a {
    height: 70px;
padding-left: 30px !important;

}
li > a> label {
    float: right;
    padding-top: 6px;
    font-size:20px;
}
.sub > a {
    height: 60px;
}
li > i:hover{
cursor:pointer;
color:$primero !important;
}

.navbar-header .icon-bar{
background:$primero;
}    
#banner {
    position: fixed;
    width: 100%;
    bottom: 0px;
    height: 0px;
    background: $cajas;
    padding: 5px;
    left:100%;
}
#capas {
   box-shadow: 5px -1px 35px 3px rgba(0, 0, 0, 0.28);
    width: 100%;
    position: fixed;
    background: $cajas;
    bottom: 0px;
    left: 100%;
    max-height: 100%;
    overflow-y: auto;
    border: 0px !important;
z-index:12;
}
#capas>h3{
/*-webkit-animation-name: exp2;
    -webkit-animation-duration: 20s; 
    animation-name: exp2;
    animation-duration: 2s;
animation-iteration-count: infinite;*/
padding: 10px!important;
    height: 45px;
    margin: 0px !important;
    text-align: center;
}
#infoMap {
    box-shadow: -4px 6px 8px 0px rgba(152, 19, 19, 0.12);
    width: 300px;
    position: fixed;
    background: $cajas;
    bottom: 50px;
    right: 50px;
    max-height: 35%;
    overflow-y: auto;
    border: 0px !important;
}
div#map {
    position: fixed !important;
    width: 100%;
    height: 100%;
    top: 0%;
    left: -20px;
}
.navbar {
transition:margin ease 1s;
    z-index: 2;
    position: fixed !important;
    width: 100%;
}
.navbar-side{
    top: 60px;
        height: auto;
}

div#map {
    width: 100%;
    min-height: 600px;
}


















/* SLIDE THREE */
.slideThree {
    width: 100px !important;
    height: 40px !important;
    background: #cecece !important;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    position: relative;

    -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
    -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
    box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
}

.slideThree:after {
    content: 'OFF';
    font: 20px/30px Arial, sans-serif;
    color: #000;
    position: absolute;
    right: 8px;
    z-index: 0;
    font-weight: bold;
    text-shadow: 1px 1px 0px rgba(255,255,255,.15);
}

.slideThree:before {
    content: 'ON';
    font: 20px/40px Arial, sans-serif;
    color: #00bf00;
    position: absolute;
    left: 10px;
    z-index: 0;
    font-weight: bold;
}

.slideThree label {
    display: block;
    width: 50px;
    height: 35px;

    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;

    -webkit-transition: all .4s ease;
    -moz-transition: all .4s ease;
    -o-transition: all .4s ease;
    -ms-transition: all .4s ease;
    transition: all .4s ease;
    cursor: pointer;
    position: absolute;
    top: 3px;
    left: 3px;
    z-index: 1;

    -webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    -moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    background: $primero;

    background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
    background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
    background: -o-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
    background: -ms-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
    background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
}

.slideThree input[type=checkbox]:checked + label {
    left: 43px;
}
h1 {
    color: #eee;
    font: 30px Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    text-shadow: 0px 1px black;
    text-align: center;
    margin-bottom: 50px;
}

input[type=checkbox] {
    visibility: hidden;
}



/* SLIDE THREE */
.miniSlideThree {
        float: right;
    margin-top: 0px;
    margin-left: 9px;
    width: 60px !important;
    height: 30px !important;
    background: #cecece !important;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    position: relative;
    -webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
    -moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
    box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
}

.miniSlideThree:after {
    content: 'N';
    font: 20px/30px Arial, sans-serif;
    color: #f00;
    position: absolute;
    right: 5px;
    z-index: 0;
    font-weight: bold;
    text-shadow: 1px 1px 0px rgba(255,255,255,.15);
}

.miniSlideThree:before {
    content: 'Y';
    font: 20px/30px Arial, sans-serif;
    color: #00bf00;
    position: absolute;
    left: 5px;
    z-index: 0;
    font-weight: bold;
}
.miniSlideThree label {
    display: block;
    width: 30px;
    height: 30px;
    -webkit-border-radius: 50px;
    -moz-border-radius: 50px;
    border-radius: 50px;
    -webkit-transition: all .4s ease;
    -moz-transition: all .4s ease;
    -o-transition: all .4s ease;
    -ms-transition: all .4s ease;
    transition: all .4s ease;
    cursor: pointer;
    position: absolute;
    top: 0px;
    left: 0px;
    z-index: 1;
    -webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    -moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    background: #ff0000;
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
}

.miniSlideThree input[type=checkbox]:checked + label {
    left: 30px;
    background: #43c743;
}
h1 {
    color: #eee;
    font: 30px Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    text-shadow: 0px 1px black;
    text-align: center;
    margin-bottom: 50px;
}


.icon {
    color: $segundo !important;
    padding: 20px;
    width: 140px;
    border-radius: 80px;
    height: 140px;
    margin:auto;
}
.icon i {
    width: 100px;
    height: 100px;
    font-size: 57px;
    float: left;
    background: $primero;
    border-radius: 200px;
    padding: 19px;
    padding-top: 22px;
}
.cursoInfo {
    width: 640px;
    margin: auto;
}
#map {
    width: 600px;
    height: 400px;
    margin: 20px;
}
a{
    cursor:pointer !important;
}
.wow > img, .box-container > img {
    width: 230px;
    height: 230px;
    border-radius: 115px;
    margin-top: 10px;
}
.slider-2-text >img {
    width: 150px;
    height: 150px;
}
iframe {
    background-image: url(../img/loading.gif);
    background-size: 100% 100%;
}
.friends {
    margin-top: 40px;
    padding: 15px 15px 20px 15px;
    background: $cajas;
    border-bottom: 2px solid $primero;
}
.friends > img {
    width: auto;
    height: 100px !important;
    border-radius: 0px !important;
}
.icono {
    width: 100px;
    height: 100px;
    background: $cajas;
    float: left;
}

body {
    background: $fondo;
    text-align: center;
    font-family: 'Open Sans', sans-serif;
    color: $texto;
    font-size: 12px;

}

.violet { color: $primero; }

a {
    color: $primero;
    text-decoration: none;
    -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
}
a:hover, a:focus { color: $texto; text-decoration: none; }

strong { font-weight: bold; }

img { max-width: 100%; }

h1, h2 { line-height: 40px; }
h3, h4 { line-height: 20px; }

::-moz-selection { background: $primero; color: $segundo; text-shadow: none; }
::selection { background: $primero; color: $segundo; text-shadow: none; }


/***** Big links / buttons *****/
.right {
    float: right;
    width: 50%;
    border-left: solid 3px;
    margin-right:1.5px;

}
.right>i{
        border-radius: 20px;
    border-bottom-left-radius: 0px;
        transform: rotate(5deg);
}
.left>i{
        border-radius: 20px;
    border-bottom-right-radius: 0px;
        transform: rotate(-5deg);
}
.linetime{
    overflow:auto !important;
}
.linetime i {
    background: $primero;
    font-size: 20px;
    color: $segundo;
    padding: 10px;
    width: 40px;
    height: 40px;
}
.linetime i:hover {
    border: solid 2px;
    cursor: pointer;
    color: $texto;
}
.right >*{
    float:left;
}
.left > *{
    float:right;
}
.linetime p {
    background: $cajas;
    padding: 11px;
    border-radius: 100px;
    color: $texto;
}
.left {
    float: left;
    width: 50%;
    border-right: solid 3px;
    margin-left:1.5px;
}
.amigos img {
    float: left;
    width: 100px;
    height: 100px;
    border: solid 2px;
}
.amigos .informacion {
    float: left;
    width: 200px;
    padding: 5px;
    overflow: hidden;
}

.amigos > div {
    width: 100%;
    float: left;
    padding: 10px;
    border-bottom: solid 1px;
    margin-bottom: 10px;
}
a.big-link-1 {
  display: inline-block;
    padding: 5px 22px;
    background: $primero !important;
    color: $segundo !important;
    font-style: italic;
    text-decoration: none;
    -moz-box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -webkit-box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
        border-radius: 200px;
}

a.big-link-1:hover {
    -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
    color:$primero !important;
    background:$segundo !important;
    cursor:pointer;
    border:solid 1px;
}

a.big-link-1:active {
    -moz-box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -webkit-box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
}

a.big-link-2 {
    display: inline-block;
    width: 35px;
    height: 35px;
    padding-top: 6px;
    background: $primero;
    font-size: 20px;
    color: $segundo;
    line-height: 20px;
    -moz-border-radius: 19px; -webkit-border-radius: 19px; border-radius: 19px;
    -moz-box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -webkit-box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
}
a.big-link-2 i { vertical-align: middle; }

a.big-link-2:hover {
    background: $texto;
    -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
}

a.big-link-2:active {
    -moz-box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -webkit-box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
}

a.big-link-3 {
  display: inline-block;
    padding: 5px 22px;
    background: $primero;
    font-size: 18px;
    color: $segundo;
    font-style: italic;
    line-height: 24px;
    text-decoration: none;
    -moz-box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -webkit-box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
}

a.big-link-3:hover {
    -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: none;
}

a.big-link-3:active {
    -moz-box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -webkit-box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 5px 10px 0 rgba(0,0,0,.15) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
}


    body{
         float: left;
    top: 0px !important;
    padding-bottom: 50px;
    width: 100%;
    height: 100%;
    margin-top: 50px;
    }
    .control-panel {
    
    background: $texto;
        position: fixed;
    float: left;
    z-index: 11;
    top: 100%;
    left: 50px;
    right: 50px;
}
.Mprincipal {
    height: auto;
    margin: 0px;
    width: 100%;
    float: left;
    padding: 0px;
}
.Mprincipal>li:hover {
    background: $segundo;
    color: $primero;
    cursor:pointer;

}
.selectPais {
        position: fixed;
    top: 100px;
    bottom: 40px;
    width: 100% !important;
    height: 100% !important;
    left: 0px;
    padding: 50px;
    right: 0px;
    margin: 0px !important;
    padding: 0px;
    padding-bottom: 100px;
    overflow: auto !important;
}
.Msecundario {
    overflow:hidden;
    height:0px;
    margin-top: 0px;
    padding-left: 0px;
    width: 117%;
    float: left;
    background: $segundo;
    color: $primero;
    margin-left: -10px;
    transition:height ease 1s;
    font-size:30px;
}
.Msecundario > li:hover {
    background: $texto;
    float: left;
    width: 100%;
    color: $segundo;
}

.control-panel li{
    list-style:none;
}
.Mprincipal >li {
    text-align:left;
    float:left;
    width:100%;
    padding: 4px;
    font-size: 33px;
    background: $texto;
    color: $segundo;
height:50px;

}
#op {
    position: absolute;
    float: right;
    top: 0px;
    right: 0px;
    display: block !important;
    height: 50px !important;
    width: 50% !important;
    font-size: 34px !important;
    background: $texto;
}
.Msecundario > li {
    padding: 5px;
}
.navbar {
    top:0px;
    background: #fcfcfc;
    border: 0;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
    border-radius: 0;
    position: fixed;
    z-index: 11;
    width: 100%;
    padding-left: 50px;
    margin-left: -50px;
   border-right: 6px solid $texto;
    opacity: 0.92;
    bottom: 0px;
    margin-bottom: 0px;
}
#MenuPrincipal .container {
overflow: hidden;
    width: 100% !important;
        height: 100%;
            padding: 0px !important;
}
.navbar-nav>li {
    float: left;
    width: 100%;
    min-height:70px;
}
.navbar-collapse {
    padding-right: 0px !important;
    padding-left: 0px !important;
    width: 100%;
    margin: 0px !important;
}
.ayudaPerson{
display:none;
}
.navbar-right {
    float: right!important;
        margin-right:0px !important;
}
ul.dropdown-menu {
background:$primero;
top:0px;    
position: relative;
    width: 100%;
    padding: 0px;
    text-align: center;
    box-shadow: none !important;
    border: none !important;
    border-bottom:4px solid !important;
}
.dropdown-menu li {
    padding-left: 10px;
}
.navbar-header{
    width:100%;
}
.icono {
    margin: auto !important;
    float:none !important;
}
#Wall, footer {
	margin-left:0px !important;
}
li {
    text-align: left;
}
#panelDeControl .fa-cog{
display:none;
}
#menu-hidde {
    transition: all ease 1s;
    top: 0px;
    width: 20%;
    height: 50px;
    position: fixed;
    left: 100%;
    margin-left:-50px;
    z-index: 11;
    color:$segundo;
    background: $primero;
    font-size: 35px;
    line-height: 48px;
    text-align: center;
/*-webkit-animation-name: exp2;
    -webkit-animation-duration: 20s;
    animation-name: exp2;
    animation-duration: 2s;
    animation-iteration-count: infinite;
*/
}
#menu-hidde:hover {
    color:$primero;
    background: $segundo;
    cursor:pointer;
    border-radius: 0px !important;
}
.menu-menu-hidde{
    margin-left: -100% !important;
	transition:margin ease 1s;
}
#menu-hidde:not(.menu-menu-hidde){
        transition:margin ease 1s;
width:50px !important;
}




ul.navbar-nav {
  font-size: 12px;
  color: $texto;
  text-transform: uppercase;
  width:100%;
  height:90%;
  overflow-y:auto;
}

ul.navbar-nav li a { padding: 0px 20px; background: $segundo; border-top: 5px solid $segundo; color: $texto; }
ul.navbar-nav li.active a { background: $primero; border-color: $primero; color: $segundo; }

ul.navbar-nav li a:hover, ul.navbar-nav li a:focus { background: $primero; border-color: $primero; color: $segundo; outline: 0; }

.nav .open > a { background: $cajas; border-color: $primero; color: $texto; }
.nav .open > a:hover, .nav .open > a:focus { background: $primero; border-color: $primero; color: $segundo; }

ul.navbar-nav li a i { line-height: 35px; color: $segundo; }
ul.navbar-nav li a:hover i, ul.navbar-nav li a:focus i { color: $segundo; }

.dropdown-menu {
  border: 0;
  -moz-border-radius: 0; -webkit-border-radius: 0; border-radius: 0;
  -moz-box-shadow: 0 6px 10px rgba(0, 0, 0, .15); -webkit-box-shadow: 0 6px 10px rgba(0, 0, 0, .15); box-shadow: 0 6px 10px rgba(0, 0, 0, .15);
}

.dropdown-menu > .active > a { background: $segundo; color: $texto; }
.dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus { background: $cajas; color: $primero; }

ul.navbar-nav li .dropdown-menu a { padding-top: 0px; padding-bottom: 0px; }
ul.navbar-nav li.active .dropdown-menu a { background: $cajas; color: $texto; border: 0; }
ul.navbar-nav li.active .dropdown-menu a:hover, 
ul.navbar-nav li.active .dropdown-menu a:focus { background: $primero; color: $segundo; border: 0; }

ul.navbar-nav li.active .dropdown-menu > .active > a { background: $texto; color: $segundo; border: 0; }
ul.navbar-nav li.active .dropdown-menu > .active > a:hover, 
ul.navbar-nav li.active .dropdown-menu > .active > a:focus { background: $texto; color: $segundo; border: 0; }

.navbar>.container .navbar-brand { margin-left: 0; }

.navbar-brand {
  width: 167px;
  height: 106px;
  background: url(../img/logo.png) left center no-repeat;
  text-indent: -99999px;
}

/***** Slider *****/

.slider-container {
    margin: 0 auto;
    background: $cajas url(../img/pattern.jpg) left top repeat;
    -moz-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset, 0 -5px 15px 0 rgba(0,0,0,.05) inset;
    -webkit-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset, 0 -5px 15px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset, 0 -5px 15px 0 rgba(0,0,0,.05) inset;
}

.slider {
  padding-left: 5px;
  padding-right: 5px;
}

.flexslider {
    margin-top: 45px;
    margin-bottom: 55px;
    border: 6px solid $segundo;
    -moz-border-radius: 0; -webkit-border-radius: 0; border-radius: 0;
    -moz-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 -5px 15px 0 rgba(0,0,0,.05);
    -webkit-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 -5px 15px 0 rgba(0,0,0,.05);
    box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 -5px 15px 0 rgba(0,0,0,.05);
}

.flexslider .slides > li {
  position: relative;
  height:400px;
}

.flex-caption {
    position: absolute;
    left: 0;
    bottom: 20px;
    width: 95%;
    padding: 10px 20px;
    background: #1d1d1d; /* browsers that don't support rgba */
    background: rgba(0, 0, 0, .7);
    font-size: 14px;
    line-height: 24px;
    color: #eaeaea;
    text-align: left;
    font-style: italic;
}

.flex-direction-nav a {
  width: 60px;
  height: 60px;
  padding-top: 17px;
  background: $primero;
  color: $segundo;
  text-shadow: none;
}

.flex-direction-nav a:before { font-size: 26px; }

.flex-direction-nav .flex-prev, .flex-direction-nav .flex-next { text-align: center; }


/***** Slider 2 *****/

.slider-2-container {
  padding: 180px 0;
}
.slider-2-text > div {
    margin-left: 0px !important;
    width: 100%;
    float: left;
}
.slider-2-text > div >* {
    opacity:0.8;
    margin: 0px !important;
    width: auto !important;
    float: left;
    background: $segundo;
    color:$texto;
        border-radius: 0px;
    border-bottom: solid 1px;
}
.slider-2-text {
    padding: 30px 0 43px 0;
    color: $segundo;
    margin-left: 0px !important;
    text-align: left;
}

.slider-2-text h1 {
padding-left: 10px;
    padding-right: 10px;
    font-family: 'Lobster', cursive;
    font-size: 50px;
    line-height: 50px;
    color: $primero;
    font-weight: bold;
    border-bottom: solid 1px $primero;
}

.slider-2-text p {
  padding-left: 30px;
  padding-right: 30px;
  font-size: 30px;
      line-height: 30px;

    font-style: italic;
    border-bottom: solid 1px;
}


/***** Presentation *****/

.presentation-container {
    margin-top: 30px;
}

.presentation-container h1 {
    font-family: 'Lobster', cursive;
    font-size: 30px;
    color: $texto;
    font-weight: bold;
}

.presentation-container p {
    font-size: 18px;
    font-style: italic;
}


/***** Services *****/

.services-container {
    margin-top: 10px;
}

.services-title {
  margin-top: 40px;
    background: url(../img/line.png) left center repeat-x;
}

.services-title h2 {
    width: 200px;
    margin: 0 auto;
    background: $cajas;
    font-family: 'Lobster', cursive;
    font-size: 24px;
    color: $texto;
    font-weight: bold;
}

.service {
    padding: 15px 15px 20px 15px;
    background: $segundo;
    border-bottom: 2px solid $segundo;
}
.col-sm-6{
    padding:0px !important;
}

.service:hover {
    box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -o-transition: all .5s; -moz-transition: all .5s; -webkit-transition: all .5s; -ms-transition: all .5s; transition: all .5s;
}

.service .service-icon {
    font-size: 50px;
    line-height: 50px;
    color: $texto;
}

.service .service-icon i { vertical-align: middle; }

.service h3 {
    margin-top: 13px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 14px;
    color: $texto;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.service p {
    padding-bottom: 7px;
    line-height: 24px;
}


/***** Latest work *****/

.work-container {
    margin-top: 50px;
}

.work-title {
    background: url(../img/line.png) left center repeat-x;
}

.work-title h2 {
    width: 220px;
    margin: 0 auto;
    background: $cajas;
    font-family: 'Lobster', cursive;
    font-size: 24px;
    color: $texto;
    font-weight: bold;
}

.work {
    margin-top: 40px;
    padding-bottom: 20px;
    background: $cajas;
    border-bottom: 2px solid $primero;
}

.work:hover img {
    opacity: 0.7;
    -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
}

.work:hover {
    box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -o-transition: all .5s; -moz-transition: all .5s; -webkit-transition: all .5s; -ms-transition: all .5s; transition: all .5s;
}

.work .work-bottom {
    margin-top: 15px;
}

.work h3 {
    margin-top: 20px;
    padding-left: 15px;
    padding-right: 15px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 14px;
    color: $texto;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.work p {
  padding-left: 15px;
    padding-right: 15px;
    line-height: 24px;
    font-style: italic;
}


/***** Testimonials *****/

.testimonials-container {
    margin-top: 50px;
    padding-bottom: 70px;
}

.testimonials-title {
    background: url(../img/line.png) left center repeat-x;
}

.testimonials-title h2 {
    width: 180px;
    margin: 0 auto;
    background: $segundo;
    font-family: 'Lobster', cursive;
    font-size: 24px;
    color: $texto;
    font-weight: bold;
}

.testimonial-list {
    margin-top: 30px;
    text-align: left;
}

.testimonial-list .tab-pane { overflow: hidden; }

.testimonial-list .testimonial-image {
  float: left;
  width: 10%;
  margin: 10px 0 0 0;
}
.testimonial-list .testimonial-image img { max-width: 64px; border: 3px solid #eaeaea; }

.testimonial-list .testimonial-text {
  float: left;
  width: 90%;
  font-size: 14px;
    line-height: 30px;
    font-style: italic;
}

.testimonial-list .nav-tabs {
    border: 0;
    text-align: right;
}

.testimonial-list .nav-tabs li {
  float: none;
  display: inline-block;
  margin-left: 2px;
    margin-right: 2px;
}

.testimonial-list .nav-tabs li a {
    width: 12px;
    height: 12px;
    padding: 0;
    background: $cajas;
    border: 0;
    -moz-border-radius: 0; -webkit-border-radius: 0; border-radius: 0;
}

.testimonial-list .nav-tabs li a:hover { border: 0; background: $primero; }
.testimonial-list .nav-tabs li.active a { background: $primero; }


/***** Footer *****/

footer {
    margin: 0 auto;
    padding-bottom: 10px;
    background: $cajas url(../img/pattern.jpg) left top repeat;
    -moz-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset; -webkit-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset; box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset;
}

.footer-box {
    margin-top: 20px;
    text-align: left;
}

.footer-box h4 {
    margin-top: 20px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 14px;
    color: $texto;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.footer-box-text p {
    line-height: 24px;
}

.footer-box-text-contact i {
    padding-right: 7px;
}

.footer-box-text-subscribe form {
  padding-bottom: 10px;
}

.footer-box-text-subscribe input[type="text"] {
  width: 95%;
  height: 26px;
}

/* Flickr feed */
.flickr-feed {
    margin: 16px 0 0 0;
}

.flickr-feed a {
  display: inline-block;
  width: 54px;
  margin: 0 4px 4px 0;
}
.flickr-feed a:hover { opacity: 0.7; }
.flickr-feed a img { border: 2px solid #eaeaea; }


.footer-border {
    margin-top: 30px;
    border-top: 1px dashed #ddd;
}

.footer-copyright {
    margin-top: 15px;
    line-height: 24px;
    text-align: left;
}

.footer-social {
    margin-top: 5px;
    text-align: right;
}
.footer-social a { margin: 0 0 0 10px; font-size: 26px; color: $texto; }
.footer-social a:hover, .footer-social a:focus { color: $primero; }


/***** Page title *****/

.page-title-container {
    margin: 0 auto;
    padding: 30px 0 35px 0;
    background: $cajas url(../img/pattern.jpg) left top repeat;
    text-align: left;
    -moz-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset, 0 -5px 15px 0 rgba(0,0,0,.05) inset;
    -webkit-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset, 0 -5px 15px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 5px 15px 0 rgba(0,0,0,.05) inset, 0 -5px 15px 0 rgba(0,0,0,.05) inset;
}

.page-title-container h1 {
    display: inline;
    margin-left: 10px;
    font-family: 'Lobster', cursive;
    font-size: 24px;
    color: $texto;
    font-weight: bold;
    text-shadow: 0 1px 0 rgba(255, 255, 255, .7);
    vertical-align: middle;
}

.page-title-container p {
    display: inline;
    margin-left: 5px;
    font-size: 14px;
    font-style: italic;
    vertical-align: middle;
}

.page-title-container i {
    font-size: 46px;
    color: #ccc;
    vertical-align: middle;
}


/* ----- ABOUT PAGE ----- */

/***** About us text *****/

.about-us-container {
    margin-top: 20px;
}

.about-us-text {
    padding-top: 10px;
    padding-bottom: 10px;
    text-align: left;
}

.about-us-text h3 {
    margin-top: 25px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 16px;
    color: $texto;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.about-us-text p {
    line-height: 28px;
    font-size: 13px;
}

/***** Meet our team *****/

.team-container {
    margin-top: 30px;
}

.team-title {
    background: url(../img/line.png) left center repeat-x;
}

.team-title h2 {
    width: 220px;
    margin: 0 auto;
    background: $segundo;
    font-family: 'Lobster', cursive;
    font-size: 24px;
    color: $texto;
    font-weight: bold;
}

.team-box {
    margin-top: 40px;
    padding-bottom: 15px;
    background: $cajas;
    border-bottom: 2px solid $primero;
    overflow: hidden;
}


.team-box:hover img {
    opacity: 0.7;
    -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
}

.team-box:hover {
  -moz-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
  -webkit-box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -o-transition: all .5s; -moz-transition: all .5s; -webkit-transition: all .5s; -ms-transition: all .5s; transition: all .5s;
}

.team-box h3 {
    margin-top: 20px;
    padding-left: 15px;
    padding-right: 15px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 14px;
    color: $texto;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.team-box p {
  padding-left: 15px;
    padding-right: 15px;
    line-height: 24px;
    font-style: italic;
}

.team-social a { margin: 0 5px; font-size: 26px; }


/* ----- CONTACT PAGE ----- */

/***** Form *****/

.contact-us-container {
    margin-top: 20px;
    padding-bottom: 50px;
    text-align: left;
}

.contact-us-container h3 {
    margin-top: 25px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 16px;
    color: $texto;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.contact-us-container p {
    line-height: 28px;
    font-size: 13px;
}

.contact-form {
    padding-top: 25px;
    padding-bottom: 30px;
}

.contact-form form {
    margin-top: 25px;
}

.contact-form form .form-group {
  margin-bottom: 20px;
}

.contact-form input[type="text"] { width: 95%; height: 34px; }
.contact-form textarea { width: 95%; height: 170px; padding-top: 6px; padding-bottom: 6px; }
.contact-form label { font-size: 13px; font-weight: 400; }
.contact-form label .error-label { font-style: italic }
.contact-form button { margin-top: 5px; padding: 0 45px; }

/***** Google map *****/

.contact-address {
  padding-bottom: 15px;
}

.contact-address .map {
    margin: 20px 0 40px 0;
    height: 300px;
    border: 5px solid $cajas;
}


/* ----- SERVICES PAGE ----- */

/***** Services full width text *****/

.services-full-width-container {
    margin-top: 20px;
}

.services-full-width-text {
    padding-top: 10px;
    text-align: left;
}

.services-full-width-text h3 {
    margin-top: 25px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 16px;
    color: $texto;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.services-full-width-text p {
    line-height: 28px;
    font-size: 13px;
}

/***** Services half width text *****/

.services-half-width-container {
    margin-top: 20px;
}

.services-half-width-text {
    padding-top: 10px;
    padding-bottom: 10px;
    text-align: left;
}

.services-half-width-text h3 {
    margin-top: 25px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 16px;
    color: $texto;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.services-half-width-text p {
    line-height: 28px;
    font-size: 13px;
}

/***** Call to action *****/

.call-to-action-container {
    margin-top: 20px;
    padding-bottom: 50px;
}

.call-to-action-text {
    padding-top: 25px;
    padding-bottom: 15px;
    background: $cajas;
    text-align: left;
    overflow: hidden;
}

.call-to-action-text:hover {
  -moz-box-shadow: 0 3px 10px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
  -webkit-box-shadow: 0 3px 10px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    box-shadow: 0 3px 10px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -o-transition: all .5s; -moz-transition: all .5s; -webkit-transition: all .5s; -ms-transition: all .5s; transition: all .5s;
}

.call-to-action-text p {
    float: left;
    width: 80%;
    padding-left: 25px;
    line-height: 30px;
    font-size: 18px;
    font-style: italic;
}

.call-to-action-text .call-to-action-button {
    float: left;
    width: 20%;
    padding-right: 25px;
    margin-bottom: 10px;
    text-align: right;
}


/* ----- PORTFOLIO PAGE ----- */

.contenedor-clase {
    margin-top: 20px;
    padding-bottom: 50px;
}

.filters {
  padding-top: 35px;
  padding-bottom: 10px;
  font-family: 'Droid Sans', sans-serif;
    font-size: 16px;
    color: $texto;
    font-weight: bold;
    text-align: left;
    text-transform: uppercase;
    text-shadow: 0 1px 0 $segundo;
}

.filters a { color: $texto; }
.filters a:hover, .filters a.active { color: $primero; }

.box {
  width: 255px;
  margin: 40px 15px 0 15px;
}

.box img {
  cursor: pointer;
  -o-transition: all .3s; -moz-transition: all .3s; -webkit-transition: all .3s; -ms-transition: all .3s; transition: all .3s;
}
.box:hover img { opacity: 0.7; }

.box-container {
  position: relative;
  background: $cajas;
    border-bottom: 2px solid $primero;
}

.box-container:hover {
    box-shadow: 0 5px 15px 0 rgba(0,0,0,.05), 0 1px 25px 0 rgba(0,0,0,.05) inset, 0 -1px 25px 0 rgba(0,0,0,.05) inset;
    -o-transition: all .5s; -moz-transition: all .5s; -webkit-transition: all .5s; -ms-transition: all .5s; transition: all .5s;
}

.box-icon {
  position: absolute;
  top: 10px;
  right: 10px;
  width: 35px;
    height: 35px;
    padding-top: 7.5px;
    padding-left: 3px;
    background: #1d1d1d; /* browsers that don't support rgba */
    background: rgba(0, 0, 0, .7);
    font-size: 20px;
    color: $segundo;
    line-height: 20px;
    -moz-border-radius: 19px; -webkit-border-radius: 19px; border-radius: 19px;
}

.box-text {
  padding: 0 15px 20px 15px;
}

.box-text h3 {
    margin-top: 20px;
    font-family: 'Droid Sans', sans-serif;
    font-size: 14px;
    color: $texto;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(255,255,255,.7);
}

.box-text p {
    line-height: 24px;
    font-style: italic;
}
.tooltip{
    position: absolute;
    z-index: 999999;
    display: none;
    padding-top: 8px;
}

.tooltip-arrow{
    width: 0;
    height: 0;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-bottom: 8px solid #274D71;
    top: 0px;
    left: 50%;
    margin-left: -10px;
    position: absolute;
}
.tooltip-content{
    font-size: 12px;
    color: #333;
    border: 1px solid #274D71;
    background: #fff;
    line-height: 18px;
    border-radius: 3px;
    position: relative;
}
.tooltip-title{
    line-height: 32px;
    color: #fff;
    font-size: 14px;
    line-height: 2;
    padding-left: 8px;
    background: #274D71;
}

.tooltip-inner{
    padding: 15px 8px;
    min-width: 100px;
}

.tooltip-center .tooltip-arrow{
    left: 50%;
    margin-left: -10px;
}


/* down */
.tooltip-down{
    padding-top: 0;
    padding-bottom: 8px;
}
.tooltip-down .tooltip-arrow{
    top: auto;
    bottom: 0;
    border-bottom: 0;
    border-top: 8px solid #274D71;
}


/* right */
.tooltip-right{
    padding: 0 8px 0 0;
}
.tooltip-right .tooltip-arrow{
    top: 50%;
    margin-top: -10px;
    left: auto;
    right: 0;
    border-right: 0;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-left: 8px solid #274D71;
}


/* left */
.tooltip-left{
    padding: 0 0 0 8px;
}
.tooltip-left .tooltip-arrow{
    left: 0;
    top: 50%;
    margin-top: -10px;
    margin-left: 0;
    border-left: 0;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-right: 8px solid #274D71;
}

.hover{
    display: block;
    width: 500px;
    height: 100px;
    background: #DA4453;
    padding: 10px;
    margin: 50px auto;
    color:#fff;
    word-wrap:break-word;
}

.closebox {
    position: fixed !important;
    width: 60px !important;
    height: 60px !important;
    font-size: 50px !important;
    background: $primero !important;
    color: $fondo !important;
    line-height: 50px !important;
    font-weight: bolder !important;
    top: 0% !important;
    left: 0% !important;
}
#Wall, footer{
            width: 100%;
    float: left;
    left: 100%;
}
footer.menu-menu-hidde {
    bottom: 0px;
    margin-left: 0px !important;
}
html, body {
        overflow-x: hidden;
}
html{
background:$texto;
float: left;
    
    width: 100%;
    height: 100%;
}
@media (orientation:portrait){
.slider1>div {
    width: 350px !important;
}
}
@media (orientation:landscape){
li {
    font-size: 16px !important;
    min-height: 40px;
}

.navbar-nav>li {
    min-height: 30px;
}
li > a> label {
    font-size: 17px;
}
.miniSlideThree{
height: 20px !important;
}
.miniSlideThree label{
height:17px !important;
left: 3px;
}
.miniSlideThree:before {
    font: 21px/22px Arial, sans-serif;
}
.miniSlideThree:after {
    font: 21px/22px Arial, sans-serif;
}
.miniSlideThree input[type=checkbox]:checked + label {
    left: 40px;
    background: #43c743;
}
#panelDeControl {
    height: 0px;
}
#panelDeControl > i {
    width: 40px;
    height: 40px;
    font-size: 30px;
}
.esconde-panel {
        margin-top: 50px !important;
    height: 100% !important;
    position: fixed;
    float: none !important;
    left: 0px;
    margin-bottom: -50px !important;
    top: 0px;
    padding-bottom: 50px !important;
}
#capas>*, #infoMap>* {
    font-size: 14px;
}
.slideThree {
    height: 30px !important;
}
.slideThree label{
height:23px;
}

.slideThree:before{
    font: 20px/35px Arial, sans-serif;
}
#primero {
    float: left;
    width: 100%;
    
    overflow: auto;
    margin: 0px;
}
.capa {
    float: left;
    width: 50%;
    height: auto;
padding-left:30px;
padding-right:30px;
}
#esconder {
left: 80%;
    top: 0px;
    position: fixed;
    width: 20%;
    padding: 6px;
    font-size: 33px;
    height: 50px !important;
    overflow: hidden;
}
.Mprincipal>li:hover>ul{
margin-top:20px;
}
input[type=range]::-moz-range-track {
  width: 100%;
  height: 10px !important;
}
input[type=range]::-moz-range-thumb {
  height: 11px !important;
  width: 11px;
}
input[type=range]::-ms-track {
  width: 100%;
  height: 5.1px;
}
input[type=range]::-ms-thumb {
  height: 11px !important;
  width: 11px;
  height: 5.1px;
}
#capas{
max-height:100%;
z-index:11;
}
}
.collapse {
display: block !important;
visibility: visible !important;
height: auto !important;
}
.navbar-toggle {
    display: none !important;
}


.findPlace {
        width: 50%;
    font-size: 20px;
    height: 40px;
    float: left;
}
.goPlace {
        font-size: 20px;
    height: 40px;
    width: auto;
    float: left;
}
#cajabuscar {
    left: 0px !important;
    top: 0px !important;
    width: 100% !important;
    height: 40px !important;
    padding: 0px !important;
    overflow: hidden;
    background:$texto;
}
    .pac-container.pac-logo{
z-index:10001 !important;
}
#cortina{    
        background: -webkit-linear-gradient(left top, $texto, $primero); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(bottom right, $texto, $primer); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(bottom right, $texto, $primero); /* For Firefox 3.6 to 15 */
    background: linear-gradient(to bottom right, $texto, $primero); /* Standard syntax */
    border-bottom:solid 4px;
}
#grupos>.padre>input{
float:left;
border-radius:20px;
border:solid 2px black;
margin-right:5px;
width:20px;
height:20px;
}
#grupos>.padre:hover>.hijo{
    bottom: 0px;
    margin-bottom: 30px;
    border-radius: 100px;
    border-bottom-left-radius: 0px;
$efecto
}
 #grupos>*{
float:left;

}
.grupo1{background:red;}
.grupo2{background:blue;}
.grupo3{background:green;}
.grupo4{background:pink;}
.grupo5{background:yellow;}
.grupo6{background:lime;}
.grupo7{background:khaki;}
.grupo8{background:goldenrod;}
.grupo9{background:coral;}
.grupo10{background:chocolate;}
.grupo11{background:orange;}
.grupo0{background:brown;}
.grupo{background:$texto;
	border:solid 2px $primero !important;
    color: $fondo;
    width: auto !important;}
.partede1{color:red;}
.partede2{color:blue;}
.partede3{color:green;}
.partede4{color:pink;}
.partede5{color:yellow;}
.partede6{color:lime;}
.partede7{color:khaki;}
.partede8{color:goldenrod;}
.partede9{color:coral;}
.partede10{color:chocolate;}
.partede11{color:orange;}
.partede0{color:brown;}

.noSeleccionado{
opacity:0.3}
#grupos{
float:right;
height:30px;
padding:5px;
}
#playStop {
    float: right;
}
.advertencia {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0px;
    left: 0px;
       background: $texto;
    background: -webkit-linear-gradient(left top, $texto, $primero); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(bottom right, $texto, $primer); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(bottom right, $texto, $primero); /* For Firefox 3.6 to 15 */
    background: linear-gradient(to bottom right, $texto, $primero); /* Standard syntax */

}
#cerrarAdvertencia {
margin-top: 10%;
    width: 50%;
    height: 40%;
font-size: 30px;
    padding: 20px;
}
.operaciones {
    width:0px;
    height:0px;
    position: fixed;
        bottom: 40px;
    top: 40px;
    left: 0px;
    right: 0px;
    margin: auto;
    z-index: 1000;
    overflow:hidden;
    background: $texto;
    -webkit-transition: all 1s ease;
    -moz-transition: all 1s ease;
    -o-transition: all 1s ease;
    transition: all 1s ease;
    padding: 0px;
    border-radius:500px;
}
.operaciones>* {
    float: left;
    font-size: 20px;
    color: rgba(57, 131, 143, 0.972549);
height: 40px;
    margin: 0px;
    width: 50%;
}
.operaciones>select {
    width: 100%;
}
.operaciones>.selectbutton{
    width: 100%;
    margin-top: -40px;
}
.muestra{
      box-shadow: rgba(0, 0, 0, 0.5) 15px 20px 20px 0px;
width:300px !important;
height:180px !important;
    transform: rotate(360deg);
 -webkit-transition: all 1s ease;
    -moz-transition: all 1s ease;
    -o-transition: all 1s ease;
    transition: all 1s ease;
padding:20px !important;
border-radius:0px !important;
border:dashed 5px $fondo;
}
#cover{
width:100%;
height:100%;
top:0%;
left:100%;
position:fixed;
overflow:hidden;
background:$fondo;

 -webkit-transition: all 1s ease;
    -moz-transition: all 1s ease;
    -o-transition: all 1s ease;
    transition: all 1s ease;
transform: perspective( 1000px ) rotateY(-90deg);
}
.muestraCover{
overflow-y:auto !important;
      box-shadow: rgba(0, 0, 0, 0.5) 15px 20px 20px 0px;
width:100% !important;
height:100% !important;
top:0px!important;
left:0px!important;
    
 -webkit-transition: all 1s ease;
    -moz-transition: all 1s ease;
    -o-transition: all 1s ease;
    transition: all 1s ease;
padding:0px !important;
border-radius:0px !important;
z-index:1001;
transform: perspective( 1000px ) rotateY(0deg) !important;
}

.hijo > i {
    margin-left: 10px;
}
.hijo > i:hover {
    color:$primero !important;
}
#cover > div {
    width: 100%;
    float: left;
    padding: 10px;
    padding-left: 10%;
    padding-right: 10%;
    margin-bottom: 10px;
}
#cover>div > img {
    height: 250px;
    margin: 5px;
}
#cover>button {
    position: fixed;
    top: 0px;
    left: 0px;
    width: 50px;
    height: 50px;
    font-size: 30px;
    background: $fondo;
    color: $texto;
}
#cover>button:hover {
    background: $primero;
    color: $fondo;
    cursor:pointer;
}

#cerraCover {
    position: fixed;
    font-size: 20px;
    width: 20%;
    height: 50px;
    border: none;
    margin-right: 0px !important;
    background: $texto;
    background: -webkit-linear-gradient(left top, $texto, $primero); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(bottom right, $texto, $primer); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(bottom right, $texto, $primero); /* For Firefox 3.6 to 15 */
    background: linear-gradient(to bottom right, $texto, $primero); /* Standard syntax */

    padding: 7px;
    color: $fondo;
    top: 0px;
    left: 20%;
    transition: all cubic-bezier(0.2, 1.24, 0.58, 1) 1s;
    overflow: hidden;
}
#cerraCover>i {
        width: 100%;
    height: 100%;
    margin-top: 0px;
    transform: rotate(0deg);
    float: right;
    font-size: 30px !important;
    padding: 5px;
}
#cerraCover>p {
    margin: 0px;
    width: 100px;
    height: 20px;
    transform: rotate(-90deg);
    margin-left: -43px;
    float: none;
    margin-top: -77px;
    font-size: 18px;
}
#cerraCover:hover {
    background: $fondo;
    color: $primero;
    cursor:pointer;
    transition: all cubic-bezier(0.2, 1.24, 0.58, 1) 1s;
}
#cover .filters {
    background: $fondo;
    padding: 0px;
}
.colores {
    width: 20px;
    height: 20px;
    float: left;
    margin-right:20px;
}
#cover .filters{
text-align:center;
}
/*
 *  STYLE 6
 */

::-webkit-scrollbar-track
{
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: $segundo;
}

::-webkit-scrollbar
{
        width: 15px;
        background-color: $segundo;
}
::-webkit-scrollbar-thumb:hover{
    background-color: $texto;
cursor:pointer;
}

::-webkit-scrollbar-thumb
{
        background-color: $primero;
        
}

.desc {
    padding: 20px;
    background: $texto;
    color: $fondo;
    font-size: 12px;
    border-bottom-right-radius: 20px;
    border-top-left-radius: 20px;
}
.displaynone{
transform: perspective( 1000px ) rotateY(90deg)  !important;
margin-bottom:-400px !important;
transition:all ease 1s;
}
.paletaColores{
width:100% !important;
height:auto !important;
float:none;
margin-bottom:20px;
}

.capa{
border-bottom:solid 3px;
padding:5px;
margin-bottom:5px;
background: $cajas;
transition:all ease 1s;
}
#tour {
left: 60%;
    position: fixed;
    top: 0px;
    height: 50px;
    width: 20%;
    font-size: 25px;

}
.cortina {
    background: $texto;
    
    z-index: 100001;
    position: fixed;
}
.next {
    z-index: 10000000;
    position: fixed;
    font-size: 60px;
    bottom: 0px;
    top: 0px;
    margin: auto;
    right: 0px;
    
    color: $segundo;
    background: $texto;
    border: solid $primero;
    width: 61px;
    height: 62px;
    border-radius: 35px;
}
.back {
      z-index: 10000000;
    position: fixed;
    font-size: 60px;
    bottom: 0px;
    top: 0px;
    margin: auto;
    left: 0px;
    color: $segundo;
    background: $texto;
    border: solid $primero;
    width: 61px;
    height: 62px;
    border-radius: 35px;

}
.closer {
z-index: 10000000;
    position: fixed;
    font-size: 60px;
    bottom: 400px;
    top: 0px;
    margin: auto;
    right: 0px;
    left: 0px;
    color: $fondo;
    background: $texto;
    border: solid $primero;
    width: 61px;
    height: 62px;
    border-radius: 35px;
}

.next:hover, .back:hover, .closer:hover {
color:$texto;
background:$segundo;
cursor:pointer;
}
.explicacion{
 left:0px; 
top:0px;
bottom:0px;
right:0px; 
margin:auto; 
width:100%; 
height:400px;
border-radius: 200px;
padding: 60px; 
    
background:$segundo;
overflow:hidden;
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
@-webkit-keyframes exp2 {
    0% {background:$primero; color:$segundo;}
    50% {background:$segundo;color:$primero;}
    100% {background:$primero; color:$segundo;}
}
@keyframes exp2 {
    0% {background:$primero; color:$segundo;}
    50% {background:$segundo;color:$primero;}
    100% {background:$primero; color:$segundo;}

}

.selec{
/*-webkit-animation-name: exp;
    -webkit-animation-duration: 4s;
    animation-name: exp;
    animation-duration: 2s;
animation-iteration-count: infinite;
*/
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

.Msecundario>li>img {
    height: 17px;
    float: left;
    width: 30px;
}
.icon > img {
    width: 100%;
    height: 70px;
}
#cover h2>img {
    width: 60px;
    height: 30px;
    margin: 5px;
}
#cover>*{
text-align:justify;
}
#google_translate_element {
    margin-right:-500px;
    position: fixed;
    top: 86px;
    right: 0px;
    background: $segundo;
    padding: 10px;
    width:500px;
border:solid 4px;
}
.verTraductor{


    margin-right: 0px !important;
    right: 0px !important;
    left: 0px;
    width: 100% !important;
    top: 50px !important;

}
.skiptranslate>iframe{display:none !important;}
#language {
    display: block !important;
    float: right;
    top: 0px;
    left: 40%;
    width: 20%;
    height: 50px;
    font-size: 33px;
    position: fixed;
    color: $segundo;
    padding: 7px;
    z-index: 13;
    background: $texto;

}#language:hover {
    cursor:pointer;
    background:$segundo;
    color: $primero;
}
center {
    width: 100%;
    height: 100%;
}
center>img {
    position: fixed;
    width: 300px;
    height: 300px;
    top: 0px;
    bottom: 0px;
    left: 0px;
    right: 0px;
    margin: auto;
}
#cortina>i {
    position: fixed;
    top: 0px;
    bottom: 0px;
    left: 0px;
    right: 0px;
    margin: auto;
    width: 260px;
    height: 300px;
}
.capa>form {
    width: 150px;
    float: left;
    margin-left: 10px;
}
.non>.container>.row>div>h2 {
    background: $texto;
    color: $segundo;
}
.showBanner{
width: 100% !important;
    height: 100% !important;
    top: 0px;
    position: fixed;
    padding: 0px !important;
    padding-top: 50px !important;
    padding-bottom: 40px !important;
    overflow-y: auto;
}
.showBanner>.logos{
    margin: auto !important;
    height: 50px !important;
    padding: 10px;
    left: 0px;
    right: 0px;
    float: none !important;
}
.showBanner>#imgMaps>.divlogos>img {
        height: 60px !important;
    width: auto !important;
    margin: auto;
    margin-top: 12px;
    margin-bottom: 12px;
    left: 0px;
    right: 0px;
    float: none;
}
.showBanner>#imgMaps>.divlogos {
    width: 100%;
    margin: auto;
    left: 0px;
    right: 0px;
    height: 84px;
}
.showBanner>#imgMaps{
width:100% !important;
height:auto !important;
}
.showBanner>#playStop{
    width: 100% !important;
}
.showBanner>#grupos{
height:60px !important;
width: 100%;
}
.showBanner>#grupos>.padre>input {
    height: 40px !important;
    width: 40px !important;
    margin-bottom: 10px;
}
.home-menu {
    width: 100%;
    height: 50px;
    float: right;
    position: fixed;
    font-size: 40px;
    margin: 0px;
    bottom: 0px;
    left: 0px;
    margin-left: -50px !important;
    padding-left: 50px;
    background: $primero;
transition:all ease 2s;
color:$segundo;

}
.menu-menu-hidde>.home-menu {
left:-100% !important;
transition:all ease 1s;
}
#btnBanner {
    position: fixed;
    bottom: 0px;
    left: 0px;
    width: 100%;
    height: 40px;
    background: $segundo;
    color: $texto;
    font-size: 30px;
    padding: 5px;
z-index: 10;
}
p,h1,h2,h3,h4,h5,h6{
font-family: "Fira Sans", sans-serif !important;
}
.nav>.padre:hover>.hijo {
    display: none !important;
}
#language>.hijo{
display:none !important;
}
.goog-te-menu2>table>tbody>tr>td {
    width: 100%;
    float: left;
    height: auto;
}
.goog-te-menu2>table {
    width: 100% !important;
    height: auto;
}
.goog-te-menu2 {
    width: 100% !important;
    height: 100% !important;
    overflow: auto !important;
}
.goog-te-menu2>table>tbody>tr>td>a>div>span {
    font-size: 20px !important;
    color: $segundo !important;

}
.goog-te-menu2>table>tbody>tr>td>a>div {
background:$texto !important;
}
.muestraCover img {
    max-height: 200px;
    margin:10px;
}
FINCSS;
?>


