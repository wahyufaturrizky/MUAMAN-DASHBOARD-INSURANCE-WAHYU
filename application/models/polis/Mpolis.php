<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpolis extends CI_Model {

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
			join apm_request_flag c
			on a.isProtected = c.requestCode 
			where a.flag = \'1\' 
			'.$search.'
			');
		return $query;	
	}

	function getpagepolis($search)
	{
			$query = $this->db->query('
			SELECT 
			COUNT(a.id) page
			FROM apm_polis a
			LEFT JOIN apm_assets b
			ON
			a.`apm_assets_id` = b.`id`
			LEFT JOIN apm_nasabah c
			ON
			a.`apm_nasabah_id` = c.`id`
			LEFT JOIN apm_produk d
			ON
			a.`apm_produk_id_produk` = d.`id_produk`
			LEFT JOIN apm_broker e
			ON
			a.`apm_broker_id` = e.`id`
			LEFT JOIN apm_asuransi f
			ON
			a.`apm_asuransi_id` = f.`id`
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

	function cekifexist($tbl)
	{
		$query = $this->db->query('
		SELECT * 
		FROM information_schema.tables
		WHERE table_schema = \'apm\' 
		    AND table_name = \'apm_akseptasi_'.$tbl.'\'
		LIMIT 1');
		return $query;
	}

	function getprodukname($id)
	{
		$query = $this->db->query('
			SELECT nama_produk 
			from apm_produk
			where id_produk = \''.$id.'\'
			');
		return $query->result_array();	
	}


	function getformvalue($tbl,$noreg)
	{
		$query = $this->db->query('
			SELECT * 
			from apm_akseptasi_'.$tbl.'
			where no_reg = \''.$noreg.'\'
			');
		return $query->result_array();	
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

	function getflag($groupid)
	{
		$query = $this->db->query('
			SELECT id,description 
			from apm_flag
			where id_part_of_broker like \'%'.$groupid.'%\'
			');
		return $query;	
	}

	function getidbroker($id)
	{
		$query = $this->db->query('
			SELECT b.`id_broker`, a.`apm_broker_user_id` , b.`part_of_id`
			FROM apm_user a
			JOIN
			apm_broker_user b
			ON
			a.`apm_broker_user_id` = b.`id`
			WHERE a.`idapm_user` = \''.$id.'\'
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
			if(a.isProtected =\'N\',\'<button class="btn btn-warning btn-flat form-control"><i class="fa fa-ban"></i> UNREQUEST</button>\',
			\'<button class="btn btn-primary btn-flat form-control"><i class="fa fa-refresh"></i> REQUESTED</button>\' 
			) isProtectedicon,  
			\'<button class="btn btn-info btn-flat" id="chooseasset"><i class="fa fa-file"></i> PILIH</button>\',
			a.id,
			a.apm_nasabah_id
			from apm_assets a
			join apm_nasabah b
			on a.apm_nasabah_id = b.id 
			join apm_request_flag c
			on a.isProtected = c.requestCode 
			where a.flag = \'1\' 
			'.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function getpolis($offset,$limit,$search){
		$query = $this->db->query('
			SELECT 
			a.no_reg,
			a.name namaNasabah,
			b.name namaAset,
			d.nama_produk,
			e.name namaBroker,
			if(f.name is NULL,\'Belum Dipilih\',f.name) namaAsuransi,
			a.date_released,
			a.date_expired,
			b.tsi,
			a.premi,
			g.description,
			IF(h.edit = \'Y\', \'<button class="btn btn-info btn-flat" id="choosequote"><i class="fa fa-file"></i> PILIH</button>\',
				\'<button class="btn btn-info btn-flat" disabled><i class="fa fa-file"> PILIH</i></button>\'
			),
			a.`id`,
			a.`apm_assets_id`,
			a.`apm_nasabah_id`,
			a.`apm_produk_id_produk`,
			a.`apm_broker_id`,
			a.`apm_asuransi_id`,
			b.address,
			a.flag
			FROM apm_polis a
			LEFT JOIN apm_assets b
			ON
			a.`apm_assets_id` = b.`id`
			LEFT JOIN apm_nasabah c
			ON
			a.`apm_nasabah_id` = c.`id`
			LEFT JOIN apm_produk d
			ON
			a.`apm_produk_id_produk` = d.`id_produk`
			LEFT JOIN apm_broker e
			ON
			a.`apm_broker_id` = e.`id`
			LEFT JOIN apm_asuransi f
			ON
			a.`apm_asuransi_id` = f.`id`
			LEFT JOIN apm_flag g
			ON
			a.flag = g.`id`
			LEFT JOIN apm_flag_priviledge h
			ON
			h.`id_broker_pos` = '.$this->session->userdata('part_of_id').'
			AND
			h.`id_flag` = a.`flag`
			'.$search.'
			ORDER BY id DESC
			LIMIT '.$offset.','.$limit.'
		');
		return $query;
		
	}

	function getpolisdata($noreg){
		$query = $this->db->query('
			SELECT 
			a.no_reg,
			a.name namaNasabah,
			b.name namaAset,
			d.nama_produk,
			e.name namaBroker,
			if(f.name is NULL,\'Belum Dipilih\',f.name) namaAsuransi,
			a.date_released,
			a.date_expired,
			b.tsi,
			a.premi,
			g.description,
			b.address,
			a.flag
			FROM apm_polis a
			LEFT JOIN apm_assets b
			ON
			a.`apm_assets_id` = b.`id`
			LEFT JOIN apm_nasabah c
			ON
			a.`apm_nasabah_id` = c.`id`
			LEFT JOIN apm_produk d
			ON
			a.`apm_produk_id_produk` = d.`id_produk`
			LEFT JOIN apm_broker e
			ON
			a.`apm_broker_id` = e.`id`
			LEFT JOIN apm_asuransi f
			ON
			a.`apm_asuransi_id` = f.`id`
			LEFT JOIN apm_flag g
			ON
			a.flag = g.`id`
			where
			a.no_reg = \''.$noreg.'\'
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
        $flag,
        $idbroker,
        $idbrokeruser
        )
	{
		$query = $this->db->query('
			REPLACE INTO apm_polis(
				`id`,
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
				`flag`,
				`apm_broker_user_id`
			)
			VALUES(
				NULL,
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
				\''.$flag.'\',
				\''.$idbrokeruser.'\'
			)
			');
		return $query;
	}

	function saveakseptasikendaraan(
		      $registrasi,      
              $no_polisi,   
              $no_rangka,     
              $penggunaan,    
              $thp,           
              $kondisi,       
              $tjhpihak3,     
              $tjhpenumpang,  
              $papengemudi,   
              $papenumpang,   
              $lainnya,       
              $informasi,
              $namaitem,
              $hargaitem  
		)
	{
		$query = $this->db->query('
			REPLACE INTO apm_akseptasi_kendaraan(
				`no_reg`,
				`no_polisi`,
				`no_rangka_mesin`,
				`penggunaan`,
				`thp`,
				`kondisi`,
				`TJHpihak3`,
				`TJHpenumpang`,
				`PApengemudi`,
				`PApenumpang`,
				`lain2`,
				`informasi`,
				aksesoris_item,
				aksesoris_harga
			)
			VALUES(
			  \''.$registrasi.'\',      
              \''.$no_polisi.'\',   
              \''.$no_rangka.'\',     
              \''.$penggunaan.'\',    
              \''.$thp.'\',           
              \''.$kondisi.'\',       
              \''.$tjhpihak3.'\',     
              \''.$tjhpenumpang.'\',  
              \''.$papengemudi.'\',   
              \''.$papenumpang.'\',   
              \''.$lainnya.'\',       
              \''.$informasi.'\',
              \''.$namaitem.'\',
              \''.$hargaitem.'\'  
			)
			');
		return $query;
	}

	function getidbrokeruser($id)
	{
		$query = $this->db->query('
			SELECT apm_broker_user_id
			from apm_user
			where idapm_user = \''.$id.'\'
			');
		return $query->result_array();	
	}

	function getidpartofbroker($id_user)
	{
		$query = $this->db->query('
			SELECT id_broker,part_of_id
			from apm_broker_user
			where id = \''.$id_user.'\'
			');
		return $query->result_array();	
	}

	function getflagallowed($part_of_id)
	{
		$query = $this->db->query('
			SELECT id FROM `apm_flag` WHERE 
			id_part_of_broker LIKE \'%'.$part_of_id.'%\'
			');
		return $query;	
	}

}

/* End of file Mkendaraan.php */
/* Location: ./application/models/polis/kendaraan/Mkendaraan.php */	

	