<?php
namespace Kohkimakimoto\Silex\Config;

use Symfony\Component\Yaml\Yaml;

/**
 * Connfig Class
 *
 * @author kohkimakimoto <kohki.makimoto@gmail.com>
 */
class Config
{
  /**
   * Array of configuration values.
   * @var unknown
   */
  protected $config = array();

  public function __construct($config = array())
  {
    $this->merge($config);
  }

  /**
   * Get a config parameter.
   * @param unknown $name
   * @param string $default
  */
  public function get($name, $default = null, $delimiter = null)
  {
    $config = $this->config;
    if ($delimiter !== null) {
      foreach (explode($delimiter, $name) as $key) {
        $config = isset($config[$key]) ? $config[$key] : $default;
      }
    } else {
      $config = isset($config[$name]) ? $config[$name] : $default;
    }
    return $config;
  }

  /**
   * Set a config parameter.
   * @param unknown $name
   * @param unknown $value
   */
  public function set($name, $value)
  {
    $this->config[$name] = $value;
  }

  public function delete($name)
  {
    unset($this->config[$name]);
  }

  /**
   * Merge config array.
   * @param unknown $path
   */
  public function merge($arr)
  {
    $this->config = array_merge($this->config, $arr);
  }

  public function mergeFile($file, $key = null)
  {
    if (!is_file($file)) {
      return;
    }

    $parsedConfig = Yaml::parse($file);
    if ($parsedConfig) {

      if (!is_array($parsedConfig)) {
        $parsedConfig = array($parsedConfig);
      }

      if ($key === null) {
        $this->config = array_merge($this->config, $parsedConfig);
      } else {
        $config = $this->get($key);
        if (!$config) {
          $config = array();
        }
        $config = array_merge($config, $parsedConfig);
        $this->set($key, $config);
      }
    }
  }

  /**
   * Get All config parameters.
   * @return multitype:
   */
  public function getAll()
  {
    return $this->config;
  }

  public function getAllOnFlatArray($namespace = null, $key = null, $array = null, $delimiter = '/')
  {
    $ret = array();

    if ($array === null) {
      $array = $this->config;
    }

    foreach ($array as $key => $val) {
      if (is_array($val) && $val) {
        if ($namespace === null) {
          $ret = array_merge($ret, $this->getAllOnFlatArray($key, $key, $val, $delimiter));
        } else {
          $ret = array_merge($ret, $this->getAllOnFlatArray($namespace.$delimiter.$key, $key, $val, $delimiter));
        }
      } else {
        if ($namespace !== null) {
          $ret[$namespace.$delimiter.$key] = $val;
        } else {
          $ret[$key] = $val;
        }
      }
    }

    return $ret;
  }
}
