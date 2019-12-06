 <div id="js"> 
 <script>


datatablepaging();
getoption();

$('#submit').submit(function(e){
    e.preventDefault(); 
    $.ajax({
         url:'<?php site_url(); ?>formadditional/uploaddata',
         type:"POST",
         data:new FormData(this),
         processData:false,
         contentType:false,
         cache:false,
         async:false,
          success: function(data){
            if(parseInt(data) > 0){
            	$("#modalupload").modal("hide");
            	$("#contentmodalsuccess").html("<h5>Upload Data Berhasil</h5>");
    			$("#modalsuccess").modal("show");
    			$('#submit')[0].reset();
    			datatablepaging();
    		}else{
    			$("#contentmodalerror").html("<h5>Upload Data Gagal. Periksa kembali tipe file yang di upload</h5>");
    			$("#modalerror").modal("show");
    		}
       },
    });
});


$(document).on('click', '#addfield', function() {
  if($('#field_list').val()=='-'){
    $("#contentmodalwarning").html('PILIH FIELD YANG AKAN DITAMBAHKAN KE FORM DAHULU');
      $("#modalwarning").modal("show");
  }else if($('#field_list  option:selected').is(':enabled')){
    var field = $('#field_list').val();
    appendform(field);
  } 
});

$(document).on('click', '#save', function() {
    var value ='';
    var delimiter ='';
    $(".values").each(function(){
      value =  value+delimiter+$(this).val();
      delimiter = '|';
    });

    $.ajax({
      url :"<?php echo site_url();?>setup/configrule/save",
      type:"POST",
      data:{
          conname   : $("#conname").val(),
          values    : value,
          result    : $("#result").val(),
          addform   : $("#addform").val()
        },
      success: function(result){
        $("#contentmodalsuccess").html("<h5>Rule Berhasil disimpan</h5>");
        $("#modalsuccess").modal("show");
        $('#form_input')[0].reset();
        $('#formfield').html('');
        $("#modalform").modal("hide");
        datatablepaging();
            
      },
      error:function error(){ 
          $("#contentmodalerror").html("<h5>Rule gagal di simpan</h5>");
          $("#modalerror").modal("show");
      }  
    });
});

$(document).on('click', '#update', function() {
    var value ='';
    var delimiter ='';
    $(".values").each(function(){
      value =  value+delimiter+$(this).val();
      delimiter = '|';
    });

    $.ajax({
      url :"<?php echo site_url();?>setup/configrule/save",
      type:"POST",
      data:{
          conname   : $("#conname").val(),
          values    : value,
          result    : $("#result").val(),
          addform   : $("#addform").val()
        },
      success: function(result){
        $("#contentmodalsuccess").html("<h5>Rule Berhasil disimpan</h5>");
        $("#modalsuccess").modal("show");
        $('#form_input')[0].reset();
        $('#formfield').html('');
        $("#modalform").modal("hide");
        datatablepaging();
            
      },
      error:function error(){ 
          $("#contentmodalerror").html("<h5>Rule gagal di simpan</h5>");
          $("#modalerror").modal("show");
      }  
    });
});

$(document).on('click', '#new', function() {
    $("#save").show();
    $("#update").hide();
    $("#form_input")[0].reset();
    $("#conname").prop("readOnly",false);
	 	$("#modalform").modal("show");
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
          url :"<?php echo site_url();?>setup/configrule/paging?search="+$('#contain').val(),
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
        "ajax": "<?php echo site_url()?>setup/configrule/ajax_data/?page="+i+"&search="+$('#contain').val()
      });

}



function deleterule(ruleid) {
	$.ajax({
	  	url :"<?php echo site_url();?>setup/rulestblrefrence/delete",
	  	type:"POST",
	  	data:{
	  		id : ruleid,
	    },
	  	success: function(result){
	  		$("#contentmodalsuccess").html("<h5>Hapus Rule Berhasil</h5>");
	  		$("#modalsuccess").modal("show");
	  		datatablepaging();
           	
	  	},
	  	error:function error(){ 
	        $("#contentmodalerror").html("<h5>Rule gagal di hapus</h5>");
	        $("#modalerror").modal("show");
      }  
  	});
}


  function appendform(field) {
    var element = 
      '<div class="row form-group" id="'+field.split(' ').join('_')+'">'+
        '<div class="col-sm-10">'+
          '<input type="text" class="form-control fieldname " value="'+field+'" readonly>'+
        '</div>'+
        '<div class="col-sm-1">'+
          '<button class="btn btn-flat btn-danger" id="btn-'+field.split(' ').join('_')+'"><i class="fa fa-trash"></i></button>'+
        '</div>'+
      '</div>'+
      '<script>'+
        '$(document).on("click", "#btn-'+field.split(' ').join('_')+'", function() {'+
          '$("#'+field.split(' ').join('_')+'").remove();'+
          '$("#field_list option[value=\''+field+'\']").prop("disabled",false);'+
        '});'+
      '<\/script>';

      $("#formfield").append(element);
  }

  function edit(valuedata,rulefield,conname,addform,result) {
    var field = rulefield.split("|");
    var value = valuedata.split("|");
    //.split(' ').join('_')
    for(var i = 0, length1 = field.length; i < length1; i++){
      $("#value-"+field[i].split(' ').join('_')).val(value[i]);
    }
    $("#conname").val(conname);
    $("#result").val(result);
    $("#addform").val(addform);
    $("#update").show();
    $("#save").hide();
    $("#conname").prop("readOnly",true);
    $("#modalform").modal("show");

  }

  function getoption() {
   $.ajax({
      url :"<?php echo site_url();?>setup/configrule/getoption",
      type:"POST",
      data:{
        
        },
      success: function(result){
        $("#addform").html(result);
        //$("#divaddform").slideDown("slow");
      },  
    });
  }



</script>
</div>