<?php

use DI\ContainerBuilder;
use PHPUnit\Framework\TestCase;
use PHPFramework\Tests\Mockups\FooController;
use PHPFramework\Tests\Mockups\FooJSonController;

class ControllerTest extends TestCase
{

    public function testController() {


        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions(ROOT_DIR . '/files/definitions.php');
        $container = $containerBuilder->build();

        $controller = new FooController($container);
        $this->assertEquals('bar', $controller->index());

    }

    public function test2Controller() {


        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions(ROOT_DIR . '/files/definitions.php');
        $container = $containerBuilder->build();

        $controller = new FooJSonController($container);

        $controller('index', []);

        //$this->assertEquals('bar', );

    }
}
