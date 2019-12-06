<!DOCTYPE html>
<html>
<head>
  <title>Sertifikat</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <style type="text/css">
	#sertifikat {
		size: A4 landscape;
		position: absolute;
		font-size: 11pt;
		font-family: Arial;
	}
	#content {
		margin-top: 100px;
		margin-left: 50px;
		margin-right: 50px;
	}
	td{
		border: thin solid;
	}
  </style>
</head>
<body>
	<?php //var_dump($header);?>
	<div id="sertifikat" style="border: solid 1px">
		<div id="content">
		<p>Lampiran <?php echo $no_sertifikat;?>
		<br><?php echo $pemegang;?>
		<br>Periode <?php echo $periode;?></p>
		<p>
		<table border="0">
			<tr>
			<?php for ($k=0; $k < count($header) ; $k++) : ?> 
				<td style="padding:5px"><b><?php echo $header[$k];?></b></td>	
			<?php endfor; ?>
			</tr>
			<tbody>
				<?php foreach ($purchase_data->result() as $b) :?>
					<?php //for($i=1 ; $i<20 ;$i++):?>
					<tr >
					<?php $datamember = explode("|", $b->data); //var_dump($datamember);?>
					<?php for ($j=0; $j < count($datamember) ; $j++) : ?>
						<td style="padding:5px"><?php echo $datamember[$j]?> </td>	
					<?php endfor; ?>
					</tr>
					<?php //endfor;?>
				<?php endforeach; ?>
			</tbody>
		</table>
		</p>
		<p>Total Pertanggungan : Rp. <?php echo number_format($pertanggungan); ?>
		<br>Total Premi : Rp. <?php echo number_format($premi); ?></p>
		</div>
	</div>





	<script type="text/javascript">
  	$( document ).ready(function() {
	    console.log( "ready!" );
	    saveAsPDF();
	});

  	function saveAsPDF() {
	    html2canvas(document.getElementById("sertifikat"), {
	    	onrendered: function(canvas) {
	    		var imgData = canvas.toDataURL('image/png');
	    		window.open(imgData);
		        var pdf = new jsPDF('p', 'mm', 'a4');
		        var pageWidth = pdf.internal.pageSize.width;
		        var pageHeight = pdf.internal.pageSize.height;
		        var imageWidth = canvas.width;
		        var imageHeight = canvas.height;

		        var ratio = imageWidth/imageHeight >= pageWidth/pageHeight ? pageWidth/imageWidth : pageHeight/imageHeight;
		        /*pdf.addHTML(document.body,function() {
				    console.log("started");
				    pdf.save('demo.pdf')
				    console.log("finished");
				});*/
		        pdf.addImage(imgData, 'JPEG', 0, 0, imageWidth * ratio, imageHeight * ratio);
		        pdf.save('lampiran.pdf');
	    	}
	    });

	}
  </script>
</body>
</html>