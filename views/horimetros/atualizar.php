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
                    <h6 class="bigstats reservatorio" style="border-bottom: 1px solid #ccc; padding-bottom: 10px; line-height:10px;"> <i class="fa fa-dashboard "></i> Atualizar Horimetros</b>
                                        </h6>
                    </div>
                    <div class="footer-reservatorio" style="text-align:center; color:#aaa">  <i class="fa fa-truck "></i> <b style="font-weight: bolder; font-size:110%;"> <?php echo count($reservatorios); ?> veiculos cadastrados</b>
                    <br>
                    </div>
                    <div style="padding: 10px;">
                        <h4 style="margin: 10px 0;"> Veículos cadastrados </h4>
                        <table class="table table-condensed">
                            <tr>
                                <th class="span4"> Título </th>
                                <th class="span3"> Horímetro Anterior </th>
                                <th class="span3"> Novo horímetro </th>
                                <th class="span1"> Última atualização </th>
                                <th class="span1"> Ação </th>
                            </tr>
                            <?php foreach ($reservatorios as $r) :
                                ?>
                                <form method="POST" data-att="att<?php echo $r['id']; ?>">
                                <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
                                <input type="hidden" name="horimetro_anterior" value="<?php echo $r['horimetro']; ?>">
                            <tr>
                            <td class="span4"><?php echo $r['titulo']; ?></td>
                            <td class="span3"><?php echo number_format($r['horimetro'], 0, ',', '.'); ?></td>
                            <td class="span3"><input style="margin-top: 5px;" type="number" min=0; class="form-control horimetro" name="horimetro" data-ultimo="<?php echo $r['horimetro']; ?>"></td>
                            <td class="span1 ultima_atualizacao" id="att<?php echo $r['id']; ?>">
                            <?php echo !empty($r['ultima_atualizacao']) ? passou(strtotime($r['ultima_atualizacao'])):''; ?>

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
