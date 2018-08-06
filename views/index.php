<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.percentageloader/0.1.0/jquery.percentageloader.min.js"> </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.percentageloader/0.1.0/jquery.percentageloader.css">
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/not.js"></script>
<style>
#ex1Slider .slider-selection {
  background: #BABABA;
}
</style>
    <div class="container">
      <div class="row">
      <div class="span12">
        <div class="container" style="text-align:center; margin-bottom: 20px;">
          <div style="float:left">
            <img src="<?php echo BASE_URL; ?>assets/img/truck-ico-inverse.png" style="overflow: hidden; opacity:0.5;width: 60px; ">
          </div>
          <input type="text" placeholder="Filtrar Equipamento" id="fEq">
            <div style="float:right" style="margin: 0 10px;">
                <a href="<?php echo BASE_URL; ?>home/default" style="color:#888;"><i class="fa fa-th fa-3x"></i></a>  
                <a href="<?php echo BASE_URL; ?>home/lista" style="color:#ccc;">
                <i class="fa fa-list fa-3x"></i>
                </a>
            </div>
        </div>
      </div>
        <div class="span12">
          <!-- /widget -->
          <div class="row">
            <?php 
            
            foreach ($reservatorios as $r) : 
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
                }
                if ($p >= 70) {
                    $class = 'fa-thermometer-full';
                    $color = 'green';
                }
                if ($p < 70 && $p> 30) {
                    $class = 'fa-thermometer-half';
                    $color = '#ffce44';
                    //$color = '#dd9c00';
                }
                if ($p <= 30) {
                    $class = 'fa-thermometer-empty';
                    $color = '#ec1f30';
                    //$color = '#b4120a';
                }
            */
            ?>
            <div class="span2 span-sm-3 reservatorio" data-tag="<?php echo $r['titulo']; ?> ">
              <div class="widget widget-nopad" style="margin-bottom: 75px;">
                <div class="reservatorio-header widget-content" style="text-align:center; background-color:#fff; ?>; z-index:0;">

                <h3 class="" style="color:#000; margin-top: 4px; margin-bottom: 8px; font-family: Segoe Ui, Verdana, Sans-Serif; font-weight: bold; font-size:110%; text-align:center;">
                <!--<i class="fa fa-tag" style="color:<?php echo $color;  ?>; postion: absolute; left: -20px; top: 5px; font-size:135%;"></i> <?php echo $r['titulo']; ?></h3>-->
                <i class="fa fa-tag" style="color: green; postion: absolute; left: -20px; top: 5px; font-size:135%;"></i> <?php echo $r['titulo']; ?></h3>
                <div class="btn-reservatorio">
                    <a class="btn btn-danger" data-placement="top" title="Checklist" data-toggle="modal" data-target="#farolModal<?php echo $r['id']; ?>"> <i class="fa fa-check-circle-o"></i>  </a>

                    <!--<a class="btn btn-sm btn-primary refil" data-id="<?php echo $r['id']; ?>" data-kg="<?php echo $qntBrutaGraxa; ?>" data-horimetro="<?php echo $r['horimetro']; ?>" data-toggle="tooltip" data-placement="top" title="Completar Reservatório"> <i class="fa fa-tint"></i>  </a>-->
                    <a href="<?php echo BASE_URL; ?>reservatorios/edit/<?php echo $r['id']; ?>" class="btn btn-default"  data-toggle="tooltip" data-placement="top" title="Editar Equipamento"> <i class="fa fa-edit"></i>  </a>
                </div>
              </div>
              <!-- /widget-header -->
              <div class="widget-content" style="margin-top: -2px; z-index: 1;  height:105px;">
                <div class="widget big-stats-container">
                  <div class="widget-content" style="">
                    <style>.centered td { text-align:center; font-size:100%; line-height: 32px; } </style>
                    <table class="table table-condensed table-responsive centered" style="text-align: center;">
                    <thead></thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #eee">
                        <td style="margin-left: -10px;">
                            <p style="margin-top:10px; font-size:80%; color:#aaa">
                                <a class="btn btn-danger" data-placement="top" title="Checklist" data-toggle="modal"
                                   data-target="#farolModal<?php echo $r['id']; ?>">
                                    <i class="fa fa-check-circle-o"></i>
                                </a>
                            </p>
                        </td>
                        
                            
                        <td>
                            <p style="margin-top:10px; font-size:80%; color:#aaa">
                                <a href="<?php echo BASE_URL; ?>reservatorios/edit/<?php echo $r['id']; ?>" class="btn btn-default"  data-toggle="tooltip" data-placement="top" title="Editar Equipamento"> <i class="fa fa-edit"></i>  </a>
                            </p>
                        </td>
                    </tr>
                <!--
                  <tr style="border-bottom: 1px solid #eee">
                    <td style="margin-left: -10px;"><i class="fa fa-dashboard"></i> <?php echo number_format($r['horimetro'], 0, ',', '.'); ?>
                    <p style="margin-top:-8px; font-size:80%; color:#aaa""> Horimetro </p>
                    </td>
                    <td ><i class="fa fa-tint"></i> <?php echo $consumo; ?>g/h
                    <p style="margin-top:-8px; font-size:80%; color:#aaa""> Consumo </p>
                    </td>
                  </tr>
                  -->
                  <!--
                  <tr style=" border-bottom: 1px solid #eee">
                    <td style="margin-left: -10px;"><i class="fa fa-stack-overflow"></i> <?php echo $qntGraxa; ?>Kg
                    <p style="margin-top:-8px; font-size:80%; color:#aaa"> Graxa </p>
                    </td>
                    <td ><i class="fa fa-check"></i> <?php echo round($p); ?>%
                    <p style="margin-top:-8px; font-size:80%; color:#aaa""> Nível</p>
                    </td>
                  </tr>
                  -->
                  <!--
                  <tr style="margin-left:10px; text-align:center; border-bottom: 1px solid #ccc">
                    <td colspan="2" style="background-color:#eee"><i class="fa fa-time"></i> <span style="font-weight:bolder; font-size:120%;"><?php echo $atual; ?> </span>Horas restantes.</td>
                    <td colspan="2" style="background-color:#eee"><i class="fa fa-time"></i> <span style="font-weight:bolder; font-size:120%;">&nbsp;</span></td>
                  </tr>
                  -->
                </tbody>
              </table>
                  <!--
                  <div class="" style="text-align:center; color:#aaa; margin-top:-20px;">
                   <b style="font-weight: bolder; font-size:90%;"></b>
                  </div>
                    <div class="footer-reservatorio" style="text-align:center; color:#aaa">
                    <i class="fa fa-stack-overflow" style="font-size: 130%; margin-left: -20px; margin-right: 3px;"></i> <b style="font-weight: bolder; font-size:90%;"></b>
                    </div>
                    <div class="footer-reservatorio" style="text-align:center; color:#aaa">
                    <i class="fa fa-tint" style="font-size: 130%; margin-left: -20px; margin-right: 3px;"></i> <b style="font-weight: bolder; font-size:90%;"><?php echo $consumo; ?> Consumo</b>
                    </div>
                    <div class="footer-reservatorio" style="text-align:center; color:#aaa">
                    <i class="fa fa-stack-overflow" style="font-size: 130%; margin-left: -20px; margin-right: 3px;"></i> <b style="font-weight: bolder; font-size:90%;"><?php echo $p; ?> %</b>
                    </div>
                    <div class="" style="text-align:center; color:#aaa" style="margin-bottom: 0;">
                    <i class="fa fa-dashboard" style="font-size: 150%; margin-left: -20px; margin-right: 3px;"></i> <b style="font-weight: bolder; font-size:90%;"><?php echo $r['horimetro']; ?> Horímetro</b>
                    </div>
                    -->
                    </div>
                  </div>
                </div>
                <!-- /widget-content -->
              </div>
            </div>
