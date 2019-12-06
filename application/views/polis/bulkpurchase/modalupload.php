      <div class="modal fade" id="modalupload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-green color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">IMPORT CSV FILE</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
              <form id="submit">
              <div class="form-group col-md-4">
                <label>Email yang digunakan</label>
              </div>
              <?php
                $email ='';
                foreach ($getemail->result() as $k) {
                  $email = $k->email;
                }
              ?>
              <div class="form-group col-md-8">
                <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
              </div>
              <div class="form-group col-md-4">
                  <label>Pilih Polis Induk </label>
              </div>
              <div class="form-group col-md-8">
                  <select class="form-control" id="polisinduk" name="id_polis">
                    
                  </select>
              </div>
              <div class="form-group col-md-4">
                  <label>Pilih File CSV</label>
              </div>
              <div class="col-md-8">
                  <input type="file" class="form-control" name="userfile">
                  <input type="hidden" name="id_asuransi" id="modalasuransi">
                  <input type="hidden" name="id_produk" id="modalproduk">
              </div>
              <div class="col-md-12" id="importprogress" hidden>
                  <div>SEDANG IMPORT DATA MOHON TUNGGU ...</div><div class="progress active"><div id = "bar" class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>
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