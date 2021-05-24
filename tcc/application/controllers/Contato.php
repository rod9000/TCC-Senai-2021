<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller {

	public function index()
	{
		$data = array(
			"scripts" => array(
				"styles.css",
				"dataTables.bootstrap.min.css",
				"datatables.min.css",
			),
			"scripts" => array(
				"owl.carousel.min.js",
				"theme-scripts.js" 
			)
		);
		$this->template->show("contato.php", $data);
	}

}

		