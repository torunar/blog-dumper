<?php

namespace BlogDumper\Tests\Posts;

use BlogDumper\Tests\FileReader;
use BlogDumper\Post\Link;


/**
 * Class LinkTest
 * @package BlogDumper\Tests\Posts
 */
class LinkTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getNameProvider
     */
    public function testGetName($postData, $expected)
    {
        $obj = new Link($postData);
        $this->assertEquals($expected, $obj->getName());
    }

    public function getNameProvider()
    {
        $path = 'post/link/';

        return [
            [FileReader::get($path . 'link.json'), 'Title'],
            [FileReader::get($path . 'link-empty.json'), '']
        ];
    }

    /**
     * @dataProvider getContentProvider
     */
    public function testGetContent($postData, $expected)
    {
        $obj = new Link($postData);
        $this->assertEquals($expected, $obj->getContent());
    }

    public function getContentProvider()
    {
        $path = 'post/link/';

        return [
            [FileReader::get($path . 'link.json'), [
                ['text' => ['<a href="http://example.com" target="_blank">Description</a>']],
            ]],
            [FileReader::get($path . 'link-empty.json'), [
                ['text' => ['<a href="" target="_blank"></a>']],
            ]]
        ];
    }
}