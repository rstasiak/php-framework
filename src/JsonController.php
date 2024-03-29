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

        $post = file_get_contents("php://input", "r");

        if (trim($post) <> '') {

            $json = json_decode($post, true);

            $error = json_last_error();

            if ($error > 0) {

                $this->render(['payload' => 'json parsing error: '.json_last_error_msg(), 'code' => 400]);
                exit;

            }

        } else {

            $json = [];
        }


        $this->input = new Input(
            $json,
            $_GET
        );

        $this->response = new JSonResponse();

    }

    public function getBearer(): string
    {

        if ( ! isset(getallheaders()['Authorization'])) {
            return '';
        }

        $auth = getallheaders()['Authorization'];

        if ( ! str_starts_with($auth, 'Bearer')) {
            return '';
        }

        return substr($auth, 7);


    }

    protected function render($res)
    {

        if ( ! isset($res['payload']) && ! isset($res['code'])) {
            throw new \Exception('not valid response');
        }

        switch ($res['code']) {

            case 200:
                header("HTTP/1.1 200 OK");
                break;
            case 404:
                header("HTTP/1.1 404 Not Found");
                break;
            case 400:
                header('HTTP/1.1 400 Bad Request');
                break;
            case 401:
                header('HTTP/1.1 401 Unauthorized');
                break;

        }

        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH');
        header("Access-Control-Allow-Headers: X-Requested-With");
        echo $res['payload'];

    }


}