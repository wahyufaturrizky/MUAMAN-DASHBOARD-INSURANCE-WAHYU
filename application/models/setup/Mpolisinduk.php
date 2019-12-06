<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpolisinduk extends CI_Model {

	public function getasuransi()
		{
			$where ='';
			if($this->session->userdata('usergroup')=='3'){
				$where = 'WHERE id_asuransi = (select apm_asuransi_id from apm_user where idapm_user = \''.$this->session->userdata('userid').'\')';
			}
			$query = $this->db->query("
			SELECT DISTINCT a.id_asuransi, b.name nama_asuransi FROM 
			apm_produk_asuransi a
			JOIN
			apm_asuransi b
			ON
			a.`id_asuransi` = b.`id`
			".$where."
			");
			return $query;	
		}

	public function getnasabah()
		{
			$query = $this->db->query("
			SELECT 
				a.name,
				b.idapm_user id	
			FROM 
				apm_nasabah a
			join
				apm_user b
			on a.id = b.apm_nasabah_id
			and a.flag = 1
			");
			return $query;	
		}	

	public function getprodukasuransi($id_asuransi)
		{
			$query = $this->db->query("
				SELECT b.id_produk, b.nama_produk FROM `apm_produk_asuransi` a JOIN
				`apm_produk` b ON a.`id_produk` = b.`id_produk` AND a.`id_asuransi` = ".$id_asuransi."
			");
			return $query;	
		}		


	public function inserttopolisinduk(
        	 	$asid,
        	 	$prodid,
        	 	$client,
        	 	$id_polis,
        	 	$pemegang,
                $nama,
                $state,
                $filename,
                $polisdetail,
                $jenispolis,
                $periodestart,
                $periodeend
        	){
			$query = $this->db->query("
			INSERT INTO `polis_induk` (
			  `id_polis_induk`,
			  `asuransi_id`,
			  `produk_id`,
			  `client`,
			  `pemegang_polis`,
			  `nama_pemegang_polis`,
			  `pdffile`,
			  `state`,
			  `id_polis_detail`,
			  `jenis_polis`,
			  `periode_start`,
			  `periode_end`,
			  `createdtimestamp`

			)
			VALUES
			  (
			    '{$id_polis}',
			    '{$asid}',
			    '{$prodid}',
			    '{$client}',
			    '{$pemegang}',
			    '{$nama}',
			    '{$filename}',
			    '{$state}',
			    '{$polisdetail}',
			    '{$jenispolis}',
			    '{$periodestart}',
			    '{$periodeend}',
			    NOW()
			  )
			  ON DUPLICATE KEY 
			  UPDATE 
			  `id_polis_induk` = VALUES(`id_polis_induk`),
			  `id_polis_detail` = VALUES(`id_polis_detail`),
			  `asuransi_id` = VALUES(`asuransi_id`),
			  `produk_id` = VALUES (produk_id),
			  `client` = VALUES(client),
			  `pemegang_polis` = VALUES(pemegang_polis),
			  `nama_pemegang_polis` = VALUES(nama_pemegang_polis),
			  `pdffile` = VALUES(pdffile),
			  `state` = VALUES(state),
			  `jenis_polis` = VALUES(`jenis_polis`),
			  `periode_start` = VALUES(`periode_start`),
			  `periode_end` = VALUES(`periode_end`),
			  `createdtimestamp` = VALUES(createdtimestamp)

			");
			return $this->db->affected_rows();
		}


	function get($offset,$limit,$search,$produk,$asuransi,$userid){
		$query = $this->db->query('
			SELECT id_polis_induk,id_polis_detail,jenis_polis,periode_start,periode_end, pemegang_polis , nama_pemegang_polis,state,
			NULL btndownload,
			NULL btndiscount,
			NULL btncommision,
			NULL btnothers,
			NULL btnformula,
			NULL btnedit,
			NULL btndelete,
			id id_form,
			asuransi_id,
			produk_id,
			pdffile,
			client
			FROM polis_induk WHERE 
			produk_id = \''.$produk.'\' and
			asuransi_id = \''.$asuransi.'\' AND
			client = \''.$userid.'\'
			'.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function getpage($search,$produk,$asuransi,$userid)
	{
		$query = $this->db->query('
			SELECT COUNT(id) page 
			FROM polis_induk WHERE 
			produk_id = \''.$produk.'\' and
			asuransi_id = \''.$asuransi.'\' AND
			client = \''.$userid.'\' '.$search.'
			');
		return $query;	
	}

	function delete($id)
	{
			$query = $this->db->query("
				DELETE FROM polis_induk WHERE id = '".$id."'
			");
			return $this->db->affected_rows();
	}

}

/* End of file Mformasuransi.php */
/* Location: ./application/models/setup/Mformasuransi.php */