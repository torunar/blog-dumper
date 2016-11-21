<?php

namespace BlogDumper\Post;


/**
 * Class Audio
 * @package BlogDumper\Post
 */
class Audio extends APost
{
    public function getName()
    {
        return sprintf('%s - %s', $this->postData->artist, $this->postData->track_name);
    }

    public function getContent()
    {
        $content = parent::getContent();

        $content[]  = [
            'text' => [$this->postData->caption],
        ];

        $content[] = [
            'remote' => [$this->postData->audio_source_url],
        ];

        return $content;
    }
}