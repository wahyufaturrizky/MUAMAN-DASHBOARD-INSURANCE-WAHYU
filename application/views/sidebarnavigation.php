<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?=base_url('assets')?>/dist/img/avatar5.png" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>Syarif Furqon </p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>
  <!-- search form -->
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
    </div>
  </form>
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    
    <li>
      <a href="<?=base_url('nasabah')?>">
        <i class="fa fa-users"></i> <span>Nasabah</span>
      </a>
    </li>

    <li>
      <a href="<?=base_url('bank')?>">
        <i class="fa fa-bank"></i> <span>Registrasi Bank</span>
      </a>
    </li>

    <li>
      <a href="<?=base_url('broker')?>">
        <i class="fa fa-btc"></i> <span>Registrasi Broker</span>
      </a>
    </li>

    <li>
      <a href="<?=base_url('asuransi')?>">
        <i class="fa fa-umbrella"></i> <span>Registrasi Asuransi</span>
      </a>
    </li>

    <li>
      <a href="<?=base_url('asset')?>">
        <i class="fa fa-money"></i> <span>Asset</span>
      </a>
    </li>
    <li>
      <a href="<?=base_url('polis')?>">
        <i class="fa fa-expeditedssl"></i> <span>Polis</span>
      </a>
    </li>
    
  </ul>
</section>
<!-- /.sidebar -->
</aside>