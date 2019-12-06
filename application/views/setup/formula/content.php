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
              <h3 class="box-title text-green">SETUP FORMULA </h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <!-- CONTENT -->
            <div class="row">
              <div class="col-sm-3 form-group">
                <select class="form-control" id="client">
                      <option value="-">Klien</option>
                      <?php foreach ($getnasabah->result() as $r) :?>
                        <option value="<?php echo $r->id;?>"><?php echo $r->name;?></option>
                      <?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm-3 form-group">
                <select class="form-control" id="asuransi">
                      <option value="-">Asuransi</option>
                      <?php foreach ($getasuransi->result() as $r) :?>
                        <option value="<?php echo $r->id_asuransi;?>"><?php echo $r->nama_asuransi;?></option>
                      <?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm-3 form-group">
                <select class="form-control" id="produk_id">
                    <option value="-">Produk Asuransi</option>
                </select>
              </div>
              <div class="col-sm-3 form-group">
                <select class="form-control" id="polis_id">
                    <option value="-">Id Polis</option>
                </select>
              </div>
              
             <input type="hidden" id="contain" class="form-control" placeholder="cari">
              
            </div>

            <!-- endCONTENT -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->
          </div>
        </div>  

      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active col-sm-2"><a href="#tab_1" data-toggle="tab">Table Refrence</a></li>
              <li class="col-sm-2"><a href="#tab_2" data-toggle="tab">Gross Payment</a></li>
              <li class="col-sm-2"><a href="#tab_3" data-toggle="tab">Shares</a></li>
              <li class="col-sm-2"><a href="#tab_4" data-toggle="tab">Net Payment</a></li>
            </ul>
            <div class="tab-content">
              <!-- <input type="text" id="tabno" value="1"> -->
              <div class="tab-pane active" id="tab_1">
               <?php $this->view('setup/formula/tableformula/content'); ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <?php $this->view('setup/formula/gross/content'); ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <?php $this->view('setup/formula/shares/content'); ?>
              </div>
              <div class="tab-pane" id="tab_4">
                
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>



        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->

  <?php  
    //$this->view('setup/ruletblrefrence/modalform'); 
  ?>
  <?php  
    $this->view('setup/ruletblrefrence/modalsuccess'); 
  ?>
  <?php  
    $this->view('setup/ruletblrefrence/modalwarning'); 
  ?>
  <?php  
    $this->view('setup/ruletblrefrence/modalerror'); 
  ?>
  <?php  
    $this->view('setup/ruletblrefrence/modaldelete'); 
  ?>
  <?php  
   //$this->view('setup/ruletblrefrence/modalupload'); 
  ?>
