<?php

namespace BlogDumper\Tests\Posts;

use BlogDumper\Tests\FileReader;
use BlogDumper\Post\Audio;


/**
 * Class AudioTest
 * @package BlogDumper\Tests\Posts
 */
class AudioTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getNameProvider
     */
    public function testGetName($postData, $expected)
    {
        $obj = new Audio($postData);
        $this->assertEquals($expected, $obj->getName());
    }

    public function getNameProvider()
    {
        $path = 'post/audio/';

        return [
            [FileReader::get($path . 'audio.json'), 'Artist - Track Name'],
            [FileReader::get($path . 'audio-empty.json'), ' - ']
        ];
    }

    /**
     * @dataProvider getContentProvider
     */
    public function testGetContent($postData, $expected)
    {
        $obj = new Audio($postData);
        $this->assertEquals($expected, $obj->getContent());
    }

    public function getContentProvider()
    {
        $path = 'post/audio/';

        return [
            [FileReader::get($path . 'audio.json'), [
                ['text' => ['Caption']],
                ['remote' => ['http://example.com/audio_source_url']]
            ]],
            [FileReader::get($path . 'audio-empty.json'), [
                ['text' => ['']],
                ['remote' => ['']]
            ]]
        ];
    }
}