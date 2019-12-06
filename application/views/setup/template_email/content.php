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
              <h3 class="box-title text-blue">Template Email</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <!-- CONTENT -->
            <div class="col-sm-2 form-group">
              <button type="button" class="btn btn-info btn-flat form-control" id="new"><i class="fa fa-save"></i> <b>DATA BARU</b></button>
            </div>
            <div class="col-sm-6"></div>
            <div class="col-sm-4">
              <input type="text" id="contain" class="form-control" placeholder="cari">
            </div>
          <div class="col-sm-12 form-group">
             <table id="example1" class="table table-bordered table-striped row-border highlight" width="100%">
                  <thead>
                    <tr class="bg-green">
                     <td><b>NAMA TEMPLATE</b></td>
                     <td><b>CREATED DATE</b></td> 
                     <td><b>EDIT</b></td>
                     <td><b>HAPUS</b></td> 
                    </tr> 
                  </thead>
                  <tbody>
                 
                  </tbody>
                </table>
          </div>
          <div class="col-sm-12 form-group">  
            <div class="row">
                <div class="col-sm-6" id="pagenumber">
                PAGE 1
                </div>
                <div class="col-sm-6">
                  <div class="pull-right" id="paging">
                   
                  </div>
                </div>
            </div>
          </div>
            <!-- endCONTENT -->
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- modal -->
      <div class="modal fade" id="modalform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">NEW TEMPLATE EMAIL</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-xs-12 col-sm-12">
                  <form method="post" id="forminput">
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-xs-12 col-sm-3">
                          <div class="form-group">     
                            <label>Nama Template</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-9">
                          <div class="form-group">     
                            <input type="text" class="form-control entries" id="nama" name="nama" placeholder="Nama Template">
                            <input type="hidden" class="form-control" id="id" >
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <textarea id="editor1" name="editor1" rows="10" cols="80" style="visibility: hidden; display: none;">
                            </textarea>
                        </div>
                      </div> 
                      <div class="row"> 
                        <div class="col-xs-12 col-sm-12">
                          &nbsp;
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 col-sm-9">
                          <div class="form-group">     
                            <button type="button" class="btn btn-info btn-flat" id="save"><i class="fa fa-save"></i> <b>Simpan Data</b></button>
                            <button type="button" class="btn btn-warning btn-flat" id="update" hidden><i class="fa fa-save"></i> <b>Update Data</b></button>
                            <button type="button" id="close" class="btn btn-danger" data-dismiss="modal"><b>Close</b></button>
                          </div>
                        </div>
                      </div>

                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal-footer">
    
            </div>
          </div>
        </div>
      </div>
      <!-- modal -->


      <!-- modal success -->
      <div class="modal fade" id="modalsuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-green color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">SUCCESS</h4> <br>
            </div>
            <div class="modal-body">
              <div id="contentmodalsuccess">
                
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-danger" data-dismiss="modal"><b>Close</b></button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal -->

      <!-- modal error -->
      <div class="modal fade" id="modalerror" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-red color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">ERROR</h4> <br>
            </div>
            <div class="modal-body">
              <div id="contentmodalerror">
                
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-danger" data-dismiss="modal"><b>Close</b></button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal -->

      <!-- modal error -->
      <div class="modal fade" id="modalconfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-yellow color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">CONFIRMATION</h4> <br>
            </div>
            <div class="modal-body">
              <div>
                <input type="hidden" id="deleteid" value="">
                Apakah anda ingin menghapus data <span id="deletename"></span> ?
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="dodelete" class="btn btn-info" data-dismiss="modal"><b>YES</b></button>
                <button type="button" id="close" class="btn btn-danger" data-dismiss="modal"><b>NO</b></button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal -->
      
      <!-- modal warning -->
      <div class="modal fade" id="modalwarning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-yellow color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">WARNING</h4> <br>
            </div>
            <div class="modal-body">
              <div id="contentmodalwarning">
                
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-danger" data-dismiss="modal"><b>Close</b></button>
            </div>
          </div>
        </div>
      </div>
      <!-- modal -->