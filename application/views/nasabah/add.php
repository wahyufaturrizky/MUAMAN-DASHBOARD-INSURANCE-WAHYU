<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
    Nasabah
</h1>
<ol class="breadcrumb">
    <li><a href="<?=base_url('')?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li><a href="<?=base_url('nasabah')?>">Nasabah</a></li>
    <li class="active">Tambah Nasabah</li>
</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <?php echo form_open('nasabah/add'); ?>
        <div class="col-md-8">
        <div class="box box-primary">
                
                <!-- /.box-header -->
                <!-- form start -->
                
                <div class="box-body">
                    <div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
                        <label for="email">Tipe Nasabah</label>
                        <select id="tipe" name="tipe" class="form-control">
                            <option disabled selected> -- Pilih --</option>
                            <option value="1">Bank</option>
                            <option value="2">Individu</option>
                            <option value="3">Corporate</option>
                        </select>
                    </div>

                    <span id="group"></span>
                    <span id="branch"></span>

                </div>
                <!-- /.box-body -->

            </div>

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

                    

                    <div class="form-group <?php if(form_error('alamat')) echo 'has-error'; ?>">
                        <label for="alamat">Alamat</label>
                        <textarea rows="6" class="form-control" id="alamat" name="alamat"><?php echo set_value('alamat'); ?></textarea>
                        <?php if(form_error('alamat')) { ?>
                        <span class="help-block"> <?php echo form_error('alamat')?> </span>
                        <?}?>
                    </div>

                    <div class="form-group <?php if(form_error('phone')) echo 'has-error'; ?>">
                        <label for="telephone">Telephone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo set_value('phone'); ?>">
                        <?php if(form_error('phone')) { ?>
                        <span class="help-block"> <?php echo form_error('phone')?> </span>
                        <?}?>
                    </div>
                    
                    
                </div>
                <!-- /.box-body -->

                
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-4">
            
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
                        <label for="repass">Re-Password</label>
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