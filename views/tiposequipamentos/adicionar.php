<div class="container">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <div class="row">
        <div class="span12">
            <div class="widget ">
                   <div class="widget-header">
                       <h3><i class="fa fa-industry"></i> Tipos de Equipamentos</h3>
                   </div>
                   <div class="widget-content">
                        <fieldset>
                            <form class="form-control form-horizontal" method="POST">
                            <div class="control-group">
                                <label class="control-label">Tipo de Equipamento</label>
                                <div class="controls">
                                    <input type="text" class="span6 " name="tipo_equipamento" required>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <div class="control-group">
                                <label class="control-label">Áreas</label>
                                <div class="controls">
                                    <select name="area_id" required>
                                        <option value="">Selecione</option>
                                        <?php if (count($areas > 0)) : 
                                            foreach ($areas as $area) : 
                                        ?>
                                                <option value="<?php echo $area['id']; ?>">
                                                    <?php echo $area['area']; ?>
                                                </option>
                                            <?php
                                            endforeach;
                                        endif; ?>
                                    </select>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    Incluir
                                </button>
                                <input type="reset" class="btn btn-default" value="Limpar">
                            </div> <!-- /form-actions -->
                            </form>
                        </fieldset>
                   </div>
            </div>
        </div>
    </div>
</div>