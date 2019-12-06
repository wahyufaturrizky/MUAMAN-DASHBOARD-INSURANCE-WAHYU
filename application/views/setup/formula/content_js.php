 <div id="js"> 
  <?php $this->view('setup/formula/tableformula/content_js'); ?>
  <?php $this->view('setup/formula/gross/content_js'); ?>
  <?php $this->view('setup/formula/shares/content_js'); ?>
 <script>


datatablepaging();

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
    var field ='';
    var delimiter ='';
    $(".fieldname").each(function(){
      field =  field+delimiter+$(this).val();
      delimiter = '|';
    });

    $.ajax({
      url :"<?php echo site_url();?>setup/rulestblrefrence/save",
      type:"POST",
      data:{
        asuransi  : $("#asuransi").val(),
        produk    : $("#produk_id").val(),
        client    : $("#client").val(),
        rulename  : $("#rulename").val(),
        rulefield : field
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

    var field ='';
    var delimiter ='';
    $(".fieldname").each(function(){
      field =  field+delimiter+$(this).val();
      delimiter = '|';
    });

    $.ajax({
      url :"<?php echo site_url();?>setup/rulestblrefrence/update",
      type:"POST",
      data:{
        asuransi  : $("#asuransi").val(),
        produk    : $("#produk_id").val(),
        client    : $("#client").val(),
        rulename  : $("#rulename").val(),
        rulefield : field,
        id        : $("#rule_id").val()
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
	if( $("#asuransi").val()=="-" || $("#produk_id").val()=="-" || $("#client").val()=="-" ){
		$("#contentmodalwarning").html("<h5>Klien, Asuransi, dan Produk harus dipilih dahulu</h5>");
    	$("#modalwarning").modal("show");
 	}else{
    getoption();
    $("#save").show();
    $("#update").hide();
	 	$("#modalform").modal("show");
 	}
});


$(document).on('change', '#asuransi', function() {
  $.ajax({
	  url :"<?php echo site_url();?>setup/formadditional/getprodukasuransi",
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
	$.ajax({
    url :"<?php echo site_url();?>setup/formula/getpolisid",
    type:"POST",
    data:{
      produk_id   : $(this).val(),
      client      : $("#client").val(),
      asuransi    : $("#asuransi").val(),
      },
    success: function(result){
      $("#polis_id").html(result);
      datatablepaging();
    },  
  });
});

$(document).on('change', '#polis_id', function() {
  //if($("#tabno").val() == '1'){
      datatablepaging();
      getoption();
      getoptiontableref();
      getnett();
  //} 
});

$(document).on('keyup', '#contain', function() {
  datatablepaging();
});


function datatablepaging() {

     $.ajax({
          url :"<?php echo site_url();?>setup/formula/paging?asuransi="+$('#asuransi').val()+"&produk="+$('#produk_id').val()+"&search="+$('#contain').val()+"&nasabahid="+$('#client').val()+"&polis_id="+$('#polis_id').val(),
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
        "ajax": "<?php echo site_url()?>setup/formula/ajax_data/?asuransi="+$('#asuransi').val()+"&produk="+$('#produk_id').val()+"&page="+i+"&search="+$('#contain').val()+"&nasabahid="+$('#client').val()+"&polis_id="+$('#polis_id').val()
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

  function edit(rulefield,rulename,ruleid) {
    var field = rulefield.split("|");
    for(var i = 0, length1 = field.length; i < length1; i++){
      appendform(field[i])
    }
    getoption();
    $("#rulename").val(rulename)
    $("#rule_id").val(ruleid)
    $("#update").show();
    $("#save").hide();
    $("#modalform").modal("show");

  }

  function getoption() {
    $.ajax({
      url :"<?php echo site_url();?>setup/formula/getoption",
      type:"POST",
      data:{
        asuransi  : $("#asuransi").val(),
        produk  : $("#produk_id").val(),
        },
      success: function(result){
        $("#headername").html("<option value="-">Header Name</option>"+result);
        $("#rowname").html("<option value="-">Row Name</option>"+result);
        $(".formref").html(result);
      },  
    });
  }


  function getoptiontableref() {
    $.ajax({
      url :"<?php echo site_url();?>setup/formula/getoptiontblref",
      type:"POST",
      data:{
        asuransi  : $("#asuransi").val(),
        produk    : $("#produk_id").val(),
        client    : $("#client").val(),
        polisid    : $("#polis_id").val(),
        },
      success: function(result){
        $(".tblref").html(result);
      },  
    });
  }
  
  function getnett() {
    $.ajax({
      url :"<?php echo site_url();?>setup/formula/getnett",
      type:"POST",
      data:{
        },
      success: function(result){
        $("#tab_4").html(result);
      },  
    });
  }
</script>
</div>