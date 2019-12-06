<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	public function logincek($user,$password)
	{
		$query = $this->db->query(
			'
		 	(Select username_xxx as admin, group_user as usergroup, (select usergroup from m_user_group where id = group_user) groupdesc, password_xxx as password,idapm_user as id from apm_user where username_xxx = \''.$user.'\' and password_xxx = \''.$password.'\')
		 	'
		 	);

		$error = $this->db->error();
		if($error['code']!=0){
			$error = $this->db->error();
			echo '<script>alert("ERROR LOGIN. CODE : '.$error['code'].' MESSAGE : '.$error['message'].'"); document.location.href="home/"</script>';

		}else{
			return $query;
		}
	}

	public function insertlog()
	{
		$query = $this->db->query(
			'
		 	INSERT INTO m_user_log
		 	VALUES(
		 		\''.$this->input->ip_address().'\',
		 		\''.$this->session->userdata('userid').'\',
		 		NOW(),
		 		NULL,
		 		\'Y\'
		 	)
		 	'
		 	);
		return $this->db->affected_rows();
	}

	public function updatelog()
	{
		$query = $this->db->query(
			'
		 	UPDATE m_user_log
		 	SET 
		 	logout_timestamp = NOW(),
		 	state = \'N\'
		 	where 
		 	ip_address =\''.$this->input->ip_address().'\'
		 	'
		 	);
		return $this->db->affected_rows();
	}
}
