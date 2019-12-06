

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            User Management
            <small>group detail</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
              <section class="content">
             <div>
                  <button class ="btn btn-flat btn-primary " data-toggle="modal" data-target="#create"><i class="fa fa-save"></i>&nbsp;Create New</button>
                  <button class ="btn btn-flat btn-success" id="reload"><i class="fa fa-refresh"></i>&nbsp;Reload</button>
                </div>
                  <br>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr class="bg-light-blue color-palette" >
                        <th>Usergroup</th>
                        <th>Username</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($getdetail->result() as $res) {
                        echo'
                        <tr>
                        <td>'.$res->grup.'</td>
                        <td>'.$res->user.'</td>
                        <td align="center"><button type="submit" class ="btn btn-flat btn-warning " data-toggle="modal" data-target="#create"><i class="fa fa-pencil"></i>&nbsp;Edit</button> </td>
                        <td align="center"><button type="submit" class ="btn btn-flat btn-danger " data-toggle="modal" data-target="#create"><i class="fa fa-trash"></i>&nbsp;Delete</button> </td>
                        </tr>
                        ';
                        }
                        ?>
                        </tbody>
                        </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
     
  