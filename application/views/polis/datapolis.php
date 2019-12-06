            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title text-blue">DATA POLIS</h3>
                <input type="hidden" id="idbrokerposition" value="<?php echo $this->session->userdata('usergroup');?>">
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <ul class="nav nav-tabs">
                    <li id="forig"class="active"><a href="#tab_1" data-toggle="tab">Original</a></li>
                    <li id="fopen"><a href="#tab_1" data-toggle="tab">Open</a></li>
                    <li id="fprocess"><a href="#tab_1" data-toggle="tab">Process</a></li>
                    <li id="fclose"><a href="#tab_1" data-toggle="tab">Close</a></li>
                    <li id="ffailed1"><a href="#tab_1" data-toggle="tab">Failed1</a></li>
                    <li id="ffailed2"><a href="#tab_1" data-toggle="tab">Failed2</a></li>
                    <li id="frequested"><a href="#tab_2" data-toggle="tab">Requested</a></li>
                  </ul>
                  <input type="hidden" id="flagquote" value="1">
                </div>

                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div class="row">
                      <div class="col-sm-2 form-group">
                        <button type="button" class="btn btn-info btn-flat form-control" id="new"><i class="fa fa-save"></i> <b>DATA BARU</b></button>
                      </div>
                      <div class="col-sm-6"></div>
                      <div class="col-sm-4">
                        <input type="text" id="containquote" class="form-control" placeholder="cari">
                      </div>
                      <div class="col-md-12 form-group">
                        <table id="example3" class="table table-bordered table-striped row-border highlight" width="100%">
                          <thead>
                            <tr style="background-color: #f3f3f3">
                             <td><b>NO REGISTRASI</b></td>
                             <td><b>NASABAH</b></td>
                             <td><b>ASSET</b></td>
                             <td><b>PRODUK</b></td>
                             <td><b>BROKER</b></td>
                             <td><b>ASURANSI</b></td>
                             <td><b>DATE RELEASE</b></td>
                             <td><b>DATE EXPIRED</b></td>
                             <td><b>TSI</b></td>
                             <td><b>PREMI</b></td>
                             <td><b>FLAG</b></td>
                             <td><b>PILIH</b></td>
                            </tr> 
                          </thead>
                          <tbody>
                         
                          </tbody>
                        </table>
                      </div>
                      <div class="col-md-12 form-group">  
                        <div class="row">
                            <div class="col-md-6" id="pagenumberquote">
                            PAGE 1
                            </div>
                            <div class="col-md-6">
                              <div class="pull-right" id="pagingquote">
                               
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_2">
                    <div class="row">
                      <div class="col-sm-8"></div>
                      <div class="col-sm-4">
                        <input type="text" id="containassetreq" class="form-control" placeholder="cari">
                      </div>
                      <div class="col-md-12 form-group">
                        <table id="example4" class="table table-bordered table-striped row-border highlight" width="100%">
                          <thead>
                            <tr style="background-color: #f3f3f3">
                             <td><b>NASABAH</b></td>
                             <td><b>ASSET</b></td>
                             <td><b>ALAMAT</b></td>
                             <td><b>TSI</b></td>
                             <td><b>STATUS REQUEST</b></td>
                             <td><b>PILIH</b></td>
                            </tr> 
                          </thead>
                          <tbody>
                         
                          </tbody>
                        </table>
                      </div>
                      <div class="col-md-12 form-group">  
                        <div class="row">
                            <div class="col-md-6" id="pagenumberassetreq">
                            PAGE 1
                            </div>
                            <div class="col-md-6">
                              <div class="pull-right" id="pagingassetreq">
                               
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
            </div>