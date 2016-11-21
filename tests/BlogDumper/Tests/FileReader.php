<?php

namespace BlogDumper\Tests;


class FileReader
{
    public static function get($path)
    {
        $path = realpath(dirname(__FILE__) . '/../../data/' . $path);

        if ($path) {
            return json_decode(file_get_contents($path));
        }

        return null;
    }
}