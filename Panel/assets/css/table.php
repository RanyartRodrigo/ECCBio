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


#map-canvas {
        width: auto;
      }

      #visualization {
        float: right;
      }

 @media(min-width:775px){     #legend {
        background: $segundo;
        margin: 0px;
        padding: 10px;
        min-width: 160px;
	max-width:200px;
	position:fixed;
	bottom:40px;
	right: 40px;
	box-shadow: 6px 7px 20px 0px $texto;
      }
}
 @media(max-width:775px){     #legend {
        background: $segundo;
        margin: 20px;
        padding: 10px;
        min-width: 160px;
        max-width:200px;
        position:fixed;
        bottom:40px;
        right: 0px;
        box-shadow: 6px 7px 20px 0px $texto;
      }
}


      #legend p {
        font-weight: bold;
        margin-top: 3px;
	font-size: 17px;
color:$texto;
      }
      #legend span {
        font-weight: bold;
        font-size: 14px;
color:$texto;
line-height:20px;
      }


      #legend div {
        clear: both;
      }

      .color {
        height: 12px;
        width: 12px;
        margin-right: 3px;
        float: left;
        display: block;
      }

      .color2 {
        height: 12px;
        width: 100%;
        margin-right: 3px;
        float: left;
        display: block;
      }

      .high {
        color: #F00;
      }

      .medium {
        color: #0F0;
      }

      .low {
        color: #00F;
      }

      .high, .medium, .low {
        font-weight: bold;
      }



/* Component styles */
@font-face {
    font-family: 'Blokk';
    src: url('../fonts/blokk/BLOKKRegular.eot');
    src: url('../fonts/blokk/BLOKKRegular.eot?#iefix') format('embedded-opentype'),
         url('../fonts/blokk/BLOKKRegular.woff') format('woff'),
         url('../fonts/blokk/BLOKKRegular.svg#BLOKKRegular') format('svg');
    font-weight: normal;
    font-style: normal;
}
.component {
    line-height: 1.5em;
    margin: 0 auto;
    padding: 2em 0 3em;
    width: 90%;
    max-width: 1000px;
    overflow: hidden;
}
.component .filler {
    font-family: "Blokk", Arial, sans-serif;
    color: $texto;
}
table {
    border-collapse: collapse;
    margin-bottom: 3em;
    width: 100%;
    background: $fondo;
}
td, th {
    padding: 0.75em 1.5em;
    text-align: left;
}
    td.err {
        background-color: $texto;
        color: $fondo;
        font-size: 0.75em;
        text-align: center;
        line-height: 1;
    }
th {
    background-color: $segundo;
    font-weight: bold;
    color: $fondo;
    white-space: nowrap;
}
tbody th {
    background-color: $texto;
    color: $fondo;
}
tbody tr:nth-child(2n-1) {
    background-color: $primero;
    color:$fondo;
    transition: all .125s ease-in-out;
}


/* For appearance */
.sticky-wrap {
    overflow-x: auto;
    overflow-y: hidden;
    position: relative;
    margin: 3em 0;
    width: 100%;
}
.sticky-wrap .sticky-thead,
.sticky-wrap .sticky-col,
.sticky-wrap .sticky-intersect {
    opacity: 0;
    position: absolute;
    top: 0;
    left: 0;
    transition: all .125s ease-in-out;
    z-index: 50;
    width: auto; /* Prevent table from stretching to full size */
}
    .sticky-wrap .sticky-thead {
        box-shadow: 0 0.25em 0.1em -0.1em rgba(0,0,0,.125);
        z-index: 100;
        width: 100%; /* Force stretch */
    }
    .sticky-wrap .sticky-intersect {
        opacity: 1;
        z-index: 150;

    }
        .sticky-wrap .sticky-intersect th {
            background-color: #666;
            color: #eee;
        }
.sticky-wrap td,
.sticky-wrap th {
    box-sizing: border-box;
}

/* Not needed for sticky header/column functionality */
td.user-name {
    text-transform: capitalize;
}
.sticky-wrap.overflow-y {
    overflow-y: auto;
    max-height: 50vh;
}






FINCSS;
?>


