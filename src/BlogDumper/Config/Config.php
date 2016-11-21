<?php

namespace BlogDumper\Config;

use BlogDumper\Config\Exception;


/**
 * Class Config
 * @package BlogDumper\Config
 */
class Config
{
    private static $config;

    public function __construct($confData = null)
    {
        self::init($confData);
    }

    public static function init($confData = null)
    {
        if (!isset(self::$config)) {
            if (is_array($confData)) {
                self::setArray($confData);
            } else {
                $confPath = empty($confData)? realpath(dirname(__FILE__) . '/../../config.php') : $confData;
                self::$config = require_once($confPath);
            }

            self::validate(self::$config);
        }
    }

    public static function get($key = null, $default = null)
    {
        self::init();

        if (isset($key)) {
            return isset(self::$config[$key]) ? self::$config[$key] : $default;
        }

        return self::$config;
    }

    public static function set($key, $value)
    {
        self::init();

        self::$config[$key] = $value;
    }

    public static function setArray($config)
    {
        self::validate($config);

        self::$config = $config;
    }

    public static function getSchema()
    {
        return [
            'consumerKey',
            'consumerSecret',
            'token',
            'tokenSecret',
            'apiKey',
            'blogName',
            'queueSize',
            'writePath',
        ];
    }

    public static function validate(array $data)
    {
        foreach ($data as $key => $value) {
            if (!in_array($key, self::getSchema())) {
                throw new Exception(sprintf('Unknown parameter: %s', $key));
            }
        }
        foreach (self::getSchema() as $key) {
            if (empty($data[$key])) {
                throw new Exception(sprintf('Missing required parameter: %s', $key));
            }
        }
    }
}