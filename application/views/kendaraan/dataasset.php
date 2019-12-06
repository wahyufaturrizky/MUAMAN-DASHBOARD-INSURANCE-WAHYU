            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title text-blue">DATA ASSET KENDARAAN</h3>
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
                        <label>Nama Asset</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <input type="text" class="form-control entries2" id="nama" name="nama" placeholder="Nama Asset">
                        <input type="hidden" id="idassets">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Nilai Asset(TSI)</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <input type="number" class="form-control entries2" id="tsi" name="nama" placeholder="Nilai Asset Rp" min="100000000">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Alamat Asset</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <textarea class="form-control entries2" id="address" rows="8"></textarea>
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
                        <!-- <button type="button" class="btn btn-info btn-flat" id="saveassets"><i class="fa fa-save"></i> <b>Simpan Data</b></button> -->
                        <button type="button" class="btn btn-info btn-flat" id="dataassets"><i class="fa fa-folder-open"></i> <b>Buka Daftar Assets</b></button>
                      </div>
                    </div>
                  </div>

                </div>  
              </form>
              <!-- endCONTENT -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->

    <!-- modal success -->
      <div class="modal fade" id="modalasset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">DAFTAR ASSET NASABAH</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-sm-4">
                  <input type="text" id="containasset" class="form-control" placeholder="cari">
                </div>
                <div class="col-md-12 form-group">
                  <table id="example2" class="table table-bordered table-striped row-border highlight" width="100%">
                    <thead>
                      <tr style="background-color: #f3f3f3">
                       <td><b>NASABAH</b></td>
                       <td><b>ASSET</b></td>
                       <td><b>ALAMAT</b></td>
                       <td><b>TSI</b></td>
                       <td><b>PILIH</b></td>
                      </tr> 
                    </thead>
                    <tbody>
                   
                    </tbody>
                  </table>
                </div>
                <div class="col-md-12 form-group">  
                  <div class="row">
                      <div class="col-md-6" id="pagenumberasset">
                      PAGE 1
                      </div>
                      <div class="col-md-6">
                        <div class="pull-right" id="pagingasset">
                         
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