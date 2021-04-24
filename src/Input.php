<?php


namespace PHPFramework;


class Input
{

    public function post(string $name = '')
    {
        return $this->fetch('post', $name);
    }

    public function get(string $name = '')
    {
        return $this->fetch('get', $name);
    }

    private function load(string $type): array
    {

        switch ($type) {

            case 'get':
                return $_GET;

            case 'post':
                return $_POST;
        }

        return [];


    }

    private function fetch(string $type, string $name)
    {
        $data = $this->load($type);

        if ($name == '')
        {
            return $data;
        }

        return $data[$name] ?? '';

    }

}