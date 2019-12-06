      <div class="modal fade" id="modalform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-green color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">SETUP CONDITION</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-xs-12 col-sm-12">
                  <form method="post" id="form_input">
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>CONDITION NAME</label>
                          </div>
                        </div>

                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <input type="text" class="form-control" id="conname">
                          </div>
                        </div>
                      </div>

                      <?php 
                          $rule_fields = explode("|", $fields);
                          for ($i=0; $i < count($rule_fields) ; $i++) :  
                      ?>

                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label><?php echo $rule_fields[$i]?></label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">
                            <input type="text" class="form-control values" id="value-<?php echo str_replace(" ","_",$rule_fields[$i]);?>">
                          </div>
                        </div>
                      </div>

                    <?php endfor; ?>
                      <div class="row" >
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>RESULT</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <select class="form-control entries2" id="result">
                              <option value="-">RESULT</option>
                              <option value="ACCEPT">ACCEPT</option>
                              <option value="ADDITIONAL">FORM TAMBAHAN</option>
                              <option value="REJECT">REJECT</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row" >
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>ADDITIONAL FORM</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <select class="form-control entries2" id="addform">
                              <option value="-">PILIHAN</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 col-sm-2">
                          <div class="form-group">     
                            <label></label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-10">
                          <div class="form-group pull-right">     
                            <button type="button" class="btn btn-info btn-flat" id="save"><i class="fa fa-save"></i> <b>Simpan Data</b></button>
                            <button type="button" class="btn btn-warning btn-flat" id="update" hidden="hidden"><i class="fa fa-save"></i> <b>Update Data</b></button>
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