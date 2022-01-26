<?php

namespace PHPFramework;

class JSonResponse
{

    public function render($message, int $code): array
    {

        if (!in_array($code, [200, 400, 404])) {

            $code = 400;
        }

        return [

            'payload' => json_encode($message),
            'code'    => $code,
        ];


    }

}