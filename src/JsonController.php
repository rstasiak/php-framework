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

        switch($res['code']) {

            case 200:
                header("HTTP/1.1 200 OK");
                break;
            case 404:
                header("HTTP/1.1 404 Not Found");
                break;
            case 400:
                header( 'HTTP/1.1 400 Bad Request' );
                break;

        }

        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH');
        header("Access-Control-Allow-Headers: X-Requested-With");
        echo $res['payload'];

    }


}