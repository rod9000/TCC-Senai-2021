<?php
// CONTROLER DA PAGINA RESTRICT
defined('BASEPATH') or exit('No direct script access allowed');

class Restrict extends CI_Controller
{

	public function __construct() //contruct da sessão
	{
		parent::__construct();
		$this->load->library("session");
	}

	public function index() //Importação de scripts e css
	{

		if ($this->session->userdata("user_id")) {
			$data = array(
				"styles" => array(
					"dataTables.bootstrap.min.css",
					"datatables.min.css",
					"select2.min.css"
				),
				"scripts" => array(
					"sweetalert2.all.min.js",
					"dataTables.bootstrap.min.js",
					"datatables.min.js",
					"util.js",	
					"restrict.js",
					"select2.min.js"
				),
				"user_id" => $this->session->userdata("user_id")
			);
			$this->template->show("restrict.php", $data);
		} else {
			$data = array(
				"scripts" => array(
					"util.js",
					"login.js"
				)
			);
			$this->template->show("login.php", $data);
		}
	}

	public function logoff() //Função de saida do site
	{
		$this->session->sess_destroy();
		header("Location: " . base_url() . "restrict");
	}

	public function ajax_login() // Função de entrada do site
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$username = $this->input->post("username");
		$password = $this->input->post("password");

		if (empty($username)) {
			$json["status"] = 0;
			$json["error_list"]["#username"] = "Usuário não pode ser vazio!";
		} else {
			$this->load->model("users_model");
			$result = $this->users_model->get_user_data($username);
			if ($result) {
				$user_id = $result->user_id;
				$password_hash = $result->password_hash;
				if (password_verify($password, $password_hash)) {
					$this->session->set_userdata("user_id", $user_id);
				} else {
					$json["status"] = 0;
				}
			} else {
				$json["status"] = 0;
			}
			if ($json["status"] == 0) {
				$json["error_list"]["#btn_login"] = "Usuário e/ou senha incorretos!";
			}
		}

