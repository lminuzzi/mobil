<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.percentageloader/0.1.0/jquery.percentageloader.min.js"> </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.percentageloader/0.1.0/jquery.percentageloader.css">
<style>#ex1Slider .slider-selection {
  background: #BABABA;
}</style>
    <div class="container">
      <div class="row">
        <div class="span12">

          <!-- /widget -->

          <div class="row">
          <?php foreach ($reservatorios as $r) : ?>
            <?php
            $horimetro = $r['horimetro'];
                          $atual = ($r['autonomia'] + $r['horimetro_abastecimento']) - $horimetro;

                          if ($atual*100/$r['autonomia']>15) {
                            $p = number_format($atual*100/$r['autonomia'], '0',',','.');
                          } else {
                            $p = number_format($atual*100/$r['autonomia'], '2',',','.');
                          }
                          $qntGraxa = number_format($r['capacidade'] * $p / 100 / 1000,2,',','.');
                          $consumo = number_format($r['capacidade'] / $r['autonomia'],2,',','.');

            if ($p > 100) {
                $class='fa-thermometer-full';
                $color = 'btn-warning';
            }
            if ($p >= 70) {
                $class = 'fa-thermometer-full';
                $color = 'btn-success';
            }
            if ($p < 70 && $p> 30) {
                $class = 'fa-thermometer-half';
                $color = 'btn-warning';
            }
            if ($p <= 30) {
                $class = 'fa-thermometer-empty';
                $color = 'btn-danger';
            }
            ?>
            <div class="span2 reservatorio">
              <div class="widget widget-nopad">
              <div class="reservatorio-header <?php echo $color; ?>">
                <h3 class=""> <i class="fa fa-thermometer-full"></i> <?php echo $r['titulo']; ?></h3>
                <div class="btn-reservatorio">
                <a class="btn btn-primary " data-toggle="tooltip" data-placement="top" title="Preencher Reservatório"> <i class="fa fa-tint"></i>  </a>
                <a class="btn btn-warning"  data-toggle="tooltip" data-placement="top" title="Histórico de Consumo"> <i class="fa fa-history"></i>  </a>
                <a href="<?php echo BASE_URL; ?>reservatorios/edit/<?php echo $r['id']; ?>" class="btn btn-default"  data-toggle="tooltip" data-placement="top" title="Editar Reservatório"> <i class="fa fa-edit"></i>  </a>
                </div>
              </div>
              <!-- /widget-header -->
              <div class="widget-content">
                <div class="widget big-stats-container">
                  <div class="widget-content">
                  <div class="container">




                  <h6 class="bigstats reservatorio">
          <div id="myDiv<?php echo $r['id'];?>" style="max-width: 100px;"></div>
             <script>
                                     $("#myDiv<?php echo $r['id'];?>").percentageLoader({
    width : 120, height : 120, progress : 0.5, value : '~27 kg'});
                                   </script>
                  </div>

                     <i class="fa fa-cogs"></i> Consumo Médio:   <b style="font-weight: bolder; font-size:110%;"><?php echo $consumo; ?> g/h</b>
                                        </h6>

                    <div id="big_stats" class="cf">

                      <div class="stat"> <i class="fa <?php echo $class; ?>" alt="Nível do Reservatório"> </i> <span class="value">
                        <?php  echo $p; ?>%

                      </span> </div>


                      <!-- .stat -->
                      </div>

                    </div>
                    <div class="footer-reservatorio" style="text-align:center; color:#aaa">  <i class="fa fa-clock-o" style="font-size: 150%; margin-left: -10px; margin-right: 10px;"></i> <b style="font-weight: bolder; font-size:110%;"><?php echo $atual; ?> horas restantes</b> </div>


                  </div>
                  <div class="container" style=" padding: 10px 0; border-top:1px solid #fefefe; margin-top:-20px;">
                  <div class="span6">
                  <i class="fa fa-tint" style="font-size: 150%; color:#aaa;"></i> <h6 style="margin-top:-25px; margin-left:30px;"> Quantidade de Graxa: <?php echo $qntGraxa; ?> Kg</h6>

                  </div>

                  </div>
                </div>
                <!-- /widget-content -->
              </div>
            </div>
          <?php endforeach; ?>
          </div>


                    <!-- /widget -->
        </div>
        <!-- /span6 -->
        <div class="clearfix"></div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
