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

.padre>.hijo {
    display: none;
    background: rgba(248, 249, 255, 0.921569);
    position: relative;
    float: right;
    margin-right: 10px;
    padding: 20px;
    border-radius: 200px;
    border-top-right-radius: 0px;
    border: solid 1px $texto;
}
.padre:.hijo > div{
display: block !important;
}
.bx-viewport{
min-height:200px;
}
.abrir{
    width: auto !important;
    overflow: visible !important;
}
#panelDeControl > i {
    width: 40px;
    height: 40px;
    color: $fondo;
    font-size: 25px;
padding:8px;
}
#panelDeControl > *{
float:right;
}
#panelDeControl i:hover{
cursor:pointer;
background:$fondo !important;
color:$texto !important; 
}

#menu {
    float: left;
    width: 100%;
    height: 40px;
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
  height: 5.1px;
  cursor: pointer;
    background: $primero;
  border-radius: 25px;
  border: 0px solid $primero;
}
input[type=range]::-webkit-slider-thumb {
    border: 1px solid rgba(0, 0, 0, 0.22);
  height: 21px;
  width: 11px;
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
  height: 5.1px;
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
    width: 20px;
    height: 20px;
    line-height: 15px;
    padding: 0px;
font-family:monospace;
}
.capa input[value="X"] {
    float: right;
    border-radius: 30px;
    background: $segundo;
    border: solid 1px red;
    color: red;
    width: 20px;
    height: 20px;
    line-height: 15px;
    padding: 0px;
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
.divlogos:hover >.logosmapasgrande {
    position: absolute;
    top: -300px;
margin-left:20px;
    width: 300px;
    height: 300px;
    background: white;
    padding: 50px;
    border-radius: 50px;
    border-bottom-left-radius: 0px;
    transition: all ease 2s;
    display: block !important;
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
#capas>*, #infoMap>* {
    border-bottom: solid 1px;
    margin: 15px;
    padding-bottom: 7px;
    text-align: left;
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
    left:246px;
}

 @media(min-width:771px){
.caret{
margin-top:15px;
float:right;
}
.ayudaPerson{
display:none;
}
.padre>.hijo {
       display: none;
    background: $fondo;
    position: absolute;
    float: left;
    padding: 20px;
    margin-left: 15px;
    border-radius: 200px;
    border-top-left-radius: 0px;
    border: solid 1px $primero;
}

.padre:hover > .hijo{
display: block !important;
}

.control-panel> i{
display:none;
}
.padre:hover .ayudaPerson {
    display:block;
    position: fixed;
    bottom: 0px;
    right: 0px;
    left: inherit;
    font-size: 29px !important;
    width: 30px;
    height: 30px;
    margin: 3px;
    padding: 0px;
    z-index: -1;
}

.dropdown-menu >.padre >.hijo,  .nav >.padre >.hijo{
        position: fixed;
    bottom: 24px;
    right: 28px;
    border-radius: 100px !important;
    border-bottom-right-radius: 0px !important;
}
li > i {

        width: 15px;
    position: absolute;
    left: 0px;
    margin-top: -27px;
    padding-left:10px;
    padding-right:10px;
font-size: 17px !important;
}
li > a {
    height: 100%;
padding-left: 30px !important;

}
li > a> label {
    float: right;
    padding-top: 6px;
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
#panelDeControl {
    width:40px;
    overflow:hidden;
    height: 40px;
    float:left;
    
    background: $texto;
    background: -webkit-linear-gradient(left top, $texto, $primero); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(bottom right, $texto, $primer); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(bottom right, $texto, $primero); /* For Firefox 3.6 to 15 */
    background: linear-gradient(to bottom right, $texto, $primero); /* Standard syntax */
transition:all ease 1s;
    z-index:100;
}    
#banner {
    position: fixed;
    width: 100%;
    bottom: 0px;
    height: 40px;
    background: $cajas;
    padding: 5px;
    left:246px;
}
#capas {
   box-shadow: 5px -1px 35px 3px rgba(0, 0, 0, 0.28);
    width: 300px;
    position: fixed;
    background: $cajas;
    bottom: 49px;
    left: 250px;
    max-height: 35%;
    overflow-y: auto;
    border: 0px !important;
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
    z-index: 2;
    position: fixed !important;
    width: 100%;
}
.navbar-side{
    top: 60px;
        height: auto;
}
}
div#map {
    width: 100%;
    min-height: 600px;
}


















/* SLIDE THREE */
.slideThree {
    width: 80px !important;
    height: 26px !important;
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
    font: 12px/26px Arial, sans-serif;
    color: #000;
    position: absolute;
    right: 10px;
    z-index: 0;
    font-weight: bold;
    text-shadow: 1px 1px 0px rgba(255,255,255,.15);
}

.slideThree:before {
    content: 'ON';
    font: 12px/26px Arial, sans-serif;
    color: #00bf00;
    position: absolute;
    left: 10px;
    z-index: 0;
    font-weight: bold;
}

