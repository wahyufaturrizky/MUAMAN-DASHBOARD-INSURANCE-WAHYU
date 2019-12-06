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
  	.garis-tebal{
  		border-top: 2px solid #000000;
  	}

  	.top-atas{
  		/*margin-top: 320px;  		*/
  	}

  	.kiri {
  		width: 60%;
  	}

  	.tengah {
  		width: 2%;
  	}
  	ul {
	  margin: 0;
	}
	ul.dashed {
	  list-style-type: none;
	}
	ul.dashed > li {
	  text-indent: -5px;
	}
	ul.dashed > li:before {
	  content: "-";
	  text-indent: -5px;
	}
	#contentpdf{
		position: absolute;
		top : 300px;
		left :110px;
	}
	.paragraf{
		margin-right: 150px
	}
	#sertifikat {
		position: relative;
	}
  </style>
</head>
<body>
	<div id="sertifikat" class="container-fluid" style="background-size:cover; background-repeat:no-repeat; background-position:center center;font-size: 25px;font-weight: bold;">
		<img id="background" src="<?php echo base_url();?>assets/img/setifikat.jpg" width="100%">
		<div class="row" id="contentpdf">
			<div class="col">
				<hr class="garis-tebal top-atas paragraf">
				<br>
				<table cellspacing="1">
					<tr>
						<td class="kiri">No. Sertifikat / Polis</td>
						<td class="tengah">:</td>
						<td><?php echo $no_sertifikat; ?></td>
					</tr>
					<tr>
						<td class="kiri">No. Peserta</td>
						<td class="tengah">:</td>
						<td><?php echo $no_peserta; ?></td>
					</tr>
					<tr>
						<td class="kiri">Pemegang Polis / Sertifikat</td>
						<td class="tengah">:</td>
						<td><?php echo $pemegang; ?></td>
					</tr>
					<tr>
						<td class="kiri">Nama Tertanggung</td>
						<td class="tengah">:</td>
						<td><?php echo $nama_tertanggung; ?></td>
					</tr>
					<tr>
						<td class="kiri">Tanggal Lahir</td>
						<td class="tengah">:</td>
						<td><?php echo $tgl_lahir; ?></td>
					</tr>
					<tr>
						<td class="kiri">Jangka Waktu</td>
						<td class="tengah">:</td>
						<td><?php echo $jangka_waktu; ?></td>
					</tr>
					<tr>
						<td class="kiri">Periode</td>
						<td class="tengah">:</td>
						<td><?php echo $periode; ?></td>
					</tr>
					<tr>
						<td class="kiri">Nilai Pertanggungan</td>
						<td class="tengah">:</td>
						<td><?php echo $nilai_tertanggung; ?></td>
					</tr>
					<tr>
						<td class="kiri">Premi</td>
						<td class="tengah">:</td>
						<td><?php echo $premi; ?></td>
					</tr>
				</table>
				<br>
				<hr class="garis-tebal paragraf">
				<table cellspacing="1">
					<tr>
						<td width="35%">Ruang Lingkup Pertanggungan</td>
						<td width="1%">:</td>
						<td>Memberikan perlindungan atas resiko sebagai berikut :</td>
					</tr>
					<tr>
						<td width="35%"></td>
						<td width="1%"></td>
						<td><?php echo $ruang_lingkup; ?></td>
					</tr>
				</table>
				<br>
				<br>
				<p class ="paragraf">
					Polis ini berkenaan dengan peserta yang diasuransikan berdasarkan syarat-syarat dan ketentuan-
					ketentuan yang sebagaimana tercantum dalam ringkasan Polis, ketentuan umum Polis, ketentuan 
					khusus Polis, dan ketentuan lainnya (apabila diadakan) yang dilampirkan atau dicantumkan dalam 
					<br>Polis ini merupakan bagian yang tidak dapat dipisahkan dari Polis induk.
				</p>
				<br><br>
				<label>
					Konsorsium Asuransi/Penjamin Kredit <?php echo $pemegang; ?>
				</label>
				<br>
				<table cellpadding="5">
					<tr>
						<td>- PT. Jamkrida Jabar</td>
						<td>(<?php echo $jamkridapersen ?>)</td>
					</tr>
					<tr>
						<td>- PT. Asuransi Intra Asia</td>
						<td>(<?php echo $intraasiapersen ?>)</td>
					</tr>
					<tr>
						<td>- PT. Asuransi Jiwa Reliance Indonesia</td>
						<td>(<?php echo $reliancepersen ?>)</td>
					</tr>
					<tr>
						<td>- PT. Asuransi Jasa Mitra Abadi (JMA)</td>
						<td>(<?php echo $mitrapersen ?>)</td>
					</tr>
					<tr>
						<td>- PT. Bumida</td>
						<td>(<?php echo $bumidapersen ?>)</td>
					</tr>
					<tr>
						<td>- PT. BNI Life Syariah Insurance</td>
						<td>(<?php echo $bnilifepersen ?>)</td>
					</tr>
					<tr>
						<td>- PT. Asuransi Syariah Keluarga Indonesia</td>
						<td>(<?php echo $syariahpersen ?>)</td>
					</tr>
				</table>
				<br>
				<label>Dibuat di Jakarta</label><br>
				<label><?php echo $tglsekarang; ?></label>
			</div>
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
		        pdf.save('sertifikat.pdf');
	    	}
	    });

	}
  </script>
</body>
</html>