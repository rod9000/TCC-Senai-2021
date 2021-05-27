<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro_despesas extends CI_Controller {

	public function __construct() //contruct da sessão
	{
		parent::__construct();
		$this->load->library("session");
	}
	
	public function index()
	{
		$data = array(
			"styles" => array(
				"bootstrap.css",
				"style.css"
			),
			"scripts" => array(
				"sweetalert2.all.min.js",
				"jquery-3.3.1.min.js",
				"bootstrap-select.js",
				"util.js",	
				"restrict.js",
			)
		);
		$this->template->show("cadDespesas.php", $data);
	}

}
