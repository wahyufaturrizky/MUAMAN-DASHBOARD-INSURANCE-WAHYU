            <div class="form-group" center>
              <b>Shares</b>
            </div>
            <div class="row form-group">
              <div class="col-md-4">
                  <input type="text" class="form-control" id="shaname" name="" placeholder="Shares Name">
                </div>
              <div class="col-md-3">
                <select class="form-control" id="shavaluetype">
                  <option value="-">Value Type</option>
                  <option value="1">Flat</option>
                  <option value="2">Proporsi </option>
                </select>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-4">
                <select class="form-control" id="shasource">
                  <option value="-">Shares Type</option>
                  <option value="1">User Input</option>
                  <option value="2">Form Refrence </option>
                </select>
              </div>
              <div id="shatype1" class="shatype">
                <div class="col-md-3">
                  <input type="text" class="form-control" id="shaformula1" name="" placeholder="Shares value">
                </div>
              </div>
              <div id="shatype2" class="shatype" hidden>
                <div class="col-md-3">
                  <select class="form-control formref" id="shaformula2">
                    <option value="-">Field List</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-7">
                  <select class="form-control" id="shapropto">
                    <option value="">FROM </option>
                    <option value="(SUBTOTAL)">SUBTOTAL GROSS </option>
                    <option value="(SUBTOTAL+TAX)">SUBTOTAL GROSS + TAX</option>
                    <option value="(SUBTOTAL+ADJUSTMENT)">SUBTOTAL GROSS + ADJUSTMENT</option>
                    <option value="(SUBTOTAL+TAX+ADJUSTMENT)">SUBTOTAL GROSS + ADJUSTMENT + TAX</option>
                  </select>
              </div>
              <div class="col-md-2">
                <button class="form-control btn btn-flat btn-info" id="savesha"> <i class="fa fa-save"></i> Simpan </button>
              </div>
            </div>
            <div class="row form-group" id="formulavariable">
                
            </div>