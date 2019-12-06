<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!-- Main content -->
	<section class="content">
		<div class="box">
			<div class="box-header with-border">

				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i
							class="fa fa-minus"></i></button>
				</div>
				<div class="box-body">
					<!-- CONTENT -->
					<div id="headerchart" align="center" style="width:100%">
						<h3 class="box-title">GRAFIK TOTAL NASABAH PER MASING-MASING TIPE NASABAH TANGGAL
							<?php echo date('d-m-Y');?></h3>
					</div>
					<div style="width: 100%;overflow: auto;margin-top: 50px">
						<div id="charthome" style="width:100%;"></div>
					</div>
					<!-- endCONTENT -->
				</div><!-- /.box-body -->
			</div>

	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<style type="text/css">
	$ {
		demo.css
	}
</style>
<script type="text/javascript">
	$(function () {
		// Create the chart
		$('#charthome').highcharts({
			chart: {
				type: 'column'
			},
			title: {
				text: ""
			},
			subtitle: {
				text: ''
			},
			xAxis: {
				type: 'category'
			},
			yAxis: {
				title: {
					text: 'Total Nasabah'
				}

			},
			legend: {
				enabled: false
			},
			plotOptions: {
				series: {
					borderWidth: 0,
					dataLabels: {
						enabled: true,
						format: '{point.y:.0f}  nasabah'
					}
				}
			},

			tooltip: {
				headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
				pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> nasabah dari keseluruhan nasabah<br/>'
			},

			series: [{
				name: 'Tipe Nasabah',
				colorByPoint: true,
				data: [

					<
					? php
					echo $result; ?
					>
				]
			}]
		});
	});
</script>
</div>
