 <script>


$(function() {
$('#reload').click(function() {
 $('#example1').DataTable().ajax.reload();
});
});

$(function() {
 $('#example1').DataTable();
});

$('#savepriviledge').click(function() {
   var val = [];
   var x = 0;
        $('#menu:checked').each(function(i){
          val[i] = $(this).val();
          x++;
        });
 $.ajax({
          url :"<?php echo site_url();?>/usermanagement/savepriviledge",
          type:"POST",
          data:{
                menu :val,
                id:$('#id').val()          
              },
          success: function(html){
               alert('Data Sudah Masuk');
               $('#example1').load('<?php echo site_url();?>/usermanagement/priviledge #example1');               
        },
        error:function error(){
                   alert('Data gagal disimpan'); 
                            } 
 });
});
$("#selectall").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});

$("#menu").change(function () {
    $("#selectall").prop('checked', $(this).prop("checked"));
});
    </script>