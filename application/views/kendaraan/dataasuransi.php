            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title text-blue">DATA ASURANSI</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
              <!-- CONTENT -->
               <form method="post" id="forminput1">
                <div class="col-sm-12">

                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>No Registrasi</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <input type="text" class="form-control entries3" id="registrasi" name="nama" placeholder="Nomor Registrasi">
                        <input type="hidden" id="idregistrasi">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Periode 1</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <input type="text" class="form-control entries3 datepicker datemask" id="periode1" name="nama" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Periode 2</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <input type="text" class="form-control entries3 datepicker datemask" id="periode2" name="nama" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Produk</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <select class="form-control entries3" id="produk">
                          <option value="">-Pilih Produk</option>
                          <?php foreach ($getproduk->result()as $row) {?>
                              <option value = "<?php echo $row->id_produk;?>"><?php echo $row->nama_produk;?></option>
                            <?php }?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Asuransi</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <select class="form-control " id="asuransi">
                          <option value="">-Pilih Asuransi</option>
                          <?php foreach ($getasuransi->result()as $row) {?>
                              <option value = "<?php echo $row->id;?>"><?php echo $row->name;?></option>
                            <?php }?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Rate (%)</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <input type="number" class="form-control entries3" id="rate" name="nama" placeholder="Nilai Rate %">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Premi</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <input type="number" class="form-control entries3" id="premi" name="nama" placeholder="Nilai Premi Rp" min="100000" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label></label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <button type="button" class="btn btn-info btn-flat" id="saveasuransi"><i class="fa fa-save"></i> <b>Simpan Data</b></button>
                        <button type="button" class="btn btn-info btn-flat" ><i class="fa fa-file"></i> <b>Buat Form Akseptasi</b></button>
                      </div>
                    </div>
                  </div>

                </div>  
              </form>
              <!-- endCONTENT -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->

      <div class="modal fade" id="modalasuransi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">DAFTAR QUOTE ASURANSI</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-sm-4">
                  <input type="text" id="contain" class="form-control" placeholder="cari">
                </div>
                <div class="col-md-12 form-group">
                  <table id="example3" class="table table-bordered table-striped row-border highlight" width="100%">
                    <thead>
                      <tr style="background-color: #f3f3f3">
                       <td><b>NO REGISTRASI</b></td>
                       <td><b>NASABAH</b></td>
                       <td><b>ASSET</b></td>
                       <td><b>PRODUK</b></td>
                       <td><b>BROKER</b></td>
                       <td><b>ASURANSI</b></td>
                       <td><b>DATE RELEASE</b></td>
                       <td><b>DATE EXPIRED</b></td>
                       <td><b>TSI</b></td>
                       <td><b>PREMI</b></td>
                       <td><b>PILIH</b></td>
                      </tr> 
                    </thead>
                    <tbody>
                   
                    </tbody>
                  </table>
                </div>
                <div class="col-md-12 form-group">  
                  <div class="row">
                      <div class="col-md-6" id="pagenumber">
                      PAGE 1
                      </div>
                      <div class="col-md-6">
                        <div class="pull-right" id="paging">
                         
                        </div>
                      </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-danger" data-dismiss="modal"><b>Close</b></button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal -->

       <div class="modal fade" id="modalakseptasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">DAFTAR FORM AKSEPTASI</h4> <br>
            </div>
            <div class="modal-body">
                  UNDER CONTRUCTION
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-danger" data-dismiss="modal"><b>Close</b></button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal -->