<?php

namespace SilexBase\Provider;

use Silex\Application;
use Silex\Provider\TwigServiceProvider as TwigProvider;
use Silex\ServiceProviderInterface;

class TwigServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Application $app)
    {
        $options = array();

        $twigPaths = [];
        foreach ($app['config']['twig']['path'] as $path) {
            $twigPaths[] = $app->getRootDir() . $path;
        }

        $app->register(
            new TwigProvider(),
            array(
                'twig.path' => $twigPaths
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $app)
    {
    }
}
