<script>

$('#dataquote').click(function() {
  $('#modalasuransi').modal("show");
});

$('#dataakseptasi').click(function() {
  $('#modalakseptasi').modal("show");
});


$(document).on('keyup', '#rate', function() {
  var tsi = parseFloat($('#tsi').val()) ; 
  var rate = parseFloat($('#rate').val()) ;
  var premi = parseFloat(tsi * (rate/100));
  $('#premi').val(premi);
});

$('#saveasuransi').click(function() {

  var validation = isvalid();
  if(validation != 'VALID'){
    $("#contentmodalwarning").html("<div>Maaf Ada kesalahan dalam data yang anda input di Data Asset sebagai berikut :<ul>"+validation+"</ul></div>");
    $("#modalwarning").modal("show");
  }else{
       $.ajax({
          url :"<?php echo site_url();?>registrasi/assets/save",
          type:"POST",
          data:{
          nama      :$("#nama").val(),
          alamat    :$("#address").val(),
            tsi       :$("#tsi").val(),
            idnasabah :$("#idnasabah").val()
            },
          success: function(result){
                $("#idassets").val(result);
                $("#contentmodalsuccess").html("<h5>Data asset berhasil disimpan</h5>");
                $("#modalsuccess").modal("show");
          
                var validation = isvalid2();
                if(validation != 'VALID'){
                  $("#contentmodalwarning").html("<div>Maaf Ada kesalahan dalam data yang anda input di Data Asuransi sebagai berikut :<ul>"+validation+"</ul></div>");
                  $("#modalwarning").modal("show");
                }else{
                     $.ajax({
                        url :"<?php echo site_url();?>polis/kendaraan/quotesave",
                        type:"POST",
                        data:{
                          registrasi      :$("#registrasi").val(),
                          periode1        :$("#periode1").val(),
                          periode2        :$("#periode2").val(),
                          rate            :$("#rate").val(),
                          produk          :$("#produk").val(),
                          asuransi        :$("#asuransi").val(),
                          premi           :$("#premi").val(),
                          namanasabah     :$("#namanasabah").val(),
                          idnasabah       :$("#idnasabah").val(),
                          idassets        :$("#idassets").val()
                          },
                        success: function(result){
                             $("#contentmodalsuccess").append("<h5>Data Asuransi berhasil disimpan</h5>");
                             $("#modalsuccess").modal("show");
                                 },
                        error:function error(){
                            $("#contentmodalerror").html("<h5>Data Asuransi gagal disimpan</h5>");
                            $("#modalerror").modal("show");
                                          }                  
                      });
                }
          },
          error:function error(){
                $("#contentmodalerror").html("<h5>Data asset gagal disimpan</h5>");
                $("#modalerror").modal("show");
                            }                  
        });
  }


});

function isvalid2() {
    //cek if blank
    var result = 'VALID';
    var cekblank =0;
    var messageblank = '';
    $('.entries3').each(function() {
      if ($(this).val()==''){
        cekblank++;
      }
    });
    if (cekblank > 0){
      messageblank = '<li>mohon isi semua keterangan pada form</li>';
    }

    //cek valid email
    //var email = $('#email').val();
    var messageemail = '';
    // var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    // if (filter.test(email)) {
    // }
    // else {
    //   messageemail = '<li>mohon gunakan format email yang valid</li>';;
    // }

    //cek valid phoe
    //var telp = $('#telp').val();
    var messagetelp = '';
    // var filter2 = /^[0-9]+$/;
    // if (filter2.test(telp)) {
    // }
    // else {
    //   messagetelp = '<li>mohon masukkan no telp dengan benar</li>';;
    // }

    if(messageblank!= '' || messageemail != '' || messagetelp != ''){
      result = messageblank+messageemail+messagetelp;
    }

    return result;
}

</script>