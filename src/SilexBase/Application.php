<?php

namespace SilexBase;

use SilexBase\Provider\ControllerServiceProvider;
use SilexBase\Provider\TwigServiceProvider;
use SilexBase\Provider\LoggingServiceProvider;
use SilexBase\Provider\ConfigServiceProvider;
use Symfony\Component\Routing\Loader;
use Silex\Application as SilexApplication;
use Symfony\Component\Yaml\Parser;

class Application extends SilexApplication
{
    /**
     * @param array $values
     */
    public function __construct(array $values = array())
    {
        parent::__construct($values);
        $parser = new Parser();
        $this->register(new ConfigServiceProvider($parser));
        $this->register(new LoggingServiceProvider());
        $this->register(new ControllerServiceProvider());
        $this->register(new TwigServiceProvider());
    }

    /**
     * @return string
     */
    public function getConfigDir()
    {
        return $this->getRootDir() . '/app/config';
    }

    /**
     * @return string
     */
    public function getRootDir()
    {
        return realpath(__DIR__ . '/../../../../..');
    }
}
