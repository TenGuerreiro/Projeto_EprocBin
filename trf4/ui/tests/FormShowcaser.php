<?php


namespace Tests;


abstract class FormShowcaser extends Showcaser
{
    abstract public function retrieveValue(string $method);
}