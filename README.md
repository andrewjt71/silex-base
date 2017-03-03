# README #

### Summary ###

Base skeleton for a Silex Application

### Packagist ###
https://packagist.org/packages/andrewjt71/silex-base

### Usage ###

```
composer require andrewjt71/silex-base
```
In app/config/config.yml
```
monolog:
    logfile: /app/logs/log
twig:
    path:
        - /src/YourProject/views
```

Create app/logs dir

In src/YourProject/controller
```
<?php

namespace YourProject\Controller;

class FrontController
{
    private $twig;

    function __construct ($twig)
    {
        $this->twig = $twig;
    }

    public function indexAction()
    {
        return $this->twig->render(
            'welcome.html.twig',
            []
        );
    }
}
```

In src/YourProject/views/base.html.twig
```
<!DOCTYPE html>
<html>
    <head>
        {% block head %}
            <link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
            <link href='https://fonts.googleapis.com/css?family=Fredoka+One' rel='stylesheet' type='text/css'>
            <title>{% block title %}{% endblock %} - My Webpage</title>
        {% endblock %}
    </head>
    <body>
        <div id="content">{% block content %}{% endblock %}</div>
    </body>
</html>
```

In src/YourProject/views/welcome.html.twig
```
{% extends "base.html.twig" %}

{% block content %}
    <div>Welcome</div>
{% endblock %}

```


In web/index.php
```
<?php

require_once __DIR__.'/../vendor/autoload.php';

use SilexBase\Application;
use YourProject\Controller\FrontController;

$app = new Application();

$app['controller.front_controller'] = $app->share(function() use ($app) {
    return new FrontController($app['twig']);
});

$app->get('/', "controller.front_controller:indexAction");

$app->run();

```