		echo json_encode($json);
	}


	public function ajax_list_despesas() //Função  para Data table e botões Exclui e editar
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$this->load->model("Despesas_model");
		$despesas = $this->despesas_model->get_datatable();

		$data = array();
		foreach ($despesas as $despesa) {

			$row = array();
			$row[] = $despesa->dp_servico;
			$row[] = $despesa->dp_funcionario;
			$row[] = $despesa->dp_local;
			$row[] = $despesa->dp_data;
			$row[] = $despesa->dp_viagem;
			$row[] = $despesa->dp_form_pagamento;

			$row[] = '<div style="display: inline-block;">
						<button class="btn btn-primary btn-edit-clt" 
						id_despesas	="' . $despesa->id_despesas . '">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-danger btn-del-clt" 
						id_despesas ="' . $despesa->id_despesas . '">
							<i class="fa fa-times"></i>
						</button>
					</div>';

			$data[] = $row;
		}

		$json = array(
			"draw" => $this->input->post("draw"),
			"recordsTotal" => $this->despesas_model->records_total(),
			"recordsFiltered" => $this->despesas_model->records_filtered(),
			"data" => $data,
		);

		echo json_encode($json);
	}
	public function ajax_delete_despesas_data() // Função  Para exclusão de clientes
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;

		$this->load->model("despesas_model");
		$id_despesas = $this->input->post("id_despesas");
		$this->despesas_model->delete($id_despesas);

		echo json_encode($json);
	}
	public function ajax_get_despesas_data() // Função  para obter dados para modificar os clientes
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();

		$this->load->model("despesas_model");

		$clientes_id = $this->input->post("id_despesas");
		$data = $this->clientes_model->get_data($clientes_id)->result_array()[0];
		$json["input"]["id_despesas"] = $data["id_despesas	"];
		$json["input"]["dp_servico"] = $data["dp_servico"];
		$json["input"]["dp_funcionario"] = $data["dp_funcionario"];
		$json["input"]["dp_local"] = $data["dp_local"];
		$json["input"]["dp_data"] = $data["dp_data"];
		$json["input"]["dp_viagem"] = $data["dp_viagem"];
		$json["input"]["dp_form_pagamento"] = $data["dp_form_pagamento"];

		echo json_encode($json);
	}
	public function ajax_save_despesas() //Função para salvar os clientes no banco de dados
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$this->load->model("despesas_model");

		$data = $this->input->post();

		if (empty($data["dp_servico"])) {
			$json["error_list"]["#dp_servico"] = "local é obrigatório!";
		} else {
			if ($this->clientes_model->is_duplicated("cl_local", $data["cl_local"], $data["clientes_id"])) {
				$json["error_list"]["#dp_servico"] = "local já existente!";
			}
		}

		if (empty($data["dp_funcionario"])) {
			$json["error_list"]["#dp_funcionario"] = "CPF é obrigatório!";
		} else {
			if ($this->clientes_model->is_duplicated("cl_cpf", $data["cl_cpf"], $data["clientes_id"])) {
				$json["error_list"]["#dp_funcionario"] = "CPF já existente!";
			}
		}

		if (empty($data["dp_local"])) {
			$json["error_list"]["#dp_local"] = "Endereço é obrigatório!";
		}

		if (empty($data["dp_data"])) {
			$json["error_list"]["#dp_data"] = "E-mail é obrigatório!";
		} 

		if (empty($data["dp_viagem"])) {
			$json["error_list"]["#dp_viagem"] = "Data de nascimento é obrigatório!";
		}

		if (empty($data["dp_form_pagamento	"])) {
			$json["error_list"]["#dp_form_pagamento	"] = "Data de nascimento é obrigatório!";
		}

		if (!empty($json["error_list"])) {
			$json["status"] = 0;
		} else {
			if (empty($data["id_despesas"])) {
				$this->despesas_model->insert($data);
			} else {
				$id_despesas = $data["id_despesas"];
				unset($data["id_depesas"]);
				$this->despesas_model->update($id_despesas, $data);
			}
		}

		echo json_encode($json);
	}

	public function ajax_list_viagens() //Função  para Data table e botões Exclui e editar
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$this->load->model("viagens_model");
		$viagens = $this->viagens_model->get_datatable();

		$data = array();
		foreach ($viagens as $viagens) {

			$row = array();
			$row[] = $viagens->pd_local;
			$row[] = $viagens->pd_data;
			$row[] = $viagens->pd_servico;
			$row[] = $viagens->pd_funcionario;
			$row[] = $viagens->pd_valor;

			$row[] = '<div style="display: inline-block;">
						<button class="btn btn-primary btn-edit-prod" 
						id_viagens="' . $viagens->id_viagens . '">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-danger btn-del-prod" 
						id_viagens="' . $viagens->id_viagens . '">
							<i class="fa fa-times"></i>
						</button>
					</div>';

			$data[] = $row;
		}

		$json = array(
			"draw" => $this->input->post("draw"),
			"recordsTotal" => $this->viagens_model->records_total(),
			"recordsFiltered" => $this->viagens_model->records_filtered(),
			"data" => $data,
		);

		echo json_encode($json);
	}
	public function ajax_delete_viagens_data() // Função  Para exclusão de viagens
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;

		$this->load->model("viagens_model");
		$id_viagens = $this->input->post("id_viagens");
		$this->viagens_model->delete($id_viagens);

		echo json_encode($json);
	}
	public function ajax_get_viagens_data() // Função  para obter dados para modificar os viagens
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();

		$this->load->model("viagens_model");

		$id_viagens = $this->input->post("id_viagens");
		$data = $this->viagens_model->get_data($id_viagens)->result_array()[0];
		$json["input"]["id_viagens"] = $data["id_viagens"];
		$json["input"]["pd_local"] = $data["pd_local"];
		$json["input"]["pd_data"] = $data["pd_data"];
		$json["input"]["pd_servico"] = $data["pd_servico"];
		$json["input"]["pd_funcionario"] = $data["pd_funcionario"];
		$json["input"]["pd_valor"] = $data["pd_valor"];

		echo json_encode($json);
	}
	public function ajax_save_viagens() //Função para salvar os viagens no banco de dados
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$this->load->model("viagens_model");

		$data = $this->input->post();

		if (empty($data["pd_local"])) {
			$json["error_list"]["#pd_local"] = "local é obrigatório!";
		} else {
			if ($this->viagens_model->is_duplicated("pd_local", $data["pd_local"], $data["id_viagens"])) {
				$json["error_list"]["#pd_local"] = "local já existente!";
			}
		}

		if (empty($data["pd_data"])) {
			$json["error_list"]["#pd_data"] = "Data é obrigatório!";
		} else {
			if ($this->viagens_model->is_duplicated("pd_data", $data["pd_data"], $data["id_viagens"])&& empty($data["id_viagens"])) {
				$json["error_list"]["#pd_data"] = "Data já existente!";
			}
		}

		if (empty($data["pd_servico"])) {
			$json["error_list"]["#pd_servico"] = "Serviço é obrigatório!";
		}

		if (empty($data["pd_funcionario"])) {
			$json["error_list"]["#pd_funcionario"] = "Funcionário é obrigatório!";
		}

		if (empty($data["pd_valor"])) {
			$json["error_list"]["#pd_valor"] = "valor é obrigatório!";
		}

		if (!empty($json["error_list"])) {
			$json["status"] = 0;
		} else {
			if (empty($data["id_viagens"])) {
				$this->viagens_model->insert($data);
			} else {
				$id_viagens = $data["id_viagens"];
				unset($data["id_viagens"]);
				$this->viagens_model->update($id_viagens, $data);
			}
		}

		echo json_encode($json);
	}

	public function ajax_list_user() //Função  para Data table e botões Exclui e editar
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$this->load->model("users_model");
		$users = $this->users_model->get_datatable();

		$data = array();
		foreach ($users as $user) {

			$row = array();
			$row[] = $user->user_login;
			$row[] = $user->user_full_name;
			$row[] = $user->user_email;

			$row[] = '<div style="display: inline-block;">
						<button class="btn btn-primary btn-edit-user" 
							user_id="' . $user->user_id . '">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-danger btn-del-user" 
							user_id="' . $user->user_id . '">
							<i class="fa fa-times"></i>
						</button>
					</div>';

			$data[] = $row;
		}

		$json = array(
			"draw" => $this->input->post("draw"),
			"recordsTotal" => $this->users_model->records_total(),
			"recordsFiltered" => $this->users_model->records_filtered(),
			"data" => $data,
		);

		echo json_encode($json);
	}
	public function ajax_delete_user_data() // Função  Para exclusão de usuários
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;

		$this->load->model("users_model");
		$user_id = $this->input->post("user_id");
		$this->users_model->delete($user_id);

		echo json_encode($json);
	}
	public function ajax_get_user_data() // Função  para obter dados para modificar os usuários
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();

		$this->load->model("users_model");

		$user_id = $this->input->post("user_id");
		$data = $this->users_model->get_data($user_id)->result_array()[0];
		$json["input"]["user_id"] = $data["user_id"];
		$json["input"]["user_login"] = $data["user_login"];
		$json["input"]["user_full_name"] = $data["user_full_name"];
		$json["input"]["user_email"] = $data["user_email"];
		$json["input"]["user_email_confirm"] = $data["user_email"];
		$json["input"]["user_password"] = $data["password_hash"];
		$json["input"]["user_password_confirm"] = $data["password_hash"];

		echo json_encode($json);
	}
	public function ajax_save_user() //Função para salvar os usuários no banco de dados
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$this->load->model("users_model");

		$data = $this->input->post();

		if (empty($data["user_login"])) {
			$json["error_list"]["#user_login"] = "Login é obrigatório!";
		} else {
			if ($this->users_model->is_duplicated("user_login", $data["user_login"], $data["user_id"])) {
				$json["error_list"]["#user_login"] = "Login já existente!";
			}
		}

		if (empty($data["user_full_name"])) {
			$json["error_list"]["#user_full_name"] = "local Completo é obrigatório!";
		}

		if (empty($data["user_email"])) {
			$json["error_list"]["#user_email"] = "E-mail é obrigatório!";
		} else {
			if ($this->users_model->is_duplicated("user_email", $data["user_email"], $data["user_id"])) {
				$json["error_list"]["#user_email"] = "E-mail já existente!";
			} else {
				if ($data["user_email"] != $data["user_email_confirm"]) {
					$json["error_list"]["#user_email"] = "";
					$json["error_list"]["#user_email_confirm"] = "E-mails não conferem!";
				}
			}
		}

		if (empty($data["user_password"])) {
			$json["error_list"]["#user_password"] = "Senha é obrigatório!";
		} else {
			if ($data["user_password"] != $data["user_password_confirm"]) {
				$json["error_list"]["#user_password"] = "";
				$json["error_list"]["#user_password_confirm"] = "Senha não conferem!";
			}
		}

		if (!empty($json["error_list"])) {
			$json["status"] = 0;
		} else {

			$data["password_hash"] = password_hash($data["user_password"], PASSWORD_DEFAULT);

			unset($data["user_password"]);
			unset($data["user_password_confirm"]);
			unset($data["user_email_confirm"]);

			if (empty($data["user_id"])) {
				$this->users_model->insert($data);
			} else {
				$user_id = $data["user_id"];
				unset($data["user_id"]);
				$this->users_model->update($user_id, $data);
			}
		}

		echo json_encode($json);
	}


}