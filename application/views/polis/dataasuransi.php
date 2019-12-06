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
                <div class="col-sm-12 form-group" style="height: 370px;overflow: auto;">

                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>No Registrasi</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <input type="text" class="form-control entries2" id="registrasi" name="nama" placeholder="Nomor Registrasi">
                        <input type="hidden" id="idregistrasi">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Periode</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                      <div class="form-group">     
                        <input type="text" class="form-control entries2 datepicker datemask" id="periode1" name="nama" placeholder="YYYY-MM-DD" style="padding-left: 10px" >
                      </div>
                    </div>
                     <div class="col-xs-12 col-sm-1">
                      <div class="form-group">     
                        <label>sd</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                      <div class="form-group">     
                        <input type="text" class="form-control entries2 datepicker datemask" id="periode2" name="nama" placeholder="YYYY-MM-DD" style="padding-left: 10px" >
                      </div>
                    </div>
                  </div>
<!--                   <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Periode 2</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <input type="text" class="form-control entries2 datepicker datemask" id="periode2" name="nama" >
                      </div>
                    </div>
                  </div> -->
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Produk</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <select class="form-control entries2" id="produk">
                          <option value="">-Pilih Produk</option>
                          <?php foreach ($getproduk->result()as $row) {?>
                              <option value = "<?php echo $row->id_produk;?>"><?php echo $row->nama_produk;?></option>
                            <?php }?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div id="detailform">
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
                          <option value="0">-Pilih Asuransi</option>
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
                        <input type="number" class="form-control entries2" id="rate" name="nama" placeholder="Nilai Rate %">
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
                        <input type="text" class="form-control entries2" id="premi" name="nama" placeholder="Nilai Premi Rp" min="100000" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Flag</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <select class="form-control " id="flag">
                          <option value="">-Pilih Flag</option>
                          <?php foreach ($getflag->result()as $row) {?>
                              <option value = "<?php echo $row->id;?>"><?php echo $row->description;?></option>
                            <?php }?>
                        </select>
                      </div>
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
                        <!-- <button type="button" class="btn btn-info btn-flat" ><i class="fa fa-file"></i> <b>Buka Form Detail</b></button> -->
                        <button type="button" class="btn btn-info btn-flat" id="saveasuransi"><i class="fa fa-save"></i> <b>Simpan</b></button>
                        <button type="button" class="btn btn-info btn-flat" id="clear" ><i class="fa fa-close"></i> <b>Tutup</b></button>
                        <button type="button" class="btn btn-info btn-flat" id="gotopdf" ><i class="fa fa-file"></i> <b>PDF</b></button>
                        <button type="button" class="btn btn-info btn-flat" id="sendmail" ><i class="fa fa-envelope"></i> <b>Kirim Email</b></button>
                      </div>
                    </div>
                  </div>

                
              </form>
              <!-- endCONTENT -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->

      <div class="modal fade" id="modalsendemail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">SENDING EMAIL</h4> <br>
            </div>
            <div class="modal-body">

              <div class="progress progress-md active">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                  <span class="sr-only">SENDING EMAIL</span>
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
      <!-- modal -->