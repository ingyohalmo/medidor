<?php

	include("connect.php"); 	
	
	$link=Connection();
	
	$sth = $link->prepare("SELECT fecha_hora, voltaje, corriente, energia FROM medidor");
	$sth->execute();

?>

<html>
   <head>
	   
      	<title>Sensor Data</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		
		<link rel="shortcut icon" type="image/x-icon" href="http://arduino.cc/en/favicon.png" />
		  
		<!-- prerequisites -->
		<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
        <script src="https://www.amcharts.com/lib/3/serial.js"></script>
        <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>  		
		
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<!-- Bootstrap Material Design -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/4.0.1/bootstrap-material-design.min.css">

   </head>
<body>
	
  <!-- cutom functions -->
        <script>
            AmCharts.loadJSON = function(url) {
            // create the request
            if (window.XMLHttpRequest) {
                // IE7+, Firefox, Chrome, Opera, Safari
                var request = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                var request = new ActiveXObject('Microsoft.XMLHTTP');
            }

            // load it
            // the last "false" parameter ensures that our code will wait before the
            // data is loaded
            request.open('GET', url, false);
            request.send();

            // parse adn return the output
            return eval(request.responseText);
            };
        </script>
    
        <script>
            var chartData = AmCharts.loadJSON('data.php');

            var chart = AmCharts.makeChart("chartdiv1", {
                "type": "serial",
                "theme": "light",
                "marginRight": 80,
                "dataProvider": chartData,
                "valueAxes": [{
                    "position": "left",
                    "title": "Voltaje (V)"
                }],
                "graphs": [{
                    "id": "g1",
                    "fillAlphas": 0.4,
                    "valueField": "voltaje",
                    "balloonText": "<div style='margin:5px; font-size:19px;'>voltaje:<b>[[voltaje]]</b></div>"
                }],
                "chartScrollbar": {
                    "graph": "g1",
                    "scrollbarHeight": 80,
                    "backgroundAlpha": 0,
                    "selectedBackgroundAlpha": 0.1,
                    "selectedBackgroundColor": "#888888",
                    "graphFillAlpha": 0,
                    "graphLineAlpha": 0.5,
                    "selectedGraphFillAlpha": 0,
                    "selectedGraphLineAlpha": 1,
                    "autoGridCount": true,
                    "color": "#AAAAAA"
                },
                "chartCursor": {
                    "categoryBalloonDateFormat": "JJ:NN, DD MMMM",
                    "cursorPosition": "mouse"
                },
                "categoryField": "fecha_hora",
                "categoryAxis": {
                    "minPeriod": "mm",
                    "parseDates": true
                },
                "export": {
                    "enabled": true,
                    "dateFormat": "YYYY-MM-DD HH:NN:SS"
                }
            });

            chart.addListener("dataUpdated", zoomChart);
            // when we apply theme, the dataUpdated event is fired even before we add listener, so
            // we need to call zoomChart here
            zoomChart();
            // this method is called when chart is first inited as we listen for "dataUpdated" event
            function zoomChart() {
                // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
                chart.zoomToIndexes(chartData.length - 250, chartData.length - 100);
            }
     
        </script>
		
		<script>
            var chartData = AmCharts.loadJSON('data.php');

            var chart = AmCharts.makeChart("chartdiv2", {
                "type": "serial",
                "theme": "light",
                "marginRight": 80,
                "dataProvider": chartData,
                "valueAxes": [{
                    "position": "left",
                    "title": "Corriente (A)"
                }],
                "graphs": [{
                    "id": "g1",
                    "fillAlphas": 0.4,
                    "valueField": "corriente",
                    "balloonText": "<div style='margin:5px; font-size:19px;'>corriente:<b>[[corriente]]</b></div>"
                }],
                "chartScrollbar": {
                    "graph": "g1",
                    "scrollbarHeight": 80,
                    "backgroundAlpha": 0,
                    "selectedBackgroundAlpha": 0.1,
                    "selectedBackgroundColor": "#888888",
                    "graphFillAlpha": 0,
                    "graphLineAlpha": 0.5,
                    "selectedGraphFillAlpha": 0,
                    "selectedGraphLineAlpha": 1,
                    "autoGridCount": true,
                    "color": "#AAAAAA"
                },
                "chartCursor": {
                    "categoryBalloonDateFormat": "JJ:NN, DD MMMM",
                    "cursorPosition": "mouse"
                },
                "categoryField": "fecha_hora",
                "categoryAxis": {
                    "minPeriod": "mm",
                    "parseDates": true
                },
                "export": {
                    "enabled": true,
                    "dateFormat": "YYYY-MM-DD HH:NN:SS"
                }
            });

            chart.addListener("dataUpdated", zoomChart);
            // when we apply theme, the dataUpdated event is fired even before we add listener, so
            // we need to call zoomChart here
            zoomChart();
            // this method is called when chart is first inited as we listen for "dataUpdated" event
            function zoomChart() {
                // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
                chart.zoomToIndexes(chartData.length - 250, chartData.length - 100);
            }
            
        </script>
		
		<script>
            var chartData = AmCharts.loadJSON('data.php');

            var chart = AmCharts.makeChart("chartdiv3", {
                "type": "serial",
                "theme": "light",
                "marginRight": 80,
                "dataProvider": chartData,
                "valueAxes": [{
                    "position": "left",
                    "title": "Energia (J)"
                }],
                "graphs": [{
                    "id": "g1",
                    "fillAlphas": 0.4,
                    "valueField": "energia",
                    "balloonText": "<div style='margin:5px; font-size:19px;'>energia:<b>[[energia]]</b></div>"
                }],
                "chartScrollbar": {
                    "graph": "g1",
                    "scrollbarHeight": 80,
                    "backgroundAlpha": 0,
                    "selectedBackgroundAlpha": 0.1,
                    "selectedBackgroundColor": "#888888",
                    "graphFillAlpha": 0,
                    "graphLineAlpha": 0.5,
                    "selectedGraphFillAlpha": 0,
                    "selectedGraphLineAlpha": 1,
                    "autoGridCount": true,
                    "color": "#AAAAAA"
                },
                "chartCursor": {
                    "categoryBalloonDateFormat": "JJ:NN, DD MMMM",
                    "cursorPosition": "mouse"
                },
                "categoryField": "fecha_hora",
                "categoryAxis": {
                    "minPeriod": "mm",
                    "parseDates": true
                },
                "export": {
                    "enabled": true,
                    "dateFormat": "YYYY-MM-DD HH:NN:SS"
                }
            });

            chart.addListener("dataUpdated", zoomChart);
            // when we apply theme, the dataUpdated event is fired even before we add listener, so
            // we need to call zoomChart here
            zoomChart();
            // this method is called when chart is first inited as we listen for "dataUpdated" event
            function zoomChart() {
                // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
                chart.zoomToIndexes(chartData.length - 250, chartData.length - 100);
            }

            
        </script>
		
		
		
		
		
		
		
		

	<div class="container"><br>
	  
		
			<div class="panel panel-success">
				<div class="panel-heading">
					<h2 class="panel-title">Voltaje</h2>
				</div>
				<div class="panel-body">
					<div id="chartdiv1" style="width	: 100%; height	: 500px;"></div>
				</div>
			</div>
		
		
		
			<div class="panel panel-success">
				<div class="panel-heading">
					<h2 class="panel-title">Corriente</h2>
				</div>
				<div class="panel-body">
					<div id="chartdiv2" style="width	: 100%; height	: 500px;"></div>
				</div>
			</div>
		
		
		
			<div class="panel panel-success">
				<div class="panel-heading">
					<h2 class="panel-title">Energia</h2>
				</div>
				<div class="panel-body">
					<div id="chartdiv3" style="width	: 100%; height	: 500px;"></div>
				</div>
			</div>
            
            <a href="report.php" class="btn btn-success btn-lg btn-block btn-raised">Generar Reporte</a>
            
            <a href="email.php" class="btn btn-info btn-lg btn-block btn-raised">Enviar a Correo</a><br>	
	
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h1 class="panel-title">Tabla de Datos</h1>
		</div>
		<div class="panel-body">
			
			<table class="table table-striped table-hover ">
				<tr class="info">
					<th>&nbsp;Fecha/Hora&nbsp;</td>
					<th>&nbsp;Voltaje&nbsp;</td>
					<th>&nbsp;Corriente&nbsp;</td>
					<th>&nbsp;Energia&nbsp;</td>
				</tr>
            
			 <?php foreach($sth->fetchAll(PDO::FETCH_ASSOC) as $row) : ?>
				<tr>
					<td><?php echo $row['fecha_hora']; ?></td>
					<td><?php echo $row['voltaje']; ?></td>
					<td><?php echo $row['corriente']; ?></td>
					<td><?php echo $row['energia']; ?></td>
				</tr>
			 <?php endforeach;?>
		   </table>
		
		</div>
	  </div>
      	
	</div>

   
</body>
</html>
