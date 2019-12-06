            <!-- Subtotal -->
            <div class="form-group" center>
              <b>Sub Total</b>
            </div>
            <div class="row form-group">
              <div class="col-md-3">
                  <input type="text" class="form-control" id="varname" name="" placeholder="Variable Name">
                </div>
              <div class="col-md-3">
                <select class="form-control" id="varsource">
                  <option value="-">Variable Type</option>
                  <option value="1">User Input</option>
                  <option value="2">Form Refrence </option>
                  <option value="3">Table Refrence </option>
                </select>
              </div>
              <div id="vartype1" class="vartype">
                <div class="col-md-3">
                  <input type="text" class="form-control" id="formula1" name="" placeholder="value">
                </div>
              </div>
              <div id="vartype2" class="vartype" hidden>
                <div class="col-md-3">
                  <select class="form-control formref" id="formula2">
                    <option value="-">Field List</option>
                  </select>
                </div>
              </div>
              <div id="vartype3" class="vartype" hidden>
                <div class="col-md-3">
                  <select class="form-control tblref" id="formula3">
                    <option value="-">Table</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <button class="form-control btn btn-flat btn-info" id="addvar"> <i class="fa fa-plus"></i> Tambahkan ke Formula</button>
              </div>
            </div>
            <div class="row form-group">
              <div>
                <div class="col-md-1">
                  <select class="form-control" id="varoperator">
                    <option value="+">+</option>
                    <option value="-">-</option>
                  </select>
                </div>
              </div>
              <div class="col-md-8">
                <input type="text" class="form-control" id="varformula" name="" placeholder="Variable formula">
                <p>operator : * = kali, / = bagi</p>
              </div>
              <div class="col-md-3">
                <button class="form-control btn btn-flat btn-info" id="savevar"> <i class="fa fa-save"></i> Simpan Formula</button>
              </div>
            </div>
            <div class="row form-group" id="formulavariable">
                
            </div>
            <hr>
            <!-- //adjustment -->
            <div class="form-group" center>
              <b>Adjustment</b>
            </div>
            <div class="row form-group">
              <div class="col-md-3">
                  <input type="text" class="form-control" id="adjname" name="" placeholder="Adjustment Name">
                </div>
              <div class="col-md-2">
                <select class="form-control" id="adjvaluetype">
                  <option value="-">Value Type</option>
                  <option value="1">Flat</option>
                  <option value="2">Proporsi </option>
                </select>
              </div>
              <div class="col-md-2">
                <select class="form-control" id="adjsource">
                  <option value="-">Adjustment Type</option>
                  <option value="1">User Input</option>
                  <option value="2">Form Refrence </option>
                </select>
              </div>
              <div id="adjtype1" class="adjtype">
                <div class="col-md-2">
                  <input type="text" class="form-control" id="adjformula1" name="" placeholder="Adjustment value">
                </div>
              </div>
              <div id="adjtype2" class="adjtype" hidden>
                <div class="col-md-2">
                  <select class="form-control formref" id="adjformula2">
                    <option value="-">Field List</option>
                  </select>
                </div>
              </div>
              <div class="col-md-1">
                  <select class="form-control" id="adjoperator">
                    <option value="-">+</option>
                    <option value="-">-</option>
                  </select>
              </div>
              <div class="col-md-2">
                <button class="form-control btn btn-flat btn-info" id="saveadj"> <i class="fa fa-save"></i> Simpan Adjustment</button>
              </div>
            </div>
            <div class="row form-group" id="formulavariable">
                
            </div>
            <hr>
            <!-- //tax -->
            <div class="form-group" center>
              <b>Tax</b>
            </div>
            <div class="row form-group">
              <div class="col-md-3">
                  <input type="text" class="form-control" id="taxname" name="" placeholder="Tax Name">
                </div>
              <div class="col-md-2">
                <select class="form-control" id="taxvaluetype">
                  <option value="-">Tax Type</option>
                  <option value="1">Flat</option>
                  <option value="2">Proporsi </option>
                </select>
              </div>
              <div id="taxtype1">
                <div class="col-md-3">
                  <input type="text" class="form-control" id="taxformula" name="" placeholder="Tax value">
                </div>
              </div>
              <div class="col-md-2">
                <button class="form-control btn btn-flat btn-info" id="savetax"> <i class="fa fa-save"></i> Simpan Tax</button>
              </div>
            </div>
            <div class="row form-group" id="formulavariable">
                
            </div>