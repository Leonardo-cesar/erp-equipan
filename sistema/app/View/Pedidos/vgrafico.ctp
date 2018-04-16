<h4 style="text-align: center;font-weight: bold">Período: <?php echo date("d/m/Y", strtotime($this->request->data['Pedidos']['dataInicial'])) ?> à <?php echo date("d/m/Y", strtotime($this->request->data['Pedidos']['dataFinal'])) ?> </h4>
<h4 style="text-align: center;font-weight: bold">Unidade: <?php echo $unidade ?></h4>
<hr />

<div id="donutchart" style="width: 100%; min-height: 1000px;"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load("current", {packages: ["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo json_encode($grafico) ?>);
        
        var options = {
            title: 'Rank de vendas'
        };

        var formatter = new google.visualization.NumberFormat({
            decimalSymbol: ',',
            groupingSymbol: '.',
            negativeColor: 'red',
            negativeParens: true,
            prefix: 'R$ '
        });
        formatter.format(data, 1);

        var formatter = new google.visualization.NumberFormat({
            prefix: 'R$: '
        });

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
        
        window.print();
    }
</script>