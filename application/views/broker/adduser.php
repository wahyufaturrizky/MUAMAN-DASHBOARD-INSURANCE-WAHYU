<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
    Pengguna Broker
</h1>
<ol class="breadcrumb">
    <li><a href="<?=base_url('')?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li><a href="<?=base_url('broker/user/')?>">Broker Pengguna</a></li>
    <li class="active">Tambah Broker</li>
</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <?php echo form_open(''); ?>
        <div class="col-md-6">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Data Utama
                    </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                				
                <div class="box-body">
                    <div class="form-group <?php if(form_error('display_name')) echo 'has-error'; ?>">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="dn" name="display_name" value="<?php echo set_value('display_name'); ?>">
                        <?php if(form_error('display_name')) { ?>
                        <span class="help-block"> <?php echo form_error('display_name')?> </span>
                        <?}?>
                    </div>

                    <div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>">
                        <?php if(form_error('email')) { ?>
                        <span class="help-block"> <?php echo form_error('email')?> </span>
                        <?}?>
                    </div>

                    <div class="form-group <?php if(form_error('part')) echo 'has-error'; ?>">
                        <label for="part">Bagian</label>
                        <select id="part" name="part" class="form-control">
                            <option disabled selected> -- Pilih --</option>
                            <option value="1">Admin</option>
                            <option value="2">Registrasi</option>
                            <option value="3">Teknik</option>
                            <option value="4">Finance</option>
                        </select>
                        <?php if(form_error('part')) { ?>
                        <span class="help-block"> <?php echo form_error('part')?> </span>
                        <?}?>
                    </div>

                    
                </div>
                <!-- /.box-body -->

                
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-6">
            
            <div class="box box-primary">
                <div class="box-header">
                <h3 class="box-title">
                    Data Login
                </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                
                <div class="box-body">
                    <div class="form-group <?php if(form_error('username')) echo 'has-error'; ?>">
                        <label for="nama">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo set_value('username'); ?>">
                        <?php if(form_error('username')) { ?>
                        <span class="help-block"> <?php echo form_error('username')?> </span>
                        <?}?>
                    </div>

                    <div class="form-group <?php if(form_error('pass')) echo 'has-error'; ?>">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" name="pass" value="<?php echo set_value('pass'); ?>">
                        <?php if(form_error('pass')) { ?>
                        <span class="help-block"> <?php echo form_error('pass')?> </span>
                        <?}?>
                    </div>

                    <div class="form-group <?php if(form_error('repass')) echo 'has-error'; ?>">
                        <label for="repass">Confirm Password</label>
                        <input type="password" class="form-control" name="repass">
                        <?php if(form_error('repass')) { ?>
                        <span class="help-block"> <?php echo form_error('repass')?> </span>
                        <?}?>
                    </div>
                
                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                    </div>

                </div>
                <!-- /.box-body -->

            </div>
            <!-- /.box -->
        </div>
        <?php echo form_close(); ?>
       
    </div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>