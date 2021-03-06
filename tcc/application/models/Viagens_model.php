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
		return $this->db->get()->result();
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
	public function get_despesas_cad($id_viagem){
		$this->db->select("*");
		$this->db->from("despesas");
		$this->db->where("dp_viagem = {$id_viagem}");
		$qry_res = $this->db->get()->row();
		if($qry_res == null):
		return null;
		else:
			return 1;
		endif;
	}
	public function get_funcionario($id){
		$this->db->select("user_full_name");
		$this->db->from("users");
		$this->db->where("user_id = {$id}");
		$this->db->order_by("user_id");
		$qry_res = $this->db->get()->row();
		return $qry_res;
	}
	public function get_funcionarios(){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->order_by("user_id");
		$qry_res = $this->db->get()->result();

		$arr = array();
		foreach($qry_res as $key => $value):
			$arr[$value->user_id] = $value->user_login;
		endforeach;
		return $arr;
	}
	public function Realizada(){
		$realizada = array(
			'2' => "Não",
			'1' => "Sim",
		);
		return $realizada;
	}
	public function get_realizada($valor){
		$realizada = array(
			'1' => "Sim",
			'2' => "Não",
		);
		if($valor == 1):
			return $realizada[1];
		else:
			return $realizada[2];
		endif;
	}
	public function get_servicos(){
		$this->db->select("*");
		$this->db->from("servicos");
		$this->db->order_by("id_servicos");
		$qry_res = $this->db->get()->result();

		$arr = array();
		foreach($qry_res as $key => $value):
			$arr[$value->id_servicos] = $value->sv_nome;
		endforeach;
		return $arr;
	}
	public function get_servico($id){
		$this->db->select("sv_nome");
		$this->db->from("servicos");
		$this->db->where("id_servicos = {$id}");
		$this->db->order_by("id_servicos");
		$qry_res = $this->db->get()->row();

		return $qry_res;
	}
	public function get_users($id){
		$this->db
		->select("user_tipo")
		->from("users")
		->where("user_id", $id);
		
		$result = $this->db->get()->row();
		return $result;
	}
	var $column_search = array("id_viagens ", "vg_destino", "vg_dsaida", "vg_dretorno", "vg_funcionario", );
	var $column_order = array("id_viagens", "vg_destino", "vg_dsaida", "vg_dretorno", "vg_funcionario");

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

		$this->db->from("viagens");
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

		$this->db->from("viagens");
		return $this->db->count_all_results();
	}
	
}