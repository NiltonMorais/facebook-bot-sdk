<?php

namespace CodeBot\Message;

use PHPUnit\Framework\TestCase;

class TextTest extends TestCase
{
    public function testReturnsAnArray()
    {
        $actual = (new Text(1))->message('Oii');
        $expected = [
            'recipient' => [
                'id'=>1
            ],
            'message' => [
                'text' => 'Oii',
                'metadata' => 'DEVELOPER_DEFINED_METADATA'
            ]
        ];
        $this->assertEquals($actual,$expected);
    }
}