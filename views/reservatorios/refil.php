<?php
date_default_timezone_set('America/Sao_Paulo');

function passou($timestamp)
{
    $hoje = time();
    $data = $timestamp;
    $diff = $hoje - $data;
    $dias = (int)floor($diff / (60 * 60 * 24));
    if ($dias > 0) {
        if ($dias > 1) {
            return 'Há '.$dias.' Dias';
        } else {
            return 'Há '.$dias.' Dia';
        }
    } else {
        return 'Hoje';
    }
    return $dias;
}

?>

<div class="container">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <div class="row">
        <div class="span12">
        <div class="widget widget-nopad">
              <div class="widget-content">
                <div class="widget big-stats-container">
                  <div class="widget-content">
                    <h6 class="bigstats reservatorio" style="border-bottom: 1px solid #ccc; padding-bottom: 10px; line-height:10px;"> <i class="fa fa-dashboard "></i> Atualizar Refil</b>
                                        </h6>
                    </div>
                    <div class="footer-reservatorio" style="text-align:center; color:#aaa">  <i class="fa fa-truck "></i> <b style="font-weight: bolder; font-size:110%;"> <?php echo count($reservatorios); ?> Refis cadastrados</b>
                    <br>
                    </div>
                    <div style="padding: 10px;">
                        <h4 style="margin: 10px 0;"> Veículos cadastrados </h4>
                        <table class="table table-condensed">
                            <tr>
                                <th class="span2"> Título </th>
                                <th class="span1"> Volume Total </th>
                                <th class="span1"> Volume Atual </th>
                                <th class="span1"> Autonomia </th>
                                <th class="span1"> Ação </th>
                            </tr>
                            <?php foreach ($reservatorios as $r) :
                                ?>
                                <form method="POST" data-att="att<?php echo $r['id']; ?>">
                                <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
                                <input type="hidden" name="horimetro_anterior" value="<?php echo $r['horimetro']; ?>">
                                <?php

                                $horimetro = $r['horimetro'];
                                $atual = ($r['autonomia'] + $r['horimetro_abastecimento']) - $horimetro;

                                if ($atual*100/$r['autonomia']>15) {
                                    $p = number_format($atual*100/$r['autonomia'], '0', ',', '.');
                                } else {
                                    $p = number_format($atual*100/$r['autonomia'], '2', ',', '.');
                                }
                                $qntGraxa = number_format($r['capacidade'] * $p / 100 / 1000, 2, ',', '.');
                                $consumo = number_format($r['capacidade'] / $r['autonomia'], 2, ',', '.');
                            ?>

                            <tr style="color:<?php echo ($atual <= 10) ?'red':''; ?>">
                            <td class="span2"><?php echo $r['titulo']; ?></td>
                            <td class="span1"><?php echo number_format($r['capacidade']/1000, 2, ',', '.'); ?> Kg</td>

                            <td class="span1"><?php echo $qntGraxa; ?> Kg</td>
                            <td class="span1" >
                            <?php echo number_format($atual, 0, ',', '.'); ?> horas
                            </td>
                            <td class="span1"><input type="submit" class="btn btn-primary" value="Atualizar"></td>
                            </form>
                            </tr>

                            <?php endforeach; ?>
                        </table>
                    </div>
                  </div>
                </div>
                <!-- /widget-content -->
              </div>
        </div>
<script>
$('form').submit(function(){
  var dados = $(this).serialize();
  var att = $(this).attr('data-att');
  $.ajax({
  method: "GET",
  url: "<?php echo BASE_URL; ?>horimetros/att_horimetros",
  data: dados
})
  .done(function( msg ) {
     $("#"+att).html('<span class="btn btn-success"> Agora </span>');

  });


  return false;
  });
$(".horimetro").blur(function(){
  var ultimo = $(this).attr('data-ultimo');
  var atual = $(this).val();
  if (atual <= ultimo && atual != '') {
    swal('Horimetro Inválido','O horimetro não pode ser inferior a '+ultimo,'error');
    $atual.val('');
  }
})
</script>

    </div>
</div>
