<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Database Error</title>
<!-- <style type="text/css"> -->
 	<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/ionic/css/ionic.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/datatables/media/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/datatables/media/css/TableTools.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css">
  	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
 	<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
	
	<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/app.min.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/highcharts/highcharts.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/highcharts/data.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/highcharts/drilldown.js"></script>
    <script src="<?php echo base_url();?>assets/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/datatables/media/js/TableTools.min.js"></script>
    <script src="<?php echo base_url();?>assets/datatables/media/js/ZeroClipboard.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>assets/datatables/media/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script> 	

</head>
<body>
	<!-- <div id="container">
		<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
	</div> -->
	<div class="" id="modalerror" tabindex="" role="" aria-labelledby="myModalLabel" aria-hidden="">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-red color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">ERROR DATABASE</h4> <br>
            </div>
            <div class="modal-body">
              <div id="contentmodalerror">
                <h3><?php echo $heading; ?></h3>
                <?php $msg = explode('</p>', $message); ?>
				<?php echo $msg[0].'</p>'; ?>
				<?php echo $msg[1].'</p>'; ?>
				<div><?php echo $msg[2].'</p>'; ?></div>
				<?php echo $msg[3].'</p>'; ?>
				<?php echo $msg[4].'</p>'; ?>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-danger" data-dismiss="modal"><b>Close</b></button>
            </div>
          </div>
        </div>
    </div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		//$("#modalerror").modal('show');
	});

	$('#close').click(function() {
		//location.href="<?php echo site_url();?>home/"
		parent.history.back();
		return false;
	});
</script>
</html>
