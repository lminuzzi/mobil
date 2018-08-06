<div class="container">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <div class="row">
        <div class="span12">
            <div class="widget ">
                   <div class="widget-header">
                       <h3><i class="fa fa-truck"></i> Modelos</h3>
                   </div>
                   <div class="widget-content">
                        <fieldset>
                            <form class="form-control form-horizontal" method="POST">
                            <div class="control-group">
                                <label class="control-label">Modelo</label>
                                <div class="controls">
                                    <input type="text" class="span6 " name="modelo" required>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <div class="control-group">
                                <label class="control-label">Fabricante</label>
                                <div class="controls">
                                    <select name="fabricante_id" required>
                                        <option value="">Selecione</option>
                                        <?php 
                                        if (count($fabricantes > 0)) : 
                                            foreach ($fabricantes as $fabricante) : 
                                        ?>
                                                <option value="<?php echo $fabricante['id']; ?>">
                                                    <?php echo $fabricante['fabricante']; ?>
                                                </option>
                                        <?php
                                            endforeach;
                                         endif; 
                                        ?>
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
