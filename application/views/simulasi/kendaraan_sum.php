
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <h3> Nilai Premi Anda Sebesar: <b><?=rupiah($premi)?></b></h3> 
            <div class="box">
                <div class="box-header with-border">
                <h3 class="box-title">Premi Kendaraan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table class="table table-bordered">
                    <tbody><tr>
                    <th style="width: 10px">#</th>
                    <th>Item</th>
                    <th></th>
                    </tr>
                    <tr>
                    <td>1.</td>
                    <td>Harga Kendaraan</td>
                    <td>
                        <?=rupiah($harga_kendaraan);?>
                    </td>
                    </tr>
                    <tr>
                    <td>2.</td>
                    <td>Jenis Pertanggungan</td>
                    <td>
                        <?=$coverage->name;?>
                    </td>
                    </tr>
                    <tr>
                    <td>3.</td>
                    <td>Tahun Kendaraan</td>
                    <td>
                        <?=$tahun_kendaraan;?> 
                    </td>
                    </tr>
                    <tr>
                    <td>4.</td>
                    <td>Area Kendaraan</td>
                    <td>
                        Wilayah <?=$id_wilayah;?> 
                    </td>
                    </tr>
                </tbody></table>
                </div>
                <!-- /.box-body -->
            
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Perluasan Manfaat</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>Item</th>
                  <th></th>
                </tr>
                <tr>
                  <td>1.</td>
                  <td>Strike, Riot, Stike, Civil Commotion (SRCC)</td>
                  <td>
                    <?=(isset($srcc)?"Ya":"Tidak")?>
                  </td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>Terorisme dan Sabotase (TS)</td>
                  <td>
                    <?=(isset($ts)?"Ya":"Tidak")?>
                  </td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Gempa Bumi dan Tsunami</td>
                  <td>
                    <?=(isset($eqvet)?"Ya":"Tidak")?>
                  </td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Banjir dan Angin Topan</td>
                  <td>
                    <?=(isset($tsfwd)?"Ya":"Tidak")?>
                  </td>
                </tr>
                <tr>
                  <td>5.</td>
                  <td>Third Party Liability (TPL)</td>
                  <td>
                  UP. <?=(!empty($tpl)?rupiah($tpl):rupiah('0'));?>
                  </td>
                </tr>
                <tr>
                  <td>6.</td>
                  <td>Kecelakaan Diri Pengemudi (PAD)</td>
                  <td>
                    UP. <?=(!empty($pad)?rupiah($pad):rupiah('0'));?>
                  </td>
                </tr>
                <tr>
                  <td>7.</td>
                  <td>Kecelakaan Diri Penumpang (PAP)</td>
                  <td>
                    UP. <?=(!empty($pap)?rupiah($pap):rupiah('0'));?>
                  </td>
                </tr>
              </tbody></table>
            </div>
            <!-- /.box-body -->
           
          </div>
        </div>
    </div>
    

</section>

<?php
function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
}
 ?>

