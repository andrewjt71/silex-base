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
        
        // Config file.
        $configFile = $configFilesDir . "/config_$env.yml";
        $configFileContents = file_get_contents($configFile);
        
        // Parameter file.
        $parameterFile = $configFilesDir . "/parameters.yml";
        $parameterFileContents = file_get_contents($parameterFile);

        $config = $this->createConfigFromFiles($configFileContents, $parameterFileContents);
        $container['config'] = $config;
    }

    /**
     * @param string $configFileContents
     * @param string $parameterFileContents
     *
     * @return array
     */
    private function createConfigFromFiles($configFileContents, $parameterFileContents)
    {
        $parameters = $this->parser->parse($parameterFileContents);

        $regexPatterns = [];
        $substitutions = [];

        foreach ($parameters as $key => $value) {
            $regexPatterns[] = '/%' . $key . '%/';
            $substitutions[] = $value;
        }

        $configString = preg_replace($regexPatterns, $substitutions, $configFileContents);

        return $this->parser->parse($configString);
    }
}
