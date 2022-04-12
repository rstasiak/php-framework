<?php


namespace PHPFramework;


use function DI\string;

class Input
{

    public function __construct(private ?array $post = null, private ?array $get = null)
    {
        $this->post = $post ?? $_POST;
        $this->get = $get ?? $_GET;
    }

    public function post(string $name = '')
    {
        return $this->fetch('post', $name);
    }

    public function get(string $name = '')
    {
        return $this->fetch('get', $name);
    }

    private function fetch(string $type, string $name)
    {

        $data = match ($type) {
            'post' => $this->post,
            default => $this->get
        };

        if ($name == '') {
            return $data;
        }

        if (( ! isset($data[$name]) || (!is_array($data[$name]) && trim($data[$name]) === ''))) {

            return null;

        }


        return $data[$name];


    }

}