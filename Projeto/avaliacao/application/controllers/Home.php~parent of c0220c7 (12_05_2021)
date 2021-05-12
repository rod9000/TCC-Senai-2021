<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->model("clientes_model");
		$courses = $this->clientes_model->show_clientes();

		$this->load->model("produtos_model");
		$team = $this->produtos_model->show_produtos();

		$data = array(
			"scripts" => array(
				"owl.carousel.min.js",
				"theme-scripts.js" 
			)
		);
		$this->template->show("home.php", $data);
	}

}

		