<?php

namespace BlogDumper\Post;


/**
 * Class Quote
 * @package BlogDumper\Post
 */
class Quote extends APost
{
    public function getName()
    {
        return sprintf('quote %s', $this->getId());
    }

    public function getContent()
    {
        $content = parent::getContent();

        $content[] = [
            'text' => [sprintf(
                '<blockquote>%s</blockquote>%s',
                $this->postData->text,
                $this->postData->source ? sprintf('<cite>%s</cite>', $this->postData->source) : ''
            )]
        ];

        return $content;
    }
}