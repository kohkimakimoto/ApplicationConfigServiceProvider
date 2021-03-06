# ApplicationConfigServiceProvider

[![Build Status](https://travis-ci.org/kohkimakimoto/ApplicationConfigServiceProvider.png?branch=master)](https://travis-ci.org/kohkimakimoto/ApplicationConfigServiceProvider)

This is a [Silex](http://silex.sensiolabs.org/) [ServiceProvider](http://silex.sensiolabs.org/doc/providers.html) to use yaml configuration files.

## Synopsis

``` yaml
# config.yml
param: AAA
param2: BBB
param3:
    param3-1: aaa
    param3-2: aaa
```

``` php
// something.php
use Silex\Application;
use Kohkimakimoto\Silex\Provider\ApplicationConfigServiceProvider;

$app = new Application();
$app->register(new ApplicationConfigServiceProvider(), array(
      'config.path' => __DIR__.'config.yml'
));

$app['config']->get('param');    # AAA
$app['config']->get('param4');   # null
$app['config']->get('param4', "default");   # default

$app['config']->get('param3');   # array('param3-1' => 'aaa', 'param3-2' => 'aaa')

$app['config']->get('param3/param3-1', null, '/');   # aaa
```
