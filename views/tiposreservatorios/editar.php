<?php
    $titleBase = "Tipo de Reservatório";
    $formBase = "tipo_reservatorio";
    $folderBase = "tiposreservatorios";
?>
<div class="container">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <div class="row">
        <div >
            <div class="widget ">
                <div class="widget-header">
                    <h3><i class="fa fa-edit"></i> Editar <?php echo $titleBase; ?></h3>
                </div>
                <div class="widget-content">
                    <fieldset>
                        <form class="form-control form-horizontal" method="POST">
                        <input type="hidden" name="id" value="<?php echo $obj['id']; ?>">
                        <div class="control-group">
                            <label class="control-label"><?php echo $titleBase; ?></label>
                            <div class="controls">
                                <input type="text" class="span6 " required 
                                    name="<?php echo $formBase; ?>"
                                    value="<?php echo $obj[$formBase]; ?>">
                            </div> <!-- /controls -->
                        </div> <!-- /control-group -->
                        <div class="control-group">
                            <label class="control-label">Volume Morto</label>
                            <div class="controls">
                                <input type="text" class="span6 " id="volume_morto" name="volume_morto" 
                                    value="<?php echo str_replace(".", ",", $obj['volume_morto']); ?>" required>
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
                            <button type="submit" class="btn btn-primary">Editar</button>
                            <a href="<?php echo BASE_URL.$folderBase; ?>" class="btn btn-default"> 
                                Cancelar 
                            </a>
                        </div> <!-- /form-actions -->
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if($obj['area_base']) :
?>
    <script type="text/javascript">
        $('#area_base').val('<?php echo $obj['area_base']; ?>');
    </script>
<?php
    endif
?>