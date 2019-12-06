 <div id="js"> 
 <script>
$(function () {
     
      $('#update').hide();
      $('#form_all').hide();
      $('#update_user').hide();
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
      });

      datatablepagingquote();
    
});

$(document).on('keyup', '#contain', function() {
    datatablepaging();
});

$(document).on('keyup', '#containasset', function() {
    datatablepagingasset();
});

$(document).on('keyup', '#containquote', function() {
    datatablepagingquote();
});


$(document).on('click', '#new', function() {
	$('#formcontentdetail').remove();
  var idbrokerposition = $('#idbrokerposition').val(); 
  if(idbrokerposition==='2' || idbrokerposition==='5'){
    $("#polissaved").fadeOut('fast');
    $("#form_all").fadeIn('fast');   
  }
  else{
    $("#contentmodalwarning").html("Maaf akun yang anda gunakan tidak memiliki akses membuat data polis baru");
    $("#modalwarning").modal("show");
  }
});

$(document).on('click', '#addaksesoris', function() {
	var a = parseInt($('#indexitem').val());
    $("#addrowitem").append('<div class="row"><div class="col-xs-12 col-sm-3"><div class="form-group"><label>Item '+ (a+1) +'</label></div></div><div class="col-xs-12 col-sm-5"><div class="form-group"><input type="text" class="form-control namaitem" value="" placeholder="Nama Item"></div></div><div class="col-xs-12 col-sm-4"><div class="form-group"><input type="text" class="form-control hargaitem" value="" placeholder="Rp. Harga Item"></div></div></div>');
    $('#indexitem').val(a+1);
});

$(document).on('change', '#produk', function() {
	x='';
	getformdetail($(this).val(),x); 
});

$('#forig').click(function () {
  $('#flagquote').val('1');
  datatablepagingquote();
});
$('#fopen').click(function () {
  $('#flagquote').val('2');
  datatablepagingquote();
});
$('#fprocess').click(function () {
  $('#flagquote').val('3');
  datatablepagingquote();
});
$('#fclose').click(function () {
  $('#flagquote').val('4');
  datatablepagingquote();
});
$('#ffailed1').click(function () {
  $('#flagquote').val('5');
  datatablepagingquote();
});
$('#ffailed2').click(function () {
  $('#flagquote').val('6');
  datatablepagingquote();
});
$('#frequested').click(function () {
  datatablepagingassetreq();
})

</script>
<?php $this->view('polis/datanasabah_js'); ?>
<?php $this->view('polis/dataasset_js'); ?>
<?php $this->view('polis/dataasuransi_js'); ?>


 </div>