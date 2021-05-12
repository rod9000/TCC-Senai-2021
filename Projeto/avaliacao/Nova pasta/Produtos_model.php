<?php

class Produtos_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function show_produtos() {
		$this->db->from("produtos");
		return $this->db->get()->result_array();
	}

	public function get_data($id, $select = NULL) {
		if (!empty($select)) {
			$this->db->select($select);
		}
		$this->db->from("produtos");
		$this->db->where("produtos_id", $id);
		return $this->db->get();
	}

	public function insert($data) {
		$this->db->insert("produtos", $data);
	}

	public function update($id, $data) {
		$this->db->where("produtos_id", $id);
		$this->db->update("produtos", $data);
	}

	public function delete($id) {
		$this->db->where("produtos_id", $id);
		$this->db->delete("produtos");
	}

	public function is_duplicated($field, $value, $id = NULL) {
		if (!empty($id)) {
			$this->db->where("produtos_id <>", $id);
		}
		$this->db->from("produtos");
		$this->db->where($field, $value);
		return $this->db->get()->num_rows() > 0;
	}

}