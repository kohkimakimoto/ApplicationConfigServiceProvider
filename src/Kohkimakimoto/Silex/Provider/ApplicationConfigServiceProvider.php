<?php
namespace Kohkimakimoto\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Finder\Finder;

use Kohkimakimoto\Silex\Config\Config;

class ApplicationConfigServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app) {

      $app['config.path'] = array();

      $app['config'] = $app->share(function ($app){
        $config = new Config();

        if (is_string($app['config.path'])) {
          $app['config.path'] = array($app['config.path']);
        }

        foreach ($app['config.path'] as $configPath) {

          $files = array();
          if (is_dir($configPath)) {
            $finder = new Finder();
            $finder->files()->in($configPath);

            $files = $finder;

          } elseif (is_file($configPath)) {

            $files[] = $configPath;$configPath;

          } else {
            throw new \Exception("File or directory is not found at $configPath");
          }

          foreach ($files as $file) {
            $config->mergeFile($file);
          }
        }

        return $config;
      });

    }

    public function boot(Application $app) {

    }
}
