<?php

namespace BlogDumper\Post;


/**
 * Class Text
 * @package BlogDumper\Post
 */
class Text extends APost
{
    public function getName()
    {
        return $this->postData->title;
    }

    public function getContent()
    {
        $content = parent::getContent();

        $content[] = [
            'text' => [$this->postData->body]
        ];

        return $content;
    }
}