<script type="text/javascript">

$('#submittable').submit(function(e){
    e.preventDefault(); 
    $.ajax({
         url:'<?php site_url(); ?>formula/uploaddata',
         type:"POST",
         data:new FormData(this),
         processData:false,
         contentType:false,
         cache:false,
         async:false,
          success: function(data){
          if(parseInt(data) > 0){
            $("#modalupload").modal("hide");
            $("#contentmodalsuccess").html("<h5>Import Data Berhasil</h5>");
            $("#modalsuccess").modal("show");
            $('#submittable')[0].reset();
            datatablepaging();
          }else{
            $("#contentmodalerror").html("<h5>Import Data Gagal. Periksa kembali tipe file yang di upload</h5>");
            $("#modalerror").modal("show");
          }
       },
    });
});

$(document).on('click', '#savetable', function() {
  $.ajax({
    url :"<?php echo site_url();?>setup/formula/savetable",
    type:"POST",
    data:{
      produk      : $("#produk_id").val(),
      client      : $("#client").val(),
      asuransi    : $("#asuransi").val(),
      polisid     : $("#polis_id").val(),
      tablename   : $("#tblname").val(),
      rowname     : $("#rowname").val(),
      columnname  : $("#headername").val()
      },
       success: function(result){
        $("#contentmodalsuccess").html("<h5>Table berhasil di simpan</h5>");
        $("#modalsuccess").modal("show");
        datatablepaging();
            
      },
      error:function error(){ 
          $("#contentmodalerror").html("<h5>Table gagal di simpan</h5>");
          $("#modalerror").modal("show");
      },    
  });
}); 


function tableheader(column,row,tablename) {
  $("#tblnametable").html(tablename);
  $("#columntable").html(column);
  $("#rowtable").html(row); 
}


function downloadcsv(column,row,tablename){
  location.href= "<?php echo site_url()?>setup/formula/downloadcsv?column="+column+"&row="+row+"&tablename="+tablename;
}

function datatablepagingtable(tableid) {

     $.ajax({
          url :"<?php echo site_url();?>setup/formula/pagingtable?tableid="+tableid,
          type:"POST",
          data:{
            },
          success: function(result){
          
          $('#pagingtable').html(result);

          var page = parseInt($('#countpagetable').val());
              for (let i = 1; i <=page; i++) {
                $('.pagetable'+i).click(function() {
                  $('#pagenumbertable').html('PAGE '+i);
                  datatableviewtable(i,tableid);
                })
              } 
            },
      });
      var x ='';
      datatableviewtable(x,tableid);
}

function datatableviewtable(i,tableid) {
      $('#example1-table').dataTable({ 
        "scrollX": true,
        "paging": false,
        "info" : false,
        "bDestroy" : true,
        //"sScrollXInner": "100%" ,
        "searching" :false, 
        "ajax": "<?php echo site_url()?>setup/formula/ajax_datatable/?tableid="+tableid
      });

}

</script>
