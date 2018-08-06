<?php
    //$horimetro = $reservatorio['horimetro'];
    //$atual = ($reservatorio['autonomia'] + $reservatorio['horimetro_abastecimento']) - $horimetro;
    //$p = number_format($atual*100/$reservatorio['autonomia'], '2');
    $avatar = "../../assets/fotos/" . $reservatorio['titulo'] . "/" . $reservatorio['avatar'];
    
    /*
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
    */
?>
<div class="container">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <div class="row">
        <div class="span4">
        <div class="widget widget-nopad">
              <!-- /widget-header -->
              <!--<div class="widget-content">
                <div class="widget big-stats-container">
                  <div class="widget-content">
                    <div>
                        <img src="<?php echo $avatar; ?>" alt="avatar" />
                    </div>
                     <h6 class="bigstats reservatorio" style="border-bottom: 1px solid #ccc; padding-bottom: 10px; line-height:10px;"> <i class="fa fa-tint "></i> Consumo Médio <b style="font-weight: bolder; font-size:110%;"><?php echo number_format($reservatorio['consumo'], 2, ',', '.'); ?>g/h</b>

                        <div id="big_stats" class="cf">

                        <div class="stat"> 
                            <i class="fa <?php echo $class; ?> " alt="Nível do Reservatório " > </i> 
                            <span class="value">
                                <?php  echo $p; ?>%
                            </span> 
                        </div>
                        
                        </div>
                    </div>
                    <div class="footer-reservatorio" style="text-align:center; color:#aaa">  <i class="fa fa-clock-o "></i> <b style="font-weight: bolder; font-size:110%;">4.225 horas restantes</b>
                    <br>
                    </div>
                    <div style="padding: 10px;">
                        <h4 style="margin: 10px 0;"> Últimos Abastecimentos </h4>
                        <table class="table table-condensed">
                            <tr>
                                <th> Data </th>
                                <th> Horímetro </th>
                                <th> Consumo </th>
                            </tr>

                            <?php foreach ($historico as $h) : ?>
                            <tr>
                            <td><?php echo date('d/m/Y', strtotime($h['data'])); ?></td>
                            <td><?php echo $h['horimetro']; ?></td>
                            <td><?php echo number_format($h['graxa_adicionada']/1000, 2, ',', '.'); ?> Kg</td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                  </div>
                </div>
                
              </div>-->
        </div>

        <div class="span12">
            <div class="widget ">
                   <div class="widget-header">
                       <h3><i class="fa fa-edit"></i> Editar Equipamento: <?php echo $reservatorio['titulo']; ?></h3>
                   </div>
                   <div class="widget-content">
                        <fieldset>
                            <form class="form-control form-horizontal" method="POST">
                            <input type="hidden" name="id" value="<?php echo $reservatorio['id']; ?>">
                            <div class="control-group">
                                    <label class="control-label">Titulo</label>
                                    <div class="controls">
                                        <input type="text" class="span6 " name="titulo" required value="<?php echo $reservatorio['titulo']; ?>">
                                    </div> <!-- /controls -->
                                </div> <!-- /control-group -->
                                <?php 
                                    $dados['obj'] = $reservatorio;
                                    $this->loadViewInTemplate("components/hierarchy", $dados);
                                ?>
                                <div class="control-group">
                                    <label class="control-label">Tipo de reservatório </label>
                                    <div class="controls">
                                        <select id="tipo_reservatorio_id" name="tipo_reservatorio_id" required>
                                            <option value="">Selecione</option>
                                            <?php if (count($tipos_reservatorios > 0)) : 
                                                foreach ($tipos_reservatorios as $tipo_reservatorio) : 
                                                    $selected = ($tipo_reservatorio['id'] == $reservatorio['tipo_reservatorio_id'] ? 'selected="selected"' : '');
                                            ?>
                                                    <option value="<?php echo $tipo_reservatorio['id']; ?>" <?php echo $selected;?> >
                                                        <?php echo $tipo_reservatorio['tipo_reservatorio']; ?>
                                                    </option>
                                            <?php
                                                endforeach;
                                            endif; ?>
                                        </select>
                                    </div> <!-- /controls -->
                                </div> <!-- /control-group -->
                                <!--<div class="control-group">
                                    <label class="control-label">Capacidade </label>
                                    <div class="controls">
                                       <div class="input-prepend input-append">
                                                  <input class="span2" id="capacidade" name="capacidade" required value="<?php echo $reservatorio['capacidade']; ?>">
                                                  <span class="add-on">Gramas</span>
                                                </div>
                                                <script> $("#capacidade").maskMoney({allowNegative: false, thousands:'.', decimal:'', precision: '0'}); </script>
                                    </div>
                                </div>
                                <div style="background-color:#dee; margin:25px 0; padding:25px 0;">
                                <div class="control-group">
                                    <label class="control-label">Horímetro</label>
                                    <div class="controls">
                                       <div class="input-prepend input-append">
                                                  <input class="span2" id="horimetro" name="horimetro" required value="<?php echo $reservatorio['horimetro']; ?>">
                                                <p class="help-block">Deve ser preenchido com o horímetro atual do equipamento</p>
                                                </div>
                                                <script> $("#horimetro").maskMoney({allowNegative: false, thousands:'.', decimal:'', precision: '0'}); </script>

                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Horímetro abastecimento </label>
                                    <div class="controls">
                                       <div class="input-prepend input-append">
                                                  <input class="span2" id="horimetro_abastecimento" name="horimetro_abastecimento" required value="<?php echo $reservatorio['horimetro_abastecimento']; ?>">
                                                <p class="help-block">Deve ser preenchido com o horímetro do último abastecimento completo do reservatório.</p>
                                                </div>
                                                <script> $("#horimetro_abastecimento").maskMoney({allowNegative: false, thousands:'.', decimal:'', precision: '0'}); </script>

                                    </div>
                                </div>

                                </div>
                               <div class="control-group">
                                    <label class="control-label">Consumo </label>
                                    <div class="controls">
                                       <div class="input-prepend input-append">
                                            <input class="span2" name="consumo" required value="<?php echo $reservatorio['consumo']; ?>">
                                            <p class="help-block">Deve ser preenchido com o consumo em gramas / hora do equipamento.</p>
                                        </div>
                                        <script> $("#horimetro_abastecimento").maskMoney({allowNegative: false, thousands:'.', decimal:'', precision: '0'}); </script>

                                    </div>
                                </div>
                                <input type="hidden" id="autonomia" name="autonomia" value="<?php echo floor($reservatorio['capacidade']/$reservatorio['consumo']); ?>" required>
                                <script>$("#consumo").change(function(){
                                    $("#autonomia").val($("#capacidade").val()/$("#consumo").val());
                                })</script>
                                -->

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Editar</button>
                                    <a href="<?php echo BASE_URL; ?>reservatorios" class="btn btn-default"> Cancelar </a>
                                </div> <!-- /form-actions -->
                            </form>
                        </fieldset>
                   </div>
            </div>
        </div>
    </div>
</div>
