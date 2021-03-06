<div class="container">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <div class="row">
        <div >
            <div class="widget ">
                   <div class="widget-header">
                       <h3><i class="fa fa-edit"></i> Editar Tipo de Equipamento</h3>
                   </div>
                   <div class="widget-content">
                        <fieldset>
                            <form class="form-control form-horizontal" method="POST">
                            <input type="hidden" name="id" value="<?php echo $tipo_equipamento['id']; ?>">
                            <div class="control-group">
                                <label class="control-label">Tipo de Equipamento</label>
                                <div class="controls">
                                    <input type="text" class="span6 " name="tipo_equipamento" required 
                                        value="<?php echo $tipo_equipamento['tipo_equipamento']; ?>">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <div class="control-group">
                                <label class="control-label">Áreas</label>
                                <div class="controls">
                                    <select name="area_id" required>
                                        <option value="">Selecione</option>
                                        <?php if (count($areas > 0)) : 
                                            foreach ($areas as $area) : 
                                                $selected = ($tipo_equipamento['area_id'] == $area['id']) ? 'selected="selected"' : "";
                                        ?>
                                                <option value="<?php echo $area['id']; ?>" <?php echo $selected;?> >
                                                    <?php echo $area['area']; ?>
                                                </option>
                                            <?php
                                            endforeach;
                                        endif; ?>
                                    </select>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Editar</button>
                                <a href="<?php echo BASE_URL; ?>tiposequipamentos" class="btn btn-default"> Cancelar </a>
                            </div> <!-- /form-actions -->
                            </form>
                        </fieldset>
                   </div>
            </div>
        </div>
    </div>
</div>
