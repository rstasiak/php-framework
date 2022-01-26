<?php

use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(ROOT_DIR . '/config/definitions.php');

return $containerBuilder->build();