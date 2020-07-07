            <!-- Page Title -->
        <div class="page-title-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow fadeIn">
                        <i class="fa fa-newspaper-o"></i>
                        <h1>Models /</h1>
                    </div>
                </div>
            </div>
        </div>
<?php
                include "../base.php";
		include "../host.php";
		include "../host2.php";
                $obj=new Base($DB_server,$DB_user,"mofuss_unam");
if(isset($_GET['id']))
  $result2 = $obj->consulta( "SELECT titulo FROM modelos where id='".$_GET["id"]."'");
else
    $result2 = $obj->consulta( "SELECT titulo FROM modelos");

?>


        <!-- Portfolio -->
        <div class="portfolio-container">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 filters modelos-a wow fadeInLeft">
                                 <?php
 echo '<a href="#" class="filter-all active">All</a> /';
   $numfilas = $result2->num_rows;
  for ($x=0;$x<$numfilas;$x++,$y++) {
      $fila = $result2->fetch_object();
        echo '<a href="#" class="filter-'.sustituir($fila->titulo).'">'.$fila->titulo.'</a> /';
     }
     ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 modelos">
                                <?php
                                if(isset($_GET['id']))
                                $result =$obj->consulta("SELECT * FROM modelos where id='".$_GET['id']."' ");
                                else
                                $result =$obj->consulta("SELECT * FROM modelos");
                                $numfilas = $result->num_rows;
                                $year=0;
                                  for ($x=0;$x<$numfilas;$x++) {
                                        $fila = $result->fetch_object();
                                        echo '
                                        <div class="box modelos-b '.sustituir($fila->titulo).'">
                                                <div class="box-container">
                                                        <div class="modelos-c box-text">
 <p class="Title">'.$fila->titulo.'</p>
                                                                <p class="Article">'.$fila->descripcion.'</p>';
                       $result3 =$obj->consulta("SELECT * FROM galeria_modelos where modelo='".$fila->id."' "); 
                       $numfilas3 = $result3->num_rows;
                                  for ($a=0;$a<$numfilas3;$a++){
                                    $fila2 = $result->fetch_object();
                                    echo "<img class='modelos-img' src='".$host."../panel/uploads/galeria_modelos/".$fila2->nombre."'>";
                                  }                                        

echo '
                                                        </div>
                                                </div>
                                        </div>

                                        ';
     }
                                ?>
                        </div>
                    </div>
                </div>
        </div>
