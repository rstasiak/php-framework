<?php


namespace PHPFramework;

use DI\Container;
use Twig\Environment;

class JsonController extends BaseController
{

    protected JSonResponse $response;

    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->input = new Input();
        $this->response = new JSonResponse();

    }

    protected function render($res) {

        header("HTTP/1.1 404 Not Found");
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH');
        header("Access-Control-Allow-Headers: X-Requested-With");
        echo $res['payload'];

    }


}