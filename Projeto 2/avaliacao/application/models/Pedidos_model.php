<?php

class Courses_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function show_courses() {
		$this->db->from("pedidos");
		return $this->db->get()->result_array();
	}

	public function get_data($id, $select = NULL) {
		if (!empty($select)) {
			$this->db->select($select);
		}
		$this->db->from("pedidos");
		$this->db->where("pedidos_id", $id);
		return $this->db->get();
	}

	public function insert($data) {
		$this->db->insert("pedidos", $data);
	}

	public function update($id, $data) {
		$this->db->where("pedidos_id", $id);
		$this->db->update("pedidos", $data);
	}

	public function delete($id) {
		$this->db->where("pedidos_id", $id);
		$this->db->delete("pedidos");
	}

	public function is_duplicated($field, $value, $id = NULL) {
		if (!empty($id)) {
			$this->db->where("pedidos_id <>", $id);
		}
		$this->db->from("pedidos");
		$this->db->where($field, $value);
		return $this->db->get()->num_rows() > 0;
	}

}