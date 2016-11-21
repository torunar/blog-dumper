<?php

namespace BlogDumper\Writer\Content;


/**
 * Class Remote
 * @package BlogDumper\Writer\Content
 */
class Remote extends AWriter
{
    public function setTarget($path)
    {
        $file = trim($this->target, '/');

        $this->target = sprintf(
            "%s/%s",
            parent::setTarget($path),
            ($file ? $file : substr($this->source, strrpos($this->source, '/') + 1))
        );

        return $this->target;
    }

    public function getAsynchronous()
    {
        $ch = curl_init();
        $target = $this->target;

        curl_setopt($ch, CURLOPT_URL, $this->source);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_WRITEFUNCTION, function($curlHandle, $data) use ($target) {
            return $this->write($target, $data);
        });

        return $ch;
    }
}