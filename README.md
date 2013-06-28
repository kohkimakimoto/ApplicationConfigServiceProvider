# ApplicationConfigServiceProvider

[![Build Status](https://travis-ci.org/kohkimakimoto/ApplicationConfigServiceProvider.png?branch=master)](https://travis-ci.org/kohkimakimoto/ApplicationConfigServiceProvider)

This is a Silex ServiceProvider to use yaml configuration files.

## Usage

  * Basic

        // config.yml
        param:  AAA
        param2: BBB

        // something.php
        use Silex\Application;
        use Kohkimakimoto\Silex\Provider\ApplicationConfigServiceProvider;

        $app = new Application();
        $app->register(new ApplicationConfigServiceProvider(), array(
              'config.path' => __DIR__.'config.yml'
        ));

        $app['config']->get('param');   # AAA

