<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class PintuMasuk extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('login_os');
		$this->load->helper('security');   
    }

    public function out()
	{
		$this->session->unset_userdata('logged_in');
		redirect(base_url("pintumasuk"));
    }	
    
    public function index()
    {
        if (isset($this->session->userdata['logged_in']))
			redirect(base_url());

		$data = [];
		
		if(isset($_POST) and !empty($_POST))
		{
            echo '<pre>'; print_r($_POST); echo '</pre>';
            $this->form_validation->set_rules('uid', 'User Name', 'trim|required');
			$this->form_validation->set_rules('upw', 'Password', 'trim|required');

			if($this->form_validation->run() != false){
            
				$data = array(
					'username' => $this->security->xss_clean($this->input->post('uid')),
					'password' => $this->security->xss_clean($this->input->post('upw'))
                );

                $login = $this->login_os->login_user($data);
                echo '<pre>'; print_r($login); echo '</pre>';
                if($login != false) {
                    if($login->group_user ==1) {
                        # nasabah
                        $profile = $this->login_os->read_profile_information_nasabah($login->apm_nasabah_id);
                    } elseif($login->group_user ==2) {
                        # broker
                        $profile = $this->login_os->read_profile_information_broker($login->apm_broker_user_id);
                    } elseif($login->group_user ==3) {
                        # asuransi
                        $profile = $this->login_os->read_profile_information_asuransi($login->apm_asuransi_id);
                    } elseif($login->group_user ==4) {
                        # debitur
                        //$profile = $this->login_os->read_profile_information_debitur($login->apm_debitur_id);
                    } else {
                        $profile = false;
                    }

                    if($profile != false) {
                        $session_data = [
                            'userloginID' => $login->idapm_user,
                            'userprofileID' => $profile->id,
                            'name' => $profile->name,
                            'email' => $profile->email,
                            'groupUser' => $login->group_user,
                            'previllege' => [
                                'nasabah_id' => $login->apm_nasabah_id,
                                'broker_id' => $login->apm_broker_user_id,
                                'asuransi_id' => $login->apm_asuransi_id,
                                'debitur_id' => $login->apm_debitur_id

                            ]
                        ];
                        //echo '<pre>'; print_r($session_data); echo '</pre>'; die();
                        $this->session->set_userdata('logged_in', $session_data);
                        redirect(base_url());
                    } elseif ($profile == false) {
                        $data['wrong_login'] = true;
                    }
                } elseif ($login == false) {
                    echo "salah";
                    $data['wrong_login'] = true;
                }
            }
        }

        $this->load->view('login_v', $data);
    }
}