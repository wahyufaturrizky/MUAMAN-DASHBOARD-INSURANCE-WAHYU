 <div id="js"> 
 <script>


datatablepaging();


$(document).on('click', '#new', function() {
  if($("#produk_id").val()=='-' || $("#asuransi").val()=='-' ){
    $("#contentmodalwarning").html('Pilih Asuransi beserta Produknya yang akan di setup dahulu');
    $("#modalwarning").modal("show");
    //$("#divlov").slideUp('fast');
    //$("#form_input")[0].reset();
    //$("#id_field").prop('readonly', false);
    
  }
  else{
  	$("#fieldadded").html('<option value="-">FIELD ID</option>');
    $("#update").hide();
    $("#save").show();
    $("#modalform").modal("show");
    $("#formfield").html('');
    $.ajax({
		  url :"<?php echo site_url();?>setup/formasuransi/getfieldlist",
		  type:"POST",
		  data:{
		    produk : $("#produk_id").val()
		    },
		  success: function(result){
		  	//datatablepaging();
		    $("#field_list").html(result);
		  },  
	});
	$.ajax({
		  url :"<?php echo site_url();?>setup/formasuransi/getmandatoryfield",
		  type:"POST",
		  data:{
		    // produk : $("#produk_id").val()
		    },
		  success: function(result){
		  	//datatablepaging();
		    $("#formfieldmandatory").html(result);
		  },  
	});
  }
});

$(document).on('click', '#closeformex', function() {
	$("#formshow").slideUp("fast");
	$("#setupform").fadeIn("fast");
	$.ajax({
	  	url :"<?php echo site_url();?>setup/formasuransi/cleartemp",
	  	type:"POST",
	  	data:{
	    },
	  	success: function(result){
	  	},  
  	});
});

$(document).on('click', '#closeformex', function() {
	$("#formshow").slideUp("fast");
	$("#setupform").fadeIn("fast");
});

$(document).on('change', '#insertmethod', function() {
	if($(this).val()!='last'){
		$("#divfieldid").fadeIn("fast");
	}else{
		$("#divfieldid").fadeOut("fast");
	}
});

$(document).on('click', '#addfield', function() {
	if($('#field_list').val()=='-'){
		$("#contentmodalwarning").html('PILIH FIELD YANG AKAN DITAMBAHKAN KE FORM DAHULU');
	    $("#modalwarning").modal("show");
	}
	else if($('#field_list  option:selected').is(':enabled')){ 
	  $("#nofield").remove();
	  var fielddata = $("#field_list").val();
	  var field = fielddata.split("|"); 
	  var field_add_element = '<div class="row form-group" id="'+field[0]+'">'+
	  		'<div class="col-sm-2">'+
	            '<input type="text" class="form-control field_id" value="'+field[0]+'" readonly>'+
	        '</div>'+
	        '<div class="col-sm-9"> '+
	            '<input type="text" class="form-control field_caption" value="'+field[1]+'" readonly>'+
	            '<input type="hidden" class="form-control field_example" value="'+field[2]+'" readonly>'+
	        '</div>'+
	        '<div class="col-sm-1">'+
	        	'<button class="btn btn-flat btn-danger" id="btn-'+field[0]+'"><i class="fa fa-trash"></i></button>'+
	        '</div>'+
	        '<script>'+
	        	'$(document).on("click", "#btn-'+field[0]+'", function() {'+
	        		'$("#'+field[0]+'").remove();'+
	        		'$("#field_list option[value=\''+field[0]+'|'+field[1]+'|'+field[2]+'\']").prop("disabled",false);'+
	        		'$("#fieldadded option[value=\''+field[0]+'\']").remove();'+
	        	'});'+
	        '<\/script></div>';

	  	if($("#insertmethod").val()=='last'){
	  		$("#formfield").append(field_add_element);
	  		$("#fieldadded").append("<option value='"+field[0]+"'>"+field[0]+"</option>");
	  		$("#field_list  option:selected").prop('disabled',true);		
	  	}
	  	else if($("#fieldadded").val()!="-"){
		  	if($("#insertmethod").val()=='after'){
		  		//$("#"+$("#fieldadded").val()).insertAfter(field_add_element);
		  		$(field_add_element).insertAfter("#"+$("#fieldadded").val());
		  		$("#fieldadded").append("<option value='"+field[0]+"'>"+field[0]+"</option>");
		  		$("#field_list  option:selected").prop('disabled',true);		
		  	}
		  	else if($("#insertmethod").val()=='before'){
		  		//$("#"+$("#fieldadded").val()).insertBefore(field_add_element);
		  		$(field_add_element).insertBefore("#"+$("#fieldadded").val());
		  		$("#fieldadded").append("<option value='"+field[0]+"'>"+field[0]+"</option>");
		  		$("#field_list  option:selected").prop('disabled',true);		
		  	}
		}else{
			$("#contentmodalwarning").html('PILIH FIELD ID TERLEBIH DAHULU');
	    	$("#modalwarning").modal("show");
		}
				$('html, body, #formcreate').animate({
        			scrollTop: $("#" + field[0]).offset().top
    			}, 'slow');	
	} 
	else{
		$("#contentmodalwarning").html('FIELD SUDAH DITAMBAHKAN');
	    $("#modalwarning").modal("show");
	}
});


