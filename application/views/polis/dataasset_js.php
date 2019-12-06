<script>
$('#saveassets').click(function() {

});

function isvalid() {
    //cek if blank
    var result = 'VALID';
    var cekblank =0;
    var messageblank = '';
    $('.entries2').each(function() {
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



$('#dataassets').click(function() {
  $("#modalasset").modal("show");
  var contain = $("#namanasabah").val();
  $("#containasset").val(contain);
  setTimeout(function() {
    datatablepagingasset();  
  },200)
});

function datatablepagingasset() {

     $.ajax({
          url :"<?php echo site_url();?>polis/polis/pagingasset?search="+$('#containasset').val(),
          type:"POST",
          data:{
            },
          success: function(result){
          
          $('#pagingasset').html(result);

          var page = parseInt($('#countpageasset').val());
              for (let i = 1; i <=page; i++) {
                $('.pageasset'+i).click(function() {
                  $('#pagenumberasset').html('PAGE '+i);
                  datatableviewasset(i);
                })
              } 
            },
      });
      var x ='';
      datatableviewasset(x);
}

function datatableviewasset(i) {
     
      $('#example2').dataTable({ 
        "scrollX": true,
        "paging": false,
        "info" : false,
        "bDestroy" : true,
        "sScrollXInner": "100%" ,
        "searching" :false, 
        "ajax": "<?php echo site_url()?>polis/polis/ajax_data_asset/?page="+i+"&search="+$('#containasset').val()
      });
      
      var data = null;
      var tableasset = $('#example2').DataTable();

      $('#example2 tbody').on('click', '#chooseasset', function () {
        data = tableasset.row( $(this).parents('tr') ).data();

        $("#namanasabah").val(data[0]);
        $("#nama").val(data[1]);
        $("#address").val(data[2]);
        $("#idnasabah").val(data[5]);
        $("#idassets").val(data[6]); 
        $("#modalasset").modal("hide");
        $("#tsi").val(formatcurrency(data[3].replace( /\D+/g, '')));
      });
}


function datatablepagingassetreq() {

     $.ajax({
          url :"<?php echo site_url();?>polis/polis/pagingassetreq?search="+$('#containassetreq').val(),
          type:"POST",
          data:{
            },
          success: function(result){
          
          $('#pagingassetreq').html(result);

          var page = parseInt($('#countpageassetreq').val());
              for (let i = 1; i <=page; i++) {
                $('.pageassetreq'+i).click(function() {
                  $('#pagenumberassetreq').html('PAGE '+i);
                  datatableviewassetreq(i);
                })
              } 
            },
      });
      var x ='';
      datatableviewassetreq(x);
}

function datatableviewassetreq(i) {
     
      $('#example4').dataTable({ 
        "scrollX": true,
        "paging": false,
        "info" : false,
        "bDestroy" : true,
        "sScrollXInner": "100%" ,
        "searching" :false, 
        "ajax": "<?php echo site_url()?>polis/polis/ajax_data_assetreq/?page="+i+"&search="+$('#containassetreq').val()
      });
      
      var data = null;
      var tableasset = $('#example4').DataTable();

      $('#example4 tbody').on('click', '#chooseasset', function () {
        data = tableasset.row( $(this).parents('tr') ).data();

        $("#namanasabah").val(data[0]);
        $("#nama").val(data[1]);
        $("#address").val(data[2]);
        $("#idnasabah").val(data[5]);
        $("#idassets").val(data[6]); 
        $("#polissaved").fadeOut('fast');
        $("#form_all").fadeIn('fast');
        $("#tsi").val(formatcurrency(data[3]));
      });
}

$(document).on('keyup', '#tsi', function() {
  angka = $(this).val();
  rupiahnum = angka.replace( /\D+/g, '');
  rupiah = formatcurrency(rupiahnum);
  $(this).val(rupiah);
});


</script>