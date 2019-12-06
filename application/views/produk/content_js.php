 <div id="js"> 
 <script>
$(function () {
     
      $('#update').hide();
      $('#update_user').hide();
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
      });

      datatablepaging();
    
});

$('#refresh').click(function() {
  $('#contain').val('');
  datatablepaging();
});


$('#save').click(function() {
  var validation = isvalid();
  if(validation != 'VALID'){
    $("#contentmodalwarning").html("Maaf Ada kesalahan dalam data yang anda input sebagai berikut :<ul>"+validation+"</ul>");
    $("#modalwarning").modal("show");
  }else{
       $.ajax({
          url :"<?php echo site_url();?>registrasi/produk/save",
          type:"POST",
          data:{
        		nama    :$("#nama").val()
            },
          success: function(html){
               $('#contain').val($("#nama").val());
               datatablepaging(); 
               $("#forminput")[0].reset();
               $("#modalform").modal("hide");
               $("#contentmodalsuccess").html("<h5>Data baru berhasil disimpan</h5>");
               $("#modalsuccess").modal("show");
                   },
          error:function error(){
              $("#contentmodalerror").html("<h5>Data baru gagal disimpan</h5>");
              $("#modalerror").modal("show");
                            }                  
        });
  } 
});

$('#new').click(function() {
  $("#modalform").modal("show");
});

$('#uploadproduk').click(function() {
  $("#modalupload").modal("show");
});

$('#close').click(function() {
  $("#update").hide();
  $("#save").show();
  $("#forminput")[0].reset();
});

$('#update').click(function() {
  var validation = isvalid();
  if(validation != 'VALID'){
    $("#contentmodalwarning").html("Maaf Ada kesalahan dalam data yang anda input sebagai berikut :<ul>"+validation+"</ul>");
    $("#modalwarning").modal("show");
  }else{
        $.ajax({
          url :"<?php echo site_url();?>registrasi/produk/update",
          type:"POST",
          data:{
            nama    :$("#nama").val(),
            id      :$("#id").val(),
            },
          success: function(html){               
               $('#contain').val($("#nama").val());
               datatablepaging();
               $("#forminput")[0].reset();
               $("#update").hide();
               $("#save").show();
               $("#modalform").modal("hide");
               $("#contentmodalsuccess").html("<h5>Data baru berhasil diperbaharui</h5>");
               $("#modalsuccess").modal("show");
                   },
          error:function error(){ 
                $("#contentmodalerror").html("<h5>Data baru gagal diperbaharui</h5>");
                $("#modalerror").modal("show");
                            }                  
        });
  }
});


$('#dodelete').click(function() {
   $.ajax({
      url :"<?php echo site_url();?>registrasi/produk/delete",
      type:"POST",
      data:{
      id : $('#deleteid').val(),
      },
      success:function(){
      $("#contentmodalsuccess").html("<h5>Data berhasil dihapus</h5>");
      $("#modalsuccess").modal("show");
      datatablepaging();  
      },
    });   
});

$('#close_user').click(function() {
  $("#form_user")[0].reset();
});

$(document).on('keyup', '#contain', function() {
    datatablepaging();
});


function datatablepaging() {

     $.ajax({
          url :"<?php echo site_url();?>registrasi/produk/paging?search="+$('#contain').val(),
          type:"POST",
          data:{
            },
          success: function(result){
          
          $('#paging').html(result);

          var page = parseInt($('#countpage').val());
              for (let i = 1; i <=page; i++) {
                $('.page'+i).click(function() {
                  $('#pagenumber').html('PAGE '+i);
                  datatableview(i);
                })
              } 
            },
      });
      var x ='';
      datatableview(x);
}

function datatableview(i) {
      $('#example1').dataTable({ 
        "scrollX": true,
        "paging": false,
        "info" : false,
        "bDestroy" : true,
        "sScrollXInner": "100%" ,
        "searching" :false, 
        "ajax": "<?php echo site_url()?>registrasi/produk/ajax_data/?page="+i+"&search="+$('#contain').val()
      });
      
      var data = null;
      var table = $('#example1').DataTable();
      $('#example1 tbody').on('click', '#delete', function () {
        data = table.row( $(this).parents('tr') ).data();
          $("#deleteid").val(data[3]);
          $("#deletename").html(data[0]); 
          $("#modalconfirm").modal("show"); 
      });


      $('#example1 tbody').on('click', '#edit', function () {
        data = table.row( $(this).parents('tr') ).data();
        $("#update").show();
        $("#save").hide();

        $("#nama").val(data[0]);
        $("#id").val(data[3]); 
        $("#modalform").modal("show");
      });

}

function isvalid() {
    //cek if blank
    var result = 'VALID';
    var cekblank =0;
    var messageblank = '';
    $('.entries').each(function() {
      if ($(this).val()==''){
        cekblank++;
      }
    });
    if (cekblank > 0){
      messageblank = '<li>mohon isi semua keterangan pada form</li>';
    }

    if(messageblank!= ''){
      result = messageblank;
    }

    return result;
}
 </script>
 </div>