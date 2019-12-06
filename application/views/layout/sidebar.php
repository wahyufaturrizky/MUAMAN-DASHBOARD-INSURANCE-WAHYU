  <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url();?>assets/img/user.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php 
              echo($username); 
              ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          
          </div>
          <!-- search form -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
           <ul class="sidebar-menu">
             <li class="header">MAIN NAVIGATION</li>
          <?php
          echo $menu;
          ?>
           </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
         