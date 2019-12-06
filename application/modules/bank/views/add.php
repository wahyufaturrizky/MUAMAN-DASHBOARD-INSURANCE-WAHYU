<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
    Bank
</h1>
<ol class="breadcrumb">
    <li><a href="<?=base_url('')?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li><a href="<?=base_url('bank')?>">Bank</a></li>
    <li class="active">Tambah Bank</li>
</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-5">
        
            <div class="box box-primary">
                <div class="box-header">
                <h3 class="box-title">
                    Data Utama
                </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php if(validation_errors()) {?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>Warning!</strong><br />
						<?php echo validation_errors(); ?>
					</div>
					<?php } ?>
                    <?php if(form_error('email')) echo 'has-error'; ?>
                
                <?php $attributes = array('id' => 'test'); ?>
				<?php echo form_open('bank/add', $attributes); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="display_name">

                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email">

                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea rows="6" class="form-control" name="alamat"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="telephone">Telephone</label>
                        <input type="text" class="form-control" name="phone">
                    </div>

                
                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </div>

                </div>
                <!-- /.box-body -->

                <?php echo form_close(); ?>
            </div>
            <!-- /.box -->
        </div>
       
    </div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>