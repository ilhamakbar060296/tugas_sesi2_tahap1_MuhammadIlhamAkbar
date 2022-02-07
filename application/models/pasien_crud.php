<?php
defined('BASEPATH') OR exit('No Direct script access allowed');

class Pasien_crud extends CI_model{

	public function get_all(){
		$query = $this->db->select("*")
					  	  ->from('pasien')
					  	  ->order_by('id', 'ASC')
					  	  ->get();

		return $query->result();		
	}

	public function get_data($email){
		$query = $this->db->select("*")->from("pasien")->where("email",$email)->get();

		return $query->result();
	}

	public function get_dokter(){
		$query = $this->db-> select("*")->from("dokter")->order_by('id_dokter', 'ASC')->get();

		return $query->result();	
	}

	public function pick_dokter($no){
		$query = $this->db->where("id_dokter", $no)
						  ->get("dokter");
		if($query){
			return $query->row();
		}else{
			return false;
		}
	}

	public function simpan_dokter($data){
		$query = $this->db->insert("dokter", $data);

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function update_dokter($value, $column, $no){
		$this->db->set($column,$value);		
		$this->db->where("id_dokter",$no);
		$this->db->update("dokter");
	}

	public function hapus_dokter($NO){
		$query = $this->db->delete("dokter", $NO);

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function hapus_semua_dokter(){
		$query = $this->db->truncate("dokter");

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function get_pasien(){
		$query = $this->db-> select("*")->from("pasien")->order_by('id_pasien', 'ASC')->get();

		return $query->result();	
	}

	public function pick_pasien($no){
		$query = $this->db->where("id_pasien", $no)
						  ->get("pasien");
		if($query){
			return $query->row();
		}else{
			return false;
		}
	}

	public function pick_riwayat($no){
		$query = $this->db-> select("*")->from("riwayat_penyakit")->where("id_pasien", $no)->get();

		return $query->result();
	}

	public function simpan_pasien($data){
		$query = $this->db->insert("pasien", $data);

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function simpan_riwayat($data){
		$query = $this->db->insert("riwayat_penyakit", $data);

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function update_pasien($value, $column, $no){
		$this->db->set($column,$value);		
		$this->db->where("id_pasien",$no);
		$this->db->update("pasien");
	}

	public function hapus_pasien($NO){
		$query = $this->db->delete("pasien", $NO);

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function hapus_semua_pasien(){
		$query = $this->db->truncate("pasien");

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function get_penyakit(){
		$query = $this->db-> select("*")->from("penyakit")->order_by('id_penyakit', 'ASC')->get();

		return $query->result();	
	}

	public function pick_penyakit($no){
		$query = $this->db->where("id_penyakit", $no)
						  ->get("penyakit");
		if($query){
			return $query->row();
		}else{
			return false;
		}
	}

	public function simpan_penyakit($data){
		$query = $this->db->insert("penyakit", $data);

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function update_penyakit($value, $column, $no){
		$this->db->set($column,$value);		
		$this->db->where("id_penyakit",$no);
		$this->db->update("penyakit");
	}

	public function hapus_penyakit($NO){
		$query = $this->db->delete("penyakit", $NO);

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function hapus_semua_penyakit(){
		$query = $this->db->truncate("penyakit");

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function get_obat(){
		$query = $this->db-> select("*")->from("obat")->order_by('id_obat', 'ASC')->get();

		return $query->result();	
	}

	public function pick_obat($no){
		$query = $this->db->where("id_obat", $no)
						  ->get("obat");
		if($query){
			return $query->row();
		}else{
			return false;
		}
	}

	public function simpan_obat($data){
		$query = $this->db->insert("obat", $data);

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function update_obat($value, $column, $no){
		$this->db->set($column,$value);		
		$this->db->where("id_obat",$no);
		$this->db->update("obat");
	}

	public function hapus_obat($NO){
		$query = $this->db->delete("obat", $NO);

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function hapus_semua_obat(){
		$query = $this->db->truncate("obat");

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function get_pembelian(){
		$query = $this->db-> select("*")->from("pembelian")->order_by('no', 'ASC')->get();

		return $query->result();	
	}

	public function pick_pembelian($no){
		$query = $this->db->where("no", $no)
						  ->get("pembelian");
		if($query){
			return $query->row();
		}else{
			return false;
		}
	}

	public function simpan_pembelian($data){
		$query = $this->db->insert("pembelian", $data);

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function update_pembelian($value, $column, $no){
		$this->db->set($column,$value);		
		$this->db->where("no",$no);
		$this->db->update("pembelian");
	}

	public function hapus_pembelian($NO){
		$query = $this->db->delete("pembelian", $NO);

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function hapus_semua_pembelian(){
		$query = $this->db->truncate("pembelian");

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function get_penjualan(){
		$query = $this->db-> select("*")->from("penjualan")->order_by('no', 'ASC')->get();

		return $query->result();	
	}

	public function pick_penjualan($no){
		$query = $this->db->where("no", $no)
						  ->get("penjualan");
		if($query){
			return $query->row();
		}else{
			return false;
		}
	}

	public function simpan_penjualan($data){
		$query = $this->db->insert("penjualan", $data);

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function update_penjualan($value, $column, $no){
		$this->db->set($column,$value);		
		$this->db->where("no",$no);
		$this->db->update("penjualan");
	}

	public function hapus_penjualan($NO){
		$query = $this->db->delete("penjualan", $NO);

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function hapus_semua_penjualan(){
		$query = $this->db->truncate("penjualan");

		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	public function simpan($data){
		$query = $this->db->insert("pasien", $data);

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function edit($ID){
		$query = $this->db->where("id", $ID)
						  ->get("pasien");

		if($query){
			return $query->row();
		}else{
			return false;
		}				  
	}

	
	public function update($data, $ID){
		$query = $this->db->update("pasien", $data, $ID);

		if($query){
			return true;
		}else{
			return false;
		}
	}
}
