<?php 
    $formBase = 'areas'; 
    $titleBase = 'Área';
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
                    <table class="table form-control table-responsive">
                        <tr>
                            <th class="span3"> Área </th>
                            <th class="span3"> Ação </th>
                        </tr>
                        <?php foreach ($areas as $r) : ?>
                            <tr>
                                <td> <?php echo $r['area']; ?> </td>
                                <td class=""> <button class="btn btn-danger" data-id="<?php echo $r['id']; ?>" onclick="confirmDelete(this);"><i class="fa fa-trash"></i> Excluir</button>
                                <a class ="btn btn-default" href="<?php echo BASE_URL.'areas/edit/'.$r['id']; ?>"><i class="fa fa-edit"></i> Editar</a>
                                <!-- <a class ="btn btn-primary" href="<?php echo BASE_URL.'areas/preencher/'.$r['id']; ?>"><i class="fa fa-tint"></i> </a> -->
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
                                    function confirmDelete(e) {
                                       var id = $(e).attr('data-id');
                                        swal({
                                          title: "Tem certeza?",
                                          text: "Você tem certeza que quer deletar esta área?",
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
                                            $.get("<?php echo BASE_URL; ?>areas/del/"+id);
                                            $(e).closest('tr').hide();
                                            swal("Deletado!", "A área foi deletada com sucesso.", "success");

                                          } else {
                                            return false;
                                          }
                                        });
                                    }
                                </script>
