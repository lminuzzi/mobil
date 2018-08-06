<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.percentageloader/0.1.0/jquery.percentageloader.min.js"> </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.percentageloader/0.1.0/jquery.percentageloader.css">
<style>#ex1Slider .slider-selection {
  background: #BABABA;
}</style>

    <div class="container">
      <div class="row">
      <div class="span12">
        <div class="container" style="text-align:center; margin-bottom: 20px;">
          <div style="float:left">
          	<img src="<?php echo BASE_URL; ?>assets/img/truck-ico-inverse.png" style="overflow: hidden; opacity:0.5;width: 60px; ">
          </div>
          <input type="text" placeholder="Filtrar Equipamento" id="fEq">
            <div style="float:right" style="margin: 0 10px;">
                <a href="<?php echo BASE_URL; ?>home/default" style="color:#ccc;"><i class="fa fa-th fa-3x"></i></a>  
                <a href="<?php echo BASE_URL; ?>home/lista" style="color:#888;">
                    <i class="fa fa-list fa-3x"></i>
                </a>
            </div>
        </div>
      </div>
        <div class="span12">

          <!-- /widget -->

          <div class="row">
            <div class="widget">
            <div class="widget-header"> <i class="icon-list"></i>
              <h3>Lista de Equipamentos</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-responsive table-stripped responsive">
                <tr data-tag="header">
                  <th> Tag </th>
                  <!--
                  <th class=""> Horímetro </th>
                  <th class="no-cel"> Consumo </th>
                  <th class="no-cel"> Graxa </th>
                  <th class="no-cel" style="text-align:center;"> Nível </th>
                  <th style="text-align:center;">Tempo de Autonomia</th>
                  -->
                  <th>Ação</th>
                </tr>
                <?php foreach ($reservatorios as $r) : 
                /*
                  $horimetro = $r['horimetro'];
                  $atual = ($r['autonomia'] + $r['horimetro_abastecimento']) - $horimetro;

                  if ($atual*100/$r['autonomia']>15) {
                      $p = number_format($atual*100/$r['autonomia'], '0', ',', '.');
                  } else {
                      $p = number_format($atual*100/$r['autonomia'], '2');
                  }
                  $qntBrutaGraxa = $r['capacidade'] - ($r['capacidade'] * $p / 100);
                  $qntGraxa = number_format($r['capacidade'] * $p / 100 / 1000, 2, ',', '.');
                  $consumo = number_format($r['capacidade'] / $r['autonomia'], 2, ',', '.');

                  if ($p > 100) {
                      $class='fa-thermometer-full';
                      $color = 'btn-warning';
                      $btn = 'btn-success';
                  }
                  if ($p >= 70) {
                      $class = 'fa-thermometer-full';
                      $color = 'green';
                      $btn = 'btn-success';
                  }
                  if ($p < 70 && $p> 30) {
                      $class = 'fa-thermometer-half';
                      $color = '#ffce44';
                      $btn = 'btn-warning';
                      //$color = '#dd9c00';
                  }
                  if ($p <= 30) {
                      $class = 'fa-thermometer-empty';
                      $color = '#ec1f30';
                      //$color = '#b4120a';
                      $btn = 'btn-danger';
                  }
                */
              ?>
            <tr style="line-height: 40px; text-align:center; border-bottom: 0 !important;" class="reservatorio_lista" data-tag="<?php echo $r['titulo']; ?> ">

            <td><span style="color:green"><i class="fa fa-tags"></i></span>
            <span style="font-weight: bold;"><?php echo $r['titulo']; ?> </span>
            </td>
            <!--
            <td class=""><i class="fa fa-dashboard"></i> <?php echo number_format($r['horimetro'], 0, ',', '.');  ?> </td>
            <td class="no-cel"><i class="fa fa-tint"></i> <?php echo number_format($r['consumo'], 2, ',', '.'); ?> g/h </td>
            <td class="no-cel"><i class="fa fa-stack-overflow"></i> <?php echo $qntGraxa; ?> Kg</td>
            <td class="no-cel" style="text-align:center;"><span class="btn <?php echo $btn; ?>"><i class="fa fa-check"></i> <?php echo $p; ?> % </span></td>
            <td style="text-align:center;"><span class="btn btn-default"><i class="fa fa-clock-o"></i>  <?php echo $atual; ?> </span> horas restantes</td>
            -->
            <td>
                <!--
                <a class="btn btn-primary refil" data-id="<?php echo $r['id']; ?>" data-kg="<?php echo $qntBrutaGraxa; ?>" data-titulo="<?php echo $r['titulo']; ?>" data-horimetro="<?php echo $r['horimetro']; ?>" data-toggle="tooltip" data-placement="top" title="Completar Reservatório"> <i class="fa fa-tint"></i>  </a>
                <a class="btn btn-warning"  data-toggle="tooltip" data-placement="top" title="Histórico de Consumo"> <i class="fa fa-history"></i>  </a>
                -->
                <a href="<?php echo BASE_URL; ?>reservatorios/edit/<?php echo $r['id']; ?>" class="btn btn-default"  data-toggle="tooltip" data-placement="top" title="Editar Equipamento"> <i class="fa fa-edit"></i>  </a>
            </td>

            </tr>

                <?php endforeach; ?>
              </table>
            </div>
            <!-- /widget-content -->
          </div>

          </div>


                    <!-- /widget -->
        </div>
        <!-- /span6 -->
        <div class="clearfix"></div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->

<!--
    <script>
      $('.refil').click(function(){
        var id = $(this).attr('data-id');
        var horimetro = $(this).attr('data-horimetro');
        var kg = $(this).attr('data-kg');
        var titulo = $(this).attr('data-titulo');
        swal({
        title: "Preenchimento do Equipamento "+titulo,
        text: "Por favor, digite o horimetro de substituição",
        type: "input",
        inputType: 'number',
        showCancelButton: true,
        closeOnCancel: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "Digite o horímetro atual"
      },
      function(inputValue){

        horimetro = parseInt(horimetro);
        if (inputValue === false) return false;
        inputValue = inputValue.replace(',','');
        inputValue = inputValue.replace('.','');
        inputValue = parseInt(inputValue);

        if (inputValue === "" || isNaN(inputValue)) {
          swal.showInputError("Digite o Horimetro atual.");
          return false
        }
        if (inputValue < horimetro) {
          swal.showInputError("Horimetro Inválido - Menor do que o atual.");
          return false
        }
        $.ajax({
          method: "GET",
          url: "<?php echo BASE_URL; ?>reservatorios/att_refil",
          data: {id : id, horimetro : inputValue, horimetro_a : horimetro, kg : kg }
        })
          .done(function( msg ) {
             swal("Ok!", "Refil atualizado com sucesso!");
             //window.location = "<?php echo BASE_URL; ?>/home/lista";


          });

      });
      });
    </script>
<script>
  $("#fEq").keyup(function(){
    var val = $("#fEq").val().toUpperCase();
    if (val == '') {
      var regex = new RegExp('');
    } else {
      var regex = new RegExp(val);
    }

    console.log(regex.test('CM2330'));
    //console.log(val);

    $("tr").each(function(res){
      if (!regex.test($(this).attr('data-tag').toUpperCase()) && $(this).attr('data-tag') != 'header') {
          $(this).hide('fast');
      } else {
        $(this).show('fast');
      }
    })
  });
</script>
-->
