<div class="container">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <div class="row">
        <div class="span12">
            <div class="widget ">
                   <div class="widget-header">
                       <h3><i class="fa fa-tags"></i> Equipamentos</h3>
                   </div>
                   <div class="widget-content">
                        <fieldset>
                            <form class="form-control form-horizontal" method="POST" enctype='multipart/form-data'>
                            <div class="control-group">
                                <label class="control-label">Tag</label>
                                <div class="controls">
                                    <input type="text" class="span6 " name="titulo" required>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <?php 
                            $this->loadViewInTemplate("components/hierarchy");
                            //$this->loadViewInTemplate("components/hierarchy", $viewData);
                            //$this->loadTemplate('components/hierarchy');
                            //require_once(BASE_URL."views/components/hierarchy.php");
                            ?>
                            <div class="control-group">
                                <label class="control-label">Tipo de reservatório </label>
                                <div class="controls">
                                    <select id="tipo_reservatorio_id" name="tipo_reservatorio_id" required>
                                        <option value="">Selecione</option>
                                        <?php if (count($tipos_reservatorios > 0)) : 
                                            foreach ($tipos_reservatorios as $tipo_reservatorio) : 
                                        ?>
                                                <option value="<?php echo $tipo_reservatorio['id']; ?>" >
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
                                        <input class="span2" id="capacidade" name="capacidade" required>
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
                                        <input class="span2" id="horimetro" name="horimetro" required>
                                        <p class="help-block">Deve ser preenchido com o horímetro atual do equipamento</p>
                                    </div>
                                    <script> $("#horimetro").maskMoney({allowNegative: false, thousands:'.', decimal:'', precision: '0'}); </script>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Horímetro abastecimento </label>
                                <div class="controls">
                                    <div class="input-prepend input-append">
                                        <input class="span2" id="horimetro_abastecimento" name="horimetro_abastecimento" required>
                                        <p class="help-block">Deve ser preenchido com o horímetro do último abastecimento completo do reservatório.</p>
                                    </div>
                                    <script> $("#horimetro_abastecimento").maskMoney({allowNegative: false, thousands:'.', decimal:'', precision: '0'}); </script>
                                </div>
                            </div>-->
                            <div class="control-group">
                                <label class="control-label">Avatar</label>
                                <div class="controls">
                                    <div class="input-prepend input-append">
                                        <input type='file' name='foto' value='Cadastrar foto'>
                                    </div>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            </div>

                            <!--<div class="control-group">
                                <label class="control-label">Consumo: </label>
                                <div class="controls">
                                <div class="input-prepend input-append">
                                    <input class="span2" id="consumo" name="consumo" required>
                                    <span class="add-on">Gramas/hora</span>
                                    <p class="help-block" id="tt">Consumo em Gramas por Hora do equipamento.</p>
                                </div>

                                <input type="hidden" id="autonomia" name="autonomia" required>

                                <script>
                                    $("#consumo").keyup(function(){
                                        var capacidade = $("#capacidade").val().replace('.','');
                                        var consumo = $("#consumo").val().replace(',','.');
                                        var total = (capacidade/consumo).toFixed(0);
                                        $("#tt").html('Autonomia estimada: '+total+' horas.');
                                        $("#autonomia").val(total);
                                    });
                                </script>
                                <script> $("#consumo").maskMoney({allowNegative: false, thousands:'.', decimal:',', precision: 2}); </script>

                            </div>
                            </div>-->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Incluir</button>
                                <input type="reset" class="btn btn-default" value="Limpar">
                            </div> <!-- /form-actions -->
                            </form>
                        </fieldset>
                   </div>
            </div>
        </div>
    </div>
</div>
<!--<script src="<?php //echo BASE_URL; ?>/assets/js/bootstrap.js"></script>-->