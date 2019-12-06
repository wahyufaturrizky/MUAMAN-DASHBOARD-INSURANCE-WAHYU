<script>

$(document).on('change', '#shasource', function() {
    var choosen = $("#shasource").val();
    $(".shatype").hide();
    $("#shatype"+choosen).show();
});

$(document).on('click', '#savesha', function() {
    var choosen = $("#shasource").val();
    $.ajax({
      url :"<?php echo site_url();?>setup/formula/saveshares",
      type:"POST",
      data:{
        varname     : $("#shaname").val(),
        sourcetype  : $("#shasource").val(),
        operator    : '+',
        valuetype   : $("#shavaluetype").val(),
        propto 		: $("#shapropto").val(),
        formula     : $("#shaformula"+choosen).val(),
        },
      success: function(result){
        $("#contentmodalsuccess").html("<h5>Shares Berhasil disimpan</h5>");
        $("#modalsuccess").modal("show");
        getnett();
        //$('#form_input')[0].reset();
        //$('#formfield').html('');
        //$("#modalform").modal("hide");
        //datatablepaging();
            
      },
      error:function error(){ 
          $("#contentmodalerror").html("<h5>Shares gagal di simpan</h5>");
          $("#modalerror").modal("show");
      }  
    });
});

</script>