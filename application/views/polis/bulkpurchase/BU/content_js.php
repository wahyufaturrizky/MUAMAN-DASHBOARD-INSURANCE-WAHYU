 <div id="js"> 
 <script>


 	 $('#submit').submit(function(e){
 	 	$("#importprogress").show();
        e.preventDefault(); 
	    $.ajax({
	         url:'<?php site_url(); ?>bulkpurchase/uploaddata',
	         type:"POST",
	         data:new FormData(this),
	         processData:false,
	         contentType:false,
	         cache:false,
	         async:true,
	          success: function(data){
	          	$("#importprogress").hide();
	           // $("#modalupload").modal("hide");
	            //$("#contentmodalsuccess").html("<h5>Import Data Berhasil</h5>");
        		//$("#modalsuccess").modal("show");
        		if(parseInt(data) > 0){
            		$("#modalupload").modal("hide");
            		$("#contentmodalsuccess").html("<h5>Upload Data Berhasil</h5>");
    				$("#modalsuccess").modal("show");
    				$("#importprogress").hide();
    				$('#submit')[0].reset();
    				datatablepaging0();
	    		}else{
	    			$("#contentmodalerror").html("<h5>Upload Data Gagal. Periksa kembali tipe file yang di upload</h5>");
	    			$("#modalerror").modal("show");
	    		}
	       }
	    });
    });

	$("#sertifikat").submit(function(e){
		$("#s_importprogress").show();
        e.preventDefault(); 
	    $.ajax({
	         url:'<?php site_url(); ?>bulkpurchase/uploadsertified',
	         type:"POST",
	         data:new FormData(this),
	         processData:false,
	         contentType:false,
	         cache:false,
	         async:false,
	          success: function(data){
	          	if(isNaN(data)=== true){
	          		$("#contentmodalerror").html("<h5>Upload Dokumen Gagal</h5>");
    				$("#modalerror").modal("show");
	          	}
	          	else{
	            	$("#modalsertifikat").modal("hide");
	            	$("#s_importprogress").hide();
	            	$("#contentmodalsuccess").html("<h5>Upload Dokumen Berhasil</h5>");
        			$("#modalsuccess").modal("show");
        			datatablepaging0();
	       		}
	       }
	    });
    });

 	 //datatablepaging0();
		
	$(document).on('change', '#asuransi', function() {
		$("#modalasuransi").val($(this).val());
	  	$.ajax({
		  url :"<?php echo site_url();?>polis/bulkpurchase/getprodukasuransi",
		  type:"POST",
		  data:{
		    asuransi  : $(this).val(),
		    },
		  success: function(result){
		    $("#produk_id").html(result);
		    $("#gentable").html('');
		    //datatablepaging();
		  //  	var table = $('#example1').DataTable();
				// table.destroy();
				$('#tbody').html('');
		  },  
	 	});
	});
	
	$('#statuscheck').change(function () {
		$("#selectall").prop("checked", false);
	});

	$("#selectall").change(function () {
		var statussearch = $('#status').val();
		var status = $('#statuscheck').val();
		//alert(status);
		if($(this).is(':checked')) {
	    	$.ajax({
			  url :"<?php echo site_url();?>polis/bulkpurchase/updateflagall",
			  type:"POST",
			  data:{
			    flag : status,
			    where :statussearch,
			    id_purchase : $("#id_purchase").val(),
			    },
			  success: function(result){
			    datatablepaging();
			  },  
			});
		}else{
			$.ajax({
			  url :"<?php echo site_url();?>polis/bulkpurchase/updateflagall",
			  type:"POST",
			  data:{
			    flag : '-',
			    where :statussearch,
			    id_purchase : $("#id_purchase").val(),
			    },
			  success: function(result){
			    //alert('STATUS UPDATE : '+ status);
			    datatablepaging();
			  },  
			});
		}
		
	});


	$(document).on('click', '#new', function() {
		if($('#usergroup').val() == '8' || $('#usergroup').val() =='1' ){
			if($('#produk_id').val()=='-'|| $('#asuransi').val()=='-'){
				$("#contentmodalwarning").html('Pilih Asuransi beserta produk dahulu sebelum upload data');
	   	 		$("#modalwarning").modal("show");	
			}else{
				$('#modalupload').modal('show');
				$.ajax({
				  url :"<?php echo site_url();?>polis/bulkpurchase/getpolisid",
				  type:"POST",
				  data:{
				  	asuransi	: $("#asuransi").val(),
				    produk_id  	: $("#produk_id").val(),
				    },
			  		success: function(result){
					  	$("#polisinduk").html(result);
					    //$("#controldata").show();
					    //datatablepaging();
			  		},  
		 		});
			}
		}else{
			$("#contentmodalwarning").html('Upload Bulk Purchase dilakukan oleh user Nasabah');
	   	 	$("#modalwarning").modal("show");
			//alert('Upload Bulk Purchase dilakukan oleh user Nasabah');
		}
	});

	$(document).on('change', '#produk_id', function() {
		$("#modalproduk").val($(this).val());
		//$("#status").val('-');
		// var table = $('#example1').DataTable();
		// table.destroy();
		$("#title").html("POLIS "+$("#produk_id  option:selected").text()+" "+$("#asuransi  option:selected").text());
		$('tbody').html('');
		datatablepaging0();
		$.ajax({
			  url :"<?php echo site_url();?>polis/bulkpurchase/getheader",
			  type:"POST",
			  data:{
			  	asuransi	: $("#asuransi").val(),
			    produk_id  	: $("#produk_id").val(),
			    },
			  success: function(result){
			  	$("#gentable").html(result);
			    $("#controldata").show();
			    //datatablepaging();
			  },  
		});
	});

	$(document).on('change', '#status', function() {
		// var table = $('#example1').DataTable();
		// table.destroy();
		//$('tbody').html('');
		datatablepaging();

	});

	$(document).on('click', '#save', function() {
		//$("#modalproduk").val($(this).val());
		$("#contentmodalwarning").html('<div>Data sedang diperbaharui, harap menunggu ...</div><div class="progress active"><div id = "bar" class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>');
        $("#modalwarning").modal("show");
		$.ajax({
		  url :"<?php echo site_url();?>polis/bulkpurchase/updatestatusflag",
		  type:"POST",
		  data:{
		  		id_purchase : $("#id_purchase").val(),
		    },
		  success: function(result){
		  	$("#modalwarning").modal("hide");
		  	$("#contentmodalsuccess").html("<h5>Data sudah di simpan</h5>");
        	$("#modalsuccess").modal("show");
		    datatablepaging();
		  },
		  error:function error(){ 
		  	$("#modalwarning").modal("hide");
        	$("#contentmodalerror").html("<h5>Data gagal di simpan</h5>");
        	$("#modalerror").modal("show");
      	  }   
	  });
	});

	$(document).on('click', '#download', function() {
		var field_caption = $("#headercsv").val();
		var field_example = $("#examplecsv").val();
		location.href = "<?php echo site_url();?>polis/bulkpurchase/downloadcsv?header="+field_caption+"&example="+field_example+"&asuransi="+$("#asuransi  option:selected").text()+"&produk="+$("#produk_id  option:selected").text();
	});



