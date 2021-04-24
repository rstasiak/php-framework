<?php


namespace PHPFramework;


class Input
{

    public function post(?string $name = null)
    {
        return $this->fetch('post', $name);
    }

    public function get(?string $name = null)
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

        if ( ! is_null($name) && isset($data[$name])) {

            return $data[$name];

        }

        if ( ! is_null($name)) {

            return '';
        }

        return $data;
    }

}