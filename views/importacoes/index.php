<div class="container">
    <div class="row">
        <div class="span12">
            <div class="widget ">
                <div class="widget-header">
                    <h3>
                        Fazer o download do arquivo padrão
                        <a class ="btn btn-success" href="<?php echo BASE_URL.'/assets/padraoExcel.xlsx'; ?>"><i class="fa fa-file"></i> Arquivo</a>
                    </h3>
                </div> <!-- /widget-header -->
                <div class="widget-content">
                    <fieldset>
                        <form class="form-control form-horizontal" method="POST" enctype='multipart/form-data'>
                        <div class="control-group">
                            <label class="control-label">Arquivo</label>
                            <div class="controls">
                                <input type="file" class="span6 form-control-file" name="arquivo" required>
                            </div> <!-- /controls -->
                        </div> <!-- /control-group -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Carregar</button>
                            <!--<input type="reset" class="btn btn-default" value="Limpar">-->
                        </div> <!-- /form-actions -->
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