$(document).on('click', '#save', function() {
	var field_id_concat= '';
	var field_caption_concat= '';
	var field_example_concat= '';
	var delimiter1 = '';
	var delimiter2 = '';
	var delimiter3 = '';
	$(".field_id").each(function(){
    	field_id_concat =  field_id_concat+delimiter1+$(this).val();
    	delimiter1 = '|';
  	});

  	$(".field_caption").each(function(){
    	field_caption_concat =  field_caption_concat+delimiter2+$(this).val();
    	delimiter2 = '|';
  	});

  	$(".field_example").each(function(){
    	field_example_concat =  field_example_concat+delimiter3+$(this).val();
    	delimiter3 = '|';
  	});

  	$.ajax({
	  url :"<?php echo site_url();?>setup/formasuransi/save",
	  type:"POST",
	  data:{
	    asuransi  	: $("#asuransi").val(),
	    produk  	: $("#produk_id").val(),
	    field_id_concat : field_id_concat,
	    field_caption_concat : field_caption_concat,	    
	    field_example_concat : field_example_concat,
	   	mandatory_id : $("#mandatory_id").val(),
	    mandatory_caption : $("#mandatory_caption").val(),
	    mandatory_example : $("#mandatory_example").val(),
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

$(document).on('click', '#update', function() {
	var field_id_concat= '';
	var field_caption_concat= '';
	var field_example_concat= '';
	var delimiter1 = '';
	var delimiter2 = '';
	var delimiter3 = '';
	$(".field_id").each(function(){
    	field_id_concat =  field_id_concat+delimiter1+$(this).val();
    	delimiter1 = '|';
  	});

  	$(".field_caption").each(function(){
    	field_caption_concat =  field_caption_concat+delimiter2+$(this).val();
    	delimiter2 = '|';
  	});

  	$(".field_example").each(function(){
    	field_example_concat =  field_example_concat+delimiter3+$(this).val();
    	delimiter3 = '|';
  	});
  	//alert(field_id_concat);
  	$.ajax({
	  url :"<?php echo site_url();?>setup/formasuransi/update",
	  type:"POST",
	  data:{
	    asuransi  	: $("#asuransi").val(),
	    produk  	: $("#produk_id").val(),
	    field_id_concat : field_id_concat,
	    field_caption_concat : field_caption_concat,
	    field_example_concat : field_example_concat,
	    mandatory_id : $("#mandatory_id").val(),
	    mandatory_caption : $("#mandatory_caption").val(),
	    mandatory_example : $("#mandatory_example").val(),
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


$(document).on('change', '#asuransi', function() {
  $.ajax({
	  url :"<?php echo site_url();?>setup/formasuransi/getprodukasuransi",
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

$(document).on('change', '#produk_id', function() {
	datatablepaging();
});

$(document).on('keyup', '#contain', function() {
  datatablepaging();
});


function datatablepaging() {

     $.ajax({
          url :"<?php echo site_url();?>setup/formasuransi/paging?asuransi="+$('#asuransi').val()+"&produk="+$('#produk_id').val()+"&search="+$('#contain').val(),
          type:"POST",
          data:{
            },
          success: function(result){
          if(result== '0'){
          	$('#new').prop('disabled', false);
          }
          else{
          	$('#new').prop('disabled', true);	
          }
          
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
        "ajax": "<?php echo site_url()?>setup/formasuransi/ajax_data/?asuransi="+$('#asuransi').val()+"&produk="+$('#produk_id').val()+"&page="+i+"&search="+$('#contain').val()
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

function editform(field_id_concat,field_caption_concat,field_example_concat) {

	var field_id = field_id_concat.split("|");
	//alert (field_id.length);
	var field_caption = field_caption_concat.split("|");
	var field_example = field_example_concat.split("|");
	//alert (field_id_concat);
	//alert (field_caption_concat);
	var optionfield = '<option value="-">FIELD ID</option>';
	$("#formfield").html('');
	$.ajax({
		  url :"<?php echo site_url();?>setup/formasuransi/getfieldlist",
		  type:"POST",
		  data:{
		    produk : $("#produk_id").val()
		    },
		  success: function(result){
		  	//datatablepaging();
		    $("#field_list").html(result);
		    $("#formfield").html();
		    for(var j = 0, length2 = field_id.length; j < (length2); j++){
			    if(field_id[j]==''){

			    }else{
					$("#field_list option[value='"+field_id[j]+"|"+field_caption[j]+"|"+field_example[j]+"']").prop("disabled",true);
				 	$("#formfield").append(
			  		'<div class="row form-group" id="'+field_id[j]+'">'+
			  		'<div class="col-sm-2">'+
			            '<input type="text" class="form-control field_id" value="'+field_id[j]+'" readonly>'+
			        '</div>'+
			        '<div class="col-sm-9"> '+
			            '<input type="text" class="form-control field_caption" value="'+field_caption[j]+'" readonly>'+
			            '<input type="hidden" class="form-control field_example" value="'+field_example[j]+'" readonly>'+
			        '</div>'+
			        '<div class="col-sm-1">'+
			        	'<button class="btn btn-flat btn-danger" id="btn-'+field_id[j]+'"><i class="fa fa-trash"></i></button>'+
			        '</div>'+
			        '<script>'+
			        	'$(document).on("click", "#btn-'+field_id[j]+'", function() {'+
			        		'$("#'+field_id[j]+'").remove();'+
			        		'$("#field_list option[value=\''+field_id[j]+'|'+field_caption[j]+'|'+field_example[j]+'\']").prop("disabled",false);'+
			        		'$("#fieldadded option[value=\''+field_id[j]+'\']").remove();'+
			        	'});'+
			        '<\/script></div>'
			        );
			        optionfield = optionfield+'<option value ="'+field_id[j]+'">'+field_id[j]+'</option>' ;
				}
			}
			$("#fieldadded").html('');
			$("#fieldadded").html(optionfield);
			$("#update").show();
		    $("#save").hide();
		    $("#modalform").modal("show");
		  },  
	});

	$.ajax({
		  url :"<?php echo site_url();?>setup/formasuransi/getmandatoryfield",
		  type:"POST",
		  data:{
		    // produk : $("#produk_id").val()
		    },
		  success: function(result){
		  	//datatablepaging();
		    $("#formfieldmandatory").html(result);
		  },  
	}); 
}

function openform(field_id_concat,id_form) {
	$.ajax({
	  	url :"<?php echo site_url();?>setup/formasuransi/generatedform",
	  	type:"POST",
	  	data:{
	    	field_id_concat  : field_id_concat,
	    	id_form : id_form,
	    	produk : $("#produk_id").val(),
	    },
	  	success: function(result){
	  		$("#asuransi_name").html($("#asuransi  option:selected").text());
	  		$("#produk_name").html($("#produk_id  option:selected").text());
	    	$("#contentform").html(result);
	    	$("#formshow").fadeIn("fast");
	  	},  
  	});	
}

function downloadcsv(field_caption,field_example) {
	location.href = "<?php echo site_url();?>setup/formasuransi/downloadcsv?header="+field_caption+"&example="+field_example+"&asuransi="+$("#asuransi  option:selected").text()+"&produk="+$("#produk_id  option:selected").text();
}

$(window).bind('beforeunload', function(e){
	e.preventDefault();
  	$.ajax({
	  	url :"<?php echo site_url();?>setup/formasuransi/cleartemp",
	  	type:"POST",
	  	data:{
	    },
	  	success: function(result){
	  	},  
  	});
});




</script>
</div>