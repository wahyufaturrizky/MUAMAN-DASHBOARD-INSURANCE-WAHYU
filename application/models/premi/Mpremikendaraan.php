<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpremikendaraan extends CI_Model {

    function getcoverage($id)
    {
        $this->db->select('id, name');
        $this->db->from('apm_jenis_pertanggungan_kendaraan');
        $this->db->where('id',$id);

		$query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->row();
        else
            return false;
    }

	function getplatkendaraan()
	{
        $this->db->select('id, id_wilayah, plat');
        $this->db->from('apm_plat_kendaraan');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();
        else
            return false;
    }

    function getidwilayah($id)
    {
        $this->db->select('id_wilayah');
        $this->db->from('apm_plat_kendaraan');
        $this->db->where('id',$id);

		$query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->row()->id_wilayah;
        else
            return false;
    }

    function getkategorikendaraan($price, $type = "Pribadi")
    {

        $query = "select kategori from apm_kategori_kendaraan
        where ('".$price ."' >= (harga_bawah ) AND ('".$price."'<= harga_atas OR harga_atas IS NULL)) and type='".$type."'";

        $result = $this->db->query($query);
        
        return $result->row()->kategori;	
    }

    function getasuransiwithrate($data)
    {
        // echo '<pre>'; print_r($data); echo '</pre>'; die();
        $id_wilayah = $data['id_wilayah'];
        $id_coverage = $data['id_coverage'];
        $id_kategori_kendaraan = $data['id_kategori_kendaraan'];

        $query = "select 
            b.id as idrate, a.name, b.nilai_rate
        from 
        apm_asuransi a,
        apm_rate_kendaraan b
        where
            a.id = b.id_asuransi
        and
            b.id_wilayah = ".$id_wilayah."
        and
            b.id_jenis_pertanggungan = ".$id_coverage."
        and
            b.id_kategori_kendaraan = ".$id_kategori_kendaraan."
        and
            b.flag = 1";

        $result = $this->db->query($query);
        return $result->result();

    }

    function getassets($id)
    {
        $this->db->select('id, name, tsi, address');
        $this->db->from('apm_assets');
        $this->db->where('id',$id);
        $this->db->where('isProtected','N');

		$query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->row();
        else
            return false;
    }
}