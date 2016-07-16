<?php

namespace SilexBase\Provider;

use Silex\Application;
use Silex\Provider\MonologServiceProvider;
use Pimple\ServiceProviderInterface;
use Pimple\Container;

class LoggingServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Container $container)
    {
        $params = array();

        foreach ($container['config']['monolog'] as $key => $value) {
            $params['monolog.' . $key] = $value;
        }

        $dir = dirname($container['config']['monolog']['logfile']);

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $container->register(new MonologServiceProvider(), $params);
    }
}
