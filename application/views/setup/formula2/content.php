 <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <ol class="breadcrumb">
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

        <div class="row" id="setupform">
         <div class="col-sm-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title text-green">SETUP FORMULA</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <!-- CONTENT -->
            <div class="row">
              <div class="col-sm-2 form-group">
                <button type="button" class="btn btn-info btn-flat form-control" id="new"><i class="fa fa-save"></i> <b>TAMBAH DATA</b></button>
              </div>
              <div class="col-sm-4">
                <input type="hidden" id="contain" class="form-control" placeholder="cari">
              </div>
            </div>
              <div class="row">
                <div class="col-md-12 form-group" id="formgenerated">

                </div>
              </div>



            <div class="row">
              <div class="col-md-12 form-group">
               <table id="example1" class="table table-bordered table-striped row-border highlight" width="100%">
                    <thead>
                      <tr class="bg-green">
                       <td><b>ID DETAIL POLIS </b></td>
                       <td><b>KELAS PEKERJAAN</b></td>
                       <td><b>UMUR MINIMAL</b></td>
                       <td><b>UMUR MAXIMAL</b></td>
                       <td><b>GENDER</b></td>
                       <td><b>PERIODE TAHUN MINIMAL</b></td>
                       <td><b>PERIODE TAHUN MAXIMAL</b></td>
                       <td><b>TIPE PREMI</b></td>
                       <td><b>SUM INSURER</b></td>
                       <td><b>RATE PREMI</b></td>
                       <td><b>JUMLAH PREMI</b></td>
                       <td><b>MATA UANG</b></td>
                       <td><b>STATUS</b></td>
                       <td><b>EDIT </b></td>
                       <td><b>DELETE </b></td>
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
            <!-- endCONTENT -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->
          </div>
        </div>  
        <div class="row" id="formshow" hidden>
          <div class="col-sm-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title text-green">Form <span id="produk_name"></span> <span id="asuransi_name"></span> </h3>
                <div class="box-tools pull-right">
                  <button class="btn btn-danger btn-flat" id="closeformex"><i class="fa fa-close"></i> CLOSE FORM</button>  
                </div>
              </div>
              <div class="box-body">
              <!-- CONTENT -->
              <div id="contentform">
                  
              </div>

              <!-- endCONTENT -->
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div>
        </div> 
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

  <?php  
    $this->view('setup/formula2/modalform'); 
  ?>
  <?php  
    $this->view('setup/formula2/modalsuccess'); 
  ?>
  <?php  
    $this->view('setup/formula2/modalwarning'); 
  ?>
  <?php  
    $this->view('setup/formula2/modalerror'); 
  ?>
  <?php  
    $this->view('setup/formula2/modaldelete'); 
  ?>
  <?php  
   //$this->view('setup/formula2/modalupload'); 
  ?>
