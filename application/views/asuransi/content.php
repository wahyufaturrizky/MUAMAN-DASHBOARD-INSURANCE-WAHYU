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
                <h3 class="box-title text-green">REGISTRASI ASURANSI</h3>
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
                <div class="col-md-12 form-group">
                 <table id="example1" class="table table-bordered table-striped row-border highlight" width="100%">
                      <thead>
                        <tr class="bg-green">
                         <td><b>ASURANSI</b></td>
                         <td><b>ALAMAT</b></td>
                         <td><b>EMAIL</b></td>
                         <td><b>TELP</b></td>
                         <td><b>BUAT AKUN</b></td>
                         <td><b>EDIT</b></td>
                         <td><b>HAPUS</b></td>
                         <td><b>PENGATURAN</b></td> 
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
              <!-- endCONTENT -->
              </div><!-- /.box-body -->
            </div><!-- /.box -->
            </div>
          </div>  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- modal -->
      <div class="modal fade" id="modalform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">REGISTRASI ASURANSI</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-xs-12 col-sm-12">
                  <form method="post" id="forminput">
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-xs-12 col-sm-3">
                          <div class="form-group">     
                            <label>Nama</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-9">
                          <div class="form-group">     
                            <input type="text" class="form-control entries" id="nama" name="nama" placeholder="Nama Asuransi">
                            <input type="hidden" class="form-control" id="id" >
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 col-sm-3">
                          <div class="form-group">     
                            <label>Alamat</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-9">
                          <div class="form-group">     
                            <textarea class="form-control entries" id="address" placeholder="Alamat lengkap" rows="6"></textarea>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 col-sm-3">
                          <div class="form-group">     
                            <label>Email</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-9">
                          <div class="form-group">     
                            <input type="text" class="form-control entries" id="email" name="nama" placeholder="ex : mailname@example.com">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 col-sm-3">
                          <div class="form-group">     
                            <label>No Telp</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-9">
                          <div class="form-group">     
                            <input type="text" class="form-control entries" id="telp" name="nama" placeholder ="ex : 08111111111">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 col-sm-3">
                          <div class="form-group">     
                            <label></label>
                          </div>
                        </div>
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


      <!-- modal -->
      <div class="modal fade" id="modalcreateaccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-green color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">BUAT AKUN PENGGUNA</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-xs-12 col-sm-12">
                  <form method="post" id="form_user">
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>Nama</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <input type="text" class="form-control" id="nama_user" name="nama" placeholder="nama">
                            <input type="hidden" class="form-control" id="id_user" >
                          </div>
                        </div>
                      </div>

                     <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>Username</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <input type="text" class="form-control entries2" id="username" name="nama" placeholder="username">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>Password</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <input type="Password" class="form-control entries2" id="password" name="nama" placeholder="password">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>Confirm Password</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <input type="Password" class="form-control entries2" id="confirm" name="nama" placeholder="confirm">
                          </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label></label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <button type="button" class="btn btn-info btn-flat" id="save_user"><i class="fa fa-save"></i> <b>Simpan Data</b></button>
                            <button type="button" class="btn btn-warning btn-flat" id="update_user" hidden><i class="fa fa-save"></i> <b>Update Data</b></button>
                            <button type="button" id="close_user" class="btn btn-danger" data-dismiss="modal"><b>Cancel</b></button>
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


      <!-- modal -->
      <div class="modal fade" id="modalproduk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header bg-green color-palette">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="myModalLabelupdate">PRODUK ASURANSI</h4> <br>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-xs-12 col-sm-12">
                  <form method="post" id="form_produk">
                    <div class="col-sm-12">
                     
                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>LIST PRODUK</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <button id="showproduct" type="button" class="btn btn-flat form-control btn-success"><i class="fa fa-search "></i>LIHAT PRODUCT</button>
                          <div id="listproduk" class="form-group">     
                            
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label>TAMBAH/HAPUS PRODUK</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <select class="form-control" id="produk_id">
                                  <option value="-">Choose Product</option>
                                  <?php foreach ($getproduk->result() as $r) :?>
                                    <option value="<?php echo $r->id_produk;?>"><?php echo $r->nama_produk;?></option>
                                  <?php endforeach; ?>
                            </select>
                            <input type="hidden" id="id_as_pro" name="">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-12 col-sm-4">
                          <div class="form-group">     
                            <label></label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-8">
                          <div class="form-group">     
                            <button type="button" class="btn btn-info btn-flat" id="save_produk"><i class="fa fa-save"></i> <b>Add</b></button>
                            <button type="button" class="btn btn-info btn-flat" id="hapus_produk"><i class="fa fa-trash"></i> <b>Delete</b></button>
                            <button type="button" id="close_produk" class="btn btn-danger" data-dismiss="modal"><b>Cancel</b></button>
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