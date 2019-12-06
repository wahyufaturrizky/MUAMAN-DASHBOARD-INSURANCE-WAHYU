<?php 

class Masuransi extends CI_Model{

	public function getproduk()
	{
		$query = $this->db->query(
			"SELECT * FROM apm_produk where flag = '1'"

		);
		return $query;
	}

	public function getprodukasuransi($id)
	{
		$query = $this->db->query(
			"SELECT nama_produk 
			FROM apm_produk_asuransi a
			join apm_produk b
			on a.id_produk = b.id_produk
			where a.state = '1' and a.id_asuransi = '".$id."' "

		);
		return $query;
	}


	public function deleteproduk($id,$produk)
	{
		$query = $this->db->query(
			"
			DELETE FROM apm_produk_asuransi a
			where a.state = '1' and a.id_asuransi = '".$id."' and id_produk = '".$produk."' "

		);
		return $query;
	}

	public function saveproduk($id,$produk)
	{
		$query = $this->db->query(
			"REPLACE INTO apm_produk_asuransi
			 values
			 (
			 '".$id."',
			 '".$produk."', 
			 '1'
			 )"
		);
		return $query;
	}

	function getpage($search)
	{
		$query = $this->db->query('
			SELECT COUNT(*) page from apm_asuransi where flag = \'1\' '.$search.'
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
			\'<button class="btn btn-info btn-flat" id="create"><i class="fa fa-user"></i> Create</button>\' ,
			\'<button class="btn btn-warning btn-flat" id="edit"><i class="fa fa-pencil"></i> Edit</button>\' ,
			\'<button class="btn btn-danger btn-flat" id="delete"><i class="fa fa-trash"></i> Delete</button>\',
			-- CONCAT(\'<a href="asuransi_setup/?idasuransi=\',id,\'&asuransiname=\',name,\'"><button class="btn btn-info btn-flat" id="setup"><i class="fa fa-gear"></i>Atur Rate</button></a>\')
			\'<button class="btn btn-info btn-flat" id="produk"><i class="fa fa-shield"></i> Produk</button>\',
			id
			from apm_asuransi where flag = \'1\' '.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function update($nama,$alamat,$email,$telp,$id)
	{
		$query = $this->db->query(
			'
			UPDATE apm_asuransi
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
			DELETE FROM apm_asuransi
			WHERE 
			id = \''.$id.'\'
			'
			);
		return $this->db->affected_rows();
	}	

	function save($nama,$alamat,$email,$telp) {
		$query = $this->db->query(
			'
			INSERT INTO apm_asuransi
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

	function save_user($username,$password,$id_user) {
		$query = $this->db->query(
			'
			INSERT INTO apm_user
			(
				username_xxx,
				password_xxx,
				group_user,
				apm_asuransi_id,
				flag
			)
			values(
				\''.addslashes($username).'\',
				\''.md5($password).'\',
				\'3\',
				\''.$id_user.'\',
				\'1\'
			)
			'
			);
		return $this->db->affected_rows();
	}

}