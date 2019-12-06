
 <script>

$(document).on('click', '#savevar', function() {
    //var choosen = $("#vartype").val();
    $.ajax({
      url :"<?php echo site_url();?>setup/formula/savesubtotal",
      type:"POST",
      data:{
        varname     : $("#varname").val(),
        sourcetype  : $("#varsource").val(),
        operator    : $("#varoperator").val(),
        formula     : $("#varformula").val(),
        },
      success: function(result){
        $("#contentmodalsuccess").html("<h5>SubTotal Berhasil disimpan</h5>");
        $("#modalsuccess").modal("show");
        getnett();
        //$('#form_input')[0].reset();
        //$('#formfield').html('');
        //$("#modalform").modal("hide");
        //datatablepaging();
            
      },
      error:function error(){ 
          $("#contentmodalerror").html("<h5>Subtotal gagal di simpan</h5>");
          $("#modalerror").modal("show");
      }  
    });
});

$(document).on('click', '#savetax', function() {
    //var choosen = $("#vartype").val();
    $.ajax({
      url :"<?php echo site_url();?>setup/formula/savetax",
      type:"POST",
      data:{
        varname     : $("#taxname").val(),
        sourcetype  : '1',
        operator    : '+',
        valuetype   : $("#taxvaluetype").val(),
        formula     : $("#taxformula").val(),
        },
      success: function(result){
        $("#contentmodalsuccess").html("<h5>Tax Berhasil disimpan</h5>");
        $("#modalsuccess").modal("show");
        getnett();
        //$('#form_input')[0].reset();
        //$('#formfield').html('');
        //$("#modalform").modal("hide");
        //datatablepaging();
            
      },
      error:function error(){ 
          $("#contentmodalerror").html("<h5>Tax gagal di simpan</h5>");
          $("#modalerror").modal("show");
      }  
    });
});

$(document).on('click', '#saveadj', function() {
    var choosen = $("#adjsource").val();
    $.ajax({
      url :"<?php echo site_url();?>setup/formula/saveadj",
      type:"POST",
      data:{
        varname     : $("#adjname").val(),
        sourcetype  : $("#adjsource").val(),
        operator    : $("#adjoperator").val(),
        valuetype   : $("#adjvaluetype").val(),
        formula     : $("#adjformula"+choosen).val(),
        },
      success: function(result){
        $("#contentmodalsuccess").html("<h5>Adjustment Berhasil disimpan</h5>");
        $("#modalsuccess").modal("show");
        getnett();
        //$('#form_input')[0].reset();
        //$('#formfield').html('');
        //$("#modalform").modal("hide");
        //datatablepaging();
            
      },
      error:function error(){ 
          $("#contentmodalerror").html("<h5>Adjustment gagal di simpan</h5>");
          $("#modalerror").modal("show");
      }  
    });
});

$(document).on('click', '#addvar', function() {
    var choosen = $("#varsource").val();
    if(choosen!=1){
      $('#varformula').insertAtCaret("`"+$("#formula"+choosen).val()+"`");
    }else{
      $('#varformula').insertAtCaret($("#formula"+choosen).val());
    }
});

$(document).on('change', '#varsource', function() {
    var choosen = $("#varsource").val();
    $(".vartype").hide();
    $("#vartype"+choosen).show();
});

$(document).on('change', '#adjsource', function() {
    var choosen = $("#adjsource").val();
    $(".adjtype").hide();
    $("#adjtype"+choosen).show();
});

jQuery.fn.extend({
insertAtCaret: function(myValue){
  return this.each(function(i) {
    if (document.selection) {
      //For browsers like Internet Explorer
      this.focus();
      var sel = document.selection.createRange();
      sel.text = myValue;
      this.focus();
    }
    else if (this.selectionStart || this.selectionStart == '0') {
      //For browsers like Firefox and Webkit based
      var startPos = this.selectionStart;
      var endPos = this.selectionEnd;
      var scrollTop = this.scrollTop;
      this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
      this.focus();
      this.selectionStart = startPos + myValue.length;
      this.selectionEnd = startPos + myValue.length;
      this.scrollTop = scrollTop;
    } else {
      this.value += myValue;
      this.focus();
    }
  });
}
});



</script>