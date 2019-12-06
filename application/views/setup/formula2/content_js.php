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
      url :"<?php echo site_url();?>setup/formula2/save",
      type:"POST",
      data:{
        occupation_class  : $("#occupation_class").val(),
        age_min           : $("#age_min").val(),
        age_max           : $("#age_max").val(),
        gender            : $("#gender").val(),
        year_period_min   : $("#year_period_min").val(),
        year_period_max   : $("#year_period_max").val(),
        premium_type      : $("#premium_type").val(),
        sum_insurer       : $("#sum_insurer").val(),
        premium_rate      : $("#premium_rate").val(),
        premium_amount    : $("#premium_amount").val(),
        currency          : $("#currency").val(),
        active            : $("#active").val(),
        id                : $("#formula2id").val(),        
      },
      success: function(result){
        $("#contentmodalsuccess").html("<h5>formula2 Berhasil disimpan</h5>");
        $("#modalsuccess").modal("show");
        $('#form_input')[0].reset();
        $("#modalform").modal("hide");
        datatablepaging();
            
      },
      error:function error(){ 
          $("#contentmodalerror").html("<h5>formula2 gagal di simpan</h5>");
          $("#modalerror").modal("show");
      }  
    });
});

$(document).on('click', '#update', function() {

    $.ajax({
      url :"<?php echo site_url();?>setup/formula2/update",
      type:"POST",
      data:{
        occupation_class  : $("#occupation_class").val(),
        age_min           : $("#age_min").val(),
        age_max           : $("#age_max").val(),
        gender            : $("#gender").val(),
        year_period_min   : $("#year_period_min").val(),
        year_period_max   : $("#year_period_max").val(),
        premium_type      : $("#premium_type").val(),
        sum_insurer       : $("#sum_insurer").val(),
        premium_rate      : $("#premium_rate").val(),
        premium_amount    : $("#premium_amount").val(),
        currency          : $("#currency").val(),
        active            : $("#active").val(),
        id                : $("#formula2id").val(), 
        },
      success: function(result){
        $("#contentmodalsuccess").html("<h5>formula2 Berhasil disimpan</h5>");
        $("#modalsuccess").modal("show");
        $('#form_input')[0].reset();
        $('#formfield').html('');
         $("#modalform").modal("hide");
        datatablepaging();
            
      },
      error:function error(){ 
          $("#contentmodalerror").html("<h5>formula2 gagal di simpan</h5>");
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
          url :"<?php echo site_url();?>setup/formula2/paging?search="+$('#contain').val(),
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
        "ajax": "<?php echo site_url()?>setup/formula2/ajax_data/?search="+$('#contain').val()
      });

}



function deleteformula2(id) {
	$.ajax({
	  	url :"<?php echo site_url();?>setup/formula2/delete",
	  	type:"POST",
	  	data:{
	  		id : id,
	    },
	  	success: function(result){
	  		$("#contentmodalsuccess").html("<h5>Hapus formula2 Berhasil</h5>");
	  		$("#modalsuccess").modal("show");
	  		datatablepaging();
           	
	  	},
	  	error:function error(){ 
	        $("#contentmodalerror").html("<h5>formula2 gagal di hapus</h5>");
	        $("#modalerror").modal("show");
      }  
  	});
}


  function edit(
        occupation_class,
        age_min,
        age_max,
        gender,
        year_period_min,
        year_period_max,
        premium_type,
        sum_insurer,
        premium_rate,
        premium_amount,
        currency,
        active,
        id
    ) 
  {
    $("#occupation_class").val(occupation_class);
    $("#age_min").val(age_min);
    $("#age_max").val(age_max);
    $("#gender").val(gender);
    $("#year_period_min").val(year_period_min);
    $("#year_period_max").val(year_period_max);
    $("#premium_type").val(premium_type);
    $("#sum_insurer").val(sum_insurer);
    $("#premium_rate").val(premium_rate);
    $("#premium_amount").val(premium_amount);
    $("#currency").val(currency);
    $("#active").val(active);
    $("#formula2id").val(id)
    $("#update").show();
    $("#save").hide();
    $("#modalform").modal("show");

  }


</script>
</div>