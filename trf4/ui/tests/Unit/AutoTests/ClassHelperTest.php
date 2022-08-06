<?php


namespace Tests\Unit\AutoTests;

use App\Http\View\DocsHelper\ClassHelper;
use App\Http\View\DocsHelper\Directory;
use App\Http\View\DocsHelper\TestClass;
use Tests\TestCase;
use Tests\Unit\AutoTests\ClassHelper\a\a1\a1c;
use Tests\Unit\AutoTests\ClassHelper\b\bc;

class ClassHelperTest extends TestCase
{
    /** @var Directory */
    public $b;
    /** @var Directory */
    public $a;
    /** @var TestClass */
    public $bc;
    /** @var TestClass */
    public $a1c;

    protected function setUp(): void
    {
        $this->a = new Directory('a', null, [], []);
        $this->a1 = new Directory('a1', null, [], [
            ($this->a1c = new TestClass(new a1c()))
        ]);
        $this->a->addChildDirectory($this->a1);
        $this->b = new Directory('b', null, [], [
            ($this->bc = new TestClass(new bc()))
        ]);
    }

    public function testGetFilesTree()
    {
        $classHelper = new ClassHelper();
        $expected = [$this->a, $this->b];
        $dir = realpath(__DIR__ . '/ClassHelper/');
        $actual = $classHelper->getFilesTree($dir);

        $this->assertEquals($expected, $actual);
    }

    public function testGetHtmlId()
    {
        $this->assertEquals(
            'a_a1_a1c',
            $this->a1c->getHtmlId()
        );
    }


}