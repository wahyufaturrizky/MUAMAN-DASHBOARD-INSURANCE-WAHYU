<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkendaraan extends CI_Model {

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

	function getpageassets($search)
	{
		$query = $this->db->query('
			SELECT COUNT(*) page 
			from apm_assets a 
			join
			apm_nasabah b
			on
			a.apm_nasabah_id = b.id
			where a.flag = \'1\' 
			'.$search.'
			');
		return $query;	
	}

	function getproduct()
	{
		$query = $this->db->query('
			SELECT id_produk, nama_produk 
			from apm_produk
			where flag = \'1\'
			');
		return $query;	
	}

	function getasuransi()
	{
		$query = $this->db->query('
			SELECT id, name 
			from apm_asuransi
			where flag = \'1\'
			');
		return $query;	
	}

	function getidbroker($id)
	{
		$query = $this->db->query('
			SELECT apm_broker_user_id
			from apm_user
			where idapm_user = \''.$id.'\'
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
			\'<button class="btn btn-info btn-flat" id="choose"><i class="fa fa-file"></i> PILIH</button>\',
			a.id,
			a.apm_nasabah_type_id
			from apm_nasabah a
			join apm_nasabah_type b
			on a.apm_nasabah_type_id = b.id 
			where a.flag = \'1\' '.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function getassets($offset,$limit,$search){
		$query = $this->db->query('
			SELECT
			b.name nasabah, 
			a.name,
			a.address, 
			a.tsi,  
			\'<button class="btn btn-info btn-flat" id="chooseasset"><i class="fa fa-file"></i> PILIH</button>\',
			a.id,
			a.apm_nasabah_id
			from apm_assets a
			join apm_nasabah b
			on a.apm_nasabah_id = b.id 
			where a.flag = \'1\' '.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function save(
		$registrasi,
        $periode1,
        $periode2,
        $produk,
        $rate,
        $premi,
        $namanasabah,
        $idnasabah,
        $idassets,
        $asuransi,
        $idbroker
        )
	{
		$query = $this->db->query('
			INSERT INTO apm_polis(
				`no_reg`,
				`apm_assets_id`,
				`apm_nasabah_id`,
				`apm_produk_id_produk`,
				`apm_asuransi_id`,
				`apm_broker_id`,
				`name`,
				`date_released`,
				`date_expired`,
				`premi`,
				`flag`
			)
			VALUES(
				\''.$registrasi.'\',
				\''.$idassets.'\',
				\''.$idnasabah.'\',
				\''.$produk.'\',
				\''.$asuransi.'\',
				\''.$idbroker.'\',
				\''.addslashes($namanasabah).'\',
				\''.$periode1.'\',
				\''.$periode2.'\',
				\''.$premi.'\',
				\'1\'
			)
			');
		return $query;
	}

}

/* End of file Mkendaraan.php */
/* Location: ./application/models/polis/kendaraan/Mkendaraan.php */	

	