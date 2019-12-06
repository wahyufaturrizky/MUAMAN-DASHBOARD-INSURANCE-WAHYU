      <div class="modal fade" id="modalsertifikat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                  <label>DESKRIPSI</label>
                </div>
                <div class="form-group col-md-8">
                  <input type="text" id="sm_desc" class="form-control" name="sm_desc" >
                </div>
                <div class="form-group col-md-4">
                    <label>FILE PDF</label>
                </div>
                <div class="col-md-8">
                    <input type="file" class="form-control" name="userfile">
                </div>
              </div>
               <div class="col-md-12" id="s_importprogress" hidden>
                  <div>SEDANG UPLOAD DOKUMEN MOHON TUNGGU ...</div><div class="progress active"><div id = "bar" class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>
              </div>
              <br>
              <br>
              <table  class="table table-bordered table-striped table-hover row-border highlight" width="100%">
                  <thead>        
                    <tr class="bg-green">           
                        <td><b>DOWNLOAD SERTIFIKAT</b></td>
                        <td><b>DESKRIPSI SERTIFIKAT</b></td>
                        <td><b>TANGGAL UPLOAD</b></td>
                    </tr>
                  </thead>
                  <tbody class="sertifikat_tbl">
                   
                  </tbody>
              </table>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submit_btn" class="btn btn-info"><b>UPLOAD</b></button>
                </form>
                <button type="button" id="close" class="btn btn-danger" data-dismiss="modal"><b>Close</b></button>
            </div>
          </div>
        </div>
      </div>