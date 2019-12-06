<?php 

class Mbroker extends CI_Model{


	function getpage($search)
	{
		$wherebroker='';
        if($this->session->userdata('idbroker')!=''){
            $wherebroker = ' AND id = '.$this->session->userdata('idbroker').' ';
        }

		$query = $this->db->query('
			SELECT COUNT(*) page from apm_broker where flag = \'1\' '.$search.$wherebroker.'
			');
		return $query;	
	}

	function get($offset,$limit,$search){
		$wherebroker='';
        if($this->session->userdata('idbroker')!=''){
            $wherebroker = ' AND id = '.$this->session->userdata('idbroker').' ';
        }

		$query = $this->db->query('
			SELECT 
			name,
			address, 
			email,
			telp,  
			CONCAT(
			\' <form method = "get" action="broker_user/"><input type="hidden" name="id_broker" value="\',
			id,
			\'"><input type="hidden" name="broker_name" value="\',
			name,
			\'"><button class="btn btn-info btn-flat"><i class="fa fa-share-alt"></i> Pengguna</button></form>\'),
			\'<button class="btn btn-info btn-flat" id="edit"><i class="fa fa-pencil"></i> Edit</button>\' ,
			\'<button class="btn btn-info btn-flat" id="delete"><i class="fa fa-trash"></i> Delete</button>\',
			id
			from apm_broker where flag = \'1\'  '.$search.$wherebroker.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function update($nama,$alamat,$email,$telp,$id)
	{
		$query = $this->db->query(
			'
			UPDATE apm_broker
			SET 
			name = \''.addslashes($nama).'\',
			email = \''.$email.'\',
			address = \''.addslashes($alamat).'\', 
			telp = \''.$telp.'\'
			WHERE 
			id = \''.$id.'\'
			'
			);
		return $this->db->affected_rows();
	}

	function uploadData2($file){
		$query = $this->db->query("
			LOAD DATA LOCAL INFILE '".$file."' 
			IGNORE 
			INTO TABLE apm_broker
			FIELDS TERMINATED BY ',' 
			OPTIONALLY ENCLOSED BY '\"' 
			LINES TERMINATED BY '\r\n' 
			IGNORE 1 LINES 
			(
				name,
				email,
				address,
				telp
			)
			SET 
			apm_broker.`flag` = 1
			");

		return $query;
	}

	function delete($id) 
	{
		$query = $this->db->query(
			'
			DELETE FROM apm_broker
			WHERE 
			id = \''.$id.'\'
			'
			);
		return $this->db->affected_rows();
	}	

	function save($nama,$alamat,$email,$telp) {
		$query = $this->db->query(
			'
			INSERT INTO apm_broker
			(
				name,
				email,
				address,
				telp,
				flag
			)
			values(
				\''.addslashes($nama).'\',
				\''.$email.'\',
				\''.addslashes($alamat).'\',
				\''.$telp.'\',
				\'1\'
			)
			'
			);
		return $this->db->affected_rows();
	}

	function getbrokerdata($id)
	{
		$query = $this->db->query('
			SELECT b.`id_broker`, a.`apm_broker_user_id`
				FROM apm_user a
				JOIN
				apm_broker_user b
				ON
				a.`apm_broker_user_id` = b.`id`
				WHERE
				a.`idapm_user` = '.$id.'
			');
		return $query->result_array();
	}

}