<div id="farolModal<?php echo $r['id']; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
      <!-- farol content-->
      <div class="modal-content" style="max-width: 800px;">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><i class="fa fa-check-circle-o"></i>Checklist</h4>
          </div>
          <div class="modal-body">
            <div class="row" style="margin-left: 0;">
                <select class="form-control" style="width: 100%; margin: 10px 0;"onchange="changeFarolSelect(this);" data-reservatorio = "<?php echo $r['id']; ?>" name="">
                   <option  selected disabled > Selecione o farol </option>
                        <?php foreach ($farois as $f) : ?>
                          <option value="<?php echo $f['id']; ?>"> <?php echo $f['titulo']; ?> </option>
                        <?php endforeach; ?>
                  </select>
                </div>
              <div class="row" style="margin-left: 0; ">
                <iframe id="iframeFarol<?php echo $r['id']; ?>" style="width: 100%;border: 0; height:300px; display:none;" src="<?php echo BASE_URL; ?>farol/get/3/5">
                </iframe>
              </div>
          </div>
          <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div> -->
      </div>
  </div>
</div>
        <!-- Fim farol -->
            <?php endforeach; ?>
          </div>
                    <!-- /widget -->
        </div>
        <!-- /span6 -->
        <div class="clearfix"></div>
      </div>
      <!-- /row -->
