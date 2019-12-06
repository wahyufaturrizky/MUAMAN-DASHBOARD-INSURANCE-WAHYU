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
              <h3 class="box-title text-green">SETUP FORM FIELD</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <!-- CONTENT -->
            <div class="row">
              <div class="col-sm-4 form-group">
                <select class="form-control" id="produk_id">
                      <option value="-">Choose Product</option>
                      <?php foreach ($getproduk->result() as $r) :?>
                        <option value="<?php echo $r->id_produk;?>"><?php echo $r->nama_produk;?></option>
                      <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-2 form-group">
                <button type="button" class="btn btn-info btn-flat form-control" id="new"><i class="fa fa-save"></i> <b>DATA BARU</b></button>
              </div>
              <div class="col-sm-6"></div>
              <div class="col-sm-4">
                <input type="text" id="contain" class="form-control" placeholder="cari">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 form-group">
               <table id="example1" class="table table-bordered table-striped row-border highlight" width="100%">
                    <thead>
                      <tr class="bg-green">
                        <td><b>ID FIELD</b></td>
                        <td><b>CAPTION FIELD</b></td>
                        <td><b>TYPE</b></td>
                        <td><b>EXAMPLE</b></td>
                        <td><b>MASTER LOV</b></td>
                        <td><b>EDIT</b></td>
                        <td><b>DELETE</b></td>
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
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <?php  
    $this->view('setup/setupfield/modalform'); 
  ?>
  <?php  
    $this->view('setup/setupfield/modalsuccess'); 
  ?>
  <?php  
    $this->view('setup/setupfield/modalwarning'); 
  ?>
  <?php  
    $this->view('setup/setupfield/modalerror'); 
  ?>
    <?php  
    $this->view('setup/setupfield/modaldelete'); 
  ?>