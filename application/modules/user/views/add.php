<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
    Pengguna
</h1>
<ol class="breadcrumb">
    <li><a href="<?=base_url('')?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li><a href="<?=base_url('user')?>">Pengguna</a></li>
    <li class="active">Tambah Pengguna</li>
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
                <form role="form" action="" method="post">
                <div class="box-body">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" class="form-control" name="kategori">

                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" name="slug">
                    
                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="text" class="form-control" name="slug">
                    
                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Re-Password</label>
                    <input type="text" class="form-control" name="slug">
                    
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Group User</label>
                        <select class="form-control">
                            <option value="1">Nasabah</option>
                            <option value="2">Broker</option>
                            <option value="3">Debitur</option>
                            <option value="4">Root</option>
                        </select>
                    
                    </div>

                
                    <!--
                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    </div> -->

                </div>
                <!-- /.box-body -->

                </form>
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-7">
        
            <div class="box box-primary">
                <div class="box-header">
                <h3 class="box-title">
                    Data Pelengkap Tipe Bank
                </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="" method="post">
                <div class="box-body">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Bank</label>
                        <select class="form-control">
                            <option value="1">BSM</option>
                            <option value="2">BNI Syari'ah</option>
                            <option value="3">BTPN Syari'ah</option>
                        </select>

                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Branch</label>
                    <select class="form-control">
                            <option value="1">Nusantara</option>
                            <option value="2">Margonda</option>
                            <option value="3">Kemang Timur</option>
                        </select>
                    
                    </div>

                    <div class="form-group">
                    <label for="exampleInputEmail1">Super Group</label>
                    <div class="radio">
                        <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">
                        Iya
                        </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                        Tidak
                        </label>
                    </div>
                    
                    </div>
                
                    
                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary  pull-right">Save</button>
                    </div>

                </div>
                <!-- /.box-body -->

                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>