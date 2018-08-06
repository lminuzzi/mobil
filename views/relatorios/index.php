<?php
/*
echo "'".implode("', '" , array_filter($graficotiposequipamentos['labels']))."'";
var_dump(implode(',' , array_filter($graficoareas['labels'])));
var_dump($graficoareas);
var_dump($graficotiposequipamentos);
*/
?>
<!--<div id="result">lalal</div>-->
<script src="<?php echo BASE_URL; ?>/assets/js/chartjs.js"></script>
<style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }

    .chart-container {
        width: 500px;
        margin-left: 40px;
        margin-right: 40px;
        margin-bottom: 40px;
    }
/*
    .container {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
    }
*/
</style>

<div class="container">
    <div class="row">
        <div class="span12">
            <div class="widget ">
                <div class="widget-header">
                    <h3>
                        Gráficos de Consumo Por Período &nbsp;
                    </h3>
                </div> <!-- /widget-header -->

                <div class="widget-content">
                    <div>
                        <form class="form-control form-horizontal" method="POST">
                            <div class="control-group">
                                <label class="control-label">Data Inicial</label>
                                <div class="controls">
                                    <input type="text" class="span2" id="data_inicial" name="data_inicial" required 
                                        value="<?php echo isset($pesquisa) ? $pesquisa['data_inicial'] : ""; ?>"
                                        onkeypress="mascaraData( this, event )" maxlength="10">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <div class="control-group">
                                <label class="control-label">Data Final</label>
                                <div class="controls">
                                    <input type="text" class="span2" id="data_final" name="data_final" required 
                                        value="<?php echo isset($pesquisa) ? $pesquisa['data_final'] : ""; ?>"
                                        onkeypress="mascaraData( this, event )" maxlength="10">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Pesquisar</button>
                                <input type="reset" class="btn btn-default" value="Limpar">
                            </div> <!-- /form-actions -->
                        </form>
                    </div>
                    <?php 
                    if(isset($pesquisa)) {
                    ?>
                    <div style="width:100%;">
                        <div>
                            <div id="canvas-holder" style="width:50%; float: left;">
                                <canvas id="chart-area"></canvas>
                            </div>
                            <div style="width:50%; float: left;">
                                <canvas id="chart-doughnut"></canvas>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                        <div></div>
                        <div>
                            <div style="width:50%; padding-left: 20%;">
                                <canvas id="chart-stacked"></canvas>
                            </div>            
                        </div>
                        <br/><br/>
                        <div>
                            <div style="width:50%; float: left;">
                                <canvas id="chart-bar"></canvas>
                            </div>
                            <div style="width:50%; float: left;">
                                <canvas id="chart-timeline"></canvas>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                    <?php 
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
if(isset($pesquisa)) {
?>
<script>
    var tupleConfigPolar = false;
    var cores = genColors(
        <?php echo max(count($graficoareas), count($graficotiposequipamentos)); ?>, 
        0.66, 1, 255);
    function HSVtoRGB(h, s, v) {
        var r, g, b, i, f, p, q, t;
        if (arguments.length === 1)
        {
            s = h.s;
            v = h.v;
            h = h.h;
        }
        i = Math.floor(h * 6);
        f = h * 6 - i;
        p = v * (1 - s);
        q = v * (1 - f * s);
        t = v * (1 - (1 - f) * s);
        switch (i % 6)
        {
            case 0:
                r = v;
                g = t;
                b = p;
                break;
            case 1:
                r = q;
                g = v;
                b = p;
                break;
            case 2:
                r = p;
                g = v;
                b = t;
                break;
            case 3:
                r = p;
                g = q;
                b = v;
                break;
            case 4:
                r = t;
                g = p;
                b = v;
                break;
            case 5:
                r = v;
                g = p;
                b = q;
                break;
            default:
                break;
        }
        return '#' + (0x1000000 + Math.round(r) * 0x10000 + Math.round(g) * 0x100 + Math.round(b)).toString(16).substring(1);
    }
    function genColors(n, start, saturation, value) {
        var colors = [];
        for (var i = 0; i < n; ++i) {
            var hue = start + i / n;
            colors.push(HSVtoRGB(hue, saturation, value));
        }
        return colors;
    }

    var idsAreas = [<?php echo implode(', ' , array_filter($graficoareas['ids'])); ?>];
    var configPolar = {
        data: {
            datasets: [{
                data: [
                    <?php echo implode(',' , array_filter($graficoareas['leituras'])); ?>
                ],
                backgroundColor: [
                    <?php 
                    for ($index = 0; $index < count($graficoareas['leituras']); $index++) { 
                    ?>
                        cores[<?php echo $index;?>],
                    <?php
                    }
                    ?>
                ],
                label: 'Áreas' // for legend
            }],
            labels: [
                '<?php echo implode("', '" , array_filter($graficoareas['labels'])); ?>'
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'right',
                onHover: function(event, legendItem) {
                    //document.getElementById("chart-area").style.cursor = 'pointer';
                    $("#chart-area").css("cursor", "pointer");
                }
            },
            hover: {
                onHover: function(e, el) {
                    //$("#chart-area").css("cursor", el[0] ? "pointer" : "default");
                }
            },
            title: {
                display: true,
                text: 'Áreas'
            },
            scale: {
                ticks: {
                    beginAtZero: true
                },
                reverse: false
            },
            animation: {
                animateRotate: true,
                animateScale: true
            },
            onClick: function(event) {
                if (this.active[0] !== undefined) {
                    //var index = this.getDatasetAtEvent(event)[0]._datasetIndex;
                    var index = this.active['0']._index;
                    marcaAreaSelecao(window.myPolarArea, index);
                    //window.myPolarArea.data.datasets[0].backgroundColor = Array.from(cores);
                    //window.myPolarArea.data.datasets[0].backgroundColor[index] = '#0007';
                    //window.myPolarArea.legend.legendItems[index].lineWidth = 7;
                    //window.myPolarArea.update();
                    // tupleConfigPolar = Object.freeze({ indice:index, 
                    //     cor:window.myPolarArea.data.datasets[0].backgroundColor[index] });
                    // window.myPolarArea.data.datasets[0].backgroundColor[index] = 'black';

                    //window.myPolarArea.update();
                    /*
                    var aClientes = oDados.lista_codigos_suregs.split('|');
                    var sMsg = aClientes[index];
                    sMsg = sMsg.replace(/;/g, '<br />');
                    oLeesrehn.carregarGraficoAgencias(sMsg);
                    */
                    construirGraficoFabricantesByArea(idsAreas[index]);
                }
            }
        }
    };
    
    var idsTiposEquipamentos = [<?php echo implode(', ' , array_filter($graficotiposequipamentos['ids'])); ?>];
    var configDoughnut = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    <?php echo implode(', ' , array_filter($graficotiposequipamentos['leituras'])); ?>
                ],
                backgroundColor: [
                    <?php 
                    for ($index = 0; $index < count($graficotiposequipamentos['leituras']); $index++) { 
                    ?>
                        cores[<?php echo $index;?>],
                    <?php
                    }
                    ?>
                ],
                label: 'Tipos de Equipamentos'
            }],
            labels: [
                '<?php echo implode("', '" , array_filter($graficotiposequipamentos['labels'])); ?>'
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
                onHover: function(event, legendItem) {
                    //document.getElementById("chart-doughnut").style.cursor = 'pointer';
                    $("#chart-doughnut").css("cursor", "pointer");
                }
            },
            hover: {
                onHover: function(e, el) {
                    //$("#chart-doughnut").css("cursor", el[0] ? "pointer" : "default");
                }
            },
            title: {
                display: true,
                text: 'Tipos de Equipamentos'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            },
            onClick: function(event) {
                if (this.active[0] !== undefined) {
                    var index = this.active['0']._index;
                    marcaAreaSelecao(window.myDoughnut, index);
                    construirGraficoFabricantesByTipoEquipamento(idsTiposEquipamentos[index]);
                }
            }
        }
    };

    function marcaAreaSelecao(grafico, index, indexDataset = null, 
                                desmarcarOutros = true, manterMarcacao = false) {
        if(desmarcarOutros) {
            desmarcarAreas();
        }
        if(indexDataset !== null) {
            grafico.data.datasets[indexDataset].backgroundColor = 'grey';//'#0003';
        } else {
            if(!manterMarcacao) {
                grafico.data.datasets[0].backgroundColor = Array.from(cores);
            }
            grafico.data.datasets[0].backgroundColor[index] = 'grey'//'#0003';
        }
        grafico.update();
    }

    function desmarcarAreas() {
        window.myPolarArea.data.datasets[0].backgroundColor = Array.from(cores);
        window.myPolarArea.update();
        window.myDoughnut.data.datasets[0].backgroundColor = Array.from(cores);
        window.myDoughnut.update();
        if(window.myStacked) {
            //window.myStacked.data.datasets[0].backgroundColor = cores[0];
            //window.myStacked.data.datasets[1].backgroundColor = cores[1];
            //window.myStacked.data.datasets[2].backgroundColor = cores[2];
            //window.myStacked.update();
        }
    }

    function construirGraficoFabricantesByArea(areaId) {
        $.post(
            "<?php echo BASE_URL;?>relatorios/ajaxConstruirGraficoFabricantesByArea",
            { area_id: areaId, data_inicial: $("#data_inicial").val(), data_final: $("#data_final").val() }, 
            function(data) {
                var obj = JSON.parse(data);
                obj.graficofabricantes.titulo = 'Fabricantes Por Área';
                carregarGraficoFabricantes(obj.graficofabricantes);
            }
        );
    }

    function construirGraficoFabricantesByTipoEquipamento(tipoEquipamentoId) {
        $.post(
            "<?php echo BASE_URL;?>relatorios/ajaxConstruirGraficoFabricantesByTipoEquipamento",
            { tipo_equipamento_id: tipoEquipamentoId, data_inicial: $("#data_inicial").val(), data_final: $("#data_final").val() }, 
            function(data) {
                var obj = JSON.parse(data);
                obj.graficofabricantes.titulo = 'Fabricantes Por Tipo de Equipamento ' + tipoEquipamentoId;
                carregarGraficoFabricantes(obj.graficofabricantes);
            }
        );
    }

    function construirDataSetsTags(grafico) {
        var dataSets = [];
        for(var index = 0; index < grafico.labels.length; index++) {
            var data = {
                label: grafico.labels[index],
                backgroundColor: cores[index],
                stack: 'Stack 0',
                data: grafico.leituras[index]
            };
            dataSets = data;
        }
        
        return dataSets;
    }

    function construirDataSetsFabricantes(graficofabricantes) {
        var dataSets = [];
        for(var index = 0; index < graficofabricantes.labels.length; index++) {
            var data = {
                label: graficofabricantes.labels[index],
                backgroundColor: cores[index],
                stack: 'Stack 0',
                data: graficofabricantes.leituras[index]
            };
            dataSets = data;
            /*
            dataSets += "label: '" + graficofabricantes.labels[index] + "',";
            dataSets += "backgroundColor: '" + cores[index] + "',";
            dataSets += "stack: 'Stack 0',";
            dataSets += "data: [" + graficofabricantes.leituras[index] + "]},";
            */
        }
        
        return dataSets;
        /*
        datasets: [{
            label: 'Fabricante 1',
            backgroundColor: cores[0],//'red',
            stack: 'Stack 0',
            data: [
                12,
                10,
                8,
                9,
                31
            ]
        }, {
            label: 'Fabricante 2',
            backgroundColor: cores[1],//'blue',
            stack: 'Stack 0',
            data: [
                5,
                7,
                0,
                2,
                3
            ]
        }, {
            label: 'Fabricante 3',
            backgroundColor: cores[2],//'green',
            stack: 'Stack 1',
            data: [
                9,
                22,
                13,
                19,
                7
            ]
        }]
        */
    }

    function carregarGraficoFabricantes(graficofabricantes) {
        if(cores.length < graficofabricantes.sublabels.length) {
            cores = genColors(graficofabricantes.sublabels.length, 0.66, 1, 255);
        }
        if(window.myStacked) {
            window.myStacked.destroy();
            window.myStacked = false;
            /*
            For ChartJS v2.x you can use update() to update the chart data without explicitly destroying and creating the canvas.

            var chart_ctx = document.getElementById("chart").getContext("2d");

            var chart = new Chart(chart_ctx, {
                type: "pie",
                data: {}
                options: {}
            }

            $.ajax({
                ...
            }).done(function (response) {
                chart.data = response;
                chart.update();
            });
            */
        }
        if(window.myBar) {
            window.myBar.destroy();
            window.myBar = false;
        }
        if(window.myTimeline) {
            window.myTimeline.destroy();
            window.myTimeline = false;
            cacheTags = [];
            cacheTagsMarcadas = [];
        }
        
        var dataSets = construirDataSetsFabricantes(graficofabricantes);
        var configFabricantes = {
            type: 'bar',
            data: {
                labels: graficofabricantes.sublabels,//['Modelo 1', 'Modelo 2', 'Modelo 3', 'Modelo 4', 'Modelo 5'],
                datasets: [dataSets]
            },
            options: {
                title: {
                    display: true,
                    text: graficofabricantes.titulo
                },
                legend: {
                    position: 'top',
                    onHover: function(event, el) {
                        //document.getElementById("chart-stacked").style.cursor = 'pointer';
                        $("#chart-stacked").css("cursor", "pointer");
                    }
                },
                hover: {
                    onHover: function(e, el) {
                        //$("#chart-stacked").css("cursor", el[0] ? "pointer" : "default");
                    }
                },
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                responsive: true,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                },
                onClick: function(event, el) {
                    if (this.active[0] !== undefined) {
                        var index = this.active['0']._index;
                        var indexStacked = this.getDatasetAtEvent(event)[0]._datasetIndex;
                        //marcaAreaSelecao(window.myStacked, index, indexStacked);
                        construirGraficoTagByModeloFabricante(graficofabricantes.idsmodelos[index], 
                            graficofabricantes.idsfabricantes[indexStacked]);
                    }
                }
            }
        };
        var ctxStacked = document.getElementById('chart-stacked').getContext('2d');
        window.myStacked = new Chart(ctxStacked, configFabricantes);
    }

    var cacheTags = [];
    cacheTagsMarcadas = [];
    function construirGraficoTagByModeloFabricante(modeloId, fabricanteId) {
        $.post(
            "<?php echo BASE_URL;?>relatorios/ajaxConstruirGraficoTagByModeloFabricante",
            { modelo_id: modeloId, data_inicial: $("#data_inicial").val(), data_final: $("#data_final").val() }, 
            function(data) {
                var obj = JSON.parse(data);
                obj.graficotags.titulo = 'Equipamentos Por Fabricante e Modelo';
                carregarGraficoTag(obj.graficotags);
            }
        );
    }

    function carregarGraficoTag(graficotags) {
        if(cores.length < graficotags.labels.length) {
            cores = genColors(graficotags.labels.length, 0.66, 1, 255);
        }
        if(window.myBar) {
            window.myBar.destroy();
            window.myBar = false;
        }
        if(window.myTimeline) {
            window.myTimeline.destroy();
            window.myTimeline = false;
            cacheTags = [];
            cacheTagsMarcadas = [];
        }
        var idsTags = graficotags.ids;
        var configEquipamentos = {
            type: 'horizontalBar',
            data: {
                labels: graficotags.labels,//['Equipamento 1', 'Equipamento 2', 'Equipamento 3', 'Equipamento 4', 'Equipamento 5', 'Equipamento 6', 'Equipamento 7'],
                datasets: [{
                    label: 'Equipamentos',
                    //backgroundColor: '#0000ff90',
                    borderColor: 'blue',
                    borderWidth: 1,
                    data: graficotags.leituras,
                    /*
                    data: [
                        12,
                        41,
                        7,
                        9,
                        14,
                        23,
                        15
                    ],
                    */
                    backgroundColor: cores.slice(0, graficotags.leituras.length)
                }]
            },
            options: {
                // Elements options apply to all of the options unless overridden in a dataset
                // In this case, we are setting the border of each horizontal bar to be 2px wide
                elements: {
                    rectangle: {
                        borderWidth: 2,
                    }
                },
                responsive: true,
                legend: {
                    position: 'right',
                    onHover: function(event, el) {
                        //document.getElementById("chart-stacked").style.cursor = 'pointer';
                        $("#chart-bar").css("cursor", "pointer");
                    }
                },
                hover: {
                    onHover: function(e, el) {
                        //$("#chart-bar").css("cursor", el[0] ? "pointer" : "default");
                    }
                },
                title: {
                    display: true,
                    text: graficotags.titulo
                },
                onClick: function(event) {
                    if (this.active[0] !== undefined) {
                        var index = this.active['0']._index;
                        //marcaAreaSelecao(window.myBar, index, null, false, true);
                        if(window.myTimeline) {
                            addOrRemoveDataset(index, window.myTimeline, idsTags[index], graficotags.labels[index]);
                        } else {
                            construirGraficoTagDetalhada(index, idsTags[index], graficotags.labels[index]);
                        }
                    }
                }
            }
        }

        var ctxBar = document.getElementById('chart-bar').getContext('2d');
        //alert(modeloId + ' ' + fabricanteId);
        window.myBar = new Chart(ctxBar, configEquipamentos);
    }

    function addOrRemoveDataset(index, grafico, idObj, titulo) {
        //console.log(cacheTagsMarcadas);
        if(cacheTagsMarcadas[index]) {
            //cacheTagsMarcadas.splice(index, 1);
            cacheTagsMarcadas[index] = false;
            
            removeDataset(index, grafico);
            /*marcaAreaSelecao(window.myBar, cacheTags[0]);
            for(var indice = 1; indice < cacheTags.length; indice++) {
                marcaAreaSelecao(window.myBar, cacheTags[indice], null, false, true);
            }*/
            //marcaAreaSelecao(window.myBar, cacheTagsMarcadas[0], null, false, false);
            //for(var indice = 1; indice < cacheTagsMarcadas.length; indice++) {
                //marcaAreaSelecao(window.myBar, cacheTagsMarcadas[indice], null, false, true);
            //}
        } else {
            addDataset(index, grafico, idObj, titulo);
        }
    }

    function addDataset(index, grafico, idObj, titulo) {
        //var colorName = colorNames[horizontalBarChartData.datasets.length % colorNames.length];
        //var dsColor = window.chartColors[colorName];
        
        grafico.data.datasets.push(getNewDataset(index, grafico.data.labels.length, idObj, titulo));
        grafico.update();
    }

    function getNewDataset(index, tamanho, idObj, titulo) {
        cacheTagsMarcadas[index] = true;
        if(!cacheTags[index]) {
            var newDataset = {
                label: titulo,
                backgroundColor: cores[index],
                borderColor: cores[index],
                fill: false,
                data: []
            };

            for (var indice = 0; indice < tamanho; ++indice) {
                newDataset.data.push(Math.floor((Math.random() * 100) + 1));
            }
            cacheTags[index] = newDataset;
        }
        return cacheTags[index];
    }

    function removeDataset(index, grafico) {
        grafico.data.datasets.splice(index, 1);
        grafico.update();
    }

    function construirGraficoTagDetalhadaaaa(index, idObj, titulo) {
        $.post(
            "<?php echo BASE_URL;?>relatorios/ajaxConstruirGraficoTagComparativo",
            { id: idObj, data_inicial: $("#data_inicial").val(), data_final: $("#data_final").val() }, 
            function(data) {
                var obj = JSON.parse(data);
                obj.graficotags.titulo = titulo;
                carregarGraficoTagDetalhada(obj.graficotags);
            }
        );
    }

    function construirGraficoTagDetalhada(index, idObj, titulo) {
    //function carregarGraficoTagDetalhada(graficotags) {
        var configTag = {
            type: 'line',
            data: {
                labels: ['10/09', '11/09', '12/09', '13/09', '14/09', '15/09', '16/09'],
                //labels: graficotags.labels,
                //datasets: [getNewDataset(graficotags.index, graficotags.labels.length, graficotags.idObj, graficotags.titulo)]
                datasets: [getNewDataset(index, 7, idObj, titulo)]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Comparativo Equipamentos'
                },
                tooltips: {
                    mode: 'x',
                    intersect: false,
                },
                hover: {
                    mode: 'x',
                    intersect: false
                },
            }
        };

        var ctxTimeline = document.getElementById('chart-timeline');
        window.myTimeline = new Chart(ctxTimeline, configTag);
        //alert(tagId);
    }
    
    window.onload = function() {
        var ctxArea = document.getElementById('chart-area');
        var ctxDoughnut = document.getElementById('chart-doughnut');
        window.myPolarArea = Chart.PolarArea(ctxArea, configPolar);
        window.myDoughnut = new Chart(ctxDoughnut, configDoughnut);
    };
