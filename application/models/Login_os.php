<?php 

class Login_os extends CI_Model{

	public function login_user($data) {

		$condition = "username_xxx =" . "'". $data['username'] . "'"." AND " . "password_xxx =" . "'" . md5($data['password']) . "' and flag=1";
		$this->db->select('idapm_user, group_user, apm_broker_user_id, apm_nasabah_id, apm_debitur_id, apm_asuransi_id, flag');
		$this->db->from('apm_user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1)
			return $query->result()[0];
		else
			return false;
		
	}

	public function read_profile_information_nasabah($id) {
		$strQueryWhere[] = "id =" . $id;
		$strQueryWhere[] = "flag = 1";
		$condition = implode(" AND ",$strQueryWhere);
		$this->db->select('*');
		$this->db->from('apm_nasabah_group');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1)
			return $query->result()[0];
		else
			return false;
		
	}

	public function read_profile_information_broker($id) {
		$strQueryWhere[] = "id =" . $id;
		$strQueryWhere[] = "flag = 1";
		$condition = implode(" AND ",$strQueryWhere);
		$this->db->select('*');
		$this->db->from('apm_broker_user');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1)
			return $query->result()[0];
		else
			return false;
		
	}

	public function read_profile_information_asuransi($id) {
		$strQueryWhere[] = "id =" . $id;
		$strQueryWhere[] = "flag = 1";
		$condition = implode(" AND ",$strQueryWhere);
		$this->db->select('*');
		$this->db->from('apm_asuransi');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1)
			return $query->result()[0];
		else
			return false;
		
	}

	public function read_profile_information_debitur($id) {
		$strQueryWhere[] = "id =" . $id;
		$strQueryWhere[] = "flag = 1";
		$condition = implode(" AND ",$strQueryWhere);
		$this->db->select('*');
		$this->db->from('apm_debitur');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1)
			return $query->result()[0];
		else
			return false;
		
	}

}