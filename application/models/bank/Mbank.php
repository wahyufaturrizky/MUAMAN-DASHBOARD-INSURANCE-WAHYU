<?php 

class Mbank extends CI_Model{

	/*
	function get(){
			$this->db->select('*');
			$this->db->from('apm_nasabah_group');
			$query = $this->db->get();

			if ($query->num_rows() > 0)
				return $query->result();
			else
				return false;
		
	}*/
	function getpage($search)
	{
		$query = $this->db->query('
			SELECT COUNT(*) page from apm_nasabah_group where id_parent = \'0\' and flag = \'1\' '.$search.'
			');
		return $query;	
	}

	function get($offset,$limit,$search){
		$query = $this->db->query('
			SELECT 
			name,
			address, 
			email,
			telp,  
			CONCAT(
			\' <form method = "get" action="bank_branch/"><input type="hidden" name="id_parent" value="\',
			id,
			\'"><input type="hidden" name="parent_name" value="\',
			name,
			\'"><button class="btn btn-info btn-flat"><i class="fa fa-share-alt"></i> Branch</button></form>\'),
			\'<button class="btn btn-warning btn-flat" id="edit"><i class="fa fa-pencil"></i> Edit</button>\' ,
			\'<button class="btn btn-danger btn-flat" id="delete"><i class="fa fa-trash"></i> Delete</button>\',
			id
			from apm_nasabah_group where id_parent = \'0\' and flag = \'1\' '.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function update($nama,$alamat,$email,$telp,$id)
	{
		$query = $this->db->query(
			'
			UPDATE apm_nasabah_group
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

	function delete($id) 
	{
		$query = $this->db->query(
			'
			DELETE apm_nasabah_group
			WHERE 
			id = \''.$id.'\'
			'
			);
		return $this->db->affected_rows();
	}	

	function save($nama,$alamat,$email,$telp) {
		$query = $this->db->query(
			'
			INSERT INTO apm_nasabah_group
			(
				id_parent,
				name,
				email,
				address,
				telp,
				flag
			)
			values(
				\'0\',
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


}