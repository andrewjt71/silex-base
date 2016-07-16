<?php

namespace SilexBase\Provider;

use Silex\Application;
use Symfony\Component\Yaml\Parser;
use Pimple\ServiceProviderInterface;
use Pimple\Container;

class ConfigServiceProvider implements ServiceProviderInterface
{
    /**
     * Parser $parser
     */
    private $parser;

    /**
     * Constructor
     *
     * @param Parser $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }
    /**
     * {@inheritDoc}
     */
    public function register(Container $container)
    {
        $configFilesDir    = $container->getConfigDir();
        $env = getenv('APP_ENV') ?: 'dev';
        $genericConfigFile = $configFilesDir . "/config_$env.yml";
        $container['config'] = $this->parser->parse(file_get_contents($genericConfigFile));
    }
}
