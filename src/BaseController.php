<?php


namespace PHPFramework;


use DI\Container;
use Twig\Environment;

class BaseController
{

	protected Environment $twig;
    protected Container $container;
    protected Input $input;

    public function __construct(Container $container)
    {
        $this->container = $container;

    }

    public function __invoke($name, $params)
    {

        $reflection = new \ReflectionClass($this);


        if ($reflection->hasMethod($name))
		{
			$method = $reflection->getMethod($name);
		} else {

        	die('there is no "' . $name . '" method in controller ' . get_class($this));
		}

        $values = [];

        foreach ($method->getParameters() as $parameter) {

            if ($parameter->getType()->isBuiltin()) {

                if ( ! isset($params[$parameter->getName()]) && !$parameter->isDefaultValueAvailable()) {

                    throw new \Exception('not set ' . $parameter->getName());
                }

                $values[] = $params[$parameter->getName()] ?? $parameter->getDefaultValue();

            } else {

                $values[] = $this->container->get($parameter->getClass()->name);
            }

        }

        $res = call_user_func_array([$this, $name], $values);



        $this->render($res);

    }

    protected function render($res) {

        echo $res;

    }




}