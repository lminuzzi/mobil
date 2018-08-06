<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.js"></script>-->
<script src="<?php echo BASE_URL; ?>/assets/js/chartjs.js"></script>
<style>
    canvas { 
        background-color : #eee;
    }
</style>

<div style="position: absolute;">
    <div style="float: left; padding-right: 8px;">
        <canvas id="chartJSContainer" width="400" height="300"></canvas>
    </div>
    <div style="float: left; padding-right: 8px;">
        <canvas id="chartJSContainer2" width="400" height="300"></canvas>
    </div>
    <div style="float: left; padding-right: 8px;">
        <canvas id="chartJSContainer3" width="400" height="300"></canvas>
    </div>
    <div style="clear:both;">&nbsp;</div>
    <div >&nbsp;</div>
    <div style="float: left; padding-right: 8px;">
        <canvas id="chartJSContainer4" width="1200" height="250"></canvas>
    </div>
    <div style="clear:both;"></div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var options = {
            type: 'line',
            data: {
                labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho"],
                datasets: [
                    {
                        label: 'GAMUN',
                        data: [12, 19, 21, 23, 14, 22],
                        borderWidth: 1
                    },	
                    {
                        label: 'GAPMN',
                        data: [7, 11, 17, 6, 15, 12],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Cadastros por Área'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            reverse: false
                        }
                    }]
                }
            }
        }
        var ctx = document.getElementById('chartJSContainer').getContext('2d');
        new Chart(ctx, options);

        ctx = document.getElementById('chartJSContainer2').getContext('2d');
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["CAT 7495HR", "P&H 2800", "L2350", "MODELO4", "MODELO5", "MODELO6"],
                datasets: [
                    {
                        label: 'Caminhão',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: 'blue',
                        borderWidth: 1
                    },	
                    {
                        label: 'Escavadeira à Cabo',
                        data: [7, 11, 5, 8, 3, 7],
                        backgroundColor: 'green',
                        borderWidth: 1
                    },
                    {
                        label: 'Carregadeiras',
                        data: [7, 11, 5, 8, 3, 7],
                        backgroundColor: 'yellow',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Falhas por Tipo de Equipamento e Modelo'
                }
            }
        });

        ctx = document.getElementById('chartJSContainer3').getContext('2d');
        myLineChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["GAMUN", "GAPMN", "AREA3", "AREA4", "AREA5", "AREA6"],
                datasets: [
                    {
                        label: ['Falhas'],
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'red',
                            'orange',
                            'yellow',
                            'green',
                            'blue',
                            'cyan'
                        ],
                        borderWidth: 1
                    }/*,	
                    {
                        label: '# of Points',
                        data: [7, 11, 5, 8, 3, 7],
                        borderWidth: 1
                    }*/
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Falhas por Área'
                }
            }
        });

        ctx = document.getElementById('chartJSContainer4').getContext('2d');
        var myLineChart = new Chart(ctx, {
            type: 'line',
			data: {
				//labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                labels: [
                <?php 
                    $primeiro = false;
                    foreach($registros as $registro) {
                        if($primeiro == false) {
                            $primeiro = true;
                        } else {
                            echo ",";    
                        }
                        echo "\"".$registro['data']." ".$registro['hora']."\"";
                    }
                ?>
                ],
				datasets: [{
					label: 'Leitura',
					fill: false,
					backgroundColor: 'blue',
					borderColor: 'blue',
					data: [
                    <?php 
                        $primeiro = false;
                        foreach($registros as $registro) {
                            if($primeiro == false) {
                                $primeiro = true;
                            } else {
                                echo ",";    
                            }
                            echo "\"".$registro['leitura']."\"";
                        }
                    ?>
                    ],
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Distância'
				},
                /*
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
                */
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Data'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Valor'
						}
					}]
				}
			}
        });
    });
</script>