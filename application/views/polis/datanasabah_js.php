<script>
$(document).on('keyup', '#contain', function() {
    datatablepaging();
});

$('#datanasabah').click(function() {
  $("#modalnasabah").modal("show");
  var contain = $("#namanasabah").val();
  $("#contain").val(contain);
  setTimeout(function() {
    datatablepaging();  
  },200)
});

function datatablepaging() {

     $.ajax({
          url :"<?php echo site_url();?>polis/polis/paging?search="+$('#contain').val(),
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
        "sScrollXInner": "100%" ,
        "searching" :false, 
        "ajax": "<?php echo site_url()?>polis/polis/ajax_data/?page="+i+"&search="+$('#contain').val()
      });
      
      var data = null;
      var table = $('#example1').DataTable();

      $('#example1 tbody').on('click', '#choose', function () {
        data = table.row( $(this).parents('tr') ).data();

        $("#namanasabah").val(data[0]);
        $("#idnasabah").val(data[6]); 
        $("#modalnasabah").modal("hide");
      });
}
</script>