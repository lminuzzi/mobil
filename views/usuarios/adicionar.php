<div class="container">
    <div class="row">
        <div class="span12">
            <div class="widget ">
                <style>
                    label,.control-label { text-weight: bold !important; }
                    .help-block {
                        color:#ccc;
                    } 
                </style>

                <div class="widget-header">
                    <h3>Adicionar Usuário</h3>
                </div> <!-- /widget-header -->

                <div class="widget-content">
                <form id="edit-profile" class="form-horizontal" method="POST" action="#?e">

                    <div class="control-group">
                        <label class="control-label" for="username">Grupo</label>
                        <div class="controls">
                            <input type="text" class="span2 disabled" id="user_grupo" value="Grupo Principal" disabled>
                            <p class="help-block">O Grupo de Utilização do Usuário não pode ser modificado.</p>
                        </div> <!-- /controls -->
                    </div> <!-- /control-group -->

                        <div class="control-group">
                            <label class="control-label" for="username">Nome</label>
                            <div class="controls">
                                <input type="text" class="span6" name="nome" id="user_nome" value="" required>
                            </div> <!-- /controls -->
                        </div> <!-- /control-group -->
                        <div class="control-group">
                            <label class="control-label" for="setor">Setor</label>
                            <div class="controls">
                                <input type="text" class="span2" name="setor" id="user_setor" value="" required>
                            </div> <!-- /controls -->
                        </div> <!-- /control-group -->
                        <div class="control-group">
                            <label class="control-label" for="cargo">Cargo</label>
                            <div class="controls">
                                <input type="text" class="span4" name="cargo" value="" required>
                            </div> <!-- /controls -->
                        </div> <!-- /control-group -->
                        <div class="control-group">
                            <label class="control-label" for="perfil">Perfil</label>
                            <div class="controls">
                                <select name="perfil">
                                    <option value="">Selecione</option>
                                    <option value="A">Administrador</option>
                                    <option value="C">Cliente</option>
                                    <option value="I">Inspeção</option>
                                </select>
                            </div> <!-- /controls -->
                        </div> <!-- /control-group -->
                        <div class="control-group">
                            <label class="control-label" for="email">Email</label>
                            <div class="controls">
                                <input type="text" class="span4"  name="email" value="" >
                            </div> <!-- /controls -->
                        </div> <!-- /control-group -->

                        <div style="background-color:#f3f3f3; padding: 50px 0;">
                            <div class="control-group">
                                <label class="control-label" for="username">Nome de Usuario</label>
                                <div class="controls">
                                    <input type="text" class="span4" name="login"  value="" required>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <div class="control-group">
                                <label class="control-label" for="username">Senha</label>
                                <div class="controls">
                                    <input type="password" class="span4"  name="password" value="" required>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div> <!-- /form-actions -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
