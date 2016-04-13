<?php

namespace SilexBase\Provider;

use Silex\Application;
use Silex\Provider\MonologServiceProvider;
use Silex\ServiceProviderInterface;

class LoggingServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Application $app)
    {
        $params = array();

        foreach ($app['config']['monolog'] as $key => $value) {
            $params['monolog.' . $key] = $value;
        }

        $dir = dirname($app['config']['monolog']['logfile']);

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $app->register(new MonologServiceProvider(), $params);
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $app)
    {
    }
}
