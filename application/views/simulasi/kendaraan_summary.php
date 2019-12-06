<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
    Summary Perhitungan Premi Kendaraan
</h1>
<ol class="breadcrumb">
    <li><a href="<?=base_url('')?>"><i class="fa fa-dashboard"></i> Beranda</a></li>
    <li><a href="<?=base_url('asuransi')?>">Broker</a></li>
    <li class="active">Tambah Asuransi</li>
</ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6">
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
                        <?=$harga_kendaraan;?>
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
        <div class="col-md-8">
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
                    
                  </td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>Terorisme dan Sabotase (TS)</td>
                  <td>
                   
                  </td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Gempa Bumi dan Tsunami</td>
                  <td>
                    
                  </td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Banjir dan Angin Topan</td>
                  <td>
                    
                  </td>
                </tr>
                <tr>
                  <td>5.</td>
                  <td>Third Party Liability (TPL)</td>
                  <td>
                    
                  </td>
                </tr>
                <tr>
                  <td>6.</td>
                  <td>Kecelakaan Diri Pengemudi (PAD)</td>
                  <td>
                    
                  </td>
                </tr>
                <tr>
                  <td>7.</td>
                  <td>Kecelakaan Diri Pengemudi (PAD)</td>
                  <td>
                    
                  </td>
                </tr>
              </tbody></table>
            </div>
            <!-- /.box-body -->
           
          </div>
        </div>
    </div>
    

</section>

</div>