<?php

namespace PHPFramework\Tests\Mockups;

use PHPFramework\Controller;

class FooController extends Controller
{
    public function index() {


        return $this->twig->render('index.twig');

    }

}