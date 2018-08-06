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
            $.post("<?php echo BASE_URL; ?>fabricantes/buildComboFabricantes", 
                { "area_id": area_id }
            )
            .done(function( data ) {
                if(data !== '') {
                    rebuildSelect('fabricante_id');
                    var obj = JSON.parse(data);
                    for (i = 0; i < obj.length; i++) {
                        addOption('fabricante_id', obj[i].id, 
                            obj[i].fabricante);
                    } 
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
});