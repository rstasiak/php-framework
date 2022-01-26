<?php

namespace PHPFramework;

class JSonResponse
{

    public function success($message): array
    {

        return [
            'payload' => json_encode($message),
            'code'    => 200,
        ];


    }

}