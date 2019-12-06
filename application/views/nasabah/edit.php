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
        <?php echo form_open(''); ?>
        <div class="col-md-8">
        <div class="box box-primary">
                <!-- /.box-header -->
                <!-- form start -->
                
                <div class="box-body">
                    <div class="form-group <?php if(form_error('tipe')) echo 'has-error'; ?>">
                        <label for="tipe">Tipe Nasabah</label>
                        <select id="tipe" name="tipe" class="form-control">
                            <option disabled selected> -- Pilih --</option>
                            <?php 
                                foreach($types as $type) {
                                    $selected= ($type->id == $nasabah->apm_nasabah_type_id)?'selected':'';
                                    echo '<option value="'.$type->id.'" '.$selected.'>'.$type->name.'</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <span id="group">
                        <?php if( $nasabah->apm_nasabah_type_id == 1) { ?>
                          <div class="form-group <?php if(form_error('bank')) echo 'has-error'; ?>">
                            <label for="bank">Bank</label>
                            <select id="bank" name="bank" class="form-control">
                                <option disabled selected> -- Pilih --</option>
                                <?php 
                                    foreach($listbanks as $bank) {
                                        $selected= ($bank->id == $nasabah->id_group_parent)?'selected':'';
                                        echo '<option value="'.$bank->id.'" '.$selected.'>'.$bank->name.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <?php } ?>
                    </span>
                    <span id="branch">
                      <?php if( $nasabah->apm_nasabah_type_id == 1) { ?>
                        <div class="form-group <?php if(form_error('branch')) echo 'has-error'; ?>">
                          <label for="branch">Cabang</label>
                          <select id="branch" name="branch" class="form-control">
                              <option disabled selected> -- Pilih --</option>
                              <?php 
                                  foreach($listbranchs as $branch) {
                                      $selected= ($branch->id == $nasabah->id_group)?'selected':'';
                                      echo '<option value="'.$branch->id.'" '.$selected.'>'.$branch->name.'</option>';
                                  }
                              ?>
                          </select>
                      </div>
                      <?php } ?>
                    </span>

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
                        <input type="text" class="form-control" name="display_name" value="<?php echo $nasabah->name; ?>">
                        <?php if(form_error('display_name')) { ?>
                        <span class="help-block"> <?php echo form_error('display_name')?> </span>
                        <?}?>
                    </div>

                    <div class="form-group <?php if(form_error('email')) echo 'has-error'; ?>">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $nasabah->email; ?>">
                        <?php if(form_error('email')) { ?>
                        <span class="help-block"> <?php echo form_error('email')?> </span>
                        <?}?>
                    </div>

                    

                    <div class="form-group <?php if(form_error('alamat')) echo 'has-error'; ?>">
                        <label for="alamat">Alamat</label>
                        <textarea rows="6" class="form-control" name="alamat"><?php echo $nasabah->address; ?></textarea>
                        <?php if(form_error('alamat')) { ?>
                        <span class="help-block"> <?php echo form_error('alamat')?> </span>
                        <?}?>
                    </div>

                    <div class="form-group <?php if(form_error('phone')) echo 'has-error'; ?>">
                        <label for="telephone">Telephone</label>
                        <input type="text" class="form-control" name="phone" value="<?php echo $nasabah->telp; ?>">
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
                        <input disabled type="text" class="form-control" name="username" value="<?php echo $nasabah->username_xxx; ?>">
                        <input type="hidden" name="iduser" value="<?php echo $nasabah->id_user;?>"
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