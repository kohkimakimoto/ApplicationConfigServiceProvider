<?php
namespace Test\Kohkimakimoto\Silex\Provider;

use Kohkimakimoto\Silex\Provider\ApplicationConfigServiceProvider;
use Silex\Application;

class ApplicationConfigServiceProviderTest extends \PHPUnit_Framework_TestCase
{
  public function testDefault()
  {
    $app = new Application();

    $app->register(new ApplicationConfigServiceProvider());

  }
}