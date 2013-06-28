<?php
namespace Test\Kohkimakimoto\Silex\Provider;

use Kohkimakimoto\Silex\Provider\ApplicationConfigServiceProvider;
use Silex\Application;

class ApplicationConfigServiceProviderTest extends \PHPUnit_Framework_TestCase
{
  public function testDefault()
  {
    $app = new Application();

    $app->register(new ApplicationConfigServiceProvider(), array(
      'config.path' => __DIR__.'/files/test.yml'
    ));

    $this->assertEquals(array('a' => 'eee'), $app['config']->get('aaa'));
  }

  public function testEmpty()
  {
    $app = new Application();

    $app->register(new ApplicationConfigServiceProvider(), array(
        'config.path' => __DIR__.'/files/test_empty.yml'
    ));

    $this->assertEquals(null, $app['config']->get('aaa'));
  }

  public function testMultiFiles()
  {
    $app = new Application();

    $app->register(new ApplicationConfigServiceProvider(), array(
        'config.path' => array(__DIR__.'/files/test.yml', __DIR__.'/files/test2.yml', __DIR__.'/files/test3.yml')
    ));

    $this->assertEquals(array('a' => 'eee'), $app['config']->get('test3'));
  }

  public function testSetAndGet()
  {
    $app = new Application();

    $app->register(new ApplicationConfigServiceProvider(), array(
        'config.path' => array(__DIR__.'/files/test.yml')
    ));

    $app['config']->set('after', 10);

    $this->assertEquals(10, $app['config']->get('after'));
  }
}