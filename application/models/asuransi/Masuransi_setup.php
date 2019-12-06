<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masuransi_setup extends CI_Model {

		function get($offset,$limit,$search){
		$query = $this->db->query('
			SELECT 
			a.wilayah,
			b.name,
			c.type,
			d.`nilai_rate`,
			NULL as edit,
			NULL as hapus,
			d.id idrate,
			d.id_wilayah,
			d.id_jenis_pertanggungan,
			d.id_kategori_kendaraan
			FROM
			`apm_rate_kendaraan` d
			JOIN
			`apm_plat_wilayah` a
			ON
			d.`id_wilayah` = a.`id`
			JOIN
			`apm_kategori_kendaraan` c
			ON
			d.`id_kategori_kendaraan` = c.`id`
			JOIN
			`apm_jenis_pertanggungan_kendaraan` b
			ON
			d.`id_jenis_pertanggungan` = b.`id`
			where d.flag = \'1\' 
			AND
			id_asuransi = \''.$this->session->userdata('idasuransi').'\'
			'.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function getpage($search)
	{
		$query = $this->db->query('
			SELECT COUNT(*) page from
			`apm_rate_kendaraan` d
			JOIN
			`apm_plat_wilayah` a
			ON
			d.`id_wilayah` = a.`id`
			JOIN
			`apm_kategori_kendaraan` c
			ON
			d.`id_kategori_kendaraan` = c.`id`
			JOIN
			`apm_jenis_pertanggungan_kendaraan` b
			ON
			d.`id_jenis_pertanggungan` = b.`id`
			where d.flag = \'1\' 
			AND id_asuransi = \''.$this->session->userdata('idasuransi').'\'
			'.$search.'
			');
		return $query;	
	}

	function pertanggungan()
	{
		$query = $this->db->query('
			SELECT id, name from
			`apm_jenis_pertanggungan_kendaraan` d
			where d.flag = \'1\'
			');
		return $query;	
	}

	function kategoriknd()
	{
		$query = $this->db->query('
			SELECT id,kategori, type, harga_bawah,harga_atas from
			apm_kategori_kendaraan d
			where d.flag = \'1\'
			');
		return $query;	
	}

	function wilayah()
	{
		$query = $this->db->query('
			SELECT id, wilayah from
			apm_plat_wilayah d
			where d.flag = \'1\'
			');
		return $query;	
	}

	function save($wilayah,$pertanggungan,$kategoriknd,$rate) {
		$query = $this->db->query(
			'
			INSERT IGNORE INTO apm_rate_kendaraan
			(
				id_asuransi,
				id_wilayah,
				id_jenis_pertanggungan,
				id_kategori_kendaraan,
				nilai_rate,
				flag
			)
			values(
				\''.$this->session->userdata('idasuransi').'\',
				\''.$wilayah.'\',
				\''.$pertanggungan.'\',
				\''.$kategoriknd.'\',
				\''.$rate.'\',
				\'1\'
			)
			'
			);
		return $this->db->affected_rows();
		
	}

}

/* End of file Masuransi_setup.php */
/* Location: ./application/models/asuransi/Masuransi_setup.php */