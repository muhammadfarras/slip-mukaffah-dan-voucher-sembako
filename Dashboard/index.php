<?php
ob_start();
include ("config.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard Sembako</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../src/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="../src/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>

	<!-- Chart Js -->
<!-- 	<link href="../vendor/Chart.js-2.9.4/dist/Chart.css" rel="stylesheet">
	<link href="../vendor/Chart.js-2.9.4/dist/Chart.min.css" rel="stylesheet"> -->
	<script src="../vendor/Moment Js/moment.js" type="text/javascript"></script>
	<script src="../vendor/Chart.js-2.9.4/dist/Chart.js" type="text/javascript"></script>
	<!-- <script src="../vendor/Chart.js-2.9.4/dist/Chart.min.js" type="text/javascript"></script> -->
	<script defer src="javascript.js" type="text/javascript"></script>
	<style type="text/css">
		.addScroll{
		  overflow-y:auto;
		  height: 200px;
		}

		canvas {
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
	</style>


</head>
<body>

	<div class="container mt-2">

		<h2>
			Dashboard Sistem Sembako
		</h2>
		
	</div>

	<div class="container mt-2 shadow p-3 rounded mb-5">

		<!-- Tempat untuk chart -->
		<div class="col-sm-12">

			<div style="width: 70%; margin: 0 auto;">
				<canvas id="chart-area"></canvas>
			</div>
			
			
		</div>


		<!-- Tempat Untuk Tabel -->
		<div class="row mt-5">
			<div class="col-sm-12">

				<div class="row">

					<!-- Table list sembako yang sudah mengambil -->
					<div class="col-sm-6 addScroll">
						<?php
							include ("Tabel Sembako Taken.php");
						?>
					</div>

					<!-- Table list sembako yang belum mengambil -->
					<div class="col-sm-6 addScroll">
						<?php
							include ("Tabel Sembako No Taken.php");
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container mt-2 shadow p-3 rounded mb-5">

		<!-- Line Area -->
		<div class="col-sm-12">

			<div style="width: 100%; margin: 0 auto;">
				<canvas id="line-area"></canvas>
			</div>
			
		</div>

	</div>

<script>
	var ctx = document.getElementById('chart-area').getContext('2d');

		var optionLabels = ['Belum diambil','Sudah diambil'],

		   	optionData = [<?php echo $noNoTaken; ?>, <?php echo $noTaken; ?>],

		   	optionColor = ['rgb(240, 188, 91)' , 'rgb(32, 214, 214)'],

		   	optionColorHover = ['rgba(240, 188, 91,0.5)', 'rgba(32, 214, 214,0.5)'];



		var myChart = new Chart(ctx, {

		   type: 'doughnut',

		   data: {

		      labels: optionLabels,

		      datasets: [{

		         label: '# of Resources',

		         data: optionData,

		         backgroundColor: optionColor,

		         borderColor: "white",

		         borderWidth: 1,

		         hoverBorderColor: optionColorHover,

		         hoverBorderWidth: [5,5]

		      }]
		   },
		   options: {

		      legend: {

		         position: 'bottom'

		      },

		      title: {

		      	display: true,

		      	text: 'Pengambil Sembako',

		      	fontStyle: 'italic',

		      	fontSize: 24
		      },

		      cutoutPercentage: 50

		   }
		});
</script>

<script>

	var monthSelected = parseInt('03')-1;
	var yearSelected = parseInt('2021');

	var timeSembako = moment().set({

		'month' : monthSelected,

		'year' : yearSelected,

		'hour' : 0,

		'minute' : 0,

		'second' : 0
	});

	console.log (timeSembako);

	var infData = <?php echo json_encode ($infPengambil); ?>;

	var firstDay = timeSembako.clone().startOf('month').format('D');
	var lastDay = timeSembako.clone().endOf('month').format('D');

	function allDate (){

		var result = {
			
			allDates : [],

			allDatesValue : [],

			countTaken : [],

			personTaken : []
		}




		for (var i = firstDay ; i <= lastDay ; i++){

			var thisDate = timeSembako.set({

				'date' : i,

				'hour' : 0,

				'minute' : 0,

				'second' : 0
			});

			result.allDatesValue.push (thisDate.unix() * 1000);

			result.allDates.push (thisDate.format ('D/MMM/YYYY'));

			result.countTaken.push (0);

			result.personTaken.push ([]);

			var positionTakenDate = 0;

			// Jika tanggalnya sama maka masukan kedalam count
			infData.tanggal.forEach (function (it) {

				var curDate = parseInt(moment(it).format ("D"));
				var curMonth = parseInt(moment(it).format ("MM"))-1;

				if ( curDate == i && monthSelected == curMonth ){

					result.countTaken[i-1] += 1;


					result.personTaken[i-1].push (infData.pengambil[positionTakenDate]);

				}
				else {

					result.countTaken[i-1] += 0;
				
				}

				positionTakenDate += 1;

			});

		}
		return result;
	}

	// console.log (allDate());

	var sCanvas = document.getElementById('line-area');

	var config = {
		type : 'line',

		data : {

			labels: allDate().allDates,

			datasets : [{
				"label":"Pengambilan Sembako",

				"data": allDate().countTaken,

				"fill": true,

				"borderColor" : "rgb(75, 192, 192)", // warna dari garis

				"borderWidth" : 2, // lebar dari garis

				"lineTension" : 0, // sudut dari garis

				'pointStyle' : 'rect',

				'clip' : 5, // besaran dari pointStyle

			}]

		},
		options : {

			title : {

				display : true,

				text : 'Grafik Pengambilan Sembako',

				fontStyle: 'italic',

		      	fontSize: 24

			},

			legend : {

				position : 'top'

			},

			scales : {

				yAxes : [{

					ticks : {

						suggestedMax : (Math.max(...allDate().countTaken)+Math.max(...allDate().countTaken)*(25/100)),

						beginAtZero: true,

						min: 0

					}

				}]

			},

			tooltips: {
	            // Disable the on-canvas tooltip
	            enabled: false,



	            callbacks: {
	                label: function(tooltipItem, data) {
	                    var label = data.datasets[tooltipItem.datasetIndex].label || '';

	                    // console.log ( tooltipItem.index);

	                    if (label) {
	                        label += ': ';
	                    }
	                    label += Math.round(tooltipItem.yLabel * 100) / 100;
	                    return tooltipItem.index;
	                }
	            },

	            custom: function(tooltipModel) {
	                // Tooltip Element
	                var tooltipEl = document.getElementById('chartjs-tooltip');

	                // Create element on first render
	                if (!tooltipEl) {

	                    tooltipEl = document.createElement('div');

	                    tooltipEl.id = 'chartjs-tooltip';

	                    tooltipEl.innerHTML = '<table></table>';

	                    document.body.appendChild(tooltipEl);
	                }

	                // Hide if no tooltip
	                if (tooltipModel.opacity === 0) {

	                    tooltipEl.style.opacity = 0;

	                    return;

	                }

	                // Set caret Position
	                tooltipEl.classList.remove('above', 'below', 'no-transform');

	                if (tooltipModel.yAlign) {

	                    tooltipEl.classList.add(tooltipModel.yAlign);

	                } else {

	                    tooltipEl.classList.add('no-transform');

	                }

	                function getBody(bodyItem) {

	                    return bodyItem.lines;

	                }

	                // Set Text
	                if (tooltipModel.body) {

	                    var titleLines = tooltipModel.title || [];

	                    var bodyLines = tooltipModel.body.map(getBody);

	                    var innerHtml = '<thead>';

	                    titleLines.forEach(function(title) {
	                        innerHtml += '<tr><th>' + title + '</th></tr>';
	                    });
	                    innerHtml += '</thead><tbody>';

	                    bodyLines.forEach(function(index, i) {

	                        var colors = tooltipModel.labelColors[i];

	                        var style = 'background:' + 'rgb(75, 192, 192)';

	                        style += '; border-color:' + colors.borderColor;

	                        style += '; border-width: px';

	                        style += '; padding: 8px';

	                        var isi = (allDate().personTaken[index].length > 0) ? allDate().personTaken[index] : "Belum ada pengambilan";


	                        innerHtml += '<tr><td id="divIsi" style="'+style+'">' + isi + '</td></tr>';

	                    });
	                    innerHtml += '</tbody>';

	                    var tableRoot = tooltipEl.querySelector('table');

	                    tableRoot.innerHTML = innerHtml;

	                }

	                // `this` will be the overall tooltip
	                var position = this._chart.canvas.getBoundingClientRect();

	                // Display, position, and set styles for font
	                tooltipEl.style.opacity = 1;

	                tooltipEl.style.position = 'absolute';

	                tooltipEl.style.left = position.left + window.pageXOffset + tooltipModel.caretX + 'px';

	                tooltipEl.style.top = position.top + window.pageYOffset + tooltipModel.caretY - tooltipEl.clientHeight + 'px';

	                tooltipEl.style.fontFamily = tooltipModel._bodyFontFamily;

	                tooltipEl.style.fontSize = tooltipModel.bodyFontSize + 'px';

	                tooltipEl.style.fontStyle = tooltipModel._bodyFontStyle;

	                tooltipEl.style.padding = tooltipModel.yPadding + 'px ' + tooltipModel.xPadding + 'px';

	                tooltipEl.style.pointerEvents = 'none';
	            }
       		 }
		}
	}

	var myLineArea = new Chart (sCanvas, config);
</script>
	 
</body>
</html>