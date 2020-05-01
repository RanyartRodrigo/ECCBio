<?php
                include "../base_MoFuSS.php";
  if("Alcances"){
  	$query = "SELECT * FROM alcances";
  }
  else if("Amigos"){
  	$query = "SELECT * FROM personas";
  }
  else if("Asesoramientos"){
  	$query = "SELECT * FROM asesoramientos";
  }
  else if("Investigaciones"){
  	$query = "SELECT * FROM investigaciones";
  }
  else if("Personas"){
  	$query = "SELECT * FROM personas";
  }
  else if("Publicaciones"){
  	$query = "SELECT * FROM publicaciones";
  }
  












  $result = $db->query($query);
  $numfilas = $result->num_rows;
  echo "<div id='elemento'>";
  for ($x=0;$x<$numfilas;$x++) {
      $fila = $result->fetch_object();
        echo '<p>'.$fila->a.'</p>';
        echo '<p>'.$fila->b.'</p>';
        echo '<p>'.$fila->c.'</p>';
     }        
     echo "</div>";
?>