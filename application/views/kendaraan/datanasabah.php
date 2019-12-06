            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title text-blue">DATA NASABAH</h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              
              <div class="box-body">
              <!-- CONTENT -->
                <div class="col-sm-12">

                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <label>Nama Nasabah</label>
                      </div>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="form-group">     
                        <input type="text" class="form-control entries2" id="namanasabah" name="nama" placeholder="Nama Nasabah">
                        <input type="hidden" class="form-control" id="idnasabah" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                      </div>
                    </div>  
                    <div class="col-xs-12 col-sm-3">
                      <div class="form-group">     
                        <button class="btn btn-info btn-flat" id="datanasabah"><i class="fa fa-folder-open"></i> <b>Buka data nasabah</b></button>
                      </div>
                    </div>
                  </div>

                </div>
                <!-- endCONTENT -->

              </div><!-- /.box-body -->

            </div><!-- /.box -->

      <!-- modal success -->
      <div class="modal fade" id="modalnasabah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">PILIH DATA NASABAH</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-8"></div>
                <div class="col-sm-4">
                  <input type="text" id="contain" class="form-control" placeholder="cari">
                </div>
                <div class="col-md-12 form-group">
                  <table id="example1" class="table table-bordered table-striped row-border highlight" width="100%">
                    <thead>
                      <tr style="background-color: #f3f3f3">
                       <td><b>NASABAH</b></td>
                       <td><b>ALAMAT</b></td>
                       <td><b>EMAIL</b></td>
                       <td><b>TELP</b></td>
                       <td><b>TYPE</b></td>
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