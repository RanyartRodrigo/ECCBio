<?php
 $jsondata = array();
 $jsondata["success"] = true;
    $jsondata["data"]["message"] ="Se han encontrado %d usuarios";
    header('Content-type: application/json; charset=utf-8');
  echo json_encode($jsondata, JSON_FORCE_OBJECT);

?>