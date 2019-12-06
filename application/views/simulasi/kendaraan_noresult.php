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
        <?php echo form_open(''); ?>
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

                            <span class="input-group-addon">Rp.</span><input type="text" name="harga_kendaraan" class="form-control rupiah" value="<?=isset($harga_kendaraan)?$harga_kendaraan:$defaultprice?>">
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
                            <select class="form-control" name="coverage">

                                <option <?=$selectedAllRisk?> value="1">All Risk</option>
                                <option <?=$selectedTLO?> value="2">TLO</option>
                            </select>
                            
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="tahun_kendaraan">
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
    
<!-- /.row -->
</section>
<!-- /.content -->
</div>

<?php
function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
}
 ?>