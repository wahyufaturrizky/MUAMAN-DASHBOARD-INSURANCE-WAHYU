<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Branch extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('mbank');
        $this->load->model('mbranch');
		$this->load->library('form_validation');
    }

    public function index($idbank)
    {
        $vdata['idbank'] = $idbank;
        $vdata['branch'] = $this->mbranch->get($vdata);
        $data['bottomActionScript'] = $this->load->view('branch/bottomActionScript', '', TRUE);
        $data['content'] = $this->load->view('branch/list', $vdata, TRUE);
        $this->load->view('layout', $data);
    }

    public function userlist($idbank)
    {
        echo $idbank;
    }
    
    public function add($idbank)
    {
        if(isset($_POST) and !empty($_POST))
		{			
			$this->load->library('form_validation');
            $this->form_validation->set_rules('display_name', 'Nama Lengkap', 'required|min_length[5]|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[15]|trim');
            $this->form_validation->set_rules('phone', 'Telephone', 'required|min_length[8]|integer|trim');

            //echo '<pre>'; print_r($_POST); echo '</pre>';
            if ($this->form_validation->run() != false)
            {

                $dataSave = [
                    'name' => $this->input->post('display_name'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('alamat'),
                    'telp' => $this->input->post('phone'),
                    'id_parent' => $idbank,
                    'flag' => 1
                ];

                $isSave = $this->mbranch->save( $dataSave );

                if ($isSave)
					redirect(base_url("branch/".$idbank."?status=1"));

            }
            
        }
        $vdata['idbank'] = $idbank;
        $data['content'] = $this->load->view('branch/add', $vdata, TRUE);
        
        $this->load->view('layout', $data);
    }

    public function edit($id)
    {
        $vdata['id'] = $id;
        $vdata['branch'] = $this->mbranch->get(
            [
                'id'=> $vdata['id']
                ]
        )[0];

        if(isset($_POST) and !empty($_POST))
		{			
			$this->load->library('form_validation');
            $this->form_validation->set_rules('display_name', 'Nama Lengkap', 'required|min_length[5]|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[15]|trim');
            $this->form_validation->set_rules('phone', 'Telephone', 'required|min_length[8]|integer|trim');
            $this->form_validation->set_rules('id_parent', 'ID Parent', 'required|integer|trim');

            if ($this->form_validation->run() != false)
            {

                $dataSave = [
                    'id' => $vdata['id'],
                    'name' => $this->input->post('display_name'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('alamat'),
                    'telp' => $this->input->post('phone'),
                    'id_parent' => $this->input->post('id_parent'),
                    'flag' => 1
                ];

                $isSave = $this->mbranch->save( $dataSave );

                if ($isSave){
                    redirect(base_url("branch/".$this->input->post('id_parent')."?status=1"));
                }

            }
            
        }
        
        $data['content'] = $this->load->view('branch/edit', $vdata, TRUE);
        
        $this->load->view('layout', $data);
    }

    public function delete($idbranch)
	{
		$data['flag'] = 0;
		$data['id'] = $idbranch;
		$result= $this->mbranch->save($data);
	}
}
