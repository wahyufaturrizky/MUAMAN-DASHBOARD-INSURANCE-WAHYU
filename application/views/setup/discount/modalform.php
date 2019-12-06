      <div class="modal fade" id="modalform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-green color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">TAMBAH SETUP DiSCOUNT</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-xs-12 col-sm-12">
                  <form method="post" id="form_input">
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>DISKON OLEH</label>
                          </div>
                        </div>

                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <select class="form-control" id="discountby" name="discountby">
                                <option value="INSURER">INSURER</option>
                                <option value="INTERNAL ADMIN COST">INTERNAL ADMIN COST</option>
                            </select>
                            <input type="hidden" id="discountid">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>DISKON TIPE</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <select class="form-control" id="discounttype" name="discounttype">
                                <option value="rate">RATE</option>
                                <option value="absolute">ABSOLUTE</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>DISKON RATE</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                              <input type="text" id="discountrate" name="discountrate" class="form-control">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>JUMLAH DISKON</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                              <input type="text" id="discountamount" name="discountamount" class="form-control">
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