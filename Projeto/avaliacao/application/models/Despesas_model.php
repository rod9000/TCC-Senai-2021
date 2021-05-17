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
	public function get_viagens(){
		$this->db->select("*");
		$this->db->from("viagens");
		$this->db->order_by("id_viagens");
		$qry_res = $this->db->get()->result();

		$arr = array();
		foreach($qry_res as $key => $value):
			$arr[$value->id_viagens] = $value->vg_destino;
		endforeach;
		return $arr;
	}

	var $column_search = array("id_despesas  ", "dp_servico", "dp_valor", "dp_local", "dp_data", "dp_viagem", "dp_form_pagamento");
	var $column_order = array("id_despesas", "dp_servico", "dp_valor", "dp_local", "dp_data", "dp_viagem",);

	private function _get_datatable() {

		$search = NULL;
		if ($this->input->post("search")) {
			$search = $this->input->post("search")["value"];
		}
		$order_column = NULL;
		$order_dir = NULL;
		$order = $this->input->post("order");
		if (isset($order)) {
			$order_column = $order[0]["column"];
			$order_dir = $order[0]["dir"];
		}

		$this->db->from("despesas");
		if (isset($search)) {
			$first = TRUE;
			foreach ($this->column_search as $field) {
				if ($first) {
					$this->db->group_start();
					$this->db->like($field, $search);
					$first = FALSE;
				} else {
					$this->db->or_like($field, $search);
				}
			}
			if (!$first) {
				$this->db->group_end();
			}
		}

		if (isset($order)) {
			$this->db->order_by($this->column_order[$order_column], $order_dir);
		}
	}

	public function get_datatable() {

		$length = $this->input->post("length");
		$start = $this->input->post("start");
		$this->_get_datatable();
		if (isset($length) && $length != -1) {
			$this->db->limit($length, $start);
		}
		return $this->db->get()->result();
	}

	public function records_filtered() {

		$this->_get_datatable();
		return $this->db->get()->num_rows();
	}

	public function records_total() {

		$this->db->from("despesas");
		return $this->db->count_all_results();
	}
}