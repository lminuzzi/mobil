<div class="container">
    <div class="row">
        <div >
            <div class="widget ">
                   <div class="widget-header">
                       <h3><i class="fa fa-edit"></i> Editar Modelo</h3>
                   </div>
                   <div class="widget-content">
                        <fieldset>
                            <form class="form-control form-horizontal" method="POST">
                            <input type="hidden" name="id" value="<?php echo $modelo['id']; ?>">
                            <div class="control-group">
                                <label class="control-label">Modelo</label>
                                <div class="controls">
                                    <input type="text" class="span6 " name="modelo" required value="<?php echo $modelo['modelo']; ?>">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <div class="control-group">
                                <label class="control-label">Fabricante</label>
                                <div class="controls">
                                    <select name="fabricante_id" required>
                                        <option value="">Selecione</option>
                                        <?php if (count($fabricantes > 0)) : 
                                            foreach ($fabricantes as $fabricante) : 
                                                $selected = ($modelo['fabricante_id'] == $fabricante['id']) ? 'selected="selected"' : "";
                                        ?>
                                                <option value="<?php echo $fabricante['id']; ?>" <?php echo $selected;?> >
                                                    <?php echo $fabricante['fabricante']; ?>
                                                </option>
                                            <?php
                                            endforeach;
                                        endif; ?>
                                    </select>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Editar</button>
                                <a href="<?php echo BASE_URL; ?>modelos" class="btn btn-default"> Cancelar </a>
                            </div> <!-- /form-actions -->
                            </form>
                        </fieldset>
                   </div>
            </div>
        </div>
    </div>
</div>
