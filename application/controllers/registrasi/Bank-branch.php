<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class bank_branch extends MY_Controller {
    
    function __construct(){
        parent::__construct();
		$this->load->model('bank/mbank_branch');
    }

    public function index()
    {   
        $data['id_parent'] = $this->input->post('id_parent');
        $this->template();
        $this->load->view('bank/branch/content',$data);
        $this->footer();
        $this->load->view('bank/branch/content_js'); 
    }

    public function ajax_data()
    {
        $id_parent = $this->input->post('id_parent');
        $data['getdata']= $this->mbank->get($id_parent);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
         $rows[] = array_values((array)$row);
        }
        $this->output->set_content_type('application/json');
        $data['ajax_data'] = json_encode(array('aaData'=> $rows));
        $this->load->view('ajax/ajax_data',$data);
    }

    public function save()
    {
        $save = $this->mbank->save(
                    $this->input->post('nama'),
                    $this->input->post('alamat'),
                    $this->input->post('email'),
                    $this->input->post('telp'),
                    $this->input->post('id_parent')
                 );
    }

    public function update()
    {
        $update = $this->mbank->update(
                    $this->input->post('nama'),
                    $this->input->post('alamat'),
                    $this->input->post('email'),
                    $this->input->post('telp'),
                    $this->input->post('id')
                 );
    }

    public function delete()
	{
		$delete =   $this->mbank->delete(
                    $this->input->post('id')
                 );
	}

    public function userlist($idbank)
    {
        echo $idbank;
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

            //echo '<pre>'; print_r($_POST); echo '</pre>';
            if ($this->form_validation->run() != false)
            {

                $dataSave = [
                    'name' => $this->input->post('display_name'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('alamat'),
                    'telp' => $this->input->post('phone'),
                    'flag' => 1
                ];

                $isSave = $this->mbank->save( $dataSave );

                if ($isSave)
					redirect(base_url("bank?status=1"));

                /*
                    - Insert Databaser (return boolean)
                    - If True 
                    * Send Email
                    * Notification Success
                    * View Form
                    - If Else Notification Failed
                        * View Formvc ftr
                    
                */
            }
            
        }
        
        $data['content'] = $this->load->view('bank/add', '', TRUE);
        
        $this->load->view('layout', $data);
    }

    public function edit($id)
    {
        $vdata['id'] = $id;
        $vdata['bank'] = $this->mbank->get(
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

            if ($this->form_validation->run() != false)
            {

                $dataSave = [
                    'id' => $vdata['id'],
                    'name' => $this->input->post('display_name'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('alamat'),
                    'telp' => $this->input->post('phone'),
                    'flag' => 1
                ];

                $isSave = $this->mbank->save( $dataSave );

                if ($isSave)
					redirect(base_url("bank?status=1"));

                /*
                    - Insert Databaser (return boolean)
                    - If True 
                    * Send Email
                    * Notification Success
                    * View Form
                    - If Else Notification Failed
                        * View Formvc ftr
                    
                */
            }
            
        }
        
        $data['content'] = $this->load->view('bank/edit', $vdata, TRUE);
        
        $this->load->view('layout', $data);
    }
}
