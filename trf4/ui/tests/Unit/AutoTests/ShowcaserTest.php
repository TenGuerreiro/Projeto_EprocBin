<?php


namespace Tests\Unit\AutoTests;


use Tests\Showcaser;
use Tests\TestCase;
use TRF4\UI\UI;

class ShowcaserTest extends TestCase
{
    /**
     * @param string $expected
     * @param Showcaser $showcaseable
     * @throws \ReflectionException
     * @dataProvider methodDataProvider
     */
    public function testMethod(string $expected, Showcaser $showcaseable)
    {
        $actual = $showcaseable->getActualMethodCode();
        $this->assertEquals($expected, $actual);
    }

    public function methodDataProvider(): array
    {
        return [
            [
                "UI::button('meu botão');",
                new class extends ShowcaserWithoutActual {
                    public function actual(): string
                    {
                        return UI::button('meu botão');
                    }
                }
            ], [

                "\$options = [
    1 => 'a',
    2 => 'b'
];
UI::select('My select', 'my_select', \$options);",
                new class extends ShowcaserWithoutActual {
                    public function actual(): string
                    {
                        $options = [
                            1 => 'a',
                            2 => 'b'
                        ];
                        return UI::select('My select', 'my_select', $options);
                    }
                }
            ], [

                "\$options = [
    UI::checkbox('Checkbox 1', null, 1)->disabled(),
    UI::checkbox('Checkbox 2', 'customCheckbox2', 2)->checked()
];

UI::checkboxGroup('label', \$options, 'name');",
                new class extends ShowcaserWithoutActual {
                    public function actual(): string
                    {

                        $options = [
                            UI::checkbox('Checkbox 1', null, 1)->disabled(),
                            UI::checkbox('Checkbox 2', 'customCheckbox2', 2)->checked()
                        ];

                        return UI::checkboxGroup('label', $options, 'name');
                    }
                }
            ],
        ];
    }


}