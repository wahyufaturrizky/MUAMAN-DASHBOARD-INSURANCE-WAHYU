<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
    Branch
</h1>
<ol class="breadcrumb">
    <li><a href="<?=base_url('')?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li><a href="<?=base_url('branch/'.$idbank)?>">Brnach</a></li>
    <li class="active">Tambah Branch</li>
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
                <!-- /.box-header -->
                <!-- form start -->
                
                <?php $attributes = array('id' => 'test'); ?>
				<?php echo form_open('branch/add/'.$idbank); ?>
                <div class="box-body">
                    <div class="form-group <?php if(form_error('display_name')) echo 'has-error'; ?>">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="display_name" value="<?php echo set_value('display_name'); ?>">
                        <?php if(form_error('display_name')) { ?>
                        <span class="help-block"> <?php echo form_error('display_name')?> </span>
                        <?}?>
                    </div>

                    <div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" value="<?php echo set_value('email'); ?>">
                        <?php if(form_error('email')) { ?>
                        <span class="help-block"> <?php echo form_error('email')?> </span>
                        <?}?>
                    </div>

                    <div class="form-group <?php if(form_error('alamat')) echo 'has-error'; ?>">
                        <label for="alamat">Alamat</label>
                        <textarea rows="6" class="form-control" name="alamat"><?php echo set_value('alamat'); ?></textarea>
                        <?php if(form_error('alamat')) { ?>
                        <span class="help-block"> <?php echo form_error('alamat')?> </span>
                        <?}?>
                    </div>

                    <div class="form-group <?php if(form_error('phone')) echo 'has-error'; ?>">
                        <label for="telephone">Telephone</label>
                        <input type="text" class="form-control" name="phone" value="<?php echo set_value('phone'); ?>">
                        <?php if(form_error('phone')) { ?>
                        <span class="help-block"> <?php echo form_error('phone')?> </span>
                        <?}?>
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