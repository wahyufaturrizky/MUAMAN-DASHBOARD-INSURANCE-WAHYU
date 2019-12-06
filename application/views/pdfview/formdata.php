<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div id="contentheader" hidden="hidden">
 <div align="center">
 	<p>
 		<b>
 			<h1>PT.INSCO INDONESIA</h1>
 		</b>
 	</p>
 	<p>
 		Jalan Kemang Timur Jakarta Selatan 
 	</p>
 </div>
</div>
<div id="editor"></div>

<div id="contentdata" hidden="hidden">
<div align="center">
	<?php 
	foreach ($getpolisdata->result() as $a): 
	$noreg = $a->no_reg;?>
<pre>
	<p>Dear <?php echo $a->namaNasabah;?>,</p>
	<p>
	Berikut adalah dokumen akseptasi mengenai asset yang akan diproteksi : 
	</p>	
	<table border="0" style="font-size: 7px;width: 20% ">
		<tr style="padding: 0px 0px 0px 0px"><td>NO REGISTRASI</td><td><?php echo $a->no_reg; ?></td></tr>
		<tr style="padding: 0px 0px 0px 0px"><td>NAMA NASABAH</td><td><?php echo $a->namaNasabah; ?></td></tr>
		<tr style="padding: 0px 0px 0px 0px"><td>ASSET</td><td><?php echo $a->namaAset; ?></td></tr>
		<tr style="padding: 0px 0px 0px 0px"><td>PRODUK</td><td><?php echo $a->nama_produk; ?></td></tr>
		<tr style="padding: 0px 0px 0px 0px"><td>TSI</td><td><?php echo 'Rp. '.number_format($a->tsi); ?></td></tr>
		<tr style="padding: 0px 0px 0px 0px"><td>PREMI</td><td><?php echo 'Rp. '.number_format($a->premi); ?></td></tr>
		<tr style="padding: 0px 0px 0px 0px"><td>TANGGAL RELEASE</td><td><?php echo $a->date_released; ?></td></tr>
		<tr style="padding: 0px 0px 0px 0px"><td>TANGGAL EXPIRED</td><td><?php echo $a->date_expired; ?></td></tr>
	</table>
</pre>
	</div>
<?php endforeach; ?>
</div>
<div id="editor2"></div>

<!-- jQuery 2.1.4 -->
<!-- <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script> -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jspdf.debug.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>

	var pdf = new jsPDF();
	var img = new Image;
	var specialElementHandlers = {
	    '#editor': function (element, renderer) {
	        return true;
	    }
	};
	img.onload = function() {
	    pdf.addImage(this, 10, 10,20,20);
	    pdf.setFontSize(12);
	    pdf.fromHTML($('#contentheader').html(), 35, 5, {
	        'width': 170,
	            'elementHandlers': specialElementHandlers
	    	});
	   	pdf.fromHTML($('#contentdata').html(), 35, 30, {
	        'width': 150,
	            'elementHandlers': specialElementHandlers
	    	});
	    pdf.save("<?php echo $noreg;?>.pdf");
	};
	img.crossOrigin = "";  // for demo as we are at different origin than image
	img.src = "<?php echo base_url();?>assets/img/logo.png";  // some random imgur image

</script>