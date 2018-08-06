<div class="container">
    <div class="row">
        <div class="span8">
        <div class="widget widget-nopad">
              <div class="widget-content">
                <div class="widget big-stats-container">
                  <div class="widget-content">
                    <h6 class="bigstats reservatorio" style="border-bottom: 1px solid #ccc; padding-bottom: 10px; line-height:10px;"> 
                        <i class="fa fa-check-circle"></i>&nbsp; Checklist
                    </h6>
                    </div>
                    <div class="footer-reservatorio" style="text-align:center; color:#aaa">  <i class="fa fa-check-circle-o "></i> <b style="font-weight: bolder; font-size:110%;"> 01 Checklists cadastrados</b>
                    <br>
                    </div>
                    <div style="padding: 10px;">
                        <h4 style="margin: 10px 0;"> Checklists cadastrados </h4>
                        <table class="table table-condensed">
                            <tr>
                                <th class="span3"> Fabricante </th>
                                <!--<th class="span3"> Modelo </th>-->
                                <th class="span2"> Ítens de Inspeção</th>
                                <th class="span2"> Situação </th>
                            </tr>
                            <?php 
                            if (count($farois > 0)) : 
                                foreach ($farois as $farol) : 
                            ?>
                            <tr>
                                <td> <?php echo $farol['titulo']; ?></td>
                                <!--<td> <?php echo $farol['equipamento']; ?></td>-->
                                <td> <?php echo $farol['total']; ?></td>
                                <td> 
                                    <a href="<?php echo BASE_URL; ?>farol/exibir/<?php echo $farol['id']; ?>" class="btn btn-primary">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                endforeach;
                            endif; 
                            ?>
                        </table>
                    </div>
                  </div>
                </div>
                <!-- /widget-content -->
              </div>
        </div>
        <div class="span4">
            <div class="widget widget-nopad">
                <div class="widget-content">
                    <div class="widget big-stats-container">
                        <div class="widget-content">
                            <h6 class="bigstats reservatorio" style="border-bottom: 1px solid #ccc; padding-bottom: 10px; line-height:10px;"> 
                                <i class="fa fa-plus"></i> Incluir Checklist </b>
                            </h6>
                        </div>
                        <div style="text-align:center;" >
                            <button data-toggle="modal" data-target="#myModal" class="btn btn-primary">Incluir Checklist </button>
                        </div>
                    </div>
                </div>
                <!-- /widget-content -->
            </div>
            <div class="widget widget-nopad">
                <div class="widget-content">
                    <div class="widget big-stats-container">
                        <div class="widget-content">
                            <h6 class="bigstats reservatorio" style="border-bottom: 1px solid #ccc; padding-bottom: 10px; line-height:10px;"> 
                                <i class="fa fa-history"></i> Histórico de Checklists </b>
                            </h6>
                        </div>
                        <div style="text-align:center; padding: 0 10px;" >
                            <table class="table table-condensed" align="center">
                                <tr>
                                <th> Data </th>
                                <th> Título</th>
                                <th> Situação </th>
                                </tr>
                                <?php 
                                $f = new Farol();
                                foreach ($farois_realizados as $farol_realizado) : 
                                ?>
                                <tr>
                                    <td><?php echo date('d/m/Y', strtotime($farol_realizado['data_resposta'])); ?></td>
                                    <td><?php echo $farol_realizado['titulo']; ?> </td>
                                    <?php
                                        $dadosOk = $f->getTotalItensOk($farol_realizado['id']);
                                        $dadosTotal = $f->getTotalItens($farol_realizado['id']);

                                        if ($dadosTotal == $dadosOk) {
                                            $color = 'success';
                                        } elseif ($dadosTotal / 2 > $dadosOk) {
                                            $color = 'danger';
                                        } else {
                                            $color = 'warning';
                                        }
                                    ?>
                                    <td><span class="btn btn-block btn-<?php echo $color; ?>"><?php echo $dadosOk; ?>/<?php echo $dadosTotal; ?></span></td>
                                    </tr>
                                <?php
                                endforeach; 
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /widget-content -->
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <style>
        .ui-autocomplete-loading {
            background: white url(<?php echo BASE_URL; ?>"assets/img/ui-anim_basic_16x16.gif") right center no-repeat;
        }
        ul.bs-autocomplete-menu {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            max-height: 200px;
            overflow: auto;
            z-index: 9999;
            border: 1px solid #eeeeee;
            border-radius: 4px;
            background-color: #fff;
            box-shadow: 0px 1px 6px 1px rgba(0, 0, 0, 0.4);
            }

            ul.bs-autocomplete-menu a {
            font-weight: normal;
            color: #333333;
            }

            .ui-helper-hidden-accessible {
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
            }

            .ui-state-active,
            .ui-state-focus {
            color: #23527c;
            background-color: #eeeeee;
            }

            .bs-autocomplete-feedback {
            width: 1.5em;
            height: 1.5em;
            overflow: hidden;
            margin-top: .5em;
            margin-right: .5em;
            }

            .loader {
            font-size: 10px;
            text-indent: -9999em;
            width: 1.5em;
            height: 1.5em;
            border-radius: 50%;
            background: #333;
            background: -moz-linear-gradient(left, #333333 10%, rgba(255, 255, 255, 0) 42%);
            background: -webkit-linear-gradient(left, #333333 10%, rgba(255, 255, 255, 0) 42%);
            background: -o-linear-gradient(left, #333333 10%, rgba(255, 255, 255, 0) 42%);
            background: -ms-linear-gradient(left, #333333 10%, rgba(255, 255, 255, 0) 42%);
            background: linear-gradient(to right, #333333 10%, rgba(255, 255, 255, 0) 42%);
            position: relative;
            -webkit-animation: load3 1.4s infinite linear;
            animation: load3 1.4s infinite linear;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            }

            .loader:before {
            width: 50%;
            height: 50%;
            background: #333;
            border-radius: 100% 0 0 0;
            position: absolute;
            top: 0;
            left: 0;
            content: '';
            }

            .loader:after {
            background: #fff;
            width: 75%;
            height: 75%;
            border-radius: 50%;
            content: '';
            margin: auto;
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            }

            @-webkit-keyframes load3 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
            }

            @keyframes load3 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Adicionar Checklist</h4>
            </div>
            <div class="modal-body">
                <div class="container" style="max-width:100%;">
                    <form class="from form-horizontal" method="POST">
                        <div class="control-group">
                        <label class="control-label" for="titulo">Título</label>
                        <div class="controls">
                            <input type="text" id="titulo" placeholder="Digite o Título do farol" />
                        </div> <!-- /controls -->
                        </div> <!-- /control-group -->

                        <div class="control-group">
                        <label class="control-label" for="titulo">Buscar por TAG</label>
                        <div class="controls">
                                <input class="form-control bs-autocomplete" id="tag_search" value="" placeholder="Digite a TAG" type="text" 
                                    data-hidden_field_id="reservatorio_id_hidden" data-item_id="id" data-item_label="titulo" autocomplete="off">
                                <input class="form-control" id="reservatorio_id_hidden" name="reservatorio_id_hidden" value="" type="hidden" readonly>
                                <input class="form-control" id="cliente_id_hidden" name="cliente_id_hidden" value="" type="hidden" readonly>
                                <input class="form-control" id="site_id_hidden" name="site_id_hidden" value="" type="hidden" readonly>
                                <input class="form-control" id="area_id_hidden" name="area_id_hidden" value="" type="hidden" readonly>
                                <input class="form-control" id="tipo_equipamento_id_hidden" name="tipo_equipamento_id_hidden" value="" type="hidden" readonly>
                                <input class="form-control" id="fabricante_id_hidden" name="fabricante_id_hidden" value="" type="hidden" readonly>
                                <input class="form-control" id="modelo_id_hidden" name="modelo_id_hidden" value="" type="hidden" readonly>
                            <!--<input type="text" id="tag_search" placeholder="Digite a TAG" />-->
                        </div> <!-- /controls -->
                        </div> <!-- /control-group -->
                        <div id="accordion">
                            <h3>Busca Detalhada</h3>
                            <div>
                                <div id="hierarchy-component">
                                    <?php 
                                        $this->loadViewInTemplate("components/hierarchy");
                                    ?>
                                </div>
                                <div class="control-group" id="tags">
                                    <label class="control-label">Tag</label>
                                    <div class="controls" id="comboTag">
                                        <select id="reservatorio_id" name="reservatorio_id" required>
                                            <option value="">Selecione um modelo.</option>
                                        </select>
                                    </div> <!-- /controls -->
                                </div> <!-- /control-group -->
                            </div>
                        </div>
                    </form>
                    <form class="from form-horizontal">
                        <div class="form-group" style="margin-top: 10px;">
                            <label for="titulo">Ítem de verificação</label>
                            <input type="text" class="form-control span2" id="item" placeholder="Ítem a ser verificado" >
                            <span class="btn btn-primary" id="addItem"> + </span>
                        </div>
                        <div class="form-group" style="padding: 10px; border:1px solid #ccc; max-height: 300px; overflow-y:scroll; margin-top:10px;">
                            <table class="table table-stripped" id="tbl" style="background-color:#fefefe;">
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <!--
                Ao invez de apagar o item, apagar somente o item "não conforme" e opção de refazer"
                Retirar confirmação
                -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="cadastrar" data-dismiss="modal">Cadastrar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
    var itens = [];
    function removeLinha(e, farolItem) {
        var linha = $(e).closest('tr');
        var index = array.indexOf(farolItem);
        itens.splice(index,1);
        linha.remove();
        console.log(itens);
    }
$(document).ready(function(e){
    $( "#accordion" ).accordion({
      collapsible: true,
      active: null
    });

    $("#addItem").click(function(){
        var item = $("#item").val();
        if (item != '') {
            itens.push(item);
            console.log(itens);
            var newRow = $("<tr>");
            var newContent = '<td>'+item+'</td><td> <!-- <button class="btn btn-danger btn-small"> <i class="fa fa-trash" onclick="removeLinha(this,'+item+'); return false;"></i> </button> --></td>';
            newRow.append(newContent);
            var tabela = $("#tbl");
            tabela.append(newRow);
            $('#item').val('');
        } else {
            alert('Digite o nome do ítem a ser verificado.');
        }
    });
    $("#cadastrar").click(function(){
        var titulo = $("#titulo").val();
        var modelo_id = $("#modelo_id").val();
        var site_id = $("#site_id").val();
        var reservatorio_id = $("#reservatorio_id").val();
        if (titulo == '') {
            alert('Preencha o titulo');
            return false;
        }
        if (site_id == '') {
            alert('Preencha o site');
            return false;
        }
        if (modelo_id == '') {
            alert('Preencha o modelo');
            return false;
        }
        if (reservatorio_id == '') {
            alert('Preencha a TAG');
            return false;
        }
        if (itens.lenght < 1) {
            alert('Preencha os ítens a sereem verificados');
            return false;
        }
        var data = {
            'titulo': titulo,
            'reservatorio_id': reservatorio_id,
            'modelo_id': modelo_id,
            'site_id': site_id,
            'itens': itens
        }
        $.ajax({
            method: "POST",
            url: "<?php echo BASE_URL; ?>farol",
            data: data
        })
        .done(function( msg ) {
            window.location.href = window.location.href;
        });
    })
    $("#modelo_id").change(function() {
        var modelo_id = $("#modelo_id").val();
        if(modelo_id !== "") {
            $.post("<?php echo BASE_URL; ?>reservatorios/buildComboEquipamentos", 
                { "modelo_id": modelo_id }
            )
            .done(function( data ) {
                if(data !== '') {
                    rebuildSelect('reservatorio_id');
                    var obj = JSON.parse(data);
                    for (i = 0; i < obj.length; i++) {
                        addOption('reservatorio_id', obj[i].id, 
                            obj[i].titulo);
                    }
                    if($("#reservatorio_id_hidden").val() != '') {
                        $("#reservatorio_id").val($("#reservatorio_id_hidden").val()).trigger('change');
                    }
                    <?php 
                    if(isset($obj) && $obj['reservatorio_id'] != '') :
                    ?>
                        $("#reservatorio_id").val(<?php echo $obj['reservatorio_id'];?>).trigger('change');
                    <?php
                    endif;
                    ?>
                }
            })
            .fail(function() {
                alert( "erro" );
            });
        }
    });

    function rebuildSelect(idSelect) {
        $('#' + idSelect + ' option').each(function() {
            $(this).remove();
        });
        $('#' + idSelect).append($('<option>', {
            value: '',
            text: 'Selecione'
        }));
    }

    function addOption(idSelect, valueOption, textOption) {
        $('#' + idSelect).append($('<option>', {
            value: valueOption,
            text: textOption
        }));
    }

    if($("#modelo_id").val() != '') {
        $("#modelo_id").trigger('change');
    }

    //Autocomplete
    var cache = {};

    $.widget("ui.autocomplete", $.ui.autocomplete, {
        _renderMenu: function(ul, items) {
            var that = this;
            ul.attr("class", "nav nav-pills nav-stacked  bs-autocomplete-menu");
            $.each(items, function(index, item) {
                that._renderItemData(ul, item);
            });
        },
        _resizeMenu: function() {
            var ul = this.menu.element;
            ul.outerWidth(Math.min(
                // Firefox wraps long text (possibly a rounding bug)
                // so we add 1px to avoid the wrapping (#7513)
                ul.width("").outerWidth() + 1,
                this.element.outerWidth()
            ));
        }
    });
    $('.bs-autocomplete').each(function() {
        var _this = $(this),
            _data = _this.data(),
            _hidden_field = $('#' + _data.hidden_field_id);

        _this.after('<div class="bs-autocomplete-feedback form-control-feedback"><div class="loader">Loading...</div></div>')
            .parent('.form-group').addClass('has-feedback');

        var feedback_icon = _this.next('.bs-autocomplete-feedback');
        feedback_icon.hide();

        _this.autocomplete({
            minLength: 3,
            autoFocus: true,

            source: function(request, response) {
                var term = request.term;
                if (term in cache) {
                    response(cache[term]);
                    return;
                }

                $.getJSON("<?php echo BASE_URL;?>reservatorios/searchAutocomplete", request, function(data, status, xhr) {
                    cache[term] = data;
                    response(data);
                });
            },

            search: function() {
                feedback_icon.show();
                _hidden_field.val('');
            },

            response: function() {
                feedback_icon.hide();
            },

            focus: function(event, ui) {
                _this.val(ui.item[_data.item_label]);
                event.preventDefault();
            },

            select: function(event, ui) {
                _this.val(ui.item[_data.item_label]);
                _hidden_field.val(ui.item[_data.item_id]);

                $('#cliente_id_hidden').val(ui.item['cliente_id']);
                $('#site_id_hidden').val(ui.item['site_id']);
                $('#area_id_hidden').val(ui.item['area_id']);
                $('#tipo_equipamento_id_hidden').val(ui.item['tipo_equipamento_id']);
                $('#fabricante_id_hidden').val(ui.item['fabricante_id']);
                $('#modelo_id_hidden').val(ui.item['modelo_id']);
                loadHierarchyComponent();

                event.preventDefault();
            }
        })
        .data('ui-autocomplete')._renderItem = function(ul, item) {
            return $('<li></li>')
                .data("item.autocomplete", item)
                .append('<a>' + item[_data.item_label] + '</a>')
                .appendTo(ul);
        };
    // end autocomplete
    });

    function loadHierarchyComponent() {
        $('#cliente_id').val($('#cliente_id_hidden').val()).trigger('change');
        $('#area_id').val($('#area_id_hidden').val()).trigger('change');
    }
});
</script>