
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

      var urlGet = "<?=base_url('bank/delete/')?>"+id;

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

</script>