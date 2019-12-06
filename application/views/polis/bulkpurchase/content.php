 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

        <div class="row">
         <div class="col-sm-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title text-green">BULK PURCHASE POLIS </h3>
              <div class="box-tools pull-right">
                <!-- <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button> -->
              </div>
            </div>
            <div class="box-body">
            <!-- CONTENT -->
            <div class="row">
              <div class="col-sm-4 form-group">
                <select class="form-control" id="asuransi">
                      <option value="-">Asuransi</option>
                      <?php foreach ($getasuransi->result() as $r) :?>
                        <option value="<?php echo $r->id_asuransi;?>"><?php echo $r->nama_asuransi;?></option>
                      <?php endforeach; ?>
                </select>
                <input type="hidden" id="usergroup" value="<?php echo $this->session->userdata('usergroup'); ?>">
              </div>
              <div class="col-sm-3 form-group">
                <select class="form-control" id="produk_id">
                    <option value="-">Produk Asuransi</option>
                </select>
                <input type="hidden" id="id_purchase">
              </div>
              <div class="col-sm-2 form-group">
                <button type="button" class="btn btn-info btn-flat form-control" id="new"><i class="fa fa-upload"></i> <b>UPLOAD FILE *.CSV</b></button>
              </div>
              <div class="col-sm-3 form-group">  
                <button type="button" class="btn btn-info btn-flat form-control" id="download"><i class="fa fa-download"></i> <b>DOWNLOAD TEMPLATE CSV</b></button>
              </div>
            </div>
      
              <!-- endCONTENT -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->
          </div>
        </div>  

        <div class="row" id="requesttbl">
         <div class="col-sm-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title text-green">DAFTAR PENGAJUAN</h3>
              <div class="box-tools pull-right">
              <!--   <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
               --></div>
            </div>
            <div class="box-body">
            <!-- CONTENT -->
            <div class="row" id="purchasetable">
              <div id="controldata" class="col-md-12">  
                <div class="row" id="divupload">
                  <div class="col-sm-8 form-group">
                    <span id="title"></span>
                  </div> 
                  <div class="col-sm-4 form-group">
                    <input type="text" id="contain0" class="form-control" placeholder="cari">
                  </div>
                </div>
              </div>

              <div class="col-md-12 form-group">
                <table id="example0" class="table table-bordered table-striped table-hover row-border highlight" width="100%">
                  <thead>        
                    <tr class="bg-green">           
                        <td><b>ID_PURCHASE</b></td>
                        <td><b>POLIS INDUK ID</b></td>
                        <td><b>TANGGAL PENGAJUAN</b></td>
                        <td><b>DETAIL</b></td>
                        <td><b>SERTIFIKAT</b></td>
                        <td><b>GENERATE SERTIFIKAT</b></td>
                        <td><b>LAMPIRAN SERTIFIKAT</b></td>
                        <?php if($this->session->userdata('usergroup')!='1'):?>
                        <td><b>UPLOAD SERTIFIKAT</b></td>
                        <td><b>PENGAJUAN OLEH</b></td>
                        <?php endif;?>
                    </tr>
                  </thead>
                  <tbody>
                   
                  </tbody>
                </table>
              </div>
              <div id="gentable0">
                
              </div>

                <div class="col-md-12 form-group">  
                  <div class="row">
                      <div class="col-md-6" id="pagenumber0">
                      
                      </div>
                      <div class="col-md-6">
                        <div class="pull-right" id="paging0">
                         
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <!-- endCONTENT -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->
          </div>
        </div>  

        <div class="row" id="membertbl" hidden>
         <div class="col-sm-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title text-green">DAFTAR PENGAJUAN MEMBER : <span id="purchasenumber"></span> </h3>
              <div class="box-tools pull-right">
                <!-- <button class="btn btn-box-tool"><i class="fa fa-minus"></i></button> -->
                <button class="btn btn-box-tool" id="closemember"><i class="fa fa-times"></i> Close</button>
              </div>
            </div>
            <div class="box-body">
            <!-- CONTENT -->
            <div class="row" id="detailtable">
              <div class="col-md-3 form-group">
                    <select class="form-control" id="status">
                      <option value="OPEN" selected>OPEN</option>
                      <option value="APPROVE">APPROVE</option>
                      <option value="PENDING">PENDING</option>
                      <option value="CANCEL">CANCEL</option>
                    </select>
                </div>
                <div class="col-sm-5">
                </div>
                <div class="col-sm-4">
                  <input type="text" id="contain" class="form-control" placeholder="cari">
                </div>
              <div class="col-md-12 form-group">
                <?php if($this->session->userdata('usergroup')!='1'):?>
                  <div class="row">
                      <div class="col-sm-3">
                         <button type="button" class="btn form-control btn-info btn-flat" id="save"><i class="fa fa-save"></i> <b>SIMPAN PEMBAHARUAN DATA</b></button>
                      </div>
                      <div class="col-sm-5">
                      </div>
                      <div class="col-sm-2">
                        <select class="form-control" id="statuscheck">
                            <option value="approve">APPROVE</option>
                            <option value="pending">PENDING</option>
                            <option value="cancel">CANCEL</option>
                        </select>
                      </div>
                      <div class="col-sm-2">
                        <input type="checkbox"  id="selectall" > SELECT/UNSELECT ALL<br>
                        
                      </div>
                  </div>
                <?php endif;?>
              </div>
              <div class="col-md-12 form-group">
                <table id="example1" class="table table-bordered table-hover table-striped row-border highlight" width="100%">
                  <thead>        
                    <tr class="bg-green">           
                        <td><b>NAMA MEMBER</b></td>
                        <td><b>UPDATE TERAKHIR</b></td>
                        <td><b>DETAIL FORM</b></td>
                        <td><b>KETENTUAN ADDITIONAL FORM</b></td>
                        <td><b>ADDITIONAL FORM</b></td>
                        <td><b>STATUS</b></td>
                        <td><b>UPLOAD ADDITIONAL FORM</b></td>
                        <td><b>PROSES</b></td>
                    </tr>
                  </thead>
                  <tbody>
                   
                  </tbody>
                </table>
              </div>
              <div id="gentable">
                
              </div>

                <div class="col-md-12 form-group">  
                  <div class="row">
                      <div class="col-md-6" id="pagenumber">
                      
                      </div>
                      <div class="col-md-6">
                        <div class="pull-right" id="paging">
                         
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            <!-- endCONTENT -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->
          </div>
        </div>  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php $this->view('polis/bulkpurchase/modalupload')?>
      <?php $this->view('polis/bulkpurchase/modalsertifikatdw')?>
      <?php $this->view('polis/bulkpurchase/modaluseradd')?>
      <?php $this->view('polis/bulkpurchase/modalmemberadd')?>
      <?php $this->view('polis/bulkpurchase/modalform')?>
      <?php $this->view('polis/bulkpurchase/modalsuccess')?>
      <?php $this->view('polis/bulkpurchase/modalwarning')?>
      <?php $this->view('polis/bulkpurchase/modalsertifikat')?>
      <?php $this->view('polis/bulkpurchase/modalerror')?>