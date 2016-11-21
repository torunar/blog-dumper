<?php

namespace BlogDumper\Tests\Posts;

use BlogDumper\Tests\FileReader;
use BlogDumper\Post\Chat;


/**
 * Class ChatTest
 * @package BlogDumper\Tests\Posts
 */
class ChatTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getNameProvider
     */
    public function testGetName($postData, $expected)
    {
        $obj = new Chat($postData);
        $this->assertEquals($expected, $obj->getName());
    }

    public function getNameProvider()
    {
        $path = 'post/chat/';

        return [
            [FileReader::get($path . 'chat.json'), 'Title'],
            [FileReader::get($path . 'chat-empty.json'), '']
        ];
    }

    /**
     * @dataProvider getContentProvider
     */
    public function testGetContent($postData, $expected)
    {
        $obj = new Chat($postData);
        $this->assertEquals($expected, $obj->getContent());
    }

    public function getContentProvider()
    {
        $path = 'post/chat/';

        return [
            [FileReader::get($path . 'chat.json'), [
                ['text' => ['<dl><dt>Name1</dt><dd>Phrase1</dd><dt>Name2</dt><dd>Phrase2</dd></dl>']],
            ]],
            [FileReader::get($path . 'chat-empty.json'), [
                ['text' => ['<dl></dl>']],
            ]]
        ];
    }
}