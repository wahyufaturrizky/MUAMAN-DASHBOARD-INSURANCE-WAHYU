 <div id="js"> 
 <script>


datatablepaging();

$(document).on('change', '#produk_id', function() {
  datatablepaging();
});


$(document).on('change', '#type', function() {
    if( $(this).val() =='LOV'||$(this).val() =='CHECK'){
        $("#divlov").slideDown('fast');
    }else{
        $("#divlov").slideUp('fast');
    }
});

$(document).on('click', '#new', function() {
  if($("#produk_id").val()!='-'){
    $("#divlov").slideUp('fast');
    $("#form_input")[0].reset();
    $("#id_field").prop('readonly', false);
    $("#update").hide();
    $("#save").show();
    $("#modalform").modal("show");
  }
  else{
    $("#contentmodalwarning").html('Pilih Produk yang akan di setup dahulu');
    $("#modalwarning").modal("show");
  }
});

$(document).on('keyup', '#contain', function() {
  datatablepaging();
});


$(document).on('click', '#save', function() {
  $.ajax({
      url :"<?php echo site_url();?>setup/setupfield/save",
      type:"POST",
      data:{
        id_produk : $("#produk_id").val(),
        id_field  : $("#id_field").val(),
        caption   : $("#caption").val(),
        type      : $("#type").val(),
        ex        : $("#exvalue").val(),
        lov       : $("#lov").val(),
        },
      success: function(result){
        if(result =='0'){
         //$("#modalform").modal("hide");
          $("#contentmodalwarning").html("<h5>ID Field Sudah digunakan pada produk asuransi ini</h5>");
          $("#modalwarning").modal("show");
        }else{
          datatablepaging();
          $("#modalform").modal("hide");
          $("#contentmodalsuccess").html("<h5>Data sudah di simpan</h5>");
          $("#modalsuccess").modal("show");
        }
      },
      error:function error(){ 
        $("#contentmodalerror").html("<h5>Data gagal di simpan</h5>");
        $("#modalerror").modal("show");
                            }     
  });
});

$(document).on('click', '#update', function() {
  $.ajax({
      url :"<?php echo site_url();?>setup/setupfield/update",
      type:"POST",
      data:{
        id_produk : $("#produk_id").val(),
        id_field  : $("#id_field").val(),
        caption   : $("#caption").val(),
        type      : $("#type").val(),
        ex        : $("#exvalue").val(),
        lov       : $("#lov").val(),
        },
      success: function(result){
        datatablepaging();
        $("#modalform").modal("hide");
        $("#contentmodalsuccess").html("<h5>Data sudah di simpan</h5>");
        $("#modalsuccess").modal("show");
      },
      error:function error(){ 
        $("#contentmodalerror").html("<h5>Data gagal di simpan</h5>");
        $("#modalerror").modal("show");
                            }     
  });
});

$(document).on('click', '#dodelete', function() {
  $.ajax({
      url :"<?php echo site_url();?>setup/setupfield/delete",
      type:"POST",
      data:{
        id_produk : $("#produk_id").val(),
        id_field  : $("#deleteidfield").val(),
        },
      success: function(result){
        datatablepaging();
        $("#modalwarning").modal("hide");
        $("#contentmodalsuccess").html("<h5>Data sudah di hapus</h5>");
        $("#modalsuccess").modal("show");
      },
      error:function error(){ 
        $("#contentmodalerror").html("<h5>Data gagal di hapus</h5>");
        $("#modalerror").modal("show");
                            }     
  });
});
function datatablepaging() {

     $.ajax({
          url :"<?php echo site_url();?>setup/setupfield/paging?produk="+$('#produk_id').val()+"&search="+$('#contain').val(),
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
        "ajax": "<?php echo site_url()?>setup/setupfield/ajax_data/?produk="+$('#produk_id').val()+"&page="+i+"&search="+$('#contain').val()
      });
      
      // var data = null;
      // var table = $('#example1').DataTable();
      // $('#example1 tbody').on('click', '#delete', function () {
      //   data = table.row( $(this).parents('tr') ).data();
      //     $("#deleteid").val(data[3]);
      //     $("#deletename").html(data[0]); 
      //     $("#modalconfirm").modal("show"); 
      // });


      // $('#example1 tbody').on('click', '#edit', function () {
      //   data = table.row( $(this).parents('tr') ).data();

      //   $('#field_id').val(data[0]);

      //   $("#update").show();
      //   $("#save").hide();
      //   $("#modalform").modal("show");
      // });

}

function editfield(id_field,caption,type,ex,lov) {
  $("#id_field").val(id_field);
  $("#caption").val(caption);
  $("#type").val(type);
  $("#exvalue").val(ex);
  if(lov!=''){
    $("#divlov").slideDown('fast');
    $("#lov").val(lov);
  }
  else{
    $("#divlov").slideUp('fast');
    $("#lov").val(''); 
  }
  $("#id_field").prop('readonly', true);
  $("#update").show();
  $("#save").hide();
  $("#modalform").modal("show");
}

function deletefield(id_produk,id_field) {
  $("#contentmodaldelete").html('Apakah Anda yakin menghapus id_field :'+ id_field+' ?');
  $("#deleteidfield").val(id_field);
  $("#modaldelete").modal("show");
}



</script>
</div>