      <div class="modal fade" id="modalupload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-green color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">UPLOAD FILE FORM TAMBAHAN *.PDF</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
                <form id="submit">
                <div class="form-group col-md-4">
                  <label>ID POLIS INDUK</label>
                </div>
                <div class="form-group col-md-8">
                  <input type="text" class="form-control" name="id_polis" id="id_polis" value="">
                </div>
                <div class="form-group col-md-4">
                  <label>POLIS DETAIL ID</label>
                </div>
                <div class="form-group col-md-8">
                  <input type="text" class="form-control" name="polisdetail" id="polisdetail" value="">
                </div>
                <div class="form-group col-md-4">
                  <label>JENIS POLIS</label>
                </div>
                <div class="form-group col-md-8">
                  <select class="form-control" id="jenispolis" name="jenispolis">
                    <option value="master">MASTER</option>
                    <option value="endorsement">ENDORSEMENT</option>
                    <option value="cancelation">CANCELATION</option>
                    <option value="cancelation">RENEWAL</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label>TANGGAL MULAI PERIODE</label>
                </div>
                <div class="form-group col-md-8">
                  <input type="text" class="form-control datepicker" name="periodestart" id="periodestart" value="">
                </div>
                <div class="form-group col-md-4">
                  <label>TANGGAL AKHIR PERIODE</label>
                </div>
                <div class="form-group col-md-8">
                  <input type="text" class="form-control datepicker" name="periodeend" id="periodeend" value="">
                </div>
                <div class="form-group col-md-4">
                  <label>PEMEGANG POLIS</label>
                </div>
                <div class="form-group col-md-8">
                  <input type="text" class="form-control" name="pemegang" id="pemegang" value="">
                </div>
                <div class="form-group col-md-4">
                  <label>NAMA PEMEGANG POLIS</label>
                </div>
                <div class="form-group col-md-8">
                  <input type="text" class="form-control" name="nama" id="nama" value="">
                </div>
                <div class="form-group col-md-4">
                  <label>STATUS</label>
                </div>
                <div class="form-group col-md-8">
                  <select class="form-control" name="state" id="state">
                    <option value="-">STATUS</option>
                    <option value="1">AKTIF</option>
                    <option value="0">TIDAK AKTIF</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                    <label>PILIH FILE PDF</label>
                </div>
                <div class="col-md-8">
                    <input type="file" class="form-control" name="userfile">
                    <input type="hidden" name="id_asuransi" id="modalasuransi">
                    <input type="hidden" name="id_produk" id="modalproduk">
                    <input type="hidden" name="id_client" id="modalclient">
                    <input type="hidden" name="filename" id="filename">
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