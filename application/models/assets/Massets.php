<?php 

class Massets extends CI_Model{

	/*
	function get(){
			$this->db->select('*');
			$this->db->from('apm_assets');
			$query = $this->db->get();

			if ($query->num_rows() > 0)
				return $query->result();
			else
				return false;
		
	}*/
	function getpage($search)
	{
		$query = $this->db->query('
			SELECT COUNT(*) page
			from apm_assets a
			join apm_nasabah b
			on a.apm_nasabah_id = b.id 
			where a.flag = \'1\' 
			and a.apm_nasabah_id= (select apm_nasabah_id from apm_user where idapm_user = \''.$this->session->userdata('userid').'\') 
			'.$search.'
			');
		return $query;	
	}

	function get($offset,$limit,$search){
		$query = $this->db->query('
			SELECT
			a.name,
			a.address, 
			a.tsi,  
			if(a.isProtected =\'N\',\'<button class="btn btn-info btn-flat" id="request"><i class="fa fa-exchange"></i> Request</button>\' ,
			\'<button class="btn btn-info btn-flat" disabled><i class="fa fa-exchange"></i> Request</button>\' 
			),
			if(a.isProtected =\'N\',\'<button class="btn btn-warning btn-flat" id="edit"><i class="fa fa-pencil"></i> Edit</button>\' ,
			\'<button class="btn btn-info btn-flat" disabled><i class="fa fa-exchange"></i> Edit</button>\'
			),
			if(a.isProtected =\'N\',\'<button class="btn btn-danger btn-flat" id="delete"><i class="fa fa-trash"></i> Delete</button>\',
			\'<button class="btn btn-info btn-flat" disabled><i class="fa fa-exchange"></i> Delete</button>\'
			),
			if(a.isProtected =\'Y\', \'<button class="btn btn-success btn-flat form-control"><i class="fa fa-check"></i> Sudah di Proteksi</button>\',
				if(a.isProtected =\'N\',\'<button class="btn btn-warning btn-flat form-control"><i class="fa fa-ban"></i> Belum Di Proteksi</button>\',
				\'<button class="btn btn-primary btn-flat form-control"><i class="fa fa-refresh"></i> Sedang di Proses</button>\'
				) 
			) isProtectedicon,
			a.id,
			a.apm_nasabah_id,
			a.isProtected
			from apm_assets a 
			where a.flag = \'1\' 
			and a.apm_nasabah_id= (select apm_nasabah_id from apm_user where idapm_user = \''.$this->session->userdata('userid').'\') 
			'.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function update($nama,$alamat,$tsi,$id,$idjenis)
	{
		$query = $this->db->query(
			'
			UPDATE apm_assets
			SET 
			name = \''.addslashes($nama).'\',
			address = \''.addslashes($alamat).'\', 
			tsi = \''.$tsi.'\',
			apm_assets_jenis_id = \''.$idjenis.'\'
			WHERE 
			id = \''.$id.'\'
			'
			);
		return $this->db->affected_rows();
	}

	function updateProtected($id)
	{
		$query = $this->db->query(
			'
			UPDATE apm_assets
			SET 
			isProtected =\'R\'
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
			DELETE FROM apm_assets
			WHERE 
			id = \''.$id.'\'
			'
			);
		return $this->db->affected_rows();
	}	

	function save($nama,$alamat,$tsi,$idnasabah,$idassets, $idjenis) {
		if($idassets==''){
			$idassets = 'NULL';
		}
		$query = $this->db->query(
			'
			REPLACE INTO apm_assets
			(
				id,
				name,
				address,
				tsi,
				apm_nasabah_id,
				apm_assets_jenis_id,
				flag
			)
			values(
				'.$idassets.',
				\''.addslashes($nama).'\',
				\''.addslashes($alamat).'\',
				\''.$tsi.'\',
				\''.$idnasabah.'\',
				\''.$idjenis.'\',
				\'1\'
			)
			'
			);
	
		return $this->db->insert_id();
		
	}

	public function getnasabahid($userid)
	{
		$query = $this->db->query('
			SELECT apm_nasabah_id from apm_user where idapm_user = \''.$this->session->userdata('userid').'\'
			');
		return $query->result_array();	
	}

	public function getjenisassets()
	{
		$query = $this->db->query('
			SELECT id, name from apm_assets_jenis where flag = \'1\'
			');
		return $query->result_array();	
	}

}