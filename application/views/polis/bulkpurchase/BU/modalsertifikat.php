      <div class="modal fade" id="modalsertifikat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-green color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">UPLOAD SERTIFIKAT</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
                <form id="sertifikat">
                <div class="form-group col-md-4">
                  <label>ID_PURCHASE</label>
                </div>
                <div class="form-group col-md-8">
                  <input type="text" id="sm_id_purchase" class="form-control" name="id_purchase" readonly>
                </div>
                <div class="form-group col-md-4">
                    <label>Pilih File CSV</label>
                </div>
                <div class="col-md-8">
                    <input type="file" class="form-control" name="userfile">
                </div>
              </div>
               <div class="col-md-12" id="s_importprogress" hidden>
                  <div>SEDANG UPLOAD DOKUMEN MOHON TUNGGU ...</div><div class="progress active"><div id = "bar" class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>
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