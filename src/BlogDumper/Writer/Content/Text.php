<?php

namespace BlogDumper\Writer\Content;


/**
 * Class Text
 * @package BlogDumper\Writer\Content
 */
class Text extends Binary
{
    public function __construct(array $sourceAndTarget)
    {
        parent::__construct($sourceAndTarget);

        if (!$this->target) {
            $this->target = 'index.html';
        }
    }
}