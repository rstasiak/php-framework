<?php

namespace PHPFramework\Tests\Mockups;

use PHPFramework\JsonController;

class FooJSonController extends JsonController
{
    public function index() {

        return $this->response->success(['foo' => 'bar']);
    }

}