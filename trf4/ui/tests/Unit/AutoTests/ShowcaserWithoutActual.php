<?php


namespace Tests\Unit\AutoTests;

use Tests\Showcaser;
use TRF4\UI\Renderer\AbstractRenderer;

abstract class ShowcaserWithoutActual extends Showcaser
{

    public function test(AbstractRenderer $renderer, string $expected)
    {
        parent::test($renderer, $expected);
    }

    public function rendererExpectations(): array
    {
        return [];
    }

    public function description(): string
    {
        return '';
    }
}