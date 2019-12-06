<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
    Simulasi Perhitungan Kendaraan
</h1>
<ol class="breadcrumb">
    <li><a href="<?=base_url('')?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li><a href="<?=base_url('asuransi')?>">Broker</a></li>
    <li class="active">Tambah Asuransi</li>
</ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <?php 
        $attributes = array('id' => 'frquotation');
        echo form_open('',$attributes); 
        ?>
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Data Utama
                    </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                				
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-3">
                            <label for="nama">Harga Kendaraan</label>
                        </div>
                        <div class="col-xs-3">
                            <label for="nama">Jenis Pertanggungan</label>
                        </div>
                        <div class="col-xs-3">
                            <label for="nama">Tahun Kendaraan</label>
                        </div>
                        <div class="col-xs-3">
                            <label for="nama">Plat Kendaraan</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                        <div class="input-group">
                            <?php
                                $defaultprice = '';
                                if(isset($assets) and !empty($assets))
                                    $defaultprice = $assets->tsi;
                    
                            ?>

                            <span class="input-group-addon">Rp.</span><input type="text" id="harga" name="harga_kendaraan" class="form-control currency" value="<?=isset($harga_kendaraan)?$harga_kendaraan:$defaultprice?>">
                        </div>
                        </div>
                        <div class="col-xs-3">

                            <?php
                                $selectedAllRisk = "";
                                $selectedTLO = "";
                                if(isset($id_coverage))
                                {
                                    if($id_coverage == 1)
                                        $selectedAllRisk = "selected";
                                    else
                                        $selectedTLO = "selected";
                                }
                            ?>
                            <select class="form-control" name="coverage" id="coverage">

                                <option <?=$selectedAllRisk?> value="1">All Risk</option>
                                <option <?=$selectedTLO?> value="2">TLO</option>
                            </select>
                            
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="tahun_kendaraan" id="thn_kendaraan">
                                <?php 
                                    $tahunnew = date("Y");
                                    $tahunold = $tahunnew - 20;
                                    $selectedThn = "";
                                    for ($thn=$tahunnew; $thn >= $tahunold; $thn--) { 

                                        if(isset($tahun_kendaraan)) {
                                            $selectedThn = ($tahun_kendaraan == $thn?"selected":"");
                                        }

                                        echo '<option '.$selectedThn.' value="'.$thn.'">'.$thn.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="plat">
                                <?php 
                                    $selectedPlat = "";
                                    foreach ($plats as $plat) {
                                        
                                        if(isset($idplat)) {
                                            $selectedPlat = ($idplat == $plat->id?"selected":"");
                                        }

                                        echo '<option '.$selectedPlat.' value="'.$plat->id.'">'.$plat->plat.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                   

                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Hitung</button>
                    </div>

                  
                    
                    
                </div>
                <!-- /.box-body -->

                
            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Perluasan Manfaat
                    </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                                
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="checkbox">
                                <label>
                                <input type="checkbox" <?=isset($srcc)?"checked":""?> name="srcc">
                                Strike, Riot, Stike, Civil Commotion (SRCC)
                                </label>
                            </div>
                            
                        </div>
                        <div class="col-xs-3">
                            <div class="checkbox">
                                <label>
                                <input type="checkbox" <?=isset($ts)?"checked":""?> name="ts">
                                Terorisme dan Sabotase (TS)
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="checkbox">
                                <label>
                                <input type="checkbox" <?=isset($eqvet)?"checked":""?> name="eqvet">
                                Gempa Bumi dan Tsunami
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="checkbox">
                                <label>
                                <input type="checkbox" <?=isset($tsfwd)?"checked":""?> name="tsfwd">
                                Banjir dan Angin Topan
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-xs-3">
                            <label>
                            Third Party Liability (TPL)
                            </label>
                        </div>
                        <div class="col-xs-3">
                            <label>
                            Kecelakaan Diri Pengemudi (PAD)
                            </label>
                        </div>
                        <div class="col-xs-3">
                            <label>
                            Kecelakaan Diri Penumpang (PAP)
                            </label>
                        </div>
                        <div class="col-xs-3">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="input-group">

                            <span class="input-group-addon">Rp.</span>
                            <input type="text" class="form-control" name="tpl" value="<?=isset($tpl)?$valtpl:""?>" max="100000000" placeholder="Jumlah Pertanggungan">
                            </div>
                        </div>
                        <div class="col-xs-3">
                        <div class="input-group">

                            <span class="input-group-addon">Rp.</span>
                            <input type="text" class="form-control" name="pad" value="<?=isset($pad)?$valpad:""?>" placeholder="Jumlah Pertanggungan">
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="col-md-8">
                                <div class="input-group">

                                <span class="input-group-addon">Rp.</span>
                                <input type="text" class="form-control" name="pap" value="<?=isset($pap)?$valpap:""?>" placeholder="Jumlah Pertanggungan"> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="tpap" value="<?=isset($valtpap)?$valtpap:""?>" placeholder="Jumlah Penumpang">
                            </div>
                        </div>
                        <div class="col-xs-3">
                            
                        </div>
                    </div>
                

                  
                
                    
                    
                </div>
                <!-- /.box-body -->

                
            </div>
            <!-- /.box -->
            </div>
                            
        <?php echo form_close(); ?>
       
    </div>

    <?php if(isset($asuransi) and !empty($asuransi)) { ?>
    <div class="row">
        <?php echo form_open(''); ?>
        <div class="col-md-8">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Daftar Asuransi
                    </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                				
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th width="250px">Nama</th>
                            <th width="250px">Rincian</th>
                            <th width="250px">Premi</th>
                            <th>Aksi</th>
                        </tr>
                        
                        <?php
                        
                        foreach($asuransi as $row) { 
                            $biaya_admin = 50000;
                            $premi = $premidasar = ($row->nilai_rate /100)* $harga_kendaraan;
                            if($loading > 0) {
                                $vloading =   $loading * $premi;
                                $premi =   $premi + $vloading;
                            }

                            $premi = $premi + $biaya_admin;

                            if(isset($srcc) and !empty($srcc))
                                $premi = $premi + $srcc;
                            
                            if(isset($ts) and !empty($ts))
                                $premi = $premi + $ts;
                            
                            if(isset($eqvet) and !empty($eqvet))
                                $premi = $premi + $eqvet;

                            if(isset($tsfwd) and !empty($tsfwd))
                                $premi = $premi + $tsfwd;
                            
                            if(isset($tpl) and !empty($tpl))
                                $premi = $premi + $tpl;

                            if(isset($pad) and !empty($pad))
                                $premi = $premi + $pad;

                            if(isset($pap) and !empty($pap))
                                $premi = $premi + $pap;
                            
                        ?>
                        <tr>
                            <td>1</td>
                            <td><?=$row->name;?></td>
                            <td>
                                <table border="0">
                                <tr>
                                    <td width="100px">Premi Dasar</td>
                                    <td>:</td>
                                    <td><?=rupiah($premidasar);?></td>
                                </tr>
                                
                                <?php if(isset($srcc) and !empty($srcc)) {
                                    echo "
                                    <tr>
                                    <td>SRCC</td>
                                    <td>:</td>
                                    <td>".rupiah($srcc)."</td>
                                    </tr>";
                                   
                                }
                                ?>
                                <?php if(isset($ts) and !empty($ts)) {
                                    echo "
                                    <tr>
                                    <td>TS</td>
                                    <td>:</td>
                                    <td>".rupiah($ts)."</td>
                                    </tr>";
                                }
                                ?>

                                <?php if(isset($eqvet) and !empty($eqvet)) {
                                    echo "
                                    <tr>
                                    <td>EQVET</td>
                                    <td>:</td>
                                    <td>".rupiah($eqvet)."</td>
                                    </tr>";

                                }
                                ?>

                                <?php if(isset($tsfwd) and !empty($tsfwd)) {
                                    echo "
                                    <tr>
                                    <td>TSWFD</td>
                                    <td>:</td>
                                    <td>".rupiah($tsfwd)."</td>
                                    </tr>";
                                }
                                ?>

                                <?php if(isset($tpl) and !empty($tpl)) {
                                    echo "
                                    <tr>
                                    <td>TPL</td>
                                    <td>:</td>
                                    <td>".rupiah($tpl)."</td>
                                    </tr>";
                                }
                                ?>

                                <?php if(isset($pad) and !empty($pad)) {
                                    echo "
                                    <tr>
                                    <td>PAD</td>
                                    <td>:</td>
                                    <td>".rupiah($pad)."</td>
                                    </tr>";
                                }
                                ?>


                                <?php if(isset($pap) and !empty($pap)) {
                                    echo "
                                    <tr>
                                    <td>PAP</td>
                                    <td>:</td>
                                    <td>".rupiah($pap)."</td>
                                    </tr>";
                                }
                                ?>

                                <?php if(isset($vloading) and !empty($vloading)) {
                                    echo "
                                    <tr>
                                    <td>Loading</td>
                                    <td>:</td>
                                    <td>".rupiah($vloading)."</td>
                                    </tr>";
                                }
                                ?>

                                <tr>
                                    <td width="100px">Administrasi</td>
                                    <td>:</td>
                                    <td><?=rupiah($biaya_admin);?></td>
                                </tr>
                                
                                </table>
                            </td>
                            <td><?=rupiah($premi);?></td>
                            <td>
                            </a>
                                <span data-id="<?=$row->idrate?>" data-premi="<?=$premi?>" class="btn bg-olive doorder"> Pilih </span>
                                
                            </td>
                        </tr>
                        <?php } ?>
                        
                    </table>
                </div>
                <!-- /.box-body -->

                
            </div>
            <!-- /.box -->
        </div>
       
        <?php echo form_close(); ?>
       
    </div>
    <?php } else { ?>
        <div class="row">
            <div class="col-md-8">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Data Tidak Dapat Ditemukan
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<!-- /.row -->
</section>
<!-- /.content -->
</div>

<!-- modal success -->
<div class="modal fade" id="modalrequest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabelupdate">SUMMARY PROTECTION ASSETS</h4> <br>
            </div>
            <div class="modal-body">
                <div id="contentrequest">
                    
                </div>
                <input type="hidden" id="idrequestproteksi">
                
            </div>
            <div class="modal-footer" style="text-align:center;">
                <h3><strong>Anda Setuju Dengan Pembelian Premi Ini?</strong></h3>
                <button type="button" id="dorequest" class="btn btn-info" data-dismiss="modal"><b>YES</b></button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><b>NO</b></button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->

<?php
function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
}
 ?>