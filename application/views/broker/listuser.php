<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        Broker <?=$broker->name;?>&nbsp; <a href="<?=base_url('broker/user/add/'.$idbroker)?>" class="btn bg-purple"> <i class="fa fa-edit"></i> Tambah Pengguna </a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=base_url('')?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="<?=base_url('broker')?>">Broker</a></li>
        <li class="active">List Pengguna</li>
    </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if(isset($_GET['status']) and $_GET['status'] == '1') {?>
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                    Data Yang Dimasukan Sudah Tersimpan.
                </div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    <h3 class="box-title">List Penggunan Broker <strong><?=$broker->name;?></strong></h3>

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
                            <th width="250px">Nama</th>
                            <th width="250px">Email</th>
                            <th><div align="center">Aksi</div></th>
                            </tr>
                            <?php 
                            if($userBroker)
                            foreach ($userBroker as $row) : ?>
                            <tr>
                            <td><?php echo $row->id; ?></td>
                            <td><?php echo $row->name; ?></td>
                            <td><em><?php echo $row->email; ?></em></td>
                            <td align="center">
                            </a>
                                <a href="<?=base_url('broker/user/edit/'.$row->id.'/'.$row->id_broker)?>" class="btn bg-olive"><i class="fa fa-fw fa fa-edit"></i> Ubah </a>&nbsp;&nbsp;
                                <a onclick='' class="btn btn-danger confirm-delete-user" data-id="<?=$row->id;?>" data-toggle="modal"><i class="fa fa-fw fa-trash-o"></i> Hapus </a>
                            </td>
                            </tr>
                            <?php endforeach?>
                            
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
