<div id="<?php echo 'Activity_'.$_GET['n'];?>">
  <button class="btnEliminar" onclick="eliminarActividad(<?php echo $_GET['n'];?>)">X</button>
<h3> <?php echo "Actividad ".$_GET['n'];?></h3>
</div>
              <div class="panelIzquierdo">
                <label for="comment">Descripción </label>
                <input type="text" name="comment" id="comment" class="form-control"/>
                <div class="panelIzquierdo">
                  <label for="hr_start">Hora de inicio:</label>
                  <input type="text" class="form-controls hide hr_start" name="hr_start" />
                  <div class="input-group date datetimepicker6">        
                    <input type="text" class="form-control hr_start_timePicker"  />
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                </div>
                <div class="panelDerecho">
                <label for="icon">Icono del Horario: </label>
                <select name="icon" id="icon" value="" class="form-control">
                  <option value="fa fa-clock-o">clock</option>
                  <option value="fa fa-user">user</option>
                </select>
                </div>
                
                
              </div>
              <div class="panelDerecho">
                <div class="box box-orange box-example-1to10">
                  <div class="box-header">Horas</div>
                  <div class="box-body">
                    <select class="example-1to10" name="rating" autocomplete="off">
                      <?php
                        for($x=23;$x>=0;$x--)
                          if($x==0)
                            echo '<option value="'.$x.'" selected>'.$x.' hr(s)</option>';  
                          else
                            echo '<option value="'.$x.'">'.$x.' hr(s)</option>';  
                       ?>
                    </select>
                  </div>
                </div>
                <div class="box box-blue box-example-1to10">
                  <div class="box-header">Minutos</div>
                  <div class="box-body">
                    <select class="example-movie" name="rating" autocomplete="off">
                     <?php
                        for($x=60;$x>=0;$x=$x-5)
                          if($x==0)
                            echo '<option value="'.$x.'" selected>'.$x.' min(s)</option>';
                         else
                            echo '<option value="'.$x.'">'.$x.' min(s)</option>';
                      ?>
                    </select>
                 </div>
                </div>
              </div> 
              <div class="separador"></div>
                    <script>
    $(document).ready(function(){
              $('.example-1to10').barrating('show', {
            theme: 'bars-horizontal',
            reverse: true,
            hoverState: true
        });

        $('.example-movie').barrating('show', {
            theme: 'bars-horizontal',
            reverse: true,
            hoverState: true
        });

                $('.datetimepicker6').datetimepicker({
      sideBySide: true,
      format: 'DD-MM-YYYY hh:mm A'

    });

    
        $(".datetimepicker6").on("dp.change", function (e) {
  
      var m = moment($('.hr_start_timePicker').val(), 'DD-MM-YYYY hh:mm A'); 
      $('.hr_start').val(m.format("YYYY-MM-DD HH:mm:00"));
      
        });


    });
    </script>