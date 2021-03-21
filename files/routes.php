<?php

use App\Controller\HomeController;


return function (FastRoute\RouteCollector $r) {

	$r->addRoute(['GET'], '/', [HomeController::class => 'index']);

};