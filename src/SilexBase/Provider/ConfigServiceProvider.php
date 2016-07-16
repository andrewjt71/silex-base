<?php

namespace SilexBase\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Yaml\Parser;

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
    public function register(Application $app)
    {
        $configFilesDir    = $app->getConfigDir();

        $env = getenv('APP_ENV') ?: 'dev';
        $genericConfigFile = $configFilesDir . "/config_$env.yml";

        $app['config'] = $this->parser->parse(file_get_contents($genericConfigFile));
    }

    /**
     * {@inheritDoc}
     */
    public function boot(Application $app)
    {
    }
}
