<?php


namespace App\Controller;

use PHPFramework\Controller;

class HomeController extends Controller {


	public function index() {


		return $this->twig->render('index.twig');
	}

}