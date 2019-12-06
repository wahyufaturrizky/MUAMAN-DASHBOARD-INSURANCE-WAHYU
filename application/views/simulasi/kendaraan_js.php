<script>
$(document).ready(function() {
    $('.dopilih').click(function() {
        var formData = new FormData($('#frquotation'));
        var form = $('#frquotation').serializeArray();
        var idrate = $(this).data("id");
        // var harga = $('#harga').val();
        // var coverage = $('#coverage').val();

        console.log(idrate, harga, coverage, form[2]);

        $.redirect('<?php echo site_url();?>simulasi/kendaraan/summary/'+idrate, {
            'data': form
            });
    });

    $('.doorder').click(function() {
        // $("#contentrequest").html('Apakah anda yakin ingin memproteksi assets '+data[0]+' ?');
        var idrate = $(this).data("id");
        var premi = $(this).data("premi");
        $.ajax({
            type: 'post',
            url: '<?php echo site_url();?>simulasi/kendaraan/sum/'+idrate,
            data: $('#frquotation').serialize()+'&premi='+premi,
            success: function (data) {
              $("#contentrequest").html(data);
              $("#modalrequest").modal("show");
            }
          });
        
    });

});

// $(document).on('keyup', '.currency', function() {
//     angka = $(this).val();
//     rupiahnum = angka.replace( /\D+/g, '');
//     rupiah = formatcurrency(rupiahnum);
//     $(this).val(rupiah);
// });

function formatcurrency(number) { 
  
  var number_string = number.toString(),
  sisa  = number_string.length % 3,
  rupiah  = number_string.substr(0, sisa),
  ribuan  = number_string.substr(sisa).match(/\d{3}/g);
    
  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }
  rupiah = "Rp. "+ rupiah;
  return rupiah;
}
</script>