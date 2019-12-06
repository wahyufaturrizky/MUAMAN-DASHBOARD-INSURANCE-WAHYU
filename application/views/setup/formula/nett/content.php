<div class="form-group" center>
   	<b>Sub Total</b>
</div>
<?php foreach ($getsubtotal->result() as $k) :?>
<div class="row form-group">
	<div class="col-md-2">
		<label></label>
	</div>
	<div class="col-md-1">
		(<?php echo $k->opt;?>)
	</div>
	<div class="col-md-3">
		<?php echo $k->substructure;?>
	</div>
	<div class="col-md-4">
		<?php echo $k->value;?>
	</div>
	<div class="col-md-1">
		<button class="btn-flat btn-danger btn form-control" id="nettdel-<?php echo $k->id;?>">
			<i class="fa fa-trash"></i>
		</button>
		<script>
			$(document).on('click', '#nettdel-<?php echo $k->id;?>', function() {
				deletenett("<?php echo $k->id;?>")
			});
		</script>
	</div>
</div>
<?php endforeach; ?>

<div class="form-group" center>
   	<b>Adjustment</b>
</div>

<?php foreach ($getadjustment->result() as $k) :?>
<div class="row form-group">
	<div class="col-md-2">
		<label></label>
	</div>
	<div class="col-md-1">
		(<?php echo $k->opt;?>)
	</div>
	<div class="col-md-3">
		<?php echo $k->substructure;?>
	</div>
	<div class="col-md-4">
		<?php echo $k->value;?>
	</div>
	<div class="col-md-1">
		<button class="btn-flat btn-danger btn form-control" id="nettdel-<?php echo $k->id;?>">
			<i class="fa fa-trash"></i>
		</button>
		<script>
			$(document).on('click', '#nettdel-<?php echo $k->id;?>', function() {
				deletenett("<?php echo $k->id;?>")
			});
		</script>
	</div>
</div>
<?php endforeach; ?>

<div class="form-group" center>
   	<b>Tax</b>
</div>

<?php foreach ($gettax->result() as $k) :?>
<div class="row form-group">
	<div class="col-md-2">
		<label></label>
	</div>
	<div class="col-md-1">
		(<?php echo $k->opt;?>)
	</div>
	<div class="col-md-3">
		<?php echo $k->substructure;?>
	</div>
	<div class="col-md-4">
		<?php echo $k->value;?>
	</div>
	<div class="col-md-1">
		<button class="btn-flat btn-danger btn form-control" id="nettdel-<?php echo $k->id;?>">
			<i class="fa fa-trash"></i>
		</button>
		<script>
			$(document).on('click', '#nettdel-<?php echo $k->id;?>', function() {
				deletenett("<?php echo $k->id;?>")
			});
		</script>
	</div>
</div>
<?php endforeach; ?>

<div class="form-group" center>
   	<b>Shares</b>
</div>
<?php foreach ($getshares->result() as $k) :?>
<div class="row form-group">
	<div class="col-md-2">
		<label></label>
	</div>
	<div class="col-md-1">
		(<?php echo $k->opt;?>)
	</div>
	<div class="col-md-3">
		<?php echo $k->substructure;?>
	</div>
	<div class="col-md-4">
		<?php echo $k->value.$k->propto;?>
	</div>
	<div class="col-md-1">
		<button class="btn-flat btn-danger btn form-control" id="nettdel-<?php echo $k->id;?>">
			<i class="fa fa-trash"></i>
		</button>
		<script>
			$(document).on('click', '#nettdel-<?php echo $k->id;?>', function() {
				deletenett("<?php echo $k->id;?>")
			});
		</script>
	</div>
</div>
<?php endforeach; ?>

<script type="text/javascript">
	function deletenett(id) {
		    $.ajax({
		      url :"<?php echo site_url();?>setup/formula/deletenett",
		      type:"POST",
		      data:{
		        id     : id
		        },
		      success: function(result){
		        $("#contentmodalsuccess").html("<h5>Berhasil dihapus dari struktur</h5>");
		        $("#modalsuccess").modal("show");
		        getnett();
		        //$('#form_input')[0].reset();
		        //$('#formfield').html('');
		        //$("#modalform").modal("hide");
		        //datatablepaging();
		            
		      },
		      error:function error(){ 
		          $("#contentmodalerror").html("<h5>Gagal dihapus dari struktur</h5>");
		          $("#modalerror").modal("show");
		      }  
		    });
	}
</script>