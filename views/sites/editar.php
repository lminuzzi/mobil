<div class="container">
    <div class="row">
        <div >
            <div class="widget ">
                   <div class="widget-header">
                       <h3><i class="fa fa-edit"></i> Editar Site</h3>
                   </div>
                   <div class="widget-content">
                        <fieldset>
                            <form class="form-control form-horizontal" method="POST">
                            <input type="hidden" name="id" value="<?php echo $site['id']; ?>">
                            <div class="control-group">
                                <label class="control-label">Site</label>
                                <div class="controls">
                                    <input type="text" class="span6 " name="site" required value="<?php echo $site['site']; ?>">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <div class="control-group">
                                <label class="control-label">Área</label>
                                <div class="controls">
                                    <select name="cliente_id" required>
                                        <option value="">Selecione</option>
                                        <?php if (count($cliente > 0)) : 
                                            foreach ($clientes as $cliente) : 
                                                $selected = ($site['cliente_id'] == $cliente['id']) ? 'selected="selected"' : "";
                                        ?>
                                                <option value="<?php echo $cliente['id']; ?>" <?php echo $selected;?> >
                                                    <?php echo $cliente['cliente']; ?>
                                                </option>
                                            <?php
                                            endforeach;
                                        endif; ?>
                                    </select>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Editar</button>
                                <a href="<?php echo BASE_URL; ?>sites" class="btn btn-default"> Cancelar </a>
                            </div> <!-- /form-actions -->
                            </form>
                        </fieldset>
                   </div>
            </div>
        </div>
    </div>
</div>
