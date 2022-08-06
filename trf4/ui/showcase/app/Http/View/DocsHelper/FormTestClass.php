<?php

namespace App\Http\View\DocsHelper;

use TRF4\UI\Unserialize;

/**
 * Class TestClass
 */
class FormTestClass extends TestClass
{
    public function getPhpServerCode(string $httpMethod)
    {
        $code =
            $this->buildCodePrefix() .
            $this->showcaser->getCodeFromMethod('retrieveValue');

        //todo replace $method with httpMethod
        return str_replace('$method', $httpMethod, $code);
    }

    private function buildCodePrefix(): string
    {
        return 'use ' . Unserialize::class . ';' . PHP_EOL . PHP_EOL;
    }
}
