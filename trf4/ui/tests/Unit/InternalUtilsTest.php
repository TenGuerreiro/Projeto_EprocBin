<?php

namespace Tests\Unit;

use Tests\TestCase;
use TRF4\UI\Util\Internal;

class InternalUtilsTest extends TestCase
{

    /**
     * @dataProvider dpTest
     * @param $string
     * @param $accesskey
     * @param $expected
     */
    public function test($string, $accesskey, $expected)
    {
        $actual = Internal::addAccesskeyTagToString($string, $accesskey);

        $this->assertEquals($expected, $actual);
    }

    public function dpTest()
    {
        return [
            ['a   c  d', 'd', 'a   c &nbsp;<u>d</u>'],
            ['Abc', 'a', '<u>A</u>bc'],
            ['Abc Cde', 'c', 'Abc&nbsp;<u>C</u>de'],
            ['çac', 'ç', '<u>ç</u>ac'],
            ['caç', 'ç', 'ca<u>ç</u>'],
            ['ábc', 'a', 'ábc'],
            ['abc', 'a', '<u>a</u>bc'],
            ['abc', 'd', 'abc'],
            ['abc d', 'c', 'ab<u>c</u>&nbsp;d'],
            ['abcd', 'd', 'abc<u>d</u>'],
            ['abc abc', 'a', '<u>a</u>bc abc'],
            ['abc abc abc', 'a', '<u>a</u>bc abc abc'],
            ['abc dbc', 'd', 'abc&nbsp;<u>d</u>bc'],
            ['abc dbc dbc', 'd', 'abc&nbsp;<u>d</u>bc dbc'],
        ];
    }

    /**
     * @dataProvider dpSanitizeValue
     */
    public function testSanitizeValue($param, $expected)
    {
        $this->assertEquals($expected,
            Internal::sanitize($param)
        );
    }

    public function dpSanitizeValue()
    {
        return [
            ['abc', 'abc'],
            ["\"'><script>alert(1);</script>", "&amp;quot;'&amp;gt;&amp;lt;script&amp;gt;alert(1);&amp;lt;/script&amp;gt;"],

        ];
    }
}
