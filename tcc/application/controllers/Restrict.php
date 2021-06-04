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
			$this->load->model("users_model");
			$user_id = $this->session->userdata("user_id");
			$user_tipo = (int)$this->users_model->get_users($user_id)->user_tipo;
			
			$data = array(
				"styles" => array(
					"style.css",
					"bootstrap.css",
				),
				"scripts" => array(
					"sweetalert2.all.min.js",
					"util.js",	
					"restrict.js",
				),
				"user_id" => $this->session->userdata("user_id"),

			);
			$dados["user_tipo"] = $user_tipo;
			$this->load->vars($dados);
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

		$this->load->model("despesas_model");
		$despesas = $this->despesas_model->get_datatable();

		$data = array();
		foreach ($despesas as $despesa) {
			$funcionario = $this->despesas_model->get_funcionario($despesa->dp_funcionario);
			$viagem = $this->despesas_model->get_viagem($despesa->dp_viagem);

			$row = array();
			$row[] = $despesa->id_despesas;
			$row[] = $despesa->dp_servico;
			$row[] = $despesa->dp_valor;
			$row[] = $despesa->dp_local;
			$row[] = $despesa->dp_data;
			$row[] = $viagem->vg_destino;
			$row[] = $funcionario->user_full_name;
			$row[] = $despesa->dp_formDePgm;

			$row[] = '<div style="display: inline-block;">
						<a href="'.base_url("{$this->router->class}/editarDespesas/{$despesa->id_despesas}/") . '" class="btn btn-primary btn-edit-dps">
							<i class="fa fa-edit"></i>
						</a>
						<a class="btn btn-danger btn-del-dps" 
						id_despesas ="' . $despesa->id_despesas . '">
							<i class="fa fa-times"></i>
						</a>
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
	/* public function ajax_get_despesas_data() // Função  para obter dados para modificar os clientes
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();

		$this->load->model("despesas_model");

		$id_despesas = $this->input->post("id_despesas");
		$data = $this->despesas_model->get_data($id_despesas)->result_array()[0];
		$json["input"]["id_despesas"] = $data["id_despesas"];
		$json["input"]["dp_servico"] = $data["dp_servico"];
		$json["input"]["dp_valor"] = $data["dp_valor"];
		$json["input"]["dp_local"] = $data["dp_local"];
		$json["input"]["dp_data"] = $data["dp_data"];
		$json["input"]["dp_viagem"] = $data["dp_viagem"];
		$json["input"]["dp_funcionario"] = $data["dp_funcionario"];
		$json["input"]["dp_formDePgm"] = $data["dp_formDePgm"];

		echo json_encode($json);
	} */
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
		} 

		if (empty($data["dp_funcionario"])) {
			$json["error_list"]["#dp_funcionario"] = "CPF é obrigatório!";
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

		if (empty($data["dp_formDePgm"])) {
			$json["error_list"]["#dp_formDePgm"] = "Data de nascimento é obrigatório!";
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
	public function editarDespesas($id)
	{
		$data = array(
			"styles" => array(
				"bootstrap.css",
				"style.css"

			),
			"scripts" => array(
				"sweetalert2.all.min.js",
				"util.js",	
				"restrict.js",
			)
		);
		$this->load->model("despesas_model");
		$editar = $this->despesas_model->get_data($id);
		$viagens = $this->despesas_model->get_viagens();
		$fucionario = $this->despesas_model->get_funcionarios();

		$dados["viagens"] = $viagens;
		$dados["funcionario"] = $fucionario;
		$dados["editar"] = $editar;

		if ($this->session->userdata("user_id")):
		$this->load->vars($dados);
		$this->template->show("cadastro_despesas.php", $data);
		else:
			$data = array(
				"scripts" => array(
					"util.js",
					"login.js"
				)
			);
			$this->template->show("login.php", $data);
		endif;
	}
	public function cadastroDespesas()
	{
		$data = array(
			"styles" => array(
				"bootstrap.css",
				"style.css"
			),
			"scripts" => array(
				"sweetalert2.all.min.js",
				"util.js",	
				"restrict.js",
			)
		);
		$this->load->model("despesas_model");
		$viagens = $this->despesas_model->get_viagens();
		$fucionario = $this->despesas_model->get_funcionarios();

		$dados["viagens"] = $viagens;
		$dados["funcionario"] = $fucionario;


		if ($this->session->userdata("user_id")):
			$this->load->vars($dados);
			$this->template->show("cadastro_despesas.php", $data);
			else:
				$data = array(
					"scripts" => array(
						"util.js",
						"login.js"
					)
				);
				$this->template->show("login.php", $data);
			endif;
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
			$ralizada = $this->viagens_model->get_realizada($viagens->vg_realizada);
			$servico = $this->viagens_model->get_servico($viagens->vg_servico);
			$funcionario = $this->viagens_model->get_funcionario($viagens->vg_funcionario);
			$row = array();
			$row[] = $viagens->id_viagens;
			$row[] = $viagens->vg_destino;
			$row[] = $viagens->vg_dsaida;
			$row[] = $viagens->vg_dretorno;
			$row[] = $servico->sv_nome;
			$row[] = $funcionario->user_full_name;
			$row[] = $viagens->vg_valorIn;
			$row[] = $ralizada;
			$row[] = $viagens->vg_motivo;


			$row[] = '<div style="display: inline-block;">
						<a href="'.base_url("{$this->router->class}/editarViagens/{$viagens->id_viagens}/") . '" class="btn btn-primary btn-edit-dps">
						<i class="fa fa-edit"></i>
						</a>
						<button class="btn btn-danger btn-del-viag" 
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
	/* public function ajax_get_viagens_data() // Função  para obter dados para modificar os viagens
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
		$json["input"]["vg_destino"] = $data["vg_destino"];
		$json["input"]["vg_dsaida"] = $data["vg_dsaida"];
		$json["input"]["vg_dretorno"] = $data["vg_dretorno"];
		$json["input"]["vg_servico"] = $data["vg_servico"];
		$json["input"]["vg_funcionario"] = $data["vg_funcionario"];
		$json["input"]["vg_valorIn"] = $data["vg_valorIn"];
		$json["input"]["vg_realizada"] = $data["vg_realizada"];
		$json["input"]["vg_motivo"] = $data["vg_motivo"];

		echo json_encode($json);
	} */
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

		if (empty($data["vg_destino"])) {
			$json["error_list"]["#vg_destino"] = "Destino é obrigatório!";
		}

		if (empty($data["vg_dsaida"])) {
			$json["error_list"]["#vg_dsaida"] = "Data de saida é obrigatório!";
		} 

		if (empty($data["vg_dretorno"])) {
			$json["error_list"]["#vg_dretorno"] = "Data de retorno é obrigatório!";
		} 

		if (empty($data["vg_servico"])) {
			$json["error_list"]["#vg_servico"] = "Serviço é obrigatório!";
		}

		if (empty($data["vg_funcionario"])) {
			$json["error_list"]["#vg_funcionario"] = "Funcionário é obrigatório!";
		}

		if (empty($data["vg_valorIn"])) {
			$json["error_list"]["#vg_valorIn"] = "valor é obrigatório!";
		}
		if (empty($data["vg_realizada"])) {
			$json["error_list"]["#vg_realizada"] = "Realizada é obrigatório!";
		}
		if (empty($data["vg_motivo"])) {
			$json["error_list"]["#vg_motivo"] = "Motivo é obrigatório!";
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
	public function editarViagens($id)
	{
		$data = array(
			"styles" => array(
				"bootstrap.css",
				"style.css"

			),
			"scripts" => array(
				"sweetalert2.all.min.js",
				"util.js",	
				"restrict.js",
			)

		);
		$this->load->model("viagens_model");
		$editar = $this->viagens_model->get_data($id);
		$fucionario = $this->viagens_model->get_funcionarios();
		$servicos = $this->viagens_model->get_servicos();
		$dados["funcionario"] = $fucionario;
		$dados["servicos"] = $servicos;
		$dados["editar"] = $editar;

		$this->load->vars($dados);
		 if ($this->session->userdata("user_id")){
			$this->template->show("cadastro_viagens.php", $data);
	 	}
	 	else{
	 		$data = array(
	 			"scripts" => array(
	 				"util.js",
	 				"login.js"
	 			));

	 		$this->template->show("login.php", $data);
		}
	}
	public function cadastroViagens()
	{
		$data = array(
			"styles" => array(
				"bootstrap.css",
				"style.css"

			),
			"scripts" => array(
				"sweetalert2.all.min.js",
				"util.js",	
				"restrict.js",
			)
		);
		$this->load->model("viagens_model");
		$fucionario = $this->viagens_model->get_funcionarios();
		$servicos = $this->viagens_model->get_servicos();

		$dados["servicos"] = $servicos;
		$dados["funcionario"] = $fucionario;
		if ($this->session->userdata("user_id")):
			$this->load->vars($dados);
			$this->template->show("cadastro_viagens.php", $data);
			else:
				$data = array(
					"scripts" => array(
						"util.js",
						"login.js"
					)
				);
				$this->template->show("login.php", $data);
			endif;
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
			$user_tipo = $this->users_model->get_tipo($user->user_tipo);
			$row = array();
			$row[] = $user->user_id;
			$row[] = $user->user_login;
			$row[] = $user->user_full_name;
			$row[] = $user_tipo;
			$row[] = $user->user_email;

			$row[] = '<div style="display: inline-block;">
						<a href="'.base_url("{$this->router->class}/editarUsuario/{$user->user_id}/") . '" class="btn btn-primary btn-edit-dps">
						<i class="fa fa-edit"></i>
						</a>
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
			$json["error_list"]["#user_full_name"] = "Nome completo é obrigatório!";
		}
		if (empty($data["user_email"])) {
			$json["error_list"]["#user_email"] = "E-mail é obrigatório!";
		} else {
			if ($this->users_model->is_duplicated("user_email", $data["user_email"], $data["user_id"])) {
				$json["error_list"]["#user_email"] = "E-mail já existente!";
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
	public function cadastroUsuario()
	{
		$this->load->model("users_model");
		$user_id = $this->session->userdata("user_id");
		$user_tipo = (int)$this->users_model->get_users($user_id)->user_tipo;
		if($user_tipo == 1):
		$data = array(
			"styles" => array(
				"bootstrap.css",
				"style.css"

			),
			"scripts" => array(
				"sweetalert2.all.min.js",
				"bootstrap-select.js",
				"util.js",	
				"restrict.js",
			)
		);
		$tipo = $this->users_model->tipo();
		$dados["tipo"] = $tipo;
		if ($this->session->userdata("user_id")):
			$this->load->vars($dados);
			$this->template->show("cadastro_usuario.php", $data);
			else:
				$data = array(
					"scripts" => array(
						"util.js",
						"login.js"
					)
				);
				$this->template->show("login.php", $data);
			endif;
		else:
			$data = array(
				"scripts" => array(
					"util.js",
					"login.js"
				)
			);
			$this->template->show("home.php", $data);
		endif;
	}
	public function editarUsuario($id)
	{
		$this->load->model("users_model");
		$user_id = $this->session->userdata("user_id");
		$user_tipo = (int)$this->users_model->get_users($user_id)->user_tipo;
		if($user_tipo == 1):
		if ($this->session->userdata("user_id")):
		$data = array(
			"styles" => array(
				"bootstrap.css",
				"style.css"

			),
			"scripts" => array(
				"sweetalert2.all.min.js",
				"util.js",	
				"restrict.js",
			)
		);

		$editar = $this->users_model->get_data($id);
		$tipo = $this->users_model->tipo();
		$dados["tipo"] = $tipo;
		$dados["editar"] = $editar;
			
			$this->load->vars($dados);
			$this->template->show("cadastro_usuario.php", $data);
		else:
				$data = array(
					"scripts" => array(
						"util.js",
						"login.js"
					)
				);
				$this->template->show("login.php", $data);
			endif;
		elseif($user_tipo != 1  && $id == $user_id):
			$data = array(
				"styles" => array(
					"bootstrap.css",
					"style.css"
	
				),
				"scripts" => array(
					"sweetalert2.all.min.js",
					"util.js",	
					"restrict.js",
				)
			);
	
			$editar = $this->users_model->get_data($id);
			$tipo = $this->users_model->tipo();
			$dados["tipo"] = $tipo;
			$dados["editar"] = $editar;
				
				$this->load->vars($dados);
				$this->template->show("cadastro_usuario.php", $data);
		else:
			$data = array(
				"scripts" => array(
					"util.js",
					"login.js"
				)
			);
			$this->template->show("home.php", $data);
		endif;

	}

	public function ajax_list_relatorio() //Função  para Data table e botões Exclui e editar
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$this->load->model("relatorio_model");
		$relatorios = $this->relatorio_model->get_datatable();

		$data = array();
		foreach ($relatorios as $relatorio) {

			$row = array();
			$row[] = $relatorio->id_despesas;
			$row[] = $relatorio->dp_servico;
			$row[] = $relatorio->dp_valor;
			$row[] = $relatorio->dp_local;
			$row[] = $relatorio->dp_data;
			$row[] = $relatorio->dp_viagem;
			$row[] = $relatorio->dp_funcionario;
			$row[] = $relatorio->dp_formDePgm;

			$data[] = $row;
		}

		$json = array(
			"draw" => $this->input->post("draw"),
			"recordsTotal" => $this->relatorio_model->records_total(),
			"recordsFiltered" => $this->relatorio_model->records_filtered(),
			"data" => $data,
		);

		echo json_encode($json);
	}

	public function Contato()
	{
		$data = array(
			"scripts" => array(
				"styles.css",
				"dataTables.bootstrap.min.css",
				"datatables.min.css",
			),
			"scripts" => array(
				"owl.carousel.min.js",
				"theme-scripts.js",
				"restrict.js" 
			)
		);
		$this->template->show("contato.php", $data);
	}

	public function cadastroServicos()
	{
		$this->load->model("users_model");
		$user_id = $this->session->userdata("user_id");
		$user_tipo = (int)$this->users_model->get_users($user_id)->user_tipo;
		if($user_tipo == 1 || $user_tipo == 2):
		$data = array(
			"styles" => array(
				"bootstrap.css",
				"style.css",

			),
			"scripts" => array(
				"sweetalert2.all.min.js",
				"bootstrap-select.js",
				"util.js",	
				"restrict.js",
			)
		);
		if ($this->session->userdata("user_id")):
			$this->template->show("cadastro_servicos.php", $data);
		else:
				$data = array(
					"scripts" => array(
						"util.js",
						"login.js"
					)
				);
				$this->template->show("login.php", $data);
			endif;
		else:
			$data = array(
				"scripts" => array(
					"util.js",
					"login.js"
				)
			);
			$this->template->show("home.php", $data);
		endif;
	}
	public function ajax_list_servicos() //Função  para Data table e botões Exclui e editar
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$this->load->model("servicos_model");
		$servicos = $this->servicos_model->get_datatable();

		$data = array();
		foreach ($servicos as $servico) {

			$row = array();
			$row[] = $servico->id_servicos;
			$row[] = $servico->sv_nome;
			$row[] = $servico->sv_diaria;

			$row[] = '<div style="display: inline-block;">
						<a href="'.base_url("{$this->router->class}/editarServicos/{$servico->id_servicos}/") . '" class="btn btn-primary btn-edit-dps">
							<i class="fa fa-edit"></i>
						</a>
						<a class="btn btn-danger btn-del-dps" 
						id_despesas ="' . $servico->id_servicos . '">
							<i class="fa fa-times"></i>
						</a>
					</div>';

			$data[] = $row;
		}

		$json = array(
			"draw" => $this->input->post("draw"),
			"recordsTotal" => $this->servicos_model->records_total(),
			"recordsFiltered" => $this->servicos_model->records_filtered(),
			"data" => $data,
		);

		echo json_encode($json);
	}
	public function ajax_save_servicoS() //Função para salvar os viagens no banco de dados
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$this->load->model("servicos_model");

		$data = $this->input->post();

		if (empty($data["sv_nome"])) {
			$json["error_list"]["#sv_nome"] = "Nome do serviço é obrigatório!";
		}

		if (!empty($json["error_list"])) {
			$json["status"] = 0;
		} else {
			if (empty($data["id_servicos"])) {
				$this->servicos_model->insert($data);
			} else {
				$id_servicos = $data["id_servicos"];
				unset($data["id_servicos"]);
				$this->servicos_model->update($id_servicos, $data);
			}
		}

		echo json_encode($json);
	}
	public function ajax_delete_servicos_data() // Função  Para exclusão de viagens
	{

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;

		$this->load->model("servicos_model");
		$id_servicos = $this->input->post("id_servicos");
		$this->servicos_model->delete($id_servicos);

		echo json_encode($json);
	}
	public function editarServicos($id)
	{
		$this->load->model("users_model");
		$user_id = $this->session->userdata("user_id");
		$user_tipo = (int)$this->users_model->get_users($user_id)->user_tipo;
		if($user_tipo == 1 || $user_tipo == 2):
		$data = array(
			"styles" => array(
				"bootstrap.css",
				"style.css"

			),
			"scripts" => array(
				"sweetalert2.all.min.js",
				"util.js",	
				"restrict.js",
			)

		);
		$this->load->model("servicos_model");
		$editar = $this->servicos_model->get_data($id);
		
		$dados["editar"] = $editar;
		if ($this->session->userdata("user_id")):
			$this->load->vars($dados);
			$this->template->show("cadastro_servicos.php", $data);
			else:
				$data = array(
					"scripts" => array(
						"util.js",
						"login.js"
					)
				);
				$this->template->show("login.php", $data);
			endif;
		else:
			$data = array(
				"scripts" => array(
					"util.js",
					"login.js"
				)
			);
			$this->template->show("home.php", $data);
		endif;
	}

}