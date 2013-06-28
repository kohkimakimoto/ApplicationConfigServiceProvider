<?php
namespace Test\Kohkimakimoto\Silex\Config;

use Kohkimakimoto\Silex\Config\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
  public function testDefault()
  {
    $config = new Config();
    $config->set('a', "eeeeeeeeeee");
    $this->assertEquals("eeeeeeeeeee", $config->get('a'));

    $config->set('arr', array('b' => array('c' => 'cccccccc')));
    $this->assertEquals(array('b' => array('c' => 'cccccccc')), $config->get('arr'));
    $this->assertEquals(array('c' => 'cccccccc'), $config->get('arr/b', null, '/'));
    $this->assertEquals('cccccccc', $config->get('arr/b/c', null, '/'));

    $this->assertEquals('default', $config->get('hogehogehoge', 'default'));
    $this->assertEquals(null, $config->get('hogehogehoge'));
  }



}