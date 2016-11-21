<?php

namespace BlogDumper\Writer\Content;


/**
 * Class Binary
 * @package BlogDumper\Writer\Content
 */
class Binary extends AWriter
{
    public function setTarget($path)
    {
        $file = trim($this->target, '/');

        $this->target = sprintf(
            "%s/%s",
            parent::setTarget($path),
            $file
        );

        return $this->target;
    }

    public function getSynchronous()
    {
        return [
            [
                __CLASS__,
                'write'
            ],
            [
                $this->target,
                $this->source
            ]
        ];
    }
}