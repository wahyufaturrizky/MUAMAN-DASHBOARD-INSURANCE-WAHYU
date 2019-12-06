 <div id="js"> 
 <script>

$('.datepicker').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true
          });
datatablepaging();

$('#submit').submit(function(e){
    e.preventDefault(); 
    $.ajax({
         url:'<?php site_url(); ?>polisinduk/uploaddata',
         type:"POST",
         data:new FormData(this),
         processData:false,
         contentType:false,
         cache:false,
         async:false,
          success: function(data){
            if(parseInt(data) > 0){
            	$("#modalupload").modal("hide");
            	$("#contentmodalsuccess").html("<h5>Data berhasil disimpan</h5>");
    			$("#modalsuccess").modal("show");
    			$('#submit')[0].reset();
    			datatablepaging();
    		}else{
    			$("#contentmodalerror").html("<h5>Data gagal disimpan </h5>");
    			$("#modalerror").modal("show");
    		}
       },
    });
});

$(document).on('click', '#new', function() {
	if( $("#asuransi").val()=="-" || $("#produk_id").val()=="-" || $("#client").val()=="-" ){
		$("#contentmodalwarning").html("<h5>Klien, Asuransi, dan Produk harus dipilih dahulu</h5>");
    	$("#modalwarning").modal("show");
 	}else{
 		$("#modalasuransi").val($("#asuransi").val());
		$("#modalproduk").val($("#produk_id").val());
		$("#modalclient").val($("#client").val());
    $("#id_polis").prop("readOnly",false);
    $('#filename').val('');
    $('#submit')[0].reset();
	 	$("#modalupload").modal("show");
 	}
});


$(document).on('change', '#asuransi', function() {
  $.ajax({
	  url :"<?php echo site_url();?>setup/polisinduk/getprodukasuransi",
	  type:"POST",
	  data:{
	    asuransi  : $(this).val(),
	    },
	  success: function(result){
	    $("#produk_id").html(result);
	    datatablepaging();
	  },  
  });
});

$(document).on('change', '#client', function() {
	$("#asuransi").val("-");
	$("#produk_id").val("-");
	datatablepaging();
});

$(document).on('change', '#produk_id', function() {
	datatablepaging();
});

$(document).on('keyup', '#contain', function() {
  datatablepaging();
});


function datatablepaging() {

     $.ajax({
          url :"<?php echo site_url();?>setup/polisinduk/paging?asuransi="+$('#asuransi').val()+"&produk="+$('#produk_id').val()+"&search="+$('#contain').val()+"&nasabahid="+$('#client').val(),
          type:"POST",
          data:{
            },
          success: function(result){
          // if(result== '0'){
          // 	$('#new').prop('disabled', false);
          // }
          // else{
          // 	$('#new').prop('disabled', true);	
          // }
          
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
        "sScrollXInner": "180%" ,
        "searching" :false, 
        "ajax": "<?php echo site_url()?>setup/polisinduk/ajax_data/?asuransi="+$('#asuransi').val()+"&produk="+$('#produk_id').val()+"&page="+i+"&search="+$('#contain').val()+"&nasabahid="+$('#client').val()
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



function deleteform(idform,filename) {
	$.ajax({
	  	url :"<?php echo site_url();?>setup/polisinduk/delete",
	  	type:"POST",
	  	data:{
	  		id : idform,
	  		filename : filename
	    },
	  	success: function(result){
	  		$("#contentmodalsuccess").html("<h5>Hapus Polis Induk Berhasil</h5>");
	  		$("#modalsuccess").modal("show");
	  		datatablepaging();
           	
	  	},
	  	error:function error(){ 
	        $("#contentmodalerror").html("<h5>Polis Induk gagal di hapus</h5>");
	        $("#modalerror").modal("show");
      }  
  	});
}

</script>
</div>