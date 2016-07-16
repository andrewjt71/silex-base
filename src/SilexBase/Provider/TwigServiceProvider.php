<?php

namespace SilexBase\Provider;

use Silex\Application;
use Silex\Provider\TwigServiceProvider as TwigProvider;
use Pimple\ServiceProviderInterface;
use Pimple\Container;

class TwigServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(Container $container)
    {
        $options = array();

        $twigPaths = [];
        foreach ($container['config']['twig']['path'] as $path) {
            $twigPaths[] = $container->getRootDir() . $path;
        }

        $container->register(
            new TwigProvider(),
            array(
                'twig.path' => $twigPaths
            )
        );
    }
}
