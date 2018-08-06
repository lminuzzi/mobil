<?php
$c = new Cliente();
$clientes = $c->getAll();
$a = new Area();
$areas = $a->getAll();
?>

<div class="control-group">
<label class="control-label">Cliente</label>
<div class="controls">
    <select id="cliente_id" name="cliente_id" required>
        <option value="">Selecione</option>
        <?php if (count($clientes > 0)) : 
            foreach ($clientes as $cliente) : 
                $selected = ($cliente['id'] == $obj['cliente_id'] ? 'selected="selected"' : '');
        ?>
                <option value="<?php echo $cliente['id']; ?>" <?php echo $selected;?> >
                    <?php echo $cliente['cliente']; ?>
                </option>
        <?php
            endforeach;
        endif; ?>
    </select>
</div> <!-- /controls -->
</div> <!-- /control-group -->
<div class="control-group" id="sites">
<label class="control-label">Site</label>
<div class="controls" id="comboSite">
    <select id="site_id" name="site_id" required>
        <option value="">Selecione um cliente.</option>
    </select>
</div> <!-- /controls -->
</div> <!-- /control-group -->
<div class="control-group">
<label class="control-label">Área</label>
<div class="controls">
    <select id="area_id" name="area_id" required>
        <option value="">Selecione</option>
        <?php 
        if (count($areas > 0)) : 
            foreach ($areas as $area) : 
                $selected = ($area['id'] == $obj['area_id'] ? 'selected="selected"' : '');
        ?>
                <option value="<?php echo $area['id']; ?>" <?php echo $selected; ?> >
                    <?php echo $area['area']; ?>
                </option>
        <?php
            endforeach;
        endif; 
        ?>
    </select>
</div> <!-- /controls -->
</div> <!-- /control-group -->
<div class="control-group" id="tiposequipamentos">
<label class="control-label">Tipo de Equipamento</label>
<div class="controls" id="comboTiposEquipamentos">
    <select id='tipo_equipamento_id' name='tipo_equipamento_id' required>
        <option value="">Selecione uma área.</option>
    </select>
</div> <!-- /controls -->
</div> <!-- /control-group -->
<div class="control-group" id="fabricantes">
<label class="control-label">Fabricante</label>
<div class="controls" id="comboFabricante">
    <select id='fabricante_id' name='fabricante_id' required>
        <option value="">Selecione um tipo de equipamento.</option>
    </select>
</div> <!-- /controls -->
</div> <!-- /control-group -->
<div class="control-group" id="modelos">
<label class="control-label">Modelo</label>
<div class="controls" id="comboModelo">
    <select id="modelo_id" name="modelo_id" required>
        <option value="">Selecione um fabricante.</option>
    </select>
</div> <!-- /controls -->
</div> <!-- /control-group -->

<script>
$(document).ready(function() {
    $("#cliente_id").change(function() {
        var cliente_id = $("#cliente_id").val();
        if(cliente_id !== "") {
            $.post("<?php echo BASE_URL; ?>sites/buildComboSites", 
                { "cliente_id": cliente_id }
            )
            .done(function( data ) {
                if(data !== '') {
                    rebuildSelect('site_id');
                    var obj = JSON.parse(data);
                    var str = "<select id='site_id' name='site_id' required>";
                    for (i = 0; i < obj.length; i++) {
                        str += "<option value='" + obj[i].id + "'>" + obj[i].site + "</option>";
                    } 
                    str += "</select>";
                    $('#comboSite').html(str);
                    if($("#site_id_hidden").val() != '') {
                        $("#site_id").val($("#site_id_hidden").val()).trigger('change');
                    }
                    <?php 
                    if(isset($obj) && $obj['site_id'] != '') :
                    ?>
                        $("#site_id").val(<?php echo $obj['site_id'];?>).trigger('change');
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

    $("#area_id").change(function() {
        var area_id = $("#area_id").val();
        if(area_id !== "") {
            $.post("<?php echo BASE_URL; ?>tiposequipamentos/buildComboTiposEquipamentos", 
                { "area_id": area_id }
            )
            .done(function( data ) {
                if(data !== '') {
                    rebuildSelect('tipo_equipamento_id');
                    var obj = JSON.parse(data);
                    for (i = 0; i < obj.length; i++) {
                        addOption('tipo_equipamento_id', obj[i].id, 
                            obj[i].tipo_equipamento);
                    }
                    if($("#tipo_equipamento_id_hidden").val() != '') {
                        $("#tipo_equipamento_id").val($("#tipo_equipamento_id_hidden").val()).trigger('change');
                    }
                    <?php 
                    if(isset($obj) && $obj['tipo_equipamento_id'] != '') :
                    ?>
                        $("#tipo_equipamento_id").val(<?php echo $obj['tipo_equipamento_id'];?>).trigger('change');
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

    $("#tipo_equipamento_id").change(function() {
        var tipo_equipamento_id = $("#tipo_equipamento_id").val();
        if(tipo_equipamento_id !== "") {
            $.post("<?php echo BASE_URL; ?>fabricantes/buildComboFabricantes", 
                { "tipo_equipamento_id": tipo_equipamento_id }
            )
            .done(function( data ) {
                if(data !== '') {
                    rebuildSelect('fabricante_id');
                    var obj = JSON.parse(data);
                    for (i = 0; i < obj.length; i++) {
                        addOption('fabricante_id', obj[i].id, 
                            obj[i].fabricante);
                    }
                    if($("#fabricante_id_hidden").val() != '') {
                        $("#fabricante_id").val($("#fabricante_id_hidden").val()).trigger('change');
                    } 
                    <?php 
                    if(isset($obj) && $obj['fabricante_id'] != '') :
                    ?>
                        $("#fabricante_id").val(<?php echo $obj['fabricante_id'];?>).trigger('change');
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

    $("#fabricante_id").change(function() {
        var fabricante_id = $("#fabricante_id").val();
        if(fabricante_id !== "") {
            $.post("<?php echo BASE_URL; ?>modelos/buildComboModelos", 
                { "fabricante_id": fabricante_id }
            )
            .done(function( data ) {
                if(data !== '') {
                    rebuildSelect('modelo_id');
                    var obj = JSON.parse(data);
                    for (i = 0; i < obj.length; i++) {
                        addOption('modelo_id', obj[i].id, 
                            obj[i].modelo);
                    }
                    if($("#modelo_id_hidden").val() != '') {
                        $("#modelo_id").val($("#modelo_id_hidden").val()).trigger('change');
                    } 
                    <?php 
                    if(isset($obj) && $obj['modelo_id'] != '') :
                    ?>
                        $("#modelo_id").val(<?php echo $obj['modelo_id']; ?>).trigger('change');
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
    
    if($("#cliente_id").val() != '') {
        $("#cliente_id").trigger('change');
    }

    if($("#area_id").val() != '') {
        $("#area_id").trigger('change');
    }
});

    
</script>