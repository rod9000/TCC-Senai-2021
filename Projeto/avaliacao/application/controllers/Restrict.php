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
			$row[] = $despesa->dp_valor;
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
		$json["input"]["dp_valor"] = $data["dp_valor"];
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
			$json["error_list"]["#dp_servico"] = "Nome é obrigatório!";
		} else {
			if ($this->clientes_model->is_duplicated("cl_nome", $data["cl_nome"], $data["clientes_id"])) {
				$json["error_list"]["#dp_servico"] = "Nome já existente!";
			}
		}

		if (empty($data["dp_valor"])) {
			$json["error_list"]["#dp_valor"] = "CPF é obrigatório!";
		} else {
			if ($this->clientes_model->is_duplicated("cl_cpf", $data["cl_cpf"], $data["clientes_id"])) {
				$json["error_list"]["#dp_valor"] = "CPF já existente!";
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
	

	public function ajax_list_produtos() //Função  para Data table e botões Exclui e editar
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$this->load->model("produtos_model");
		$produtos = $this->produtos_model->get_datatable();

		$data = array();
		foreach ($produtos as $produto) {

			$row = array();
			$row[] = $produto->pd_nome;
			$row[] = $produto->pd_codigodebarras;
			$row[] = $produto->pd_descricao;
			$row[] = $produto->pd_valor;
			$row[] = $produto->pd_quantidade;
			$row[] = $produto->pd_datadecadastro;

			$row[] = '<div style="display: inline-block;">
						<button class="btn btn-primary btn-edit-prod" 
						produtos_id="' . $produto->produtos_id . '">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-danger btn-del-prod" 
						produtos_id="' . $produto->produtos_id . '">
							<i class="fa fa-times"></i>
						</button>
					</div>';

			$data[] = $row;
		}

		$json = array(
			"draw" => $this->input->post("draw"),
			"recordsTotal" => $this->produtos_model->records_total(),
			"recordsFiltered" => $this->produtos_model->records_filtered(),
			"data" => $data,
		);

		echo json_encode($json);
	}
	public function ajax_delete_produtos_data() // Função  Para exclusão de produtos
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;

		$this->load->model("produtos_model");
		$produtos_id = $this->input->post("produtos_id");
		$this->produtos_model->delete($produtos_id);

		echo json_encode($json);
	}
	public function ajax_get_produtos_data() // Função  para obter dados para modificar os produtos
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();

		$this->load->model("produtos_model");

		$produtos_id = $this->input->post("produtos_id");
		$data = $this->produtos_model->get_data($produtos_id)->result_array()[0];
		$json["input"]["produtos_id"] = $data["produtos_id"];
		$json["input"]["pd_nome"] = $data["pd_nome"];
		$json["input"]["pd_codigodebarras"] = $data["pd_codigodebarras"];
		$json["input"]["pd_descricao"] = $data["pd_descricao"];
		$json["input"]["pd_valor"] = $data["pd_valor"];
		$json["input"]["pd_quantidade"] = $data["pd_quantidade"];
		$json["input"]["pd_datadecadastro"] = $data["pd_datadecadastro"];

		echo json_encode($json);
	}
	public function ajax_save_produtos() //Função para salvar os produtos no banco de dados
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$this->load->model("produtos_model");

		$data = $this->input->post();

		if (empty($data["pd_nome"])) {
			$json["error_list"]["#pd_nome"] = "Nome é obrigatório!";
		} else {
			if ($this->produtos_model->is_duplicated("pd_nome", $data["pd_nome"], $data["produtos_id"])) {
				$json["error_list"]["#pd_nome"] = "Nome já existente!";
			}
		}

		if (empty($data["pd_codigodebarras"])) {
			$json["error_list"]["#pd_codigodebarras"] = "Codigo de barras é obrigatório!";
		} else {
			if ($this->produtos_model->is_duplicated("pd_codigodebarras", $data["pd_codigodebarras"], $data["produtos_id"])&& empty($data["produtos_id"])) {
				$json["error_list"]["#pd_codigodebarras"] = "Codigo de barras já existente!";
			}
		}

		if (empty($data["pd_descricao"])) {
			$json["error_list"]["#pd_descricao"] = "Descrição é obrigatório!";
		}

		if (empty($data["pd_valor"])) {
			$json["error_list"]["#pd_valor"] = "Valor é obrigatório!";
		}

		if (empty($data["pd_quantidade"])) {
			$json["error_list"]["#pd_quantidade"] = "Quantidade é obrigatório!";
		}

		if (empty($data["pd_datadecadastro"])) {
			$json["error_list"]["#pd_datadecadastro"] = "Data de cadastro é obrigatório!";
		}

		if (!empty($json["error_list"])) {
			$json["status"] = 0;
		} else {
			if (empty($data["produtos_id"])) {
				$this->produtos_model->insert($data);
			} else {
				$produtos_id = $data["produtos_id"];
				unset($data["produtos_id"]);
				$this->produtos_model->update($produtos_id, $data);
			}
		}

		echo json_encode($json);
	}

	public function ajax_list_pedidos() //Função  para Data table e botões Exclui e editar
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$this->load->model("pedidos_model");
		$pedidos = $this->pedidos_model->get_datatable();

		$data = array();
		foreach ($pedidos as $pedido) {

			$row = array();
			$row[] = $pedido->pdd_cliente;
			$row[] = $pedido->pdd_produtos;
			$row[] = $pedido->pdd_valor;
			$row[] = $pedido->pdd_quantitade;
			$row[] = $pedido->pdd_total;
			$row[] = $pedido->pdd_datadecadastro;

			$row[] = '<div style="display: inline-block;">
						<button class="btn btn-primary btn-edit-pdd" 
						pedidos_id="' . $pedido->pedidos_id . '">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-danger btn-del-pdd" 
						pedidos_id="' . $pedido->pedidos_id . '">
							<i class="fa fa-times"></i>
						</button>
					</div>';

			$data[] = $row;
		}

		$json = array(
			"draw" => $this->input->post("draw"),
			"recordsTotal" => $this->pedidos_model->records_total(),
			"recordsFiltered" => $this->pedidos_model->records_filtered(),
			"data" => $data,
		);

		echo json_encode($json);
	}
	public function ajax_delete_pedidos_data() // Função  Para exclusão de pedidos
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;

		$this->load->model("pedidos_model");
		$pedidos_id = $this->input->post("pedidos_id");
		$this->pedidos_model->delete($pedidos_id);

		echo json_encode($json);
	}
	public function ajax_get_pedidos_data() // Função  para obter dados para modificar os pedidos
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();

		$this->load->model("pedidos_model");

		$pedidos_id = $this->input->post("pedidos_id");
		$data = $this->pedidos_model->get_data($pedidos_id)->result_array()[0];
		$json["input"]["pedidos_id"] = $data["pedidos_id"];
		$json["input"]["pdd_cliente"] = $data["pdd_cliente"];
		$json["input"]["pdd_produtos"] = $data["pdd_produtos"];
		$json["input"]["pdd_valor"] = $data["pdd_valor"];
		$json["input"]["pdd_quantitade"] = $data["pdd_quantitade"];
		$json["input"]["pdd_datadecadastro"] = $data["pdd_datadecadastro"];

		echo json_encode($json);
	}
	public function ajax_save_pedidos() //Função para salvar os pedidos no banco de dados
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$this->load->model("pedidos_model");

		$data = $this->input->post();

		if (empty($data["pdd_cliente"])) {
			$json["error_list"]["#pdd_cliente"] = "Cliente é obrigatório!";
		} 

		if (empty($data["pdd_produtos"])) {
			$json["error_list"]["#pdd_produtos"] = "Selecione o produto!";
		}

		if (empty($data["pdd_valor"])) {
			$json["error_list"]["#pdd_valor"] = "Valor é obrigatório!";
		}

		if (empty($data["pdd_quantitade"])) {
			$json["error_list"]["#pdd_quantitade"] = "Quantidade é obrigatório!";
		}
		if (empty($data["pdd_total"])) {
			$json["error_list"]["#pdd_total"] = "Total é obrigatório!";
		}
		if (empty($data["pdd_datadecadastro"])) {
			$json["error_list"]["#pdd_datadecadastro"] = "Coloque a data de cadastro!";
		}

		if (!empty($json["error_list"])) {
			$json["status"] = 0;
		} else {
			if (empty($data["pedidos_id"])) {
				$this->pedidos_model->insert($data);
			} else {
				$pedidos_id = $data["pedidos_id"];
				unset($data["pedidos_id"]);
				$this->pedidos_model->update($pedidos_id, $data);
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
			$json["error_list"]["#user_full_name"] = "Nome Completo é obrigatório!";
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