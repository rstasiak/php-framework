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

    public function post(string $name = '', bool $clean = true, string $type = 'string')
    {
        return $this->fetch('post', $name, $clean, $type);
    }

    public function get(string $name = '', bool $clean = true, string $type = 'string')
    {
        return $this->fetch('get', $name, $clean, $type);
    }

    private function load(string $type): array
    {

        return match ($type) {
            'get' => $this->get,
            'post' => $this->post,
            default => [],
        };


    }

    private function fetch(string $type, string $name, bool $clean = true, string $valueType = 'string')
    {
        $data = $this->load($type);


        if ($clean) {
            $data = $this->clean($data);
        }

        if ($name == '') {
            return $data;
        }

        // jeśli podamy nazwę pola

        $rawValue = $data[$name] ?? null;

        $value = match ($valueType) {
            default => (string) $rawValue,
            'bool' => (bool) $rawValue,
            'int' => (int) $rawValue,
        };

        return $value ?? null;

    }

    private function clean(array $data): array
    {
        $cleaned = [];

        foreach ($data as $key => $value) {
            $cv = $this->cleanValue($value);
            $cleaned[$key] = $cv;
        }

        return $cleaned;
    }

    private function cleanValue(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
    }

}