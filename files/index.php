<?php

use DI\ContainerBuilder;

require '../bootstrap.php';

$container = require ROOT_DIR . '/container.php';

$dispatcher = FastRoute\simpleDispatcher(require_once ROOT_DIR . '/config/routes.php');

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?'))
{
	$uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0])
{
	case FastRoute\Dispatcher::NOT_FOUND:
		// ... 404 Not Found
		echo 'route not found';
		break;
	case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
		$allowedMethods = $routeInfo[1];
		// ... 405 Method Not Allowed
		echo 'method not allowed';

		break;
	case FastRoute\Dispatcher::FOUND:

		$handler = $routeInfo[1];
		$vars = $routeInfo[2];


		$class = key($handler);
		$controller = (new $class($container))($handler[$class], $vars);

		break;


}