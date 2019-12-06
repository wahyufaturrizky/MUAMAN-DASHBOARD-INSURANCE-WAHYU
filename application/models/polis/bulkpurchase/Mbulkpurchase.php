<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbulkpurchase extends CI_Model {

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


	public function getpolisid($id_asuransi,$id_produk,$client)
		{
			$query = $this->db->query("
				SELECT id_polis_induk, id, id_polis_detail from polis_induk 
				where 
				asuransi_id = '{$id_asuransi}' and
				produk_id = '{$id_produk}' and
				client = '{$client}'
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

	public function getheader($id_asuransi,$id_produk)
		{
			$query = $this->db->query("
				SELECT field_list,field_mandatory_list, example, example_mandatory from apm_generated_form where id_asuransi = ".$id_asuransi." and id_produk = ".$id_produk."
			");
			return $query;
		}


	public function getrulefield($id_asuransi,$id_produk,$id_polis)
		{
			$client = $this->session->userdata('userid');
			$query = $this->db->query("
				SELECT rule_id,rule_field FROM `apm_rule` WHERE
				`asuransi_id` = '$id_asuransi' AND
				`produk_id` = '$id_produk' AND
				`client_id` = '$client' AND
				`polis_id` = '$id_polis'
			");
			return $query->result_array();
		}

	public function gettableformula($id_asuransi,$id_produk,$id_polis)
		{
			$client = $this->session->userdata('userid');
			$query = $this->db->query("
				SELECT `tablename`,`rowname`,`columnname`,`id` FROM `apm_table_formula` WHERE
				`asuransi_id` = '$id_asuransi' AND
				`produk_id` = '$id_produk' AND
				`client_id` = '$client' AND
				`polis_id` = '$id_polis'
			");
			return $query;
		}

	public function getvaluetableformula(
            $rowvalue,
            $columnvalue,
            $tableid
        )
	{
		$client = $this->session->userdata('userid');
			$query = $this->db->query("
				SELECT data_value FROM `apm_table_formula_values`
				WHERE
					table_id = '$tableid'
				AND
					row_value = '$rowvalue'
				AND
					column_value = '$columnvalue'
			");
		return $query->result_array();
	}

	public function inserttablevalue(
	        $tableid,
	        $tablename,
	        $purchaseid,
	        $memberid,
	        $value
	    )
	{
		$query = $this->db->query("
		INSERT INTO `formula_table_result` (
		  `table_id`,
		  `table_name`,
		  `purchase_id`,
		  `member_id`,
		  `value`,
		  `createdtimestamp`
		)
		VALUES
		  (
		    '$tableid',
		    '$tablename',
		    '$purchaseid',
		    '$memberid',
		    '$value',
		    NOW()
		  );
		");
		return $this->db->affected_rows();
	}

	public function getresult($queryresult)
		{
			$query = $this->db->query($queryresult);
			return $query->result_array();
		}

	public function get($offset,$limit,$search,$produk,$asuransi,$status,$id_purchase)
		{
			$where ='';
			if($this->session->userdata('usergroup')=='1'){
				$where = 'and a.buyer = \''.$this->session->userdata('userid').'\'';
			}
			$query = $this->db->query("
				SELECT
				-- c.name,
				b.member_name,
				-- a.datestamp,
				a.last_update,
				NULL as viewform,
				NULL as ruleadd,
				NULL as listadd, 
				a.`status`,
				NULL as addform,
				NULL as choose, 
				a.`data`,
				'L' headeradd,
				'L' dataadd,
				a.headerform,
				a.markedas,
				a.markedplus,
				a.id,
				a.id_member,
				a.purchase_id,
				a.buyer
				from polis_muaman a
				JOIN apm_member_bank b
				ON a.id_member = b.member_id  and a.buyer = b.id_nasabah
				JOIN
				apm_nasabah c
				ON
				c.`id` = (SELECT apm_nasabah_id FROM apm_user WHERE idapm_user = b.`id_nasabah`)
				where a.purchase_id= '".$id_purchase."' and a.purchase_type ='BULK' ".$where." and a.`status` = '".$status."' and a.id_asuransi = ".$asuransi." and a.id_produk = ".$produk." ".$search." ORDER BY `timestamp` ASC LIMIT ".$offset.",".$limit."
			");
			return $query;
		}

	public function get0($offset,$limit,$search,$produk,$asuransi)
		{
			$where ='';
			if($this->session->userdata('usergroup')=='1'){
				$where = 'and a.id_nasabah = \''.$this->session->userdata('userid').'\'';
			}
			$query = $this->db->query("
				SELECT a.id_purchase, CONCAT(e.id_polis_induk,':',e.id_polis_detail) polis_induk, a.datestamp, NULL as `detail`,  sertifikat as `download`, 
					NULL as generatesertifikat,
					NULL as generatelampiran,
					NULL as `upload`,  d.username_xxx, b.name, c.nama_produk, e.id_polis_induk,e.id_polis_detail
					FROM `polis_purchase` a
					JOIN `apm_asuransi` b
					ON a.`id_asuransi` = b.`id`
					JOIN `apm_produk` c
					ON a.`id_produk` = c.`id_produk`
					JOIN
					`apm_user` d
					ON a.`id_nasabah` = d.`idapm_user`
					JOIN
					polis_induk e
					ON
					a.polis_induk = e.id
					Where  a.id_asuransi = ".$asuransi."
				".$where." and a.id_produk = ".$produk." ".$search." ORDER BY `timestamp` ASC LIMIT ".$offset.",".$limit."
			");
			return $query;
		}

	function getpage($search,$produk,$asuransi,$status,$id_purchase)
	{
		$where ='';
			if($this->session->userdata('usergroup')=='1'){
				$where = 'and a.buyer = \''.$this->session->userdata('userid').'\'';
			}
		$query = $this->db->query("
			SELECT count(a.id) page
			from polis_muaman a
			JOIN apm_member_bank b
			ON a.id_member = b.member_id  and a.buyer = b.id_nasabah
			JOIN
				apm_nasabah c
				ON
				c.`id` = (SELECT apm_nasabah_id FROM apm_user WHERE idapm_user = b.`id_nasabah`)
			where a.purchase_id= '".$id_purchase."' and a.purchase_type ='BULK' ".$where." and a.`status` = '".$status."' and a.id_asuransi = ".$asuransi." and a.id_produk = ".$produk." ".$search."
			");
		return $query;
	}

	function getpage0($search,$produk,$asuransi)
	{
		$where ='';
			if($this->session->userdata('usergroup')=='1'){
				$where = 'and a.id_nasabah = \''.$this->session->userdata('userid').'\'';
			}
		$query = $this->db->query("
			SELECT COUNT(id_purchase) page
					FROM `polis_purchase` a
					JOIN `apm_asuransi` b
					ON a.`id_asuransi` = b.`id`
					JOIN `apm_produk` c
					ON a.`id_produk` = c.`id_produk`
					JOIN
					`apm_user` d
					ON a.`id_nasabah` = d.`idapm_user`
					Where  a.id_asuransi = ".$asuransi."
				".$where." and a.id_produk = ".$produk." ".$search." ORDER BY `timestamp`
			");
		return $query;
	}

	function insertbulkdata($bulkdata)
	{
		$query = $this->db->query("
			INSERT IGNORE INTO polis_muaman VALUES ".$bulkdata."
			");
		return $query;
	}

	function insertbulkdata2($bulkdata)
	{
		$query = $this->db->query("
			INSERT IGNORE INTO apm_member_bank VALUES ".$bulkdata."
			");
		return $query;
	}

	function insertpurchasemember($bulkdata)
	{
		$query = $this->db->query("
		INSERT INTO `purchase_data` (
		  `purchase_id`,
		  `memberid`,
		  `fieldname`,
		  `fieldvalue`,
		  `creatdedtimestamp`
		)
		VALUES
		".$bulkdata."
		");
		return $query;
	}

	function getemail()
	{
		$query = $this->db->query("
			SELECT email FROM apm_nasabah WHERE id =
			(SELECT apm_nasabah_id  FROM apm_user WHERE idapm_user = '".$this->session->userdata('userid')."' )
			");
		return $query;
	}

	function updateflag($flag,$id)
	{
		$query = $this->db->query("
			UPDATE polis_muaman set
			`markedas` = '".$flag."',
			`markedby` = '".$this->session->userdata('userid')."'
			where id = '".$id."'
			");
		return $query;
	}

	function addform($addform,$id)
	{
		$query = $this->db->query("
			UPDATE polis_muaman set
			`markedplus` = '".$addform."',
			`markedby` = '".$this->session->userdata('userid')."'
			where id = '".$id."'
			");
		return $query;
	}

	function updateflagall($flag,$where,$id_purchase)
	{
		if($flag =='-'){
			$flag = 'NULL';
			$markedby = 'NULL';
		}
		else{
			$flag = "'".strtoupper($flag)."'";
			$markedby =  "'".$this->session->userdata('userid')."'";
		}
		$query = $this->db->query("
			UPDATE polis_muaman set
			`markedas` = ".$flag.",
			`markedby` = ".$markedby."
			where `status` = '".$where."'
			and purchase_id = '".$id_purchase."'
			");
		return $query;
	}
	function updatestatusflag($id_purchase)
	{
		$query = $this->db->query("
			UPDATE polis_muaman set
			`status` = markedas,
			markedas = null,
			last_update = now()
			where
			markedas is not null
			and
			markedby = '".$this->session->userdata('userid')."'
			and purchase_id = '".$id_purchase."'
			");
		return $query;
	}

	function getemaildata($id_purchase)
	{
		$query = $this->db->query("
			SELECT DISTINCT email, `status`  FROM polis_muaman WHERE markedby = '".$this->session->userdata('userid')."' and `status` != 'OPEN'
			and purchase_id = '".$id_purchase."'
			");
		return $query;
	}



	function setmarkednull($status,$id_purchase)
	{
		$query = $this->db->query("
			UPDATE polis_muaman set
			markedby = NULL
			where
			`status` = '".$status."' and
			markedby = '".$this->session->userdata('userid')."'
			and purchase_id = '".$id_purchase."'
			");
		return $query;
	}

	public function getdatastatus($status,$id_purchase)
	{
		$query = $this->db->query("
			SELECT headerform, `data` from polis_muaman where `status` = '".$status."' and
			markedby = '".$this->session->userdata('userid')."'
			and purchase_id = '".$id_purchase."'
			");
		return $query;
	}

	public function insertqueue()
	{
		$query = $this->db->query("
			INSERT INTO `purchase_queue` (`id`, `datestamp`)
			VALUES
			(NULL, CURDATE());
			");
		return $this->db->insert_id();
	}

	public function insertpurchase($asuransi,$produk,$idpurchase,$idpolis)
	{
		$query = $this->db->query("
		INSERT INTO `polis_purchase` (
			  `id`,
			  `Id_purchase`,
			  `id_asuransi`,
			  `id_produk`,
			  `id_nasabah`,
			  `polis_induk`,
			  `datestamp`,
			  `timestamp`
			)
			VALUES
			  (
			    NULL,
			    '{$idpurchase}',
			    '{$asuransi}',
			    '{$produk}',
			    '{$this->session->userdata('userid')}',
			    '{$idpolis}',
			    CURDATE(),
			    CURTIME()
			  )
		");
		return $this->db->affected_rows();
	}

	public function updatesertifikat($id_purchase,$filename,$sm_desc)
	{
		$query = $this->db->query("
		INSERT INTO `polis_sertifikat` (
		  `id`,
		  `id_purchase`,
		  `sertifikat`,
		  `description`,
		  `date_upload`
		)
		VALUES
		  (
		    NULL,
		    '$id_purchase',
		    '$filename',
		    '$sm_desc',
		    NOW()
		  );

		");
		return $this->db->affected_rows();
	}

	public function getsertifikat($id_purchase)
	{
		$query = $this->db->query("
		SELECT
		  `sertifikat`,
		  `description`,
		  `date_upload`
		FROM
			`polis_sertifikat`
		WHERE
			id_purchase ='$id_purchase'
		");
		return $query;
	}

	public function getformtambahan($id_asuransi,$id_produk,$id_user)
	{
		$query = $this->db->query("
		SELECT
		  `id`,
		  `formname`,
		  `state`,
		  `createdtimestamp`
		FROM
		  `apm_additional_form`
		where
			`asuransi_id` = '$id_asuransi'
		AND
			`produk_id` = '$id_produk'
		AND
  			`user_id` = '$id_user'
  		AND
  			`state` = '1'

		");
		return $query;
	}

	public function saveuseraddform($id_purchase,$id_member,$id_addform)
		{
		$query = $this->db->query("
		INSERT INTO `polis_additional_document` (
		  `id_purchase`,
		  `id_member`,
		  `additional_form_id`
		)
		VALUES
		  (
		    '$id_purchase',
		    '$id_member',
		    '$id_addform'
		  );
		 ");
		return $query;
	}

	public function addformdata($id_purchase,$id_member)
		{
		$query = $this->db->query("
		SELECT
		  b.formname,
		  b.filename,
		  IFNULL(a.`user_upload_form`,'BELUM DIUPLOAD MEMBER') user_upload_form,
		  IFNULL(a.`date_upload`,'TIDAK ADA') date_upload,
		  a.additional_form_id
		FROM
		  `polis_additional_document` a
		JOIN
			apm_additional_form b
		ON
			a.additional_form_id = b.id
		WHERE
		  	a.id_purchase =  '$id_purchase'
		AND
		    a.id_member = '$id_member'
		  ;
		 ");
		return $query;
	}

	public function updateformtambahan($id_purchase,$id_member,$id_addform,$filename)
		{
		$query = $this->db->query("
		UPDATE polis_additional_document
		SET
			user_upload_form = '$filename',
			date_upload = NOW()
		WHERE
		  	id_purchase =  '$id_purchase'
		AND
		    id_member = '$id_member'
		AND
			additional_form_id = '$id_addform'
		  ;
		 ");
		return $this->db->affected_rows();
	}


	public function getpolispdf($polis_id,$detail_id)
	{
		$query = $this->db->query("
			SELECT
			  a.`periode_start`,
			  a.`pemegang_polis`,
			  b.name as asuransi
			FROM
				polis_induk a
			JOIN
				`apm_asuransi` b
			ON 
				a.`asuransi_id` = b.`id`
			where
				`id_polis_induk` = '$polis_id'
			AND
				id_polis_detail = '$detail_id'
		");
		return $query;
	}


	public function getpurchasepdf($id_purchase)
	{
		$query = $this->db->query("
			SELECT
			  `data`,
			  `headerform`
			FROM
				`polis_muaman`
			where
				`purchase_id` = '$id_purchase'
		");
		return $query;
	}
}