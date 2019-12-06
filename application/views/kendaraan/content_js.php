 <div id="js"> 
 <script>
$(function () {
     
      $('#update').hide();
      $('#update_user').hide();
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
      });

      
    
});

</script>
<?php $this->view('kendaraan/datanasabah_js'); ?>
<?php $this->view('kendaraan/dataasset_js'); ?>
<?php $this->view('kendaraan/dataasuransi_js'); ?>




 </div>