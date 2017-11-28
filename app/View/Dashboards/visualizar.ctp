<script type="text/javascript">

$(function () {

$(document).ready(function () {
    $('#chart-pizza').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: '<?php echo "Alarmes gerados a partir: ".$nmeServicoRetorno?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.2f}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: false,
                    format: '{point.name}'
                },
                showInLegend: true
            }
        },
        series: [{
            type: 'pie',
            name: 'Qtd',
            data: [  
                 ['critical', <?php echo $critical;?> ],
                 ['warning', <?php echo $warning;?>  ] 
            ]
        }]
    });
});
});



$(function () {

$(document).ready(function () {
    $('#chart-pizza2').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: '<?php echo "Quantidade de alarmes Critical por servidor do serviço: ".$nmeServicoRetorno?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.2f}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: false,
                    format: '{point.name}'
                },
                showInLegend: true
            }
        },
        series: [{
            type: 'pie',
            name: 'Qtd',
            data: [

                    <?php        

                    foreach ($todosServidoresCritical as $td) {

           
                                    $qtdeCritical = $td['0']['qtde'];
                                    $SerCritical = $td['LogServico']['ip'];
                    

                    ?>

                  ['<?php echo $SerCritical;?>',<?php echo $qtdeCritical;?>],

                  <?php } ?>
            ]
        }]
    });
});
});



$(function () {

$(document).ready(function () {
    $('#chart-pizza3').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: '<?php echo "Quantidade de alarmes Warning por servidor do serviço: ".$nmeServicoRetorno?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.2f}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: false,
                    format: '{point.name}'
                },
                showInLegend: true
            }
        },
        series: [{
            type: 'pie',
            name: 'Qtd',
            data: [

                    <?php        

                    foreach ($todosServidoresWarning as $td) {

           
                                    $qtdeWarning = $td['0']['qtde'];
                                    $SerWarning = $td['LogServico']['ip'];
                    

                    ?>

                  ['<?php echo $SerWarning;?>',<?php echo $qtdeWarning;?>],

                  <?php } ?>
            ]
        }]
    });
});
});





$(function () {

 $(document).ready(function () {   
    $('#chart-coluna1').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '<?php echo "Quantidade de alarmes geral por servidor do serviço: ".$nmeServicoRetorno?>'
        },
        subtitle: {
            //text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Quantidade de alarmes'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Qtde: <b>{point.y:.0f}</b>'
        },
        series: [{
            name: 'Population',
            colorByPoint: true,
            data: [
            <?php
                    foreach ($todosServidoresBarra as $ta) {

           
                            $qtdeBarra = $ta['0']['qtde'];
                            $SerBarra = $ta['LogServico']['ip'];
            ?>                

                ['<?php echo $SerBarra;?>',<?php echo $qtdeBarra;?>],

            <?php } ?>    

            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
});


$(function () {
     $(document).ready(function () {  
    $('#chart-line-critical').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: '<?php echo "Periodo de alarmes criticals gerais do serviço: ".$nmeServicoRetorno?>'
        },
        xAxis: {
            categories: [
            <?php
                    foreach ($periodoCritical as $ta) {

           
                            //$qtdeBarra = $ta['0']['qtde'];
                            $dataCritical = $ta['LogServico']['modified'];
                            $newDateCritical = date('Y-m', strtotime($dataCritical));
            ?>                

                ['<?php echo $newDateCritical;?>'],

            <?php } ?>    

            ],
        },
        yAxis: {
            title: {
                text: 'Qtde Critical'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{

            data: [
            <?php
                    foreach ($periodoCritical as $ta) {

           
                            //$qtdeBarra = $ta['0']['qtde'];
                            $qtdeCritical = $ta['0']['qtde'];
            ?>                

                [<?php echo $qtdeCritical;?>],

            <?php } ?>    

            ],
            name: '<?php echo $nmeServicoRetorno?>'
            
        }]
    });
});
});






$(function () {
     $(document).ready(function () {  
    $('#chart-line-warning').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: '<?php echo "Periodo de alarmes Warnings gerais do serviço: ".$nmeServicoRetorno?>'
        },
        xAxis: {
            categories: [
            <?php
                    foreach ($periodoWarning as $ta) {

           
                            //$qtdeBarra = $ta['0']['qtde'];
                            $dataWarning = $ta['LogServico']['modified'];
                            $newDateWarning = date('Y-m', strtotime($dataWarning));
            ?>                

                ['<?php echo $newDateWarning;?>'],

            <?php } ?>    

            ],
        },
        yAxis: {
            title: {
                text: 'Qtde Warning'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{

            data: [
            <?php
                    foreach ($periodoWarning as $ta) {

                            $qtdeWarning = $ta['0']['qtde'];
            ?>                

                [<?php echo $qtdeWarning;?>],

            <?php } ?>    

            ],
            name: '<?php echo $nmeServicoRetorno?>'
            
        }]
    });
});
});


</script>

        <div class="col-sm-4">

            <div id="chart-pizza"></div>

        </div>

        <div class="col-sm-4">

            <div id="chart-pizza2"></div>

        </div>


        <div class="col-sm-4">

            <div id="chart-pizza3"></div>

        </div>
    

        <div class="col-sm-12">

            <div id="chart-coluna1"></div>

        </div>  


    <div class="col-sm-12">

            <div id="chart-line-critical"></div>

    </div>  

    <div class="col-sm-12">

            <div id="chart-line-warning"></div>

    </div>  