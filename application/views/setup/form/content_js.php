<script>
     $('.datepicker').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true
          });


    $.ajax({
 		url :"<?php echo site_url();?>setup/formasuransi/getgender",
  		type:"POST",
 		data:{
    		//kecamatan  : $(this).val(),
    	},
  		success: function(result){
    		$(".master_gender").html(result);
  		},  
  	});

    $.ajax({
	 	url :"<?php echo site_url();?>setup/formasuransi/getprovinsi",
	  	type:"POST",
	 	data:{
	    	
	    },
		success: function(result){
		$(".master_provinsi").html(result);
		},  
	});
	$(document).on('change', '.master_provinsi', function() {
  		$.ajax({
	 		url :"<?php echo site_url();?>setup/formasuransi/getkota",
	  		type:"POST",
	 		data:{
	    		provinsi  : $(this).val(),
	    	},
	  		success: function(result){
	    		$(".master_kota").html(result);
	  		},  
  		});
	});
	$(document).on('change', '.master_kota', function() {
  		$.ajax({
	 		url :"<?php echo site_url();?>setup/formasuransi/getkecamatan",
	  		type:"POST",
	 		data:{
	    		kota  : $(this).val(),
	    	},
	  		success: function(result){
	    		$(".master_kecamatan").html(result);
	  		},  
  		});
	});
	$(document).on('change', '.master_kecamatan', function() {
  		$.ajax({
	 		url :"<?php echo site_url();?>setup/formasuransi/getkelurahan",
	  		type:"POST",
	 		data:{
	    		kecamatan  : $(this).val(),
	    	},
	  		success: function(result){
	    		$(".master_kelurahan").html(result);
	  		},  
  		});
	});

		
	
</script>