<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro_viagens extends CI_Controller {

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
				//"bootstrap-select.js",
				"util.js",	
				"restrict.js",
			)
		);
		$this->template->show("cadViagens.php", $data);
	}

}
