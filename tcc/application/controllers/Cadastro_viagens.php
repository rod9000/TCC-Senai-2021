<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro_viagens extends CI_Controller {

	public function index()
	{
		$data = array(
			"scripts" => array(
				"owl.carousel.min.js",
				"theme-scripts.js" 
			)
		);
		$this->template->show("cadViagens.php", $data);
	}

}
