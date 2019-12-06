<?php $this->view('header'); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php $this->view('topnavigation'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php $this->view('sidebarnavigation'); ?>

  <!-- Content Wrapper. Contains page content -->
    <?php echo $content;?>
  <!-- /.content-wrapper -->
    <?php $this->view('footer'); ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?=base_url('assets')?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url('assets')?>/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?=base_url('assets')?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?=base_url('assets')?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url('assets')?>/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets')?>/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('assets')?>/dist/js/demo.js"></script>
<script src="<?=base_url('assets')?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<link rel="stylesheet" href="<?=base_url('assets')?>/plugins/sweetalert2/sweetalert2.min.css">

<!-- page script -->
<!-- <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script> -->

<?php echo (isset($bottomActionScript)?$bottomActionScript:"");?>
</body>
</html>
