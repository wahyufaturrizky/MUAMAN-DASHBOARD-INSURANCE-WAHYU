      <div class="modal fade" id="modalform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-green color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">TAMBAH SETUP commision</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-xs-12 col-sm-12">
                  <form method="post" id="form_input">
                    <div class="col-sm-12">

                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>THIRD PARTY ID</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                              <input type="text" id="thirdpartyid" name="thirdpartyid" class="form-control">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>KATEGORI KOMISI</label>
                          </div>
                        </div>

                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <select class="form-control" id="commisioncategory" name="commisioncategory">
                                <option value="BROKERAGE">BROKERAGE</option>
                                <option value="COMMISION_OUT">COMMISION OUT</option>
                            </select>
                            <input type="hidden" id="commisionid">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>TIPE KOMISI</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <select class="form-control" id="commisiontype" name="commisiontype">
                                <option value="RATE">RATE</option>
                                <option value="ABSOLUTE">ABSOLUTE</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>RATE KOMISI</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                              <input type="text" id="commisionrate" name="commisionrate" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>JUMLAH KOMISI</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                              <input type="text" id="commisionamount" name="commisionamount" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-xs-12 col-sm-12">
                  <div class="form-group pull-right">     
                    <button type="button" class="btn btn-info btn-flat" id="save"><i class="fa fa-save"></i> <b>Simpan Data</b></button>
                    <button type="button" class="btn btn-warning btn-flat" id="update" hidden="hidden"><i class="fa fa-save"></i> <b>Update Data</b></button>
                    <button type="button" id="close" class="btn btn-danger" data-dismiss="modal"><b>Cancel</b></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- modal -->