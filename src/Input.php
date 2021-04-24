<?php


namespace PHPFramework;


class Input
{
    public function post(?string $name = null) {

        if (!is_null($name) && isset($_POST[$name])) {

            return $_POST[$name];

        }

        return $_POST;

    }

    public function get(?string $name = null) {

        if (!is_null($name) && isset($_GET[$name])) {

            return $_GET[$name];

        }

        return $_GET;

    }

}