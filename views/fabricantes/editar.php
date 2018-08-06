<div class="container">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <div class="row">
        <div >
            <div class="widget ">
                   <div class="widget-header">
                       <h3><i class="fa fa-edit"></i> Editar Fabricante</h3>
                   </div>
                   <div class="widget-content">
                        <fieldset>
                            <form class="form-control form-horizontal" method="POST">
                            <input type="hidden" name="id" value="<?php echo $fabricante['id']; ?>">
                            <div class="control-group">
                                <label class="control-label">Fabricante</label>
                                <div class="controls">
                                    <input type="text" class="span6 " name="fabricante" required value="<?php echo $fabricante['fabricante']; ?>">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <div class="control-group">
                                <label class="control-label">Tipo de Equipamento</label>
                                <div class="controls">
                                    <select name="tipo_equipamento_id" required>
                                        <option value="">Selecione</option>
                                        <?php if (count($tipos_equipamentos > 0)) : 
                                            foreach ($tipos_equipamentos as $tipo_equipamento) : 
                                                $selected = ($fabricante['tipo_equipamento_id'] == $tipo_equipamento['id']) ? 'selected="selected"' : "";
                                        ?>
                                                <option value="<?php echo $tipo_equipamento['id']; ?>" <?php echo $selected;?> >
                                                    <?php echo $tipo_equipamento['tipo_equipamento']; ?>
                                                </option>
                                            <?php
                                            endforeach;
                                        endif; ?>
                                    </select>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Editar</button>
                                <a href="<?php echo BASE_URL; ?>fabricantes" class="btn btn-default"> Cancelar </a>
                            </div> <!-- /form-actions -->
                            </form>
                        </fieldset>
                   </div>
            </div>
        </div>
    </div>
</div>
