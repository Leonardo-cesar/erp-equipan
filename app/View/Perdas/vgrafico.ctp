<h4 style="text-align: center;font-weight: bold">Período: <?php echo date("d/m/Y", strtotime($this->request->data['Perda']['dataInicial'])) ?> à <?php echo date("d/m/Y", strtotime($this->request->data['Perda']['dataFinal'])) ?> </h4>
<h4 style="text-align: center;font-weight: bold">Unidade: <?php echo $unidade ?></h4>
<hr />

<div id="columnchart_values" style="width: 100%; min-height: 1000px;"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    

    google.charts.load("current", {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo json_encode($grafico) ?>);
        var options = {
            title: "Perda de Material",
            legend: {position: 'none'}
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(data, options);
    }
</script>