.slideThree label {
    display: block;
    width: 34px;
    height: 20px;

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
    margin-top: 10px;
    margin-left: 9px;
    width: 30px !important;
    height: 13px !important;
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
    font: 10px/15px Arial, sans-serif;
    color: #f00;
    position: absolute;
    right: 2px;
    z-index: 0;
    font-weight: bold;
    text-shadow: 1px 1px 0px rgba(255,255,255,.15);
}

.miniSlideThree:before {
    content: 'Y';
    font: 10px/15px Arial, sans-serif;
    color: #00bf00;
    position: absolute;
    left: 2px;
    z-index: 0;
    font-weight: bold;
}
.miniSlideThree label {
    display: block;
    width: 15px;
    height: 10px;
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
    top: 1px;
    left: 1px;
    z-index: 1;
    -webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    -moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
    background: #ff0000;
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
}

.miniSlideThree input[type=checkbox]:checked + label {
    left: 15px;
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
    width: 80px;
    height: 90px;
    padding-top: 25px;
    padding-bottom: 25px;
    background: $cajas;
    float: left;
    padding-left: 5px;
    padding-right: 5px;
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


/***** Top menu *****/
@media screen and (min-width: 771px){
    body{
                padding-top: 40px;
    }
    .control-panel {
    width: 100%;
    height: 40px;
    background: $texto;
    position: fixed;
    float: left;
    z-index: 12;
    top: 0px;
    left: 0px;
    padding-left:90px;
    padding-right:90px;
}
.Mprincipal {
    height: auto;
    float: right;
    margin: 0px;
}
.Mprincipal>li:hover {
    background: $segundo;
    color: $primero;
    cursor:pointer;

}
.Mprincipal>li:hover>ul {
    height: auto;
    background: $segundo;
    color: $primero;
    overflow-y: visible;
    cursor: pointer;
    border-bottom: 2px solid $primero;
}
.Msecundario {
    overflow:hidden;
    height:0px;
    margin-top: 8px;
    padding-left: 0px;
    width: 117%;
    float: left;
    background: $segundo;
    color: $primero;
    margin-left: -10px;
    transition:height ease 1s;
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
    float: right;
    height: 40px;
    padding: 10px;
    font-size: 16px;
    background: $texto;
    color: $segundo;
}
.Msecundario > li {
    padding: 5px;
}
.navbar {
    top: 40px;
    background: #fcfcfc;
    border: 0;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
    border-radius: 0;
    position: fixed;
    z-index: 11;
    width: 245px;
    border-right: 6px solid $texto;
    opacity: 0.92;
    bottom: 0px;
    margin-bottom: 0px;
}
#MenuPrincipal .container {
    width: 100% !important;
        height: 100%;
            padding: 0px !important;
}
.navbar-nav>li {
    float: left;
    width: 100%;
height:40px;
}
.navbar-collapse {
    padding-right: 0px !important;
    padding-left: 0px !important;
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
    padding-left: 245px;
}
li {
    text-align: left;
}
#menu-hidde {
    width: 50px;
    height: 50px;
    position: fixed;
    top: 40px;
    left: 245px;
    z-index: 11;
    color:$segundo;
    background: $primero;
    font-size: 35px;
    line-height: 48px;
    text-align: center;

}
#menu-hidde:hover {
    color:$primero;
    background: $segundo;
    cursor:pointer;
    border-radius: 0px !important;
}
.menu-menu-hidde{
    margin-left: -240px;
}

}
@media screen and (max-width: 770px){

.caret{
margin-top:15px;
float:right;
}
.control-panel > i {
    width: 40px;
    height: 40px;
    color: white;
    font-size: 25px;
    padding: 8px;
    position: absolute;
    left: 0px;
}
#country{
top:40px;
}
#lenguage{
}
.ayudaPerson{
display:none;
}
.padre:hover > .ayudaPerson{
display: block !important;
    position: fixed;
    bottom: 80px;
    left: 0px;
    font-size: 60px !important;
}

.padre>.hijo {
      display: none;
    background: $fondo;
    position: absolute;
    float: left;
    padding: 20px;
    margin-left: 15px;
    border-radius: 200px;
    border-top-left-radius: 0px;
    border: solid 1px $texto;
}
.navbar .padre>.hijo {
      display: none;
    background: $fondo;
    position: fixed;
    padding: 20px;
    bottom: 125px;
    left: 50px;
    border-radius: 200px;
    border-bottom-left-radius: 0px;
    border: solid 1px $texto;
}


.padre:hover > .hijo{
display: block !important;

}
li > i {

        width: 15px;
    position: absolute;
    left: 0px;
    margin-top: -27px;
    padding-left:10px;
    padding-right:10px;
font-size: 17px !important;
}
li > a {
    height: 40px;
padding-left: 30px !important;

}
li > a> label {
    float: right;
    padding-top: 6px;
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
#menu {
    float: left;
    width: 100%;
    height: 40px;
}


