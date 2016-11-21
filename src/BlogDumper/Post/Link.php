<?php

namespace BlogDumper\Post;


/**
 * Class Link
 * @package BlogDumper\Post
 */
class Link extends APost
{
    public function getName()
    {
        return $this->postData->title;
    }

    public function getContent()
    {
        $content = parent::getContent();

        $content[] = [
            'text' => [sprintf(
                '<a href="%s" target="_blank">%s</a>',
                $this->postData->url,
                $this->postData->description
            )]
        ];

        return $content;
    }
}