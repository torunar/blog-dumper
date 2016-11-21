<?php

namespace BlogDumper\Tests\Posts;

use BlogDumper\Tests\FileReader;
use BlogDumper\Post\Photo;


/**
 * Class PhotoTest
 * @package BlogDumper\Tests\Posts
 */
class PhotoTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getNameProvider
     */
    public function testGetName($postData, $expected)
    {
        $obj = new Photo($postData);
        $this->assertEquals($expected, $obj->getName());
    }

    public function getNameProvider()
    {
        $path = 'post/photo/';

        return [
            [FileReader::get($path . 'photo.json'), 'photo 1'],
            [FileReader::get($path . 'photo-empty.json'), 'photo 1']
        ];
    }

    /**
     * @dataProvider getContentProvider
     */
    public function testGetContent($postData, $expected)
    {
        $obj = new Photo($postData);
        $this->assertEquals($expected, $obj->getContent());
    }

    public function getContentProvider()
    {
        $path = 'post/photo/';

        return [
            [FileReader::get($path . 'photo.json'), [
                ['text' => ['Caption']],
                ['remote' => ['http://example.com/image.jpg', '01.jpg']],
                ['text' => ['Caption', '01.html']],
            ]],
            [FileReader::get($path . 'photo-multi.json'), [
                ['text' => ['Caption']],
                ['remote' => ['http://example.com/image.jpg', '01.jpg']],
                ['text' => ['Caption 1', '01.html']],
                ['remote' => ['http://example.com/image.png', '02.png']],
                ['text' => ['Caption 2', '02.html']],
            ]],
            [FileReader::get($path . 'photo-empty.json'), [
            ]]
        ];
    }
}