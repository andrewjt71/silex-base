<?php

namespace SilexBase\Provider;

use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;
use Pimple\ServiceProviderInterface;
use Pimple\Container;

class ControllerServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Container $container)
    {
        $container->register(new ServiceControllerServiceProvider());
    }
}
