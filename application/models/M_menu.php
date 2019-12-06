<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_menu extends CI_Model {

public function getmenuparent($group)
	{
		$query = $this->db->query(
			'SELECT distinct
				a.id,
				a.caption,
				a.style,
				a.link,
				a.isparent,
                                a.order_num
			 FROM m_menu_parent AS a
			 JOIN
			 menu_priviledge AS b
			 ON
			 a.id = b.idmenuparent
			 where
			 ismenu =\'y\'
			 and
			 b.usergroup='.$group.'
	 		 order by order_num ASC
			 ');
		return $query;
	}	

	public function getusergroup($id)
	{
	$query = $this->db->query(
	'select usergroup from m_admin where id = '.$id);
	return $query;
	}

public function getmenuchild($id,$group)
{
	$query = $this->db->query(
	'select a.* 
	 from m_menu_child as a 
	 join
	 menu_priviledge as b
	 on
	 a.id = b.idmenuchild
	 where ismenu = \'y\' and usergroup = '.$group.' and idparent = '.$id);
	return $query;
}

public function cek_priv($page,$id)
{
	$query = $this->db->query(
			'SELECT 
				a.id,
				a.caption,
				a.style,
				a.link,
				c.link,
				b.usergroup
			 FROM m_menu_parent AS a
			 JOIN
			 menu_priviledge AS b
			 ON
			 a.id = b.idmenuparent
			 LEFT JOIN
			 m_menu_child AS c
			 ON
			 c.id = b.idmenuchild
			WHERE 
			(b.`usergroup` = '.$id.'
			AND a.`link` = \''.$page.'\')
			OR
			(b.`usergroup` ='.$id.'
			AND c.`link` =\''.$page.'\')');
	return $query;
}
}

/* End of file m_menu.php */
/* Location: ./application/models/m_menu.php */
