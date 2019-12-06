      <div class="modal fade" id="modalform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-green color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">SETUP FORM ASURANSI</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-xs-12 col-sm-12">
                  <form method="post" id="form_input">
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-xs-12 col-sm-2">
                          <div class="form-group">     
                            <label>FIELD LIST</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <select class="form-control entries2" id="field_list">
                              
                            </select>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-2">
                          <div class="form-group">     
                            <select class="form-control entries2" id="insertmethod">
                              <option value="last">Last</option>
                              <option value="before">Before</option>
                              <option value="after">After</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-2" id="divfieldid" hidden>
                          <div class="form-group">     
                            <select class="form-control entries2" id="fieldadded">
                              <option value="-">FIELD ID</option>
                            </select>
                          </div>
                        </div>
                         <div class="col-xs-12 col-sm-2">
                          <div class="form-group">     
                            <button type="button" class="btn btn-info btn-flat form-control" id="addfield"><i class="fa fa-plus"></i> <b>Add Field</b></button>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-xs-12 col-sm-12">
                          <div class="form-group" align="center">     
                              <h3><b>CREATE FORM</b></h3>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div id="formcreate" style="height: 300px;width: 100%;overflow-y: auto" align="center">
                          <div class="form-group" align="left" > 
                            <div class="col-sm-12">    
                              <h4><b>MANDATORY FIELD</b></h4>
                            </div>    
                          </div>
                          <div id="formfieldmandatory" style="width: 95%;">
                          
                          </div>
                          <div class="form-group" align="left">
                            <div class="col-sm-12">     
                              <h4><b>CUSTOM FIELD</b></h4>
                            </div>
                          </div>
                          <div id="formfield" style="width: 95%;">
                          
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-xs-12 col-sm-2">
                          <div class="form-group">     
                            <label></label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-10">
                          <div class="form-group pull-right">     
                            <button type="button" class="btn btn-info btn-flat" id="save"><i class="fa fa-save"></i> <b>Simpan Form</b></button>
                            <button type="button" class="btn btn-warning btn-flat" id="update" hidden><i class="fa fa-save"></i> <b>Update Form</b></button>
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