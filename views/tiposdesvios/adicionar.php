<?php
    $iconFormBase = "times-circle";
    $titleBase = "Tipos de Desvios";
    $formBase = "tipo_desvio";
?>
<div class="container">
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