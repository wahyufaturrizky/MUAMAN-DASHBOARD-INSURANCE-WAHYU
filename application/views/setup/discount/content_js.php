 <div id="js"> 
 <script>


datatablepaging();

$(document).on('click', '#save', function() {
    $.ajax({
      url :"<?php echo site_url();?>setup/discount/save",
      type:"POST",
      data:{
        discountby    : $("#discountby").val(),
        discounttype  : $("#discounttype").val(),
        discountrate  : $("#discountrate").val(),
        discountamount: $("#discountamount").val(),
        },
      success: function(result){
        $("#contentmodalsuccess").html("<h5>Discount Berhasil disimpan</h5>");
        $("#modalsuccess").modal("show");
        $('#form_input')[0].reset();
        $("#modalform").modal("hide");
        datatablepaging();
            
      },
      error:function error(){ 
          $("#contentmodalerror").html("<h5>Discount gagal di simpan</h5>");
          $("#modalerror").modal("show");
      }  
    });
});

$(document).on('click', '#update', function() {

    $.ajax({
      url :"<?php echo site_url();?>setup/discount/update",
      type:"POST",
      data:{
        discountby    : $("#discountby").val(),
        discounttype  : $("#discounttype").val(),
        discountrate  : $("#discountrate").val(),
        discountamount: $("#discountamount").val(),
        id            : $("#discountid").val()
        },
      success: function(result){
        $("#contentmodalsuccess").html("<h5>Discount Berhasil disimpan</h5>");
        $("#modalsuccess").modal("show");
        $('#form_input')[0].reset();
        $('#formfield').html('');
         $("#modalform").modal("hide");
        datatablepaging();
            
      },
      error:function error(){ 
          $("#contentmodalerror").html("<h5>Discount gagal di simpan</h5>");
          $("#modalerror").modal("show");
      }  
    });
});

$(document).on('click', '#new', function() {

    $("#save").show();
    $("#update").hide();
	 	$("#modalform").modal("show");
 	
});



function datatablepaging() {

     $.ajax({
          url :"<?php echo site_url();?>setup/discount/paging?search="+$('#contain').val(),
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
        //"sScrollXInner": "100%" ,
        "searching" :false, 
        "ajax": "<?php echo site_url()?>setup/discount/ajax_data/?search="+$('#contain').val()
      });

}



function deletediscount(id) {
	$.ajax({
	  	url :"<?php echo site_url();?>setup/discount/delete",
	  	type:"POST",
	  	data:{
	  		id : id,
	    },
	  	success: function(result){
	  		$("#contentmodalsuccess").html("<h5>Hapus Discount Berhasil</h5>");
	  		$("#modalsuccess").modal("show");
	  		datatablepaging();
           	
	  	},
	  	error:function error(){ 
	        $("#contentmodalerror").html("<h5>Discount gagal di hapus</h5>");
	        $("#modalerror").modal("show");
      }  
  	});
}


  function edit(discountby,discounttype,discountrate,discountamount,id) {
    $("#discountby").val(discountby)
    $("#discounttype").val(discounttype)
    $("#discountrate").val(discountrate)
    $("#discountamount").val(discountamount)
    $("#discountid").val(id)
    $("#update").show();
    $("#save").hide();
    $("#modalform").modal("show");

  }


</script>
</div>