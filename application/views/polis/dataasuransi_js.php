<script>

$('#dataakseptasi').click(function() {
  $('#modalakseptasi').modal("show");
});


$('#clear').click(function() {
        $("#namanasabah").val('');
        $("#nama").val('');
        $("#address").val('');
        $("#tsi").val('');
        $("#idnasabah").val('');
        $("#idassets").val('');

        $("#registrasi").val('');
        $("#periode1").val('');
        $("#periode2").val('');
        
        $("#produk").val('');
        $("#asuransi").val('0');
        $("#premi").val('');
        $("#rate").val('');
        $("#flag").val('')
        
        $("#polissaved").fadeIn('fast');
        $("#form_all").fadeOut('fast'); 
        $('#example3').DataTable().ajax.reload();
});

$(document).on('keyup', '#rate', function() {
  var tsi = parseFloat($('#tsi').val().replace( /\D+/g, '')) ; 
  var rate = parseFloat($('#rate').val()) ;
  var premi = parseFloat(tsi * (rate/100)).toFixed(0);
  var premirupiah = formatcurrency(premi);
  $('#premi').val(premirupiah);
});

$(document).on('click', '#sendmail', function() {
    $("#modalsendemail").modal("show");
    $.ajax({
          url :"<?php echo site_url();?>polis/polis/sendemail/?reg="+ $("#registrasi").val(),
          type:"GET",
          data:{
            },
          success: function(result){
            $("#modalsendemail").modal("hide");
            if(result === '1'){
                $("#contentmodalsuccess").html("<h5>Email Sudah Dikirim</h5>");
                $("#modalsuccess").modal("show");
            }
            else{
                $("#contentmodalerror").html("<h5>Email Gagal Dikirim</h5>");
                $("#modalerror").modal("show");
            }
          },
          error:function error(){
                $("#modalsendemail").modal("hide");
                $("#contentmodalerror").html("<h5>Email Gagal Dikirim</h5>");
                $("#modalerror").modal("show");
                        }
      });
});

