<?php


namespace PHPFramework;


use DI\Container;
use Twig\Environment;
use PHPFramework\Input;

class Controller
{

	protected Environment $twig;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->twig = $container->get(Environment::class);
        $this->input = new Input();


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

        echo $res;

    }

    public function redirect($destination)
    {

        header("Location: https://admin.artpower.pl" . $destination);
        exit;

    }

    public function redirectToReferer()
    {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;

    }


}