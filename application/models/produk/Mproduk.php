<?php 

class Mproduk extends CI_Model{

	function getpage($search)
	{
		$query = $this->db->query('
			SELECT COUNT(*) page from apm_produk where flag = \'1\' '.$search.'
			');
		return $query;	
	}

	function get($offset,$limit,$search){
		$query = $this->db->query('
			SELECT 
			nama_produk,
			\'<button class="btn btn-info btn-flat" id="edit"><i class="fa fa-pencil"></i> Edit</button>\' ,
			\'<button class="btn btn-info btn-flat" id="delete"><i class="fa fa-trash"></i> Delete</button>\',
			id_produk
			from apm_produk where flag = \'1\' '.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function uploadData2($file){
		$query = $this->db->query("
			LOAD DATA LOCAL INFILE '".$file."' 
			IGNORE 
			INTO TABLE apm_produk
			FIELDS TERMINATED BY ',' 
			OPTIONALLY ENCLOSED BY '\"' 
			LINES TERMINATED BY '\r\n' 
			IGNORE 1 LINES 
			(
				nama_produk
			)
			SET 
			apm_produk.`flag` = 1
			");

		return $query;
	}

	function update($nama,$id)
	{
		$query = $this->db->query(
			'
			UPDATE apm_produk
			SET 
			nama_produk = \''.addslashes($nama).'\'
			WHERE 
			id_produk = \''.$id.'\'
			'
			);
		return $this->db->affected_rows();
	}

	function delete($id) 
	{
		$query = $this->db->query(
			'
			DELETE FROM apm_produk
			WHERE 
			id_produk = \''.$id.'\'
			'
			);
		return $this->db->affected_rows();
	}	

	function save($nama) {
		$query = $this->db->query(
			'
			INSERT INTO apm_produk
			(
				nama_produk,
				flag
			)
			values(
				\''.addslashes($nama).'\',
				\'1\'
			)
			'
			);
		return $this->db->affected_rows();
		
	}

}