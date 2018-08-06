<div class="container">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <div class="row">
        <div >
            <div class="widget ">
                   <div class="widget-header">
                       <h3><i class="fa fa-edit"></i> Editar Área</h3>
                   </div>
                   <div class="widget-content">
                        <fieldset>
                            <form class="form-control form-horizontal" method="POST">
                            <input type="hidden" name="id" value="<?php echo $area['id']; ?>">
                            <div class="control-group">
                                <label class="control-label">Área</label>
                                <div class="controls">
                                    <input type="text" class="span6 " name="area" required value="<?php echo $area['area']; ?>">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Editar</button>
                                <a href="<?php echo BASE_URL; ?>areas" class="btn btn-default"> Cancelar </a>
                            </div> <!-- /form-actions -->
                            </form>
                        </fieldset>
                   </div>
            </div>
        </div>
    </div>
</div>
