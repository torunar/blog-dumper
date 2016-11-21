<?php

namespace BlogDumper\Tests\Posts;

use BlogDumper\Tests\FileReader;
use BlogDumper\Post\Text;


/**
 * Class TextTest
 * @package BlogDumper\Tests\Posts
 */
class TextTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getNameProvider
     */
    public function testGetName($postData, $expected)
    {
        $obj = new Text($postData);
        $this->assertEquals($expected, $obj->getName());
    }

    public function getNameProvider()
    {
        $path = 'post/text/';

        return [
            [FileReader::get($path . 'text.json'), 'Title'],
            [FileReader::get($path . 'text-empty.json'), '']
        ];
    }

    /**
     * @dataProvider getContentProvider
     */
    public function testGetContent($postData, $expected)
    {
        $obj = new Text($postData);
        $this->assertEquals($expected, $obj->getContent());
    }

    public function getContentProvider()
    {
        $path = 'post/text/';

        return [
            [FileReader::get($path . 'text.json'), [
                ['text' => ['Body']],
            ]],
            [FileReader::get($path . 'text-empty.json'), [
                ['text' => ['']],
            ]]
        ];
    }
}