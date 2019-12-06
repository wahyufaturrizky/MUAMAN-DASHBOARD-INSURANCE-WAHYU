      <div class="modal fade" id="modalform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-green color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">SETUP FIELD</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-xs-12 col-sm-12">
                  <form method="post" id="form_input">
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>ID FIELD</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <input type="text" class="form-control " id="id_field" name="nama" placeholder="ex :F0001">
                          </div>
                        </div>
                      </div>

                     <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>FIELD CAPTION</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <input type="text" class="form-control entries2" id="caption" name="nama" placeholder="">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>TYPE</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <select class="form-control" id="type">
                              <option value="TEXT">TEXT</option>
                              <option value="LOV">LIST OF VALUE</option>
                               <option value="CHECK">MULTIPLE VALUE</option>
                              <option value="DATE">DATE</option>
                              <option value="NUMBER">NUMBER</option>
                              <option value="TELP">TELP</option>
                              <option value="EMAIL">EMAIL</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row" id="divlov" hidden>
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>MASTER LIST OF VALUE</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <!-- <input type="text" class="form-control entries2" id="lov" name="nama" placeholder="ex : 1|2|3"> -->
                            <select id="lov" class="entries2 form-control">
                                  <option value="">MASTER DATA</option>
                                <?php foreach ($getmaster->result() as $v) :?>
                                  <option value="<?php echo $v->master_name;?>"><?php echo $v->master_name;?></option>
                                <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>EXAMPLE VALUE</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <input type="text" class="form-control entries2" id="exvalue" name="nama" placeholder="1">
                          </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label></label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <button type="button" class="btn btn-info btn-flat" id="save"><i class="fa fa-save"></i> <b>Simpan Data</b></button>
                            <button type="button" class="btn btn-warning btn-flat" id="update" hidden><i class="fa fa-save"></i> <b>Update Data</b></button>
                            <button type="button" id="close" class="btn btn-danger" data-dismiss="modal"><b>Cancel</b></button>
                          </div>
                        </div>
                      </div>

                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal-footer">
    
            </div>
          </div>
        </div>
      </div>
      <!-- modal -->