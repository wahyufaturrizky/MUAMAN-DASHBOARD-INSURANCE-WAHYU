<?php 

class Mbranch extends CI_Model{

	/*
	function get($idbank){
            $condition = "apm_nasabah_group_id = ".$idbank. " and flag = 1";
			$this->db->select('*');
            $this->db->from('apm_nasabah_branch_group');
            $this->db->where($condition);
			$query = $this->db->get();

			if ($query->num_rows() > 0)
				return $query->result();
			else
				return false;
		
	}
	*/

	function get($params = array()){
		$this->db->select('*');
		$this->db->from('apm_nasabah_group');
		$strQueryWhere[] = "flag = 1";

		if(isset($params['idbank'])){
			$strQueryWhere[] = "id_parent = ".$params['idbank'];
		}

		if(isset($params['id'])){
			$strQueryWhere[] = "id = " . $params['id'];
			$this->db->limit(1);
		}

		$condition = implode(" AND ",$strQueryWhere);
		$this->db->where($condition);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return false;
		
	}

	function save($data = array()) {

		if(isset($data['id']))
		{
			$this->db->where('id', $data['id']);
			$this->db->update('apm_nasabah_group', $data);
		} else {
			$this->db->insert('apm_nasabah_group', $data);
		}

		if ($this->db->affected_rows() > 0)
			return true;
		
	}


}