$(document).on('click', '#saveasuransi', function() {
  var validation = isvalid();
  if(validation != 'VALID'){
    $("#contentmodalwarning").html("<div>Maaf Ada kesalahan dalam data yang anda input di Data Asset sebagai berikut :<ul>"+validation+"</ul></div>");
    $("#modalwarning").modal("show");
  }else{
       $.ajax({
          url :"<?php echo site_url();?>registrasi/assets/save",
          type:"POST",
          data:{
            idassets  :$("#idassets").val(),
            nama      :$("#nama").val(),
            alamat    :$("#address").val(),
            tsi       :$("#tsi").val().replace( /\D+/g, ''),
            idnasabah :$("#idnasabah").val()
            },
          success: function(result){
                $("#idassets").val(result);
                var premirp = $("#premi").val();
                var premi = premirp.replace( /\D+/g, '');
                var validation = isvalid2();
                if(validation != 'VALID'){
                  $("#contentmodalwarning").html("<div>Maaf Ada kesalahan dalam data yang anda input di Data Asuransi sebagai berikut :<ul>"+validation+"</ul></div>");
                  $("#modalwarning").modal("show");
                }else{
                     akseptasi();
                     $.ajax({
                        url :"<?php echo site_url();?>polis/polis/quotesave",
                        type:"POST",
                        data:{
                          registrasi      :$("#registrasi").val(),
                          periode1        :$("#periode1").val(),
                          periode2        :$("#periode2").val(),
                          rate            :$("#rate").val(),
                          produk          :$("#produk").val(),
                          asuransi        :$("#asuransi").val(),
                          premi           :premi,
                          namanasabah     :$("#namanasabah").val(),
                          idnasabah       :$("#idnasabah").val(),
                          idassets        :$("#idassets").val(),
                          flag            :$("#flag").val(),
                          },
                        success: function(result){
                             $("#contentmodalsuccess").html("<h5>Data Asuransi berhasil disimpan</h5>");
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
                $("#contentmodalerror").html("<h5>Data Asset gagal disimpan</h5>");
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

$(document).on('keyup', '#containquote', function() {
    datatablepagingquote();
});

// $('#dataquote').click(function() {
//   $("#modalasuransi").modal("show");
//   var contain = $("#namanasabah").val();
//   $("#containquote").val(contain);
//   setTimeout(function() {
//     datatablepagingquote();  
//   },100)
// });

function datatablepagingquote() {
    var flag = $('#flagquote').val(); 
     $.ajax({
          url :"<?php echo site_url();?>polis/polis/pagingquote?flag="+flag+"&search="+$('#containquote').val(),
          type:"POST",
          data:{
            },
          success: function(result){
          
          $('#pagingquote').html(result);

          var page = parseInt($('#countpagequote').val());
              for (let i = 1; i <=page; i++) {
                $('.pagequote'+i).click(function() {
                  $('#pagenumberquote').html('PAGE '+i);
                  datatableviewquote(flag,i);
                })
              } 
            },
      });
      var x ='';
      datatableviewquote(flag,x);
}

function datatableviewquote(flag,i) {
     
      $('#example3').dataTable({ 
        "scrollX": true,
        "paging": false,
        "info" : false,
        "bDestroy" : true,
        "sScrollXInner": "120%" ,
        "searching" :false, 
        "ajax": "<?php echo site_url()?>polis/polis/ajax_data_quote/?flag="+flag+"&page="+i+"&search="+$('#containquote').val()
      });
      
      var data = null;
      var tablequote = $('#example3').DataTable();

      $('#example3 tbody').on('click', '#choosequote', function () {
        data = tablequote.row( $(this).parents('tr') ).data();

        $("#namanasabah").val(data[1]);
        $("#nama").val(data[2]);
        $("#address").val(data[18]);
        $("#tsi").val(formatcurrency(data[8].replace( /\D+/g, '')));
        $("#idnasabah").val(data[14]);
        $("#idassets").val(data[13]);

        $("#registrasi").val(data[0]);
        $("#periode1").val(data[6]);
        $("#periode2").val(data[7]);
        
        $("#produk").val(data[15]);
        $("#asuransi").val(data[17]);
        $("#premi").val(formatcurrency(data[9].replace( /\D+/g, '')));
        $("#flag").val(data[19]);
        var rate = parseFloat(parseInt(data[9])*100/parseInt(data[8]));
        $("#rate").val(rate);
        $("#polissaved").fadeOut('fast');
        $("#form_all").fadeIn('fast');

        getformdetail(data[15],data[0]);

      });
}

$(document).on('keyup', '#thp', function() {
    angka = $(this).val();
    rupiahnum = angka.replace( /\D+/g, '');
    rupiah = formatcurrency(rupiahnum);
    $(this).val(rupiah);
});

$(document).on('keyup', '#tjhpihak3', function() {
    angka = $(this).val();
    rupiahnum = angka.replace( /\D+/g, '');
    rupiah = formatcurrency(rupiahnum);
    $(this).val(rupiah);
});

$(document).on('keyup', '#tjhpenumpang', function() {
    angka = $(this).val();
    rupiahnum = angka.replace( /\D+/g, '');
    rupiah = formatcurrency(rupiahnum);
    $(this).val(rupiah);
});

$(document).on('keyup', '#papenumpang', function() {
    angka = $(this).val();
    rupiahnum = angka.replace( /\D+/g, '');
    rupiah = formatcurrency(rupiahnum);
    $(this).val(rupiah);
});

$(document).on('keyup', '#papengemudi', function() {
    angka = $(this).val();
    rupiahnum = angka.replace( /\D+/g, '');
    rupiah = formatcurrency(rupiahnum);
    $(this).val(rupiah);
});

$(document).on('keyup', '#lainnya', function() {
    angka = $(this).val();
    rupiahnum = angka.replace( /\D+/g, '');
    rupiah = formatcurrency(rupiahnum);
    $(this).val(rupiah);
});

$(document).on('keyup', '.hargaitem', function() {
    angka = $(this).val();
    rupiahnum = angka.replace( /\D+/g, '');
    rupiah = formatcurrency(rupiahnum);
    $(this).val(rupiah);
});

function getformdetail(produkid,noreg) {
  $.ajax({
          url :"<?php echo site_url();?>polis/polis/formdetail",
          type:"POST",
          data:{
              produk : produkid,
              noreg : noreg
            },
          success: function(result){
          $("#detailform").html(result);
            },
        });
}

function formatcurrency(number) { 
  
  var number_string = number.toString(),
  sisa  = number_string.length % 3,
  rupiah  = number_string.substr(0, sisa),
  ribuan  = number_string.substr(sisa).match(/\d{3}/g);
    
  if (ribuan) {
    separator = sisa ? ',' : '';
    rupiah += separator + ribuan.join(',');
  }
  rupiah = "Rp. "+ rupiah;
  return rupiah;
}

</script>