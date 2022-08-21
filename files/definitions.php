<?php


use Monolog\Logger;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\ErrorLogHandler;

return [


	Environment::class => function () {

		$loader = new FilesystemLoader(ROOT_DIR . '/templates');
        return new Environment($loader, [

            'cache' => false,

        ]);

	},

    Logger::class => function() {

        $logger = new Logger('app');

        $logger->pushHandler(new StreamHandler(ROOT_DIR."/logs/info.log", Logger::INFO, true));
        $logger->pushHandler(new StreamHandler(ROOT_DIR."/logs/debug.log", Logger::DEBUG, true));
        $logger->pushHandler(new StreamHandler(ROOT_DIR."/logs/critical.log", Logger::CRITICAL, true));
        $logger->pushHandler(new ErrorLogHandler(0, Logger::INFO, true));

        return $logger;

    },


];