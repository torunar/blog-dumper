<?php

namespace BlogDumper\Tests\Posts;

use BlogDumper\Tests\FileReader;
use BlogDumper\Post\Quote;


/**
 * Class QuoteTest
 * @package BlogDumper\Tests\Posts
 */
class QuoteTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider getNameProvider
     */
    public function testGetName($postData, $expected)
    {
        $obj = new Quote($postData);
        $this->assertEquals($expected, $obj->getName());
    }

    public function getNameProvider()
    {
        $path = 'post/quote/';

        return [
            [FileReader::get($path . 'quote.json'), 'quote 1'],
            [FileReader::get($path . 'quote-empty.json'), 'quote 1']
        ];
    }

    /**
     * @dataProvider getContentProvider
     */
    public function testGetContent($postData, $expected)
    {
        $obj = new Quote($postData);
        $this->assertEquals($expected, $obj->getContent());
    }

    public function getContentProvider()
    {
        $path = 'post/quote/';

        return [
            [FileReader::get($path . 'quote.json'), [
                ['text' => ['<blockquote>Text</blockquote><cite>Source</cite>']],
            ]],
            [FileReader::get($path . 'quote-empty.json'), [
                ['text' => ['<blockquote></blockquote>']],
            ]]
        ];
    }
}