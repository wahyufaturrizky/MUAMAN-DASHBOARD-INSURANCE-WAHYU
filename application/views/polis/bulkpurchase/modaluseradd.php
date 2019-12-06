      <div class="modal fade" id="modaluseradd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-green color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">SET FORM TAMBAHAN</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="form-group col-md-4">
                  <label>ID_PURCHASE</label>
                </div>
                <div class="form-group col-md-8">
                  <input type="text" id="uaf_id_purchase" class="form-control" name="id_purchase" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label>ID MEMBER</label>
                </div>
                <div class="form-group col-md-8">
                  <input type="text" id="uaf_id_member" class="form-control" name="id_member" readonly>
                  <!-- <input type="text" id="uaf_id_bank" class="form-control" name="id_bank" readonly> -->
                </div>
                <div class="form-group col-md-4">
                    <label>FORM TAMBAHAN</label>
                </div>
                <div class="col-md-8">
                    <select id="uaf_id_addform" class="form-control" name="uaf_id_addform">
                      
                    </select>
                </div>
              </div>
              <br>
              <br>
              <table class="table table-bordered table-striped table-hover row-border highlight" width="100%">
                  <thead>        
                    <tr class="bg-green">           
                        <td><b>FORM TAMBAHAN</b></td>
                        <td><b>TEMPLATE FORM TAMBAHAN</b></td>
                        <td><b>UPLOAD DARI MEMBER</b></td>
                        <td><b>TANGGAL UPLOAD</b></td>
                    </tr>
                  </thead>
                  <tbody class="addform_tbl">
                   
                  </tbody>
              </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="addform-save" class="btn btn-info"><b>Save</b></button>
                <button type="button" id="close" class="btn btn-danger" data-dismiss="modal"><b>Close</b></button>
            </div>
          </div>
        </div>
      </div>