</script>
<?php 
}
?>
<script type="text/javascript">
    function mascaraData( campo, e )
    {
        var kC = (document.all) ? event.keyCode : e.keyCode;
        var data = campo.value;
        
        if( kC!=8 && kC!=46 ) {
            if( data.length==2 ) {
                campo.value = data += '/';
            } else if( data.length==5 ) {
                campo.value = data += '/';
            } else {
                campo.value = data;
            }
        }
    }

    function valData(data) {//dd/mm/aaaa
        day = data.substring(0,2);
        month = data.substring(3,5);
        year = data.substring(6,10);

        if( (month==01) || (month==03) || (month==05) || (month==07) || (month==08) || (month==10) || (month==12) ) {
            //mes com 31 dias
            if( (day < 01) || (day > 31) ) {
                alert('invalid date');
            }
        } else if( (month==04) || (month==06) || (month==09) || (month==11) ) {
            //mes com 30 dias
            if( (day < 01) || (day > 30) ){
                alert('invalid date');
            }
        } else if( (month==02) ) {
            //February and leap year
            if( (year % 4 == 0) && ( (year % 100 != 0) || (year % 400 == 0) ) ) {
                if( (day < 01) || (day > 29) ) {
                    alert('invalid date');
                }
            } else {
                if( (day < 01) || (day > 28) ) {
                    alert('invalid date');
                }
            }
        }
    }

</script>