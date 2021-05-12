<?php

class Viagens_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	public function show_clientes() {
		$this->db->from("clientes");
		return $this->db->get()->result_array();
	}
	public function get_data($id, $select = NULL) {
		if (!empty($select)) {
			$this->db->select($select);
		}
		$this->db->from("clientes");
		$this->db->where("clientes_id", $id);
		return $this->db->get();
	}
	public function insert($data) {
		$this->db->insert("clientes", $data);
	}
	public function update($id, $data) {
		$this->db->where("clientes_id", $id);
		$this->db->update("clientes", $data);
	}
	public function delete($id) {
		$this->db->where("clientes_id", $id);
		$this->db->delete("clientes");
	}
	public function is_duplicated($field, $value, $id = NULL) {
		if (!empty($id)) {
			$this->db->where("clientes_id <>", $id);
		}
		$this->db->from("clientes");
		$this->db->where($field, $value);
		return $this->db->get()->num_rows() > 0;
	}
}