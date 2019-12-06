            <div class="row form-group">
              <div class="col-md-3">
                <input type="text" class="form-control" id="tblname" placeholder="Table Name">
              </div>
              <div class="col-md-3">
                <select class="form-control" id="headername">
                  <option value="-">Header Name</option>
                </select>
              </div>
              <div class="col-md-3">
                <select class="form-control" id="rowname">
                  <option value="-">Row Name</option>
                </select>
              </div>
              <div class="col-md-3">
                <button class="form-control btn btn-flat btn-info" id="savetable"> <i class="fa fa-save"></i> Simpan</button>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 form-group">
               <table id="example1" class="table table-bordered table-striped row-border highlight" width="100%">
                    <thead>
                      <tr class="bg-green">
                       <td><b>Table Name</b></td>
                       <td><b>Header Name</b></td>
                       <td><b>Row Name</b></td>
                       <td><b>Import Value</b></td>
                       <td><b>Show Data</b></td>
                      <td><b>Template</b></td>
                      </tr> 
                    </thead>
                    <tbody>
                   
                    </tbody>
                  </table>
                </div>

                <div class="col-md-12 form-group">  
                  <div class="row">
                      <div class="col-md-6" id="pagenumber">
                      PAGE 1
                      </div>
                      <div class="col-md-6">
                        <div class="pull-right" id="paging">
                         
                        </div>
                      </div>
                  </div>
                </div>
              </div>

  <?php  
    $this->view('setup/formula/tableformula/modalform'); 
  ?>
  <?php  
   $this->view('setup/formula/tableformula/modalupload'); 
  ?>
  <?php  
   $this->view('setup/formula/tableformula/modaldatatable'); 
  ?>
