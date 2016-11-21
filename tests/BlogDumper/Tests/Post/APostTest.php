<?php

namespace BlogDumper\Tests\Posts;

use BlogDumper\Tests\FileReader;
use BlogDumper\Post\APost;


/**
 * Class APostTest
 * @package BlogDumper\Tests\Posts
 */
class APostTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getIdProvider
     */
    public function testGetId($postData, $expected)
    {
        $obj = new APost($postData);
        $this->assertEquals($expected, $obj->getId());
    }

    public function getIdProvider()
    {
        $path = 'post/apost/';

        return [
            [FileReader::get($path . 'apost.json'), 1],
        ];
    }

    /**
     * @dataProvider getDateProvider
     */
    public function testGetDate($postData, $expected)
    {
        $obj = new APost($postData);
        $this->assertEquals($expected, $obj->getDate()->format('Y-m-d H:i:s T'));
    }

    public function getDateProvider()
    {
        $path = 'post/apost/';

        return [
            [FileReader::get($path . 'apost.json'), '2016-01-01 00:00:00 GMT'],
        ];
    }

    /**
     * @dataProvider getTagsProvider
     */
    public function testGetTags($postData, $expected)
    {
        $obj = new APost($postData);
        $this->assertEquals($expected, $obj->getTags());
    }

    public function getTagsProvider()
    {
        $path = 'post/apost/';

        return [
            [FileReader::get($path . 'apost.json'), ['tag1', 'tag2', 'tag3']],
            [FileReader::get($path . 'apost-empty.json'), []],
        ];
    }
}