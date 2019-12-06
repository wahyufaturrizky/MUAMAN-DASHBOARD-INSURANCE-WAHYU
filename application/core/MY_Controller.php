<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function template()
	{
		$data['userid'] = $this->session->userdata('userid');
		$data['username'] = $this->session->userdata('username');
    $data['usergroup'] = $this->session->userdata('usergroup');
		if ($data['userid'] == null){
  		redirect(site_url().'/home/loginpage');
  	}	
  		
  		$this->load->model('m_menu');
  		$this->load->view('layout/header',$data);
      $getmenuparent = $this->m_menu->getmenuparent($this->session->userdata('usergroup'));
      $data['menu'] = null;
      foreach ($getmenuparent->result() as $resmenuparent) {
      if ($resmenuparent->link == ''){
      $data['menu'] = $data['menu'].'<li class="treeview">
              <a href="'.site_url().''.$resmenuparent->link.'">
                <i class="'.$resmenuparent->style.'"></i> <span>'.$resmenuparent->caption.'</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">';

      $data['menu2'] = null;
 		 $getmenuchild = $this->m_menu->getmenuchild($resmenuparent->id,$this->session->userdata('usergroup'));
 		 foreach ($getmenuchild->result() as $resmenuchild) {
      $data['menu2']=$data['menu2'].'<li><a href="'.site_url().''.$resmenuchild->link.'"><i class="'.$resmenuchild->style.'"></i>'.$resmenuchild->caption.'</a></li>';
      }
      $data['menu'] = $data['menu'].$data['menu2'].'</ul>'; 
    }
    else{
      $data['menu']=  $data['menu'].'<li>
              <a href="'.site_url().''.$resmenuparent->link.'">
                <i class="'.$resmenuparent->style.'"></i> <span>'.$resmenuparent->caption.'</span> 
              </a>
            </li>';

}
}
	$this->load->view('layout/sidebar',$data);

	}


	public function footer()
	{
		$this->load->view('layout/footer');
	}

  public function cekpriviledge()
  {
    if($this->session->userdata('userid')!=null){
    $this->load->model('m_menu');
    // $getusergroup=$this->m_menu->getusergroup($this->session->userdata('userid'));
    // foreach ($getusergroup->result() as $resusergroup) {
    //   $group = $resusergroup->usergroup;
    // }
    $group = $this->session->userdata('usergroup');
    $link = substr(current_url(),strlen(site_url()),strlen(current_url()));
    $cek = $this->m_menu->cek_priv($link,$group);
      if($cek->num_rows()==0){
      redirect(site_url().'restrict'); 
      }
  }
}
}

/* End of file layout.php */
/* Location: ./application/controllers/layout.php */