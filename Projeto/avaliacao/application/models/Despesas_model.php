<?php

class Despesas_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	public function show_despesas() {
		$this->db->from("despesas");
		return $this->db->get()->result_array();
	}
	public function get_data($id, $select = NULL) {
		if (!empty($select)) {
			$this->db->select($select);
		}
		$this->db->from("despesas");
		$this->db->where("id_despesas", $id);
		return $this->db->get();
	}
	public function insert($data) {
		$this->db->insert("despesas", $data);
	}
	public function update($id, $data) {
		$this->db->where("id_despesas", $id);
		$this->db->update("despesas", $data);
	}
	public function delete($id) {
		$this->db->where("id_despesas", $id);
		$this->db->delete("despesas");
	}
	public function is_duplicated($field, $value, $id = NULL) {
		if (!empty($id)) {
			$this->db->where("id_despesas <>", $id);
		}
		$this->db->from("despesas");
		$this->db->where($field, $value);
		return $this->db->get()->num_rows() > 0;
	}
}