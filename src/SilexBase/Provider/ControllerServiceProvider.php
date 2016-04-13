<?php

namespace SilexBase\Provider;

use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\ServiceProviderInterface;

class ControllerServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Application $app)
    {
        $app->register(new ServiceControllerServiceProvider());
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $app)
    {
    }
}
