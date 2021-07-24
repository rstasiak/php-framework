<?php


namespace PHPFramework;


use function DI\string;

class Input
{

    public function post(string $name = '', bool $clean = true)
    {


        return $this->fetch('post', $name, $clean);
    }

    public function get(string $name = '', bool $clean = true)
    {
        return $this->fetch('get', $name, $clean);
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

    private function fetch(string $type, string $name, bool $clean = true)
    {
        $data = $this->load($type);

        if ($clean)
        {
            $data = $this->clean($data);
        }

        if ($name == '')
        {
            return $data;
        }

        return $data[$name] ?? null;

    }

    private function clean(array $data): array
    {
        $cleaned = [];

        foreach($data as $key => $value)
        {
            $cv = $this->cleanValue($value);
            $cleaned[$key] = $cv;
        }

        return $cleaned;
    }

    private function cleanValue(string $value): string
    {
        $cleaned = strip_tags($value);
        return $cleaned;
    }

}