<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 1000px;
        }

        h1 {
            color: #333;
            margin-bottom: 40px;
        }

        #typePiechart, #factoryPiechart, #monthChart {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            border-radius: 8px;
        }
    </style>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
    drawTypeChart();
    drawFactoryChart();
    drawMonthChart();
}
        function drawTypeChart() {
            var data = google.visualization.arrayToDataTable(<?php echo json_encode($formattedDataByType); ?>);
            var options = { title: 'จำนวนข้อมูลสินค้าในแต่ละประเภท' };
            var chart = new google.visualization.PieChart(document.getElementById('typePiechart'));
            chart.draw(data, options);
        }

        function drawFactoryChart() {
            var data = google.visualization.arrayToDataTable(<?php echo json_encode($formattedDataByFactory); ?>);
            var options = { title: 'จำนวนข้อมูลสินค้าในแต่ละโรงงาน' };
            var chart = new google.visualization.PieChart(document.getElementById('factoryPiechart'));
            chart.draw(data, options);
        }

        function drawMonthChart() {
    var data = google.visualization.arrayToDataTable(<?php echo json_encode($formattedDataByMonth); ?>);
    var options = {
        title: 'จำนวนข้อมูลสินค้ารวมทั้งเดือน ระยะเวลา 1 ปี',
        hAxis: { title: 'Month' },
        vAxis: { title: 'Number of Products' }
    };
    var chart = new google.visualization.ColumnChart(document.getElementById('monthChart'));
    chart.draw(data, options);
}


    </script>


  </head>
  <body>

    <div class="container" style="background-color: #616161;">
        <h2 style="text-align: center; margin-top: 20px; margin-bottom: 20px;">กราฟข้อมูลสต็อกสินค้า</h2>

        <div id="typePiechart" style="width: 900px; height: 500px;"></div>
        <div id="factoryPiechart" style="width: 900px; height: 500px;"></div>
        <div id="monthChart" style="width: 900px; height: 500px;"></div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
