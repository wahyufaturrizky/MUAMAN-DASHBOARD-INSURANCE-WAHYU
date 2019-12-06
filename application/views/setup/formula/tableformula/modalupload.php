      <div class="modal fade" id="modaluploadtable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-green color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">IMPORT VALUE DATA</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
                <form id="submittable">
                <div class="form-group col-md-4">
                    <label>Pilih File CSV</label>
                </div>
                <div class="col-md-8">
                    <input type="file" class="form-control" name="userfile">
                    <input type="hidden" name="tableid" id="tableid">
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submit_btn" class="btn btn-info"><b>UPLOAD</b></button>
                </form>
                <button type="button" id="close" class="btn btn-danger" data-dismiss="modal"><b>Close</b></button>
            </div>
          </div>
        </div>
      </div>