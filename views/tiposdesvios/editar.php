<?php
    $titleBase = "Tipos de Desvios";
    $formBase = "tipo_desvio";
    $folderBase = "tiposdesvios";
?>
<div class="container">
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