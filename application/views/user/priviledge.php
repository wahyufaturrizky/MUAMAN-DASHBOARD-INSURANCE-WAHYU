

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            User Management
            <small>group priviledge</small>
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
                  <div><label><input type="checkbox" id="selectall"> Select All</label></div>
                  
                  <br>
                  <input type="hidden" id="id" value="<?php echo $id;?>">
                  <table id="example1" class="table table-bordered table-striped" style ="width:100%">
                    <thead>
                      <tr class="bg-light-blue color-palette" >
                        <th>Menu Parent Caption </th>
                        <th>Menu Child Caption</th>
                        <th>Set Priviledge</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $id = 0;
                        foreach ($getpriviledge->result() as $res) {
                        if ($res->parentid != $id){
                        if ($id != 0){  
                        echo '<td colspan="3" class="bg-light-blue color-palette" ></td>';
                        }
                        echo'
                        <tr>
                        <td><b>'.$res->parent.'</b></td>
                        <td>'.$res->child.'</td>
                        <td>'.$res->cek.'</td>
                        </tr>
                        ';
                        }
                        else{
                        echo'
                        <tr>
                        <td></td>
                        <td>'.$res->child.'</td>
                        <td>'.$res->cek.'</td>
                        </tr>
                        ';  
                        }
                        $id = $res->parentid;
                        }
                        ?>
                        </tbody>
                        </table>
                        <div align="right">
                        <button  class ="btn btn-flat btn-primary " id="savepriviledge"><i class="fa fa-save"></i>&nbsp;Save Priviledge</button>
                        </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
     
  