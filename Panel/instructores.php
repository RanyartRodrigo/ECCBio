<?php
$id=$_POST['id'];
 $jsondata = array();
 $jsondata["success"] = true;
    $jsondata["data"]["message"] ="Se han encontrado %d usuarios ".$id;
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);

?>