<?php

namespace BlogDumper\Config;


/**
 * Class CliConfig
 * @package BlogDumper\Config
 */
class CliConfig extends Config
{
    public function __construct($argv)
    {
        array_shift($argv);

        $confData = [];
        foreach ($argv as $arg) {
            @list($key, $value) = explode('=', $arg);

            $key = substr_replace($key, '', 0, 2);
            $value = trim($value, "'\"");

            if ($key == 'config') {
                parent::init($value);
                break;
            } else {
                $confData[$key] = $value;
            }
        }

        if (!$confData) {
            parent::init();
        }

        parent::__construct($confData);
    }
}