#map{
margin:0px !important;
}
#panelDeControl {
        height: 40px;
    float: right;
    position: absolute;
    width: 40px;
    top: 172px;
    left: 0px;
    background: $texto;
        overflow: hidden;
    background: -webkit-linear-gradient(left top, $texto, $primero); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(bottom right, $texto, $primer); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(bottom right, $texto, $primero); /* For Firefox 3.6 to 15 */
    background: linear-gradient(to bottom right, $texto, $primero); /* Standard syntax */
transition:all ease 1s;
    z-index:-1;
}
#banner{
min-height:80px;
height:auto !important;
z-index:1;
left:0px !important;
}
#banner #imgMaps{
    float: right;
    height: 30px;
    width: 100%;
    min-width: 10px;}
.navbar {
    top: 40px;
    background: $segundo;
    border: 0;
    -moz-border-radius: 0; -webkit-border-radius: 0; border-radius: 0;
    position: relative;
    z-index: 11;
    width: 100%;
        border-bottom: 6px solid $primero;
}
    .control-panel {
    width: 100%;
    background: $texto;
    position: fixed;
    float: left;
    z-index: 12;
    top: 0px;
    left: 0px;
    padding-left:0px;
    padding-right:0px;
}
.Mprincipal {
    height: auto;
    float: right;
    margin: 0px;
    width:100%;
    padding:0px !important;

}
.Mprincipal>li:hover {
    background: $segundo;
    color: $primero;
    cursor:pointer;
padding-left:0px;
padding-right:0px;

}
.Mprincipal>li:hover>ul {
    height: auto;
    background: $segundo;
    color: $primero;
    overflow-y: visible;
    cursor: pointer;
    border-bottom: 2px solid $primero;
    padding:10px;
}
.Msecundario {
    overflow:hidden;
    height:0px;
    margin-top: 8px;
    padding-left: 0px;
    width: 100%;
    float: left;
    background: $segundo;
    color: $primero;
    margin-left: 0px;
    transition:height ease 1s;
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
    float: right;
    height: 40px;
    width:100%;
    padding: 10px;
    font-size: 16px;
    background: $texto;
    color: $segundo;
}
.Msecundario > li {
    padding: 5px;
}
#capas{
padding-bottom:80px;
}
}
ul.navbar-nav {
  font-size: 12px;
  color: $texto;
  text-transform: uppercase;
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
    margin-left: 20px !important;
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
padding-left: 30px;
    padding-right: 30px;
    font-family: 'Lobster', cursive;
    font-size: 70px;
    line-height: 70px;
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

.bx-viewport {
    min-height: 203px !important;
}
@-ms-keyframes spin {
    from { -ms-transform: rotate(0deg); }
    to { -ms-transform: rotate(360deg); }
}
@-moz-keyframes spin {
    from { -moz-transform: rotate(0deg); }
    to { -moz-transform: rotate(360deg); }
}
@-webkit-keyframes spin {
    from { -webkit-transform: rotate(0deg); }
    to { -webkit-transform: rotate(360deg); }
}
@keyframes spin {
    from {
        transform:rotate(0deg);
    }
    to {
        transform:rotate(360deg);
    }
}
.fa-cog:hover{
border-radius:40px;
}
.fa-cog{
    -webkit-animation-name: spin;
    -webkit-animation-duration: 4000ms;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
    -moz-animation-name: spin;
    -moz-animation-duration: 4000ms;
    -moz-animation-iteration-count: infinite;
    -moz-animation-timing-function: linear;
    -ms-animation-name: spin;
    -ms-animation-duration: 4000ms;
    -ms-animation-iteration-count: infinite;
    -ms-animation-timing-function: linear;
    
    animation-name: spin;
    animation-duration: 4000ms;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}
.country:hover >.icon>i, .country:hover >a{
background:$fondo !important;
color: $texto !important;
cursor:pointer;
border:solid 1px;
}
.country:hover{
cursor:pointer;
background:$primero !important;
}
.closebox {
    position: fixed !important;
    width: 50px !important;
    height: 50px !important;
    font-size: 30px !important;
    background: $primero !important;
    color: $fondo !important;
    line-height: 40px !important;
    font-weight: bolder !important;
    top: 5% !important;
    right: 5% !important;
}
.closebox:hover{
background:$fondo !important;
color:$texto !important;
}
.lightbox{
top:5% !important;
left:5% !important;
width:90% !important;
height:90% !important;
}
.findPlace {
    width: 80%;
    font-size: 20px;
    height: 40px;
    padding:10px;
    margin-left:5%;
}
.goPlace {
    font-size: 20px;
    height: 40px;
    width:80%;
    padding:10px;
    margin-left:5%;
}
#cajabuscar {
    left: inherit !important;
    margin: auto !important;
    width: 100% !important;
    height: auto !important;
}
    .pac-container.pac-logo{
z-index:10001 !important;
}
FINCSS;
?>


