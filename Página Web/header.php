<!doctype HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Ops! Aconteceu alguma coisa...</title>
			<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
			<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
			<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
			<link rel="stylesheet" type="text/css" href="css/style.css">
			<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
			<script type="text/javascript" src="js/materialize.min.js"></script>
			<script type="text/javascript" src="js/canvasjs.min.js"></script>
			<script type="text/javascript" src="js/websocket.js"></script>
			<script type="text/javascript" src="js/function.js"></script>
	<script type="text/javascript">
	window.onload = function () {

		var dps = []; // dataPoints

		var chart = new CanvasJS.Chart("chartContainer",{
			title :{
				text: "Temperatura"
			},			
			data: [{
				type: "line",
				dataPoints: dps 
			}],
			 axisY:{
   				valueFormatString: ("#,."),
   				 suffix: " ºC",
 			}
		});

		var xVal = 0;
		var yVal = 100;	
		var updateInterval = 100;
		var dataLength = 100; // number of dataPoints visible at any point

		var updateChart = function (count) {
			count = count || 1;
			// count is number of times loop runs to generate random dataPoints.
			
			for (var j = 0; j < count; j++) {	
				yVal =  parseInt(sensorVal*1000);
				dps.push({
					x: xVal,
					y: yVal
				});
				xVal++;
			};
			if (dps.length > dataLength)
			{
				dps.shift();				
			}
			
			chart.render();		

		};

		// generates first set of dataPoints
		updateChart(dataLength); 

		// update chart after specified time. 
		setInterval(function(){updateChart()}, updateInterval); 

	}
	</script>

	</head>

	<body>
		<header>
			<div class="row header up-down  z-depth-2">
					
					<div class="col s12  offset-l2 l8">
						<h1 class="center headerTitle">Projeto Final</h1>
						<h3 class="center">Microcontroladores</h3>
					</div>
					
			</div>
			
		</header>
		<section class="menu">

	  <a class="waves-effect waves-green btn-flat ini" href="index.php"><i class="fa fa-home"></i>
  Inicio</a>
  		<a class="waves-effect waves-green btn-flat apr" value="Apresentação" href="apresenta.php"><i class="fa fa-info-circle"></i> 
 Apresentação</a>
</section>