<script>
function changeFarolSelect(e) {
  var reservatorio = $(e).attr('data-reservatorio');
  var farol = $(e).val();
  $('#iframeFarol'+reservatorio).show();
  $('#iframeFarol'+reservatorio).attr('src','<?php echo BASE_URL; ?>farol/get/'+farol+'/'+reservatorio);
  //alert(reservatorio);
}
</script>
<style>
.trdisable {
    background-color:#cecece;
    opacity: 0.5;
}
    .green {
        color:green;
    }
    .red {
        color:red;
    }
</style>
    </div>
    <!-- /container -->
    <script>
      $('.refil').click(function(){
        var id = $(this).attr('data-id');
        var horimetro = $(this).attr('data-horimetro');
        var kg = $(this).attr('data-kg');
        swal({
        title: "Preenchimento de Reservatório",
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
             window.location = "<?php echo BASE_URL; ?>";
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
    $(".reservatorio").each(function(res){
      if (!regex.test($(this).attr('data-tag').toUpperCase())) {
          $(this).hide('fast');
      } else {
        $(this).show('fast');
      }
    })
  });
</script>
<script>
    function conta() {
        var counter = 0;
        $('.btn_ok').each(function(){
            if (!$(this).hasClass('trdisable')) {
                counter++
            }
        });
        if (counter < 1) {
            swal(
                'Pronto!',
                'Você preencheu com sucesso o Checklist do equipamento.',
                'success'
            );
            $("#farolModal").modal('hide');
            $('.btn_ok').each(function(){
                $(this).closest('tr').removeClass('trdisable');
                $(this).closest('tr').removeClass('green');
                $(this).closest('tr').removeClass('red');
            });
        }
    }
    $(document).ready(function(){
       $(".btn_ok").click(function(){
           $(this).closest('tr').addClass('trdisable');
           $(this).closest('tr').addClass('green');
           setTimeout(function(){$(this).closest('tr').detach(); conta();},800);

       });
       $(".btn_obs").click(function(){
           var t = $(this).closest('tr');
           swal({
                   title: "Não Conforme",
                   text: "Por favor, descreva o problema constatado",
                   type: "input",
                   showCancelButton: true,
                   closeOnConfirm: true,
                   animation: "slide-from-top",
                   inputPlaceholder: "Descreva o problema constatado"
               },
               function(inputValue){
                   if (inputValue === false) return false;

                   if (inputValue === "") {
                       swal.showInputError("Descrição em branco!");
                       return false
                   } else {
                        t.addClass('trdisable');
                        t.addClass('red');
                        conta();
                       return false;
                   }
               });
           });
    });
</script>
<script>
    $(document).ready(function(){
        /*swal(
            'Falha na comunicação com Hardware',
            'Sistema offline há mais de 60 minutos. Verifique placa lógica.',
            'error'
        )*/
    });
</script>