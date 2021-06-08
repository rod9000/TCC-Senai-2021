<?php

class Relatorio_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_funcionario($id){
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("user_id = {$id}");
		$this->db->order_by("user_id");
		$qry_res = $this->db->get()->row();
		return $qry_res;
    }
    public function get_servico($id){
		$this->db->select("*");
		$this->db->from("servicos");
		$this->db->where("id_servicos = {$id}");
		$this->db->order_by("id_servicos");
		$qry_res = $this->db->get()->row();

		return $qry_res;
	}

    public function get_valor_despesas($viagem, $funcionario){
        $this->db->select_sum("dp_valor");
        $this->db->from("despesas");
        $this->db->where("dp_viagem = {$viagem} AND dp_funcionario = {$funcionario}");
        $qry_res = $this->db->get()->result();
        
        return $qry_res;
    }   

    var $column_search = array("id_viagens", "vg_destino");
    var $column_order = array("id_viagens",  "vg_destino");

    private function _get_datatable()
    {

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
        $this->db->select("id_viagens as id, vg_servico as servico, vg_funcionario as funcionario, vg_destino as viagens, vg_dsaida as saida, vg_dretorno as retorno, vg_valorin as inicial");
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

    public function get_datatable()
    {

        $length = $this->input->post("length");
        $start = $this->input->post("start");
        $this->_get_datatable();
        if (isset($length) && $length != -1) {
            $this->db->limit($length, $start);
        }
        return $this->db->get()->result();
    }

    public function records_filtered()
    {

        $this->_get_datatable();
        return $this->db->get()->num_rows();
    }

    public function records_total()
    {

        $this->db->from("despesas");
        return $this->db->count_all_results();
    }
}
