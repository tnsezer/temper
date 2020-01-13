<!doctype html>
<html lang="en">
<head>
    <title>Temper</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>
    <div id="chart">
        <div id="chartContainer" style="width:100%; height:400px;"></div>
        <div id="error" v-if="error">Loading error: {{ error }}</div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
    <script src="https://unpkg.com/vue"></script>
    <script src="/js/chart.js"></script>
</body>
</html>