<?php

namespace BlogDumper\Post;


/**
 * Class Chat
 * @package BlogDumper\Post
 */
class Chat extends APost
{
    public function getName()
    {
        return $this->postData->title;
    }

    public function getContent()
    {
        $content = parent::getContent();

        $chat = '';
        foreach ($this->postData->dialogue as $entry) {
            $chat .= sprintf(
                '<dt>%s</dt><dd>%s</dd>',
                $entry->name,
                $entry->phrase
            );
        }

        $content[] = [
            'text' => [sprintf(
                '<dl>%s</dl>',
                $chat
            )]
        ];

        return $content;
    }
}