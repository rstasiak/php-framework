<?php


namespace PHPFramework;

use DI\Container;
use Twig\Environment;

class Controller extends BaseController
{

    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->twig = $container->get(Environment::class);
        $this->input = new Input();


    }

    public function redirect($destination)
    {

        header("Location: " . $_SERVER['BASE_URL'] . $destination);
        exit;

    }

}