function datatablepaging() {

     $.ajax({
          url :"<?php echo site_url();?>polis/bulkpurchase/paging?status="+$('#status').val()+"&asuransi="+$('#asuransi').val()+"&produk="+$('#produk_id').val()+"&search="+$('#contain').val()+"&id_purchase="+$('#id_purchase').val(),
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
        "ajax": "<?php echo site_url()?>polis/bulkpurchase/ajax_data/?status="+$('#status').val()+"&asuransi="+$('#asuransi').val()+"&produk="+$('#produk_id').val()+"&page="+i+"&search="+$('#contain').val()+"&id_purchase="+$('#id_purchase').val(),
      });
      
}

function datatablepaging0() {

     $.ajax({
          url :"<?php echo site_url();?>polis/bulkpurchase/paging0?asuransi="+$('#asuransi').val()+"&produk="+$('#produk_id').val()+"&search="+$('#contain0').val(),
          type:"POST",
          data:{
            },
          success: function(result){
          
          $('#paging0').html(result);

          var page = parseInt($('#countpage0').val());
              for (let i = 1; i <=page; i++) {
                $('.page0'+i).click(function() {
                  $('#pagenumber0').html('PAGE '+i);
                  datatableview0(i);
                })
              } 
            },
      });
      var x ='';
      datatableview0(x);
}

function datatableview0(i) {
      $('#example0').dataTable({ 
        "scrollX": true,
        "paging": false,
        "info" : false,
        "bDestroy" : true,
        //"sScrollXInner": "100%" ,
        "searching" :false, 
        "ajax": "<?php echo site_url()?>polis/bulkpurchase/ajax_data0/?asuransi="+$('#asuransi').val()+"&produk="+$('#produk_id').val()+"&page="+i+"&search="+$('#contain0').val()
      });
      
}



function viewform(data,header) {
	// alert(data);
	// alert(header);
	var data = data.split("|");
	var header = header.split("|");
	var content = '';
	for (var i = 0; i < header.length; i++) {
		content = content + 
			'<div class="row form-group">'+
				'<div class="col-sm-6">'+
					'<label>'+header[i]+'</label>'+
				'</div>'+
				'<div class="col-sm-6">'+
					'<input value="'+data[i]+'" class="form-control" type = "text" readonly>'+
				'</div>'+
			'</div>';
	}
	$("#contentviewform").html(content);
	$("#modalform").modal("show");
}

function checkedchoice(value,id) {
		$.ajax({
			  url :"<?php echo site_url();?>polis/bulkpurchase/updateflag",
			  type:"POST",
			  data:{
			    flag : value,
			    id :id,
			    },
			  success: function(result){
			    //alert('STATUS UPDATE : '+ value);
			    //datatablepaging();
			  },  
		});
}

function addformtype(value,id) {
		$.ajax({
			  url :"<?php echo site_url();?>polis/bulkpurchase/addformtype",
			  type:"POST",
			  data:{
			    addform : value,
			    id :id,
			    },
			  success: function(result){
			    //alert('STATUS UPDATE : '+ value);
			    //datatablepaging();
			  },  
		});
}

function opendetaildata(id_purchase) {
	$("#id_purchase").val(id_purchase);
	$("#purchasenumber").html(id_purchase);
	datatablepaging();
	$("#requesttbl").fadeOut('fast');
	$("#membertbl").fadeIn('slow');
}
$(document).on('click', '#closemember', function() {
	$("#requesttbl").fadeIn('slow');
	$("#membertbl").fadeOut('fast');	
});

</script>
</div>