<?php
    $iconFormBase = "flask";
    $titleBase = "Tipo de Reservatório";
    $formBase = "tipo_reservatorio";
?>
<div class="container">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <div class="row">
        <div class="span12">
            <div class="widget ">
                <div class="widget-header">
                    <h3><i class="fa fa-<?php echo $iconFormBase; ?>"></i>
                        <?php echo $titleBase; ?>
                    </h3>
                </div>
                <div class="widget-content">
                    <fieldset>
                        <form class="form-control form-horizontal" method="POST">
                        <div class="control-group">
                            <label class="control-label"><?php echo $titleBase; ?></label>
                            <div class="controls">
                                <input type="text" class="span6 " 
                                    name="<?php echo $formBase; ?>" required>
                            </div> <!-- /controls -->
                        </div> <!-- /control-group -->
                        <div class="control-group">
                            <label class="control-label">Volume Morto</label>
                            <div class="controls">
                                <input type="text" class="span6 " id="volume_morto"
                                    name="volume_morto" required>
                            </div> <!-- /controls -->
                        </div> <!-- /control-group -->
                        <script> $("#volume_morto").maskMoney({allowNegative: false, thousands:'.', decimal:','}); </script>
                        <div class="control-group">
                            <label class="control-label">Área Base</label>
                            <div class="controls">
                                <select id="area_base" name="area_base" required>
                                    <option value="">Selecione</option>
                                    <option value="C">Círculo</option>
                                    <option value="R">Retângulo</option>
                                </select>
                            </div> <!-- /controls -->
                        </div> <!-- /control-group -->
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