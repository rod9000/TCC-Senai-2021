<?php

class Viagens_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	public function show_viagens() {
		$this->db->from("viagens");
		return $this->db->get()->result_array();
	}
	public function get_data($id, $select = NULL) {
		if (!empty($select)) {
			$this->db->select($select);
		}
		$this->db->from("viagens");
		$this->db->where("id_viagens", $id);
		return $this->db->get();
	}
	public function insert($data) {
		$this->db->insert("viagens", $data);
	}
	public function update($id, $data) {
		$this->db->where("id_viagens", $id);
		$this->db->update("viagens", $data);
	}
	public function delete($id) {
		$this->db->where("id_viagens", $id);
		$this->db->delete("viagens");
	}
	public function is_duplicated($field, $value, $id = NULL) {
		if (!empty($id)) {
			$this->db->where("id_viagens <>", $id);
		}
		$this->db->from("viagens");
		$this->db->where($field, $value);
		return $this->db->get()->num_rows() > 0;
	}
}