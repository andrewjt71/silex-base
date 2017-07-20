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

        $logFile = $container->getRootDir() . '/' . $container['config']['monolog']['logfile'];

        $dir = dirname($logFile);

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $params['monolog.logfile'] = $logFile;

        $container->register(new MonologServiceProvider(), $params);
    }
}
