<?php


namespace PHPFramework;

use DI\Container;
use Monolog\Logger;
use Twig\Environment;

class Controller extends BaseController
{

    /**
     * @var mixed|\Monolog\Logger
     */
    protected mixed $log;

    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->twig = $container->get(Environment::class);
        $this->log = $container->get(Logger::class);
        $this->input = new Input();


    }

    public function redirect($destination)
    {

        header("Location: " . $_SERVER['BASE_URL'] . $destination);
        exit;

    }

}