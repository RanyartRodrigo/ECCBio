<?php

include "../base.php";
$obj=new Base("localhost","root","global");
$color1=$_POST['color1'];
$color2=$_POST['color2'];
$color3=$_POST['color3'];
$color4=$_POST['color4'];
$color4=$_POST['color4'];
$color5=$_POST['color5'];
$color1=str_replace("0.99","1",$color1);
$color2=str_replace("0.99","1",$color2);
$color3=str_replace("0.99","1",$color3);
$color4=str_replace("0.99","1",$color4);
$color5=str_replace("0.99","1",$color5);

$obj->consulta("update colores set color='".$color1."' where id=1");
$obj->consulta("update colores set color='".$color2."' where id=2");
$obj->consulta("update colores set color='".$color3."' where id=3");
$obj->consulta("update colores set color='".$color4."' where id=4");
$obj->consulta("update colores set color='".$color5."' where id=5");
     $jsondata = array();
 $jsondata["success"] = true;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);
?>
