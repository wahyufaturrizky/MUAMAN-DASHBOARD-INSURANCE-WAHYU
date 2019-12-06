<script type="text/javascript">

$( document ).ready(function() {

  $('.confirm-delete').on('click', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then(function () {

      var urlGet = "<?=base_url('nasabah/delete/')?>"+id;

      $.get(urlGet, function( data ) {
          swal({
            title: "Deleted!",
            text: "Your Record has been deleted.",
            type: "success",
            confirmButtonText: "Ok"
          }).then(function () {
            location.reload();
          });
      });
      
    }, function(dismiss){
        
    })

  });
  
});

<?php
if (! isset($_SESSION['csrf_token']))
    $_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32));

?>

$("select#tipe").change(function(){
  var selectedTipe = $("#tipe option:selected").val();
  if(selectedTipe == 1) {

    $.ajax({
          type: "POST",
          url: "<?=base_url('api/bank/html');?>",
          data: { 
            token : '<?php echo $_SESSION['csrf_token'] ?>'
          } 
      }).done(function(data){
          $("#group").html('');
          $("#group").html(data);
          
          selectbank();
      })
  }
  $("#group").html('');
  $("#branch").html('');
  $("#dn").val('');
  $("#email").val('');
  $("#phone").val('');
  $("#alamat").val('');
  
});

selectbank();

function selectbank() {
  $("select#bank").change(function(){
      var selectedBank = $("#bank option:selected").val();

      $.ajax({
          type: "POST",
          url: "<?=base_url('api/branch/html');?>",
          data: { 
            bank : selectedBank,
            token : '<?php echo $_SESSION['csrf_token'] ?>'
          } 
      }).done(function(data){
          $("#branch").html('');
          $("#branch").html(data);
          $("#dn").val('');
          $("#email").val('');
          $("#phone").val('');
          $("#alamat").val('');
          selectbranch();
      });
  });
}

function selectbranch() {
  $("select#branch").change(function(){
      var selectedBranch = $("#branch option:selected").val();

      $.ajax({
          type: "POST",
          url: "<?=base_url('api/branch/data');?>",
          dataType: "json",
          data: { 
            branch : selectedBranch,
            token : '<?php echo $_SESSION['csrf_token'] ?>'
          } 
      }).done(function(data){
          $("#dn").val(data.name);
          $("#email").val(data.email);
          $("#phone").val(data.telp);
          $("#alamat").val(data.address);

      });
  });
}

</script>