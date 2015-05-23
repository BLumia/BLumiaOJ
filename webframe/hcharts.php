<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="renderer" content="webkit">

		<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
		<script src="http://cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

		<script src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>
		<script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>	
		<script type="text/javascript">
			$(function () {
				var chart;
				
				$(document).ready(function () {
					
					// Build the chart
					$('#cont').highcharts({
						chart: {
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false
						},
						title: {
							text: 'What the fuck?'
						},
						tooltip: {
							pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
									enabled: false
								},
								showInLegend: true
							}
						},
						series: [{
							type: 'pie',
							name: 'percentage',
							data: [
								['AC',   45.0],
								['WA',       26.8],
								['TLE',    8.5],
								['MLE',     6.2],
								['CE',   0.7]
							]
						}]
					});
				});
			});
		</script>
	</head>
	<body>
		<div id="cont" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	</body>
</html>