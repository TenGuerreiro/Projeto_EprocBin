<?php


namespace Tests\Unit\AutoTests\ClassHelper\b;


use Tests\Showcaser;

class bc extends Showcaser
{

    public function rendererExpectations(): array {
        return [];
    }

    public function actual(): string {
        return '';
    }

    public function description(): string {
        return '';
    }
}