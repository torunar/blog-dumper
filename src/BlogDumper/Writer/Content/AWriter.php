<?php

namespace BlogDumper\Writer\Content;


/**
 * Class AWriter
 * @package BlogDumper\Writer\Content
 */
class AWriter
{
    /**
     * @var string $source Source of the content
     */
    protected $source;

    /**
     * @var string $target Place to write content to
     */
    protected $target;

    public function __construct(array $sourceAndTarget)
    {
        $this->source = reset($sourceAndTarget);
        $this->target = count($sourceAndTarget) > 1 ? end($sourceAndTarget) : null;
    }

    public function setSource($source)
    {
        $this->source = $source;
        return $this->source;
    }

    public function setTarget($path)
    {
        $this->target = rtrim($path, '/');

        return $this->target;
    }

    public function getSynchronous()
    {
        return false;
    }

    public function getAsynchronous()
    {
        return false;
    }

    public static function write($target, $data = '')
    {
        if (!file_exists(dirname($target))) {
            mkdir(dirname($target), 0777, true);
        }

        return file_put_contents($target, $data, FILE_APPEND);
    }
}