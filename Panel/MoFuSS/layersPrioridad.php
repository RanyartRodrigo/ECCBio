<?php
  include '../base.php';
  include "../host2.php";
  $obj=new Base("localhost",$DB_user,$DB_name);
        $result = $obj->consulta( "SELECT sub,subMenu,nombre,id_Capa as id,concat('<i class=\'fa fa-arrow-circle-o-down menosP\' onClick=\'PrioridadL(',id_Capa,',+1)\'></i><i class=\'fa fa-arrow-circle-o-up masP\' onClick=\'PrioridadL(',id_Capa,',-1)\'></i>') as a FROM menus where id_Pais=".$_POST["pais"]." order by prioridad ASC");  
  $numfilas = $result->num_rows;
  $subList=array();
  $y=0;
  for ($x=0;$x<$numfilas;$x++) {
      $fila = $result->fetch_object();
      if($fila->sub==1 && !in_array($fila->nombre,$subList)){
		array_push($subList,$fila->nombre);
		$y++;
      		echo "<div class='elemento ' id='".$fila->id."-p' title='".$fila->id."'>";
        	echo '<h7>'.$y.'.- </h7>';
        	echo '<p class="sub">'.$fila->a.'*'.$fila->nombre.'</p>';
        	echo "</div>";
	}
      else if($fila->sub!=1 && $fila->subMenu==''){
                $subAnt=$fila->subMenu;
                $y++;
                echo "<div class='elemento ' id='".$fila->id."-p' title='".$fila->id."'>";
                echo '<h7>'.$y.'.- </h7>';
                echo '<p>'.$fila->a.$fila->nombre.'</p>';
                echo "</div>";
        }
      else if($fila->sub!=1 && !in_array($fila->subMenu,$subList)){
                array_push($subList,$fila->subMenu);
                $subAnt=$fila->subMenu;
                $y++;
                echo "<div class='elemento ' id='".$fila->id."-p' title='".$fila->id."'>";
                echo '<h7>'.$y.'.- </h7>';
                echo '<p class=" sub">'.$fila->a.'*'.$fila->nombre.' - '.$fila->subMenu.'</p>';
                echo "</div>";
        }
    else{
                //$subList=array_push($subList,$fila->subMenu);
                $subAnt=$fila->subMenu;
                $y++;
                echo "<div class='elemento ' id='".$fila->id."-p' title='".$fila->id."'>";
                echo '<h7>'.$y.'.- </h7>';
                echo '<p class="sub2">'.$fila->a.$fila->nombre.' - '.$fila->subMenu.'</p>';
                echo "</div>";
        }
     }  
     echo "<div class='elemento' onClick='datos(this.title)' title='null-".$lista."'>";
        echo '<span>Nuevo</span>';
        echo "</div>";
        echo "<input id='nl' type='number' value='".(($nl/10)+1)."' class='hidden'>";      

?>
<script>
$('#Lista').after($('#Lista2'));
function PrioridadL(este, val){
                        $.ajax({
                        data: {
                          "opcion": 4,
                          "valor":val,
                          "pais" :<?php echo $_POST["pais"]?>,
                          "id" : este
                        },
                        type: "POST",
                        dataType: "json",
                        url: "MoFuSS/menusModel.php",
                      })
                      .done(function( respuesta ) {
                            $("#Lista2").load(host+"MoFuSS/layersPrioridad.php",{pais:<?php echo $_POST["pais"]?>});
$("html,body").animate({
        scrollTop: $("#Lista2").offset().top},
        "slow");
                      })
                      .fail(function( jqXHR, textStatus, errorThrown ) {
                        if ( console && console.log ) {
                          console.log( "La solicitud a fallado: " +  textStatus);
                      }
                      });
    }

</script>
<style>
.masP, .menosP {
    float: right;
    width: 20px;
    height: 20px;
}
.sub{
background: black !important;
color:white !important;
}
.sub2{
background: gray !important;
color:white !important;
}
</style>

