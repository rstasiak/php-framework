<?php


namespace PHPFramework;


class Config
{

    private array $config;

    public function __construct(string $path)
    {
        $this->config = require $path;
    }

    public function get(string $name)
    {
        if (isset($this->config[$name]))
        {
            return $this->config[$name];
        }
    }

}