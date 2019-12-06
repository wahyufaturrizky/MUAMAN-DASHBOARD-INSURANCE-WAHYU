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
      result = messageblank+messageemail+messagetelp+cekblank;
    }

    return result;
}

$(document).on('keyup', '#containasset', function() {
    datatablepagingasset();
});

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
          url :"<?php echo site_url();?>polis/kendaraan/pagingasset?search="+$('#containasset').val(),
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
        "ajax": "<?php echo site_url()?>polis/kendaraan/ajax_data_asset/?page="+i+"&search="+$('#containasset').val()
      });
      
      var data = null;
      var tableasset = $('#example2').DataTable();

      $('#example2 tbody').on('click', '#chooseasset', function () {
        data = tableasset.row( $(this).parents('tr') ).data();

        $("#namanasabah").val(data[0]);
        $("#nama").val(data[1]);
        $("#address").val(data[2]);
        $("#tsi").val(data[3]);
        $("#idnasabah").val(data[6]);
        $("#idassets").val(data[5]); 
        $("#modalasset").modal("hide");
      });
}

</script>