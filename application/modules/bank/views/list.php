<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        Bank &nbsp; <a href="<?=base_url('bank/add')?>" class="btn bg-purple"> <i class="fa fa-edit"></i> Tambah Baru </a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=base_url('')?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="<?=base_url('bank')?>">Bank</a></li>
        <li class="active">List Bank</li>
    </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    <h3 class="box-title">List Bank</h3>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Tipe</th>
                            <th>Aksi</th>
                            </tr>
                            <tr>
                            <td>183</td>
                            <td>Syarif Furqon</td>
                            <td><em>syarifurqon</em></td>
                            <td>Root</td>
                            <td>
                                <a href=# class="btn bg-olive"><i class="fa fa-fw fa fa-edit"></i> Edit </a>&nbsp;&nbsp;
                                <a href=# class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i> Delete </a>
                            </td>
                            </tr>
                            <tr>
                            <td>219</td>
                            <td>BSM Pusat</td>
                            <td><em>bsmpusat</em></td>
                            <td>Nasabah</td>
                            <td>
                                <a href=# class="btn bg-olive"><i class="fa fa-fw fa fa-edit"></i> Edit </a>&nbsp;&nbsp;
                                <a href=# class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i> Delete </a>
                            </td>
                            </tr>
                            <tr>
                            <td>657</td>
                            <td>BSM Cab. Nusantara</td>
                            <td><em>bsmcab001</<em></td>
                            <td>Nasabah</td>
                            <td>
                                <a href=# class="btn bg-olive"><i class="fa fa-fw fa fa-edit"></i> Edit </a>&nbsp;&nbsp;
                                <a href=# class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i> Delete </a>
                            </td>
                            </tr>
                            <tr>
                            <td>175</td>
                            <td>Insco</td>
                            <td><em>insco</em></td>
                            <td>Broker</td>
                            <td>
                                <a href=# class="btn bg-olive"><i class="fa fa-fw fa fa-edit"></i> Edit </a>&nbsp;&nbsp;
                                <a href=# class="btn btn-danger"><i class="fa fa-fw fa-trash-o"></i> Delete </a>
                            </td>
                            </tr>
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li><a href="#">«</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">»</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
            <!-- /.box -->
            </div>
        </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
</div>