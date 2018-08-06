<?php 
    $formBase = 'usuarios'; 
    $titleBase = 'Usuário';
?>
<div class="container">
    <div class="row">
        <div class="span12">
            <div class="widget ">
                <div class="widget-header">
                    <h3>
                        Gerenciar <?php echo $titleBase; ?> &nbsp;
                        <a class ="btn btn-success" href="<?php echo BASE_URL.$formBase.'/adicionar'; ?>"><i class="fa fa-plus"></i> Incluir Novo</a>
                    </h3>
                </div> <!-- /widget-header -->

                <div class="widget-content">
                    <table class="table form-control">
                        <tr>
                            <th class="span5"> Usuário </th>
                            <th class="span3"> Login </th>
                            <th class="span3"> Email </th>
                            <th class="span2"> Perfil </th>
                            <th class="span4"> Ação </th>
                        </tr>
                        <?php foreach ($users as $u) : ?>
                        <tr>
                            <td class="span5"> <?php echo $u['nome']; ?></td>
                            <td class="span3"> <?php echo $u['login']; ?></td>
                            <td class="span3"> <?php echo $u['email']; ?> </td>
                            <td class="span2"> <?php echo $u['perfil']; ?> </td>
                            <td class="span4">
                            <?php if ($u['id'] > 1 && $u['id'] != $_SESSION['uid']) : ?>
                            <button data-id="<?php echo $u['id']; ?>" onclick="confirmDelete(this);" class="btn btn-danger" ><i class="fa fa-trash "></i> Excluir</button>
                            <?php else : ?>
                                <button disabled="disabled" data-toggle="tooltip" data-placement="top" alt="Você não pode deletar este usuário" data-id="<?php echo $u['id']; ?>" onclick="#" class="btn btn-danger disabled"><i class="fa fa-trash "></i> Excluir</button>
                            <?php endif; ?>
                            <button data-toggle="tooltip" data-placement="top" alt="Alterar Senha" data-id="<?php echo $u['id']; ?>" onclick="alterarSenha(this);" class="btn btn-primary"><i class="fa fa-key "></i> Alterar Senha</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
 <script>
function alterarSenha(e) {
    var id = $(e).attr('data-id');
    swal({
  title: "Alterar Senha!",
  text: "Digite a nova senha",
  type: "input",
   inputType: "password",
  showCancelButton: true,
  closeOnConfirm: false,
  animation: "slide-from-top",
  inputPlaceholder: "Nova senha"
},
function(inputValue){
  if (inputValue === false) return false;

  if (inputValue == "") {
    swal.showInputError("Senha inválida.");
    return false
  }
  if (inputValue.length < 6) {
    swal.showInputError("Senha muito curta. Digite no mínimo 6 caracteres.");
    return false
  }

$.ajax({
  url: "<?php echo BASE_URL; ?>usuarios/senha",
  method: "GET",
  data: { id : id, senha : inputValue },
  dataType: "html",
  success: function() { swal("Pronto!", "Senha do Usuário alterada com sucesso.", "success"); }
});
});
}

                                    function confirmDelete(e) {
                                       var id = $(e).attr('data-id');
                                        swal({
                                          title: "Tem certeza?",
                                          text: "Você tem certeza que quer deletar este usuário?",
                                          type: "warning",
                                          showCancelButton: true,
                                          confirmButtonColor: "#DD6B55",
                                          confirmButtonText: "Sim, apague-o!",
                                          cancelButtonText: "Não, cancelar.",
                                          closeOnConfirm: false,
                                          closeOnCancel: true
                                        },
                                        function(isConfirm){
                                          if (isConfirm) {
                                            $.get("<?php echo BASE_URL; ?>usuarios/del/"+id);
                                            $(e).closest('tr').hide();
                                            swal("Deletado!", "O Usuario foi deletado com sucesso.", "success");

                                          } else {
                                            return false;
                                          }
                                        });
                                    }
                                </script>
