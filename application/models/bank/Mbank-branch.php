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

	function get($id_parent){
		$query = $this->db->query('
			SELECT 
			name,
			address, 
			email,
			telp,  
			\'<button class="btn btn-info btn-flat" id="edit"><i class="fa fa-pencil"></i> Edit</button>\' ,
			\'<button class="btn btn-info btn-flat" id="delete"><i class="fa fa-trash"></i> Delete</button>\',
			id
			from apm_nasabah_group where id_parent = \''.$id_parent.'\' and flag = \'1\'
			');
		return $query;
		
	}

	function update($nama,$alamat,$email,$telp,$id)
	{
		$query = $this->db->query(
			'
			UPDATE apm_nasabah_group
			SET 
			name = \''.$nama.'\',
			email = \''.$email.'\',
			address = \''.$alamat.'\', 
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
			UPDATE apm_nasabah_group
			SET 
			flag = \'0\'
			WHERE 
			id = \''.$id.'\'
			'
			);
		return $this->db->affected_rows();
	}	

	function save($nama,$alamat,$email,$telp,$id_parent) {
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
				\''.$id_parent.'\',
				\''.$nama.'\',
				\''.$email.'\',
				\''.$alamat.'\',
				\''.$telp.'\',
				\'1\'
			)
			'
			);
		return $this->db->affected_rows();
		// if(isset($data['id']))
		// {
		// 	$this->db->where('id', $data['id']);
		// 	$this->db->update('apm_nasabah_group', $data);
		// } else {
		// 	$this->db->insert('apm_nasabah_group', $data);
		// }

		// if ($this->db->affected_rows() > 0)
		// 	return true;
		
	}


}