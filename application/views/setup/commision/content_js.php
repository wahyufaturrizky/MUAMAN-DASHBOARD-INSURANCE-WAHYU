 <div id="js"> 
 <script>


datatablepaging();

$(document).on('click', '#save', function() {
    $.ajax({
      url :"<?php echo site_url();?>setup/commision/save",
      type:"POST",
      data:{
        thirdpartyid         : $("#thirdpartyid").val(),
        commisioncategory    : $("#commisioncategory").val(),
        commisiontype        : $("#commisiontype").val(),
        commisionrate        : $("#commisionrate").val(),
        commisionamount      : $("#commisionamount").val(),
        },
      success: function(result){
        $("#contentmodalsuccess").html("<h5>commision Berhasil disimpan</h5>");
        $("#modalsuccess").modal("show");
        $('#form_input')[0].reset();
        $("#modalform").modal("hide");
        datatablepaging();
            
      },
      error:function error(){ 
          $("#contentmodalerror").html("<h5>commision gagal di simpan</h5>");
          $("#modalerror").modal("show");
      }  
    });
});

$(document).on('click', '#update', function() {

    $.ajax({
      url :"<?php echo site_url();?>setup/commision/update",
      type:"POST",
      data:{
        thirdpartyid         : $("#thirdpartyid").val(),
        commisioncategory    : $("#commisioncategory").val(),
        commisiontype        : $("#commisiontype").val(),
        commisionrate        : $("#commisionrate").val(),
        commisionamount      : $("#commisionamount").val(),
        id            : $("#commisionid").val()
        },
      success: function(result){
        $("#contentmodalsuccess").html("<h5>commision Berhasil disimpan</h5>");
        $("#modalsuccess").modal("show");
        $('#form_input')[0].reset();
        $('#formfield').html('');
         $("#modalform").modal("hide");
        datatablepaging();
            
      },
      error:function error(){ 
          $("#contentmodalerror").html("<h5>commision gagal di simpan</h5>");
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
          url :"<?php echo site_url();?>setup/commision/paging?search="+$('#contain').val(),
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
        "ajax": "<?php echo site_url()?>setup/commision/ajax_data/?search="+$('#contain').val()
      });

}



function deletecommision(id) {
	$.ajax({
	  	url :"<?php echo site_url();?>setup/commision/delete",
	  	type:"POST",
	  	data:{
	  		id : id,
	    },
	  	success: function(result){
	  		$("#contentmodalsuccess").html("<h5>Hapus commision Berhasil</h5>");
	  		$("#modalsuccess").modal("show");
	  		datatablepaging();
           	
	  	},
	  	error:function error(){ 
	        $("#contentmodalerror").html("<h5>commision gagal di hapus</h5>");
	        $("#modalerror").modal("show");
      }  
  	});
}


  function edit(commisioncategory,commisiontype,commisionrate,commisionamount,id,thirdpartyid) {
    $("#thirdpartyid").val(thirdpartyid)
    $("#commisioncategory").val(commisioncategory)
    $("#commisiontype").val(commisiontype)
    $("#commisionrate").val(commisionrate)
    $("#commisionamount").val(commisionamount)
    $("#commisionid").val(id)
    $("#update").show();
    $("#save").hide();
    $("#modalform").modal("show");

  }


</script>
</div>