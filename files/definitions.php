<?php


use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return [


	Environment::class => function () {

		$loader = new FilesystemLoader(ROOT_DIR . '/templates');
        return new Environment($loader, [

            'cache' => false,

        ]);

	},


];