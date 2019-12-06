 <div id="js"> 
 <script>


datatablepaging();

  // policy_detail_id        text [ref: > policy_detail.id]
  // policy_cost             decimal
  // stamp_duty              decimal
  // internal_admin_cost     decimal
  // insurer_admin_cost      decimal

function formatcurrency(number) {
  //alert(number.indexOf(".")) ;

  var bulat = number;
  var desimal = '';

  if(number.indexOf(".") > 0 ){
      var number_split = number.split(".");
      var bulat = number_split[0];
      var desimal = '.'+number_split[1];
  }

  

  bulat = bulat.replace( /\D+/g, '');
  var number_string = bulat.toString(),
  sisa  = number_string.length % 3,
  rupiah  = number_string.substr(0, sisa),
  ribuan  = number_string.substr(sisa).match(/\d{3}/g);
    
  if (ribuan) {
    separator = sisa ? ',' : '';
    rupiah += separator + ribuan.join(',');
  }
  rupiah = "Rp. "+ rupiah +desimal;
  return rupiah;
}

function numberdecimalonly(money) {
  var desimal = money.replace("Rp. ", "");
  return desimal.replace(",", "");
}

$(document).on('keyup', '.currency', function() {
    var angka = $(this).val();
    rupiahnum = angka.replace("Rp. ", "");
    rupiah = formatcurrency(rupiahnum);
    $(this).val(rupiah);
})

$(document).on('click', '#save', function() {
    $.ajax({
      url :"<?php echo site_url();?>setup/others/save",
      type:"POST",
      data:{
        policy_cost         : numberdecimalonly($("#policy_cost").val()),
        stamp_duty          : numberdecimalonly($("#stamp_duty").val()),
        internal_admin_cost : numberdecimalonly($("#internal_admin_cost").val()),
        insurer_admin_cost  : numberdecimalonly($("#insurer_admin_cost").val())
        },
      success: function(result){
        $("#contentmodalsuccess").html("<h5>others Berhasil disimpan</h5>");
        $("#modalsuccess").modal("show");
        $('#form_input')[0].reset();
        $("#modalform").modal("hide");
        datatablepaging();
            
      },
      error:function error(){ 
          $("#contentmodalerror").html("<h5>others gagal di simpan</h5>");
          $("#modalerror").modal("show");
      }  
    });
});

$(document).on('click', '#update', function() {

    $.ajax({
      url :"<?php echo site_url();?>setup/others/update",
      type:"POST",
      data:{
        policy_cost         : numberdecimalonly($("#policy_cost").val()),
        stamp_duty          : numberdecimalonly($("#stamp_duty").val()),
        internal_admin_cost : numberdecimalonly($("#internal_admin_cost").val()),
        insurer_admin_cost  : numberdecimalonly($("#insurer_admin_cost").val()),
        id                  : $("#othersid").val()
        },
      success: function(result){
        $("#contentmodalsuccess").html("<h5>others Berhasil disimpan</h5>");
        $("#modalsuccess").modal("show");
        $('#form_input')[0].reset();
        $('#formfield').html('');
         $("#modalform").modal("hide");
        datatablepaging();
            
      },
      error:function error(){ 
          $("#contentmodalerror").html("<h5>others gagal di simpan</h5>");
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
          url :"<?php echo site_url();?>setup/others/paging?search="+$('#contain').val(),
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
        "ajax": "<?php echo site_url()?>setup/others/ajax_data/?search="+$('#contain').val()
      });

}



function deleteothers(id) {
	$.ajax({
	  	url :"<?php echo site_url();?>setup/others/delete",
	  	type:"POST",
	  	data:{
	  		id : id,
	    },
	  	success: function(result){
	  		$("#contentmodalsuccess").html("<h5>Hapus others Berhasil</h5>");
	  		$("#modalsuccess").modal("show");
	  		datatablepaging();
           	
	  	},
	  	error:function error(){ 
	        $("#contentmodalerror").html("<h5>others gagal di hapus</h5>");
	        $("#modalerror").modal("show");
      }  
  	});
}


  function edit(policy_cost,stamp_duty,internal_admin_cost,insurer_admin_cost,id) {
    $("#policy_cost").val(formatcurrency(policy_cost))
    $("#stamp_duty").val(formatcurrency(stamp_duty))
    $("#internal_admin_cost").val(formatcurrency(internal_admin_cost))
    $("#insurer_admin_cost").val(formatcurrency(insurer_admin_cost))
    $("#othersid").val(id)
    $("#update").show();
    $("#save").hide();
    $("#modalform").modal("show");

  }


</script>
</div>