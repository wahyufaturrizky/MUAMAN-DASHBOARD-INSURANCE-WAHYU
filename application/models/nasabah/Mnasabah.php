<?php 

class Mnasabah extends CI_Model{

	function gettype()
	{
		$query = $this->db->query('
			SELECT id,name 
			from apm_nasabah_type 
			where flag = \'1\'
			');
		return $query;	
	}

	function getlistbank($bank)
	{
		$query = $this->db->query('
			SELECT id,name 
			from apm_nasabah_group 
			where 
				flag = \'1\' 
			and 
				id_parent = \'0\'
			and 
				name LIKE \'%'.addslashes($bank).'%\'
			');
		return $query;	
	}	

	function getlistbranch($id_parent)
	{
		$query = $this->db->query('
			SELECT name,address,email,telp 
			from apm_nasabah_group 
			where 
				flag = \'1\' 
			and 
				id_parent = \''.$id_parent.'\'
			');
		return $query;	
	}	

	function getpage($search)
	{
		$query = $this->db->query('
			SELECT COUNT(*) page 
			from apm_nasabah a 
			join
			apm_nasabah_type b
			on
			a.apm_nasabah_type_id = b.id
			where a.flag = \'1\' '.$search.'
			');
		return $query;	
	}

	function get($offset,$limit,$search){
		$query = $this->db->query('
			SELECT 
			a.name,
			a.address, 
			a.email,
			a.telp,
			b.name TYPE,  
			if(c.idapm_user is NULL,\'<button class="btn btn-info btn-flat" id="create"><i class="fa fa-user"></i> Create</button>\',
				\'<button class="btn btn-success btn-flat"><i class="fa fa-user"></i> Sudah Memiliki Akun</button>\'
			),
			\'<button class="btn btn-warning btn-flat" id="edit"><i class="fa fa-pencil"></i> Edit</button>\' ,
			\'<button class="btn btn-danger btn-flat" id="delete"><i class="fa fa-trash"></i> Delete</button>\',
			a.id,
			a.apm_nasabah_type_id
			from apm_nasabah a
			join apm_nasabah_type b
			on a.apm_nasabah_type_id = b.id
			left join
			apm_user c
			on
			a.id = c.apm_nasabah_id 
			where a.flag = \'1\' '.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function update($nama,$alamat,$email,$telp,$id,$type)
	{
		$query = $this->db->query(
			'
			UPDATE apm_nasabah
			SET 
			name = \''.addslashes($nama).'\',
			email = \''.$email.'\',
			address = \''.addslashes($alamat).'\', 
			telp = \''.$telp.'\',
			apm_nasabah_type_id = \''.$type.'\'
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
			DELETE FROM apm_nasabah
			WHERE 
			id = \''.$id.'\'
			'
			);
		return $this->db->affected_rows();
	}	

	function save($nama,$alamat,$email,$telp,$type) {
		$query = $this->db->query(
			'
			INSERT INTO apm_nasabah
			(
				name,
				email,
				address,
				telp,
				apm_nasabah_type_id,
				flag
			)
			values(
				\''.addslashes($nama).'\',
				\''.$email.'\',
				\''.addslashes($alamat).'\',
				\''.$telp.'\',
				\''.$type.'\',
				\'1\'
			)
			'
			);
		return $this->db->affected_rows();
		
	}

	function save_user($username,$password,$id_user) {
		$query = $this->db->query(
			'
			INSERT INTO apm_user
			(
				username_xxx,
				password_xxx,
				group_user,
				apm_nasabah_id,
				flag
			)
			values(
				\''.addslashes($username).'\',
				\''.md5($password).'\',
				\'1\',
				\''.$id_user.'\',
				\'1\'
			)
			'
			);
		return $this->db->affected_rows();
	}

}