<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Nasabah extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper(array('form', 'url'));
        $this->load->model('mnasabah');
        $this->load->model('muser');
        $this->load->model('mbank');
        $this->load->model('mbranch');
		$this->load->library('form_validation');
    }

    public function index()
    {
        $vdata['nasabah'] = $this->mnasabah->get();
        $data['content'] = $this->load->view('nasabah/list', $vdata, TRUE);
        $data['bottomActionScript'] = $this->load->view('nasabah/bottomActionScript', '', TRUE);
        $this->load->view('layout', $data);
    }

    public function delete($idnasabah)
	{
		$data['flag'] = 0;
		$data['id'] = $idnasabah;
        $result= $this->mnasabah->save($data);
        $result= $this->muser->deletebyidnasabah($idnasabah);

	}

    public function userlist($idnasabah)
    {
        echo $idnasabah;
    }
    
    public function add()
    {
        if(isset($_POST) and !empty($_POST))
		{			
			$this->load->library('form_validation');
            $this->form_validation->set_rules('display_name', 'Nama Lengkap', 'required|min_length[5]|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[15]|trim');
            $this->form_validation->set_rules('phone', 'Telephone', 'required|min_length[8]|integer|trim');

            $this->form_validation->set_rules('username','Username','trim|required|min_length[3]|is_unique[apm_user.username_xxx]');
            $this->form_validation->set_rules('pass', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('repass', 'Confirm Password', 'required|matches[pass]|min_length[6]');

            if ($this->form_validation->run() != false)
            {

                $dataSave = [
                    'name' => $this->input->post('display_name'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('alamat'),
                    'telp' => $this->input->post('phone'),
                    'apm_nasabah_type_id' => $this->input->post('tipe'),
                    'apm_nasabah_group_id' => $this->input->post('branch'),
                    'telp' => $this->input->post('phone'),
                    'flag' => 1
                ];

                $idnasabah = $this->mnasabah->save( $dataSave );

                $dataUser = [
                    'username_xxx' => strtolower(str_replace(" ","",$this->input->post('username'))),
                    'password_xxx' => md5( $this->input->post('pass') ),
                    'group_user' => 1,
                    'apm_nasabah_id' => $idnasabah,
                    'flag'=> 1
                ];

                $isSave = $this->muser->save( $dataUser );

                if ($isSave)
					redirect(base_url("nasabah?status=1"));

            }
            
        }
        
        $data['bottomActionScript'] = $this->load->view('nasabah/bottomActionScript', '', TRUE);
        $data['content'] = $this->load->view('nasabah/add', '', TRUE);
        
        $this->load->view('layout', $data);
    }

    public function edit($id)
    {
        $vdata['id'] = $id;
        $vdata['nasabah'] = $this->mnasabah->get(
            [
                'id'=> $vdata['id']
                ]
        )[0];

        $vdata['types'] = $this->mnasabah->getTipeNasabah();
        $vdata['listbanks'] = $this->mbank->get();

        $branch['idbank'] = $vdata['nasabah']->id_group_parent;
        $vdata['listbranchs'] = $this->mbranch->get( $branch ); 
        
        if(isset($_POST) and !empty($_POST))
		{			
			$this->load->library('form_validation');
            $this->form_validation->set_rules('display_name', 'Nama Lengkap', 'required|min_length[5]|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[15]|trim');
            $this->form_validation->set_rules('phone', 'Telephone', 'required|min_length[8]|integer|trim');

            $this->form_validation->set_rules('iduser', 'ID User', 'required');

            if($this->input->post('pass')) {
                $this->form_validation->set_rules('pass', 'Password', 'required|min_length[6]');
                $this->form_validation->set_rules('repass', 'Confirm Password', 'required|matches[pass]|min_length[6]');
            }

            
            if ($this->form_validation->run() != false)
            {

                $dataSave = [
                    'id' => $id,
                    'name' => $this->input->post('display_name'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('alamat'),
                    'telp' => $this->input->post('phone'),
                    'apm_nasabah_type_id' => $this->input->post('tipe'),
                    'apm_nasabah_group_id' => $this->input->post('branch'),
                    'telp' => $this->input->post('phone'),
                    'flag' => 1
                ];

                //echo '<pre>'; print_r($_POST); echo '</pre>';
                $resNasabah = $this->mnasabah->save( $dataSave );

                if($this->input->post('pass')) {
                    $dataUser = [
                        'idapm_user' => $this->input->post('iduser'),
                        'password_xxx' => md5( $this->input->post('pass') ),
                        'group_user' => 1,
                        'flag'=> 1
                    ];
                    $resUser = $this->muser->save( $dataUser );
                }

                

                if ($resNasabah)
					redirect(base_url("nasabah?status=1"));

            }
            
        }
        
        $data['content'] = $this->load->view('nasabah/edit', $vdata, TRUE);
        $data['bottomActionScript'] = $this->load->view('nasabah/bottomActionScript', '', TRUE);
        $this->load->view('layout', $data);
    }
}
